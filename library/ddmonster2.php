<<<<<<< HEAD
<?php
echo "wp_user = $wp_user";
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$ddpost = $url . $domain;
/*
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
}
*/
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<?php
$mon_key_1 = $wp_user;
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = str_replace("\'", "", $v);
       $v = str_replace('\"', "", $v);
       $v = str_replace("'", "", $v);
       $v = str_replace('"', "", $v);
       $v = str_replace('+', "", $v);
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
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
            $msg = "Natural AC must be numeric";
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
       $beg = substr($k,0,7);
       $beg2 = substr($k,0,3);
       if ($v == "" and $beg != "mon_fea" and $beg != "monskil" and $beg !="mon_spe"and $beg2 != "dam" and $beg2 != "spe" and $k != "mon_template"
            and $beg !="monlang" and $beg != "monorg_" and $beg != "montrea"  and $beg != "monadv_"){
          $msg = "please fill in all fields";
           echo $k;
       }

   }
   $select = "Select count(*) from monster2 where mon_name = '$mon_name' and (mon_key_1 = 'dd35' or mon_key_1 = '$wp_user')";
   $link = getDBLink();
   $result = mysqli_query($link, $select);
   if ($result){
      $row = mysqli_fetch_array($result);
      $mon_count = $row[0];
      if ($mon_count > 0){
         $msg = "This monster already exists, change the name if you want to create a new version";
      }
   }
   if ($mon_type !=""){
     $select = "select montype_hd, montype_skillp from montype where montype = '$mon_type'";
     $result = mysqli_query($link, $select);
     $row = mysqli_fetch_array($result);
     $montype_hd = $row['montype_hd'];
     $montype_skillp = $row['montype_skillp'];
   }
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
//      echo $atr_pluss . ":" . $montype_skillp . ":" . $mon_hitdie;
      $skillp = $montype_skillp + $atr_pluss;
      if ($skillp < 1){
        $skillp = 1;
      }
      $skill_points = $skillp * ( $mon_hitdie + 3 ) ;
   }
   if ($msg == "") {
      $mon_full_att =" ";
      $mon_ac = " ";
      $mon_hp =" ";
      $mon_init  = " ";
      $mon_ac_flat = 10 + $mon_nat_ac;
      $mon_base_att = " ";
      $mon_delete = "";
      $insert  = "INSERT INTO monster2 (mon_key_1, mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed, mon_speed_fly, mon_speed_swim, mon_speed_burrow, mon_speed_climb," .
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, mon_user, mon_nochange, mon_template, mon_alignment, mon_environment, mon_level_adj, mon_magic_use, mon_delete) " .
           "VALUES ( '$mon_key_1','$mon_name' ,'$mon_size' , '$mon_type' ,'$mon_hd' ,'$mon_hp' ,".
                 "'$mon_init' ,'$mon_speed', '$mon_speed_fly', '$mon_speed_swim', '$mon_speed_burrow','$mon_speed_climb',".
                     "'$mon_ac_flat' , '$mon_ac' ,".
                     "'$mon_base_att' ,'$mon_full_att' ,'$mon_space' ,'$mon_reach' ,".
                     "'$mon_cr' ,'$mon_str' ,'$mon_dex' ,'$mon_con' ,'$mon_int' ,".
                     "'$mon_wis' ,'$mon_chr' ,'$mon_desc','$mon_sv_fort',".
                     "'$mon_sv_reflex',  '$mon_sv_will','$mon_armour', '$mon_shield','$user_id', 'N', '$mon_template'," .
                     "'$mon_alignment','$mon_environment', '$mon_level_adj', '$mon_magic_use', '$mon_delete')";

//    echo $insert . "</BR>;
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
            $spec_name = $$specv;
            $valuev = "specq_value_" . $count;
            $value  = $$valuev;
            $minv = "specq_min_" . $count;
            $min  = $$minv;
            $maxv = "specq_max_" . $count;
            $max  = $$maxv;
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1,mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$mon_key_1','$mon_name', 'S', '$spec_name', '$value','$min','$max')";
//            echo "</BR> $insert ";
               $result = mysqli_query($link, $insert);
            }
          }
          //insert Special attacks
          $count = 0;
          while ($count < 16){
            $count = $count + 1;
            $specv =  "speca_" . $count ;
            $spec_name = $$specv;
            $valuev = "speca_value_" . $count;
            $value  = $$valuev;
            $minv = "speca_min_" . $count;
            $min  = $$minv;
            $maxv = "speca_max_" . $count;
            $max  = $$maxv;
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1,mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$mon_key_1','$mon_name', 'A', '$spec_name', '$value', '$min', '$max')";
//          echo "</BR> $insert ";
               $result = mysqli_query($link, $insert);

            }
          }




