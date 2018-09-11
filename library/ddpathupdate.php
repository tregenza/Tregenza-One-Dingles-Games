<?
include 'ddmonsterFunctions.php';
/*
$link = getDBLink();
$select = "select magic_name, magic_body, magic_desc, magic_value from magic2 where mon_key_1 = 'dd35'";
$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)){
  $magic_name = $row['magic_name'] ;
  $magic_body = $row['magic_body'] ;
  $magic_desc = $row['magic_desc'] ;
  $magic_value = $row['magic_value'] ;
  $insert = "insert into magic2 (magic_name, magic_body, magic_desc, magic_value, mon_key_1) " .
            "values ('$magic_name', '$magic_body', '$magic_desc', '$magic_value', 'path')";
  echo $insert;
  $result2 = mysqli_query($link, $insert);
  if ($result2){
     $select3 = "select magic_name, magic_spec, magic_feat, magic_skill, magic_no, magic_bonus_tp, magic_type from magicattr2 ".
                "where magic_name = '$magic_name' and mon_key_1 = 'dd35'";
     echo $select3;
     $result3 = mysqli_query($link, $select3) ;
     while ($row3 = mysqli_fetch_array($result3)){
         $magic_name = $row3['magic_name'] ;
         $magic_spec = $row3['magic_spec'] ;
         $magic_feat = $row3['magic_feat'] ;
         $magic_skill = $row3['magic_skill'] ;
         $magic_no   = $row3['magic_no'] ;
         $magic_bonus_tp = $row3['magic_bonus_tp'] ;
         $magic_type = $row3['magic_type'] ;

         $insert4 = "insert into magicattr2 (magic_name, magic_spec, magic_feat, magic_skill, magic_no, magic_bonus_tp, magic_type, mon_key_1)" .
                    "values ('$magic_name', '$magic_spec', '$magic_feat', '$magic_skill', '$magic_no', '$magic_bonus_tp', '$magic_type','path')";
         echo $insert4;
         $result4 = mysqli_query($link, $insert4);
     }
  }
}
*/










//session_start();
//$mon_name = "Dragon, Red Adult";
$mon_name = "Ogre";
$wp_user = "dd35";
$in_user = "path";
$select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed , mon_speed_fly, mon_speed_climb, mon_speed_swim, mon_speed_burrow, ".
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, montype_skillp, montype_att, montype_cr, mon_nochange, mon_template, mon_alignment, ".
                   "mon_environment, mon_level_adj, mon_magic_use, mon_delete " .
                   "from monster2, montype where mon_type = montype and mon_key_1 = '$wp_user'";
