<?php
 global $wp_user, $user_id, $paid_user, $key_1, $savemon_key;
/*   monsters saved */
//echo "XXXXXXXXXX in 199";
$urlPATH = "/tools/monsters-saved";
$edit_ind = "";
if (isset($_POST["edit_ind"])){
   $edit_ind = $_POST["edit_ind"];
}
$print_ind = "";
if (isset($_POST["print_ind"])){
   $print_ind = $_POST["print_ind"];
}
//echo "print_ind $print_ind edit_ind $edit_ind ";
if ($edit_ind != ""){
//   $edit_ind = $_POST["edit_ind"];
   $save_key_r = "save_key_". $edit_ind;
   $savemon_key = $_POST["$save_key_r"];
    require_once(locate_template('library/ddglobal.php'));
   vetSelectMonsterForm();
// edit ind and prind ind will get overrriden in vet
   if (isset($_POST["edit_ind"])){
      $edit_ind = $_POST["edit_ind"];
  }
  if (isset($_POST["print_ind"])){
      $print_ind = $_POST["print_ind"];
  }
//                           echo "savemon_key " . $savemon_key;
   $_POST["savemon_key"] = $savemon_key;
   $_POST[$save_key_r] = $savemon_key;
   $_POST["edit_ind"] = $edit_ind;
echo <<<EOF
<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
<INPUT TYPE="hidden" NAME="edit_ind", VALUE="$edit_ind"/>
EOF;
//echo "key_1  = $key_1 savemon_key = $savemon_key";
       if ($print_ind == "Plain Text Version" or $print_ind == "Short Text Version"){
                 echo "printing";
                if ($print_ind ==  "Plain Text Version"){
                    if ($key_1 == "path"){
                       include(locate_template('library/pathdismonprint.php'));
                    }else{ 
                       include(locate_template('library/dddismonprint.php'));
                    }
                }else{
                     include(locate_template('library/shortdismonprint.php'));
                }

         } else{
             if ($key_1 == "path"){
                 include(locate_template('library/pathdisNPC.php'));
             }else{
                 include(locate_template('library/dddisNPC.php'));
             }
         }
}else if ($print_ind != ""){
//                            $urlPATH = "/tools/NPCGenerator/dnd35";
    $save_key_r = "save_key_". $_POST["print_ind"];
    $savemon_key = $_POST["$save_key_r"];
//                            echo "save key " . $savemon_key;
    $_POST["savemon_key"] = $savemon_key;
     require_once(locate_template('library/ddglobal.php'));
    vetSelectMonsterForm();
    $savemon_camp_s = $savemon_camp;
    $savemon_sub_s = $savemon_sub;
    $savemon_name_s = $savemon_name;
//                            echo $savemon_monster;
    getSaveMon($savemon_monster);
    $savemon_camp = $savemon_camp_s;
    $savemon_sub = $savemon_sub_s;
    $savemon_name = $savemon_name_s;
/*
                            parse_str($savemon_monster,$monster_a);
                            foreach ($monster_a as $k => $v) {
                               $v = trim($v) ;
                               $v = str_replace("¬", "+", $v);
                               $$k = $v ;
//        echo $k .  "= " .$v . "<BR></BR>";
                            }
*/

    if ($key_1 == "path"){

        include(locate_template('library/pathdismonprint.php'));
    }else{
          //pds 23/11/2010
        include(locate_template('library/dddismonprint.php'));
            //                   require( $workingPath."/pathdismonprint.php");
        }
}else{
 //  require( $workingPath."/ddsaveedit.php");
   include(locate_template('library/ddsaveedit.php'));
}
?>