
<?PHP
global $current_user;
get_currentuserinfo();
if (array_key_exists('type', $_GET)){
  $gg_type = $_GET['type'];
  $gg_key = $_GET['key'];
  $gg_pay = $_GET['pay'];
  if ($gg_pay == "paypal"){
     require_once("paypal_api.php");

     $Token = $_GET["token"];
     $PayerID = $_GET["PayerID"];
     $nvps = "";
     $nvps = array();
//     $nvps["USER"] = "paul_api1.dinglesgames.com";
//$nvps["USER"] = "paul_api1.dinglesgames.com";
//     $nvps["PWD"] = "N8WQVRYS2BV6SZC8";
//     $nvps["SIGNATURE"] = "AFcWxV21C7fd0v3bYYYRCpSSRl31A6tZA3NUVQ79mbkjn7mkZcd88RxL";
//     $nvps["VERSION"] = "97.0";
//     $nvps["PAYERID"] = $PayerID;
// get details of transaction (needed for Name & Desc in DoExpressCheckoutPayment)
     $nvps["METHOD"] = "GetExpressCheckoutDetails";
     $nvps["TOKEN"] = $Token;
     $response = RunAPICall($nvps); // Send the API call to PayPal.
  //   echo "</BR>response 1= ";
//     print_r ($response);
// Do the final action - complete the payment!
     $nvps["METHOD"] = "DoExpressCheckoutPayment";
     $nvps["PAYERID"] = $response["PAYERID"];
     $nvps["PAYMENTREQUEST_0_PAYMENTACTION"] = "Sale";
     $nvps["PAYMENTREQUEST_0_AMT"] = $response["AMT"];
     $response = RunAPICall($nvps); // Send the API call to PayPal.
//     echo "</BR>response 2= ";
//     print_r ($response);


  }
//  echo  "key:"  . $gg_key;
  $sixday = time() - (60*60*24*7);
  $today = time();
  echo "<BR></BR>today " . $today . "<BR></BR>";
//  echo  "6 days " . $sixday;
  if ($gg_type == "l" or $gg_type == "y" or $gg_type == "3" or $gg_type == "6" or $gg_type == "w" or $gg_type == "DB" ){
    if ($gg_key >= $sixday  and $gg_key <= $today){
       if ($gg_type == "l"){
          $membership = "Lifetime";
       }
       if ($gg_type == "y"){
          $membership = "One Year";
       }
       if ($gg_type == "6"){
          $membership = "Six Months";
       }
       if ($gg_type == "3"){
          $membership = "Three Months";
       }
       if ($gg_type == "w"){
          $membership = "1 week";
       }
       if ($gg_type == "DB"){
          $membership = "30 Days";
       }
       $gg_reg = $gg_type;
       $gg_error = "To register your " . $membership . " membership just Login or Create a New User";
//     echo  '<input type="hidden" name="gg_reg" value="' . $gg_reg . '" />';
    }else{
       $gg_error = "The Registration key has expired please contact paul@dinglesgames.com";
    }
  }else{
      $gg_error = "The Registration key is incorrect please contact paul@dinglesgames.com";
  }
}





/*
echo('Username: ' . $current_user->user_login . "\n");
echo('User email: ' . $current_user->user_email . "\n");
echo('User level: ' . $current_user->user_level . "\n");
echo('User first name: ' . $current_user->user_firstname . "\n");
echo('User last name: ' . $current_user->user_lastname . "\n");
echo('User display name: ' . $current_user->display_name . "\n");
echo('User ID: ' . $current_user->ID . "\n");
*/
$user_name_wp = $current_user->user_login ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
//       echo $k . "=" .$v . "<BR></BR>";
    }
}
//echo "user id " . $wp_user_id;
//wp_signon( $credentials, $secure_cookie );
//echo "reg = " . $gg_reg;
require ($wordpressAbsolutePath . '/wp-includes'. '/registration.php' );




