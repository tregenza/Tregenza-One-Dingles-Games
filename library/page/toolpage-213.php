<?php
/*

	Page 213 - Monster Creator - Edit - DnD


*/

<<<<<<< HEAD
     global $key_1, $user_id, $wp_user, $savemon_key;
=======

>>>>>>> 65450b134015a9177e74559b90657752af789db3

     if ($wp_user != "" and $paid_user == "Y"){
             if (!isset($_POST['mon_name'])){
                  $_POST['mon_name'] = "";
             }
	     if ($_POST['mon_name'] == ""){
	         include(locate_template('library/ddchangemon21.php'));
	     }else{
                 include(locate_template('library/ddchangemon22.php'));
	     }
     }else{
	     echo "You Must Have Paid Membership to use the Monster Creator";
     }

?>