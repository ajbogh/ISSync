<?php

class Error{
	public $logLocation;
	private $logFile;
	function __construct($logLocation){
		if(!is_null($logLocation)) $this->logLocation = $logLocation ;
		else $this->logLocation = $_SERVER['DOCUMENT_ROOT']."/logs/";
		//open log file
		 
		//$this->logFile = fopen($this->logLocation,'a');
	}
	function printError(){
		//check to see how many logs we have, delete old ones.
	}
	
	function __destruct(){
		//close log file
	}
}

?>