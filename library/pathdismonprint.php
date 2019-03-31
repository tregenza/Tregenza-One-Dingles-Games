<?php

//$includePath = "/usr/share/wordpress2.7/wp-content/themes/dinglesgames/";
//$includePathLocal = $includePath."tools/MonsterGenerator/dnd35";
// Get standard functions
//require $includePathLocal."/ddmonsterFunctions.php";

// require "./ddInit.php";

$local =  $_SERVER['SERVER_NAME'];
//  <-- CT 29/11/08
//$local .= dirname($_SERVER['PHP_SELF'] );
//echo  "local = $local";
//$local = locate_template('ddglobal.php');
//echo  "local = $local";
//require_once(locate_template('library/ddglobal.php'));
//require "./ddglobal.php";
global $user;
  global $mon_str, $mon_int, $mon_dex, $mon_chr, $mon_con, $mon_wis, $mon_str_bonus, $mon_int_bonus, $mon_dex_bonus, $mon_chr_bonus, $mon_con_bonus, $mon_wis_bonus;
global $wp_user, $user, $print_attack, $htmlp_secondary_attacks_s, $magic_WEAPONA_SPEC_1;
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
 global  $spell_html_print, $spell_html_print_s ;
 global $class1_spell_level, $class2_spell_level, $class3_spell_level;
   global $class1_spell0_n, $class1_spell1_n,$class1_spell2_n,$class1_spell3_n,$class1_spell4_n,$class1_spell5_n, $class1_spell6_n,$class1_spell7_n,$class1_spell8_n,$class1_spell9_n;
   global $class2_spell0_n, $class2_spell1_n,$class2_spell2_n,$class2_spell3_n,$class2_spell4_n,$class2_spell5_n, $class2_spell6_n,$class2_spell7_n,$class2_spell8_n,$class2_spell9_n;
   global $class3_spell0_n, $class3_spell1_n,$class3_spell2_n,$class3_spell3_n,$class3_spell4_n,$class3_spell5_n, $class3_spell6_n,$class3_spell7_n,$class3_spell8_n,$class3_spell9_n;
   global $class1_spat, $class2_splat, $class3_splat;
//   $name_v = "class" . $class_no . "_spell_level" . $spell_level . "_" . $count;
   $count_class  = 1;
   $spell_level = 0;
   while ($count_class < 3){
       $spell_level = 0;
       while ($spell_level < 9){
          $count = 0;
          while ($count < 15){
            $name_v = "class" . $count_class . "_spell_level" . $spell_level . "_" . $count;
            global $$name_v;
            $name_v = "class" . $count_class . "_spell_level" . $spell_level . "_" . $count;
            global $$name_v;
            $count += 1;
          }
          $spell_level += 1;
       }
      $count_class += 1;
   }
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
   $print        = $_SESSION['sprint'];
   $oldmon_key   = $_SESSION['soldmon_key'];
   $elite        = $_SESSION['selite'];
   $mon_temp     = $_SESSION['smon_template'];
   $mon_temp2     = $_SESSION['smon_template2'];
 //  echo "user = $user" ;
}

$htmlp = "";
$print = "";

$htmlpBlock = "";
$printBlock = "";

$tem_type = "";
$tem_type2 = "";
$magic_WEAPONR_SPEC_1 = "";
$magic_WEAPONP_SPEC_1 = "";
if (isset($class1_level)){
}else{
   $class1_level = "";
}
if (isset($class2_level)){
}else{
   $class2_level = "";
}

if (isSet($savemon_camp)){
   $savemon_camp_s = $savemon_camp;
   $savemon_sub_s = $savemon_sub;
   $savemon_name_s = $savemon_name;
}else{
   $savemon_camp_s = "";
   $savemon_sub_s = "";
   $savemon_name_s = "";
}
//echo $savemon_desc;
foreach ($_POST  as $k => $v) {
//       $v = trim($v) ;
       $$k = $v ;
//       echo "<div>$k $v </div> ";
}
//echo "speed $speed_land $user_id";
//echo "save text $save_text";
if (is_page(199)){
  $savemon_camp = $savemon_camp_s;
  $savemon_sub = $savemon_sub_s;
  $savemon_name = $savemon_name_s;
}
if (is_page(1947)){
   $savemon_camp = "";
  $savemon_sub = "";
  $savemon_name = "";
  $savemon_desc = "";
}
//echo $magic_WEAPONR_SPEC_1;
//echo "first key 1 $key_1";
 $link = getDBLink();
 $select = "select dduser_mon_created from dduser where dduser_id = '$wp_user'";
 $result = mysqli_query($link, $select) ;
 if ($result){
       $row = mysqli_fetch_array($result);
       $mon_created = $row['dduser_mon_created'] + 1;
       $today =  time();
       $today =  date('Ymd');
       $update = "update dduser set dduser_mon_created = '$mon_created', dduser_last_date = '$today' where dduser_id = '$wp_user'";
       $result = mysqli_query($link, $update) ;
//        echo $update;
}

