<?php
if ( is_page() ) {
}else{
  $wordpressAbsolutePath = "/usr/share/wordpress2.7";
  $themePath = get_template_directory();
   $themePath = str_ireplace( $wordpressAbsolutePath, "", $themePath);  // Trim directory so it is relative to the wordpress root
  $workingPath = $wordpressAbsolutePath.$themePath."/library";
  require $workingPath."/ddmonsterFunctions.php";
}
global $current_user;
get_currentuserinfo();
$user_name_wp = $current_user->user_login ;
//$user_name_wp = "Paul3";
$desc_l =  "Not Logged on";
if ($user_name_wp != ""){
   $desc_l =  "Logged on as";
   $select = "select dduser_type, dduser_exp_date from dduser where dduser_id = '$user_name_wp'";
//   echo $select;
   $link = getDBLink();
   $result = mysqli_query($link, $select) ;
   $type_l = "Registered";
   if (mysqli_num_rows($result) > 0){
      while ($row = mysqli_fetch_array($result)){
        $user_type_l = $row[dduser_type];
//        echo "tp " . $user_type_1;
        $exp_date  = $row[dduser_exp_date];
//        echo "ex " . $exp_date;
        $edate = "expires " . date('Y-m-d', $exp_date);
//        echo $edate;
        if ($user_type_l == "l"){
           $type_l ="Lifetime member";
           $edate = "";
        }
        if ($user_type_l == "y"){
           $type_l ="Year membership";
           echo $user_type_1;
        }
      }
   }
}
$url = curPageURL();
$www = substr($url,7,4);
echo "url = $url";
echo $www;
if ($www == "test"){
    $desc_l =  "Logged on as";
    $user_type_l == "y";
    $paid_user = "Y";
    $user_name_wp = "admin";
//    $user_name_wp = "CallTHammer";
//    $wp_user =  "CallTHammer";
    $type_l ="Lifetime member";
    $wp_user =  "admin";
}

/*  ALPHA: Static left hand column */
?>

<div id="alpha">
        <div class="friends">
            <?echo $desc_l?>
            <?echo $user_name_wp?>
            <?echo $type_l?>
            <?echo $edate?>
        </div>

	<div class="navBox">
		<h4>Navigation</h4>
		<a href="/">Home</a>
                <a href="/tools/monster-creator/">Monster Creator (Add)</a>
                <a href="/tools/monster-creator-edit/">Monster Creator (Edit)</a>
	</div>

<?php
	/* List Friends on home page only */
	if ( is_home()  ) {
		?>
		<div class="friends">
				<?php  wp_list_bookmarks('title_before=&title_before=&category=7');   ?>

		</div>
<?php
	}



?>


<?php if ( ! is_page() ) {

	if (function_exists('get_recent_comments')) { ?>
		<div class="recentComments">
			<h4><?php _e('Recent Comments:'); ?></h2>
	   		<ul><?php get_recent_comments(); ?></ul>
		</div>
	<?php } 
	
}
?>   

</div>
