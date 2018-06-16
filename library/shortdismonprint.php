<?
//$includePath = "/usr/share/wordpress2.7/wp-content/themes/dinglesgames/";
//$includePathLocal = $includePath."tools/MonsterGenerator/dnd35";
// Get standard functions
//require $includePathLocal."/ddmonsterFunctions.php";

// require "./ddInit.php";

/* CT TEMP  - Added to stop undef errors */
$savemon_sub = "";
$savemon_name = "";
$htmlp = "";
$html = "";
$temp_type2 = "";
$ctit_txt_p = "";
$htmlp_secondary_attacks_s = "";
$spell_html_print_s = "";
$class1_level = "";
$class2_level = "";
$mon_alignment = "";
$mon_aligment = "";					/*  typo or correct name ? */
$tem_type2 = "";
$savemon_camp = "";
/* end */

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
//   echo "user = $user" ;
}

$savemon_camp_s = $savemon_camp;
$savemon_sub_s = $savemon_sub;
$savemon_name_s = $savemon_name;
//echo $savemon_desc;
foreach ($_POST  as $k => $v) {
//       $v = trim($v) ;
       $$k = $v ;
}
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

//echo "first key 1 $key_1";



$header = '<div style="border-top:1px solid rgb(0, 0, 0);border-bottom:1px solid rgb(0, 0, 0);margin-top:6px;margin-bottom:6px;width:100%"><font size="3">';

if ($savemon_camp != "" or $savemon_sub != ""){
   $print = "Name " . $savemon_name . " (" . $savemon_camp . "/" . $savemon_sub . ")" .  "\n";
   $htmlp .=  "</BR></BR><b>Name</b> " . $savemon_name . " (" . $savemon_camp . "/" . $savemon_sub . ")" .  "\n";
}else{
    $print = "Name " . $savemon_name . "\n";
    $htmlp .=  "</BR></BR><b>Name</b> " . $savemon_name;
}
$htmlp .=  " ";
$print .=  $mon_name . " (" . $mon_size . " " . $mon_type . ")";
if ($print_sub != ""){
   $print_sub = " " . $print_sub;
}
$htmlp .=  "<b>" . $mon_name . " ";
$class1_tp = trim($class1_tp);
$class2_tp = trim($class2_tp);
$class3_tp = trim($class3_tp);
if ($class1_tp != ""){
   $print .=  $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus . "\n";
   $htmlp .=  $class1_tp . " level " . $class1_level . " (skill points " . $class1_skill_points  . ") " . $class1_focus . "</BR>";
}
if ($domain_11 != "" ){
  if ($class1_tp == "Cleric"){
       $print .= "(Domains  $domain_11 and $domain_12) ";
       $htmlp .= "(Domains  $domain_11 and $domain_12) ";
  }else{
     if ($class1_tp == "Wizard"){
        $print .=  "(School $domain_11  Prohibited  $domain_12 , $domain_13)";
        $htmlp .=  "(School $domain_11  Prohibited  $domain_12 , $domain_13)";

     }else{
        $print .= "($domain_11 ) ";
        $htmlp .= "($domain_11 ) ";
     }
   }
   $print .= "\n";
   $htmlp .= "</BR>";
}

if ($class2_tp != ""){
     $print .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus . "\n";
     $htmlp .=  $class2_tp . " level " . $class2_level . " (skill points " . $class2_skill_points  . ") " . $class2_focus . "</BR>";

     if ($domain_21 != "" ){
        if ($class2_tp != "Wizard"){
           if ($class2 == "Cleric"){
             $print .= "(Domains  $domain_21 and $domain_22)";
             $htmlp .= "(Domains  $domain_21 and $domain_22)";
           }else{
             $print .= "($domain_21)";
             $htmlp .= "($domain_21)";
           }
       }else{
          $print .=  "(School $domain_21  Prohibited  $domain_22 , $domain_23)";
          $htmlp .=  "(School $domain_21  Prohibited  $domain_22 , $domain_23)";
      }
      $print .= "\n";
      $htmlp .= "</BR>";
    }
}
if ($class3_tp != ""){
     $print .=  $class3_tp . " level " . $class3_level . " (skill points " . $class3_skill_points  . ") " . $class3_focus . "\n";
     $htmlp .=  $class3_tp . " level " . $class3_level . " (skill points " . $class3_skill_points  . ") " . $class3_focus . "</BR>";

     if ($domain_31 != "" ){
        if ($class3_tp != "Wizard"){
          $print .= "(Domains  $domain_31 and $domain_32)";
          $htmlp .= "(Domains  $domain_31 and $domain_32)";
       }else{
          $print .=  "(School $domain_31  Prohibited  $domain_32 , $domain_33)";
          $htmlp .=  "(School $domain_31  Prohibited  $domain_32 , $domain_33)";
      }
      $print .= "\n";
      $htmlp .= "</BR>";
    }
}
$print .= "hp " . $total_hps. " ("  . $total_hd . ");" . $print_hp . "\n";
$htmlp .= " <b>hp</b> " . $total_hps. " ("  . $total_hd . "), " ;
$html .="</BR>";
$cr_total = $cr + $cr_path;
if ($cr_total > 1){
  $cr_total = round($cr_total,0);
}
$link = getDBLink();
if ($cr_total < 1){
  $select = "select level_xp from level where lev_no = 1";
  if ($result = mysqli_query($link, $select)){
    $row = mysqli_fetch_array($result);
    $xp = $row[level_xp] * $cr_total;
    $xp = round($xp,0);
  }else{
    $xp = "***";
  }
}else{
  $select = "select level_xp from level where lev_no = '$cr_total'";
  if ($result = mysqli_query($link, $select)){
    $row = mysqli_fetch_array($result);
    $xp = $row[level_xp];
  }else{
    $xp = "***";
  }
}

