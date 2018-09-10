<<<<<<< HEAD
<?php
//$includePath = "/usr/share/wordpress2.7/wp-content/themes/dinglesgames/";
//$includePathLocal = $includePath."tools/MonsterGenerator/dnd35";
// Get standard functions
//require $includePathLocal."/ddmonsterFunctions.php";

// require "./ddInit.php";
//echo "HERE";
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
//   echo "user = $user" ;
}else{

//   <P><A HREF="ddselmon.php">Monster Generator</A>

}
// echo "class2_spell_level $class2_spell_level"  ;
$savemon_camp_s = $savemon_camp;
$savemon_sub_s = $savemon_sub;
$savemon_name_s = $savemon_name;
//echo $savemon_name;
foreach ($_POST  as $k => $v) {
//       $v = trim($v) ;
       $$k = $v ;
}
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
if (is_page(199)){
  $savemon_camp = $savemon_camp_s;
  $savemon_sub = $savemon_sub_s;
  $savemon_name = $savemon_name_s;
}
// $print = $mon_print;
if ($savemon_camp != "" or $savemon_sub != ""){
   $print = "Name:" . $savemon_name . " (" . $savemon_camp . "/" . $savemon_sub . ")" .  "\n";
}else{
    $print = "Name:" . $savemon_name . "\n";
}

$print .=  $mon_name . " (" . $mon_size . " " . $mon_type . ")" ;
if ($mon_temp !=""){
   $print .= " $mon_temp \n";
}else{
   $print .= "\n";
}
$print .=  $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus . "\n";

if ($domain_11 != "" ){
  if ($class1_tp != "Wizard"){
     $print .= "(Domains  $domain_11 and $domain_12) ";
   }else{
      $print .=  "(School $domain_11  Prohibited  $domain_12 , $domain_13)";
   }
   $print .= "\n";
}
if (isset($class2_tp)){
}else{
   $class2_tp = "";
}
if (isset($class3_tp)){
}else{
   $class3_tp = "";
}
if ($class2_tp != ""){
     $print .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus . "\n";
     if ($domain_21 != "" ){
        if ($class2_tp != "Wizard"){
          $print .= "(Domains  $domain_21 and $domain_22)";
       }else{
          $print .=  "(School $domain_21  Prohibited  $domain_22 , $domain_23)";
      }
      $print .= "\n";
    }
}
if ($class3_tp != ""){
     $print .=  $class3_tp . " level " . $class3_level . " (skill points " . $class3_skill_points  . ") " . $class3_focus . "\n";
     if ($domain_31 != "" ){
        if ($class3_tp != "Wizard"){
          $print .= "(Domains  $domain_31 and $domain_32)";
       }else{
          $print .=  "(School $domain_31  Prohibited  $domain_32 , $domain_33)";
      }
      $print .= "\n";
    }
}
$print .= "Hit die: " . $total_hd . "(" .$total_hps . "hp)" . "\n" .
          "Init: " . $init . "\n" .
          "Speed: " . $speed_land;
if (($mon_speed_fly != "0" or $mon_speed_climb != "0" or $mon_speed_swim != "0" or $mon_speed_burrow != "0") and
	    ($mon_speed_fly != "" or $mon_speed_climb != "" or $mon_speed_swim != "" or $mon_speed_burrow != "")) {
   $print .=  ",fly " . $mon_speed_fly . ",swim " . $mon_speed_swim . ",climb " . $mon_speed_climb . ",burrow " . $mon_speed_burrow . "\n";
}else{
  $print .= "\n";
}
if (substr($magic_armour,0,1) == "+"){
   $print .= "AC: " . $mon_ac . " " . $magic_armour . " " . $mon_armour . ", " . $magic_shield . " " . $mon_shield . "\n";
}else{
   $print .= "AC: " . $mon_ac . " +" . $magic_armour . " " . $mon_armour . ", +" . $magic_shield . " " . $mon_shield . "\n";
}
if ($ac_desc != ""){
  $print .= "(" . $ac_desc .  ") \n";
}