$htmlpBlock = "";
$printBlock = "";



if ($savemon_camp != "" or $savemon_sub != ""){
   $printBlock = "Name " . $savemon_name . " (" . $savemon_camp . "/" . $savemon_sub . ")" .  "\n";
   $htmlpBlock .=  wrapHTMLHighlight("Name") . $savemon_name . " (" . $savemon_camp . "/" . $savemon_sub . ")" .  "\n";
}else{
    $printBlock = "Name " . $savemon_name . "\n";
    $htmlpBlock .=  wrapHTMLHighlight("Name") . $savemon_name;
}
$htmlp .=  wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

$print .=  $mon_name . " (" . $mon_size . " " . $mon_type . ")";
if ($print_sub != ""){
   $print_sub = " " . $print_sub;
}

$htmlpBlock .=  wrapHTMLHighlight($mon_name);

$cr_total = $cr + $cr_path;
//echo "cr total $cr_total cr path $cr_path";
if ($cr_total > 1){
  $cr_total = round($cr_total,0);
}
$link = getDBLink();
if ($cr_total < 1){
  $select = "select level_xp from level where lev_no = 1";
  if ($result = mysqli_query($link, $select)){
    $row = mysqli_fetch_array($result);
    $xp = $row['level_xp'] * $cr_total;
    $xp = round($xp,0);
  }else{
    $xp = "***";
  }
}else{
  $select = "select level_xp from level where lev_no = '$cr_total'";
  if ($result = mysqli_query($link, $select)){
    $row = mysqli_fetch_array($result);
    $xp = $row['level_xp'];
  }else{
    $xp = "***";
  }
}



if ($mon_temp !=""){
   if ($mon_temp2 != ""){
       $print .=  $mon_temp . "/" . $mon_temp2 . "     CR " . $cr_total .   "\n";
       $htmlpBlock .=  wrapHTMLHighlight(" " . $mon_temp . "/" . $mon_temp2 .  "     CR " . $cr_total );
   }else{
       $print .=  $mon_temp . "     CR " . $cr_total .   "\n";
       $htmlpBlock .=  wrapHTMLHighlight(" " . $mon_temp . "     CR " . $cr_total );
   }
}else{
   $print .= "               CR " . $cr_total . "\n";
   $htmlpBlock  .= wrapHTMLHighlight(" CR " . $cr_total );
}

$htmlp .=  wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


//echo $mon_desc;
if ($mon_desc == $mon_name or $mon_desc == "-" or $key_1 != "path"  or strlen($mon_desc) < 20 ) {

}else{
  $htmlp .= wrapHTMLBlock($mon_desc);
		$htmlpBlock = "";
}

$print .= "XP " . $xp . "\n";

$htmlpBlock .= wrapHTMLHighlight("XP") . $xp ;
$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


if ($tem_type != "" and ((($mon_type == 'Animal' or $mon_type == 'Vermin') and $tem_type == 'Magical beast') or $tem_type != 'Magical beast')){
   if ($tem_type2 != "" and ((($mon_type == 'Animal' or $mon_type == 'Vermin') and $tem_type2 == 'Magical beast') or $tem_type2 != 'Magical beast')){
       $htmlpBlock .= $mon_alignment .  " " . $mon_size . " " . $mon_type . " ($tem_type $tem_type2)" . $print_sub ;
   }else{
      $htmlpBlock .= $mon_alignment .  " " . $mon_size . " " . $mon_type . " ($tem_type)" . $print_sub ;
   }
}else{
   if ($tem_type2 != "" and ((($mon_type == 'Animal' or $mon_type == 'Vermin') and $tem_type2 == 'Magical beast') or $tem_type2 != 'Magical beast')){
       $htmlpBlock .= $mon_alignment .  " " . $mon_size . " " . $mon_type . " ($tem_type $tem_type2)" . $print_sub ;
   }else{
      $htmlpBlock .= $mon_alignment .  " " . $mon_size . " " . $mon_type . $print_sub ;
   }
}

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

