<?php

	if(isset($_GET["to"]) AND !empty($_GET["to"]))
	{
		$url_decode_str = urldecode($_GET["to"]);
		$decoded_str = base64_decode($url_decode_str);

		if($decoded_str)
		{
			header($_SERVER['SERVER_PROTOCOL']." 301 Moved Permanently", true, 301);
			header("Location: ".$decoded_str);
		}
		else
		{
			header($_SERVER['SERVER_PROTOCOL']." 500 Internal Server Error", true, 500);
			die("Invalid Parameter(s).");
		}
	}
	else
	{
		header($_SERVER['SERVER_PROTOCOL']." 301 Moved Permanently", true, 301);
		header("Location: /");
	}

?>