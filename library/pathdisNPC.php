<?php
// echo exec('whoami');
// echo "</BR>";
$local =  $_SERVER['SERVER_NAME'];
//  <-- CT 29/11/08
$local .= dirname($_SERVER['PHP_SELF'] ); 		// Append the current path
//  END -->
//$includePath = "/usr/share/wordpress2.7/wp-content/themes/dinglesgames/";
//$includePathLocal = $includePath."tools/MonsterGenerator/dnd35";
// Get standard functions
//require $includePathLocal."/ddmonsterFunctions.php";
 $local =  $_SERVER['SERVER_NAME'];
//  <-- CT 29/11/08
$local .= dirname($_SERVER['PHP_SELF'] ); 
/*
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location_print = 'http://' . $local . '/pathdismonprint.php';
}else{
   $location_print =  'http://' . $local . '/pathdismonprint.php';
}
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location_self = 'http://' . $local . '/pathdismon.php';
}else{
   $location_self =  'http://' . $local . '/pathdismon.php';
}
*/
$location_print = locate_template('library/pathdismonprint.php');
//echo "loc = $location_print";
$current_user = wp_get_current_user();
$wp_user = $current_user->user_login;
//echo '<script language="javascript">';
//        echo "var status = document.getElementById('status')";
//echo 'alert("in pathdisNPC")';
//echo '</script>';

/*  Variable defs added by CT as hack to get round error messages during development */

//   globals now defined in ddglobal.php
/*
global $mon_str,$mon_dex,$mon_con,$mon_int,$mon_wis,$mon_chr,$mon_int_bonus_orig,$mon_int_bonus_skill,$mon_con_bonus,$mon_wis_bonus,$mon_dex_bonus,$mon_chr_bonus,$mon_str_bonus,$mon_int_bonus, $mon_str_bonus;
global  $key_1;
global $magic_ac,$magic_ac_dodge,$magic_ac_deflect,$bonus_dam_spec,$gen_feats,$classm_spat,$feat_weaptr, $AC_text;
global $save_text,$game,$skill_1,$skill_1_rank,$skill_no_extra,$buffx_level_1,$buffx_level_2,$buffx_level_3,$mon_size, $mon_size_old,$mon_size_m,$mon_size_u,$size_changed_sel,$animal_companion;
global $zombie_tem,$tem_base_att,$class1_att,$class1_lev_att,$class1_spat,$class2_spat,$class3_spat,$first_pass,$tem_feats_calc,$repopulate_feats,$class1_hd ,$class2_hd,
$class3_hd,$temCR,$total_level_old,$attr_spent,$tem_die,$magic_hps,$tough_hp,$class1_fort_sv,$class2_fort_sv,$class3_fort_sv,$tem_fort_sv,$class1_will_sv,$class2_will_sv,$class3_will_sv,$tem_will_sv,
$class1_reflex_sv,$class2_reflex_sv,$class3_reflex_sv,$tem_reflex_sv,$class1_skill_points,$class2_skill_points,$class3_skill_points,$total_skill_points_old,$mon_skill_points,$mon_skill_points_save,$attnum1, $mon_speed;

global $attnum2,$attnum3,$attnum4,$attnum5,$class2_attack,$class3_attack, $int_ac,$feat_ac_bonus,$magic_armour_touch,$str_bonus,$feat_grapple,$feat_attall,$single_attack,$flurry_att,$no_attacks,$exattap,
$flurry_no,$feat_size,$crit_mod,$crit_mod_r,$temp_weapons_flag,$mon_weap_r,$crit_mod,$crit_mod_r,$orig_monweap_dam_s1,$weap_dam_s1,$weap_dam2_s1,$monweap_dambase_no_s1,$magic_damage_s1,$magic_tohit_s1,$orig_monweap_dam_s2,
$weap_dam_s2,$mon_weap_s2,$orig_monweap_dam_s3,$weap_dam_s3,$weap_dam_s3,$orig_monweap_dam_s4,$weap_dam_s4,$weap_dam_s4,$orig_monweap_dam_s5,$weap_dam_s5,$weap_dam_s5,$orig_monweap_dam_s6,$weap_dam_s6,
$weap_dam_s6,$orig_monweap_dam_s7,$weap_dam_s7,$weap_dam_s7,$orig_monweap_dam_s8,$weap_dam_s8,$weap_dam_s8,$orig_monweap_dam_s9,$weap_dam_s9,$weap_dam_s9,$orig_monweap_dam_s10,$weap_dam_s10,$weap_dam_s10,
$spec_init,$mon_weap_s3,$mon_weap_s4,$mon_weap_s5,$mon_weap_s5,$mon_weap_s6,$mon_weap_s7,$mon_weap_s8,$mon_weap_s9,$mon_weap_s10,$class2_damage,$class1_cr_mult,$class2_cr_mult,$tem_cr,$color,
$armour_1,$armour_2,$armour_3,$armour_4,$weaponHTML,$extra_attack,$add_extra_attack,$damage_s2,$attack_s2,$weap_crit_s2,$weap_crit_ch_s2,$damage_s3,$attack_s3,$weap_crit_s3,$weap_crit_ch_s3,
$damage_s4,$attack_s4,$weap_crit_s4,$weap_crit_ch_s4,$damage_s5,$attack_s5,$weap_crit_s5,$weap_crit_ch_s5,$damage_s6,$attack_s6,$weap_crit_s6,$weap_crit_ch_s6, $damage_s7,$attack_s7,$weap_crit_s7,$weap_crit_ch_s7;


global $damage_s8,$attack_s8,$weap_crit_s8,$weap_crit_ch_s8,$damage_s9,$attack_s9,$weap_crit_s9,$weap_crit_ch_s9,$damage_s10,$attack_s10,$weap_crit_s10,$weap_crit_ch_s10,$null_feat,$errortxt,
$class1_psi,$class2_psi,$class3_psi,$feathelp,$multi_found,$skill_changed_old,$skill_spent,$skillt_skill,$skillt_rank,$skillt_atr,$skillt_armour_ch,$skillt_xskill,$skillt_untrained,$skillsHTML2,$text,
$skill_changed,$bold,$ebold,$class1_psi_pts,$class2_psi_pts,$class3_psi_pts,$psi_points,$class1_psi_cmb, $class2_psi_cmb,$class3_psi_cmb,$total_spent,$print_ind,$tem_type,$ac_profane,$ac_dodge,$ac_luck,$ac_insight,
$skillErrorsHTML,$attrErrorsHTML,$class3_tp,$HTML,$fighter_weapHTML,$path2_HTML,$spellsThreeHTML,$spellsMonHTM,$savemon_desc,$class1_spell0,$class1_spell1,$class1_spell2,$class1_spell3,$class1_spell4,$class1_spell5,
$class1_spell6,$class1_spell7,$class1_spell8,$class1_spell9,$class2_spell0,$class2_spell1,$class2_spell2,$class2_spell3,$class2_spell4,$class2_spell5,$class2_spell6,$class2_spell7,$class2_spell8,$class2_spell9,
$class3_spell0,$class3_spell1,$class3_spell2,$class3_spell3,$class3_spell4,$class3_spell5,$class3_spell6, $class3_spell7,$class3_spell8,$class3_spell9,$cr_path,$monlang1,$monlang2,$monlang3,$monlang4,$monlang5,$monlang6,
$reach_text,$speed_text,$print_specdesc,$AC_text,$print_init,$init_text,$sen_text,$feat_text,$zombie,$class1_attg,$feat_rr,$feat_rrh,$feat_rrb,$feat_name,$feat_desc,$spec_no_v,$new_animal_comp_level,$mon_print,
$foo_temp,$mon_lev_savep,$mythic_temp,$spell_feat_count,$chrdexac,$tem_ac_deflect,$tem_ac_insight,$tem_ac_profane,$tem_ac_luck,$tem_ac_dodge,$size_ac_mod,$simpSecAdj,$flurry_bonus,$sec_adj,$rang_adg,$feat_agilem,
$CMDLtArm,$CMDMdArm,$CMDHvArm,$feat_dct,$chrdexcmd,$feat_multiw,$rang_adj,$tohit_feat_p,$feat_exatta11,$feat_exatta12,$bonus_dam_close,$dam_feat_p,$crit_mod2,$feat_dslice,$feat_atth2,$feat_armtp,$speedmednorm,
$monk_level_dam,$weretemp,$half_fiend_temp,$fiendish_temp,$armour_BUCKLER,$print_spell_abil,$spellcl_replace_feats1,$classfeat_del_feat,$classfeat_level,$add_feat_class11,$add_feat_class12,$add_feat_class21,
$add_feat_class22,$add_feat_class31,$add_feat_class32,$skill_race_desc,$spellsMonHTML,$class1_feat,$class2_feat,$class3_feat,$spec_fort_sv,$spec_will_sv,$spec_reflex_sv,$flurry_of_blows,$feat_armch,
$magic_ac_insight,$magic_ac_profane,$magic_ac_luck,$feat_defshield,$prim_adj,$marSecAdj,$simpSecAdj,$exSecAdj,$feat_multi,$old_animal_comp_level,$feat_acrobat,$feat_armch,$path2,$count_ranged,$feat_atth2_used,
$old_specatta,$count_attack,$tem_level,$count_space,$count_sen,$count_sub,$count_def,$count_hp,$count_speed,$count_space,$count_init,$count_CMB,$count_CMD,$count_aura,$count_svtext,$count_speed,$multi_found,$mon_nul_bonus,
$feat_multi,$spellcl_replace_feats2,$bonus_atr1,$bonus_atr2,$bonus_atr3,$finess_damage,$mon_str_m,$mon_dex_m,$mon_con_m,$mon_wis_m,$mon_int_m ,$mon_chr_m, $mon_orig_feats, $mon_feats, $tem_feats;
global $key_1, $mon_level, $mon_int, $mon_feats_calc, $tem_level, $tem_feats, $mon_name, $zombie, $mon_feats;
global $class1_tp, $class1_level, $class2_tp, $class3_tp, $class2_level, $class3_level, $class_feats;
global $gen_feats, $zombie, $max_feats, $animal_companion, $animal_companion_hd;
global $class1_feat, $class2_feat, $mon_free_feats, $epic_feat_max, $human_counted, $wp_user, $tem_free_feats;
 // globals copied from functions


 global $key_1, $class1_psi, $class2_psi;
 global $mon_name, $mon_int,$mon_dex,$mon_wis,$mon_con, $mon_chr, $mon_str, $mon_level, $class1_level, $class2_level, $mon_ac_flat,
         $class1_tp, $class2_tp, $attnum1, $mon_base_att, $user, $caster, $mon_type, $mon_speed_fly, $key_1,
         $mon_int_m,$mon_dex_m,$mon_wis_m,$mon_con_m, $mon_chr_m, $mon_str_m,$epic_count, $epic_feat_max, $wp_user,
         $class3_tp, $class3_level, $help_ok, $tem_level,$mon_weap_p, $mon_weap_s1, $mon_shield,
         $class1_spell_list_1,  $class1_spell_list_2,  $class2_spell_list_1,  $class2_spell_list_2;

   global $class1_tp, $class2_tp, $class3_tp, $mon_type, $mon_name, $mon_temp, $key_1 , $domain_11, $domain_21, $domain_31, $weap_firearm, $firearms ;
   $wep = "weapon_1-Simple";

   global $$wep;
   $wep = "weapon_0-Natural";
    global $$wep;
   $wep = "weapon_2-Martial";
    global $$wep;
   $wep = "weapon_3-Exotic";
    global $$wep;
//   global $weapon_1-Simple, $weapon_0-Natural, $weapon_2-Martial, $weapon_3-Exotic;
   global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23, $domain_m1, $domain_m2, $domain_m3, $feat_addpst;
   global $spell_feat_1,$spell_feat_2,$spell_feat_3,$spell_feat_4,$spell_feat_5, $spell_feat_6, $spell_feat_7, $spell_feat_8, $spell_feat_9;
   global $key_1;
   global $class1_spell_list_1, $class1_spell_list_2, $class2_spell_list_1, $class2_spell_list_2,$class3_spell_list_1, $class3_spell_list_2;
   $class_spell_list_1_v = "class" . $class_no . "_spell_list_1";

   $class_spell_list_2_v = "class" . $class_no . "_spell_list_2";

   $class_spell_list_3_v = "class" . $class_no . "_spell_list_3";
   global $$class_spell_list_1_v, $$class_spell_list_2_v, $$class_spell_list_3_v ;
   global $class1_level, $class2_level, $class3_level;
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
global $spell_feat_1, $spell_feat_2, $spell_feat_3, $spell_feat_4, $spell_feat_5, $spell_feat_6, $spell_feat_7, $spell_feat_8, $spell_feat_9;

  global  $spell_html_print, $spell_html_print_s ;


  $select = "select magicbody_id from magicbody";
  $link = getDBLink();
  //  echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;

  if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)) {
      $body = $row['magicbody_id'];
      $loop = 1;
      while ($loop < 5){
        $magic_item_v = "magic_" . $body . "_" . $loop;
        $magic_item_gp_v = $magic_item_v . "_gp";
        global $$magic_item_v, $magic_item_gp_v ;
   //     echo $magic_item_v;
         $loop += 1;
      }
    }
  }
  global $mon_str_m, $mon_con_m, $mon_dex_m, $mon_int_m, $mon_wis_m, $mon_chr_m, $mon_size_m, $magic_ac, $magic_skill_all, $magic_armour_nac;
   global $mon_str_s, $mon_con_s, $mon_dex_s, $mon_int_s, $mon_wis_s, $mon_chr_s, $mon_size_s, $magic_ac_deflect, $magic_ac_dodge;
   global $class1_tp, $class2_tp, $class3_tp, $class1_level, $class2_level, $class3_level;
   global  $magic_found;
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
       global $key_1, $mon_shield, $mon_armour, $mon_weap_p, $mon_weap_r, $mon_weap_s1;
        global $user, $total_spent,$total_gp, $header;
         global $magic_html_print,$magic_html_print_s ;
          global $weretemp;
          global $tem_cr, $tem_type, $tem_ac_deflect, $tem_ac_insight, $tem_ac_profane, $tem_ac_luck, $tem_ac_dodge;
    global $tem_sv_will, $tem_sv_fort, $tem_sv_reflex, $montype_att;
    global $mon_str, $mon_int, $mon_wis, $mon_dex, $mon_con, $mon_chr, $mon_cr, $mon_space, $mon_reach, $mon_speed, $mon_base_att, $mon_type, $mon_level;
    global $mon_ac_flat, $tem_die, $tem_level, $tem_skillp, $tem_hd_override, $mon_speed_fly, $mon_size, $magic_ac_deflect, $magic_ac_insight, $magic_ac_profane, $magic_ac_dodge;
    global $magic_ac_luck, $montype_att;
    global  $calc_mon_feats, $mon_feats, $mon_free_feats, $_POST, $zombie, $zombie_tem, $mon_hd_original, $tem_base_att, $half_fiend_temp, $fiendish_temp, $foo_temp, $fay_temp, $skeleton_tem, $exoskeleton_tem;
    global $animal_companion, $animal_companion_hd, $mon_chr_bonus, $mon_speed_fly_save, $mythic_temp, $mythic_count;
    global $tem_will_sv,  $tem_fort_sv, $tem_reflex_sv;
     global $mon_will_sv,  $mon_fort_sv, $mon_reflex_sv;
    global  $wp_user, $key_1, $user, $weretemp, $temCR;
    global $total_level;
     global $user, $tem_level;
      global $tem_free_feats, $mon_int, $tem_feats;
       global $wp_user, $key_1, $temp_weapons_flag;
$count = 1;
while ($count < 15){
   if ($count == 1) { $attp = "P";}
   if ($count == 2) { $attp = "R";}
   if ($count > 3) { $attp = "S" . ($count - 2) ;}
    $weap_dam_v = "weap_dam_" . $attp ;
    $weap_dam2_v = "weap_dam2_" . $attp ;
    $weap_type_v = "weap_type_" .$attp ;
    $weap_cat_v  = "weap_cat_" . $attp;
    $monweap_dam_v = "monweap_dam_" .$attp;
    $weap_dambase_no_v = "monweap_dambase_no_" . $attp;
    $weap_dambase_incr_v = "monweap_dambase_incr_" . $attp;
    global  $$weap_dam_v, $$weap_dam2_v, $$weap_type_v, $$weap_cat_v, $$monweap_dam_v, $$weap_dambase_no_v, $$weap_dambase_incr_v;
    $count += 1;
}

 global $mon_name, $mon_hd_original, $mon_size_original, $advance, $mon_die, $wp_user, $key_1;
 global $mon_name, $mon_size_old, $mon_level, $mon_level_old, $mon_size, $mon_str, $mon_dex, $mon_con, $mon_ac_flat, $advance, $mon_die;
  global $mon_name, $mon_size_old, $mon_level, $mon_level_old, $mon_size, $mon_str, $mon_dex, $mon_con, $mon_ac_flat, $advance;
  global $old_grapple, $new_grapple, $old_size_no, $new_size_no;

 global $mon_name, $mon_temp, $class1_tp, $class2_tp, $classm_spat, $classm_tp, $classm_level, $key_1, $wp_user;
   global $classm_feat, $classm_damage, $classm_spell0, $classm_spell1, $classm_spell2, $classm_spell3, $classm_spell4, $classm_spell5, $classm_spell6;
   global $classm_spell7, $classm_spell8, $classm_spell9, $classm_spell0_n, $classm_spell1_n, $classm_spell2_n, $classm_spell3_n,
          $classm_spell4_n, $classm_spell5_n, $classm_spell6_n, $classm_spell7_n, $classm_spell8_n, $classm_spell9_n, $caster;
   global $mon_level, $class1_level, $class2_level, $class3_level, $tem_level;
   $total_level = $mon_level + $class1_level + $class2_level + $class3_level + $tem_level;
    global $classm_spell_level;
     global $weap_tr1, $feat_weaptr, $bonus_dam_spec, $feat_atth_close, $feat_atthd_close, $feat_atth_pole, $feat_atthd_pole;
   global $feat_atth_natural, $feat_atthd_natural;
   global  $weap_tr1, $weap_tr2, $weap_tr3, $weap_tr4, $weap_tr5, $weap_tr6, $weap_tr7;
   global $psi_points;
   $loop = 1;
   while ($loop < 20){
     $buff_sel_v = "buff_spell_" .$loop;
     $buff_spell_v = "buff_spell_" . $loop;
     $buff_level_v = "buff_level_" . $loop;
     $level_v = "buffx_level_" . $loop;
     $addfeat2_r = "add_feat_class1" . $loop;
     global $$addfeat2_r;
     $addfeat2_r = "add_feat_class2" . $loop;
     global $$addfeat2_r;
     $addfeat2_r = "add_feat_class3" . $loop;
     global $$addfeat2_r;
     global $$level_v;
     global $$buff_spell_v, $$buff_level_v;
     global $$buff_sel_v;
     $loop += 1;
   }
   global $mon_name, $key_1, $user, $buffx_level_1, $buffx_level_2, $buffx_level_3;
 global $user, $key_1, $buffx_level_1, $buffx_level_2, $buffx_level_3, $magic_found, $print_buff, $htmlp_buff;

   global $mon_name, $mon_temp, $key_1;
   global $html_org_desc; $print_org_desc;
   global $html_treas_desc; $print_treas_desc;
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
   global $wp_user, $attack, $user;
    global $wp_user, $user, $print_attack, $htmlp_secondary_attacks_s, $magic_WEAPONA_SPEC_1;
    global $wp_user, $user;
  global $key_1, $class1_tp, $class2_tp, $class3_tp, $class1_level, $class2_level, $class3_level, $path2;
  global $domain_11, $domain_12, $domain_13, $domain_21, $domain_22, $domain_23, $domain_31, $domain_32, $domain_33;
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
  global $reduce_feats_1,  $reduce_feats_2,$reduce_feats_3;
  $select = "select specattr_no from specattr where specattr_type = 'ADDFEAT2'";
  $link = getDBLink();
  //  echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;

  if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)) {
      $spec_no = $row['specattr_no'];
      global $$spec_no;

    }
  }
   global $key_1, $user, $class1_tp, $class2_tp, $class3_tp, $class1_focus, $class2_focus, $class3_focus, $class1_domain1, $class2_domain2, $class1_level, $class2_level, $class3_level ;
  global $class1_feat, $class2_feat,  $class3_feat, $gen_feats, $attnum1, $class_feats, $mon_str, $mod_dex, $mon_free_feats, $mon_feats, $epic_feat_max, $tem_feats;
  global $wp_user, $epic_count, $mon_name, $mon_orig_feats, $mon_int, $mon_str, $mon_dex;
  global $key_1, $mon_level, $mon_int, $mon_feats_calc, $tem_level, $tem_feats, $mon_name, $zombie, $mon_feats;
  global $class1_tp, $class1_level, $class2_tp, $class3_tp, $class2_level, $class3_level, $class_feats;
  global $gen_feats, $zombie, $max_feats, $animal_companion, $animal_companion_hd;
  global $class1_feat, $class2_feat, $mon_free_feats, $epic_feat_max, $human_counted, $wp_user, $tem_free_feats;
    global $key_1, $total_level;
    global $mon_chr_bonus, $mon_level, $mon_con_bonus;
   global $user, $wp_user, $key_1, $mon_str_bonus, $mon_int_bonus, $mon_wis_bonus, $mon_dex_bonus, $mon_con_bonus, $mon_cha_bonus, $mon_temp, $mon_temp2;
   global $mon_str_m, $mon_str_s, $mon_int_m, $mon_int_s, $mon_dex_m, $mon_dex_s, $mon_con_m, $mon_con_s, $mon_wis_m, $mon_wis_s, $mon_chr_m, $mon_chr_s;
    global  $count_aura, $print_aura, $count_aura, $htmlp_spell_abil,$htmlp_spell_abil_s, $print_spell_abil, $print_attack, $count_attack, $monsterSpecialHTML;
   global $zombie_tem,  $mon_template, $spec_level, $print_special_attacks, $print_ranged, $count_ranged, $print_CMD, $count_CMD, $print_CMB, $count_CMB;
   global $print_reach, $count_reach,$htmlp_special_attacks, $print_special_attacks_s;
   global $wp_user, $key_1, $total_level, $mon_name, $mon_level, $tem_level, $mon_template, $mon_temp, $mon_temp2;
   global $mon_str_bonus, $mon_int_bonus, $mon_wis_bonus, $mon_dex_bonus, $mon_con_bonus, $mon_chr_bonus;
   global $mon_str, $mon_int, $mon_wis, $mon_dex, $mon_con, $mon_chr,$mon_namex;
   global $save_key_old;
    global $armour_s30;
     global $mon_str_bonus, $mon_dex_bonus,$mon_con_bonus, $mon_int_bonus, $mon_int_orig, $mon_int_bonus_skill, $mon_wis_bonus, $mon_chr_bonus,
          $mon_str, $mon_dex, $mon_con, $mon_int, $mon_wis, $mon_chr, $mon_int_bonus_orig;
   global $tem_type, $mon_sv_will, $tem_sv_will, $mon_sv_fort, $tem_sv_fort, $mon_sv_reflex, $tem_sv_reflex, $key_1;
   global $mon_str_m, $mon_dex_m, $mon_con_m, $mon_int_m, $mon_wis_m, $mon_chr_m, $mon_int_bonus_skill;



*/










$speed_land = 0;
$mon_str = 0;
$mon_dex = 0;
$mon_con = 0;
$mon_int = 0;
$mon_wis = 0;
$mon_chr = 0;
$mon_int_bonus_orig = 0;
$mon_int_bonus_skill = 0;
$mon_con_bonus = 0;
$mon_wis_bonus = 0;
$mon_dex_bonus = 0;
$mon_chr_bonus = 0;
$mon_str_bonus = 0;
$magic_ac = 0;
$magic_ac_dodge = 0;
$magic_ac_deflect = 0;
$mon_str_bonus = 0;
$bonus_dam_spec = 0;
$gen_feats = 0;
$mon_int_bonus = 0;
$classm_spat = "";
$feat_weaptr = 0;
/* END CT  */


$key_1 = "path";
$AC_text = "";
$save_text = "";
$game = "path";

$x = add_days_bought();

$skill_1 = "";
$skill_1_rank = 0;
$skill_no_extra = 0;
$buffx_level_1 = "";
$buffx_level_2 = "";
$buffx_level_3 = "";
$mon_size = "";
$mon_size_old = "";
$mon_size_m = "";
$mon_size_u = "";
$size_changed_sel = "";
$animal_companion = "";
$zombie_tem = "";
$tem_base_att = 0;
$class1_att = "";
$class1_lev_att = "";
$class1_spat = "";
$class2_spat = "";
$class3_spat = "";
$first_pass = "" ;
$tem_feats_calc = "";
$repopulate_feats = "";
$count2 = 0;
$class1_hd = "";
$class2_hd = "";
$class3_hd = "";
$temCR = 0;
$total_level_old = "";
$attr_spent = "";
$tem_die = "";
$magic_hps = "";
$tough_hp = "";
$class1_fort_sv = 0;
$class2_fort_sv = 0;
$class3_fort_sv =0;
$tem_fort_sv = 0;
$class1_will_sv = 0;
$class2_will_sv = 0;
$class3_will_sv = 0;
$tem_will_sv = 0;
$class1_reflex_sv = 0;
$class2_reflex_sv = 0;
$class3_reflex_sv = 0;
$tem_reflex_sv = 0;
$class1_skill_points = 0;
$class2_skill_points = 0;
$class3_skill_points = 0;
$total_skill_points_old = 0;
$mon_skill_points = 0;
$mon_skill_points_save = 0;
$attnum1 = 0;
$attnum2 = 0;
$attnum3 = 0;
$attnum4 = 0;
$attnum5 = 0;
$class2_attack = "";
$class3_attack = "";
$int_ac = "";
$feat_ac_bonus = 0;
$magic_armour_touch = 0;
$str_bonus = 0;
$feat_grapple = 0;
$feat_attall = 0;
$single_attack = 0;
$flurry_att = 0;
$no_attacks = 0;
$exattap = "";
$flurry_no = 0;
$feat_size = 0;
$crit_mod = 0;
$crit_mod_r = 0;
$temp_weapons_flag = "";
$mon_weap_r = 0;
$crit_mod = 0;
$crit_mod_r = 0;
$orig_monweap_dam_s1 = 0;
$weap_dam_s1 = 0;
$weap_dam2_s1 = 0;
$monweap_dambase_no_s1 = 0;
$magic_damage_s1 = 0;
$magic_tohit_s1 = 0;
$orig_monweap_dam_s2 = 0;
$weap_dam_s2 = 0;
$mon_weap_s2 = 0;
$orig_monweap_dam_s3 = 0;
$weap_dam_s3 = 0;
$weap_dam_s3 = 0;
$orig_monweap_dam_s4 = 0;
$weap_dam_s4 = 0;
$weap_dam_s4 = 0;
$orig_monweap_dam_s5 = 0;
$weap_dam_s5 = 0;
$weap_dam_s5 = 0;
$orig_monweap_dam_s6 = 0;
$weap_dam_s6 = 0;
$weap_dam_s6 = 0;
$orig_monweap_dam_s7 = 0;
$weap_dam_s7 = 0;
$weap_dam_s7 = 0;
$orig_monweap_dam_s8 = 0;
$weap_dam_s8 = 0;
$weap_dam_s8 = 0;
$orig_monweap_dam_s9 = 0;
$weap_dam_s9 = 0;
$weap_dam_s9 = 0;
$orig_monweap_dam_s10 = 0;
$weap_dam_s10 = 0;
$weap_dam_s10 = 0;
$spec_init = 0;
$mon_weap_s3  = 0;
$mon_weap_s4  = 0;
$mon_weap_s5  = 0;
$mon_weap_s5  = 0;
$mon_weap_s6 = 0;
$mon_weap_s7 = 0;
$mon_weap_s8 = 0;
$mon_weap_s9 = 0;
$mon_weap_s10 = 0;
$class2_damage = 0;
$class1_cr_mult = 0;
$class2_cr_mult = 0;
$tem_cr = 0;
$color = "";
$armour_1 = "";
$armour_2 = "";
$armour_3 = "";
$armour_4 = "";
$weaponHTML = "";
$extra_attack = "";
$add_extra_attack = "";
$damage_s2 = "";
$attack_s2 = "";
$weap_crit_s2 = "";
$weap_crit_ch_s2 = "";
$damage_s3 = "";
$attack_s3 = "";
$weap_crit_s3 = "";
$weap_crit_ch_s3 = "";
$damage_s4 = "";
$attack_s4 = "";
$weap_crit_s4 = "";
$weap_crit_ch_s4 = "";
$damage_s5 = "";
$attack_s5 = "";
$weap_crit_s5 = "";
$weap_crit_ch_s5 = "";
$damage_s6 = "";
$attack_s6 = "";
$weap_crit_s6 = "";
$weap_crit_ch_s6 = "";
$damage_s7 = "";
$attack_s7 = "";
$weap_crit_s7 = "";
$weap_crit_ch_s7 = "";
$damage_s8 = "";
$attack_s8 = "";
$weap_crit_s8 = "";
$weap_crit_ch_s8 = "";
$damage_s9 = "";
$attack_s9 = "";
$weap_crit_s9 = "";
$weap_crit_ch_s9 = "";
$damage_s10 = "";
$attack_s10 = "";
$weap_crit_s10 = "";
$weap_crit_ch_s10 = "";




