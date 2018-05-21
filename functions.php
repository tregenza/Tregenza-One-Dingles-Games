<?php
/*
		Functions.php for Dingles Games, child theme of Tregenza-One
*/


/* ---------- Load standard Javascript ----------- */
/*add_action( 'wp_enqueue_scripts', 'load_scripts' );
function load_scripts() {
 	wp_enqueue_script( 'dgUtility', get_template_directory_uri() .'/utility.js' );
}
*/
/** ------ Load Additional Style Sheets ------ **/
function custom_style_sheet() {
	wp_enqueue_style( 'custom-styling', get_stylesheet_directory_uri() . 'css/style-tools.css' );
}
add_action('wp_enqueue_scripts', 'custom_style_sheet');



/* --------- Cookies for tools ----------- */
add_action( 'init', 'tools_cookie' );
function tools_cookie() {
	$url = home_url(add_query_arg(array()));
	$id = url_to_postid($url);
	switch ($id) {
		/* There must be a better thing to check than page ids */
		case 47:
		case 136:
		case 183:
		case 199:
		case 203: 
		case 209:
		case 213:
		case 224:
		case 260:
		case 1947:
		case 2013:
			if (isSet($_COOKIE['dd_user_id'])){
			    $user_id = $_COOKIE['dd_user_id'];
		    	setcookie('dd_user_id','');
		    	setcookie('dd_user_id',$user_id, time() + (60*60*24*365), COOKIEPATH, COOKIE_DOMAIN);
			} else {
			    $user_id = "dd" . time();
			    setcookie('dd_user_id',$user_id, time() + (60*60*24*365), COOKIEPATH, COOKIE_DOMAIN);
			    $count_new_x = 1;
			}
			if ($user_id == ""){
				$user_id = "dd" . time();
			    setcookie('dd_user_id',$user_id, time() + (60*60*24*365), COOKIEPATH, COOKIE_DOMAIN);
			    $count_new_x = 1;
			}
		
			/* Special code for login page - Not sure why */
			if (is_page(183)){
				$cookie_error = $_POST['cookie_error'];
			//    echo "here:" . $cookie_error ;
				if (isSet($_COOKIE['dd_user_id'])){
			//    echo "cookie" . $cookie_error;
			    }	else	{
			//    echo "error2:" . $cookie_error;
					if ($cookie_error <> "Y"){
			        	$cookie_error = "Y";
						?>
						<SCRIPT>
						alert ("Error in writing cookies. Please make sure cookies are enabled on your web browser, If you are using Internet Explorer go to internet options (top right cog), select the privacy tab, select sites and enter http:/www.dinglesgames.com/ and click allow. Then refresh screens by pressing F5");
						
						</SCRIPT>
						
						<?php
					}
	    		}
	  		}
		} /* End Switch */
}




/* ---------- Dingles Games database connection function ----------- */
function getDBLink() {
	/* Chris Local Test */
 	return mysqli_connect('localhost','rootdd','','dd') ;
	
	/*  Test.dinglesgames */
// 	return mysqli_connect('localhost','rootdd','8jXXgB=L5z','dd') ;
}


/* --------- Dingles Games - Special functions for User management & Order Processing with Woocommerce ----------- */

