<?php

	require_once("../includes/initializer.php");

	$smarty->assign("body_class","inbox has-navbars classic-nav");
	$smarty->assign("classic_nav",true);
	$smarty->assign("slim_hero",true);
	$smarty->assign("top_ad",false);
	$smarty->assign("bot_ad",false);

	$inbox_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "cyan_inbox");

	if(!isset($_GET["message"]) || empty($_GET["message"]))
	{
		$index_q = "SELECT * FROM `inboxes` WHERE `to`='".$_SESSION["steamid"]."' ORDER BY `send_date` DESC";
		if(mysqli_num_rows($inbox_db->query($index_q)) > 0)
		{
			$smarty->assign("num_messages",mysqli_num_rows($inbox_db->query($index_q)));
			$smarty->assign("messages",$inbox_db->query($index_q));
		}
		$smarty->display(ROOT.'/templates/deploy/inbox/index.tpl');
	}
	else
	{
		$view_q = "SELECT * FROM `inboxes` WHERE `to`='".$_SESSION["steamid"]."' && `message_hash`='".$_GET["message"]."'";
		if(mysqli_num_rows($inbox_db->query($view_q)) > 0)
		{
			$result = $inbox_db->query($view_q);
			while($mi = $result->fetch_assoc())
			{
				if($mi["to"] === $_SESSION["steamid"])
				{
					$smarty->assign("message_date",$mi["send_date"]);
					$smarty->assign("message_subject",$mi["subject"]);
					$smarty->assign("message_body",$mi["body"]);
					$smarty->assign("message_from",$mi["from"]);

					$smarty->display(ROOT.'/templates/deploy/inbox/view.tpl');
				}
				else
				{
					$smarty->assign("error_description","You do not have permission to view this message. You may only view messages that are yours while you are logged in.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
		}
		else
		{
			$smarty->assign("error_description","The message you have requested does not appear to exist.");
			$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
		}
	}

	$inbox_db->close();

?>