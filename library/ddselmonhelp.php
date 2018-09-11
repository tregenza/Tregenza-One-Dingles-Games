<?

// <-- CT 29/11/08
$includePath = "/var/www/dinglesgames";
$includePathLocal = $includePath.dirname($_SERVER['PHP_SELF'] ); 
// END -->
require_once $includePath."/header.php";
?>

	<!-- Define local CSS -->
	<LINK href="local.css" rel="stylesheet" type="text/css">
	<!-- END CSS Set Up -->

<?php

// Load Javascript functions
require_once $includePathLocal."/ddmonsterJS.php";
// END -->


// include $includePathLocal.'/includes/dd_menu.txt' ;


$local =  $_SERVER['SERVER_NAME'];			
//  <-- CT 29/11/08
$local .= dirname($_SERVER['PHP_SELF'] ); 		// Append the current path
//  END -->


if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location = '"http://' . $local . '/dddismon.php"';
}else{
   $location =  '"http://' . $local . '/dddismon.php"';
}
//echo $location;
if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}
if ($msg == "" and $_POST){
echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript">
     window.location = $location;
  </script>

EOF;
}


?>

	</HEAD>

	<BODY>
	
		<div id="titleBanner">
		
		
		</div>
		<div id="content">

		<div id="alpha">
<?PHP		
			require $includePath."/alpha.php"; 
?>
		</div>
	
		<div id="beta">
			<h1>Monster Generator</h1>
			<h2>D&D 3.5 Monster Generator</h2>
			<h3>Help Information</h3>
<?PHP

			require_once $includePathLocal."/selectMonsterAdditional.php";


?>
		</div>
		
		<div id="charlie">
<?PHP 
			require $includePath."/charlie.php"; 
?>
		</div>


		<div id="footer">
<?PHP 
			require $includePath."/footer.php"; 
?>
		</div>

	</div>

<?PHP

	require_once $includePath."/pageEnd.php";
?>