//  include 'includes/dd_db_conn.txt';
$link = getDBLink();
$result3 = mysqli_query($link, $select) ;
while ($row3 = mysqli_fetch_array($result3)){
  $mon_name = $row3['mon_name'] ;
  $mon_size = $row3['mon_size'] ;
  $mon_type = $row3['mon_type'] ;
  $mon_hd   = $row3['mon_hd'] ;
  $mon_init = $row3['mon_init'] ;
  $mon_speed = $row3['mon_speed'] ;
  $mon_speed_fly = $row3['mon_speed_fly'] ;
  $mon_speed_climb = $row3['mon_speed_climb'] ;
  $mon_speed_swim = $row3['mon_speed_swim'] ;
  $mon_speed_burrow = $row3['mon_speed_burrow'] ;
  $mon_ac_flat = $row3['mon_ac_flat'] ;
  $mon_nat_ac = $mon_ac_flat - 10;
  $mon_ac   = $row3['mon_ac'] ;
  $mon_base_att = $row3['mon_base_att'] ;
  $mon_full_att = $row3['mon_full_att'] ;
  $mon_space    = $row3['mon_space'] ;
  $mon_reach    = $row3['mon_reach'] ;
  $mon_cr   = $row3['mon_cr'] ;
  $mon_str = $row3['mon_str'] ;
  $mon_dex = $row3['mon_dex'] ;
  $mon_con = $row3['mon_con'] ;
  $mon_int = $row3['mon_int'] ;
  $mon_wis = $row3['mon_wis'] ;
  $mon_chr = $row3['mon_chr'] ;
  $mon_desc = $row3['mon_desc'] ;
  $mon_sv_fort = $row3['mon_sv_fort'] ;
  $mon_sv_reflex = $row3['mon_sv_reflex'] ;
  $mon_sv_will = $row3['mon_sv_will'] ;
  $mon_armour = $row3['mon_armour'] ;
  $mon_shield = $row3['mon_shield'] ;
  $mon_skillp  = $row3['montype_skillp'] ;
  $montype_cr  = $row3['montype_cr'];
  $montype_att = $row3['montype_att'];
  $mon_nochange = $row3['mon_nochange'];
  $mon_template = $row3['mon_template'];
  $mon_alignment = $row3['mon_alignment'];
  $mon_environment = $row3['mon_environment'];
  $mon_level_adj = $row3['mon_level_adj'];
  $mon_magic_use = $row3['mon_magic_use'];
  $mon_delete = $row3['mon_delete'];
  $mon_size_original = $mon_size;
  if ($mon_type == "Giant"){
     $mon_type = "Humanoid";
  }
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
  $user = "path";
  $insert  = "INSERT INTO monster2 (mon_key_1,mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed, mon_speed_fly, mon_speed_swim, mon_speed_burrow, mon_speed_climb," .
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, mon_user, mon_nochange, mon_template, mon_alignment, mon_environment, mon_level_adj, mon_magic_use, mon_delete) " .
           "VALUES ( '$in_user','$mon_name' ,'$mon_size' , '$mon_type' ,'$mon_hd' ,'$mon_hp' ,".
                 "'$mon_init' ,'$mon_speed', '$mon_speed_fly', '$mon_speed_swim', '$mon_speed_burrow','$mon_speed_climb',".
                     "'$mon_ac_flat' , '$mon_ac' ,".
                     "'$mon_base_att' ,'$mon_full_att' ,'$mon_space' ,'$mon_reach' ,".
                     "'$mon_cr' ,'$mon_str' ,'$mon_dex' ,'$mon_con' ,'$mon_int' ,".
                     "'$mon_wis' ,'$mon_chr' ,'$mon_desc','$mon_sv_fort',".
                     "'$mon_sv_reflex',  '$mon_sv_will','$mon_armour', '$mon_shield', '$user_id', '$mon_nochange', '$mon_template'," .
                     "'$mon_alignment', '$mon_environment', '$mon_level_adj', '$mon_magic_use', '$mon_delete')";

//    echo $insert . "</BR>";
      $link = getDBLink();
//      include 'includes/dd_db_conn.txt';
      $result2 = mysqli_query($link, $insert);
// Monster Feats
//  echo "</BR> " . $delete;
  $select = "select monfeat from monfeat2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
//    echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    $mon_feats = 0;
    while ($row = mysqli_fetch_array($result)) {
      $mon_feats = $mon_feats + 1;
      $feat_val = $row['monfeat'];
      $insert = "INSERT INTO monfeat2 (mon_key_1, mon_name , monfeat)".
                        "VALUES ('$in_user','$mon_name', '$feat_val')";
              $result2 = mysqli_query($link, $insert);
//      echo "</BR> feat" . $feat;
// echo "</BR> $insert";
    }
  }

