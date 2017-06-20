<?php

	require_once("../includes/initializer.php");

	$smarty->assign("body_class","admin-posts has-navbars classic-nav");
	$smarty->assign("classic_nav",true);
	$smarty->assign("slim_hero",true);

	if(isset($_GET["view"]))
	{
		if(!empty($_GET["view"]))
		{
			if(is_numeric($_GET["view"]))
			{
				$post_con = new mysqli(DB_HOST, DB_USER, DB_PASS, 'POSTS DATABASE');
				$post_q = "SELECT * FROM `posts` WHERE `id`='".$_GET["view"]."'";

				$result = $post_con->query($post_q);
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
							$smarty->assign("top_ad",true);
							$smarty->assign("bot_ad",true);
							$smarty->assign("post_id",$info["id"]);
							$smarty->assign("post_hash",$info["post_hash"]);
							$smarty->assign("post_date",$info["post_date"]);
							$smarty->assign("post_submitter",$info["poster"]);
							$smarty->assign("post_title",$info["title"]);
							$smarty->assign("post_content",$info["content"]);
							$smarty->assign("admin_only",$info["admin_only"]);
							$smarty->assign("login_only",$info["login_only"]);
							$smarty->display(ROOT."/templates/deploy/posts/view.tpl");
						}
					}
					else
					{
						$smarty->assign("error_description","The post you have requested does not appear to exist.");
						$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
					}
				}
			}
			else
			{
				header("Location: /");
			}
		}
		else
		{
			header("Location: /");
		}
	}
	elseif(isset($_GET["add"]))
	{
		$smarty->assign("top_ad",false);
		$smarty->assign("bot_ad",false);
		$smarty->display(ROOT."/templates/deploy/posts/create.tpl");
	}
	else
	{
		header("Location: /");
	}

?>