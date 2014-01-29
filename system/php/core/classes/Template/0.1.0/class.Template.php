<?php

class Template{

	private $smarty = null;
	
	public function __construct(){

		$this->initSmarty();

	}

	/* Initializing Smarty template system
	 *
	 */
	private function initSmarty(){
		$this->smarty = new Smarty;
		# Následující nastavení určitě třeba načítat z databáze
		$this->smarty->debugging = false;
		$this->smarty->caching = false;
		$this->smarty->cache_lifetime = 0;
	}

	/* Parsing data to template
	 * @return string html
	 */
	public function load(){
		return $this->smarty->fetch("default.tpl");
	}

}

?>