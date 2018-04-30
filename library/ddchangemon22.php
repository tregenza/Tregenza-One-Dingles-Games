<?php
//session_start();
if (isset($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "";
}
if ($_POST['mon_name'] != ""){
   $mon_name     = $_POST['mon_name'];
  $select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed , mon_speed_fly, mon_speed_climb, mon_speed_swim, mon_speed_burrow, ".
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, montype_skillp, montype_att, montype_cr, mon_nochange, mon_template, mon_alignment, ".
                   "mon_environment, mon_level_adj, mon_magic_use, mon_delete, mon_ac_deflect, mon_skill_rule " .
                   "from monster2, montype where mon_name = '$mon_name' and mon_type = montype and mon_key_1 = '$wp_user'";
  if ($wp_user == "path"){
      $key_1 = "path";
  }else{
      $key_1 = "dd35";
  }
//  include 'includes/dd_db_conn.txt';
  $link = getDBLink();
  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
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
  $mon_nat_ac = $mon_ac_flat - 10;
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
  $mon_nochange = $row['mon_nochange'];
  $mon_template = $row['mon_template']; 
  $mon_alignment = $row['mon_alignment'];
  $mon_environment = $row['mon_environment'];
  $mon_level_adj = $row['mon_level_adj'];
  $mon_magic_use = $row['mon_magic_use'];
  $mon_delete = $row['mon_delete'];
  $mon_ac_deflect = $row['mon_ac_deflect'];
  $mon_skill_rule = $row['mon_skill_rule'];
  $mon_size_original = $mon_size;


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
  $mon_base_att_orig = $mon_base_att;
  $mon_ac_flat_orig = $mon_ac_flat;
  $mon_int_orig = $mon_int;
// Monster Feats
//  echo "</BR> " . $delete;
  $select = "select monfeat, monfeat_free from monfeat2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
//    echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    $mon_feats = 0;
    while ($row = mysqli_fetch_array($result)) {
      $mon_feats = $mon_feats + 1;
      $mon_feat_v = "mon_feat_" . $mon_feats;
      $$mon_feat_v = $row['monfeat'];
      $mon_feat_free_v = "mon_feat_free_" . $mon_feats;
      $$mon_feat_free_v = $row['monfeat_free'];
//      echo "</BR> feat" . $feat;
// echo "</BR> $insert";
    }
  }

// Monster Weapons
  $select = "select monweap_attp, monweap_wp, monweap_dam monweap_dam from " .
             "monweap2 where ".
             "monweap_mon = '$mon_name'  and mon_key_1 = '$wp_user'";
//  echo "</BR> " . $select. "/BR";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)) {
        $attp = strtolower($row['monweap_attp']);
        $mon_weap_v = "mon_weap_" . $attp ;
        $weap_dam_v = "dam_" . $attp ;
        $weap_dam2_v = "dam2_" . $attp ;
        $weap_type_v = "weap_type_" .$attp ;
        $weap_cat_v  = "weap_cat_" . $attp;
        $monweap_dam_v = "monweap_dam_" .$attp;
        $weap_dambase_no_v = "monweap_dambase_no_" . $attp;
        $weap_dambase_incr_v = "monweap_dambase_incr_" . $attp;
        $$mon_weap_v = $row['monweap_wp'];
        $$weap_dam_v = $row['monweap_dam'];
        $$monweap_dam_v = $row['monweap_dam'];
        $weap = $row['monweap_wp'];
//                echo "</BR> Weapon " . $mon_weap_v . $$mon_weap_v . $$weap_dam_v ."*** </BR>";
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
   //
 $select = "SELECT monskill_tp, monskill_val,skill_atr, skill_armour_ch from monskill2, skills WHERE mon_name = '$mon_name'  and mon_key_1 = '$wp_user' ".
             " AND monskill_tp = skill_cd" ;
//  echo "</BR> " . $select . "</BR>";
 $result = mysqli_query($link, $select) ;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $skill = $row['monskill_tp'];
    $rank  = $row['monskill_val'];
    $atr   = $row['skill_atr'];
    $armour_ch = $row['skill_armour_ch'];
    $skill_v = "monskill_tp_" . $count;
    $rank_v  = "monskill_val_" . $count;
    $$skill_v = $skill;
    $$rank_v = $rank;
 }
  $select = "SELECT monskillrb_tp, monskillrb_val, monskillrb_text, monskillrb_atr from monskillrb WHERE mon_name = '$mon_name'  and mon_key_1 = '$wp_user' ";
//  echo "</BR> " . $select . "</BR>";
 $result = mysqli_query($link, $select) ;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $skillrb = $row['monskillrb_tp'];
    $rankrb  = $row['monskillrb_val'];
    $textrb  = $row['monskillrb_text'];
    $atrrb  = $row['monskillrb_atr'];
    $skillrb_v = "monskillrb_tp_" . $count;
    $rankrb_v  = "monskillrb_val_" . $count;
    $textrb_v  = "monskillrb_text_" . $count;
    $atrrb_v  = "monskillrb_atr_" . $count;

    $$skillrb_v = $skillrb;
    $$rankrb_v = $rankrb;
    $$textrb_v = $textrb;
    $$atrrb_v = $textrb;
 }

 $select = "SELECT monspec_name, monspec_value, monspec_min, monspec_max from monspec2 where monspec_tp = 'A' and mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $spec_v = "speca_" . $count;
  $spec_value_v = "speca_value_" . $count;
  $$spec_v = $row['monspec_name'];
  $$spec_value_v = $row['monspec_value'];
  $spec_min_v = "speca_min_" . $count;
  $$spec_min_v = $row['monspec_min'];
  $spec_max_v = "speca_max_" . $count;
  $$spec_max_v = $row['monspec_max'];
 }
 $select = "SELECT monspec_name, monspec_value, monspec_min, monspec_max from monspec2 where monspec_tp = 'S' and mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $spec_v = "specq_" . $count;
  $spec_value_v = "specq_value_" . $count;
  $$spec_v = $row['monspec_name'];
  $$spec_value_v = $row['monspec_value'];
  $spec_min_v = "specq_min_" . $count;
  $$spec_min_v = $row['monspec_min'];
  $spec_max_v = "specq_max_" . $count;
  $$spec_max_v = $row['monspec_max'];
 }
// mon treasure
 $select = "SELECT mon_name, montreas_tp, montreas_mult from montreas2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $montreas_tp_v = "montreas_tp_" . $count;
  $montreas_mult_v = "montreas_mult_" . $count;
  $$montreas_tp_v = $row['montreas_tp'];
  $$montreas_mult_v = $row['montreas_mult'];
 }
 // mon Organization
 $select = "SELECT mon_name, monorg_id, monorg_min, monorg_max from monorg2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $monorg_v = "monorg_" . $count;
  $monorg_min_v = "monorg_min_" . $count;
  $monorg_max_v = "monorg_max_" . $count;
  $$monorg_v = $row['monorg_id'];
  $$monorg_min_v = $row['monorg_min'];
  $$monorg_max_v = $row['monorg_max'];
 }
