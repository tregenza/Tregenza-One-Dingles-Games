<?php
/*  

	Page 203 - Emcounter Generator - DnD 3.5


*/
        global $key_1, $user_id, $wp_user, $savemon_key;

       $msg = "";
        if (isset($_POST["edit_ind"])){
            $edit_ind = $_POST["edit_ind"];
        }else{
            $edit_ind = "";
        }
        if (isset($_POST["print_indx"])){
            $print_indx = $_POST["print_indx"];
        }else{
            $print_indx = "";
        }
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
//        echo "edit $edit_ind print $print_ind";
        if ($edit_ind != ""){
           $edit_ind = $_POST["edit_ind"];
           $save_key_r = "save_key_". $_POST["edit_ind"];
           $savemon_key = $_POST["$save_key_r"];
           $_POST["savemon_key"] = $savemon_key;
           if ($encounter != "Y"){
              $encounter = "Y";
              require_once(locate_template('library/ddglobal.php'));
              vetSelectMonsterForm();
           }

echo <<<EOF
<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
<INPUT TYPE="hidden" NAME="edit_ind", VALUE="$edit_ind"/>
<INPUT TYPE="hidden" NAME="encounter", VALUE="$encounter"/>
EOF;
		include(locate_template('library/dddisNPC.php'));
	} else if ($print_indx != "") {
                 $save_key_r = "save_key_". $_POST["print_indx"];
                 $savemon_key = $_POST["$save_key_r"];
                 $_POST["savemon_key"] = $savemon_key;
                 $encounter = "Y";
                 require_once(locate_template('library/ddglobal.php'));
                 vetSelectMonsterForm();

                getSaveMon($savemon_monster);

                if ($key_1 == "path"){
                    require_once(locate_template('library/ddglobal.php'));
                   include(locate_template('library/pathdismonprint.php'));
                } else{
                   require_once(locate_template('library/ddglobal.php'));
                   include(locate_template('library/dddismonprint.php'));
                }

        } else {
                if ($print_ind != ""){
                    $require = print_ind($print_ind);
                     require_once(locate_template('library/ddglobal.php'));
                    include(locate_template('library' . $require));
                }else{
                     include(locate_template('library/ddencounter.php'));
                }
	}




?>


