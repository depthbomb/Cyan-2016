<?php

	require_once("../includes/steam.initializer.php");
	session_unset();
	session_destroy();
	$auth->LogOut();

	unset($_COOKIE["_uc"]);
	unset($_COOKIE["_usid"]);
	setcookie('_uc', null, -1, '/');
	setcookie('_usid', null, -1, '/');
	
	@$goto = $_GET["goto"];
	
	if(isset($goto))
	{
		header("Location: $goto");
	}
	else
	{
		header("Location: /");
	}

?>