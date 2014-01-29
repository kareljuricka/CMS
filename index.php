<?php
	// Configuration
	require("config.php");

	// Loader
	require("system/php/core/classes/class.Loader.php");
	$loader = new Loader($root);

	// Database connect
	//dibi::connect($db_config);

	# Následující věci přebere controller - viz Evernote nápdy

	// Front init 
	$front = new Front();
	$data = $front->getData();

	// Front output
	$template = new Template($root,$data);
	$html = $template->load();

	echo $html;

?>