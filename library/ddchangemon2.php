<?
session_start();
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
}
if (IsSet($_SESSION['smon_name'])){
   $mon_name     = $_SESSION['smon_name'];
  $select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed , mon_speed_fly, mon_speed_climb, mon_speed_swim, mon_speed_burrow, ".
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, montype_skillp, montype_att, montype_cr, mon_nochange ".
                   "from monster, montype where mon_name = '$mon_name' and mon_type = montype";
  include 'includes/dd_db_conn.txt';
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
  $select = "select monfeat from monfeat where mon_name = '$mon_name'";
//    echo "</BR> " . $select . "</BR>";
  $result = mysqli_query($link, $select) ;
  if (mysqli_num_rows($result) > 0){
    $mon_feats = 0;
    while ($row = mysqli_fetch_array($result)) {
      $mon_feats = $mon_feats + 1;
      $mon_feat_v = "mon_feat_" . $mon_feats;
      $$mon_feat_v = $row['monfeat'];
//      echo "</BR> feat" . $feat;
// echo "</BR> $insert";
    }
  }

// Monster Weapons
  $select = "select monweap_attp, monweap_wp, monweap_dam monweap_dam from " .
             "monweap where ".
             "monweap_mon = '$mon_name'";
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
 $select = "SELECT monskill_tp, monskill_val,skill_atr, skill_armour_ch from monskill, skills WHERE mon_name = '$mon_name'".
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
 $select = "SELECT monspec_name, monspec_value from monspec where monspec_tp = 'A' and mon_name = '$mon_name'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $spec_v = "speca_" . $count;
  $spec_value_v = "speca_value_" . $count;
  $$spec_v = $row['monspec_name'];
  $$spec_value_v = $row['monspec_value'];
 }
 $select = "SELECT monspec_name, monspec_value from monspec where monspec_tp = 'S' and mon_name = '$mon_name'";
 $result = mysqli_query($link, $select) ;