// Monster Weapons
  $select = "select monweap_attp, monweap_wp, monweap_dam from " .
             "monweap2 where ".
             "monweap_mon = '$mon_name'  and mon_key_1 = '$wp_user'";
  echo "</BR> " . $select. "</BR>";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_array($result)) {
        $attp = $row['monweap_attp'];
        $dam = $row['monweap_dam'];
        $mon_weap = $row['monweap_wp'];
        if ($mon_weap != ""){
          $insert = "INSERT INTO monweap2 (mon_key_1,monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                     "VALUES ('$in_user','$mon_name', '$attp','$mon_weap', '$dam')";
          $result2 = mysqli_query($link, $insert);
//           echo "</BR> Weapon " . $attp .  $mon_weap . $dam ."*** </BR>";
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
//  monster skills
//
//
  if (strpos($mon_hd, "d")){
      $hd_pos =  strpos($mon_hd, "d");
      $mon_hitdie = substr($mon_hd,0,$hd_pos);
   }else{
      if ($mon_type != ""){
         $mon_hitdie = $mon_hd;
         $mon_hd = trim($mon_hd) . $montype_hd;
      }
   }

 $select = "SELECT monskill_tp, monskill_val,skill_atr, skill_armour_ch from monskill2, skills WHERE mon_name = '$mon_name'  and mon_key_1 = '$wp_user' ".
             " AND monskill_tp = skill_cd" ;
//  echo "</BR> " . $select . "</BR>";
 $result = mysqli_query($link, $select) ;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
    $count = $count + 1;
    $mon_skill = $row['monskill_tp'];
    $mon_skill_val  = $row['monskill_val'];
    $atr   = $row['skill_atr'];
    $armour_ch = $row['skill_armour_ch'];
    if ($mon_skill == "Balance"){
       $mon_skill = "Acrobatics";
    }
    if ($mon_skill == "Decipher Script"){
       $mon_skill = "Linguistics";
    }
    if ($mon_skill == "Forgery"){
       $mon_skill = "Linguistics";
    }
    if ($mon_skill == "Gather Information"){
       $mon_skill = "Diplomacy";
    }
    if ($mon_skill == "Decipher Script"){
       $mon_skill = "Linguistics";
    }
    if ($mon_skill == "Hide"){
       $mon_skill = "Stealth";
    }
    if ($mon_skill == "Jump"){
       $mon_skill = "Acrobatics";
    }
    if ($mon_skill == "Listen"){
       $mon_skill = "Perception";
    }
    if ($mon_skill == "Move Silently"){
       $mon_skill = "Stealth";
    }
    if ($mon_skill == "Open Lock"){
       $mon_skill = "Disable Devise";
    }
    if ($mon_skill == "Search"){
       $mon_skill = "Perception";
    }
    if ($mon_skill == "Speak Languages"){
       $mon_skill = "Linguistics";
    }
    if ($mon_skill == "Spot"){
       $mon_skill = "Perception";
    }
    if ($mon_skill == "Tumble"){
       $mon_skill = "Acrobatics";
    }
    if ($mon_skill == "Use Rope"){
       $mon_skill = "";
    }
    if ($mon_skill == "Concentration"){
       $mon_skill = "";
    }
    if ($mon_skill != ""){
      if ($mon_skill_val >= $mon_hd){
         $mon_skill_val = $mon_skill_val - 3;
      }


      $insert = "INSERT INTO monskill2 (mon_key_1, mon_name, monskill_tp , monskill_val)".
                          "VALUES ('$in_user','$mon_name', '$mon_skill', '$mon_skill_val')";
      $result2 = mysqli_query($link, $insert);
      if ($result2){
      }else{
         $select4 = "SELECT monskill_tp, monskill_val from monskill2 WHERE mon_name = '$mon_name'  and mon_key_1 = '$in_user' ";
         $result4 = mysqli_query($link, $select4);
         $row4 = mysqli_fetch_array($result4);
         $old_skill_val = $row4['monskill_val'];
         if ($mon_skill_val > $old_skill_val){
             $update = "update monskill2 set monskill_val = '$mon_skill_val' where mon_name = '$mon_name'  and mon_key_1 = '$in_user' ";
             $result5 =  mysqli_query($link, $update);
         }else{
            if ($mon_speed_fly > "0"){
               $mon_skill = "Fly";
               $insert = "INSERT INTO monskill2 (mon_key_1, mon_name, monskill_tp , monskill_val)".
                          "VALUES ('$in_user','$mon_name', '$mon_skill', '$mon_skill_val')";
               $result2 = mysqli_query($link, $insert);
            }
         }

      }


    }


 }
 $select = "SELECT monspec_name, monspec_value, monspec_min, monspec_max from monspec2 where monspec_tp = 'A' and mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $spec_name = $row['monspec_name'];
  $value = $row['monspec_value'];
  $min = $row['monspec_min'];
  $max = $row['monspec_max'];

  if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1, mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$in_user','$mon_name', 'A', '$spec_name', '$value', '$min', '$max')";
//            echo "</BR> $insert ";
               $result2 = mysqli_query($link, $insert);
  }
 }
 $select = "SELECT monspec_name, monspec_value, monspec_min, monspec_max from monspec2 where monspec_tp = 'S' and mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $spec_name = $row['monspec_name'];
  $value = $row['monspec_value'];
  $min = $row['monspec_min'];
  $max = $row['monspec_max'];
  if ($spec_name !=""){
               $insert = "INSERT INTO monspec2 (mon_key_1, mon_name, monspec_tp, monspec_name, monspec_value, monspec_min, monspec_max) " .
                         "VALUES ('$in_user','$mon_name', 'S', '$spec_name', '$value', '$min', '$max')";
//            echo "</BR> $insert ";
               $result2 = mysqli_query($link, $insert);
  }
 }
