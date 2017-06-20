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
	include('vendor/bootstrap.min.css');
	include('vendor/font-awesome.min.css');
	include('vendor/bootstrap-select.min.css');
	include('vendor/bootstrap-checkbox.css');
	include('vendor/bootstrap-switch.min.css');
	include('vendor/summernote.css');
	include('components/font.css');
	include('components/animation.css');
	include('components/styles.css');
	include('components/modals.css');
	include('components/sidebar.css');
	include('components/format.css');
	include('components/responsive.css');
	ob_end_flush();

?>
