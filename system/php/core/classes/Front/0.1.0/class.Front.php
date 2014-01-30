<?php

class Front{

	private $modules = array();
	private $modules_data = array();
	
	public function __construct(){

		# Dočasně ruční zadání modulů, po návrhu databáze jejich načtení z databáze
		$this->modules = array("content", "Head");

		// Auto-initializing modules
		$this->initModules();

	}

	/** Initialization modules
	 *
	 */
	private function initModules(){
		foreach($this->modules as $module){
			$class_module = new Module($module);

			// Modul Head consists of submoduls
			if ($class_module->isHead()) {
				$head_module = $class_module->getData();
				// Iterate through submodules, set plugin name headPlugin 
				//-- kvuli zpusobu zpracovani templatu je nutny nazev pluginu
				foreach($head_module as $submodule_name => $submodul_value) {		
					$this->modules_data[$submodule_name][$module] = $submodul_value;
				}
			}
			// Standart simple modul
			else
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