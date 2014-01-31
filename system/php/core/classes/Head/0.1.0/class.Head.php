<?php

class Head{


	private $head_data = array();

	
	public function __construct(){

		$this->head_data['meta']['author'] = 'Lukas Hajek & Karel Juricka';
		$this->head_data['meta']['description'] = "Popis webu";
		$this->head_data['title'] = 'SmartCMS';

	}

	public function getData(){
		return $this->head_data;
	}

}

?>