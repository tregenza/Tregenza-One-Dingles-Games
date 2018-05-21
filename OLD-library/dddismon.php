<?
$local =  $_SERVER['SERVER_NAME'];
//  <-- CT 29/11/08
$local .= dirname($_SERVER['PHP_SELF'] ); 		// Append the current path
//  END -->
//$includePath = "/usr/share/wordpress2.7/wp-content/themes/dinglesgames/";
//$includePathLocal = $includePath."tools/MonsterGenerator/dnd35";
// Get standard functions
//require $includePathLocal."/ddmonsterFunctions.php";


if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location_print = 'http://' . $local . '/dddismonprint.php';
}else{
   $location_print =  'http://' . $local . '/dddismonprint.php';
}
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location_self = 'http://' . $local . '/dddismon.php';
}else{
   $location_self =  'http://' . $local . '/dddismon.php';
}

$h = populateHelp();



//echo $location;
//echo "-------------------\n";
//echo var_dump($_SESSION);

if (IsSet($_SESSION['smon_name'])){
   $mon_name     = $_SESSION['smon_name'];
   $class1_tp    = $_SESSION['sclass1_tp'];
   $class1_level = $_SESSION['sclass1_level'];
   $class1_focus = $_SESSION['sclass1_focus'];
   $class2_tp    = $_SESSION['sclass2_tp'];
   $class2_level = $_SESSION['sclass2_level'];
   $class2_focus = $_SESSION['sclass2_focus'];
   $user         = $_SESSION['suser'];
   $new          = $_SESSION['snew'];
   $oldmon_key   = $_SESSION['soldmon_key'];
   $elite        = $_SESSION['selite'];
//echo "elite = " . $elite . "</BR>";
   $select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed , mon_speed_fly, mon_speed_climb, mon_speed_swim, mon_speed_burrow, ".
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, montype_skillp, montype_att, montype_cr, mon_template ".
                   "from monster, montype where mon_name = '$mon_name' and mon_type = montype";

//  include $includePathLocal.'/includes/dd_db_conn.txt';
	$link = getDBLink();


  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
/*
	$mon_name = $row['mon_name'] ;
	$mon_size = $row['mon_size'] ;
	$mon_type = $row['mon_type'] ;
	$mon_hd   = $row['mon_hd'] ;
	$mon_init = $row['mon_init'] ;
	$mon_speed = $row['mon_speed'] ;
	$mon_speed_fly = $row['mon_speed_fly'] ;
	$mon_speed_climb = $row['mon_speed_climb'] ;
	$mon_speed_swim = $row['mon_speed_swim'] ;
	$mon_speed_burrow = $row['mon_speed_burrow'] ;
	$mon_ac_flat = $row['mon_ac_flat'] ;
	$mon_ac   = $row['mon_ac'] ;
	$mon_base_att = $row['mon_base_att'] ;
	$mon_full_att = $row['mon_full_att'] ;
	$mon_space    = $row['mon_space'] ;
	$mon_reach    = $row['mon_reach'] ;
	$mon_cr   = $row['mon_cr'] ;
	$mon_str = $row['mon_str'] ;
	$mon_dex = $row['mon_dex'] ;
	$mon_con = $row['mon_con'] ;
	$mon_int = $row['mon_int'] ;
	$mon_wis = $row['mon_wis'] ;
	$mon_chr = $row['mon_chr'] ;
	$mon_desc = $row['mon_desc'] ;
	$mon_sv_fort = $row['mon_sv_fort'] ;
	$mon_sv_reflex = $row['mon_sv_reflex'] ;
	$mon_sv_will = $row['mon_sv_will'] ;
	$mon_armour = $row['mon_armour'] ;
	$mon_shield = $row['mon_shield'] ;
	$mon_skillp  = $row['montype_skillp'] ;
	$montype_cr  = $row['montype_cr'];
	$montype_att = $row['montype_att'];

*/
	extract( $row, EXTR_OVERWRITE);
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
   $total_level = $class1_level + $class2_level;
   $total_level_bonus = round(($total_level / 4 -0.5), 0);
//  echo "lev bonus " . $total_level_bonus;
//   if ($elite == "Y"){
   if ($class1_tp !=""){
     if ( $class1_level >= $class2_level){
       $class_tp = $class1_tp;
       $class_focus = $class1_focus;
     }else{
       $class_tp = $class2_tp;
       $class_focus = $class2_focus;
     }
     $select = "select classh_atr1, classh_atr2, classh_atr3, classh_atr4, classh_atr5, classh_atr6 from  classfocush " .
               "where classfh_class =  '$class_tp' and classfh_focus = '$class_focus'";
//       echo $select;
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result);
     $atr_1 = $row['classh_atr1'];
//echo "atr_1 ". $atr_1;
     $atr_2 = $row['classh_atr2'];
     $atr_3 = $row['classh_atr3'];
     $atr_4 = $row['classh_atr4'];
     $atr_5 = $row['classh_atr5'];
     $atr_6 = $row['classh_atr6'];
   }else{
     $atr_1 = "STR";
     $atr_2 = "INT";
     $atr_3 = "CON";
     $atr_4 = "CHR";
     $atr_5 = "DEX";
     $atr_6 = "WIS";
   }
   $atr1_v = "mon_" . strtolower($atr_1);
//   echo $atr1_v;
   $atr2_v = "mon_" . strtolower($atr_2);
   $atr3_v = "mon_" . strtolower($atr_3);
   $atr4_v = "mon_" . strtolower($atr_4);
   $atr5_v = "mon_" . strtolower($atr_5);
   $atr6_v = "mon_" . strtolower($atr_6);
   if ($elite == "Y"){
     if ($mon_hd_original == 0 or $mon_hd_original == 1){
       if ($$atr1_v != 0){
         $$atr1_v = $$atr1_v + 4 + $total_level_bonus;
       }
       if ($$atr2_v != 0){
         $$atr2_v = $$atr2_v + 3;
       }
       if ($$atr3_v != 0){
         $$atr3_v = $$atr3_v + 2;
       }
       if ($$atr4_v != 0){
         $$atr4_v = $$atr4_v + 1;
       }
       if ($$atr6_v != 0){
       $$atr6_v = $$atr6_v - 2;
       }
     }else{
       if ($$atr1_v != 0){
         $$atr1_v = $$atr1_v + 4 + $total_level_bonus;
       }
       if ($$atr2_v != 0){
         $$atr2_v = $$atr2_v + 2;
       }
       if ($$atr3_v != 0){
         $$atr3_v = $$atr3_v + 2;
       }
       if ($$atr4_v != 0){
         $$atr4_v = $$atr4_v + 0;
       }
       if ($$atr6_v != 0){
       $$atr6_v = $$atr6_v + 0;
       }
     }
   }else{
     if ($mon_hd_original == 0 or $mon_hd_original == 1){
       if ($$atr1_v != 0){
        $$atr1_v = $$atr1_v + 2 + $total_level_bonus;
       }
       if ($$atr2_v != 0){
         $$atr2_v = $$atr2_v + 1;
       }
       if ($$atr3_v != 0){
         $$atr3_v = $$atr3_v + 0;
       }
       if ($$atr4_v != 0){
         $$atr4_v = $$atr4_v - 1;
       }
       if ($$atr5_v != 0){
         $$atr5_v = $$atr5_v - 2;
       }
       if ($$atr6_v != 0){
         $$atr6_v = $$atr6_v - 3;
       }
     }else{
//      $$atr1_v = $$atr1_v + $total_level_bonus;
//      $$atr5_v = $$atr5_v - 1;
//      $$atr6_v = $$atr6_v - 1;
     }
   }
//  take off armour
   if (($class1_tp == "Sorcerer" or $class1_tp == "Wizard" or $class1_tp == "Monk") or 
       ($class2_tp == "Sorcerer" or $class2_tp == "Wizard" or $class2_tp == "Monk")){
       $mon_armour = "No Armour";
       $mon_shield = "Shield, none";
   }



  $mon_size_original = $mon_size;










  $mon_base_att_orig = $mon_base_att;
  $mon_ac_flat_orig = $mon_ac_flat;
  $mon_int_orig = $mon_int;
// Monster Feats
  $delete = "delete from feattemp where feattemp_user = '$user'";
//  echo "</BR> " . $delete;
  $result = mysqli_query($link, $delete) ;
  $select = "select monfeat from monfeat where mon_name = '$mon_name'";
//    echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    $mon_feats = 0;
    $mon_free_feats = 0;
    while ($row = mysqli_fetch_array($result)) {
      $feat = $row['monfeat'];
// if feat is a proficiecy do not include this in the count for the monster as these are free
      if ($feat == "Armour prof light" or $feat == "Armour prof medium" or $feat == "Armour prof heavy" or
          $feat == "Simple Weapon Proficiency" or $feat == "Martial Weap Prof" or $feat == "Shield Proficiency"){
          $mon_free_feats = $mon_free_feats + 1;
      }
      $mon_feats = $mon_feats + 1;
//      echo "</BR> feat" . $feat;
      $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto) VALUES " .
                "('$user','$feat', '3','Y')";
// echo "</BR> $insert";
      $result1 = mysqli_query($link, $insert);   
    }
   }
//  Checks for free feats of monster
   if ($mon_hd_original > 0){
       $calc_mon_feats =  round((($mon_hd_original /3) -0.5),0) +1;
       if ($mon_int == 0){
         $calc_mon_feats = 0;
       }
//       echo "calc " . $calc_mon_feats . " mon " . $mon_feats . " free " . $mon_free_feats ;
       if ($calc_mon_feats < ($mon_feats - $mon_free_feats)){
         $diff = $mon_feats - ($calc_mon_feats + $mon_free_feats);
//         echo "diff " . $diff;
         $mon_free_feats =  $mon_free_feats + $diff;
       }
   }
// Monster Weapons
  $mon_weap_s1 = "No Melee";
  $select = "select monweap_attp, monweap_wp, weap_dam, weap_dam2, weap_type, weap_cat, dambase_no, dambase_incr,".
            " monweap_dam from " .
             "monweap, weapons, dddambase where ".
             "monweap_mon = '$mon_name' and monweap_wp = weap_id and weap_dam = dambase";
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
        $$weap_dam_v = $row['weap_dam'];
        $$weap_dam2_v = $row['weap_dam2'];
        $$weap_type_v = $row['weap_type'];
        $$monweap_dam_v = $row['monweap_dam'];
        $$weap_cat_v    = $row['weap_cat'];
        $$weap_dambase_no_v  = $row['dambase_no'];
        $$weap_dambase_incr_v  = $row['dambase_incr'];
        $weap = $row['monweap_wp'];
        if ($$weap_cat_v == "0-Natural"){
           $$weap_dam_v = $$monweap_dam_v;
        }
//        echo "</BR> Weapon " . $mon_weap_v . $$mon_weap_v . $$weap_dam_v ."*** </BR>";
    }
  }

//
//
//
//
//
//
//
//  monster skills
//
// 
 $new = "YES";
 if ($new == "YES"){
	 $link = getDBLink();
//  include 'includes/dd_db_conn.txt';
  $delete = "DELETE FROM skilltemp WHERE skillt_user = '$user'";
//  echo "</BR>" . $delete ;
  $result = mysqli_query($link, $delete) ;
//
  $select = "SELECT monskill_tp, monskill_val,skill_atr, skill_armour_ch from monskill, skills WHERE mon_name = '$mon_name'".
             " AND monskill_tp = skill_cd" ;
//  echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  $count = 0;
  while ($row = mysqli_fetch_array($result)) {
    $count += 1;
    $skill = $row['monskill_tp'];
    $rank  = $row['monskill_val'];
    $atr   = $row['skill_atr'];
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
      $result1 = mysqli_query($link, $insert);
//    
//    echo $insert . " </BR>";
     }
   }

