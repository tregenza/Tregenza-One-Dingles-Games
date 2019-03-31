<?PHP

//echo "in global";
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
   $class_no = 1;
   while ($class_no < 4){
      $class_spell_list_1_v = "class" . $class_no . "_spell_list_1";

      $class_spell_list_2_v = "class" . $class_no . "_spell_list_2";

      $class_spell_list_3_v = "class" . $class_no . "_spell_list_3";
      global $$class_spell_list_1_v, $$class_spell_list_2_v, $$class_spell_list_3_v ;
      $class_no +=1;
   }
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
  //      echo "<p>$magic_item_v</p>";
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
 $count = 1;
 $count2 = 1;
 while ($count < 40){
    while ($count2 < 4){
        $feat_v = "feat_" . $count2 . $count;
         $feat_auto_v = "feat_auto_" . $count2 . $count;
 //        echo "$feat_v $feat_auto_v";
        global $$feat_v, $$feat_auto_v;
        $count2 += 1;
    }
    $count2 = 1;
    $count +=1;
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
  global $mon_str, $mon_dex, $mon_int, $mon_con, $mon_chr, $mon_wis, $first_pass, $mon_ac_flat, $save_mon, $mon_ac;
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
   global $ac_desc, $ac_flat, $ac_touch, $base_attack, $base_grapple, $print_special_attacks, $print_special_qualities, $total_fort_sv, $total_will_sv, $total_reflex_sv;
   global $print_skill, $print_feat, $print_buff, $mon_alighment, $cr, $print_buff, $init, $speed_land, $mon_alignment, $savemon_name, $savemon_camp, $savemon_sub;

?>