$print .=  "AC flat footed :" . $ac_flat . "\n";
$print .= "AC Touch: " . $ac_touch . "\n";
$print  .= "Base Attack/Grapple: " . $base_attack . "/" . $base_grapple . "\n";
if ($key_1 == "path"){
  $print .= "CMB $base_cmb  CMD $base_cmd" . "\n";
}
if ($magic_tohit_p != "" or $magic_damage_p != ""){
   if (substr($magic_tohit_p,0,1) == "+"){
     $magic_p = "(" . $magic_tohit_p . "/" . $magic_damage_p . ") ";
   }else{
     $magic_p = "(+" . $magic_tohit_p . "/+" . $magic_damage_p . ") ";
   }
}else{
  $magic_p = " ";
}
if ($magic_tohit_r != "" or $magic_damage_r != ""){
  if (substr($magic_tohit_r,0,1) == "+"){
   $magic_r = "(" . $magic_tohit_r . "/" . $magic_damage_r . ") ";
  }else{
   $magic_r = "(+" . $magic_tohit_r . "/+" . $magic_damage_r . ") ";
  }
}else{
   $magic_r = " ";
}
if ($crit_ch_p != "" and $crit_ch_p != "20"){
  $crit_txt_p =  " Crit(". $crit_ch_p . "-20)X". $crit_p;
}
$print .= "Attack: +" . $single_attack . " " . $magic_p . $mon_weap_p . " " . $damage_p . $crit_txt_p . "\n";
if ($crit_ch_r != "" and $crit_ch_r != "20"){
  $crit_txt_r =  " Crit(". $crit_ch_r . "-20)X". $crit_r;
}
if ($mon_weap_r != "None"){
    $print .=  "    or  +" . $single_ranged . " " . $magic_r . $mon_weap_r . " " . $damage_r .  $crit_txt_r ."\n";
}
$print .= "Full attack: +" . $full_attack . " "  . $magic_p . $mon_weap_p . " " . $damage_p . $crit_txt_p . "\n";
if ($mon_weap_s1 != "No Melee"){
   $print .= $print_secondary_attacks . "\n";
}
if ($mon_weap_r != "None"){
    $print .=  "    or  +" . $ranged_attack . " " . $magic_r . $mon_weap_r . " " . $damage_r . "(range " . $weap_range_r .")"  ."\n";
}
if ($class1_tp == "Monk" or $class2_tp == "Monk") {
  $print .= "    or Flurry of blows +" . $flurry . " " . $flurry_damage ."\n";
}
$print .= "Space/Reach: " . $mon_space . "/" . $mon_reach . "\n";
$print .= "Special Attacks: "  . $print_special_attacks . "\n";
$print .= "Special Qualities: " . $print_special_qualities . "\n";
if ($total_fort_sv >= 0){
 $print .= "Saves: Fort +" . $total_fort_sv;
}else{
  $print .= "Saves: Fort " . $total_fort_sv;
}
if ($total_reflex_sv >= 0){
  $print .= ", Ref +" . $total_reflex_sv;
}else{
  $print .= ", Ref " . $total_reflex_sv;
}
if ($total_will_sv >= 0){
  $print .= ", Will +" . $total_will_sv . "\n";
}else{
  $print .= ", Will " . $total_will_sv . "\n";
}

//", Ref +" . $total_reflex_sv . ", Will +" . $total_will_sv . "\n";
$print .= "Abilities: Str " . $mon_str . disStats("str") . ", Dex " . $mon_dex . disStats("dex") . ", Con " . $mon_con . disStats("con") .
          ", Int " . $mon_int . disStats("int") .  ", Wis " . $mon_wis . disStats("wis"). ", Chr " . $mon_chr . disStats("chr") ."\n";
