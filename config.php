<?php

	$config = array();

	$db_config = array(
		"host" => "localhost",
		"database" => "cms",
		"username" => "cms",
		"password" => "h78uhj6"
	);	

	$config["db_config"] = $db_config;

	$config["admin_url"] = "admin";

	$config["smarty"]["caching"] = false;
	$config["smarty"]["debugging"] = false;
	$config["smarty"]["cache_lifetime"] = 0;

	$config["root"] = dirname(__FILE__);

?>