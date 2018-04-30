<?

// <-- CT 29/11/08
$includePath = "/var/www/dinglesgames";
$includePathLocal = $includePath.dirname($_SERVER['PHP_SELF'] );
// END -->

session_start();
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
  $count_new_x = 1;
}

if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }

    if ($comment == "") {
       $msg = "please enter comments" ;
    }
    if ($email == "") {
       $msg = "please enter an e-mail address or name";
    }



//    echo "mon_hd_1 " . $mon_hd_1 . "**";




    if ($msg == "") {
      $date  = date('jS M Y, H-i-s');
      $country = " ";
      include 'includes/dd_db_conn.txt';
      $update  = "insert into comments (comments_email, comments_internal, comments_date, comments_country, comments_text) ".
                 " values ('$email',  '$user_id', '$date', '$country', '$comment')";
//     echo $update;
      $result3 = mysqli_query($link, $update) ;
      $comment = "";
      $thanks = "Thankyou for the comment";


    }
//  echo "<div class=\"error\">$msg</div>" ;
}
else {
      $fn = $ln = "" ;
}

// <-- CT 29/11/08
// $background_blue = "LightSkyBlue";
// $background_grey = "LightGrey";

require_once $includePath."/header.php";
?>

	<!-- Define local CSS -->
	<LINK href="local.css" rel="stylesheet" type="text/css">
	<!-- END CSS Set Up -->
<STYLE type="text/css">
<!--
.error {
	color: red;
}
-->
</STYLE>
<?php

// Load Javascript functions
//require_once $includePathLocal."/ddmonsterJS.php";
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

//if ($msg == "" and $_POST){
//echo <<<EOF
//  <SCRIPT LANGUAGE="JavaScript">
//     window.location = $location;
//  </script>

//EOF;
//}


?>
<STYLE type="text/css">
<!--
.commentsPrint {
	border: 1px solid #CCCCCC;
        height: 250px;
       	width: 450px;
}
-->
</STYLE>

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
			<h1>D&D 3.5 Monster Generator Comments</h1>
			<div id="intro" class="lightBorder justify">
			<p>Welcome to Dingle's Games <em>free</em> monster generator for D&D 3.5.</p>
			<div id="intro" class="lightBorder justify">
			<p class="small">Please enter your email address (or just name) and comment.</p>
			<p class="small">You may want to include any monsters you would like adding (monster manual only), or any new skill focus's you think would be useful, or anything about a skill focus that seems odd.</p>
                        <p class="small">Coming soon Dingles Treasure Generator.</p>
			</div>
			<h3>Comments</h3>
<?PHP
if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}
?>
<?PHP
			require_once $includePathLocal."/selectCommentsForm.php";



?>
			</div>


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



