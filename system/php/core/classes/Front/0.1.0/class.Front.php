<?php

class Front{
	
	private $config = null;
	private $registry = null;

	private $modules = array();
	private $modules_data = array();
	private $head_data = array();
	
	public function __construct(){
		
		// Bind registry and config
		$this->registry = Registry::getRegistry();
		$this->config = $this->registry->get("config");

		# Dočasně ruční zadání modulů, po návrhu databáze jejich načtení z databáze
		$this->modules = array("content");

		// Auto-initializing modules
		$this->initModules();

		// Auto-initializing head
		$this->initHead();

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

	/** Iitialization head
	 *
	 */
	private function initHead(){
			$head = new Head();
			$this->head_data = $head->getData();
	}

	/** Get modules data  
	 *
	 */
	public function getModulesData(){
		return $this->modules_data;
	}

	/** Get head data  
	 *
	 */
	public function getHeadData(){
		return $this->head_data;
	}
	
}

?>