// insert all focus skills into temp dbase
    if ($class1_tp != ""){
      $select = "SELECT classf_class, classf_focus, classf_skill, classf_tp, classf_xskill, skill_atr, skill_armour_ch " . 
               " from classfocus, skills ".
               "WHERE classf_class = '$class1_tp' and classf_focus = '$class1_focus'" .  
                     "and  classf_skill =  skill_cd";
       $link = getDBLink();
      // include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $select) ;
      while ($row = mysqli_fetch_array($result)) {
         $skill = $row['classf_skill'];
         $rank  = 0;
         $xskill = $row['classf_xskill'];
         $atr = $row['skill_atr'];
         $atr_bonus = 0;
         $misc_bonus = 0;
         $armour_ch = $row['skill_armour_ch'];
         $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                   "skillt_misc_bonus , skillt_xskill,skillt_armour_ch) " .
                   "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch')";
         $result1 = mysqli_query($link, $insert);
     }
    }
    if ($class2_tp != ""){
      $select = "SELECT classf_class, classf_focus, classf_skill, classf_tp, classf_xskill, skill_atr, skill_armour_ch " . 
                " from classfocus, skills ".
               "WHERE classf_class = '$class2_tp' and classf_focus = '$class2_focus'" .
                      "and  classf_skill =  skill_cd"; 
//echo "</BR> $select";
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      while ($row = mysqli_fetch_array($result)) {
         $skill = $row['classf_skill'];
         $rank  = 0;
         $xskill = $row['classf_xskill'];
         $atr = $row['skill_atr'];
         $atr_bonus = 0;
         $misc_bonus = 0;
         $armour_ch = $row['skill_armour_ch'];
         $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                   "skillt_misc_bonus , skillt_xskill, skillt_armour_ch) " .
                    "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch')";
// echo "</BR> $insert";
         $result1 = mysqli_query($link, $insert);
      }
    }
  }
  $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level where lev_no = '$mon_hd_original'" ;

//   include 'includes/dd_db_conn.txt';

	$link = getDBLink();

   $result = mysqli_query($link, $select) ;
   if (mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      $mon_orig_attg = $row['lev_attg'] ;
      $mon_orig_atta = $row['lev_atta'] ;
      $mon_orig_attp = $row['lec_attp'] ;
   }

//
//
//
}else{
   $local =  $_SERVER['SERVER_NAME'];
   if ($local == "paulds-1.vm.bytemark.co.uk"){
       $location_sel = '"http://' . $local . './index.php"';
   }else{
       $location_sel =  '"http://' . $local . $defaultPath;
   }
echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript">
  alert( $location_sel );
     window.location = $location_sel;
  </script>

EOF;
}

if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
    }
//          
   if ($msg == "") {
      $_SESSION['smon_name'] = $mon_name;
      $_SESSION['sclass1_tp'] = $class1_tp;
      $_SESSION['sclass1_level'] = $class1_level;
      $_SESSION['sclass2_tp'] = $class2_tp;
      $_SESSION['sclass2_level'] = $class2_level;
      $_SESSION['snew'] = "NO";
      $_SESSION['sprint'] = $mon_print;
//      echo $mon_print;
      $update  = "UPDATE lastmon SET lastmon_mon_name = '$mon_name', lastmon_class1_tp = '$class1_tp', lastmon_class1_level = '$class1_level', " .
      "lastmon_class1_focus = '$class1_focus', lastmon_class2_tp = '$class2_tp', lastmon_class2_level = '$class2_level', lastmon_class2_focus = '$class2_focus', " .
      "lastmon_text = '$mon_print'  WHERE lastmon_count = '$oldmon_key'";
      $link = getDBLink();
      $result3 = mysqli_query($link, $update) ;
   }
//   echo $_SERVER['HTTP_REFERER'];

}
//echo $mon_print;
if ($print_ind == "Plain Text Version"){
    $_SESSION['sprint'] = $mon_print;
echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript">
     window.location = '$location_print';
  </script>
EOF;
}
//
//

//require $includePathLocal."/ddmonsterFunctions.php";




//Get monster level
//
$d = strpos($mon_hd,"D");
if ($d == FALSE){
   $d = strpos($mon_hd,"d");
}
if ($d == FALSE){
  $mon_die = "D8";
  $mon_level = $mon_hd;
}else{
  $len = strlen($mon_hd);
  $mon_level = substr($mon_hd,0,($d));
  $mon_die = substr($mon_hd,$d,$len);
}
// echo "</BR> level = " . $mon_level . " hd = " . $mon_die;
//
  //Calculate stat bonus
//
//
//
if (is_numeric($mon_str) == TRUE and $mon_str > 0){
  $mon_str_bonus = ($mon_str - 10) /2 - .49;
  $mon_str_bonus = round($mon_str_bonus,0);
}else{
  $mon_str_bonus = 0;
}
if (is_numeric($mon_dex) == TRUE and $mon_dex > 0){
  $mon_dex_bonus = ($mon_dex - 10) /2 - .49;
  $mon_dex_bonus = round($mon_dex_bonus,0);
}else{
  $mon_dex_bonus = 0;
}

if (is_numeric($mon_con) == TRUE and $mon_con > 0){
  $mon_con_bonus = ($mon_con - 10) /2 - .49;
  $mon_con_bonus = round($mon_con_bonus,0);
}else{
  $mon_con_bonus = 0;
}
if (is_numeric($mon_int) == TRUE and $mon_int > 0){
  $mon_int_bonus = ($mon_int - 10) /2 - .49;
  $mon_int_bonus = round($mon_int_bonus,0);
}else{
  $mon_int_bonus = 0;
}
if (is_numeric($mon_int_orig) == TRUE and $mon_int_orig > 0){
  $mon_int_bonus_orig = ($mon_int_orig - 10) /2 - .49;
  $mon_int_bonus_orig = round($mon_int_bonus_orig,0);
}else{
  $mon_int_bonus_orig = 0;
}
if (is_numeric($mon_wis) == TRUE and $mon_wis > 0){
  $mon_wis_bonus = ($mon_wis - 10) /2 - .49;
  $mon_wis_bonus = round($mon_wis_bonus,0);
}else{
  $mon_wis_bonus = 0;
}
if (is_numeric($mon_chr) == TRUE and $mon_chr > 0){
  $mon_chr_bonus = ($mon_chr - 10) /2 - .49;
  $mon_chr_bonus = round($mon_chr_bonus,0);
}else{
  $mon_chr_bonus = 0;
}
//
//
//
//  get monster class level
//
//
//
// echo $mon_level;
//
$select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
 "lev_abil from level where lev_no = $mon_level" ;

 $link = getDBLink();
//include $includePathLocal.'/includes/dd_db_conn.txt';


$result = mysqli_query($link, $select) ;
if (mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_array($result);
  $mon_lev_savg = $row['lev_savg'] ;
  $mon_lev_savp = $row['lev_savp'] ;
  $mon_lev_attg = $row['lev_attg'] ;
  $mon_lev_atta = $row['lev_atta'] ;
  $mon_lev_attp = $row['lev_attp'] ;
  $mon_lev_sjlr = $row['lev_sklr'] ;
  $mon_lev_sklx = $row['lev_sklx'] ;
  $mon_lev_feat = $row['lev_feat'] ;
  $mon_lev_abil = $row['lev_abil'] ;
}
//
// saving throws
//
$pal = 0;
if (($class1_tp == "Paladin" and $class1_level > 1) or
    ($class2_tp == "Paladin" and $class2_level > 1)){
   $pal = $mon_chr_bonus;
}  
//
if ($mon_sv_will == 'G'){
    $mon_will_sv = $mon_lev_savg + $pal;
}else{
    $mon_will_sv = $mon_lev_savp + $pal; 
}  
if ($mon_sv_fort == 'G'){
    $mon_fort_sv = $mon_lev_savg + $pal;
}else{
    $mon_fort_sv = $mon_lev_savp + $pal; 
}  
if ($mon_sv_reflex == 'G'){
    $mon_reflex_sv = $mon_lev_savg + $pal;
}else{
    $mon_reflex_sv = $mon_lev_savp + $pal; 
}  
//
//  Find how good monsters attack is
//
//
//echo "</BR> $mon_orig_attg ";
//echo "</BR> level $mon_lev_attg";
$mon_base_att_v = "mon_lev_att" . strtolower($montype_att);
//echo "</BR> $mon_base_att_v $$monbase_att_v";
$mon_base_att_x = $$mon_base_att_v;
//if ($mon_base_att_orig >= $mon_orig_attg){
//   $mon_base_att_x = $mon_lev_attg;
//}else{
//     if ($mon_base_att_orig >= $mon_orig_atta){
//         $mon_base_att_x = $mon_lev_atta;
//     }else{
//         $mon_base_att_x = $mon_lev_attp;
//     }
//}

If ($mon_level != "1"){
    $slash = strpos($mon_base_att_x,"/");
    if ($slash){
      $mon_base_att =  substr($mon_base_att_x,0,$slash);
   }else{
      $mon_base_att = $mon_base_att_x;
   }
}

//echo "</BR> " . $mon_base_att_orig . "slash " . $slash;
//
//
//
//

//
//
//
//Monster extra skill points
//
//
$mon_skill_b = $mon_skillp + $mon_int_bonus;
$mon_skill_b_orig = $mon_skillp + $mon_int_bonus_orig;