// mon treasure
 $select = "SELECT mon_name, montreas_tp, montreas_mult from montreas2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $montreas = $row['montreas_tp'];
  $montreas_mult = $row['montreas_mult'];
  if ($montreas != ""){
       $insert = "INSERT INTO montreas2 (mon_key_1, mon_name, montreas_tp, montreas_mult)" .
                  " VALUES ('$in_user','$mon_name','$montreas','$montreas_mult')";
       $result2 = mysqli_query($link, $insert);
  }
 }
 // mon Organization
 $select = "SELECT mon_name, monorg_id, monorg_min, monorg_max from monorg2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $monorg_id = $row['monorg_id'];
  $monorg_min = $row['monorg_min'];
  $monorg_max = $row['monorg_max'];
  if ($monorg_id != ""){
       $insert = "INSERT INTO monorg2 (mon_key_1, mon_name, monorg_id, monorg_min, monorg_max)" .
                   " VALUES ('$in_user','$mon_name','$monorg_id','$monorg_min', '$monorg_max')";
       $result2 = mysqli_query($link, $insert);
  }
 }
// mon language
 $select = "SELECT mon_name, monlang_id from monlang2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $monlang = $row['monlang_id'];
  if ($monlang != ""){
        $insert = "INSERT INTO monlang2 (mon_key_1, mon_name, monlang_id)" .
                   " VALUES ('$in_user','$mon_name','$monlang')";
       $result2 = mysqli_query($link, $insert);
  }

 }


 $select = "SELECT mon_name, monadv_min_hd, monadv_max_hd, monadv_size from monadv2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $monadv_size = $row['monadv_size'];
  $monadv_min = $row['monadv_min_hd'];
  $monadv_max = $row['monadv_max_hd'];
  if ($monadv_min != ""){
              $insert = "INSERT INTO monadv2 (mon_key_1, mon_name, monadv_min_hd, monadv_max_hd, monadv_size)" .
                        " VALUES ('$in_user','$mon_name','$monadv_min','$monadv_max','$monadv_size')";
              $result2 = mysqli_query($link, $insert);
  }
 }
}

?>




<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<?
$link = getDBLink();
//include 'includes/dd_menu.txt' ;
?>
<h2>Change Monster</h2>
<?

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
  <TD><INPUT TYPE="text" NAME="mon_name" VALUE="<? echo $mon_name ?>"/></TD>
  <TD><SELECT NAME="mon_size" VALUE="<? echo $mon_size ?>">
<?
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
<TD><SELECT NAME="mon_type">
<?
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "select montype from montype ".
           "order by montype";
// echo $select;
   $result = mysqli_query($link, $select) ;
