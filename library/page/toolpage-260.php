<?php
/*  

	Page 260 - NPC Generator - Pathfinder


*/


	$msg = "";
        $key_1 = "path";
	if (isset($_POST[ "status" ]) && $_POST[ "status" ] == "NEW" ) {
		// Select Monster page but not vetted
		$msg = vetSelectMonsterForm();

	}

	if (!isset($_POST[ "status" ]) || $_POST["status"] != "VETTED" ) {
		// Not Vetted - Either brand new Select Monster or the vetting failed
		// Select Monster Stage
   	    $focus1 = "focus1";
		$focus2 = "focus1";

		require_once(locate_template('library/pathselectNPC.php'));

	} else {

		// Vetted Monster so load the Display Monster page
		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Plain Text Version"){
			require_once(locate_template('library/pathdismonprint.php'));
		}else{
    		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
            require_once(locate_template('library/shortdismonprint.php'));
			}else{
				require_once(locate_template('library/pathdisNPC.php'));
			}
		}
	}

?>
