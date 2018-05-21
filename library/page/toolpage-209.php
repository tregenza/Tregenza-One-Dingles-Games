<?php
/*  

	Page 209 - Monster Creator - Add - DnD


*/


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