<?php

	require_once("global.config.php");
	require_once("global.constants.php");
	require_once("global.functions.php");
	require_once("steam.initializer.php");
	require_once("inbox.functions.php");
	require_once("user.functions.php");
	require_once("global.watcher.php");
	require_once("../vendor/autoload.php");

	#	===========	SMARTY	===========	#
	$smarty = new SmartyBC;
	$smarty->template_dir = ROOT."/templates";
	$smarty->compile_dir = ROOT."/templates_c";
	$smarty->caching = 0;
	$smarty->force_compile = true;
	$smarty->clear_all_cache();

	$smarty->assign("DB_CONNECT",$GLOBALS["c"]);

	if($auth->IsUserLoggedIn())
	{
		$smarty->assign("logged_in",true);
		if($_SESSION["rank"] > 2)
		{
			$smarty->assign("is_admin",true);
		}
		else
		{
			$smarty->assign("is_admin",false);
		}
		$smarty->assign("inbox_unread",NUM_UNREAD);
		$smarty->assign("accepted_terms",A_TERMS);
	}
	else
	{
		$smarty->assign("logged_in",false);
	}
	#	===========	SMARTY	===========	#

	if(in_array(get_real_ip(), $banned_users))
	{
		$is_banned = true;
	}
	else
	{
		$is_banned = false;
	}

?>