// mon language
 $select = "SELECT mon_name, monlang_id from monlang2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $monlang_v = "monlang_" . $count;
  $$monlang_v = $row['monlang_id'];
 }
 

 $select = "SELECT mon_name, monadv_min_hd, monadv_max_hd, monadv_size from monadv2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $monadv_size_v = "monadv_size_" . $count;
  $monadv_min_v = "monadv_min_" . $count;
  $monadv_max_v = "monadv_max_" . $count;
  $$monadv_size_v = $row['monadv_size'];
  $$monadv_min_v = $row['monadv_min_hd'];
  $$monadv_max_v = $row['monadv_max_hd'];
 }




}else{
//   echo   '<P><A HREF="ddchangemon1.php">Select New Monster</A>';
}


?>




<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<?php
$link = getDBLink();
//include 'includes/dd_menu.txt' ;
?>
<h2>Change Monster</h2>
<?php
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = str_replace("\'", "", $v);
       $v = str_replace('\"', "", $v);
       $v = str_replace("'", "", $v);
       $v = str_replace('"', "", $v);
//       $v = str_replace("+", "", $v);
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $beg = substr($k,0,7);
       $beg2 = substr($k,0,3);
       if ($k == "mon_speed" or $k == "mon_speed_fly" or $k=="mon_speed_burrow" or $k=="mon_speed_climb"){
          if (is_numeric($$k)){
            if ($$k < 0 ){
              $msg = "Speeds cannot be negative";
              echo $k;
            }
          }else{
            $msg = "Speeds must be numeric. Do not enter 'ft'" ;
            echo $k;
          }
       }
       if ($k == "mon_str" or $k == "mon_dex" or $k == "mon_con" or $k == "mon_int" or $k=="mon_wis" or $k=="mon_wis" or $k =="mon_chr"){
          if (is_numeric($$k)){
            if ($$k < 0 or $$k >50){
              $msg = "Monster Stats must be between 0 and 50";
              echo $k;
            }
          }else{
            $msg = "Monster Stats must be numeric";
            echo $k;
          }
        }
        if ($k == "mon_ac_flat"){
          if (is_numeric($$k)){
          }else{
            $msg = "Monster natural AC must be numeric";
            echo $k;
          }
        }
        if ($k == "mon_cr" ){
          if (is_numeric($$k)){
            if ($$k < 0 or $$k >40){
              $msg = "Monster CR must be between 0 and 40";
               echo $k;
            }
          }else{
            $msg = "Monster CR must be numeric";
            echo $k;
          }
        }

       if ($v == "" and $beg != "mon_fea" and $beg != "monskil" and $beg !="mon_spe"and $beg2 != "dam" and $beg2 != "spe"  and $beg !="mon_noc"
           and $k != "mon_template" and       $beg != "montrea" and $beg !="monorg_" and $beg !="monlang" and $beg != "monadv_"){
          $msg = "please fill in all fields";
           echo $k;
       }

   }
   if ($mon_type !=""){
     $select = "select montype_hd, montype_skillp from montype2 where montype = '$mon_type' and mon_key_1 = '$key_1'";
     $result = mysqli_query($link, $select);
     $row = mysqli_fetch_array($result);
     $montype_hd = $row['montype_hd'];
     $montype_skillp = $row['montype_skillp'];
//     echo "skillp " . $montype_skillp;
   }
   $mon_hd = strtolower($mon_hd);
   if (strpos($mon_hd, "d")){
      $hd_pos =  strpos($mon_hd, "d");
      $mon_hitdie = substr($mon_hd,0,$hd_pos);
   }else{
      if ($mon_type != ""){
         $mon_hitdie = $mon_hd;
         $mon_hd = trim($mon_hd) . $montype_hd;
      }
   }
   if ($mon_int == "0"){
       $skill_points = 0;
   }else{
      $atr_pluss = (($mon_int - 10) / 2) -0.49;
      $atr_pluss = round($atr_pluss,0);
//     echo $atr_pluss . ":" . $montype_skillp . ":" . $mon_hitdie;
      $skillp = $montype_skillp + $atr_pluss;
//     echo ":" . $skillp;
      if ($skillp < 1){
        $skillp = 1;
      }
      if ($key_1 == "dd35"){
          $skill_points = $skillp * ($mon_hitdie + 3);
      }
      if ($key_1 == "path"){
          $skill_points = $skillp * $mon_hitdie ;
      }
   }
   if ($msg == "") {
      $link = getDBLink();
//      include 'includes/dd_db_conn.txt';
      $delete = "delete from monster2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monfeat2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monskill2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monskillrb where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monweap2 where monweap_mon = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monspec2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from montreas2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monorg2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monlang2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monadv2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monskillrb where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $mon_full_att =" ";
      $mon_ac = " ";
      $mon_hp =" ";
      $mon_init  = " ";
      $mon_ac_flat = $mon_nat_ac + 10;
      $mon_dase_att = " ";
      $insert  = "INSERT INTO monster2 (mon_key_1,mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed, mon_speed_fly, mon_speed_swim, mon_speed_burrow, mon_speed_climb," .
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, mon_user, mon_nochange, mon_template, mon_alignment, mon_environment, mon_level_adj, mon_magic_use, mon_delete, mon_ac_deflect, mon_skill_rule) " .
           "VALUES ( '$wp_user','$mon_name' ,'$mon_size' , '$mon_type' ,'$mon_hd' ,'$mon_hp' ,".
                 "'$mon_init' ,'$mon_speed', '$mon_speed_fly', '$mon_speed_swim', '$mon_speed_burrow','$mon_speed_climb',".
                     "'$mon_ac_flat' , '$mon_ac' ,".
                     "'$mon_base_att' ,'$mon_full_att' ,'$mon_space' ,'$mon_reach' ,".
                     "'$mon_cr' ,'$mon_str' ,'$mon_dex' ,'$mon_con' ,'$mon_int' ,".
                     "'$mon_wis' ,'$mon_chr' ,'$mon_desc','$mon_sv_fort',".
                     "'$mon_sv_reflex',  '$mon_sv_will','$mon_armour', '$mon_shield', '$user_id', '$mon_nochange', '$mon_template'," .
                     "'$mon_alignment', '$mon_environment', '$mon_level_adj', '$mon_magic_use', '$mon_delete','$mon_ac_deflect','$mon_skill_rule')";

//    echo $insert . "</BR>";
      $link = getDBLink();