//  echo "result " $result;
while ($row = mysqli_fetch_array($result)) {
   $mon_type_sel = $row[montype] ;
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
   <TD><INPUT TYPE="text" NAME="mon_hd" VALUE="<? echo $mon_hd ?>"/></TD>

</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
   <TH>Base Speed Land</TH>
   <TH>Speed Fly</TH>
   <TH>Speed Climb</TH>
   <TH>Speed Swim</TH>
   <TH>Speed Burrow</TH>
</TR>
<TR>
    <TD><INPUT TYPE="text" NAME="mon_speed" VALUE="<? echo $mon_speed ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_fly" VALUE="<? echo $mon_speed_fly ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_climb" VALUE="<? echo $mon_speed_climb ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_swim" VALUE="<? echo $mon_speed_swim ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_burrow" VALUE="<? echo $mon_speed_burrow ?>"/></TD>
</TR>
</TABLE>
<BR></BR>
<TABLE>
</BR>
<TR>
  <TH>Natural AC Bonus</TH>
</TR>

<TR>
   <TD><INPUT TYPE="text" NAME="mon_nat_ac" VALUE="<? echo $mon_nat_ac ?>"/></TD>
</TR>
</TABLE>
<TABLE>
<TR>
  <TH>Armour</TH>
  <TH>Shield</TH>
<TR>
 <TD><SELECT NAME="mon_armour" VALUE="<? echo $mon_armour ?>">
<?
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT armour_cd, armour_tp, armour_bonus, armour_check FROM armour " .
           "where armour_cd != '4' order by armour_cd, armour_bonus, armour_dex DESC";  
// echo "select" . $select; 
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row[armour_tp] ;
    $armour_bonus_sel = $row[armour_bonus] ;
    $armour_check      = $row[armour_check];
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
 <TD><SELECT NAME="mon_shield" VALUE="<? echo $mon_shield ?>">
<?
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT armour_cd, armour_tp, armour_bonus, armour_check FROM armour " .
           "where armour_cd = '4' order by armour_cd, armour_bonus, armour_dex DESC";  
// echo "select" . $select; 
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row[armour_tp] ;
    $armour_bonus_sel = $row[armour_bonus] ;
    $armour_check      = $row[armour_check]; 
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
  <TH>Misile weapon</TH>
  <TH>Damage</TH>
</TR>
<TR>
 <TD><SELECT NAME="mon_weap_p" VALUE="<? echo $mon_weap_p ?>">
<?
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
$select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp != 'Ranged' order by weap_cat, weap_type, weap_id";
echo "select" . $select; 
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
   $desc = $weap_id_sel . " " . $weap_cat_sel;    
echo <<<EOF
     <OPTION VALUE="$weap_id_sel" $sel > $desc </OPTION>
EOF;
   }
mysqli_close($link);
?>
</TD>
  <TD><SELECT NAME="dam_p">
<?
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
 <TD><SELECT NAME="mon_weap_r" VALUE="<? echo $mon_weap_r ?>">
<?
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
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
   $desc = $weap_id_sel . " " . $weap_cat_sel;
echo <<<EOF
     <OPTION VALUE="$weap_id_sel" $sel > $desc </OPTION>
EOF;
   }
mysqli_close($link);
?>
</TD>
<TD><SELECT NAME="dam_r">
<?
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
</TR>
</TABLE>
<BR></BR>
<TABLE>
<TR>
  <TH>Secondary Att</TH>
  <TH>Damage</TH>
</TR>
<TR>
<?
$count = 0;

