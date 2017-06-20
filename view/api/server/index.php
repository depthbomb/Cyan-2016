<?php

	error_reporting(-1);

	header("Content-type: application/json; charset=utf-8");

	// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	// {
		require("../../../vendor/autoload.php");

		$gq = new GameQ();
		$gq->addServer(array('id' => 'cyan','type' => 'tf2','host' => '66.150.188.17:27015'));

		$results = $gq->requestData();

		if(isset($_GET["info"]))
		{
			if($results["cyan"]["gq_online"])
			{
				$json = array(
					"online"=>true,
					"current_players"=>$results["cyan"]["num_players"],
					"bots"=>$results["cyan"]["num_bots"],
					"map"=>$results["cyan"]["map"]
				);
			}
			else
			{
				$json = array(
					"online"=>false
				);
			}
		}
		elseif(isset($_GET["players"]))
		{
			if($results["cyan"]["gq_online"])
			{
				$json = $results["cyan"]["players"];
			}
			else
			{
				$json = array(
					"online"=>false
				);
			}
		}

		echo json_encode($json,JSON_PARTIAL_OUTPUT_ON_ERROR);
	// }
	// else
	// {
	// 	echo json_encode(array("error"=>"This is not a public API."));
	// }

?>