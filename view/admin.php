<?php

	require_once("../includes/initializer.php");

	$smarty->assign("body_class","admin has-navbars classic-nav");
	$smarty->assign("classic_nav",true);
	$smarty->assign("slim_hero",true);
	$smarty->assign("top_ad",false);
	$smarty->assign("bot_ad",false);

	$admin_user_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "CACHE DATABASE");
	$admin_user_q = "SELECT * FROM `user_info` ORDER BY `rank` DESC";

	$smarty->assign("admin_users",$admin_user_db->query($admin_user_q));

	$smarty->display(ROOT."/templates/deploy/admin/index.tpl");

?>