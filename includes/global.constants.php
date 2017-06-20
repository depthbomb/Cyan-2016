<?php

	date_default_timezone_set('America/Chicago');
	define("URL","https://".$_SERVER['SERVER_NAME']);
	define("CURL",URL.$_SERVER['REQUEST_URI']);
	define("ROOT",str_replace("/view", "", $_SERVER["DOCUMENT_ROOT"]));
	define("USER_AGENT",$_SERVER['HTTP_USER_AGENT']);
	function getUserIP()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}
		return $ip;
	}
	define("VISITOR_IP",getUserIP());
	define("DATE24",date("l, F j, Y @ G:i:s"));
	define("DATE12",date("l, F j, Y @ g:i:sA"));
	define("TIME24",date("G:i:s"));
	define("TIME12",date("g:i:sA"));
