<?php
	include "config.php";

	require("system/php/core/classes/class.Loader.php");
	$loader = new Loader(ROOT);

	dibi::connect($db_config);

	$front = new Front();


?>