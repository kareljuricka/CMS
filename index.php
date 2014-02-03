<?php
	// Configuration
	require("config.php");

	// Loader
	require("system/php/core/classes/class.Loader.php");
	$loader = new Loader($config);
	
	// Error handler
	$error = new Error($config["root"]);
	set_error_handler(array($error,"catchError"));

	// Getting url and parameters
	$url = $_GET["url"];
	unset($_GET["url"]);

	// Controller start
	$controller = new Controller($config, $url);
	echo $controller->getHtml();		
?>