if ($mon_temp !=""){
   if ($mon_temp2 != ""){
       $print .=  $mon_temp . "/" . $mon_temp2 . "     CR " . $cr_total .   "\n";
       $htmlp .=  " " . $mon_temp . "/" . $mon_temp2 .  "     CR " . $cr_total .   "</b>";
   }else{
       $print .=  $mon_temp . "     CR " . $cr_total .   "\n";
       $htmlp .=  " " . $mon_temp . "     CR " . $cr_total .   "</b>";
   }
}else{
   $print .= "               CR " . $cr_total . "\n";
   $htmlp  .= "               CR " . $cr_total . "</b>";
}
$htmlp .= " ";
$print .= "XP " . $xp . "\n";
$htmlp .= "<b>XP</b> $xp, " ;
if ($tem_type != "" and ((($mon_type == 'Animal' or $mon_type == 'Vermin') and $tem_type == 'Magical beast') or $tem_type != 'Magical beast')){
   if ($tem_type2 != "" and ((($mon_type == 'Animal' or $mon_type == 'Vermin') and $tem_type2 == 'Magical beast') or $tem_type2 != 'Magical beast')){
       $htmlp .= $mon_alignment .  " " . $mon_size . " " . $mon_type . " ($tem_type $tem_type2)" . $print_sub . "</BR>";
   }else{
      $htmlp .= $mon_alignment .  " " . $mon_size . " " . $mon_type . " ($tem_type)" . $print_sub . "</BR>";
   }
}else{
echo $mon_aligment;

   if ($tem_type2 != "" and ((($mon_type == 'Animal' or $mon_type == 'Vermin') and $tem_type2 == 'Magical beast') or $tem_type2 != 'Magical beast')){ 
       $htmlp .= $mon_alignment .  " " . $mon_size . " " . $mon_type . " ($tem_type $tem_type2)" . $print_sub . "</BR>";
   }else{
      $htmlp .= $mon_alignment .  " " . $mon_size . " " . $mon_type . $print_sub . "</BR>";
   }
}

$initp = $init;
if ($init > 0){
   $initp = "+" . $init;
}
if ($init == ""){
   $initp = "0";
}
$print .=  "Init " . $initp . "; Senses " . $print_sen;
$htmlp .=  "<b>Init</b> " . $initp;
$print .=  " Speed: " . $speed_land . "ft.";
$htmlp .=  " <b>Speed</b> " . $speed_land;
if ($mon_speed_fly != "0" and $mon_speed_fly != ""){
    $print .=  ", fly " . $mon_speed_fly;
    $htmlp .=  ", fly " . $mon_speed_fly . "ft.";
}
if ($mon_speed_swim != "0" and $mon_speed_swim != ""){
    $print .=  ", swim " . $mon_speed_swim;
    $htmlp .=  ", swim " . $mon_speed_swim. "ft.";
}
if ($mon_speed_climb != "0" and $mon_speed_climb != ""){
    $print .=  ", climb " . $mon_speed_climb;
    $htmlp .=  ", climb " . $mon_speed_climb. "ft.";
}
if ($mon_speed_burrow != "0" and $mon_speed_burrow != ""){
    $print .=  ", burrow " . $mon_speed_burrow;
    $htmlp .=  ", burrow " . $mon_speed_burrow. "ft.";
}

