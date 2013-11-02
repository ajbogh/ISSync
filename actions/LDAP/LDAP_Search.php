<?php
class LDAP_Search{
	public static $icon = "Crystal_Clear_app_xmag.png";
	public static $displayName = "LDAP Search";
	public static $name = "LDAP Search";
	
	public function __construct($ldapsession,$ldapbasedn='',$searchString='objectclass=*',$attributes=array('distinguishedname')){
		$this->ldapsession = $ldapsession;
		$this->ldapbasedn = $ldapbasedn;
		$this->searchString = $searchString; //like 'objectclass=*'
		$this->attributes = $attributes; //array of attribute names like array('name')
	}
	
	public function Build(){
		return ldap_search($this->ldapsession,$this->ldapbasedn,$this->searchString,$this->attributes);
	}
	
	public function __destruct(){
		
	}
}

if(isset($ldapsession)){
	$searchclass = new LDAP_Search($ldapsession,$ldapbasedn,$searchString,$attributes);
}
//$searchResults = $searchClass->Build();
?>