//      include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $insert);
      if (!$result) {
         $msg = "$result" ." Error inserting data";
      }
      else {
         $msg = "record sucessfully added" ;
          $fn = $ln = "" ;
//insert Specials
          $count = 0;
          while ($count < 16){
            $count = $count + 1;
            $specv =  "specq_" . $count;
            if (!isset($$specv)){
                 $$specv = "";
            }
            $spec_name = $$specv;
            $valuev = "specq_value_" . $count;
            if (!isset($$valuev)){
               $$valuev = "";
            }
            $value  = $$valuev;
            $minv = "specq_min_" . $count;
            if (!isset($$minv)){
                $$minv = "";
            }
            $min  = $$minv;
            $maxv = "specq_max_" . $count;
            if (!isset($$maxv)){
                $$maxv = "";
            }
            $max  = $$maxv;
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1, mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$wp_user','$mon_name', 'S', '$spec_name', '$value', '$min', '$max')";
//            echo "</BR> $insert ";
               $result = mysqli_query($link, $insert);
            }
          }
          //insert Special attacks
          $count = 0;
          while ($count < 16){
            $count = $count + 1;
            $specv =  "speca_" . $count ;
            if (!isset($$specv)){
                $$specv = "";
            }
            $spec_name = $$specv;
            $valuev = "speca_value_" . $count;
            if (!isset($$valuev)){
               $$valuev = "";
            }
            $value  = $$valuev;
            $minv = "speca_min_" . $count;
            if (!isset($$minv)){
                $$minv = "";
            }
            $min  = $$minv;
            $maxv = "speca_max_" . $count;
            if (!isset($$maxv)){
                $$maxv = "";
            }
            $max  = $$maxv;
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1, mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$wp_user','$mon_name', 'A', '$spec_name', '$value', '$min', '$max')";
 //         echo "</BR> $insert ";
               $result = mysqli_query($link, $insert);

            }
          }




//insert feats
         $count = 0;
         while ($count < 34){
           $count = $count + 1;
           $name = "mon_feat_" . $count;
           if (!isset($$name)){
                $$name = "";
            }
           $feat_val = $$name;
           $free_v = "mon_feat_free_" . $count;
           if (!isset($$free_v)){
                $$free_v = "";
            }
           $free = $$free_v;
           if ($feat_val != ""){
              $insert = "INSERT INTO monfeat2 (mon_key_1, mon_name , monfeat, monfeat_free)".
                        "VALUES ('$wp_user','$mon_name', '$feat_val', '$free')";
          //    echo $insert;
              $result = mysqli_query($link, $insert);
              if (!$result) {
                 $msg = "$result" ." Error inserting feats";
              }
              else {
                 $msg = "record sucessfully added" ;
                 $fn = $ln = "" ;
              }
           }
         }
//insert skills
         $count = 0;
         $skill_total = 0;
         while ($count < 30){
//find the skill atribute and take off the skill value

           $count = $count + 1;
           $name = "monskill_tp_" . $count;
           if (!isset($$name)){
                $$name = "";
            }
           $value = "monskill_val_" . $count;
           if (!isset($$value)){
                $$value = "";
            }
           $mon_skill_val = $$value;
           $mon_skill = $$name;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skill != ""){
              $insert = "INSERT INTO monskill2 (mon_key_1, mon_name, monskill_tp , monskill_val)".
                        "VALUES ('$wp_user','$mon_name', '$mon_skill', '$mon_skill_val')";
              $result = mysqli_query($link, $insert);
              if (!$result) {
                 $msg = "$result" ." Error inserting skills";
              }
              else {
                 $msg = "record sucessfully added" ;
                 $fn = $ln = "" ;
              }
              $skill_total += $mon_skill_val;
           }
         }
         $count = 0;
         while ($count < 10){
//find the skill atribute and take off the skill value

           $count = $count + 1;
           $skill = "monskillrb_tp_" . $count;
           $value = "monskillrb_val_" . $count;
           $text = "monskillrb_text_" . $count;
           $atr = "monskillrb_atr_" . $count;
           if (!isset($$skill)){
                $$skill = "";
           }
           if (!isset($$value)){
                $$value = "";
           }
           if (!isset($$text)){
                $$text = "";
           }
           if (!isset($$atr)){
                $$atr = "";
            }
           $monskillrb_val = $$value;
           $monskillrb_tp = $$skill;
           $monskillrb_text = $$text;
           $monskillrb_atr = $$atr;
//         echo $value . "  " . $mon_skill_val;
           if ($monskillrb_tp != ""){
              $insert = "INSERT INTO monskillrb (mon_key_1, mon_name, monskillrb_tp , monskillrb_val, monskillrb_text,monskillrb_atr)".
                        "VALUES ('$wp_user','$mon_name', '$monskillrb_tp', '$monskillrb_val', '$monskillrb_text','$monskillrb_atr')";
           //   echo $insert;
              $result = mysqli_query($link, $insert);
              if (!$result) {
                 $msg = "$result" ." Error inserting skills";
              }
              else {
                 $msg = "record sucessfully added" ;
                 $fn = $ln = "" ;
              }
           }
         }
             
             
             
             
             
             
             

//insert Primary att
         $insert = "INSERT INTO monweap2 (mon_key_1,monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                   "VALUES ('$wp_user','$mon_name', 'P','$mon_weap_p', '$dam_p')";
         $result = mysqli_query($link, $insert);
         if (!$result) {
              $msg = "$result" ." Error inserting monweap primary";
         }
         else {
              $msg = "record sucessfully added" ;
              $fn = $ln = "" ;
              }
//insert ranged
         if ($mon_weap_r != "None"){
           $insert = "INSERT INTO monweap2 (mon_key_1, monweap_mon, monweap_attp, monweap_wp,monweap_dam)".
                     "VALUES ('$wp_user','$mon_name', 'R','$mon_weap_r','$dam_r')";
           $result = mysqli_query($link, $insert);
           if (!$result) {
                $msg = "$result" ." Error inserting monweap ranged";
           }
           else {
              $msg = "record sucessfully added" ;
              $fn = $ln = "" ;
                }
         }
//insert Secomdary atts
         $count = 0;
         while ($count <10) {
            $count = $count + 1;
            $name = "mon_weap_s" . $count;
            if (!isset($$name)){
                $$name = "";
            }
            $mon_weap = $$name;
            $dam_v = "dam_s" . $count;
            if (!isset($$dam_v)){
                $$dam_v = "";
            }
            $dam = $$dam_v;
            $mon_attp = "S" . $count;
            if ($mon_weap != "No Melee"){
               $insert = "INSERT INTO monweap2 (mon_key_1, monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                         "VALUES ('$wp_user','$mon_name', '$mon_attp','$mon_weap', '$dam')";
               $result = mysqli_query($link, $insert);
               if (!$result) {
                  $msg = "$result" ." Error inserting monweap secondary";
               }
               else {
                  $msg = "record sucessfully added" ;
                  $fn = $ln = "" ;
               }
            }
         }
// Monter Treasure
         $count = 0;
         While ($count <4){
           $count = $count  + 1;
           $montreas_v = "montreas_tp_". $count;
           $montreas_mult_v = "montreas_mult_" . $count;
           if (!isset($$montreas_v)){
                $$montreas_v = "";
           }
           if (!isset($$montreas_mult_v)){
                $$montreas_mult_v = "";
           }
           $montreas = $$montreas_v;
           $montreas_mult = $$montreas_mult_v;
           if ($montreas != ""){
             $insert = "INSERT INTO montreas2 (mon_key_1, mon_name, montreas_tp, montreas_mult)" .
                       " VALUES ('$wp_user','$mon_name','$montreas','$montreas_mult')";
           $result = mysqli_query($link, $insert);
               if (!$result) {
                  $msg = "$result" ." Error inserting montreas";
               }
               else {
                  $msg = "record sucessfully added" ;
                  $fn = $ln = "" ;
               }
           }
         }