While ($count < 10){
  $count = $count + 1;
  $name = "mon_weap_s" . $count;
  $dam_v = "dam_s" . $count;
  $dam   = $$dam_v;
  $mon_weap_s = $$name;

echo <<<EOF
    <TR>
    <TD><SELECT NAME="$name" VALUE="<? echo $mon_weap_s ?>">
EOF;

  $link = getDBLink();
//  include 'includes/dd_db_conn.txt' ;
  $select = "SELECT weap_id, weap_cat FROM weapons " .
           "where weap_range_tp != 'Ranged' order by weap_cat, weap_type, weap_id";
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {
    $weap_id_sel = $row[weap_id] ;
    $weap_cat_sel = $row[weap_cat] ;
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
<TABLE>
<BR></BR>
<TR>
  <TH>Space</TH>
  <TH>Reach</TH>
</TR>
<TR>
<TD><SELECT NAME="mon_space"">
<?
$sel_half = $sel_1 = $sel_2 = $sel_10 = $sel_15 = $sel_20 = $sel_30 = ""; 
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
<?
$sel_half = $sel_1 = $sel_2 = $sel_10 = $sel_15 = $sel_20 = $sel_30 = "";
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
</TABLE>
<TABLE class ="SpecialaTable">
</BR>
<TR>
    <TH>Special Attacks</TH>
    <TH>Value</TH>
    <TH>Min HD</TH>
    <TH>Max HD</TH>
</TR>
<?
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
<?
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
    $specq_sel = $row[specq_name] ;

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
  <TD><SELECT NAME="mon_sv_fort" VALUE="<? echo $mon_sv_fort ?>">
<?
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
  <TD><SELECT NAME="mon_sv_reflex" VALUE="<? echo $mon_sv_reflex ?>">
<?
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
  <TD><SELECT NAME="mon_sv_will" VALUE="<? echo $mon_sv_will ?>">
<?
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
<?
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
Changing Monsters Skills
The skills in the change monster screen do not include any atribute bonus they are just assigned skill points.
<?
if ($skill_points > 0){
   echo "<BR></BR>Total skill points to spend = $skill_points. Skill points spent = $skill_total.";
}
?>
<BR></BR>
<TABLE BORDER="1" CELLPADDING="1">
</TR>
</BR>
<?
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
    $mon_skill_val = $$value;
    $mon_skill = $$name;

echo <<<EOF
    <TD><SELECT NAME="$name" VALUE="<? echo $mon_skill ?>">
EOF;

   $select = "SELECT skill_cd FROM skills order by skill_cd" ;

   $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
   while ($row = mysqli_fetch_array($result)) {
    $skill_sel = $row[skill_cd] ;
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
<TABLE BORDER="1" CELLPADDING="1">
<BR>
<TR>
<TD COLSPAN="2">Monsters Feats: </TD>
</TR>

<TR>
<?
// FEATS
$count  = 0 ;
$link = getDBLink();
//include 'includes/dd_db_conn.txt' ;
While ($count < 16) {
  $count = $count + 1;
  $name = "mon_feat_" . $count;
  $mon_feat = $$name;
  if ($count == 5 or $count == 9 or $count == 13 or $count == 17){
     echo "</TR><TR>";
  }    
echo <<<EOF
    <TD><SELECT NAME="$name" VALUE="<? echo $mon_feat ?>">
EOF;

  $select = "SELECT feat_name FROM feats order by feat_name" ;
 
  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  while ($row = mysqli_fetch_array($result)) {
    $feat_sel = $row[feat_name] ;
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
}
mysqli_close($link);
?>
</TABLE>
<BR></BR>
<TABLE>
<TR>
<TH>Environment</TH>
<?
$select = "select distinct savemon_terain from savemon order by savemon_terain";
$link = getDBLink();
$result = mysqli_query($link, $select) ;
$save_count = 0;
$html = '<TD>Terain <SELECT NAME="mon_environment" >';
while ($row = mysqli_fetch_array($result)) {
   $terain_sel = $row['savemon_terain'] ;
    if ($terain_sel == $mon_environment){
	$sel = " SELECTED" ;
    } else {
	$sel = "" ;
    }
    if ($terain_sel != ""){
       $html .= '<OPTION VALUE="'.$terain_sel.'" '.$sel.' >'.$terain_sel.'</OPTION>';
    }
}
mysqli_close($link);

$html .= '</SELECT></TD>';
echo $html;
?>
</TR>
</BR>
<TR>
  <TH>CR Rating</TH>
  <TH>Template</TH>
</TR>
<TR>
   <TD><INPUT TYPE="text" NAME="mon_cr" VALUE="<? echo $mon_cr ?>"/></TD>
   <TD><SELECT NAME="mon_template" VALUE="<? echo $mon_template ?>">
<?
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
<?
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
    <TD><SELECT NAME="$name" VALUE="<? echo $montreas ?>">
EOF;

  $select = "SELECT montreastp_id FROM montreastp order by montreastp_id" ;

  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  while ($row = mysqli_fetch_array($result)) {
    $treas_sel = $row[montreastp_id] ;
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
<?
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
<?
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
<TD><SELECT NAME="mon_magic_use" VALUE="<? echo $mon_magic_use ?>">
<?
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
<?echo $mon_desc ?> </TEXTAREA> </TD>
</TR>
</TABLE>
<BR>
  <INPUT TYPE="submit" VALUE="Change Monster" style="height: 70px; width: 200px />
</BR>
</BR>
</FORM>
</BODY>
</HTML>