if ($mon_skill_b < 1){
   $mon_skill_b = 1;
}
if ($mon_skill_b_orig < 1){
   $mon_skill_b_orig = 1;
}
$mon_skill_points = ($mon_level  * $mon_skill_b) - ($mon_hd_original * $mon_skill_b_orig);
//echo "</BR> $mon_skill_b_orig hd $mon_hd_original";
//echo "</BR> mon skill points =" . $mon_skill_points;
While ($mon_skill_points > 0){
   $select = "SELECT MIN(skillt_rank) FROM skilltemp, monskill where skillt_user = '$user' " .
             "and mon_name = '$mon_name' and skillt_skill = monskill_tp";
//   echo "</BR>" . $select;
$link = getDBLink();
//   include 'includes/dd_db_conn.txt';
   $result = mysqli_query($link, $select);
//   echo "</BR> rows " . mysqli_num_rows($result);
   if (mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_array($result);
     $min = $row[0];
     if ($min !=""){
//     echo "$MIN " . $min; 
       $select2 = "select skillt_skill from skilltemp, monskill where skillt_rank = '$min' and skillt_user = '$user'" .
                 " and mon_name = '$mon_name' and skillt_skill = monskill_tp";
//       echo "</BR>" . $select2;
       $result2 = mysqli_query($link, $select2); 
       while (($row2 =  mysqli_fetch_array($result2)) and $mon_skill_points > 0){
         $skill = $row2[skillt_skill];
         $rank = $min + 1;
         $mon_skill_points = $mon_skill_points - 1; 
         $update  = "UPDATE skilltemp SET skillt_rank = '$rank' WHERE " .
                      "skillt_user = '$user' and skillt_skill = '$skill'";
         $result3 = mysqli_query($link, $update) ;
       }
     }else{
      $mon_skill_points = 0;
     } 
   }else{
      $mon_skill_points = 0;
   }
//   echo "</BR> mon_skill_points " . $mon_skill_points; 
}
//
//
//
//
//
//
//
//
//
//
//   Get Classes
//
$human_skill_points = 0;
if ($mon_name == "Human"){
   $human_skill_points = 1;
}
//
//
$att = strtolower($class1_att);
$class1_attack_v = "class1_lev_att" . $att ;
$class1_attack = $$class1_attack_v ;
if ($class1_tp != ""){
  $select = "SELECT class_tp, class_att, class_fort, class_ref, class_will, class_skillp, class_spat, class_hd ".
            "from class where class_tp ='$class1_tp'";
//  echo $select;
//  include 'includes/dd_db_conn.txt';

	$link = getDBLink();

  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class1_att = $row['class_att'] ;
  $class1_fort = $row['class_fort'] ;
  $class1_reflex = $row['class_ref'] ;
  $class1_will = $row['class_will'] ;
  $class1_skillp = $row['class_skillp'] ;
  $class1_spat = $row['class_spat'] ;
  if ($class1_spat != ""){
     $caster = "Y";
  }
  $class1_hd = $row['class_hd'] ;
  if ($mon_type == "Undead"){
    $class1_hd = "1D12";
  }
  $mon_skillp =    ($mon_int - 10) /2 -0.49;
  $mon_skillp = round($mon_skillp,0);
//  echo "mon skillp " . $mon_skillp;
  $class1_skill_p_l = $class1_skillp + $mon_skillp + $human_skill_points ;
//  echo "class_1_skill_p " . $class1_skill_p_l ;
  if ($class1_skill_p_l < 1 ){
     $class1_skill_p_l = 1;
  }
  $skill_bonus = 0;
// if 0 level monster add in 1st level bonus to skills
  if ($mon_hd_original == 0){
      $skill_bonus = 3;
  }
  $class1_skill_points = ($class1_level + $skill_bonus) * $class1_skill_p_l ;
//  echo "class " . $class1_skill_points; 
//
//  get class level
//
//
  $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level where lev_no = $class1_level" ; 
//
$link = getDBLink();

//  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class1_lev_savg = $row['lev_savg'] ;
  $class1_lev_savp = $row['lev_savp'] ;
  $class1_lev_attg = $row['lev_attg'] ;
  $class1_lev_atta = $row['lev_atta'] ;
  $class1_lev_attp = $row['lev_attp'] ;
  $class1_lev_sjlr = $row['lev_sklr'] ;
  $class1_lev_sklx = $row['lev_sklx'] ;
  $class1_lev_feat = $row['lev_feat'] ;
  $class1_lev_abil = $row['lev_abil'] ;
//  
//
  if ($class1_will == 'G'){
      $class1_will_sv = $class1_lev_savg;
  }else{
      $class1_will_sv = $class1_lev_savp;
  }  
  if ($class1_fort == 'G'){
      $class1_fort_sv = $class1_lev_savg;
  }else{
     $class1_fort_sv = $class1_lev_savp; 
  }  
  if ($class1_reflex == 'G'){
      $class1_reflex_sv = $class1_lev_savg;
  }else{
      $class1_reflex_sv = $class1_lev_savp; 
  }  
  $att = strtolower($class1_att);
  $class1_attack_v = "class1_lev_att" . $att ;
  $class1_attack = $$class1_attack_v ;
//  echo "</BR> class1 attack " .  $class1_attack ; 
  
}
//
//
//
//
//
//
//
//
//
if ($class2_tp != ""){
  $select = "SELECT class_tp, class_att, class_fort, class_ref, class_will, class_skillp, class_spat, class_hd ".
            "from class where class_tp ='$class2_tp'";
//  echo $select;
//  include 'includes/dd_db_conn.txt';

	$link = getDBLink();

  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class2_att = $row['class_att'] ;
  $class2_fort = $row['class_fort'] ;
  $class2_reflex = $row['class_ref'] ;
  $class2_will = $row['class_will'] ;
  $class2_skillp = $row['class_skillp'] ;
  $class2_spat = $row['class_spat'] ;
  $class2_hd = $row['class_hd'] ;
  if ($mon_type == "Undead"){
    $class2_hd = "1D12";
  }
  if ($class2_spat != ""){
     $caster = "Y";
  }
  $class2_skill_p_l = $class2_skillp + $mon_skillp + $human_skill_points ;
  if ($class2_skill_p_l < 1 ){
     $class2_skill_p_l = 1;
  }
  $class2_skill_points = $class2_level * $class2_skill_p_l;
//
//  get class level
//
//
  $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level where lev_no = $class2_level" ; 
//
//  include 'includes/dd_db_conn.txt';

	$link = getDBLink();


  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class2_lev_savg = $row['lev_savg'] ;
  $class2_lev_savp = $row['lev_savp'] ;
  $class2_lev_attg = $row['lev_attg'] ;
  $class2_lev_attp = $row['lev_attp'] ;
  $class2_lev_atta = $row['lev_atta'] ;
  $class2_lev_sjlr = $row['lev_sklr'] ;
  $class2_lev_sklx = $row['lev_sklx'] ;
  $class2_lev_feat = $row['lev_feat'] ;
  $class2_lev_abil = $row['lev_abil'] ;
//
//
//
  if ($class2_will == 'G'){
      $class2_will_sv = $class2_lev_savg;
  }else{
      $class2_will_sv = $class2_lev_savp; 
  }  
  if ($class2_fort == 'G'){
      $class2_fort_sv = $class2_lev_savg;
  }else{
     $class2_fort_sv = $class2_lev_savp; 
  }  
  if ($class2_reflex == 'G'){
      $class2_reflex_sv = $class2_lev_savg;
  }else{
      $class2_reflex_sv = $class2_lev_savp; 
  }  
  $att = strtolower($class2_att);
  $class2_attack_v = "class2_lev_att" . $att ;
  $class2_attack = $$class2_attack_v ;

}
//
//
$speed = 0;
$class_feats = 0;
if ($class1_tp  !="" or $class2_tp != ""){
//   include 'includes/dd_db_conn.txt';

	$link = getDBLink();

   $select  = "select specattr_no from specattr, classsp where " .
                "((classsp_class = '$class1_tp'and classsp_level <= '$class1_level') or " .
                 "(classsp_class = '$class2_tp'and classsp_level <= '$class2_level')) " .
                     "and specattr_type = 'FEAT' and ".
                    "specattr_spec = classsp_spec";
//   echo "</BR> $select";

  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)){
     $feat = $row[specattr_no];

     if ($feat != ""){ 
        $insert = "insert into feattemp (feattemp_user, feattemp_feat, feattemp_class, feattemp_auto) " .
                     "values('$user', '$feat', '3','Y')"; 
// echo "</BR> $insert";  
        
         $result2 = mysqli_query($link, $insert) ;
         if ($result2){ 
            $class_feats = $class_feats + 1;
         }
     }
  }
  $select  = "select specattr_no from specattr, classsp where " .
                "((classsp_class = '$class1_tp'and classsp_level <= '$class1_level') or " .
                 "(classsp_class = '$class2_tp'and classsp_level <= '$class2_level')) " .
                     "and specattr_type = 'FAST' and ".
                    "specattr_spec = classsp_spec";
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)){     
      $speed = $speed +  $row[specattr_no];
  } 
  $select  = "select specattr_no from specattr, classsp where " .
                "((classsp_class = '$class1_tp'and classsp_level <= '$class1_level') or " .
                 "(classsp_class = '$class2_tp'and classsp_level <= '$class2_level')) " .
                     "and specattr_type = 'FLURRY' and ".
                    "specattr_spec = classsp_spec";
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)){     
      $flurry_no = $flurry_no +  $row[specattr_no];
  }
  $select  = "select classsp_no from specattr, classsp where " .
                "((classsp_class = '$class1_tp'and classsp_level <= '$class1_level') or " .
                 "(classsp_class = '$class2_tp'and classsp_level <= '$class2_level')) " .
                     "and specattr_type = 'FLURRYATT' and ".
                    "specattr_spec = classsp_spec";
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)){
      $flurry_att = $flurry_att +  $row[classsp_no];
  }
}

$count2 = 0;
while ($count2 < 3){
  $count2 = $count2 + 1;
  $count = 0;
  while ($count < 24){
    $count = $count + 1;
    $featv = "feat_" .$count2 . $count;
    $feat = $$featv;
    $autov  = "feat_auto_" .$count2 . $count;
    $auto   = $$autov;
//  echo "</BR>" . $featv . $auto ;
    if ($feat != ""){
       $insert = "insert into feattemp (feattemp_user, feattemp_feat, feattemp_class,feattemp_auto) " .
                 "values('$user', '$feat', '$count2','$auto')";
//       echo "</BR> $insert";
       $result = mysqli_query($link, $insert) ;
    }
  }
}





//
//
//
//
//
//
//
//
//
//  echo "class " . $class2_skill_points; 
//
//
//
// Calculate HPs and HD
//
//
//
//
//
//
//

$d = strpos($class1_hd,"D");
if ($d == FALSE){
  $class1_die = "D" . $class1_hd;
  $class1_no_die = "1"; 
}else{
  $len = strlen($class1_hd);
  $class1_no_die = substr($class1_hd,0,1);
  $class1_die = substr($class1_hd,$d,$len);
}
$d = strpos($class2_hd,"D");
if ($d == FALSE){
  $class2_die = "D" . $class2_hd;
  $class2_no_die = 1; 
}else{
  $len = strlen($class2_hd);
  $class2_no_die = substr($class2_hd,0,1);
  $class2_die = substr($class2_hd,$d,$len); 
}
$total1 = $class1_level * $class1_no_die;
$total2 = $class2_level * $class2_no_die;
$total_hd = $mon_level . $mon_die;
if ($total1 > 0){
  $total_hd = $total_hd . "+" . $total1 . $class1_die;
}
//
if ($total2 > 0){
  $total_hd = $total_hd . "+" . $total2 . $class2_die;
}
//
$total_level = $mon_level + $class1_level + $class2_level;
$total_con_bonus = $total_level * $mon_con_bonus;
if ($total_con_bonus != 0){
 $total_hd = $total_hd . "+" . $total_con_bonus;
} 
$total_hd = strtolower($total_hd);

//
// Calculate average HPs
//
$mon_hp_lev =  (1 + substr($mon_die,1,2)) / 2;
$mon_hps    = $mon_level * $mon_hp_lev;
$class1_hp_lev = (1 + substr($class1_die,1,2)) / 2;
$class1_hps =  $class1_level * $class1_hp_lev;
$class2_hp_lev = (1 + substr($class2_die,1,2)) / 2;
$class2_hps =  $class2_level * $class2_hp_lev;
$total_hps   = round(($mon_hps + $class1_hps + $class2_hps + $total_con_bonus -0.5) ,0);
//
//
//Saving Throws
//
$total_fort_sv = $mon_fort_sv + $class1_fort_sv + $class2_fort_sv + $mon_con_bonus;
$total_will_sv = $mon_will_sv + $class1_will_sv + $class2_will_sv + $mon_wis_bonus;
$total_reflex_sv = $mon_reflex_sv + $class1_reflex_sv + $class2_reflex_sv + $mon_dex_bonus;
//echo "</BR> $mon " . $mon_reflex_sv . "class1" . $class1_reflex_sv . "dex " . $mon_dex_bonus . "***";
//echo "total " . $total_reflex_sv;
//
//
//SKILLS
//
// Get monster skills
//
//
//


