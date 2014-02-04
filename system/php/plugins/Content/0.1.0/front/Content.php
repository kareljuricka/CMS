<?php

class Content{
	
	private $version = "0.1.0";

	public function __construct(){

	}

	/**
	 *
	 */
	public function getData(){
		# V rámci testu vracíme test data
		$data = "Lorem ipsum dolor <br />site amet!";
		
		$return = array("version" => $this->version, "data" => $data);		
		return $return;
	}
		
}

?>