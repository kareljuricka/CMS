<?php

class Controller{

	private $url = null;
	private $url_pieces = null;
	private $html = null;
	private $config = null;

	public function __construct($config,$url){
		$this->config = $config;
		$this->url = $url;

		$this->compileUrl();
		
		// Getting data for template
		// Go to Front or Back?
		if($this->goToBack()){
			// Back init
			$back = new Back();
			$data = $back->getData();
			
		} else {
			// Front init 
			$front = new Front();
			$data = $front->getData();			
		}

		// Template init and parsing
		$template = new Template($this->config,$data);
		$this->html = $template->getHtml();		
	}

	/* Exploding and compiling requested url
	 *
	 */
	private function compileUrl(){
		// Last / removing
		$url = preg_replace("~/$~", '', trim($this->url));		

		if(count($url)){
			$url_pieces = explode("/", $url);
			$this->url_pieces = $url_pieces;
		}
			
	}

	/* Decision on base of url, if controller gos to Back
	 *
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