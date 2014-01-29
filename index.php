<?php
	// Configuration
	require("config.php");

	// Loader
	require("system/php/core/classes/class.Loader.php");
	$loader = new Loader(ROOT);

	// Database connect
	dibi::connect($db_config);

	// Front init 
	$front = new Front();
	$data = $front->getData();

	// Front output
	$template = new Template($data);
	$html = $template->load();

	echo $html;

?>