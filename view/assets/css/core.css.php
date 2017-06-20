<?php

	header('Content-type:text/css');
	ob_start("compress");
	function compress($buffer)
	{
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		$buffer = str_replace("%URL%", "https://cyan.tf", $buffer);
		return $buffer;
	}

	ob_end_flush();

?>