$print .= "Skills: " . $print_skill . "\n";
$print .= "Languages: " . $monlang1;
$count = 1;
while ($count < 6){
  $count += 1;
  $monlang_r = "monlang" . $count;
  if ($$monlang_r != ""){
     $print .= ", " . $$monlang_r;
  }
}
$print .= "\n";
//if ($key_1 == "path"){
$print .= "Feats: \n" . $print_feat . "\n";
//}else{
//  $print .= "Feats: " . $print_feat . "\n";
//}

$print .= "Alignment: " . $mon_alignment . "\n";
$print .=  "CR: " . $cr . "\n";
//if ($psi_cmb > 0){
//   $print .= print_psi_combat();
//}
//$print .= "Class Specials: " . $print_class_special . "\n";
$print .= "Spells Known: " ."\n";
if (isset($psi_pts)){
}else{
   $psi_pts = "";
}
if ($psi_pts > 0){
   $print .= "Power Points " . $psi_pts . "\n";
}
if (isset($class1_spat)){
}else{
   $class1_spat = "";
}
if (isset($class2_spat)){
}else{
   $class2_spat = "";
}
if (isset($class3_spat)){
}else{
   $class3_spat = "";
}
if (isset($classm_spat)){
}else{
   $classm_spat = "";
}
if (isset($class1_psi)){
}else{
   $class1_psi = "";
}
if (isset($class2_psi)){
}else{
   $class2_psi = "";
}
if (isset($class3_psi)){
}else{
   $class3_psi = "";
}
if (isset($classm_psi)){
}else{
   $classm_psi = "";
}
//echo $class1_spat;
//if (is_page(136)){
  if ($class1_spat != ""  or $class1_psi == "Y"){
   $print .= printSpells(1);
  }
  if ($class2_spat != "" or $class2_psi == "Y"){
     $print .= printSpells(2);
  }
  if ($class3_spat != "" or $class3_psi == "Y"){
     $print .= printSpells(3);
  }
  if ($classm_spat != "" or $classm_psi == "Y"){
     $print .= printSpells("m");
  }
  //don't print buffering spells if comming from encouter gernerator
  if (is_page(203)){
  }else{
    if ($print_buff != ""){
      $print .=  "Buffing spells pre-cast: \n" . $print_buff;
    }
  }


//}else{
//   $print .= "Spells: ". $print_spell ."\n";
//}
//magic items
//if (is_page (136)){
 // echo "<P>magic_armour_1 $magic_ARMOUR_1</P>";
  $print .= printMagic();
//}
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

		<!-- Define Local CSS -->
		<LINK href="./local.css" rel="stylesheet" type="text/css" media="all">
		<!-- Define CSS for stats-->
		<LINK href="./style-statsBlock.css" rel="stylesheet" type="text/css" media="all">
		<!-- END CSS Set Up -->
<STYLE type="text/css">
<!--
.monPrint {
	border: 1px solid #CCCCCC;
        height: 1500px;
       	width: 750px;
}
-->
</STYLE>

<?php

//echo $_SERVER['HTTP_USER_AGENT'];
//if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT'])) {
//  $location = "javascript:history.go(-1)";
//}else{
  $location = "javascript:history.go(-1)";
//}




//	<BODY>
//		<div id="titleBanner">
//	</div>
//  	<div id="content">

?>


                	<div class="noPrint">
				<h1>D&D 3.5 Monster Generator</h1>

				<h2>Plain Text Version</h2>
<?php
//include 'advert.php';
?>
	                </div>

<p>
<TEXTAREA class="monPrint" Name="monPrint">
<?php echo $print ?> </TEXTAREA>
</p>
 <INPUT TYPE="hidden" NAME="print", VALUE="<?php echo $print?>"/>
        <INPUT TYPE="hidden" NAME="print_indx", VALUE="<?php echo $print_indx?>"/>
        <INPUT TYPE="hidden" NAME="mon_print", VALUE="<? php echo $print?>"/>
	<INPUT class="button noPrint" TYPE="button" VALUE="Return" onClick="location.href='<?php echo $location?>'"/>