/* Get full details of the users account status */
function dgGetAccountStatus() {

	$value = array();

	$value['valid_member'] = 0;
	$value['has_dduser'] = 0;
    $value['user_type'] = "";
    $value['exp_date']  = "";  
    $value['exp_date_formatted'] = "";      
	$value['days_bought'] = 0;
	$value['days_used'] = 0;
	$value['days_left'] = 0;
	$value['mon_created'] = 0;
	$value['dduser_id'] = "";
	$value['dduser_wp_key'] = "";
	$value['exp_date_text'] = "";
	$value['user_type_nice'] = ""; 


	if ( is_user_logged_in() ) {
		// PLACEHOLDER - CHECK IF USER HAS PAID 
		$current_user = wp_get_current_user();
		$wp_user = $current_user->user_login;

		$value['wp_user'] = $wp_user;

		$link = getDBLink();


		$select = "select dduser_type, dduser_exp_date, dduser_days_bought, dduser_wp_key, dduser_mon_created from dduser where dduser_id = '$wp_user'";
		$result = mysqli_query($link, $select) ;
		if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_array($result);
				$value['has_dduser'] = 1;
		        $value['user_type'] = $row['dduser_type'];
       			$value['mon_created'] = $row['dduser_mon_created'];
				$value['dduser_wp_key'] = $row['dduser_wp_key'];

				$today = date("Y-m-d");
		
				switch (strtolower($value['user_type'])) {
					case 'l':
						$value['user_type_nice'] = "Lifetime"; 
						$value['exp_date_text'] = "Never";
						$value['valid_member'] = 1; 
						break; 
					case 'y':
						$value['user_type_nice'] = "Year"; 
				        $value['exp_date']  = $row['dduser_exp_date'];  
				        $value['exp_date_formatted'] = "expires " . date('Y-m-d', $value['exp_date']);      
						if ( $value['exp_date_formatted'] >= $today ) {
							$value['valid_member'] = 1; 
						}
						$value['exp_date_text'] = date('dS F Y', $value['exp_date']);
						break; 
					case '6':
						$value['user_type_nice'] = "Six Month"; 
				        $value['exp_date']  = $row['dduser_exp_date'];  
				        $value['exp_date_formatted'] = "expires " . date('Y-m-d', $value['exp_date']);      
						if ( $value['exp_date_formatted'] >= $today ) {
							$value['valid_member'] = 1; 
						}
						$value['exp_date_text'] = date('dS F Y', $value['exp_date']);
						break; 
					case '3':
						$value['user_type_nice'] = "Three Month"; 
				        $value['exp_date']  = $row['dduser_exp_date'];  
				        $value['exp_date_formatted'] = "expires " . date('Y-m-d', $value['exp_date']);      
						if ( $value['exp_date_formatted'] >= $today ) {
							$value['valid_member'] = 1; 
						}
						$value['exp_date_text'] = date('dS F Y', $value['exp_date']);
						break; 
					case 'db':
						$value['user_type_nice'] = "Days Bought";
						$value['days_bought'] = $row['dduser_days_bought']; 
						$select = "select count(DISTINCT dduserdate_date) as used_days from dduserdate where dduser_id = '".$value['dduser_wp_key']."'";
						$result = mysqli_query($link, $select) ;
						if (mysqli_num_rows($result) > 0){
							$rowdays = mysqli_fetch_array($result);
							$value['days_used'] = $rowdays['used_days'];
						}
						$value['days_left'] = $value['days_bought'] - $value['days_used'];
						if ( $value['days_left'] >= 0 ) {
							$value['valid_member'] = 1; 
							$value['exp_date_text'] = $value['days_left']  ." of ".$value['days_bought']." days remaining";
						} else {
							$value['exp_date_text'] = "0  days remaining";
						}

						break; 
					default:
						$value['user_type_nice'] = "UNKNOWN";
						$value['valid_member'] = 0;  /* Not a valid member */
						break;

				}
		}
		mysqli_close($link);
	}
	return $value;
} 



/* Is it a paid user?  ----  PLACEHOLDER */
function dgHasUserPaid() {

	$user_info = dgGetAccountStatus();

	return $user_info['valid_member'];
}

/* How Many Days Left?  ----  PLACEHOLDER */
function dgHowManyDaysLeft() {

	$value = dgGetAccountStatus();

	return $value['days_left'];
}

/* Update the membership - it has been used today  ----  PLACEHOLDER */
function dgMembershipUsed() {

	// PLACEHOLDER - UPDATE MEMBERSHIP / DAYS LEFT 
	
	return 1;
}

/* Add a number of days to the user's account */
function add_days_bought_NEW(){
   $current_user = wp_get_current_user();
   $wp_user = $current_user->user_login;
   $link = getDBLink();
   $select = "select dduser_type, dduser_exp_date, dduser_days_bought from dduser where dduser_id = '$wp_user'";
 //  echo "<BR>$select";
   $result = mysqli_query($link, $select) ;
   if (mysqli_num_rows($result) > 0){
      while ($row = mysqli_fetch_array($result)){
        $user_type_l = $row[dduser_type];
  //      echo "add days tp " . $user_type_l;
        $exp_date  = $row[dduser_exp_date];
        $days_bought = $row[dduser_days_bought];
      }
      if ($user_type_l == "DB" and $days_bought > 0){
         $date = date("Ymd");
         $insert = "insert into dduserdate (dduser_id, dduserdate_date) values ( '$wp_user', '$date')";
         $result = mysqli_query($link, $insert) ;
    //     echo $insert;
      }
   }


}
/* Update Dingles Games tables with order information */
function mysite_woocommerce_payment_complete( $order_id ) {
	error_log( "----------------- ORDER ----------------- ");
    error_log( "Payment has been received for order $order_id" );
//	error_log( "----------------- ORDER DETAILS ----------------- ");

	/* Get the order details */
	$order = new WC_Order( $order_id );
    $items = $order->get_items();

//	error_log( var_export($order, true));
	
	foreach ( $items as $item ) {
	 
//		error_log( "----------------- ITEM ----------------- ");
//		error_log( var_export($item, true));
	    $product = wc_get_product( $item['product_id'] );
	 
	    // Now you have access to (see above)...
	 
	    $sku = strtoupper($product->get_sku());
		$result = false;
		switch ($sku) {
			case "SKU-L":
				error_log("Lifetime");
				$result = addUpdateMembershipDetails('l');
				break;
			case "SKU-3":
				error_log("Three Months Membership");
				$result = addUpdateMembershipDetails('3');
				break;
			case "SKU-6":
				error_log("Six Months Membership");
				$result = addUpdateMembershipDetails('6');
				break;
			case "SKU-Y":
				error_log("Year Membership");
				$result = addUpdateMembershipDetails('y');
				break;
			case "SKU-DB":
				error_log("Day Brought");
				$result = addUpdateMembershipDetails('DB');
				break;
			default:
				error_log("Non-Membership Product");
				/* This allows non-membership related products to be ordered */
				// $result = true;  
		}

		if ( !$result ) {
			error_log("ERROR on Order");
		    $order->update_status( 'on-hold' );
			wc_add_notice( 'An error has occurred authorising your membership. Please contact Paul(at)DinglesGames.com.', 'error' );
		}

	}
	return $result;

}
add_action( 'woocommerce_payment_complete', 'mysite_woocommerce_payment_complete', 10, 1 );


