<?php

	require_once("../includes/initializer.php");

	$smarty->assign("body_class","tickets has-navbars classic-nav");
	$smarty->assign("classic_nav",true);
	$smarty->assign("slim_hero",true);

	$t_view = new mysqli(DB_HOST, DB_USER, DB_PASS, "TICKETS DATABASE");

	if(!isset($_GET["view"]) || empty($_GET["view"]))
	{
		$smarty->assign("top_ad",true);
		$smarty->assign("bot_ad",true);

		$index_q = "SELECT * FROM `entries` WHERE `steamid`='".$_SESSION["steamid"]."'";
		if(mysqli_num_rows($t_view->query($index_q)) > 0)
		{
			$smarty->assign("u_num_tickets",mysqli_num_rows($t_view->query($index_q)));

			$list_t_q = "SELECT * FROM `entries` WHERE `steamid`='".$_SESSION["steamid"]."'";

			$smarty->assign("tickets_list",$t_view->query($list_t_q));
		}

		$smarty->display(ROOT.'/templates/deploy/ticket.tpl');
	}
	elseif(isset($_GET["view"]) AND !empty($_GET["view"]))
	{
		if($_GET["state"] === "submitted")
		{
			$smarty->assign("is_submitted",true);
		}
		$q = "SELECT * FROM `entries` WHERE `ticket_id`='".$_GET["view"]."'";

		$result = $t_view->query($q);

		if($result)
		{
			if(mysqli_num_rows($result) < 1)
			{
				$smarty->assign("error_description","The ticket you have requested does not exist.");
				$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
			}
			else
			{
				$replies_q = "SELECT * FROM `admin_replies` WHERE `reply_to`='".$_GET["view"]."'";

				$result_r = $t_view->query($replies_q);
				if(mysqli_num_rows($result_r) > 0)
				{
					$smarty->assign("has_replies",true);
					$smarty->assign("a_replies",$result_r);
				}
				else
				{
					$smarty->assign("has_replies",false);
				}

				while($ti = $result->fetch_assoc())
				{
					if($ti["steamid"] === $_SESSION["steamid"] OR $_SESSION["rank"] > 1)
					{
						$smarty->assign("t_id",$ti["ticket_id"]);
						$smarty->assign("t_is_closed",$ti["closed"]);
						$smarty->assign("t_section",$ti["post_section"]);
						$smarty->assign("t_submitter",$ti["username"]);
						$smarty->assign("t_submitter_steamid",$ti["steamid"]);
						$smarty->assign("t_date",$ti["post_date"]);
						$smarty->assign("t_content",$ti["post_content"]);
						$smarty->display(ROOT."/templates/deploy/ticket/view.tpl");
					}
					else
					{
						$smarty->assign("error_description","You do not have permission to view this ticket. You may only view tickets that are yours while you are logged in.");
						$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
					}
				}
			}
		}
		else
		{
			$smarty->assign("error_description","The ticket you have requested does not appear to exist.");
			$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
		}
	}

?>