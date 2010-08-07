<?php
/**
 *	Script which allows for the checking of the status of a server. Works by checking to see if a socket connection can be opened to a given server address and port number.
 *	For specific services (such as HTTP) advanced checks can be made to ensure that the server is responding appropriately.
 *
 *	@author		Lee Findlow	<projects@leefindlow.com>
 *	@version	0.4
 *	@link		http://leefindlow.com/projects/serverstatus/
 */

class	ServerStatus{

	private	$advancedCheckPorts	=	array();
	private	$timeout;

	//Something here
	public	function	__construct(){
		$this->advancedCheckPorts	=	array('80','8080');
		$this->timeout	=	0;
	}
	/**
	 *	Main method which is used to check a server, usage is simple with examples below:
	 *
	 *
	 *	@param	mixed	$server			Hostname or IP address of the server to be checked.
	 *	@param	int		$port			Port number which should be checked on the given server.
	 *	@param	bool	$advancedCheck	Whether to perform an advanced service check (specific ports only).
	 *	@return	bool
	 */
	public	function	ServerStatus($hostname = '127.0.0.1', $port = 80, $advancedCheck = false){
		if($advancedCheck){
			return	$this->checkServerAdvanced($hostname, $port);
		}else{
			return	$this->checkServer($hostname, $port);
		}
	}

	protected	function	checkServer($hostname = '127.0.0.1', $port = 80){
		$fp	=	@fsockopen($hostname, $port, $errno, $errstr, $this->timeout);
		if($errno == 0){
			return	true;
			fclose($fp);
		}
		return	false;
	}

	protected	function	checkServerAdvanced($hostname = '127.0.0.1', $port = 80){
		$fp	=	@fsockopen($hostname, $port, $errno, $errstr, $this->timeout);
		if($errno == 0){
			if(in_array($port, $this->advancedCheckPorts)){
				//Perform advanced checks
				switch($port){
					//FTP
					case 20:
					case 21:
						return	true;
						break;
					//SSH
					case 22:
						return	true;
						break;
					//Telnet
					case 23:
						return true;
						break;
					//SMTP
					case 35:
						return	true;
						break;
					//WHOIS
					case 43:
						return	true;
						break;
					//HTTP
					case 80:
					case 8080:
						$resp	=	$this->writeToSocket($fp, "HEAD / HTTP/1.1\r\nHost: $hostname\r\nConnection:close\r\n\r\n");
						preg_match('/([1-5][0-5][0-9])/', $resp, $statusCode);
						$statusCode	=	$statusCode[0];
						if($statusCode < 400)
							return	true;
						break;
					//POP
					case 110:
						return	true;
						break;
					//IMAP
					case 143:
						return	true;
						break;
				}
			}else{
				return	true;
			}
			fclose($fp);
		}
		return	false;
	}

	private	function	writeToSocket($fp, $data){
		if($fp && !empty($data)){
			fwrite($fp, $data);
			$resp	=	'';
			while(!feof($fp)){
				$resp.=	fgets($fp);
			}
			return	$resp;
		}
		return	false;
	}

}

?>
