<?php

	require_once("../includes/initializer.php");

	$smarty->assign("body_class","help view-article has-navbars classic-nav");
	$smarty->assign("classic_nav",true);
	$smarty->assign("slim_hero",true);

	if(isset($_GET["view"]))
	{
		if(!empty($_GET["view"]))
		{
			if(is_numeric($_GET["view"]))
			{
				$query = "SELECT * FROM `articles` WHERE `id`='".$_GET["view"]."'";
				$result = $GLOBALS["c"]->query($query);
				if(!$result)
				{
					die("An error should go here.");
				}
				else
				{
					if(mysqli_num_rows($result) > 0)
					{
						while($info = $result->fetch_assoc())
						{
							$smarty->assign("top_ad",false);
							$smarty->assign("bot_ad",false);
							$smarty->assign("article_id",$info["id"]);
							$smarty->assign("article_title",$info["title"]);
							$smarty->assign("article_content",$info["content"]);
							$smarty->display(ROOT."/templates/deploy/help/view.tpl");
						}
					}
					else
					{
						$smarty->assign("error_description","The article you have requested does not appear to exist.");
						$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
					}
				}
			}
			else
			{
				header("Location: /help");
			}
		}
		else
		{
			header("Location: /help");
		}
	}
	elseif(isset($_GET["add"]))
	{
		$smarty->assign("top_ad",false);
		$smarty->assign("bot_ad",false);
		$smarty->display(ROOT."/templates/deploy/help/add.tpl");
	}
	else
	{
		$smarty->assign("top_ad",true);
		$smarty->assign("bot_ad",true);
		$smarty->assign("kb_articles",$GLOBALS["articles"]);
		$smarty->display(ROOT."/templates/deploy/help/index.tpl");
	}

?>