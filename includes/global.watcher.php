<?php

	if(isset($_SESSION["steamid"]))
	{
		$watcher_db = new mysqli("HOST", "USERNAME", "PASSWORD", "CACHE DATABASE");
		$watcher_q = "SELECT * FROM `user_info` WHERE `steamid`='".$_SESSION["steamid"]."'";

		$watcher_r = $watcher_db->query($watcher_q);

		while($w = $watcher_r->fetch_assoc())
		{
			define("A_TERMS",$w["accepted_terms"]);
		}
	}
	else
	{
		if(isset($_COOKIE["_uc"]) && isset($_COOKIE["_usid"]))
		{
			$hashed_sid = denc($_COOKIE["_uc"],EKEY,"de");

			if($hashed_sid === $_COOKIE["_usid"])
			{
				session_start();
				$_SESSION["steamid"] = $hashed_sid;
				$_SESSION["personaname"] = get_user_meta($hashed_sid,'personaname');
				$_SESSION["avatar"] = get_user_meta($hashed_sid,'avatar_medium');
				$_SESSION["user_hash"] = denc($hashed_sid, EKEY, "en");
				$_SESSION["rank"] = get_user_meta($hashed_sid,'rank',true);
			}
			else
			{
				session_unset();
				session_destroy();
				$auth->LogOut();

				unset($_COOKIE["_uc"]);
				unset($_COOKIE["_usid"]);
				setcookie('_uc', null, -1, '/');
				setcookie('_usid', null, -1, '/');
			}

			#echo denc($_COOKIE["_uc"],EKEY,"de");
		}
	}

?>