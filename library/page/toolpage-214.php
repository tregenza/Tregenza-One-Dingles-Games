<?php
/*  

	Page 214 - Monster Creator - Delete


*/

        global $key_1, $user_id, $wp_user, $paid_user;
	if ($wp_user != "" and $paid_user == "Y"){
		include(locate_template('library/dddeletemon.php'));
	}else{
		echo "You Must Have Paid Membership to use the Monster Creator";
	}

?>