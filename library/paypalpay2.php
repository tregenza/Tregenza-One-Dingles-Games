<?php
//require_once("https://paypal-nvp-api.googlecode.com/svn-history/r2/trunk/Paypal_api.php");

//echo "</BR>Item = $Item";
//print_r($_POST);
require_once("paypal_api.php");
//echo "in paypalpay";
$Desc = "";
$Price = 0.00;
if($Item == "week"){
$Desc = "1 weeks membership";
$Price = 1.00;
$type = "w";
}
if($Item == "threem"){
$Desc = "3 months membership";
$Price = 8.00;
$type = "3";
}

if($Item == "hyear"){
$Desc = "6 months membership";
$Price = 15.00;
$type = "6";
}

if($Item == "year"){
$Desc = "1 years membership";
$Price = 25.00;
$type ="y";
}

if($Item == "life"){
$Desc = "lifetime membership";
$Price = 40.00;
$type ="l";
}
if($Item == "daysbought"){
$Desc = "30 Days membership";
$Price = 15.00;
$type ="DB";
}

$nvps = array();
//$nvps["USER"] = "paul_api1.dinglesgames.com";
//$nvps["USER"] = "paul_api1.dinglesgames.com";
//$nvps["PWD"] = "N8WQVRYS2BV6SZC8";
//$nvps["SIGNATURE"] = "AFcWxV21C7fd0v3bYYYRCpSSRl31A6tZA3NUVQ79mbkjn7mkZcd88RxL";


$nvps["VERSION"] = "97.0";
$gg_key =  time();
// Single-item purchase
$nvps["METHOD"] = "SetExpressCheckout";
$nvps["RETURNURL"] = "http://www.dinglesgames.com/tools/login/?type=$type&key=$gg_key&pay=paypal";
$nvps["CANCELURL"] = "http://www.dinglesgames.com/";
$nvps["PAYMENTREQUEST_0_PAYMENTACTION"] = "Sale";
// $nvps["PAYMENTREQUEST_0_NOTIFYURL"] = "http://www.yourdomain.com/PayPal/YourPayPalListener.php";
$nvps["PAYMENTREQUEST_0_AMT"] = "$Price";
$nvps["PAYMENTREQUEST_0_CURRENCYCODE"] = "USD";
$nvps["PAYMENTREQUEST_0_ITEMAMT"] = "$Price";
$nvps["L_PAYMENTREQUEST_0_NAME0"] = "$Desc";
$nvps["L_PAYMENTREQUEST_0_NUMBER0"] = "$Item";
$nvps["L_PAYMENTREQUEST_0_AMT0"] = "$Price";
$nvps["L_PAYMENTREQUEST_0_QTY0"] = "1";
$nvps["L_PAYMENTREQUEST_0_ITEMCATEGORY0"] = "Digital"; // specific to Digital Goods
$nvps["SOLUTIONTYPE"] = "Sole"; // accept plain old credit cards in addition to paypal accounts!

// IMPORTANT: Setting SOLUTIONTYPE to "Sole" enables guest checkout (pay with credit card). And since it's a digital good (and not physical), we don't need a shipping address.
$nvps["REQCONFIRMSHIPPING"] = "0";
$nvps["NOSHIPPING"] = "1";

// Send the API call to PayPal.
$response = RunAPICall($nvps);

// Did we get an error back from PayPal? Did PayPal not give us a token? If so, fail now.
if(($response["ACK"] != "Success" && $response["ACK"] != "SuccessWithWarning") || !strlen($response["TOKEN"])){
  echo "Failure in PayPal API call: SetExpressCheckout<br>";
  echo outputArrayValues($response);
die();
}
$resp = $response["TOKEN"];
$href =  "https://www.paypal.com/incontext?token=" . $resp ;
//echo "</BR>$href";
//$date = date("Ymd H:i:s") . ": $type ";
//$link = getDBLink();
//$insert = "insert into ppdate (ppdate_user, ppdate_time) values ('$wp_user', '$date')";
//$result = mysqli_query($link, $insert);
//mysqli_close($link)
//echo "</BR>adding ppdate";

?>
//alert ("here");
paywin = window.open("<?echo $href ?>");



