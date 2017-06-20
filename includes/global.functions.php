<?php

	function dirToArray($dir)
	{
		$result = array();
		$cdir = scandir($dir);
		foreach ($cdir as $key => $value)
		{
			if(!in_array($value,array(".","..")))
			{
				if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
				{
					$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
				}
				else
				{
					$result[] = $value;
				}
			}
		}
		return $result;
	}

	function in_array_r($needle, $haystack, $strict = false)
	{
		foreach($haystack as $item)
		{
			if(($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict)))
			{
				return true;
			}
		}
		return false;
	}

	function human_date($timestamp)
	{
		return date("M jS, Y G:ia",$timestamp);
	}

	function admin_meta($target, $info)
	{
		if(isset($info) AND isset($target))
		{
			$data = json_decode(file_get_contents("../data/staff/staff.json"),true);
			if($info === "personaname")
			{
				return $data["staff"][$target]["personaname"];
			}
			elseif($info === "steamid")
			{
				return $data["staff"][$target]["steamid"];
			}
			elseif($info === "avatar")
			{
				return $data["staff"][$target]["avatar"];
			}
		}
		else
		{
			return false;
		}
	}

	function cyan_mailer($to, $subject, $message)
	{
		$mailer_ver = "1.0.0beta";

		$mail_to = $to;

		$mail_from = "email@website.com";

		$mail_headers = 'From: Cyan.TF Administration <'.$mail_from.'>' . "\r\n";
		$mail_headers .= 'X-Mailer: PHP/' . phpversion();
		$mail_headers .= 'Reply-To: '.$mail_from . "\r\n";
		$mail_headers .= 'Return-Path: ' . $mail_from . "\r\n";
		$mail_headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\r\n";
		$mail_headers .= "CC: ". $mail_from . "\r\n";
		$mail_headers .= "BCC: " . $mail_from . "\r\n";
		$mail_headers .= "MIME-Version: 1.0\r\n";
		$mail_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail_headers .= "Date: " . date('r', time()) . "\n";

		$mail_subject = $subject;

		$mail_message = "<!-- Cyan.TF Mailer v$mailer_ver by depthbomb | http://steamcommunity.com/id/minorin | http://cyan.tf -->";
		$mail_message .= $message;
		$mail_message .= "<p>Have a nice day!</p><small><a href='"._re('mailto:email@website.com')."'>Somebody using your email? Click here to unsubscribe.</a></small>";

		mail($mail_to,$mail_subject,$mail_message,$mail_headers);
	}

	function get_real_ip()
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

	function minify_html($tpl_output, Smarty_Internal_Template $template)
	{
		$tpl_output = preg_replace('![\t ]*[\r\n]+[\t ]*!', '', $tpl_output);
		return $tpl_output;
	}

	function _re($url)
	{
		if(isset($url))
		{
			$query = urlencode(base64_encode($url));
			return "http://cyan.tf/redirect/$query";
		}
		else
		{
			return "http://cyan.tf/";
		}
	}

	function _ex($url)
	{
		if(isset($url))
		{
			$query = urlencode(base64_encode($url));
			return "http://cyan.tf/external/$query";
		}
		else
		{
			return "http://cyan.tf/";
		}
	}

	function embed_img($url)
	{
		$type = pathinfo($url, PATHINFO_EXTENSION);
		$data = file_get_contents($url);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		return $base64;
	}

	function bust($asset,$always_bust)
	{
		if($always_bust == false)
		{
			return $asset."?".md5(@filemtime($_SERVER["DOCUMENT_ROOT"].$asset));
		}
		else
		{
			return $asset."?".md5(rand(rand(),rand()));
		}
	}

	function timeago($ptime)
	{
		$estimate_time = time() - $ptime;
		if($estimate_time < 1)
		{
			return 'Just Now';
		}
		$condition = array( 
			12 * 30 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60       =>  'month',
			24 * 60 * 60            =>  'day',
			60 * 60                 =>  'hour',
			60                      =>  'minute',
			1                       =>  'second'
		);
		foreach($condition as $secs => $str)
		{
			$d = $estimate_time / $secs;
			if($d >= 1)
			{
				$r = round($d);
				return ' ' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
			}
		}
	}

	function timeto($ptime)
	{
		$estimate_time = $ptime - time();
		if($estimate_time < 1)
		{
			return 'Just Now';
		}
		$condition = array( 
			12 * 30 * 24 * 60 * 60  =>  'year',
			30 * 24 * 60 * 60       =>  'month',
			24 * 60 * 60            =>  'day',
			60 * 60                 =>  'hour',
			60                      =>  'minute',
			1                       =>  'second'
		);
		foreach($condition as $secs => $str)
		{
			$d = $estimate_time / $secs;
			if($d >= 1)
			{
				$r = round($d);
				return ' ' . $r . ' ' . $str . ($r > 1 ? 's' : '');
			}
		}
	}

	function denc($string, $key, $crypt)
	{
		if($crypt == "en")
		{
			$string = serialize($string);
			$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
			@$key = pack('H*', $key);
			$mac = hash_hmac('sha256', $string, substr(bin2hex($key), -32));
			$passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string.$mac, MCRYPT_MODE_CBC, $iv);
			$encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
			return $encoded;
		}
		elseif($crypt == "de")
		{
			$string = explode('|', $string.'|');
			$decoded = base64_decode($string[0]);
			$iv = base64_decode($string[1]);
			if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
			@$key = pack('H*', $key);
			$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
			$mac = substr($decrypted, -64);
			$decrypted = substr($decrypted, 0, -64);
			$calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
			if($calcmac!==$mac){ return false; }
			$decrypted = unserialize($decrypted);
			return $decrypted;
		}
	}

?>