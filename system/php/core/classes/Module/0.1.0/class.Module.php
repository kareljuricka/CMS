<?php

class Module{
	
	private $config = null;
	private $registry = null;

	private $module = "";
	private $plugins = array();
	private $plugins_data = array();

	public function __construct($module){
		
		// Bind registry and config
		$this->registry = Registry::getRegistry();
		$this->config = $this->registry->get("config");

		$this->module = $module;

		# Dočasně ruční zadání pluginů, po návrhu databáze jejich načtení z databáze
		$this->plugins = array("Content");
			
		// Auto-initializing plugins
		$this->initPlugins();		

	}

	/** Initialization plugins
	 *
	 */
	private function initPlugins(){
		foreach($this->plugins as $plugin){
			$class_plugin = new Plugin($plugin);
			$this->plugins_data[$plugin] = $class_plugin->getData();
		}
	}	

	/**
	 *
	 */
	public function getData(){

		return $this->plugins_data;
	}

}

?>