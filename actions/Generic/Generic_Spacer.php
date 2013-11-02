<?php

class Generic_Spacer{
	public static $icon = "Crystal_Clear_app_miscellaneous.png";
	public static $displayName = "";
	public static $name = "Generic Spacer";
	
	public function __construct($comment = ""){
		$this->comment = $comment;
	}
	
	public function Build(){
		return Generic_Spacer();
	}
	
	public function __destruct(){
		
	}
}


$spacer = new Generic_Spacer();

?>