$class1_tp = trim($class1_tp);
$class2_tp = trim($class2_tp);
$class3_tp = trim($class3_tp);
if ($class1_tp != ""){
   $print .=  $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus . "\n";
   $htmlpBlock .=  $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus ;
}
if ($domain_11 != "" ){
  if ($class1_tp == "Cleric"){
       $print .= "(Domains  $domain_11 and $domain_12) ";
       $htmlpBlock .= "(Domains  $domain_11 and $domain_12) ";
  }else{
     if ($class1_tp == "Wizard"){
        $print .=  "(School $domain_11  Prohibited  $domain_12 , $domain_13)";
        $htmlpBlock .=  "(School $domain_11  Prohibited  $domain_12 , $domain_13)";

     }else{
        $print .= "($domain_11 $domain_12) ";
        $htmlpBlock .= "($domain_11 $domain_12) ";
     }
   }
   $print .= "\n";
}

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


if ($class2_tp != ""){
     $print .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus . "\n";
     $htmlpBlock .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus ;

					$htmlp .= wrapHTMLBlock($htmlpBlock);
					$htmlpBlock = "";
					

     if ($domain_21 != "" ){
        if ($class2_tp != "Wizard"){
           if ($class2_tp == "Cleric"){
             $print .= "(Domains  $domain_21 and $domain_22)";
             $htmlpBlock .= "(Domains  $domain_21 and $domain_22)";
           }else{
             $print .= "($domain_21 $domain_22)";
             $htmlpBlock .= "($domain_21 $domain_22)";
           }
       }else{
          $print .=  "(School $domain_21  Prohibited  $domain_22 , $domain_23)";
          $htmlpBlock .=  "(School $domain_21  Prohibited  $domain_22 , $domain_23)";
      }

					$htmlp .= wrapHTMLBlock($htmlpBlock);
					$htmlpBlock = "";
					
    }
}
if ($class3_tp != ""){
     $print .=  $class3_tp . " level " . $class3_level . " (skill points " . $class3_skill_points  . ") " . $class3_focus . "\n";
     $htmlpBlock .=  $class3_tp . " level " . $class3_level . " (skill points " . $class3_skill_points  . ") " . $class3_focus  ;

					$htmlp .= wrapHTMLBlock($htmlpBlock);
					$htmlpBlock = "";

     if ($domain_31 != "" ){
        if ($class3_tp != "Wizard"){
          $print .= "(Domains  $domain_31 and $domain_32)";
          $htmlpBlock .= "(Domains  $domain_31 and $domain_32)";
       }else{
          $print .=  "(School $domain_31  Prohibited  $domain_32 , $domain_33)";
          $htmlpBlock .=  "(School $domain_31  Prohibited  $domain_32 , $domain_33)";
      }
      $print .= "\n";

						$htmlp .= wrapHTMLBlock($htmlpBlock);
						$htmlpBlock = "";
						
    }
}
$initp = $init;
if ($init > 0){
   $initp = "+" . $init;
}
if ($init == ""){
   $initp = "0";
}
if ($print_init >""){
   $print_init = " " . $print_init;
}
if ($init_text >""){
   if ($print_init >""){
       $print_init .= ", " . $init_text;
   }else{
       $print_init = $init_text;
   }
}
//echo "sen_text = $sen_text ";
if ($sen_text >""){
   if ($print_sen >""){
       $print_sen .= ", " . $sen_text;
   }else{
       $print_sen = $sen_text;
   }
}
$print .=  "Init " . $initp . $print_init . "; Senses " . $print_sen;

$htmlpBlock .=  wrapHTMLHighlight("Init") . $initp . $print_init . "; ".wrapHTMLHighlight("Senses") . $print_sen ;
$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

if ($print_aura != ""){
   $htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Aura"). $print_aura);
}

$print .= "\n\n" . "DEFENSE \n";

$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("DEFENSE"));

$magic_armour_d = round($magic_armour,0);


//echo 1 . $magic_armour . ":" . $magic_armour_d;
if ($magic_armour > $magic_armour_d){
   $magic_armour_d = "masterwork";
}
//echo 2 . $magic_armour . ":" . $magic_armour_d;
if ($magic_armour_d !== "masterwork"){
//   echo "not mastwer";
   if ($magic_armour_d > 0 ){
//     echo "here:" . $magic_armour_d . ":";
     $magic_armour_d = "+" . $magic_armour_d;
   }else{
     $magic_armour_d = "";
//     echo "space?:" . $magic_armour_d . ":";
   }
}
//echo 3 . $magic_armour . ":" . $magic_armour_d;

$magic_shield_d = round($magic_shield,0);

if ($magic_shield > $magic_shield_d){
   $magic_shield_d = "masterwork";
}
if ($magic_shield_d !== "masterwork" ){
   if ($magic_shield_d > 0 ){
      $magic_shield_d = "+" . $magic_shield_d;
   }else{
      $magic_shield_d = "";
   }
}
$mon_ac_d = round($mon_ac);
$ac_flat_d = round($ac_flat);


