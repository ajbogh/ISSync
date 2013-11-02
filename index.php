<?php 

 //install php5-ldap
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
 include('includes/config.inc.php');
 include('classes/Template.php');
 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ISSync</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
		<!--<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" />-->
		<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.8.21.custom.css" />
		
		<!--<link rel="stylesheet" type="text/css" href="css/jqdialog.css" />-->
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.layout-latest.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery.dragsort-0.4.min.js"></script>
		<script type="text/javascript" src="js/jqdialog.js"></script>
		<script type="text/javascript" src="js/generalfunctions.js"></script>
		<script type="text/javascript" src="js/actions.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
		    	$('body').layout({ 
		    		applyDefaultStyles: true
		    		,north__resizable: false
		    		,north__size: 25
		    		,north__spacing_open: 0
		    	});

		    	$(".ui-layout-center").dragsort({dragBetween:true, scrollContainer:".ui-layout-center"}); 
		    });
		</script>
	</head>
	<body>
		
		<div class="ui-layout-center">
		
		</div>
		<div class="ui-layout-north">
			<?php
				$tpl = new Template("includes/content/menu.phtml");
				//$tpl->name = "John Doe";
				echo $tpl;
			?>
		</div>
		<div class="ui-layout-south">South</div>
		<div class="ui-layout-west">
			<?php
				Actions::GetActionsHTMLList($app['actionsFolder']);
			?>
		</div>
		<div id="actionMover"></div>
		<div id="actionMover2"></div>
		
	</body>
</html>