if ($print_speed != ""){
 $print .=  ", " . $print_speed;
 $htmlp .=  ", " . $print_speed;
}

//if ($print_aura != ""){
//   $htmlp .= "<b>Aura </b>". $print_aura;
//}

//$htmlp .= "</BR><i><u>" . "DEFENSE </u></i>";
//$htmlp .= "</BR>";
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



$ac_flat_d = round($ac_flat_d,0          );
$htmlp .= " <b>AC</b> " . $mon_ac_d . ", Touch " . $ac_touch . ", flat footed " . $ac_flat_d;
$print .= "AC: " . $mon_ac_d . " " . $magic_armour_d . " " . $mon_armour . ", " . $magic_shield_d . " " . $mon_shield . " $AC_text \n";
$htmlp .= " (" . $magic_armour_d . " " . $mon_armour . ", " . $magic_shield_d . " " . $mon_shield . ") $AC_text </BR>";


if ($ac_desc != ""){
  $print .= "(" . $ac_desc .  ") \n";
  $htmlp .= "(" . $ac_desc .  ") </BR>";
}
$print .=  "AC flat footed :" . $ac_flat . ", Touch: " . $ac_touch . "\n";
//$htmlp .=  "AC flat footed :" . $ac_flat . ", Touch: " . $ac_touch . "</BR>";



//$htmlp .= "</BR>";
$print .= "\n";

$print .= "Melee ";
$htmlp .= "<b>Melee</b> ";

