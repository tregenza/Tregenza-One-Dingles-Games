<?php
/**
*
*		Initialisation code shared between programs. 
*
*/

// Set up paths
$includePath = "/var/www/dinglesgames";
$includePathLocal = $includePath.dirname($_SERVER['PHP_SELF'] ); 

// Init Session
session_start();

if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
}

// Get standard functions
require $includePathLocal."/ddmonsterFunctions.php";



?>