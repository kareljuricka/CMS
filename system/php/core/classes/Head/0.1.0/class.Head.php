<?php

class Head{


	private $head_module = array();

	
	public function __construct(){

		$this->head_module['author'] = 'Lukas Hajek & Karel Juricka';
		$this->head_module['title'] = 'SmartCMS';
		$this->head_module['description'] = "Popis webu";

	}

	public function getData(){

		return $this->head_module;
	}

}

?>