<?php
	
	header("Content-type: application/javascript; charset=utf-8");
	require("../../../vendor/autoload.php");

	use MatthiasMullie\Minify;

	$minifier = new Minify\JS;

	$minifier->add("_core.js");

	echo $minifier->minify();

?>