function addUpdateMembershipDetails($memType ) {

	error_log("----------------- Updating Membership  -----------------");

	$success = false;
	$days = 0;
	$startDate = time();

	

	$current_user = wp_get_current_user();
	$data = array();
	$data['wp_user'] = $current_user->user_login;
	$data['wp_user_key'] = $current_user->ID;
	$data['user_type'] = "";
	$data['exp_date'] = "";
	$data['days_bought'] = "";
	$data['user_type'] = $memType;

	$user_info = dgGetAccountStatus();

	if ( $user_info['has_dduser'] == 1 ) {
		// Already got a user record
		// What now depends on their current record.
		if ( $user_info['user_type'] != "l" ) {
			// Not a Lifetime member

			if ( $user_info['user_type'] != 'DB' && $data['user_type'] != 'DB' ) {
				// Currently not a Days Bought and buying something other than DB so update expiry date etc
				if ( $user_info['valid_member'] == 1 ) {
					// Still a current member so extend membership
					$startDate = $user_info['exp_date'];
				} 
			} else if ($data['user_type'] == 'DB')  {
				// Set days bought
				if ( $user_info['days_left'] > 0 ) {
					$days = $user_info['days_left'];
				}
			} else { 
				// Should never get here
			}

		} else {
			// Lifetime member. No need to update 
		}
	}

	switch ($data['user_type']) {
		case "l":
        	$data['exp_date'] = $startDate + (60*60*24*365 * 120);
			break;
		case  "y":
			$days = 365;
			$data['exp_date'] = $startDate + (60*60*24*$days);
			break;
		case "6":
			$days = 183;
			$data['exp_date'] = $startDate + (60*60*24*$days);
			break;
		case "3":
			$days = 92;
			$data['exp_date'] = $startDate + (60*60*24*$days);
			break;
		case "w":
			$days = 7;
			$data['exp_date']  = $startDate + (60*60*24*$days);
			break;
		case "DB" :
			$days = $days + 30;
			$data['days_bought'] = $days;
			break;
		default:
			/* UNKNOWN - Something is wrong */
			return $success;
   }

	error_log(var_export($data,1));

	$link = getDBLink();
	if ($user_info['has_dduser'] == 1 ) {
		// Update record
		$query = "update dduser set dduser_wp_key = '".$data['wp_user']."', dduser_type = '".$data['user_type']."', dduser_exp_date = '".$data['exp_date']."', dduser_days_bought = '".$data['days_bought']."' WHERE dduser_id = '".$data['wp_user']."'";
	} else {
		// New ddRecord Required
			$query = "insert into dduser (dduser_id, dduser_wp_key, dduser_type, dduser_mon_created, dduser_last_date, dduser_exp_date, dduser_days_bought) ";
			$query .= " VALUES ('".$data['wp_user']."', '".$data['wp_user_key']."', '".$data['user_type']."', '0', '".time()."', '".$data['exp_date']."', '".$data['days_bought']."')";
	}		

	error_log($query);
	$queryRes = mysqli_query($link, $query) ;
	error_log($queryRes);

	if ( !$queryRes ) {
		// Database error
		$success = false;
	} else {
		$success = true;
	}

	return $success;

}

/* Add a record to dduserdate to track days bought useage */
function add_days_bought(){

	$result = false;

	$user_info = dgGetAccountStatus();

	if ($user_info['user_type'] == "DB" and $user_info['days_bought'] > 0){
		$date = date("Ymd");
		$link = getDBLink();
		$insert = "insert IGNORE into dduserdate (dduser_id, dduserdate_date) values ( '".$user_info['wp_user']."', '".$date."')";
		$result = mysqli_query($link, $insert) ;
		if ( !$result ) {
			error_log('Error updating dduserdate table in add_days_bought');
			error_log($insert);
		}
	}

	return $result;

}

?>