<?php
	set_include_path(get_include_path() . PATH_SEPARATOR . getcwd());

	//All folder paths should be relative to the root directory.
	$app['actionsFolder'] = "actions";
	
	
	/////////////////////////////////////////
	//DO NOT EDIT BELOW/////////////////////
	///////////////////////////////////////
	
	include('classes/Actions.php'); //generic Actions class
?>
