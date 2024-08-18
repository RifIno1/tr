<?php

class mail_check_global
	{
	var $system_OS 			= "win";	// required for MX digging (win / linux)
	var $debug 				= 0;		// self-explaining (0 - OFF, 1 - ON)
	var $recType 			= "MX";		// limitting dns query to Mail eXchange only
	var $email;							// the goal! ;)
	var $hostName;						// parent domain for address
	var $userName; 						// actually NOT used :)
	var $check_DNS_result;				// debuging DNS check
	var $check_MAIL_result;				// debuging SYNTAX check
	
	// check if MX records in DNS server response (WINDOWS !!!):
	function checkDNS() 
		{ 
		if ($this -> system_OS == "linux") 		// linuz
			{
			if (getmxrr($this -> hostName)) return TRUE;
				else return FALSE;
			} else 	{							// windoz
					if(!empty($this -> hostName)) 
						{ 
						exec("nslookup -type=".$this->recType." ".$this -> hostName, $result); 
					   // check each line to find the one that starts with the host 
					   // name. If it exists then the function succeeded. 
						foreach ($result as $line) 
							{
							if(eregi("^".$this -> hostName,$line)) return true;  
							} 
					   // otherwise there was no mail handler for the domain 
					   return false; 
						} 
					 return false; 
					}		
		}
	
	// brake address --> username & parent domain
	function check_email_dns()
		{
		list($this -> userName, $this -> hostName) = split("@", $this -> email); 
		if (!$this -> checkDNS ($this -> hostName)) 
			{
			$this -> check_DNS_result = "Address domain MX DNS record could NOT be found";	
			return FALSE;
			} else 	{
					$this -> check_DNS_result = "Address DNS MX is OK";	
					return TRUE;
					}
		}
		
	// check addresse's SYNTAX
	function check_email()
		{
		$this -> email = strtolower($this -> email); 
		if (preg_match('/^[-!#$%&\'*+\\.\/0-9=?A-Z^_`{|}~]+@([-0-9A-Z]+\.)+([0-9A-Z]){2,4}$/i', $this -> email)) 
			{
			$this -> check_MAIL_result = "Address syntax is OK";
			return TRUE;
			} else	{
					$this -> check_MAIL_result = "Address syntax is WRONG";	
					return FALSE;		
					}
		}
		
	// global check
	function final_mail_check()
		{
		if (!$this -> check_email_dns() OR !$this -> check_email()) return FALSE;
			else return TRUE;
		}

	// debuging ONLY
	function debug_address()
		{
		if ($this -> debug == 1) 
			{
			}
		}
	}
	
?>