<!-- Toolpage 260 Start -->
<?php
/*

	Page 260 - NPC Generator - Pathfinder


*/      

$msg = "";
$status = checkPageStatus();

switch ($status) {
	case "NEW" : 
		// Select Monster page but not vetted
		$msg = vetSelectMonsterForm();
				// NPC Form
		require_once(locate_template('library/ddglobal.php'));
		require_once(locate_template('library/pathdisNPC.php'));
		break;
	case "VETTED" :
		// Valid NPC
		if (isset($_POST["print_ind"])) {
				// Output 
			require_once(locate_template('library/dgNPCOutput.php'));
	 } else {
				// NPC Form
			require_once(locate_template('library/ddglobal.php'));
			require_once(locate_template('library/pathdisNPC.php'));
		}	
		break;
	default:
		// Not Vetted - Either brand new Select Monster or the vetting failed
		// Select Monster Stage
  $focus1 = "focus1";
		$focus2 = "focus1";
  require_once(locate_template('library/ddglobal.php'));
		require_once(locate_template('library/pathselectNPC.php'));
		break;	
}


end;

function checkPageStatus() {
	        if (isset($_POST[ "status" ])){
	            $status = $_POST[ "status" ];
	        }else{
	
	          $status = "";
	        }

	return $status;

}
/*

OLD CODE

        if (isset($_POST[ "status" ])){
            $status = $_POST[ "status" ];
 //            echo "status = $status";
        }else{

          $status = "";
        }

	$msg = "";
	global $key_1, $user_id, $wp_user, $savemon_key;
        $key_1 = "path";
	if (isset($_POST[ "status" ]) && $_POST[ "status" ] == "NEW" ) {
		// Select Monster page but not vetted
		$msg = vetSelectMonsterForm();

	}
        if (isset($_POST[ "status" ])){
            $status = $_POST[ "status" ];
//             echo "after vet status = $status";
        }else{
          $status = "";
        }
	if ($status == ""  or $status != "VETTED" ){
		// Not Vetted - Either brand new Select Monster or the vetting failed
		// Select Monster Stage
   	        $focus1 = "focus1";
		$focus2 = "focus1";
                require_once(locate_template('library/ddglobal.php'));
		require_once(locate_template('library/pathselectNPC.php'));

	} else {

		// Vetted Monster so load the Display Monster page
		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Plain Text Version"){
                        require_once(locate_template('library/ddglobal.php'));
			require_once(locate_template('library/pathdismonprint.php'));
		}else{
    		    if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
                       require_once(locate_template('library/ddglobal.php'));
                       require_once(locate_template('library/shortdismonprint.php'));
		    }else{
                       require_once(locate_template('library/ddglobal.php'));
		       require_once(locate_template('library/pathdisNPC.php'));
	           }
		}
	}
*/
?>
<!-- Toolpage 260 END -->