//  echo "result " $result;
 $count = 0;
 while ($row = mysqli_fetch_array($result)) {
  $count = $count + 1;
  $spec_v = "specq_" . $count;
  $spec_value_v = "specq_value_" . $count;
  $$spec_v = $row['monspec_name'];
  $$spec_value_v = $row['monspec_value'];
 }


}else{
   echo   '<P><A HREF="ddchangemon1.php">Select New Monster</A>';
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
include 'includes/dd_menu.txt' ;
?>
<h2>Change Monster</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $beg = substr($k,0,8);
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
        if ($k == "mon_base_att" or $k == "mon_ac_flat"){
          if (is_numeric($$k)){
          }else{
            $msg = "Monster Base attack and natural AC must be numeric";
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

       if ($v == "" and $beg != "mon_feat" and $beg != "monskill" and $beg !="mon_spec"and $beg2 != "dam" and $beg2 != "spe"  and $beg !="mon_noch"){
          $msg = "please fill in all fields";
           echo $k;
       }

   }

   if ($msg == "") {
      include 'includes/dd_db_conn.txt';
      $delete = "delete from monster where mon_name = '$mon_name'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monfeat where mon_name = '$mon_name'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monskill where mon_name = '$mon_name'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monweap where monweap_mon = '$mon_name'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monspec where mon_name = '$mon_name'";
      $result = mysqli_query($link, $delete) ;
      $mon_full_att =" ";
      $mon_ac = " ";
      $mon_hp =" ";
      $mon_init  = " ";
      $insert  = "INSERT INTO monster (mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed, mon_speed_fly, mon_speed_swim, mon_speed_burrow, mon_speed_climb," .
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, mon_user, mon_nochange) " .
           "VALUES ( '$mon_name' ,'$mon_size' , '$mon_type' ,'$mon_hd' ,'$mon_hp' ,".
                 "'$mon_init' ,'$mon_speed', '$mon_speed_fly', '$mon_speed_swim', '$mon_speed_burrow','$mon_speed_climb',".
                     "'$mon_ac_flat' , '$mon_ac' ,".
                     "'$mon_base_att' ,'$mon_full_att' ,'$mon_space' ,'$mon_reach' ,".
                     "'$mon_cr' ,'$mon_str' ,'$mon_dex' ,'$mon_con' ,'$mon_int' ,".
                     "'$mon_wis' ,'$mon_chr' ,'$mon_desc','$mon_sv_fort',".
                     "'$mon_sv_reflex',  '$mon_sv_will','$mon_armour', '$mon_shield', '$user_id', '$mon_nochange')";

//    echo $insert . "</BR>;

      include 'includes/dd_db_conn.txt';
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
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec (mon_name, monspec_tp, monspec_name, monspec_value) " .
                         "VALUES ('$mon_name', 'S', '$spec_name', '$value')";
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
            if ($spec_name !=""){
               $insert = "INSERT INTO monspec (mon_name, monspec_tp, monspec_name, monspec_value) " .
                         "VALUES ('$mon_name', 'A', '$spec_name', '$value')";
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
           if ($feat_val != ""){
              $insert = "INSERT INTO monfeat (mon_name , monfeat)".
                        "VALUES ('$mon_name', '$feat_val')";
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
           $mon_skill = $$name;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skill != ""){
/*              $select = "SELECT skill_cd, skill_atr, skill_armour_ch from skills ".
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
              $atr_pluss = (($atr_val - 10) / 2) -0.5;
              $atr_pluss = round($atr_pluss,0);
              $mon_skill_val = $mon_skill_val - $atr_pluss;
//  find if any feats have been included for the skill
              $select = "select featattr_no from featattr, monfeat where ".
                        "mon_name = '$mon_name' and featattr_type = 'SKILL' and ".
                        "featattr_id = '$mon_skill' and featattr_feat = monfeat";
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
                      $armour_bonus = $row[armour_bonus];
                       $armour_dex =   $row[armour_dex];
                       $armour_check = $row[armour_check];
                       $armour_spell = $row[armour_spell];
                       $armour_s30   = $row[armour_s30];
                       $armour_s20   = $row[armour_s20];
                       $armour_wt    = $row[armour_wt];
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
*/
              $insert = "INSERT INTO monskill (mon_name, monskill_tp , monskill_val)".
                        "VALUES ('$mon_name', '$mon_skill', '$mon_skill_val')";
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
         $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                   "VALUES ('$mon_name', 'P','$mon_weap_p', '$dam_p')";
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
           $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp,monweap_dam)".
                     "VALUES ('$mon_name', 'R','$mon_weap_r','$dam_r')";
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
            $mon_weap = $$name;
            $dam_v = "dam_s" . $count;
            $dam = $$dam_v;
            $mon_attp = "S" . $count;
            if ($mon_weap != "No Mellee"){
               $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp, monweap_dam)".
                         "VALUES ('$mon_name', '$mon_attp','$mon_weap', '$dam')";
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
         float: left;
}
.specialqTable {
	position: relative;
	Left: 200px;
}
</STYLE>
EOF;

?>
<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Name</TH>
  <TH>Size</TH>
  <TH>Type</TH>
  <TH>Hit Die</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="mon_name" VALUE="<? echo $mon_name ?>"/></TD>
  <TD><SELECT NAME="mon_size" VALUE="<? echo $mon_size ?>">
<?
$select = "SELECT size_cat FROM size order by size_ac_mod desc" ;
include 'includes/dd_db_conn.txt';
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
include 'includes/dd_db_conn.txt' ;
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
<TR>
   <TH>Base Speed Land</TH>
   <TH>Speed Fly</TH>
   <TH>Speed Climb</TH>

</TR>
<TR>
    <TD><INPUT TYPE="text" NAME="mon_speed" VALUE="<? echo $mon_speed ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_fly" VALUE="<? echo $mon_speed_fly ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_climb" VALUE="<? echo $mon_speed_climb ?>"/></TD>
</TR>
<TR>
   <TH>Speed Swim</TH>
   <TH>Speed Burrow</TH>
</TR>
<TR>
    <TD><INPUT TYPE="text" NAME="mon_speed_swim" VALUE="<? echo $mon_speed_swim ?>"/></TD>
    <TD><INPUT TYPE="text" NAME="mon_speed_burrow" VALUE="<? echo $mon_speed_burrow ?>"/></TD>
</TR>
</BR>
<TR>
  <TH>Base Natural AC</TH>
  <TH>Base Attack</TH>
</TR>
<TR>
   <TD><INPUT TYPE="text" NAME="mon_ac_flat" VALUE="<? echo $mon_ac_flat ?>"/></TD>
   <TD><INPUT TYPE="text" NAME="mon_base_att" VALUE="<? echo $mon_base_att ?>"/></TD>  
</TR>
</BR>
<TR>
  <TH>Armour</TH>
  <TH>Shield</TH>
<TR>
 <TD><SELECT NAME="mon_armour" VALUE="<? echo $mon_armour ?>">
<?
include 'includes/dd_db_conn.txt' ;
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
include 'includes/dd_db_conn.txt' ;
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




<TR>
  <TH>Primary Weapon</TH>
  <TH>Damage</TH>
  <TH>Misile weapon</TH>
  <TH>Damage</TH>
</TR>
<TR>
 <TD><SELECT NAME="mon_weap_p" VALUE="<? echo $mon_weap_p ?>">
<?
include 'includes/dd_db_conn.txt' ;
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
include 'includes/dd_db_conn.txt';
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
include 'includes/dd_db_conn.txt' ;
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
</TD>
  <TD><SELECT NAME="dam_r">
<?
$select = "SELECT DISTINCT dambase FROM dddambase order by dambase_no" ;
include 'includes/dd_db_conn.txt';
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

  include 'includes/dd_db_conn.txt' ;
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
  include 'includes/dd_db_conn.txt';
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
</BR>
<TR>
  <TH>Space</TH>
  <TH>Reach</TH>
</TR>
<TR>
<TD><SELECT NAME="mon_space"">
<?
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
</TR>
<?
include 'includes/dd_db_conn.txt' ;
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
echo <<<EOF
  <TD><INPUT TYPE='text' NAME='$speca_valuev' VALUE='$speca_value'></TD>
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
</TR>
<?
// special Qualities
include 'includes/dd_db_conn.txt' ;
$count = 0;
while ($count < 16){
  $count = $count + 1;
   $specqv = "specq_" . $count;
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
    $specq_sel = $row[specq_name] ;
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
  $specq_value = $$specq_valuev;
echo <<<EOF
  <TD><INPUT TYPE='text' NAME='$specq_valuev' VALUE='$specq_value'></TD>
EOF;

  echo "</TR>";
}
echo "</TABLE>";


?>
<TABLE>
</BR>

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
</BR>
</BR>
<TR>
  <TH>Str</TH>
  <TH>Dex</TH>
  <TH>Con</TH>
  <TH>Int</TH>
  <TH>Wis</TH>
  <TH>Chr</TH> 
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="mon_str" VALUE="<? echo $mon_str ?>"/></TD> 
  <TD><INPUT TYPE="text" NAME="mon_dex" VALUE="<? echo $mon_dex ?>"/></TD> 
  <TD><INPUT TYPE="text" NAME="mon_con" VALUE="<? echo $mon_con ?>"/></TD> 
  <TD><INPUT TYPE="text" NAME="mon_int" VALUE="<? echo $mon_int ?>"/></TD> 
  <TD><INPUT TYPE="text" NAME="mon_wis" VALUE="<? echo $mon_wis ?>"/></TD> 
  <TD><INPUT TYPE="text" NAME="mon_chr" VALUE="<? echo $mon_chr ?>"/></TD> 
</TR>
</BR>
</TABLE>
</BR>

</TABLE>
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
while ($count1 < 10){
  echo "</TR> <TR>";
  $count2 = 0;
  while ($count2 < 3){
    $count2 = $count2 + 1;
    $sub = ($count1 * 2) + $count2;
    include 'includes/dd_db_conn.txt' ;

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
include 'includes/dd_db_conn.txt' ;
While ($count < 16) {
  $count = $count + 1;
  $name = "mon_feat_" . $count;
  $mon_feat = $$name;
  if ($count == 4 or $count == 7 or $count == 10 or $count == 13 or $count  == 16){
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
<TABLE>
</BR>
<TR>
  <TH>CR Rating</TH>
  <TH>Protect Monster from being changed by other users</TH>
</TR>
<TR>
   <TD><INPUT TYPE="text" NAME="mon_cr" VALUE="<? echo $mon_cr ?>"/></TD>
   <TD><SELECT NAME="mon_nochange" VALUE="<? echo $mon_nochange ?>">
<?
if ($mon_nochange == "Y"){
   $sel_y = " SELECTED";
}else{
   $sel_n = " SELECTED";
}
echo <<<EOF
     <OPTION VALUE="Y" $sel_y > Protected </OPTION>
     <OPTION VALUE=" " $sel_n > Not Protected </OPTION>
EOF
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
  <INPUT TYPE="submit" VALUE="Change Monster" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</BR>
</BR>
<A HREF="ddchangemon1.php">Fetch New Monster</A>
</FORM>
</BODY>
</HTML>