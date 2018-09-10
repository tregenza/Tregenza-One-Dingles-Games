<?php
<<<<<<< HEAD

/*
=======
/*  
>>>>>>> 65450b134015a9177e74559b90657752af789db3

	Page 260 - NPC Generator - Pathfinder


<<<<<<< HEAD
*/      

        if (isset($_POST[ "status" ])){
            $status = $_POST[ "status" ];
 //            echo "status = $status";
        }else{

          $status = "";
        }

	$msg = "";
	global $key_1, $user_id, $wp_user, $savemon_key;
=======
*/


	$msg = "";
>>>>>>> 65450b134015a9177e74559b90657752af789db3
        $key_1 = "path";
	if (isset($_POST[ "status" ]) && $_POST[ "status" ] == "NEW" ) {
		// Select Monster page but not vetted
		$msg = vetSelectMonsterForm();

	}
<<<<<<< HEAD
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
=======

	if (!isset($_POST[ "status" ]) || $_POST["status"] != "VETTED" ) {
		// Not Vetted - Either brand new Select Monster or the vetting failed
		// Select Monster Stage
   	    $focus1 = "focus1";
		$focus2 = "focus1";

>>>>>>> 65450b134015a9177e74559b90657752af789db3
		require_once(locate_template('library/pathselectNPC.php'));

	} else {

		// Vetted Monster so load the Display Monster page
		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Plain Text Version"){
<<<<<<< HEAD
                        require_once(locate_template('library/ddglobal.php'));
			require_once(locate_template('library/pathdismonprint.php'));
		}else{
    		    if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
                       require_once(locate_template('library/ddglobal.php'));
                       require_once(locate_template('library/shortdismonprint.php'));
		    }else{
//                      echo '<script language="javascript">';
//        echo "var status = document.getElementById('status')";
//                    echo 'alert("calling pathdisNPC")';
//                   echo '</script>';
                       require_once(locate_template('library/ddglobal.php'));
		       require_once(locate_template('library/pathdisNPC.php'));
	           }
=======
			require_once(locate_template('library/pathdismonprint.php'));
		}else{
    		if (isset($_POST["print_ind"]) && $_POST["print_ind"] == "Short Text Version"){
            require_once(locate_template('library/shortdismonprint.php'));
			}else{
				require_once(locate_template('library/pathdisNPC.php'));
			}
>>>>>>> 65450b134015a9177e74559b90657752af789db3
		}
	}

?>