//echo "AC_text = $AC_text";
$ac_flat_d = round($ac_flat_d,0          );

$htmlpBlock .= wrapHTMLHighlight("AC") . $mon_ac_d . ", Touch " . $ac_touch . ", flat footed " . $ac_flat_d;

$print .= "AC: " . $mon_ac_d . " " . $magic_armour_d . " " . $mon_armour . ", " . $magic_shield_d . " " . $mon_shield . " $AC_text\n";

$htmlpBlock .= " (" . $magic_armour_d . " " . $mon_armour . ", " . $magic_shield_d . " " . $mon_shield . ") $AC_text";

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


if ($ac_desc != ""){
  $print .= "(" . $ac_desc .  ") \n";

  $htmlp .= wrapHTMLBlock("(" . $ac_desc .  ")");

}

$print .=  "AC flat footed :" . $ac_flat . ", Touch: " . $ac_touch . " \n";
//$htmlp .=  "AC flat footed :" . $ac_flat . ", Touch: " . $ac_touch . "</BR>";

$print .= "hp " . $total_hps. " ("  . $total_hd . ");" . $print_hp . "\n";

$htmlpBlock .= wrapHTMLHighlight("hp") . $total_hps. " ("  . $total_hd . ");" . $print_hp ;
$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


if ($total_fort_sv >= 0){
 $print .= "Saves: Fort +" . $total_fort_sv;
 $htmlpBlock .= wrapHTMLhighlight("Fort"). "+" . $total_fort_sv;
}else{
  $print .= "Saves: Fort " . $total_fort_sv;
  $htmlpBlock .= wrapHTMLhighlight("Fort") . $total_fort_sv;
}

if ($total_reflex_sv >= 0){
  $print .= ", Ref +" . $total_reflex_sv;
  $htmlpBlock .= ", ".wrapHTMLHighlight("Ref")." +" . $total_reflex_sv;
}else{
  $print .= ", Ref " . $total_reflex_sv;
  $htmlpBlock .= ", ".wrapHTMLHighlight("Ref") . $total_reflex_sv;
}
if ($total_will_sv >= 0){
  $print .= ", Will +" . $total_will_sv;
  $htmlpBlock .= ", ".wrapHTMLHighlight("Will")." +" . $total_will_sv;
}else{
  $print .= ", Will " . $total_will_sv;
  $htmlpBlock .= ", ".wrapHTMLHighlight("Will") . $total_will_sv;
}
$print .= " $save_text";
$htmlpBlock .= " $save_text";

$print .= "\n";

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


if ($print_def != ""){
   $print .= "Defensive Abilities " . $print_def;
   if ($htmlp_def ==""){
      $htmlp .= wrapHTMLHighlight("Defensive Abilities") ." ". $print_def;
   }else{
      $htmlp .= $htmlp_def;
   }
}

$print .= "\n \n"  . "OFFENSE " . "\n";
//$htmlp .= "</BR>"  . "<i><u>OFFENSE</u></i>" ;

$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("OFFENSE"));
$htmlpBlock = "";

//$htmlp .= "</BR>";
if (isset($mon_speed_swim)){
}else{
   $mon_speed_swim = "";
}
if (isset($mon_speed_fly)){
}else{
   $mon_speed_fly = "";
}
if (isset($mon_speed_climb)){
}else{
   $mon_speed_climb = "";
}
if (isset($mon_speed_burrow)){
}else{
   $mon_speed_burrow = "";
}
//echo "Speed $speed_land ";
$print .=  "Speed: " . $speed_land . "ft.";

$htmlpBlock .=  wrapHTMLHighlight("Speed ") . $speed_land;

if ($mon_speed_fly != "0" and $mon_speed_fly != ""){
    $print .=  ", fly " . $mon_speed_fly;
    $htmlpBlock .=  ", fly " . $mon_speed_fly . "ft.";
}
if ($mon_speed_swim != "0" and $mon_speed_swim != ""){
    $print .=  ", swim " . $mon_speed_swim;
    $htmlpBlock .=  ", swim " . $mon_speed_swim. "ft.";
}
if ($mon_speed_climb != "0" and $mon_speed_climb != ""){
    $print .=  ", climb " . $mon_speed_climb;
    $htmlpBlock .=  ", climb " . $mon_speed_climb. "ft.";
}
if ($mon_speed_burrow != "0" and $mon_speed_burrow != ""){
    $print .=  ", burrow " . $mon_speed_burrow;
    $htmlpBlock .=  ", burrow " . $mon_speed_burrow. "ft.";
}
if ($speed_text >""){
   if ($print_speed >""){
       $print_speed .= ", " . $speed_text;
   }else{
       $print_speed = $speed_text;
   }
}
if ($print_speed != ""){
 $print .=  ", " . $print_speed;
 $htmlpBlock .=  ", " . $print_speed;
}
$print .= "\n";

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