// Monter Organization
         $count = 0;
         While ($count <4){
           $count = $count  + 1;
           $monorg_v = "monorg_". $count;
           $monorg_min_v = "monorg_min_" . $count;
           $monorg_max_v = "monorg_max_" . $count;
           if (!isset($$monorg_v)){
                $$monorg_v = "";
           }
           if (!isset($$monorg_min_v)){
                $$monorg_min_v = "";
           }
           if (!isset($$monorg_max_v)){
                $$monorg_max_v = "";
           }

           $monorg = $$monorg_v;
           $monorg_min = $$monorg_min_v;
           $monorg_max = $$monorg_max_v;
           if ($monorg != ""){
             $insert = "INSERT INTO monorg2 (mon_key_1, mon_name, monorg_id, monorg_min, monorg_max)" .
                       " VALUES ('$wp_user','$mon_name','$monorg','$monorg_min', '$monorg_max')";
           $result = mysqli_query($link, $insert);
               if (!$result) {
                  $msg = "$result" ." Error inserting monorg";
               }
               else {
                  $msg = "record sucessfully added" ;
                  $fn = $ln = "" ;
               }
           }
         }
// Monter Advancement
         $count = 0;
         While ($count <4){
           $count = $count  + 1;
           $monadv_size_v = "monadv_size_". $count;
           $monadv_min_v = "monadv_min_" . $count;
           $monadv_max_v = "monadv_max_" . $count;
           if (!isset($$monadv_size_v)){
                $$monadv_size_v = "";
           }
           if (!isset($$monadv_min_v)){
                $$monadv_min_v = "";
           }
           if (!isset($$monadv_max_v)){
                $$monadv_max_v = "";
           }
           $monadv_size = $$monadv_size_v;
           $monadv_min = $$monadv_min_v;
           $monadv_max = $$monadv_max_v;
           if ($monadv_min != ""){
              $insert = "INSERT INTO monadv2 (mon_key_1, mon_name, monadv_min_hd, monadv_max_hd, monadv_size)" .
                        " VALUES ('$wp_user','$mon_name','$monadv_min','$monadv_max','$monadv_size')";
              $result = mysqli_query($link, $insert);
               if (!$result) {
                  $msg = "$result" ." Error inserting monadv";
               }
               else {
                  $msg = "record sucessfully added" ;
                  $fn = $ln = "" ;
               }
           }
         }

// Monter Language
         $count = 0;
         While ($count <6){
           $count = $count  + 1;
           $monlang_v = "monlang_". $count;
           if (!isset($$monlang_v)){
                $$monlang_v = "";
           }
           $monlang = $$monlang_v;

           if ($monlang != ""){
             $insert = "INSERT INTO monlang2 (mon_key_1, mon_name, monlang_id)" .
                       " VALUES ('$wp_user','$mon_name','$monlang')";
           $result = mysqli_query($link, $insert);
               if (!$result) {
                  $msg = "$result" ." Error inserting monlang";
               }
               else {
                  $msg = "record sucessfully added" ;
                  $fn = $ln = "" ;
               }
           }
         }

      }
      mysqli_close($link) ;
   }
   echo "<div class=\"error\">$msg</div>" ;
}
else {
      $fn = $ln = "" ;
}


$background_blue = "LightSkyBlue";
$background_grey = "LightGrey";

echo <<<EOF
<STYLE>
table {
	border: 1px black solid;
        background-color: $background_blue;
}
th {
	border: 1px black solid;
        background-color: $background_blue;
        color: black;
}
h {
	border: 1px black solid;
        background-color: $background_blue;
        color: Black;
}
td {
	border: 1px black solid;
        color: black;
        background-color: $background_grey;
}
.specialaTable {
	position: relative;
}
.specialqTable {
	position: relative;
}
</STYLE>
EOF;

?>
<FORM METHOD="post" ACTION="<?php echo $baseDomain.$urlPATH; ?>">
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Name</TH>
  <TH>Size</TH>
  <TH>Type</TH>
  <TH>Hit Die e.g. 5D8 (Do not include bonus hit points)</TH>
</TR>
<TR>
  <TD><INPUT TYPE="text" NAME="mon_name" VALUE="<?php echo $mon_name ?>"/></TD>
  <TD><SELECT NAME="mon_size" VALUE="<?php echo $mon_size ?>">
<?php
$select = "SELECT size_cat FROM size order by size_ac_mod desc" ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$size_sel = $row['size_cat'] ;
if ($size_sel == $mon_size)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$size_sel" $sel > $size_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
</SELECT>
</TD>
<TD><SELECT NAME="mon_type">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "select montype from montype2 where mon_key_1 = '$key_1' ".
           "order by montype";
// echo $select;
   $result = mysqli_query($link, $select) ;
//  echo "result " $result;
while ($row = mysqli_fetch_array($result)) {
   $mon_type_sel = $row['montype'] ;
    if ($mon_type_sel == $mon_type){
      $sel = " SELECTED" ;
    } else {
      $sel = "" ;
    }

echo <<<EOF
     <OPTION VALUE="$mon_type_sel" $sel > $mon_type_sel </OPTION>
EOF;
}
?>
</SELECT>
</TD>
   <TD><INPUT TYPE="text" NAME="mon_hd" VALUE="<?php echo $mon_hd ?>"/></TD>

</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
   <TH>Base Speed Land</TH>
   <TH>Speed Fly</TH>
   <TH>Speed Climb</TH>
</TR>

<TR>
    <TD><INPUT TYPE="text" NAME="mon_speed" VALUE="<?php echo $mon_speed ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_fly" VALUE="<?php echo $mon_speed_fly ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_climb" VALUE="<?php echo $mon_speed_climb ?>"/></TD>
</TR>
<TR>
   <TH>Speed Swim</TH>
   <TH>Speed Burrow</TH>
</TR>
<TR>
    <TD><INPUT TYPE="text" NAME="mon_speed_swim" VALUE="<?php echo $mon_speed_swim ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_burrow" VALUE="<?php echo $mon_speed_burrow ?>"/></TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
</BR>
<TR>
  <TH>Natural AC Bonus</TH>
  <TH>Deflection AC Bonus</TH>
</TR>

<TR>
   <TD><INPUT TYPE="text" NAME="mon_nat_ac" VALUE="<?php echo $mon_nat_ac ?>"/></TD>
   <TD><SELECT NAME="mon_ac_deflect" VALUE="<?php echo $mon_ac_deflect ?>">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT deflect_key, deflect_desc FROM deflect " .
           "order by deflect_key";
// echo "select" . $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $deflect_key_sel = $row['deflect_key'] ;
    $deflect_desc_sel = $row['deflect_desc'] ;
    if ($deflect_key_sel == $mon_ac_deflect)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
     <OPTION VALUE="$deflect_key_sel" $sel > $deflect_desc_sel </OPTION>
EOF;
   }
mysqli_close($link);
?>
</TR>
</TABLE>
<TABLE>
<TR>
  <TH>Armour</TH>
  <TH>Shield</TH>
