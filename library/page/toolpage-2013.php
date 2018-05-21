<?php
/*  

	Page 2013 - Animal Companion Generator - Pathfinder


*/


	$msg = "";

	if (isset($_POST[ "status" ]) && $_POST[ "status" ] == "NEW" ) {
		// Select Monster page but not vetted
		$msg = vetSelectMonsterForm();

	}

	if (!isset($_POST[ "status" ]) || $_POST["status"] != "VETTED" ) {
		// Not Vetted - Either brand new Select Monster or the vetting failed
		// Select Monster Stage
   	    $focus1 = "focus1";
		$focus2 = "focus1";

		include(locate_template('library/pathSelectAnimalComp.php'));

	} else {

		// Vetted Monster so load the Display Monster page
		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Plain Text Version"){
               //pds 23/11/2010       require( $workingPath."/dddismonprint.php");
			include(locate_template('library/pathdismonprint.php'));
		}else{
    		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
            	include(locate_template('library/shortdismonprint.php'));
			}else{
				include(locate_template('library/pathdisNPC.php'));
			}
		}
	}

?>



