<?php

class Template{

	private $data = null;
	private $config = null;

	private $html = null;
	private $smarty = null;

	public function __construct($data){

		$this->data = $data;
		
		// Bind config
		$registry = Registry::getRegistry();
		$this->config = $registry->get("config");

		$this->smarty = $this->initSmarty();

		// Parsing data to template
		$this->parse();
	}

	/** Initializing Smarty template system
	 * @return object smarty instance
	 */
	private function initSmarty(){
		$smarty = new Smarty();
		$smarty->debugging = $this->config["smarty"]["debugging"];
		$smarty->caching = $this->config["smarty"]["caching"];
		$smarty->cache_lifetime = $this->config["smarty"]["cache_lifetime"];
		return $smarty;
	}

	/** Parsing data to template
	 *
	 */
	private function parse(){
			
		$this->assignModules();
		$this->assignHead();	

		$this->html = $this->smarty->fetch("default.tpl");
	}
	
	/** Assign header data to smarty 
	 * 
	 */
	private function assignHead(){
		$this->smarty->assign("head", $this->data["head_data"]);
	}
	
	/** Parse and assign modules to smarty 
	 * 
	 */
	private function assignModules(){
		// Parsing and assign modules
		foreach($this->data["modules_data"] as $module => $module_data){
			$html = "";
			foreach($module_data as $plugin => $plugin_data){				
				$version = $plugin_data["version"];
				$data = $plugin_data["data"];				
				$smarty_plugin = $this->initSmarty();
				$smarty_plugin->setTemplateDir($this->config["root"].'/system/php/plugins/'.$plugin.'/'.$version.'/front/templates');
				$smarty_plugin->assign("data", $data);
				$html.= $smarty_plugin->fetch("default.tpl");
			}
			$this->smarty->assign($module,$html);
		}
	}

	public function getHtml(){
		return $this->html;
	}

}

?>