<?php
/*  

	Page 214 - Monster Creator - Delete


*/

	if ($wp_user != "" and $paid_user == "Y"){
		include(locate_template('library/dddeletemon.php'));
	}else{
		echo "You Must Have Paid Membership to use the Monster Creator";
	}

?>