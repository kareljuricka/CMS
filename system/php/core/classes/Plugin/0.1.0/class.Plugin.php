<?php

class Plugin{
	
	private $config = null;
	private $registry = null;

	private $plugin = "";
	private $plugin_data = null;

	public function __construct($plugin){
		
		// Bind registry and config
		$this->registry = Registry::getRegistry();
		$this->config = $this->registry->get("config");
		
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