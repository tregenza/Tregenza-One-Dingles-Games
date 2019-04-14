<?php
/**
*
*	Custom WooCommerce functionality for Dingles Games
* loaded via functions.php. 
*
*/

/********** START - General Config **********/

	
	/* Change Terminology */
	function custom_strings( $translated_text, $text, $domain ) {
	
		if ($domain === "woocommerce" ) {
			switch ( $translated_text ) {
				case 'Checkout' : 
					$translated_text =  "Buy Membership"; 
					break;
			}
		}
	
	  return $translated_text;
	}
	add_filter('gettext', 'custom_strings', 20, 3);

/* Relabel Add to Cart buttons */		
function tregenza_one_rename_add_to_cart() {
	return __('Buy Now', 'woocommerce');
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'tregenza_one_rename_add_to_cart');
add_filter( 'woocommerce_product_add_to_cart_text', 'tregenza_one_rename_add_to_cart');

		
	/* Disable prices on dropdowns */
	function wt_composite_dropdown_price_true() {
		return true;
	}
	add_filter( 'woocommerce_composite_component_option_prices_hide', 'wt_composite_dropdown_price_true' );
	
	
	/* Hide related products on product page */
//	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	

/*  Redirect so Add To Cart sends the user to the checkout */
/*  Note: Needs the "Add To Cart Behaviour" settings in Woocommerce / Settings / Products to NOT redirect to cart page */
function tregenza_one_add_redirect() {
		global $woocommerce;
		$checkout_url = wc_get_checkout_url();
		return $checkout_url;
}
add_filter('woocommerce_add_to_cart_redirect', 'tregenza_one_add_redirect');	


/********** END- General Config **********/


/****


	NOTE:  A lot of this PHP file relates to adding fields to billing and shiiping address. 
	Unfortunently woocommerce does make this easy and there is different code / hooks / filters for all the different ways
	woocommerce us them. 

	*Standard WooCommerce Billing Fields*
    billing_first_name
    billing_last_name
    billing_company
    billing_address_1
    billing_address_2
    billing_city
    billing_postcode
    billing_country
    billing_state
    billing_email
    billing_phone


	*Dingles Games Changes *
	Hide/remove address fields


****/

/********* START - Woocommerce Accounts / Account Pages *********/
	/**
  * Edit my account menu order
		*
 */
 function my_account_menu_order() {
		 	$menuOrder = array(
		 		'dashboard'          => __( 'My Account', 'woocommerce' ),
		 		'saved_monsters'             => 'Saved Monsters / NPCs' ,
		 		'orders'             => __( 'Orders', 'woocommerce' ),
/*		 		'downloads'          => __( 'Download', 'woocommerce' ), */
/*		 		'edit-address'       => __( 'Addresses', 'woocommerce' ), */
		 		'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
		 		'customer-logout'    => __( 'Logout', 'woocommerce' ),
		 	);
		 	return $menuOrder;
	 }
 add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );

	/**
  * Register new endpoints to use inside My Account page.
		*
  */
 function my_account_new_endpoints() {
	 	add_rewrite_endpoint( 'saved_monsters', EP_ROOT | EP_PAGES );
		flush_rewrite_rules();
 }
 add_action( 'init', 'my_account_new_endpoints' );

	/**
  * Get new endpoint content
  */
 function saved_monsters_endpoint_content() {
			require_once(locate_template('dgLibrary/dgUtilityFunctions.php'));	
			require_once(locate_template('dgLibrary/dgUtilityDataFunctions.php'));	
			require_once(locate_template('dgLibrary/dgUtilityHTMLFunctions.php'));			

			$dgTools = initDGTools();
			dgLoad($dgTools, "dgNPCDataFunctions");
			dgLoad($dgTools, "dgNPCSelectHTMLFunctions");
			$html =  getLoadSavesHTML($dgTools);
			echo $html;
 }
 add_action( 'woocommerce_account_saved_monsters_endpoint', 'saved_monsters_endpoint_content' );


	/* Dingles specific code for dashboard page */
	remove_filter('woocommerce_account_dashboard', 'action_woocommerce_account_dashboard');

	function dg_dashboard() { 
			$user_info = dgGetAccountStatus();

			if ( $user_info['valid_member'] != 1 ) {
							$memStatus = "Free Membership (Restricted to levels 1 to 5)";
			} else {
							$memStatus = "Paid Membership (Full Access)";
			}						
			?>
					<div class="dg_dashboard">
						<h3>Hello <?php echo $user_info['wp_user']; ?></h3>		
						<dl>
						<dt>Current Status</dt>
						<dd><?php echo $memStatus ?></dd>
						<dt>Membership Type</dt>
						<dd><?php echo $user_info['user_type_nice'] ?></dd>
						<dt>Expires</dt>
						<dd><?php echo $user_info['exp_date_text'] ?></dd>
						<dt>Monsters Created</dt>
						<dd><?php echo $user_info['mon_created'] ?></dd>
						</dl>
				</div>
			<?php
			
	}
	add_filter('woocommerce_account_dashboard', 'dg_dashboard', 20);

	


/********* END - Woocommerce Accounts / Account Pages *********/


/********** START - Registration Fields / Forms **********/

/** 
	Woocommerce doesn't provide any convient hooks / functions to manage the registration form other than a couple in form-login.php so html and 
	code for validation of the extra fields needs to be done manually.
	The validation is very basic (an is it there check only) but data will be validated properly when the user places an order. 

*/

/**
* Add new fields to WooCommerce registration pages.
*/
function wooc_extra_register_fields() {
?>
<?php 
}
//add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );


/**
* Validate the extra register fields.
*/
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {

}
//add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
* Save the extra register fields.
*/
function wooc_save_custom_fields( $customer_id ) {
}
//add_action( 'woocommerce_created_customer', 'wooc_save_custom_fields', 20, 1 );

/********** END- Registration Fields / Forms **********/





/********** START - Checkout / Shipping fields & Forms **********/

/**
*
*		It is relatively easy to ammend / add fields on the checkout forms for billing & shipping addresses. It
*		also haddles validation.
*
*
*/

	

	/*** Customer Shipping  ***/
	function custom_checkout_fields($fields) {

	}
//	add_filter('woocommerce_checkout_fields','custom_checkout_fields');
//	add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true');  /* Always shipping to different addess. CSS hide's checkbox */ 

/********** END - Checkout / Shipping fields & Forms **********/