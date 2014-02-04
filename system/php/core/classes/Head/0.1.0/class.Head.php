<?php

class Head{

	private $config = null;
	private $registry = null;

	private $head_data = array();

	
	public function __construct(){
		
		// Bind registry and config
		$this->registry = Registry::getRegistry();
		$this->config = $this->registry->get("config");

		$this->head_data['meta']['author'] = 'Lukas Hajek & Karel Juricka';
		$this->head_data['meta']['description'] = "Popis webu";
		$this->head_data['title'] = 'SmartCMS';

	}

	public function getData(){
		return $this->head_data;
	}

}

?>