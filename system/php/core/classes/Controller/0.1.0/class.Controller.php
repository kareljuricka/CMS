<?php

class Controller{
	
	private $registry = null;
	private $config = null;

	private $url = null;	
	private $url_pieces = null;
	private $html = null;
	
	public function __construct($config,$url){
		
		// Initialize error handlers
		$error = new Error($config["root"]);
		set_error_handler(array($error,"catchError"));
		set_exception_handler(array($error,"catchException"));
		register_shutdown_function(array($error,"catchFatalError"));
			
		// Creating registry and bind config
		$this->registry = Registry::getRegistry();
		$this->registry->put("config", $config);
		
		// Save requested url and config
		$this->url = $url;
		$this->config = $config;			
		
		// Proceed requested url
		$this->explodeUrl();
		
		// Getting data for template
		if($this->goToBack()){
			// Back init
			$back = new Back();
			$data[] = $back->getData();
			
		} else {
			// Front init 
			$front = new Front();
			$data["modules_data"] = $front->getModulesData();	
			$data["head_data"] = $front->getHeadData();			
		}

		// Template init and parsing
		$template = new Template($data);
		$this->html = $template->getHtml();		
	}

	/* Exploding and compiling requested url
	 *
	 */
	private function explodeUrl(){
		// Last slash removing
		$url = preg_replace("~/$~", '', trim($this->url));		

		if(count($url)){
			$url_pieces = explode("/", $url);
			$this->url_pieces = $url_pieces;
		}
			
	}

	/** Decision on base of url, if controller gos to Back
	 * @return bool going to back
	 */
	private function goToBack(){		
		if($this->url_pieces[0] == $this->config["admin_url"]){
			return true;
		}
		else{
			return false;
		}
	}

	public function getHtml(){
		return $this->html;
	}

}

?>