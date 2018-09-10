<?php
/*

	Page 1995 - Monster Creator - Edit - Pathfinder


*/
<<<<<<< HEAD
         global $wp_user, $paid_user;
=======

>>>>>>> 65450b134015a9177e74559b90657752af789db3
         if (isset($_POST["mon_name"])){
             $mon_name = $_POST["mon_name"];
         }else{
             $mon_name ="";
         }

	 if ($wp_user != "" and $paid_user == "Y"){
		if ($mon_name == ""){
			include(locate_template('library/pathchangemon21.php'));
		}else{
			include(locate_template('library/pathchangemon22.php'));
		}
	}else{
		echo "You Must Have Paid Membership to use the Monster Creator";
	}
?>