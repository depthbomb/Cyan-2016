<?php

	require_once("../includes/initializer.php");

	@$goto = $_GET["goto"];

	if(!$auth->IsUserLoggedIn())
	{
		header("Location: ".$auth->GetLoginURL());
	}
	else
	{
		#session_start();
		$api_key = "STEAM API KEY";
		$json = json_decode(file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$api_key."&steamids=".$auth->SteamID), true);

		$login_db = new mysqli(DB_HOST,DB_USER,DB_PASS,"CACHE DATABASE");
		$login_q = "SELECT * FROM `user_info` WHERE `steamid`='".$auth->SteamID."'";
		$login_r = $login_db->query($login_q);
		$login_num_rows = mysqli_num_rows($login_r);

		setcookie("_uc", denc($auth->SteamID,EKEY,"en"), time()+(86400 * 360), "/");
		setcookie("_usid", $auth->SteamID, time()+(86400 * 360), "/");

		if($login_num_rows === 1)
		{
			while($uc = $login_r->fetch_assoc())
			{
				$login_db->query(
					"UPDATE `user_info` SET 
					`ip`='".denc(get_real_ip(),EKEY,"en")."',
					`cookie_hash`='".md5($auth->SteamID+time()+mt_rand())."',
					`cache_time`='".time()."',
					`avatar_small`='".$json['response']['players'][0]['avatar']."', 
					`avatar_medium`='".$json['response']['players'][0]['avatarmedium']."', 
					`avatar_large`='".$json['response']['players'][0]['avatarfull']."',
					`personaname`='".htmlspecialchars($uc["personaname"])."'
					WHERE `steamid`='".$auth->SteamID."'"
					);
				$_SESSION["steamid"] = $uc["steamid"];
				$_SESSION["personaname"] = htmlspecialchars($uc["personaname"]);
				$_SESSION["avatar"] = $uc["avatar_medium"];
				$_SESSION["rank"] = $uc["rank"];
				$_SESSION["hide_ads"] = $uc["hide_ads"];
			}
		}
		else
		{
			$login_db->query("INSERT INTO `user_info`
				(`ip`,`cookie_hash`,`cache_time`,`steamid`,`avatar_small`,`avatar_medium`,`avatar_large`,`personaname`)
				VALUES
				('".denc(get_real_ip(),EKEY,"en")."','".md5($auth->SteamID+time()+mt_rand())."','".time()."','".$json['response']['players'][0]['steamid']."','".$json['response']['players'][0]['avatar']."','".$json['response']['players'][0]['avatarmedium']."','".$json['response']['players'][0]['avatarfull']."','".$json['response']['players'][0]['personaname']."')

			");
			$_SESSION["steamid"] = $json['response']['players'][0]['steamid'];
			$_SESSION["personaname"] = htmlspecialchars($json['response']['players'][0]['personaname']);
			$_SESSION["avatar"] = $json['response']['players'][0]['avatarmedium'];
			$_SESSION["rank"] = $uc["rank"];
			$_SESSION["hide_ads"] = $uc["hide_ads"];
		}

		if(isset($goto) && !empty($goto))
		{
			header("Location: $goto");
		}
		else
		{
			header("Location: /");
		}
	}

?>