<?php

class Template{

	private $data = null;
	private $config = null;

	private $html = null;
	private $smarty = null;

	public function __construct($config, $data){

		$this->data = $data;
		$this->config = $config;

		$this->smarty = $this->initSmarty();

		// Parsing data to template
		$this->parse();
	}

	/* Initializing Smarty template system
	 * @return object smarty instance
	 */
	private function initSmarty(){
		$smarty = new Smarty();
		$smarty->debugging = $this->config["smarty"]["debugging"];
		$smarty->caching = $this->config["smarty"]["caching"];
		$smarty->cache_lifetime = $this->config["smarty"]["cache_lifetime"];
		return $smarty;
	}

	/* Parsing data to template
	 * @return string html
	 */
	private function parse(){
		foreach($this->data as $module => $module_data){
			$html = "";
			foreach($module_data as $plugin => $plugin_data){
				$smarty_plugin = $this->initSmarty();
				# Nutno zde upravit správné načítání celé cesty aby to bylo dynamické - zatím test
				$smarty_plugin->setTemplateDir($this->config["root"].'/system/php/plugins/'.$plugin.'/0.1.0/front/templates');
				$smarty_plugin->assign("data",$plugin_data);
				$html.= $smarty_plugin->fetch("default.tpl");
			}
			$this->smarty->assign($module,$html);
		} 
		
		$this->html = $this->smarty->fetch("default.tpl");
	}

	public function getHtml(){
		return $this->html;
	}

}

?>