<TR>
 <TD><SELECT NAME="mon_armour" VALUE="<?php echo $mon_armour ?>">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT armour_cd, armour_tp, armour_bonus, armour_check FROM armour " .
           "where armour_cd != '4' order by armour_cd, armour_bonus, armour_dex DESC";  
// echo "select" . $select; 
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row['armour_tp'] ;
    $armour_bonus_sel = $row['armour_bonus'] ;
    $armour_check      = $row['armour_check'];
      if ($armour_tp_sel == $mon_armour)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
     <OPTION VALUE="$armour_tp_sel" $sel > $armour_tp_sel $armour_bonus_sel </OPTION>
EOF;
   }
mysqli_close($link);
?>
</SELECT>
</TD>
 <TD><SELECT NAME="mon_shield" VALUE="<?php echo $mon_shield ?>">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT armour_cd, armour_tp, armour_bonus, armour_check FROM armour " .
           "where armour_cd = '4' order by armour_cd, armour_bonus, armour_dex DESC";  
// echo "select" . $select; 
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row['armour_tp'] ;
    $armour_bonus_sel = $row['armour_bonus'] ;
    $armour_check      = $row['armour_check']; 
      if ($armour_tp_sel == $mon_shield)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
     <OPTION VALUE="$armour_tp_sel" $sel > $armour_tp_sel $armour_bonus_sel </OPTION>
EOF;
   }
mysqli_close($link);
?>
</SELECT>
</TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>



<TR>
  <TH>Primary Weapon</TH>
  <TH>Damage</TH>
  <TH>Missile weapon</TH>
  <TH>Damage</TH>
</TR>
<TR>
 <TD><SELECT NAME="mon_weap_p" VALUE="<?php echo $mon_weap_p ?>">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp != 'Ranged' order by weap_cat, weap_type, weap_id";
echo "select" . $select; 
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
   $desc = $weap_id_sel . " " . $weap_cat_sel;    
echo <<<EOF
     <OPTION VALUE="$weap_id_sel" $sel > $desc </OPTION>
EOF;
   }
mysqli_close($link);
?>
</SELECT>
</TD>
  <TD><SELECT NAME="dam_p">
<?php
$select = "SELECT DISTINCT dambase FROM dddambase order by dambase_no" ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

  $damage_sel = $row['dambase'] ;
  if ($damage_sel == $dam_p)
   {
    $sel = " SELECTED" ;
   } else {
     $sel = "" ;
          }
echo <<<EOF
  <OPTION VALUE="$damage_sel" $sel > $damage_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
</SELECT>
</TD>
 <TD><SELECT NAME="mon_weap_r" VALUE="<?php echo $mon_weap_r ?>">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp = 'Ranged' order by weap_cat, weap_type, weap_id";
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $weap_id_sel = $row['weap_id'] ;
    $weap_cat_sel = $row['weap_cat'] ;
      if ($weap_id_sel == $mon_weap_r)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }
   $desc = $weap_id_sel . " " . $weap_cat_sel;
echo <<<EOF
     <OPTION VALUE="$weap_id_sel" $sel > $desc </OPTION>
EOF;
   }
mysqli_close($link);
?>
<SELECT>
</TD>
<TD><SELECT NAME="dam_r">
<?php
$select = "SELECT DISTINCT dambase FROM dddambase order by dambase_no" ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

  $damage_sel = $row['dambase'] ;
  if ($damage_sel == $dam_r)
   {
    $sel = " SELECTED" ;
   } else {
     $sel = "" ;
          }
echo <<<EOF
  <OPTION VALUE="$damage_sel" $sel > $damage_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
</SELECT>
</TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
  <TH>Secondary Att</TH>
  <TH>Damage</TH>
</TR>
<TR>
<?php
$count = 0;

While ($count < 10){
  $count = $count + 1;
  $name = "mon_weap_s" . $count;
  $dam_v = "dam_s" . $count;
  $dam   = $$dam_v;
  $mon_weap_s = $$name;

echo <<<EOF
    <TR>
    <TD><SELECT NAME="$name" VALUE="<?php echo $mon_weap_s ?>">
EOF;

  $link = getDBLink();
//  include 'includes/dd_db_conn.txt' ;
  $select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp != 'Ranged' order by weap_cat, weap_type, weap_id";
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {
    $weap_id_sel = $row['weap_id'] ;
    $weap_cat_sel = $row['weap_cat'] ;
      if ($weap_id_sel == $mon_weap_s)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }
   $desc = $weap_id_sel . " " . $weap_cat_sel;
echo <<<EOF
     <OPTION VALUE="$weap_id_sel" $sel > $desc </OPTION>
EOF;
   }
echo "</TD>";
echo "</SELECT>";
echo "<TD><SELECT NAME='$dam_v'>";
  $select = "SELECT DISTINCT dambase FROM dddambase order by dambase_no" ;
  $link = getDBLink();
//  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $damage_sel = $row['dambase'] ;
    if ($damage_sel == $dam)
     {
      $sel = " SELECTED" ;
     } else {
       $sel = "" ;
          }
echo <<<EOF
  <OPTION VALUE="$damage_sel" $sel > $damage_sel </OPTION>
EOF;
   }
echo "</TD></SELECT></TR>";
}
?>
<TABLE>
<BR></BR>
<TR>
  <TH>Space</TH>
  <TH>Reach</TH>
</TR>
<TR>
<TD><SELECT NAME="mon_space"">
<?php
$sel_half = $sel_1 = $sel_2 =  $sel_5 = $sel_10 = $sel_15 = $sel_20 = $sel_25 = $sel_30 = "";
$var = "sel_" . $mon_space;
$$var = "SELECTED";
echo <<<EOF
     <OPTION VALUE="half" $sel_half > 1/2 ft </OPTION>
     <OPTION VALUE="1" $sel_1 > 1 ft </OPTION>
     <OPTION VALUE="2" $sel_2 > 2 1/2 ft </OPTION>
     <OPTION VALUE="5" $sel_5 > 5 ft </OPTION>
     <OPTION VALUE="10" $sel_10 >10 ft </OPTION>
     <OPTION VALUE="15" $sel_15 > 15 ft </OPTION>
     <OPTION VALUE="20" $sel_20 > 20 ft </OPTION>
     <OPTION VALUE="25" $sel_25 > 25 ft </OPTION>
     <OPTION VALUE="30" $sel_30 > 30 ft </OPTION>
     </SELECT>
     </TD>
EOF;
?>
<TD><SELECT NAME="mon_reach"">
<?php
$sel_half = $sel_1 = $sel_2 = $sel_5 = $sel_10 = $sel_15 = $sel_20 = $sel_25 = $sel_30 = $sel_35 = $sel_40 = $sel_45 = $sel_50 = "";
$var = "sel_" . $mon_reach;
$$var = "SELECTED";
echo <<<EOF
     <OPTION VALUE="0" $sel_0 > 0 ft </OPTION>
     <OPTION VALUE="5" $sel_5 > 5 ft </OPTION>
     <OPTION VALUE="10" $sel_10 > 10 ft </OPTION>
     <OPTION VALUE="15" $sel_15 > 15 ft </OPTION>
     <OPTION VALUE="20" $sel_20 > 20 ft </OPTION>
     <OPTION VALUE="25" $sel_25 > 25 ft </OPTION>
     <OPTION VALUE="30" $sel_30 > 30 ft </OPTION>
     <OPTION VALUE="35" $sel_35 > 35 ft </OPTION>
     <OPTION VALUE="40" $sel_40 > 40 ft </OPTION>
     <OPTION VALUE="45" $sel_45 > 45 ft </OPTION>
     <OPTION VALUE="50" $sel_50 > 50 ft </OPTION>
     </SELECT>