If ($new == "YES"){
//      add in Primary skills %80 of skills
 $skill1_prim = round(($class1_skill_points * 0.8) ,0);
 $skill1_sec  = $class1_skill_points - $skill1_prim;
 $skill2_prim = round(($class2_skill_points *0.8),0);
 $skill2_sec  = $class2_skill_points - $skill2_prim;
// echo "</BR> skill1_sec " .$skill1_sec . "</BR>";

//
//
//
// add 1st primary even out and try to max
//
 $max_skill = $total_level + 3;
 $max_xskill = $max_skill /2;

 $skill_cnt = 0;
 While ($skill_cnt < 4){
   $skill_cnt = $skill_cnt + 1;
   if ($skill_cnt == 1){
      $sel = "P";
      $class_tp = $class1_tp;
      $class_focus = $class1_focus;
      $skill_prim = $skill1_prim;
   } 
   if ($skill_cnt == 2){
      $sel = "S";
      $class_tp = $class1_tp;
      $class_focus = $class1_focus;
      $skill_prim = $skill_prim + $skill1_sec;
   }  
   if ($skill_cnt == 3){
      $skill1_left = $skill_prim;
      $sel = "P";
      $class_tp = $class2_tp;
      $class_focus = $class2_focus;
      $skill_prim = $skill2_prim; 
   } 
   if ($skill_cnt == 4){
      $sel = "S";
      $class_tp = $class2_tp;
      $class_focus = $class2_focus;
      $skill_prim = $skill_prim + $skill2_sec;
   }   
//   echo "</BR> Skill_cnt " . $skill_cnt ."</BR>";  
   $pr = 0;                   
   While ($pr < 4 and $skill_prim > 1){
      $pr = $pr + 1;
      $prim = $sel . $pr ;
    $found = "Y";
    $update_flag = "Y";
    $update_count = 0 ;
    $first_time = "Y";
    $no_xskill = "";
    $exit = "N";
    while ($found == "Y" and $skill_prim > 0 and $exit != "Y"){
      if ($first_time == "Y"){
          $first_time = "N";
      }else{
          if ($update_count == 0){
             $no_xskill = "Y";
          }else{
             $update_count = 0;
          }
      }
      $update_flag = "";
      if ($no_xskill == "Y"){
         $select1 = "SELECT MIN(skillt_rank) FROM skilltemp, classfocus ". 
               " WHERE classf_class = '$class_tp' and classf_focus = '$class_focus' " .
               " and classf_tp = '$prim'" .
               " and classf_skill = skillt_skill" .  
               " and skillt_rank < $max_skill and skillt_user = '$user'" .
               " and skillt_rank < classf_max" .
               " and skillt_xskill = ''";
      }else{
          $select1 = "SELECT MIN(skillt_rank) FROM skilltemp, classfocus ".
                 " WHERE classf_class = '$class_tp' and classf_focus = '$class_focus' " .
                 " and classf_tp = '$prim'" .
                 " and classf_skill = skillt_skill" .  
                 " and skillt_rank < $max_skill and skillt_user = '$user'" .
                 " and skillt_rank < classf_max";
      } 
//      echo "</BR>" . $select1 . "</BR>";
      $result1 = mysqli_query($link, $select1) ;
      if (mysqli_num_rows($result1) > 0){
        $row1 = mysqli_fetch_array($result1);

        $min = $row1[0] ;
//    echo "</BR> min = " . $min;    
        if ($min != ""){
//    echo "row 1 = " .$row1 ." result = " . mysqli_num_rows($result1) . "min=" .$min . "update ". $update_flag;
          $select2 = "SELECT skillt_skill, skillt_rank, skillt_xskill, classf_xskill  FROM skilltemp, classfocus ". 
                 " WHERE classf_class = '$class_tp' and classf_focus = '$class_focus' ".
                 " and classf_tp = '$prim' " . 
                 " and classf_skill = skillt_skill" .  
                 " and skillt_rank = $min" .
                 " and skillt_rank < classf_max" .
                 " and skillt_rank < $max_skill and skillt_user = '$user'"; 
//        echo  "</BR>" . $select2 . "</BR>";
$link = getDBLink();
//          include 'includes/dd_db_conn.txt';
            
          $result2 = mysqli_query($link, $select2) ;
          if (mysqli_num_rows($result2) > 0){
            while (($row2 = mysqli_fetch_array($result2)) and $skill_prim > 0) {
                $skill = $row2['skillt_skill'] ;
                $rank  = $row2['skillt_rank'] ;
                $skillt_xskill = $row2['skillt_xskill'] ;
                $classf_xskill = $row2['classf_xskill'] ;
                $update_skill = "Y"; 
                if ($classf_xskill == "Y"){
                 if ($skillt_xskill == "Y") {
                    if ($rank < $max_xskill){
//    echo "</BR> skill " . $skill . $rank . " max ". $max_xskill ."</BR>";
                        $rank = $rank + 0.5;
                        $skill_prim = $skill_prim - 1;
                    }else{
                         $update_skill = "N";
                    }
                  }else{
                        $rank = $rank + 0.5;
                        $skill_prim = $skill_prim - 1;
                  }
                }else{
                  $rank = $rank + 1;
                  $skill_prim = $skill_prim - 1;
                }
                if ($update_skill == "Y"){
                   $update  = "UPDATE skilltemp SET skillt_rank = '$rank' WHERE " .
                                "skillt_user = '$user' and skillt_skill = '$skill'";
                   $result3 = mysqli_query($link, $update) ;
                   $update_flag = "Y";
                   $update_count = $update_count + 1;
//    echo $skill . "  " . $rank . " points left " . $skill_prim;
                }
            }
          }else{

               $found = "N";

          }
        }else{

               $found = "N";


        }
    }else{

               $found = "N";

    
         }
    }
  }
//   echo "skill points left " . $skill_prim;
 }
   $skill2_left = $skill_prim;
}
//
//get AC
//
//
$select = "select size_ac_mod, size_grapple, size_hide, size_sq, size_reach_t, size_reach_l, size_golemhp from size ".
          "where size_cat = '$mon_size'";
$result = mysqli_query($link, $select);
if (mysqli_num_rows($result) > 0){
   $row = mysqli_fetch_array($result);
    $size_ac_mod    = $row[size_ac_mod];
    $size_grapple   = $row[size_grapple];
    $size_hide      = $row[size_hide];
    $size_sq        = $row[size_sq];
    $size_reach_t   = $row[size_reach_t];
    $size_reach_l   = $row[size_reach_l];
    $size_golemhp   = $row[size_golemhp];
    if ($mon_size != $mon_size_original){
      $mon_space = $size_sq;
      $mon_reach = $size_reach_l;
    }
    if ($mon_type == "Construct"){
       $total_hd = $total_hd . "+" . $size_golemhp;
       $total_hps = $total_hps + $size_golemhp;
    }
}
$select = "select armour_cd, armour_tp, armour_bonus, armour_dex, armour_check, armour_spell, armour_s30,".
          "armour_s20,armour_wt from armour where armour_tp = '$mon_armour' or armour_tp = '$mon_shield'" .
          "order by armour_cd";
//echo "</BR> " . $select;
$result = mysqli_query($link, $select);
$count = 0;
if (mysqli_num_rows($result) > 0){
   while($row = mysqli_fetch_array($result)){
     $count = $count + 1;  
     if ($count == 1){
       $armour_bonus = $row[armour_bonus];
       $armour_dex =   $row[armour_dex];
       $armour_check = $row[armour_check];
       $armour_spell = $row[armour_spell];
       $armour_s30   = $row[armour_s30];
       $armour_s20   = $row[armour_s20];
       $armour_wt    = $row[armour_wt];
       $armour_cd    = $row[armour_cd];
     }else{
       $shield_bonus = $row[armour_bonus];
       $shield_dex =   $row[armour_dex];
       $shield_check = $row[armour_check];
       $shield_spell = $row[armour_spell];
       $shield_s30   = $row[armour_s30];
       $shield_s20   = $row[armour_s20];
       $shield_wt    = $row[armour_wt];
         }
   }
}
if ($armour_dex > $shield_dex){
   $max_dex = $shield_dex;
}else{
   $max_dex = $armour_dex;
}
if ($max_dex < $mon_dex_bonus){
   $dex_bonus = $max_dex;
}else{
   $dex_bonus = $mon_dex_bonus;
}
$monk_bonus = 0;
if ($class1_tp == "Monk" or $class2_tp == "Monk"){
//   echo "</BR> MONK";
   if ($armour_bonus == 0 and $shield_bonus == 0 and $mon_wis_bonus > 0){
      $monk_bonus = $mon_wis_bonus;
      if ($class1_tp == "Monk"){
         $bonus = round(($class1_level / 5)  - 0.49);
         $monk_bonus = $monk_bonus + $bonus;
      }else{
         $bonus = round(($class2_level / 5)  - 0.49);
         $monk_bonus = $monk_bonus + $bonus;
      }
    }
}   
//
//
//
//
//
//
//
//
//
//get attacks
//
//

$level_c = 0;
while ($level_c  < 2){
  $level_c = $level_c + 1;
  if ($level_c == 1){
     $string = $class1_attack;
  }else{
     $string = $class2_attack;
  }
  $count = 0;
  while ($count < 5){
    $count = $count + 1;
    $att_v = "class" . $level_c ."att" . $count;
    $attnum_v = "attnum" . $count;
    $pos = strpos($string, "/");
    if ($pos == 0){
      $$att_v = $string;
      $string = "";
    }else{
      $$att_v = substr($string,0,($pos));
      $len = strlen($string);
      $string = substr($string,($pos +1),$len);
         }
    $$attnum_v = $$attnum_v + $$att_v;
//    echo $att_v . " = ".  $$att_v . "***" ;
  }
}
//echo "</BR> attnum1= " . $attnum1;
$select = "select count(*) from feattemp where ".
          " feattemp_user = '$user' and feattemp_feat = 'Weapon Finesse'";
$result = mysqli_query($link, $select) ;
$weapon_finess = 0;
if ($result){
   $row = mysqli_fetch_array($result);
   $weapon_finess = $row[0];
}

$select = "select weap_dam, weap_dam2, weap_type, weap_cat from " .
             "weapons where weap_id = '$mon_weap_p'";
$result = mysqli_query($link, $select) ;
if ($result){
   $row = mysqli_fetch_array($result);
   $weap_type_p = $row[weap_type];
   $weap_cat_p = $row[weap_cat];
//   echo "found";
}



// echo $select;
// echo "weap_type_p  =" . $weap_type_p . " weap_cat_p = " . $weap_cat_p;
If (($mon_weap_p == "Rapier" or $mon_weap_p == "Whip" or $mon_weap_p == "Chain, spiked" or $weap_type_p == "LT" or $weap_cat_p == "0-Natural")
   and $weapon_finess >  0){
   $bonus = $mon_dex_bonus;
}else{
   $bonus = $mon_str_bonus;
}
//echo "finess" . $weapon_finess;
//
// find any feats which effect combat bonus'
//
$select = "select featattr_no, featattr_type, feattemp_auto ,featattr_feat,featattr_rfeat from featattr, feattemp " .
               "where  feattemp_user = '$user' and ".
                " feattemp_feat = featattr_feat order by featattr_feat desc";