<?php
//include 'paypal.php';
?>

















=======
<?php
//$includePath = "/usr/share/wordpress2.7/wp-content/themes/dinglesgames/";
//$includePathLocal = $includePath."tools/MonsterGenerator/dnd35";
// Get standard functions
//require $includePathLocal."/ddmonsterFunctions.php";

// require "./ddInit.php";
//echo "HERE";

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
//   echo "user = $user" ;
}else{

//   <P><A HREF="ddselmon.php">Monster Generator</A>

}

$savemon_camp_s = $savemon_camp;
$savemon_sub_s = $savemon_sub;
$savemon_name_s = $savemon_name;
//echo $savemon_name;
foreach ($_POST  as $k => $v) {
//       $v = trim($v) ;
       $$k = $v ;
}
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
if (is_page(199)){
  $savemon_camp = $savemon_camp_s;
  $savemon_sub = $savemon_sub_s;
  $savemon_name = $savemon_name_s;
}
// $print = $mon_print;
if ($savemon_camp != "" or $savemon_sub != ""){
   $print = "Name:" . $savemon_name . " (" . $savemon_camp . "/" . $savemon_sub . ")" .  "\n";
}else{
    $print = "Name:" . $savemon_name . "\n";
}

$print .=  $mon_name . " (" . $mon_size . " " . $mon_type . ")" ;
if ($mon_temp !=""){
   $print .= " $mon_temp \n";
}else{
   $print .= "\n";
}
$print .=  $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus . "\n";

if ($domain_11 != "" ){
  if ($class1_tp != "Wizard"){
     $print .= "(Domains  $domain_11 and $domain_12) ";
   }else{
      $print .=  "(School $domain_11  Prohibited  $domain_12 , $domain_13)";
   }
   $print .= "\n";
}
if (isset($class2_tp)){
}else{
   $class2_tp = "";
}
if (isset($class3_tp)){
}else{
   $class3_tp = "";
}
if ($class2_tp != ""){
     $print .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus . "\n";
     if ($domain_21 != "" ){
        if ($class2_tp != "Wizard"){
          $print .= "(Domains  $domain_21 and $domain_22)";
       }else{
          $print .=  "(School $domain_21  Prohibited  $domain_22 , $domain_23)";
      }
      $print .= "\n";
    }
}
if ($class3_tp != ""){
     $print .=  $class3_tp . " level " . $class3_level . " (skill points " . $class3_skill_points  . ") " . $class3_focus . "\n";
     if ($domain_31 != "" ){
        if ($class3_tp != "Wizard"){
          $print .= "(Domains  $domain_31 and $domain_32)";
       }else{
          $print .=  "(School $domain_31  Prohibited  $domain_32 , $domain_33)";
      }
      $print .= "\n";
    }
}
$print .= "Hit die: " . $total_hd . "(" .$total_hps . "hp)" . "\n" .
          "Init: " . $init . "\n" .
          "Speed: " . $speed_land;
if (($mon_speed_fly != "0" or $mon_speed_climb != "0" or $mon_speed_swim != "0" or $mon_speed_burrow != "0") and
	    ($mon_speed_fly != "" or $mon_speed_climb != "" or $mon_speed_swim != "" or $mon_speed_burrow != "")) {
   $print .=  ",fly " . $mon_speed_fly . ",swim " . $mon_speed_swim . ",climb " . $mon_speed_climb . ",burrow " . $mon_speed_burrow . "\n";
}else{
  $print .= "\n";
}
if (substr($magic_armour,0,1) == "+"){
   $print .= "AC: " . $mon_ac . " " . $magic_armour . " " . $mon_armour . ", " . $magic_shield . " " . $mon_shield . "\n";
}else{
   $print .= "AC: " . $mon_ac . " +" . $magic_armour . " " . $mon_armour . ", +" . $magic_shield . " " . $mon_shield . "\n";
}
if ($ac_desc != ""){
  $print .= "(" . $ac_desc .  ") \n";
}

