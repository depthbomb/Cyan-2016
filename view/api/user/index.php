<?php

	header("Content-type: application/json");

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		if(isset($_GET["user_info"]) AND !empty($_GET["user_info"]))
		{
			$api_key = "STEAM API KEY";

			$response = json_decode(file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $api_key . "&steamids=" . $_GET["user_info"]), true);

			$json = array(
				"success"=>true,
				"user_data"=>array(
					"avatar_lg"=>$response['response']['players'][0]['avatarfull'],
					"avatar_med"=>$response['response']['players'][0]['avatarmedium'],
					"avatar_small"=>$response['response']['players'][0]['avatar'],
					"personaname"=>$response['response']['players'][0]['personaname']
				)
			);
		}

		echo json_encode($json,JSON_PRETTY_PRINT);
	}
	else
	{
		echo json_encode(array("error"=>"This is not a public API."));
	}

?>