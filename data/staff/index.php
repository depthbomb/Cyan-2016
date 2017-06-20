<?php

	header("content-type: application/json");

	$json = array(
		"staff"=>array(
			"depthbomb"=>array(
				"steam_id"=>"76561198026398801",
				"avatar"=>"http://beta9.cyan.tf/assets/img/staff-images/depthbomb.jpg",
				"roles"=>"Server Owner"
			)
		)
	);

	echo json_encode($json, JSON_PRETTY_PRINT);

?>