<?php

	if(isset($_SESSION["steamid"]))
	{
		$unread_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "INBOX DATABASE");
		if($unread_res = $unread_con->query("SELECT * FROM `inboxes` WHERE `to`='".$_SESSION["steamid"]."' && `seen`='false'"))
		{
			define("NUM_UNREAD",$unread_res->num_rows);
		}

		function send_notif($to,$subject,$body,$from)
		{
			$inbox_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "INBOX DATABASE");
			
			if($from == 0)
			{
				$footer = '<p><small class="text-muted">This message was sent automatically by the system. Please do not reply to it as it will not respond.</small></p>';
			}
			else
			{
				$footer = null;
			}

			$send_query = "INSERT INTO `inboxes`
			(`message_hash`, `send_date`, `to`, `subject`, `body`, `seen`, `from`)
			VALUES
			('".md5(time()+mt_rand())."', '".time()."', '$to', '$subject', '".$body.$footer."', false, '$from')";

			if($inbox_con->query($send_query))
			{
				echo "Success";
			}
			else
			{
				echo $inbox_con->error();
			}
		}
	}

?>