<?php

	define('EKEY', 'ENCRYPTION KEY');
	define('SITE_DESCRIPTION', 'The official website for the Cyan.TF Team Fortress 2 server. Join us today @ 66.150.188.17:27015');
	define('SITE_TITLE', 'Cyan.TF :: '.SITE_DESCRIPTION);
	define('ALLOWED_HTML_TAGS','<a><b><u><s><del><i><em><img><span><p><br><hr><ul><ol><li>');

	$banned_users = array(

	);

	$staff = array(
		"staff"=>array(
			"CyanBot!"=>array(
				"steamid"=>"0",
				"override_button"=>"http://cyan.tf",
				"avatar"=>"/assets/img/cyan_system_avatar.jpg",
				"role"=>array("Automaton","Site notifications"),
				"show_on_site"=>false
			),

			"depthbomb"=>array(
				"steamid"=>"76561198026398801",
				"avatar"=>"/assets/img/staff-images/depthbomb.png",
				"role"=>array("Server Owner","Website Creator"),
				"show_on_site"=>true
			),

			"Sarah Bear"=>array(
				"steamid"=>"76561198073971730",
				"avatar"=>"/assets/img/staff-images/sarah-bear.jpg",
				"role"=>array("Admin"),
				"show_on_site"=>true
			)
		)
	);

?>