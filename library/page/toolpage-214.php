<?php
/*  

	Page 214 - Monster Creator - Delete


*/

<<<<<<< HEAD
        global $key_1, $user_id, $wp_user, $paid_user;
=======
>>>>>>> 65450b134015a9177e74559b90657752af789db3
	if ($wp_user != "" and $paid_user == "Y"){
		include(locate_template('library/dddeletemon.php'));
	}else{
		echo "You Must Have Paid Membership to use the Monster Creator";
	}

?>