//
//                "(featattr_type  = 'ATTH' OR featattr_type  = 'ATTHD' OR ".
//                 "featattr_type  = 'ATTR' OR featattr_type  = 'ATTRD' OR " .
//                 "featattr_type  = 'EXATTR' OR featattr_type  = 'EXATTR1' OR ".
//                 "featattr_type  = 'EXATTA' OR featattr_type  = 'EXATTA1' OR " .
//                "featattr_type  = 'MULTI' )";
//echo "</BR> " . $select;
$result = mysqli_query($link, $select) ;
//
//
$feat_atth = 0;
$feat_atthd = 0;
$feat_attr = 0;
$feat_attrd = 0;
$feat_exatta = 0;
$exatta = "";
$feat_exattr = 0;
$feat_init = 0;
$exatta1 = 0;
$exattr1 = 0;
$range_mod = 0;
if (mysqli_num_rows($result) > 0){
   while ($row = mysqli_fetch_array($result)){
      $feat          = $row[featattr_feat];
      $featattr_no   = $row[featattr_no];
      $featattr_type = $row[featattr_type];
      $feattemp_auto = $row[feattemp_auto];
//      echo "</BR>" . $featattr_type . $featattr_no;
      if ($featattr_type == "ATTH"){ 
         $feat_atth = $feat_atth + $featattr_no;
      }
      if ($featattr_type == "ATTHD"){ 
         $feat_atthd = $feat_atthd + $featattr_no;
      }
      if ($featattr_type == "ATTR"){
         $feat_attr = $feat_attr + $featattr_no;
      }
      if ($featattr_type == "ATTRD"){ 
         $feat_attrd = $feat_attrd + $featattr_no;
      }
      if ($featattr_type == "EXATTA"){
         $feat_exatta = $featattr_no;
         $exatta = "Y";
      }
      if ($featattr_type == "EXATTR"){ 
         $feat_exattr = $featattr_no;
      }
      if ($featattr_type == "EXATTA1"){
         $exatta1 = $exatta1 + 1; 
         $feat_exatta1_v = "feat_exatta1" . $exatta1;
         $$feat_exatta1_v = $featattr_no;
      }
      if ($featattr_type == "EXATTR1"){
         $exattr1 = $exattr1 + 1; 
         $feat_exattr1_v = "feat_exatta1" . $exattr1;
         $$feat_exattr1_v = $featattr_no;
      }
      if ($featattr_type == "MULTI"){
         $feat_multi = $featattr_no;
      }
      if ($featattr_type == "SVWILL"){
         $total_will_sv = $total_will_sv + $featattr_no;
      }
      if ($featattr_type == "SVFORT"){
         $total_fort_sv = $total_fort_sv + $featattr_no;
      }
      if ($featattr_type == "SVREFLEX"){
         $total_reflex_sv = $total_reflex_sv + $featattr_no;
      }
      if ($featattr_type == "NATARMOUR"){
         $mon_nat_armour_ft = $mon_nat_armour_ft + $featattr_no;
      }
      if ($featattr_type == "NATATTACK"){
         $select2 = "select size_cat from size where size_grapple >  '$size_grapple' order by size_grapple";
         $result2 = mysqli_query($link, $select2) ;
         $count2 = 0;
         $feat_size = "";
         while ($row2 = mysqli_fetch_array($result2) and $count2 <1){
           $count2 =  $count2 + 1;
           $feat_size = $row2[size_cat];
         }
      }
      if ($featattr_type == "HP"){
         $total_hps  = $total_hps +  $featattr_no;
      } 
      if ($featattr_type == "INIT"){
         $feat_init  = $feat_init +  $featattr_no;
      } 
      if ($featattr_type == "GRAPPLE"){
         $feat_grapple  = $feat_grapple +  $featattr_no;
      }
      if ($featattr_type == "SHIELD"){
         $shield_bonus  = $shield_bonus +  $featattr_no;
      }
      if ($featattr_type == "FARSHOT"){
         $range_mod = $range_mod +  $featattr_no;
      }
      if ($featattr_type =="ARMOURP"){
          $feat_armour_v = "armour_" . $featattr_no;
          $$feat_armour_v = "Y";
//          echo "ARMOURP $
      }
      if ($featattr_type =="WEAPONP"){
          $feat_weapon_v = "weapon_" . $featattr_no;
          $$feat_weapon_v = "Y";
          global $$feat_weapon_v;
      }
      if ($featattr_type == "RR"){
          $feat_rr = "Y";
      }
      if ($feattemp_auto != "Y"){
          if ($featattr_type == "RINT"){
             if ($mon_int < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Int of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RDEX"){
             if ($mon_dex < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Dex of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RWIS"){
             if ($mon_wis < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Wis of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RCON"){
             if ($mon_con < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Con of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RCHR"){
             if ($mon_chr < $featattr_no){
                 $errortxt = $errortxt . "<p>Feat $feat requires a Chr of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RSTR"){
             if ($mon_str < $featattr_no){
                $errortxt = $errortxt . "<p>Feat $feat requires a Str of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RMONSTER"){
             if ($mon_type == "Humanoid"){
                $errortxt = $errortxt . "<p>Feat $feat is not applicable to humanoids</p>";
             }
          }
          if ($featattr_type == "RFLY"){
             if ($mon_speed_fly == 0){
                $errortxt = $errortxt . "<p>Feat $feat requires a fly speed</p>";
             }
          }
          if ($featattr_type == "RLEVEL"){
             if ($class1_level  < $featattr_no and $class2_level  < $featattr_no) {
                $errortxt = $errortxt . "<p>Feat $feat requires a Level of $featattr_no</p>";
             }
          }
          if ($featattr_type == "RCLASS"){
             if ($class1_tp  != $featattr_no and $class2_tp  != $featattr_no){
                 if ($featattr_no == "Caster" and $caster =="Y"){
                 }else{                
                    $errortxt = $errortxt . "<p>Feat $feat requires a Class of $featattr_no</p>";
                }
             }
          }
          if ($featattr_type == "RATT"){
             $base_att = $attnum1 + $mon_base_att;
             if (base_att  < $featattr_no) {
                $errortxt = $errortxt . "<p>Feat $feat requires a Base Attack of $featattr_no</p>";
             }
          }

          if ($featattr_type == "RFEAT"){
             $rfeat = $row[featattr_rfeat];
             $select2 = "select count(*) from feattemp where feattemp_user = '$user' and feattemp_feat = '$rfeat'";
             $result2 = mysqli_query($link, $select2) ;
             $row2 = mysqli_fetch_array($result2);
             $feat_count = $row2[0];
             if ($feat_count  < 1){
                $errortxt = $errortxt . "<p>Feat  $feat requires the feat $rfeat</p>";
             }
          }





      } 


   }
}
If ($range_mod == 0){
  $range_mod = 1;
}
$mon_ac = $mon_ac_flat + $size_ac_mod + $dex_bonus + $armour_bonus + $shield_bonus + $monk_bonus + $mon_nat_armour_ft +
           $magic_armour + $magic_shield;
$ac_flat = $mon_ac_flat + $size_ac_mod + $armour_bonus + $shield_bonus + $monk_bonus + $mon_nat_armour_ft + $magic_armour;
$ac_touch = 10 + $size_ac_mod + $monk_bonus + $dex_bonus;
//



echo "</BR>";
//echo $errortxt;
// echo "</BR> feat_attrd " . $feat_attrd;

$base_att = $attnum1 + $mon_base_att;
$att_left = $base_att - $str_bonus;
$count = 1;
while ($att_left > 5){
   $count = $count + 1;
   $att_left = $att_left - 5;
   if ($att_left > 0){
      $attnum_v = "attnum" . $count;
      $$attnum_v = $att_left;
//      echo "</BR>  $attnum_v  $att_left" ;
      $no_attacks = $count;
   }
}




$base_attack = $attnum1 + $mon_base_att;
$base_grapple = $base_attack + $size_grapple + $feat_grapple + $mon_str_bonus;
$ranged_attack = $attnum1 + $mon_base_att + $mon_dex_bonus + $feat_attr + $feat_exattr + $magic_tohit_r + $size_ac_mod;
$ranged_attack_st = $ranged_attack;
$single_ranged = $ranged_attack - $feat_exattr;
$full_attack = $attnum1 + $mon_base_att + $bonus + $feat_atth + $feat_exatta + $magic_tohit_p + $size_ac_mod;
$full_attack_st = $full_attack;
$single_attack = $full_attack - $feat_exatta;
$flurry = $full_attack + $flurry_att - $feat_atth;
$count = 1;
while ($count < $no_attacks){
  $count = $count + 1;
  $attnum_v = "attnum" . $count;
  $attnum_r_v = "attnum_r" . $count;
  if ($$attnum_v > 0){
     $$attnum_r_v = $$attnum_v +  $mon_dex_bonus + $feat_attr + $magic_tohit_r + $feat_exattr + $size_ac_mod;
     $$attnum_v = $$attnum_v +  $bonus + $feat_atth + $magic_tohit_p + $feat_exatta + $size_ac_mod;
     $full_attack = $full_attack . "/". $$attnum_v ;
     $ranged_attack = $ranged_attack . "/" . $$attnum_r_v;
     $flurry_x  = $$attnum_v +  $flurry_att - $feat_atth;
     $flurry = $flurry . "/" . $flurry_x;
  }
}
if ($flurry_no > 0){
//  echo "</BR> flurry $flurry_att";
  $count = 0;
  while ($count < $flurry_no){
     $count = $count + 1;
     $flurry_x  = $single_attack + $flurry_att - $feat_atth;
     $flurry    = $flurry_x . "/"  . $flurry;
  }
}



if ($feat_exattr != 0){
    $ranged_attack = $ranged_attack_st . "/" . $ranged_attack;
}
//
// Get Damage
//
//
$count = 0;
while ($count < 8){
  $count = $count + 1;
  if ($count == 1){
   $weap_v = "mon_weap_p";
   $damage_v    = "damage_p";
   $weap_dam_v = "weap_dam_p";
   $weap_dambase_no_v = "monweap_dambase_no_p";
   $bonus = $mon_str_bonus + $feat_atthd + $magic_damage_p;
   $weap_range_v = "weap_range_p";
   $weap_reload_v = "weap_reload_p";
   $weap_bow_v  = "weap_bow_p";
  }
  if ($count == 2){
     $weap_v = "mon_weap_r";
     $damage_v    = "damage_r";
     $weap_dam_v = "weap_dam_r";
     $weap_range_v = "weap_range_r";
     $weap_reload_v = "weap_reload_r";
     $weap_bow_v  = "weap_bow_r";
     $bonus = $feat_attrd + $magic_damage_r;
  }
  if ($count > 2){
     $sub = $count - 2;
     $weap_v = "mon_weap_s" . $sub;
     $damage_v    = "damage_s". $sub;
     $weap_dam_v = "weap_dam_s" . $sub;
     $weap_dambase_no_v = "monweap_dambase_no_s" .$sub;
     $weap_range_v = "weap_range_s" . $sub;
     $weap_reload_v = "weap_reload_s" .$sub;
     $weap_bow_v  = "weap_bow_s" . $sub;
     $bonus = round(($mon_str_bonus /2 - 0.49),0);
// if same weapon as primary then add in weapon specialization feats
     if ($$weap_v == $mon_weap_p){
       $bonus = $bonus + $feat_atthd;
     }
  }
  $weapon = $$weap_v;
//  echo "</BR> weapon s1 = " .  $mon_weap_s1;
  if ($weapon != ""){
     $mon_size_w = $mon_size;
     if  ($count == 1 or $weapon == $mon_weap_p){
        if ($weap_cat_p == "0-Natural" and $feat_size != ""){
           $mon_size_w = $feat_size;
        }
     }
     $select = "select damage, weap_range_str, weap_cat, dambase_no, dambase_incr, weap_range, weap_reload, weap_bow from weapons, damage,dddambase where  " .
                "weap_id = '$weapon' and dam_base = weap_dam and " .
                "dam_size = '$mon_size_w' and dambase = damage";
// echo "</BR>" . $select ."</BR>";
     $result = mysqli_query($link, $select);
     if ($result){
       $row = mysqli_fetch_array($result);
       $$damage_v = $row[damage];
       $weap_range_str = $row[weap_range_str];
       $weap_cat = $row[weap_cat];
       $dambase_no = $row[dambase_no];
       $dambase_incr = $row[dambase_incr];
       $$weap_range_v = $row[weap_range] * $range_mod;
       $$weap_reload_v = $row[weap_reload];
       $$weap_bow_v    = $row[weap_bow];
       $weap_dambase_no = $$weap_dambase_no_v;
       if ($weap_cat == "0-Natural" and $$weap_dam_v != ""){
// echo "</BR> $dambase_no RRR $weap_dambase_no size $mon_size_original";
// dont change natural damage if size has not changed and feat not increased damage.
          if ($mon_size == $mon_size_original and ($feat_size =="" or ($count != 1 and $weapon != $mon_weap_p))){
             $$damage_v = $$weap_dam_v;
          }
       }
       if ($count == 1 and $shield_bonus ==0 and $mon_weap_s1 == "No Melee" and $mon_str_bonus > 0 ){
//            and $weap_cat != "0-Natural"){
          $bonus = round(($mon_str_bonus * 1.5) -0.49,0) + $feat_atthd + $magic_damage_p;
//          echo round(($mon_str_bonus * 1.5) -0.49,0);
//          echo "</BR> Bonus  " . $bonus . $feat_atthd;
       }
       if ($count == 1 and $weap_cat == "0-Natural" ){
           $full_attack = $single_attack;
       }



       if ($count == 2 and $weap_range_str == "Y"){
          $bonus = $mon_str_bonus + $feat_attrd + $magic_damage_r;
       }
       if ($count == 2){
          if ($weap_reload_r != "Y"){
              if ($weap_reload_r != "RR" or $feat_rr != "Y"){
                 $ranged_attack = $single_ranged;
                 if ($feat_exattr != 0){
                     $ranged_attack = $ranged_attack_st . "/" . $ranged_attack_st;
                 }
              }
          }
       }


       if ($bonus != 0){
          $$damage_v = $$damage_v . "+" . $bonus;
       }
       if ($count == 3){
          $attack_v = "attack_s" . ($count -2);
          if ($weap_cat != "0-Natural"){
             if ($exatta != "Y"){
                $$attack_v = $single_attack - 6 - $magic_tohit_p;
             }else{
                $$attack_v = $single_attack + $feat_exatta - $magic_tohit_p;
             }
             if ($mon_weap_s1 != $mon_weap_p){
                   $$attack_v = $$attack_v - $feat_atth;
             }
             $exatta1_count = 0;
             while ($exatta1_count <  $exatta1){
                $exatta1_count = $exatta1_count + 1;
                $feat_exatta1_v = "feat_exatta1" . $exatta1_count;
                $attack2        = $$feat_exatta1_v + $single_attack - $magic_tohit_p + $feat_exatta;
                if ($mon_weap_s1 != $mon_weap_p){
                   $attack2 = $attack2 - $feat_atth;
                }
                $$attack_v = $$attack_v . "/" . $attack2;
             }
//   if secondary atack is the same as primary and they are natural then attack is same as primary
         }
          if ($weap_cat == "0-Natural" and $weapon == $mon_weap_p){
             $$attack_v = $single_attack;
             $damage_s1 = $damage_p;
          }
       }
//
       if ($count > 3 or (($count == 3 and $weap_cat == "0-Natural" and $weapon != $mon_weap_p))){
//             or ($weapon == $mon_weap_p and $count == 3 and $weap_cat != "0-Natural"))){
          $attack_v = "attack_s" . ($count -2);
          if ($feat_multi != ""){
             $$attack_v = $single_attack + $feat_multi;
          }else{
             $$attack_v = $single_attack - 5;
          }
          if ($weapon != $mon_weap_p){
            $$attack_v -=  $feat_atth;
          }
          if ($weap_cat == "0-Natural" and $weapon == $mon_weap_p){
             $$attack_v = $single_attack;
             $$damage_v = $damage_p;
          }
       }

     }else{
       $$damage_v = 0;
          }
  }
}
//INIT
if ($mon_dex != 0){
   $init = $mon_dex_bonus + $feat_init;
}else{
   $init = $mon_int_bonus + $feat_init;
}

if ($mon_speed == 30){
  $mon_speed = $armour_s30;
}else{
   if ($mon_speed == 20){
     $mon_speed = $armour_s20;
   }else{
       if ($armour_s30 != 30){
         $mon_speed = $mon_speed - 10;
       }
   }
}

if ($armour_cd < 3){
  $speed_land = $mon_speed + $speed;
}else{
  $speed_land = $mon_speed;
}
// echo "</BR> $mon_speed xx $armour_cd xx $armour_s30";




// include 'includes/dd_db_conn.txt' ;

	$link = getDBLink();


$select = "select classl_feat, classl_tp," . 
           " classl_sp0, classl_sp1,classl_sp2,classl_sp3,classl_sp4,classl_sp5,classl_sp6,classl_sp7,classl_sp8, " .
           " classl_sp9, classl_damage from classlev where " .
          "(classl_tp = '$class1_tp' and classl_lev = '$class1_level') OR ".
          "(classl_tp = '$class2_tp' and classl_lev = '$class2_level')";   
// echo $select;
$result = mysqli_query($link, $select) ;
if ($result){
  while ($row = mysqli_fetch_array($result)) {
    $classl_tp     = $row[classl_tp];
    $classl_feat   = $row[classl_feat];
    
//    echo "</BR>" . $class1_tp . " " . $classl_tp;
    if ($class1_tp == $classl_tp){
//       echo "</BR>" . $class1_tp . " " . $classl_tp;
       $class1_feat = $classl_feat;
       $class1_damage = $row[classl_damage];
       $class1_spell0 = $row[classl_sp0];
       $class1_spell1 = $row[classl_sp1];
       $class1_spell2 = $row[classl_sp2];
       $class1_spell3 = $row[classl_sp3];
       $class1_spell4 = $row[classl_sp4];
       $class1_spell5 = $row[classl_sp5];
       $class1_spell6 = $row[classl_sp6];
       $class1_spell7 = $row[classl_sp7];
       $class1_spell8 = $row[classl_sp8];
       $class1_spell9 = $row[classl_sp9];  
    }else{
       $class2_feat = $classl_feat;
       $class2_damage = $row[classl_damage];
       $class2_spell0 = $row[classl_sp0];
       $class2_spell1 = $row[classl_sp1];
       $class2_spell2 = $row[classl_sp2];
       $class2_spell3 = $row[classl_sp3];
       $class2_spell4 = $row[classl_sp4];
       $class2_spell5 = $row[classl_sp5];
       $class2_spell6 = $row[classl_sp6];
       $class2_spell7 = $row[classl_sp7];
       $class2_spell8 = $row[classl_sp8];
       $class2_spell9 = $row[classl_sp9]; 
         }
  }
}


if ($class1_tp == "Monk"){
   $flurry_damage = $class1_damage;
}else{
   $flurry_damage = $class2_damage;
}
$flurry_damage = strtolower($flurry_damage);
if ($flurry_damage != ""){
   $select = "select damage from damage where dam_base = '$flurry_damage' and dam_size = '$mon_size'";
   $result = mysqli_query($link, $select) ;
   if (mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_array($result);
     $f_dam = $row[damage];
     if ($f_dam != ""){
         $flurry_damage = $f_dam . "+" . $mon_str_bonus ;
     }
   }
   if ($mon_weap_p == "Unarmed strike"){
     $damage_p = $flurry_damage;
   }
}
$select = "select count(*) from crass where ((crass_class1 = '$class1_tp' and crass_class2 = '$class2_tp') or " .
          "(crass_class1 = '$class2_tp' and crass_class2 = '$class1_tp'))";
$result = mysqli_query($link, $select) ;
$crass = 0;
if (mysqli_num_rows($result) > 0){
  $row = mysqli_fetch_array($result);
  $crass = $row[0];
}
//echo "crass = " . $crass;
if ($montype_cr == 0){
  $montype_crx = 1;
}else{
  $montype_crx = $montype_cr;
}

if ($crass == 0) {
   if ($class1_level >= $class2_level){
      $cr = $mon_cr + (($mon_level - $mon_hd_original)/$montype_crx)  + $class1_level + ($class2_level /2) ;
   }else{
      $cr = $mon_cr + (($mon_level - $mon_hd_original)/$montype_crx)  + $class2_level + ($class1_level /2) ;
   }
}else{
  $cr = $mon_cr + (($mon_level - $mon_hd_original)/$montype_crx)  + $class1_level + $class2_level ;
}
if ($mon_size_original =="Medium"){
  if ($mon_size == "Large" or $mon_size == "Huge" or $mon_size == "Gargantuan" or $mon_size == "Colossal"){
    $cr = $cr +1;
  }
}
if ($elite == "Y"){
  $cr = $cr + 1;
}










// add 2nd primary even out and try to max
//
// add 3rd primary even out and try to max
//
// add 4th primary even out and try to max
//
//
// any left add to secondary
//
//
//
// add in Sendonary skills %20 + any left over from above
//
// add +1 first secondary even out
//
// add +1 second secondary even out
//
// if any left repeat 1st secondary
//
if ($color == "white"){
    $background_blue = "";
    $background_grey = "";
}else{

    $background_blue = "#87CEFA";
//    $background_grey = "LightGrey";
//    $background_blue = "LightSkyBlue";
    $background_grey = "#D3D3D3";
}




//  HTML for different monster sizes
$sizeHTML = "";
$select = "SELECT size_cat FROM size order by size_ac_mod desc" ;
//include 'includes/dd_db_conn.txt';

	$link = getDBLink();

$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)) {

	$size_sel = $row['size_cat'] ;
	if ($size_sel == $mon_size) {
	    	$sel = " SELECTED" ;
	} else {
	    	$sel = "" ;
	}

	$sizeHTML .= '<OPTION VALUE="'.$size_sel.'" '.$sel.' > '.$size_sel.' </OPTION>';
	
}
mysqli_close($link);


// HTML for armour types
//include 'includes/dd_db_conn.txt' ;

$link = getDBLink();
$armourHTML = "";	
$select = "SELECT armour_cd, armour_tp, armour_bonus FROM armour " .
           "where armour_cd != '4' order by armour_cd, armour_bonus, armour_dex DESC";
// echo "select" . $select;
$result = mysqli_query($link, $select) ;
//  echo "result " $result;
while ($row = mysqli_fetch_array($result)) {
	$armour_tp_sel = $row[armour_tp] ;
    $armour_bonus_sel = $row[armour_bonus] ;
    $armour_cd = $row[armour_cd];
    if ($armour_tp_sel == $mon_armour)
      {
       $sel = " SELECTED" ;
    } else {
       $sel = "" ;
    }
    $armour_0 = "Y";
    $armour_v = "armour_" . $armour_cd;
    $armour = $$armour_v;
//    echo "$armour_v $armour";
    if ($$armour_v == "Y"){
      $color = "validOption";
    }else{
      $color = "invalidOption";
    }
	    
	    $armourHTML .= '<OPTION class="'.$color.'" VALUE="'.$armour_tp_sel.'" '.$sel.' >'.$armour_tp_sel.' '.$armour_bonus_sel.'</OPTION>';
}
mysqli_close($link);


//  Shields HTML
// include 'includes/dd_db_conn.txt' ;
$link = getDBLink();
$shieldHTML = "";
$select = "SELECT armour_cd, armour_tp, armour_bonus FROM armour " .
           "where armour_cd = '4' order by armour_cd, armour_bonus, armour_dex DESC";
// echo "select" . $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row[armour_tp] ;
    $armour_bonus_sel = $row[armour_bonus] ;
      if ($armour_tp_sel == $mon_shield)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }
//      echo "$armour_v $armour";
    if ($armour_4 == "Y" or $armour_bonus_sel == 0){
      $color = "validOption";
    }else{
      $color = "invalidOption";
    }
	    $shieldHTML .= '<OPTION class ="'.$color.'" VALUE="'.$armour_tp_sel.'" '.$sel.' >'.$armour_tp_sel.' '.$armour_bonus_sel.'</OPTION>';
}
mysqli_close($link);

// weapons HTML
//include 'includes/dd_db_conn.txt' ;
$weaponsHTML = "";
$link = getDBLink();
$select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp != 'Ranged' order by weap_cat, weap_type, weap_id";
// echo "select" . $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $weap_id_sel = $row[weap_id] ;
    $weap_cat_sel = $row[weap_cat] ;
      if ($weap_id_sel == $mon_weap_p)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }
   $desc = $weap_cat_sel ." - ".$weap_id_sel  ;
//   echo "$weapon_v $armour";
    $color = check_weapon($weap_id_sel,$weap_cat_sel);
    $weaponHTML .= '<OPTION class = "'.$color.'" VALUE="'.$weap_id_sel.'" '.$sel.' >'.$desc.'</OPTION>';
   }
