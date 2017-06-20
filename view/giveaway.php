<?php

	require_once("../includes/initializer.php");

	$smarty->assign("body_class","giveaway has-navbars classic-nav");
	$smarty->assign("classic_nav",true);
	$smarty->assign("slim_hero",true);
	$smarty->assign("top_ad",true);
	$smarty->assign("bot_ad",true);

	$ga_view = new mysqli(DB_HOST, DB_USER, DB_PASS, "GIVEAWAYS DATABASE");

	if(!isset($_GET["view"]) || empty($_GET["view"]))
	{
		$index_q = "SELECT * FROM `giveaway` ORDER BY `created` DESC";
		if(mysqli_num_rows($ga_view->query($index_q)) > 0)
		{
			$smarty->assign("num_giveaways",mysqli_num_rows($ga_view->query($index_q)));
			$smarty->assign("giveaways",$ga_view->query($index_q));
		}
		$smarty->display(ROOT.'/templates/deploy/giveaways/index.tpl');
	}
	elseif(isset($_GET["view"]) AND !empty($_GET["view"]))
	{
		$q = "SELECT * FROM `giveaway` WHERE `hash`='".$_GET["view"]."'";

		$result = $ga_view->query($q);

		if($result)
		{
			if(mysqli_num_rows($result) < 1)
			{
				$smarty->assign("error_description","The giveaway you have requested does not appear to exist.");
				$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
			}
			else
			{
				while($ga = $result->fetch_assoc())
				{
					$smarty->assign("ga_hash",$ga["hash"]);
					$smarty->assign("ga_max_rank",$ga["max_rank"]);
					$smarty->assign("ga_created",$ga["created"]);
					$smarty->assign("ga_ends",$ga["ends"]);
					$smarty->assign("ga_by",$ga["by"]);
					$smarty->assign("ga_winner",$ga["winner"]);
					$smarty->assign("ga_subject",$ga["subject"]);
					$smarty->assign("ga_prize",$ga["prize"]);
					$smarty->assign("ga_is_completed",$ga["completed"]);
					$smarty->assign("ga_is_hidden",$ga["hidden"]);
					
					$smarty->display(ROOT."/templates/deploy/giveaways/view.tpl");
				}
			}
		}
		else
		{
			$smarty->assign("error_description","The giveaway you have requested does not appear to exist.");
			$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
		}
	}

?>