$print .= "Melee ";
$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Melee"));

//echo "magic p = $magic_tohit_p";
if ($magic_tohit_p != 0 or $magic_damage_p != 0){

   if ($magic_damage_p == ""){
       $magic_damage_p = "0";
   }
   if (substr($magic_tohit_p,0,1) == "+"){
     $magic_p = "(" . $magic_tohit_p . "/" . $magic_damage_p . ") ";
   }else{
     $magic_p = "(+" . $magic_tohit_p . "/+" . $magic_damage_p . ") ";
   }
}else{
  $magic_p = " ";
}
//echo "s1 = $magic_tohit_s1  ";
if ($magic_tohit_s1 != 0 or $magic_damage_s1 !=  0){
   if ($magic_damage_s1 == ""){
       $magic_damage_s1 = "0";
   }
   if (substr($magic_tohit_s1,0,1) == "+"){
     $magic_s1 = "(" . $magic_tohit_s1 . "/" . $magic_damage_s1 . ") ";
   }else{
     $magic_s1 = "(+" . $magic_tohit_s1 . "/+" . $magic_damage_s1 . ") ";
   }
}else{
  $magic_s1 = " ";
}
if ($magic_tohit_r != 0 or $magic_damage_r != 0){
  if ($magic_damage_r == ""){
       $magic_damage_r = "0";
   }
  if (substr($magic_tohit_r,0,1) == "+"){
   $magic_r = "(" . $magic_tohit_r . "/" . $magic_damage_r . ") ";
  }else{
   $magic_r = "(+" . $magic_tohit_r . "/+" . $magic_damage_r . ") ";
  }
}else{
   $magic_r = " ";
}

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
if (substr($single_attack,0,1) == "-"){
    $print .= "Attack +" . $magic_p . $mon_weap_p . " " . $single_attack .  " (" . $damage_p . $crit_txt_p . ") $magic_WEAPONA_SPEC_1  \n";
    $htmlpBlock .= wrapHTMLHighlight("Single Attack ") . $magic_p . $mon_weap_p ." " . $single_attack . " (" . $damage_p . $crit_txt_p . ") $magic_WEAPONA_SPEC_1";
}else{
    $print .= "Attack +" . $magic_p . $mon_weap_p . " +" . $single_attack .  " (" . $damage_p . $crit_txt_p . ") $magic_WEAPONA_SPEC_1  \n";
    $htmlpBlock .= wrapHTMLHighlight("Single Attack") . $magic_p . $mon_weap_p ." +" . $single_attack . " (" . $damage_p . $crit_txt_p . ") $magic_WEAPONA_SPEC_1";
}
if ($print_attack != ""){
   $htmlpBlock .= "(" . $print_attack . ")";
}

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


//echo "print $prnt_attack";
//echo "magic2 " . $magic_p;
if ($crit_ch_r != ""){
  $crit_txt_r =  " /". $crit_ch_r . "-20 X". $crit_r;
}
if ($crit_ch_r == "" or $crit_ch_r == "20"){
  if ($crit_r == 2 or $crit_r == 0 or $crit_r == ""){
   $crit_txt_r =  "";
  }else{
    $crit_txt_r =  " X". $crit_r;
  }
}

if ($mon_weap_r != "None"){
    $print .=  "    or " . $magic_r . $mon_weap_r . " +" . $single_ranged . " (" . $damage_r .  $crit_txt_r .") $magic_WEAPONR_SPEC_1 $print_ranged \n";
    $htmlpBlock .=  "    or " . $magic_r . $mon_weap_r . " +" . $single_ranged . " (" . $damage_r .  $crit_txt_r .") $magic_WEAPONR_SPEC_1 $print_ranged";
}

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


$print .= "Full attack " . $magic_p . $mon_weap_p . " +" . $full_attack .   " (" . $damage_p . $crit_txt_p . ")$magic_WEAPONP_SPEC_1 \n";
$x = formatattack();

$htmlp_attacks = printattacks();
$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Full Attack")." " . $htmlp_attacks);


if ($mon_weap_s1 != "No Melee"){
  $print .= $print_secondary_attacks . "\n";
}
if ($mon_weap_r != "None"){
    $print .=  "    or " .  $magic_r . $mon_weap_r . " +" . $ranged_attack . " (" . $damage_r . ") range " . $weap_range_r . " $magic_WEAPONR_SPEC_1  $print_ranged \n";
    $htmlpBlock .=  "    or " .  $magic_r . $mon_weap_r . " +" . $ranged_attack . " (" .  $damage_r . $crit_txt_r .") range " . $weap_range_r  ." $magic_WEAPONR_SPEC_1 $print_ranged";
}

