<?php

class Front{

	private $modules = array();
	private $modules_data = array();
	
	public function __construct(){

		# Dočasně ruční zadání modulů, po návrhu databáze jejich načtení z databáze
		$this->modules = array("head","content");

		// Auto-initializing modules
		$this->initModules();

	}

	/** Initialization modules
	 *
	 */
	private function initModules(){
		foreach($this->modules as $module){
			$class_module = new Module();
			$this->modules_data[] = $class_module->getData();
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