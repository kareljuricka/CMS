<?php

class Error{
	
	private $log_dir = null;
	
	public function __construct($log_dir){
		$this->log_dir = $log_dir;
	}	
	
	/** Catch PHP error and choose what to do with it
	 * @param int error type
	 * @param string error message
	 * @param err_file string filename that the error was raised in
	 * @param err_line int line number the error was raised at 
	 * @param err_context array every variable that existed in the scope the error was triggered in	 * 
	 */
	public function catchError($err_no, $err_str, $err_file, $err_line, $err_context){
		$log_file = $this->log_dir."/error.log";
		$date =  date("[Y-m-d h:i:s]",time());
		$client_ip = "[".$_SERVER['REMOTE_ADDR']."]";
		$text = " Error n: $err_no: $err_str on line $err_line in $err_file\n";
		file_put_contents($log_file, $date.$client_ip." ".$text, FILE_APPEND);
	}
	
}

?>