if ($class1_tp == "Monk" or $class2_tp == "Monk") {
  $print .= "    or Flurry of blows +" . $flurry . " " . $flurry_damage ."\n";
  $htmlpBlock .= "    or Flurry of blows +" . $flurry . " " . $flurry_damage ;
}
//echo "reach text $reach_text";
if ($reach_text >""){
   if ($print_reach >""){
       $print_reach .= ", " . $reach_text;
   }else{
       $print_reach = $reach_text;
   }
}
$print .= "Space/Reach: " . $mon_space . "/" . $mon_reach ." " . $print_space . " $print_reach \n";

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

$htmlpBlock .= wrapHTMLHighlight("Space ") . $mon_space . "ft.; ".wrapHTMLHighlight("Reach")." " . $mon_reach ." " . $print_space . " $print_reach ";
$print .= "Special Attacks "  . $print_special_attacks ;

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

/** What is this doing ??? */
$htmlp_special_attacks = add_BR($htmlp_special_attacks);
$htmlp_special_attacks = str_replace("\n","</BR></div><div>",$htmlp_special_attacks);


$htmlpBlock .= wrapHTMLHighlight("Special Attacks");
$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

$htmlp .= wrapHTMLBlock($htmlp_special_attacks);

//echo "Special Attacks: "  . $htmlp_special_attacks ;
if ($print_spell_abil != "" or $htmlp_spell_abil != ""){
//   echo "spell abil " . $htmlp_spell_abil;
   $print .= $print_spell_abil . "\n";


   $htmlpBlock .=  wrapHTMLBlock(wrapHTMLHighlight("Spell-like Abilities"), "dgStatsHeading");
   $htmlp .= wrapHTMLBlock($htmlpBlock);
			$htmlpBlock = "";

			/* Strip spell abilities of BR tags and replaces with DIVs */	
			$spell_abil_array = preg_split(":</?br>:is", $htmlp_spell_abil);
			foreach ($spell_abil_array as $line) {
					$htmlpBlock .= wrapHTMLBlock($line);
			}
   $htmlp .= wrapHTMLBlock($htmlpBlock);
			$htmlpBlock = "";


}else{
   $print .= "\n";
}
if (($class1_spat != ""  or $class1_psi == "Y") or
     ($class2_spat != ""  or $class2_psi == "Y") or
     ($class3_spat != ""  or $class3_psi == "Y") or
     ($classm_spat != ""  or $classm_psi == "Y")){
    $print .= "\n Spells Known: " ."\n";
    $htmlpBlock .= wrapHTMLHighlight("Spells Known: ");
   $htmlp .= wrapHTMLBlock($htmlpBlock);
			$htmlpBlock = "";
}
if ($psi_pts > 0){
   $print .= "Power Points " . $psi_pts . "\n";
   $htmlp .= wrapHTMLBlock("Power Points " . $psi_pts);
}
//echo " class1 spat = $class1_spat";
//if (is_page(136)){
  if ($class1_spat != ""  or $class1_psi == "Y"){
   $print .= printSpells(1);

   $htmlp .= wrapHTMLBlock($spell_html_print);

  }
  if ($class2_spat != "" or $class2_psi == "Y"){
     $print .= printSpells(2);
     $htmlp .= wrapHTMLBlock($spell_html_print);
  }
  if ($class3_spat != "" or $class3_psi == "Y"){
     $print .= printSpells(3);
     $htmlp .= wrapHTMLBlock($spell_html_print);
  }
  if ($classm_spat != "" or $classm_psi == "Y"){
     $print .= printSpells("m");
     $htmlp .= wrapHTMLBlock($spell_html_print);
  }
$print .= "\n" . "STATISTICS" . "\n";

$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("STATISTICS"));

//$htmlp .= "</BR>";


//", Ref +" . $total_reflex_sv . ", Will +" . $total_will_sv . "\n";
$print .= "Str " . $mon_str . disStats("str") . ", Dex " . $mon_dex . disStats("dex") . ", Con " . $mon_con . disStats("con") .
          ", Int " . $mon_int . disStats("int") .  ", Wis " . $mon_wis . disStats("wis"). ", Cha " . $mon_chr . disStats("chr") ."\n";