mysqli_close($link);



// Secondary Attacks
$count = 0;
$secondaryWeaponHTML = array();
$secondaryWeaponHTMLCount = 0;
$print_secondary_attacks = "";
$print_special_attacks = "";
$print_special_qualities = "";
While ($count < 6) {
	$count = $count + 1;
	$secondaryWeaponHTML[$count] = "";
	$name = "mon_weap_s" . $count;
	$mon_weap_s = $$name;
	$damage_v     = "damage_s" . $count;
	$damage       = $$damage_v;
	$attack_v = "attack_s" . ($count);
	$attack = $$attack_v;
//  echo $mon_weap_s;
	if ($count == 1 or ($mon_weap_s != "No Melee" and $mon_weap_s !="")) {
		$secondaryWeaponHTML[$count] = '<p class="boxLabel">Off Hand/Secondary Attack</p><p class="boxValue"><SELECT NAME="'.$name.'">';
	  	$print_secondary_attacks .=  "              +" . $attack . " " . $mon_weap_s . " " . $damage . "\n";
//    include 'includes/dd_db_conn.txt' ;
		$link = getDBLink();

    	$select = "SELECT weap_id, weap_cat FROM weapons " .
             "where weap_range_tp != 'Ranged' order by weap_cat, weap_type, weap_id";
    	$result = mysqli_query($link, $select) ;

		while ($row = mysqli_fetch_array($result)) {
			$weap_id_sel = $row[weap_id] ;
			$weap_cat_sel = $row[weap_cat] ;
	        if ($weap_id_sel == $mon_weap_s) {
	        	$sel = " SELECTED" ;
	        } else {
	 				$sel = "" ;
	 		}
	 		$desc = $weap_cat_sel ." - ".$weap_id_sel ;
	 		$color = check_weapon($weap_id_sel,$weap_cat_sel);
	 
	 		$secondaryWeaponHTML[$count] .= '<OPTION class="'.$color.'" VALUE="'.$weap_id_sel.'" '.$sel.' >'.$desc.'</OPTION>';
		}
		$secondaryWeaponHTML[$count] .= "</SELECT></p><ul class='small'>";
		$secondaryWeaponHTML[$count] .= '<li ><span class="greyText">Attack:</span><span class="indent40"> +'.$attack."</span></li>";
		$secondaryWeaponHTML[$count] .= '<li ><span class="greyText">Damage:</span><span class="indent40"> '.$damage."</span></li>";
		$secondaryWeaponHTML[$count] .= '</ul>';

		mysqli_close($link);	
	}
}

// Ranged Weapons
// include 'includes/dd_db_conn.txt' ;
$link = getDBLink();
$rangeWeaponHTML = "";
$select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp = 'Ranged' order by weap_cat, weap_type, weap_id";
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $weap_id_sel = $row[weap_id] ;
    $weap_cat_sel = $row[weap_cat] ;
      if ($weap_id_sel == $mon_weap_r)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }
   $desc = $weap_cat_sel." - ".$weap_id_sel;
   $color = check_weapon($weap_id_sel,$weap_cat_sel);

	$rangeWeaponHTML .= '<OPTION class = "'.$color.'" VALUE="'.$weap_id_sel.'" '.$sel.' > '.$desc.' </OPTION>';
}
mysqli_close($link);

// Monk Specials
$monkHTML = "";
if ($class1_tp == "Monk" or $class2_tp == "Monk") {
	$monkHTML = '<li class="specialAbility"><ul>';
	$monkHTML .= "<li>Monk's Flurry of Blows</li>";
	$monkHTML .= '<li  class="small greyText">Attack: '.$flurry.'</li>';
	$monkHTML .= '<li  class="small greyText">Damage: '.$flurry_damage.'</li>';
	$monkHTML .= '</ul></li>';
}


