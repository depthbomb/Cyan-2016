<?php

	require_once("../includes/initializer.php");

	if(isset($_GET["code"]))
	{
		$code = $_GET["code"];
		#header($_SERVER['HTTP_HOST']." ".$header,true,$code);
		if($code == 401)
		{
			$error_title = "401 - Unauthorized";
			$error_description = "The page you are trying to access requires you to be authorized, probably via logging in.";
		}
		elseif($code == 403)
		{
			$error_title = "403 - Forbidden";
			$error_description = "The resource you tried to view is off-limits.";
		}
		elseif($code == 404)
		{
			$error_title = "404 - File Not Found";
			$error_description = "The file you have requested does not appear to exist.";
		}
		elseif($code == 500)
		{
			$error_title = "500 - Internal Server Error";
			$error_description = "Something went wrong on the server.";
		}
		$smarty->assign("error_title",$error_title);
		$smarty->assign("error_description",$error_description);
		$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
	}
	else
	{
		header("Location: /");
	}

?>