$null_feat = "";
$errortxt = "";
$class1_psi = "";
$class2_psi = "";
$class3_psi = "";
$feathelp = "";
$multi_found = "";
$skill_changed_old = "";
$skill_spent = "";
$skillt_skill = "";
$skillt_rank = "";
$skillt_atr = "";
$skillt_armour_ch = "";
$skillt_xskill = "";
$skillt_untrained = "";
$skillsHTML2 = "";
$text = "";
$skill_changed = "";
$bold = "";
$ebold = "";
$class1_psi_pts  = 0;
$class2_psi_pts  = 0;
$class3_psi_pts  = 0;
$psi_points = 0;
$class1_psi_cmb = 0;
$class2_psi_cmb = 0;
$class3_psi_cmb = 0;
$total_spent = "";
$print_ind = "";
$tem_type = "";
$ac_profane = 0;
$ac_dodge =  0;
$ac_luck = 0;
$ac_insight = 0;
$skillErrorsHTML = "";
$attrErrorsHTML = "";
$class3_tp = "";
$HTML = "";
$fighter_weapHTML = "";
$path2_HTML = "";
$spellsThreeHTML = "";
$spellsMonHTM = "";
$savemon_desc = "";
$class1_spell0 = "";
$class1_spell1 = "";
$class1_spell2 = "";
$class1_spell3 = "";
$class1_spell4 = "";
$class1_spell5 = "";
$class1_spell6 = "";
$class1_spell7 = "";
$class1_spell8 = "";
$class1_spell9 = "";
$class2_spell0 = "";
$class2_spell1 = "";
$class2_spell2 = "";
$class2_spell3 = "";
$class2_spell4 = "";
$class2_spell5 = "";
$class2_spell6 = "";
$class2_spell7 = "";
$class2_spell8 = "";
$class2_spell9 = "";
$class3_spell0 = "";
$class3_spell1 = "";
$class3_spell2 = "";
$class3_spell3 = "";
$class3_spell4 = "";
$class3_spell5 = "";
$class3_spell6 = "";
$class3_spell7 = "";
$class3_spell8 = "";
$class3_spell9 = "";
$cr_path = "";
$monlang1 = "";
$monlang2 = "";
$monlang3 = "";
$monlang4 = "";
$monlang5 = "";
$monlang6 = "" ;
$reach_text = "";
$speed_text = "";
$print_specdesc = "";
$AC_text = "";
$print_init = "";
$init_text = "";
$sen_text = "";
$feat_text = "";
$zombie = "";
$class1_attg = "";
$feat_rr = "";
$feat_rrh = "";
$feat_rrb = "";
$feat_name = "";
$feat_desc = "";
$spec_no_v = "";
$new_animal_comp_level = 0;
$mon_print = "";
$foo_temp = "";
$mon_lev_savep = "";
$mythic_temp = "";
$spell_feat_count = 0;
$chrdexac = 0;
$tem_ac_deflect = 0;
$tem_ac_insight = 0;
$tem_ac_profane = 0;
$tem_ac_luck = 0;
$tem_ac_dodge = 0;
$size_ac_mod = 0;
$simpSecAdj = 0;
$flurry_bonus = 0;
$sec_adj = 0;
$rang_adg = 0;
$feat_agilem = 0;
$CMDLtArm = 0;
$CMDMdArm = 0;
$CMDHvArm = 0;
$feat_dct = 0;
$chrdexcmd  = 0;
$feat_multiw = 0;
$rang_adj = 0;
$tohit_feat_p = 0;
$feat_exatta11 = 0;
$feat_exatta12 = 0;
$bonus_dam_close = 0;
$dam_feat_p = 0;
$crit_mod2 = 0;
$feat_dslice = 0;
$feat_atth2 = 0;
$feat_armtp  = 0;
$speedmednorm = "";
$monk_level_dam = "";
$weretemp = "";
$half_fiend_temp = "";
$fiendish_temp = "";
$armour_BUCKLER ="";
$print_spell_abil ="";
$spellcl_replace_feats1 = "";
$classfeat_del_feat = "";
$classfeat_level = "";
$add_feat_class11 = "";
$add_feat_class12 = "";
$add_feat_class21 = "";
$add_feat_class22 = "";
$add_feat_class31 = "";
$add_feat_class32 = "";
$skill_race_desc = "";
$spellsMonHTML = "";
$class1_feat = 0;
$class2_feat = 0;
$class3_feat = 0;
$spec_fort_sv = 0;
$spec_will_sv = 0;
$spec_reflex_sv = 0;
$flurry_of_blows = "";
$feat_armch = 0;
$magic_ac_insight = 0;
$magic_ac_profane = 0;
$magic_ac_luck = 0;
$feat_defshield = 0;
$prim_adj = 0;
$marSecAdj = 0;
$simpSecAdj = 0;
$exSecAdj = 0;
$feat_multi = 0;
$old_animal_comp_level = 0;
$feat_acrobat = 0;
$feat_armch = 0;
$path2 = "";
$count_ranged = "";
$feat_atth2_used = "";
$old_specatta = "";
$count_attack = 0;
$tem_level = 0;
$count_space = 0;
$count_sen = 0;
$count_sub = 0;
$count_def = 0;
$count_hp = 0;
$count_speed = 0;
$count_space = 0;
$count_init = 0;
$count_CMB = 0;
$count_CMD = 0;
$count_aura = 0;
$count_svtext = 0;
$count_speed = 0;
$multi_found = "";
$mon_nul_bonus = 0;
$feat_multi = "";
$spellcl_replace_feats2 = "";
$bonus_atr1 = 0;
$bonus_atr2 = 0;
$bonus_atr3 = 0;
$finess_damage = "";
$mon_str_m = 0;
$mon_dex_m =0; 
$mon_con_m = 0;
$mon_wis_m =0; 
$mon_int_m = 0;
$mon_chr_m =0;
$savemon_key = "";
$class2_level = "";
$class2_level = "";
$class3_level = "";
$mon_skillp = "";
$mon_ac_profane = "";
$mon_ac_flat = "";
$mon_weap_p = "";
$mon_ac_luck = "";
$orig_mon_weap_p = "";
$mon_size_original = "";
$mon_template = "";
$classm_tp = "";
$die_increase = "";
$psidcint = "";
$psidccon = "";
$print_buff = "";
$htmlp_buff = "";
$class1_spell_level = 0;
$class2_spell_level = 0;
$class3_spell_level = 0;
$classm_spell_level = 0;
$new_size_no = 0;
$old_size_no = 0;
$terain = "";
$mon_hd_original = "";
$total_class_level = 0;
$weap_dam_p = "";
$mon_speed = 0;
$mon_orig_feats = 0;
$class1_level = 0;
$class2_level = 0;
$class3_level = 0;
$encounter = "";
$classm_psi = "";
$psidcstr = "";
$psidcdex = "";
$psidcwis = "";
$psidcchr = "";
$class_pc = "";
$couny2 = 0;
$pres_spell_lev_arc = 0;
 while ($count2 < 5){
  $count2 = $count2 + 1;
  $count = 0;
  while ($count < 24){
    $count = $count + 1;
    $featv = "feat_" .$count2 . $count;
    $$featv = "";
    $featautov =   "feat_auto_" .$count2 . $count;
    $$featautov = "";
   }
}



//echo $location;
//echo "-------------------\n";
//echo var_dump($_POST);

if (IsSet($_SESSION['smon_name']) or $_POST['savemon_key'] != ""){
//   echo "</BR>here";
   $mon_name     = $_SESSION['smon_name'];
   $class1_tp    = trim($_SESSION['sclass1_tp']);
   $class1_level = $_SESSION['sclass1_level'];
   $class1_focus = $_SESSION['sclass1_focus'];
   $class2_tp    = trim($_SESSION['sclass2_tp']);
   $class2_level = $_SESSION['sclass2_level'];
   $class2_focus = $_SESSION['sclass2_focus'];
   $user         = $_SESSION['suser'];
   $new          = $_SESSION['snew'];
   $oldmon_key   = $_SESSION['soldmon_key'];
   $elite        = $_SESSION['selite'];
   $mon_temp = $_SESSION['smon_template'];
   $mon_temp2 = $_SESSION['smon_template2'];
   if (isset($_POST['savemon_key'])){
   }else{
     $_POST['savemon_key'] = "";
   }
//   $save_mon  = $_SESSION['ssave_mon_key'];
   $save_mon = $_POST['savemon_key'];
//   echo "savemon = $save_mon";
   if (isset($_POST['class_tp_3'])){
      $class3_tp    = trim($_POST['class_tp_3']);
      $class3_level = $_POST['classLevel_3'];
      if (isset($_POST['classFocus_3'])){
      }else{
          $_POST['classFocus_3'] = "";
      }
      $class3_focus = $_POST['classFocus_3'];
   }else{
      $class3_tp    = "";
      $class3_level = "";
      $class3_focus = "";
   }
//   $domain_11 = $_POST['domain_11'];
//   echo "domain $domain_11";
   if (isset($_POST['domain_11'])){
   }else{
      $_POST['domain_11'] = "";
   }
   if (isset($_POST['domain_21'])){
   }else{
      $_POST['domain_21'] = "";
   }
   $domain_11 = $_POST['domain_11'];
   $domain_21 = $_POST['domain_21'];
   $user_save = $user;


//     echo "user " . $user;
//    echo "save_mon = " . $save_mon ;
   if ($save_mon != ""){
      $save_key_old = $save_mon;

      $select =  "SELECT savemon_monster, savemon_mon_name, savemon_class1_tp, savemon_class2_tp, savemon_class3_tp, savemon_mon_temp, ".
                 "savemon_class1_focus, savemon_class2_focus, savemon_class3_focus," .
                 "savemon_camp, savemon_sub, savemon_name, savemon_desc, savemon_mon_temp2" .
          " from savemon where savemon_key = '$save_mon'";
//      echo $select;
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $savemon_monster = $row['savemon_monster'] ;
      $mon_name = $_POST['mon_name'] =  $row['savemon_mon_name'] ;
      $class1_tp = $_POST['class_tp_1'] = $row['savemon_class1_tp'] ;
      $class2_tp = $_POST['class_tp_2'] = $row['savemon_class2_tp'] ;
      $class3_tp = $_POST['class_tp_3'] = $row['savemon_class3_tp'] ;
      $class1_focus = $_POST['classFocus_1'] = $row['savemon_class1_focus'] ;
      $class2_focus = $_POST['classFocus_2'] = $row['savemon_class2_focus'] ;
      $class3_focus = $_POST['classFocus_3'] = $row['savemon_class3_focus'] ;
      $mon_temp =  $_POST['mon_tem'] =   $row['savemon_mon_temp'] ;
      $mon_temp2 =  $_POST['mon_tem2'] =   $row['savemon_mon_temp2'];
      $savemon_camp = $_POST['savemon_camp'] = $row['savemon_camp'];
      $savemon_sub = $_POST['savemon_sub'] = $row['savemon_sub'];
      $savemon_name = $_POST['savemon_name'] = $row['savemon_name'];
      $savemon_desc = $_POST['savemon_desc'] = $row['savemon_desc'];

//       addslashes($str)

      parse_str($savemon_monster,$monster_a);
//      echo "getSaveMon" ;
// cant to as function any more becaus of globals not working PDS 24/07/18
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

//      getSaveMon($savemon_monster);

     $save_key_old = $save_mon;
//     echo "save_key_old " . $save_key_old;
     $user = $user_save;
//     echo $user;
     $_SESSION['smon_name'] = $mon_name;
     $_SESSION['sclass1_tp'] = $class1_tp;
     $_SESSION['sclass1_level'] = $class1_level;
     $_SESSION['sclass2_tp'] = $class2_tp;
     $_SESSION['sclass2_level'] = $class2_level;
     $_SESSION['snew'] = "NO";
     $_SESSION['sprint'] = $mon_print;
     $_SESSION['sclass1_focus'] = $class1_focus;
     $_SESSION['sclass2_focus'] = $class2_focus;
     $_SESSION['smon_template'] = $mon_temp;
     $_SESSION['smon_template2'] = $mon_temp2;
   }
//echo "template = " . $mon_temp . "</BR>";
 //    echo "mon name  = " . $mon_name;
   $select = "SELECT monster2.mon_key_1,mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed , mon_speed_fly, mon_speed_climb, mon_speed_swim, mon_speed_burrow, ".
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, montype_skillp, montype_att, montype_cr, mon_template, mon_alignment, mon_environment, mon_level_adj," .
                   " mon_ac_deflect, mon_ac_insight, mon_ac_profane, mon_ac_dodge, mon_ac_luck, mon_skill_rule ".
                   "from monster2, montype2 where mon_name = '$mon_name' and mon_type = montype and (monster2.mon_key_1 = '$wp_user' or monster2.mon_key_1 = '$key_1')" .
                   " and montype2.mon_key_1 = '$key_1'";
//echo $select;
//  include $includePathLocal.'/includes/dd_db_conn.txt';
	$link = getDBLink();


  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
/*

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

	extract($row, EXTR_OVERWRITE);

	/*  Cast to int any vars which are varchar in the DB but hod numerics */
	$mon_con = (int)$mon_con;
	$mon_cr = (int)$mon_cr;
	$mon_ac_flat = (int)$mon_ac_flat;
	$mon_speed_fly_save = $mon_speed_fly;
//	echo $montype_skillp;
        $mon_skillp = $montype_skillp;
	$mon_key_1 = $row[0];
//        echo "mon name  = " . $mon_name;
//        echo "mon speedd = " . $mon_speed;
  $terain = $mon_environment;
  $d = strpos($mon_hd,"D");
  if ($d == FALSE){
      $d = strpos($mon_hd,"d");
   }
  if ($d == FALSE){
     $mon_die = "D8";
     $mon_level = $mon_hd;
  }else{
     $len = strlen($mon_hd);
     $mon_level = (int)substr($mon_hd,0,($d));
     $mon_die = substr($mon_hd,$d,$len);
 }
  $d = strpos($mon_hd,"D");
  if ($d == FALSE){
     $d = strpos($mon_hd,"d");
  }
  if ($d == FALSE){
   $mon_hd_original = $mon_hd;
  }else{
     $len = strlen($mon_hd);
     $mon_hd_original = (int)substr($mon_hd,0,($d));
  }
   $mon_size_original = $mon_size;
   $sizehd_v = "size" .$mon_hd_original . $mon_die .  "_v";
   global $$sizehd_v;
   $total_level = $class1_level + $class2_level + $class3_level;
   $total_class_level = $class1_level + $class2_level + $class3_level;
   $total_level_bonus = round(($total_level / 4 -0.5), 0);
   $title_desc = $mon_name;
   if ($mon_temp !=""){
     $title_desc .= " $mon_temp ";
   }
   if ($mon_temp2 !=""){
     $title_desc .= " $mon_temp2 ";
   }
   if ($class1_tp != ""){
       $title_desc .= "($class1_tp $class1_level";
   }
   if ($class2_tp != ""){
       $title_desc .= " / $class2_tp $class2_level";
   }
   if ($class1_tp !="" or $class1_tp != ""){
       $title_desc .= ")";
   } 
 //  echo $title_desc;
//  echo "lev bonus " . $total_level_bonus;

//   if ($elite == "Y"){
   if ($class1_tp !=""){
     
     if ($class1_tp == "Animal Companion"){
       if (  $old_animal_comp_level !=""){
          $class1_level = $old_animal_comp_level;
       }
      $select = "select classl_ac_hd from classlev2 where classl_tp = '$class1_tp' and classl_lev = $class1_level and mon_key_1 = '$key_1'";
      $link = getDBLink();
 //      echo $select;
//  include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $select) ;
       $row = mysqli_fetch_array($result);
       $old_animal_comp_level  = $class1_level;
       $class1_level = $row['classl_ac_hd'];
       $new_animal_comp_level  = $class1_level;
     }
     if ( $class1_level >= $class2_level){
       $class_tp = $class1_tp;
       $class_focus = $class1_focus;
     }else{
       $class_tp = $class2_tp;
       $class_focus = $class2_focus;
     }
     $select = "select classh_atr1, classh_atr2, classh_atr3, classh_atr4, classh_atr5, classh_atr6, class_cr_mult from  classfocush2, class2 " .
               "where classfh_class =  '$class_tp' and classfh_focus = '$class_focus' and class_tp = '$class_tp' and " .
               "  class2.mon_key_1 = classfocush2.mon_key_1 and  class2.mon_key_1 = '$key_1'";
//       echo $select;
     $result = mysqli_query($link, $select) ;
     $row = mysqli_fetch_array($result);
     $class_cr_mult = $row['class_cr_mult'];
     if ($class_cr_mult == 1){
         $elite = "Y";
         $class_pc = "Y";
     }
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
//   echo "levelx = $class1_level";
   $atr1_v = "mon_" . strtolower($atr_1);
//   echo $atr1_v;
   $atr2_v = "mon_" . strtolower($atr_2);
   $atr3_v = "mon_" . strtolower($atr_3);
   $atr4_v = "mon_" . strtolower($atr_4);
   $atr5_v = "mon_" . strtolower($atr_5);
   $atr6_v = "mon_" . strtolower($atr_6);
   if ($class1_tp == "Animal Companion"){
       $$atr1_v = $$atr1_v + $total_level_bonus;
   }else{
    if ($elite == "Y"){
      if ($mon_hd_original == 0 or ($mon_hd_original == 1  and $mon_template == "LV")){
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
        if ($$atr5_v != 0){
          $$atr4_v = $$atr4_v - 1;
        }
        if ($$atr6_v != 0){
        $$atr6_v = $$atr6_v - 3;
        }
      }else{
        if ($$atr1_v != 0){
          $$atr1_v = $$atr1_v + 4 + $total_level_bonus;
        }else{
           $bonus_atr1 = 2;
        }
        if ($$atr2_v != 0){
          $$atr2_v = $$atr2_v + 4 ;
        }else{
           $bonus_attr2 = 2;
        }
        if ($$atr3_v != 0){
          $$atr3_v = $$atr3_v + 2;
          if ($bonus_atr1 > 0){
              $$atr3_v = $$atr3_v +  $bonus_atr1;
              $bonus_atr1 = 0;
         }else{
            if ($bonus_atr2 > 0){
             $$atr3_v = $$atr3_v +  $bonus_atr2;
             $bonus_atr2 = 0;
            }
         }   

        }else{
          $bonus_atr3 = 2;
        }
        if ($$atr4_v != 0){
          $$atr4_v = $$atr4_v + 2;
          if ($bonus_atr1 > 0){
              $$atr4_v = $$atr4_v +  $bonus_atr1;
              $bonus_atr1 = 0;
          }else{
             if ($bonus_atr2 > 0){
             $$atr4_v = $$atr4_v +  $bonus_atr2;
              $bonus_atr2 = 0;
             }
          }
        }else{
           $bonus_atr3 = 2;
        }
        if ($$atr5_v != 0){
          if ($bonus_atr1 > 0){
              $$atr5_v = $$atr5_v +  $bonus_atr1;
              $bonus_atr1 = 0;
          }else{
             if ($bonus_atr2 > 0){
              $$atr5_v = $$atr5_v +  $bonus_atr2;
              $bonus_atr2 = 0;
             }else{
                 if ($bonus_atr3 > 0){
                   $$atr5_v = $$atr5_v +  $bonus_atr3;
                   $bonus_atr3 = 0;
                 }
             }
          }
        }
        if ($$atr6_v != 0){
           $$atr6_v = $$atr6_v + -2;
           if ($bonus_atr1 > 0){
              $$atr5_v = $$atr5_v +  $bonus_atr1;
              $bonus_atr1 = 0;
           }else{
             if ($bonus_atr2 > 0){
              $$atr5_v = $$atr5_v +  $bonus_atr2;
              $bonus_atr2 = 0;
             }else{
               if ($bonus_atr3 > 0){
                  $$atr5_v = $$atr5_v +  $bonus_atr3;
                  $bonus_atr3 = 0;
               }
            }
           }
        }
      }

    }else{
      if ($mon_hd_original == 0 or ($mon_hd_original == 1 and $mon_template == "LV")) {
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
//      $$atr5_v = $$atr5_v - 1;
//      $$atr6_v = $$atr6_v - 1;
     }
    }
   }
//  take off armour
   if ($mon_armour != "No Armour"){
     if ($class1_tp == "Barbarian" or $class2_tp == "Barbarian"){
        $mon_armour =  "Hide";
        $mon_shield = "Shield, none";
     }
     if ($class1_tp == "Bard" or $class2_tp == "Bard" or $class1_tp == "Alchemist"  or $class1_tp == "Summoner"   or $class1_tp == "Unchained Summoner"
      or $class2_tp == "Alchemist" or $class1_tp == "Investigator" or $class2_tp == "Investigator" or $class2_tp == "Summoner" or $class2_tp == "Unchained Summoner" ){
        $mon_armour =  "Chain Shirt";
        $mon_shield = "Shield, none";
     }
     if ($class1_tp == "Druid" or $class2_tp == "Druid"){
        $mon_armour =  "Hide";
        $mon_shield = "Shield, heavy wooden";
     }
     if ($class1_tp == "Ninja" or $class2_tp == "Ninja" or $class1_tp == "Gunslinger" or $class2_tp == "Gunslinger" 
        or $class1_tp == "Swashbuckler"   or $class2_tp == "Swashbuckler"    or $class1_tp == "Unchained Rogue" or $class2_tp == "Unchained Rogue"
        or $class1_tp == "Rogue" or $class2_tp == "Rogue"  or $class1_tp == "Brawler" or $class2_tp == "Brawler" ){
        $mon_armour = "Leather";
        $mon_shield = "Shield, none";
     }
     if ($domain_11 == "Gun Tank"){
          $mon_armour = "Breastplate";
          $mon_shield = "Shield, heavy steel";
     }
     if ($class1_tp == "Samurai" or $class2_tp == "Samurai"){
          $mon_armour = "Breastplate";
          $mon_shield = "Shield, heavy steel";
     }
     if (($class1_tp == "Sorcerer" or $class1_tp == "Wizard" or $class1_tp == "Monk"  or $class1_tp == "Unchained Monk"
      or $class1_tp == "Witch" or $class1_tp == "Psion" or $class1_tp == "Adept" or $class1_tp =="Arcanist")
      or  ($class2_tp == "Sorcerer" or $class2_tp == "Wizard" or $class2_tp == "Monk"  or $class2_tp == "Unchained Monk"
      or $class2_tp == "Witch" or $class2_tp == "Psion" or $class2_tp == "Adept"  or $class2_tp =="Arcanist")
      or  ($domain_11 == "Geisha" or $domain_21 == "Geisha") ){
         $mon_armour = "No Armour";
         $mon_shield = "Shield, none";
     }
   }








  $mon_size_original = $mon_size;
  $select = "select size_grapple, size_no from size where size_cat = '$mon_size'";
  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $original_grapple = $row['size_grapple'];
  $original_size_no = $row['size_no'];









  $mon_base_att_orig = $mon_base_att;
  $mon_ac_flat_orig = $mon_ac_flat;
  $mon_int_orig = $mon_int;
 // echo "mon_int_orig $mon_int_orig";
// Monster Feats

  $delete = "delete from feattemp where feattemp_user = '$user'";
//  echo "</BR> " . $delete;
  $result = mysqli_query($link, $delete) ;
  $select = "select monfeat,feat_order from monfeat2, feats2 where mon_name = '$mon_name'
             and (monfeat2.mon_key_1 = '$mon_key_1' or monfeat2.mon_key_1 = '$wp_user') and feats2.mon_key_1 = 'path'
             and monfeat = feat_name";
  //  echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  $mon_feats = 0;
  if (mysqli_num_rows($result) > 0){
    $mon_feats = 0;
    $mon_free_feats = 0;
    while ($row = mysqli_fetch_array($result)) {
      $feat = $row['monfeat'];
      $feat_order = $row['feat_order'];
// if feat is a proficiecy do not include this in the count for the monster as these are free
      if ($feat == "Armour prof light" or $feat == "Armour prof medium" or $feat == "Armour prof heavy" or
          $feat == "Simple Weapon Proficiency" or $feat == "Martial Weap Prof" or $feat == "Shield Proficiency"){
          $mon_free_feats = $mon_free_feats + 1;
//          echo "Free " . $feat;

      }
      $mon_feats = $mon_feats + 1;
//      echo "</BR> feat" . $feat;
//      echo  "user " . $user . " mon " . $mon_name;
      $insert = "INSERT INTO feattemp (feattemp_user , feattemp_feat, feattemp_class, feattemp_auto, feattemp_order) VALUES " .
                "('$user','$feat', '3','Y','$feat_order')";
// echo "</BR> $insert";
      $result1 = mysqli_query($link, $insert);
    }
   }
   $mon_orig_feats = $mon_feats;
 // echo "mon_orig_feats = $mon_orig_feats";

//  Checks for free feats of monster
/*
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
*/
// Monster Weapons
  $mon_weap_s1 = "No Melee";
  $select = "select monweap_attp, monweap_wp, weap_dam, weap_dam2, weap_type, weap_cat, dambase_no, dambase_incr,".
            " monweap_dam from " .
             "monweap2, weapons, dddambase where ".
             "monweap_mon = '$mon_name' and monweap_wp = weap_id and weap_dam = dambase and (mon_key_1 = '$mon_key_1' or mon_key_1 = '$wp_user')";
 // echo "</BR> " . $select. "/BR";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)) {
        $attp = strtolower($row['monweap_attp']);
        $mon_weap_v = "mon_weap_" . $attp ;
        $orig_mon_weap_v = "orig_mon_weap_" . $attp;
        $weap_dam_v = "weap_dam_" . $attp ;
        $orig_monweap_dam_v = "orig_monweap_dam_" . $attp;
        $weap_dam2_v = "weap_dam2_" . $attp ;
        $weap_type_v = "weap_type_" .$attp ;
        $weap_cat_v  = "weap_cat_" . $attp;
        $monweap_dam_v = "monweap_dam_" .$attp;
        $weap_dambase_no_v = "monweap_dambase_no_" . $attp;
        $weap_dambase_incr_v = "monweap_dambase_incr_" . $attp;
        $$mon_weap_v = $row['monweap_wp'];
        $$orig_mon_weap_v =  $row['monweap_wp'];
        $$weap_dam_v = $row['weap_dam'];
        $$orig_monweap_dam_v =  $row['monweap_dam'];
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
  //      echo "</BR> Weapon " . $mon_weap_v . $$mon_weap_v . $$weap_dam_v ."*** </BR>";
    }
  }
  if ($class1_tp == "Monk" or $class2_tp == "Monk" or $class1_tp == "Unchained Monk" or $class2_tp == "Unchained Monk" or  $class1_tp == "Brawler" or $class2_tp == "Brawler"){
     $mon_weap_p = "Unarmed strike";
     $mon_weap_s1 = "Unarmed strike";
   }
   if ($domain_11 == "Geisha" or $domain_21 ==  "Geisha"){
     $mon_weap_p = "Kama" ;
   }
   if ($class1_tp == "Ninja" or $class2_tp == "Ninja"){
      $mon_weap_p =  "Katana";
   }
    if ($class1_tp == "Samurai" or $class2_tp == "Samurai"){
      $mon_weap_p =  "Katana";
   }
   if ($class1_tp == "Gunslinger" or $class2_tp == "Gunslinger"){
      $mon_weap_r =  "Pistol";
   }
   if ($class1_tp == "Swashbuckler" or $class2_tp == "Swashbuckler"){
      $mon_weap_p =  "Rapier";
   }
   if ($class1_tp == "Alchemist" or $class2_tp == "Alchemist"){
      $mon_weap_r =  "Bomb";
      $mon_weap_p = "Mace,Heavy";
   }
   if ($domain_11 == "Musket Master" or $domain_21 == "Musket Master"){
          $mon_weap_r = "Musket";
   }

//
//
//
//
//
//
//echo "domain $domain_11 / $domain_12 / $domain_13 ";
//
 $new = "YES";
 if ($new == "YES"){
	 $link = getDBLink();
//  include 'includes/dd_db_conn.txt';
  $delete = "DELETE FROM skilltemp WHERE skillt_user = '$user'";
//  echo "</BR>" . $delete ;
  $result = mysqli_query($link, $delete) ;
//
  $select = "SELECT monskill_tp, monskill_val,skill_atr, skill_armour_ch, skill_untrained from monskill2, skills WHERE mon_name = '$mon_name'".
             " AND monskill_tp = skill_cd and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user')" ;
//  echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  $count = 0;
  while ($row = mysqli_fetch_array($result)) {
    $count += 1;
    $skill = $row['monskill_tp'];
    $rank  = $row['monskill_val'];
    $atr   = $row['skill_atr'];
    //  if disable device change attribute to dex for pathfinder
    if ($skill == "Disable Device"){
       $atr = "DEX";
    }
    $armour_ch = $row['skill_armour_ch'];
    $skill_untrained = $row['skill_untrained'];
 // check if class skill for monster
 // if mon_skill_type is not "TYPE" then all monster skills are now class skills
 //
    if ($mon_skill_rule == "TYPE" or ($mon_skill_rule !="ALL" and $mon_key_1 != "path") ){
       $select2 = "SELECT count(*) from montpskill where montype = '$mon_type' and skill_cd = '$skill' and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user')";
//       echo $select;
       $result2 = mysqli_query($link, $select2) ;
       $row2 = mysqli_fetch_array($result2);
       $skill_count = $row2[0];
//       echo "count $skill_count";
       if ($skill_count > 0){
         $xskill = "";
       }else{
         $xskill = "Y";
       }
    }else{
       $xskill ="";
    }
    // If can fly then fly is a class skill
    if ($skill == "Fly" and  $mon_speed_fly > 1){
       $xskill = "";
    }


//    if ($skill == "Spot" or $skill == "Listen"){
//       $xskill = "Y";
//    }else{
//       $xskill = "";
//    }
    if ($rank != ""){
      $atr_bonus = 0;
      $misc_bonus = 0;
     $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
               "skillt_misc_bonus , skillt_xskill, skillt_armour_ch, skillt_untrained) " .
               "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch','$skill_untrained')";
      $result1 = mysqli_query($link, $insert);
//
//    echo $insert . " </BR>";
     }
   }
 //  echo "class1_level = $class1_level";
// insert all focus skills into temp dbase
    if ($class1_tp != ""){
      $select = "SELECT classf_class, classf_focus, classf_skill, classf_tp, classf_xskill, skill_atr, skill_armour_ch, skill_untrained " .
               " from classfocus2, skills ".
               "WHERE classf_class = '$class1_tp' and classf_focus = '$class1_focus'" .
                     "and  classf_skill =  skill_cd and mon_key_1 = '$key_1'";
       $link = getDBLink();
      // include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $select) ;
      while ($row = mysqli_fetch_array($result)) {
         $skill = $row['classf_skill'];
         $rank  = 0;
         $xskill = $row['classf_xskill'];
         $atr = $row['skill_atr'];
         //  if disable device change attribute to dex for pathfinder
         if ($skill == "Disable Device"){
            $atr = "DEX";
         }
         $skill_untrained = $row['skill_untrained'];
         $atr_bonus = 0;
         $misc_bonus = 0;
         $armour_ch = $row['skill_armour_ch'];
         $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                   "skillt_misc_bonus , skillt_xskill,skillt_armour_ch, skillt_untrained) " .
                   "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch', '$skill_untrained')";
         $result1 = mysqli_query($link, $insert);
         if ($result1){
         }else{
           if ($xskill != "Y"){
             $update = "UPDATE skilltemp set skillt_xskill = '$xskill' where skillt_user = '$user' and skillt_skill = '$skill'";
             $result2 = mysqli_query($link, $update);
           }
         }
     }
    }
    if ($class2_tp != ""){
      $select = "SELECT classf_class, classf_focus, classf_skill, classf_tp, classf_xskill, skill_atr, skill_armour_ch, skill_untrained " .
                " from classfocus2, skills ".
               "WHERE classf_class = '$class2_tp' and classf_focus = '$class2_focus'" .
                      "and  classf_skill =  skill_cd and mon_key_1 = '$key_1'";
//echo "</BR> $select";
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      while ($row = mysqli_fetch_array($result)) {
         $skill = $row['classf_skill'];
         $rank  = 0;
         $xskill = $row['classf_xskill'];
         $atr = $row['skill_atr'];
         //  if disable device change attribute to dex for pathfinder
         if ($skill == "Disable Device"){
            $atr = "DEX";
         }
         $skill_untrained = $row['skill_untrained'];
         $atr_bonus = 0;
         $misc_bonus = 0;
         $armour_ch = $row['skill_armour_ch'];
         $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                   "skillt_misc_bonus , skillt_xskill, skillt_armour_ch, skillt_untrained) " .
                    "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch', '$skill_untrained')";
// echo "</BR> $insert";
         $result1 = mysqli_query($link, $insert);
         if ($result1){
         }else{
           if ($xskill != "Y"){
             $update = "UPDATE skilltemp set skillt_xskill = '$xskill' where skillt_user = '$user' and skillt_skill = '$skill'";
             $result2 = mysqli_query($link, $update);
           }
         }
      }
    }
    if ($class3_tp != ""){
      $select = "SELECT classf_class, classf_focus, classf_skill, classf_tp, classf_xskill, skill_atr, skill_armour_ch, skill_untrained " .
                " from classfocus2, skills ".
               "WHERE classf_class = '$class3_tp' and classf_focus = '$class3_focus'" .
                      "and  classf_skill =  skill_cd and mon_key_1 = '$key_1'";
//echo "</BR> $select";
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      while ($row = mysqli_fetch_array($result)) {
         $skill = $row['classf_skill'];
         $rank  = 0;
         $xskill = $row['classf_xskill'];
         $atr = $row['skill_atr'];
         //  if disable device change attribute to dex for pathfinder
         if ($skill == "Disable Device"){
            $atr = "DEX";
         }
         $skill_untrained = $row['skill_untrained'];
         $atr_bonus = 0;
         $misc_bonus = 0;
         $armour_ch = $row['skill_armour_ch'];
         $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                   "skillt_misc_bonus , skillt_xskill, skillt_armour_ch, skillt_untrained) " .
                    "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch', '$skill_untrained')";
// echo "</BR> $insert";
         $result1 = mysqli_query($link, $insert);
         if ($result1){
         }else{
           if ($xskill != "Y"){
             $update = "UPDATE skilltemp set skillt_xskill = '$xskill' where skillt_user = '$user' and skillt_skill = '$skill'";
             $result2 = mysqli_query($link, $update);
           }
         }
      }
    }
  }
  $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level2 where lev_no = '$mon_hd_original' and mon_key_1 = '$key_1'" ;

//   include 'includes/dd_db_conn.txt';

   $link = getDBLink();

   $result = mysqli_query($link, $select) ;
   if (mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      $mon_orig_attg = $row['lev_attg'] ;
      $mon_orig_atta = $row['lev_atta'] ;
      $mon_orig_attp = $row['lev_attp'] ;
   }