EOF;

mysqli_close($link);
?>
</TD>
</TABLE>
<TABLE class ="SpecialaTable">
</BR>
<TR>
    <TH>Special Attacks</TH>
    <TH>Value</TH>
    <TH>Min HD</TH>
    <TH>Max HD</TH>
</TR>
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
// special attacks
$count = 0;

while ($count < 16){
  $count = $count + 1;
   $specav = "speca_" . $count;
   $speca  = $$specav;
   echo "<TR>";
echo <<<EOF
   <TD><SELECT NAME='$specav'>
EOF;

   $select = "SELECT speca_name FROM specatta order by speca_name" ;
//   echo $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  $sel = "";
  while ($row = mysqli_fetch_array($result)) {
    $speca_sel = $row['speca_name'] ;
//    echo "</BR> spec_atta_sel " . $spec_atta_sel;
      if ($speca_sel == $speca)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
    <OPTION VALUE="$speca_sel" $sel > $speca_sel </OPTION>
EOF;
  }
  echo "</SELECT>";
  echo "</TD>";
  $speca_valuev = "speca_value_" . $count;
  $speca_value = $$speca_valuev;
  $speca_minv = "speca_min_" . $count;
  $speca_min = $$speca_minv;
  $speca_maxv = "speca_max_" . $count;
  $speca_max = $$speca_maxv;
echo <<<EOF
  <TD><INPUT TYPE='text' NAME='$speca_valuev' VALUE='$speca_value'></TD>
  <TD><INPUT TYPE='text' NAME='$speca_minv' VALUE='$speca_min'></TD>
  <TD><INPUT TYPE='text' NAME='$speca_maxv' VALUE='$speca_max'></TD>
EOF;

  echo "</TR>";
}
echo "</TABLE>";
?>
</TR>
</TABLE>
</BR>
<TABLE class="specialqTable">
<TR>
    <TH>Special Qualities</TH>
    <TH>Value</TH>
    <TH>Min HD</TH>
    <TH>Max HD</TH>
</TR>
<?php
// special Qualities
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$count = 0;
//echo  "specq_1 " .$specq_1;
while ($count < 16){
  $count = $count + 1;
   $specqv = "specq_" . $count;
   $specq  = $$specqv;
   echo "<TR>";
echo <<<EOF
   <TD><SELECT NAME='$specqv'>
EOF;

   $select = "SELECT specq_name FROM specqual order by specq_name" ;
//   echo $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  $sel = "";
  while ($row = mysqli_fetch_array($result)) {
    $specq_sel = $row['specq_name'] ;

      if ($specq_sel == $specq)
      {

       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }
      echo "</BR> specq_sel " . $specq_sel . " specq " . $specq . $sel;
echo <<<EOF
    <OPTION VALUE="$specq_sel" $sel > $specq_sel </OPTION>
EOF;
  }
  echo "</SELECT>";
  echo "</TD>";
  $specq_valuev = "specq_value_" . $count;
  $specq_value = $$specq_valuev;
  $specq_minv = "specq_min_" . $count;
  $specq_min = $$specq_minv;
  $specq_maxv = "specq_max_" . $count;
  $specq_max = $$specq_maxv;
echo <<<EOF
  <TD><INPUT TYPE='text' NAME='$specq_valuev' VALUE='$specq_value'></TD>
  <TD><INPUT TYPE='text' NAME='$specq_minv' VALUE='$specq_min'></TD>
  <TD><INPUT TYPE='text' NAME='$specq_maxv' VALUE='$specq_max'></TD>
EOF;

  echo "</TR>";
}
echo "</TABLE>";


?>
<BR></BR>
<TABLE>
<TR>
  <TH>Fort Save Type</TH>
  <TH>Reflex Save Type</TH>
  <TH>Will Save Type</TH>
</TR>
<TR>
  <TD><SELECT NAME="mon_sv_fort" VALUE="<?php echo $mon_sv_fort ?>">
<?php
$sel_g = "";
$sel_b = "";
if ($mon_sv_fort == "G"){
   $sel_g = " SELECTED";
}else{
   $sel_b = " SELECTED";
}
echo <<<EOF
     <OPTION VALUE="G" $sel_g > Good save </OPTION>
     <OPTION VALUE="B" $sel_b > Bad save </OPTION>
EOF
?>
</SELECT>
</TD>
  <TD><SELECT NAME="mon_sv_reflex" VALUE="<?php echo $mon_sv_reflex ?>">
<?php
$sel_g = "";
$sel_b = "";
if ($mon_sv_reflex == "G"){
   $sel_g = " SELECTED";
}else{
   $sel_b = " SELECTED";
}
echo <<<EOF
     <OPTION VALUE="G" $sel_g > Good save </OPTION>
     <OPTION VALUE="B" $sel_b > Bad save </OPTION>
EOF
?>
</SELECT>
</TD>
  <TD><SELECT NAME="mon_sv_will" VALUE="<?php echo $mon_sv_will ?>">
<?php
$sel_g = "";
$sel_b = "";
if ($mon_sv_will == "G"){
   $sel_g = " SELECTED";
}else{
   $sel_b = " SELECTED";
}     
echo <<<EOF
     <OPTION VALUE="G" $sel_g > Good save </OPTION>   
     <OPTION VALUE="B" $sel_b > Bad save </OPTION>
EOF
?>
</SELECT>
</TD>
</TR>
<TABLE>
<BR></BR>
<TR>
  <TH>Str</TH>
  <TH>Dex</TH>
  <TH>Con</TH>
  <TH>Int</TH>
  <TH>Wis</TH>
  <TH>Chr</TH> 
</TR>

<TR>
<?php
disAttr("Str",$mon_str);
disAttr("Dex",$mon_dex);
disAttr("Con",$mon_con);
disAttr("Int",$mon_int);
disAttr("Wis",$mon_wis);
disAttr("Chr",$mon_chr);
/*
  <TD><INPUT TYPE="text" NAME="mon_str" VALUE="<? echo $mon_str ?>"/></TD>
  <TD><INPUT TYPE="text" NAME="mon_dex" VALUE="<? echo $mon_dex ?>"/></TD>
  <TD><INPUT TYPE="text" NAME="mon_con" VALUE="<? echo $mon_con ?>"/></TD>
  <TD><INPUT TYPE="text" NAME="mon_int" VALUE="<? echo $mon_int ?>"/></TD>
  <TD><INPUT TYPE="text" NAME="mon_wis" VALUE="<? echo $mon_wis ?>"/></TD>
  <TD><INPUT TYPE="text" NAME="mon_chr" VALUE="<? echo $mon_chr ?>"/></TD>
*/
?>
</TR>
</TABLE>
<BR></BR>
<H3>Changing Monsters Skills</H3>

