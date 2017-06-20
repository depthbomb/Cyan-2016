<?php

	require("classes/SteamAuth.class.php");

	$auth = new SteamAuth();
	// You can use this to do other checks on the person, such as making an account in a database
	$auth->SetOnLoginCallback(function($steamid){
		return true; // returning true will log them in, false will stop the login (you should put an error message in that case)
	});
	// This handler is for when a login fails Ex: cancelled, auth failed, exploit attempt, etc
	$auth->SetOnLoginFailedCallback(function(){
		return true;
	});
	// Always call Init() on pages you want to check a login from.  Call this AFTER you set handlers!
	$auth->Init();

?>