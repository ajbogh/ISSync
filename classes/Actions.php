<?php
class Actions{
	public static function GetActionsHTMLList($actionsFolder){
		echo "<ul style=\"list-style-type: none;padding: 0px;margin: 0px;font-size:.9em;\">\n";
		self::GetDirectoryInfo($actionsFolder);
		echo "</ul>\n";
	}
	
	public static function GetDirectoryInfo($dir,$level=0){
		$dh = @opendir($dir);
		$ignore = array('.','..','icons');
		
		while(false !== ($file = readdir($dh))){ 
			// Check that this file is not to be ignored 
			if(!in_array($file, $ignore)){ 
				// Indent spacing for better view
				$spaces = ($level * 10);
				
				// Show directories only
				if(is_dir("$dir/$file")){ 
					// Re-call this same function but on a new directory. 
					// this is what makes function recursive.	
					echo "<li style=\"list-style-image: url('images/icons/16x16/Crystal_Clear_filesystem_folder_grey_open.png');list-style-position:inside;padding-left:".$spaces."px;\" class=\"nodrag\">$file</li>\n";
					echo "<ul style=\"list-style-type: none;padding-left: 10px;\">\n";
					self::GetDirectoryInfo("$dir/$file", ($level+1));
					echo "</ul>\n"; 
				}else if(is_file("$dir/$file")){
					//list-style-image: url(classimage.gif);
					include("$dir/$file");
					$class = str_replace(".php","",$file);

					echo "<li style=\"list-style-image: url('".
						str_replace($_SERVER['DOCUMENT_ROOT'],"",$dir)."/icons/16x16/".
						self::get_user_prop($class, "icon").
						"');list-style-position:inside;\" data-displayName=\"".self::get_user_prop($class, "displayName")."\">".
						str_replace(".php","",str_replace("_"," ",$file)).
						"</li>\n";
				}
			}
		}
		// Close the directory handle 
		closedir( $dh ); 
	}
	
	//gets a property from the a class.
	public static function get_user_prop($className, $property) {
  		if(!property_exists($className, $property)) return "-";
		else{
			$vars = get_class_vars($className);
			return $vars[$property];
		}
	}
}
?>
