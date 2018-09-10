<?php
/*  

	Page 209 - Monster Creator - Add - DnD


*/
<<<<<<< HEAD
         global $key_1, $user_id, $wp_user, $paid_user;
=======

>>>>>>> 65450b134015a9177e74559b90657752af789db3

	if ($wp_user != "" and $paid_user == "Y"){
		if ($wp_user == 'path'){
			include(locate_template('library/pathmonster2.php'));
		}else{
			include(locate_template('library/ddmonster2.php'));
		}
	}else{
		echo "You Must Have Paid Membership to use the Monster Creator";
	}


?>