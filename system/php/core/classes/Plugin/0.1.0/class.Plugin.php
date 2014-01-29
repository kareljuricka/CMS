<?php

class Plugin{

	private $plugin = "";
	private $plugin_data = null;

	public function __construct($plugin){
		$this->plugin = $plugin;
		$this->initPlugin();		
	}

	private function initPlugin(){
		$plugin = new $this->plugin;
		$this->plugin_data = $plugin->getData();
	}

	/**
	 *
	 */
	public function getData(){
		return $this->plugin_data;
	}

}

?>