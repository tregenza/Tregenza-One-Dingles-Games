<?php
/*  

	Page 2013 - Animal Companion Generator - Pathfinder


*/

        global $key_1, $user_id, $wp_user, $savemon_key;
	$msg = "";

        $status = "";
        if  (isset($_POST[ "status" ])){
            $status = $_POST[ "status" ];
        }

     //     echo "in 2013 $status";

	if ($status == "NEW" ) {
		// Select Monster page but not vetted
                require_once(locate_template('library/ddglobal.php'));
		$msg = vetSelectMonsterForm();
		$status = $_POST[ "status" ];
//		echo "msg = $msg";

	}

	if ($status == ""  or  $status != "VETTED" ) {
		// Not Vetted - Either brand new Select Monster or the vetting failed
		// Select Monster Stage
                $focus1 = "focus1";
		$focus2 = "focus1";
                require_once(locate_template('library/ddglobal.php'));
        //        require_once(locate_template('library/pathselectNPC.php'));
		require_once(locate_template('library/pathSelectAnimalComp.php'));

	} else {

		// Vetted Monster so load the Display Monster page
		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Plain Text Version"){
               //pds 23/11/2010       require( $workingPath."/dddismonprint.php");
			require_once(locate_template('library/pathdismonprint.php'));
		}else{
    		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
            	            require_once(locate_template('library/shortdismonprint.php'));
			}else{
                            require_once(locate_template('library/ddglobal.php'));
			    require_once(locate_template('library/pathdisNPC.php'));
			}
		}
	}

?>