//insert feats
         $count = 0;
         while ($count < 16){
           $count = $count + 1;
           $name = "mon_feat_" . $count;
           $feat_val = $$name;
           $free_v = "mon_feat_free_" . $count;
           $free = $$free_v;

           if ($feat_val != ""){
              $insert = "INSERT INTO monfeat2 (mon_key_1, mon_name , monfeat, monfeat_free)".
                        "VALUES ('$mon_key_1','$mon_name', '$feat_val','$free')";
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
         while ($count < 30){
//find the skill atribute and take off the skill value

           $count = $count + 1;
           $name = "monskill_tp_" . $count;
           $value = "monskill_val_" . $count;
           $mon_skill_val = $$value;
           $mon_skill_val_rank = $mon_skill_val;
           $mon_skill = $$name;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skill != ""){
              $select = "SELECT skill_cd, skill_atr, skill_armour_ch from skills ".
                      "WHERE skill_cd = '$mon_skill'";
//              echo $select;
              $result = mysqli_query($link, $select);
              $row = mysqli_fetch_array($result);
              $armour_ch = $row['skill_armour_ch'];
              $skill_atr = $row['skill_atr'];
//              echo "skill atr = " . $skill_atr;
              $lower = strtolower($skill_atr);
      //        echo $lower;
              $field = "mon_" . $lower;
//              echo "</BR>";
      //        echo "mon_str = " . $mon_str;
              $atr_val = $$field;
      //        echo  "field " . $field . " value " . $atr_val . " ***";
              $atr_pluss = (($atr_val - 10) / 2) -0.49;
              $atr_pluss = round($atr_pluss,0);
              $mon_skill_val = $mon_skill_val - $atr_pluss;
//  find if any feats have been included for the skill
              $select = "select featattr_no from featattr2, monfeat2 where ".
                        "mon_name = '$mon_name' and featattr_type = 'SKILL' and ".
                        "featattr_id = '$mon_skill' and featattr_feat = monfeat and monfeat2.mon_key_1 = 'dd35' ".
                        "and featattr2.mon_key_1 = 'dd35'  ";
              $result = mysqli_query($link, $select);
              if ($result){
                  $row = mysqli_fetch_array($result);
                  $featattr_no = $row['featattr_no'];
                  $mon_skill_val = $mon_skill_val - $featattr_no;
              }
              $select = "select armour_cd, armour_tp, armour_bonus, armour_dex, armour_check, armour_spell, armour_s30,".
             "armour_s20,armour_wt from armour where armour_tp = '$mon_armour' or armour_tp = '$mon_shield'" .
             "order by armour_cd";
// echo "</BR> " . $select;
              $result = mysqli_query($link, $select);
              $count3 = 0;
              if (mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_array($result)){
                    $count3 = $count3 + 1;
                    if ($count3 == 1){
                      $armour_bonus = $row['armour_bonus'];
                       $armour_dex =   $row['armour_dex'];
                       $armour_check = $row['armour_check'];
                       $armour_spell = $row['armour_spell'];
                       $armour_s30   = $row['armour_s30'];
                       $armour_s20   = $row['armour_s20'];
                       $armour_wt    = $row['armour_wt'];
                   }else{
                      $shield_bonus = $row['armour_bonus'];
                      $shield_dex =   $row['armour_dex'];
                      $shield_check = $row['armour_check'];
                      $shield_spell = $row['armour_spell'];
                      $shield_s30   = $row['armour_s30'];
                      $shield_s20   = $row['armour_s20'];
                      $shield_wt    = $row['armour_wt'];
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
              $armour_bon = 0;
              if ($armour_ch == "Y"){
                    $armour_bon = $armour_check + $shield_check;
              }
              if ($armour_ch == "2"){
                 $armour_bon = ($armour_check + $shield_check) * 2;
              }
//              echo "</BR> armour ch $armour_ch";
//              echo "</BR> armour bon $armour_bon";
//              echo "</BR> armour_check $armout_check";
              $mon_skill_val = $mon_skill_val - $armour_bon;
              if ($mon_skill == "Hide"){
                 $select_size = "select size_ac_mod, size_grapple, size_hide, size_sq, size_reach_t, size_reach_l from size ".
                 "where size_cat = '$mon_size'";
                 $result_size = mysqli_query($link, $select_size);
                 if (mysqli_num_rows($result_size) > 0){
                    $row_size = mysqli_fetch_array($result_size);
                    $size_hide      = $row_size['size_hide'];
                    $mon_skill_val = $mon_skill_val - $size_hide;
                 }
              }
              $select = "SELECT monskillrb_val from monskillrb where mon_key_1 = '$wp_user' and mon_name = '$mon_name' and monskillrb_tp = '$mon_skill' and monskillrb_text = ''";
              $result_skillrb = mysqli_query($link, $select);
              if (mysqli_num_rows($result_skillrb) > 0){
                $row_skillrb = mysqli_fetch_array($result_skillrb);
                $mon_skill_val = $mon_skill_val - $row_skillrb['monskillrb_val'];
              }
// reset to original value if rank selected
              if ($mon_skill_all == "RANK"){
                  $mon_skill_val = $mon_skill_val_rank;
      //            echo $mon_skill . $mon_skill_val_rank;
              }
              $insert = "INSERT INTO monskill2 (mon_key_1, mon_name, monskill_tp , monskill_val)".
                        "VALUES ('$mon_key_1','$mon_name', '$mon_skill', '$mon_skill_val')";
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
           $mon_skillrb_val = $$value;
           $mon_skillrb_tp = $$skill;
           $mon_skillrb_text = $$text;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skillrb_tp != ""){
              $insert = "INSERT INTO monskillrb (mon_key_1, mon_name, monskillrb_tp , monskillrb_val, monskillrb_text)".
                        "VALUES ('$wp_user','$mon_name', '$mon_skillrb_tp', '$mon_skillrb_val', '$mon_skillrb_text')";
        //      echo $insert;
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
         $insert = "INSERT INTO monweap2 (mon_key_1, monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                   "VALUES ('$mon_key_1','$mon_name', 'P','$mon_weap_p', '$dam_p')";
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
                     "VALUES ('$mon_key_1','$mon_name', 'R','$mon_weap_r','$dam_r')";
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
            $name = "mon_weap_s_" . $count;
            $mon_weap = $$name;
            $dam_v = "dam_s_" . $count;
            $dam = $$dam_v;
            $mon_attp = "S" . $count;
            if ($mon_weap != "No Melee"){
               $insert = "INSERT INTO monweap2 (mon_key_1, monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                         "VALUES ('$mon_key_1','$mon_name', '$mon_attp','$mon_weap', '$dam')";
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
           $montreas = $$montreas_v;
           $montreas_mult = $$montreas_mult_v;
           if ($montreas != ""){
             $insert = "INSERT INTO montreas2 (mon_key_1, mon_name, montreas_tp, montreas_mult)" .
                       " VALUES ('$mon_key_1','$mon_name','$montreas','$montreas_mult')";
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
           $monorg = $$monorg_v;
           $monorg_min = $$monorg_min_v;
           $monorg_max = $$monorg_max_v;
           if ($monorg != ""){
             $insert = "INSERT INTO monorg2 (mon_key_1, mon_name, monorg_id, monorg_min, monorg_max)" .
                       " VALUES ('$mon_key_1','$mon_name','$monorg','$monorg_min', '$monorg_max')";
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
// Monter Language
         $count = 0;
         While ($count <6){
           $count = $count  + 1;
           $monlang_v = "monlang_". $count;
           $monlang = $$monlang_v;
           if ($monlang != ""){
             $insert = "INSERT INTO monlang2 (mon_key_1, mon_name, monlang_id)" .
                       " VALUES ('$mon_key_1','$mon_name','$monlang')";
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
// Monter HD Advancment
         $count = 0;
         While ($count <4){
           $count = $count  + 1;
           $monadv_size_v = "monadv_size_". $count;
           $monadv_size = $$monadv_size_v;
           $monadv_min_v = "monadv_min_". $count;
           $monadv_min = $$monadv_min_v;
           $monadv_max_v = "monadv_max_". $count;
           $monadv_max = $$monadv_max_v;
           if ($monadv_min != ""){
             $insert = "INSERT INTO monadv2 (mon_key_1, mon_name, monadv_min_hd, monadv_max_hd, monadv_size)" .
                       " VALUES ('$mon_key_1','$mon_name','$monadv_min','$monadv_max','$monadv_size')";
           $result = mysqli_query($link, $insert);
               if (!$result) {
                  $msg = "$result" ." Error inserting monlang";
               }else{
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

//echo <<<EOF
//<STYLE>
//table {
//	border: 1px black solid;
//       background-color: $background_blue;
//
//
//h {
//	border: 1px black solid;
//        background-color: $background_blue;
//        color: Black;
//}


//</STYLE>
//EOF;
//td {
//	border: 1px black solid;
//        color: black;
//        background-color: $background_grey;
//}
//th {
//	border: 1px black solid;
//        background-color: $background_blue;
//        color: black;
//}
?>
<FORM METHOD="post" ACTION="<?php echo $ddpost; ?>">
<?php
$link = getDBLink();
//include 'includes/dd_menu.txt' ;
if (!isset($mon_name)){
   $mon_name = "";
}
if (!isset($mon_size)){
   $mon_size = "";
}
if (!isset($mon_type)){
   $mon_type = "";
}
if (!isset($mon_hd)){
   $mon_hd = "";
}
if (!isset($mon_speed)){
   $mon_speed = "";
}
if (!isset($mon_speed_fly)){
   $mon_speed_fly = "";
}
if (!isset($mon_speed_climb)){
   $mon_speed_climb = "";
}
if (!isset($mon_speed_swim)){
   $mon_speed_swim = "";
}
if (!isset($mon_speed_burrow)){
   $mon_speed_burrow = "";
}
if (!isset($mon_nat_ac)){
   $mon_nat_ac = "";
}
if (!isset($mon_armour)){
   $mon_armour = "";
}
if (!isset($mon_shield)){
   $mon_shield = "";
}
if (!isset($mon_weap_p)){
   $mon_weap_p = "";
}
?>
<BODY>
<h2>Add Monster</h2>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Name</TH>
  <TH>Size</TH>
  <TH>Type</TH>
  <TH>Hit Die (include die and ignore bonus e.g 4d10)</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="mon_name" VALUE="<?php echo $mon_name ?>"/></TD>
  <TD><SELECT NAME="mon_size" VALUE="<?php echo $mon_size ?>">
<?php
$select = "SELECT size_cat FROM size order by size_ac_mod desc" ;
//include 'includes/dd_db_conn.txt';
$link = getDBLink();
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
<TD><SELECT NAME="mon_type">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "select montype from montype ".
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
   <TD><INPUT TYPE="text" NAME="mon_hd" VALUE="<?php echo $mon_hd ?>"/></TD>

</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
   <TH>Base Speed Land</TH>
   <TH>Speed Fly</TH>
   <TH>Speed Climb</TH>

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
<TR>
  <TH>Natural AC Bonus</TH>
</TR>
<TR>
   <TD><INPUT TYPE="text" NAME="mon_nat_ac" VALUE="<?php echo $mon_nat_ac ?>"/></TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
  <TH>Armour</TH>
  <TH>Shield</TH>
</TR>
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
</TD>
  <TD><SELECT NAME="dam_p">
<?php
if (!isset($dam_p)){
   $dam_p = "";
}
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
if (!isset($mon_weap_r)){
   $mon_weap_r = "";
}
?>
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
</TD>
<TD><SELECT NAME="dam_r">
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
  $name = "mon_weap_s_" . $count;
  $dam_v = "dam_s_" . $count;
  if (!isset($$dam_v)){
   $$dam_v = "";
  }
  $dam   = $$dam_v;
  if (!isset($$name)){
   $$name = "";
  }
  $mon_weap_s = $$name;

echo <<<EOF
    <TR>
    <TD><SELECT NAME="$name" VALUE="<?php echo $mon_weap_s ?>">
EOF;

//  include 'includes/dd_db_conn.txt' ;
  $link = getDBLink();
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
echo "</TR>";
}
?>
</TABLE>
<BR></BR>
<TABLE>
<TR>
  <TH>Space</TH>
  <TH>Reach</TH>
</TR>
<TR>
<TD><SELECT NAME="mon_space">
<?php
if (!isset($mon_space)){
   $mon_space = "5";
}
$sel_0 = $sel_half = $sel_1 = $sel_2 = $sel_5 = $sel_10 = $sel_15 = $sel_20 = $sel_25 =  $sel_30 = $sel_35 = $sel_40 = $sel_45 = $sel_50 = "";
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
<TD><SELECT NAME="mon_reach">
<?php
$sel_0 = $sel_half = $sel_1 = $sel_2 = $sel_5 = $sel_10 = $sel_15 = $sel_20 = $sel_25 = $sel_30 =  $sel_40 = $sel_45 = $sel_50 = "";
if (!isset($mon_reach)){
   $mon_reach = "5";
}
$var = "sel_" . $mon_reach;
if (!isset($$var)){
    $$var = "";
}
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
</TABLE>
<BR></BR>
<TABLE class ="SpecialaTable">
<TR>
    <TH class="thbig" >Special Attacks</TH>
    <TH class="thsmall" >Value</TH>
    <TH class="thsmall">Min HD</TH>
    <TH class="thsmall">Max HD</TH>
</TR>
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
// special attacks
$count = 0;
while ($count < 16){
  $count = $count + 1;
   $specav = "speca_" . $count;
   if (!isset($$specav)){
      $$specav  = "";
   }
   $speca  = $$specav;
   echo "<TR>";
echo <<<EOF
   <TD class="thbig"><SELECT NAME='$specav'>
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
  if (!isset($$speca_valuev)){
      $$speca_valuev  = "";
   }
  $speca_value = $$speca_valuev;
  $speca_minv = "speca_min_" . $count;
  if (!isset($$speca_minv)){
      $$speca_minv  = "";
   }
  $speca_min = $$speca_minv;
  $speca_maxv = "speca_max_" . $count;
  if (!isset($$speca_maxv)){
      $$speca_maxv  = "";
   }
  $speca_max = $$speca_maxv;
echo <<<EOF
  <TD class="thsmall"><INPUT TYPE='text' NAME='$speca_valuev' VALUE='$speca_value'></TD>
  <TD class="thsmall"><INPUT TYPE='text' NAME='$speca_minv' VALUE='$speca_min'></TD>
  <TD class="thsmall"><INPUT TYPE='text' NAME='$speca_maxv' VALUE='$speca_max'></TD>
EOF;

  echo "</TR>";
}
echo "</TABLE>";
?>
<BR></BR>
<BR></BR>
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
while ($count < 16){
  $count = $count + 1;
   $specqv = "specq_" . $count;
   if (!isset($$specqv)){
      $$specqv  = "";
   }
   $specq  = $$specqv;
   echo "<TR>";
echo <<<EOF
   <TD><SELECT NAME='$specqv'>
EOF;

   $select = "SELECT specq_name FROM specqual order by specq_name" ;
   echo $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  $sel = "";
  while ($row = mysqli_fetch_array($result)) {
    $specq_sel = $row['specq_name'] ;
    echo "</BR> specq_sel " . $specq_sel;
      if ($specq_sel == $specq)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
    <OPTION VALUE="$specq_sel" $sel > $specq_sel </OPTION>
EOF;
  }
  echo "</SELECT>";
  echo "</TD>";
  $specq_valuev = "specq_value_" . $count;
  if (!isset($$specq_valuev)){
      $$specq_valuev  = "";
  }
  $specq_value = $$specq_valuev;
  $specq_minv = "specq_min_" . $count;
  if (!isset($$specq_minv)){
      $$specq_minv  = "";
  }
  $specq_min = $$specq_minv;
  $specq_maxv = "specq_max_" . $count;
  if (!isset($$specq_maxv)){
      $$specq_maxv  = "";
  }
  $specq_max = $$specq_maxv;

echo <<<EOF
  <TD><INPUT TYPE='text' NAME='$specq_valuev' VALUE='$specq_value'></TD>
  <TD><INPUT TYPE='text' NAME='$specq_minv' VALUE='$specq_min'></TD>
  <TD><INPUT TYPE='text' NAME='$specq_maxv' VALUE='$specq_max'></TD>
EOF;

  echo "</TR>";
}
echo "</TABLE>";
if (!isset($mon_sv_fort)){
      $mon_sv_fort  = "";
}
if (!isset($mon_sv_reflex)){
      $mon_sv_reflex  = "";
}
if (!isset($mon_sv_will)){
      $mon_sv_will  = "";
}
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
EOF;

if (!isset($mon_str)){
      $mon_str  = "";
}
if (!isset($mon_dex)){
      $mon_dex  = "";
}
if (!isset($mon_com)){
      $mon_con  = "";
}
if (!isset($mon_int)){
      $mon_int  = "";
}
if (!isset($mon_wis)){
      $mon_wis  = "";
}
if (!isset($mon_chr)){
      $mon_chr  = "";
}
?>
</TR>
</TABLE>
<BR></BR>
<TABLE>
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
$sel_Y = "";
$sel_N = "";
if (!isset($mon_skill_rule)){
      $mon_skill_rule  = "";
}
IF ($mon_skill_rule == ""){
   $mon_skill_rule = "TYPE";
}

if ($mon_skill_rule == "TYPE"){
    $sel_N = " SELECTED";
}else{
    $sel_Y = " SELECTED";
}
echo <<<EOF
</TR>
</TABLE>
<BR></BR>
</BR>
<TABLE>
<TH>All Monster Skill are class skills?</TH>
<TD><SELECT NAME="mon_skill_rule">
     <OPTION VALUE="ALL" $sel_Y > Yes, all skills are class skills</OPTION>
     <OPTION VALUE="TYPE" $sel_N > No, only the skills under monster type are class skills</OPTION>
     </SELECT>
</TD>
</TABLE>
EOF;

$sel_all = "";
$sel_rank = "";
if (!isset($mon_skill_all)){
      $mon_skill_all  = "";
}
IF ($mon_skill_all == ""){
   $mon_skill_all = "ALL";
}

//echo "skill " . $mon_skill_all;
if ($mon_skill_all == "RANK"){
    $sel_rank = " SELECTED";
}else{
    $sel_all = " SELECTED";
}
echo <<<EOF
<TABLE>
<TH>Calculated Skill include any atribute bonus (i.e enter as you see them in the monster manual) or just skill ranks</TH>
<TD><SELECT NAME="mon_skill_all">
     <OPTION VALUE="ALL" $sel_all >  Calculated Skills</OPTION>
     <OPTION VALUE="RANK" $sel_rank > Skill Ranks</OPTION>
     </SELECT>
</TD>
</TABLE>
</BR>
EOF;
if (!isset($skill_points)){
      $skill_points  = 0;
}
if ($skill_points > 0){
   echo "<BR></BR>Total skill points to spend = $skill_points. Skill points spent = $skill_total.";
}
?>
<BR></BR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
<?php
echo <<<EOF
  <TH>Skill</TH>
  <TH>Rank</TH>
  <TH>Skill</TH>
  <TH>Rank</TH>
EOF;
$count1 = 0;
while ($count1 < 15){
  echo "</TR> <TR>";
  $count2 = 0;
  while ($count2 < 2){
    $count2 = $count2 + 1;
    $sub = ($count1 * 2) + $count2;
    $link = getDBLink();
//    include 'includes/dd_db_conn.txt' ;

    $name = "monskill_tp_" . $sub;
    if (!isset($$name)){
      $$name  = "";
    }
    $value = "monskill_val_" . $sub;
    if (!isset($$value)){
      $$value  = "";
    }
    $mon_skill_val = $$value;
    $mon_skill = $$name;

echo <<<EOF
    <TD><SELECT NAME="$name" VALUE="<?php echo $mon_skill ?>">
EOF;

   $select = "SELECT skill_cd FROM skills where skill_dd35 = 'Y' order by skill_cd" ;

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
</TR>
</TABLE>

<BR></BR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
<?php
echo <<<EOF
<H3>Monster Race Bonus Skills</H3>
</BR>
Leave the text field blank if there is no condition on the skill bonus. A condition for hide may be "in snow".
</BR>
  <TH>Skill</TH>
  <TH>Text</TH>
  <TH>Rank</TH>

EOF;
$count1 = 0;
while ($count1 < 5){
  echo "</TR> <TR>";
  $count1 += 1;
  $sub = ($count1);
  $link = getDBLink();
//    include 'includes/dd_db_conn.txt' ;

   $name = "monskillrb_tp_" . $sub;
   if (!isset($$name)){
      $$name  = "";
    }
   $value = "monskillrb_val_" . $sub;
   if (!isset($$value)){
      $$value  = "";
    }
   $text =  "monskillrb_text_" . $sub;
   if (!isset($$text)){
      $$text  = "";
    }
   $mon_skill_val = $$value;
   $mon_skillrb = $$name;
   $mon_skill_text = $$text;

echo <<<EOF
    <TD><SELECT NAME="$name">
EOF;

   $select = "SELECT skill_cd FROM skills where skill_dd35 = 'Y' order by skill_cd" ;

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


EOF;
}
mysqli_close($link);
?>
</TR>
</TABLE>





<BR></BR>
<TABLE BORDER="1" CELLPADDING="1" style="width:100%">
<TR>
<TH style="width:20%">Monster Feats</TH>
<TH style="width:8%">Free?</TH>
<TH style="width:20%">Monster Feats</TH>
<TH style="width:58%">Free?</TH>
<TH style="width:20%">Monster Feats</TH>
<TH style="width:8%"> Free?</TH>
</TR>

<TR>
<?php
// FEATS
$count  = 0 ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
While ($count < 18) {
  $count = $count + 1;
  $name = "mon_feat_" . $count;
  if (!isset($$name)){
      $$name  = "";
    }
  $mon_feat = $$name;
  $free_v = "mon_feat_free_" . $count;
  if (!isset($$free_v)){
      $$free_v  = "";
    }
  $free = $$free_v;
  if ($count == 4 or $count == 7 or $count == 10 or $count == 13 or $count == 16){
     echo "</TR><TR>";
  }
echo <<<EOF
    <TD><SELECT NAME="$name">
EOF;

  $select = "SELECT feat_name FROM feats2 where mon_key_1 = 'dd35' order by feat_name" ;
 
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
</TR>
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
 //   if ($terain_sel == $mon_environment){
//	$sel = " SELECTED" ;
//    } else {
//	$sel = "" ;
//    }
//    if ($terain_sel != ""){
//       $html .= '<OPTION VALUE="'.$terain_sel.'" '.$sel.' >'.$terain_sel.'</OPTION>';
 //   }
//}
//mysqli_close($link);

//$html .= '</SELECT></TD>';
//echo $html;
if (!isset($mon_environmant)){
      $mon_environment  = "";
}
if (!isset($mon_cr)){
      $mon_cr  = "";
}
if (!isset($mon_template)){
      $mon_template  = "";
}
?>
<TH>Terain</TH>
<TD><INPUT TYPE="text" NAME="mon_environment" VALUE="<?php echo $mon_environment ?>"/></TD>
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
  if (!isset($$name)){
      $$name  = "";
    }
  $montreas = $$name;
  $montreas_mult_v = "montreas_mult_" . $count;
  if (!isset($$montreas_mult_v)){
      $$montreas_mult_v  = "";
    }
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
</TR>
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
  if (!isset($$monorg_v)){
      $$monorg_v  = "";
  }
  $monorg = $$monorg_v;
  $monorg_min_v = "monorg_min_" . $count;
  if (!isset($$monorg_min_v)){
      $$monorg_min_v = "";
  }
  $monorg_min = $$monorg_min_v;
  $monorg_max_v = "monorg_max_" . $count;
  if (!isset($$monorg_max_v)){
      $$monorg_max_v = "";
  }
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
  if (!isset($$monadv_size_v)){
      $$monadv_size_v = "";
  }
  $monadv_size = $$monadv_size_v;
  $monadv_min_v = "monadv_min_" . $count;
  if (!isset($$monadv_min_v)){
      $$monadv_min_v = "";
  }
  $monadv_min = $$monadv_min_v;
  $monadv_max_v = "monadv_max_" . $count;
  if (!isset($$monadv_max_v)){
      $$monadv_max_v = "";
  }
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
if (!isset($mon_alignment)){
      $mon_alignment = "";
}
if (!isset($mon_level_adj)){
      $mon_level_adj = "";
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
  if ($count == 3){
     echo "</TR><TR>";
  }
  $count = $count +1;
  $monlang_v = "monlang_" . $count;
  if (!isset($$monlang_v)){
      $$monlang_v = "";
}
  $monlang = $$monlang_v;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$monlang_v" VALUE="$monlang"/></TD>
EOF;
}
if (!isset($mon_magic_use)){
      $mon_magic_use = "";
}
?>
</TR>  
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Monster Magic Use</TH>
<TD><SELECT NAME="mon_magic_use" VALUE="<?php echo $mon_magic_use ?>">
<?php
$sel_v = "sel_" . $mon_magic_use;
if ($sel_v == "sel_"){
  $sel_v = "sel_";
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
if (!isset($mon_desc)){
      $mon_desc = "";
}
?>
</TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
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
<BR></BR>
  <INPUT TYPE="submit" VALUE="Create Monster" style="height: 70px; width: 200px"/>
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>
</BODY>
=======
<?php
echo "wp_user = $wp_user";
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$ddpost = $url . $domain;
/*
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
}
*/
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<?php
$mon_key_1 = $wp_user;
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = str_replace("\'", "", $v);
       $v = str_replace('\"', "", $v);
       $v = str_replace("'", "", $v);
       $v = str_replace('"', "", $v);
       $v = str_replace('+', "", $v);
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
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
            $msg = "Natural AC must be numeric";
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
       $beg = substr($k,0,7);
       $beg2 = substr($k,0,3);
       if ($v == "" and $beg != "mon_fea" and $beg != "monskil" and $beg !="mon_spe"and $beg2 != "dam" and $beg2 != "spe" and $k != "mon_template"
            and $beg !="monlang" and $beg != "monorg_" and $beg != "montrea"  and $beg != "monadv_"){
          $msg = "please fill in all fields";
           echo $k;
       }

   }
   $select = "Select count(*) from monster2 where mon_name = '$mon_name' and (mon_key_1 = 'dd35' or mon_key_1 = '$wp_user')";
   $link = getDBLink();
   $result = mysqli_query($link, $select);
   if ($result){
      $row = mysqli_fetch_array($result);
      $mon_count = $row[0];
      if ($mon_count > 0){
         $msg = "This monster already exists, change the name if you want to create a new version";
      }
   }
   if ($mon_type !=""){
     $select = "select montype_hd, montype_skillp from montype where montype = '$mon_type'";
     $result = mysqli_query($link, $select);
     $row = mysqli_fetch_array($result);
     $montype_hd = $row['montype_hd'];
     $montype_skillp = $row['montype_skillp'];
   }
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
//      echo $atr_pluss . ":" . $montype_skillp . ":" . $mon_hitdie;
      $skillp = $montype_skillp + $atr_pluss;
      if ($skillp < 1){
        $skillp = 1;
      }
      $skill_points = $skillp * ( $mon_hitdie + 3 ) ;
   }
   if ($msg == "") {
      $mon_full_att =" ";
      $mon_ac = " ";
      $mon_hp =" ";
      $mon_init  = " ";
      $mon_ac_flat = 10 + $mon_nat_ac;
      $mon_base_att = " ";
      $mon_delete = "";
      $insert  = "INSERT INTO monster2 (mon_key_1, mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed, mon_speed_fly, mon_speed_swim, mon_speed_burrow, mon_speed_climb," .
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, mon_user, mon_nochange, mon_template, mon_alignment, mon_environment, mon_level_adj, mon_magic_use, mon_delete) " .
           "VALUES ( '$mon_key_1','$mon_name' ,'$mon_size' , '$mon_type' ,'$mon_hd' ,'$mon_hp' ,".
                 "'$mon_init' ,'$mon_speed', '$mon_speed_fly', '$mon_speed_swim', '$mon_speed_burrow','$mon_speed_climb',".
                     "'$mon_ac_flat' , '$mon_ac' ,".
                     "'$mon_base_att' ,'$mon_full_att' ,'$mon_space' ,'$mon_reach' ,".
                     "'$mon_cr' ,'$mon_str' ,'$mon_dex' ,'$mon_con' ,'$mon_int' ,".
                     "'$mon_wis' ,'$mon_chr' ,'$mon_desc','$mon_sv_fort',".
                     "'$mon_sv_reflex',  '$mon_sv_will','$mon_armour', '$mon_shield','$user_id', 'N', '$mon_template'," .
                     "'$mon_alignment','$mon_environment', '$mon_level_adj', '$mon_magic_use', '$mon_delete')";

//    echo $insert . "</BR>;
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
            $spec_name = $$specv;
            $valuev = "specq_value_" . $count;
            $value  = $$valuev;
            $minv = "specq_min_" . $count;
            $min  = $$minv;
            $maxv = "specq_max_" . $count;
            $max  = $$maxv;
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1,mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$mon_key_1','$mon_name', 'S', '$spec_name', '$value','$min','$max')";
//            echo "</BR> $insert ";
               $result = mysqli_query($link, $insert);
            }
          }
          //insert Special attacks
          $count = 0;
          while ($count < 16){
            $count = $count + 1;
            $specv =  "speca_" . $count ;
            $spec_name = $$specv;
            $valuev = "speca_value_" . $count;
            $value  = $$valuev;
            $minv = "speca_min_" . $count;
            $min  = $$minv;
            $maxv = "speca_max_" . $count;
            $max  = $$maxv;
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1,mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$mon_key_1','$mon_name', 'A', '$spec_name', '$value', '$min', '$max')";
//          echo "</BR> $insert ";
               $result = mysqli_query($link, $insert);

            }
          }




//insert feats
         $count = 0;
         while ($count < 16){
           $count = $count + 1;
           $name = "mon_feat_" . $count;
           $feat_val = $$name;
           $free_v = "mon_feat_free_" . $count;
           $free = $$free_v;

           if ($feat_val != ""){
              $insert = "INSERT INTO monfeat2 (mon_key_1, mon_name , monfeat, monfeat_free)".
                        "VALUES ('$mon_key_1','$mon_name', '$feat_val','$free')";
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
         while ($count < 30){
//find the skill atribute and take off the skill value

           $count = $count + 1;
           $name = "monskill_tp_" . $count;
           $value = "monskill_val_" . $count;
           $mon_skill_val = $$value;
           $mon_skill_val_rank = $mon_skill_val;
           $mon_skill = $$name;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skill != ""){
              $select = "SELECT skill_cd, skill_atr, skill_armour_ch from skills ".
                      "WHERE skill_cd = '$mon_skill'";
//              echo $select;
              $result = mysqli_query($link, $select);
              $row = mysqli_fetch_array($result);
              $armour_ch = $row['skill_armour_ch'];
              $skill_atr = $row['skill_atr'];
//              echo "skill atr = " . $skill_atr;
              $lower = strtolower($skill_atr);
      //        echo $lower;
              $field = "mon_" . $lower;
//              echo "</BR>";
      //        echo "mon_str = " . $mon_str;
              $atr_val = $$field;
      //        echo  "field " . $field . " value " . $atr_val . " ***";
              $atr_pluss = (($atr_val - 10) / 2) -0.49;
              $atr_pluss = round($atr_pluss,0);
              $mon_skill_val = $mon_skill_val - $atr_pluss;
//  find if any feats have been included for the skill
              $select = "select featattr_no from featattr2, monfeat2 where ".
                        "mon_name = '$mon_name' and featattr_type = 'SKILL' and ".
                        "featattr_id = '$mon_skill' and featattr_feat = monfeat and monfeat2.mon_key_1 = 'dd35' ".
                        "and featattr2.mon_key_1 = 'dd35'  ";
              $result = mysqli_query($link, $select);
              if ($result){
                  $row = mysqli_fetch_array($result);
                  $featattr_no = $row['featattr_no'];
                  $mon_skill_val = $mon_skill_val - $featattr_no;
              }
              $select = "select armour_cd, armour_tp, armour_bonus, armour_dex, armour_check, armour_spell, armour_s30,".
             "armour_s20,armour_wt from armour where armour_tp = '$mon_armour' or armour_tp = '$mon_shield'" .
             "order by armour_cd";
// echo "</BR> " . $select;
              $result = mysqli_query($link, $select);
              $count3 = 0;
              if (mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_array($result)){
                    $count3 = $count3 + 1;
                    if ($count3 == 1){
                      $armour_bonus = $row['armour_bonus'];
                       $armour_dex =   $row['armour_dex'];
                       $armour_check = $row['armour_check'];
                       $armour_spell = $row['armour_spell'];
                       $armour_s30   = $row['armour_s30'];
                       $armour_s20   = $row['armour_s20'];
                       $armour_wt    = $row['armour_wt'];
                   }else{
                      $shield_bonus = $row['armour_bonus'];
                      $shield_dex =   $row['armour_dex'];
                      $shield_check = $row['armour_check'];
                      $shield_spell = $row['armour_spell'];
                      $shield_s30   = $row['armour_s30'];
                      $shield_s20   = $row['armour_s20'];
                      $shield_wt    = $row['armour_wt'];
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
              $armour_bon = 0;
              if ($armour_ch == "Y"){
                    $armour_bon = $armour_check + $shield_check;
              }
              if ($armour_ch == "2"){
                 $armour_bon = ($armour_check + $shield_check) * 2;
              }
//              echo "</BR> armour ch $armour_ch";
//              echo "</BR> armour bon $armour_bon";
//              echo "</BR> armour_check $armout_check";
              $mon_skill_val = $mon_skill_val - $armour_bon;
              if ($mon_skill == "Hide"){
                 $select_size = "select size_ac_mod, size_grapple, size_hide, size_sq, size_reach_t, size_reach_l from size ".
                 "where size_cat = '$mon_size'";
                 $result_size = mysqli_query($link, $select_size);
                 if (mysqli_num_rows($result_size) > 0){
                    $row_size = mysqli_fetch_array($result_size);
                    $size_hide      = $row_size['size_hide'];
                    $mon_skill_val = $mon_skill_val - $size_hide;
                 }
              }
              $select = "SELECT monskillrb_val from monskillrb where mon_key_1 = '$wp_user' and mon_name = '$mon_name' and monskillrb_tp = '$mon_skill' and monskillrb_text = ''";
              $result_skillrb = mysqli_query($link, $select);
              if (mysqli_num_rows($result_skillrb) > 0){
                $row_skillrb = mysqli_fetch_array($result_skillrb);
                $mon_skill_val = $mon_skill_val - $row_skillrb['monskillrb_val'];
              }
// reset to original value if rank selected
              if ($mon_skill_all == "RANK"){
                  $mon_skill_val = $mon_skill_val_rank;
      //            echo $mon_skill . $mon_skill_val_rank;
              }
              $insert = "INSERT INTO monskill2 (mon_key_1, mon_name, monskill_tp , monskill_val)".
                        "VALUES ('$mon_key_1','$mon_name', '$mon_skill', '$mon_skill_val')";
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
           $mon_skillrb_val = $$value;
           $mon_skillrb_tp = $$skill;
           $mon_skillrb_text = $$text;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skillrb_tp != ""){
              $insert = "INSERT INTO monskillrb (mon_key_1, mon_name, monskillrb_tp , monskillrb_val, monskillrb_text)".
                        "VALUES ('$wp_user','$mon_name', '$mon_skillrb_tp', '$mon_skillrb_val', '$mon_skillrb_text')";
        //      echo $insert;
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
         $insert = "INSERT INTO monweap2 (mon_key_1, monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                   "VALUES ('$mon_key_1','$mon_name', 'P','$mon_weap_p', '$dam_p')";
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
                     "VALUES ('$mon_key_1','$mon_name', 'R','$mon_weap_r','$dam_r')";
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
            $name = "mon_weap_s_" . $count;
            $mon_weap = $$name;
            $dam_v = "dam_s_" . $count;
            $dam = $$dam_v;
            $mon_attp = "S" . $count;
            if ($mon_weap != "No Melee"){
               $insert = "INSERT INTO monweap2 (mon_key_1, monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                         "VALUES ('$mon_key_1','$mon_name', '$mon_attp','$mon_weap', '$dam')";
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
           $montreas = $$montreas_v;
           $montreas_mult = $$montreas_mult_v;
           if ($montreas != ""){
             $insert = "INSERT INTO montreas2 (mon_key_1, mon_name, montreas_tp, montreas_mult)" .
                       " VALUES ('$mon_key_1','$mon_name','$montreas','$montreas_mult')";
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
           $monorg = $$monorg_v;
           $monorg_min = $$monorg_min_v;
           $monorg_max = $$monorg_max_v;
           if ($monorg != ""){
             $insert = "INSERT INTO monorg2 (mon_key_1, mon_name, monorg_id, monorg_min, monorg_max)" .
                       " VALUES ('$mon_key_1','$mon_name','$monorg','$monorg_min', '$monorg_max')";
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
// Monter Language
         $count = 0;
         While ($count <6){
           $count = $count  + 1;
           $monlang_v = "monlang_". $count;
           $monlang = $$monlang_v;
           if ($monlang != ""){
             $insert = "INSERT INTO monlang2 (mon_key_1, mon_name, monlang_id)" .
                       " VALUES ('$mon_key_1','$mon_name','$monlang')";
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
// Monter HD Advancment
         $count = 0;
         While ($count <4){
           $count = $count  + 1;
           $monadv_size_v = "monadv_size_". $count;
           $monadv_size = $$monadv_size_v;
           $monadv_min_v = "monadv_min_". $count;
           $monadv_min = $$monadv_min_v;
           $monadv_max_v = "monadv_max_". $count;
           $monadv_max = $$monadv_max_v;
           if ($monadv_min != ""){
             $insert = "INSERT INTO monadv2 (mon_key_1, mon_name, monadv_min_hd, monadv_max_hd, monadv_size)" .
                       " VALUES ('$mon_key_1','$mon_name','$monadv_min','$monadv_max','$monadv_size')";
           $result = mysqli_query($link, $insert);
               if (!$result) {
                  $msg = "$result" ." Error inserting monlang";
               }else{
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

//echo <<<EOF
//<STYLE>
//table {
//	border: 1px black solid;
//       background-color: $background_blue;
//
//
//h {
//	border: 1px black solid;
//        background-color: $background_blue;
//        color: Black;
//}


//</STYLE>
//EOF;
//td {
//	border: 1px black solid;
//        color: black;
//        background-color: $background_grey;
//}
//th {
//	border: 1px black solid;
//        background-color: $background_blue;
//        color: black;
//}
?>
<FORM METHOD="post" ACTION="<?php echo $ddpost; ?>">
<?php
$link = getDBLink();
//include 'includes/dd_menu.txt' ;
if (!isset($mon_name)){
   $mon_name = "";
}
if (!isset($mon_size)){
   $mon_size = "";
}
if (!isset($mon_type)){
   $mon_type = "";
}
if (!isset($mon_hd)){
   $mon_hd = "";
}
if (!isset($mon_speed)){
   $mon_speed = "";
}
if (!isset($mon_speed_fly)){
   $mon_speed_fly = "";
}
if (!isset($mon_speed_climb)){
   $mon_speed_climb = "";
}
if (!isset($mon_speed_swim)){
   $mon_speed_swim = "";
}
if (!isset($mon_speed_burrow)){
   $mon_speed_burrow = "";
}
if (!isset($mon_nat_ac)){
   $mon_nat_ac = "";
}
if (!isset($mon_armour)){
   $mon_armour = "";
}
if (!isset($mon_shield)){
   $mon_shield = "";
}
if (!isset($mon_weap_p)){
   $mon_weap_p = "";
}
?>
<BODY>
<h2>Add Monster</h2>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Name</TH>
  <TH>Size</TH>
  <TH>Type</TH>
  <TH>Hit Die (include die and ignore bonus e.g 4d10)</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="mon_name" VALUE="<?php echo $mon_name ?>"/></TD>
  <TD><SELECT NAME="mon_size" VALUE="<?php echo $mon_size ?>">
<?php
$select = "SELECT size_cat FROM size order by size_ac_mod desc" ;
//include 'includes/dd_db_conn.txt';
$link = getDBLink();
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
<TD><SELECT NAME="mon_type">
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "select montype from montype ".
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
   <TD><INPUT TYPE="text" NAME="mon_hd" VALUE="<?php echo $mon_hd ?>"/></TD>

</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
   <TH>Base Speed Land</TH>
   <TH>Speed Fly</TH>
   <TH>Speed Climb</TH>

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
<TR>
  <TH>Natural AC Bonus</TH>
</TR>
<TR>
   <TD><INPUT TYPE="text" NAME="mon_nat_ac" VALUE="<?php echo $mon_nat_ac ?>"/></TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
  <TH>Armour</TH>
  <TH>Shield</TH>
</TR>
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
</TD>
  <TD><SELECT NAME="dam_p">
<?php
if (!isset($dam_p)){
   $dam_p = "";
}
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
if (!isset($mon_weap_r)){
   $mon_weap_r = "";
}
?>
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
</TD>
<TD><SELECT NAME="dam_r">
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
  $name = "mon_weap_s_" . $count;
  $dam_v = "dam_s_" . $count;
  if (!isset($$dam_v)){
   $$dam_v = "";
  }
  $dam   = $$dam_v;
  if (!isset($$name)){
   $$name = "";
  }
  $mon_weap_s = $$name;

echo <<<EOF
    <TR>
    <TD><SELECT NAME="$name" VALUE="<?php echo $mon_weap_s ?>">
EOF;

//  include 'includes/dd_db_conn.txt' ;
  $link = getDBLink();
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
echo "</TR>";
}
?>
</TABLE>
<BR></BR>
<TABLE>
<TR>
  <TH>Space</TH>
  <TH>Reach</TH>
</TR>
<TR>
<TD><SELECT NAME="mon_space">
<?php
if (!isset($mon_space)){
   $mon_space = "5";
}
$sel_0 = $sel_half = $sel_1 = $sel_2 = $sel_5 = $sel_10 = $sel_15 = $sel_20 = $sel_25 =  $sel_30 = $sel_35 = $sel_40 = $sel_45 = $sel_50 = "";
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
<TD><SELECT NAME="mon_reach">
<?php
$sel_0 = $sel_half = $sel_1 = $sel_2 = $sel_5 = $sel_10 = $sel_15 = $sel_20 = $sel_25 = $sel_30 =  $sel_40 = $sel_45 = $sel_50 = "";
if (!isset($mon_reach)){
   $mon_reach = "5";
}
$var = "sel_" . $mon_reach;
if (!isset($$var)){
    $$var = "";
}
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
</TABLE>
<BR></BR>
<TABLE class ="SpecialaTable">
<TR>
    <TH class="thbig" >Special Attacks</TH>
    <TH class="thsmall" >Value</TH>
    <TH class="thsmall">Min HD</TH>
    <TH class="thsmall">Max HD</TH>
</TR>
<?php
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
// special attacks
$count = 0;
while ($count < 16){
  $count = $count + 1;
   $specav = "speca_" . $count;
   if (!isset($$specav)){
      $$specav  = "";
   }
   $speca  = $$specav;
   echo "<TR>";
echo <<<EOF
   <TD class="thbig"><SELECT NAME='$specav'>
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
  if (!isset($$speca_valuev)){
      $$speca_valuev  = "";
   }
  $speca_value = $$speca_valuev;
  $speca_minv = "speca_min_" . $count;
  if (!isset($$speca_minv)){
      $$speca_minv  = "";
   }
  $speca_min = $$speca_minv;
  $speca_maxv = "speca_max_" . $count;
  if (!isset($$speca_maxv)){
      $$speca_maxv  = "";
   }
  $speca_max = $$speca_maxv;
echo <<<EOF
  <TD class="thsmall"><INPUT TYPE='text' NAME='$speca_valuev' VALUE='$speca_value'></TD>
  <TD class="thsmall"><INPUT TYPE='text' NAME='$speca_minv' VALUE='$speca_min'></TD>
  <TD class="thsmall"><INPUT TYPE='text' NAME='$speca_maxv' VALUE='$speca_max'></TD>
EOF;

  echo "</TR>";
}
echo "</TABLE>";
?>
<BR></BR>
<BR></BR>
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
while ($count < 16){
  $count = $count + 1;
   $specqv = "specq_" . $count;
   if (!isset($$specqv)){
      $$specqv  = "";
   }
   $specq  = $$specqv;
   echo "<TR>";
echo <<<EOF
   <TD><SELECT NAME='$specqv'>
EOF;

   $select = "SELECT specq_name FROM specqual order by specq_name" ;
   echo $select;
  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  $sel = "";
  while ($row = mysqli_fetch_array($result)) {
    $specq_sel = $row['specq_name'] ;
    echo "</BR> specq_sel " . $specq_sel;
      if ($specq_sel == $specq)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
             }

echo <<<EOF
    <OPTION VALUE="$specq_sel" $sel > $specq_sel </OPTION>
EOF;
  }
  echo "</SELECT>";
  echo "</TD>";
  $specq_valuev = "specq_value_" . $count;
  if (!isset($$specq_valuev)){
      $$specq_valuev  = "";
  }
  $specq_value = $$specq_valuev;
  $specq_minv = "specq_min_" . $count;
  if (!isset($$specq_minv)){
      $$specq_minv  = "";
  }
  $specq_min = $$specq_minv;
  $specq_maxv = "specq_max_" . $count;
  if (!isset($$specq_maxv)){
      $$specq_maxv  = "";
  }
  $specq_max = $$specq_maxv;

echo <<<EOF
  <TD><INPUT TYPE='text' NAME='$specq_valuev' VALUE='$specq_value'></TD>
  <TD><INPUT TYPE='text' NAME='$specq_minv' VALUE='$specq_min'></TD>
  <TD><INPUT TYPE='text' NAME='$specq_maxv' VALUE='$specq_max'></TD>
EOF;

  echo "</TR>";
}
echo "</TABLE>";
if (!isset($mon_sv_fort)){
      $mon_sv_fort  = "";
}
if (!isset($mon_sv_reflex)){
      $mon_sv_reflex  = "";
}
if (!isset($mon_sv_will)){
      $mon_sv_will  = "";
}
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
EOF;

if (!isset($mon_str)){
      $mon_str  = "";
}
if (!isset($mon_dex)){
      $mon_dex  = "";
}
if (!isset($mon_com)){
      $mon_con  = "";
}
if (!isset($mon_int)){
      $mon_int  = "";
}
if (!isset($mon_wis)){
      $mon_wis  = "";
}
if (!isset($mon_chr)){
      $mon_chr  = "";
}
?>
</TR>
</TABLE>
<BR></BR>
<TABLE>
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
$sel_Y = "";
$sel_N = "";
if (!isset($mon_skill_rule)){
      $mon_skill_rule  = "";
}
IF ($mon_skill_rule == ""){
   $mon_skill_rule = "TYPE";
}

if ($mon_skill_rule == "TYPE"){
    $sel_N = " SELECTED";
}else{
    $sel_Y = " SELECTED";
}
echo <<<EOF
</TR>
</TABLE>
<BR></BR>
</BR>
<TABLE>
<TH>All Monster Skill are class skills?</TH>
<TD><SELECT NAME="mon_skill_rule">
     <OPTION VALUE="ALL" $sel_Y > Yes, all skills are class skills</OPTION>
     <OPTION VALUE="TYPE" $sel_N > No, only the skills under monster type are class skills</OPTION>
     </SELECT>
</TD>
</TABLE>
EOF;

$sel_all = "";
$sel_rank = "";
if (!isset($mon_skill_all)){
      $mon_skill_all  = "";
}
IF ($mon_skill_all == ""){
   $mon_skill_all = "ALL";
}

//echo "skill " . $mon_skill_all;
if ($mon_skill_all == "RANK"){
    $sel_rank = " SELECTED";
}else{
    $sel_all = " SELECTED";
}
echo <<<EOF
<TABLE>
<TH>Calculated Skill include any atribute bonus (i.e enter as you see them in the monster manual) or just skill ranks</TH>
<TD><SELECT NAME="mon_skill_all">
     <OPTION VALUE="ALL" $sel_all >  Calculated Skills</OPTION>
     <OPTION VALUE="RANK" $sel_rank > Skill Ranks</OPTION>
     </SELECT>
</TD>
</TABLE>
</BR>
EOF;
if (!isset($skill_points)){
      $skill_points  = 0;
}
if ($skill_points > 0){
   echo "<BR></BR>Total skill points to spend = $skill_points. Skill points spent = $skill_total.";
}
?>
<BR></BR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
<?php
echo <<<EOF
  <TH>Skill</TH>
  <TH>Rank</TH>
  <TH>Skill</TH>
  <TH>Rank</TH>
EOF;
$count1 = 0;
while ($count1 < 15){
  echo "</TR> <TR>";
  $count2 = 0;
  while ($count2 < 2){
    $count2 = $count2 + 1;
    $sub = ($count1 * 2) + $count2;
    $link = getDBLink();
//    include 'includes/dd_db_conn.txt' ;

    $name = "monskill_tp_" . $sub;
    if (!isset($$name)){
      $$name  = "";
    }
    $value = "monskill_val_" . $sub;
    if (!isset($$value)){
      $$value  = "";
    }
    $mon_skill_val = $$value;
    $mon_skill = $$name;

echo <<<EOF
    <TD><SELECT NAME="$name" VALUE="<?php echo $mon_skill ?>">
EOF;

   $select = "SELECT skill_cd FROM skills where skill_dd35 = 'Y' order by skill_cd" ;

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
</TR>
</TABLE>

<BR></BR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
<?php
echo <<<EOF
<H3>Monster Race Bonus Skills</H3>
</BR>
Leave the text field blank if there is no condition on the skill bonus. A condition for hide may be "in snow".
</BR>
  <TH>Skill</TH>
  <TH>Text</TH>
  <TH>Rank</TH>

EOF;
$count1 = 0;
while ($count1 < 5){
  echo "</TR> <TR>";
  $count1 += 1;
  $sub = ($count1);
  $link = getDBLink();
//    include 'includes/dd_db_conn.txt' ;

   $name = "monskillrb_tp_" . $sub;
   if (!isset($$name)){
      $$name  = "";
    }
   $value = "monskillrb_val_" . $sub;
   if (!isset($$value)){
      $$value  = "";
    }
   $text =  "monskillrb_text_" . $sub;
   if (!isset($$text)){
      $$text  = "";
    }
   $mon_skill_val = $$value;
   $mon_skillrb = $$name;
   $mon_skill_text = $$text;

echo <<<EOF
    <TD><SELECT NAME="$name">
EOF;

   $select = "SELECT skill_cd FROM skills where skill_dd35 = 'Y' order by skill_cd" ;

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


EOF;
}
mysqli_close($link);
?>
</TR>
</TABLE>





<BR></BR>
<TABLE BORDER="1" CELLPADDING="1" style="width:100%">
<TR>
<TH style="width:20%">Monster Feats</TH>
<TH style="width:8%">Free?</TH>
<TH style="width:20%">Monster Feats</TH>
<TH style="width:58%">Free?</TH>
<TH style="width:20%">Monster Feats</TH>
<TH style="width:8%"> Free?</TH>
</TR>

<TR>
<?php
// FEATS
$count  = 0 ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
While ($count < 18) {
  $count = $count + 1;
  $name = "mon_feat_" . $count;
  if (!isset($$name)){
      $$name  = "";
    }
  $mon_feat = $$name;
  $free_v = "mon_feat_free_" . $count;
  if (!isset($$free_v)){
      $$free_v  = "";
    }
  $free = $$free_v;
  if ($count == 4 or $count == 7 or $count == 10 or $count == 13 or $count == 16){
     echo "</TR><TR>";
  }
echo <<<EOF
    <TD><SELECT NAME="$name">
EOF;

  $select = "SELECT feat_name FROM feats2 where mon_key_1 = 'dd35' order by feat_name" ;
 
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
</TR>
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
 //   if ($terain_sel == $mon_environment){
//	$sel = " SELECTED" ;
//    } else {
//	$sel = "" ;
//    }
//    if ($terain_sel != ""){
//       $html .= '<OPTION VALUE="'.$terain_sel.'" '.$sel.' >'.$terain_sel.'</OPTION>';
 //   }
//}
//mysqli_close($link);

//$html .= '</SELECT></TD>';
//echo $html;
if (!isset($mon_environmant)){
      $mon_environment  = "";
}
if (!isset($mon_cr)){
      $mon_cr  = "";
}
if (!isset($mon_template)){
      $mon_template  = "";
}
?>
<TH>Terain</TH>
<TD><INPUT TYPE="text" NAME="mon_environment" VALUE="<?php echo $mon_environment ?>"/></TD>
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
  if (!isset($$name)){
      $$name  = "";
    }
  $montreas = $$name;
  $montreas_mult_v = "montreas_mult_" . $count;
  if (!isset($$montreas_mult_v)){
      $$montreas_mult_v  = "";
    }
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
</TR>
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
  if (!isset($$monorg_v)){
      $$monorg_v  = "";
  }
  $monorg = $$monorg_v;
  $monorg_min_v = "monorg_min_" . $count;
  if (!isset($$monorg_min_v)){
      $$monorg_min_v = "";
  }
  $monorg_min = $$monorg_min_v;
  $monorg_max_v = "monorg_max_" . $count;
  if (!isset($$monorg_max_v)){
      $$monorg_max_v = "";
  }
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
  if (!isset($$monadv_size_v)){
      $$monadv_size_v = "";
  }
  $monadv_size = $$monadv_size_v;
  $monadv_min_v = "monadv_min_" . $count;
  if (!isset($$monadv_min_v)){
      $$monadv_min_v = "";
  }
  $monadv_min = $$monadv_min_v;
  $monadv_max_v = "monadv_max_" . $count;
  if (!isset($$monadv_max_v)){
      $$monadv_max_v = "";
  }
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
if (!isset($mon_alignment)){
      $mon_alignment = "";
}
if (!isset($mon_level_adj)){
      $mon_level_adj = "";
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
  if ($count == 3){
     echo "</TR><TR>";
  }
  $count = $count +1;
  $monlang_v = "monlang_" . $count;
  if (!isset($$monlang_v)){
      $$monlang_v = "";
}
  $monlang = $$monlang_v;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$monlang_v" VALUE="$monlang"/></TD>
EOF;
}
if (!isset($mon_magic_use)){
      $mon_magic_use = "";
}
?>
</TR>  
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Monster Magic Use</TH>
<TD><SELECT NAME="mon_magic_use" VALUE="<?php echo $mon_magic_use ?>">
<?php
$sel_v = "sel_" . $mon_magic_use;
if ($sel_v == "sel_"){
  $sel_v = "sel_";
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
if (!isset($mon_desc)){
      $mon_desc = "";
}
?>
</TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
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
<BR></BR>
  <INPUT TYPE="submit" VALUE="Create Monster" style="height: 70px; width: 200px"/>
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>
</BODY>
>>>>>>> 65450b134015a9177e74559b90657752af789db3
</HTML>