// Monster Special Attacks 
//include 'includes/dd_db_conn.txt';
$link = getDBLink();
$monsterSpecialHTML = "";
$select = "SELECT monspec_name, monspec_value, specatta_abil, specatta_save from monspec, specatta where monspec_tp = 'A' and mon_name = '$mon_name'" .
          "and monspec_name = speca_name";
$result = mysqli_query($link, $select) ;
//  echo "result " $result;
$count = 0;
$mon_nul_bonus = 0;
// if monster has a template then specials abilities include levels
//echo "template " . $mon_template;
if ($mon_template == "0" or $mon__template =="L" or $mon_template == "T"){
   $spec_level = $total_level;
}else{
   $spec_level = $mon_level;
}
// echo "spec level " . $spec_level;
while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $specatta_abil = $row[specatta_abil];
    $abil_atr_v = "mon_". strtolower($specatta_abil) . "_bonus";
    if ($$abil_atr_v == "0"){
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
    $specatta_save = $row[specatta_save];
    $DC_txt = " ";
    if ($specatta_save !="" and $specatta_save != " "){
      if ($specatta_save == "LV"){
        $DC =  10 + round($spec_level /2 -0.5) + $$abil_atr_v;
      }else{
        $DC = 10 + $specatta_save + $$abil_atr_v;
      }
      $DC_txt = " DC(" . $DC . ") ";
    }
    $monsterSpecialHTML .= '<li class="specialAbility"><ul>';
    $monsterSpecialHTML .= '<li>'.$row[monspec_name]. $DC_txt . '</li>';
    $monsterSpecialHTML .= '<li class="small greyText">'.$row[monspec_value] . '</li>';
    $monsterSpecialHTML .= '</ul></li>';
    $print_special_attacks .= $row[monspec_name] . "$DC_txt" . $row[monspec_value] . ", ";
}

// Monster Special Abilities
//include 'includes/dd_db_conn.txt';
$link = getDBLink();
$specialAbilitiesHTML = "";
$select = "SELECT monspec_name, monspec_value, specqual_abil, specqual_save from monspec, specqual where monspec_tp = 'S' and mon_name = '$mon_name' " .
          "and monspec_name = specq_name";
$result = mysqli_query($link, $select) ;
//  echo "result " $result;
$count = 0;

while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $specqual_abil = $row[specqual_abil];
    $abil_atr_v = "mon_". strtolower($specqual_abil) . "_bonus";
    if ($$abil_atr_v == "0"){
       if ($mon_chr > 1){
         $abil_atr_v = "mon_chr_bonus";
       }else{
         $abil_atr_v = "mon_nul_bonus";
       }
    }
    $specqual_save = $row[specqual_save];
    $DC_txt = " ";

    if ($specqual_save !="" and $specqual_save != " "){
      if ($specqual_save == "LV"){
        $DC =  10 + round($spec_level /2 -0.5) + $$abil_atr_v;
      }else{
        $DC = 10 + $specqual_save + $$abil_atr_v;
      }
      $DC_txt = " DC(" . $DC . ") ";
    }
	$specialAbilitiesHTML .= '<li class="specialAbility"><ul>';
	$specialAbilitiesHTML .= '<li>'.$row[monspec_name]. $DC_txt .'</li>';
    $specialAbilitiesHTML .= '<li class="small greyText">'.$row[monspec_value].'</li>';
    $specialAbilitiesHTML .= '</ul></li>';
    if ($print_special_quantities != ""){
         $print_special_quantities .= ", ";
    }
    $print_special_qualities .= $row[monspec_name] . "$DC_txt " . $row[monspec_value];

}


//  FEATS
// Work out how many
$mon_feats_calc = 0;
if ($mon_level >0){
   $mon_feats_calc = round(($mon_level) / 3 - 0.49,0) + 1;
}
if ($mon_int == 0){
   $mon_feats_calc = 0;
}
if ($mon_feats_calc > ($mon_feats - $mon_free_feats)){
   $mon_feats = $mon_feats_calc + $mon_free_feats;
}
//echo "calc " . $mon_feats_calc . "free " . $mon_free_feats;
if ($mon_name == "Human"){
   $mon_feats = $mon_feats + 1;
}
if ($class1_tp != ""){
   $gen_feats = round(($class1_level + $class2_level) / 3 - 0.49,0) + 1 + $mon_feats + $class_feats;
}else{
   $gen_feats = $mon_feats;
}
//echo "</BR> gen_feats = " . $gen_feats;
//echo "</BR> mon_feats = " . $gen_feats;
//echo "</BR> class1_feat = " . $class1_feat;
//echo "</BR> class2_feat = " . $class2_feat;

$max_feats = $mon_feats + $class1_feat + $class2_feat + $gen_feats + $class_feats;
//echo "@".$max_feats."<br/>";

// Get temp feats
//include 'includes/dd_db_conn.txt' ;
$link = getDBLink();

$select = "SELECT feattemp_feat, feattemp_class, feattemp_auto from feattemp where feattemp_user = '$user'" .
          "ORDER BY feattemp_class, feattemp_feat";

// echo "</BR> SELECT = " . $select;
$result = mysqli_query($link, $select) ;
$count = 0;
$old_class ="";
$print_feat = "";
if ($result){
  while ($row = mysqli_fetch_array($result)) {
     $feat_class = $row[feattemp_class];

     if ($old_class != $feat_class){
        $count = 0;
     }
     $count = $count + 1;
     $old_class = $feat_class;
     $featv = "feat_" . $feat_class . $count;
     $$featv = $row[feattemp_feat] ;
     $autov   = "feat_auto_" . $feat_class . $count;
     $$autov = $row[feattemp_auto];
     $print_feat .= $row[feattemp_feat] . ", ";
//     echo "</BR>" .  $featv . " " . $$featv; 
  }
}

// Build up HTML
$featsHTML = array();


$count1 = 0;
$add2 = 0;
$count3 = 0;
while ($count3 < 3){
	$count3 = $count3 + 1;

	$featsHTML[ $count3 ] = "";


	if ($count3 == 1){
		 if ($class1_feat > 0){
		 	$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class1_tp.' <span class="small">(Max: '.$class1_feat.')</span></h4>';
	     }
	     $max_feats = $class1_feat;
	}
	
	if ($count3 ==2){
	    if ($class2_feat > 0){
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class2_tp.' <span class="small">(Max: '.$class2_feat.')</span></h4>';
	     }
     	     $max_feats = $class2_feat;
        }
	if ($count3 == 3){
    	$featsHTML[ $count3 ] = '<h4 class="boxLabel">General <span class="small">(Max: '.$gen_feats.')</span></h4>';
	    $max_feats = $gen_feats;
  	}

	$count1 = 0;
	$add2 = 0;
//echo "--".$count3."<br/>";
	while ($count1 < 4 and $add2 < $max_feats){
//echo $count1." ".$add2." ".$max_feats."<br/>";
		$count1 = $count1 + 1;
		$add1   = ($count1 - 1) * 5; 
		$count2 = 0;
		while ($count2 < 5 and $add2 < $max_feats){
			$count2 = $count2 + 1;
			$add2 = $add1 + $count2;
			$featv  = "feat_" . $count3 . $add2;
			$feat = $$featv;
			$feat_autov = "feat_auto_" . $count3 . $add2;
			$auto = $$feat_autov;
//       echo  "</BR>" . $featv . $feat , $auto;

			if ($add2 <= $max_feats){
				$featsHTML[ $count3 ] .= '<li>';
				if ($count3 == 3 and $auto ==  "Y" and $feat !=""){
					$featsHTML[ $count3 ] .= '<p class="featName">'.$feat;
				}else{
					$featsHTML[ $count3 ] .= '<p class="featName"><SELECT NAME="'.$featv.'" >';
 			
//          echo "Count = " . $count3;
					if ($count3 == 1){
						$select = "SELECT feat_name, feat_desc FROM feats, classfeats " .
	             		"where classfeat_class = '$class1_tp' and classfeat_level <= '$class1_level' and feat_name = classfeat_feat ".
	             		"order by feat_name" ;
	             		if ($class1_tp != "Fighter"){	
	             			$$feat_autov = "Y";
	             		}
	             	}else{
	             		if ($count3 == 2){
	             			$select = "SELECT feat_name, feat_desc FROM feats, classfeats " .
	              			"where classfeat_class = '$class2_tp' and classfeat_level <= '$class2_level' and feat_name = classfeat_feat ". 
	              			"order by feat_name" ;
	              			if ($class2_tp != "Fighter"){
	              				$$feat_autov = "Y";
	              			}
	              		}else{
	              			$$feat_autov = "";
	              			$select = "SELECT feat_name, feat_desc FROM feats order by feat_name" ;
	              		}
	              	}
//    echo "</BR> SELECT $select";        

					$result = mysqli_query($link, $select) ;

//  echo "result " . $result;
					while ($row = mysqli_fetch_array($result)) {
						$feat_sel = $row[feat_name] ;
						$feat_desc = $row[feat_desc] ;
						if ($feat_sel == $$featv) {
							$sel = "SELECTED" ;
						} else {
							$sel = "" ;
						}
						$color = "validOption";
						if ($count3 == 3 or ($count3 == 1 and $class1_tp =="Fighter") 
							or ($count3 == 2 and $class2_tp =="Fighter")) {
							
							$text = check_feat($feat_sel);
							if ($text != ""){
								$color = "invalidOption";
							}
						}
						
						$featsHTML[ $count3 ] .= '<OPTION class="'.$color.'" VALUE="'.$feat_sel.'" '.$sel.' >'.$feat_sel.'</OPTION>';
					}
					$featsHTML[ $count3 ] .= "</SELECT>";
				}
				$feat_auto = $$feat_autov;
				$featsHTML[ $count3 ] .= '<INPUT TYPE="hidden" NAME="'.$feat_autov.'" VALUE="'.$feat_auto.'" />';
			}
		}
		$featsHTML[ $count3 ] .= "</p></li>";
	}
}
mysqli_close($link);

$featErrorsHTML = "";
if ($errortxt !=""){
   $featErrorsHTML = $errortxt;
}


// Feat Help
//include 'includes/dd_db_conn.txt' ;
$link = getDBLink();
$featHelpHTML  = "";
$select = "SELECT feat_name, feat_desc FROM feats order by feat_name" ;
$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)) {
	$feat_sel = $row[feat_name] ;
	$feat_desc = $row[feat_desc];
	if ($feat_sel == $feathelp) {
		$sel = " SELECTED" ;
	} else {
		$sel = "" ;
	}
	$featHelpHTML .= '<OPTION VALUE="'.$feat_sel.'" '.$sel.' >'.$feat_sel.' '.$feat_desc.' </OPTION>';
}




// Skills table
//include 'includes/dd_db_conn.txt' ;
$link = getDBLink();
$skillsHTML = "";
$print_skill = "";
$select = "SELECT  skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                 "skillt_misc_bonus , skillt_xskill, skillt_armour_ch from skilltemp where skillt_user = '$user'";

$result = mysqli_query($link, $select) ;
$count = 0;
while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $skillv = "skill_" . $count;
    $$skillv = $row[skillt_skill] ; 
    $skill = $$skillv ;
    $rankv = "skillrank_" . $count;
    $$rankv = $row[skillt_rank] ; 
    $rank = $$rankv ;    
    $atr  = $row[skillt_atr];
    $armour_ch = $row[skillt_armour_ch];
    $select2 = "select featattr_no from featattr, feattemp where ".
                        "feattemp_user = '$user' and featattr_type = 'SKILL' and ".
                        "featattr_id = '$skill' and featattr_feat = feattemp_feat";
//    echo $select2;
    $result2 = mysqli_query($link, $select2) ;
    $misc_bonusv = "skillmiscbon_" . $count;
    $$misc_bonusv = 0;
    if ($result2){
       while ($row2 = mysqli_fetch_array($result2)){
          $add = $row2[featattr_no]; 
          $$misc_bonusv = $$misc_bonusv + $add;
//          echo "</BR> Bonus " . $add;
       }
    }
    $misc_bonus = $$misc_bonusv;
    $select3 = "select specattr_no from specattr, classsp where ".
                        "((classsp_class = '$class1_tp'and classsp_level <= '$class1_level') or " .
                          "(classsp_class = '$class2_tp'and classsp_level <= '$class2_level')) " .
                        " and specattr_type = 'SKILL' and ".
                        "specattr_id = '$skill' and specattr_spec = classsp_spec";