<?php
$sel_Y = $sel_N = "";
if ($mon_skill_rule == "ALL"){
    $sel_Y = " SELECTED";
}else{
    $sel_N = " SELECTED";
}

echo <<<EOF
</BR>
<TABLE>
<TH>All Monster Skill are class skills?(Pathfinder)</TH>
<TD><SELECT NAME="mon_skill_rule">
     <OPTION VALUE="ALL" $sel_Y > Yes, all skills are class skills</OPTION>
     <OPTION VALUE="TYPE" $sel_N > No, only the skills under monster type are class skills</OPTION>
     </SELECT>
</TD>
</TABLE>
</BR>
The skills in the change monster screen do not include any atribute bonus they are just assigned skill points.
EOF;

if ($skill_points > 0){
   echo "<BR></BR>Total skill points to spend = $skill_points. Skill points spent = $skill_total.";
}
?>
<BR></BR>
<TABLE BORDER="1" CELLPADDING="1">
</TR>
</BR>
<?php
echo <<<EOF
  <TH>Skill</TH>
  <TH>Rank</TH>
  <TH>Skill</TH>
  <TH>Rank</TH>
EOF;
$count1 = 0;
while ($count1 < 20){
  echo "</TR> <TR>";
  $count2 = 0;
  while ($count2 < 2){
    $count2 = $count2 + 1;
    $sub = ($count1 * 2) + $count2;
    $link = getDBLink();
//    include 'includes/dd_db_conn.txt' ;

    $name = "monskill_tp_" . $sub;
    $value = "monskill_val_" . $sub;
    if (!isset($$name)){
         $$name = "";
    }
    if (!isset($$value)){
         $$value = "";
    }
    $mon_skill_val = $$value;
    $mon_skill = $$name;

echo <<<EOF
    <TD><SELECT NAME="$name" VALUE="<?php echo $mon_skill ?>">
EOF;

   $select = "SELECT skill_cd FROM skills order by skill_cd" ;

   $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
   while ($row = mysqli_fetch_array($result)) {
    $skill_sel = $row['skill_cd'] ;
      if ($skill_sel == $mon_skill)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
      <OPTION VALUE="$skill_sel" $sel > $skill_sel </OPTION>
EOF;
   }
echo "</SELECT>";
echo "</TD>";

echo <<<EOF
    <TD><INPUT TYPE="text" NAME="$value" VALUE="$mon_skill_val"/></TD>
EOF;
 }
 $count1 = $count1 + 1;
}
mysqli_close($link);
?>
<BR></BR>
<TABLE BORDER="1" CELLPADDING="1">
</TR>
</BR>
<?php
echo <<<EOF
</BR></BR>
<H3>Monster Race Bonus Skills</H3>
</BR>

Leave the text field blank if there is no condition on the skill bonus. A condition for hide may be "in snow".
</BR>
  <TH>Skill</TH>
  <TH>Text</TH>
  <TH>Rank</TH>
  <TH>Attribute</TH>

EOF;
$count1 = 0;
while ($count1 < 10){
  echo "</TR> <TR>";
  $count1 += 1;
  $sub = ($count1);
  $link = getDBLink();
//    include 'includes/dd_db_conn.txt' ;

   $name = "monskillrb_tp_" . $sub;
   $value = "monskillrb_val_" . $sub;
   $text =  "monskillrb_text_" . $sub;
   $atr =  "monskillrb_atr_" . $sub;
   $mon_skill_val = $$value;
   $mon_skillrb = $$name;
   $mon_skill_text = $$text;
   $mon_skill_atr = $$atr;

echo <<<EOF
    <TD><SELECT NAME="$name">
EOF;

   $select = "SELECT skill_cd FROM skills order by skill_cd" ;

   $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
   while ($row = mysqli_fetch_array($result)) {
    $skill_sel = $row['skill_cd'] ;
      if ($skill_sel == $mon_skillrb)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
      <OPTION VALUE="$skill_sel" $sel > $skill_sel </OPTION>
EOF;
   }
echo "</SELECT>";
echo "</TD>";

echo <<<EOF
    <TD><INPUT TYPE="text" NAME="$text" VALUE="$mon_skill_text"/></TD>
    <TD><INPUT TYPE="text" NAME="$value" VALUE="$mon_skill_val"/></TD>
    <TD><INPUT TYPE="text" NAME="$atr" VALUE="$mon_skill_atr"/></TD>


EOF;
}
mysqli_close($link);
?>
</TR>
</TABLE>
</BR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
<TH>Monster Feats</TH>
<TH>Free?</TH>
<TH>Monster Feats</TH>
<TH>Free?</TH>
<TH>Monster Feats</TH>
<TH>Free?</TH>
</TR>

<TR>
<?php
// FEATS
$count  = 0 ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
While ($count < 33) {
  $count = $count + 1;
  $name = "mon_feat_" . $count;
  $mon_feat = $$name;
  $free_v = "mon_feat_free_" . $count;
  $free = $$free_v;
  if ($count == 4 or $count == 7 or $count == 10 or $count == 13 or $count == 16 or $count == 19 or $count == 22 or $count == 25 or $count == 28 or $count ==31){
     echo "</TR><TR>";
  }
echo <<<EOF
    <TD><SELECT NAME="$name">
EOF;

  $select = "SELECT feat_name FROM feats2 where mon_key_1 = '$key_1' order by feat_name" ;
 
  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  while ($row = mysqli_fetch_array($result)) {
    $feat_sel = $row['feat_name'] ;
      if ($feat_sel == $mon_feat)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
    <OPTION VALUE="$feat_sel" $sel > $feat_sel </OPTION>
EOF;
  }
  echo "</SELECT>";
  echo "</TD>";

  $sel_Y = $sel_N = "";
  if ($free == "Y"){
   $sel_Y = " SELECTED";
   $sel_N = "";
  }else{
   $sel_Y = "";
   $sel_N = " SELECTED";
  }

echo <<<EOF
<TD><SELECT NAME="$free_v">
     <OPTION VALUE="Y" $sel_Y > Yes</OPTION>
     <OPTION VALUE="" $sel_N > No </OPTION>
     </SELECT>
</TD>
EOF;
}
mysqli_close($link);
?>
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Environment</TH>
<?php
//$select = "select distinct savemon_terain from savemon order by savemon_terain";
//$link = getDBLink();
//$result = mysqli_query($link, $select) ;
//$save_count = 0;
//$html = '<TD>Terain <SELECT NAME="mon_environment" >';
//while ($row = mysqli_fetch_array($result)) {
//   $terain_sel = $row['savemon_terain'] ;
//    if ($terain_sel == $mon_environment){
//	$sel = " SELECTED" ;
//    } else {
//	$sel = "" ;
//    }
//    if ($terain_sel != ""){
//       $html .= '<OPTION VALUE="'.$terain_sel.'" '.$sel.' >'.$terain_sel.'</OPTION>';
//    }
//}
//mysqli_close($link);

