<?php
//LDAP_Create_Session
$ldaphost = '192.168.0.18';
$ldapport = 389; //default port 389
$ldapsecureconnection = false;
$ldapprotocolversion = 3;
include('actions/LDAP/LDAP_Create_Session.php');
			
//LDAP_Search
$ldapbasedn = "dc=example,dc=com";
$searchString = "objectclass=*";
$attributes = array('name');
include('actions/LDAP/LDAP_Search.php');
			
$searchResults = ldap_search($ldapsession,$ldapbasedn,'objectclass=*',array('name'));
if($searchResults){
	$info = ldap_get_entries($ldapsession, $searchResults);
	echo "<pre>";
	print_r($info);
	echo "</pre>";
}else{
	echo "Error: ".ldap_errno($ldapsession)." - ".ldap_error($ldapsession)."<br />";
}
?>