//     echo $select3;
    $result3 = mysqli_query($link, $select3) ;
    $misc_bonusv = "skillmiscbon_" . $count;
    $$misc_bonusv = 0;
    if ($result3){
       while ($row3 = mysqli_fetch_array($result3)){
          $add = $row3[specattr_no];
          $$misc_bonusv = $$misc_bonusv + $add;
//          echo "</BR> Bonus " . $add;
       }
    }
    $misc_bonus = $misc_bonus + $$misc_bonusv;
//
// synergy bonus
//
    $select4 = "select count(*) from skillsyn, skilltemp where skillt_user = '$user' and " .
                "skillsyn_skill2 = '$skill' and skillsyn_skill1 = skillt_skill and " .
                "skillt_rank > '4'";
//    echo $select4;
    $result4 = mysqli_query($link, $select4) ;
    $row4 = mysqli_fetch_array($result4);
    $syn = $row4[0];
    if ($syn > 0){
       $syn_bonus = $syn * 2;
       $misc_bonus = $misc_bonus + $syn_bonus;
    }
    if ($skill == "Hide"){
        $misc_bonus = $misc_bonus + $size_hide;
    }

//    
//
//
//
    if ($atr != ""){
       $atr_bonusv = "mon_" . strtolower($atr) ."_bonus" ;
       $atr_bonus = $$atr_bonusv;
    }else{
       $atr_bonus = 0;
    }  
//
//
    $armour_bonus = 0;
    if ($magic_armour > 0  and $armour_check != 0 ){
       $magic_bonus = +1;
    }
    if ($armour_ch == "Y"){
       $armour_bonus = $armour_check + $shield_check + $magic_bonus;
    }
    if ($armour_ch == "2"){
       $armour_bonus = ($armour_check + $shield_check + $magic_bonus) * 2;
    }
    $misc_bonus = $misc_bonus + $armour_bonus;
    $mod = $rank + $atr_bonus + $misc_bonus;

	if ( $count /2 == round($count / 2) ) {
		$skillsHTML .= '<TR class="evenRow">';
	} else {
		$skillsHTML .= '<TR class="oddRow">';		
	}
	$skillsHTML .= '<TD class="skillName">'.$skill.'</TD>';
	$skillsHTML .= '<TD class="skillTotal">'.$mod.'</Td>';
	$skillsHTML .= '<TD class="skillRank">';
	if ( $rank == 0 ) {
		$skillsHTML .= "-";
	} else {
		$skillsHTML .= $rank;
	}
	$skillsHTML .= '</TD>';
	$skillsHTML .= '<TD class="skillStatBonus">';
	if ( $atr_bonus == 0 ) {
		$skillsHTML .= "-";
	} else {
		$skillsHTML .= $atr_bonus;
	}
	$skillsHTML .= '</TD>';
	$skillsHTML .= '<TD class="skillMiscBonus">';
	if ( $misc_bonus == 0 ) {
		$skillsHTML .= "-";
	} else {
		$skillsHTML .= $misc_bonus;
	}
	$skillsHTML .= '</TD>';
	
	$skillsHTML .= '</TR>';
	$print_skill .= $skill . " " . $mod . ", ";
}



// SPELLS
$spellsOneHTML = "";
$spellsTwoHTML = "";
$print_spell = "";
if ($class1_spat != ""){
   $stat_v = "mon_" . strtolower($class1_spat);
   $stat1_bonus_v =   "mon_" . strtolower($class1_spat) . "_bonus";
   $stat1_bonus = $$stat1_bonus_v;
   $stat   = $$stat_v;
   $stat1 = $stat;
   $select = "select abil_0l,abil_1l,abil_2l,abil_3l,abil_4l,abil_5l,abil_6l,abil_7l,abil_8l,abil_9l ".
             "from abilities where abil_score = $stat";
   $result = mysqli_query($link, $select) ;
   if ($result){
      $row = mysqli_fetch_array($result);
      $count = 0;
      while ($count < 10){
         $class_spell_v = "class1_spell" . $count;
         $abil_v = "abil_" . $count . "l";
         $class_spell = $$class_spell_v;
         $class_spell = trim($class_spell);
//         echo  "</BR> spell $class_spell";
         if ($class_spell != ""){
//            echo $abil_v .  $row[$abil_v];
            $$class_spell_v =  $$class_spell_v  + $row[$abil_v];
         }
         $count = $count + 1;
      }

   }
   $spellsOneHTML .= '<TR class="oddRow">';
   $spellsOneHTML .= '<TD>'.$class1_tp.'</TD>';

   $count = 0;
   $print_spell = "\n" . $class1_tp;
   $max1_level = $stat1 - 10;
   while ($count < 10){
     $spell_v = "class1_spell" . $count;
     $spell = trim($$spell_v);
     $spellsOneHTML .=  "<TD>$spell</TD>";
     $dc = 10 + $count + $stat1_bonus;
     if ($spell != ""){
         $print_spell .= "\n" . "level " . $count . " (" . $spell . ")  (DC " . $dc . ")";
         if ($max1_level < $count){
           $print_spell .= " * needs  ". $class1_spat . " of " . (10 + $count) . " to cast *";
         }
     }
     $count = $count + 1;
   }
   $spellsOneHTML .= '</TR>';

}
if ($class2_spat != ""){
   $stat_v = "mon_" . strtolower($class2_spat);
   $stat   = $$stat_v;
   $stat2   = $stat;
   $stat2_bonus_v =   "mon_" . strtolower($class2_spat) . "_bonus";
   $stat2_bonus = $$stat2_bonus_v;
   $select = "select abil_0l,abil_1l,abil_2l,abil_3l,abil_4l,abil_5l,abil_6l,abil_7l,abil_8l,abil_9l ".
             "from abilities where abil_score = $stat";
   $result = mysqli_query($link, $select) ;
   if ($result){
      $row = mysqli_fetch_array($result);
      $count = 0;
      $print_spell .=   "\n" . $class2_tp;
      while ($count < 10){
         $class_spell_v = "class2_spell" . $count;
         $abil_v = "abil_" . $count . "l";
         $class_spell = trim($$class_spell_v);
//         echo  "</BR> spell $class_spell";
         if ($class_spell != ""){
//            echo $abil_v .  $row[$abil_v];
            $$class_spell_v =  $$class_spell_v  + $row[$abil_v];
         }
         $count = $count + 1;
      }

   }
   $spellsTwoHTML .= '<TR class="evenRow">';
   $spellsTwoHTML .= '<TD>'.$class2_tp.'</TD>';

   $count = 0;
   $max2_level = $stat2 - 10;
   while ($count < 10){
     $spell_v = "class2_spell" . $count;
     $spell = $$spell_v;
     $spellsTwoHTML .=  "<TD>$spell</TD>";
     if ($spell != ""){
       $dc = 10 + $count + $stat2_bonus;
       $print_spell .= "\n" . "level " . $count . " (" . $spell . ")  (DC ". $dc . ")";
       if ($max2_level < $count){
           $print_spell .= " * needs  ". $class2_spat . " of " . (10 + $count) . " to cast *";
       }
     }
     $count = $count + 1;
   }
   $spellsTwoHTML .= '</TR>';

}


// Class Specials
$classSpecialsOneHTML = "";
$classSpecialsTwoHTML = "";
$print_class_special = "";
if ($class1_tp !=""){
  $select = "SELECT classsp_spec, spec_desc, SUM(classsp_no), spec_display  " .
             "FROM classsp, specials " .
             "WHERE classsp_spec = spec_name and ".
             "classsp_class = '$class1_tp' and classsp_level <=  '$class1_level' " .
             "group by classsp_spec";
//  echo $select;
  $result = mysqli_query($link, $select) ;
  $print_class_special = "\n" . $class1_tp . " Special Abilities ";
  while ($row = mysqli_fetch_array($result)) {
      $count = $count + 1;
      $spec_v = "class1_spec_" . $count;
      $$spec_v  = $row[0];
      $spec   = $$spec_v;
      $spec_desc_v = "class1_spec_desc_" . $count;
      $$spec_desc_v = $row[1];
      $spec_desc = $$spec_desc_v;
      $spev_no_v = "class1_spec_no_" . $count;
      $$spec_no_v = $row[2];
      $spec_no  = $$spec_no_v;
      $spec_display = $row[3];
//      echo "</BR> $spec  $spec_no";

		if ( $count /2 == round($count / 2) ) {
			$classSpecialsOneHTML .= '<TR class="evenRow">';
		} else {
			$classSpecialsOneHTML .= '<TR class="oddRow">';
		}
		$classSpecialsOneHTML .= '<TD class="classSpecialName">'.$spec.'</TD>';
		$classSpecialsOneHTML .= '<TD class="classSpecialDesc">'.$spec_desc.'</TD>';
		$classSpecialsOneHTML .= '<TD class="classSpecialValue">'.$spec_no.'</TD>';
		$classSpecialsOneHTML .= '</TR>';
		if ($spec_display == "A"){
                    $print_special_attacks .= "\n" . $spec. " " . $spec_desc;
                    if ($spec_no != 0){
                       $print_special_attacks .=  " " . $spec_no;
                    }
                }
                if ($spec_display == "Q"){
                    $print_special_qualities .= "\n" . $spec. " " . $spec_desc;
                    if ($spec_no != 0){
                       $print_special_qualities .= " " . $spec_no;
                    }
                }
		$print_class_special .=  "\n" .$spec . " " . $spec_desc;
		if ($spec_no != 0){
                   $print_class_special .= " " . $spec_no;
                }
  }
}
if ($class2_tp !=""){
  $print_class_special .= "\n" . $class2_tp . " Special Abilities ";
  $select = "SELECT classsp_spec, spec_desc, SUM(classsp_no), spec_display  " .
             "FROM classsp, specials " .
             "WHERE classsp_spec = spec_name and ".
             "classsp_class = '$class2_tp' and classsp_level <=  '$class2_level' " .
             "group by classsp_spec";
//  echo $select;
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)) {
      $count = $count + 1;
      $spec_v = "class2_spec_" . $count;
      $$spec_v  = $row[0];
      $spec   = $$spec_v;
      $spec_desc_v = "class2_spec_desc_" . $count;
      $$spec_desc_v = $row[1];
      $spec_desc = $$spec_desc_v;
      $spev_no_v = "class2_spec_no_" . $count;
      $$spec_no_v = $row[2];
      $spec_no  = $$spec_no_v;
      $spec_display = $row[3];
//      echo "</BR> $spec  $spec_no";


		if ( $count /2 == round($count / 2) ) {
			$classSpecialsTwoHTML .= '<TR class="evenRow">';
		} else {
			$classSpecialsTwoHTML .= '<TR class="oddRow">';
		}
		$classSpecialsTwoHTML .= '<TD  class="classSpecialName">'.$spec.'</TD>';
		$classSpecialsTwoHTML .= '<TD  class="classSpecialDesc">'.$spec_desc.'</TD>';
		$classSpecialsTwoHTML .= '<TD class="classSpecialValue">'.$spec_no.'</TD>';
		$classSpecialsTwoHTML .= '</TR>';
		if ($spec_display == "A"){
                    $print_special_attacks .= "\n" . $spec. " " . $spec_desc;
                    if ($spec_no != 0){
                       $print_special_attacks .= " " . $spec_no;
                    }
                }
                if ($spec_display == "Q"){
                    $print_special_qualities .= "\n" . $spec. " " . $spec_desc;
                    if ($spec_no != 0){
                       $print_special_qualities .= " " . $spec_no;
                    }
                }
		$print_class_special .=  "\n" .$spec . " " . $spec_desc;
		if ($spec_no != 0){
                   $print_class_special .=  $spec_no;
                }

  }
}







require ( "ddDisplayMonsterJS.php" );

require ( "ddDisplayMonsterForm.php" );

?>
<script>
if(typeof(urchinTracker)!='function')document.write('<sc'+'ript src="'+
'http'+(document.location.protocol=='https:'?'s://ssl':'://www')+
'.google-analytics.com/urchin.js'+'"></sc'+'ript>')
</script>
<script>
try {
_uacct = 'UA-6999444-1';
urchinTracker("/1656209821/goal");
} catch (err) { }
</script>





