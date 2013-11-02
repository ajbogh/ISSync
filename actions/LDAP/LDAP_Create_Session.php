<?php

class LDAP_Create_Session{
	public static $icon = "Crystal_Clear_filesystem_blockdevice.png";
	public static $displayName = "LDAP Create Session123";
	public static $name = "LDAP Create Session";
	
	public function __construct($ldaphost,$ldapport=389,$ldapsecureconnection=false,$ldapprotocolversion=3){
		$this->ldaphost = $ldaphost;
		$this->ldapport = $ldapport; //default port 389
		$this->ldapsecureconnection = $ldapsecureconnection;
		$this->ldapprotocolversion = $ldapprotocolversion;
		
		$this->ldaprdn = ""; //like "uid=admin,ou=people,".$ldapbasedn - leave blank for anonymous binding
		$this->ldappass = ""; //leave blank for anonymous binding
	}
	
    public function Build(){
		if(extension_loaded("ldap")){		
			$ldapsession = ldap_connect(($this->ldapsecureconnection?"ldaps://":"ldap://").$this->ldaphost,$this->ldapport);
			if($ldapsession){
				ldap_set_option($ldapsession, LDAP_OPT_PROTOCOL_VERSION, $this->ldapprotocolversion);
				$ldapbind;
				if(strlen($ldaprdn) > 0){
					$ldapbind = ldap_bind($ldapsession,$this->ldaprdn,$this->ldappass);
				}else{
					$ldapbind = ldap_bind($ldapsession);
				}
				
				if($ldapbind){
					return $ldapsession;
				}else{
					echo "Could not bind to the LDAP session.<br />";
					echo "Error: ".ldap_errno($ldapsession)." - ".ldap_error($ldapsession)."<br />";
				}
			}else{
				echo "Could not connect to LDAP server ".$this->ldaphost." on port ".$this->ldapport.".";
			}
		}else{
			echo "The LDAP PHP extension is not installed. Please install it before using this action.";
		}
		
    }
	
	public function __destruct(){
		
	}
}

if(isset($ldaphost)){
	$sessionclass = new LDAP_Create_Session($ldaphost,$ldapport,$ldapsecureconnection,$ldapprotocolversion);
	$ldapsession = $sessionclass->Build();
}

?>