//   echo "mon template 1 " . $mon_temp;
   $tem_will_sv = 0;
   $tem_fort_sv = 0;
   $tem_reflex_sv = 0;
   $tem_cr = 0;
  // echo "mon_size = $mon_size";
   if ($_POST){
     if (isset($_POST['mon_size'])){
        $mon_size_p =  $_POST['mon_size'];
     }else{
        $mon_size_p = "";
     }

     if ($mon_size_p == ""){
     }else{
        $mon_size = $mon_size_p;
     }
   }
   if ($mon_temp != ""){
      $x = addTemplate($mon_temp);
   }
//   echo "int1 = $mon_int";
   if ($mon_temp2 != ""){
      $x = addTemplate($mon_temp2);
   }
//    echo "int2 = $mon_int";
//   echo "fly = $mon_speed_fly";
   $mon_speed_fly_save = $mon_speed_fly;
//   if ($mon_size_p == ""){
//   }else{
//      $_POST['mon_speed_fly'] = $mon_speed_fly;
//   }
   if ($mon_hd_original > 0){
       $calc_mon_feats =  round((($mon_hd_original /2) -0.5),0) +1;
   // check if int has been changed
       if (isset($_POST['mon_int'])){
            if ($_POST['mon_int'] > ""){
              $mon_int = $_POST['mon_int'];
            }
 //           echo "int2 = $mon_int";
       }
       if ($mon_int == 0){
         $calc_mon_feats = 0;
       }
 //      echo "calc " . $calc_mon_feats . " mon " . $mon_feats . " free " . $mon_free_feats ;
       if ($calc_mon_feats < ($mon_feats - $mon_free_feats)){
         $diff = $mon_feats - ($calc_mon_feats + $mon_free_feats);
//         echo "diff " . $diff;
         $mon_free_feats =  $mon_free_feats + $diff;
       }
   }
//   echo "mon_size2 = $mon_size";
//Monbuffs

//  echo "int2 = $mon_int";
  $x = monbuff();
//   echo "int2 = $mon_int";
//   echo "</BR>mon_size2 = $mon_size</BR>";
//
//
//
}else{
   $local =  $_SERVER['SERVER_NAME'];
   if ($local == "paulds-1.vm.bytemark.co.uk"){
       $location_sel = '"http://' . $local . './index.php"';
   }else{
       $location_sel =  '"http://' . $local . $defaultPath . '"' ;
   }
echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript">
   alert( "$location_sel" );
     window.location = $location_sel;
  </script>

EOF;
}
if ($save_mon != ""){
   parse_str($savemon_monster,$monster_a);
//      echo "getSaveMon" ;
// not doing as a function any more because globals not working
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
//   getSaveMon($savemon_monster);
   $_POST['mon_hd'] = $mon_hd;
   $save_key_old = $save_mon;
//   echo "save_key_old " . $save_key_old;
   $user = $user_save;
//   echo $user;
}
//echo "mon intt = $mon_int";
//echo "mon_speed = $mon_speed";
$date2 =  date('Ymd');

if ($_POST) {
   $msg = "" ;
    $post_count = 0;
    $save_post = "";
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
//       echo "<div>$k $v </div>";
       if ($k == "savemon_desc"){
          $$k = strip_tags($v);
//          echo $savemon_desc;
       }else{
//       "user_login" => $user_name_wp, "user_password" => $password_wp, "remember" => $remember
         $post_count .=1;
         if ($post_count >1){
           $save_post .= "&";
         }
      // $save_post .= '"' . $k . '"' . ' => ' . '"' . $v . '"';
         $vi = str_replace("+", "�", $v);
         $vi = str_replace("'", "|", $vi);
         $vi = str_replace("&", "#", $vi);

         $save_post .= $k . '='  . $vi ;
       }
    }

 //  echo "mon int2 $mon_int";
    if (isset($_POST['mon_type'])){
    }else{
        $_POST['mon_type'] = "";
    }
    if ($_POST['mon_type'] != ""){
//      echo $save_post;
      if ($wp_user != ""){
           $save_key = $wp_user;
      }else{
           $save_key = $user;
      }
//     echo " Post save count = " . $save_count;
      $delete = "DELETE from savemon where savemon_key = '$save_key'";
      $savemon_date = time();
      $link = getDBLink();
      $result3 = mysqli_query($link, $delete) ;
      if ($new_animal_comp_level > 0){
         $class1_level = $old_animal_comp_level;
      }
      $class4_focus = "";
      $class5_focus = "";
      $class4_level = "";
      $class5_level = "";
 //      echo "levelx = $class1_level";
      $insert = "INSERT INTO savemon (savemon_key, savemon_cr, savemon_terain, savemon_monster, savemon_user, savemon_mon_name, savemon_class1_tp," .
              "savemon_class2_tp, savemon_class3_tp, savemon_class4_tp, savemon_class5_tp, savemon_mon_temp, savemon_class1_focus, savemon_class2_focus, " .
              "savemon_class3_focus, savemon_class4_focus, savemon_class5_focus, savemon_class1_level, savemon_class2_level, savemon_class3_level," .
              "savemon_class4_level, savemon_class5_level, savemon_date, savemon_name, savemon_camp, savemon_sub, savemon_wp_user, savemon_mon_key_1, " .
              "savemon_mon_type, savemon_temp_type, savemon_desc, savemon_mon_temp2, savemon_date2) " .
              " VALUES ('$save_key','$cr', '$terain', '$save_post', '$user', '$mon_name', '$class1_tp', '$class2_tp', '$class3_tp','','', '$mon_temp', '$class1_focus'," .
              "'$class2_focus', '$class3_focus','$class4_focus','$class5_focus', '$class1_level', '$class2_level', '$class3_level','$class4_level','$class5_level', '$savemon_date', " .
              " '$savemon_name', '$savemon_camp', '$savemon_sub','$wp_user','$mon_key_1', '$mon_type', '$tem_type','$savemon_desc', '$mon_temp2','$date2') ";
      $result4 = mysqli_query($link, $insert) ;
//      echo "**** name = " . $savemon_name;
      if ($_POST['print_ind'] == "Save"or $_POST['print_ind'] == "New Save"){
// if not from encounter generator set save key to saved monter ket from edit saved NPC's
//echo "encounter = " . $encounter;
           if ($encounter != "Y"){
              $save_key = $save_key_old;
           }else{
             $savemon_camp = "";
             $savemon_sub = "";
             $savemon_name = "";
             $save_key = $save_count;
           }
           if ($_POST['print_ind'] == "New Save"){
               $savemon_name = "";
               $save_key = $save_count;
               $save_key_old = $save_key;
            }

//         echo "save key " . $save_key;
//         echo "save_count $save_count";
//          echo "**** name = " . $savemon_name;
          if ($save_key == "" or $save_key == $wp_user or $save_key == $user_id){
              $save_key = $save_count;
          }

//               echo "wp user " . $wp_user . $save_key;
//          echo "save_key2 $save_key";
          $delete = "DELETE from savemon where savemon_key = '$save_key'";
          $result3 = mysqli_query($link, $delete) ;
          $insert = "INSERT INTO savemon (savemon_key, savemon_cr, savemon_terain, savemon_monster, savemon_user, savemon_mon_name, savemon_class1_tp," .
              "savemon_class2_tp, savemon_class3_tp, savemon_class4_tp, savemon_class5_tp, savemon_mon_temp, savemon_class1_focus, savemon_class2_focus, " .
              "savemon_class3_focus, savemon_class4_focus, savemon_class5_focus, savemon_class1_level, savemon_class2_level, savemon_class3_level," .
              "savemon_class4_level, savemon_class5_level, savemon_date, savemon_name, savemon_camp, savemon_sub, savemon_wp_user, savemon_mon_key_1, " .
              "savemon_mon_type, savemon_temp_type, savemon_desc,savemon_mon_temp2, savemon_date2) " .
              " VALUES ('$save_key','$cr', '$terain', '$save_post', '$user_id', '$mon_name', '$class1_tp', '$class2_tp', '$class3_tp','','', '$mon_temp', '$class1_focus'," .
              "'$class2_focus', '$class3_focus','$class4_focus','$class5_focus', '$class1_level', '$class2_level', '$class3_level','$class4_level','$class5_level','$savemon_date', " .
              " '$savemon_name', '$savemon_camp', '$savemon_sub','$wp_user', '$mon_key_1', '$mon_type', '$tem_type', '$savemon_desc','$mon_temp2','$date2') ";
          $result4 = mysqli_query($link, $insert) ;

      }

   }
//   echo "</BR>mon_size2 = $mon_size</BR>";
   //reset animal comp level to hd after savemon
   if ($new_animal_comp_level > 0){
       $class1_level = $new_animal_comp_level;
   }

 //   echo "levelx = $class1_level";
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
//      $update  = "UPDATE lastmon SET lastmon_mon_name = '$mon_name', lastmon_class1_tp = '$class1_tp', lastmon_class1_level = '$class1_level', " .
//      "lastmon_class1_focus = '$class1_focus', lastmon_class2_tp = '$class2_tp', lastmon_class2_level = '$class2_level', lastmon_class2_focus = '$class2_focus', " .
//      "lastmon_text = '$mon_print'  WHERE lastmon_count = '$oldmon_key'";
//      $link = getDBLink();
//      $result3 = mysqli_query($link, $update) ;
   }
//   echo $_SERVER['HTTP_REFERER'];

}
//echo "mon int $mon_int";
 //echo "</BR>mon_size2 = $mon_size</BR>";
if ($skill_1 == "" and $skill_1_rank  > 0){
   $skill_spent += $skill_1_rank;
}
 // add in any skills added in manually
if ($skill_1 != "" or $skill_no_extra > 0){
   if ($skill_1 !=""){
       $skill_no_extra += 1;
       $skill_r = "skille_" . $skill_no_extra;
       $$skill_r = $skill_1;
       $ranke_r = "ranke_" . $skill_no_extra;
       $$ranke_r  = $skill_1_rank;
    }
    $count = 0;
    while ($count < $skill_no_extra){
       $count +=1;
       $skill_r = "skille_" . $count;
       $skill = $$skill_r;
       $select = "select skill_cd, skill_atr, skill_armour_ch, skill_untrained from skills where skill_cd = '$skill'";
       $result = mysqli_query($link, $select) ;
       while ($row = mysqli_fetch_array($result)){
          $skill = $row['skill_cd'];
          $rank_r = "ranke_" . $count;
          $rank = $$rank_r;
          $atr = $row['skill_atr'];
          //  if disable device change attribute to dex for pathfinder
          if ($skill == "Disable Device"){
              $atr = "DEX";
          }
          $skill_untrained = $row['skill_untrained'];
          $xskill = "Y";
          $armour_ch = $row['skill_armour_ch'];
          if ($skill !=""){
             $insert = "INSERT INTO skilltemp (skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                 "skillt_misc_bonus , skillt_xskill, skillt_armour_ch, skillt_untrained) " .
                 "VALUES ('$user', '$skill', '$rank', '$atr', '$atr_bonus', '$misc_bonus', '$xskill','$armour_ch', '$skill_untrained')";
             $result1 = mysqli_query($link, $insert);
           if ($result1){
           }else{
               $skill_spent += $rank;
               $$rank_r = "";
               $$skill_r = "";
           }
          }
       }
    }
}

//echo "$mon_print $location_print" ;
//if ($print_ind == "Plain Text Version"){
//    $_SESSION['sprint'] = $mon_print;
//echo <<<EOF
//  <SCRIPT LANGUAGE="JavaScript">
//     window.location = '$location_print';
//  </script>
//EOF;
//}
$feat_atth = 0;
$feat_atthd = 0;
$feat_attr = 0;
$feat_attrd = 0;
$feat_exatta = 0;
$feat_attf = 0;
$exatta = "";
$feat_exattr = 0;
$feat_init = 0;
$exatta1 = 0;
$exattr1 = 0;
$range_mod = 0;
$feat_psi_points = 0;
$dodge = 0;


// check magic items
$magic_tohit_p =  0;
$magic_damage_p = 0;
$magic_tohit_r = 0;
$magic_damage_r = 0;
$feat_inert_arm = 0;
$feat_attu = $feat_attud = 0;
$magic_will_sv = $magic_fort_sv = $magic_reflex_sv  = 0 ;
$magic_speed = 0;
$mon_nat_armour_ft = 0;
$magic_shield = 0;
$magic_armour = 0;
$magic_skill_all = 0;
$magic_armour_nac = 0;
$htmlp_spell_abil = "";
$htmlp_spell_abil_s = "";
$print_aura = "";
$print_attack = "";
$print_ranged = "";
$print_CMD = "";
$print_CMB = "";
$print_reach = "";
$print_specdesc = "";
$AC_text = "";
$save_text = "";
$print_init = "";
$sen_text = "";
$speed_text = "";
$reach_text = "";
$init_text = "";
$resist_text = "";
$htmlp_def = "";

//echo "level = $class1_level";

$print_special_attacks_s = "";
if ($buffx_level_1 == "" or  $buffx_level_1 == "0" ){
  $buffx_level_1 = $class1_level;
}
if ($buffx_level_2 == "" or $buffx_level_2 == "0"){
  $buffx_level_2 = $class1_level;
}
if ($buffx_level_3 == "" or $buffx_level_3 == "0"){
  $buffx_level_3 = $class1_level;
}


//
//

//require $includePathLocal."/ddmonsterFunctions.php";




//Get monster level
//
$mon_hd = strtoupper($mon_hd);
$d = strpos($mon_hd,"D");
if ($d == FALSE){
   $d = strpos($mon_hd,"d");
}
if ($d == FALSE){
  $mon_die = "D8";
  $mon_level = $mon_hd;
}else{
  $len = strlen($mon_hd);
  $mon_level = (int)substr($mon_hd,0,($d));
  $mon_die = substr($mon_hd,$d,$len);
}
//echo "</BR>mon_level = $mon_level mon_die = $mon_die";
// half dragons increase HD by one catagory
// echo "override = " .    $tem_hd_override;
// echo "</BR> level = " . $mon_level . " hd = " . $mon_die;
// echo "die_increase = " .    $die_increase;
if ($mon_temp != ""){
   if ($tem_hd_override == "Y" and $die_increase == ""){
       $die_increase = "Y";
       if ($mon_die == "D4"){
          $mon_die = "D6";
       }else{
           if ($mon_die == "D6"){
              $mon_die = "D8";
           }else{
             if ($mon_die == "D8"){
                 $mon_die = "D10";
             }else{
                if ($mon_die == "D10"){
                   $mon_die = "D12";
                }
             }
           }
       }
   }
   if ($tem_type == "Undead"){
      $mon_die = "D8";
   }
}
if ($foo_temp == "Y"){
   $mon_die = "D10";
}   
// echo "</BR>mon_size0 = $mon_size";
$mon_hd = $mon_level . $mon_die;
$HD_HTML = monHDHTML($mon_hd);
//echo "</BR>mon_size = $mon_size";
$mon_size_save = $mon_size;
if ($mon_size_u != "" and $mon_size_m != ""){
    $mon_size = $mon_size_u;
}
if ($mon_size_old == ""){
   $mon_size_u = $mon_size;
   $mon_size_old = $mon_size;
   $mon_level_old = $mon_level;
}
//echo "</BR>old size " . $mon_size;
$sizehd_v = "size" . $mon_level . $mon_die . "_v";
global $$sizehd_v;
//echo "level = $class1_level";
$x = changeSize();
//echo "</BR>new size " . $mon_size;
if ($mon_size_save != $mon_size){
// echo "changed size $mon_size_save : $mon_size";
   $mon_size_new = $mon_size;
   $size_changed_sel = "Y";
}
$mon_size_old = $mon_size;
$mon_level_old = $mon_level;
// save size before magic adjustment
$mon_size_u = $mon_size;
$mon_size_m_old = $mon_size_m;
$mon_size_m = "";

$m = magicAttr();
//echo $mon_size_m . ":" . $mon_size_m_old . ":" . $mon_size_save . ":" . $mon_size_u;
//echo "mon size_m = $mon_size_m";
if ($mon_size_m != ""){
    $mon_size = $mon_size_m;
}else{
     // if enlarge was taken off restore the unmagic size
    if ($mon_size_m_old != ""){
       $mon_size = $mon_size_u;
    }else{
//       echo "size changed sel = $size_changed_sel advance $advance";
      if ($size_changed_sel != "Y"){
         $mon_size = $mon_size_save;
         $sizehd_v = "size" . $mon_level . $mon_die . "_v";
         global $$sizehd_v;
         $x = changeSize();
      }
   }
}
// echo "</BR> level = " . $mon_level . " hd = " . $mon_die;
//
  //Calculate stat bonus
//
//
//echo "</BR>mon_size 2 = $mon_size";
$speed = 0;
$class_feats = 0;
$delete = "delete from specw where specw_user = '$user'";
$result = mysqli_query($link, $delete) ;
//$mon_con = 30;
//echo "</BR>calling con = $mon_con" ;
//attribute bonus may be changed ny classspec so calc before and after
//  echo "mon_int $mon_int";
$x = get_attr_bonus();
//echo "mon_int $mon_int";
//echo "mon_int_bonus_orig $mon_int_bonus_orig ";
//
//echo "level = $class1_level";
//echo "after call $mon_con";
if (($class1_tp  !="" or $class2_tp != "" or $class3_tp != "" ) and $zombie != "Y"){
   $x = classspec();
}
//echo "after level $class1_level";
//$x = get_attr_bonus();



//
//
//
//  get monster class level
//
//
//
// echo $mon_level;
//
if ($mon_level == ""){
   $mon_level = 0;
}

$select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
 "lev_abil from level2 where lev_no = $mon_level and mon_key_1 = '$key_1'" ;
//echo $select;
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
  $mon_lev_sklr = $row['lev_sklr'] ;
  $mon_lev_sklx = $row['lev_sklx'] ;
  $mon_lev_feat = $row['lev_feat'] ;
  $mon_lev_abil = $row['lev_abil'] ;
}else{
  $mon_lev_savg = 0 ;
  $mon_lev_savp = 0 ;
  $mon_lev_attg = 0 ;
  $mon_lev_atta = 0 ;
  $mon_lev_attp = 0 ;
  $mon_lev_sklr = 0 ;
  $mon_lev_sklx = 0; ;
  $mon_lev_feat = 0; ;
  $mon_lev_abil = 0 ;
}
//
// saving throws
//
//echo "level = $class1_level";
$pal = 0;
if (($class1_tp == "Paladin" and $class1_level > 1) or
    ($class2_tp == "Paladin" and $class2_level > 1) or
    ($class1_tp == "Antipaladin" and $class1_level > 1) or
    ($class2_tp == "Antipaladin" and $class2_level > 1) or
    ($class3_tp == "Blackguard" and $class3_level > 1)){
   $pal = $mon_chr_bonus;
}
if ($tem_type == "Undead"){
   $mon_sv_will = $tem_sv_will;
   $mon_sv_fort = $tem_sv_fort;
   $mon_sv_reflex = $tem_sv_reflex;
   if ($mon_chr < 10){
     $mon_chr = 10;
   }
//   echo "will $mon_sv_will fort $mon_sv_fort reflex $mon_sv_reflex";
}
//
if ($mon_sv_will == 'G'){
    $mon_will_sv = $mon_lev_savg + $pal ;
}else{
    $mon_will_sv = $mon_lev_savp + $pal ;
}
if ($mon_sv_fort == 'G'){
    $mon_fort_sv = $mon_lev_savg + $pal ;
}else{
    $mon_fort_sv = $mon_lev_savp + $pal ;
}
if ($mon_sv_reflex == 'G'){
    $mon_reflex_sv = $mon_lev_savg + $pal ;
}else{
    $mon_reflex_sv = $mon_lev_savp + $pal ;
}
//
//  Find how good monsters attack is
//
//
//echo "</BR> $mon_sv_reflex $mon_reflex_sv ";
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
// echo "levelx = $class1_level";
If ($mon_level != "1"){
    $slash = strpos($mon_base_att_x,"/");
    if ($slash){
      $mon_base_att =  (int)substr($mon_base_att_x,0,$slash);
   }else{
      $mon_base_att = (int)$mon_base_att_x;
   }
}

$mon_base_att += $tem_base_att;

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
//echo "mon_skillp = $mon_skillp  mon_int_bonus_orig = $mon_int_bonus_orig mon_int_bonus_skill = $mon_int_bonus_skill";

$mon_skill_b_orig = $mon_skillp + $mon_int_bonus_orig;
//echo "mon_skill_b_orig =  $mon_skill_b_orig  mon_skillp = $mon_skillp  mon_int_bonus_orig = $mon_int_bonus_orig";
$mon_skill_b = $mon_skillp + $mon_int_bonus_skill;
// if half dragon or half fiend template use their skillp
if ($mon_temp != ""){
  if ($tem_skillp > 0){
     $mon_skill_b = $tem_skillp + $mon_int_bonus_skill;
  }
}

//
//  monster skills
// add race bonus
$delete = "delete from skilltemprb where skilltrb_user = '$user'";
$result = mysqli_query($link, $delete) ;
$x = addskillrb($mon_name);
//


if ($mon_skill_b < 1){
   $mon_skill_b = 1;
}
if ($mon_skill_b_orig < 1){
   $mon_skill_b_orig = 1;
}
//echo "p " . $mon_skillp . " b ". $mon_skill_b;
if ($mon_level > 0){
   $mon_skill_points_total = (($mon_level ) * $mon_skill_b);
}else{
   $mon_skill_points_total = 0;
}


