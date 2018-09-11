<?php
/*  

	Page 83 - Dingles Games Login Page


*/
        global $key_1, $user_id, $wp_user, $savemon_key;
	
	if ( !is_user_logged_in() ) {
		/* USER Not Logged In */
	
		$args = array(
			'echo'           => true,
			'remember'       => true
			);
		
		wp_login_form( $args );
	
	} else {
		$user_info = dgGetAccountStatus();
		
?>
		<div class="ddUserInfo">
			<h3>Hello <?php echo $user_info['wp_user']; ?></h3>		
			<p><label>Current Status</label>  
<?php
			if ( $user_info['valid_member'] != 1 ) {
				echo "Free Membership (Restricted to levels 1 to 5)";
			} else {
				echo "Paid Membership (Full Access)";
			}
			
?>
			</p>
			<p><label>
				Membership Type
			</label>
				<?php echo $user_info['user_type_nice'] ?>
			</p>
			<p><label>
				Expires
			</label>
				<?php echo $user_info['exp_date_text'] ?>
			</p>
			<p><label>
				Monsters Created
			</label>
				<?php echo $user_info['mon_created'] ?>
			</p>

	</div>


<?php


	/* Display logout information */
	echo '<p><a href="'.wp_logout_url( get_permalink() ).'">Logout</a></p>';

}

?>