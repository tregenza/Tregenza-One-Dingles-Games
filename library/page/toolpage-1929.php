<?php
/*  

	Page 1929 - Monster Creator - Add - Pathfinder


*/

	if ($wp_user != "" and $paid_user == "Y"){
		include(locate_template('library/pathmonster2.php'));
	} else {
		echo "You Must Have Paid Membership to use the Monster Creator";
		echo " paid user " . $paid_user . "wp_user " . $wp_user;
	}

?>