<?php
/*
	Server Status Script
	Created by: Lee Findlow
	Website:	http://leefindlow.com
*/
class ServerStatus{
	//Standard Services to Check
	var $services	=	array();
	function ServerStatus(){
		//Set "$services" for default checking
		$this->services	=	array(
			'HTTP (Port 80)' => array('localhost' => 80),
			'HTTPS (Port 443)' => array('localhost' => 443),
			'FTP (Port 21)' => array('localhost' => 21),
			'MySQL (Port 3306)' => array('localhost' => 3306),
			'SMTP (Port 25)' => array('localhost' =>  25),
			'POP3 (Port 110)' => array('localhost' =>  110),
			'Internet Connection' => array('google.com' => 80)
		);
	}
	//Functions
	function CheckStatus($server = 'localhost', $port = '80'){
		//Connection
		$fp	=	@fsockopen($server, $port, $errno, $errstr, 1);
			//Check if connection is present
			if($fp){
				//Return Alive
				return true;
			} else{
				//Return Dead
				return false;
			}
		//Close Connection
		fclose($fp);
	}

	//Function to check all services in the $services array
	function CheckAll(){
		//Check All Services
		foreach($this->services as $name => $server){
			foreach($server as $host => $port){
				$status[$name] = $this->CheckStatus($host,$port);
			}
		}
		return $status;		
	}
}
?>