if ($user_name_wp !=""){
  if ($password_wp !=""){
     $wp_user_id = username_exists($user_name_wp);
//      echo "user id " . $wp_user_id . " password " . $password_wp;
      if ($wp_user_id) {
        $pass = user_pass_ok($user_name_wp, $password_wp);
//        echo "pass " . $pass;
        if (user_pass_ok($user_name_wp, $password_wp)){
           wp_set_current_user( $user_id, $user_name_wp );
        }else{
            $msg = "Password Invalid";
            $wp_user_id = "";
        }
      }else{
        $msg = "User Id Invalid";
      }
  }else{
    $msg = "Please Enter Password";
  }
}
if ($n_user_name_wp !=""){
  if ($n_password_wp == $n_password_wp_2){
    if ($n_password_wp !=""){
       $wp_user_id = username_exists($n_user_name_wp);
//        echo "new user id " . $n_user_name_wp . " password " . $n_password_wp;
        if (!$wp_user_id) {
             $wp_user_id = wp_create_user($n_user_name_wp, $n_password_wp, $n_user_email);
//             echo "wp new id = " . $wp_user_id;
             wp_set_current_user( $wp_user_id, $n_user_name_wp );
             $user_name_wp = $n_user_name_wp;
             $password_wp  = $n_password_wp;
             $rememberme = $n_rememberme;
        }else{
          $msg = "User Id aleady exists";
          $wp_user_id = "";
        }
    }else{
      $msg = "Please Enter Password";
    }
  }else{
      $msg = "Passwords do not match";
  }
}
// if a logon id has been found and user has renewed automatically set the login id
if ($wp_user_id == "" and $user_name_wp <> "" and $gg_reg <> ""){
   $wp_user_id = username_exists($user_name_wp);
}
if ($wp_user_id){
   wp_set_current_user( $wp_user_id, $user_name_wp );
   global $current_user;
 //  get_currentuserinfo();
   if ($gg_reg != ""){
      $meta_key = "ddexpire";
      if ($gg_reg == "l"){
         $meta_value = time() + (60*60*24*365 * 120);
      }
      if ($gg_reg == "y"){
         $meta_value = time() + (60*60*24*365);
      }
      if ($gg_reg == "6"){
         $meta_value = time() + (60*60*24*183);
      }
      if ($gg_reg == "3"){
         $meta_value = time() + (60*60*24*92);
      }
      if ($gg_reg == "w"){
         $meta_value = time() + (60*60*24*7);
      }
      if ($gg_reg == "DB"){
          $meta_value = "";
          $days_bought = 30;
          $days = 30;
      }
        $date = time();
      	$link = getDBLink();
      	$select = "select dduser_wp_key, dduser_days_bought from dduser where dduser_id = '$user_name_wp'";
      	$result = mysqli_query($link, $select) ;
      	if (mysqli_num_rows($result) > 0){
           $row = mysqli_fetch_array($result);
           $days = $row[dduser_days_bought];

           if ($gg_reg == "DB"){
             if ($days > 0){
                  $days += $days_bought;
              }else{
                  $days = $days_bought;
              }
             }
           $update = "update dduser set dduser_wp_key = '$wp_user_id', dduser_type = '$gg_reg', dduser_exp_date = '$meta_value', dduser_date_key = '$gg_key',  ".
                     " dduser_days_bought = '$days' WHERE dduser_id = '$user_name_wp'";
    //       echo $update;
           $result3 = mysqli_query($link, $update) ;
       }else{
            $insert = "insert into dduser (dduser_id, dduser_wp_key, dduser_type, dduser_mon_created, dduser_last_date, dduser_exp_date, dduser_int_key, dduser_date_key, dduser_days_bought)" .
                        " VALUES ('$user_name_wp', '$wp_user_id', '$gg_reg', '0', '$date', '$meta_value', '$user_id', '$gg_key', '$days')";
//            echo $insert;
            $result3 = mysqli_query($link, $insert) ;
       }

//      update_usermeta($wp_user_id,$meta_key,$meta_value);
   }

//  $secure_cookie = 1;
//   $login = $current_user->user_login;
//   $pwd = $password_wp;
//   $remember = $remember;
   $credentials = array("user_login" => $user_name_wp, "user_password" => $password_wp, "remember" => $remember);
//   $credentials["user_password"] = $current_user->user_password;
//   $credentials["remember"] = $remember;
//   $test = wp_logoff();
//   echo "CREDS " .  $credentials->user_login;
 //   if ($n_password_wp <> "" and $msg == ""){
?>
    <form name="form1" action="<?php echo get_option('home'); ?>/wp-login.php" method="post">
<?
//    }
echo <<<EOF
    <input type="hidden" name="pwd" value="$password_wp" />
    <input type="hidden" name="log" value="$user_name_wp" />
    <input type="hidden" name="redirect_to" value="/" />
    <input type="hidden" name="rememberme" value="$rememberme" />
EOF;
/*
    <input type="hidden" name="pwd" value="$password_wp" />
    <input type="hidden" name="log" value="$user_name_wp" />
    <input type="hidden" name="redirect_to" value="/" />
*/
//   $location_sel =  get_option('home') . "/wp-login.php" . "?log=" . $user_name_wp . "&pwd=" . $password_wp;
   $location_sel =  get_option('home') . "/wp-login.php" ;
//   $location_sel = "'" . $location_sel . "'";
//   $_POST['pwd'] = $password_wp;
//   $_POST['log'] = $user_name_wp;
//   $_POST['redirect_to'] = "/";

echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript">
//    alert( '$location_sel' );
    document.form1.method = 'Post';
    document.form1.action = '$location_sel';
    document.form1.submit();
  </script>

EOF;

//   $user_xx = wp_signon($credentials, $secure_cookie );
//   echo "SIGNED ON error " . $wp_error;
//   print_r($user_xx);
}



$credentials = "";
//$secure_cookie = 1;


require ($workingPath."/ddlogonForm.php");