$print .=  "AC flat footed :" . $ac_flat . "\n";
$print .= "AC Touch: " . $ac_touch . "\n";
$print  .= "Base Attack/Grapple: " . $base_attack . "/" . $base_grapple . "\n";
if ($key_1 == "path"){
  $print .= "CMB $base_cmb  CMD $base_cmd" . "\n";
}
if ($magic_tohit_p != "" or $magic_damage_p != ""){
   if (substr($magic_tohit_p,0,1) == "+"){
     $magic_p = "(" . $magic_tohit_p . "/" . $magic_damage_p . ") ";
   }else{
     $magic_p = "(+" . $magic_tohit_p . "/+" . $magic_damage_p . ") ";
   }
}else{
  $magic_p = " ";
}
if ($magic_tohit_r != "" or $magic_damage_r != ""){
  if (substr($magic_tohit_r,0,1) == "+"){
   $magic_r = "(" . $magic_tohit_r . "/" . $magic_damage_r . ") ";
  }else{
   $magic_r = "(+" . $magic_tohit_r . "/+" . $magic_damage_r . ") ";
  }
}else{
   $magic_r = " ";
}
if ($crit_ch_p != ""){
  $crit_txt_p =  " Crit(". $crit_ch_p . "-20)X". $crit_p;
}
$print .= "Attack: +" . $single_attack . " " . $magic_p . $mon_weap_p . " " . $damage_p . $crit_txt_p . "\n";
if ($crit_ch_r != ""){
  $crit_txt_r =  " Crit(". $crit_ch_r . "-20)X". $crit_r;
}
if ($mon_weap_r != "None"){
    $print .=  "    or  +" . $single_ranged . " " . $magic_r . $mon_weap_r . " " . $damage_r .  $crit_txt_r ."\n";
}
$print .= "Full attack: +" . $full_attack . " "  . $magic_p . $mon_weap_p . " " . $damage_p . "\n";
if ($mon_weap_s1 != "No Melee"){
   $print .= $print_secondary_attacks . "\n";
}
if ($mon_weap_r != "None"){
    $print .=  "    or  +" . $ranged_attack . " " . $magic_r . $mon_weap_r . " " . $damage_r . "(range " . $weap_range_r .")"  ."\n";
}
if ($class1_tp == "Monk" or $class2_tp == "Monk") {
  $print .= "    or Flurry of blows +" . $flurry . " " . $flurry_damage ."\n";
}
$print .= "Space/Reach: " . $mon_space . "/" . $mon_reach . "\n";
$print .= "Special Attacks: "  . $print_special_attacks . "\n";
$print .= "Special Qualities: " . $print_special_qualities . "\n";
if ($total_fort_sv >= 0){
 $print .= "Saves: Fort +" . $total_fort_sv;
}else{
  $print .= "Saves: Fort " . $total_fort_sv;
}
if ($total_reflex_sv >= 0){
  $print .= ", Ref +" . $total_reflex_sv;
}else{
  $print .= ", Ref " . $total_reflex_sv;
}
if ($total_will_sv >= 0){
  $print .= ", Will +" . $total_will_sv . "\n";
}else{
  $print .= ", Will " . $total_will_sv . "\n";
}

//", Ref +" . $total_reflex_sv . ", Will +" . $total_will_sv . "\n";
$print .= "Abilities: Str " . $mon_str . disStats("str") . ", Dex " . $mon_dex . disStats("dex") . ", Con " . $mon_con . disStats("con") .
          ", Int " . $mon_int . disStats("int") .  ", Wis " . $mon_wis . disStats("wis"). ", Chr " . $mon_chr . disStats("chr") ."\n";
$print .= "Skills: " . $print_skill . "\n";
$print .= "Languages: " . $monlang1;
$count = 1;
while ($count < 6){
  $count += 1;
  $monlang_r = "monlang" . $count;
  if ($$monlang_r != ""){
     $print .= ", " . $$monlang_r;
  }
}
$print .= "\n";
//if ($key_1 == "path"){
$print .= "Feats: \n" . $print_feat . "\n";
//}else{
//  $print .= "Feats: " . $print_feat . "\n";
//}

