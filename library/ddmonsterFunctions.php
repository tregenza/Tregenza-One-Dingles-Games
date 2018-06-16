<?php
/***
*
*	Functions for Monster generator
*
*				Important!!!! 
*				Any variables set when this file is loaded (not in functions) 
*				needs to be added to the query_var 'dg_vars' to make them avaiable
*				to Dingle Games /library/ code.
*
*/

$ddmonsterFunctions = "Y";

if(dgHasUserPaid() == 1){
   $paid_user = "Y";
}else{
   $paid_user = "";
}

$args = array(
								'paid_user' => $paid_user,		/* PAUL - All code using this var should be replaced with a called to dgHasUserPaid() */
								'ddmonsterFunctions' => $ddmonsterFunctions,
							);
set_query_var( 'dg_vars', $args);



$current_user = wp_get_current_user();
$wp_user = $current_user->user_login;







if (isSet($_COOKIE['dd_user_id'])){
   $user_id = $_COOKIE['dd_user_id'];
}

function populateHelp() {
  global $key_1, $class1_psi, $class2_psi;
//  echo "class1_psi " . $class1_psi;
   if ($key_1 == ""){
       $key_1 = "dd35";
   }

   $link = getDBLink();

   $select = "select * from feathelp5 where mon_key_1 = '$key_1' order by feat_name, featattr_type, featattr_id ";


 //  echo $select;
/* OLD CODE CT - 13/6/18
   echo "<script>" . "\n";
   $result = mysqli_query($link, $select) ;
   $feat_name_old = "";
   $count = 0;
   while ($row = mysqli_fetch_array($result)){
      $count +=1;
      $feat_name = $row['feat_name'];
      if ($feat_name != ""){
        $feat_desc = $row['feat_desc'];
        $feat_desc = str_replace("\n","\\n", $feat_desc);
        $feat_desc = str_replace("\r","\\n", $feat_desc);
        $feat_desc = str_replace('"'," ", $feat_desc);

        $feat_type = $row['featattr_type'];
        $feat_id = $row['featattr_id'];
        $feat_rfeat = $row['featattr_rfeat'];
        $feat_no = $row['featattr_no'];
        $feattype_desc = $row['feattype_desc'];
        if ($feat_type == "RMONTP" or $feat_type == "RCLASS"){
           $feat_id = "";
        }
        if ($feat_name_old != $feat_name){
          if ($feat_name_old != ""){
             echo "var $feat_name_v =" . '"' . $$feat_name_v . '"' . ";" . "\n";
          }
          $feat_name_v = str_replace(" ", "_",$feat_name);
          $feat_name_v = str_replace(",", "_",$feat_name_v);
          $feat_name_v = str_replace("'", "_",$feat_name_v);
          $feat_name_v = str_replace("(", "_",$feat_name_v);
          $feat_name_v = str_replace("-", "_",$feat_name_v);
          $feat_name_v = str_replace("+", "_",$feat_name_v);
          $feat_name_v = str_replace("*", "_",$feat_name_v);
          $feat_name_v = str_replace(")", "_",$feat_name_v) ."_h";
          global $$feat_name_v;
          $$feat_name_v = $feat_name ." " . $feat_desc . "\\n";
          $feat_name_old = $feat_name;
        }
        $$feat_name_v .=  " " . $feattype_desc . " " .  $feat_id . " " . $feat_rfeat ." " . $feat_no . "\\n";
        if ($count == 10){
           $count = 1;
           echo   "</script><script>" . "\n";
        }
      }  
   }
   echo "</script>" . "\n";

*/

/* New - CT */	
			$scriptOutput = "";
   $result = mysqli_query($link, $select) ;
   $feat_name_old = "";
   $count = 0;
   while ($row = mysqli_fetch_array($result)){
      $count +=1;
      $feat_name = $row['feat_name'];
      if ($feat_name != ""){
        $feat_desc = $row['feat_desc'];
        $feat_desc = str_replace("\n","\\n", $feat_desc);
        $feat_desc = str_replace("\r","\\n", $feat_desc);
        $feat_desc = str_replace('"'," ", $feat_desc);

        $feat_type = $row['featattr_type'];
        $feat_id = $row['featattr_id'];
        $feat_rfeat = $row['featattr_rfeat'];
        $feat_no = $row['featattr_no'];
        $feattype_desc = $row['feattype_desc'];
        if ($feat_type == "RMONTP" or $feat_type == "RCLASS"){
           $feat_id = "";
        }
        if ($feat_name_old != $feat_name){
          if ($feat_name_old != ""){
             $scriptOutput .= "var $feat_name_v =" . '"' . $$feat_name_v . '"' . ";" . "\n";
          }
          $feat_name_v = str_replace(" ", "_",$feat_name);
          $feat_name_v = str_replace(",", "_",$feat_name_v);
          $feat_name_v = str_replace("'", "_",$feat_name_v);
          $feat_name_v = str_replace("(", "_",$feat_name_v);
          $feat_name_v = str_replace("-", "_",$feat_name_v);
          $feat_name_v = str_replace("+", "_",$feat_name_v);
          $feat_name_v = str_replace("*", "_",$feat_name_v);
          $feat_name_v = str_replace(")", "_",$feat_name_v) ."_h";
          global $$feat_name_v;
          $$feat_name_v = $feat_name ." " . $feat_desc . "\\n";
          $feat_name_old = $feat_name;
        }
        $$feat_name_v .=  " " . $feattype_desc . " " .  $feat_id . " " . $feat_rfeat ." " . $feat_no . "\\n";
        if ($count == 10){
           $count = 1;
        }
      }  
   }



		/* Capture dynmically generated JS*/
		$resultJS = 	wp_add_inline_script( 'dgJS', $scriptOutput);			/* add it to static JS loaded via the functions.php */
	
		if ( ! $resultJS ) {
			error_log("Dynamic JS failed to load in ddmonsterFunctions.php");	
			die;
		}
/* New - CT - END */



}