$htmlpBlock .= wrapHTMLHighlight("Str ") . $mon_str . disStats("str") . ", ".wrapHTMLHighlight("Dex ") . $mon_dex . disStats("dex") . ", ".wrapHTMLHighlight("Con ") . $mon_con . disStats("con") .
          ", ".wrapHTMLHighlight("Int ") . $mon_int . disStats("int") .  ", ".wrapHTMLHighlight("Wis ") . $mon_wis . disStats("wis"). ", ".wrapHTMLHighlight("Cha ") . $mon_chr . disStats("chr") ;
$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

$print  .= "Base Attack: " . $base_attack;

$htmlpBlock  .= "<b>Base Attack</b> " . $base_attack;

if ($key_1 == "path"){
  if ($base_cmb != $base_grapple){
      $print .= " CMB> $base_cmb (grapple $base_grapple) $print_CMB  CMD $base_cmd $print_CMD" . "\n";
      $htmlpBlock .= wrapHTMLHighlight(" CMB "). "$base_cmb ;(".wrapHTMLHighlight("grapple"). " $base_grapple) $print_CMB  ;".wrapHTMLHighlight("CMD")." $base_cmd $print_CMD " ;
  }else{
     $print .= " CMB $base_cmb $print_CMB  CMD $base_cmd $print_CMD" . "\n";
     $htmlpBlock .= wrapHTMLHighlight(" CMB"). "$base_cmb $print_CMB; ".wrapHTMLHighlight("CMD"). " $base_cmd $print_CMD" ;
  }
}else{
  $htmlpBlock  .= " Grapple " . $base_grapple .  "$print_CMB $print_CMD  ";
}

$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";


$print .= "Feats: \n" . $print_feat . "\n";

//$htmlp_feat = add_BR($htmlp_feat);

$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Feats"));

/* Strip BR tags and replaces with DIVs */	
$htmlp_feat_array = preg_split(":</?br>:is", $htmlp_feat);
foreach ($htmlp_feat_array as $line) {
	$htmlpBlock .= wrapHTMLBlock($line);
}
$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";
			
$print .= "Skills " . $print_skill . "\n";
$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Skills ") . $htmlp_skill ) ;

$print .= "Languages: " . $monlang1;

$htmlpBlock .= wrapHTMLHighlight("Languages ") . $monlang1;
$count = 1;
while ($count < 6){
  $count += 1;
  $monlang_r = "monlang" . $count;
  if ($$monlang_r != ""){
     $print .= ", " . $$monlang_r;
     $htmlpBlock .= ", " . $$monlang_r;
//    echo $monlang_r . $$monlang_r;
  }
}
$htmlp .= wrapHTMLBlock($htmlpBlock);
$htmlpBlock = "";

$print .= "\n";

$print .= "\n" . "ECOLOGY" ."\n";
//$htmlp .= "</BR><i><u>" . "ECOLOGY" ."</u></i>";

$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("ECOLOGY"));
$htmlpBlock = "";

//$htmlp .= "</BR>";

//if ($key_1 == "path"){

//}else{
//  $print .= "Feats: " . $print_feat . "\n";
//}
$x = print_ecology();
$print .= "Alignment " . $mon_alignment . "\n";
//$htmlp .= "<b>Alignment:</b> " . $mon_alignment . "</BR>";

$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Environment ") . $mon_environment );
$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Organization ") . $html_org_desc);
$htmlp .= wrapHTMLBlock(wrapHTMLHighlight("Treasure ") . $html_treas_desc) ;

if ($htmlp_special_qualities !="" or $print_specdesc !=""){
   $print .= "\n SPECIAL ABILITIES \n " . $print_special_qualities . "\n" ;
   $htmlp .= wrapHTMLBlock(wrapHTMLHighlight("SPECIAL ABILITIES"));

//   $htmlp_special_qualities = add_BR($htmlp_special_qualities);
//   $htmlp .= $htmlp_special_qualities  ;

		/* Strip BR tags and replaces with DIVs */	
		$htmlp_special_qualities_array = preg_split(":</?br>:is", $htmlp_special_qualities);
		foreach ($htmlp_special_qualities_array as $line) {
			$htmlpBlock .= wrapHTMLBlock($line);
		}
		$htmlp .= wrapHTMLBlock($htmlpBlock);
		$htmlpBlock = "";
		
}


if ($print_specdesc != ""){

/*   $print_specdesc = str_replace("\n","</BR></div><div>",$print_specdesc);
//   $print_specdesc = str_replace("\r","</BR>",$print_specdesc);
   $print_specdesc = str_replace("\'","",$print_specdesc);

   $htmlp .= $print_specdesc;
*/

//var_dump($print_specdesc);

		$htmlp .= wrapHTMLBlock($print_specdesc,"dgSpecDesc");
		$htmlpBlock = "";

}
   if ($print_buff != ""){
     $print .=  "Buffing spells pre-cast: \n" . $print_buff;

     $htmlp .=  wrapHTMLBlock(wrapHTMLHighlight("Buffing spells pre-cast:"));
				 $htmlp .= wrapHTMLBlock($htmlp_buff,"dgSpellsPreBuff");
   }