$print .= "Alignment: " . $mon_alignment . "\n";
$print .=  "CR: " . $cr . "\n";
//if ($psi_cmb > 0){
//   $print .= print_psi_combat();
//}
//$print .= "Class Specials: " . $print_class_special . "\n";
$print .= "Spells Known: " ."\n";
if (isset($psi_pts)){
}else{
   $psi_pts = "";
}
if ($psi_pts > 0){
   $print .= "Power Points " . $psi_pts . "\n";
}
if (isset($class1_spat)){
}else{
   $class1_spat = "";
}
if (isset($class2_spat)){
}else{
   $class2_spat = "";
}
if (isset($class3_spat)){
}else{
   $class3_spat = "";
}
if (isset($classm_spat)){
}else{
   $classm_spat = "";
}
if (isset($class1_psi)){
}else{
   $class1_psi = "";
}
if (isset($class2_psi)){
}else{
   $class2_psi = "";
}
if (isset($class3_psi)){
}else{
   $class3_psi = "";
}
if (isset($classm_psi)){
}else{
   $classm_psi = "";
}
//echo $class1_spat;
//if (is_page(136)){
  if ($class1_spat != ""  or $class1_psi == "Y"){
   $print .= printSpells(1);
  }
  if ($class2_spat != "" or $class2_psi == "Y"){
     $print .= printSpells(2);
  }
  if ($class3_spat != "" or $class3_psi == "Y"){
     $print .= printSpells(3);
  }
  if ($classm_spat != "" or $classm_psi == "Y"){
     $print .= printSpells("m");
  }
  //don't print buffering spells if comming from encouter gernerator
  if (is_page(203)){
  }else{
    if ($print_buff != ""){
      $print .=  "Buffing spells pre-cast: \n" . $print_buff;
    }
  }


//}else{
//   $print .= "Spells: ". $print_spell ."\n";
//}
//magic items
//if (is_page (136)){
  $print .= printMagic();
//}
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

		<!-- Define Local CSS -->
		<LINK href="./local.css" rel="stylesheet" type="text/css" media="all">
		<!-- Define CSS for stats-->
		<LINK href="./style-statsBlock.css" rel="stylesheet" type="text/css" media="all">
		<!-- END CSS Set Up -->
<STYLE type="text/css">
<!--
.monPrint {
	border: 1px solid #CCCCCC;
        height: 1500px;
       	width: 750px;
}
-->
</STYLE>

<?php

//echo $_SERVER['HTTP_USER_AGENT'];
//if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT'])) {
//  $location = "javascript:history.go(-1)";
//}else{
  $location = "javascript:history.go(-1)";
//}




//	<BODY>
//		<div id="titleBanner">
//	</div>
//  	<div id="content">

?>


                	<div class="noPrint">
				<h1>D&D 3.5 Monster Generator</h1>

				<h2>Plain Text Version</h2>
<?php
//include 'advert.php';
?>
	                </div>

<TABLE BORDER="1" CELLPADDING="1">
<BR>
<TR>
<TD><TEXTAREA class="monPrint" Name="monPrint">
<?php echo $print ?> </TEXTAREA>
</TR>
</TABLE>
        <INPUT TYPE="hidden" NAME="print", VALUE="<?php echo $print?>"/>
        <INPUT TYPE="hidden" NAME="print_indx", VALUE="<?php echo $print_indx?>"/>
        <INPUT TYPE="hidden" NAME="mon_print", VALUE="<? php echo $print?>"/>
	<INPUT class="button noPrint" TYPE="button" VALUE="Return" onClick="location.href='<?php echo $location?>'"/>



<?php
//include 'paypal.php';
?>

















>>>>>>> 65450b134015a9177e74559b90657752af789db3