function check_feat($feat){

  $errortxt = "";
  global $mon_name, $mon_int,$mon_dex,$mon_wis,$mon_con, $mon_chr, $mon_str, $mon_level, $class1_level, $class2_level, $mon_ac_flat,
         $class1_tp, $class2_tp, $attnum1, $mon_base_att, $user, $caster, $mon_type, $mon_speed_fly, $key_1,
         $mon_int_m,$mon_dex_m,$mon_wis_m,$mon_con_m, $mon_chr_m, $mon_str_m,$epic_count, $epic_feat_max, $wp_user,
         $class3_tp, $class3_level, $help_ok, $tem_level,$mon_weap_p, $mon_weap_s1, $mon_shield,
         $class1_spell_list_1,  $class1_spell_list_2,  $class2_spell_list_1,  $class2_spell_list_2;
  if ($key_1 == ""){
       $key_1 = "dd35";
   }
  $select =  "select feat_char_spec from feats2 where feat_name = '$feat' and mon_key_1 = '$key_1'";
  $link = getDBLink();
  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $feat_char_spec = $row['feat_char_spec'];
  $total_level = $mon_level + $class1_level + $class2_level + $tem_level;
  $feat_ok ="";
  $help_ok = "";
  $rclass_tp = "";
  if ($feat_char_spec == "EPIC" ){
      if ($total_level < 21){
          $errortxt .= "Feat $feat requires total hit dice above 21";
      }else{
          if ($epic_count >= $epic_feat_max){
//             echo "</BR>$feat epic count $epic_count epic_feat_max $epic_feat_max";
//             $epic_count +=1;
              $errortxt .= "Feat $feat to many epic feats selected max = $epic_feat_max" ;
          }
      }
  }
  // Check for monk and ranger class feats
  if ($class1_tp == "Monk" or $class1_tp == "Ranger" or $class1_tp == "Unchained Monk"){
    $select = "select classfeat_level from classfeats2 where classfeat_class = '$class1_tp' and classfeat_feat = '$feat' ".
              "and mon_key_1 = '$key_1'";
    $result = mysqli_query($link, $select) ;
    if (mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      $classfeat_level = $row['classfeat_level'];

      if ($class1_level >= $classfeat_level and $feat_char_spec != "EPIC"){
         $feat_ok = "Y";
       //  echo "$feat,";
      }
    }
  }
  if ($class2_tp == "Monk" or $class2_tp == "Ranger" or $class2_tp == "Unchained Monk"){
    $select = "select classfeat_level from classfeats2 where classfeat_class = '$class2_tp' and classfeat_feat = '$feat' ".
              "and mon_key_1 = '$key_1'";
    $result = mysqli_query($link, $select) ;
    if (mysqli_num_rows($result) > 0){
       $row = mysqli_fetch_array($result);
       $classfeat_level = $row['classfeat_level'];
       if ($class2_level >= $classfeat_level and $feat_char_spec !="EPIC"){
          $feat_ok = "Y";
       }
    }
  }


  if ($feat_ok ==""){
    $selectx = "select featattr_no, featattr_type, featattr_feat,featattr_rfeat from featattr2 " .
                "where featattr_feat = '$feat' and mon_key_1 = '$key_1' order by featattr_type";

  // include 'includes/dd_db_conn.txt';
    $link = getDBLink();


    $resultx = mysqli_query($link, $selectx) ;
     while ($rowx = mysqli_fetch_array($resultx)){
          $featattr_no   = $rowx['featattr_no'];
          $featattr_type = $rowx['featattr_type'];
          //echo $featattr_type;
          if ($featattr_type == "RINT"){
             if ($mon_int < $featattr_no){
                 if ($class1_tp == "Swashbuckler" or  $class2_tp ==  "Swashbuckler"){
                    if ($mon_chr <  $featattr_no){
                       $errortxt = $errortxt . "<p>Feat $feat requires a Int or Cha of $featattr_no</p>";
                    }
                 }else{
                  $errortxt = $errortxt . "<p>Feat $feat requires a Int of $featattr_no</p>";
                }
             }
          }
          if ($featattr_type == "RDEX"){
          //   if ($wp_user == "admin"){
               // echo "$mon_dex, $mon_dex_m";
          //   }
             if (($mon_dex + $mon_dex_m) < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Dex of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RWIS"){
             if (($mon_wis + $mon_wis_m) < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Wis of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RCON"){
             if (($mon_con + $mon_con_m) < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Con of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RCHR"){
             if (($mon_chr + $mon_chr_m) < $featattr_no){
                 $errortxt = $errortxt . "<p>Feat $feat requires a Chr of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RSTR"){
             if (($mon_str + $mon_str_m) < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Str of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RMONSTER"){
             if ($mon_type == "Humanoid" and $mon_ac_flat == "10"){
                $help_ok = "N";
                $errortxt = $errortxt . "<p>Feat $feat is not applicable to humanoids</p>";
             }
          }
          if ($featattr_type == "RFLY"){
             if ($mon_speed_fly == 0){
                $errortxt = $errortxt . "<p>Feat $feat requires a fly speed</p>";
                 $help_ok = "N";
             }
          }
          if ($featattr_type == "RLEVEL"){
             $level_calc = "";
             if ($rclass_tp == "Fighter"){
                if ($class1_tp == "Magus"){
                    $level_calc = $class1_level /2;
                    if ($class2_tp == "Fighter" or  $class2_tp  == "Cavalier" or $class2_tp  == "Samurai" or
                       $class2_tp  == "Psychic Warrior"){
                       $level_calc += $class2_level;
                    }
                }
                if ($class2_tp == "Magus"){
                    $level_calc = $class2_level /2;
                    if ($class1_tp == "Fighter" or  $class1_tp  == "Cavalier" or  $class2_tp  == "Samurai" or
                        $class1_tp  == "Psychic Warrior"){
                        $level_calc += $class1_level;
                    }
                 }
                 if ($class1_tp == "Samurai"){
                    $level_calc = $class1_level;
                    if ($class2_tp == "Fighter" or  $class2_tp  == "Cavalier" or $class2_tp  == "Samurai" or
                       $class2_tp  == "Psychic Warrior"){
                       $level_calc += $class2_level;
                    }
                }
                if ($class2_tp == "Samurai"){
                    $level_calc = $class2_level;
                    if ($class1_tp == "Fighter" or  $class1_tp  == "Cavalier" or  $class2_tp  == "Samurai" or
                        $class1_tp  == "Psychic Warrior"){
                        $level_calc += $class1_level;
                    }
                }
                if ($class1_spell_list_1 == "Fighter" or $class1_spell_list_2 == "Fighter" ){
      //              echo "</BR>here" ;
                    $level_calc += $class1_level;
                }
                if ($class2_spell_list_1 == "Fighter" or $class2_spell_list_2 == "Fighter" ){
                    $level_calc += $class2_level;
                }
                if ($class1_tp == "Fighter"){
      //              echo "</BR>here" ;
                    $level_calc += $class1_level;
                }
                if ($class2_tp == "Fighter"){
                    $level_calc += $class2_level;
                }
                if ($level_calc  < $featattr_no) {
                   $errortxt = $errortxt . "<p>Feat $feat requires a Fighter Level of $featattr_no Calulated Fighter level = $level_calc</p>";
          //        echo "$errortxt  class tp = $rclass_tp $class1_spell_list_1 ";
                }
               }



               if ($rclass_tp == "Fighter"){
               }else{
                 if ($class1_level  < $featattr_no and $class2_level  < $featattr_no) {
                  $errortxt = $errortxt . "<p>Feat $feat requires a Level of $featattr_no</p>";

                 }
             }

          }
          if ($featattr_type == "RCLASS"){
              $selecty = "select featattr_no from featattr2 " .
                "where featattr_feat = '$feat' and mon_key_1 = '$key_1' and featattr_type = 'RCLASS'";
              $resulty = mysqli_query($link, $selecty) ;
              $rclass = "";
              $rclass_tp = "";
  //             echo "caster $caster";
              while ($rowy = mysqli_fetch_array($resulty)){
                  $featattr_noy   = $rowy['featattr_no'];
                  $rclass_tp = $featattr_noy;
                  if ($class1_tp  == $featattr_noy or $class2_tp  == $featattr_noy){
                     $rclass = "Y";
                  }else{
                     if ($featattr_noy == "Caster" and $caster =="Y"){
             //           echo "caster $caster";
                        $rclass = "Y";
                     }else{
                        if ($featattr_noy == "Fighter"){
                           if ($class1_tp  == "Cavalier" or $class2_tp  == "Cavalier" or $class1_tp == "Samurai" or $class2_tp == "Samurai" or
                               $class3_tp  == "Eldritch Knight" or $class3_tp  == "Eldritch Knight" or
                               $class1_tp  == "Psychic Warrior" or $class2_tp  == "Psychic Warrior" or
                               $class1_spell_list_1 == "Fighter" or $class1_spell_list_2 == "Fighter" or
                               $class2_spell_list_1 == "Fighter" or $class2_spell_list_2 == "Fighter" or
                               ($class1_tp  == "Magus" and $class1_level > 9) or ($class2_tp  == "Magus"  and $class2_level > 9)
                               ){
                               $rclass = "Y";

                           }

                        }
                    }
                  }
              }
    //          echo "rclass = $rclass";
              if ($rclass != "Y"){
                 $errortxt = $errortxt . "<p>Feat $feat requires a class of $featattr_no</p>";
                  $help_ok = "N";
              }
          }
          // for monster type check to see if any of the monsters match
          if ($featattr_type == "RMONTP"){
              $selecty = "select featattr_no from featattr2 " .
                "where featattr_feat = '$feat' and mon_key_1 = '$key_1' and featattr_type = 'RMONTP'";
              $resulty = mysqli_query($link, $selecty) ;
              $rmontp = "";
              while ($rowy = mysqli_fetch_array($resulty)){
                  $featattr_noy   = $rowy['featattr_no'];
                  if ($mon_name  == $featattr_noy){
                     $rmontp = "Y";
                  }
              }
              if ($rmontp != "Y"){
                 $errortxt = $errortxt . "<p>Feat $feat requires a Type of $featattr_no</p>";
                 $help_ok = "N";
              }
          }
          if ($featattr_type == "RSNEAK"){
              $selecty = "SELECT SUM(classsp_no)  " .
             "FROM classsp2 " .
             "WHERE classsp_spec = 'Sneak Attack' and mon_key_1 = '$key_1' and".
             "((classsp_class = '$class1_tp'and classsp_level <=  '$class1_level') or " .
             "(classsp_class = '$class2_tp' and classsp_level <=  '$class2_level') or " .
             "(classsp_class = '$class3_tp' and classsp_level <=  '$class3_level')) " .
             "group by classsp_spec";
      //       echo $selecty;
             $resulty = mysqli_query($link, $selecty) ;
             $rowy = mysqli_fetch_array($resulty);
             $sneak = $rowy[0];
       //      echo "sneak = $sneak";
             if ($sneak < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Sneak Attack of $featattr_no d6</p>";
             }
          }
          if ($featattr_type == "RATT"){
             $base_att = $attnum1 + $mon_base_att;
             if ($base_att  < $featattr_no) {
                $errortxt = $errortxt . "<p>Feat $feat requires a Base Attack of $featattr_no</p>";
     //           echo $errortxt . " " . $base_att;

             }
          }
          if ($featattr_type == "RWEAPON"){
             if ($mon_weap_p  != $featattr_no) {
                $errortxt = $errortxt . "<p>Feat $feat requires a Primary weapon of $featattr_no</p>";
     //           echo $errortxt . " " . $base_att;

             }
          }
          if ($featattr_type == "ROFFHANDFREE"){
             if ($mon_weap_s1  != "No Melee" or $mon_shield != "Shield, none") {
                $errortxt = $errortxt . "<p>Feat $feat requires off hand to be free and no shield</p>";
     //           echo $errortxt . " " . $base_att;

             }
          }

          if ($featattr_type == "RFEAT"){
             $rfeat = $rowx['featattr_rfeat'];
             $select2 = "select count(*) from feattemp where feattemp_user = '$user' and feattemp_feat = '$rfeat'";
             $result2 = mysqli_query($link, $select2) ;
             $row2 = mysqli_fetch_array($result2);
             $feat_count = $row2[0];
             if ($feat_count  < 1){
          //      if ($wp_user == "admin"){
          //         echo $select2;
          //      }
                $errortxt = $errortxt . "<p>Feat  $feat requires the feat $rfeat</p>";
             }
          }
       }
  }

  //echo "</BR> feat $feat error $errortxt";
  return $errortxt;
}
function check_weapon($weap_id_sel,$weap_cat_sel) {
   global $class1_tp, $class2_tp, $mon_type, $mon_name, $mon_temp, $key_1 , $domain_11, $domain_21, $domain_31, $weap_firearm, $firearms ;
//   echo "type = " . $class1_tp;
   if ($key_1 == ""){
      $key_1 = "dd35";
   }
   $class_tp_1 = $class1_tp;
   $class_tp_2 = $class2_tp;
   $elf_weapons = array( "Longsword","Rapier", "Shortbow","Shortbow ,Composite", "Longbow","Longbow ,Composite");
   $drow_weapons = array( "Rapier", "Sword, short","Crossbow, hand");
   $orc_weapons = array( "Axe, orc double");
   $dwarf_weapons = array("Urgrosh, dwarven", "Waraxe, dwarven");
   $rouge_weapons = array("Crossbow, hand","Rapier","Sword, short","Shortbow","Shortbow ,Composite");
   $investigator_weapons = array("Crossbow, hand","Rapier","Sword, short","Shortbow","Shortbow ,Composite","Sap");
   $monk_weapons = array("Club","Crossbow, heavy", "Crossbow, light", "Dagger", "Handaxe", "Javalin","Kama","Nunchaku", "Quarterstaff","Unarmed strike",
                         "Sai", "Shuriken", "Siagham", "Sling","Brass Knuckles");                                          
   $bard_weapons = array("Longsword","Rapier","Sap","Sword, short","Shortbow","Shortbow ,Composite","Whip");
   $druid_weapons = array("Club","Dagger","Dart","Quarterstaff","Scimitar","Sickle","Shortspear","Sling","Spear");
   $wizard_weapons = array("Club","Dagger","Crossbow, heavy", "Crossbow, light","Quarterstaff");
   $psion_weapons = array("Club","Dagger","Crossbow, heavy", "Crossbow, light","Quarterstaff", "Shortspear");    
   $inquisitor_weapons = array("Crossbow, hand","Crossbow, repeating heavy","Crossbow, repeating light","Shortbow","Shortbow ,Composite","Longbow","Longbow ,Composite");
   $human_race = array("Elf", "Dwarf", "Gnome", "Human", "Drow", "Derro","Dwarf, Deugar", "Goblin", "Hobgoblin", "Halfling", "Kobold", "Orc");
   $dervish_weapons = array("Scimitar","Kukri", "Longsword","Sap","Sword, short","Shortbow","Shortbow ,Composite");
   $ninja_weapons = array("Kama","Katana","kusarigama","Nunchaku", "Sai", "Shuriken", "Siagham", "wakizashi",
                  "Sword, short","Shortbow","Shortbow ,Composite");
   $samurai_weapons = array("Katana","Naginata","Wakizashi");
   $brawler_weapons = array( "Handaxe", "Sword, short");
   $weapon_v = "weapon_" . $weap_cat_sel;
   global $$weapon_v;
   if ($mon_type != "Humanoid" or $mon_temp != ""){
     $weapon_n = "weapon_0-Natural";
     $$weapon_n = "Y";
   }else{
      $found_human = "";
      foreach ($human_race as $race){
        if ($race == $mon_name){
           $found_human = "Y";
        }
     }
     if ($found_human != "Y" or $key_1  == "dd35"){
         $weapon_n = "weapon_0-Natural";
         $$weapon_n = "Y";
     }
   }

   $weapon_ = "Y";
   if ($$weapon_v == "Y"){
     $color = "validOption";
   }else{
     $color = "invalidOption";
   }
   if ($firearms == "Y" and $weap_firearm == "Y"){
      $color = "";
   }
   if ($class_tp_1 == "Rogue" or $class_tp_2 == "Rogue" or $class_tp_1 == "Unchained Rogue" or $class_tp_2 == "Unchained Rogue" ){
      foreach ($rouge_weapons as $rouge){
        if ($rouge == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Investigator" or $class_tp_2 == "Investigator"){
      foreach ($investigator_weapons as $investigator){
        if ($investigator == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Monk" or $class_tp_2 == "Monk" or $class_tp_1 == "Unchained Monk" or $class_tp_2 == "Unchained Monk"){
      foreach ($monk_weapons as $monk){
        if ($monk == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Brawler" or $class_tp_2 == "Brawler"){
      foreach ($brawler_weapons as $brawler){
        if ($brawler == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Bard" or $class_tp_2 == "Bard"){
      if ($domain_11 == "Dervish Dancer" or $domain_21 == "Dervish Dancer"){
         foreach ($dervish_weapons as $dervish){
            if ($dervish == $weap_id_sel) {
              $color = "";
            }
         }
      }else{
         if ($domain_11 == "Geisha" or $domain_21 == "Geisha"){
            foreach ($monk_weapons as $dervish){
               if ($dervish == $weap_id_sel) {
                   $color = "";
               }
            }
         }else{
           foreach ($bard_weapons as $bard){
             if ($bard == $weap_id_sel) {
                $color = "";
             }
           }
         }
      }
   }
   if ($class_tp_1 == "Druid" or $class_tp_2 == "Druid"){
      foreach ($druid_weapons as $druid){
        if ($druid == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Wizard" or $class_tp_2 == "Wizard"){
      foreach ($wizard_weapons as $wizard){
        if ($wizard == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Psion" or $class_tp_2 == "Psion"){
      foreach ($psion_weapons as $psion){
        if ($psion == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Inquisitor" or $class_tp_2 == "Inquisitor"){
      foreach ($inquisitor_weapons as $inquisitor){
        if ($inquisitor == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Ninja" or $class_tp_2 == "Ninja"){
      foreach ($ninja_weapons as $ninja){
        if ($ninja == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($class_tp_1 == "Samurai" or $class_tp_2 == "Samurai"){
      foreach ($samurai_weapons as $samurai ){
        if ($samurai == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($mon_name == "Elf"){
      foreach ($elf_weapons as $elf){
        if ($elf == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($mon_name == "Dwarf"){
      foreach ($dwarf_weapons as $dwarf){
        if ($dwarf == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($mon_name == "Drow"){
      foreach ($drow_weapons as $drow){
        if ($drow == $weap_id_sel) {
           $color = "";
        }
     }
   }
   if ($mon_name == "Orc" or $mon_name == "Half-Orc"){
      foreach ($orc_weapons as $orc){
        if ($orc == $weap_id_sel) {
           $color = "";
        }
     }
   }





   if ($color == ""){
     $color = "validOption";
   }
   return $color;
}
function monLetter($letter){
   $html_letter = "html_" . $letter;
   global $$html_letter;
   global $wp_user, $key_1;
//   echo "</BR>monLetter $key_1</BR>";
        if ($key_1 == ""){
           $key_1 = "dd35";
        }
//        if ($wp_user = "admin"){
//          $wp_user = "MARK";
//          $chg = "Y";
//        }
	$html = '<LABEL id="monsterTypeLabel">Monster <SELECT NAME="mon_name" id="mon_name" >';
//        $html = '<TABLE ><TR><TH><b>Monster</b></TH><TH><b>Template</b></TH></TR>' .
//                '<TR><TD><SELECT NAME="mon_name" >';

	$select = "SELECT mon_key_1, mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,";
	$select .= "mon_init ,mon_speed ,mon_ac_flat , mon_ac ,";
	$select .= "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,";
	$select .= "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," ;
	$select .= "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " ;
	$select .= 	"mon_armour, mon_shield from monster2 where ((mon_template <> 'T' and mon_template <>'AC') or mon_template is NULL) and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user') ";
	$select .= " and (mon_delete <> 'Y' or mon_delete is NULL) and mon_name like '" . $letter . "%'  order by mon_name";

	$link = getDBLink();
	$result = mysqli_query($link, $select) ;

	if ( $result ) {	
			while ($row = mysqli_fetch_array($result)) {
		
				$mon_sel = $row['mon_name'] ;
				$mon_hd  = $row['mon_hd'] ;
		        $mon_key_1 = $row['mon_key_1'];
		/***
		*			Change by Chris:
		*			$currentlySelected not defined	
		*
		* 	OLD CODE
				if ($mon_sel == $currentlySelected)     {
					$sel = " SELECTED" ;
				} else {
					$sel = "" ;
		        }
		*  END OLD CODE */
		/* NEW CODE */
				$sel = "" ;
		/* END NEW CODE */
		       $html .= '<OPTION VALUE="' .$mon_sel. '" '.$sel.' >'.$mon_sel.'</OPTION>';
			}
	}			
	mysqli_close($link);
//	echo $html_C  . "</BR>"  ;
//        echo "C = " .  $$html_C;
	$html .= '</SELECT></LABEL>';
//        if ($chg == "Y"){
//           $wp_user = "admin";
//        }
	return $html;
} 
function monsterLetters(){
  $letters = " ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$html = "";

  for ($count = 0; $count <= 26; $count++){
     $letter = substr($letters,$count,1);
     $html .= '<INPUT NAME="submit" TYPE=Button Value = "' . $letter . '" style= "width: 20px" onClick=monsterSelection(this)>';
  }
  return $html;

}


/* Returns the Monster Selection HTML */
function getMonsterSelectionHTML($currentlySelected) {
        global $wp_user, $key_1;
//        echo $key_1;
        if ($key_1 == ""){
           $key_1 = "dd35";
        }
//        if ($wp_user == "admin"){
//           $chg = "Y";
//           $wp_user = "MARK";
//        }
	$html = '<LABEL id="monsterTypeLabel">Monster <SELECT NAME="mon_name" id="mon_name" >';
//        $html = '<TABLE ><TR><TH><b>Monster</b></TH><TH><b>Template</b></TH></TR>' .
//                '<TR><TD><SELECT NAME="mon_name" >';
	$select = "SELECT mon_key_1, mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
	                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
	                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
	                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
	                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
	                 "mon_armour, mon_shield from monster2 where ((mon_template <> 'T' and mon_template <>'AC') or mon_template is NULL) and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user') " .
                         " and (mon_delete <> 'Y' or mon_delete is NULL) order by mon_name";
//        echo $select;

	$link = getDBLink();
	$result = mysqli_query($link, $select) ;

	while ($row = mysqli_fetch_array($result)) {

		$mon_sel = $row['mon_name'] ;
		$mon_hd  = $row['mon_hd'] ;
	        $mon_key_1 = $row['mon_key_1'];
		if ($mon_sel == $currentlySelected)     {
			$sel = " SELECTED" ;
		} else {
			$sel = "" ;
	        }
                $html .= '<OPTION VALUE="' .$mon_sel. '" '.$sel.' >'.$mon_sel.'</OPTION>';



	}
	mysqli_close($link);
//	echo $html_C  . "</BR>"  ;
//        echo "C = " .  $$html_C;
	$html .= '</SELECT></LABEL>';
//        if ($chg == "Y"){
//           $wp_user = "admin";
//        }

	return $html;

}
function getAnimalCompanionSelectionHTML($currentlySelected) {
        global $wp_user, $key_1;
//        echo $key_1;
        if ($key_1 == ""){
           $key_1 = "dd35";
        }
	$html = '<LABEL id="monsterTypeLabel">Companion <SELECT NAME="mon_name" >';
//        $html = '<TABLE ><TR><TH><b>Monster</b></TH><TH><b>Template</b></TH></TR>' .
//                '<TR><TD><SELECT NAME="mon_name" >';
	$select = "SELECT mon_key_1, mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
	                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
	                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
	                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
	                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
	                 "mon_armour, mon_shield from monster2 where mon_template ='AC' and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user') " .
                         " and (mon_delete <> 'Y' or mon_delete is NULL) order by mon_name";
//        echo $select;

	$link = getDBLink();
	$result = mysqli_query($link, $select) ;

	while ($row = mysqli_fetch_array($result)) {

		$mon_sel = $row['mon_name'] ;
		$mon_hd  = $row['mon_hd'] ;
	        $mon_key_1 = $row['mon_key_1'];
		if ($mon_sel == $currentlySelected)     {
			$sel = " SELECTED" ;
		} else {
			$sel = "" ;
	    }

		$html .= '<OPTION VALUE="' .$mon_sel. '" '.$sel.' >'.$mon_sel.'</OPTION>';
	}
	mysqli_close($link);

	$html .= '</SELECT></LABEL>';

	return $html;
 }



/* Returns the HTML for class selection */

function getClassSelectionHTML( $classNumber, $currentlySelected ) {
        $prestige = "";
        global $key_1;
        if ($key_1 == ""){
           $key_1 = "dd35";
        }

        if ($classNumber == 3){
           $prestige = "Y";
        }
	$html = '<SELECT NAME="class_tp_'.$classNumber.'" class="classSelect" ID="class_tp_'.$classNumber.'" onchange="changeField(this,'.$classNumber.')">';

	$select = "SELECT class_tp from class2 where (class_prest = '$prestige' or class_tp = '') and mon_key_1 = '$key_1' ORDER BY class_tp";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

		$class_sel = $row['class_tp'] ;
		if ($class_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

		$html .= '<OPTION VALUE="'.$class_sel.'" '.$sel.' >'.$class_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';	

	return $html;
}

/* Returns the HTML for Cleric Domains selection */

function getDomainSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
//        echo "Selected " . $currentlySelected;
/*
        ?>
        <SCRIPT>
        alert ("selected " + <?echo $currentlySelected?>);
        </SCRIPT>
        <?
*/

	$html = "";
	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'Y' ORDER BY spellcl_id";
	$link = getDBLink();


	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getBloodlineSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'S' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getOrderSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'C' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getCavalierSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'CAV' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getPatronSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'WI' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}




function getPsionSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'P' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getSchoolSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellschool_id from spellschool ORDER BY spellschool_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	$domain_sel = "None";
        $html .= '<OPTION VALUE="" >'.$domain_sel.'</OPTION>';
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellschool_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getPsyWarrSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'PW' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getRangerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'RAN' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getRogueSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ROG' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getDruidSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'DRU' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getDruidDomainSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_druid = 'Y' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getBardSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'BAR' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getBarbarianSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'BARB' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getAlchemistSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ALCH' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getFighterSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'FIGHT' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getMonkSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'MONK' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getGunslingerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'GUNSL' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getSummonerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'SUMM' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getOracleSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ORA' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

function getOracleCurseSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ORACUR' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getBloodragerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'BLRAGE' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getWarpriestSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'WARPR' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getAnimalCompanionFocus($currentlySelected) {

	$html = '<SELECT  NAME="classFocus_1" class="classSelect" ID="classFocus_1">';

	$select = "SELECT classfh_focus from classfocush2 Where classfh_class = 'Animal Companion' ORDER BY classfh_class";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $focus_sel = $row['classfh_focus'] ;
	    if ($focus_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$focus_sel.'" '.$sel.' >'.$focus_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

/* Returns the HTML for class level selection */
function getClassLevelHTML( $classNumber, $currentlySelected ) {
    global $wp_user, $paid_user;
    global $key_1;
//    echo "paid user $paid_user " ;
    if ($key_1 == ""){
        $key_1 = "dd35";
    }
    if ($key_1 == "path"){
       $max = 21;
    }else{
       $max = 31;
    }
    if ($classNumber == 3){
       $max = 11;
    }
    if ($paid_user != "Y"){
       $max = 6;
    }
     if (isset($class3_type) && $class3_type == "Archmage" && $classNumber == 3){
       $max = 6;
    }
//    $html = '<SELECT class="width4em" NAME="classLevel_'.$classNumber.'">';
    $html = '<SELECT class="width4em" NAME="classLevel_' . $classNumber . '" id="classlevel_'. $classNumber. '">';
                                                                                                         
    $count = 0;
    While ($count < $max){
		if ($count == $currentlySelected ){
			$sel = " SELECTED";
		} else {
			$sel = "";
		}
		$html .= '<OPTION VALUE="'.$count.'" '.$sel.' >'.$count.'</OPTION>';
		$count = $count +1;
	}
	$html .= '</SELECT>';

	return $html;

}
function getClassLevelHTML2( $classNumber, $currentlySelected ) {
    global $wp_user, $paid_user, $class3_tp;
    global $key_1;
    if ($key_1 == ""){
        $key_1 = "dd35";
    }
    if ($key_1 == "path"){
       $max = 21;
    }else{
       $max = 31;
    }
    if ($classNumber == 3){
       $max = 11;
    }
    if ($paid_user != "Y"){
       $max = 6;
    }
    if (($class3_tp == "Archmage" or $class3_tp == "Hierophant") and $classNumber == 3){
       $max = 6;
    }
    $html = '<SELECT class="width4em" NAME="class'.$classNumber. '_level" id="classlevel_'. $classNumber. '">';
    $count = 1;
    While ($count < $max){
		if ($count == $currentlySelected ){
			$sel = " SELECTED";
		} else {
			$sel = "";
		}
		$html .= '<OPTION VALUE="'.$count.'" '.$sel.' >'.$count.'</OPTION>';
		$count = $count +1;
	}
	$html .= '</SELECT>';

	return $html;

}


/* Validates the POST data from the Select Monster Form */
function vetSelectMonsterForm() {

	/* Define a whole bunch of variables just to aviod Undefined Variable error messages - CT  */
	      $savemon_monster ="" ;
	      $savemon_name = "";
	      $savemon_camp = "";
	      $savemon_sub  = "";
	      $savemon_desc  = "";
	      $mon_name =      "" ;
	      $class1_tp = "" ;
	      $class2_tp = "" ;
	      $class3_tp = "" ;
	      $class1_focus = "" ;
	      $class2_focus = "" ;
	      $class3_focus = "";
	      $class1_level = "" ;
	      $class2_level = "" ;
	      $class3_level = "" ;
	      $mon_temp =    "";
	      $mon_temp2 =    "";
	      $class_tp_1 = "";
	      $class_tp_2 = "";
	      $class_tp_3 = "";
	      $classLevel_1 = "";
	      $classLevel_2 = "";
	      $classLevel_3 = "";
	      $classFocus_1 = "";
	      $classFocus_2 = "";
	      $classFocus_3 = "";
	      $savemon_mon_key_1 = "";
	      $domain11 = "";
	      $domain12 = "";
	      $domain13 = "";
	      $domain21 = "";
	      $domain22 = "";
	      $domain23 = "";
	      $domain31 = "";
	      $domain32 = "";
	      $domain33 = "";



    global $key_1;
//    echo "</BR>key = $key_1 </BR>";
    if ($key_1 == ""){
        $key_1 = "dd35";
     }
// echo var_dump($_POST);

    $msg = "" ;
    global $user_id, $savemon_key;
//    echo "function 1 user " . $user_id;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }

 //   echo "level = " . $class1_level . "class = " . $class_tp_1 . " level " . $classLevel_1;
    global $user_id, $wp_user;
    if ($savemon_key != ""){
	       $select =  "SELECT savemon_monster, savemon_mon_name, savemon_class1_tp, savemon_class2_tp, savemon_class3_tp, savemon_mon_temp, savemon_class1_focus, savemon_class2_focus, " .
	          "savemon_class3_focus, savemon_class1_level, savemon_class2_level, savemon_class3_level, savemon_mon_temp, savemon_camp, savemon_sub, savemon_name, savemon_mon_key_1, " .
	          "savemon_desc, savemon_mon_temp2 " .
	          " from savemon where savemon_key = '$savemon_key'";
	//      echo $select;
	      $link = getDBLink();
	      $result = mysqli_query($link, $select) ;
	      $row = mysqli_fetch_array($result);
	      global $savemon_monster, $savemon_name, $savemon_camp, $savemon_sub, $savemon_desc;
	      $savemon_monster = $row['savemon_monster'] ;
	      $savemon_name = $row['savemon_name'];
	      $savemon_camp = $row['savemon_camp'];
	      $savemon_sub  = $row['savemon_sub'];
	      $savemon_desc  = $row['savemon_desc'];
	      $mon_name =      $row['savemon_mon_name'] ;
	      $class1_tp = $row['savemon_class1_tp'] ;
	      $class2_tp = $row['savemon_class2_tp'] ;
	      $class3_tp = $row['savemon_class3_tp'] ;
	      $class1_focus = $row['savemon_class1_focus'] ;
	      $class2_focus = $row['savemon_class2_focus'] ;
	      $class3_focus = $row['savemon_class3_focus'] ;
	      $class1_level = $row['savemon_class1_level'] ;
	      $class2_level = $row['savemon_class2_level'] ;
	      $class3_level = $row['savemon_class3_level'] ;
	      $mon_temp =    $row['savemon_mon_temp'];
	      $mon_temp2 =    $row['savemon_mon_temp2'];
	      $class_tp_1 = $class1_tp;
	      $class_tp_2 = $class2_tp;
	      $class_tp_3 = $class3_tp;
	      $classLevel_1 = $class1_level;
	//      echo "  classLevel_1 = " . $class1_level;
	      $classLevel_2 = $class2_level;
	      $classLevel_3 = $class3_level;
	      $classFocus_1 = $class1_focus;
	      $classFocus_2 = $class2_focus;
	      $classFocus_3 = $class3_focus;
	      $savemon_mon_key_1 = $row['savemon_mon_key_1'];
	      if ($savemon_mon_key_1 == "path"){
	          $key_1 = "path";
	      }
	      $mon_tem = $mon_temp;
	  //    echo  " *** $mon_temp ***";
	      getSaveMon($savemon_monster);
	      $savemon_name = $row['savemon_name'];
	      $savemon_camp = $row['savemon_camp'];
	      $savemon_sub  = $row['savemon_sub'];
	      $savemon_desc  = $row['savemon_desc'];

	//      echo $savemon_name;
	/*
	      parse_str($savemon_monster,$monster_a);

	//      $monster_a = array('$savemon_monster');
	//      echo $savemon_monster;

	      foreach ($monster_a as $k => $v) {
	        $v = trim($v) ;
	        $v = str_replace("¨", "+", $v);
	        $$k = $v ;
	//        echo $k .  "= " .$v . "<BR></BR>";
	      }
	*/
	//      echo "mon_tem $mon_tem";
	      global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23,$domain_31, $domain_32, $domain_33, $mon_tem, $mon_tem2;
	//      echo "mon_tem2 $mon_tem";
	      if ($mon_tem == ""){
	         $mon_tem = $mon_temp;
	         $mon_tem2 = $mon_temp2;
	      }
	      $domain11 = $domain_11;
	      $domain12 = $domain_12;
	      $domain13 = $domain_13;
	      $domain21 = $domain_21;
	      $domain22 = $domain_22;
	      $domain23 = $domain_23;
	      $domain31 = $domain_31;
	      $domain32 = $domain_32;
	      $domain33 = $domain_33;
	  //    echo "domain " . $domain_11;
    } else {

//		$domain_11 = "";
//		$domain_12 = "";
//		$domain_13 = "";
//		$domain_21 = "";
//		$domain_22 = "";
//		$domain_23 = "";
//		$domain_31 = "";
//		$domain_32 = "";
//		$domain_33 = "";
//		$mon_tem = "";
//		$mon_tem2 = "";

    }
    if ($mon_name == "") {
       $msg = "please select monster" ;
    }else{
      $select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
		                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
		                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
		                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
		                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
		                 "mon_armour, mon_shield from monster2 where mon_name = '$mon_name' and (mon_key_1 = '$wp_user' or mon_key_1 ='$key_1') ";
//      echo $select;
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $mon_hd = $row['mon_hd'] ;
      $mon_hd_1 = substr($mon_hd,0,1);
      $d = strpos($mon_hd,"D");
      if ($d == FALSE){
         $d = strpos($mon_hd,"d");
      }
      if ($d == FALSE){
          $mon_hd_original = $mon_hd;
      }else{
          $len = strlen($mon_hd);
          $mon_hd_original = substr($mon_hd,0,($d));
      }
    }

//    echo "mon_hd_1 " . $mon_hd_1 . "**";
    if ($class_tp_1 !="" and ((is_numeric($classLevel_1) == FALSE) or
       ($classLevel_1 > 30) or ($classLevel_1 < 1))) {
//         echo "tp1 = " . $class_tp_1 . "level1 =" . $classLevel_1;
       $msg = "Select first class for monster and  level (1-30)";
    } else {
    if ($class_tp_2 !="" and ((is_numeric($classLevel_2) == FALSE) or
       ($classLevel_2 > 30) or ($classLevel_2 < 1))) {
       $msg = "Select second class for monster and level (1-30)";
    }
    }
    if ($class_tp_1 !="" and $classFocus_1 == "" and $msg == ""){
       $msg = "Now select skill focus for class 1";
    }
    if ($class_tp_2 !="" and $classFocus_2 == "" and $msg == ""){
       $msg = "Now select skill focus for class 2";
    }
    if ($class_tp_3 !="" and $classFocus_3 == "" and $msg == ""){
       $msg = "Now select skill focus for prestige class";
    }
    if ($class_tp_1 == "" and $classLevel_1 != 0 and  $msg ==""){
        $msg =  "Can not add levels to no class, to add levels to monsters go to generate monster and change Racial hitdie. Monsters with 0 Hit die (templates)require a class.";
    }
    if ($class_tp_2 == "" and $classLevel_2 != 0 and $msg == ""){
        $msg =  "Can not add levels to no class, to add levels to monsters go to generate monster and change Racial hitdie. Monsters with 0 Hit die (templates) require a class.";
    }
    if ($class_tp_3 == "" and $classLevel_3 != 0 and $msg == ""){
        $msg =  "Can not add levels to no class, to add levels to monsters go to generate monster and change Racial hitdie. Monsters with 0 Hit die (templates) require a class.";
    }
    if ($mon_hd_1 == 0 and $class_tp_1 == "" and $msg == ""){
        $msg = "This Monster requires a class and level as it is only a template (it is set up with 0 hit die)";
    }
    if ($class_tp_1 == "Cleric" and $domain_11 == $domain_12 and $domain_11 !=""){
        $msg = "Select two different domains for the Cleric";
    }
    if ($class_tp_2 == "Cleric" and $domain_21 == $domain_22 and $domain_21 !=""){
        $msg = "Select two different domains for the Cleric";
    }
    if ($class_tp_1 == "Wizard"){
        if ($domain_11 ==  "" and ($domain_12 !=  "" or $domain_13 !="")){
           $msg = "Only Select prohibited school when when you select a Specialized school";
        }
        if ($domain_11 !=  "" and $domain_12 ==  "" and $domain_11 != "Universal"){
           $msg = "If Specializing then must enter a Prohibited school";
        }
        if ($domain_11 == "Universal" or $domain_11 == ""){
          $domain_11 =   "Universal";
          global $domain_11;
          if ($domain_12 != "" or $domain_13 != ""){
             $msg ="Universal Wizards do not need a prohibited school";
          }
        }else{
            if ($domain_11 == "Divination" and $key_1 == "dd35"){
                if ($domain_12 !=  "" and $domain_13 !=  ""  and $domain_12 != $domain_13){
                  $msg = "Divination only needs one Prohibited school";
                }
            }else{
                if ($domain_11 != "" and ($domain_12 ==  "" or $domain_13 ==  "" )){
                   $msg = "Must select two prohibited schools";
                }
                if ($domain_11 != "" and  $msg != "" and (($domain_11 == $domain_12) or ($domain_11 == $domain_13) or ($domain_12 == $domain_13))){
                   $msg = "Specialisec Schools and all prohibited schools must be different";
               }
            }
        }
    }
    if ($class_tp_2 == "Wizard"){
        if ($domain_21 ==  "" and ($domain_22 !=  "" or $domain_23 !="")){
           $msg = "Only Select prohibited school when when you select a Specialized school";
        }
        if ($domain_21 !=  "" and $domain_22 ==  "" and $domain_21 != "Universal"){
           $msg = "If Specializing then must enter a Prohibited school";
        }
        if ($domain_21 == "Universal" or $domain_21 == ""){
          global $domain_21;
          $domain_21 =   "Universal";
          ;
          if ($domain_22 != "" or $domain_23 != ""){
             $msg ="Universal Wizards do not need a prohibited school";
          }
        }else{
            if ($domain_21 == "Divination"){
                if ($domain_22 !=  "" and $domain_23 !=  ""  and $domain_22 != $domain_23){
                  $msg = "Divination only needs one Prohibited school";
                }
            }else{
                if ($domain_21 != "" and ($domain_22 ==  "" or $domain_23 ==  "" )){
                   $msg = "Must select two phohibited schools";
                }
                if ($domain_21 != "" and  $msg != "" and (($domain_21 == $domain_22) or ($domain_21 == $domain_23) or ($domain_22 == $domain_23))){
                   $msg = "Specialisec Schools and all prohibited schools must be different";
               }
            }
        }
    }
    if (($class_tp_1 == 'Psion' and $domain_11 == "") or
        ($class_tp_2 == 'Psion' and $domain_21 == "" )){
        $msg = "Must select a Psionic Discipline";
    }
    if ($class_tp_3 != ""){
      $total_level = $classLevel_1 + $classLevel_2 + $mon_hd_original;
      if ($total_level < 5){
         $msg = "Must have at least 5 levels and/or hit die to select a prestige class";
      }
    }
    if ($mon_temp == $mon_temp2 and $mon_temp != ""){
        $msg = "Second template must be different to the first template";
    }
    if ($class_tp_1 !=""){
        $focus1 = "focus1v";
    }else{
        $focus1 = "focus1";
    }
    if ($class_tp_2 !=""){
        $focus2 = "focus1v";
    }else{
        $focus2 = "focus1";
    }
    if ($class_tp_3 !=""){
        $focus3 = "focus1v";
    }else{
        $focus3 = "focus1";
    }

    if ($msg == "") {
      if (isset($domain_11)){
      }else{
         $domain_11 = "";
      }
      if (isset($domain_12)){
      }else{
         $domain_12 = "";
      }
      if (isset($domain_21)){
      }else{
         $domain_21 = "";
      }
      if (isset($domain_22)){
      }else{
         $domain_22 = "";
      }
      if (isset($elite)){
      }else{
         $elite = "";
      }
      $_SESSION['smon_name'] = $mon_name;
      $_SESSION['sclass1_tp'] = $class_tp_1;
      $_SESSION['sclass1_level'] = $classLevel_1;
      $_SESSION['sclass1_focus'] = $classFocus_1;
      $_SESSION['sclass1_domain1'] = $domain_11;
      $_SESSION['sclass1_domain2'] = $domain_12;
      $_SESSION['sclass2_tp'] = $class_tp_2;
      $_SESSION['sclass2_level'] = $classLevel_2;
      $_SESSION['sclass2_focus'] = $classFocus_2;
      $_SESSION['sclass2_domain1'] = $domain_21;
      $_SESSION['sclass2_domain2'] = $domain_22;

      $_SESSION['suser'] = $user_id;
 //     echo "user" . $user;
      $_SESSION['snew'] = "YES";
      $_SESSION['selite'] = $elite;
      $_SESSION['smon_template'] = $mon_tem;
  //    echo "mon_tem " . $mon_tem;
       $_SESSION['smon_template2'] = $mon_tem2;
      $_SESSION['ssavemon_key'] = $savemon_key;
//      echo "function user_id " . $user_id;
      $select = "SELECT count_new, count_old, count_oldmon_key from count where count_key = 'KEY'";
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $count_new = $row['count_new'];
      $count_old = $row['count_old'];
      $count_oldmon_key = $row['count_oldmon_key'];
      $count_oldmon_key = $count_oldmon_key + 1;
      if (isset($count_new_x)){
      }else{
          $count_new_x = "";
      }
      if ($count_oldmon_key > 9){
         $count_oldmon_key = 0;
      }
      if ($count_new_x == 1){
        $count_new = $count_new + 1;
      }else{
        $count_old = $count_old + 1;
      }
      $update  = "UPDATE count SET count_new = '$count_new', count_old = '$count_old', count_oldmon_key = '$count_oldmon_key' WHERE " .
                      "count_key = 'KEY'";
      $result3 = mysqli_query($link, $update) ;
      $_SESSION['soldmon_key'] = $count_oldmon_key;
      global $save_count;
      $save_count = $count_new +  $count_old;
//       echo "MF save count " . $save_count;
       $_POST["status"] = "VETTED";
       $_POST["mon_hd"] = $mon_hd;
       $_POST["save_count"] = $save_count;

    }

	return $msg;
}

function spells($class_no){
   global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23, $domain_m1, $domain_m2, $domain_m3, $feat_addpst;
   global $spell_feat_1,$spell_feat_2,$spell_feat_3,$spell_feat_4,$spell_feat_5, $spell_feat_6, $spell_feat_7, $spell_feat_8, $spell_feat_9;
   global $key_1;
   global $class1_spell_list_1, $class1_spell_list_2, $class2_spell_list_1, $class2_spell_list_2,$class3_spell_list_1, $class3_spell_list_2;
   $HTML = "";
//   echo "class1_spell_list_1 $class1_spell_list_1";
   $class_spell_list_1_v = "class" . $class_no . "_spell_list_1";

   $class_spell_list_2_v = "class" . $class_no . "_spell_list_2";

   $class_spell_list_3_v = "class" . $class_no . "_spell_list_3";
   global $$class_spell_list_1_v, $$class_spell_list_2_v, $$class_spell_list_3_v ;


   if (isset($$class_spell_list_1_v)){
    }else{
       $$class_spell_list_1_v = "";
    }
    if (isset($$class_spell_list_2_v)){
    }else{
       $$class_spell_list_2_v = "";
    }
    if (isset($$class_spell_list_3_v)){
    }else{
       $$class_spell_list_3_v = "";
   }
   $class_spell_list_1 = $$class_spell_list_1_v;
   $class_spell_list_2 = $$class_spell_list_2_v;
   $class_spell_list_3 = $$class_spell_list_3_v;
//   echo "spell list = " .  $class_spell_list_1;

   if ($key_1 == ""){
     $key_1 = "dd35";
   }
   $class_level_v = "class" . $class_no . "_level";
   global $$class_level_v;
   $level = $$class_level_v;
   $class_v  = "class" . $class_no . "_tp";
   global $$class_v;
   $class = $$class_v;
   $class_spell_level_v = "class" . $class_no . "_spell_level";
   global $$class_spell_level_v;
   $class_spell_level = $$class_spell_level_v;
//   echo $class_spell_level_v . "/" . $class_spell_level;
//   echo "class" . $class .  $class_v . " key_1 $key_1";
   $spell_level = 0;
   if ($class == "Paladin" or $class == "Ranger" or $class == "Assassin" or $class == "Blackguard" or ($class =="Psion" and $key_1 =="dd35")
       or ($class == "Psychic Warrior" and $key_1 == "dd35") or $class == "Antipaladin"  or $class == "Bloodrager"
       or $class == "Alchemist" or $class == "Demon Lord" or $class == "Investigator" ){
     $spell_level = 1;
   }
 //  echo "spell_level ". $spell_level;
   if ($class != "Bard" and $class != "Sorcerer" and $class != "Assassin"  and $class != "Summoner"  and $class != "Unchained Summoner"  and $class != "Demon Lord"  and $class != "Skald"
        and $class !="Psion" and $class != "Psychic Warrior" and $class !="Inquisitor" and $class != "Oracle"  and $class != "Hunter" and $class != "Arcanist"){
     $spells_v = "class" . $class_no . "_spell" . $spell_level;
     $max_spell_level = 0;
     $count = 1;
     while ($count < 9){
       $spells_ch_v = "class" . $class_no . "_spell" . $count ;
        if (isset($$spells_ch_v)){
        }else{
          $$spells_ch_v = "";
        }
        global $$spells_ch_v;
        if ($$spells_ch_v > 0){
           $max_spell_level = $count;
        }
        $count += 1;
     }


   }else{
     $spells_v = "class" . $class_no . "_spell" . $spell_level . "_n";
     $max_spell_level = 0;
     $count = 1;
     while ($count < 9){
       $spells_ch_v = "class" . $class_no . "_spell" . $count  . "_n";
       if (isset($$spells_ch_v)){
        }else{
          $$spells_ch_v = "";
        }
        global $$spells_ch_v;

        if ($$spells_ch_v > 0){
           $max_spell_level = $count;
        }
        $count += 1;
     }
   }
 //  echo "max_spell_level $max_spell_level";
   global $$spells_v;
//   echo $spells_v . " "  . $$spells_v;
   $spells = trim($$spells_v);
   $domain1_v = "domain_" . $class_no . "1";
   $domain1 = $$domain1_v;
   $domain2_v = "domain_" . $class_no . "2";
   $domain2 = $$domain2_v;
   $domain3_v = "domain_" . $class_no . "3";
   $domain3 = $$domain3_v;
   $HTML .= "<div><h4>Spell Lists for $class</h4></div>";
   $spat_v = "class" . $class_no . "_spat";
  global $$spat_v;
  $spat = $$spat_v;


  // check Psion
/*
  if ($class == "Psion"){
     $select = "select spellcl_attr from spellcl where spellcl_id = '$domain1'";
     $link = getDBLink();
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result);
     $spat = $row['spellcl_attr'];
  }
 */



  $stat_v = "mon_" . strtolower($spat);
  global $$stat_v;
  $stat_bonus_v =   "mon_" . strtolower($spat) . "_bonus";
  global $$stat_bonus_v;
  $stat_bonus = $$stat_bonus_v;
  $stat   = $$stat_v;
  $stat_b = magicstat($spat);
  $stat += $stat_b;
  $conc = $class_spell_level + $stat_bonus;
  $HTML .= "</BR><b>CL $class_spell_level Concentration " . $conc . '</b>';
  $max_level = $stat - 10;
  if ($class == "Wizard" and $spells > 0 and $domain1 != ""){
       $spells += 1;
//       echo "add 1 " . $domain1;
  }
//  if ($class == "Witch" and $spells > 0 and $domain1 != ""  ){
//       $spells += 1;
//       echo "add 1 " . $domain1;
//  }
//   echo "Spells " . $spells;
  $max_spell = 10;
//  if ($class == "Assassin" or $class == "Blackguard" or $class == "Paladin" or $class == "Ranger"){
//     $max_spell = 5;
//  }
//  if ($class == "Bard"){
//     $max_spell = 7;
//  }
  while ($spell_level < $max_spell and $spells != ""){
     $dc = 10 + $spell_level + $stat_bonus;
     if ($spell_level == 0 and ($class == "Psion" or $class == "Psychic Warrior")){
         $HTML .= "\n<div> $class Discipline Talents (" . $spells . ")" . " DC " . $dc;
     }else{
         $HTML .= "\n<div> $class Level " . $spell_level . "(" . $spells . ")" . " DC " . $dc;
     }
     if ($spell_level > $max_level){
        $HTML .=  " ** Needs $spat of ". (10 + $spell_level) . " to cast **";
     }
     if ($class == "Cleric" and $spell_level != "0"){
        $HTML .= "</div><div> Domain Spell </div> <div> ";
     }
     if ($class == "Hunter" and $spell_level != "0"){
        $HTML .= "</div><div> Domain Spell </div> <div> ";
     }
     if ($class == "Druid" and $spell_level != "0" and $domain2 > " " ){
        $HTML .= "</div><div> Domain Spell </div> <div> ";
     }
     if ($class == "Shannan" and $spell_level != "0" and $domain2 > " " ){
        $HTML .= "</div><div> Spiit Magic </div> <div> ";
     }
     if ($class == "Psion" and $feat_addpst > 0 and ($spell_level > ($max_spell_level - $feat_addpst) )){
        $spells += 1;
        $HTML .= "</div><div> Feat Talent Power </div> <div> ";
     }
     if ($class == "Wizard" and $domain1 != ""){
        $HTML .= "</div><div> Specialized School </div> <div> ";
     }
     if ($class == "Sorcerer" and $domain1 != "" and $spell_level != "0" and
        (($spell_level == 1 and $level > 2) or
        ($spell_level == 2 and $level > 4) or
        ($spell_level == 3 and $level > 6) or
        ($spell_level == 4 and $level > 8) or
        ($spell_level == 5 and $level > 10) or
        ($spell_level == 6 and $level > 12) or
        ($spell_level == 7 and $level > 14) or
        ($spell_level == 8 and $level > 16) or
        ($spell_level == 9 and $level > 18))){
          $spells += 1;
        $HTML .= "</div><div> Bloodline Spell </div> <div> ";
     }
     if ($class == "Oracle" and $domain1 != "" and $spell_level != "0" and
        (($spell_level == 1 and $level > 1) or
        ($spell_level == 2 and $level > 3) or
        ($spell_level == 3 and $level > 5) or
        ($spell_level == 4 and $level > 7) or
        ($spell_level == 5 and $level > 9) or
        ($spell_level == 6 and $level > 11) or
        ($spell_level == 7 and $level > 13) or
        ($spell_level == 8 and $level > 15) or
        ($spell_level == 9 and $level > 17))){
          $spells += 1;
        $HTML .= "</div><div> Mystery Spell </div> <div> ";
     }
     if ($class == "Witch" and $domain1 != "" and $spell_level != "0" and
        (($spell_level == 1 and $level > 1) or
        ($spell_level == 2 and $level > 3) or
        ($spell_level == 3 and $level > 5) or
        ($spell_level == 4 and $level > 7) or
        ($spell_level == 5 and $level > 9) or
        ($spell_level == 6 and $level > 11) or
        ($spell_level == 7 and $level > 13) or
        ($spell_level == 8 and $level > 15) or
        ($spell_level == 9 and $level > 17))){
          $spells += 1;
        $HTML .= "</div><div> Patron Spell </div> <div> ";
     }
     if ($class == "Bloodrager" and $domain1 !=""  and $domain1 != " " and 
        (($spell_level == 1 and $level > 6) or
        ($spell_level == 2 and $level > 9) or
        ($spell_level == 3 and $level > 12) or
        ($spell_level == 4 and $level > 15))){
           $spells += 1;
           $HTML .= "</div><div> Bloodline Spell </div> <div> ";
     }
     $count = 1;
//     while ($count < $spells){
     $name_v = "class" . $class_no . "_spell_level" . $spell_level . "_" . $count;
     global $$name_v;
     $name = $$name_v;

     if ($spell_level != 0 and $class == "Cleric"){
        $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
        $select = "SELECT spellclass_name, spell_dd35 from spellclass, spell where (spellclass_class = '$domain1' or spellclass_class = '$domain2')" .
                  "AND spellclass_level = '$spell_level' and spellclass_name = spell_name";
//        echo $select;
        $link = getDBLink();
        $result = mysqli_query($link, $select) ;
         while ($row = mysqli_fetch_array($result)){
            $spell_name_sel = $row['spellclass_name'];
            if ($spell_name_sel == $name){
               $sel = " SELECTED";
           }else{
               $sel =  "";
           }
           $spell_dd35 = $row['spell_dd35'];
           $spell_ok = "Y";
           if ($spell_dd35 == "N" and $key_1 == "dd35"){
                $spell_ok = "N";
           }
           if ($sel == " SELECTED" or $spell_ok == "Y"){
               $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
           }
         }
         $count = $count +1;
         $HTML .= "\n</SELECT></div><div>";
     }else{
       if ($class == "Wizard" and $domain1 != ""){
        $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
        $select = "SELECT spellclass_name, spell_dd35 from spellclass, spell where (spellclass_class = '$class' and spellclass_name = spell_name and ".
                   " spell_school = '$domain1' )" .
                  "AND spellclass_level = '$spell_level'";
//        echo $select;
        $link = getDBLink();
        $result = mysqli_query($link, $select) ;
         while ($row = mysqli_fetch_array($result)){
            $spell_name_sel = $row['spellclass_name'];
            if ($spell_name_sel == $name){
               $sel = " SELECTED";
           }else{
               $sel =  "";
           }
           $spell_dd35 = $row['spell_dd35'];
           $spell_ok = "Y";
           if ($spell_dd35 == "N" and $key_1 == "dd35"){
               $spell_ok = "N";
           }
           if ($sel == " SELECTED" or $spell_ok == "Y"){
              $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
           }
         }
         $count = $count +1;
         $HTML .= "\n</SELECT></div><div>";

       }else{
          if ($class == "Sorcerer" and $domain1 !=""  and $domain1 != " " and (
              ($spell_level == 1 and $level > 2) or
              ($spell_level == 2 and $level > 4) or
              ($spell_level == 3 and $level > 6) or
              ($spell_level == 4 and $level > 8) or
              ($spell_level == 5 and $level > 10) or
              ($spell_level == 6 and $level > 12) or
              ($spell_level == 7 and $level > 14) or
              ($spell_level == 8 and $level > 16) or
              ($spell_level == 9 and $level > 18))){
             $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
             $select = "SELECT spellclass_name, spell_dd35 from spellclass, spell where spellclass_class = '$domain1' and spellclass_name = spell_name and ".
                  " spellclass_level = '$spell_level'";
//        echo $select;
             $link = getDBLink();
             $result = mysqli_query($link, $select) ;
             while ($row = mysqli_fetch_array($result)){
                $spell_name_sel = $row['spellclass_name'];

                if ($spell_name_sel == $name){
                   $sel = " SELECTED";
               }else{
                   $sel =  "";
               }
               $spell_dd35 = $row['spell_dd35'];
               $spell_ok = "Y";
               if ($spell_dd35 == "N" and $key_1 == "dd35"){
                   $spell_ok = "N";
               }
               if ($sel == " SELECTED" or $spell_ok == "Y"){
                  $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
               }
             }
             $count = $count +1;
             $HTML .= "\n</SELECT></div><div>";
          }else{
              if (($class == "Oracle" or $class == "Shannan") and $domain1 !=""  and $domain1 != " " and (
              ($spell_level == 1 and $level > 1) or
              ($spell_level == 2 and $level > 3) or
              ($spell_level == 3 and $level > 5) or
              ($spell_level == 4 and $level > 7) or
              ($spell_level == 5 and $level > 9) or
              ($spell_level == 6 and $level > 11) or
              ($spell_level == 7 and $level > 13) or
              ($spell_level == 8 and $level > 15) or
              ($spell_level == 9 and $level > 17))){
             $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
             $select = "SELECT spellclass_name, spell_dd35 from spellclass, spell where spellclass_class = '$domain1' and spellclass_name = spell_name and ".
                  " spellclass_level = '$spell_level'";
//        echo $select;
             $link = getDBLink();
             $result = mysqli_query($link, $select) ;
             while ($row = mysqli_fetch_array($result)){
                $spell_name_sel = $row['spellclass_name'];
                if ($spell_name_sel == $name){
                   $sel = " SELECTED";
               }else{
                   $sel =  "";
               }
               $spell_dd35 = $row['spell_dd35'];
               $spell_ok = "Y";
               if ($spell_dd35 == "N" and $key_1 == "dd35"){
                   $spell_ok = "N";
               }
               if ($sel == " SELECTED" or $spell_ok == "Y"){
                  $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
               }
             }
             $count = $count +1;
             $HTML .= "\n</SELECT></div><div>";



          }else{
            if ($class == "Psion" and $feat_addpst > 0 and  ($spell_level > ($max_spell_level - $feat_addpst))){
               $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
               $select = "SELECT DISTINCT spellclass_name, spell_dd35 from spellclass, spell where spell_psi_power_pts > 0 " .
                          "and spellclass_name = spell_name ".
                        "AND spellclass_level = '$spell_level'";
    //    echo $select;
              $link = getDBLink();
              $result = mysqli_query($link, $select) ;
              while ($row = mysqli_fetch_array($result)){
                $spell_name_sel = $row['spellclass_name'];
                if ($spell_name_sel == $name){
                  $sel = " SELECTED";
               }else{
                  $sel =  "";
               }
               $spell_dd35 = $row['spell_dd35'];
               $spell_ok = "Y";
               if ($spell_dd35 == "N" and $key_1 == "dd35"){
                   $spell_ok = "N";
               }
               if ($sel == " SELECTED" or $spell_ok == "Y"){
                  $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
               }

              }
              $count = $count +1;
              $HTML .= "\n</SELECT></div><div>";
          }else{
              if ($class == "Witch" and $domain1 !=""  and $domain1 != " " and (
              ($spell_level == 1 and $level > 1) or
              ($spell_level == 2 and $level > 3) or
              ($spell_level == 3 and $level > 5) or
              ($spell_level == 4 and $level > 7) or
              ($spell_level == 5 and $level > 9) or
              ($spell_level == 6 and $level > 11) or
              ($spell_level == 7 and $level > 13) or
              ($spell_level == 8 and $level > 15) or
              ($spell_level == 9 and $level > 17))){
             $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
             $select = "SELECT spellclass_name from spellclass, spell where spellclass_class = '$domain1' and spellclass_name = spell_name and ".
                  " spellclass_level = '$spell_level'";
//        echo $select;
             $link = getDBLink();
             $result = mysqli_query($link, $select) ;
             while ($row = mysqli_fetch_array($result)){
                $spell_name_sel = $row['spellclass_name'];
                if ($spell_name_sel == $name){
                   $sel = " SELECTED";
               }else{
                   $sel =  "";
               }
               $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
             }
             $count = $count +1;
             $HTML .= "\n</SELECT></div><div>";
          }else{
             if ($class == "Druid" and $spell_level != "0" and  $domain2 !=""  and $domain2 != " "){
                 $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
                 $select = "SELECT spellclass_name, spell_dd35 from spellclass, spell where spellclass_class = '$domain2' and spellclass_name = spell_name and ".
                  " spellclass_level = '$spell_level'";
//        echo $select;
                 $link = getDBLink();
                 $result = mysqli_query($link, $select) ;
                 while ($row = mysqli_fetch_array($result)){
                    $spell_name_sel = $row['spellclass_name'];
                    if ($spell_name_sel == $name){
                       $sel = " SELECTED";
                   }else{
                       $sel =  "";
                   }
                   $spell_dd35 = $row['spell_dd35'];
                   $spell_ok = "Y";
                   if ($spell_dd35 == "N" and $key_1 == "dd35"){
                       $spell_ok = "N";
                   }
                   if ($sel == " SELECTED" or $spell_ok == "Y"){
                      $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
                   }
                 }
                 $count = $count +1;
                 $HTML .= "\n</SELECT></div><div>";
          }else{
               if ($spell_level != 0 and $class == "Hunter"){
                  $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
                  $select = "SELECT spellclass_name, spell_dd35 from spellclass, spell where 
                      (spellclass_class = '$class')" .
                      "AND spellclass_level = '$spell_level' and spellclass_name = spell_name";
  //       echo $select;
                  $link = getDBLink();
                  $result = mysqli_query($link, $select) ;
                  while ($row = mysqli_fetch_array($result)){
                     $spell_name_sel = $row['spellclass_name'];
                     if ($spell_name_sel == $name){
                        $sel = " SELECTED";
                    }else{
                        $sel =  "";
                  }
                  $spell_dd35 = $row['spell_dd35'];
                  $spell_ok = "Y";
                  if ($spell_dd35 == "N" and $key_1 == "dd35"){
                     $spell_ok = "N";
                  }
                  if ($sel == " SELECTED" or $spell_ok == "Y"){
                     $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
                  }
                 }
                $count = $count +1;
                $HTML .= "\n</SELECT></div><div>";
          }else{
              if ($class == "Bloodrager" and $domain1 !=""  and $domain1 != " " and (
              ($spell_level == 1 and $level > 6) or
              ($spell_level == 2 and $level > 9) or
              ($spell_level == 3 and $level > 12) or
              ($spell_level == 4 and $level > 15)
              )){
             $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
             $select = "SELECT spellclass_name, spell_dd35 from spellclass, spell where spellclass_class = '$domain1' and spellclass_name = spell_name and ".
                  " spellclass_level = '$spell_level'";
//        echo $select;
             $link = getDBLink();
             $result = mysqli_query($link, $select) ;
             while ($row = mysqli_fetch_array($result)){
                $spell_name_sel = $row['spellclass_name'];
                if ($spell_name_sel == $name){
                   $sel = " SELECTED";
               }else{
                   $sel =  "";
               }
               $spell_dd35 = $row['spell_dd35'];
               $spell_ok = "Y";
               if ($spell_dd35 == "N" and $key_1 == "dd35"){
                   $spell_ok = "N";
               }
               if ($sel == " SELECTED" or $spell_ok == "Y"){
                  $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
               }
             }
             $count = $count +1;
             $HTML .= "\n</SELECT></div><div>";



          }else{
      //        $HTML .= "\n</SELECT></div><div>";
              $HTML .= "\n</div><div>";
          }
          }
          }
          }
          }
          }
         }
       }
     }

  //   echo "spell_level $spell_level max level $max_spell_level feat_addpst $feat_addpst";

     if ($class == "Cleric" or $class == "Witch" or ($class == "Sorcerer" and $domain1 != "")
         or ($class == "Wizard" and $domain1 != "")
         or ($class == "Oracle" and $domain1 != "")
         or ($class == "Bloodrager" and $domain1 != "")
         or $class == "Hunter"
         or ($class == "Psion" and $feat_addpst > 0 and  ($spell_level > ($max_spell_level - $feat_addpst)))){
        $HTML .= "\nNormal Spells</div><div>";
     }
     $count_2 = 0;
     while ($count < ($spells +1)){
        $count_2 += 1;
        $name_v = "class" . $class_no . "_spell_level" . $spell_level . "_" . $count;
        global $$name_v;
        $name = $$name_v;
        if ($count_2 == 4 or $count_2 == 7 or $count_2 == 10 or $count_2 == 13){
            $HTML .= "\n</div><div>";
        }
        $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
        if ($class == "Wizard" and $domain1 != ""){
            $select = "SELECT spellclass_name, spell_dd35 from spellclass , spell where " .
                  "spellclass_class = '$class' and  spell_school <> '$domain2' and spell_school <> '$domain3' " .
                  "and spellclass_level = '$spell_level' and spell_name = spellclass_name order by spell_name ";

         }else{
                if ($class_spell_list_1 != "" or  $class_spell_list_2 != ""){
                   $select = "SELECT DISTINCT  spellclass_name, spell_dd35 from spellclass, spell where (spellclass_class = '$class_spell_list_1' or spellclass_class = '$class_spell_list_2' " .
                    "or spellclass_class = '$class') " .
                    "and spellclass_level = '$spell_level' and spellclass_name = spell_name";
                }else{
                   $select = "SELECT DISTINCT  spellclass_name, spell_dd35 from spellclass, spell where (spellclass_class = '$domain1' or spellclass_class = '$domain2' or spellclass_class = '$domain3'" .
                    "or spellclass_class = '$class') " .
                    "and spellclass_level = '$spell_level' and spellclass_name = spell_name";
                }
         }
//         echo $select;
        $link = getDBLink();
        $result = mysqli_query($link, $select) ;
         while ($row = mysqli_fetch_array($result)){
            $spell_name_sel = $row['spellclass_name'];
            if ($spell_name_sel == $name){
               $sel = " SELECTED";
           }else{
               $sel =  "";
           }
           $spell_dd35 = $row['spell_dd35'];
           $spell_ok = "Y";
           if ($spell_dd35 == "N" and $key_1 == "dd35"){
                   $spell_ok = "N";
           }
           if ($sel == " SELECTED" or $spell_ok == "Y"){
              if (($key_1 == "path" and $spell_name_sel != "Cure Minor Wounds")
              OR $key_1 != "path"){
                  $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'.$spell_name_sel.'</OPTION>';
              }
           }

         }
         $count_3 = 1;
         $spell_feat_r = "spell_feat_" . $count_3;
         global $$spell_feat_r;
         $spell_feat_v = $$spell_feat_r;
   //      echo $spell_feat_r . $spell_feat_v;
         global $$spell_feat_v;
         $spell_feat = $spell_feat_v;
         $spell_feat_count = $$spell_feat_v;
   //      echo $spell_feat  ."=" . $spell_feat_count;
         while ($count_3 < 9 and $spell_feat != ""){
           if ($spell_level > $spell_feat_count){
               $new_level = $spell_level - $spell_feat_count;
//               echo $spell_feat . $spell_feat_count;
               if ($class == "Wizard" and $domain1 != ""){
                   $select = "SELECT spellclass_name, spell_dd35 from spellclass , spell where " .
                      "spellclass_class = '$class' and  spell_school <> '$domain2' and spell_school <> '$domain3' " .
                      "and spellclass_level = '$new_level' and spell_name = spellclass_name order by spell_name ";

              }else{
                   if ($class_spell_list_1 != "" or  $class_spell_list_2 != ""){
                     $select = "SELECT DISTINCT  spellclass_name, spell_dd35 from spellclass, spell where (spellclass_class = '$class_spell_list_1' or spellclass_class = '$class_spell_list_2' " .
                      "or spellclass_class = '$class') " .
                      "and spellclass_level = '$spell_level' and spellclass_name = spell_name";
                   }else{
                       $select = "SELECT  DISTINCT spellclass_name, spell_dd35 from spellclass, spell where (spellclass_class = '$domain1' or spellclass_class = '$domain2'" .
                         "or spellclass_class = '$class') " .
                         "and spellclass_level = '$new_level' and spellclass_name = spell_name";
                   }
              }
//              echo $select;
              $link = getDBLink();
              $result = mysqli_query($link, $select) ;
              while ($row = mysqli_fetch_array($result)){
                 $spell_name_sel = $row['spellclass_name'];
                 $spell_name_sel_d = $spell_feat . " " . $spell_name_sel;
                 $spell_name_sel = $spell_feat . "*" . $spell_name_sel;
                 if ($spell_name_sel == $name){
                    $sel = " SELECTED";
                 }else{
                    $sel =  "";
                }
                $spell_dd35 = $row['spell_dd35'];
                $spell_ok = "Y";
                if ($spell_dd35 == "N" and $key_1 == "dd35"){
                    $spell_ok = "N";
                }
                if ($sel == " SELECTED" or $spell_ok == "Y"){
                   if (($key_1 == "path" and $spell_name_sel != "Cure Minor Wounds")
                    or $key_1 != "path"){
                      $HTML .= '<OPTION VALUE="'.$spell_name_sel.'" '.$sel.' >'. $spell_name_sel_d.'</OPTION>';
                   }
                }
              }
           }

           $count_3 += 1;
           $spell_feat_r = "spell_feat_" . $count_3;
           $spell_feat_v = $$spell_feat_r;
           global $$spell_feat_v;
           $spell_feat = $spell_feat_v;
           $spell_feat_count = $$spell_feat;

        }

        $count = $count +1;
        $HTML .= "\n</SELECT>";

     }
     $spell_level = $spell_level +1;
      if ($class != "Bard" and $class != "Sorcerer" and $class != "Psion" and $class != "Psychic Warrior" 
           and $class != "Oracle" and  $class != "Bloodrager"   and  $class != "Skald"
           and $class != "Inquisitor" and $class != "Summoner" and $class != "Demon Lord"  and $class != "Hunter" and $class != "Unchained Summoner" ){
       $spells_v = "class" . $class_no . "_spell" . $spell_level;
     }else{
       $spells_v = "class" . $class_no . "_spell" . $spell_level . "_n";
     }
     global $$spells_v;
     $spells = trim($$spells_v);
     if ($class == "Wizard" and $spells > 0 and $domain1 != ""){
       $spells += 1;
     }
  //   if ($class == "Witch" and $spells > 0 and $domain1 != ""){
  //     $spells += 1;
  //   }
    $HTML .= "\n</div>";
  }

  // echo $HTML;
  return $HTML;
}
function printSpells($classNumber){
  $class_v =  "class" . $classNumber . "_tp";
  global $$class_v;
  global $user;
  $level_v = "class" . $classNumber . "_level";
  global $$level_v;
  $level = $$level_v;
  //  echo  "user = " . $user;
  $class = $$class_v;
  $spell_level = 0;
  $count = 1;
  $name_v = "class" . $classNumber . "_spell_level" . $spell_level . "_" . $count;
//  echo $name_v;
  $delete = "delete from spelltemp where spellt_user = '$user'";
  $link = getDBLink();
  $result = mysqli_query($link, $delete) ;
  global $$name_v;
  $name = $$name_v;
  $class_spell_level_v = "class" . $classNumber . "_spell_level";
  global $$class_spell_level_v;
  $class_spell_level = $$class_spell_level_v;
 // echo $class_spell_level_v . "/" . $class_spell_level;
  While ($spell_level < 10){
     While($count < 15){
      if ($name != ""){
        $insert = "INSERT INTO spelltemp (spellt_user, spellt_class_no, spellt_level, spellt_spell, spellt_count) " .
                  "VALUES ('$user', '$classNumber', '$spell_level', '$name', '1')";
        if (!mysqli_query($link, $insert)){
           $select = "SELECT spellt_count from spelltemp where spellt_user = '$user' and spellt_class_no = '$classNumber' and " .
                  " spellt_level = '$spell_level' and spellt_spell = '$name'";
//           echo "select count " . $select;
           $result = mysqli_query($link, $select);
           $row = mysqli_fetch_array($result);
           $spellt_count = $row['spellt_count'];
//           echo "spellt_count " . $spellt_count;
           $spellt_count += 1;
           $update = "UPDATE spelltemp SET spellt_count = '$spellt_count' WHERE spellt_user = '$user' and spellt_class_no = '$classNumber' and " .
                  " spellt_level = '$spell_level' and spellt_spell = '$name'";
//           echo "update " . $update;
           $result = mysqli_query($link, $update);
        }
      }
      $count += 1;
      $name_v = "class" . $classNumber . "_spell_level" . $spell_level . "_" . $count;
      global $$name_v;
      $name = $$name_v;

     }
     $spell_level += 1;
     $count = 1;
     $name_v = "class" . $classNumber . "_spell_level" . $spell_level . "_" . $count;
     global $$name_v;
     $name = $$name_v;
  }

  $spell_level = 0;
  $count = 0;
  global $$name_v;
  $name = $$name_v;
  $print = $class . " \n Spells \n";
  $html = "<b>" . $class . " Spells</b></BR>";
  $html_s = "<b>" . $class . " Spells: </b>";
  $spat_v = "class" . $classNumber . "_spat";
  $psi_v = "class" . $classNumber . "_psi";

  global $$psi_v;
//  echo $psi_v . " " . $$psi_v;
  $psi = $$psi_v;
/*
  if ($psi == "Y"){
     $domain_r = "domain_" . $classNumber . "1";
     global $$domain_r;
     $domain = $$domain_r;
//     echo "domain" . $domain;
     if ($domain != ""){
        $select = "select spellcl_attr from spellcl where spellcl_id = '$domain'";
        $result = mysqli_query($link, $select);
        $row = mysqli_fetch_array($result);
        $spat = $row['spellcl_attr'];
//        echo "spat" . $spat;
     }
  }else{
*/
 global $$spat_v;
 $spat = $$spat_v;
  $stat_v = "mon_" . strtolower($spat);

  global $$stat_v;
  $stat_bonus_v =   "mon_" . strtolower($spat) . "_bonus";

  global $$stat_bonus_v;
//  echo "stat bonus v " . $stat_bonus_v . $$stat_bonus_v;
  $stat_bonus = $$stat_bonus_v;
  // echo "class_spell_level $class_spell_level";
  $conc = $class_spell_level + $stat_bonus;
  $html .= "<b>CL $class_spell_level Concentration $conc</b></BR>";
  $html_s .= "<b>CL $class_spell_level Concentration $conc</b> ";
  $print .= "CL $class_spell_level Concentration $conc</n>";
  $stat   = $$stat_v;
  $stat_b = magicstat($spat);
  $stat += $stat_b;
  $max_level = $stat - 10;
  while ($spell_level < 10){

    $select1 = "SELECT spellt_count, spellt_spell from spelltemp where spellt_user = '$user' and spellt_class_no = '$classNumber' and " .
                  " spellt_level = '$spell_level' order by spellt_spell";
//    echo $select1;
    $link = getDBLink();
    $result1 = mysqli_query($link, $select1);
    $print_level = "Y";

    While($row1 = mysqli_fetch_array($result1)){
      if ($print_level == "Y"){
             $dc = 10 + $spell_level + $stat_bonus;
             $spell_no_v = "class" . $classNumber . "_spell" . $spell_level;
             global $$spell_no_v;
             $spell_no = $$spell_no_v;
             $spell_no_dis = $spell_no;
             $domain_r = "domain_" . $classNumber . "1";
             global $$domain_r;
             $domain = $$domain_r;
             if (($spell_level > 0 )and ($class == "Witch" or ($class == "Wizard" and $domain != "" and $domain !="Universal"))){
                $spell_no_dis = $spell_no + 1;
             }
//             echo $spell_no_v . $spell_no;
             $print .= "Level $spell_level ($spell_no_dis) DC " . $dc;
             $html .= "<b>Level $spell_level ($spell_no_dis) DC " . $dc . "</b>";
             $html_s .= "<b>Level $spell_level ($spell_no_dis) DC " . $dc . "</b>";
             if ($spell_level > $max_level and $spat != ""){
                $print .= "** Needs $spat of ". (10 + $spell_level) . " to cast **";
                $html .= "** Needs $spat of ". (10 + $spell_level) . " to cast **";
             }
             $print .= "\n";
             $html .= "</BR>";
             $html_s .= ": ";
             $print_level = "N";
      }
      $name = $row1['spellt_spell'];
      $name2 = $name;

      $star = stripos($name,"*");
      if ($star > 0){
         $star += 1;
         $len =strlen($name);
         $name2 = substr($name,$star,$len);
         $name2 = trim($name2);
         $name = str_replace("*"," ",$name);
//         echo $name;
      }
      $spellt_count = $row1['spellt_count'];
  //    $select = "SELECT spell_school, spell_desc, spell_type1, spell_type2, spell_type3, spell_type4, spell_comp, spell_range, spell_duration, spell_save," .
  //               "spell_area, spellrange_desc, spell_psi_power_pts, spell_resist, spell_psi_focus, spell_cast_time, spell_book  from spell, spellrange" .
  //               " where spell_range = spellrange_id and spell_name = '$name2'";
      $select = "SELECT spell_school, spell_desc, spell_type1, spell_type2, spell_type3, spell_type4, spell_comp, spell_range, spell_duration, spell_save," .
                 "spell_area, spell_psi_power_pts, spell_resist, spell_psi_focus, spell_cast_time, spell_book  from spell" .
                 " where spell_name = '$name2'";
   //   echo $select;
      $link = getDBLink();
      $result = mysqli_query($link, $select);
      while ($row = mysqli_fetch_array($result)){
        $spell_school = $row['spell_school'];
        $spell_desc = $row['spell_desc'];
 //       echo " desc " . $spell_desc;
        $spell_desc = trim($spell_desc);
        $spell_type1 = $row['spell_type1'];
        $spell_type2 = $row['spell_type2'];
        $spell_type3 = $row['spell_type3'];
        $spell_type4 = $row['spell_type4'];
        $spell_comp = $row['spell_comp'];
        $spell_range = $row['spell_range'];
        $spell_duration = $row['spell_duration'];
        $spell_save = $row['spell_save'];
        $spell_area = $row['spell_area'];
  //      $spellrange_desc = $row['spellrange_desc'];
        $spell_psi_power_pts = $row['spell_psi_power_pts'];
        $spell_resist = $row['spell_resist'];
        $spell_psi_focus = $row['spell_psi_focus'];
        $spell_cast_time = $row['spell_cast_time'];
        $spell_book = $row['spell_book'];
        $spell_dc = "";
        if ($spell_psi_power_pts > 0){
           $spell_psi_power_pts = ($spell_level * 2) -1;
        }
        $select2 = "select spellrange_desc from spellrange where spellrange_id = '$spell_range'";
        $result2 = mysqli_query($link, $select2);
         if (mysqli_num_rows($result2) > 0){
           $row2 = mysqli_fetch_array($result2);
        }
        if (isset($row2['spellrange_desc'])){
           $spellrange_desc = $row2['spellrange_desc'];
        }else{
            $spellrange_desc = "";
        }
/*
        if ($class == "Psion" or $class == "Psychic Warrior"){
            $psi = "Y";
            if ($spell_psi_focus != ""){
               $stat_bonus_v =   "mon_" . strtolower($spell_psi_focus) . "_bonus";
               global $$stat_bonus_v;
               $dc_r = 'psidc' . strtolower($spell_psi_focus);
               global $$dc_r;
    //           echo $dc_r . $$dc_r;
               $feat_dc = 0;
               $feat_dc = $$dc_r;
               $dc = 10 + $spell_level + $$stat_bonus_v + $feat_dc;
               $spell_dc = " DC " . $dc;
            }
        }
*/

  global $$stat_bonus_v;
        $html_s .= $name;
        if ($spellt_count > 1){
           $html_s .= " X " . $spellt_count;
        }

        $print .= $name . "(" . $spell_school. ")" . "[" . $spell_type1 . " " . $spell_type2 . " " . $spell_type3 . " " . $spell_type4 . "]" .
                " X " . $spellt_count . "\n" .
                "   "  . $spell_comp . " rng: " . $spell_range . " " . $spellrange_desc . " Cast time: " . $spell_cast_time . " Dur: " . $spell_duration . "\n" .
                "   " . "SV ". $spell_save . " Area: " . $spell_area . " Book: " . $spell_book .  "\n";
        $html .= $name. "(" . $spell_school. ")" . "[" . $spell_type1 . " " . $spell_type2 . " " . $spell_type3 . " " . $spell_type4 . "]" .
                " X " . $spellt_count . "</BR>" .
                "   "  . $spell_comp . " rng: " . $spell_range . " " . $spellrange_desc . " CT:" . $spell_cast_time . " Dur: " . $spell_duration . "</BR>" .
                "   " . "SV ". $spell_save . " Area: " . $spell_area .  " Book: $spell_book </BR>";
        if ($spell_psi_power_pts > 0 and $psi == "Y"){
            $print .= "   Power Points " . $spell_psi_power_pts . "\n";
            $html .= "   Power Points " . $spell_psi_power_pts . "</BR>";
        }
        if ($spell_desc > "" and $spell_desc != "-"){
           $print .= "   Description: " . $spell_desc . "\n";
           $html .= "   Description: <font class='spelldesc'>" . $spell_desc . "</font></BR>";
        }
        $print .= "\n";
        $html .= "</BR>";
        $html_s .= ", ";
      }

//      $count = $count + 1;
//      $name_v = "class" . $classNumber . "_spell_level" . $spell_level . "_" . $count;
//      global $$name_v;
//      $name = trim($$name_v);
    }
    $spell_level = $spell_level +1;
    if ($name != ""){
      $html_s .= "; ";
    }
    $count = 1;
    $name_v = "class" . $classNumber . "_spell_level" . $spell_level . "_" . $count;
    global $$name_v;
    $name = trim($$name_v);
  }
  $print .= "\n \n";
  $html  .= "</BR>";
//  $html_s .= "</BR>";
  global  $spell_html_print, $spell_html_print_s ;
  $spell_html_print = $html;
  $spell_html_print_s = $html_s;

//  echo "print = " . $print;
  return $print;
}
function magicItems($body, $number){
  global $key_1;

  if ($key_1 == ""){
        $key_1 = "dd35";
  }
  $magic_item_v = "magic_" . $body . "_" . $number;
  global $$magic_item_v;
  $magic_item = $$magic_item_v;
  $magic_item_gp_v = $magic_item_v . "_gp";
  global $$magic_item_gp_v;
  $magic_item_gp = $$magic_item_gp_v;
  if ($magic_item_gp == ""){
    $magic_item_gp = "0";
  }
  echo "\n<script>\n";
  echo 'var magic_type_' .$body  . '_' . $number . ' ="' . $magic_item_gp_v . '" ;' . "\n" ;

  $type = "magic_type_" . $body .'_' . $number;
  $HTML = '<SELECT NAME="' . $magic_item_v . '"  style="width:550px" onchange="calcGP(this,'.  $magic_item_gp_v . ',' . $type. ')">';
  if ($magic_item == ""){
          $sel = " SELECTED";
          echo "var ". $magic_item_gp_v . " = 0 ;" . "\n";
      }else{
          $sel =  "";
      }
  $HTML .= "<OPTION VALUE='' $sel  >None</OPTION>";
  $body2 = $body;
  if ($body == "WEAPONA"){
     $body2 = "WEAPON";
  }
  if ($body == "WEAPONB"){
     $body2 = "WEAPON";
  }
  if ($body == "WEAPONB_SPEC"){
     $body2 = "WEAPONA_SPEC";
  }
  if ($body == "WEAPONB_MAT"){
     $body2 = "WEAPONA_MAT";
  }
  $select = "SELECT magic_name, magic_desc, magic_value, magic_no_spec, magic_price_bonus, magic_masterwork FROM magic2 where magic_body = '$body2'" .
            "and mon_key_1 = '$key_1' order by magic_name";
  $link = getDBLink();
  $result = mysqli_query($link, $select);
  while ($row = mysqli_fetch_array($result)){
      $magic_name_sel = $row['magic_name'];
      $magic_desc = $row['magic_desc'];
      $magic_value = $row['magic_value'];
      if ($magic_value == ""){
          $magic_value = "0";
      }
      $magic_no_spec = $row['magic_no_spec'];
      $magic_price_bonus = $row['magic_price_bonus'];
      $magic_masterwork = $row['magic_masterwork'];
      if ($body2 == "ARMOUR_SPEC" or $body2 == "SHIELD_SPEC" or $body2 == "WEAPONA_SPEC" or $body2 == "WEAPONR_SPEC"){
         if ($magic_price_bonus > 0){
           $magic_name_desc = $magic_name_sel . ": (+" . $magic_price_bonus ." bonus) "  . $magic_desc ;
         }else{
           $magic_name_desc = $magic_name_sel . ": (" . $magic_value ." gp) "  . $magic_desc ;
         }
      }else{
        $magic_name_desc = $magic_name_sel . " " . $magic_desc . " " . "($magic_value gp)";
      }

      $magic_name_v = str_replace(" ", "_",$magic_name_sel);
      $magic_name_v = str_replace("(", "_",$magic_name_v);
      $magic_name_v = str_replace("-", "_",$magic_name_v);
      $magic_name_v = str_replace("+", "_",$magic_name_v);
      $magic_name_v = str_replace("/", "_",$magic_name_v);
      $magic_name_v = str_replace(",", "_",$magic_name_v);
      $magic_no_spec_v =  str_replace(")", "_",$magic_name_v) ."_no_spec";
      $magic_name_v = str_replace(")", "_",$magic_name_v) ."_gp";
      if ($number == 1){
         echo "var " . $magic_name_v . " = " . $magic_value . " ;" . "\n";
          if ($body2 == "ARMOUR" or $body2 == "SHIELD" or $body2 == "WEAPON" or $body2 == "WEAPONR"){
             echo "var " . $magic_no_spec_v . " = " . $magic_no_spec . " ;" . "\n";
          }
      }
      if ($magic_name_sel == $magic_item){
           echo "var ". $magic_item_gp_v . " = " . $magic_value . ";" . "\n";
          $sel = " SELECTED";
      }else{
          $sel =  "";
      }

      $HTML .= '<OPTION VALUE="'.$magic_name_sel.'" '.$sel.' >'.$magic_name_desc.'</OPTION>';

//      echo "HTML = " . $HTML;
  }
  $HTML .=  "</SELECT>";
  echo  "</script>\n";
  return $HTML;
}
//
// Uddate stats with magic items
//
function magicAttr(){
   global $key_1;
   if ($key_1 == ""){
       $key_1 = "dd35";
   }
   global $user;
   global $mon_str_m, $mon_con_m, $mon_dex_m, $mon_int_m, $mon_wis_m, $mon_chr_m, $mon_size_m, $magic_ac, $magic_skill_all, $magic_armour_nac;
   global $mon_str_s, $mon_con_s, $mon_dex_s, $mon_int_s, $mon_wis_s, $mon_chr_s, $mon_size_s, $magic_ac_deflect, $magic_ac_dodge;
   global $class1_tp, $class2_tp, $class3_tp, $class1_level, $class2_level, $class3_level;
   global  $magic_found;
   $mon_str_m = $mon_con_m = $mon_dex_m = $mon_int_m = $mon_wis_m = $mon_chr_m = "0";
   $delete = "DELETE from magictemp where magict_user = '$user'";
   $link = getDBLink();
   $result = mysqli_query($link, $delete);
   $select = "SELECT magicbody_id from magicbody";
   $link = getDBLink();
   $result = mysqli_query($link, $select);
   while ($row = mysqli_fetch_array($result)){
       $number = 1;
       $max = 2;
       $body = $row['magicbody_id'];
       if ($body == "RING"){
          $max = 3;
       }else{
          if($body == "MISC"){
             $max = 5;
          }else{
             if($body == "WAND"){
                $max = 5;
             }else{
                if($body == "POTIONS"){
                   $max = 5;
                }else{
                  if($body == "WEAPON"){
                   $max = 3;
                  }
                }
             }
          }
       }
       while ($number < $max){
 //        echo $number . $body . "</BR>";
          $body2 = $body;
          if ($number == 1 and $body == "WEAPON"){
             $body2 = "WEAPONA";
          }
          if ($number == 2 and $body == "WEAPON"){
             $body2 = "WEAPONB";
          }
          if ($number == 2 and $body == "WEAPONA_SPEC"){
             $body2 = "WEAPONB_SPEC";
          }
          if ($number == 2 and $body == "WEAPONA_MAT"){
             $body2 = "WEAPONB_MAT";
          }
          $magic_item_v = "magic_" . $body2 . "_" . $number;
          global $$magic_item_v;
          $magic_item = $$magic_item_v;
    //      echo $magic_item_v . " = "  . $magic_item;
          if ($magic_item != ""){
             $magic_found = "Y";
             $select2 = "SELECT magic_spec, magic_bonus_tp, magic_feat, magic_skill, magic_no from magicattr2 where magic_name = '$magic_item'" .
                        "and mon_key_1 = '$key_1'";
//             echo $select2;
             $result2 = mysqli_query($link, $select2);
              while ($row2 = mysqli_fetch_array($result2)){
                  $magic_spec     = $row2['magic_spec'];
                  if ($body == "WEAPON" and $number == "2"){
                     $magic_spec .= "S1";
                  }
                  $magic_bonus_tp = $row2['magic_bonus_tp'];
                  $magic_feat     = $row2['magic_feat'];
                  $magic_skill    = $row2['magic_skill'];
                  $magic_no       = $row2['magic_no'];
                  $insert = "INSERT into magictemp (magict_user, magic_spec, magic_bonus_tp, magic_feat, magic_skill, magict_no) " .
                             "VALUES('$user', '$magic_spec','$magic_bonus_tp', '$magic_feat', '$magic_skill', '$magic_no')";
  //                echo $insert . "</BR>";
                  if (!mysqli_query($link, $insert)){
                      $select3 =  "SELECT magict_user, magic_spec, magic_bonus_tp, magic_feat, magic_skill, magict_no FROM magictemp " .
                                   "WHERE magict_user = '$user' and magic_spec = '$magic_spec' and magic_bonus_tp = '$magic_bonus_tp' and " .
                                   " magic_feat = '$magic_feat' and magic_skill = '$magic_skill'";
                      $result3 = mysqli_query($link, $select3);
                      $row3 =  mysqli_fetch_array($result3);
                      $magic_no_old = $row3['magict_no'];
                      if ($magic_no > $magic_no_old){
                         $update = "UPDATE magictemp SET magict_no = '$magic_no' " .
                         "WHERE magict_user = '$user' and magic_spec = '$magic_spec' and magic_bonus_tp = '$magic_bonus_tp' and " .
                         " magic_feat = '$magic_feat' and magic_skill = '$magic_skill'";
                         $result4 = mysqli_query($link, $update);
                      }
                  }
              }
          }
          $number = $number + 1;
       }
   }
   $x = buff_attr();
   $feat_attu = $feat_attud = 0;
   $magic_will_sv = $magic_fort_sv = $magic_reflex_sv  = "0" ;
   $magic_speed = 0;
   $mon_nat_armour_ft = 0;
   $magic_shield = 0;
   $magic_armour = 0;
   $magic_skill_all = 0;
   $magic_armour_nac = 0;
   $finess_damage = "";
   if ($magic_found == "Y"){
       global $feat_atth, $feat_atthd, $feat_attr, $feat_attrd, $feat_exatta, $exatta, $feat_exattr, $feat_multi, $magic_will_sv, $magic_fort_sv;
       global $feat_exattap, $exattap, $feat_attall, $exattr, $feat_multiw;
       global $magic_reflex_sv, $mon_nat_armour_ft, $feat_size, $total_hps,$feat_init, $feat_grapple, $shield_bonus, $range_mod;
       global $magic_tohit_p, $magic_damage_p, $magic_tohit_r, $magic_damage_r, $magic_shield, $magic_armour, $magic_speed ;
       global $magic_ac, $magic_ac_deflect, $magic_ac_insight, $magic_ac_profane,$magic_ac_luch, $magic_ac_dodge ;
       global $magic_tohit_s1, $magic_damage_s1;
       global $class1_tp, $class2_tp, $class1_attg, $class2_attg, $magic_hps, $new_size_no_feat, $speedmednorm ;
       global $feat_attu, $feat_attud,$mon_free_feats, $mon_feats, $magic_armour_touch, $crit_mod, $crit_mod_r, $feat_armch, $feat_armtp,$mon_size, $mon_size_u;
       global $save_text, $AC_text,  $finess_damage;
       global $mon_str, $mon_int, $mon_dex, $mon_chr, $mon_con, $mon_wis, $mon_str_bonus, $mon_int_bonus, $mon_dex_bonus, $mon_chr_bonus, $mon_con_bonus, $mon_wis_bonus;
//       $save_text = "";
//       $AC_text = "";
       $feat_attu = $feat_attud = 0;
       $magic_will_sv = $magic_fort_sv = $magic_reflex_sv  = "0" ;
       $magic_speed = 0;
       $mon_nat_armour_ft = 0;
       $magic_shield = 0;
       $magic_armour = 0;
       $magic_skill_all = 0;
       $magic_armour_nac = 0;
       $select3 =  "SELECT magict_user, magic_spec, magic_bonus_tp, magic_feat, magic_skill, magict_no, magict_desc, magict_text FROM magictemp " .
                                   "WHERE magict_user = '$user'";
//       echo $select3;
       $result3 = mysqli_query($link, $select3);
       while ($row3 =  mysqli_fetch_array($result3)){
          $magic_spec     = $row3['magic_spec'];
          $magic_bonus_tp = $row3['magic_bonus_tp'];
          $magic_feat     = $row3['magic_feat'];
          $magic_skill    = $row3['magic_skill'];
          $magic_no       = $row3['magict_no'];
          $magic_desc     = $row3['magict_desc'];
          $magic_text     = $row3['magict_text'];
//          $spell = substr($magic_desc,"0","4");
//          echo "magic spec $magic_spec  text $magic_text " ;
          if (substr($magic_desc,"0","5") == "spell"){
             $spell = "Y";
          }else{
            $spell = "";
          }
          $featattr_no    = $magic_no;
          // attg is only used for cleric spell divine power or Mages Transformation
          if ($magic_spec == "ATTG"){
               if ($class1_tp == "Cleric" or $class1_tp == "Sorcerer" or $class1_tp == "Wizard" or $class1_tp == "Oracle" or $class1_tp == "Arcanist"){
                      $class1_attg = "Y";
               }else{
                  $class2_attg = "Y";
               }
          }
          if ($magic_spec == "ATTH"){
             if ($magic_bonus_tp == "weapon"){
                $magic_tohit_p = $featattr_no;
              }else{
                 $feat_atth = $feat_atth + $featattr_no;
              }
//              echo "tohit p " . $magic_tohit_p;
           }
           if ($magic_spec == "ATTHS1"){
                $magic_tohit_s1 = $featattr_no;
           }
           if ($magic_spec == "ATTHD"){
              if ($magic_bonus_tp == "weapon"){
                 $magic_damage_p = $featattr_no;
              }else{
                $feat_atthd = $feat_atthd + $featattr_no;
              }
           }
//           echo $magic_spec;
          if ($magic_spec == "ATTHDS1"){
              $magic_damage_s1 = $featattr_no;
  //            echo "damage s1 = $magic_damage_s1";
          }
          if ($magic_spec == "ATTU"){
              $feat_attu += $featattr_no;
          }
          if ($magic_spec == "ATTALL"){
              $feat_attall += $featattr_no;
          }
          if ($magic_spec == "ATTUD"){
              $feat_attud += $featattr_no;
          }



          if ($magic_spec == "ATTR"){
             if ($magic_bonus_tp == "weaponranged"){
                 $magic_tohit_r = $featattr_no;
             }else{
                $feat_attr = $feat_attr + $featattr_no;
             }
          }
          if ($magic_spec == "ATTRD"){
             if ($magic_bonus_tp == "weaponranged"){
                $magic_damage_r = $featattr_no;
             }else{
                $feat_attrd = $feat_attrd + $featattr_no;
             }
          }
          if ($magic_spec == "EXATTA"){
             $feat_exatta = $featattr_no;
             $exatta = "Y";
          }
          if ($magic_spec == "EXATTAP"){
             $feat_exattap = $featattr_no;
             $exattap = "Y";
          }
          if ($magic_spec == "EXATTR"){
             $feat_exattr = $featattr_no;
             $exattr = "Y";
          }
          if ($magic_spec == "EXATTA1"){
             $exatta1 = $exatta1 + 1;
             $feat_exatta1_v = "feat_exatta1" . $exatta1;
             global $$feat_evatta_v;
            $$feat_exatta1_v = $featattr_no;
          }
          if ($magic_spec == "EXATTR1"){
             $exattr1 = $exattr1 + 1;
             $feat_exattr1_v = "feat_exatta1" . $exattr1;
             global $$feat_exattr1_v;
             $$feat_exattr1_v = $featattr_no;
          }
          if ($magic_spec == "MULTI"){
             $feat_multi = $featattr_no;
          }
          if ($magic_spec == "MULTIW"){
             $feat_multiw = $featattr_no;
          }
          if ($magic_spec == "SVWILL"){
             $magic_will_sv += $featattr_no;
          }
          if ($magic_spec == "SVFORT"){
             $magic_fort_sv += $featattr_no;
          }
          if ($magic_spec == "SVREFLEX"){
             $magic_reflex_sv += $featattr_no;
          }
          if ($magic_spec == "NATARMOUR"){
             $mon_nat_armour_ft = $mon_nat_armour_ft + $featattr_no;
          }
          if ($magic_spec == "NATATTACK"){
             $select2 = "select size_cat, size_no from size where size_grapple >  '$size_grapple' order by size_grapple";
             $result2 = mysqli_query($link, $select2) ;
             $count2 = 0;
             $feat_size = "";
             while ($row2 = mysqli_fetch_array($result2) and $count2 <1){
               $count2 =  $count2 + 1;
               $feat_size = $row2['size_cat'];
               $new_size_no_feat = $row2['size_no'];   
            }
          }
          if ($magic_spec == "HP"){
             $magic_hps  = $magic_hps +  $featattr_no;
       //      echo "HP" . $magic_hps;
          }
          if ($magic_spec == "INIT"){
             $feat_init  = $feat_init +  $featattr_no;
          }
          if ($magic_spec == "GRAPPLE"){
             $feat_grapple  = $feat_grapple +  $featattr_no;
          }
          if ($magic_spec == "SHIELD"){
              if ($featattr_no > ($shield_bonus + $magic_shield)){
                 $magic_shield  = $featattr_no;
        //         $magic_armour_touch += $featattr_no;
              }
          }
          if ($magic_spec == "MSHIELD"){
             $magic_shield  += $featattr_no;
          }
          if ($magic_spec == "MARMOUR"){
             $magic_armour  += $featattr_no;
             if ($magic_bonus_tp != "armour"){
               $magic_armour_nac += $featattr_no;
               $magic_armour_touch += $featattr_no;
             }
          }
          if ($magic_spec == "FARSHOT"){
             $range_mod = $range_mod +  $featattr_no;
          }
          if ($magic_spec == "ADDSTR"){
             $mon_str_m +=  $featattr_no;
             if ($spell == "Y"){
                $mon_str_s +=  $featattr_no;
             }
             
          }

          if ($magic_spec == "ADDDEX"){
             $mon_dex_m +=  $featattr_no;
             if ($spell == "Y"){
                $mon_dex_s +=  $featattr_no;
             }
          }
          if ($magic_spec == "ADDCON"){
             $mon_con_m +=  $featattr_no;
             if ($spell == "Y"){
                $mon_con_s +=  $featattr_no;
             }
          }
          if ($magic_spec == "ADDWIS"){
             $mon_wis_m +=  $featattr_no;
             if ($spell == "Y"){
                $mon_wis_s +=  $featattr_no;
             }
          }
          if ($magic_spec == "ADDINT"){
             $mon_int_m +=  $featattr_no;
             if ($spell == "Y"){
                $mon_int_s +=  $featattr_no;
             }
          }
          if ($magic_spec == "ADDCHR"){
             $mon_chr_m +=  $featattr_no;
             if ($spell == "Y"){
                $mon_chr_s +=  $featattr_no;
             }
          }

          if ($magic_spec == "AC"){
             if ($magic_bonus_tp == "deflection"){
                $magic_ac_deflect += $featattr_no;
             }else{
                if ($magic_bonus_tp == "insight"){
                   $magic_ac_insight += $featattr_no;
                }else{
                   if ($magic_bonus_tp == "profane"){
                    $magic_ac_profane += $featattr_no;
                   }else{
                       if ($magic_bonus_tp == "dodge"){
                          $magic_ac_dodge += $featattr_no;
                       }else{
                          if ($magic_bonus_tp == "luck"){
                              $magic_ac_luck += $featattr_no;
                          }else{
                              $magic_ac +=  $featattr_no;
                          }
                       }
                   }
                }
             }
          }
    //         $magic_armour_touch += $featattr_no;

          if ($magic_spec == "FAST"){
             $magic_speed +=  $featattr_no;
          }
           if ($magic_spec == "FEAT"){
               $feat_order = feat_order($magic_feat);

               $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto, feattemp_order) VALUES " .
                "('$user','$magic_feat', '3','Y','feat_order')";
                if (mysqli_query($link, $insert)){
                  $mon_free_feats += 1;
                  $mon_feats += 1;
                }
           }
           if ($magic_spec == "SKILL"){
              if ($magic_skill == "test"){
                 $magic_skill_all +=  $featattr_no;
              }
           }
           if ($magic_spec == "CRIT"){
              $crit_mod = $crit_mod +  $featattr_no;
           }
           if ($magic_spec == "RCRIT"){
              $crit_mod_r = $crit_mod_r +  $featattr_no;
           }
           if ($magic_spec == "ARMCH"){
              $feat_armch +=   $featattr_no;
           }
           if ($magic_spec == "ARMTP"){
              $feat_armtp +=   $featattr_no;
           }
           if ($magic_spec == "SIZE+"){
                   $select2 = "select size_cat, size_no from size where size_cat = '$mon_size_u'";
                   $result2 = mysqli_query($link, $select2) ;
                   $row2 = mysqli_fetch_array($result2);
                   $size_no = $row2['size_no'];
                   $size_no += $featattr_no;
                   if ($size_no > 9){
                      $size_no = 9;
                   }
                   $select2 = "select size_cat, size_no from size where size_no = '$size_no'";
                   $result2 = mysqli_query($link, $select2) ;
                   $row2 = mysqli_fetch_array($result2);
                   $size_cat = $row2['size_cat'];
                   if ($size_cat != $mon_size) {
                     if ($magic_desc == "spell: Enlarge Person" or  $magict_desc == "spell: Enlarge Person, Mass"){
                       $mon_str_m += 2;
                       $mon_dex_m -= 2;
                       $mon_size_m = $size_cat;
                       if ($spell == "Y"){
                         $mon_str_s += 2;
                         $mon_dex_s -= 2;
                         $mon_size_s = $size_cat;
                       }
                     }
                     if ($magic_desc == "spell: Animal Growth"){
                  //     echo "Animal Growth";
                       $mon_str_m += 8;
                       $mon_dex_m -= 2;
                       $mon_con_m +=4;
                       $mon_size_m = $size_cat;
                       if ($spell == "Y"){
                         $mon_str_s += 8;
                         $mon_dex_s -= 2;
                         $mon_con_s +=4;
                         $mon_size_s = $size_cat;
                       }
                     }

                   }

           }
           if ($magic_spec == "SPEEDMEDNORM"){
             $speedmednorm = "Y";
           }
           if ($magic_spec == "SVTEXT"){
             if ($save_text != ""){
                $save_text .= ", ";
             }else{
                $save_text = "; ";
             }
             $save_text .= $magic_text;
 //            echo "save text = $save_text";
           }
           if ($magic_spec == "ACTEXT"){
             if ($AC_text != ""){
                $AC_text .= ", ";
             }else{
                $AC_text = "; ";
             }
             $AC_text .= $magic_text;
   //         echo "AC_text = $AC_text";
           }
           if ($magic_spec == "SIZE-"){
               $select2 = "select size_cat, size_no from size where size_cat = '$mon_size_u'";
               $result2 = mysqli_query($link, $select2) ;
               $row2 = mysqli_fetch_array($result2);
               $size_no = $row2['size_no'];
               $size_no -= $featattr_no;
               if ($size_no < 1){
                  $size_no = 1;
               }
               $select2 = "select size_cat, size_no from size where size_no = '$size_no'";
               $result2 = mysqli_query($link, $select2) ;
               $row2 = mysqli_fetch_array($result2);
               $size_cat = $row2['size_cat'];

               if ($size_cat != $mon_size){
                   $mon_str_m -= 2;
                   $mon_dex_m += 2;
                   $mon_size_m = $size_cat;
                   if ($spell == "Y"){
                     $mon_str_s -= 2;
                     $mon_dex_s += 2;
                     $mon_size_s = $size_cat;
                   }
               }
           }
           if ($magic_spec == "DEXDAM"){
             $finess_damage = "Y";
       //      $dam_feat_p = $mon_dex_bonus - $mon_str_bonus;
           }
       }
     }


}
function printMagic(){
   global $key_1, $mon_shield, $mon_armour, $mon_weap_p, $mon_weap_r, $mon_weap_s1;
//   echo "magic key 1 = $key_1";
   if ($key_1 == ""){
       $key_1 = "dd35";
   }
   global $user, $total_spent,$total_gp, $header;
   $print = "";
   $html = "";
   $total_value = 0;
   $html_s = "";
   $select = "SELECT magicbody_id from magicbody order by magicbody_id";
   $link = getDBLink();
   $result = mysqli_query($link, $select);
   $print .= "\n\n MAGIC ITEMS (max value $total_gp) \n";
   $html .= $header ."<b>MAGIC ITEMS (max value $total_gp)</b></div>";

   while ($row = mysqli_fetch_array($result)){
       $number = 1;
       $max = 2;
       $body = $row['magicbody_id'];
 //      echo $body;

       if ($body == "RING"){
          $max = 3;
       }else{
          if($body == "MISC"){
             $max = 5;
          }else{
             if($body == "WAND"){
               $max = 5;
             }else{
                if($body == "POTIONS"){
                   $max = 5;
                }else{
                   if ($body == "PSICRYSTAL"){
                      $max = 2;
                   }else{
                     if ($body == "SCROLL"){
                        $max = 5;
                     }else{
                       if ($body == "WEAPONA"){
                        $max = 3;
                       }else{
                           if ($body == "WEAPONA_SPEC"){
                             $max = 3;
                           }else{
                               if ($body == "WEAPONA_MAT"){
                                 $max = 3;
                               }else{
                                 if ($body == "WEAPONB"){
                                 $max = 3;
                               }
                             }
                           }

                       }
                     }
                   }
                }
             }
          }
       }
       while ($number < $max){
           $body2 = $body;
           if ($body == "WEAPONA" and $number == 1){
               $body2 = "WEAPONA";
           }
           if ($body == "WEAPONB" ){
               $body2 = "WEAPONB";
               $number = 2;
           }
           if ($body == "WEAPONB_SPEC"){
               $body2 = "WEAPONB_SPEC";
               $number = 2;
           }
           if ($body == "WEAPONB_MAT" ){
               $body2 = "WEAPONB_MAT";
               $number = 2;
           }
          $magic_item_v = "magic_" . $body2 . "_" . $number;
          global $$magic_item_v;
          $magic_item = $$magic_item_v;
//          echo $magic_item_v . " = "  . $magic_item;
          if ($magic_item != ""){
             $magic_found = "Y";

             $select2 = "SELECT magic_name, magic_desc, magic_value, magic_price_bonus from magic2 where magic_name = '$magic_item'" .
                         "and mon_key_1 = '$key_1' order by magic_body";
 //            echo $select2;
             $result2 = mysqli_query($link, $select2);
              while ($row2 = mysqli_fetch_array($result2)){
                 $magic_desc = $row2['magic_desc'];
                 $magic_value = $row2['magic_value'];
                 $magic_price_bonus = $row2['magic_price_bonus'];
                 if ($magic_price_bonus > 0){
                    $magic_value = "+" . $magic_price_bonus;
                 }else{
                    $total_value += $magic_value;
                 }
                 if ($body == "PSICRYSTAL"){
                    $magic_item = "Psicrystal " . $magic_item;
                 }
                 if ($body == "ARMOUR"){
                    $magic_item = $magic_desc;
                    $magic_desc =  $mon_armour;
                //    $magic_item = "";
                 }
                 if ($body == "SHIELD"){
                    $magic_item = $magic_desc;
                    $magic_desc =  $mon_shield;
                 //   $magic_item = "";
                 }
                 if ($body == "WEAPONA"){
                    $magic_item = $magic_desc;
                    $magic_desc =  $mon_weap_p;
                 //   $magic_item = "";
                 }
                 if ($body == "WEAPONB"){
                    $magic_item = $magic_desc;
                    $magic_desc =  $mon_weap_s1;
                 //   $magic_item = "";
                 }
                 if ($body == "WEAPONR"){
                    $magic_item = $magic_desc;
                    $magic_desc =  $mon_weap_r;
                 //   $magic_item = "";
                 }
                 if ($body == "ARMOUR_SPEC"){
                    $magic_desc =  ": " . $magic_desc;
                //    $magic_item = "";
                 }
                 if ($body == "SHIELD_SPEC"){
                    $magic_desc =  ": " . $magic_desc;
                //   $magic_item = "";
                 }
                 if ($body == "WEAPONA_SPEC"){
                    $magic_desc =  ": " . $magic_desc;
                 //   $magic_item = "";
                 }
                 if ($body == "WEAPONB_SPEC"){
                    $magic_desc =  ": " . $magic_desc;
                 //   $magic_item = "";
                 }
                 if ($body == "WEAPONR_SPEC"){
                    $magic_desc =  ": " . $magic_desc;
                 //   $magic_item = "";
                 }
                 if ($body == "WEAPONA_MAT" ){
                    $magic_desc =  ": " . $magic_desc;
                 //   $magic_item = "";
                 }
                 if ($body == "WEAPONB_MAT" ){
                    $magic_desc =  ": " . $magic_desc;
                 //   $magic_item = "";
                 }
                 if ($magic_price_bonus > 0){
                   $print .= "\n" . $magic_item . " " . $magic_desc . " (" . $magic_value . " bonus)";
                   $html .=  $magic_item . " " . $magic_desc . " (" . $magic_value . " bonus) </BR>";
                   $html_s .=  $magic_item . " " . $magic_desc . ", ";
                 }else{
                   $print .= "\n" . $magic_item . " " . $magic_desc . " (" . $magic_value . "gp)";
                   $html .=  $magic_item . " " . $magic_desc . " (" . $magic_value . "gp) </BR>";
                   $html_s .=  $magic_item . " " . $magic_desc . ", ";
                 }
              }
          }
          $number += 1;
       }
   }
   $print .=  "\n\n Total Value = " . $total_value;
   $html .=  "</BR></BR><b> Total Value = " . $total_value . "</b>";
   global $magic_html_print,$magic_html_print_s ;
   $magic_html_print = $html;
   $html_s = "<b>ITEMS: </b>"  .   $html_s;

   $magic_html_print_s = $html_s;
   return $print;
}
/* Returns the Monster Selection HTML */
function getTemplateSelectionHTML($currentlySelected) {
        global  $wp_user, $key_1;
        if ($key_1 == ""){
           $key_1 = "dd35";
        }
//        if ($wp_user == "admin"){
//            $wp_user = "Industrious1";
//        }

//        echo "wp_user = $wp_user";
	$html = '<LABEL id="monsterTypeLabel">Template<SELECT NAME="mon_tem" >';
        $mon_sel = '' ;
	$mon_hd  = 0 ;

	if ($mon_sel == $currentlySelected)     {
	  $sel = " SELECTED" ;
	} else {
		$sel = "" ;
        }

	$html .= '<OPTION VALUE="'.$mon_sel.'" '.$sel.' >None</OPTION>';


	$select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
	                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
	                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
	                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
	                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
	                 "mon_armour, mon_shield from monster2 where mon_template = 'T' and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1') " .
                         " and (mon_delete <> 'Y' or mon_delete = NULL) order by mon_name";

	$link = getDBLink();
	$result = mysqli_query($link, $select) ;

	while ($row = mysqli_fetch_array($result)) {

		$mon_sel = $row['mon_name'] ;
		$mon_hd  = $row['mon_hd'] ;

		if ($mon_sel == $currentlySelected)     {
		  $sel = " SELECTED" ;
		} else {
		  $sel = "" ;
                }

		$html .= '<OPTION VALUE="'.$mon_sel.'" '.$sel.' >'.$mon_sel.'</OPTION>';
	}
	mysqli_close($link);

	$html .= '</SELECT></LABEL>';

	return $html;

}
/* Returns the Monster Selection HTML */
function getTemplateSelection2HTML($currentlySelected) {
        global  $wp_user, $key_1;
        if ($key_1 == ""){
           $key_1 = "dd35";
        }

//        echo "wp_user = $wp_user";
	$html = '<LABEL id="monsterTypeLabel">Template 2<SELECT NAME="mon_tem2" >';
        $mon_sel = '' ;
	$mon_hd  = 0 ;

	if ($mon_sel == $currentlySelected)     {
	  $sel = " SELECTED" ;
	} else {
		$sel = "" ;
        }

	$html .= '<OPTION VALUE="'.$mon_sel.'" '.$sel.' >None</OPTION>';


	$select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
	                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
	                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
	                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
	                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
	                 "mon_armour, mon_shield from monster2 where mon_template = 'T' and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1') " .
                         " and (mon_delete <> 'Y' or mon_delete = NULL) order by mon_name";

	$link = getDBLink();
	$result = mysqli_query($link, $select) ;

	while ($row = mysqli_fetch_array($result)) {

		$mon_sel = $row['mon_name'] ;
		$mon_hd  = $row['mon_hd'] ;

		if ($mon_sel == $currentlySelected)     {
		  $sel = " SELECTED" ;
		} else {
		  $sel = "" ;
                }

		$html .= '<OPTION VALUE="'.$mon_sel.'" '.$sel.' >'.$mon_sel.'</OPTION>';
	}
	mysqli_close($link);

	$html .= '</SELECT></LABEL>';

	return $html;

}


function addTemplate($mon_template){
//   echo "template 2 " . $mon_template;
   global  $wp_user, $key_1, $user, $weretemp;
   if ($key_1 == ""){
       $key_1 = "dd35";
   }

   $select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
	    "mon_init ,mon_speed, mon_speed_fly ,mon_ac_flat , mon_ac ,mon_ac_deflect, mon_ac_insight, mon_ac_profane, mon_ac_profane, mon_ac_dodge, mon_ac_luck, " .
	    "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
	    "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
	    "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
	    "mon_armour, mon_shield, montype_skillp, montype_att from monster2, montype2 where mon_name = '$mon_template' and mon_type = montype " .
	    "and (monster2.mon_key_1 = '$wp_user' or monster2.mon_key_1 ='$key_1') and montype2.mon_key_1 = '$key_1'";
 //   echo $select;
    $link = getDBLink();
    $result = mysqli_query($link, $select) ;
    global $tem_cr, $tem_type, $tem_ac_deflect, $tem_ac_insight, $tem_ac_profane, $tem_ac_luck, $tem_ac_dodge;
    global $tem_sv_will, $tem_sv_fort, $tem_sv_reflex, $montype_att;
    $row = mysqli_fetch_array($result);
    $tem_type = $row['mon_type'];
    $tem_size = $row['mon_size'];
    $tem_hd = $row['mon_hd'];
    $tem_speed = $row['mon_speed'];
    $tem_speed_fly = $row['mon_speed_fly'];
    $tem_ac_flat = $row['mon_ac_flat'];
    $tem_ac_deflect_1 = $row['mon_ac_deflect'];
    if ($tem_ac_deflect_1 > $tem_ac_deflect){
        $tem_ac_deflect = $tem_ac_deflect_1;
    }
    $tem_ac_insight_1 = $row['mon_ac_insight'];
    if ($tem_ac_insight == "" or $tem_ac_insight_1 > $tem_ac_insight){
       $tem_ac_insight = $tem_ac_insight_1;
    }
  //  echo "ac insight $tem_ac_insight";
    $tem_ac_profane_1 = $row['mon_ac_profane'];
    if ($tem_ac_profane == "" or $tem_ac_profane_1 > $tem_ac_profane){
       $tem_ac_profane = $tem_ac_profane_1;
    }
    $tem_ac_luck_1 = $row['mon_ac_luck'];
    if ($tem_ac_luck == "" or $tem_ac_luck_1 > $tem_ac_luck){
       $tem_ac_luck = $tem_ac_luck_1;
    }
    $tem_ac_dodge_1 = $row['mon_ac_dodge'];
    if ($tem_ac_dodge == "" or $tem_ac_dodge_1 > $tem_ac_dodge){
       $tem_ac_dodge = $tem_ac_dodge_1;
    }
    $tem_base_att = $row['mon_base_att'];
    $tem_space = $row['mon_space'];
    $tem_reach = $row['mon_reach'];
    $tem_cr += $row['mon_cr'];

    $tem_str = $row['mon_str'];
    $tem_dex = $row['mon_dex'];
    $tem_con = $row['mon_con'];
    $tem_int = $row['mon_int'];
    $tem_wis = $row['mon_wis'];
    $tem_chr = $row['mon_chr'];
    $tem_sv_fort = $row['mon_sv_fort'];
    $tem_sv_reflex = $row['mon_sv_reflex'];
    $tem_sv_will = $row['mon_sv_will'];
    $skillp = $row['montype_skillp'];
    $tem_att = $row['montype_att'];

    //echo $tem_att;
    global $mon_str, $mon_int, $mon_wis, $mon_dex, $mon_con, $mon_chr, $mon_cr, $mon_space, $mon_reach, $mon_speed, $mon_base_att, $mon_type, $mon_level;
    global $mon_ac_flat, $tem_die, $tem_level, $tem_skillp, $tem_hd_override, $mon_speed_fly, $mon_size, $magic_ac_deflect, $magic_ac_insight, $magic_ac_profane, $magic_ac_dodge;
    global $magic_ac_luck, $montype_att;
    global  $calc_mon_feats, $mon_feats, $mon_free_feats, $_POST, $zombie, $zombie_tem, $mon_hd_original, $tem_base_att, $half_fiend_temp, $fiendish_temp, $foo_temp, $fay_temp, $skeleton_tem, $exoskeleton_tem;
    global $animal_companion, $animal_companion_hd, $mon_chr_bonus, $mon_speed_fly_save, $mythic_temp, $mythic_count;
// if size is not medium find the size difference from medium abd apply this to the mon_size
//  size change will not change the stats, the template stats will be used to adjust the stats

    if ($tem_size != "Medium"){
       $select1 = "select size_no from size where size_cat = '$tem_size'";
       $result1 = mysqli_query($link, $select1) ;
       $row1 = mysqli_fetch_array($result1);
       $tem_size_no = $row1['size_no'];
       $select2 = "select size_no from size where size_cat = '$mon_size'";
       $result2 = mysqli_query($link, $select2) ;
       $row2 = mysqli_fetch_array($result2);
       $old_size_no = $row2['size_no'];
       $new_size_no = $tem_size_no - 5 + $old_size_no;
       $select3 = "select size_cat from size where size_no = $new_size_no";
       $result3 = mysqli_query($link, $select3) ;
       $row3 = mysqli_fetch_array($result3);
       $mon_size = $row3['size_cat'];
    }

    if ($tem_speed > $mon_speed and $tem_speed != "30"){
       $mon_speed = $mon_speed + $tem_speed - 30;
    }
    if ($tem_speed < 30){
       $diff = 30 - $tem_speed;
       $mon_speed = $mon_speed - $diff;
       if ($mon_speed < 5){
          $mon_speed = 5;
       }
    }
    $fey_creature = stripos($mon_template, "Fey Creature");
    $foo_creature = stripos($mon_template, "Foo Creature");
    $half_dragon = stripos($mon_template, "Half-dragon");
    $half_fiend = stripos($mon_template, "Half-Fiend");
    $fiendish = stripos($mon_template, "Fiendish");
    $half_celestial = stripos($mon_template, "Half-celestial");
    $zombie_tem = stripos($mon_template, "Zombie");
    $skeleton_tem = stripos($mon_template, "Skeleton");
    $skeletal_tem = stripos($mon_template, "Skeletal");
    $exoskeleton_tem   =  stripos($mon_template, "Exoskeleton");
    $dread_skeleton_tem = stripos($mon_template, "Dread Skeleton");
    $dread = stripos($mon_template, "Dread");
    $animal_companion = stripos($mon_template, "Animal Companion");
    $awakened  = stripos($mon_template, "Awakened");
    $mythic  = stripos($mon_template, "Mythic");
    if ($mythic === 0){
        $mythic_temp = "Y";
        $mythic_count += 1;
        if ($tem_speed_fly > 0 and $mon_speed_fly > 0){
           $mon_speed_fly += $tem_speed_fly;
        }   
    }
    $skeleton = "";
    if ($skeleton_tem === 0 or $exoskeleton_tem === 0 or($skeletal_tem === 0 and $key_1 == "dd35")){
       $skeleton = "Y";
       $zombie_tem = 0;
    }
 //   echo   "fey_creature = $fey_creature";
//    echo "awake =  $awakened";
    if ($mon_template == "Zombie Juju"){
       $zombie_tem = "";
    }

  //  echo 'zombie_tem = $zombie_tem';

    if ($zombie_tem === 0 and $key_1 == "dd35"){
            $mon_chr = 1;
    }
    $dread_temp = "";
    $half_fiend_temp = "";
    $fiendish_temp = "";
    $foo_temp = "";

    if ($dread_skeleton_tem === 0){
      $dread_skeleton = "Y";
    }
    if ($dread === 0){
        $dread_temp = "Y";
    }
    if ($half_fiend === 0){
       $half_fiend_temp = "Y";
    }
    if ($fiendish === 0){
       $fiendish_temp = "Y";
    }
    if ($foo_creature === 0){
       $foo_temp = "Y";
    }
    $fey_temp = "";
    if ($fey_creature === 0){
       $fey_temp = "Y";
    }
    $tem_skillp = '';
    if ($half_dragon === 0 or $half_fiend === 0 or $half_celestial === 0){
//        echo "change int";
       $tem_skillp = $skillp;
   //    echo "$key_1 $mon_size";
       if ($half_dragon === 0 ){
          if ($key_1 == "path" or ($key_1 == "dd35" and ($mon_size == "Large" or $mon_size == "Huge" or $mon_size == "Gargantuan" or $mon_size == "Colossal"))){
              $tem_speed_fly = $mon_speed * 2;
     //               echo "here $tem_speed_fly";
          }
       }else{
          $tem_speed_fly = $mon_speed * 2;
       }
    }
    if ($fey_temp == "Y"){
        $mon_speed_fly = $mon_speed * 1.5;
        $div = $mon_speed_fly / 5;
//        echo "div = $div";
        $div2 = intval($div);
//        echo "div2 = $div2";
        $mon_speed_fly_save_x = $div2 * 5;
        if ($mon_speed_fly_save_x > $mon_speed_fly_save){
            $mon_speed_fly_save = $mon_speed_fly_save_x;
        }
//        $mon_speed_fly_save = $mon_speed_fly;
//        echo "mon_speed_fly_save $mon_speed_fly_save";
    }else{
       if ($tem_speed_fly > $mon_speed_fly){
         $mon_speed_fly = $tem_speed_fly;
       }
    }
  //  echo " fly = $mon_speed_fly";
    $celestial = stripos($mon_template, "celestial");
//    echo "celestial=" . $celestial;
    if ($celestial === 0){
//        echo "change int";
       if ($mon_int < 3){
          $mon_int = "3";
       }
    }
    // if awakened set int to 11 as default
    if ($awakened === 0){
  //    echo "here";
       if ($mon_int < 11){
          $mon_int = 11;
       }
    }
    $weretemp = "";
    $were =  stripos($mon_template, "were");
//    echo "were " . $were;
    if  ($were === 0){
//       echo "were";
       if (stripos($mon_template, "human")){
           $mon_ac_flat += 2;
           $weretemp = "human";
//           echo "Human";
       }else{
          if (stripos($mon_template, "hybrid")){
             $weretemp = "hybrid";
//             echo "Hybrid";
             if ($mon_ac_flat > $tem_ac_flat -2 ){
                 $mon_ac_flat += 2;
             }else{
                 $mon_ac_flat = $tem_ac_flat;
             }
          }else{
              $weretemp = "animal";
//              echo "animal";
              $mon_ac_flat = $tem_ac_flat;
          }
       }
    }else{
 //       echo "mon ac flat $mon_ac_flat";
        $mon_ac_flat += $tem_ac_flat - 10;
 //       echo "tem ac flat $tem_ac_flat";
    }
    //worm that walks does not have any nat armor
    if ($mon_template ==  "Worm That Walks"){
       $mon_ac_flat = 10;
    }
    // if natural armor has gone negative then set to zero
    if ($mon_ac_flat < 0){
       $mon_ac_flat = 0;
    }
    //sketetons and zombles don't use there ariginal natural armor
    if ($zombie_tem === 0){
       $mon_ac_flat = $tem_ac_flat;
    }
//    echo "weretemp " . $weretemp;
    if ($weretemp == "" or $key_1 != "path"){
  //    echo "wrong";
      $mon_str = temStats($tem_str, $mon_str);
      $mon_int = temStats($tem_int, $mon_int);
      $mon_wis = temStats($tem_wis, $mon_wis);
      $mon_dex = temStats($tem_dex, $mon_dex);
      $mon_con = temStats($tem_con, $mon_con);
      $mon_chr = temStats($tem_chr, $mon_chr);
    }
    if ($fey_temp == "Y" and $mon_int == 0){
       $mon_int = "3";
    }

    if ($weretemp == "human" and $key_1 == "path"){
        $mon_wis += 2;
        $mon_chr -= 2;
    }
    if (($weretemp == "animal" or $weretemp == "hybrid") and $key_1 == "path"){
  //      echo "</BR> animal";
        if ($mon_wis > $tem_wis -2){
           $mon_wis += 2;
        }else{
           $mon_wis = $tem_wis;
        }
        if ($mon_chr > $tem_chr -4){
           $mon_chr -= 2;
        }else{
           $mon_chr = $tem_chr;
        }
        if ($mon_str > $tem_str -2){
           $mon_str += 2;
        }else{
           $mon_str = $tem_str;
        }
        if ($mon_con > $tem_con -2){
           $mon_con += 2;
        }else{
           $mon_con = $tem_con;
        }
        if ($mon_dex > $tem_dex){
           $mon_dex += 0;
        }else{
           $mon_dex = $tem_dex;
        }
    }

//  attacks and saves
//Get monster level
//
  $d = strpos($tem_hd,"D");
  if ($d == FALSE){
     $d = strpos($tem_hd,"d");
  }
  if ($d == FALSE){
    $tem_die = "D8";
    $tem_level = $tem_hd;
  }else{
    $len = strlen($tem_hd);
    $tem_level = substr($tem_hd,0,($d));
    $tem_die = substr($tem_hd,$d,$len);
  }
  if ($animal_companion === 0 and $key_1 == "dd35"){
     $animal_companion = "Y";
     $animal_companion_hd = $tem_level;
  }
  if ($zombie_tem === 0 and $key_1 == "dd35"){

     $tem_level = $mon_level;
  //   echo "tem_level = " . $tem_level;
     if ($tem_level == 0 or $tem_level == ""){
        $tem_level = 1;
  //      echo "tem_level 6 = " . $tem_level;
     }else{
        if ($skeleton == "Y"){
           $tem_level = 0;
        }
     }
     if ($tem_level > 10){
        if ($tem_level >= 20){
           $tem_level = 0;
//             echo "tem_level 4 = " . $tem_level;
        }else{
           $tem_level = 20 - $tem_level ;
//            echo "tem_level 5 = " . $tem_level;
       }
     }
//      echo "tem_level 2 = " . $tem_level;
     $tem_die = "d12";
//      echo "tem level 3= " . $tem_level;
  }
  $tem_hd_override = "";
//  echo "half dragon = " . $half_dragon;
  if ($half_dragon === 0 and $key_1 != "path"){
      $tem_hd_override = "Y";
//      echo "setting override" ;
  }
//  echo "pat int = " . $_POST['mon_int'];
  if (!isset($_POST['mon_int'])){
         $_POST['mon_int'] = "";
  }
  if ($mon_int == 0 and ($_POST['mon_int'] == "" or $_POST['mon_int'] == 0)){
         $delete = "DELETE FROM skilltemp WHERE skillt_user = '$user'";
 // echo "</BR>" . $delete ;
         $result = mysqli_query($link, $delete) ;
         $delete = "delete from feattemp where feattemp_user = '$user'";
//  echo "</BR> " . $delete;
         $result = mysqli_query($link, $delete) ;
         $calc_mon_feats = 0;
         $mon_feats = 0;
         $mon_free_feats = 0;
         if ($key_1 == "path"){
            $mon_chr = 10;
         }
         $mon_wis = 10;
         $zombie = "Y";
  }
  $x = tem_feats($mon_template);
  $x = tem_skills($mon_template);
  $x = addskillrb($mon_template);
  $x = tem_weapons($mon_template);
  if (is_numeric($tem_level)){
    $tem_level = $tem_level;
  }else{
    $tem_level = 0;
  }
//  Animal companions want the level added to monster level
  if ($animal_companion != "Y"){
    $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level where lev_no = $tem_level" ;
//           echo $select;
   $link = getDBLink();
//include $includePathLocal.'/includes/dd_db_conn.txt';
    global $tem_will_sv,  $tem_fort_sv, $tem_reflex_sv;

    $result = mysqli_query($link, $select) ;
    if (mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      $tem_lev_savg = $row['lev_savg'] ;
      $tem_lev_savp = $row['lev_savp'] ;
      $tem_lev_attg = $row['lev_attg'] ;
      $tem_lev_atta = $row['lev_atta'] ;
      $tem_lev_attp = $row['lev_attp'] ;
//    $mon_lev_sklr += $row['lev_sklr'] ;
//    $mon_lev_sklx += $row['lev_sklx'] ;
//    $mon_lev_feat == $row['lev_feat'] ;
//    $mon_lev_abil += $row['lev_abil'] ;
  }
  // 29/12/2011 changed tem_sv to += for second template
    if ($tem_sv_will == 'G'){
       $tem_will_sv += $tem_lev_savg;
    }else{
        $tem_will_sv += $tem_lev_savp;
    }
    if ($tem_sv_fort == 'G'){
        $tem_fort_sv += $tem_lev_savg;
    }else{
        $tem_fort_sv += $tem_lev_savp;
    }
    if ($tem_sv_reflex == 'G'){
        $tem_reflex_sv += $tem_lev_savg;
    }else{
        $tem_reflex_sv += $tem_lev_savp;
    }
    if ($tem_att == "G"){
     $tem_base_att += $tem_lev_attg;
    }
    if ($tem_att == "A"){
       $tem_base_att += $tem_lev_atta;
    }
    if ($tem_att == "P"){
      $tem_base_att += $tem_lev_attp;
    }
   // echo $tem_base_att;
  }
  //dread undead do not chand their bab
//    echo "dread = " . $dread;
  if ($tem_type == "Undead" and $dread_temp != "Y" ){
 //     echo "dread = " . $dread;
      $montype_att = $tem_att;
  }
  if ($zombie_tem ===0 and $key_1 =="dd35" ){
     $tem_level = $mon_level;
     $level_zom = $mon_level + $tem_level;
     $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
 "lev_abil from level2 where lev_no = $level_zom and mon_key_1 = '$key_1'" ;
//  $link = getDBLink();
//include $includePathLocal.'/includes/dd_db_conn.txt';
     $result = mysqli_query($link, $select) ;
     if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        global $mon_will_sv,  $mon_fort_sv, $mon_reflex_sv;
        $mon_base_att = $row['lev_attp'] ;
        $mon_will_sv = $row['lev_savg'];
        $mon_fort_sv = $row['lev_savp'];
        $mon_reflex_sv = $row['lev_savp'];
        $tem_will_sv = 0;
        $tem_fort_sv = 0;
        $tem_reflex_sv = 0;
//          echo "base att = ". $mon_base_att . " level = " . $level_zom;
     }
//     echo "base att = ". $mon_base_att . " level = " . $level_zom;
  }

  mysqli_close($link);

}
function temCR($mon_template){
    global  $wp_user, $key_1, $user, $weretemp, $temCR;
    global $total_level;
   $link = getDBLink();
   $select2 = "select monspec_value, monspec_min, monspec_max from monspec2 where mon_name = '$mon_template' and monspec_name = 'CR +' and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user')";
    $result2 = mysqli_query($link, $select2) ;
//    echo $select2;
//         echo "total_level " . $total_level;
    while ($row2 = mysqli_fetch_array($result2)){
        $min = $row2['monspec_min'];
        $max = $row2['monspec_max'];
 //        echo "min $min max $max";
        if ($total_level >= $min and $total_level <= $max){
            $temCR +=  $row2['monspec_value'];
 //           echo "tem cr = $temCR";
        }
    }
    mysqli_close($link);
}

function temStats($tem,$stat){
  if ($tem > 0.5 and $stat > 0.5){
     $bonus =  $tem - 11;
     $stat += $bonus;
     if ($stat < 1){
        $stat = 1;
     }
     return($stat);
  }else{
     return(0);
  }

}
function tem_feats($mon_name){
  global $key_1,$wp_user;
  global $user, $tem_level;
  global $tem_free_feats, $mon_int, $tem_feats;
  if ($key_1 == ""){
      $key_1 = "dd35";
  }
  // animal companions have free feats
  $animal_companion = stripos($mon_name, "Animal Companion");
  if ($animal_companion === 0){
    $animal_companion = "Y";
//     echo "***animal***";
  }
  $link = getDBLink();
  $select = "select monfeat from monfeat2 where mon_name = '$mon_name' and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1')";
  //  echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){


    while ($row = mysqli_fetch_array($result)) {
      $feat = $row['monfeat'];
// if feat is a proficiecy do not include this in the count for the monster as these are free
      if ($feat == "Armour prof light" or $feat == "Armour prof medium" or $feat == "Armour prof heavy" or
          $feat == "Simple Weapon Proficiency" or $feat == "Martial Weap Prof" or $feat == "Shield Proficiency"
           or $animal_companion == "Y"){
          $tem_free_feats = $tem_free_feats + 1;
     //     echo "</BR> Free " . $feat;

      }


//      echo "</BR> feat" . $feat;
//      echo  "user " . $user . " mon " . $mon_name;
      $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto) VALUES " .
                "('$user','$feat', '3','Y')";

// echo "</BR> $insert";
      $result1 = mysqli_query($link, $insert);
      if ($result1){
        $tem_feats = $tem_feats + 1;
//        if ($wp_user == "admin"){
//           echo "temp feats = $feat";
//        }
      }
    }
   }
  //  if ($wp_user == "admin"){
  //     echo "1 tem_feats = $tem_feats";
 //   }
 //   if ($wp_user == "admin"){
 //      echo "1 feats = $feat";
//    }
//  Checks for free feats of monster
   if ($tem_level > 0 ){
       $calc_mon_feats =  round((($tem_level /3) -0.49),0) + 1;
//       echo "round " . round((($tem_level /3) -0.49),0);
       if ($mon_int == 0){
         $calc_mon_feats = 0;
       }
//       echo "calc " . $calc_mon_feats . " tem " . $tem_feats . " level " . $tem_level ;
       if ($calc_mon_feats < ($tem_feats - $tem_free_feats)){
         $diff = $tem_feats - ($calc_mon_feats + $tem_free_feats);
//         echo "diff " . $diff;
         $tem_free_feats +=  $diff;
       }
   }
  // echo "</BR> tem_free feats . $tem_free_feats;";
   mysqli_close($link);

}
function tem_skills($mon_name){
    $link = getDBLink();

  global $user, $wp_user, $key_1;
  if ($key_1 == ""){
     $key_1 = "dd35";
  }

  $select = "SELECT monskill_tp, monskill_val,skill_atr, skill_armour_ch from monskill2, skills WHERE mon_name = '$mon_name'".
             " AND monskill_tp = skill_cd and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1')" ;
//  echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  $count = 0;
  while ($row = mysqli_fetch_array($result)) {
    $count += 1;
    $skill = $row['monskill_tp'];
    $rank  = $row['monskill_val'];
    $atr   = $row['skill_atr'];
    $atr_bonus = "";
    $misc_bonus = "";
    $armour_ch = $row['skill_armour_ch'];
    if ($skill == "Spot" or $skill == "Listen"){
       $xskill = "Y";
    }else{
       $xskill = "";
    }
    if ($rank != ""){
     $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
               "skillt_misc_bonus , skillt_xskill, skillt_armour_ch) " .
               "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch')";
      if (!mysqli_query($link, $insert)){
         $select2 = "SELECT skillt_rank from skilltemp where skillt_user = '$user' and skillt_skill = '$skill'";
         $result2 = mysqli_query($link, $select2) ;
         $row2 =  mysqli_fetch_array($result2);
         $skillt_rank = $row2['skillt_rank'];

         $rank += $skillt_rank;
         $update = "UPDATE skilltemp set skillt_rank = '$rank'  where skillt_user = '$user' and skillt_skill = '$skill'";
         $result3 = mysqli_query($link, $update) ;
      }
//
//      echo $update . " </BR>";
     }
   }
   mysqli_close($link);
}
function tem_weapons($mon_name){
 $link = getDBLink();
 global $wp_user, $key_1, $temp_weapons_flag;
 if ($key_1 == ""){
    $key_1 = "dd35";
 }

 $select = "select monweap_attp, monweap_wp, weap_dam, weap_dam2, weap_type, weap_cat, dambase_no, dambase_incr,".
            " monweap_dam from " .
             "monweap2, weapons, dddambase where ".
             "monweap_mon = '$mon_name' and monweap_wp = weap_id and weap_dam = dambase " .
             "and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1')";
//  echo "</BR> " . $select. "/BR";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)) {

        $attp = strtolower($row['monweap_attp']);
        $mon_weap_v = "mon_weap_" . $attp ;

        $weap_dam_v = "weap_dam_" . $attp ;
        $weap_dam2_v = "weap_dam2_" . $attp ;
        $weap_type_v = "weap_type_" .$attp ;
        $weap_cat_v  = "weap_cat_" . $attp;
        $monweap_dam_v = "monweap_dam_" .$attp;
        $weap_dambase_no_v = "monweap_dambase_no_" . $attp;
        $weap_dambase_incr_v = "monweap_dambase_incr_" . $attp;
        $$mon_weap_v = $row['monweap_wp'];
        $weapon =  $$mon_weap_v;
        $weapon = trim ($weapon);
        global $$weap_dambase_no_v;
        $old_dam_base = $$weap_dambase_no_v ;

      //  $select2 = "select dambase_no from dddambase where dambase = '$old_dam_base'";
     //   echo $select2;
     //   $result2 = mysqli_query($link, $select2) ;
     //   while ($row2 = mysqli_fetch_array($result2)){
     //     $old_dambase_no = $row2[dambase_no];
     //   }



        // only default weapons if bigger than natural weapon
    //    echo $row['dambase_no'] .   $old_dam_base . "</BR>";
        if ($weapon != "" and $weapon != "No Melee" and $row['dambase_no'] > $old_dam_base or $mon_name == "Worm That Walks"){
          $$weap_cat_v    = $row['weap_cat'];
          if ($$weap_cat_v == "0-Natural"){
            global $$mon_weap_v, $$weap_dam_v, $$weap_dam2_v, $$weap_type_v, $$weap_cat_v, $$monweap_dam_v;
            global $$weap_cat_v, $$weap_dambase_no_v, $$weap_dambase_incr_v;
            $$weap_cat_v    = $row['weap_cat'];
            $$mon_weap_v = $weapon;

          }


          $temp_weapons_flag = "Y";
     //     echo "temp weapons " . $weapon;

          $$weap_dam_v = $row['weap_dam'];
          $$weap_dam2_v = $row['weap_dam2'];
          $$weap_type_v = $row['weap_type'];
          $$monweap_dam_v = $row['monweap_dam'];

          $$weap_dambase_no_v  = $row['dambase_no'];
          $$weap_dambase_incr_v  = $row['dambase_incr'];
          $weap = $row['monweap_wp'];
          if ($$weap_cat_v == "0-Natural"){
             $$weap_dam_v = $$monweap_dam_v;
//              echo "</BR> Weapon " . $mon_weap_v . $$mon_weap_v . $$weap_dam_v ."*** </BR>";
          }
        }
    }
  }
  mysqli_close($link);
}
function monHDHTML($currentlySelected){
//   echo "selected = " . $currentlySelected;
   global $mon_name, $mon_hd_original, $mon_size_original, $advance, $mon_die, $wp_user, $key_1;
   if ($key_1 == ""){
      $key_1 = "dd35";
   }

   $advance = "";
   $link = getDBLink();
   $select = "select count(*) from monadv2 where mon_name = '$mon_name' and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1')";
   $result = mysqli_query($link, $select) ;
   $row = mysqli_fetch_array($result);
   $count = $row[0];
   if ($count > 0){
       $advance = "Y";
       $HTML =    "<SELECT NAME='mon_hd' >";
       $mon_sel =  $mon_hd_original . $mon_die ;
       if ($mon_hd_original == $currentlySelected) {
	  $sel = " SELECTED" ;
	} else {
	  $sel = "" ;
       }
       $sizehd_v = "size" .$mon_hd_original . $mon_die .  "_v";
       global $$sizehd_v;
       $$sizehd_v = $mon_size_original;
       $HTML .= "<OPTION VALUE='$mon_sel' $sel  >$mon_sel $mon_size_original</OPTION>";
       $select = "select monadv_min_hd, monadv_max_hd, monadv_size from monadv2 where mon_name = '$mon_name' and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1')" .
       " order by LPAD(monadv_min_hd,3,'0') ASC";
       $result = mysqli_query($link, $select) ;
       while ($row = mysqli_fetch_array($result)){
          $min_hd = $row['monadv_min_hd'];
          $max_hd = $row['monadv_max_hd'];
          $size   = $row['monadv_size'];
          $hd = $min_hd;

          while ($hd <= $max_hd and $hd <= 50) {
             $hdf = $hd . $mon_die;
             $sizehd_v = "size" .$hdf . "_v";
             global $$sizehd_v;
             $$sizehd_v = $size;
             if ($hdf == $currentlySelected)     {
               $sel = " SELECTED" ;
             }else {
               $sel = "" ;
             }
             $HTML .=  "<OPTION VALUE='$hdf' $sel  >$hdf $size</OPTION>";
             $hd += 1;
          }
       }
       $HTML .= "</SELECT>";
   }else{
       $HTML = "<INPUT TYPE='text' class='text width4em' NAME='mon_hd' VALUE='$currentlySelected'/>";
   }
   mysqli_close($link);
   return ($HTML);
}
function changeSize(){
  global $mon_name, $mon_size_old, $mon_level, $mon_level_old, $mon_size, $mon_str, $mon_dex, $mon_con, $mon_ac_flat, $advance, $mon_die;
 //   echo "mon level " . $mon_level. " old " . $mon_level_old . "advance " . $advance;
  if ($mon_level_old != $mon_level and $advance =="Y"){
      $sizehd_v = "size" . $mon_level . $mon_die . "_v";
      global $$sizehd_v;
      $size_new = $$sizehd_v;
 //     echo "New size = " . $size_new;
      if ($size_new != $mon_size){
          $x = updateSize($mon_size_old, $size_new);
      }
  }else{
    if ($mon_size_old != $mon_size){
         $x = updateSize($mon_size_old, $mon_size);
         $mon_size_old = $mon_size;
    }
  }
}



function updateSize($size_old, $size_new){
 // echo "<BR></BR> update old " . $size_old . " new " . $size_new;
  global $mon_name, $mon_size_old, $mon_level, $mon_level_old, $mon_size, $mon_str, $mon_dex, $mon_con, $mon_ac_flat, $advance;
  global $old_grapple, $new_grapple, $old_size_no, $new_size_no;
  $return = "";
  $link = getDBLink();
  $select = "select size_str, size_dex, size_con, size_nat_ac, size_grapple, size_no from size where size_cat = '$size_old'";
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)){
    $old_found = "Y";
    $old_str = $row['size_str'];
    $old_dex = $row['size_dex'];
    $old_con = $row['size_con'];
    $old_nat_ac = $row['size_nat_ac'];
    $old_grapple = $row['size_grapple'];
    $old_size_no = $row['size_no'];
   }
   $select = "select size_str, size_dex, size_con, size_nat_ac, size_grapple, size_no from size where size_cat = '$size_new'";
   $result = mysqli_query($link, $select) ;
   while ($row = mysqli_fetch_array($result)){
    $new_found = "Y";
    $new_str = $row['size_str'];
    $new_dex = $row['size_dex'];
    $new_con = $row['size_con'];
    $new_nat_ac = $row['size_nat_ac'];
    $new_grapple = $row['size_grapple'];
    $new_size_no = $row['size_no'];
  }
  // echo "</BR>old_str $old_str new str $new_str";
   if ($new_found == "Y" and $old_found == "Y"){
       $mon_size = $size_new;
       if ($mon_str > 0){
          $mon_str += ($new_str - $old_str);
 //        echo "new str = $mon_str";
       }
       if ($mon_dex > 0){
          $mon_dex += ($new_dex - $old_dex);
       }
       if ($mon_con > 0){
          $mon_con += ($new_con - $old_con);
       }
       $mon_ac_flat += ($new_nat_ac - $old_nat_ac);
   }
}
function disStats($stat){
   $return = "";
   $stat_v = "mon_" . $stat;
   $stat_m_v = "mon_" . $stat . "_m";
   global $$stat_v, $$stat_m_v;
   if ($$stat_v > 0.1) {
      if ($$stat_m_v > 0.1){
         $total = $$stat_v  + $$stat_m_v;
         $return = " + " . $$stat_m_v . " = " . $total;
      }
      if ($$stat_m_v < -0.1){
         $total = $$stat_v  + $$stat_m_v;
         $return = " " . $$stat_m_v . " = " . $total;
      }
   }
   return ($return);
}
function getSaveSelectionHTML($currentlySelected) {
 //       $currentlySelected = "";
        global $user_id, $wp_user;
	$html = '<LABEL id="monsterTypeLabel">Saves <SELECT NAME="savemon_key" WIDTH="480" STYLE="width: 480px">';
//        $html = '<TABLE ><TR><TH><b>Monster</b></TH><TH><b>Template</b></TH></TR>' .
//                '<TR><TD><SELECT NAME="mon_name" >';
        if ($wp_user != ""){
//             echo "wp user " . $wp_user;
             $save_key = trim($wp_user);
             $save_user = $user_id;
        }else{
             $save_user = $user_id;
             $save_key = $user_id;
        }
   //     echo "save_user $save_user save_key $save_key";
        if ( $save_user != "" || $save_key != "" ) {
                   if($save_user == ""){
                       $save_user = "xxxxx";
                   }
                   if ($save_key == ""){
                       $save_key = "xxxxxx";
                   }
			// Only run the query if we have valid data otherwise it returns 100,000+ monsters and crashes

	        $select = "SELECT savemon_key, savemon_monster, savemon_mon_name, savemon_class1_tp, savemon_class2_tp, savemon_mon_temp, savemon_class1_focus, savemon_class2_focus, " .
	          " savemon_class1_level, savemon_class2_level, savemon_name, savemon_camp, savemon_sub, savemon_cr, savemon_date " .
	          " from savemon where savemon_user = '$save_user' or savemon_wp_user = '$save_key'";
              //   echo $select;
			error_log("getSaveSelectionHTML  SQL --> ".$select);

			$link = getDBLink();
			$result = mysqli_query($link, $select) ;

			$desc = " None";
			$save_sel = "";
		    if ($save_sel == $currentlySelected)     {
				$sel = " SELECTED" ;
			} else {
				$sel = "" ;
			}
	        $html .= "<OPTION VALUE='$save_sel' $sel>$save_sel $desc </OPTION>";
			while ($row = mysqli_fetch_array($result)) {

				$save_sel = $row['savemon_key'] ;
				$savemon_mon_name = $row['savemon_mon_name'];
				$savemon_mon_temp = $row['savemon_mon_temp'];
		                $savemon_class1_tp = $row['savemon_class1_tp'];
		                $savemon_class2_tp = $row['savemon_class2_tp'];
		                $savemon_class1_level = $row['savemon_class1_level'];
		                $savemon_class2_level = $row['savemon_class1_level'];
		                $savemon_name = $row['savemon_name'];
		                $savemon_date = $row['savemon_date'];
		                $date_x = "";
		                if ($savemon_date !=""){
		                   $date_x = date('Y-m-d H:i',$savemon_date);
		                }
		                if ($save_sel == $save_user){
		                   $desc = "Last created ";
		                }else{
		                   $desc = "";
		                }
		                if ($savemon_name !=  ""){
		                   $desc .= $savemon_name . " ";
		                }
		                $desc .=  $savemon_mon_name;
		                if ($savemon_mon_temp !=""){
		                   $desc .= ",(". $savemon_mon_temp . ")";
		                }
		                if ($savemon_class1_tp != ""){
		                  $desc .=  " " . $savemon_class1_tp . "($savemon_class1_level)";
		                }
		                if ($savemon_class2_tp != ""){
		                  $desc .=  " " . $savemon_class2_tp . "($savemon_class2_level)";
		                }
		                $desc .=  " " . $date_x;
				if ($save_sel == $currentlySelected)     {
					$sel = " SELECTED" ;
				} else {
					$sel = "" ;
			    }
		
				$html .= "<OPTION VALUE='$save_sel' $sel>$desc </OPTION>";
			}
			mysqli_close($link);

		}

	$html .= '</SELECT></LABEL>';

	return $html;

}
function getSaveMon($savemon_monster){
      parse_str($savemon_monster,$monster_a);
//      echo "getSaveMon" ;

//      $monster_a = array('$savemon_monster');
//      echo $savemon_monster;
      foreach ($monster_a as $k => $v) {
        $v = trim($v) ;
        $v = str_replace("¨", "+", $v);
        $v = str_replace("|", "'", $v);
        $v = str_replace("#", "&", $v);
        if ($k != "encounter" and $k != "user" and $k!= "user_id" and $k != "save_key_old"){
           global $$k, $k;
           $$k = $v ;
//           echo $k . " " . $$k;

        }
//       echo $k .  "= " .$v . "<BR></BR>";
      }
}
function disAttr($attr,$selected){
   $name = "mon_" . strtolower($attr);
   $html = "<TD>" . $attr . " <SELECT NAME='$name' >";
$sub = -1 ;
while ($sub < 60){
  $sub +=1;
   if ($sub == $selected){
	$sel = " SELECTED" ;
    } else {
	$sel = "" ;
    }
    $html .= '<OPTION VALUE="'.$sub.'" '.$sel.' >'.$sub.'</OPTION>';
}
$html .= '</SELECT></TD>';
echo $html;
}
function disAttr2($attr,$selected){
    $bonus_r = "mon_" . strtolower($attr) . "_bonus";
    global $$bonus_r;
    if ($$bonus_r == "-0"){
        $$bonus_r = 0;
    }

    $attrn = "attr_" . $attr ;
    $old_attrn = $attrn . "_old";


// OLD CODE CT - 13/6/18
//    echo "\n<script>\n";
//    echo "var $old_attrn = $selected \n";
//    echo "\n</script>\n";

/* New - CT */
		/* Capture dynmically generated JS*/
		ob_start();
		echo "\n/* ddmonsterFunctions */\n";
  echo "var $old_attrn = $selected; \n";
		$dynamicJS = ob_get_clean();
		$resultJS = 	wp_add_inline_script( 'dgJS', $dynamicJS);			/* add it to static JS loaded via the functions.php */
	
		if ( ! $resultJS ) {
			error_log("Dynamic JS failed to load in ddmonsterFunctions.php");	
			die;
		}
/* New - CT - END */


   $name = "mon_" . strtolower($attr);
   $html = $attr . "</TD><TD><SELECT class='width4em' NAME='$name' onchange="
            . '"calcattr(this,'
            . "$old_attrn, "
            . "'$old_attrn"
            . "','')"
            . '">';
$sub = -1 ;
while ($sub < 60){
  $sub +=1;
   if ($sub == $selected){
	$sel = " SELECTED" ;
    } else {
	$sel = "" ;
    }
    $html .= '<OPTION VALUE="'.$sub.'" '.$sel.' >'.$sub.'</OPTION>';
}
$html .= '</SELECT>';
echo $html;
}
function monsterSpells(){
   global $mon_name, $mon_temp, $class1_tp, $class2_tp, $classm_spat, $classm_tp, $classm_level, $key_1, $wp_user;
   global $classm_feat, $classm_damage, $classm_spell0, $classm_spell1, $classm_spell2, $classm_spell3, $classm_spell4, $classm_spell5, $classm_spell6;
   global $classm_spell7, $classm_spell8, $classm_spell9, $classm_spell0_n, $classm_spell1_n, $classm_spell2_n, $classm_spell3_n,
          $classm_spell4_n, $classm_spell5_n, $classm_spell6_n, $classm_spell7_n, $classm_spell8_n, $classm_spell9_n, $caster;
   global $mon_level, $class1_level, $class2_level, $class3_level, $tem_level;
   $total_level = $mon_level + $class1_level + $class2_level + $class3_level + $tem_level;
   if ($key_1 == ""){
       $key_1 = "dd35";
   }
 //  if ($wp_user == "admin"){
 //   echo $total_level;
 //  }
   $select = "SELECT monspec_name, monspec_value from monspec2 where monspec_tp = 'A' and (mon_name = '$mon_name' or mon_name = '$mon_temp')" .
          "and (monspec_name = 'Wizard' or monspec_name = 'Cleric' or monspec_name = 'Witch' or  monspec_name = 'Druid' or  monspec_name = 'Sorcerer' or monspec_name = 'Oracle' or monspec_name = 'Bard')  and (mon_key_1 = '$wp_user' or  mon_key_1 = '$key_1')" .
           " and ((monspec_min = 0 and monspec_max = 0) or (monspec_min = '' and monspec_max = '') or (monspec_min <= '$total_level' and monspec_max = 0)" .
          "or (monspec_min <= '$total_level' and monspec_max >= '$total_level')  )";
   $link = getDBLink();
   $result = mysqli_query($link, $select) ;
   $level_x = 0;
   if ($result){
      while ($row = mysqli_fetch_array($result)){
        $level_x = $row['monspec_value'];
        $class_x = $row['monspec_name'];
        $caster = "Y";
  //      echo "caster $caster";
  //      echo $class_x . $level_x;
        if ($class_x != $class1_tp and $class_x != $class2_tp){
           $select2 = "select classl_feat, classl_tp," .
             " classl_sp0, classl_sp1,classl_sp2,classl_sp3,classl_sp4,classl_sp5,classl_sp6,classl_sp7,classl_sp8, " .
             " classl_sp9, " .
             " classl_sp0_n, classl_sp1_n,classl_sp2_n,classl_sp3_n,classl_sp4_n,classl_sp5_n,classl_sp6_n,classl_sp7_n,classl_sp8_n, " .
             " classl_sp9_n, ".
             " classl_damage from classlev2 where " .
            " (classl_tp = '$class_x' and classl_lev = '$level_x' and mon_key_1 = '$key_1')";
            global $classm_spell_level;
            $classm_spell_level = $level_x;

 //  echo $select2;
           $result2 = mysqli_query($link, $select2) ;
           if ($result2){
             while ($row2 = mysqli_fetch_array($result2)) {
                 $classm_tp     = $row2['classl_tp'];
                 $classm_feat   = $row2['classl_feat'];

 //  echo "</BR>" . $classm_tp . " " . $classm_feat;
                 $classm_damage = $row2['classl_damage'];
                 $classm_spell0 = $row2['classl_sp0'];
                 $classm_spell1 = $row2['classl_sp1'];
                 $classm_spell2 = $row2['classl_sp2'];
                 $classm_spell3 = $row2['classl_sp3'];
                 $classm_spell4 = $row2['classl_sp4'];
                 $classm_spell5 = $row2['classl_sp5'];
                 $classm_spell6 = $row2['classl_sp6'];
                 $classm_spell7 = $row2['classl_sp7'];
                 $classm_spell8 = $row2['classl_sp8'];
                 $classm_spell9 = $row2['classl_sp9'];
                 $classm_spell0_n = $row2['classl_sp0_n'];
                 $classm_spell1_n = $row2['classl_sp1_n'];
                 $classm_spell2_n = $row2['classl_sp2_n'];
                 $classm_spell3_n = $row2['classl_sp3_n'];
                 $classm_spell4_n = $row2['classl_sp4_n'];
                 $classm_spell5_n = $row2['classl_sp5_n'];
                 $classm_spell6_n = $row2['classl_sp6_n'];
                 $classm_spell7_n = $row2['classl_sp7_n'];
                 $classm_spell8_n = $row2['classl_sp8_n'];
                 $classm_spell9_n = $row2['classl_sp9_n'];
                 $select3 = "SELECT class_tp, class_att, class_fort, class_ref, class_will, class_skillp, class_spat, class_hd, class_cr_mult ".
                          "from class2 where class_tp ='$classm_tp' and mon_key_1 = '$key_1'";
                 $result3 = mysqli_query($link, $select3) ;
                if ($result3){
                  $row3 = mysqli_fetch_array($result3);
                  $classm_spat = $row3['class_spat'];
     //             echo $classm_spat;
                }
             }
         }
        }
      }

   }
}
function weapgroup($weap_id){
   global $weap_tr1, $feat_weaptr, $bonus_dam_spec, $feat_atth_close, $feat_atthd_close, $feat_atth_pole, $feat_atthd_pole;
   global $feat_atth_natural, $feat_atthd_natural;
   $bonus = 0;
   $count = 1;
   $weap_tr_v = "weap_tr" . $count;
   $weap_tr = $$weap_tr_v;
   $link = getDBLink();
   $found = "";

   while ($weap_tr != "" and $found != "Y"){
      $select = "SELECT COUNT(*) from weapgroups where weap_id = '$weap_id' and weapgroup_id = '$weap_tr'";
//      echo $select;
      $result = mysqli_query($link, $select) ;
      if ($result){
         $row = mysqli_fetch_array($result);
         $weap = $row[0];
         if ($weap == 1){
            $bonus = $feat_weaptr - $count + 1;
            $found = "Y";
//             echo "found";
         }
      }
      $count += 1;
      $weap_tr_v = "weap_tr" . $count;
      global $$weap_tr_v;
      $weap_tr = $$weap_tr_v;

   }
//   echo "feat_atth_close = $feat_atth_close";
   if ($feat_atth_close >0){
         $select = "SELECT COUNT(*) from weapgroups where weap_id = '$weap_id' and weapgroup_id = 'Close'";
         $result = mysqli_query($link, $select) ;
         if ($result){
            $row = mysqli_fetch_array($result);
             $weap = $row[0];
             if ($weap == 1){
                $bonus += $feat_atth_close;
             }
         }
   }
   $bonus_dam_spec = 0;
   if ($feat_atthd_close >0){
         $select = "SELECT COUNT(*) from weapgroups where weap_id = '$weap_id' and weapgroup_id = 'Close'";
         $result = mysqli_query($link, $select) ;
         if ($result){
            $row = mysqli_fetch_array($result);
             $weap = $row[0];
             if ($weap == 1){
                $bonus_dam_spec = $feat_atthd_close - $feat_atth_close;
       //         echo "feat_atthd_close $feat_atthd_close";
       //         echo "bonus_dam_spec = $bonus_dam_spec";
             }
         }
   }
   if ($feat_atth_pole >0){
         $select = "SELECT COUNT(*) from weapgroups where weap_id = '$weap_id' and (weapgroup_id = 'Pole Arms' or weapgroup_id = 'Spears') ";
         $result = mysqli_query($link, $select) ;
         if ($result){
            $row = mysqli_fetch_array($result);
             $weap = $row[0];
             if ($weap == 1){
                $bonus += $feat_atth_pole;
             }
         }
   }
//
   if ($feat_atthd_pole >0){
    //     echo "feat_atthd_pole = $feat_atthd_pole";
         $select = "SELECT COUNT(*) from weapgroups where weap_id = '$weap_id' and (weapgroup_id = 'Pole Arms' or weapgroup_id = 'Spears')";
         $result = mysqli_query($link, $select) ;
         if ($result){
            $row = mysqli_fetch_array($result);
             $weap = $row[0];
       //      echo "weap = $weap";
             if ($weap == 1){
                $bonus_dam_spec = $feat_atthd_pole - $feat_atth_pole;
         //       echo "feat_atthd_pole $feat_atthd_pole";
       //         echo "bonus_dam_spec = $bonus_dam_spec";
             }
         }
   }
   if ($feat_atth_natural >0){
         $select = "SELECT COUNT(*) from weapgroups where weap_id = '$weap_id' and weapgroup_id = 'Natural' ";
         $result = mysqli_query($link, $select) ;
         if ($result){
            $row = mysqli_fetch_array($result);
             $weap = $row[0];
             if ($weap == 1){
                $bonus += $feat_atth_natural;
             }
         }
   }
//
   if ($feat_atthd_natural >0){
    //     echo "feat_atthd_pole = $feat_atthd_pole";
         $select = "SELECT COUNT(*) from weapgroups where weap_id = '$weap_id' and weapgroup_id = 'Natural'";
         $result = mysqli_query($link, $select) ;
         if ($result){
            $row = mysqli_fetch_array($result);
             $weap = $row[0];
       //      echo "weap = $weap";
             if ($weap == 1){
                $bonus_dam_spec = $feat_atthd_natural - $feat_atth_natural;
         //       echo "feat_atthd_pole $feat_atthd_pole";
       //         echo "bonus_dam_spec = $bonus_dam_spec";
             }
         }
   }
//   echo $weap_id . " bonus ". $bonus;
   return $bonus;
}
function psi_points($class_no){
   global $mon_name, $mon_temp, $class1_tp, $class2_tp, $class1_level, $class2_level,  $key_1;
   global $domain_11, $domain_21;
   global $psi_points;
 //  echo "start points  $psi_points";
   if ($class_no == "1"){
      $class = $class1_tp;
      $level = $class1_level;
      $domain = $domain_11;
   }else{
      $class = $class2_tp;
      $level = $class2_level;
      $domain = $domain_21;
   }
//   echo "len (level) = " . strlen($level);
   if (strlen($level) == 1){
       $level = "0" .  $level;
   }
//   $link = getDBLink();
//   $select = "select spellcl_attr from spellcl where spellcl_id = '$domain'";
//   echo $select;
//   $result = mysqli_query($link, $select) ;
//   $row = mysqli_fetch_array($result);
//   $attr = $row[0];
   if ($class == "Psion"){
       $attr = "int";
   }else{
       $attr = "wis" ;
   }
   $attr_v = "mon_" . strtolower($attr);
   global $$attr_v;
   $attr_val = $$attr_v;
   if ($attr != ""){

      $attr_bon_v = $attr_v . "_bonus";
      global $$attr_bon_v;
      $bonus = $$attr_bon_v;
      $psi_points += round(($bonus * $level) / 2 - 0.49);
//      echo "psi points " . $psi_points;
   }

   /*
   if ($attr != ""){
      $select = "select psibonus_points, psibonus_score_max, psibonus_level from psibonus where psibonus_score_min <= '$attr_val' ".
                "and psibonus_score_max >= '$attr_val' and psibonus_level <= '$level' order by psibonus_level DESC";
  //    echo $select . "<BR></BR>";
      $result = mysqli_query($link, $select) ;
      $flag = "Y";
      while ($row = mysqli_fetch_array($result) and $flag == "Y" ) {
          $psi_points += $row['psibonus_points'];
          $psi_max = $row['psibonus_score_max'];
          $psi_level = $row['psibonus_level'];
          $flag = "N";
      }
    //  echo "max $psi_max level $psi_level psi points" . $psi_points  ;
    }
    */
}
function psi_combat($psi_cmb) {
   $HTML = "";
   $loop = 0;
   $link = getDBLink();
   while ($loop < $psi_cmb){
     $loop +=1;
     $name_v = 'psi_cmb_' . $loop;
     global $$name_v;
     $name = $$name_v;
     $HTML .= '<SELECT class="width40em" NAME="' . $name_v . '">';
        $select = "SELECT psicmb_name, psicmb_attr, psicmb_pow_pts from psicmb order by psicmb_name";
 //       echo $select;
        $link = getDBLink();
        $result = mysqli_query($link, $select) ;
        $row_count = 0;
         while ($row = mysqli_fetch_array($result)){
            $row_count += 1;
            $psicmb_name_sel = trim($row['psicmb_name']);
            $psicmb_attr_sel = trim($row['psicmb_attr']);
            $psicmb_pow_pts_sel = $row['psicmb_pow_pts'];
            if  ($psicmb_attr_sel != ""){
               $display = $psicmb_name_sel . " (" . $psicmb_attr_sel . ") pts " . $psicmb_pow_pts_sel;
            }else{
               $display = $psicmb_name_sel . " pts " . $psicmb_pow_pts_sel;
            }
            if ($psicmb_name_sel == $name or ($name == "" and $row_count == $loop) ){
               $sel = " SELECTED";
           }else{
               $sel =  "";
           }
           $HTML .= "<OPTION VALUE='$psicmb_name_sel' $sel>$display</OPTION>";
         }

         $count = $count +1;
         $HTML .= "\n</SELECT></div><div>";
     }
     return ($HTML);
}
function print_psi_combat(){
  global $psi_cmb, $psi_pts;
  $loop = 0;
   $link = getDBLink();
   $display = "Psionic Combat Modes:  Psi Power Points $psi_pts\n";
   while ($loop < $psi_cmb){
     $loop +=1;
     $name_v = 'psi_cmb_' . $loop;
     global $$name_v;
     $name = $$name_v;
     $select = "SELECT psicmb_name, psicmb_attr, psicmb_pow_pts from psicmb where psicmb_name = '$name'";
 //    echo $select;
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result) ;
     $psicmb_name_sel = trim($row['psicmb_name']);
     $psicmb_attr_sel = trim($row['psicmb_attr']);
     $psicmb_pow_pts_sel = $row['psicmb_pow_pts'];
     if  ($psicmb_attr_sel != ""){
         $display .= $psicmb_name_sel . " (" . $psicmb_attr_sel . ") pts " . $psicmb_pow_pts_sel;
     }else{
         $display .= $psicmb_name_sel . " pts " . $psicmb_pow_pts_sel;
     }
     $display .= "\n";
   }
   return ($display);
}
function buff_html($buff_no){
  global $mon_name, $mon_temp, $class1_tp, $class2_tp, $class3_tp, $class1_level, $class2_level,  $key_1;
  if ($key_1 == ""){
    $key_1 = "dd35";
  }
  $HTML = "";
  $buff_sel_v = "buff_spell_" .$buff_no;
  global $$buff_sel_v;
//  echo $buff_sel_v . $$buff_sel_v;
  $buff_sel = $$buff_sel_v;
  $HTML .= '<SELECT class="width40em" NAME="' . $buff_sel_v . '">';
  if ($buff_sel == ''){
      $sel = " SELECTED";
  }else{
      $sel =  "";
  }
  $HTML .= "<OPTION VALUE='' $sel>No Buffering</OPTION>";
  $link = getDBLink();
  $select = "select distinct spell.spell_name, spell_range from spellattr, spell, spellclass where ((spell_range <> 'Personal')
            or (spell_range = 'Personal' and (spellclass_class = '$class1_tp' or spellclass_class='$class2_tp'
            or spellclass_class = '$class3_tp'))) and spell.spell_name = spellclass_name and
            spell.spell_name = spellattr.spell_name and mon_key_1 = '$key_1' ";

  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)) {
      $spell_name = $row['spell_name'];
  //    echo $spell_name ;
      $spell_range = $row['spell_range'];
      if ($spell_range == "Personal"){
        $select2 =  "select spellclass_level, spellclass_class from spellclass where
                  spellclass_name = '$spell_name' and (spellclass_class = '$class1_tp'
                  or spellclass_class='$class2_tp'
                  or spellclass_class = '$class3_tp')";
        $result2 = mysqli_query($link, $select2) ;
        while ($row2 = mysqli_fetch_array($result2)) {
           $spellclass_level = $row2['spellclass_level'];
           $spellclass_class = $row2['spellclass_class'];
           if ($class1_tp == $spellclass_class){
              $class_no = '1';
           }
           if ($class2_tp == $spellclass_class){
              $class_no = '2';
           }
           if ($class3_tp == $spellclass_class){
              $class_no = '3';
           }
           $classl_sp_v = "class" . $class_no . "_spell" . $spellclass_level;
           $classl_sp_n_v = "class" . $class_no . "_spell" . $spellclass_level . "_n";
           global $$classl_sp_v, $$classl_sp_n_v;
     //      echo $spell_name . " " . $classl_sp_v . "=" . $$classl_sp_n_v;
           if ($$classl_sp_v >= 1 or $$classl_sp_n_v >= 1){
              if ($buff_sel == $spell_name){
                  $sel = " SELECTED";
              }else{
                  $sel =  "";
              }
              $HTML .= "<OPTION VALUE='$spell_name' $sel>$spell_name</OPTION>";
            }

        }
      }else{
           if ($buff_sel == $spell_name){
               $sel = " SELECTED";
           }else{
               $sel =  "";
           }
           $HTML .= "<OPTION VALUE='$spell_name' $sel>$spell_name</OPTION>";

       }
  }
  $HTML .= "</SELECT>";

  return($HTML);
}
function monbuff(){
  global $mon_name, $key_1, $user, $buffx_level_1, $buffx_level_2, $buffx_level_3;
  $select = "select monbuff_spell, monbuff_level from monbuff where mon_name = '$mon_name' and mon_key_1 = '$key_1'";
  $link = getDBLink();
  $result = mysqli_query($link, $select);
  $buff_no = 0;
  while ($row = mysqli_fetch_array($result)){
    $buff_no +=1;
    if ($buff_no < 4){
       $buffx_level_1 = $row['monbuff_level'];
    }else{
       $buffx_level_2 = $row['monbuff_level'];
    }
    $buff_spell_v = "buff_spell_" . $buff_no;
    $buff_level_v = "buff_level_" . $buff_no;
    global $$buff_spell_v, $$buff_level_v;
    $$buff_spell_v = $row['monbuff_spell'];
    $$buff_level_v = $row['mombuff_level'];
  }

}

function buff_attr(){
  global $user, $key_1, $buffx_level_1, $buffx_level_2, $buffx_level_3, $magic_found, $print_buff, $htmlp_buff;
  if ($key_1 == ""){
     $key_1 = "dd35";
  }
  $print_buff = "";
  $htmlp_buff = "";
  $buff_level_1 = $buff_level_2 = $buff_level_3 = $buffx_level_1;
  $buff_level_4 = $buff_level_5 = $buff_level_6 = $buffx_level_2;
  $buff_level_7 = $buff_level_8 = $buff_level_9 = $buffx_level_3;
  $buff_no = 1;
  $link = getDBLink();
  while ($buff_no < 10){
    $buff_spell_v = "buff_spell_" . $buff_no;
    $buff_level_v = "buff_level_" . $buff_no;

    global $$buff_spell_v;
    $buff_spell = $$buff_spell_v;
    if ($buff_spell != ""){
      $print_buff .= $$buff_spell_v . " caster level " . $$buff_level_v . "\n";
      $htmlp_buff .= $$buff_spell_v . " caster level " . $$buff_level_v . "</BR>";
      $magic_found = "Y";
      $buff_level = $$buff_level_v;
      $select2 = "SELECT spell_name, spellattr_spec, spellattr_feat, spellattr_skill, spellattr_no, spellattr_one_per_level, ".
                  "spellattr_max, spellattr_after_level, spellattr_bonus_tp, spellattr_text " .
                  " from spellattr where spell_name = '$buff_spell'" .
                          "and mon_key_1 = '$key_1'";
 //     echo $select2;
      $result2 = mysqli_query($link, $select2);
      while ($row2 = mysqli_fetch_array($result2)){
            $magic_desc     = "spell: " . $row2['spell_name'];
            $magic_spec     = $row2['spellattr_spec'];
            $magic_bonus_tp = $row2['spellattr_bonus_tp'];
            $magic_feat     = $row2['spellattr_feat'];
            $magic_skill    = $row2['spellattr_skill'];
            $magic_no       = $row2['spellattr_no'];
            $one_per_level  = $row2['spellattr_one_per_level'];
            $max            = $row2['spellattr_max'];
            $after_level    = $row2['spellattr_after_level'];
            $magic_text     = $row2['spellattr_text'];
            if ($one_per_level > 0){
               $add =  $bonus = round((($buff_level - $after_level) / $one_per_level)  - 0.49);
               if ($add < 0){
                  $add = 0;
               }
//               echo " add " . $add . "level " . $buff_level . $buff_level_v . "buffx" . $buffx_level_1;
               $magic_no += $add;
               if ($magic_no > $max and $max > 0 and $max != NULL){
                   $magic_no = $max;
               }
            }
   //         echo $magic_desc . $magic_no;
            $insert = "INSERT into magictemp (magict_user, magic_spec, magic_bonus_tp, magic_feat, magic_skill, magict_no, magict_desc, magict_text) " .
                       "VALUES('$user', '$magic_spec','$magic_bonus_tp', '$magic_feat', '$magic_skill', '$magic_no','$magic_desc','$magic_text')";
//            echo $insert;
             if (!mysqli_query($link, $insert)){
                 $select3 =  "SELECT magict_user, magic_spec, magic_bonus_tp, magic_feat, magic_skill, magict_no FROM magictemp " .
                              "WHERE magict_user = '$user' and magic_spec = '$magic_spec' and magic_bonus_tp = '$magic_bonus_tp' and " .
                              " magic_feat = '$magic_feat' and magic_skill = '$magic_skill'";
                 $result3 = mysqli_query($link, $select3);
                 $row3 =  mysqli_fetch_array($result3);
                 $magic_no_old = $row3['magict_no'];
                 if ($magic_no > $magic_no_old){
                    $update = "UPDATE magictemp SET magict_no = '$magic_no',  magict_desc = '$magic_desc' " .
                    "WHERE magict_user = '$user' and magic_spec = '$magic_spec' and magic_bonus_tp = '$magic_bonus_tp' and " .
                    " magic_feat = '$magic_feat' and magic_skill = '$magic_skill'";
                    $result4 = mysqli_query($link, $update);
                 }
             }
      }
    }
    $buff_no +=1;
  }
}
function buff_level($buff){
  $level_v = "buffx_level_" . strtolower($buff);
  global $$level_v;
  $selected = $$level_v;
  $html = "Caster level" . "<SELECT class='width4em' NAME='$level_v'>";
  $sub = -1 ;
  while ($sub < 20){
    $sub +=1;
     if ($sub == $selected){
  	$sel = " SELECTED" ;
      } else {
  	$sel = "" ;
      }
      $html .= '<OPTION VALUE="'.$sub.'" '.$sel.' >'.$sub.'</OPTION>';
  }
  $html .= '</SELECT>';
  return($html);
//  echo $html;
}
function print_ecology(){
  global $mon_name, $mon_temp, $key_1;
  $html_org_desc = "";
  $print_org_desc = "";
//  echo "ecol key_1 $key_1";
  if ($key_1 == ""){
     $key_1 = "dd35";
  }
  $link = getDBLink();
  $select = "select monorg_id, monorg_min, monorg_max from monorg2 where " .
            "mon_name = '$mon_name' and mon_key_1 = '$key_1' order by monorg_min" ;
  $result = mysqli_query($link, $select);
  global $html_org_desc; $print_org_desc;
  $count = 0;
  while ($row = mysqli_fetch_array($result)){
     $count += 1;
     if ($count > 1){
        $html_org_desc .= ", ";
     }
     $org_id = $row['monorg_id'];
     $org_min = $row['monorg_min'];
     $org_max = $row['monorg_max'];
     if ($org_min != $org_max and ($org_min != "1" or $org_min != "2")){
       $html_org_desc  .= $org_id . " " . $org_min . "-" . $org_max;
       $print_org_desc  .= $org_id . " min " . $org_min . " max " . $org_max . "\p";
     }else{
         $print_org_desc  .= $org_id;
         $html_org_desc  .= $org_id;
     }
  }
  $select = "select montreas_tp, montreas_mult from montreas2 where " .
        "mon_name = '$mon_name' and mon_key_1 = '$key_1'";
  $result = mysqli_query($link, $select);
  global $html_treas_desc; $print_treas_desc;
  $count = 0;
  while ($row = mysqli_fetch_array($result)){
     $treas_tp = $row['montreas_tp'];
     $treas_mult = $row['montreas_mult'];
     $count += 1;
     if ($count > 1){
        $html_treas_desc .= ", ";
     }
     $html_treas_desc .= $treas_tp;
     if ($treas_mult != "1" and $treas_mult != "0"){
        $html_treas_desc .= " x " . $treas_mult;
     }
  }
}
function formatattack(){
 global $wp_user, $attack, $user, $attack;
 global $crit_ch_p,$crit_p, $crit_ch_s1,$crit_s1,$crit_ch_s2,$crit_s2;
 global $crit_ch_s3,$crit_s3,$crit_ch_s4,$crit_s5,$crit_ch_s5,$crit_s5,$crit_ch_s6,$crit_s6,$crit_ch_s7,$crit_s7,$crit_ch_s8,$crit_s8,$crit_ch_s9,$crit_s9,$crit_ch_s10,$crit_s10;
 global $mon_weap_p,$damage_p, $full_attack, $magic_p, $magic_s1, $magic_WEAPONB_SPEC_2;
 global $mon_weap_s1, $attack_s1, $damage_s1;
 global $mon_weap_s2, $attack_s2, $damage_s2;
 global $mon_weap_s3, $attack_s3, $damage_s3;
 global $mon_weap_s4, $attack_s4, $damage_s4;
 global $mon_weap_s5, $attack_s5, $damage_s5;
 global $mon_weap_s6, $attack_s6, $damage_s6;
 global $mon_weap_s7, $attack_s7, $damage_s7;
 global $mon_weap_s8, $attack_s8, $damage_s8;
 global $mon_weap_s9, $attack_s9, $damage_s9;
 global $mon_weap_s10, $attack_s10, $damage_s10,  $add_extra_attack;
 $print_secondary_attacks = "";
 $htmlp_secondary_attacks = "";

// echo "spec 2 " . $magic_WEAPONB_SPEC_2;
  $link = getDBLink();
  $delete = "DELETE from attacktemp where attacktemp_user = '$user'";
  $result = mysqli_query($link, $delete) ;
  if ($crit_ch_p != ""){
    if ($crit_p == 2 or $crit_p == 0 or $crit_p == ""){
       $crit_txt_p =  "/". $crit_ch_p . "-20";
    }else{
       $crit_txt_p =  "/". $crit_ch_p . "-20 X". $crit_p;
    }
  }
  if ($crit_ch_p == "" or $crit_ch_p == "20"){
    if ($crit_p == 2 or $crit_p == 0 or $crit_p == ""){
     $crit_txt_p =  "";
    }else{
      $crit_txt_p =  " X". $crit_p;
    }
  }
//echo "magic*" . $magic_s1 . "*";
  $magic_p = trim($magic_p);
  if ($magic_p != ""){
     $magic_p .= " ";
  }
  if (substr($full_attack,0,1) != "-"){
     $htmlx_primary_attacks = $magic_p . $mon_weap_p . " +" . $full_attack . " (" .  $damage_p . $crit_txt_p . ")";
  }else{
     $htmlx_primary_attacks = $magic_p . $mon_weap_p . " " . $full_attack . " (" .  $damage_p . $crit_txt_p . ")";
  }
  $attack = $full_attack;

  $x = addattacktemp($htmlx_primary_attacks,"P");
  $count = 0;
  While ($count < 10) {
	$count = $count + 1;
	$name = "mon_weap_s" . $count;
	$mon_weap_s = $$name;
	if ($count == 1){
          $magic_s1 = trim($magic_s1);
          if ($magic_s1 != ""){
              $magic_s1 .= " ";
          }
   //      echo "</BR>magic*" . $magic_s1 . "*";
          $mon_weap_s = $magic_s1 . $mon_weap_s;
        }
	$damage_v     = "damage_s" . $count;
	$damage       = $$damage_v;
	$attack_v = "attack_s" . ($count);
	$attack = $$attack_v;
	$crit_v = "crit_s" . $count;
	if (isset($$crit_v)){
        }else{
           $$crit_v = "";
        }
	$crit = $$crit_v;
        $crit_ch_v = "crit_ch_s" . $count;
        if (isset($$crit_ch_v)){
        }else{
            $$crit_ch_v = "";
        }
	$crit_ch = $$crit_ch_v;
	if ($crit_ch != ""){
           if ($crit == 2 or $crit == 0 or $crit == ""){
           $crit_txt =  "/" . $crit_ch . "-20";
           }else{
             $crit_txt =  "/" . $crit_ch . "-20 X". $crit;
           }
        }
        if ($crit_ch == "" or $crit_ch == "20"){
            if ($crit == 2 or $crit == 0 or $crit == ""){
                $crit_txt =  "";
           }else{
               $crit_txt =  " X". $crit;
           }
        }
 // echo $mon_weap_s;

	if ($count <= $add_extra_attack or ($mon_weap_s != "No Melee" and $mon_weap_s !="")) {
	   if ($attack >= 0){
              if ($count == 1){
                 if (substr($attack,0,1) != "-"){
	             $print_secondary_attacks .=  $mon_weap_s . " +" . $attack . " (" . $damage . " (". $crit_ch . "-20)X". $crit . ") $magic_WEAPONB_SPEC_2 \n";
	             $htmlx_secondary_attacks =   $mon_weap_s . " +" . $attack . " (" . $damage . $crit_txt . ") $magic_WEAPONB_SPEC_2 ";
                 }else{
                     $print_secondary_attacks .=  $mon_weap_s . " " . $attack . " (" . $damage . " (". $crit_ch . "-20)X". $crit . ") $magic_WEAPONB_SPEC_2 \n";
	             $htmlx_secondary_attacks =   $mon_weap_s . " " . $attack . " (" . $damage . $crit_txt . ") $magic_WEAPONB_SPEC_2 ";
                 }
	       }else{
                   if (substr($attack,0,1) != "-"){
                      $print_secondary_attacks .=  $mon_weap_s . " +" . $attack . " (" . $damage . " (". $crit_ch . "-20)X". $crit . ") \n";
                      $htmlx_secondary_attacks =   $mon_weap_s . " +" . $attack . " (" . $damage . $crit_txt . ")";
                   }else{
                      $print_secondary_attacks .=  $mon_weap_s . " " . $attack . " (" . $damage . " (". $crit_ch . "-20)X". $crit . ") \n";
                      $htmlx_secondary_attacks =   $mon_weap_s . " " . $attack . " (" . $damage . $crit_txt . ")";
                   }

               }
            }else{
               $print_secondary_attacks .=  $mon_weap_s . $attack . " (" . $damage . $crit_txt . ")\n";
               $htmlx_secondary_attacks =   $mon_weap_s . $attack .  " (" . $damage . $crit_txt. ")";
            }

            $htmlp_secondary_attacks .= $htmlx_secondary_attacks . "</BR>";
            $x = addattacktemp($htmlx_secondary_attacks, "S");
        }
    }
}


function addattacktemp($htmlx_secondary_attacks, $prim){
   global $wp_user, $attack, $user;
   $link = getDBLink();
   $select = "select attacktemp_count,attacktemp_prim from attacktemp where attacktemp_user = '$user' and " .
             " attacktemp_desc = '$htmlx_secondary_attacks'";

   $result = mysqli_query($link, $select) ;
   $attacktemp_count = 0;
   while ($row = mysqli_fetch_array($result)) {
       $attacktemp_count = $row['attacktemp_count'];
       $attacktemp_prim = $row['attacktemp_prim'];
       if ($attacktemp_prim == "P"){
          $prim = "P";
       }
   }
   $attacktemp_count += 1;
   if ($attacktemp_count == 1){
       $slash = strpos($attack,"/");
       if ($slash > 0){
          $attack_x = substr($attack,0,$slash);   
       }else{
          $attack_x = $attack  ;
       }
       $insert = "insert into attacktemp (attacktemp_user, attacktemp_desc, attacktemp_tohit, " .
                 "attacktemp_count, attacktemp_prim) " .
       "values('$user','$htmlx_secondary_attacks' , $attack_x, $attacktemp_count,'$prim')";
//        echo $insert;
        $result = mysqli_query($link, $insert) ;
   }else{
      $update = "update attacktemp set attacktemp_count = $attacktemp_count, attacktemp_prim = '$prim' " .
                 " where attacktemp_user = '$user' and " .
                " attacktemp_desc = '$htmlx_secondary_attacks'";
//     echo "</BR>$update";
       $result = mysqli_query($link, $update) ;
  }
  mysqli_close($link);
}
function printattacks(){
   global $wp_user, $user, $print_attack, $htmlp_secondary_attacks_s, $magic_WEAPONA_SPEC_1;
 //  echo "magic weapon " .  $magic_WEAPONA_SPEC_1;
   $htmlp_secondary_attacks_s = "";
   $htmlp_secondary_attacks = "";
   $link = getDBLink();
   $select = "select attacktemp_desc, attacktemp_count, attacktemp_prim from attacktemp " .
             "where attacktemp_user = '$user' " .
             " order by attacktemp_prim, attacktemp_tohit DESC, attacktemp_desc ";
//    echo $select;
    $result = mysqli_query($link, $select) ;
   $attacktemp_count = 0;
   $count = 0;
   while ($row = mysqli_fetch_array($result)) {
       $count += 1;
       $attacktemp_desc = $row['attacktemp_desc'];
       $attacktemp_count = $row['attacktemp_count'];
       $attacktemp_prim = $row['attacktemp_prim'];
       if  (strpos($attacktemp_desc, "No Melee")){
        $mult = "";
       }else{
         $mult = "";
         if ($attacktemp_count > 1){
            $mult = $attacktemp_count . " ";
         }
         $htmlp_secondary_attacks .= $mult . $attacktemp_desc;
         if ($attacktemp_prim == "P"){
             if ($magic_WEAPONA_SPEC_1 != ""){
                  $htmlp_secondary_attacks .=  " $magic_WEAPONA_SPEC_1 ";
             }
         }
         if ($htmlp_secondary_attacks_s  !=""){
             $htmlp_secondary_attacks_s  .=", ";
         }
         $htmlp_secondary_attacks_s .= $mult . $attacktemp_desc;
         if ($print_attack <> "" and $count == 1){
            $htmlp_secondary_attacks .= "(" . $print_attack . ")</BR>";
            $htmlp_secondary_attacks_s .= "(" . $print_attack . ")";
         }else{
            $htmlp_secondary_attacks  .="</BR>";

         }
       }

   }
   mysqli_close($link);
   return  ($htmlp_secondary_attacks);
}
Function domain_sel(){
  global $wp_user, $user;
  global $key_1, $class1_tp, $class2_tp, $class3_tp, $class1_level, $class2_level, $class3_level, $path2;
  global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23, $domain_31, $domain_32, $domain_33;
  $sel1 = "";
  $sel2 = "";
//  if ($wp_user == "admin"){
//     echo "path2 = *$path2*";
//  }
  $class1_level_dm = $class1_level;
  $class2_level_dm = $class2_level;
//
  if ($class3_tp == "Dragon Disciple" and $key_1 == "path"){
     if ($domain_11 == "Draconic"){
         $class1_level_dm += $class3_level;
     }
     if ($domain_21 == "Draconic"){
         $class2_level_dm += $class3_level;
     }
  }
  if ($class1_tp == "Sorcerer" or $class1_tp == "Wizard"  or $class1_tp == "Samurai"
      or $class1_tp == "Inquisitor" or $class1_tp == "Psion" or $class1_tp == "Ranger"
      or $class1_tp == "Bard" or $class1_tp == "Barbarian"  or $class1_tp == "Fighter"  or $class1_tp == "Skald"
      or $class1_tp == "Rogue" or $class1_tp == "Monk"  or $class1_tp == "Alchemist" or $class1_tp == "Investigator"
      or $class1_tp == "Gunslinger"  or $class1_tp == "Bloodrager"
      or $class1_tp == "Summoner"   or $class1_tp == "Unchained Summoner"
      or ($class1_tp == "Psychic Warrior" and $key_1 == "path" and ($path2 == "" or $domain_12 ==""))){
     $sel1 = "(spellcl_id = '$domain_11' and spellclsp_level <= '$class1_level_dm')";
  }
  if ($class1_tp == "Cleric" or $class1_tp == "Oracle" or $class1_tp == 'Druid' or $class1_tp == "Cavalier"  or $class1_tp == "Warpriest"
  or ($class1_tp == "Psychic Warrior" and $key_1 == "path" and $path2 != "" and $domain_12 !="")){
     $sel1 = "((spellcl_id = '$domain_11' or spellcl_id = '$domain_12') and spellclsp_level <= '$class1_level')";
  }
  if ($class2_tp == "Sorcerer" or $class2_tp == "Wizard"  or $class2_tp == "Oracle"  or $class2_tp == "Bloodrager"
      or $class2_tp == "Inquisitor"  or $class2_tp == "Psion" or $class2_tp == "Ranger" or $class2_tp == "Samurai"
      or $class2_tp == "Bard" or $class2_tp == "Barbarian"  or $class2_tp == "Fighter"   or $class2_tp == "Skald"
      or $class2_tp == "Rogue" or $class2_tp == "Monk" or $class2_tp == "Alchemist" or $class2_tp == "Investigator"
      or $class2_tp == "Gunslinger"  or $class2_tp == "Bloodrager"  or $class2_tp == "Warpriest"
      or $class2_tp == "Summoner"    or $class2_tp == "Unchained Summoner"
      ){
     $sel2 = "(spellcl_id = '$domain_21' and spellclsp_level <= '$class2_level_dm')";
  }
  if ($class2_tp == "Cleric" or $class2_tp == "Oracle" or $class2_tp == "Cavalier" or $class2_tp == "Druid"  or $class1_tp == "Warpriest"
  or($class2_tp == "Psychic Warrior" and $key_1 == "path" and $path2 != "" and $domain_22 !="")){
     $sel2 = "((spellcl_id = '$domain_21' or spellcl_id = '$domain_22') and spellclsp_level <= '$class2_level' )";
  }
  if ($sel1 != ""){
     $sel = $sel1;
     if ($sel2 != ""){
        $sel .= " or (" . $sel2 . ")";
     }
  }else{
      $sel = $sel2;
  }
  $sel_spellcl = $sel;
  return ($sel);


}

Function classspec(){
  global $wp_user, $user;
  global $key_1, $class1_tp, $class2_tp, $class3_tp, $class1_level, $class2_level, $class3_level;
  global $class_feats, $speed, $flurry_no, $flurry_att, $pres_spell_lev_arc, $pres_spell_lev_div, $pres_spell_lev_psi;
  global $pres_spell_lev_any, $pres_spell_no,  $feat_armch, $feat_armdex, $feat_weaptr, $spec_init;
  global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23, $domain_31, $domain_32, $domain_33;
  global $spec_fort_sv, $spec_will_sv,  $spec_reflex_sv, $path2, $feat_armch, $feat_acrobat;
  global $feat_atth, $feat_atthd, $feat_attr, $feat_attrd, $feat_defshield, $feat_atth_close, $feat_atthd_close, $feat_tower, $feat_tower_armch, $feat_tower_dex;
  global $feat_atth_pole, $feat_atthd_pole, $feat_atth_natural, $feat_atthd_natural, $int_ac, $firearms, $feat_ac_bonus, $magic_armour_touch ;
  global $mon_str, $mon_dex, $mon_int, $mon_con, $mon_chr, $mon_wis, $first_pass, $mon_ac_flat, $save_mon;
  global $spec_first_time, $mon_int_orig, $flurry_of_blows;
  global $old_animal_comp_level, $new_animal_comp_level;
  global $AC_text, $save_text, $mon_nat_armour_ft, $sen_text, $init_text, $reach_text, $speed_text, $resist_text, $htmlp_def ;
  global $magic_ac_deflect, $magic_ac_insight, $magic_ac_profane, $magic_ac_dodge, $magic_ac_luck;
  $save_text_array =  array();
  $AC_text_array =  array();
  $sen_text_array =  array();
  $speed_text_array =  array();
  $reach_text_array =  array();
  $init_text_array =  array();
  $resist_text_array =  array();
  $feat2_array1 = array();
  $feat2_array2 = array();
  $feat2_array3 = array();
  $addfeat1 = "";
  $addfeat2 = "";
  $addfeat3 = "";
  $link = getDBLink();
  if ($old_animal_comp_level != ""){
     $class1_level = $old_animal_comp_level;
  }
  $select  = "select classsp_no, classsp_class, classsp_spec, classsp_level from classsp2 where  " .
               "((classsp_class = '$class1_tp'and classsp_level <= '$class1_level') or " .
                "(classsp_class = '$class2_tp'and classsp_level <= '$class2_level') or " .
                "(classsp_class = '$class3_tp'and classsp_level <= '$class3_level')) and " .
                "mon_key_1 = '$key_1'";
 //  echo "</BR> $select";
  if ($old_animal_comp_level != ""){
     $class1_level = $new_animal_comp_level;
  }
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)){
      $class = $row['classsp_class'];
      $class_no =   $row['classsp_no'];
      $level = $row['classsp_level'];
      $spec = $row['classsp_spec'];

      $insert = "insert into specw (specw_user, specw_class, specw_level, specw_spec, specw_no) " .
                " values('$user', '$class', '$level', '$spec', '$class_no' ) ";
      $result2 = mysqli_query($link, $insert) ;
  }
  $sel = domain_sel();
  if ($sel != ""){
     $select = "SELECT spellcl_id, spellclsp_level, spec_name, spellclsp_no, spellclsp_remove " .
               "FROM spellclsp WHERE mon_key_1 = '$key_1' and (". $sel . ")" ;
//     echo $select;
     $result = mysqli_query($link, $select) ;
      while ($row = mysqli_fetch_array($result)){
         $class = $row['spellcl_id'];
         $class_no =   $row['spellclsp_no'];
         $level = $row['spellclsp_level'];
         $spec = $row['spec_name'];
         if ($spec == "Reduce Class Feats"){
       //     echo " $class $domain_11 ";
            if ($class == $domain_11) {
               $class_tp = $class1_tp;
            }else{
                if ($class == $domain_21){
                  $class_tp = $class2_tp;
                }else{
                    $class_tp = $class3_tp;
                }

            }
            $reduce_feat_r = "reduce_feats_". $class_tp;
            global $$reduce_feat_r;
            $$reduce_feat_r += $class_no;
    //        echo " $reduce_feat_r $$reduce_feat_r";
         }
         $remove = $row['spellclsp_remove'];
         if ($remove == "Y"){
            $delete = "delete from specw where specw_user = '$user' and specw_level = '$level' and specw_spec = '$spec'";
            $result2 = mysqli_query($link, $delete) ;
//            echo $delete . "</BR>";
         }else{
            $insert ="insert into specw (specw_user, specw_class, specw_level, specw_spec, specw_no) " .
                " values('$user', '$class', '$level', '$spec', '$class_no' ) ";
            $result2 = mysqli_query($link, $insert) ;
         }
      }
  }
 $select  = "select specattr_no, specattr_type, specattr_id, specw_no, specw_class, specattr_bonus_tp from specattr, specw where  " .
            "specattr_spec = specw_spec and specw_user = '$user'";
 $result = mysqli_query($link, $select) ;
 while ($row = mysqli_fetch_array($result)){
    $type = $row['specattr_type'];
    $spec_no = $row['specattr_no'];
    $class_no = $row['specw_no'];

    $spec_id = $row['specattr_id'];
    $spec_class = $row['specw_class'];
    $specattr_bonus_tp = $row['specattr_bonus_tp'];
    $spec_no = checkno($spec_no, $spec_class);
    $class_no = checkno($class_no, $spec_class);
    if ($spec_no > 0 and $class_no > 0){
       $spec_class_no = $spec_no * $class_no;
    }else{
       $spec_class_no = $spec_no;
    }

    if ($type == "FEAT"){
        $feat = $spec_no;
    //  check if feat exists
        $select = "select count(*) from feats2 where mon_key_1 = '$key_1'and feat_name = '$feat'";
   //     echo $select;
        $result3 = mysqli_query($link, $select) ;
        $count = 0;

        while ($row = mysqli_fetch_array($result3)){
            $count = $row[0];
        }
        if ($count > 0){
           $insert = "insert into feattemp (feattemp_user, feattemp_feat, feattemp_class, feattemp_auto) " .
                     "values('$user', '$feat', '3','Y')";
// echo "</BR> $insert";



            $result2 = mysqli_query($link, $insert) ;
           if ($result2){
              $class_feats = $class_feats + 1;
//            if ($wp_user == "admin"){
 //                 echo "</BR>  $class_feats  $feat ";
//            }
           }
         }
    }
//
    if ($type == "ADDFEAT2"){
        $feat2_found = "";
        $feat2_count = 0;
        if ($class1_tp == $spec_class or $domain_11 == $spec_class){
            foreach ($feat2_array1 as $key=>$type){
              $feat2_count += 1;
              if ($spec_no == $type){
                  $feat2_found = "Y";
                  $feat2_count_found = $feat2_count;
              }
            }
            $no = 1;
            if ($feat2_found == ""){
                $feat2_count_found = 1;
                $addfeat1 += 1;
                $feat2_array1[] = $spec_no;
            }
        }
        if ($class2_tp == $spec_class or $domain_12 == $spec_class){
            $no = 2;
            foreach ($feat2_array2 as $key=>$type){
              $feat2_count += 1;
              if ($spec_no == $type){
                  $feat2_found = "Y";
                  $feat2_count_found = $feat2_count;
              }
            }
            if ($feat2_found == ""){
                $feat2_count_found = 1;
                $addfeat2 += 1;
                $feat2_array2[] = $spec_no;
            }
        }
        if ($class3_tp == $spec_class or $domain_13 == $spec_class){
            $no = 3;
            foreach ($feat2_array3 as $key=>$type){
              $feat2_count += 1;
              if ($spec_no == $type){
                  $feat2_found = "Y";
                  $feat2_count_found = $feat2_count;
                ;
              }
            }
            if ($feat2_found == ""){
                $feat2_count_found = 1;
                $addfeat3 += 1;
                $feat2_array3[] = $spec_no;
            }
        }
        // this will now allow multiple class feat types per class note that the pathdisnpc only allows for 2 additional class feat types.
        $addfeat_r ="addfeat" . $no;
        $addfeat = $$addfeat_r;
        $addfeat2_r = "add_feat_class" . $no . $feat2_count_found;
        global $$addfeat2_r;
        $$addfeat2_r = $spec_no;

        global $$spec_no;
        $$spec_no +=1;
        $test =   $$addfeat2_r;
   //     echo "</BR>" . $addfeat2_r . "=" . $test;
        $test = $$spec_no;

   //     echo "</BR>" . $spec_no . "=" . $test . "</BR>";
    }
//
  //  if ($type == "AC"){
  //        $feat_ac_bonus  = $feat_ac_bonus +  $spec_class_no;
  //       $magic_armour_touch += $spec_class_no;
  //  }
    if ($type =="ARMOURP"){
          $feat_armour_v = "armour_" . $spec_no;

//          echo $feat_armour_v;
          global $$feat_armour_v;
          $$feat_armour_v = "Y";

//          echo "ARMOURP $
    }
    if ($type == "ATTH"){
       $feat_atth = $feat_atth + $spec_no;
    }
    if ($type == "ATTHD"){
       $feat_atthd = $feat_atthd + $spec_no;
    }
    if ($type == "ATTHCLOSE"){
//      echo "***feat_atth_close ***";
       $feat_atth_close = $feat_atth_close + $class_no;
    }
    if ($type == "ATTHDCLOSE"){
       $feat_atthd_close = $feat_atthd_close + $class_no;
    }
    if ($type == "ATTHPOLE"){

       $feat_atth_pole = $feat_atth_pole + $class_no;
  //     echo "***feat_atth_pole = $feat_atth_pole ";
    }
    if ($type == "ATTHDPOLE"){
       $feat_atthd_pole = $feat_atthd_pole + $class_no;
    }
    if ($type == "ATTHNAT"){

       $feat_atth_natural = $feat_atth_natural + $class_no;
  //     echo "***feat_atth_pole = $feat_atth_pole ";
    }
    if ($type == "ATTHDNAT"){
       $feat_atthd_nalural = $feat_atthd_natural + $class_no;
    }
    if ($type == "ATTR"){
       $feat_attr = $feat_attr + $spec_no;
    }
    if ($type == "ATTRD"){
       $feat_attrd = $feat_attrd + checkno($spec_no,$spec_class);
    }
    if ($type == "DEFSHIELD"){
       $feat_defshield = $feat_defshield + $spec_no;
    }
    if ($type == "TOWER"){
       $feat_tower = $feat_tower + $class_no;
    }
    if ($type == "TOWERARMCH"){
       $feat_tower_armch = $feat_tower_armch + $spec_no;
   //    echo "feat_tower_armch  $feat_tower_armch ";
    }
    if ($type == "TOWERDEX"){
       $feat_tower_dex = $feat_tower_dex + $spec_no;
  //     echo "feat_tower_dex  $feat_tower_dex ";
    }
    if ($type == "FAST"){
       $speed = $speed +  $spec_no;
    }
    if ($type == "FLURRY"){
        $flurry_no = $flurry_no +  $spec_no;
  //      echo "flurry_no $flurry_no";
    }

    if ($type == "FLURRYATT"){
        $flurry_att = $flurry_att +  $class_no;
        $flurry_of_blows = "Y";
    }
    if ($type == "SPLEVARC"){
      $pres_spell_lev_arc +=   $class_no;
    }
    if ($type == "SPLEVDIV"){
       $pres_spell_lev_div +=   $class_no;
     }
     if ($type == "SPLEVPSI"){
       $pres_spell_lev_psi +=   $class_no;
     }
    if ($type == "SPLEVANY"){
      $pres_spell_lev_any +=   $class_no;
    }
    if ($type == "SPELLNO"){
      $pres_spell_no +=   $class_no;
    }
    if ($type == "ARMCH"){
       $feat_armch +=   $class_no;
    }
    if ($type == "ARMDEX"){
      $feat_armdex +=   $class_no;
    }

    if ($type == "WEAPTR"){
       $feat_weaptr +=   $class_no;
//             if ($wp_user == "admin"){
//                echo "</BR> weaptr =   $feat_weaptr   ";
//          }
    }
    if ($type == "PATH2"){
       $path2 =   $spec_no;
    }
    if ($type == "FIREARMS"){
       $firearms = "Y";
    }
    if ($type == "INIT"){
       $no = checkno($spec_class_no,"");
       $spec_init +=   $no;
//       echo "init " . $no;
    }
    if ($type == "ACROBAT"){
        $feat_acrobat = "Y";
    }
    if ($type == "RCLASSFT"){
        $remove_class_feat += $class_no;
    }
    if ($type == "INTAC"){
       $int_ac += 1;
    }
    if ($type == "SVFORT"){
       $spec_fort_sv = $spec_fort_sv +  $class_no;
    }
    if ($type == "SVWILL"){
       $spec_will_sv = $spec_will_sv +  $class_no;
    }
    if ($type == "SVREFLEX"){
       $spec_reflex_sv = $spec_reflex_sv +  $class_no;
    }
    if ($type == "SVTEXT"){
         if ($class_no == ""){
          if ($save_text != ""){
             $save_text .= "; ";
          }else{
            $save_text = "; ";
          }
          $save_text .= $spec_no ;
       }else{
          if (!isset($save_text_array[$spec_no])){
             $save_text_array[$spec_no] = "";
          }
          $save_text_array[$spec_no] += $class_no;
       }

 //            echo "save text = $save_text";
    }

    if ($type == "ACTEXT"){
       if ($class_no == ""){
          if ($AC_text != ""){
             $AC_text .= "; ";
          }else{
            $AC_text = "; ";
          }
          $AC_text .= $spec_no ;
       }else{
           if (isset($AC_text_array[$spec_no])){
              $AC_text_array[$spec_no] += $class_no;
           }else{
              $AC_text_array[$spec_no] = $class_no;
           }
       }

 //            echo "save text = $save_text";
    }
    if ($type == "SENTEXT"){
         if ($class_no == ""){
          if ($sen_text != ""){
             $sen_text .= "; ";
          }else{
            $sen_text = "; ";
          }
          $sen_text .= $spec_no ;
       }else{
           if (!isset($sen_text_array[$spec_no])){
              $sen_text_array[$spec_no] = $class_no;
           }else{
              $sen_text_array[$spec_no] += $class_no;
           }
       }
    }
    if ($type == "SPEEDTEXT"){
         if ($class_no == ""){
          if ($speed_text != ""){
             $speed_text .= "; ";
          }else{
            $speed_text = "; ";
          }
          $speed_text .= $spec_no ;
       }else{
           if (!isset($speed_text_array[$spec_no])){
              $speed_text_array[$spec_no] = $class_no;
           }else{
              $speed_text_array[$spec_no] += $class_no;
           }
       }
    }
    if ($type == "REACHTEXT"){
         if ($class_no == ""){
          if ($reach_text != ""){
             $reach_text .= "; ";
          }else{
            $reach_text = "; ";
          }
          $reach_text .= $spec_no ;
       }else{
          if (!isset($reach_text_array[$spec_no])){
              $reach_text_array[$spec_no] = $class_no;
          }else{
             $reach_text_array[$spec_no] += $class_no;
          }
       }
    }
    if ($type == "INITTEXT"){
         if ($class_no == ""){
          if ($init_text != ""){
             $init_text .= "; ";
          }else{
            $init_text = "; ";
          }
          $init_text .= $spec_no ;
       }else{
           if (!isset( $init_text_array[$spec_no])){
              $init_text_array[$spec_no] += $class_no;
           }else{
              $init_text_array[$spec_no] += $class_no;
           }
       }
    }
    if ($type == "RESISTTEXT"){
         if ($class_no == ""){
          if ($resist_text != ""){
             $resist_text .= "; ";
          }else{
            $resist_text = "; ";
          }
          $resist_text .= $spec_no ;
       }else{
          if (!isset($resist_text_array[$spec_no])){
            $resist_text_array[$spec_no] = $class_no;
          }else{
            $resist_text_array[$spec_no] += $class_no;
          }
       }
    }
 /*
    if ($type == "ACTEXT"){
        if ($AC_text != ""){
            $AC_text .= ", ";
        }else{
            $AC_text = "; ";
        }
        $AC_text .= $spec_no;
        if ($class_no > 0){
            $AC_text .=  " ". $class_no ;
       }
    }
 */
    //only add str and dex once on first pass
    if ($type == "ADDSTR" and $first_pass == "" and $save_mon == ""){
        $mon_str += $class_no;
        $x =  get_attr_bonus();
    }
    if ($type == "ADDDEX" and $first_pass == "" and $save_mon == ""){
        $mon_dex += $class_no;
        $x =  get_attr_bonus();
    }
    if ($type == "ADDCON" and $first_pass == "" and $save_mon == ""){
        $mon_con += $class_no;
        $x =  get_attr_bonus();
    }
    if ($type == "ADDINT" and $first_pass == "" and $save_mon == ""){
        $mon_int += $class_no;
        $x =  get_attr_bonus();
    }
    if ($type == "ADDCHR" and $first_pass == "" and $save_mon == ""){
        $mon_chr += $class_no;
        $x =  get_attr_bonus();
    }
//     if ($type == "NATARMOUR" and $first_pass == "" and $save_mon == ""){
//        $mon_ac_flat += $class_no;
//     }                         `
     if ($type == "NATARMOUR"){
         $mon_nat_armour_ft = $mon_nat_armour_ft + $class_no;
     }
     if ($type == "AC"){
 //            echo "type = $specattr_bonus_tp";
             if ($specattr_bonus_tp == "deflection"){
                $magic_ac_deflect += $spec_class_no;
             }else{
                if ($specattr_bonus_tp == "insight"){
                   $magic_ac_insight += $spec_class_no;
                }else{
                   if ($specattr_bonus_tp == "profane"){
                    $magic_ac_profane += $spec_class_no;
                   }else{
                       if ($specattr_bonus_tp == "dodge"){
                          $magic_ac_dodge += $spec_class_no;
                       }else{
                          if ($specattr_bonus_tp == "luck"){
                              $magic_ac_luck += $spec_class_no;
                          }else{
                               $feat_ac_bonus  = $feat_ac_bonus +  $spec_class_no;
                               $magic_armour_touch += $spec_class_no;
                       //       $magic_ac +=  $class_no;
                          }
                       }
                   }
                }
             }
        //     echo "magic_ac_luck $magic_ac_luck";
     }
    if ($type == "SKILL"){
       $skill =  $spec_id;
       $rank = "0";
       $skillt_xskill = "";
       $select2 = "select skill_atr, skill_armour_ch from skills where skill_cd = '$skill'";
       $result2 = mysqli_query($link, $select2) ;
    // echo $select2;
       while ($row2 = mysqli_fetch_array($result2)){
         $atr = $row2['skill_atr'];
         $atr_bonus = 0;
         $misc_bonus = 0;
         $xskill = "Y";
         $armour_ch = $row2['skill_armour_ch'];
       }
       $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
               "skillt_misc_bonus , skillt_xskill, skillt_armour_ch) " .
               "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch')";
       $result3 = mysqli_query($link, $insert) ;
    }
    if ($type == "CLASSSKILL"){
       $skill =  $spec_id;
       $rank = "0";
       $skillt_xskill = "";
       $select2 = "select skill_atr, skill_armour_ch from skills where skill_cd = '$skill'";
       $result2 = mysqli_query($link, $select2) ;
    // echo $select2;
       while ($row2 = mysqli_fetch_array($result2)){
         $atr = $row2['skill_atr'];
         $atr_bonus = 0;
         $misc_bonus = 0;
         $armour_ch = $row2['skill_armour_ch'];
       }
       $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
               "skillt_misc_bonus , skillt_xskill, skillt_armour_ch) " .
               "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch')";
       $result3 = mysqli_query($link, $insert) ;
       $update  = "UPDATE skilltemp SET skillt_xskill = '' WHERE " .
                                "skillt_user = '$user' and skillt_skill = '$skill'";
       $result4 = mysqli_query($link, $update) ;
    }
   }
   foreach ($save_text_array as $key=>$value){
 //     echo "$key $value";
      if ($save_text != ""){
          $save_text .= "; ";
      }else{
           $save_text = "; ";
      }
      $save_text .= $key;
      if ($value != 0){
   //       echo "</BR>here  $value";
          $save_text .= " " . $value;
  //        echo "$save_text </BR>";
      }
   }
   foreach ($AC_text_array as $key=>$value){
 //     echo "$key $value";
      if ($AC_text != ""){
          $AC_text .= "; ";
      }else{
           $AC_text = "; ";
      }
      $AC_text .= $key;
      if ($value != 0){
   //       echo "</BR>here  $value";
          $AC_text .= " " . $value;
  //        echo "$save_text </BR>";
      }
   }
   foreach ($sen_text_array as $key=>$value){
      if ($sen_text != ""){
          $sen_text .= "; ";
      }else{
           $sen_text = "; ";
      }
      $sen_text .= $key;
      if ($value != 0){
          $sen_text .= " " . $value;
      }
   }
 //  echo "sen text = $sen_text";
   foreach ($speed_text_array as $key=>$value){
      if ($speed_text != ""){
          $speed_text .= "; ";
      }else{
           $speed_text = "; ";
      }
      $speed_text .= $key;
      if ($value != 0){
          $speed_text .= " " . $value;
      }
   }
   foreach ($reach_text_array as $key=>$value){
      if ($reach_text != ""){
          $reach_text .= "; ";
      }else{
          $reach_text = "; ";
      }
      $reach_text .= $key;
      if ($value != 0){
          $reach_text .= " " . $value;
      }
   }
 //  echo "reach text $reach_text";
   foreach ($init_text_array as $key=>$value){
      if ($init_text != ""){
          $init_text .= "; ";
      }else{
           $init_text = "; ";
      }
      $init_text .= $key;
      if ($value != 0){
          $init_text .= " " . $value;
      }
   }
   foreach ($resist_text_array as $key=>$value){
      if ($resist_text != ""){
          $resist_text .= ", ";
      }else{
           $resist_text = "";
      }
      $resist_text .= $key;
      if ($value != 0){
          $resist_text .= " " . $value;
      }
   }
   if ($resist_text != ""){
      $htmlp_def = "</BR><b>Resistance to </b> $resist_text ";
   }


 mysqli_close($link);



}
Function checkno($no,$class){
  global $mon_str_bonus, $mon_int_bonus, $mon_wis_bonus, $mon_dex_bonus, $mon_con_bonus, $mon_chr_bonus;
  global $key_1, $class1_tp, $class2_tp, $class3_tp, $class1_level, $class2_level, $class3_level;
  global $domain_11, $domain_21, $domain_31;
   if ($no == "STR" or  $no == "INT" or $no == "WIS" or  $no =="DEX" or $no == "CON" or $no == "CHR"){
       $bonus_v = "mon_" . strtolower($no) . "_bonus";
//       echo "</BR>bonus $bonus_v";
//       echo $mon_str_bonus;
//       global $$bonus_v;
       $no = $$bonus_v;
 //     echo " no = $no";
   }else{
      if ($no == "HLEVEL"){
         if ($class != ""){
           if ($class == $class1_tp or $class == $domain_11 ){
              $level = $class1_level;
           }
           if ($class == $class2_tp or $class == $domain_21){
              $level = $class2_level;
           }
           if ($class == $class3_tp or $class == $domain_31){
              $level = $class3_level;
           }
           $no =  $level/2 - 0.1;
           $no = round($no, "0");
           if ($no == 0){
              $no = "1";
           }
      //     echo "level $level bonus $no";
         }
      }
   }
   return($no);
}

Function feat_order($feat){
  global $key_1 ;
  $link = getDBLink();
  $select = "select feat_order from feats2 where feat_name = '$feat' and mon_key_1 = '$key_1'";
  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result) ;
  $feat_order = $row['feat_order'];
  return ($feat_order);
}

Function classffeat(){
  global $key_1, $user, $class1_tp, $class2_tp, $class3_tp, $class1_focus, $class2_focus, $class3_focus, $class1_domain1, $class2_domain2, $class1_level, $class2_level, $class3_level ;
  global $class1_feat, $class2_feat,  $class3_feat, $gen_feats, $attnum1, $class_feats, $mon_str, $mod_dex, $mon_free_feats, $mon_feats, $epic_feat_max, $tem_feats;
  global $wp_user, $epic_count, $mon_name, $mon_orig_feats, $mon_int, $mon_str, $mon_dex;
  //attnum will get overwritten only set to 20 to get over vetting
  $attnum1 = 20;
  $x = count_feats();
//  echo $wp_user;
  $link = getDBLink();
  $count = 0;
  while ($count < 3){

    $count += 1;
    $class_r = 'class' . $count . "_tp";
    $class = $$class_r;
    $level_r = 'class' . $count . "_level";
    $level = $$level_r;
    if ($class !=""){
       $select = "select classl_feat from classlev2 where classl_tp = '$class' and classl_lev = $level and mon_key_1 = '$key_1'";
//  echo $select;
       $result = mysqli_query($link, $select) ;
       $row = mysqli_fetch_array($result) ;
       $classl_feat = $row['classl_feat'];
    }else{
       $classl_feat = 0;
    }
    $class_feat_r = 'class' . $count . "_feat";
    $$class_feat_r = $classl_feat;

  }
  // animal companions start with 3 or 6 tricks depending on int score
  if ($class1_tp == "Animal Companion"){
   //      echo "here";
      if ($mon_int < 2){
           if ($mon_int == 0){
             $class1_feat += 1;
           }else{
             $class1_feat += 3;
           }
      }else{
          $class1_feat += 6;
      }

  }
  $count = 0;
  $gen_feats_count = $class_feats + $mon_orig_feats + $tem_feats;
//
 // if ($mon_name == "Human"){
 //    $gen_feats_count = $gen_feats_count - 1;
//  }
//if ($wp_user == "admin"){
// echo "class feats $class_feats";
// echo "</BR>gen_feats_count =  $gen_feats_count class_feats $class_feats  mon_orig_feats $mon_orig_feats tem feats $tem_feats";
// echo "</BR>class1_feat = $class1_feat class2_feat = $class2_feat gen_feats = $gen_feats gen_feats_count = $gen_feats_count";
//}
  $no = 0;
  $class1_feat_count = 0; 
  $class2_feat_count = 0;
  $class3_feat_count = 0;
  while ($no < 40 and
    ($class1_feat > $class1_feat_count or $class2_feat > $class2_feat_count or  $class3_feat > $class3_feat_count or $gen_feats > $gen_feats_count)){
    $no +=1;
//    echo " No  $no /";
    $count = 0;
    while ($count < 5){
     $count +=1;
//     echo "</BR>$count class1_feat = $class1_feat class1_feat_count = $class1_feat_count";
     if ($count == 1 and $class1_feat > $class1_feat_count){
         $class = $class1_tp;
         $focus = $class1_focus;
         $type = "C";
         $select = "select classffeat_feat, feat_char_spec, feat_order from classffeat, feats2 where classffeat_class = '$class' and classffeat_focus = '$focus' " .
                 " and classffeat_type = '$type' and classffeat_no = '$no' and feat_name = classffeat_feat and classffeat.mon_key_1 = '$key_1'" .
                  " and classffeat.mon_key_1 = feats2.mon_key_1";
 //        echo $select;
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result) ;
        $feat = $row['classffeat_feat'];
        $feat_char_spec = $row['feat_char_spec'];
        $feat_order = $row['feat_order'];
        $text = check_feat($feat);
        if ($feat == "Weapon Finesse" and $mon_str >= $mon_dex){
            $text = "Str > Dex";
        }


//if ($wp_user == "admin"){
//   echo "classff $feat $text";
//}
        if ($text == "" and $feat !=""){
            $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto, feattemp_order) VALUES " .
                "('$user','$feat', '1','','$feat_order')";
            if (mysqli_query($link, $insert)){
                $class1_feat_count += 1;
                if ($feat_char_spec == "EPIC"){
                   $epic_count +=1;
                }
   //             echo "</BR>feat $class1_feat_count " . $feat . "  " . $user;
            }
 //         echo "</BR>feat $class1_feat_count " . $feat;
        }
     }
     if ($count == 2 and $class2_feat > $class2_feat_count){
         $class = $class2_tp;
         $focus = $class2_focus;
         $type = "C";
         $select = "select classffeat_feat, feat_char_spec, feat_order from classffeat, feats2 where classffeat_class = '$class' and classffeat_focus = '$focus' " .
                 " and classffeat_type = '$type' and classffeat_no = '$no' and feat_name = classffeat_feat and classffeat.mon_key_1 = '$key_1'" .
                  " and classffeat.mon_key_1 = feats2.mon_key_1";
      //   $select = "select classffeat_feat from classffeat where classffeat_class = '$class' and classffeat_focus = '$focus' " .
     //            " and classffeat_type = '$type' and classffeat_no = '$no'  and mon_key_1 = '$key_1'";
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result) ;
        $feat = $row['classffeat_feat'];
        $feat_char_spec = $row['feat_char_spec'];
        $feat_order = $row['feat_order'];
        $text = check_feat($feat);
// if weapon finesse then check dex > str
        if ($feat == "Weapon Finesse" and $mon_str >= $mon_dex){
            $text = "Str > Dex";
        }
  //      echo "classff $feat $text";
        if ($text == "" and $feat != ""){
            $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto, feattemp_order) VALUES " .
                "('$user','$feat', '2','','$feat_order')";
            if (mysqli_query($link, $insert)){
              $class2_feat_count += 1;
              if ($feat_char_spec == "EPIC"){
                   $epic_count +=1;
              }
            }
//            echo "</BR>feat $count " . $feat;
        }
     }
//     echo "$count, $class3_feat, $class3_feat_count";
     if ($count == 5 and $class3_feat > $class3_feat_count){
         $class = $class3_tp;
         $focus = $class3_focus;
         $type = "C";
         $select = "select classffeat_feat, feat_char_spec, feat_order from classffeat, feats2 where classffeat_class = '$class' and classffeat_focus = '$focus' " .
                 " and classffeat_type = '$type' and classffeat_no = '$no' and feat_name = classffeat_feat and classffeat.mon_key_1 = '$key_1'" .
                  " and classffeat.mon_key_1 = feats2.mon_key_1";
       //  echo $select;
      //   $select = "select classffeat_feat from classffeat where classffeat_class = '$class' and classffeat_focus = '$focus' " .
     //            " and classffeat_type = '$type' and classffeat_no = '$no'  and mon_key_1 = '$key_1'";
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result) ;
        $feat = $row['classffeat_feat'];
        $feat_char_spec = $row['feat_char_spec'];
        $feat_order = $row['feat_order'];
        $text = check_feat($feat);
//        echo "$feat $text";
// if weapon finesse then check dex > str
        if ($feat == "Weapon Finesse" and $mon_str >= $mon_dex){
            $text = "Str > Dex";
        }
        if ($text == "" and $feat != ""){
            $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto, feattemp_order) VALUES " .
                "('$user','$feat', '4','','$feat_order')";
//            echo $insert;
            if (mysqli_query($link, $insert)){
              $class3_feat_count += 1;
              if ($feat_char_spec == "EPIC"){
                   $epic_count +=1;
              }
            }
//            echo "</BR>feat $count " . $feat;
        }
     }
     if ($count == 3 and $gen_feats > $gen_feats_count){
//         if ($wp_user == "admin"){
 //          echo "</BR> gen_feats $gen_feats gen_feats_count $gen_feats_count";
//         }
         $class = $class1_tp;
         $focus = $class1_focus;
         $level = $class1_level;
         $type = "G";
   //      $select = "select classffeat_feat from classffeat where classffeat_class = '$class' and classffeat_focus = '$focus' " .
   //              " and classffeat_type = '$type' and classffeat_no = '$no'  and mon_key_1 = '$key_1' ";
         $select = "select classffeat_feat, feat_char_spec, feat_order from classffeat, feats2 where classffeat_class = '$class' and classffeat_focus = '$focus' " .
                 " and classffeat_type = '$type' and classffeat_no = '$no' and feat_name = classffeat_feat and classffeat.mon_key_1 = '$key_1'" .
                  " and classffeat.mon_key_1 = feats2.mon_key_1";

    //     echo $select;
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result) ;
        $feat = $row['classffeat_feat'];
        $feat_order = $row['feat_order'];
        $feat_char_spec = $row['feat_char_spec'];
        $text = check_feat($feat);
        if ($feat == "Weapon Finesse" and $mon_str >= $mon_dex){
            $text = "Str > Dex";
        }
  //      if ($wp_user == "admin"){
  //        echo "classff $feat $text";
 //       }
 //       echo "</BR>feat $gen_feats_count " . $feat . $text . " gen feats $gen_feats";
        if ($text == "" and $feat != ""){
            $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto, feattemp_order) VALUES " .
                "('$user','$feat', '3','','$feat_order')";
 //           if ($wp_user == "admin"){
 //               echo "</BR>$insert</BR>";
 //           }
            if (mysqli_query($link, $insert)){
//              echo $insert;
               $gen_feats_count += 1;
               if ($feat_char_spec == "EPIC"){
                   $epic_count +=1;
               }
            }

        }
     }
     if ($count == 4 and $gen_feats > $gen_feats_count and $class2_tp != ""){
         $class = $class2_tp;
         $focus = $class2_focus;
         $type = "G";
   //      $select = "select classffeat_feat from classffeat, classfeats2 where classffeat_class = '$class' and classffeat_focus = '$focus' " .
   //              " and classffeat_type = '$type' and classffeat_no = '$no'  and classffeat.mon_key_1 = '$key_1' ".
   //               " and classffeat.mon_key_1 = classfeats2.mon_key_1 and classffeat_feat = classfeat_feat " .
   //               " and classfeat_class = '$class' and classfeat_level <= $level ";
         $select = "select classffeat_feat, feat_char_spec, feat_order from classffeat, feats2 where classffeat_class = '$class' and classffeat_focus = '$focus' " .
                 " and classffeat_type = '$type' and classffeat_no = '$no' and feat_name = classffeat_feat and classffeat.mon_key_1 = '$key_1'" .
                  " and classffeat.mon_key_1 = feats2.mon_key_1";
 //        $select = "select classffeat_feat from classffeat where classffeat_class = '$class' and classffeat_focus = '$focus' " .
 //                " and classffeat_type = '$type' and classffeat_no = '$no' and mon_key_1 = '$key_1'";
 //        echo $select;
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result) ;
        $feat = $row['classffeat_feat'];
        $feat_char_spec = $row['feat_char_spec'];
        $feat_order = $row['feat_order'];
        $text = check_feat($feat);
        if ($feat == "Weapon Finesse" and $mon_str >= $mon_dex){
            $text = "Str > Dex";
        }
        if ($text == "" and $feat != ""){
            $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto, feattemp_order) VALUES " .
                "('$user','$feat', '3','','$feat_order')";
            if (mysqli_query($link, $insert)){
               $gen_feats_count += 1;
               if ($feat_char_spec == "EPIC"){
                   $epic_count +=1;
               }
//               echo $gen_feats_count . ",";
            }
//            echo "</BR>feat $count " . $feat;
        }
     }
     //  if ($wp_user == "admin" and $text != ""){
     //    echo $text . $feat;
     //  }
    }
  }
//  echo "class1_feat = $class1_feat class1_feat_count = $class1_feat_count";
  $attnum1 = 0;
   mysqli_close($link);
}


Function count_feats(){
  global $key_1, $mon_level, $mon_int, $mon_feats_calc, $tem_level, $tem_feats, $mon_name, $zombie, $mon_feats;
  global $class1_tp, $class1_level, $class2_tp, $class3_tp, $class2_level, $class3_level, $class_feats;
  global $gen_feats, $zombie, $max_feats, $animal_companion, $animal_companion_hd;
  global $class1_feat, $class2_feat, $mon_free_feats, $epic_feat_max, $human_counted, $wp_user, $tem_free_feats;
  $div = 3;
  if ($key_1 == "dd35"){
     $div = 3;
     $minus = 0.49;
  }
  if ($key_1 == "path"){
     $div = 2;
     $minus = 0.51;
  }
//echo "div =  $div";
  $mon_feats_calc = 0;
  $mon_level_x = $mon_level;
  if ($animal_companion == "Y"){
     $mon_level_x += $animal_companion_hd;
  }
  if ($mon_level_x >0){
     $mon_feats_calc = round(($mon_level_x) / $div - $minus,0) + 1;
  }
  //echo "mon_level_x $mon_level_x";
//    echo "</BR>mon_feats_calc $mon_feats_calc mon_feats $mon_feats mon_free_feats $mon_free_feats class_feats $class_feats" ;
  $tem_feats_calc = 0;
  if ($tem_level >0 and $tem_level > $animal_companion_hd){
     $tem_feats_calc = round(($tem_level - $animal_companion_hd) / $div - $minus,0) + 1;
  }
  if ($mon_int == 0){
     $mon_feats_calc = 0;
     $tem_feats_calc = 0;
  }
  if ($mon_feats_calc  > ($mon_feats - $mon_free_feats)){
     $mon_feats = $mon_feats_calc + $mon_free_feats;
  }
  if ($tem_feats_calc  > ($tem_feats - $tem_free_feats)){
     $tem_feats = $tem_feats_calc + $tem_free_feats;
  }else{
     if ($animal_companion_hd > 0){
        $tem_feats_calc = $tem_free_feats;
     }
  }
  //echo "tem_feats_calc  $tem_feats_calc free $tem_free_feats";
//  if ($wp_user == "admin"){
//    echo "</BR> tem calc " . $tem_feats_calc . "free " . $tem_free_feats;
//    echo "</BR> mon feat  $mon_feats class feats $class_feats tem feats $tem_feats";
// }
  if ($class1_tp != "" and $zombie != "Y"){
    $gen_check = round(($class1_level + $class2_level + $class3_level) / $div - $minus,0);
//     echo "gen check $gen_check";
     $gen_feats = round(($class1_level + $class2_level + $class3_level) / $div - $minus,0) + 1 + $mon_feats + $class_feats + $tem_feats;
//     echo "</BR>gen_feats $gen_feats mon_feats $mon_feats class_feats $class_feats tem_feats $tem_feats";
     $class_feats_calc = round(($class1_level + $class2_level + $class3_level) / $div - $minus,0) + 1 ;
  }else{
     $gen_feats = $mon_feats + $tem_feats;
     $class_feats_calc = 0;
  }
  if ($mon_name == "Human" and $zombie != "Y" and $human_counted !="Y"){
     $gen_feats = $gen_feats + 1;
     $mon_feats = $mon_feats + 1;
     $human_counted = "Y";
  }
//echo "</BR> mon_level = " . $mon_level;
//
//echo "<BR> class feats = " . $class_feats;
//if ($wp_user == "admin"){
//  echo "</BR> class_feats_calc = " . $class_feats_calc;
//  echo "</BR> tem_feats = " . $tem_feats;
//  echo "</BR> mon feats = " . $mon_feats;
// echo "</BR> gen feats = ". $gen_feats;
//}
  if ($zombie == "Y"){
      $class1_feat = 0;
      $class2_feat = 0;
   }
 // $max_feats = $class1_feat + $class2_feat + $gen_feats ;
  if ($class1_level > 0){
     $link = getDBLink();
     $select = "select classl_feat from classlev2 where classl_tp = '$class1_tp' and classl_lev = $class1_level and mon_key_1 = '$key_1'";
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result) ;
     $class1_feat = $row['classl_feat'];
     if ($class1_tp == "Animal Companion"){
   //      echo "here";
        if ($mon_int < 2){
           if ($mon_int == 0){
             $class1_feat += 1;
           }else{
             $class1_feat += 3;
           }
        }else{
          $class1_feat += 6;
       }
    }
  }
  if ($class2_level > 0){
     $link = getDBLink();
     $select = "select classl_feat from classlev2 where classl_tp = '$class2_tp' and classl_lev = $class2_level and mon_key_1 = '$key_1'";
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result) ;
     $class2_feat = $row['classl_feat'];
  }
//echo "</BR> class1_feat = " . $class1_feat;
//echo "</BR> class2_feat = " . $class2_feat;
  if ($class1_level > 20){
     $link = getDBLink();
     $select = "select classl_feat from classlev2 where classl_tp = '$class1_tp' and classl_lev = 20 and mon_key_1 = '$key_1'";
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result) ;
     $not_epic_feat1 = $row['classl_feat'];
     $epic = "Y";
  }else{
     $not_epic_feat1 = $class1_feat;
  }
  if ($class2_level > 20){
     $link = getDBLink();
     $select = "select classl_feat from classlev2 where classl_tp = '$class2_tp' and classl_lev = 20 and mon_key_1 = '$key_1'";
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result) ;
     $not_epic_feat2 = $row['classl_feat'];
     $epic = "Y";
  }else{
     $not_epic_feat2 = $class2_feat;
  }
  if ($mon_level > 20){
     $not_epic_feat3 = 7;
     $epic = "Y";
  }else{
     $not_epic_feat3 = 7;
  }

   // if ($epic == "Y"){
   //    $epic_feat_max = $max_feats - $not_epic_feat1 - $not_epic_feat2 - $not_epic_feat3 - $mon_feats_calc;
   // }else{
   //    $epic_feat_max = $gen_feats - $class_feats - $not_epic_feat3 - $tem_feats - $mon_free_feats;
        $epic_feat_max = $mon_feats_calc - 7 + $class_feats_calc ;
        $epic_feat_max = $gen_feats + $class1_feat + $class2_feat - (7 + $class_feats  + $not_epic_feat1 + $not_epic_feat2 + $mon_free_feats);
    //    echo "$epic_feat_max / $gen_feats / $class_feats / $class_feats_calc / $mon_free_feats</BR>";
    //    echo "$epic_feat_max " . (7 + $class_feats + $class_feats_calc + $mon_free_feats) . "</BR>";
    //    echo "c1 $class1_feat c2 $class2_feat </BR>";
   // }
 //   echo "epic feat $epic_feat_max mon feats calc $mon_feats_calc class_feats_clac $class_feats_calc" ;
  //  echo "</BR> gen_feats= $gen_feats class_feats= $class_feats";
  //  echo "</BR>not epic_feat1= $not_epic_feat1 not epic_feat2= $not_epic_feat2 not epic_feat3= $not_epic_feat3 mon_feats_calc = $mon_feats_calc ";
  //  echo "</BR>max feats= $max_feats  epic_feat_max = $epic_feat_max";
}
Function check_domain_remove($class,$level,$spec){
  global $class1_tp, $class1_level, $class2_tp, $class3_tp, $class2_level, $class3_level, $class1_feats;
  global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23, $domain_31, $domain_32, $domain_33;
  if ($class == $class1_tp){
     $domain = $domain11;
  }else{
     if ($class == $class2_tp){
        $domain = $domain21;
     }else{
       if ($class == $class3_tp){
          $domain = $domain31;
       }
     }
  }
  //echo "***domain*** $domain";
  if ($domain ==""){
      return("");
  }
  $link = getDBLink();
  $select =  "select spellclsp_remove from spellclsp where spellcl_id = '$spec' and spellclsp_level = '$level' and " .
          "spellclsp_remove = 'Y' and spellcl_id = '$domain'";
  $result = mysqli_query($link, $select) ;
  $remove = "";
   while ($row = mysqli_fetch_array($result)){
     $remove = $row['classl_feat'];
   }
   return ($remove);
}

Function check_specials_remove($spec, $no){
  global $class1_tp, $class1_level, $class2_tp, $class3_tp, $class2_level, $class3_level, $class1_feats, $key_1;
  global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23, $domain_31, $domain_32, $domain_33;
  $sel1 = "";
  $sel2 = "";
  if ($class1_tp == "Sorcerer" or $class1_tp == "Wizard" or $class1_tp == "Oracle" or  $class1_tp == "Bloodrager" or
      $class1_tp == "Psion" or $class1_tp == "Psychic Warrior" or $class1_tp == "Samurai" or  $class1_tp == "Investigator" or
      $class1_tp == "Cavalier" or $class1_tp == "Inquisitor" or $class1_tp == "Ranger" or $class1_tp == "Gunslinger" ){
     $sel1 = "(spellcl_id = '$domain_11' and spellclsp_level <= '$class1_level')";
  }
  if ($class1_tp == "Cleric" or ($class1_tp == "Psychic Warrior" and $domain_12 !="") ){
     $sel1 = "((spellcl_id = '$domain_11' or spellcl_id = '$domain_12') and spellclsp_level <= '$class1_level')";
  }
  if ($class2_tp == "Sorcerer" or $class1_tp == "Wizard" or $class2_tp == "Cavalier" or  $class2_tp == "Bloodrager" or
      $class2_tp == "Inquisitor" or $class1_tp == "Oracle" or $class2_tp == "Investigator" or
     $class2_tp == "Psion" or $class2_tp == "Psychic Warrior" or  $class2_tp == "Ranger" or $class2_tp == "Gunslinger" or $class2_tp == "Samurai"){
     $sel2 = "(spellcl_id = '$domain_21' and spellclsp_level <= '$class2_level')";
  }
  if ($class2_tp == "Cleric" or ($class2_tp == "Psychic Warrior" and $domain_22 !="") ){
     $sel2 = "((spellcl_id = '$domain_21' or spellcl_id = '$domain_22') and spellclsp_level <= '$class2_level' )";
  }
  if ($sel1 != ""){
     $sel_spellcl = $sel1;
     if ($sel2 != ""){
        $sel_spellcl .= " or (" . $sel2 . ")";
        $sel_spellcl = "(" . $sel_spellcl . ")";
     }
  }else{
      $sel_spellcl = $sel2;
  }
  $link = getDBLink();
  $select = "SELECT specials.spec_name, spec_desc, SUM(spellclsp_no), spec_display, spellclsp_remove  " .
               "FROM spellclsp, specials " .
               "WHERE spellclsp.spec_name = specials.spec_name and spellclsp.spec_name = '$spec' and " .
               "mon_key_1 = '$key_1' and ".
               $sel_spellcl .
               " group by specials.spec_name";
  $result = mysqli_query($link, $select) ;
  $remove = "";
   while ($row = mysqli_fetch_array($result)){
     $remove = $row[4];
     $sum += $row[2];
   }
//   echo "spec = $spec remove = $remove sum = $sum</BR>";
   $no += $sum;
   if ($no <= 0 and $remove == "Y"){
      return("Y");
   }else{
      return ($sum);
   }
}

Function skill_rank($rank){
   global $key_1, $total_level;
   $max = $total_level;
   if ($key_1 == "dd35"){
      $max = $total_level + 3;
   }
   if ($rank > $max){
      $max = $rank;
   }
   $loop = 0;
   $text = "";
   while ($loop <= $max){
     if ($rank == $loop){
        $sel = " SELECTED ";
     }else{
        $sel = " ";
     }
     if ($loop == 0){
        $value = "-";
     }else{
        $value = $loop;
     }
     $text.= "<OPTION VALUE =" . "'". $loop. "'" . " '". $sel . "' " . ">" . $value . "</OPTION>";
     $loop += 1;

   }
   $text .= "</SELECT>";
   return ($text);

}
Function deflect($deflect){
  global $mon_chr_bonus, $mon_level, $mon_con_bonus;
 // echo "deflect = " . $deflect;
  if ($deflect){
    if ($deflect == "QHD"){
       $ac = $mon_level / 4 - 0.49;
       $ac = round($ac,0);
    }else{
       if ($deflect == "CHR"){
          $ac = $mon_chr_bonus;
          if ($ac < 1){
             $ac = 1;
          }
       }else{
         if ($deflect == "HCHR"){
            $ac = $mon_chr_bonus / 2 - 0.49;
            $ac = round($ac,0);
            if ($ac < 1){
               $ac = 1;
            }
         }else{
             if ($deflect == "CON"){
                 $ac = $mon_con_bonus;
                 $ac = round($ac,0);
                 if ($ac < 1){
                     $ac = 1;
                 }
             }else{
                $ac = $deflect;
             }
         }
      }
   }
  }else{
     $ac = 0;
  }
  return ($ac);
}
Function insight($deflect){
  global $mon_int_bonus, $mon_level, $mon_chr_bonus, $mon_wis_bonus;
//  echo "insight = " . $deflect . " " . $mon_wis_bonus;
  if ($deflect){
    if ($deflect == "QHD"){
       $ac = $mon_level / 4 - 0.49;
       $ac = round($ac,0);
    }else{
       if ($deflect == "INT"){
          $ac = $mon_int_bonus;
          if ($ac < 1){
             $ac = 1;
          }
       }else{
         if ($deflect == "HINT"){
            $ac = $mon_int_bonus / 2 - 0.49;
            $ac = round($ac,0);
            if ($ac < 1){
               $ac = 1;
            }
         }else{
            if($deflect == "CHR"){
                $ac = $mon_chr_bonus;
                if ($ac < 1){
                      $ac = 1;
                }

           }else{
               if($deflect == "WIS"){
                  $ac = $mon_wis_bonus;
                  if ($ac < 1){
                      $ac = 1;
                  }

               }else{

                  $ac = $deflect;
               }
           }
         }
      }
   }
  }else{
     $ac = 0;
  }
  return ($ac);
}
Function profane($deflect){
  global $mon_chr_bonus, $mon_level;
 // echo "deflect = " . $deflect;
  if ($deflect){
    if ($deflect == "QHD"){
       $ac = $mon_level / 4 - 0.49;
       $ac = round($ac,0);
    }else{
       if ($deflect == "CHR"){
          $ac = $mon_chr_bonus;
          if ($ac < 1){
             $ac = 1;
          }
       }else{
         if ($deflect == "HCHR"){
            $ac = $mon_chr_bonus / 2 - 0.49;
            $ac = round($ac,0);
            if ($ac < 1){
               $ac = 1;
            }
         }else{
            $ac = $deflect;
         }
      }
   }
  }else{
     $ac = 0;
  }
  return ($ac);
}
Function dodge($deflect){
  global $mon_chr_bonus, $mon_level;
 // echo "deflect = " . $deflect;
  if ($deflect){
    if ($deflect == "QHD"){
       $ac = $mon_level / 4 - 0.49;
       $ac = round($ac,0);
    }else{
       if ($deflect == "CHR"){
          $ac = $mon_chr_bonus;
          if ($ac < 1){
             $ac = 1;
          }
       }else{
         if ($deflect == "HCHR"){
            $ac = $mon_chr_bonus / 2 - 0.49;
            $ac = round($ac,0);
            if ($ac < 1){
               $ac = 1;
            }
         }else{
            $ac = $deflect;
         }
      }
   }
  }else{
     $ac = 0;
  }
  return ($ac);
}
Function addskillrb($mon_name){
  global $user, $wp_user, $key_1, $mon_str_bonus, $mon_int_bonus, $mon_wis_bonus, $mon_dex_bonus, $mon_con_bonus, $mon_cha_bonus, $mon_temp, $mon_temp2;
//  echo "mon_str_bonus = $mon_str_bonus";
  $link = getDBLink();
  $select = "select monskillrb_tp, monskillrb_val, monskillrb_text, monskillrb_atr, monskillrb_classskill from monskillrb where (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user')
               and (mon_name = '$mon_name' or mon_name = '$mon_temp' or mon_name ='$mon_temp2')";
//  echo $select;
  $result = mysqli_query($link, $select) ;


  $count = 0;
  while ($row = mysqli_fetch_array($result)) {

       $skill= $row['monskillrb_tp'];
       $val = $row['monskillrb_val'];
       $text = $row['monskillrb_text'];
       $atr = $row['monskillrb_atr'];
       $classskill = $row['monskillrb_classskill'];
       if ($classskill == "Y"){
          $update = "UPDATE skilltemp set skillt_xskill = '' where skillt_user = '$user' and skillt_skill = '$skill'";
             $result2 = mysqli_query($link, $update);
       }




//       echo "</BR>atr = $atr";
       $atr_bon = checkno($atr,"");
       if ($atr_bon > 0){
          $val += $atr_bon;
       }
 //      echo "$skill  $text $val $atr_bon";
       $insert = "INSERT INTO skilltemprb (skilltrb_user , skilltrb_skill , skilltrb_text , skilltrb_val)" .
               "VALUES ('$user', '$skill', '$text', '$val')";
 //       echo $insert;
      if (!mysqli_query($link, $insert)){
         $select2 = "SELECT skilltrb_val from skilltemprb where skilltrb_user = '$user' and skilltrb_skill = '$skill' and skilltrb_text = '$text'";
         $result2 = mysqli_query($link, $select2) ;
         $row2 =  mysqli_fetch_array($result2);
         $val2 = $row2['skilltrb_val'];

         $val += $val2;
     //    echo "here $val . $val2";
         $update = "UPDATE skilltemprb set skilltrb_val = '$val'  where skilltrb_user = '$user' and skilltrb_skill = '$skill' and skilltrb_text = '$text'";
         $result3 = mysqli_query($link, $update) ;
      }
   }
}
Function addjumpskillrb ($armour_jump){
       global $user, $wp_user, $key_1;
       $link = getDBLink();
       $skill= "Acrobatics";
       $val = $armour_jump;
       $text = "Jumping";
 //      echo "$skill  $text $val";
       $insert = "INSERT INTO skilltemprb (skilltrb_user , skilltrb_skill , skilltrb_text , skilltrb_val)" .
               "VALUES ('$user', '$skill', '$text', '$val')";
 //       echo $insert;
      if (!mysqli_query($link, $insert)){
         $select2 = "SELECT skilltrb_val from skilltemprb where skilltrb_user = '$user' and skilltrb_skill = '$skill' and skilltrb_text = '$text'";
         $result2 = mysqli_query($link, $select2) ;
         $row2 =  mysqli_fetch_array($result2);
         $val2 = $row2['skilltrb_val'];

         $val += $val2;
         $update = "UPDATE skilltemprb set skilltrb_val = '$val'  where skilltrb_user = '$user' and skilltrb_skill = '$skill' and skilltrb_text = '$text'";
         $result3 = mysqli_query($link, $update) ;
      }
}
Function magicstat($class_spat){
   global $mon_str_m, $mon_str_s, $mon_int_m, $mon_int_s, $mon_dex_m, $mon_dex_s, $mon_con_m, $mon_con_s, $mon_wis_m, $mon_wis_s, $mon_chr_m, $mon_chr_s;
   $stat_m_v = "mon_" . strtolower($class_spat) . "_m";
   $stat_s_v = "mon_" . strtolower($class_spat) . "_s";
   $stat_m = $$stat_m_v;
   $stat_s = $$stat_s_v;
   $stat_b = $stat_m - $stat_s;
//   echo "$stat_m_v = " . $stat_m;
//   echo "$stat_s_v = " . $stat_s;
//   echo "stat_b = " . $stat_b;

   if ($stat_b < 0){
      $stat_b = 0;
   }
   return($stat_b);
}
Function specattr(){
   global  $count_aura, $print_aura, $count_aura, $htmlp_spell_abil,$htmlp_spell_abil_s, $print_spell_abil, $print_attack, $count_attack, $monsterSpecialHTML;
   global $zombie_tem,  $mon_template, $spec_level, $print_special_attacks, $print_ranged, $count_ranged, $print_CMD, $count_CMD, $print_CMB, $count_CMB;
   global $print_reach, $count_reach,$htmlp_special_attacks, $print_special_attacks_s;
   global $wp_user, $key_1, $total_level, $mon_name, $mon_level, $tem_level, $mon_template, $mon_temp, $mon_temp2;
   global $mon_str_bonus, $mon_int_bonus, $mon_wis_bonus, $mon_dex_bonus, $mon_con_bonus, $mon_chr_bonus;
   global $mon_str, $mon_int, $mon_wis, $mon_dex, $mon_con, $mon_chr,$mon_namex;
  // Monster Special Attacks
//include 'includes/dd_db_conn.txt';
  $link = getDBLink();
  $monsterSpecialHTML = "";
  $mon_namex = $mon_name;
//  if ($wp_user == "admin"){
//     echo $total_level;
//  }
  if ($zombie_tem === 0 and $mon_int == 0){
     $mon_namex = "XXXX";
  }
  $select = "SELECT monspec_name, monspec_value, specatta_abil, specatta_save, specatta_type from monspec2, specatta where monspec_tp = 'A' and (mon_name = '$mon_namex' or mon_name = '$mon_temp' or mon_name = '$mon_temp2')" .
            "and monspec_name = speca_name and (mon_key_1 = '$wp_user' or  mon_key_1 = '$key_1')" .
            " and ((monspec_min = 0 and monspec_max = 0) or (monspec_min = '' and monspec_max = '') or (monspec_min <= '$total_level' and monspec_max = 0)" .
            "or (monspec_min <= '$total_level' and monspec_max >= '$total_level')  )";
 // if ($wp_user == "admin"){
//    echo $select;
//  }
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  $count = 0;
  $mon_nul_bonus = 0;
// if monster has a template then specials abilities include levels
//echo "template " . $mon_template;
  if ($mon_template == "0" or $mon_template =="L" or $mon_template == "T" or $mon_template =="AC"){
     $spec_level = $total_level;
  }else{
     $spec_level = $mon_level + $tem_level;
  }
//echo "spec level " . $spec_level;
  while ($row = mysqli_fetch_array($result)) {
      $count = $count + 1;
      $specatta_abil = strtolower($row['specatta_abil']);
      $specatta_type = $row['specatta_type'];
      if ($specatta_abil == "str" or  $specatta_abil == "int" or $specatta_abil == "wis" or $specatta_abil == "dex" or $specatta_abil == "con" or $specatta_abil == "chr"){
         $abil_atr_v = "mon_". strtolower($specatta_abil) . "_bonus";
         $abil_atr_p_v = "mon_". strtolower($specatta_abil);
         if ($$abil_atr_p_v == "0"){
           if ($mon_type == "Construct"){
              $abil_atr_v = "mon_nul_bonus";
           }else{
              if ($mon_chr > 1){
                $abil_atr_v = "mon_chr_bonus";
             }else{
                $abil_atr_v = "mon_nul_bonus";
             }
           }
         }
      }else{
         $abil_atr_v = "mon_nul_bonus";
      }

      $specatta_save = $row['specatta_save'];
      $DC_txt = " ";
//    echo $$abil_atr_v . $abil_atr_v;
      if ($specatta_save !="" and $specatta_save != " "){
        if ($specatta_save == "LV"){
          $DC =  10 + round($spec_level /2 -0.5) + $$abil_atr_v;
        }else{
          $DC = 10 + $specatta_save + $$abil_atr_v;
        }
        $DC_txt = " DC(" . $DC . ") ";
      }
      if ($specatta_type == "DOMAIN"){
         $domain_m +=1;
         $domain_v = "domain_m". $domain_m;
         $$domain_v = $row['monspec_value'];
//        echo "$domain_v $domain_m1";
      }
      $monsterSpecialHTML .= '<li class="specialAbility"><ul>';
      $monsterSpecialHTML .= '<li>'.$row['monspec_name']. $DC_txt . '</li>';
      $monsterSpecialHTML .= '<li class="small greyText">'.$row['monspec_value'] . '</li>';
      $monsterSpecialHTML .= '</ul></li>';
      $print_special_attacks .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'] . ", \n";
      if ($specatta_type != "SPELL"){
         if ($print_special_attacks_s != ""){
             $print_special_attacks_s .= ", ";
         }
         $print_special_attacks_s .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'] ;
      }




  //  echo "type = :" . $specatta_type .":";
      if ($specatta_type == "AURA"){
         $count_aura += 1;
          if ($count_aura > 1){
             $print_aura .= ", ";
          }
         $print_aura .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
      }else{
        if ($specatta_type == "SPELL"){
          $htmlp_spell_abil .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value']. "</BR>";
          if ($htmlp_spell_abil_s != ""){
              $htmlp_spell_abil_s .= ", ";
          }
          $htmlp_spell_abil_s .=  "$DC_txt" . $row['monspec_value'];
          $print_spell_abil .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value']. "\p";

         }else{
           if ($specatta_type == "ATTACK"){
              $count_attack += 1;
              if ($count_attack > 1){
                 $print_attack .= ", ";
              }
        //      echo $print_attack;
              $print_attack .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
           }else{
              if ($specatta_type == "RANGED"){
                $count_ranged += 1;
                if ($count_ranged > 1){
                   $print_ranged .= ", ";
                }
                $print_ranged .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
    //            echo "Ranged $print_ranged";
             }else{
                if ($specatta_type == "CMD"){
                  $count_CMD += 1;
                  if ($count_CMD > 1){
                     $print_CMD .= ", ";
                  }
        //      echo "CMD $print_CMD";
                  $print_CMD .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
               }else{
                    if ($specatta_type == "CMB"){
                       $count_CMB += 1;
                       if ($count_CMB > 1){
                         $print_CMB .= ", ";
                       }
          //    echo "CMB $print_CMB";
                      $print_CMB .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
                    }else{
                      if ($specatta_type == "REACH"){
                       $count_reach += 1;
                        if ($count_reach > 1){
                         $print_reach .= ", ";
                        }
        //    echo "CMB $print_CMB";
                        $print_reach .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
                        }else{
                           if ($htmlp_special_attacks != ""){
                             $htmlp_special_attacks .= ",<BR>";
                           }
                        $htmlp_special_attacks .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
                       }
                   }
               }
            }
        }
      }
    }
  }
  if ($htmlp_special_attacks != ""){
      $htmlp_special_attacks .= "<BR>";
  }

}
Function displayButtons1(){
global $save_key_old;
if ($save_key_old != ""){

echo <<<END
<div class="buttonBlock">
<INPUT class="button noPrint" TYPE="submit" ID="print_ind11" style="display: none"  NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 90px" />
<INPUT class="button noPrint" TYPE="submit" ID="print_ind12" style="display: none"  NAME="print_ind" VALUE="Plain Text Version" style="height: 28px; width: 140px"/>
<INPUT class="button noPrint" TYPE="submit" ID="print_ind13" style="display: none"  NAME="print_ind" VALUE="Short Text Version" style="height: 28px; width: 140px"/>
<INPUT class="button noPrint" TYPE="submit" ID="print_ind14" style="display: none"  NAME="print_ind" VALUE="Save" style="height: 28px; width: 50px"/>
<INPUT class="button noPrint" TYPE="submit" ID="print_ind15" style="display: none"  NAME="print_ind" VALUE="New Save" style="height: 28px; width: 77px"/>
</div>
END;

}else{
echo <<<END
<div class="buttonBlock">
<INPUT class="button noPrint" TYPE="submit" ID="print_ind1" style="display: none" NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 150px"/>
<INPUT class="button noPrint" TYPE="submit" ID="print_ind2" style="display: none" NAME="print_ind"  VALUE="Plain Text Version" style="height: 28px; width: 150px"/>
<INPUT class="button noPrint" TYPE="submit" ID="print_ind3" style="display: none" NAME="print_ind"  VALUE="Short Text Version" style="height: 28px; width: 180px"/>
<INPUT class="button noPrint" TYPE="submit" ID="print_ind4" style="display: none" NAME="print_ind" VALUE="Save" style="height: 28px; width: 80px"/>
</div>
END;

}

}
Function displayButtons2(){
global $save_key_old;
if ($save_key_old != ""){

echo <<<END
<div class="buttonBlock">
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 90px" />
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind" VALUE="Plain Text Version" style="height: 28px; width: 140px"/>
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind" VALUE="Short Text Version" style="height: 28px; width: 140px"/>
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind" VALUE="Save" style="height: 28px; width: 50px"/>
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind" VALUE="New Save" style="height: 28px; width: 80px"/>
</div>
END;

}else{
echo <<<END
<div class="buttonBlock">
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind" VALUE="Recalculate" style="height: 28px; width: 150px"/>
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind"  VALUE="Plain Text Version" style="height: 28px; width: 150px"/>
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind"  VALUE="Short Text Version" style="height: 28px; width: 150px"/>
<INPUT class="button noPrint" TYPE="submit"  NAME="print_ind" VALUE="Save" style="height: 28px; width: 100px"/>
</div>
END;

}
}
Function speed($speed){
  global $armour_s30;
  if ($speed == 0 or $armour_s30 == 30){
     return($speed);
  }else{
    $select = "select speed_reduced from speed where speed_ft = $speed";
    $link = getDBLink();
    $result = mysqli_query($link, $select) ;
    $row = mysqli_fetch_array($result);
    $speed_reduced = $row['speed_reduced'];
    if ($speed_reduced > 0){
      return ($speed_reduced);
    }else{
      $speed_reduced = $speed - 10;
      if ($speed_reduced < 0){
        $speed_reduced = 5;
      }
      return ($speed_reduced);
    }
  }
}

Function  get_attr_bonus() {
   global $mon_str_bonus, $mon_dex_bonus,$mon_con_bonus, $mon_int_bonus, $mon_int_orig, $mon_int_bonus_skill, $mon_wis_bonus, $mon_chr_bonus;
   global $mon_str, $mon_dex, $mon_con, $mon_int, $mon_wis, $mon_chr, $mon_int_bonus_orig;
   global $tem_type, $mon_sv_will, $tem_sv_will, $mon_sv_fort, $tem_sv_fort, $mon_sv_reflex, $tem_sv_reflex, $key_1;
   global $mon_str_m, $mon_dex_m, $mon_con_m, $mon_int_m, $mon_wis_m, $mon_chr_m, $mon_int_bonus_skill;
   if (is_numeric($mon_str) == TRUE and $mon_str > 0){
     $mon_str_bonus = ($mon_str + $mon_str_m  - 10) /2 - .49;
     $mon_str_bonus = round($mon_str_bonus,0);
   }else{
     $mon_str_bonus = 0;
   }
   if (is_numeric($mon_dex) == TRUE and $mon_dex > 0){
     $mon_dex_bonus = ($mon_dex + $mon_dex_m - 10) /2 - .49;
     $mon_dex_bonus = round($mon_dex_bonus,0);
   }else{
     $mon_dex_bonus = 0;
   }

   if (is_numeric($mon_con) == TRUE and $mon_con > 0){
     $mon_con_bonus = ($mon_con + $mon_con_m - 10) /2 - .49;

     $mon_con_bonus = round($mon_con_bonus,0);
//  echo $mon_con_bonus;
   }else{
     $mon_con_bonus = 0;
   }
   if (is_numeric($mon_int) == TRUE and $mon_int > 0){
     $mon_int_bonus = ($mon_int + $mon_int_m - 10) /2 - .49;
     $mon_int_bonus = round($mon_int_bonus,0);
     $mon_int_bonus_skill = ($mon_int - 10) /2 - .49;
     $mon_int_bonus_skill = round($mon_int_bonus_skill,0);
   }else{
     $mon_int_bonus = 0;
     $mon_int_bonus_skill = 0;
   }
 //  echo "mon_int_orig $mon_int_orig";
   if (is_numeric($mon_int_orig) == TRUE and $mon_int_orig > 0){
     $mon_int_bonus_orig = ($mon_int_orig - 10) /2 - .49;
     $mon_int_bonus_orig = round($mon_int_bonus_orig,0);
   }else{
      $mon_int_bonus_orig = 0;
   }
//   echo  "mon_int_bonus_orig = $mon_int_bonus_orig";
   if (is_numeric($mon_wis) == TRUE and $mon_wis > 0){
     $mon_wis_bonus = ($mon_wis + $mon_wis_m - 10) /2 - .49;
     $mon_wis_bonus = round($mon_wis_bonus,0);
   }else{
     $mon_wis_bonus = 0;
   }
   if ($tem_type == "Undead" and $key_1 =="path"){
      $mon_sv_will = $tem_sv_will;
      $mon_sv_fort = $tem_sv_fort;
      $mon_sv_reflex = $tem_sv_reflex;
      if ($mon_chr < 10){
        $mon_chr = 10;
      }
//   echo "will $mon_sv_will fort $mon_sv_fort reflex $mon_sv_reflex";
   }


   if (is_numeric($mon_chr) == TRUE and $mon_chr > 0){
     $mon_chr_bonus = ($mon_chr + $mon_chr_m - 10) /2 - .49;
     $mon_chr_bonus = round($mon_chr_bonus,0);
   }else{
     $mon_chr_bonus = 0;
   }
}

function add_BR ($html){
   $html = str_replace("\\\n","</BR>",$html);
   $html = str_replace("\\n","</BR>",$html);
   $html = str_replace("\n","</BR>",$html);
   $html = str_replace("\'","",$html);
   $html = str_replace(".\\" , "." , $html);
   $html = str_replace(chr(30),"</BR>",$html);
   $html = str_replace(chr(10),"</BR>",$html);
   $html = str_replace(chr(155),"</BR>",$html);
   return($html);
}




?>