if ($magic_tohit_p != "" or $magic_damage_p != ""){
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
if ($magic_tohit_s1 != "" or $magic_damage_s1 != ""){
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
if ($magic_tohit_r != "" or $magic_damage_r != ""){
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
$print  .= "Base Attack: " . $base_attack;
$htmlp  .= "<b>Base Attack</b> " . $base_attack;

if ($key_1 == "path"){
  if ($base_cmb != $base_grapple){
      $print .= " CMB> $base_cmb (grapple $base_grapple)  CMD $base_cmd" . "\n";
      $htmlp .= " <b>CMB</b> $base_cmb ;(<b>grapple</b> $base_grapple)  ;<b>CMD</b> $base_cmd, ";
  }else{
     $print .= " CMB $base_cmb  CMD $base_cmd" . "\n";
     $htmlp .= " <b>CMB</b> $base_cmb;  <b>CMD</b> $base_cmd, ";
  }
}else{
  $htmlp  .= " Grapple " . $base_grapple .  ", ";
}
$print .= "Attack +" . $magic_p . $mon_weap_p . " +" . $single_attack .  " (" . $damage_p . $crit_txt_p . ")\n";
$htmlp .= " <b>Single Attack</b>" . $magic_p . $mon_weap_p ." +" . $single_attack . " (" . $damage_p . $crit_txt_p . ")";
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
    $print .=  "    or " . $magic_r . $mon_weap_r . " +" . $single_ranged . " (" . $damage_r .  $crit_txt_r .")\n";
    $htmlp .=  "    or " . $magic_r . $mon_weap_r . " +" . $single_ranged . " (" . $damage_r .  $crit_txt_r .")</BR>";

}
$print .= "Full attack " . $magic_p . $mon_weap_p . " +" . $full_attack .   " (" . $damage_p . $ctit_txt_p . ")\n";
$x = formatattack();
$htmlp_attacks = printattacks();
$htmlp .= " <b>Full Attack</b>  " . $htmlp_secondary_attacks_s ;

//$htmlp .= "<b>Full Attack:</b></BR> +" . $full_attack . " "  . $magic_p . $mon_weap_p . " " . $damage_p . $crit_txt_p ."<BR>";

if ($mon_weap_s1 != "No Melee"){
//
  $print .= $print_secondary_attacks . "\n";
//  $htmlp .= $htmlp_secondary_attacks . "</BR>";
}
if ($mon_weap_r != "None"){
    $print .=  "    or " .  $magic_r . $mon_weap_r . " +" . $ranged_attack . " (" . $damage_r . ") range " . $weap_range_r   ."\n";
    $htmlp .=  "    or " .  $magic_r . $mon_weap_r . " +" . $ranged_attack . " (" .  $damage_r . $crit_txt_r .") range " . $weap_range_r ;

}
if ($class1_tp == "Monk" or $class2_tp == "Monk") {
  $print .= "  or Flurry of blows +" . $flurry . " " . $flurry_damage ."\n";
  $htmlp .= "  or Flurry of blows +" . $flurry . " " . $flurry_damage .", ";
}

$print .= "Space/Reach: " . $mon_space . "/" . $mon_reach ." " . $print_space . "\n";
$htmlp .= "; <b>Space</b> " . $mon_space . "ft.; <b>Reach</b> " . $mon_reach ." " . $print_space . "</BR>";
$print .= "Special Attacks "  . $print_special_attacks ;
$htmlp .= " <b>SA</b> "  . $print_special_attacks_s ;
//echo "Special Attacks: "  . $htmlp_special_attacks ;
if ($print_spell_abil != "" or $htmlp_spell_abil_s != ""){
//   echo "spell abil " . $htmlp_spell_abil;
   $print .= $print_spell_abil . "\n";
   $htmlp .=  " <b>Spell-like Abilities</b> ";
   $htmlp .= $htmlp_spell_abil_s;
}else{
   $print .= "\n";
}
if ($htmlp_special_qualities_s !=""){
   $htmlp .= ", <b>SQ</b> " . $htmlp_special_qualities_s . "</BR>" ;
}


//$htmlp .= "</BR>";
if ($total_fort_sv >= 0){
 $print .= "Saves: Fort +" . $total_fort_sv;
 $htmlp .= " <b>Fort</b> +" . $total_fort_sv;
}else{
  $print .= "Saves: Fort " . $total_fort_sv;
  $htmlp .= "<b>Fort</b> " . $total_fort_sv;
}
if ($total_reflex_sv >= 0){
  $print .= ", Ref +" . $total_reflex_sv;
  $htmlp .= ", <b>Ref</b> +" . $total_reflex_sv;
}else{
  $print .= ", Ref " . $total_reflex_sv;
  $htmlp .= ", <b>Ref</b> " . $total_reflex_sv;
}
if ($total_will_sv >= 0){
  $print .= ", Will +" . $total_will_sv . "\n";
  $htmlp .= ", <b>Will</b> +" . $total_will_sv . ", " ;
}else{
  $print .= ", Will " . $total_will_sv . "\n";
  $htmlp .= ", <b>Will</b> " . $total_will_sv . ", ";
}
$htmlp .= "</BR>";

//", Ref +" . $total_reflex_sv . ", Will +" . $total_will_sv . "\n";
$print .= "Str " . $mon_str . disStats("str") . ", Dex " . $mon_dex . disStats("dex") . ", Con " . $mon_con . disStats("con") .
          ", Int " . $mon_int . disStats("int") .  ", Wis " . $mon_wis . disStats("wis"). ", Cha " . $mon_chr . disStats("chr") ."\n";
$htmlp .= "<b>Str</b> " . $mon_str . disStats("str") . ", <b>Dex</b> " . $mon_dex . disStats("dex") . ", <b>Con</b> " . $mon_con . disStats("con") .
          ", <b>Int</b> " . $mon_int . disStats("int") .  ", <b>Wis</b> " . $mon_wis . disStats("wis"). ", <b>Cha</b> " . $mon_chr . disStats("chr") ."</BR>";


$print .= "Skills " . $print_skill . "\n";
$htmlp .= "<b>Skills</b> " . $htmlp_skill  ;
$print .= "Feats: \n" . $print_feat . "\n";
$htmlp .= " <b>Feats: </b> " . $htmlp_feat_s ;

$print .= "Languages: " . $monlang1;
$htmlp .= "<b>Languages</b> " . $monlang1;
$count = 1;
while ($count < 6){
  $count += 1;
  $monlang_r = "monlang" . $count;
  if ($$monlang_r != ""){
     $print .= ", " . $$monlang_r;
     $htmlp .= ", " . $$monlang_r;
//    echo $monlang_r . $$monlang_r;
  }
}
$print .= "\n";
$htmlp .= "</BR>";
$print .= "\n" . "ECOLOGY" ."\n";
//$htmlp .= "</BR><i><u>" . "ECOLOGY" ."</u></i>";
// $htmlp .= $header . "<b> ECOLOGY</b></font></div>";
//$htmlp .= "</BR>";

//if ($key_1 == "path"){

//}else{
//  $print .= "Feats: " . $print_feat . "\n";
//}
$x = print_ecology();
$print .= "Alignment " . $mon_alignment . "\n";
//$htmlp .= "<b>Alignment:</b> " . $mon_alignment . "</BR>";
// $htmlp .= "<b>Environment</b> " . $mon_environment . "</BR>";
// $htmlp .= "<b>Organization</b> " . $html_org_desc . "</BR>";
//$htmlp .= "<b>Treasure</b> " . $html_treas_desc . "</BR>";


//if ($psi_cmb > 0){
//   $print .= print_psi_combat();
//}
//$print .= "Class Specials: " . $print_class_special . "\n";

if (is_page(203) or is_page(1947)){
  }else{
   if ($print_buff != ""){
     $print .=  "Buffing spells pre-cast: \n" . $print_buff;
     $htmlp .=  "<b>Buffing spells pre-cast:</b> " . $htmlp_buff . "</BR>";
   }
}
if (($class1_spat != ""  or $class1_psi == "Y") or
     ($class2_spat != ""  or $class2_psi == "Y") or
     ($class3_spat != ""  or $class3_psi == "Y") or
     ($classm_spat != ""  or $classm_psi == "Y")){
    $print .= "\n Spells Known: " ."\n";
    $htmlp .= "<b> Spells Known: " ."</b>";
    $htmlp .= " ";
    $spells = "Y";
}
if ($psi_pts > 0){
   $print .= "Power Points " . $psi_pts . "\n";
   $htmlp .= "Power Points " . $psi_pts . " " ;
}
//echo $class1_spat;
//if (is_page(136)){
if ($class1_spat != ""  or $class1_psi == "Y"){
   $print .= printSpells(1);
   $htmlp .= "</BR'>";
   $htmlp .= $spell_html_print_s;

}
if ($class2_spat != "" or $class2_psi == "Y"){
     $htmlp .= "</BR>";
     $print .= printSpells(2);
     $htmlp .= $spell_html_print_s;
}
if ($class3_spat != "" or $class3_psi == "Y"){
     $print .= printSpells(3);
     $htmlp .= "</BR>";
     $htmlp .= $spell_html_print_s;
}
if ($classm_spat != "" or $classm_psi == "Y"){
     $print .= printSpells("m");
     $htmlp .= "</BR>";
     $htmlp .= $spell_html_print_s;
}
if ($spells == "Y"){
   $htmlp .= "</BR>";
}
//}else{
//   $print .= "Spells: ". $print_spell ."\n";
//}
//magic items
//if (is_page (136)){
$print .= printMagic();
$htmlp .= $magic_html_print_s;
$htmlp .= "</BR>" . $savemon_desc . "</BR>";
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
<?
// require_once $includePath."/header.php";
/*
?>
		<!-- Define Local CSS -->
		<LINK href="./local.css" rel="stylesheet" type="text/css" media="all">
		<!-- Define CSS for stats-->
		<LINK href="./style-statsBlock.css" rel="stylesheet" type="text/css" media="all">
		<!-- END CSS Set Up -->
<?
*/
/*
<STYLE type="text/css">
<!--
.monPrint {
	border: 1px solid #CCCCCC;
        height: 1500px;
       	width: 750px;
}
.htmlPrint {
       font-family:"Times New Roman",Georgia,Serif;
       font-size: 90%;
       right:0px;
}
.headmon {
    font-family:"Times New Roman",Georgia,Serif;
    font-size: 12          0%;
    text-align: left
}
p {font-size:90%}

</STYLE>
*/
?>
<?
//echo $_SERVER['HTTP_USER_AGENT'];
if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT'])) {
  $location = "javascript:history.go(-1)";
}else{
  $location = "javascript:history.go(-1)";
}




//	<BODY>
//		<div id="titleBanner">
//	</div>
//  	<div id="content">

?>


                	<div class="noPrint">
<?
//echo "key1  $key_1";
if ($key_1 == "dd35"){
?>
				<h1>D&D 3.5 Monster Generator</h1>
<?
}else{
?>
                               	<h1>Pathfinder RPG Monster Generator</h1>
<?
}
?>


				<h2>Short Text Version</h2>
<?
//echo $savemon_key;
//include 'advert.php';
?>
	                </div>
<div>

<?echo $htmlp ?>
<BR>
<?
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
//echo $savemon_desc;



/*
<TEXTAREA NAME="savemon_desc" class="desc" ROWS="<?echo $rows?>" COLS="60" readonly><?echo $savemon_desc ?> </TEXTAREA>
</div>
<?
*/
//<TABLE BORDER="1" CELLPADDING="1">
// <BR>
// <TR>

/*
<TD><TEXTAREA class="monPrint" Name="monPrint">
<?echo $print ?> </TEXTAREA>
*/

//</TR>
 ?>

        <INPUT TYPE="hidden" NAME="print", VALUE="<?echo $print?>"/>
        <INPUT TYPE="hidden" NAME="mon_print", VALUE="<?echo $print?>"/>
	<INPUT class="button noPrint" TYPE="button" VALUE="Return" onClick="location.href='<? echo $location?>'"/>



<?
//include 'paypal4.php';
?>
















