<?php
/*

	Page 1947 - Encounter Generator - Pathfinder


*/
<<<<<<< HEAD
        global $key_1, $user_id, $wp_user, $savemon_key;
=======

>>>>>>> 65450b134015a9177e74559b90657752af789db3

	$msg = "";
	$key_1 = "path";
        if (isset($_POST["edit_ind"])){
            $edit_ind = $_POST["edit_ind"];
        }else{
            $edit_ind = "";
        }
        // print_indx is from pathencounter
        if (isset($_POST["print_indx"])){
            $print_indx = $_POST["print_indx"];
        }else{
            $print_indx = "";
        }
        // print ind is from pathdisNPC
        if (isset($_POST["print_ind"])){
            $print_ind = $_POST["print_ind"];
        }else{
            $print_ind = "";
        }
        if (isset($_POST["encounter"])){
            $encounter = $_POST["encounter"];
        }else{
            $encounter = "";
        }
    //    Pathfinder Encounter Generator                  echo "LOGON PAGE";
<<<<<<< HEAD
    //     echo "<p>edit_ind = $edit_ind print_ind = $print_ind</p>";
=======
>>>>>>> 65450b134015a9177e74559b90657752af789db3
	if ($edit_ind != ""){
           $save_key_r = "save_key_". $_POST["edit_ind"];
           $savemon_key = $_POST["$save_key_r"];
           $_POST["savemon_key"] = $savemon_key;
           if ($encounter != "Y"){
              $encounter = "Y";
<<<<<<< HEAD
               require_once(locate_template('library/ddglobal.php'));
               vetSelectMonsterForm();
           }
           // vetting overides the print in so reset
           if (isset($_POST["print_ind"])){
              $print_ind = $_POST["print_ind"];
           }else{
              $print_ind = "";
           }
           if (isset($_POST["edit_ind"])){
             $edit_ind = $_POST["edit_ind"];
           }else{
             $edit_ind = "";
           }
//echo <<<EOF
//<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
//<INPUT TYPE="hidden" NAME="edit_ind", VALUE="$edit_ind"/>
//<INPUT TYPE="hidden" NAME="encounter", VALUE="$encounter"/>
//EOF;
//            include(locate_template('library/pathdisNPC.php'))
 //            echo "print = $print_ind";
            if ($print_ind == "Plain Text Version" or $print_ind == "Short Text Version"){
                 echo "printing";
                if ($print_ind ==  "Plain Text Version"){
                   include(locate_template('library/pathdismonprint.php'));
                }else{
                     include(locate_template('library/shortdismonprint.php'));
                }

           }else{
//                echo "not";
                include(locate_template('library/pathdisNPC.php'));
           }
=======
               vetSelectMonsterForm();
           }

echo <<<EOF
<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
<INPUT TYPE="hidden" NAME="edit_ind", VALUE="$edit_ind"/>
<INPUT TYPE="hidden" NAME="encounter", VALUE="$encounter"/>
EOF;
            include(locate_template('library/pathdisNPC.php'));
>>>>>>> 65450b134015a9177e74559b90657752af789db3
	} else if ($print_indx != ""){
             $save_key_r = "save_key_". $_POST["print_indx"];
             $savemon_key = $_POST["$save_key_r"];
             $_POST["savemon_key"] = $savemon_key;
             $encounter = "Y";
<<<<<<< HEAD
             require_once(locate_template('library/ddglobal.php'));
=======
>>>>>>> 65450b134015a9177e74559b90657752af789db3
             vetSelectMonsterForm();
             getSaveMon($savemon_monster);
             if ($key_1 == "path"){
                include(locate_template('library/pathdismonprint.php'));
            }else{
                include(locate_template('library/dddismonprint.php'));
            }

    }else{
       if ($print_ind != ""){
           $require = print_ind($print_ind);
<<<<<<< HEAD
           require_once(locate_template('library/ddglobal.php'));
=======
>>>>>>> 65450b134015a9177e74559b90657752af789db3
           include(locate_template('library' . $require));
       }else{
           include(locate_template('library/pathencounter.php'));
       }
    }

?>