if ($mon_hd_original > 0){
  $mon_skill_points = (($mon_level )  * $mon_skill_b) - (($mon_hd_original ) * $mon_skill_b_orig);
}else{
  $mon_skill_points = (($mon_level)  * $mon_skill_b) - (($mon_hd_original) * $mon_skill_b_orig);
}
//check for zombie
if ($mon_int == 0){
   $mon_skill_points_total = 0;
}
//echo "levelx = $class1_level";
$max_skill_rank = $mon_level + $class1_level + $class2_level + $class3_level;
//echo "</BR> $mon_skill_b_orig hd $mon_hd_original";
//echo "</BR> mon skill points =" . $mon_skill_points;
While ($mon_skill_points > 0){
   $select = "SELECT MIN(skillt_rank) FROM skilltemp, monskill2 where skillt_user = '$user' " .
             "and mon_name = '$mon_name' and skillt_skill = monskill_tp and mon_key_1 = '$key_1'";
   $select = "SELECT MIN(skillt_rank) FROM skilltemp where skillt_user = '$user' " ;

//   echo "</BR>" . $select;
$link = getDBLink();
//   include 'includes/dd_db_conn.txt';
   $result = mysqli_query($link, $select);
//   echo "</BR> rows " . mysqli_num_rows($result);
   if (mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_array($result);
     $min = $row[0];
     if ($min >= $max_skill_rank){
         $min = "";
         $mon_skill_points_save = $mon_skill_points;
         $mon_skill_points = 0;
     }
     if ($min !=""){
//     echo "$MIN " . $min;
       $select2 = "select skillt_skill from skilltemp, monskill2 where skillt_rank = '$min' and skillt_user = '$user'" .
                 " and mon_name = '$mon_name' and skillt_skill = monskill_tp and mon_key_1 = '$key_1'";
                 $select2 = "select skillt_skill from skilltemp where skillt_rank = '$min' and skillt_user = '$user'" ;

//       echo "</BR>" . $select2;
       $result2 = mysqli_query($link, $select2);
       while (($row2 =  mysqli_fetch_array($result2)) and $mon_skill_points > 0){
         $skill = $row2['skillt_skill'];
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
//echo "</BR> mon_skill_points_save " . $mon_skill_points_save;
//
//
//
//
//
//
//
if ($class1_tp == "Wizard" and $domain_11 == ""){
   $domain_11 = "Universal";
}
if ($class2_tp == "Wizard" and $domain_21 == ""){
   $domain_21 = "Universal";
}
//
//
//echo "levelx = $class1_level";
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
  $select = "SELECT class_tp, class_att, class_fort, class_ref, class_will, class_skillp, class_spat, class_hd, class_cr_mult, ".
            "class_psi, class_spell_list_1, class_spell_list_2 from class2 where class_tp ='$class1_tp'  and mon_key_1 = '$key_1'";
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
  $class1_spat = trim($row['class_spat']) ;
  $class1_cr_mult  = $row['class_cr_mult'] ;
  $class1_psi = $row['class_psi'];
  $class1_spell_list_1 = $row['class_spell_list_1'];
  $class1_spell_list_2 = $row['class_spell_list_2'];
 // echo "spell list 1 $class1_spell_list_1";
  if ($class1_spat != "" or $class1_psi != "" ){
     $caster = "Y";
  }
  $class1_hd = $row['class_hd'] ;


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
//  if ($mon_hd_original == 0){
//      $skill_bonus = 3;
//  }




   $class1_skill_points = ($class1_level + $skill_bonus) * $class1_skill_p_l ;
  if ($zombie_tem === 0){
    $class2_hd = "1D8";
    $class2_skill_points = 0;
  }
  
  //if ($mon_name == "Human" and $key_1 == "path"){
 //  $class1_skill_points += 3;
 // }
//  echo "class " . $class1_skill_points;
//
//  get class level
//
//
  $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level2  where lev_no = $class1_level  and mon_key_1 = '$key_1'" ;
//
$link = getDBLink();

//  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class1_lev_savg = (int)$row['lev_savg'] ;
  $class1_lev_savp = (int)$row['lev_savp'] ;
  $class1_lev_attg = (int)$row['lev_attg'] ;
  $class1_lev_atta = (int)$row['lev_atta'] ;
  $class1_lev_attp = (int)$row['lev_attp'] ;
  $class1_lev_sjlr = (int)$row['lev_sklr'] ;
  $class1_lev_sklx = (int)$row['lev_sklx'] ;
  $class1_lev_feat = (int)$row['lev_feat'] ;
  $class1_lev_abil = (int)$row['lev_abil'] ;
  if ($zombie_tem === 0 ){
      $class1_will = 'G';
      $class1_fort = 'P';
      $class1_reflex  = 'P';
      $class1_atta = 'A';
  }
  if ($mon_int == 0){
     $class1_skill_points = 0;
  }
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
  if ($zombie_tem === 0){
    $class1_lev_feat = 0;
    $class1_hd = "1D8";
  }
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
//echo "levelx = $class1_level";
if ($class2_tp != ""){
  $select = "SELECT class_tp, class_att, class_fort, class_ref, class_will, class_skillp, class_spat, class_hd, class_cr_mult, ".
            "class_psi, class_spell_list_1, class_spell_list_2 from class2 where class_tp ='$class2_tp'  and mon_key_1 = '$key_1'";
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
  $class2_spat = trim($row['class_spat']) ;
  $class2_hd = $row['class_hd'] ;
  $class2_cr_mult = $row['class_cr_mult'] ;
  $class2_psi = $row['class_psi'];
  $class2_spell_list_1 = $row['class_spell_list_1'];
  $class2_spell_list_2 = $row['class_spell_list_2'];

  if ($class2_spat != "" or $class2_psi != ""){
     $caster = "Y";
  }
  $class2_skill_p_l = $class2_skillp + $mon_skillp + $human_skill_points ;
  if ($class2_skill_p_l < 1 ){
     $class2_skill_p_l = 1;
  }
  $class2_skill_points = $class2_level * $class2_skill_p_l;
  if ($zombie_tem === 0 ){
     $class2_hd = "1D8";
  }
  if ($mon_int == 0){
     $class2_skill_points = 0;
  }

//
//  get class level
//
//
  $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level2 where lev_no = $class2_level  and mon_key_1 = '$key_1'" ;
//
//  include 'includes/dd_db_conn.txt';

  $link = getDBLink();


  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class2_lev_savg = (int)$row['lev_savg'] ;
  $class2_lev_savp = (int)$row['lev_savp'] ;
  $class2_lev_attg = (int)$row['lev_attg'] ;
  $class2_lev_attp = (int)$row['lev_attp'] ;
  $class2_lev_atta = (int)$row['lev_atta'] ;
  $class2_lev_sjlr = (int)$row['lev_sklr'] ;
  $class2_lev_sklx = (int)$row['lev_sklx'] ;
  $class2_lev_feat = (int)$row['lev_feat'] ;
  $class2_lev_abil = (int)$row['lev_abil'] ;
  if ($zombie == "Y"){
    $class2_lev_feat= 0;
  }
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
  if ($zombie == "Y"){
    $class2_lev_feat= 0;
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
if ($class3_tp != ""){
  $select = "SELECT class_tp, class_att, class_fort, class_ref, class_will, class_skillp, class_spat, class_hd, class_cr_mult, ".
            "class_prest_spells, class_psi, class_spell_list_1, class_spell_list_2 " .
            "from class2 where class_tp ='$class3_tp'  and mon_key_1 = '$key_1'";
//  echo $select;
//  include 'includes/dd_db_conn.txt';

	$link = getDBLink();

  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class3_att = $row['class_att'] ;
  $class3_fort = $row['class_fort'] ;
  $class3_reflex = $row['class_ref'] ;
  $class3_will = $row['class_will'] ;
  $class3_skillp = $row['class_skillp'] ;
  $class3_spat = trim($row['class_spat']) ;
//  echo "spat = $class3_spat";
  $class3_hd = $row['class_hd'] ;
  $class3_cr_mult = $row['class_cr_mult'] ;
  $class3_prest_spells = $row['class_prest_spells'] ;
  $class3_psi = $row['class_psi'];
  $class3_spell_list_1 = $row['class_spell_list_1'];
  $class3_spell_list_2 = $row['class_spell_list_2'];
//  if ($mon_type == "Undead" or $tem_type =="Undead"){
//    $class3_hd = "1D8";
//  }
  if ($class3_spat != "" or $class3_psi != "" ){
     $caster = "Y";
  }
  $class3_skill_p_l = $class3_skillp + $mon_skillp + $human_skill_points ;
  if ($class3_skill_p_l < 1 ){
     $class3_skill_p_l = 1;
  }
  $class3_skill_points = $class3_level * $class3_skill_p_l;
//
//  get class level
//
//
  $select = "SELECT lev_no ,lev_savg ,lev_savp ,lev_attg ,lev_atta ,lev_attp ,lev_sklr ,lev_sklx ,lev_feat ," .
   "lev_abil from level2 where lev_no = $class3_level  and mon_key_1 = '$key_1'" ;
//
//  include 'includes/dd_db_conn.txt';

  $link = getDBLink();


  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $class3_lev_savg = $row['lev_savg'] ;
  $class3_lev_savp = $row['lev_savp'] ;
  $class3_lev_attg = $row['lev_attg'] ;
  $class3_lev_attp = $row['lev_attp'] ;
  $class3_lev_atta = $row['lev_atta'] ;
  $class3_lev_sjlr = $row['lev_sklr'] ;
  $class3_lev_sklx = $row['lev_sklx'] ;
  $class3_lev_feat = $row['lev_feat'] ;
  $class3_lev_abil = $row['lev_abil'] ;
//
//
//
  if ($class3_will == 'G'){
      $class3_will_sv = $class3_lev_savg;
  }else{
      $class3_will_sv = $class3_lev_savp;
  }
  if ($class3_fort == 'G'){
      $class3_fort_sv = $class3_lev_savg;
  }else{
     $class3_fort_sv = $class3_lev_savp;
  }
  if ($class3_reflex == 'G'){
      $class3_reflex_sv = $class3_lev_savg;
  }else{
      $class3_reflex_sv = $class3_lev_savp;
  }
  $att = strtolower($class3_att);
  $class3_attack_v = "class3_lev_att" . $att ;
  $class3_attack = $$class3_attack_v ;

}
$class1_spat = trim($class1_spat);
$class2_spat = trim($class2_spat);
$class3_spat = trim($class3_spat);
$x = monsterSpells();
//echo "levelx = $class1_level";
//
//
//
//

/*
if (($class1_tp  !="" or $class2_tp != "" or $class3_tp != "" ) and $zombie != "Y"){
// if animal companion the level for specials is the char level not the hitdice level
   if ($new_animal_comp_level > 0){
      $class1_lev = $old_animal_comp_level;
   }
   $x = classspec();
    if ($new_animal_comp_level > 0){
      $class1_lev = $new_animal_comp_level;
   }
}
*/
if  (($first_pass == "" and $save_mon == "") or $repopulate_feats == "Y"){
  $x = classffeat();
}
$first_pass = "N";
if ($repopulate_feats != "Y"){
  $count2 = 0;
  while ($count2 < 7){
    $count2 = $count2 + 1;
    $count = 0;
    while ($count < 35){
      $count = $count + 1;
      $featv = "feat_" .$count2 . $count;
      if (isset($$featv)){
      }else{
         $$featv = "";
      }
      $feat = $$featv;
      $autov  = "feat_auto_" .$count2 . $count;
      if (isset($$autov)){
      }else{
         $$autov = "";
      }
      $auto   = $$autov;
//  echo "</BR>" . $featv . $auto ;
      if ($feat != ""){
         $feat_order = feat_order($feat);
         $insert = "insert into feattemp (feattemp_user, feattemp_feat, feattemp_class,feattemp_auto, feattemp_order) " .
                   "values('$user', '$feat', '$count2','$auto', '$feat_order')";
//       echo "</BR> $insert";
         $result = mysqli_query($link, $insert) ;
      }
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
$d = strpos($class3_hd,"D");
if ($d == FALSE){
  $class3_die = "D" . $class3_hd;
  $class3_no_die = 1;
}else{
  $len = strlen($class3_hd);
  $class3_no_die = substr($class3_hd,0,1);
  $class3_die = substr($class3_hd,$d,$len);
}
$total1 = $class1_level * $class1_no_die;
$total2 = $class2_level * $class2_no_die;
$total3 = $class3_level * $class3_no_die;
$total_hd = $mon_level . $mon_die;
if ($tem_level > 0){
   $total_hd .= "+" . $tem_level . $tem_die;
}
if ($total1 > 0){
  $total_hd = $total_hd . "+" . $total1 . $class1_die;
}
//
if ($total2 > 0){
  $total_hd = $total_hd . "+" . $total2 . $class2_die;
}
if ($total3 > 0){
  $total_hd = $total_hd . "+" . $total3 . $class3_die;
}
//

$total_level = $mon_level + $class1_level + $class2_level + $class3_level + $tem_level;
if ($mon_temp != ""){
      $x = temCR($mon_temp);
}
//   echo "after speed = $mon_speed_fly";
if ($mon_temp2 != ""){
      $x = temCR($mon_temp2);
}

$mon_cr += $temCR;

//echo "total level old = " . $total_level_old;
if ($total_level_old == ""){
    $total_level_old = $total_level;
}

if ($total_level_old != $total_level){
    $level_bonus_old =  round(($total_level_old / 4 -0.5), 0);
    $level_bonus_new =  round(($total_level / 4 -0.5), 0);
    $diff =  $level_bonus_new - $level_bonus_old;
    $attr_spent += $diff;
    $total_level_old = $total_level;
  //  echo "attr_spent = " . $attr_spent;
}
if ($attr_spent > 0){
   $attrErrorsHTML = "Attribute points have not been spent";
}
if ($attr_spent < 0){
   $attrErrorsHTML = "Too many Attribute points have been spent";
}



$total_con_bonus = $total_level * $mon_con_bonus;
if ($mon_type == "Undead" or $tem_type =="Undead"){
   $total_con_bonus = $total_level * $mon_chr_bonus;
}

//echo "levelx = $class1_level";
if ($total_con_bonus != 0){
 $total_hd = $total_hd . "+" . $total_con_bonus;
}
$total_hd = strtolower($total_hd);

//
// Calculate average HPs
//
$mon_hp_lev =  (1 + (int)substr($mon_die,1,2)) / 2;
$mon_hps    = $mon_level * $mon_hp_lev;
if ($elite == "Y" and $class1_level == 0 and $mon_level > 0){
   $mon_hps = substr($mon_die,1,2) + (($mon_level -1 )* $mon_hp_lev);
}

$tem_hp_lev =  (1 + (int)substr($tem_die,1,2)) / 2;
$tem_hps    = $tem_level * $tem_hp_lev;

$class1_hp_lev = (1 + (int)substr($class1_die,1,2)) / 2;
if ($class1_level > 0 and ($class1_cr_mult == 1 or $elite == "Y")){
   $class1_hps =  (int)substr($class1_die,1,2) + (($class1_level -1) * $class1_hp_lev );
}else{
  $class1_hps =  $class1_level * $class1_hp_lev;
}

$class1_hps += $class1_level ;
$class2_hp_lev = (1 + (int)substr($class2_die,1,2)) / 2;
$class2_hps =  ($class2_level * $class2_hp_lev);
$class3_hp_lev = (1 + (int)substr($class3_die,1,2)) / 2;
$class3_hps =  ($class3_level * $class3_hp_lev);
$total_hps   = round(($mon_hps + $class1_hps + $class2_hps + $class3_hps + $tem_hps + $total_con_bonus -0.5) ,0);
//mythic template bonus adds mon hit die to total hps for each mythic template
if ($mythic_temp == "Y"){
   $mythic_hps = $mythic_count * substr($mon_die,1,2);
   $total_hps += $mythic_hps;
   $total_hd .= "+" . $mythic_hps;
}
$select = "select count(*) from feattemp where ".
          " feattemp_user = '$user' and feattemp_feat = 'Toughness'";
$result = mysqli_query($link, $select) ;
// add favorite class hps
if ($class1_level > 0 and $class1_tp != "Animal Companion"){
  $total_hd .= "+". $class1_level;
}
$toughness = 0;
if ($result){
   $row = mysqli_fetch_array($result);
   $toughness = $row[0];
}
if ($toughness > 0){
  $tough_hp = 3;
  if ($total_level > 3){
      $tough_hp += $total_level - 3;
  }
  $select = "select count(*) from feattemp where ".
          " feattemp_user = '$user' and feattemp_feat = 'Toughness (Mythic)'";
  $result = mysqli_query($link, $select) ;
  if ($result){
    $row = mysqli_fetch_array($result);
    $toughness_m = $row[0];
  //  echo "toughness_m = $toughness_m";
    if ($toughness_m > 0){
       $tough_hp += 3;
       if ($total_level > 3){
          $tough_hp += $total_level - 3;
       }
    }
  }
  $select = "select count(*) from feattemp where ".
          " feattemp_user = '$user' and feattemp_feat = 'Improved Toughness (Forgotten Core Feats)'";
  $result = mysqli_query($link, $select) ;
  if ($result){
    $row = mysqli_fetch_array($result);
    $toughness_m = $row[0];
  //  echo "toughness_m = $toughness_m";
    if ($toughness_m > 0){
          $tough_hp += $total_level;
    }
  }
//  echo $tough_hp;
  $total_hps += $tough_hp;
  $total_hd .= "+". $tough_hp;
}
//
//
//Saving Throws
//

$total_fort_sv = $mon_fort_sv + $class1_fort_sv + $class2_fort_sv + $class3_fort_sv + $mon_con_bonus + $magic_fort_sv + $tem_fort_sv + $spec_fort_sv;
$total_will_sv = $mon_will_sv + $class1_will_sv + $class2_will_sv + $class3_will_sv + $mon_wis_bonus + $magic_will_sv + $tem_will_sv + $spec_will_sv;
$total_reflex_sv = $mon_reflex_sv + $class1_reflex_sv + $class2_reflex_sv + $class3_reflex_sv + $mon_dex_bonus + $magic_reflex_sv + $tem_reflex_sv + $spec_reflex_sv;

if (($mon_type == "Undead" or $tem_type =="Undead") and $key_1 == "path"){
   $total_fort_sv = $mon_fort_sv + $class1_fort_sv + $class2_fort_sv + $class3_fort_sv + $mon_chr_bonus + $magic_fort_sv + $tem_fort_sv + $spec_fort_sv;
}
//echo "</BR> $mon " . $mon_reflex_sv . "class1" . $class1_reflex_sv . "dex " . $mon_dex_bonus . "***";
//echo "total " . $total_reflex_sv;
//
//
//SKILLS
//
// Get monster skills
//
//echo "levelx = $class1_level";
$total_skill_points = $mon_skill_points_total + $class1_skill_points + $class2_skill_points + $class3_skill_points;
$diff_skill_points = 0;
if ($total_skill_points != $total_skill_points_old){
    $diff_skill_points = $total_skill_points - $total_skill_points_old;
}
$total_skill_points_old =  $total_skill_points;
//
//
//echo "total_skill_points_old " . $total_skill_points_old;
//echo "diff_skill_points " . $diff_skill_points;

If ($new == "YES"){
//      add in Primary skills %80 of skills
 $skill1_prim = round((($class1_skill_points + ($mon_skill_points_save )) * 0.8) ,0);
 $skill1_sec  = $class1_skill_points + ($mon_skill_points_save) - $skill1_prim;
 $skill2_prim = round(($class2_skill_points *0.8),0);
 $skill2_sec  = $class2_skill_points - $skill2_prim;
 $skill3_prim = round(($class3_skill_points *0.8),0);
 $skill3_sec  = $class3_skill_points - $skill3_prim;
//echo "</BR> skill1_prim " .$skill1_prim . "</BR>";

//
//
//
// add 1st primary even out and try to max
//
  if ($key_1 == "dd35"){
     $max_skill = $total_level + 3;
     $max_xskill = $max_skill /2;
  }
  if ($key_1 == "path"){
     $max_skill = $total_level;
     $max_xskill = $max_skill;
  }
 $skill_cnt = 0;
 While ($skill_cnt < 6){
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
      $skill_prim = $skill2_prim + $skill1_left; 
   }
   if ($skill_cnt == 4){
      $sel = "S";
      $class_tp = $class2_tp;
      $class_focus = $class2_focus;
      $skill_prim = $skill_prim + $skill2_sec;
   }  
   if ($skill_cnt == 5){
      $skill1_left = $skill_prim;
      $sel = "P";
      $class_tp = $class3_tp;
      $class_focus = $class3_focus;
      $skill_prim = $skill3_prim + $skill1_left;
   }
   if ($skill_cnt == 6){
      $sel = "S";
      $class_tp = $class3_tp;
      $class_focus = $class3_focus;
      $skill_prim = $skill_prim + $skill3_sec;
   }
//   echo "</BR> Skill_cnt " . $skill_cnt ."</BR>";  
   $pr = 0;                   
   While ($pr < 4 and $skill_prim >= 1){
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
         $select1 = "SELECT MIN(skillt_rank) FROM skilltemp, classfocus2 ".
               " WHERE classf_class = '$class_tp' and classf_focus = '$class_focus' " .
               " and classf_tp = '$prim'" .
               " and classf_skill = skillt_skill" .
               " and skillt_rank < $max_skill and skillt_user = '$user'" .
               " and skillt_rank < classf_max" .
               " and skillt_xskill = '' and mon_key_1 = '$key_1'";
      }else{
          $select1 = "SELECT MIN(skillt_rank) FROM skilltemp, classfocus2 ".
                 " WHERE classf_class = '$class_tp' and classf_focus = '$class_focus' " .
                 " and classf_tp = '$prim'" .
                 " and classf_skill = skillt_skill" .
                 " and skillt_rank < $max_skill and skillt_user = '$user'" .
                 " and skillt_rank < classf_max and mon_key_1 = '$key_1' ";
      } 
//      echo "</BR>" . $select1 . "</BR>";
      $result1 = mysqli_query($link, $select1) ;
      if (mysqli_num_rows($result1) > 0){
        $row1 = mysqli_fetch_array($result1);

        $min = $row1[0] ;
//    echo "</BR> min = " . $min;    
        if ($min != ""){
//    echo "row 1 = " .$row1 ." result = " . mysqli_num_rows($result1) . "min=" .$min . "update ". $update_flag;
          $select2 = "SELECT skillt_skill, skillt_rank, skillt_xskill, classf_xskill  FROM skilltemp, classfocus2 ".
                 " WHERE classf_class = '$class_tp' and classf_focus = '$class_focus' and mon_key_1 = '$key_1' ".
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
                        $rank = $rank + 1;
                        $skill_prim = $skill_prim - 1;
                    }else{
                         $update_skill = "N";
                    }
                  }else{
                        $rank = $rank + 1;
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
//   echo "skill points left xx " . $skill_prim;
 }
   $skill2_left = $skill_prim;
}
//
//echo "skill spent = " . $skill2_left;
//get AC
//
//
//echo "levelx = $class1_level";
$Inevitable = stripos($mon_name, "Inevitable");
$select = "select size_ac_mod, size_grapple, size_hide, size_sq, size_reach_t, size_reach_l, size_golemhp from size ".
          "where size_cat = '$mon_size'";
//echo "<BR>$select</BR>";
$result = mysqli_query($link, $select);

if (mysqli_num_rows($result) > 0){
   $row = mysqli_fetch_array($result);
//    echo"here";
    $size_ac_mod    = (int)$row['size_ac_mod'];
    $size_grapple   = $row['size_grapple'];
    $size_hide      = $row['size_hide'];
    $size_sq        = $row['size_sq'];
    $size_reach_t   = $row['size_reach_t'];
    $size_reach_l   = $row['size_reach_l'];
    $size_golemhp   = $row['size_golemhp'];
    if ($mon_size != $mon_size_original){
      $mon_space = $size_sq;
      $mon_reach = $size_reach_l;
    }
    if ($mon_type == "Construct" or $Inevitable === 0){
       $total_hd = $total_hd . "+" . $size_golemhp;
       $total_hps = $total_hps + $size_golemhp;
    }
}
$select = "select armour_cd, armour_tp, armour_bonus_path, armour_dex, armour_check, armour_spell, armour_s30,".
          "armour_s20,armour_wt, armour_tohit, armour_climb, armour_jump, armour_cost from armour where armour_tp = '$mon_armour' or armour_tp = '$mon_shield'" .
          "order by armour_cd";
//echo "</BR> " . $select;
$result = mysqli_query($link, $select);
$count = 0;
if (mysqli_num_rows($result) > 0){
   while($row = mysqli_fetch_array($result)){
     $count = $count + 1;
     if ($count == 1){
       $armour_bonus = $row['armour_bonus_path'];
       $armour_dex =   (int)$row['armour_dex'];
       $armour_check = $row['armour_check'];
       $armour_spell = $row['armour_spell'];
       $armour_s30   = $row['armour_s30'];
       $armour_s20   = $row['armour_s20'];
       $armour_wt    = $row['armour_wt'];
       $armour_cd    = $row['armour_cd'];
       $armour_jump  = $row['armour_jump'];
       $armour_climb = $row['armour_climb'];
       $armour_cost =  $row['armour_cost'];
     }else{
       $shield_bonus = (int)$row['armour_bonus_path'];
       $shield_dex =   (int)$row['armour_dex'];
       $shield_check = $row['armour_check'];
       $shield_spell = $row['armour_spell'];
       $shield_s30   = $row['armour_s30'];
       $shield_s20   = $row['armour_s20'];
       $shield_wt    = $row['armour_wt'];
       $shield_tohit = $row['armour_tohit'];
       $shield_cost  = $row['armour_cost'];

       if ($mon_shield == "Shield, tower"){
          $shield_tohit += $feat_tower;
          if ($shield_tohit > 0){
              $shield_tohit = 0;
          }
   //       $shield_dex = $feat_tower_dex;
   //       $shield_sheck += $feat_tower_armch;
       }
    }
  }
}


$monk_bonus = 0;
// if ($class1_tp == "Monk" or $class2_tp == "Monk"){
  if ($flurry_of_blows == "Y"){
//   echo "</BR> MONK";
   if ($armour_bonus == 0 and $shield_bonus == 0 and $mon_wis_bonus > 0){
      $monk_bonus = $mon_wis_bonus;
      if ($class1_tp == "Monk"){
         $bonus = round(($class1_level / 4)  - 0.49);
         $monk_bonus = $monk_bonus + $bonus;

      }else{
         $bonus = round(($class2_level / 4)  - 0.49);
         $monk_bonus = $monk_bonus + $bonus;
      }
    }
    if ($class1_tp == "Monk"){
      $monk_level = $class1_level;
      $flurry_bonus =  $class1_level - $class1_attack;
    }else{
      $monk_level = $class2_level;
      $flurry_bonus =  $class2_level - $class2_attack;
    }
}
if ($armour_bonus == 0 and $shield_bonus == 0 and $mon_wis_bonus > 0 and ($class1_tp == "Unchained Monk"  or $class2_tp == "Unchained Monk")) {
    $monk_bonus = $mon_wis_bonus;
    $flurry_bonus = 0;
    if ($class1_tp == "Unchained Monk"){
      $monk_level = $class1_level;
    }else{
      $monk_level = $class2_level;
    }
}
//echo "levelx = $class1_level";
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
while ($level_c  < 3){
  $level_c = $level_c + 1;
  if ($level_c == 1){
     $string = $class1_attack;
  }
  if ($level_c == 2){
     $string = $class2_attack;
  }
  if ($level_c == 3){
     $string = $class3_attack;
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
   $weap_type_p = $row['weap_type'];
   $weap_cat_p = $row['weap_cat'];
//   echo "found";
}


 // for some reason a shortspear is treated as a finess weapon for small creatures
// echo $select;
// echo "weap_type_p  =" . $weap_type_p . " weap_cat_p = " . $weap_cat_p;
$finess_diff = 0;
If (($mon_weap_p == "Rapier" or $mon_weap_p == "Whip" or $mon_weap_p == "Chain, spiked" or $weap_type_p == "LT" or $weap_cat_p == "0-Natural" or
     $mon_weap_p == "Curved blade, elven" or ($mon_weap_p == "Shortspear" and ($original_size_no  < 5)))
     and $weapon_finess >  0  or $mon_str == 0 ) {
   $bonus = $mon_dex_bonus;
   $bonus_finess = "Y";
   if ($finess_damage == "Y" ){
      $dam_feat_p = $mon_dex_bonus - $mon_str_bonus;
   }
}else{
   $bonus = $mon_str_bonus;
   if ($weapon_finess > 0){
      $finess_diff = $mon_dex_bonus - $mon_str_bonus;
   }

}

if ($finess_diff < 0){
  $finess_diff = 0;
}
//echo "finess" . $weapon_finess;
//
// find any feats which effect combat bonus'
//
$select = "select featattr_no, featattr_type, feattemp_auto ,featattr_feat,featattr_rfeat, featattr_level from featattr2, feattemp " .
               "where  feattemp_user = '$user' and ".
                " feattemp_feat = featattr_feat  and mon_key_1 = '$key_1' and featattr_level <= $total_class_level order by feattemp_order asc, featattr_feat asc, featattr_type asc";
//
//echo "</BR> " . $select;
$result = mysqli_query($link, $select) ;
//
//
/*  comment out
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
*/
if (mysqli_num_rows($result) > 0){
   while ($row = mysqli_fetch_array($result)){
      $old_feat = $feat;
      $feat          = $row['featattr_feat'];
      $featattr_no   = $row['featattr_no'];
      $featattr_type = $row['featattr_type'];
      $feattemp_auto = $row['feattemp_auto'];
      $featattr_level = $row['featattr_level'];
//      echo "</BR>" . $featattr_type . $featattr_no;
      if ($featattr_type == "TOWER"){
        $feat_tower = $feat_tower + $featattr_no;
      }
      if ($featattr_type == "TOWERARMCH"){
       $feat_tower_armch = $feat_tower_armch + $featattr_no;
  //     echo "feat_tower_armch  $feat_tower_armch ";
      }
      if ($featattr_type == "TOWERDEX"){
         $feat_tower_dex = $feat_tower_dex + $featattr_no;
//         echo "feat_tower_dex  $feat_tower_dex ";
      }
      if ($mon_shield == "Shield. tower"){
         if ($featattr_type == "TOWER"){
             $shield_tohit += $feat_tower;
             if ($shield_tohit > 0){
                $shield_tohit = 0;
             }
         }
         if ($featattr_type == "TOWERDEX"){
                $shield_dex = $feat_tower_dex;
          }
          if ($featattr_type == "TOWERARMCH"){
             $shield_check += $feat_tower_armch;
//             echo "shield check $shield_check";
          }
      }
      if ($featattr_type == "SIMPSECADJ"){
         $simpSecAdj = $featattr_no;
      }
      if ($featattr_type == "MARSECADJ"){
         $marSecAdj = $featattr_no;
      }
      if ($featattr_type == "EXSECADJ"){
         $exSecAdj = $featattr_no;
      }
      if ($featattr_type == "CMDLTARM"){
         $CMDLtArm = "Y";
      }
      if ($featattr_type == "CMDMDARM"){
         $CMDMdArm = "Y";
      }
      if ($featattr_type == "CMDHVARM"){
         $CMDHvArm = "Y";
      }
     if ($featattr_type == "MYTHMONKAC"){
         if ($class1_tp == "Monk" or $class1_tp == "Unchained Monk"){
           $monk_level_ac = $class1_level + round((($class2_level / 2 -0.49)),0);
    //       echo " monk_level_ac $monk_level_ac";
           $bonus = round(($monk_level_ac  / 4 )  - 0.49);
            $monk_bonus = $mon_wis_bonus + $bonus;
      //      echo "monk_bonus $monk_bonus";

         }else{
            if ($class2_tp == "Monk" or $class2_tp == "Unchained Monk"){
              $monk_level_ac = $class2_level + round((($class1_level / 2 -0.49)),0);
              $bonus = round(($monk_level_ac  / 4 )  - 0.49);
              $monk_bonus = $mon_wis_bonus + $bonus;
            }
         }
      }
      if ($featattr_type == "MONKDAM"){
         if ($class1_tp == "Monk" or $class1_tp == "Unchained Monk"){
           $monk_level_dam = $class1_level + round((($class2_level / 2 -0.49)),0);
    //       echo " monk_level_ac $monk_level_ac";

      //      echo "monk_bonus $monk_bonus";

         }else{
            if ($class2_tp == "Monk" or $class2_tp == "Unchained Monk"){
              $monk_level_dam = $class2_level + round((($class1_level / 2 -0.49)),0);

            }
         }


      }
      if ($featattr_type == "DEXTOHIT"){
         $tohit_feat_p = $mon_dex_bonus - $mon_str_bonus;
      }
      if ($featattr_type == "DEXDAM"){
         $dam_feat_p = $mon_dex_bonus - $mon_str_bonus;
      }
      if ($featattr_type == "ATTH"){
         $feat_atth = $feat_atth + $featattr_no;
      }
      if ($featattr_type == "ATTH2"){
         $feat_atth2 = $feat_atth2 + $featattr_no;
      }
      if ($featattr_type == "ATTHD"){
         $feat_atthd = $feat_atthd + $featattr_no;
      }
      if ($featattr_type == "ATTHD2"){
         $feat_atthd2 = $feat_atthd2 + $featattr_no;
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
         $feat_exattr1_v = "feat_exattr1" . $exattr1;
         $$feat_exattr1_v = $featattr_no;
      }
      if ($featattr_type == "MULTI"){
         $feat_multi = $featattr_no;
      }
      if ($featattr_type == "MULTIW"){
         $feat_multiw = $featattr_no;
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
      if ($featattr_type == "HP"){
        if ($featattr_no == "PSI"){
             $select2 = "select count(*) from feattemp, feats2 where feattemp_user = '$user' and mon_key_1 = '$key_1' " .
                        " and  feattemp_feat = feat_name and feat_psionic = 'Y'";
      //       echo ($select2);
             $result2 = mysqli_query($link, $select2) ;
             $row2 = mysqli_fetch_array($result2);
             $count = $row2[0];
      //       echo "count = " . $count;
             $psi_hps =    $count * 2;
             $total_hps  = $total_hps + $psi_hps;
              $total_hd = $total_hd . "+" . $psi_hps;
         }else{
            $total_hps  = $total_hps +  $featattr_no;
         }
      } 
      if ($featattr_type == "INIT"){
         $feat_init  = $feat_init +  $featattr_no;
      } 
      if ($featattr_type == "GRAPPLE"){
         $feat_grapple  = $feat_grapple +  $featattr_no;
      }
      if ($featattr_type == "SHIELD"){
         if ($shield_bonus > 0){
            $shield_bonus  = $shield_bonus +  $featattr_no;
         }
      }
      // AC is dodge Feat gets added to touch
      if ($featattr_type == "AC"){
         $feat_ac_bonus  = $feat_ac_bonus +  $featattr_no;
         $magic_armour_touch += $featattr_no;
         $dodge +=  $featattr_no;
      }
      if ($featattr_type == "FARSHOT"){
         $range_mod = $range_mod +  $featattr_no;
      }
      if ($featattr_type == "CRIT"){
         $crit_mod = $crit_mod +  $featattr_no;
      }
      if ($featattr_type == "CRIT2"){
         $crit_mod2 = $crit_mod2 +  $featattr_no;
//         echo "crit_mod2 = $crit_mod2";
      }
      if ($featattr_type == "RCRIT"){
         $crit_mod_r = $crit_mod_r +  $featattr_no;
      }
      if ($featattr_type =="ARMOURP"){
          $feat_armour_v = "armour_" . $featattr_no;
 //         echo $feat_armour_v;
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
      if ($featattr_type == "RRH"){
          $feat_rrh = "Y";
      }
      if ($featattr_type == "RRB"){
          $feat_rrb = "Y";
      }
      if ($featattr_type == "AGILEM"){
          $feat_agilem = "Y";
      }
      if ($featattr_type == "FAST"){
          $speed += $featattr_no;
      }
      if ($featattr_type == "DCT"){
          $feat_dct = "Y";
      }
      if ($featattr_type == "DSLICE"){
          $feat_dslice = "Y";
      }
      if ($featattr_type == "SPELLDESC"){
          $spell_feat_count += 1;
          $spell_feat_v = "spell_feat_" . $spell_feat_count;
          $$spell_feat_v = $featattr_no;

      }
      if ($featattr_type == "SPELLLEV"){
          $spell_feat_vv = $$spell_feat_v;
          $$spell_feat_vv = $featattr_no;
//          echo $spell_feat_vv . $$spell_feat_vv;
      }
      if ($featattr_type == "POWP"){
          $feat_psi_points += $featattr_no;
      }
      if ($featattr_type == "INERTARM"){
          $feat_inert_arm += $featattr_no;
      }
      if ($featattr_type == "ADDPST"){
          $feat_addpst += $featattr_no;
      }
// sidestep uses CHR instead DEX for AC and Reflex save
      if ($featattr_type == "CHRDEXAC"){
         $chrdexac = $mon_chr_bonus - $mon_dex_bonus;
      }
      if ($featattr_type == "CHRDEXRS"){
         $chrdexrf = $mon_chr_bonus - $mon_dex_bonus;
         $total_reflex_sv += $chrdexrf;
      }
      if ($featattr_type == "CHRDEXCMD"){
         $chrdexcmd = $mon_chr_bonus - $mon_dex_bonus;
      }
//  speed in medium armor is normal
      if ($featattr_type == "SPEEDMEDNORM"){
         $speedmednorm = "Y";
      }
      if ($featattr_type == "RANGED"){
          $count_ranged += 1;
          if ($count_ranged > 1){
             $print_ranged .= ", ";
          }
          $print_ranged .= $featattr_no;
    //          echo "Ranged $print_ranged";
      }


 //     if ($feattemp_auto != "Y"){
      if ($feattemp_auto != "Y" and $old_feat != $feat){
         $error = check_feat($feat);
         if ($error != ""){
            $errortxt  .= "<p>" . check_feat($feat) . "</p>";
         }
       }


   }
}
// add in fighters armour dex bonus
//chrdexac is the difference between chr and dex used for oracles which can replace DEX with CHR
if ($armour_dex > $shield_dex){
   $max_dex = $shield_dex;
}else{
   $max_dex = $armour_dex;
}

$max_dex = $max_dex + $feat_armch + $chrdexac;
if ($max_dex < $mon_dex_bonus ){
   $dex_bonus = $max_dex;
}else{
   $dex_bonus = $mon_dex_bonus + $chrdexac;
}

 //echo "levelx = $class1_level";

If ($range_mod == 0){
  $range_mod = 1;
}
// if magic bracers is greater than armour (without rings) use bracers
if ($armour_bonus > 0){
   if ($magic_ac > ($armour_bonus + $magic_armour - $magic_armour_nac)){
      $armour_bonus = $magic_ac;
      $magic_armour = $magic_armour_nac;
   }
}else{
  $armour_bonus = $magic_ac;
}
// If inertial armour is greater than armour use it
// echo "inert " . $feat_inert_arm;
if ($feat_inert_arm > ($armour_bonus + $magic_armour - $magic_armour_nac )){
    $armour_bonus = $feat_inert_arm;
    $mon_armour = "Inertail armour";
}
$int_ac_bonus = 0;
if ($int_ac > 0 and $mon_int_bonus >0 and ($mon_armour == "No Armour" or $armour_cd < 2) and $mon_shield == "Shield, none" ){
    if ($mon_int_bonus > $int_ac){
       $int_ac_bonus = $int_ac;
    }else{
       $int_ac_bonus = $mon_int_bonus;
    }
}

//deflection

$ac_deflect = deflect($mon_ac_deflect);
//echo "tem_ac_deflect = $tem_ac_deflect mon_chr_bonus = $mon_chr_bonus $mon_chr";
if ($tem_ac_deflect !="" and $tem_ac_deflect !== 0){
     $ac_deflect = deflect($tem_ac_deflect);
//     echo "ac_deflect = $ac_deflect";
}
if ($magic_ac_deflect > $ac_deflect){
   $ac_deflect = $magic_ac_deflect;
}

//insight

$ac_insight = insight($mon_ac_insight);
if ($tem_ac_insight !="" and $tem_ac_insight !== 0){
     $ac_insight = insight($tem_ac_insight);
//     echo "ac_deflect = $ac_deflect";

}
if ($magic_ac_insight > $ac_insight){
         $ac_insight = $magic_ac_insight;

}
//profane

$ac_profane = profane($mon_ac_profane);
if ($tem_ac_profane !="" and $tem_ac_profane !==0){
     $ac_profane = profane($tem_ac_profane);
//     echo "ac_deflect = $ac_deflect";

}

if ($magic_ac_profane > $ac_profane){
   $ac_profane = $magic_ac_profane;
}
//luck

$ac_luck = profane($mon_ac_luck);
if ($tem_ac_luck !="" and $tem_ac_luck !== 0){
     $ac_luck = profane($tem_ac_luck);
//     echo "ac_luck = $ac_luck";

}

if ($magic_ac_luck > $ac_luck){
   $ac_luck = $magic_ac_luck;
}

//dodge
$ac_dodge = dodge($mon_ac_dodge);
if ($tem_ac_dodge !="" and $tem_ac_dodge !==0 ){
     $ac_dodge += dodge($tem_ac_dodge);
//     echo "ac_deflect = $ac_deflect";

}
if ($magic_ac_dodge != ""){
   $ac_dodge += $magic_ac_dodge;
}
//echo "feat ac bonus $feat_ac_bonus ac_dodge $ac_dodge";

$mon_ac = $mon_ac_flat + $size_ac_mod + $dex_bonus + $armour_bonus + $shield_bonus + $monk_bonus + $mon_nat_armour_ft +
           $magic_armour + $magic_shield + $feat_ac_bonus  + $int_ac_bonus + $ac_deflect + $ac_insight + $ac_profane +  $ac_luck + $ac_dodge;
$ac_desc = "";
if ($dex_bonus != 0){
    if ($dex_bonus > 0){
       $ac_desc .= "+". $dex_bonus . " Dex";
    }else{
      $ac_desc .=  $dex_bonus . " Dex";
    }
}
if ($mon_ac_flat != 10 or $mon_nat_armour_ft !="" ){
    if ($ac_desc != ""){
       $ac_desc .= ", ";
    }
   $ac_desc .=  "+" . ($mon_ac_flat - 10 + $mon_nat_armour_ft). " Natural";
}
//echo "size " . $size_ac_mod;
if ($size_ac_mod != 0 and $size_ac_mod != ""){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
    }
   if ($size_ac_mod < 0){
     $ac_desc .= $size_ac_mod . " size";
   }else{
     $ac_desc .= "+" . $size_ac_mod. " size";
   }
}
if ($monk_bonus != ""){
  if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
  $ac_desc .= "+" . $monk_bonus . " Monk";
}
if ($int_ac_bonus > 0){
    if ($ac_desc != ""){
       $ac_desc .= ", ";
    }
    $ac_desc .= "+" . $int_ac_bonus . " INT";
}   
//echo "armour " . $armour_bonus;
$total = $armour_bonus + $magic_armour;
$total = round($total,0);
if ($total > 0 ){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
//   echo "total = " . $total;
   if (substr($magic_armour,0,1) == "+"){
//      $ac_desc .= " +" . $total .  $mon_armour . " ($magic_armour)" ;
      $ac_desc .= " +" . $total .  " armour" ;
   }else{
      if ($magic_armour > 0.1){
//         $ac_desc .=  " +" . $total . " ".  $mon_armour . " (+$magic_armour)" ;
         $ac_desc .=  " +" . $total . " armour";
//         echo $ac_desc;
      }else{
//         $ac_desc .=  " +" . $total . " " . $mon_armour ;
         $ac_desc .=  " +" . $total . " armour";
      }
   }
}
$total = $shield_bonus + $magic_shield;
$total = round($total,0);
if ($total > 0){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
   if (substr($magic_armour,0,1) == "+"){
  //    $ac_desc .=  " +" . $total . " " .  $mon_shield . " ($magic_shield)" ;
      $ac_desc .=  " +" . $total . " shield" ;
   }else{
      if ($magic_armour > 0.1){
    //     $ac_desc .= " +" . $total .  " ".  $mon_shield . " (+$magic_shield)" ;
         $ac_desc .= " +" . $total .  " shield";
      }else{
   //      $ac_desc .=  " +" . $total .  " " .  $mon_shield ;
         $ac_desc .=  " +" . $total .  " shield" ;
      }
   }
}
if ($feat_ac_bonus != ""){
  if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
  $ac_desc .= "+". $feat_ac_bonus . " feats";
}

if ($ac_deflect > "0"){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
  $ac_desc .= "+". $ac_deflect . " deflection";
}
if ($ac_insight > "0"){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
  $ac_desc .= "+". $ac_insight . "  insight";
}
if ($ac_profane > "0"){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
  $ac_desc .= "+". $ac_profane . "  profane";
}
//echo "ac luck = $ac_luck";
if ($ac_luck > "0"){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
  $ac_desc .= "+". $ac_luck . "  luck";
}
if ($ac_dodge > "0"){
   if ($ac_desc != ""){
       $ac_desc .= ", ";
  }
  $ac_desc .= "+". $ac_dodge . "  dodge";
}
//echo "feat " .  $feat_defshield;
// Deflective shield special allows shield bonus to touch ac
$defshield = 0;
if ($feat_defshield > 0){
   if ($feat_defshield > (  $shield_bonus + $magic_shield)){
       $defshield = $shield_bonus + $magic_shield;
   }else{
       $defshield = $feat_defshield;
   }
 }
//echo "feat " .  $defshield;

$ac_flat = $mon_ac_flat + $size_ac_mod + $armour_bonus + $shield_bonus + $monk_bonus + $mon_nat_armour_ft + $magic_armour
            + $magic_shield + $ac_deflect + $ac_insight + $ac_profane + $ac_luck;

if ($ac_flat > $mon_ac){
  $ac_flat = $mon_ac;
}


$ac_touch = 10 + $size_ac_mod + $monk_bonus + $dex_bonus + $magic_armour_touch + $defshield + $int_ac_bonus + $ac_deflect +
                $ac_insight + $ac_luck + $ac_dodge +  $ac_profane ;
//



//echo "</BR>";
//echo $errortxt;
// echo "</BR> feat_attrd " . $feat_attrd;
$select = "SELECT weap_cat, weap_type from weapons where weap_id =  '$mon_weap_p'";
$result = mysqli_query($link, $select);
if ($result){
   $row = mysqli_fetch_array($result);
   $weap_cat = $row['weap_cat'];
   $weap_type = $row['weap_type'];
}
$select = "SELECT weap_cat, weap_type from weapons where weap_id =  '$mon_weap_s1'";
$result = mysqli_query($link, $select);
if ($result){
   $row = mysqli_fetch_array($result);
   $weap_cat_s1 = $row['weap_cat'];
   $weap_type_s1 = $row['weap_type'];
}
$select = "SELECT weap_cat, weap_type from weapons where weap_id =  '$mon_weap_r'";
$result = mysqli_query($link, $select);
if ($result){
   $row = mysqli_fetch_array($result);
   $weap_cat_r = $row['weap_cat'];
   $weap_type_r = $row['weap_type'];
}
if ($weap_cat == "1-Simple"){
   $prim_adj = $simpSecAdj;
}
if ($weap_cat == "2-Martial"){
   $prim_adj = $marSecAdj;
}
if ($weap_cat == "3-Exotic"){
   $prim_adj = $exSecAdj;
}

//if ($weap_cat_s1 == "1-Simple"){
//   $sec_adj = $simpSecAdj;
//}

//if ($weap_cat_s1 == "2-Martial"){
//   $sec_adj = $marSecAdj;
//}
//if ($weap_cat_s1 == "3-Exotic"){
//   $sec_adj = $exSecAdj;
//}
//if ($weap_cat_r == "1-Simple"){
//   $rang_adj = $simpSecAdj;
//}
//if ($weap_cat_r == "2-Martial"){
//   $rang_adj = $marSecAdj;
//}
//if ($weap_cat_r == "3-Exotic"){
//   $rang_adj = $exSecAdj;
//}
//echo "$weap_cat prim adj $prim_adj simSecAdj $simpSecAdj";
$base_att = $attnum1 + $mon_base_att + $flurry_bonus;
$att_left = $base_att - $str_bonus;
// max no of attacks is 4 with primary weapon
$count = 1;
while ($att_left > 5 and $count < 4){
   $count = $count + 1;
// sec_adj is used in mythic weapon prof
   $att_left = $att_left - 5 + $prim_adj;
   if ($att_left > 0){
      $attnum_v = "attnum" . $count;
      $$attnum_v = $att_left;
//      echo "</BR>  $attnum_v  $att_left" ;
      $no_attacks = $count;
   }
}
$att_left = $base_att - $str_bonus;
$count = 0;
while ($att_left > 5 and $count < 4){
   $count = $count + 1;
// sec_adj is used in mythic weapon prof
   $att_left = $att_left - 5 + $sec_adj;
   if ($att_left > 0){
      $attnum_v = "attnums" . $count;
      $$attnum_v = $att_left;
//      echo "</BR>  $attnum_v  $att_left" ;
//      $no_attacks = $count;
   }
}
$count = 1;
$att_left = $base_att - $str_bonus;
while ($att_left > 5 and $count < 4){
   $count = $count + 1;
// sec_adj is used in mythic weapon prof
   $att_left = $att_left - 5 + $rang_adj;
   if ($att_left > 0){
      $attnum_v = "attnumr" . $count;
      $$attnum_v = $att_left;
  //   echo "</BR>  $attnum_v  $att_left $rang_adj" ;
//      $no_attacks = $count;
   }
}
// if 2 heavy weapons then take an extra -2 to hit don't do for monters with multi weapon fighting
if (($weap_type == "1H" or $weap_type == "2H" or $weap_type == "DB" ) and($weap_type_s1 =="1H" or $weap_type_s1 == "2H" or $weap_type_s1 == "DB") ){
   if ($feat_muliw != ""){
     $heavy_two_weap = -2;
     $feat_exatta -= 2;
   }
}
$size_grapple = $size_ac_mod * -1;
$base_attack = $attnum1 + $mon_base_att;
$base_grapple = $base_attack + $size_grapple + $feat_grapple + $mon_str_bonus;
$base_attack_cmb = $base_attack;
// if Monk then use the monk level as base attack for CMB
if ($class1_tp == "Monk" and $class1_level > 2){
    $base_attack_cmb  = $base_attack_cmb - $class1_attack + $class1_level;
    $base_grapple  = $base_grapple - $class1_attack + $class1_level;
//    echo "base_attack_cmb =  $base_attack_cmb";
}
if ($class2_tp == "Monk" and $class2_level > 2){
    $base_attack_cmb  = $base_attack_cmb - $class2_attack + $class2_level;
    $base_grapple  = $base_grapple - $class2_attack + $class2_level;
}
$base_cmb = $base_attack_cmb + $size_grapple;
// if agile maneuvers
if ($feat_agilem != "Y" and $mon_str > 0){
   $base_cmb += $mon_str_bonus;
}else{
   $base_cmb += $mon_dex_bonus;
}
// the below is for the mythic armor feats adds 1/2 armor AC to CMD
$CMDFeatArm = 0;
if ($CMDLtArm == "Y" and $armour_cd == "1"){
    $CMDFeatArm = round((($armour_bonus - .1)/2),0);
}
if ($CMDMdArm == "Y" and $armour_cd == "2"){
    $CMDFeatArm = round((($armour_bonus - .1)/2),0);
}
if ($CMDHvArm == "Y" and $armour_cd == "3"){
    $CMDFeatArm = round((($armour_bonus - .1)/2),0);
}
//echo "CMDHvArm = $CMDHvArm  CMDFeatArm = $CMDFeatArm ";
$base_grapple = $base_cmb + $feat_grapple;
// if defencive combat training
//echo "feat_grapple = $feat_grapple";
if ($feat_dct != "Y"){
   $base_cmd  = 10 +  $base_attack + $size_grapple + $feat_grapple + $mon_str_bonus + $mon_dex_bonus + $monk_bonus + $chrdexcmd + $ac_deflect +
                $ac_dodge + $ac_profane + $ac_insight + $feat_ac_bonus + $CMDFeatArm  ;
}else{
   $base_cmd  = 10 +  $total_level + $size_grapple + $feat_grapple + $mon_str_bonus + $mon_dex_bonus + $monk_bonus + $chrdexcmd + $ac_deflect +
                $ac_dodge + $ac_profane + $ac_insight + $feat_ac_bonus + $CMDFeatArm ;
}

$ranged_attack = $base_attack + $mon_dex_bonus + $feat_attr + $feat_exattr + $magic_tohit_r + $size_ac_mod
                 + $feat_attall + $shield_tohit;
//echo "ranged = $ranged_attack : $attnumr1 : $base_attack ";
$single_ranged = $ranged_attack - $feat_exattr;
$full_attack = $attnum1 + $mon_base_att + $bonus + $feat_atth + $feat_exatta + $magic_tohit_p + $size_ac_mod
                + $feat_attall + $shield_tohit + $feat_multiw;
//echo "  attnum1 $attnum1 mon_base_attack $mon_base_att ";
// add in bounus for magic unarmed
$attu = "";
if ($mon_weap_p == 'Unarmed strike' or $weap_cat == "0-Natural"){
  $full_attack += $feat_attu;
  $single_attack += $feat_attu;
  $attu = "Y";
}

$full_attack_st = $full_attack;
$single_attack = $full_attack - $feat_exatta - $feat_multiw;
$flurry = $full_attack + $flurry_att - $feat_atth + $finess_diff;
if ($mon_weap_p == 'Unarmed strike'){
        $flurry += $feat_atth;

}
if ($attu != "Y"){
    $flurry += $feat_attu;
}
$bonus_p = weapgroup($mon_weap_p);
$bonus_r = weapgroup($mon_weap_r);
$ranged_attack += $bonus_r;
$ranged_attack_st = $ranged_attack;
$single_ranged += $bonus_r;
$full_attack += $flurry_bonus + $bonus_p + $tohit_feat_p;
$single_attack += $bonus_p + $tohit_feat_p;
//   echo "levelx = $class1_level";
$flurry_p1 = "";
$flurry_p2 = "";
$flurry_p3 = "";
$flurry_p4 = "";
$flurry_p5 = "";
$flurry_p6 = "";
$flurry_s1 = "";
$flurry_s2 = "";
$flurry_s3 = "";
$flurry_s4 = "";
$flurry_s5 = "";
$flurry_s6 = "";

$flurry_p1 = $full_attack;
$count = 1;
while ($count < $no_attacks){
  $count = $count + 1;
  $attnum_v = "attnum" . $count;
  $attnumr_v = "attnumr" . $count;
  $attnum_r_v = "attnum_r" . $count;
  if ($$attnum_v > 0){
     $$attnum_r_v = $$attnumr_v +  $mon_dex_bonus + $feat_attr + $magic_tohit_r + $feat_exattr + $size_ac_mod + $bonus_r
                    + $shield_tohit;
     $$attnum_v = $$attnum_v +  $bonus + $feat_atth + $magic_tohit_p + $feat_exatta + $size_ac_mod + $bonus_p + $tohit_feat_p +
                   + $shield_tohit;
     if ($attu == "Y"){
        $$attnum_v += $feat_attu;
     }
     $flurry_v = "flurry_p" . $count;
     $$flurry_v = $$attnum_v;
     $full_attack = $full_attack . "/". $$attnum_v ;
  //   echo "full attack $full_attack flurry_bonus $flurry_bonus bonus_p $bonus_p";
     $ranged_attack = $ranged_attack . "/" . $$attnum_r_v;
     $flurry_x  = $$attnum_v +  $flurry_att - $feat_atth + $feat_attu + $finess_diff;
//     if ($mon_weap_p == 'Unarmed strike'){
//       $flurry_x += $feat_atth;
//     }
//     $flurry = $flurry . "/" . $flurry_x;
  }
}
if ($exattap == "Y"){
   $full_attack = $full_attack_st . "/" . $full_attack;
}


/*
if ($flurry_no > 0){
//  echo "</BR> flurry $flurry_att";
  $count = 0;
  while ($count < $flurry_no){
     $count = $count + 1;
     $flurry_x  = $single_attack + $flurry_att - $feat_atth + $finess_diff;
// if weapon focus on unarmed strike add to flurry
     if ($mon_weap_p == 'Unarmed strike'){
        $flurry_x += $feat_atth;
     }
     if ($attu != "Y"){
        $flurry_x  += $feat_attu;
     }
     $flurry    = $flurry_x . "/"  . $flurry;
  }
}
*/
if ($feat_exatta11 < $feat_exatta12){
   $x = $feat_exatta11;
   $feat_exatta11 = $feat_exatta12;
   $feat_exatta12 = $x;
}


if ($feat_exattr != 0){
    $ranged_attack = $ranged_attack_st . "/" . $ranged_attack;
}
//
// Get Damage
//
//echo "weap_dam_p = $weap_dam_p";
$select = "select dambase_no  from dddambase where dambase = '$weap_dam_p'";
$result = mysqli_query($link, $select);
$old_dambase_no = 0;
if ($result){
    $row = mysqli_fetch_array($result);
    $old_dambase_no = $row['dambase_no'];
}
//
$count = 0;
while ($count < 12){
  $count = $count + 1;
  if ($count == 1){
   $select = "select dambase_no  from dddambase where dambase = '$weap_dam_p'";
   $result = mysqli_query($link, $select);
   $old_dambase_no = 0;
   if ($result){
      $row = mysqli_fetch_array($result);
      $old_dambase_no = $row['dambase_no'];
   }
   $old_weap_dam = $weap_dam_p;
   $orig_monweap_dam = $orig_monweap_dam_p;
   $weap_v = "mon_weap_p";
   $damage_v    = "damage_p";
   $weap_dam_v = "weap_dam_p";
  
   $weap_dambase_no_v = "monweap_dambase_no_p";
   $bonus = $mon_str_bonus + $feat_atthd + $magic_damage_p + $bonus_dam_close + $dam_feat_p;
   $bonus +=  weapgroup($mon_weap_p);
 //  echo  " </BR> bonus = $bonus bonus_dam_spec = $bonus_dam_spec";
   $bonus += $bonus_dam_spec;
   $weap_range_v = "weap_range_p";
   $weap_reload_v = "weap_reload_p";
   $weap_bow_v  = "weap_bow_p";
   $weap_crit_v = "weap_crit_p";
   $weap_crit_ch_v = "weap_crit_ch_p";
   $weap_prim_v = "weap_prim_p";
   $weap_cat_v = "weap_cat_p";
   $weap_type_v = "weap_type_p";
   $weap_str_mult_v = "weap_str_mult_p";

  }
  if ($count == 2){
     $weap_v = "mon_weap_r";
     $damage_v    = "damage_r";
     $weap_dam_v = "weap_dam_r";
     $weap_range_v = "weap_range_r";
     $weap_reload_v = "weap_reload_r";
     $weap_bow_v  = "weap_bow_r";
     $weap_crit_v = "weap_crit_r";
     $weap_crit_ch_v = "weap_crit_ch_r";
     $bonus = $feat_attrd + $magic_damage_r;
     $weap_prim_v = "weap_prim_r";
     $weap_cat_v = "weap_cat_r";
     $weap_type_v = "weap_type_r";
     $weap_str_mult_v = "weap_str_mult_r" ;

  }
  if ($count > 2){
     $sub = $count - 2;
     $orig_monweap_dam_v = "orig_monweap_dam_s" . $sub;
     $orig_monweap_dam = $$orig_monweap_dam_v;
   //  echo   "$orig_monweap_dam_v =  $orig_monweap_dam";
     $weap_v = "mon_weap_s" . $sub;
     $damage_v    = "damage_s". $sub;
     $weap_dam_v = "weap_dam_s" . $sub;
   // check for double weapon  07/05/2011
     $double = "";
     if ($count == "3"){
        $weap2_v = "weap_dam2_s" . $sub;
        $weap2 = $$weap2_v;
        $weap2 = trim($weap2);

  //      echo "$weap2_v = $weap2";
        if ($weap2 <> "" and $weap2 <> NULL and $mon_weap_s1 == $mon_weap_p){
           $double = "Y";
           $weap_dam_v = "weap_dam2_s1";
        }
     }

     $dam_sel = $$weap_dam_v;
     $select = "select dambase_no  from dddambase where dambase = '$dam_sel'";
   //  echo "</BR> $select";
     $result = mysqli_query($link, $select);
     $old_dambase_no = 0;
     if ($result){
        $row = mysqli_fetch_array($result);
        $old_dambase_no = $row['dambase_no'];
     }
     $old_weap_dam = $$weap_dam_v;
     $weap_dambase_no_v = "monweap_dambase_no_s" .$sub;
     $weap_range_v = "weap_range_s" . $sub;
     $weap_reload_v = "weap_reload_s" .$sub;
     $weap_bow_v  = "weap_bow_s" . $sub;
     $weap_crit_v = "weap_crit_s" . $sub;
     $weap_crit_ch_v = "weap_crit_ch_s" . $sub;
     $weap_prim_v = "weap_prim_s" . $sub;
     $weap_cat_v = "weap_cat_s" . $sub;
     $weap_type_v = "weap_type_s" . $sub;
     $weap_str_mult_v = "weap_str_mult_s" . $sub;
     $bonus = round(($mon_str_bonus /2 - 0.49),0);

  }
  $weapon = $$weap_v;
//  echo "</BR> weapon s1 = " .  $mon_weap_s1;
  if ($weapon =="" and $count ==2){
     $weapon = "None";
  }
  if ($weapon != ""){

//       echo "bonus3 " . $bonus_dam_spec;
     $mon_size_w = $mon_size;
     if  ($count == 1 or $weapon == $mon_weap_p){
        if ($weap_cat_p == "0-Natural" and $feat_size != ""){
           $mon_size_w = $feat_size;
        }
     }
     // double weapon 07/05/2011
     $double = "";
     if ($count == 3 and $mon_weap_p == $mon_weap_s1){
        $select = "select weap_dam2 from weapons where weap_id = '$weapon'";
        $result = mysqli_query($link, $select);
        if ($result){
           $row = mysqli_fetch_array($result);
           $weap_dam2 = $row['weap_dam2'];
           $weap_dam2 = trim($weap_dam2);
           if ($weap_dam2 <> "" and $weap_dam2 <> NULL){
              $double = "Y";
           }
        }
     }
 //    echo $mon_size_w;
     if ($double == "Y"){
       $select = "select damage, weap_range_str, weap_cat,weap_crit, weap_crit_ch, dambase_no, dambase_incr, weap_range, weap_reload, weap_bow, weap_prim, weap_type, " .
                 "weap_str_mult from weapons, damage,dddambase where  " .
                "weap_id = '$weapon' and dam_base = weap_dam2 and " .
                "dam_size = '$mon_size_w' and dambase = damage";
     }else{
       $select = "select damage, weap_range_str, weap_cat,weap_crit, weap_crit_ch, dambase_no, dambase_incr, weap_range, weap_reload, weap_bow, weap_prim, weap_type, " .
                  "weap_str_mult from weapons, damage,dddambase where  " .
                  "weap_id = '$weapon' and dam_base = weap_dam and " .
                  "dam_size = '$mon_size_w' and dambase = damage";
     }
 //echo "</BR>" . $select ."</BR>";
     $result = mysqli_query($link, $select);
     if ($result){
       $row = mysqli_fetch_array($result);
       $$damage_v = $row['damage'];
    //   $dam = $$damage_v;
   //    echo $damage_v . $dam . "</BR>";
       $weap_range_str = $row['weap_range_str'];
       $weap_cat = $row['weap_cat'];
       $$weap_cat_v = $weap_cat;
       $dambase_no = $row['dambase_no'];
       $$weap_dambase_no_v = $dambase_no;
   //    echo "disnpc " . $dambase_no;
       $dambase_incr = $row['dambase_incr'];
       if ($range_mod > 1){
          $$weap_range_v = $row['weap_range'] * $range_mod;
       }else{
          $$weap_range_v = $row['weap_range'];
       }
       $$weap_reload_v = $row['weap_reload'];
       $$weap_bow_v    = $row['weap_bow'];
       $weap_dambase_no = $$weap_dambase_no_v;
       $$weap_crit_v =  $row['weap_crit'];
       $$weap_crit_ch_v = $row['weap_crit_ch'];
       $$weap_prim_v = $row['weap_prim'];
       $$weap_type_v = $row['weap_type'];
       $$weap_str_mult_v = $row['weap_str_mult'];
       $weap_str_mult = $$weap_str_mult_v;
       if ($weap_str_mult == 1.5){
          $bonus = round(($mon_str_bonus * 1.5) -0.49,0) +  $feat_atthd + $magic_damage_p + $bonus_dam_close + $dam_feat_p;
          $bonus +=  weapgroup($weapon);
          $bonus += $bonus_dam_spec;
       }
  //     echo "bonus2 " . $bonus . " " . $weap_str_mult;

       if ($weap_type == "UN"){
             $bonus += $feat_attud;
       }
  //    echo "damage_r" . $damage_r . " count " . $count . " -  $damage_v";
       if ($count > 2){
         if ($$weap_prim_v == "S" or $weap_cat != "0-Natural" ){
            if ($feat_dslice == "Y" or ($weapon == $mon_weap_p and $weap_cat == "0-Natural")){
                $bonus = $mon_str_bonus + $bonus_dam_spec;
            }else{
                $bonus = round(($mon_str_bonus /2 - 0.49),0) + $bonus_dam_spec;
            }
         }else{                        
            $bonus = $mon_str_bonus + $bonus_dam_spec;
         }
         if ($$weap_str_mult_v == "1.5"){
             $bonus = round(($mon_str_bonus * 1.5) -0.49,0) +   $bonus_dam_spec;
         }

  //       echo "count " . $count . " bonus " . $bonus;
 // if same weapon as primary then add in weapon specialization feats
          if ($$weap_v == $mon_weap_p){
//              echo "bonus " . $bonus;
            $bonus = $bonus + $feat_atthd;
//       echo "bonus " . $bonus;
          }

          if ($count == 3 and $double == "Y"){
             $bonus +=  $magic_damage_p;
          }
          if ($weap_type == "UN"){
             $bonus += $feat_attud;
          }
       }
       if ($$weap_crit_v == ""){
           $$weap_crit_v = "2";
       }
       if ($$weap_crit_ch_v == ""){
           $$weap_crit_ch_v = "20";
       }
       if ($crit_mod !="" and ($count == 1 or $weapon == $mon_weap_p)){
          $crit_x = (21 - $$weap_crit_ch_v) * ($crit_mod +1);
          $$weap_crit_ch_v = 21 - $crit_x;
       }
       if ($crit_mod2 !="" and (($count > 2 or $weapon == $mon_weap_crit_s) and ($weapon != $mon_weap_p))){
//          echo "</BR>mon_weap_crit_s  $mon_weap_crit_s";
          if ($weapon == $mon_weap_crit_s or $mon_weap_crit_s == ""){
            $mon_weap_crit_s = $weapon;
            $crit_x = (21 - $$weap_crit_ch_v) * ($crit_mod2 +1);
            $$weap_crit_ch_v = 21 - $crit_x;
//            echo "critial $weapon $weap_crit_ch_v";
          }
       }
       if ($crit_mod_r !="" and $count == 2 ){
          $crit_x = (21 - $$weap_crit_ch_v) * ($crit_mod_r +1);
          $$weap_crit_ch_v = 21 - $crit_x;
       }
//
       if ($weap_cat == "0-Natural" and $$weap_dam_v != ""){
         if ($wp_user == "admin"){
// echo "</BR> $dambase_no RRR $weap_dambase_no size $mon_size_original old_dambase $old_dambase_no new_dambase $dambase_no ";
// echo "old grapple $old_grapple new grapple $new_grapple";
// dont change natural damage if size has not changed and feat not increased damage.
         }
          if ($mon_size == $mon_size_original and ($feat_size =="" or ($count != 1 and $weapon != $mon_weap_p)) or
           ($feat_size != "" and $weapon == $mon_weap_p)
            or ($mon_size != $mon_size_original and $new_grapple > $old_grapple and $new_grapple > $original_grapple)){
             if (($feat_size != ""  and $weapon == $mon_weap_p)
                 or ($mon_size != $mon_size_original and  $old_dambase_no >= $dambase_no
                                                     and $new_grapple > $old_grapple)){
                 if ($feat_size != "" and $weapon == $mon_weap_p){
                     $new_size_no = $new_size_no_feat;
                 }
     //    echo "</BR>new size $new_size_no orig size $original_size_no";

                 $size_diff =  5 + $new_size_no - $original_size_no;
                 if ($size_diff > 9 ){
                     $size_diff  = 9;
                 }
                 if ($size_diff < 1 ){
                     $size_diff  = 1;
                 }

                 $select4 = "select size_cat from size where size_no = '$size_diff'";
          //       echo "</BR> $select4";
                 $result4 = mysqli_query($link, $select4);
                 $row4 = mysqli_fetch_array($result4);
                 $size_cat_x = $row4['size_cat'];



              //   $select3 = "select dambase  from dddambase where dambase_no > $old_dambase_no order by dambase_no";
                 $select3 = "select damage from damage where dam_base = '$orig_monweap_dam' and dam_size = '$size_cat_x'";
                 $result3 = mysqli_query($link, $select3);
 //               echo "</BR>select 3 $select3";
                 $old_dambase_no = 0;
                 if ($result3){
                   $row3 = mysqli_fetch_array($result3);
                   $$damage_v = $row3['damage'];
                 }else{
                   $$damage_v = $$weap_dam_v;
                 }
             }else{
               if ($mon_size == $mon_size_original and $temp_weapons_flag !="Y"){
                 $$damage_v = $$weap_dam_v;
               }
             }
          }
       }
       // if no monk levels but original monster does unarmed damage then keep this unarmed damage
       if ($class1_tp != "Monk" and $class2_tp != "Monk" ){
 // echo "orig_mon_weap_p $orig_mon_weap_p";
          if ( $count == 1 and $orig_mon_weap_p =="Unarmed strike"){
            if ($mon_weap_p == "Unarmed strike"){
                $$damage_v = $monweap_dam_p;
            }
          }
          if ( $count == 3 and $orig_mon_weap_p =="Unarmed strike"){
            if ($mon_weap_s1 == "Unarmed strike"){
                $$damage_v = $monweap_dam_s1;
            }
         }
       }
      // echo "damage_r" . $damage_r;

     //    echo "levelx = $class1_level";






       /*
       if ($weap_cat == "0-Natural" and $$weap_dam_v != ""){
          $bonus += $feat_attud;
// echo "</BR> $dambase_no RRR $weap_dambase_no size $mon_size_original $old_dambase_no";
// dont change natural damage if size has not changed and feat not increased damage.
          if ($mon_size == $mon_size_original and ($feat_size =="" or ($count != 1 and $weapon != $mon_weap_p)) or
          ($feat_size != "" and $old_dambase_no > $dambase_no and $weapon == $mon_weap_p)){
             if (  $feat_size != "" and $old_dambase_no > $dambase_no and $weapon == $mon_weap_p){
                 $select3 = "select dambase  from dddambase where dambase_no > $old_dambase_no order by dambase_no";
                 $result3 = mysqli_query($link, $select3);
                 $old_dambase_no = 0;
                if ($result3){
                   $row3 = mysqli_fetch_array($result3);
                   $$damage_v = $row3[dambase];
                }else{
                 $$damage_v = $$weap_dam_v;
                }
             }else{
               $$damage_v = $$weap_dam_v;
             }
          }
       }
       */
       if ($count == 1 and $shield_bonus ==0 and ($mon_weap_s1 == "No Melee" or ($weap_type_p == "2H" and
                                                 (($double == "" or ($double =="Y" and $mon_weap_p <> $mon_weap_s1 ) )  and $weap_type_s1 == "UN")))
          and $mon_str_bonus > 0 and $weap_type_p != "LT" ){
//            and $weap_cat != "0-Natural"){
          $bonus = round(($mon_str_bonus * 1.5) -0.49,0) + $feat_atthd + $magic_damage_p + $dam_feat_p;
          $bonus +=  weapgroup($weapon);
          $bonus += $bonus_dam_spec;
          if ($weap_type == "UN"){
             $bonus += $feat_attud;
          }
//          echo round(($mon_str_bonus * 1.5) -0.49,0);
//          echo "</BR> Bonus  " . $bonus . $feat_atthd;
       }
       if ($count == 1 and $weap_cat == "0-Natural" ){
          if ($$weap_prim_v !=  "S"){
            $full_attack = $single_attack;
          }else{
            $full_attack = $single_attack;
          }
          if ($exattap == "Y"){
              $full_attack = $full_attack . "/" . $full_attack;
          }
          if ($weapon == "Swarm"){
             $full_attack = "";
             $single_attack = "";
             $bonus = "";
          }

       }



       if ($count == 2 and $weap_range_str == "Y"){
          $bonus = $mon_str_bonus + $feat_attrd + $magic_damage_r;
       }
       // Giants rocks are * 1.5 str
       if ($count == 2 and $weap_range_str == "H"){
          $bonus = round(($mon_str_bonus * 1.5) -0.49,0) + $feat_attrd + $magic_damage_r;

       }
       if ($count == 2){
          $bonus +=  weapgroup($weapon);
          if ($weap_reload_r != "Y"){
              if (($weap_reload_r != "RR" or $feat_rr != "Y") 
              and ($weap_reload_r != "RRB" or $feat_rrb != "Y")
              and ($weap_reload_r != "RRH" or $feat_rrh != "Y") ) {
                 $ranged_attack = $single_ranged;
                 if ($feat_exattr != 0){
                     $ranged_attack = $ranged_attack_st . "/" . $ranged_attack_st;
                 }
              }
          }
          if ($exattap == "Y"){
              $ranged_attack = $ranged_attack_st . "/" . $ranged_attack;
          }
       }
       if ($count > 2){
          $bonus +=  weapgroup($weapon);
          $bonus += $bonus_dam_spec;
       }
       if ($count == 3){
          $bonus += $magic_damage_s1;
       }
 //      echo "</BR>" . $count . " bonus " . $bonus;
       if ($bonus != 0){
          if ($bonus > 0){
             $$damage_v = $$damage_v . "+" . $bonus;
          }else{
             $$damage_v = $$damage_v . $bonus;
//             echo "here $bonus";
          }
          $dam_test = $$damage_v;
  //        echo "$damage_v $dam_test";
       }
       if ($count == 3){
          $attack_v = "attack_s" . ($count -2);
          if ($weap_cat != "0-Natural"){
      //       echo "feat_multiw $feat_multiw";
             if ($exatta != "Y" and $feat_multiw == "") {
                $$attack_v = $single_attack - 6 - $magic_tohit_p - $bonus_p;
             }else{
                $$attack_v = $single_attack + $feat_exatta - $magic_tohit_p + $flurry_bonus - $bonus_p + $feat_multiw;
                $flurry_s1 = $$attack_v;
             }
             if ($mon_weap_s1 != $mon_weap_p){
                   $$attack_v = $$attack_v - $feat_atth + $feat_atth2;
                   $atth2_weapon = $weapon;
                   $feat_atth2_used = "Y";
             }
        //   if double weapon in second hand add in magic bonus  07/05/2011
//        echo "double = $double";
//   01/08/13 magic second attack
//             if ($double == "Y"){
//                $$attack_v += $magic_tohit_p;
//             }
             $$attack_v += $magic_tohit_s1;
             $dis_attack = $$attack_v;
     //        echo "$attack_v $dis_attack $magic_tohit_s1";
             $$attack_v +=  weapgroup($weapon);
             $exatta1_count = 0;
             while ($exatta1_count <  $exatta1){
                $exatta1_count = $exatta1_count + 1;
                $feat_exatta1_v = "feat_exatta1" . $exatta1_count;
//                echo $feat_exatta1_v  . " " . $$feat_exatta1_v;
                $attack2        = $$feat_exatta1_v + $single_attack - $magic_tohit_p + $feat_exatta + $flurry_bonus - $bonus_p;
                $attack2 +=  weapgroup($weapon);
                $flurry_v = "flurry_s" . ($exatta1_count +1);
                $$flurry_v = $attack2;
//15/08/13 atth2
                if ($mon_weap_s1 != $mon_weap_p){
                   $attack2 = $attack2 - $feat_atth + $feat_atth2;
                   $feat_atth2_used = "Y";
                   $atth2_weapon == $weapon;
                }
                // double weapon 07/05/2011
//01/08/13
                $attack2 += $magic_tohit_s1;
//                if ($double == "Y"){
//                   $attack2 += $magic_tohit_p;
//                }
                $$attack_v = $$attack_v . "/" . $attack2;
             }
//   if secondary atack is the same as primary and they are natural then attack is same as primary
         }
          if ($weap_cat == "0-Natural" and $weapon == $mon_weap_p){
             $$attack_v = $single_attack  - $magic_tohit_p + $magic_tohit_s1;
  //           $damage_s1 = $damage_p;
          }
       }
//
       if ($count > 3 or (($count == 3 and $weap_cat == "0-Natural" and $weapon != $mon_weap_p))){
//             or ($weapon == $mon_weap_p and $count == 3 and $weap_cat != "0-Natural"))){
          $attack_v = "attack_s" . ($count -2);
          if (($$weap_prim_v == "S" and $weapon != $mon_weap_p) or $weap_cat_p != "0-Natural"  ){
              if ($feat_multi != ""){
                 $$attack_v = $single_attack + $feat_multi  - $magic_tohit_p;
              }else{
                 if ($feat_multiw != "" and $weap_cat != "0-Natural"){
//                   echo "feat exatt " . $feat_exatta;
                    $$attack_v = $single_attack + $feat_multiw  - $magic_tohit_p;
                 }else{
                     $$attack_v = $single_attack - 5  - $magic_tohit_p;
                 }
              }

          }else{
              $$attack_v = $single_attack  - $magic_tohit_p;
          }
          if ($weapon != $mon_weap_p){
            $$attack_v -=  $feat_atth + $bonus_p;
            $$attack_v +=  weapgroup($weapon);
            if ($feat_atth2_used != "Y" or $weapon == $atth2_weapon){
               $$attack_v += $feat_atth2;
               $atth2_weapon = $weapon;
               $feat_atth2_used = "Y";
            }
          }

          if ($weap_cat == "0-Natural" and ($weapon == $mon_weap_p and $count >3)){
             $$attack_v = $single_attack  - $magic_tohit_p ;
      //       $$damage_v = $damage_p - $magic_damage_p ;
          }
          if ($count == 3){
             $$attack_v += $magic_tohit_s1;
          }
       }

     }else{
       $$damage_v = 0;
          }
  }
}
//INIT
//echo "mon_dex_bonus  $mon_dex_bonus  feat_init $feat_init spec_init $spec_init";
if ($mon_dex != 0){
   $init = $mon_dex_bonus + $feat_init + $spec_init;
}else{
   $init = $mon_int_bonus + $feat_init + $spec_init;
}
$armour_cd_check = $armour_cd;
if ($feat_armtp > 0 and $armour_cd > 10){
   $armour_cd_check = $armour_cd - $feat_armtp;
   if ($armour_cd_check < 1){
      $armour_cd_check = 1;
   }
}
//echo "mon_speed ";
// speedmedmorm is a feat that allows normal speed in medium armor
//reset fly speed
$mon_speed_fly = $mon_speed_fly_save;
if ($speedmednorm == "Y" and $armour_cd_check < 4){

}else{
  $mon_speed_fly = speed($mon_speed_fly);
  if ($mon_speed == 30){
    $mon_speed = $armour_s30;
  }else{
     if ($mon_speed == 20){
       if ($mon_name == "Dwarf"){
          $mon_speed = 20;
       }else{
          $mon_speed = $armour_s20;
       }
     }else{
         if ($armour_s30 != 30){
           $mon_speed = speed($mon_speed);
         }
     }
  }
}
// fleet is only for medium or light armour
if ($armour_cd_check < 3){
  $speed_land = $mon_speed + $speed;
}else{
  $speed_land = $mon_speed;
}
$speed_land += $magic_speed;
// echo "</BR> $mon_speed xx $armour_cd xx $armour_s30 xx $speed_land";

//echo "levely $class1_level";


// include 'includes/dd_db_conn.txt' ;
// Add in monster levels
//echo "mon_int " . $mon_int;
if ($zombie_tem === 0 and $mon_int == 0){
}else{
  $link = getDBLink();
  $select = "SELECT monspec_value from monspec2 where monspec_tp = 'A' and (mon_name = '$mon_name' or mon_name = '$mon_temp'or mon_name = '$mon_temp2')" .
            "and monspec_name = '$class1_tp' and (mon_key_1 = '$wp_user' or  mon_key_1 = '$key_1')" .
             " and ((monspec_min = 0 and monspec_max = 0) or (monspec_min = '' and monspec_max = '') or (monspec_min <= '$total_level' and monspec_max = 0)" .
          "or (monspec_min <= '$total_level' and monspec_max >= '$total_level')  )";
  $result = mysqli_query($link, $select) ;
 // if ($wp_user == "admin"){
  //  echo $select;
 // }
  $class1_spell_level = $class1_level;
  $class2_spell_level = $class2_level;
  $class3_spell_level = $class3_level;
  //echo "class1_spell_level " . $class1_spell_level;
  $level_x = 0;
  if ($result){
     $row = mysqli_fetch_array($result);
     $level_x = $row['monspec_value'];
//    echo "level " . $level_x . "total level" .  $total_level;
     $class1_spell_level += $level_x;
  }
//add in monster Levels
  $select = "SELECT monspec_value from monspec2 where monspec_tp = 'A' and (mon_name = '$mon_name' or mon_name = '$mon_temp' or mon_name = '$mon_temp2')" .
            "and monspec_name = '$class2_tp' and (mon_key_1 = '$wp_user' or  mon_key_1 = '$key_1')" . 
             " and ((monspec_min = 0 and monspec_max = 0) or (monspec_min = '' and monspec_max = '') or (monspec_min <= '$total_level' and monspec_max = 0)" .
            "or (monspec_min <= '$total_level' and monspec_max >= '$total_level')  )";
  $result = mysqli_query($link, $select) ;
  $level_x = 0;
  if ($result){
     $row = mysqli_fetch_array($result);
     $level_x = $row['monspec_value'];
     $class2_spell_level += $level_x;
  }
}
//
// add in pretige spell levels
//
if ($class3_tp !=""){
  if ($class1_spat == "CHR" or $class1_spat == "INT" or $class1_psi == "Y"){
      $class1_spell_level += $pres_spell_lev_arc;
  }else{
      if ($class2_spat == "CHR" or $class2_spat == "INT" or $class2_psi == "Y"){
         $class2_spell_level += $pres_spell_lev_arc;
      }
  }
  if ($class1_spat == "WIS"){
      $class1_spell_level += $pres_spell_lev_div;
  }else{
      if ($class2_spat == "WIS"){
         $class2_spell_level += $pres_spell_lev_div;
      }
  }
  if ($class1_spat != ""){
      $class1_spell_level += $pres_spell_lev_any;
  }else{
      if ($class2_spat != ""){
         $class2_spell_level += $pres_spell_lev_any;
      }
  }
}
if ( $old_animal_comp_level > 0){
   $class1_level = $old_animal_comp_level;
}

$select = "select classl_feat, classl_tp," .
           " classl_sp0, classl_sp1,classl_sp2,classl_sp3,classl_sp4,classl_sp5,classl_sp6,classl_sp7,classl_sp8, " .
           " classl_sp9, " .
           " classl_sp0_n, classl_sp1_n,classl_sp2_n,classl_sp3_n,classl_sp4_n,classl_sp5_n,classl_sp6_n,classl_sp7_n,classl_sp8_n, " .
           " classl_sp9_n, ".
           " classl_damage, classl_psi_pts, classl_psi_cmb from classlev2 where " .
          "((classl_tp = '$class1_tp' and classl_lev = '$class1_spell_level') OR ".
          "(classl_tp = '$class2_tp' and classl_lev = '$class2_spell_level') OR ".
          "(classl_tp = '$class3_tp' and classl_lev = '$class3_spell_level'))  and mon_key_1 = '$key_1'";
//if ($wp_user == "admin"){
//   echo $select;
//}
if ( $old_animal_comp_level >0){
   $class1_level = $new_animal_comp_level;
}
$result = mysqli_query($link, $select) ;
if ($result){
  while ($row = mysqli_fetch_array($result)) {
    $classl_tp     = $row['classl_tp'];
    $classl_feat   = $row['classl_feat'];

 //  echo "</BR>" . $classl_tp . " " . $classl_tp;
    if ($class1_tp == $classl_tp){
//       echo "</BR>" . $class1_tp . " " . $classl_tp;
       $class1_feat = $classl_feat;
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
   //      echo $class1_feat;
       $class1_damage = $row['classl_damage'];
       $class1_spell0 = $row['classl_sp0'];
       $class1_spell1 = $row['classl_sp1'];
       $class1_spell2 = $row['classl_sp2'];
       $class1_spell3 = $row['classl_sp3'];
       $class1_spell4 = $row['classl_sp4'];
       $class1_spell5 = $row['classl_sp5'];
       $class1_spell6 = $row['classl_sp6'];
       $class1_spell7 = $row['classl_sp7'];
       $class1_spell8 = $row['classl_sp8'];
       $class1_spell9 = $row['classl_sp9'];
       $class1_spell0_n = $row['classl_sp0_n'];
       $class1_spell1_n = $row['classl_sp1_n'];
       $class1_spell2_n = $row['classl_sp2_n'];
       $class1_spell3_n = $row['classl_sp3_n'];
       $class1_spell4_n = $row['classl_sp4_n'];
       $class1_spell5_n = $row['classl_sp5_n'];
       $class1_spell6_n = $row['classl_sp6_n'];
       $class1_spell7_n = $row['classl_sp7_n'];
       $class1_spell8_n = $row['classl_sp8_n'];
       $class1_spell9_n = $row['classl_sp9_n'];
       $class1_psi_pts  = $row['classl_psi_pts'];
       $class1_psi_cmb  = $row['classl_psi_cmb'];
    }
    if ($class2_tp == $classl_tp){
       $class2_feat = $classl_feat;
       $class2_damage = $row['classl_damage'];
       $class2_spell0 = $row['classl_sp0'];
       $class2_spell1 = $row['classl_sp1'];
       $class2_spell2 = $row['classl_sp2'];
       $class2_spell3 = $row['classl_sp3'];
       $class2_spell4 = $row['classl_sp4'];
       $class2_spell5 = $row['classl_sp5'];
       $class2_spell6 = $row['classl_sp6'];
       $class2_spell7 = $row['classl_sp7'];
       $class2_spell8 = $row['classl_sp8'];
       $class2_spell9 = $row['classl_sp9'];
       $class2_spell0_n = $row['classl_sp0_n'];
       $class2_spell1_n = $row['classl_sp1_n'];
       $class2_spell2_n = $row['classl_sp2_n'];
       $class2_spell3_n = $row['classl_sp3_n'];
       $class2_spell4_n = $row['classl_sp4_n'];
       $class2_spell5_n = $row['classl_sp5_n'];
       $class2_spell6_n = $row['classl_sp6_n'];
       $class2_spell7_n = $row['classl_sp7_n'];
       $class2_spell8_n = $row['classl_sp8_n'];
       $class2_spell9_n = $row['classl_sp9_n'];
       $class2_psi_pts  = $row['classl_psi_pts'];
       $class2_psi_cmb  = $row['classl_psi_cmb'];
    }
    if ($class3_tp == $classl_tp){
       $class3_feat = $classl_feat;
       $class3_damage = $row['classl_damage'];
       $class3_spell0 = $row['classl_sp0'];
       $class3_spell1 = $row['classl_sp1'];
       $class3_spell2 = $row['classl_sp2'];
       $class3_spell3 = $row['classl_sp3'];
       $class3_spell4 = $row['classl_sp4'];
       $class3_spell5 = $row['classl_sp5'];
       $class3_spell6 = $row['classl_sp6'];
       $class3_spell7 = $row['classl_sp7'];
       $class3_spell8 = $row['classl_sp8'];
       $class3_spell9 = $row['classl_sp9'];
       $class3_spell0_n = $row['classl_sp0_n'];
       $class3_spell1_n = $row['classl_sp1_n'];
       $class3_spell2_n = $row['classl_sp2_n'];
       $class3_spell3_n = $row['classl_sp3_n'];
       $class3_spell4_n = $row['classl_sp4_n'];
       $class3_spell5_n = $row['classl_sp5_n'];
       $class3_spell6_n = $row['classl_sp6_n'];
       $class3_spell7_n = $row['classl_sp7_n'];
       $class3_spell8_n = $row['classl_sp8_n'];
       $class3_spell9_n = $row['classl_sp9_n'];
       $class3_psi_pts  = $row['classl_psi_pts'];
       $class3_psi_cmb  = $row['classl_psi_cmb'];
    }
  }
}
//echo "levelx $class1_level";
//if ($class1_tp == "Monk" or $class2_tp == "Monk"){
if ($flurry_of_blows == "Y"){
    $flurry = $flurry_p1 . "/" . $flurry_s1;
    if ($flurry_p2 !== ""){
        $flurry .= "/" . $flurry_p2;
    }
    if ($flurry_s2 !== ""){
        $flurry .= "/" . $flurry_s2;
    }
    if ($flurry_p3 !== ""){
        $flurry .= "/" . $flurry_p3;
    }
    if ($flurry_s3 !== ""){
        $flurry .= "/" . $flurry_s3;
    }
    if ($flurry_p4 !== ""){
        $flurry .= "/" . $flurry_p4;
    }
    if ($flurry_s4 !== ""){
        $flurry .= "/" . $flurry_s4;
    }
    if ($flurry_p5 !== ""){
        $flurry .= "/" . $flurry_p5;
    }
    if ($flurry_s5 !== ""){
        $flurry .= "/" . $flurry_s5;
    }
    $flurry_count = 0;
    while ($flurry_count < $flurry_no){
       $flurry = $flurry_p1 . "/" . $flurry;
       $flurry_count += 1;
    }
}

if ($class1_tp == "Monk" or $class1_tp == "Brawler" or $class1_tp == "Unchained Monk"){
   $flurry_damage = $class1_damage;
}else{
   $flurry_damage = $class2_damage;
}
//echo "monk_level_dam  $monk_level_dam ";
//  if feat adds to monk level for damage then reread for damage
if ($monk_level_dam > 0){
   $select = "select classl_damage from classlev2 where classl_lev = $monk_level_dam and classl_tp = 'Monk'";
 //  echo $select;
   $result = mysqli_query($link, $select) ;
   if (mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_array($result);
     $flurry_damage = $row['classl_damage'];
   }
}


$flurry_damage = strtolower($flurry_damage);

if ($flurry_damage != ""){
   $select = "select damage from damage where dam_base = '$flurry_damage' and dam_size = '$mon_size'";
   $result = mysqli_query($link, $select) ;
   if (mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_array($result);
     $f_dam = $row['damage'];
     if ($f_dam != ""){
         $flurry_damage = $f_dam . "+" . ($mon_str_bonus + $feat_attud + $feat_atthd);
     }
   }
   if ($mon_weap_p == "Unarmed strike"){
     $damage_p = $flurry_damage;
   }
   if ($mon_weap_s1 == "Unarmed strike"){
     $damage_s1 = $flurry_damage;
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
   if (($class1_level >= $class2_level and $class1_cr_mult >= $class2_cr_mult)
       or $class1_cr_mult > $class2_cr_mult){
      $cr = $mon_cr + (($mon_level - $mon_hd_original)/$montype_crx)  + ($class1_level * $class1_cr_mult) + ($class2_level /2) ;
   }else{
      $cr = $mon_cr + (($mon_level - $mon_hd_original)/$montype_crx)  + ($class2_level * $class2_cr_mult) + ($class1_level /2) ;
   }
}else{
  $cr = $mon_cr + (($mon_level - $mon_hd_original)/$montype_crx)  + $class1_level + $class2_level ;
}
if ($mon_size_original =="Medium" or $mon_size_original =="Fine" or $mon_size_original == "Diminutive" or
   $mon_size_original == "Tiny" or $mon_size_original =="Small"){
  if ($mon_size_u == "Large" or $mon_size_u == "Huge" or $mon_size_u == "Gargantuan" or $mon_size_u == "Colossal"){
    $cr = $cr +1;
  }
}
if ($elite == "Y" and $class_pc != "Y"){
  $cr = $cr + 1;
}
$cr_path = 0;
// if zero level and class then take 1 off the cr
if ($class1_level > 1 and $mon_hd_original == 0){
   if ($cr == 1){
      $cr_path = -0.5;
   }else{
      $cr_path = -1;
   }
}
// if zero class level and class level = 1 and no level adjustment cr = 0.5 or 0.3
if ($class1_level == 1 and $class2_level == 0 and $mon_level == 0 and $mon_level_adj < 1){
 //  echo "mon level adj" .   $mon_level_adj;
   if ($class1_cr_mult == 1){
     $cr = 0.5;
   }else{
     $cr = 0.3;
   }
}
$cr += $class3_level;

if ($weretemp != "" and $key_1 == "path"){

       if ($cr > $tem_cr){
  //          echo "cr = $cr";
           $cr += 1;
       }else{
           $cr = $tem_cr;
           $cr_path = 0;
   //         echo "cr t = $cr";
       }
}else{
//   echo "</BR> NPC $weretemp $tem_cr" ;
   $cr += $tem_cr;
//   echo "</BR> CR " .  $cr;
}
//echo "levely $class1_level";
//echo $zombie_tem;
if (($zombie_tem === 0 and $zombie == "Y") and $skeleton_tem == ""  and $exoskeleton_tem == ""){
   if ($total_level == 1){
      $cr = 0.25;
   }
   if ($total_level == 2){
      $cr = 0.5;
   }
   if ($total_level == 3 or $total_level == 4){
      $cr = 1;
   }
   if ($total_level == 6 or $total_level == 6){
      $cr = 2;
   }
   if ($total_level == 7 or $total_level == 8){
      $cr = 3;
   }
   if ($total_level == 9 or $total_level == 10){
      $cr = 4;
   }
   if ($total_level == 11 or $total_level == 12){
      $cr = 5;
   }
   if ($total_level >= 13 and $total_level <= 16){
      $cr = 6;
   }
   if ($total_level >= 17 and $total_level <= 20){
      $cr = 7;
   }
   if ($total_level >= 21 and $total_level <= 24){
      $cr = 8;
   }
   if ($total_level >= 25 and $total_level <= 28){
      $cr = 9;
   }
   if ($total_level >= 29 and $total_level <= 32){
      $cr = 10;
   }
   if ($total_level >= 33 and $total_level <= 36){
      $cr = 11;
   }
   if ($total_level >= 37 and $total_level <= 40){
      $cr = 12;
   }
   if ($total_level >= 41) {
      $cr = 13;
   }
   if (($elite == "Y" or $class_pc == "Y") and $total_level < 3) {
    $cr = 1;
   }

}
//echo "exo $exoskeleton_tem";
if (($zombie_tem === 0 and $zombie == "Y") and ($skeleton_tem === 0  or $exoskeleton_tem === 0)){
 //   echo "</BR> total level $total_level";
   if ($total_level == 1){
      $cr = 0.25;
   }
   if ($total_level == 2){
      $cr = 0.5;
   }
   if ($total_level == 3 or $total_level == 4){
      $cr = 1;
   }
   if ($total_level == 6 or $total_level == 6){
      $cr = 2;
   }
   if ($total_level == 7 or $total_level == 8){
      $cr = 3;
   }
   if ($total_level == 9 or $total_level == 10){
      $cr = 4;
   }
   if ($total_level == 11 or $total_level == 12){
      $cr = 5;
   }
   if ($total_level >= 13 and $total_level <= 15){
      $cr = 6;
   }
   if ($total_level >= 16 and $total_level <= 17){
      $cr = 7;
   }
   if ($total_level >= 18 and $total_level <= 20){
      $cr = 8;
   }
   if ($total_level >= 21 and $total_level <= 24){
      $cr = 9;
   }
   if ($total_level >= 25 and $total_level <= 28){
      $cr = 10;
   }
   if ($total_level >= 29 and $total_level <= 35){
      $cr = 11;
   }
   if ($total_level >= 36 and $total_level <= 40){
      $cr = 12;
   }
   if ($total_level >= 41) {
      $cr = 13;
   }
   if (($elite == "Y" or $class_pc == "Y") and $total_level < 3) {
    $cr = 1;
   }

}
//echo "half fiend $half_fiend_temp level $mon_level" ;
if ($half_fiend_temp == "Y"){
   if ($mon_level > 4){
     $cr += 1;
//     echo "</BR>add 1";
   }
   if ($mon_level > 10){
     $cr += 1;
 //    echo "</BR>add 1";
   }
}
if ($fiendish_temp == "Y"){
   if ($mon_level > 4){
     $cr += 1;
//     echo "</BR>add 1";
   }
}
// echo "</BR> CR " .  $cr;
// animal companion has no CR
if ($class1_tp == "Animal Companion"){
   $cr = 0;
}

$cr_total = $cr + $cr_path;
if ($cr_total > 1){
   $cr_total = round($cr_total,0);
}
if($cr_total < 0 ){
  $cr_total = 0.25;
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
$select = "SELECT armour_cd, armour_tp, armour_bonus_path FROM armour " .
           "where armour_cd != '4' order by armour_cd, armour_bonus_path, armour_dex DESC";
// echo "select" . $select;
$result = mysqli_query($link, $select) ;
//  echo "result " $result;
while ($row = mysqli_fetch_array($result)) {
	$armour_tp_sel = $row['armour_tp'] ;
    $armour_bonus_sel = $row['armour_bonus_path'] ;
    $armour_cdx = $row['armour_cd'];
    if ($armour_tp_sel == $mon_armour)
      {
       $sel = " SELECTED" ;
    } else {
       $sel = "" ;
    }
    $armour_0 = "Y";
    $armour_v = "armour_" . $armour_cdx;
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
$select = "SELECT armour_cd, armour_tp, armour_bonus_path FROM armour " .
           "where armour_cd = '4' order by armour_cd, armour_bonus_path, armour_dex DESC";
// echo "select" . $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row['armour_tp'] ;
    $armour_bonus_sel = $row['armour_bonus_path'] ;
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
 //   echo "buck = $armour_BUCKLER";
    if ($armour_BUCKLER == "Y" and $armour_tp_sel == "Shield, buckler"){
        $color = "validOption";
    }
	    $shieldHTML .= '<OPTION class ="'.$color.'" VALUE="'.$armour_tp_sel.'" '.$sel.' >'.$armour_tp_sel.' '.$armour_bonus_sel.'</OPTION>';
}
mysqli_close($link);

// weapons HTML
//include 'includes/dd_db_conn.txt' ;
$weaponsHTML = "";
$link = getDBLink();
$select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp != 'Ranged' order by weap_cat, weap_id";
// echo "select" . $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $weap_id_sel = $row['weap_id'] ;
    $weap_cat_sel = $row['weap_cat'] ;
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
$htmlp_special_attacks = "";
$htmlp_special_qualities = "";
$htmlp_special_qualities_s = "";
$htmlp_secondary_attacks =  "";
if ($extra_attack == "Add Extra Attack"){
   $add_extra_attack += 1;
}

if ($add_extra_attack < 1){
   $add_extra_attack = 1;
   $check_count = 1;
    While ($check_count < 10){
       $check_count += 1;
       $name = "mon_weap_s" . $check_count;
       if ($$name != "No Melee" and $$name !=""){
          $add_extra_attack += 1;
       }

    }
}
$link = getDBLink();
$delete = "DELETE from attacktemp where attacktemp_user = '$user'";
$result = mysqli_query($link, $delete) ;
mysqli_close($link);
$crit_ch_p  = $weap_crit_ch_p;
$crit_p  = $weap_crit_p;
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
    $crit_txt_p =  " Crit X". $crit_p;
  }
}
$htmlx_primary_attacks = $mon_weap_p . " +" . $full_attack . " (" .  $damage_p . $crit_txt_p . ")";
$attack = $full_attack;
$x = addattacktemp($htmlx_primary_attacks,"P");


While ($count < 10) {
	$count = $count + 1;
	$secondaryWeaponHTML[$count] = "";
	$name = "mon_weap_s" . $count;
	$mon_weap_s = $$name;
	$damage_v     = "damage_s" . $count;
	$damage       = $$damage_v;
	$attack_v = "attack_s" . ($count);
	$attack = $$attack_v;
	$crit_v = "weap_crit_s" . $count;
	$crit = $$crit_v;
        $crit_ch_v = "weap_crit_ch_s" . $count;
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
               $crit_txt =  " Crit X". $crit;
           }
        }
//  echo $mon_weap_s;

	if ($count <= $add_extra_attack or ($mon_weap_s != "No Melee" and $mon_weap_s !="")) {
	   $secondaryWeaponHTML[$count] = '<p class="boxLabel">Off Hand/Other Attacks</p><p class="boxValue"><SELECT NAME="'.$name.'">';
	   if ($attack >= 0){
              if ($count == 1){
	         $print_secondary_attacks .=  $mon_weap_s . " +" . $attack . " (" . $damage . " Crit(". $crit_ch . "-20)X". $crit . ")\n";
	         $htmlx_secondary_attacks =   $mon_weap_s . " +" . $attack . " (" . $damage . $crit_txt . ")";
	       }else{
                 $print_secondary_attacks .=  $mon_weap_s . " +" . $attack . " (" . $damage . " Crit(". $crit_ch . "-20)X". $crit . ")\n";
                 $htmlx_secondary_attacks =   $mon_weap_s . " +" . $attack . " (" . $damage . $crit_txt . ")";
               }
            }else{
               $print_secondary_attacks .=  $mon_weap_s . $attack . " (" . $damage . $crit_txt . ")\n";
               $htmlx_secondary_attacks =   $mon_weap_s . $attack .  " (" . $damage . $crit_txt. ")";
            }

            $htmlp_secondary_attacks .= $htmlx_secondary_attacks . "</BR>";
            $x = addattacktemp($htmlx_secondary_attacks, "S");

//    include 'includes/dd_db_conn.txt' ;
		$link = getDBLink();

    	$select = "SELECT weap_id, weap_cat FROM weapons " .
             "where weap_range_tp != 'Ranged' order by weap_cat, weap_id";
    	$result = mysqli_query($link, $select) ;

		while ($row = mysqli_fetch_array($result)) {
			$weap_id_sel = $row['weap_id'] ;
			$weap_cat_sel = $row['weap_cat'] ;
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
$select = "SELECT weap_id, weap_cat, weap_firearm FROM weapons " .
           "where weap_range_tp = 'Ranged' order by weap_cat, weap_id";
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $weap_id_sel = $row['weap_id'] ;
    $weap_cat_sel = $row['weap_cat'] ;
    $weap_firearm = $row['weap_firearm'] ;
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
//if ($class1_tp == "Monk" or $class2_tp == "Monk") {
if ($flurry_of_blows == "Y"){
	$monkHTML = '<li class="specialAbility"><ul>';
	$monkHTML .= "<li>Monk's Flurry of Blows</li>";
	$monkHTML .= '<li  class="small greyText">Attack: '.$flurry.'</li>';
	$monkHTML .= '<li  class="small greyText">Damage: '.$flurry_damage.'</li>';
	$monkHTML .= '</ul></li>';
}

//$x = specattr();

// Monster Special Attacks
//include 'includes/dd_db_conn.txt';

$link = getDBLink();
$monsterSpecialHTML = "";
$mon_namex = $mon_name;
if ($zombie_tem === 0 and $mon_int == 0){
   $mon_namex = "XXXX";
}
$select = "SELECT monspec_name, monspec_value, specatta_abil, specatta_save, specatta_type, speca_desc from monspec2, specatta where monspec_tp = 'A' and (mon_name = '$mon_namex' or mon_name = '$mon_temp' or mon_name = '$mon_temp2')" .
          "and monspec_name = speca_name and (mon_key_1 = '$wp_user' or  mon_key_1 = '$key_1')" .
          " and ((monspec_min = 0 and monspec_max = 0) or (monspec_min = '' and monspec_max = '') or (monspec_min <= '$total_level' and monspec_max = 0)" .
          "or (monspec_min <= '$total_level' and monspec_max >= '$total_level')  ) order by monspec_name";
//if ($wp_user == "admin"){
//   echo $select;
//}
$result = mysqli_query($link, $select) ;
//  echo "result " $result;
$count = 0;
$mon_nul_bonus = 0;
// if monster has a template then specials abilities include levels
//echo "template " . $mon_template;
if ($mon_template == "0" or $mon_template =="L" or $mon_template == "T" or $new_animal_comp_level > 0){
   $spec_level = $total_level;
}else{
   $spec_level = $mon_level + $tem_level;
}
//echo "spec level " . $spec_level;
while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $specatta_abil = $row['specatta_abil'];
    $specatta_type = $row['specatta_type'];
    $abil_atr_v = "mon_". strtolower($specatta_abil) . "_bonus";
    $abil_atr_p_v = "mon_". strtolower($specatta_abil);
    if (isset($$abil_atr_p_v)){
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
  //      echo "invalid $specatta_abil : $specatta_type";
        $$abil_atr_v = "mon_nul_bonus";
    }


    $specatta_save = $row['specatta_save'];
    $speca_desc = trim($row['speca_desc']);
    if ($speca_desc != "" and $old_specatta !=  $row['monspec_name'] ){
       $old_specatta =  $row['monspec_name'];
       $print_specdesc .= "<b>" . $row['monspec_name'] . "</B>:" . $speca_desc . "</BR>";
    }
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
//       echo "$domain_v $domain_m1";
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
    //          echo "Ranged $print_ranged";
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
                         if ($specatta_type == "INIT"){
                            $count_init += 1;
                            if ($count_init > 1){
                                $print_init .= ", ";
                            }
                            $print_init .= $row['monspec_name'] . "$DC_txt" . $row['monspec_value'];
                         }else{
                             if ($htmlp_special_attacks != ""){
                               $htmlp_special_attacks .= ",</BR>";
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
}
if ($htmlp_special_attacks != ""){
    $htmlp_special_attacks .= "</BR>";
}

//
//

//
//
//

// Monster Special Abilities
//include 'includes/dd_db_conn.txt';
$link = getDBLink();
$specialAbilitiesHTML = "";
$select = "SELECT monspec_name, monspec_value, specqual_abil, specqual_save, specqual_type, specq_desc from monspec2, specqual where monspec_tp = 'S' and (mon_name = '$mon_namex' or mon_name = '$mon_temp' or mon_name = '$mon_temp2') " .
          "and monspec_name = specq_name and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1') " .
          " and ((monspec_min = 0 and monspec_max = 0) or (monspec_min = '' and monspec_max = '') or (monspec_min <= '$total_level' and monspec_max = 0)" .
          "or (monspec_min <= '$total_level' and monspec_max >= '$total_level')  )";
$result = mysqli_query($link, $select) ;
//  echo "result " $result;
$count = 0;
$print_sen = "";
$print_sub = "";
$print_def = "";

$print_hp = "";
$print_speed = "";
$print_spell_abil = "";
$print_special_qualities = "";
$print_space = "";

$count_sen = $count_sub = $count_def = $count_hp = $count_speed = $count_spell_abil = 0;
$count_special_qualities = $count_space = 0;
while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $specqual_abil = $row['specqual_abil'];
    $abil_atr_v = "mon_". strtolower($specqual_abil) . "_bonus";
    if (isset($$abil_atr_v)){
       if ($$abil_atr_v == "0"){
          if ($mon_chr > 1){
            $abil_atr_v = "mon_chr_bonus";
          }else{
            $abil_atr_v = "mon_nul_bonus";
          }
       }
    }else{
          $abil_atr_v = "mon_nul_bonus";
    }
    $specqual_save = $row['specqual_save'];
    $specqual_type = $row['specqual_type'];
    $specq_desc = trim($row['specq_desc']);
    if ($specq_desc != "" and $specq_desc != " "){
       $print_specdesc .= "<b>" . $row['monspec_name'] . "</B>:" . $specq_desc . "</BR>";
    }
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
    $specialAbilitiesHTML .= '<li>'.$row['monspec_name']. $DC_txt .'</li>';
    $specialAbilitiesHTML .= '<li class="small greyText">'.$row['monspec_value'].'</li>';
    $specialAbilitiesHTML .= '</ul></li>';
    $monspec_name = $row['monspec_name'];
    $monspec_value = $row['monspec_value'];
    $print_item = $monspec_name;
    $htmlp_item = "<b>" . $monspec_name . "</b>";
 //   echo $htmlp_item . $specqual_type . " ";
    if ($DC_txt != " "){
       $print_item .= $DC_txt;
       $htmlp_item .= trim($DC_txt);
    }
    if ($monspec_value != "" and $monspec_value != " "){
       $print_item .=  " " . $monspec_value;
       $htmlp_item .=  " " . $monspec_value;
//       echo "<div>item = $htmlp_item</div>";
    }
    if ($specqual_type == "SEN"){
        $count_sen += 1;
        if ($count_sen > 1){
           $print_sen .= ", ";
        }
        $print_sen .= $print_item;
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $htmlp_special_qualities_s .= $print_item;
    }
    if ($specqual_type == "SUB"){
        $count_sub += 1;
        if ($count_sub > 1){
           $print_sub .= ", ";
        }
        $print_sub .= $print_item;
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $htmlp_special_qualities_s .= $print_item;
    }
    if ($specqual_type == "DEF"){
        $count_def += 1;
        if ($count_def > 1){
           $print_def .= ", ";
           $htmlp_def .= ", ";
        }
        $print_def .= $print_item ;
        $htmlp_def .= $htmlp_item;
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $htmlp_special_qualities_s .= $print_item;
   //     echo $htmlp_def;
    }
    if ($specqual_type == "HP"){
        $count_hp += 1;
        if ($count_hp > 1){
           $print_hp .= ", ";
        }
        $print_hp .= $print_item;  
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $htmlp_special_qualities_s .= $print_item;
    }
    if ($specqual_type == "SPEED"){
        $count_speed += 1;
        if ($count_speed > 1){
           $print_speed .= ", ";
        }
        $print_speed .= $print_item;
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $htmlp_special_qualities_s .= $print_item;
    }
    if ($specqual_type == "ACTEXT"){
       if ($AC_text != ""){
           $AC_text .= ", ";
       }else{
           $AC_text = "; ";
       }
       $AC_text .= $print_item;
    }
    if ($specqual_type == "SPACE"){
        $count_space += 1;
        if ($count_space > 1){
           $print_space .= ", ";
        }
        $print_space .= $print_item ;
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $htmlp_special_qualities_s .= $print_item ;
    }
    if ($specqual_type == "AURA"){
        $count_aura += 1;
        if ($count_aura > 1){
           $print_aura .= ", ";
        }
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $print_aura .= $print_item ;
        $htmlp_special_qualities_s .= $print_item ;
    }
    if ($specqual_type == "SVTEXT"){
        $count_svtext += 1;
        if ($save_text != ""){
           $save_text .= ", ";
        }
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $save_text .= $print_item ;
        $htmlp_special_qualities_s .= $print_item ;
    }
    if ($specqual_type == "INIT"){
        $count_init += 1;
        if ($print_init != ""){
           $print_init .= ", ";
        }
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $print_init .= $print_item ;
        $htmlp_special_qualities_s .= $print_item ;
    }
    if ($specqual_type == "CMB"){
        $count_CMB += 1;
        if ($count_CMB > 1){
           $print_CMB .= ", ";
        }
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $print_CMB .= $print_item ;
        $htmlp_special_qualities_s .= $print_item ;
    }
    if ($specqual_type == "CMD"){
        $count_CMD += 1;
        if ($count_CMD > 1){
           $print_CMD .= ", ";
        }
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $print_CMD .= $print_item ;
        $htmlp_special_qualities_s .= $print_item ;
    }
    if ($specqual_type == "SPELL"){
        $print_spell_abil .= $print_item . "\n";
        if ($htmlp_spell_abil_s != ""){
            $htmlp_spell_abil_s .= ", " ;
        }
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $htmlp_spell_abil_s .= $print_item ;
        $htmlp_spell_abil .= $print_item . "</BR>";
        $htmlp_special_qualities_s .= $print_item ;
    }
    if ($specqual_type == "" or $specqual_type == " "){
        $count_special_qualities += 1;
        if ($count_special_qualities > 1){
           $print_special_qualities .= ", ";
           $htmlp_special_qualities .= "</BR>";
        }
        if ($htmlp_special_qualities_s !=""){
            $htmlp_special_qualities_s .= ", ";
        }
        $print_special_qualities .= $print_item ;
        if ($DC_txt != ""){
           $htmlp_special_qualities .= "<b>$monspec_name</b>$DC_txt $monspec_value" ;
        }else{
           $htmlp_special_qualities .= "<b>$monspec_name</b> $monspec_value" ;
        }
        $htmlp_special_qualities_s .= $print_item;
    }
}
//classffeats 26/07/2011
$x = count_feats();
//  FEATS
// Work out how many
/*
$mon_feats_calc = 0;
if ($mon_level >0){
   $mon_feats_calc = round(($mon_level- 1) / 2 - 0.49,0) + 1;
}
if ($tem_level >0){
   $tem_feats_calc = round(($tem_level -1) / 2 - 0.49,0) + 1;
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
}

//echo "calc " . $mon_feats_calc . "free " . $mon_free_feats;
if ($mon_name == "Human" and $zombie != "Y"){
   $mon_feats = $mon_feats + 1;
}
if ($class1_tp != "" and $zombie !="Y"){
   $gen_feats = round(($class1_level + $class2_level + $class3_level +1) / 2 - 0.49,0) + $mon_feats + $class_feats + $tem_feats;
}else{
   $gen_feats = $mon_feats + $tem_feats;
}
//echo "gen_feats $gen_feats";
//echo "</BR> mon_feats = " . $mon_feats;
//echo "</BR> tem_free_feats = " . $tem_free_feats;
//echo "</BR> class_feats = " . $class_feats;
//echo "</BR> class2_feat = " . $class2_feat;
 if ($zombie == "Y"){
    $class1_feat = 0;
    $class2_feat = 0;
 }

$max_feats = $mon_feats + $class1_feat + $class2_feat + $gen_feats + $class_feats;
*/
//echo "@".$max_feats."<br/>";

// Get temp feats
//include 'includes/dd_db_conn.txt' ;
$link = getDBLink();

$select = "SELECT feattemp_feat, feattemp_class, feattemp_auto, feat_desc from feattemp, feats2 where feattemp_user = '$user'" .
         " and mon_key_1 = '$key_1' and feat_name = feattemp_feat " .
          "ORDER BY feattemp_class, feattemp_feat";

// echo "</BR> SELECT = " . $select;
$result = mysqli_query($link, $select) ;
$count = 0;
$old_class ="";
$print_feat = "";
$htmlp_feat = "";
$htmlp_feat_s = "";
if ($result){
  while ($row = mysqli_fetch_array($result)) {
     $feat_class = $row['feattemp_class'];

     if ($old_class != $feat_class){
        $count = 0;
     }
     $count = $count + 1;
     $old_class = $feat_class;
     $featv = "feat_" . $feat_class . $count;
     $$featv = $row['feattemp_feat'] ;
     $autov   = "feat_auto_" . $feat_class . $count;
     $$autov = $row['feattemp_auto'];
     $feat_desc = $row["feat_desc"];
     $print_feat .= $row['feattemp_feat'] . ": " . $feat_desc .  "," . "\n";
     if ($htmlp_feat != ""){
        $htmlp_feat .= ",</BR></div><div>";
        $htmlp_feat_s .= ", ";
     }
     $htmlp_feat .= $row['feattemp_feat'];
     $htmlp_feat_s .= $row['feattemp_feat'];
     if ($feat_desc != ""){
        $htmlp_feat .= ": " . $feat_desc ;
     }
//     echo "</BR>" .  $featv . " " . $$featv;
  }
  if ($htmlp_feat != ""){
     $htmlp_feat .= "</BR></div><div>";
     $htmlp_feat_s .= "; ";
  }
}

// Build up HTML
$featsHTML = array();

$reduce_feat1_r = "reduce_feats_". $class1_tp;
if (isset($$reduce_feat1_r)){
   $reduce_feat1 =  $$reduce_feat1_r;
}else{
   $reduce_feat1 = 0;
}

$reduce_feat2_r = "reduce_feats_". $class2_tp;
if (isset($$reduce_feat2_r)){
   $reduce_feat2 =  $$reduce_feat2_r;
}else{
   $reduce_feat2 = 0;
}

$reduce_feat3_r = "reduce_feats_". $class3_tp;
if (isset($$reduce_feat3_r)){
   $reduce_feat3 =  $$reduce_feat3_r;
}else{
   $reduce_feat3 = 0;
}

//echo "</BR>reduce_feat1 = $reduce_feat1</BR>";
$count1 = 0;
$add2 = 0;
$count3 = 0;
if ($domain_11 != ""){
   $select_rf = "select spellcl_replace_feats from spellcl where spellcl_id = '$domain_11'";
//   echo $select_rf;
   $result = mysqli_query($link, $select_rf) ;
   $row = mysqli_fetch_array($result);
   $spellcl_replace_feats1 = $row['spellcl_replace_feats'];
}
if ($domain_21 != ""){
   $select_rf = "select spellcl_replace_feats from spellcl where spellcl_id = '$domain_21'";
   $result = mysqli_query($link, $select_rf) ;
   $row = mysqli_fetch_array($result) ;
   $spellcl_replace_feats2 = $row['spellcl_replace_feats'];
}
//echo "gen feats = $gen_feats";
//allows for 2 additional feats per class
while ($count3 < 10){
	$count3 = $count3 + 1;

	$featsHTML[ $count3 ] = "";


	if ($count3 == 1){
	      if ($class1_feat > 0){
		 	$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class1_tp.' <span class="small">(Max: '.$class1_feat.')</span></h4>';
	     }
	     $max_feats = $class1_feat - $reduce_feat1;
	}

	if ($count3 ==2){
	      if ($class2_feat > 0){
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class2_tp.' <span class="small">(Max: '.$class2_feat.')</span></h4>';
	     }
     	    $max_feats = $class2_feat - $reduce_feat2;
        }
	if ($count3 == 3){
    	$featsHTML[ $count3 ] = '<h4 class="boxLabel">General <span class="small">(Max: '.$gen_feats.')</span></h4>';
	    $max_feats = $gen_feats;
  	}
  	if ($count3 ==4){
      //        echo "  class3_feat = $class3_feat " ;
	      if ($class3_feat > 0){

     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class3_tp.' <span class="small">(Max: '.$class3_feat.')</span></h4>';
	     }
     	    $max_feats = $class3_feat - $reduce_feat3;
        }
        if ($count3 ==5){
              $no_feats = 0;
   //             echo  "add_feat_class1 = " . $add_feat_class1 ;
	      if ($add_feat_class11 != "" and $$add_feat_class11 > 0){
                $no_feats = $$add_feat_class11;
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class1_tp.' abilities <span class="small">(Max: '.$no_feats.')</span></h4>';
	      }
     	      $max_feats = $no_feats;
        }
        if ($count3 ==6){
              $no_feats = 0;
   //             echo  "add_feat_class1 = " . $add_feat_class1 ;
	      if ($add_feat_class12 != "" and $$add_feat_class12 > 0){
                $no_feats = $$add_feat_class12;
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class1_tp.' abilities <span class="small">(Max: '.$no_feats.')</span></h4>';
	      }
     	      $max_feats = $no_feats;
        }
        if ($count3 ==7){
              $no_feats = 0;
	      if ($add_feat_class21 != "" and $$add_feat_class21 > 0){
                $no_feats = $$add_feat_class21;
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class2_tp.' abilities <span class="small">(Max: '.$no_feats.')</span></h4>';
	      }
     	      $max_feats = $no_feats;
        }
        if ($count3 ==8){
              $no_feats = 0;
	      if ($add_feat_class22 != "" and $$add_feat_class22 > 0){
                $no_feats = $$add_feat_class22;
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class2_tp.' abilities <span class="small">(Max: '.$no_feats.')</span></h4>';
	      }
     	      $max_feats = $no_feats;
        }
        if ($count3 ==9){
              $no_feats = 0;
	      if ($add_feat_class31 != "" and $$add_feat_class31 > 0){
                $no_feats = $$add_feat_class31;
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class3_tp.' abilities <span class="small">(Max: '.$no_feats.')</span></h4>';
	      }
     	      $max_feats = $no_feats;
        }
        if ($count3 ==10){
              $no_feats = 0;
	      if ($add_feat_class32 != "" and $$add_feat_class32 > 0){
                $no_feats = $$add_feat_class32;
     		$featsHTML[ $count3 ] = '<h4 class="boxLabel">'.$class3_tp.' abilities <span class="small">(Max: '.$no_feats.')</span></h4>';
	      }
     	      $max_feats = $no_feats;
        }
	$count1 = 0;
	$add2 = 0;
	$epic = "XXXX";
 //  echo "<p>--".$count3."<br/></p>";
	while ($count1 < 6 and $add2 < $max_feats){
   //       if ($wp_user == "admin"){
   //    echo "<p>" . $count1." ".$add2." ".$max_feats."</p>";
   //       }
	    $count1 = $count1 + 1;
	    $add1   = ($count1 - 1) * 5;
	    $count2 = 0;
	    while ($count2 < 5 and $add2 < $max_feats){
                $classfeat_check = "";
                $count2 = $count2 + 1;
                $add2 = $add1 + $count2;
		$featv  = "feat_" . $count3 . $add2;
		if (!isset($$featv)){
                    $$featv = "";
                }
		$feat = $$featv;
                if ($feat == ""){
                    $null_feat += 1;
                }
                $feat_autov = "feat_auto_" . $count3 . $add2;
                if (!isset($$feat_autov)){
                    $$feat_autov = "";
                }
                $auto = $$feat_autov;
//	if ($wp_user == "admin"){
 //         echo  "</BR>" . $featv . $feat , $auto;
 //         }

                if ($add2 <= $max_feats){
                   $featsHTML[ $count3 ] .= '<li>';
                    if ($count3 == 3 and $auto ==  "Y" and $feat !=""){
                        $featsHTML[ $count3 ] .= '<p class="featName">'.$feat;
                    }else{
                        $featsHTML[ $count3 ] .= '<p class="featName"><SELECT NAME="'.$featv.'" >';
//          echo "Count = " . $count3;
		        if ($count3 == 1){
                           if ($class1_tp == "Sorcerer" or $class1_tp == "Oracle" or $class1_tp == "Bloodrager"){
                               $class_type = $domain_11;
                           }else{
                                $class_type = $class1_tp;
                           }
                           if ($class1_tp == "Monk" or $class1_tp == "Alchemist"){
                               $domainor = " or classfeat_class = '$domain_11'";
                           }else{
                               $domainor = "";
                           }
                           if ($domain_11 == "Viking" and $class1_level > 5){
                               $domainor = " or feat_char_spec = 'Barbarian'";
                           }
                           // if replace feats flag = y use feats on the archetypes instead of the base class
                           if ($spellcl_replace_feats1 == "Y"){
                             $select = "SELECT feat_name, feat_desc, MIN(classfeat_level) as classfeat_level, MAX(classfeat_del_feat) as classfeat_del_feat
                               FROM feats2, classfeats2
	                      where (classfeat_class = '$domain_11') and classfeat_level <= '$class1_level' and feat_name = classfeat_feat
   	                       and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1' group by feat_name group by feat_name order by feat_name" ;
                           }else{
                              $select = "SELECT feat_name, feat_desc, MIN(classfeat_level) as classfeat_level, MAX(classfeat_del_feat) as classfeat_del_feat
                                FROM feats2, classfeats2
	                         where (classfeat_class = '$class_type' $domainor ) and classfeat_level <= '$class1_level' and feat_name = classfeat_feat
                                 and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1' group by feat_name order by feat_name" ;
                           }
	                   if ($class1_tp != "Fighter" and $class1_tp != "Magus"){
	                      $$feat_autov = "Y";
         		   }
         		   $classfeat_check = "Y";
                        }else{
                            if ($count3 == 2){
                                if ($class2_psi != "Y"){
                                     if ($class2_tp == "Sorcerer" or $class2_tp == "Oracle" or $class2_tp == "Bloodrager"){
                                         $class_type = $domain_21;
                                     }else{
                                         $class_type = $class2_tp;
                                     }
                                     if ($class2_tp == "Monk" or $class2_tp == "Alchemist"){
                                         $domainor = " or classfeat_class = '$domain_21'";
                                     }else{
                                         $domainor = "";
                                     }
                                     if ($domain_21 == "Viking" and $class2_level > 5){
                                        $domainor = " or feat_char_spec = 'Barbarian'";
                                     }
                                     if ($spellcl_replace_feats2 == "Y"){
                                         $select = "SELECT feat_name, feat_desc, classfeat_level FROM feats2, classfeats2 " .
	                                   "where (classfeat_class = '$domain_21') and classfeat_level <= '$class2_level' and feat_name = classfeat_feat ".
	             	                   " and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'" . "order by feat_name" ;
                                     }else{
            	                        $select = "SELECT feat_name, feat_desc, MIN(classfeat_level) as classfeat_level, MAX(classfeat_del_feat) as classfeat_del_feat
                                            FROM feats2, classfeats2
	              		           where (classfeat_class = '$class_type' $domainor  )and classfeat_level <= '$class2_level' and feat_name = classfeat_feat
                                             and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'
	              		           group by feat_name order by feat_name" ;
                                     }
	              		     $classfeat_check = "Y";
                                     if ($class2_tp != "Fighter" and $class1_tp != "Magus"){
        	                        $$feat_autov = "Y";
                                     }
             		       }else{
                                      $select = "SELECT feat_name, feat_desc FROM feats2 " .
        		               "where feat_psionic = 'Y' and mon_key_1 = '$key_1' " .
           		            "order by feat_name" ;
                               }
                            }else{
                                 if ($count3 == 4){
                                    if ($class3_psi != "Y"){
                                        if ($class3_tp == "Sorcerer"){
                                           $class_type = $domain_31;
                                        }else{
                                            $class_type = $class3_tp;
                                        }
	             	               $select = "SELECT feat_name, feat_desc, MIN(classfeat_level) as classfeat_level, MAX(classfeat_del_feat) as classfeat_del_feat
                                               FROM feats2, classfeats2
	              		                 where classfeat_class = '$class_type' and classfeat_level <= '$class3_level' and feat_name = classfeat_feat
                                                 and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'
	              		                 group by feat_name order by feat_name " ;
	              		          $classfeat_check = "Y";
	              		    //   if ($wp_user == "admin"){
                                    //      echo $select;
                                    //   }
	              		       if ($class3_tp != "Fighter"){
          			          $$feat_autov = "Y";
	              		       }
	              		    }else{
                                        $select = "SELECT feat_name, feat_desc FROM feats2 " .
	               		         "where feat_psionic = 'Y' and mon_key_1 = '$key_1' " .
	             		         "order by feat_name" ;
                                    }
	              		 }else{
                                     if ($count3 == 3){
	              	                 $$feat_autov = "";
                                         if ($class1_psi != "Y" and $class2_psi != "Y" and $class3_psi != "Y"){
	              	    	            $select = "SELECT feat_name, feat_desc FROM feats2 where (feat_psionic <> 'Y' or feat_psionic is NULL) " .
              	                                " and (feat_char_spec <> '$epic' or feat_char_spec is NULL) and  (feat_char_spec is null or " .
	              	                        "feat_char_spec = '' or feat_char_spec = ' ' or feat_char_spec = '$class1_tp'" .
                                                 " or feat_char_spec = '$class2_tp' or feat_char_spec is NULL ) " .
                                                 " and  mon_key_1 = '$key_1' order by feat_name" ;
                                                 $classfeat_check = "Y";
                        //                           echo $select;
	            	                 }else{
	              	                     $select = "SELECT feat_name, feat_desc FROM feats2  where mon_key_1 = '$key_1' " .
                                               "and (feat_char_spec = '' or feat_char_spec = ' ' or feat_char_spec = '$class1_tp'" .
                                               " or feat_char_spec = '$class2_tp' or feat_char_spec is NULL ) " .
                                               " order by feat_name" ;
                                         }
                                     }else{
                                        if ($count3 == 5){
                                           $select = "";
                                 //          echo  "add_feat_class1 " . $add_feat_class1 ;
                                           if ($add_feat_class11 != ""){
                                               $select = "SELECT feat_name, feat_desc, classfeat_level FROM feats2, classfeats2 " .
	                                      "where (classfeat_class = '$add_feat_class11' ) and classfeat_level <= $class1_level and feat_name = classfeat_feat ".
	             	                      " and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'" . "order by feat_name" ;
	             	                      $classfeat_check = "Y";
	             	     //                 echo $select;
                                           }
                                        }else{
                                          if ($count3 == 6){
                                             $select = "";
                                             if ($add_feat_class12 != ""){
                                               $select = "SELECT feat_name, feat_desc, classfeat_level FROM feats2, classfeats2 " .
	                                      "where (classfeat_class = '$add_feat_class12' ) and classfeat_level <= '$class1_level' and feat_name = classfeat_feat ".
	             	                      " and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'" . "order by feat_name" ;
	             	                      $classfeat_check = "Y";
                                           }
                                          }else{
                                             if ($count3 == 7){
                                                $select = "";
                                                if ($add_feat_class21 != ""){
                                                  $select = "SELECT feat_name, feat_desc, classfeat_level  FROM feats2, classfeats2 " .
	                                          "where (classfeat_class = '$add_feat_class21' ) and classfeat_level <= '$class2_level' and feat_name = classfeat_feat ".
	             	                          " and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'" . "order by feat_name" ;
	             	                          $classfeat_check = "Y";
                                                }
                                             }else{
                                                if ($count3 == 8){
                                                   $select = "";
                                                  if ($add_feat_class22 != ""){
                                                    $select = "SELECT feat_name, feat_desc, classfeat_level  FROM feats2, classfeats2 " .
	                                            "where (classfeat_class = '$add_feat_class22' ) and classfeat_level <= '$class2_level' and feat_name = classfeat_feat ".
	             	                            " and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'" . "order by feat_name" ;
	             	                            $classfeat_check = "Y";
       	                                          }
                                                 }else{
                                                   if ($count3 == 9){
                                                      $select = "";
                                                      if ($add_feat_class31 != ""){
                                                        $select = "SELECT feat_name, feat_desc, classfeat_level  FROM feats2, classfeats2 " .
	                                                "where (classfeat_class = '$add_feat_class31' ) and classfeat_level <= '$class3_level' and feat_name = classfeat_feat ".
	             	                               " and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'" . "order by feat_name" ;
	             	                                $classfeat_check = "Y";
       	                                              }
                                                  }else{
                                                      if ($count3 == 10){
                                                        $select = "";
                                                        if ($add_feat_class32 != ""){
                                                          $select = "SELECT feat_name, feat_desc, classfeat_level  FROM feats2, classfeats2 " .
	                                                  "where (classfeat_class = '$add_feat_class32' ) and classfeat_level <= '$class3_level' and feat_name = classfeat_feat ".
	             	                                 " and  feats2.mon_key_1 = classfeats2.mon_key_1 and feats2.mon_key_1 = '$key_1'" . "order by feat_name" ;
	             	                                  $classfeat_check = "Y";
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
	                }
//    echo "</BR>$select";
                        if ($select != ""){
      //                   echo "</BR> $count3   $select";
		 	  $result = mysqli_query($link, $select) ;

//  echo "result " . $result;
//          16/11/2011 check for lower case as updated datsbases
                          $featv_l = strtolower($$featv);
                       //          echo "featv_l = $featv_l";
		 	   While ($row = mysqli_fetch_array($result)) {
			      $feat_sel = $row['feat_name'] ;
			      $feat_desc = $row['feat_desc'] ;
			      if (isset($row['classfeat_del_feat'])){
                                 $classfeat_del_feat = $row['classfeat_del_feat'];
                              }else{
                                 $classfeat_del_feat = "";
                              }
                   //            if ($count3 == 1){
                    //              echo "</BR>" . $feat_sel . " " . $classfeat_del_feat;
                     //          }
			      if ($classfeat_check == "Y" and isset($row['classfeat_level'])){
                                 $classfeat_level = $row['classfeat_level'];
                              }else{
                                 $classfeat_level = "";
                              }
			      $feat_sel_l = strtolower($feat_sel);
			      if ($feat_sel_l == $featv_l) {
			          $sel = "SELECTED" ;
			      }else{
			   	  $sel = "" ;
			      }
			      $color = "validOption";
			      $help_ok = "Y";
			      if ($count3 == 3 or ($count3 == 1 and ($class1_tp =="Fighter" or $class1_tp =="Magus"))
			  	  or ($count3 == 2 and ($class2_tp =="Fighter" or $class2_tp == "Magus"  ))) {

				  $text = check_feat($feat_sel);
				  if ($text != ""){
			    	      $color = "invalidOption";
				  }
			      }
			      $feat_sel_desc = $feat_sel;
			      if ($classfeat_level != "" and $classfeat_level !=1){
                                 $feat_sel_desc .= " (Level $classfeat_level)";
                              }
                              if ($classfeat_del_feat == "Y"){
                                 $help_ok = "N";
                              }
                              if ($help_ok != "N"){
			        $featsHTML[ $count3 ] .= '<OPTION class="'.$color.'" VALUE="'.$feat_sel.'" '.$sel.' >'.$feat_sel_desc.'</OPTION>';
                              }
                          }
			  $featsHTML[ $count3 ] .= "</SELECT>";
		      }
		    }
		   $feat_auto = $$feat_autov;
		   $featsHTML[ $count3 ] .= '<INPUT TYPE="hidden" NAME="'.$feat_autov.'" VALUE="'.$feat_auto.'" />';
	       }
            }
	    $featsHTML[ $count3 ] .= "</p></li>";
//	    if ($wp_user == "admin"){
//               echo "</BR>add2 = $add2 max feats = $max_feats count1 = $count1 count2 = $count2 null_feat $null_feat </BR> ";
//            }
        }
}
mysqli_close($link);

$featErrorsHTML = "";
if ($null_feat > 0){
   $errortxt .= "$null_feat Feat(s) have not been allocated, Select the feats from the list and press recalculate when done </BR>";
}
if ($errortxt !=""){
   $featErrorsHTML = $errortxt;
}


// Feat Help
//include 'includes/dd_db_conn.txt' ;
$link = getDBLink();
$featHelpHTML  = "";
if ($class1_psi == "Y" or $class2_psi == "Y"){
   $select = "SELECT feat_name, feat_desc FROM feats2  where mon_key_1 = '$key_1' order by feat_name" ;
}else{
//   $select = "SELECT feat_name, feat_desc FROM feats2 where mon_key_1 = '$key_1' and " .
//             " (feat_psionic != 'Y' or feat_psionic is NULL)  order by feat_name" ;
   $select = "SELECT feat_name, feat_desc FROM feats2 where (feat_psionic <> 'Y' or feat_psionic is NULL) " .
	              	    		           " and (feat_char_spec <> '$epic' ) and  (feat_char_spec is null or " .
	              	    		           "feat_char_spec = '' or feat_char_spec = ' ' or feat_char_spec = '$class1_tp' or feat_char_spec = '$class3_tp' " .
                                                   " or feat_char_spec = '$class2_tp' or feat_char_spec is NULL ) " .
                                                    " and  mon_key_1 = '$key_1' order by feat_name" ;
}

$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)) {
    $feat_sel = $row['feat_name'] ;
    $feat_desc = $row['feat_desc'];
    $help_ok = "";
    $error  = check_feat($feat_sel);
    if ($help_ok ==""){
        if ($feat_sel == $feathelp) {
            $sel = " SELECTED" ;
        } else {
           $sel = "" ;
        }
        $featHelpHTML .= '<OPTION VALUE="'.$feat_sel.'" '.$sel.' >'.$feat_sel. ' </OPTION>';
    }
}


// insert 0 skill ranks for any magic item skills they have
$select = "select magic_skill, magict_no, skill_atr, skill_armour_ch from magictemp, skills where magic_spec = 'SKILL' and magic_skill = skill_cd and " .
           "magict_user = '$user'";
//echo $select;
$result = mysqli_query($link, $select) ;
$count = 0;
while ($row = mysqli_fetch_array($result)) {
   $skill = $row['magic_skill'];
   $skill_atr = $row['skill_atr'];
   //  if disable device change attribute to dex for pathfinder
    if ($skill == "Disable Device"){
       $skill_atr = "DEX";
    }
   $armour_ch = $row['skill_armour_ch'];
   $magict_no = $row['magict_no'];
   $skill_atr_bonus_v = "mon_" . strtolower($skill_atr) . "_bonus";
   $bonus = $$skill_atr_bonus_v;
   if ($skill != "test"){
     $insert = "insert into skilltemp (skillt_user, skillt_skill, skillt_rank, skillt_atr, skillt_atr_bonus, skillt_xskill, skillt_armour_ch, skillt_untrained) " .
             "VALUES ('$user', '$skill', '0', '$skill_atr', '$bonus', 'Y', '$armour_ch', 'Y')";
//   echo $insert;
     $result2 = mysqli_query($link, $insert) ;
   }
}



// insert 0 skill ranks for any feat skills they have
$select = "select featattr_no, featattr_type, feattemp_auto ,featattr_feat,featattr_id from featattr2, feattemp " .
               "where  feattemp_user = '$user' and featattr_type = 'SKILL' and ".
                " feattemp_feat = featattr_feat  and mon_key_1 = '$key_1'";
//echo $select;
$result = mysqli_query($link, $select) ;
$count = 0;
while ($row = mysqli_fetch_array($result)) {

   $skill = $row['featattr_id'];
//   echo $skill;
   $select2 = "select  skill_atr, skill_armour_ch, skill_untrained from skills where skill_cd = '$skill'";
   $result2 = mysqli_query($link, $select2) ;
   $row2 = mysqli_fetch_array($result2) ;
   $skill_atr = $row2['skill_atr'];
   //  if disable device change attribute to dex for pathfinder
    if ($skill == "Disable Device"){
       $skill_atr = "DEX";
    }
   $armour_ch = $row2['skill_armour_ch'];
   $magict_no = $row['featattr_no'];
   $skill_untrained = $row2['skill_untrained'];
   $skill_atr_bonus_v = "mon_" . strtolower($skill_atr) . "_bonus";
   $bonus = $$skill_atr_bonus_v;
// test is +1 to all skills (Luck Stone)
   if ($skill != "test"){
     $insert = "insert into skilltemp (skillt_user, skillt_skill, skillt_rank, skillt_atr, skillt_atr_bonus, skillt_xskill, skillt_armour_ch, skillt_untrained) " .
             "VALUES ('$user', '$skill', '0', '$skill_atr', '$bonus', 'Y', '$armour_ch','$skill_untrained')";
//   echo $insert;
     $result2 = mysqli_query($link, $insert) ;
   }
}





// Skills table
//echo "skill changes old " . $skill_changed_old;
//if ($skill_left_flag != "Y" and $skill2_left > 0){
//    $skill_spent += $skill2_left;
//    $skill_left_flag = "Y";
//}
if ($diff_skill_points != 0 and ($skill_changed_old == "Y" or $skill2_left > 0)){
   if ($skill_changed_old == "Y"){
       $skill_spent += $diff_skill_points;
   }else{
        $skill_spent += $skill2_left;
        $skill_changed = "Y";
   }
}
if ($skill_spent > 0){
   $skillErrorsHTML = "Skill points have not been spent";
}
if ($skill_spent < 0){
   $skillErrorsHTML = "Too many skill points have been spent";
}
$print_skill ="";
$htmlp_skill ="";
if ($armour_jump > 0){
//  echo "armour_jump " . $armour_jump;
  $x = addjumpskillrb ($armour_jump);
}
//include 'includes/dd_db_conn.txt' ;
$link = getDBLink();
$skillsHTML = "";
$select = "SELECT  skillt_user , skillt_skill , skillt_rank , skillt_atr, skillt_atr_bonus, ".
                 "skillt_misc_bonus , skillt_xskill, skillt_armour_ch, skillt_untrained from skilltemp where skillt_user = '$user'";
$resultSkill = mysqli_query($link, $select) ;
$count = 0;
while ($row = mysqli_fetch_array($resultSkill)) {
    $count = $count + 1;
    $skillv = "skill_" . $count;
    $$skillv = $row['skillt_skill'] ;
    $skill = $$skillv ;
    $rankv = "skillrank_" . $count;
    $$rankv = $row['skillt_rank'] ;
    $rank = $$rankv ;
    $atr  = $row['skillt_atr'];
    $armour_ch = $row['skillt_armour_ch'];
    $xskillv = "skillxskill_" . $count;
    $$xskillv = $row['skillt_xskill'];
    $xskill = $$xskillv;
    $skill_untrained = $row['skillt_untrained'];
    $skilln = $skill;
    $skilln = str_replace(" ","_", $skilln);
    $skilln = str_replace("+","_",$skilln);
    $skilln = str_replace("'","_",$skilln);
    $skilln = str_replace("&","_",$skilln);
    $old_skilln = $skilln . "_old";
    if (isset($$skilln)){
    }else{
        $$skilln = "";
    }
    if ($$skilln == "" or ($skill_changed_old != "Y" and $diff_skill_points != 0)){
     	$$skilln = $rank;
    }else{
       if ($rank != $$skilln){
          $skill_changed = "Y";
       }
       $rank = $$skilln;
    }
// add 3 to skill if class skill

    $select2 = "select featattr_no from featattr2, feattemp where ".
                        "feattemp_user = '$user' and featattr_type = 'SKILL' and ".
                        "featattr_id = '$skill' and featattr_feat = feattemp_feat and mon_key_1 = '$key_1'";
//    if ($wp_user == "admin"){
//      echo "</BR> $select2 </BR>";
//   }
    $result2 = mysqli_query($link, $select2) ;
    $misc_bonusv = "skillmiscbon_" . $count;
    $$misc_bonusv = 0;
    if ($xskill != "Y" and $rank > 0){
       $$misc_bonusv = $$misc_bonusv + 3;
//       echo    $$misc_bonusv;
    }
    if ($result2){
       while ($row2 = mysqli_fetch_array($result2)){
          $add = $row2['featattr_no'];
//          echo $add;
          if ($add == "STR" or $add =="INT" or $add == "CON" or $add == "WIS" or $add == "DEX" or $add == "CHR"){
            $add_v = "mon_" . strtolower($add) . "_bonus";
//            echo $add_v . " " . $$add_v;
            $$misc_bonusv = $$misc_bonusv + $$add_v;
            $add = 0;
          }else{
             $$misc_bonusv = $$misc_bonusv + $add;
// if >= 10 ranks then double bonus if feat is +2 or +3
//
             if (($add == 2 or $add ==3)  and $rank > 9){
                $$misc_bonusv = $$misc_bonusv + $add;
             }
          }
   //       if ($wp_user == "admin"){
   //         echo "</BR> Bonus " . $add;
   //       }
       }
    }
    $misc_bonus = $$misc_bonusv;
    $select3 = "select specattr_no, specw_class, specw_spec, specw_level from specattr, specw where ".
                       "specattr_type = 'SKILL' and ".
                       "specattr_id = '$skill' and specattr_spec = specw_spec and specw_user = '$user'";
//     echo $select3 . "</BR>";
    $result3 = mysqli_query($link, $select3) ;
    $misc_bonusv = "skillmiscbon_" . $count;
    $$misc_bonusv = 0;
    if ($result3){
       while ($row3 = mysqli_fetch_array($result3)){
          $spec = $row2['specw_spec'];
          $add = $row3['specattr_no'];
          $class = $row3['specw_class'];
          $level = $row3['specw_level'];
          $add = checkno($add, $class);
          $$misc_bonusv = $$misc_bonusv + $add;

    //      if ($wp_user == "admin"){
  //          echo "</BR> $skill class Bonus " . $$misc_bonusv;
    //      }
       }
    }

   $misc_bonus = $misc_bonus + $$misc_bonusv;
//    echo "</BR>$skill " . $misc_bonus;
   $$misc_bonusv = 0;
// magic bonus
   $select5 = "select magict_no from magictemp where magict_user = '$user' and magic_spec = 'SKILL' and magic_skill = '$skill'";
   $result5 = mysqli_query($link, $select5) ;
   $magic_skill = 0;
   while ($row5 = mysqli_fetch_array($result5)){
      $magic_skill += $row5['magict_no'];
   }
   $misc_bonus += $magic_skill;
//   echo $misc_bonus;
//
// synergy bonus Not for pathfinder
//
    if ($key_1 == "dd35"){
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
 //        if ($wp_user == "admin"){
 //           echo "</BR> Skill syn $syn_bonus</BR>";
 //        }
      }
    }
    if ($skill == "Hide" or $skill == "Stealth"){
        $misc_bonus = $misc_bonus + $size_hide;
    }
     $select5 = "select skilltrb_val, skilltrb_text from skilltemprb where skilltrb_user = '$user' and skilltrb_skill = '$skill'";
 //   echo $select5;
    $result5 = mysqli_query($link, $select5) ;
    $skilltrb_val = "";
    $skilltrb_text = "";
    $skill_race_text_array = "";
    $skilltrb_val_array = "";
    $skilltrb_text_array = "";
    $skill_race_val_array = "";
    $skilltrb_val_array = array();
    $skilltrb_text_array = array();
    $skill_race_val_array = array();
//    $skill_race_text_array[] = array();
 //   $skilltrb_val_array = "";
 //   $skilltrb_text_array = "";

    $skill_race_desc_bonus = 0;
    $skill_race_val = 0;

    $skill_race_text = "";
    while ($row5 = mysqli_fetch_array($result5)){
      $skilltrb_val = $row5['skilltrb_val'];
      $skilltrb_text = trim($row5['skilltrb_text']);
      if ($skilltrb_text == ""){
         $misc_bonus += $skilltrb_val;
      }else{
         if ($skill_race_desc != ""){
            $skill_race_desc .= ", ";
         }
         $skill_race_desc .= "$skill +" . $skilltrb_val. " $skilltrb_text";
  //       echo $skill_race_desc;
         $skill_race_val = $skilltrb_val;
         $skill_race_val_array[] = $skilltrb_val;
         $skill_race_text = $skilltrb_text;
         $skill_race_text_array[] = $skilltrb_text;

      }
    }
// magic titem e.g. luckstone that effects all skills
    $misc_bonus += $magic_skill_all;
//
//
//
//  small animals can use there dex instead of strength for climbing
//    echo "here" . $mon_type . $mon_size;
    if ($skill == "Climb" and ($mon_type == "Animal" or $mon_type == "Vermin") and
       ($mon_size == "Small" or $mon_size == "Tiny" or $mon_size == "Diminutive" or $mon_size == "Fine" or $mon_str == 0)){
        if ($mon_dex > $mon_str){
           $atr = "dex";
        }
    }
    if ($skill == "Swim"  and
       ($mon_size == "Small" or $mon_size == "Tiny" or $mon_size == "Diminutive" or $mon_size == "Fine" or $mon_str == 0)){
        if ($mon_dex > $mon_str){
           $atr = "dex";
        }
    }

    if ($atr != ""){
       $atr_bonusv = "mon_" . strtolower($atr) ."_bonus" ;
       $atr_bonus = $$atr_bonusv;
    }else{
       $atr_bonus = 0;
    }
//
//
    $armour_bonus = 0;
//    echo "$skill feat_armch = " . $feat_armch;

    $magic_bonus = 0;

    if ($magic_shield > 0  and $shield_check != 0 ){
       $magic_bonus = +1;
    }


    if ($magic_armour > 0  and $armour_check != 0 ){
       $magic_bonus += 1;
    }
    if ($armour_ch == "Y"){
//      echo "shield_check $shield_check";
     //  echo "***  feat_acrobat $feat_acrobat armour_cd $armour_cd";
       if ($feat_acrobat == "Y" and  $armour_cd_check <= 1){
          if ($armour_cd ==  0 and ($skill == "Acrobatics" or $skill == "Fly")){
              $armour_bonus = $shield_check ;
              $misc_bonus = $misc_bonus + 2;
     //         echo "misc bonus = $misc_bonus</BR>";
          }else{
              $armour_bonus = $shield_check ;
          }
       }else{
          $armour_bonus = $armour_check + $shield_check + $magic_bonus + $feat_armch;
       }
       if ($skill == "Climb"){
          $armour_bonus += $armour_climb;
       }   
    }
    if ($armour_ch == "2"){
       $armour_bonus = ($armour_check + $shield_check + $magic_bonus + $feat_armch) * 2;
    }
    if ($armour_bonus > 0){
       $armour_bonus = 0;
    }
 //   echo "$skill misc = $misc_bonus armour bonus = " . $armour_bonus;
    $misc_bonus = $misc_bonus + $armour_bonus;

    $mod = $rank + $atr_bonus + $misc_bonus;

	if ( $count /2 == round($count / 2) ) {
		$skillsHTML .= '<TR class="evenRow">';
		$skillsHTML2 .= '<TR class="evenRow">';
	} else {
		$skillsHTML .= '<TR class="oddRow">';
		$skillsHTML2 .= '<TR class="oddRow">';
	}
	$skillsHTML .= '<TD class="skillName">'.$skill.'</TD>';
	$skillsHTML .= '<TD class="skillTotal">'.$mod.'</Td>';
	$skillsHTML .= '<TD class="skillRank">';
	$skillsHTML2 .= '<TD class="skillName">' .$skill.'</TD>';
	$skillsHTML2 .= '<TD class="skillTotal">'.$mod.'</Td>';
	$skillsHTML2 .= '<TD class="skillRank">';
	if ( $rank == 0 ) {
		$skillsHTML .= "-";
	} else {
		$skillsHTML .= $rank;
	}
	$skillsHTML .= '</TD>';

// OLD CODE CT - 13/6/18
//        echo "\n<script>\n";
//        echo "var $old_skilln = $rank \n";
//        echo "\n</script>\n";

/* New - CT */
		/* Capture dynmically generated JS*/
		ob_start();
		echo "\n/* pathdisNPC */\n";
		echo "var $old_skilln = $rank; \n";
		$dynamicJS = ob_get_clean();
		$resultJS = 	wp_add_inline_script( 'dgJS', $dynamicJS);			/* add it to static JS loaded via the functions.php */
	
		if ( ! $resultJS ) {
			error_log("Dynamic JS failed to load in pathdisNPC.php");	
			die;
		}
/* New - CT - END */


        $skillsHTML2 .= "<SELECT class='width4em' NAME='$skilln'  onchange="
            . '"calcskill(this,'
            . "$old_skilln, "
            . "'$old_skilln"

            . "','"
            ."')"
            . '"'
            . '>\n';
	$skillsHTML2 .= skill_rank($rank);
	$skillsHTML2 .= "</TD>";
	$skillsHTML .= '<TD class="skillStatBonus">';
	$skillsHTML2 .= '<TD class="skillStatBonus">';
	if ( $atr_bonus == 0 ) {
		$skillsHTML .= "-";
		$skillsHTML2 .= "-";
	} else {
		$skillsHTML .= $atr_bonus;
		$skillsHTML2 .= $atr_bonus;
	}
	$skillsHTML .= '</TD>';
	$skillsHTML .= '<TD class="skillMiscBonus">';
	$skillsHTML2 .= '</TD>';
	$skillsHTML2 .= '<TD class="skillMiscBonus">';
	if ( $misc_bonus == 0 ) {
		$skillsHTML .= "-";
		$skillsHTML2 .= "-";
	} else {
		$skillsHTML .= $misc_bonus;
		$skillsHTML2 .= $misc_bonus;
	}
	$skillsHTML .= '</TD>';
	$skillsHTML .= '</TR>';
	$skillsHTML2 .= '</TD>';
	$skillsHTML2 .= '</TR>';
	if ($rank > -1 or $skill_untrained != "N"){
	   if ($htmlp_skill != ""){
              $htmlp_skill .=", ";
              $print_skill .=", ";
           }
           $print_skill .= $skill . " " . $mod ;
	   $htmlp_skill .= $skill . " " . $mod ;
	   $skill_array_count = 0;
//	   if ($wp_user == "admin"){
//                echo $skill;
//                print_r ($skill_race_text_array);
//                print_r ($skill_race_val_array);
//           }
	   if ($skill_race_text != ""){
              foreach ($skill_race_text_array as $skill_race_text){
                $skill_race_val = $skill_race_val_array[$skill_array_count];
                $skill_array_count += 1;
                $mod_x = $mod + $skill_race_val;

                $print_skill .= "($skill $skill_race_text $mod_x)" ;
	        $htmlp_skill .= "($skill $skill_race_text $mod_x)" ;
              }
           }
	   if ($skill == "Perception"){
                $print_sen .= "; " . $skill . " +" . $mod ;
           }
       }
}
if ($skill_changed == "Y"){
   $skill_changed_old = $skill_changed;
}
//skills window
$skill_no = "skill_1";
if ($$skill_no == " "){
   $$skill_no = "";
}

$rank  = 0;
$skillsHTML3 = "<TR>\n";
$skillsHTML3 .= "<TD class='skillName'> <SELECT  NAME='$skill_no'>";
$select = "select skill_cd from skills where skill_path = 'Y' order by skill_cd";
$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)){
    $skill = $row['skill_cd'];
    $skill_d = $skill;
    if ($skill == ""){
       $sel =  " SELECTED ";
       $skill_d = "Add a Skill";
    }else{
       $sel = "";
    }
    $select3 = "select count(*) from skilltemp  where skillt_user = '$user' and skillt_skill = '$skill'";
    $result3 = mysqli_query($link, $select3) ;
    $already_found = 0;
    if ($result3){
       $row3 = mysqli_fetch_array($result3);
        $already_found = $row3[0];
//        echo $skill . $prim;
    }
    if ($already_found < 1){
       $select2 = "select count(*) from montpskill where montype = '$mon_type' and skill_cd = '$skill'";
//    echo $select2 . "</br>";
       $result2 = mysqli_query($link, $select2) ;
       $prim_desc = "";
       $prim_count = 0;
       $bold = "";
       $ebold = "";
       if ($result2){
          $row2 = mysqli_fetch_array($result2);
          $prim_count = $row2[0];
//        echo $skill . $prim;
       }
       if ($prim_count > 0 ){
         $prim_desc =" (class)";
//      $ebold = "</b>";
//      echo $skill . $prim;

       }
       $skillsHTML3 .=  "<OPTION VALUE = '$skill' $sel > $skill_d . $prim_desc </OPTION>";
   }
}
$mod = 0;
$skillsHTML3 .= '</SELECT></TD>';
$skillsHTML3 .= '<TD class="skillTotal">'.$mod.'</TD>';
$skillsHTML3 .= '<TD class="skillRank">';
$skilln = "skill_1_rank";
$old_skilln = "skill_1_rank_old";

// OLD CODE CT - 13/6/18
//echo "\n<script>\n";
//echo "var $old_skilln = $rank \n";
//echo "\n</script>\n";

/* New - CT */
		/* Capture dynmically generated JS*/
		ob_start();
		echo "\n/* pathdisNPC */\n";
		echo "var $old_skilln = $rank; \n";
		$dynamicJS = ob_get_clean();
		$resultJS = 	wp_add_inline_script( 'dgJS', $dynamicJS);			/* add it to static JS loaded via the functions.php */
	
		if ( ! $resultJS ) {
			error_log("Dynamic JS failed to load in pathdisNPC.php");	
			die;
		}
/* New - CT - END */


$skillsHTML3 .= "<SELECT class='width4em' NAME='$skilln'  onchange="
            . '"calcskill(this,'
            . "$old_skilln, "
            . "'$old_skilln"
            . "','')"
            . '">';

$skillsHTML3 .= skill_rank($rank);
$skillsHTML3 .= "</TD>";
$skillsHTML3 .= "</TR>\n";

//Psionics
// $psi_points = 0;
if ($class1_psi == "Y"){
   psi_points(1);
}
if ($class2_psi == "Y"){
   psi_points(2);
}
$psi_pts = $class1_psi_pts + $class2_psi_pts + $class3_psi_pts + $psi_points + $feat_psi_points;
//echo "psi points = " . $psi_pts;
$psi_cmb = $class1_psi_cmb + $class2_psi_cmb;
$psi_cmb_HTML = "";


// SPELLS
$spellsOneHTML = "";
$spellsTwoHTML = "";
$print_spell = "";
$htmlp_spell = "";
if ($class1_spat != "" or $class1_psi == "Y"){
  if ($class1_psi != "Y" ){
   $stat_v = "mon_" . strtolower($class1_spat);
   $stat1_bonus_v =   "mon_" . strtolower($class1_spat) . "_bonus";
   $stat1_bonus = $$stat1_bonus_v;
   $stat   = $$stat_v;
   $stat_b = magicstat($class1_spat);
   $stat += $stat_b;
   $stat1 = $stat;
 //  echo "stat1 " . $stat1;
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
 //       echo  "</BR> spell $class_spell";
         if ($class_spell != ""){
//            echo $abil_v .  $row[$abil_v];
            if  ($class1_tp != "Inquisitor"){
               $$class_spell_v =  $$class_spell_v  + $row[$abil_v];
            }else{
               $$class_spell_v =  $$class_spell_v;
            }
         }
         $count = $count + 1;
      }
     }
   }
   $cons1 = $stat1_bonus + $class1_level;

   $spellsOneHTML .= '<TR class="oddRow">';
   $spellsOneHTML .= '<TD>'.$class1_tp. '</TD>';

   if ($class1_psi == "Y"){
          $spellsOneHTML .=  "<TD>Psionic Points $psi_pts</TD>";
   }else{
   $count = 0;
   $print_spell = "\n" . $class1_tp;
   $htmlp_spell = "</BR>" . $class1_tp;
   $max1_level = $stat1 - 10;
   while ($count < 10){
     $spell_v = "class1_spell" . $count;
     $spell = trim($$spell_v);
     $spellsOneHTML .=  "<TD>$spell</TD>";
     $dc = 10 + $count + $stat1_bonus;
     if ($spell != ""){
         $print_spell .= "\n" . "level " . $count . " (" . $spell . ")  (DC " . $dc . ")";
         $htmlp_spell .= "</BR>" . "level " . $count . " (" . $spell . ")  (DC " . $dc . ")";
         if ($max1_level < $count and $class1_psi != "Y"){
           $print_spell .= " * needs  ". $class1_spat . " of " . (10 + $count) . " to cast *";
           $htmlp_spell .= " * needs  ". $class1_spat . " of " . (10 + $count) . " to cast *";
         }
     }
     $count = $count + 1;
   }
   }
   $spellsOneHTML .= '</TR>';

}
if ($class2_spat != ""  or $class2_psi == "Y"){
   $stat_v = "mon_" . strtolower($class2_spat);
   $stat   = $$stat_v;
   $stat_b = magicstat($class2_spat);
   $stat += $stat_b;
   $stat2 = $stat;
   $stat2_bonus_v =   "mon_" . strtolower($class2_spat) . "_bonus";
   $stat2_bonus = $$stat2_bonus_v;
   $select = "select abil_0l,abil_1l,abil_2l,abil_3l,abil_4l,abil_5l,abil_6l,abil_7l,abil_8l,abil_9l ".
             "from abilities where abil_score = $stat";
   $result = mysqli_query($link, $select) ;
   if ($result){
      $row = mysqli_fetch_array($result);
      $count = 0;
      $print_spell .=   "\n" . $class2_tp;
      $htmlp_spell .=   "</BR>" . $class2_tp;
      while ($count < 10){
         $class_spell_v = "class2_spell" . $count;
         $abil_v = "abil_" . $count . "l";
         $class_spell = trim($$class_spell_v);
//         echo  "</BR> spell $class_spell";

         if ($class_spell != ""){
           if  ($class2_tp != "Inquisitor"){
               $$class_spell_v =  $$class_spell_v  + $row[$abil_v];
           }else{
              $$class_spell_v =  $$class_spell_v;
           }
         }
         $count = $count + 1;
      }

   }
   $spellsTwoHTML .= '<TR class="evenRow">';
   $cons2 = $stat2_bonus + $class2_level;
   $spellsTwoHTML .= '<TD>'.$class2_tp . '</TD>';

   $count = 0;
   $max2_level = $stat2 - 10;
   while ($count < 10){
     $spell_v = "class2_spell" . $count;
     $spell = $$spell_v;
     $spellsTwoHTML .=  "<TD>$spell</TD>";
     if ($spell != ""){
       $dc = 10 + $count + $stat2_bonus;
       $print_spell .= "\n" . "level " . $count . " (" . $spell . ")  (DC ". $dc . ")";
       $htmlp_spell .= "</BR>" . "level " . $count . " (" . $spell . ")  (DC ". $dc . ")";
       if ($max2_level < $count){
           $print_spell .= " * needs  ". $class2_spat . " of " . (10 + $count) . " to cast *";
           $htmlp_spell .= " * needs  ". $class2_spat . " of " . (10 + $count) . " to cast *";
       }
     }
     $count = $count + 1;
   }
   $spellsTwoHTML .= '</TR>';

}
//echo "going $class3_spat"  ;
if (($class3_spat != "" or $class3_psi == "Y") and $class3_prest_spells == "SPE"){
//   echo "here";
   $stat_v = "mon_" . strtolower($class3_spat);
   $stat   = $$stat_v;
   $stat_b = magicstat($class3_spat);
   $stat += $stat_b;
   $stat3 = $stat;
   $stat3_bonus_v =   "mon_" . strtolower($class3_spat) . "_bonus";
   $stat3_bonus = $$stat3_bonus_v;
   $select = "select abil_0l,abil_1l,abil_2l,abil_3l,abil_4l,abil_5l,abil_6l,abil_7l,abil_8l,abil_9l ".
             "from abilities where abil_score = $stat";
   $result = mysqli_query($link, $select) ;
   if ($result){
      $row = mysqli_fetch_array($result);
      $count = 0;
      $print_spell .=   "\n" . $class3_tp;
      $htmlp_spell .=   "</BR>" . $class3_tp;
      while ($count < 10){
         $class_spell_v = "class3_spell" . $count;
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
   $spellsThreeHTML .= '<TR class="evenRow">';
   $spellsThreeHTML .= '<TD>'.$class3_tp.'</TD>';

   $count = 0;
   $max3_level = $stat3 - 10;
   while ($count < 10){
     $spell_v = "class3_spell" . $count;
     $spell = $$spell_v;
     $spellsThreeHTML .=  "<TD>$spell</TD>";
     if ($spell != ""){
       $dc = 10 + $count + $stat3_bonus;
       $print_spell .= "\n" . "level " . $count . " (" . $spell . ")  (DC ". $dc . ")";
       $htmlp_spell .= "</BR>" . "level " . $count . " (" . $spell . ")  (DC ". $dc . ")";
       if ($max3_level < $count){
           $print_spell .= " * needs  ". $class3_spat . " of " . (10 + $count) . " to cast *";
           $htmlp_spell .= " * needs  ". $class3_spat . " of " . (10 + $count) . " to cast *";
       }
     }
     $count = $count + 1;
   }
   $spellsThreeHTML .= '</TR>';

}
//$x = monsterSpells();
//
//echo "classm_spat = $classm_spat" ;
if ($classm_spat != "" and ($zombie_tem !== 0 or $mon_int > 0)){
   $stat_v = "mon_" . strtolower($classm_spat);
   $stat   = $$stat_v;
   $stat_b = magicstat($classm_spat);
   $stat += $stat_b;
   $statm = $stat;
   $statm_bonus_v =   "mon_" . strtolower($classm_spat) . "_bonus";
   $statm_bonus = $$statm_bonus_v;
   $select = "select abil_0l,abil_1l,abil_2l,abil_3l,abil_4l,abil_5l,abil_6l,abil_7l,abil_8l,abil_9l ".
             "from abilities where abil_score = $stat";
   $result = mysqli_query($link, $select) ;
   if ($result){
      $row = mysqli_fetch_array($result);
      $count = 0;
      $print_spell .=   "\n" . $classm_tp;
      $html_spell .=   "</BR>" . $classm_tp;
      while ($count < 10){
         $class_spell_v = "classm_spell" . $count;
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
   $spellsMonHTML .= '<TR class="evenRow">';
   $spellsMonHTML .= '<TD>'.$classm_tp.'</TD>';

   $count = 0;
   $max2_level = $stat2 - 10;
   while ($count < 10){
     $spell_v = "classm_spell" . $count;
     $spell = $$spell_v;
     $spellsMonHTML .=  "<TD>$spell</TD>";
     if ($spell != ""){
       $dc = 10 + $count + $statm_bonus;
       $print_spell .= "\n" . "level " . $count . " (" . $spell . ")  (DC ". $dc . ")";
       $htmlp_spell .= "</BR>" . "level " . $count . " (" . $spell . ")  (DC ". $dc . ")";
       if ($max2_level < $count){
           $print_spell .= " * needs  ". $classm_spat . " of " . (10 + $count) . " to cast *";
           $htmlp_spell .= " * needs  ". $classm_spat . " of " . (10 + $count) . " to cast *";
       }
     }
     $count = $count + 1;
   }
   $spellsMonHTML .= '</TR>';

}
$path2_html = "";
if ($path2 != ""){
  if ($class1_tp == "Psychic Warrior"){
     $domain_v = "domain_12";
     $domain_v2 = "domain12";
  }else{
     $domain_v = "domain_22";
     $domain_v2 = "domain22";
  }
//  echo $path2 . $domain_12;
  $path2_HTML .= "Second Path <SELECT NAME = '$domain_v'>";
  $select = "SELECT spellcl_id from spellcl where spellcl_domain = '$path2'";
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)) {
      $path2_sel  = $row['spellcl_id'];
      if ($path2_sel == $$domain_v){
         $sel = " SELECTED";
      }else{
         $sel = " ";
      }
        $path2_HTML .= '<OPTION VALUE="'.$path2_sel.'" '.$sel.' >'.$path2_sel.'</OPTION>';
  }
     $path2_HTML .= "</SELECT>";
}
// Class Specials
$classSpecialsOneHTML = "";
$classSpecialsTwoHTML = "";
$classSpecialsThreeTML = "";
$classSpecialsMonHTML = "";
$print_class_special = "";
$htmlp_class_special = "";
//echo "sa1 " . $htmlp_special_attacks;
if ($class1_tp !="" or $class2_tp != "" or $class3_tp != ""){
  $select = "SELECT specw_spec, spec_desc, SUM(specw_no), spec_display  " .
             "FROM specw, specials " .
             "WHERE specw_spec = spec_name and specw_user = '$user' ".
             "group by specw_spec";
//  echo $select;
  $result = mysqli_query($link, $select) ;
  $print_class_special = "\n" . " Special Abilities ";
  $htmlp_class_special = "</BR><b>" . " Special Abilities </b>";
  while ($row = mysqli_fetch_array($result)) {
      $result2 = mysqli_query($link, $select2) ;
      $spec = $row[0];
      $no = $row[2];
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
      }else{
        $classSpecialsOneHTML .= '<TR class="oddRow">';
      }
      if ($spec_no =="0"){
         $spec_no = "";
      }
      $classSpecialsOneHTML .= '<TD class="classSpecialName">'.$spec.'</TD>';
      $classSpecialsOneHTML .= '<TD class="classSpecialDesc">'.$spec_desc.'</TD>';
      $classSpecialsOneHTML .= '<TD class="classSpecialValue">'.$spec_no.'</TD>';
      $classSpecialsOneHTML .= '</TR>';
      if ($spec_display == "A"){
         $print_special_attacks .= "\n" . $spec. " " . $spec_desc;
         $htmlp_special_attacks .= "<b>" .$spec. "</b> " . $spec_desc;
         if ($spec_no != ""){
             $print_special_attacks .=  " " . $spec_no;
             $htmlp_special_attacks .=  " " . $spec_no;
         }
         $htmlp_special_attacks .= "</BR>";
      }
          //      echo "sa" . $htmlp_special_attacks;
      if ($spec_display == "Q"){
         $print_special_qualities .= "\n" . $spec. " " . $spec_desc;
         if ($htmlp_special_qualities != ""){
             $print_special_qualities .= ", ";
             $htmlp_special_qualities .= "</BR>";

         }
         if ($htmlp_special_qualities_s != ""){
            $htmlp_special_qualities_s .= ", ";
         }
         $htmlp_special_qualities .=  "<b>$spec</b> $spec_desc";
         $htmlp_special_qualities_s .=  "$spec";
         if ($spec_no != 0){
             $print_special_qualities .= " " . $spec_no;
             $htmlp_special_qualities .= " " . $spec_no;
             $htmlp_special_qualities_s .= " " . $spec_no;
         }
      }
      $print_class_special .=  "\n" .$spec . " " . $spec_desc;

      if ($spec_no != 0){
         $print_class_special .= " " . $spec_no;
         $htmlp_class_special .= " " . $spec_no;
      }
  }

}
//
// spell class specials (Domain, Sorcerer blood line and wizard school)
//
/*
*/
// GET MAX treasure
$total_gp = "0";
//$total_spent = "0";
$cr_round  = round(($cr -0.49),0);
$select = "SELECT level_gp from level2 where lev_no = '$cr_round' and mon_key_1 = '$key_1'";
$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)) {
  $total_gp = $row['level_gp'];
}
//echo "total spent " . $total_spent;
if ($total_spent == ""){
  $total_spent = 0;
}
//echo "weapon " . $magic_WEAPON_1;

$select = "SELECT monlang_id from monlang2 where mon_name = '$mon_name' and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user')";
$result = mysqli_query($link, $select) ;
$count = 0;
while ($row = mysqli_fetch_array($result)) {
  $count +=1;
  $lang_r = "monlang" . $count;
  $$lang_r = $row['monlang_id'];
//    echo $lang_r . $$lang_r;
}
//echo "3" . $monlang3 . "4" .$monlang4;
$fighter_weapHTML = "";
if ($feat_weaptr != ""){
  $count = 0;
  while ($count < $feat_weaptr){
     $count += 1;
     $weap_tr_v = "weap_tr" . $count;
     if (isset($$weap_tr_v)){
     }else{
        $$weap_tr_v = "";
     }
     $fighter_weapHTML .= "<p>Weapon training - $count = <SELECT NAME = '$weap_tr_v'>";
     $select = "select weapgroup_id  from weapgroup order by weapgroup_id";
     $result = mysqli_query($link, $select) ;
     while ($row = mysqli_fetch_array($result)) {
        $weapgroup_sel  = $row['weapgroup_id'];
        if ($weapgroup_sel == $$weap_tr_v){
           $sel = " SELECTED";
        }else{
           $sel = " ";
        }
        $fighter_weapHTML .= '<OPTION VALUE="'.$weapgroup_sel.'" '.$sel.' >'.$weapgroup_sel.'</OPTION>';
     }
     $fighter_weapHTML .= "</SELECT></p>";
  }
}

$h = populateHelp();


// require_once ( "ddDisplayMonsterJS.php" );			/* Now loaded via functions.php */
// reset the level for animal companions
if ($new_animal_comp_level > 0){
    $class1_level = $old_animal_comp_level;
}
//echo $class1_level;

//echo "domain $domain_11 / $domain_12 / $domain_13 ";
//require_once ( "ddDisplayNPCForm.php" );
//echo '<script language="javascript">';
//        echo "var status = document.getElementById('status')";
//echo 'alert("calling dddisplayNPCForm")';
//echo '</script>';
require_once(locate_template('library/dddisplayNPCForm.php'));

?>
/* Redundent??? handled by theme ??? */
/*
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
*/