<?php
/*  

	Page 1929 - Monster Creator - Add - Pathfinder


<<<<<<< HEAD
*/ 
         global $wp_user, $paid_user;
       
//        echo "wp_user $wp_user paid $paid_user";
=======
*/

>>>>>>> 65450b134015a9177e74559b90657752af789db3
	if ($wp_user != "" and $paid_user == "Y"){
		include(locate_template('library/pathmonster2.php'));
	} else {
		echo "You Must Have Paid Membership to use the Monster Creator";
		echo " paid user " . $paid_user . "wp_user " . $wp_user;
	}

?>