//$html .= '</SELECT></TD>';
//echo $html;
?>
<TD>Terain<INPUT TYPE="text" NAME="mon_environment" VALUE="<?php echo $mon_environment ?>"/></TD>
</TR>
</BR>
<TR>
  <TH>CR Rating</TH>
  <TH>Template</TH>
</TR>
<TR>
   <TD><INPUT TYPE="text" NAME="mon_cr" VALUE="<?php echo $mon_cr ?>"/></TD>
   <TD><SELECT NAME="mon_template" VALUE="<?php echo $mon_template ?>">
<?php
$sel_T = $sel_0 = $sel_L = $sel_N = "";
$sel_v = "sel_" . $mon_template;
if ($sel_v == "sel_"){
  $sel_v = "sel_N";
}
$$sel_v = " SELECTED";
echo <<<EOF
     <OPTION VALUE="T" $sel_T > Template</OPTION>
     <OPTION VALUE="0" $sel_0 > Zero Level</OPTION>
     <OPTION VALUE="L" $sel_L > Char Levels</OPTION>
     <OPTION VALUE=""  $sel_N > No Template</OPTION>
     </SELECT>
EOF;
?>
</TD>

</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
   <TH>Treasure</TH>
   <TH>Mult</TH>
</TR>
<TR>
<?php
$count  = 0 ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
While ($count < 4) {
  $count = $count + 1;
  $name = "montreas_tp_" . $count;
  $montreas = $$name;
  $montreas_mult_v = "montreas_mult_" . $count;
  $montreas_mult = $$montreas_mult_v;
echo <<<EOF
    <TR>
    <TD><SELECT NAME="$name" VALUE="<?php echo $montreas ?>">
EOF;

  $select = "SELECT montreastp_id FROM montreastp order by montreastp_id" ;

  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  while ($row = mysqli_fetch_array($result)) {
    $treas_sel = $row['montreastp_id'] ;
      if ($treas_sel == $montreas)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
    <OPTION VALUE="$treas_sel" $sel > $treas_sel </OPTION>
EOF;
  }
echo <<<EOF
</SELECT>
</TD>
<TD><INPUT TYPE="text" NAME="$montreas_mult_v" VALUE="$montreas_mult"/></TD>
</TR>
EOF;

}
?>
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Organization</TH>
<TH>Min</TH>
<TH>Max</TH>
</TR>
<?php
$count = 0;
while ($count < 4){
  $count = $count +1;
  $monorg_v = "monorg_" . $count;
  $monorg = $$monorg_v;
  $monorg_min_v = "monorg_min_" . $count;
  $monorg_min = $$monorg_min_v;
  $monorg_max_v = "monorg_max_" . $count;
  $monorg_max = $$monorg_max_v;
echo <<<EOF
  <TR>
  <TD><INPUT TYPE="text" NAME="$monorg_v" VALUE="$monorg"/></TD>
  <TD><INPUT TYPE="text" NAME="$monorg_min_v" VALUE="$monorg_min"/></TD>
  <TD><INPUT TYPE="text" NAME="$monorg_max_v" VALUE="$monorg_max"/></TD>
  </TR>
EOF;
}
?>
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Advancment Size</TH>
<TH>Min</TH>
<TH>Max</TH>
</TR>
<?php
$count = 0;
while ($count < 4){
  $count = $count +1;
  $monadv_size_v = "monadv_size_" . $count;
  $monadv_size = $$monadv_size_v;
  $monadv_min_v = "monadv_min_" . $count;
  $monadv_min = $$monadv_min_v;
  $monadv_max_v = "monadv_max_" . $count;
  $monadv_max = $$monadv_max_v;
echo <<<EOF
  <TR>
  <TD><SELECT NAME="$monadv_size_v" >
EOF;

  $select = "SELECT size_cat FROM size order by size_ac_mod desc" ;
  $link = getDBLink();
//  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $size_sel = $row['size_cat'] ;
    if ($size_sel == $monadv_size){
        $sel = " SELECTED" ;
    }else{
          $sel = "" ;
    }

echo <<<EOF
  <OPTION VALUE="$size_sel" $sel > $size_sel </OPTION>
EOF;
  }
mysqli_close($link);

echo <<<EOF
</SELECT>
  </TD>
  <TD><INPUT TYPE="text" NAME="$monadv_min_v" VALUE="$monadv_min"/></TD>
  <TD><INPUT TYPE="text" NAME="$monadv_max_v" VALUE="$monadv_max"/></TD>
  </TR>
EOF;
}


echo <<<EOF
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Alignment</TH>
<TD><INPUT TYPE="text" NAME="mon_alignment" VALUE="$mon_alignment"/></TD>
<TH>Level Adjustment</TH>
<TD><INPUT TYPE="text" NAME="mon_level_adj" VALUE="$mon_level_adj"/></TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Languages</TH>
</TR>
EOF;

$count = 0;
while ($count < 6){
  $count = $count +1;
  if ($count == 4){
     echo "</TR><TR>";
  }
  $monlang_v = "monlang_" . $count;
  $monlang = $$monlang_v;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$monlang_v" VALUE="$monlang"/></TD>
EOF;
}
?>
</TR>
</TABLE>
<BR></BR>
<TABLE>
<TH>Monster Magic Use</TH>
<TD><SELECT NAME="mon_magic_use" VALUE="<?php echo $mon_magic_use ?>">
<?php
$sel_Y = $sel_N = $sel_H = $sel_T = $sel_B = $sel_W = $sel_A = $sel_E = $sel_R = "";
$sel_v = "sel_" . $mon_magic_use;
if ($sel_v == "sel_"){
  $sel_v = "sel_N";
}
$$sel_v = " SELECTED";
echo <<<EOF
     <OPTION VALUE="Y" $sel_Y > Yes (Humanoid)</OPTION>
     <OPTION VALUE="N" $sel_N > No Magic use</OPTION>
     <OPTION VALUE="H" $sel_H > Head only</OPTION>
     <OPTION VALUE="T"  $sel_T > Top Half only</OPTION>
     <OPTION VALUE="B"  $sel_B > Bottom Half only</OPTION>
     <OPTION VALUE="W"  $sel_W > Weapons only</OPTION>
     <OPTION VALUE="A"  $sel_A > Armour only</OPTION>
     <OPTION VALUE="E"  $sel_E > Eyes only</OPTION>
     <OPTION VALUE="R"  $sel_R > Rings only</OPTION>
     </SELECT>
EOF;

?>
</TD>
</TR>
<P>
<BR>

<TABLE BORDER="1" CELLPADDING="1">
<BR>
<TR>
<TD COLSPAN="4">Monsters Description: </TD>
</TR>
<TR>
<TD COLSPAN="4"><TEXTAREA NAME="mon_desc" ROWS="6" COLS="70">
<?php echo $mon_desc ?> </TEXTAREA> </TD>
</TR>
</TABLE>
<BR>
  <INPUT TYPE="submit" VALUE="Change Monster" style="height: 70px; width: 200px" />
</BR>
</BR>
</FORM>
</BODY>
</HTML>