<?php

class Front{

	private $modules = array();
	private $modules_data = array();
	
	public function __construct(){

		# Dočasně ruční zadání modulů, po návrhu databáze jejich načtení z databáze
		$this->modules = array("content");

		// Auto-initializing modules
		$this->initModules();

	}

	/** Initialization modules
	 *
	 */
	private function initModules(){
		foreach($this->modules as $module){
			$class_module = new Module($module);
			$this->modules_data[$module] = $class_module->getData();
		}
	}

	/** Get data  
	 *
	 */
	public function getData(){
		return $this->modules_data;
	}
	
}

?>