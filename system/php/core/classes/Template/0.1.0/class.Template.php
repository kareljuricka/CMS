<?php

class Template{

	private $data = null;
	private $root = "";

	private $smarty = null;
	
	public function __construct($root,$data){

		$this->data = $data;
		$this->root = $root;

		$this->initSmarty();

	}

	/* Initializing Smarty template system
	 *
	 */
	private function initSmarty(){
		$this->smarty = new Smarty();
		# Následující nastavení určitě třeba načítat z databáze
		$this->smarty->debugging = false;
		$this->smarty->caching = false;
		$this->smarty->cache_lifetime = 0;
	}

	/* Parsing data to template
	 * @return string html
	 */
	public function load(){
		foreach($this->data as $module => $module_data){
			$html = "";
			foreach($module_data as $plugin => $plugin_data){
				$smarty = new Smarty();
				$smarty->debugging = false;
				$smarty->caching = false;
				$smarty->cache_lifetime = 0;

				# Nutno zde upravit správné načítání celé cesty aby to bylo dynamické - zatím test
				$smarty->setTemplateDir($this->root.'/system/php/plugins/'.$plugin.'/0.1.0/front/templates');

				$smarty->assign("data",$plugin_data);
				$html.= $smarty->fetch("default.tpl");
			}
			$this->smarty->assign($module,$html);
		} 
		
		return $this->smarty->fetch("default.tpl");
	}

}

?>