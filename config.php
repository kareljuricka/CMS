<?php	
	$config = array();

	$config["db_config"] = array(
		"host" => "localhost",
		"database" => "cms",
		"username" => "cms",
		"password" => "h78uhj6"
	);	

	$config["admin_url"] = "admin";

	$config["smarty"]["caching"] = false;
	$config["smarty"]["debugging"] = false;
	$config["smarty"]["cache_lifetime"] = 0;

	$config["root"] = dirname(__FILE__);	
?>