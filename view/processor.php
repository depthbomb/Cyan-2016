<?php

	require_once("../includes/initializer.php");
	if($_POST)
	{
		if(isset($_GET["action"]))
		{
			$action = $_GET["action"];
			if($action === "ticket.create")
			{
				$tickets_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "TICKETS DATABASE");

				$ticket_hash = substr(md5(mt_rand()), mt_rand(1,7),5);
				$ticket_steamid = $_SESSION["steamid"];
				$ticket_username = $tickets_db->real_escape_string(htmlspecialchars($_SESSION["personaname"]));
				$ticket_sUsername = $tickets_db->real_escape_string(htmlspecialchars($_POST["username"]));
				$ticket_ip = denc(get_real_ip(),"EKEY","en");
				$ticket_content = $tickets_db->real_escape_string(strip_tags($_POST["content"], ALLOWED_HTML_TAGS));
				$ticket_date = time();

				if($_POST["section"] == 1){$ticket_section = "General Support";}
				elseif($_POST["section"] == 2){$ticket_section = "Report a Player";}
				elseif($_POST["section"] == 3){$ticket_section = "Punishment Appeal";}
				elseif($_POST["section"] == 4){$ticket_section = "Admin Application";}
				elseif($_POST["section"] == 5){$ticket_section = "Website Bugs";}
				else
				{
					$smarty->assign("error_description","Invalid section.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
					die();
				}

				$create_query = "INSERT INTO `entries`
					(`ip`,`ticket_id`,`post_date`,`steamid`,`username`,`post_section`,`post_content`,`closed`)
					VALUES
					('$ticket_ip','$ticket_hash','$ticket_date','$ticket_steamid','$ticket_username','$ticket_section','$ticket_content',false)";

				if($tickets_db->query($create_query))
				{
					cyan_mailer("EMAIL", "A user has submitted a ticket.", "You can view their ticket at: http://cyan.tf/ticket/view/$ticket_hash");
					send_notif($ticket_steamid,"Your ticket was successfully submitted!","<p>Hello, <b>".get_user_meta($ticket_steamid,'personaname')."</b>! Your ticket was successfully created and an admin has been notified of it.</p><p>You can view your ticket <a href=\"http://cyan.tf/ticket/view/$ticket_hash\">here.</a></p>",0);
					header("Location: /ticket/view/$ticket_hash/submitted");
				}
				else
				{
					die($tickets_db->error);
				}
			}
			elseif($action === "user.ticket.reply")
			{
				$tickets_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "TICKETS DATABASE");

				$ticket_id = $_POST["ticket_id"];
				$ticket_response = $_POST["user-reply"];
				$ticket_response_time = time();

				$reply_query = "INSERT INTO `admin_replies`
					(`reply_to`,`reply_date`,`reply_content`,`admin_steamid`)
					VALUES
					('$ticket_id','$ticket_response_time','$ticket_response','".$_SESSION["steamid"]."')";

				$info_r = $tickets_db->query("SELECT * FROM `entries` WHERE `ticket_id`='$ticket_id'");

				if($tickets_db->query($reply_query))
				{
					header("Location: /ticket/view/$ticket_id");
				}
				else
				{
					$smarty->assign("error_description","Could not perform this action: <b>" . $tickets_db->error . "</b>.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "inbox.mark.seen")
			{
				if(isset($_POST["message_id"]))
				{
					$seen_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "INBOX DATABASE");
					$message_id = $_POST["message_id"];

					$seen_q = "UPDATE `inboxes` SET `seen`=true WHERE `message_hash`='$message_id'";

					if($seen_con->query($seen_q))
					{
						header("Location: /inbox");
					}
					else
					{
						$smarty->assign("error_description","Could not perform this action: <b>" . $seen_con->error . "</b>.");
						$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
					}
				}
				else
				{
					$smarty->assign("error_description","Invalid parameters.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "terms.accept")
			{
				if(isset($_POST["steamid"]))
				{
					$steamid = denc($_POST["steamid"],EKEY,"de");
					if($steamid === $_SESSION["steamid"])
					{
						$ta_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "CACHE DATABASE");
						$ta_q = "UPDATE `user_info` SET `accepted_terms`=true WHERE `steamid`='$steamid'";

						if($ta_db->query($ta_q))
						{
							$smarty->assign("status_type","success");
							$smarty->assign("status_title","Thank you!");
							$smarty->assign("status_description","Thank you for accepting our terms and guidelines. You will not see the alert on the site again unless the terms are updated. Click the button below to return to the homepage.");
							$smarty->display(ROOT."/templates/deploy/status.page.tpl");
						}
						else
						{
							$smarty->assign("error_description","Some sort of weird DB error. Please contact the site administrator.");
							$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
						}
					}
					else
					{
						$smarty->assign("error_description","Non-matching parameters.");
						$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
					}
				}
				else
				{
					$smarty->assign("error_description","Invalid parameters.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "admin.ticket.lock")
			{
				$ticket_id = $_POST["ticket_id"];

				$tickets_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "TICKETS DATABASE");
				$lock_query = "UPDATE `entries` SET `closed`=true WHERE `ticket_id`='$ticket_id'";

				if($tickets_db->query($lock_query))
				{
					header("Location: /ticket/view/$ticket_id");
				}
				else
				{
					$smarty->assign("error_description","Could not perform this action: <b>" . $tickets_db->error . "</b>.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "admin.ticket.open")
			{
				$ticket_id = $_POST["ticket_id"];

				$tickets_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "TICKETS DATABASE");
				$lock_query = "UPDATE `entries` SET `closed`=false WHERE `ticket_id`='$ticket_id'";

				if($tickets_db->query($lock_query))
				{
					header("Location: /ticket/view/$ticket_id");
				}
				else
				{
					$smarty->assign("error_description","Could not perform this action: <b>" . $tickets_db->error . "</b>.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "admin.ticket.reply")
			{
				$tickets_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "TICKETS DATABASE");

				$ticket_id = $_POST["ticket_id"];
				$ticket_response = $_POST["admin-reply"];
				$ticket_response_time = time();

				$reply_query = "INSERT INTO `admin_replies`
					(`reply_to`,`reply_date`,`reply_content`,`admin_steamid`)
					VALUES
					('$ticket_id','$ticket_response_time','$ticket_response','".$_SESSION["steamid"]."')";

				$info_r = $tickets_db->query("SELECT * FROM `entries` WHERE `ticket_id`='$ticket_id'");

				if($tickets_db->query($reply_query))
				{
					while($ti = $info_r->fetch_assoc())
					{
						send_notif($ti["steamid"],"An admin has replied to your ticket.","<p>Hello, ".$ti["username"]."! An admin has replied to your ticket ID: <b>$ticket_id</b></p><p>You can view their response <a href=\"http://cyan.tf/ticket/view/$ticket_id\">here.</a></p>",0);
					}
					header("Location: /ticket/view/$ticket_id");
				}
				else
				{
					$smarty->assign("error_description","Could not perform this action: <b>" . $tickets_db->error . "</b>.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "admin.add.post")
			{
				$post_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "POSTS DATABASE");

				$post_num = mysqli_num_rows($post_db->query("SELECT * FROM `posts`"));

				$post_id = ($post_num + 1);
				$post_hash = md5($_POST["post_title"]+time()+mt_rand());
				$post_date = time();
				$post_title = $post_db->real_escape_string(strip_tags($_POST["post_title"]));
				$post_content = $post_db->real_escape_string($_POST["post_content"]);
				$add_query = "INSERT INTO `posts`
					(`id`,`post_hash`,`post_date`,`title`,`content`,`poster`,`admin_only`,`login_only`)
					VALUES
					('$post_id','$post_hash','$post_date','$post_title','$post_content','".$_SESSION["steamid"]."',false,false)";
				if($post_db->query($add_query))
				{
					header("Location: /post/$post_id");
				}
				else
				{
					$smarty->assign("error_description","Could not perform this action: <b>" . $post_db->error . "</b>.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "admin.add.kb")
			{
				$kb_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "KNOWLEDGE BASE DATABASE");

				$kb_num = mysqli_num_rows($kb_db->query("SELECT * FROM `articles`"));

				$kb_title = $kb_db->real_escape_string(strip_tags($_POST["kb_title"]));
				$kb_content = $kb_db->real_escape_string($_POST["kb_content"]);
				$add_query = "INSERT INTO `articles`
					(`id`,`title`,`content`,`hidden`)
					VALUES
					('".($kb_num + 1)."','$kb_title','$kb_content','false')";
				if($kb_db->query($add_query))
				{
					header("Location: /help/kb/".($kb_num + 1));
				}
				else
				{
					$smarty->assign("error_description","Could not perform this action: <b>" . $kb_db->error . "</b>.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			elseif($action === "admin.edit.kb")
			{
				$kb_db = new mysqli(DB_HOST, DB_USER, DB_PASS, "KNOWLEDGE BASE DATABASE");

				$kb_id = $_POST["kb_id"];
				$kb_title = strip_tags($_POST["kb_title"]);
				$kb_content = $kb_db->real_escape_string($_POST["kb_content"]);
				$edit_query = "UPDATE `articles` SET `title`='$kb_title', `content`='$kb_content', `hidden`='false' WHERE `id`='$kb_id'";
				if($kb_db->query($edit_query))
				{
					header("Location: /help/kb/$kb_id");
				}
				else
				{
					$smarty->assign("error_description","Could not perform this action: <b>" . $kb_db->error . "</b>.");
					$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
				}
			}
			else
			{
				$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
			}
		}
		else
		{
			$smarty->display(ROOT."/templates/deploy/errors/application.error.tpl");
		}
	}
	else
	{
		if($_GET["action"] === "admin.tickets.table")
		{
			$t_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "TICKETS DATABASE");
			if($t_con->connect_error)
			{
				die($t_con->connect_error);
			}
			else
			{
				$t_con->query("
					CREATE TABLE `entries`
					(
						`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`ticket_id` TEXT NOT NULL,
						`ip` VARCHAR(173),
						`post_date` INT NOT NULL,
						`email` TEXT NOT NULL,
						`steamid` VARCHAR(255) NOT NULL,
						`username` VARCHAR(255) NOT NULL,
						`post_section` TEXT NOT NULL,
						`post_content` TEXT NOT NULL,
						`closed` TINYINT(1),
						PRIMARY KEY (`id`)
					)
					ENGINE=MyISAM
					DEFAULT CHARACTER SET = utf8
				") or die($t_con->error);

				$t_con->query("
					CREATE TABLE `admin_replies`
					(
						`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`reply_to` TEXT NOT NULL,
						`reply_date` INT NOT NULL,
						`reply_content` TEXT NOT NULL,
						`admin_steamid` VARCHAR(255) NOT NULL,
						PRIMARY KEY (`id`)
					)
					ENGINE=MyISAM
					DEFAULT CHARACTER SET = utf8
				") or die($t_con->error);

				$t_con->close();	
			}
			echo "generated";
		}
		elseif($_GET["action"] === "admin.usercache.table")
		{
			$c_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "CACHE DATABASE");
			if($c_con->connect_error)
			{
				die($c_con->connect_error);
			}
			else
			{
				$c_con->query("
					ALTER TABLE `user_info`
					ADD `hide_ads` TINYINT(1) DEFAULT 0 AFTER `accepted_terms`,
					ADD `ip` VARCHAR(173) DEFAULT 0 AFTER `hide_ads`
				") or die($c_con->error);
				$c_con->close();	
			}
			echo "generated";
		}
		elseif($_GET["action"] === "admin.inbox.table")
		{
			$c_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "INBOX DATABASE");
			if($c_con->connect_error)
			{
				die($c_con->connect_error);
			}
			else
			{
				$c_con->query("
					CREATE TABLE `inboxes`
					(
						`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`message_hash` VARCHAR(32) NOT NULL,
						`send_date` INT NOT NULL,
						`to` TEXT NOT NULL,
						`subject` TEXT NOT NULL,
						`body` TEXT NOT NULL,
						`seen` TINYINT(1) NOT NULL,
						`from` TEXT NOT NULL,
						PRIMARY KEY (`id`)
					)
					ENGINE=MyISAM
					DEFAULT CHARACTER SET = utf8
				") or die($c_con->error);
				$c_con->close();	
			}
			echo "generated";
		}
		elseif($_GET["action"] === "admin.post.table")
		{
			$post_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "POSTS DATABASE");
			if($post_con->connect_error)
			{
				die($post_con->connect_error);
			}
			else
			{
				$post_con->query("
					CREATE TABLE `posts`
					(
						`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`post_hash` VARCHAR(32) NOT NULL,
						`post_date` INT NOT NULL,
						`title` TEXT NOT NULL,
						`content` TEXT NOT NULL,
						`poster` TEXT NOT NULL,
						`admin_only` TINYINT(1) NOT NULL,
						`login_only` TINYINT(1) NOT NULL,
						PRIMARY KEY (`id`)
					)
					ENGINE=MyISAM
					DEFAULT CHARACTER SET = utf8
				") or die($post_con->error);
				$post_con->query("
					CREATE TABLE `replies`
					(
						`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`reply_to` VARCHAR(32) NOT NULL,
						`reply_hash` VARCHAR(32) NOT NULL,
						`reply_date` INT NOT NULL,
						`content` TEXT NOT NULL,
						`poster` TEXT NOT NULL,
						PRIMARY KEY (`id`)
					)
					ENGINE=MyISAM
					DEFAULT CHARACTER SET = utf8
				") or die($post_con->error);
				$post_con->close();	
			}
			echo "generated";
		}
		elseif($_GET["action"] === "admin.giveaways.table")
		{
			$c_con = new mysqli(DB_HOST, DB_USER, DB_PASS, "GIVEAWAYS DATABASE");
			if($c_con->connect_error)
			{
				die($c_con->connect_error);
			}
			else
			{
				$c_con->query("
					CREATE TABLE `giveaway`
					(
						`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`hash` VARCHAR(32) NOT NULL,
						`max_rank` INT NOT NULL,
						`created` INT NOT NULL,
						`ends` INT NOT NULL,
						`by` TEXT NOT NULL,
						`winner` TEXT NOT NULL,
						`subject` TEXT NOT NULL,
						`prize` TEXT NOT NULL,
						`completed` TINYINT(1) NOT NULL,
						`hidden` TINYINT(1) NOT NULL,
						PRIMARY KEY (`id`)
					)
					ENGINE=MyISAM
					DEFAULT CHARACTER SET = utf8
				") or die($c_con->error);
				$c_con->query("
					CREATE TABLE `entries`
					(
						`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
						`giveaway_hash` VARCHAR(32) NOT NULL,
						`entry_date` INT NOT NULL,
						`entrant` TEXT NOT NULL,
						PRIMARY KEY (`id`)
					)
					ENGINE=MyISAM
					DEFAULT CHARACTER SET = utf8
				") or die($c_con->error);
				$c_con->close();	
			}
			echo "generated";
		}
		else
		{
			header("Location: /");
		}
	}

?>