/*   *******   SHITTY CODE  AHEAD   *******  */
/*  The printMagic function sets globals!!!! for the magic_html_print and others */
//$print .= printMagic();

//$htmlp .= wrapHTMLBlock(urlencode($magic_html_print), "dgMagicPrint");

$magicItems = getMagicItems();


$htmlp .= "  MAGIC ITEMS HERE !!!!! ";
$htmlp .= var_export($magicItems,1);

$htmlp .= wrapHTMLblock(wrapHTMLHighlight("Magic Items (Max Value = ".$magicItems['Max Value']));

foreach ($magicItems as $magicType) {

	$htmlpSuperBlock = "";

	foreach ($magicType as $magicItem) {
		if ( isset($magicItem['magic_item'])) {
	
		 $htmlpBlock = "";
			$htmlpBlock .= wrapHTMLHighlight($magicItem['magic_item'],"dgMagicItemName");	
		
			if (isset($magicItem['magic_desc'] ) ) {
					$htmlpBlock .= wrapHTMLHighlight($magicItem['magic_desc'],"dgMagicItemDescription");	
			}
			$htmlpSuperBlock .= wrapHTMLblock($htmlpBlock);
				
		}
		if ( isset($htmlpSuperBlock)) {
			$htmlp .= wrapHTMLBlock($htmlpSuperBlock,"dgMagicItemType");

		}

	}

}


$htmlp .= wrapHTMLblock(wrapHTMLHighlight("Total Value = ".$magicItems['Total Value']));


$update  = "UPDATE lastmon SET lastmon_mon_name = '$mon_name', lastmon_class1_tp = '$class1_tp', lastmon_class1_level = '$class1_level', " .
      "lastmon_class1_focus = '$class1_focus', lastmon_class2_tp = '$class2_tp', lastmon_class2_level = '$class2_level', lastmon_class2_focus = '$class2_focus', " .
      "lastmon_text = '$print'  WHERE lastmon_count = '$oldmon_key'";
$link = getDBLink();
$result3 = mysqli_query($link, $update) ;
$_SESSION['sprint'] = $print;
$local =  $_SERVER['SERVER_NAME'];
//  <-- CT 29/11/08
$local .= dirname($_SERVER['PHP_SELF'] ); 		// Append the current path
//  END -->
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location = 'http://' . $local . '/dddismon.php';
}else{
   $location =  'http://' . $local . '/dddismon.php';
}
?>
<?php
?>
<?php
//echo $_SERVER['HTTP_USER_AGENT'];
//if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT'])) {
  $location = "javascript:history.go(-1)";
//}else{
  $location = "javascript:history.go(-1)";
//}


?>
<!-- pathdisMonsterPrint monsterPlainText  -->
<div class="monsterPlainText">
<div class="monsterPlainTextStats">

<?php  echo $htmlp ?>

<div class="monsterPlainTextNotes">
<p>
<b>Descriptions/Notes</b>
</p>
<?php
$line_count = 0;
$save_len = strlen($savemon_desc);
$line_len = round(($save_len / 60),0);
$lines = stripos($savemon_desc,"\n") ;
$desc = $savemon_desc;
while ($lines > 0 and $lines == TRUE){
   $line_count +=1;
   $desc = substr($desc, ($lines + 1), $save_len);
   $lines = stripos($desc,"\n");
}
// echo "lines $line_count $line_len" ;
$rows = $line_count + $line_len + 1;
?>
<TEXTAREA NAME="savemon_desc" class="desc" ROWS="<?php echo $rows?>" COLS="60" readonly><?php echo $savemon_desc ?> </TEXTAREA>
</div>

<!-- pathdisMonster - monsterPlainTextStats END -->
</div>

<?php
if (!isset($print_indx)){
    $print_indx = "";
}
?>

<div class="monsterPlainTextOptions">
        <INPUT TYPE="hidden" NAME="print", VALUE="<?php echo $print?>"/>
        <INPUT TYPE="hidden" NAME="mon_print", VALUE="<?php echo $print?>"/>
        <INPUT TYPE="hidden" NAME="print_indx", VALUE="<?php echo $print_indx?>"/>
				<INPUT class="button noPrint" TYPE="button" VALUE="Return" onClick="location.href='<?php echo $location?>'"/>
</div>

</div>
<!-- pathdisMonsterPrint monsterPlainText END -->