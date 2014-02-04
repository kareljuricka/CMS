<?php

class Error{
	
	private $log_file = null;	
	
	private $php_errors = array(
		1 => 'E_ERROR',
		2 => 'E_WARNING',
		4 => "E_PARSE",
		8 => "E_NOTICE",
		16 => "E_CORE_ERROR",
		32 => "E_CORE_WARNING",
		64 => "E_COMPILE_ERROR",
		128 => "E_COMPILE_WARNING",	 
		256 => "E_USER_ERROR",
		512 => "E_USER_WARNING",
		1024 => "E_USER_NOTICE",
		2048 => "E_STRICT",
		4096 => "E_RECOVERABLE_ERROR",
		8192 => "E_DEPRECATED",
		16384 => "E_USER_DEPRECATED",
		32767 => "E_ALL"		    
	);	
	
	public function __construct($log_dir){
		$this->log_file = $log_dir . "/error.log";
	}
	
	/** Catch PHP error and write it to the log
	 * @param int error type
	 * @param string error message
	 * @param err_file string filename that the error was raised in
	 * @param err_line int line number the error was raised at 
	 * @param err_context array every variable that existed in the scope the error was triggered in
	 */
	public function catchError($err_no, $err_str, $err_file, $err_line, $err_context){
		$date =  date("[Y-m-d h:i:s]",time());
		$client_ip = "[".$_SERVER['REMOTE_ADDR']."]";
		
		// Get PHP error name
		if(isset($this->php_errors[$err_no])){
			$err_name = $this->php_errors[$err_no];
		} else {
			$err_name = $err_no;
		}
		
		$text = "Error: $err_name - $err_str; Line: $err_line; File: $err_file\n";
		
		file_put_contents($this->log_file, $date.$client_ip." ".$text, FILE_APPEND);
		
		$this->showError($text);	
	}
	
	/** Catch PHP Fatal Error and write it to the log
	 */
	public function catchFatalError(){
		$error = error_get_last();
		if($error["type"] == 1){
			$date =  date("[Y-m-d h:i:s]",time());
			$client_ip = "[".$_SERVER['REMOTE_ADDR']."]";		
			$err_str = $error["message"];
			$err_file = $error["file"];
			$err_line = $error["line"];
			
			$text = "Fatal Error: $err_str; Line: $err_line; File: $err_file\n";
			
			file_put_contents($this->log_file, $date.$client_ip." ".$text, FILE_APPEND);
			
			$this->showError($text);
		}			
	}
	
	/** Catch Exception and write it to the log
	 * @param object Exception class
	 */
	public function catchException($e){		
		$date =  date("[Y-m-d h:i:s]",time());
		$client_ip = "[".$_SERVER['REMOTE_ADDR']."]";
		
		$trace = preg_replace("#\n#",", ",$e->getTraceAsString());
		
		$text = "Exception: ".$e->getMessage()."; Line: ".$e->getLine()."; File: ".$e->getFile()."; Trace: ".$trace."\n";
		
		file_put_contents($this->log_file, $date.$client_ip." ".$text, FILE_APPEND);
		
		$this->showError($text);
	}
	
	/** If develop_mode is on, show error to screen
	 * @param string error
	 */
	private function showError($error){
		$registry = Registry::getRegistry();
		$config = $registry->get("config");
		
		if($config["develop_mode"]){			
			echo $error."<br />";
		}
	}
	
}

?>