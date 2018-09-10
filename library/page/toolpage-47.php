<?php
/*  

	Page 47 - NPC Generator - DND 3.5


*/
<<<<<<< HEAD
        if (isset($_POST[ "status" ])){
            $status = $_POST[ "status" ];
 //            echo "status = $status";
        }else{

          $status = "";
        }

	$msg = "";
	global $key_1, $user_id, $wp_user, $savemon_key;
        $key_1 = "dd35";

=======


	$msg = "";
>>>>>>> 65450b134015a9177e74559b90657752af789db3

	if (isset($_POST[ "status" ]) && $_POST[ "status" ] == "NEW" ) {
		// Select Monster page but not vetted
		$msg = vetSelectMonsterForm();

	}

	if (!isset($_POST[ "status" ]) || $_POST["status"] != "VETTED" ) {
		// Not Vetted - Either brand new Select Monster or the vetting failed
		// Select Monster Stage
   	    $focus1 = "focus1";
		$focus2 = "focus1";
<<<<<<< HEAD
		 require_once(locate_template('library/ddglobal.php'));
=======
>>>>>>> 65450b134015a9177e74559b90657752af789db3
		include(locate_template('library/selectNPC.php'));
	} else {

		// Vetted Monster so load the Display Monster page
		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Plain Text Version"){
               //pds 23/11/2010       require( $workingPath."/dddismonprint.php");
<<<<<<< HEAD
                          require_once(locate_template('library/ddglobal.php'));
			include(locate_template('library/pathdismonprint.php'));
		}else{
    		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
                  require_once(locate_template('library/ddglobal.php'));
                  include(locate_template('library/shortdismonprint.php'));
			}else{
                                require_once(locate_template('library/ddglobal.php'));
=======
			include(locate_template('library/pathdismonprint.php'));
		}else{
    		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
            	include(locate_template('library/shortdismonprint.php'));
			}else{
>>>>>>> 65450b134015a9177e74559b90657752af789db3
				include(locate_template('library/dddisNPC.php'));
			}
		}
	}

?>