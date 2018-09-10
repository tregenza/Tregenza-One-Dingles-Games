<<<<<<< HEAD
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<h2>Add Monster</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,8); 
       if ($v == "" and $beg != "mon_feat" and $beg != "monskill" and $beg !="mon_spec") {
          $msg = "please fill in all fields";
       }
   }
   
   if ($msg == "") {
      $mon_full_att =" ";
      $mon_ac = " ";
      $mon_space = " ";
      $mon_reach = " ";
      $mon_hp =" ";
      $mon_init  = " ";
      $insert  = "INSERT INTO monster (mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield) " .
           "VALUES ( '$mon_name' ,'$mon_size' , '$mon_type' ,'$mon_hd' ,'$mon_hp' ,".
                     "'$mon_init' ,'$mon_speed' ,'$mon_ac_flat' , '$mon_ac' ,".
                     "'$mon_base_att' ,'$mon_full_att' ,'$mon_space' ,'$mon_reach' ,".
                     "'$mon_cr' ,'$mon_str' ,'$mon_dex' ,'$mon_con' ,'$mon_int' ,".	
                     "'$mon_wis' ,'$mon_chr' ,'$mon_desc','$mon_sv_fort',". 
                     "'$mon_sv_reflex',  '$mon_sv_will','$mon_armour', '$mon_shield')"; 
    
//    echo $insert . "</BR>;

      include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $insert);
      if (!$result) {
         $msg = "$result" ." Error inserting data";
      }
      else {
         $msg = "record sucessfully added" ;
          $fn = $ln = "" ;
   
//insert feats
         $count = 0;
         while ($count < 6){
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
         while ($count < 9){
//find the skill atribute and take off the skill value
           
           $count = $count + 1;
           $name = "monskill_tp_" . $count;
           $value = "monskill_val_" . $count;
           $mon_skill_val = $$value;
           $mon_skill = $$name;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skill != ""){
              $select = "SELECT skill_cd, skill_atr from skills ".
                      "WHERE skill_cd = '$mon_skill'";
              echo $select; 
              $result = mysqli_query($link, $select);
              $row = mysqli_fetch_array($result);
              $skill_atr = $row['skill_atr'];
              echo "skill atr = " . $skill_atr;
              $lower = strtolower($skill_atr);
              echo $lower;
              $field = "mon_" . $lower;
              echo "</BR>";
              echo "mon_str = " . $mon_str;
              $atr_val = $$field;
              echo  "field " . $field . " value " . $atr_val . " ***";
              $atr_pluss = (($atr_val - 10) / 2) -0.5;
              $atr_pluss = round($atr_pluss,0);
              $mon_skill_val = $mon_skill_val - $atr_pluss;          

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
         $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp)".
                   "VALUES ('$mon_name', 'P','$mon_weap_p')";       
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
           $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp)".
                     "VALUES ('$mon_name', 'R','$mon_weap_r')";       
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
         while ($count <6) {
            $count = $count + 1;
            $name = "mon_weap_s_" . $count;
            $mon_weap = $$name;
            $mon_attp = "S" . $count;
            if ($mon_weap != "No Mellee"){
               $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp)".
                         "VALUES ('$mon_name', '$mon_attp','$mon_weap')";
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

?>


<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">


<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Name</TH>
  <TH>Size</TH>
  <TH>Type</TH>
  <TH>Speed</TH>
  <TH>Base Natural AC</TH>
  <TH>Base Attack</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="mon_name" VALUE="<? echo $mon_name ?>"/></TD> 
  <TD><SELECT NAME="mon_size" VALUE="<? echo $mon_size ?>">
<?
$select = "SELECT size_cat FROM size" ;
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
   <TD><INPUT TYPE="text" NAME="mon_type" VALUE="<? echo $mon_type ?>"/></TD> 
   <TD><INPUT TYPE="text" NAME="mon_speed" VALUE="<? echo $mon_speed ?>"/></TD> 
   <TD><INPUT TYPE="text" NAME="mon_ac_flat" VALUE="<? echo $mon_ac_flat ?>"/></TD> 
   <TD><INPUT TYPE="text" NAME="mon_base_att" VALUE="<? echo $mon_base_att ?>"/></TD>  
</TR> 
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

<TR>
  <TH>Hit Dice</TH>
  <TH>CR Rating</TH>
  <TH>Fort Save Type</TH>
  <TH>Reflex Save Type</TH>
  <TH>Will Save Type</TH>
</TR>
<TR>
  <TD><INPUT TYPE="text" NAME="mon_hd" VALUE="<? echo $mon_hd ?>"/></TD> 
  <TD><INPUT TYPE="text" NAME="mon_cr" VALUE="<? echo $mon_cr ?>"/></TD> 
  <TD><SELECT NAME="mon_sv_fort" VALUE="<? echo $mon_sv_fort ?>">
<?
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
<BR>
<BR>

<TR>
<TD COLSPAN="2">Monsters Feats: </TD>
</TR>

<TR>
<?
// FEATS
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 6) {
  $count = $count + 1;
  $name = "mon_feat_" . $count;
  $mon_feat = $$name;

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

</TR>

<TR>
  <TH>Skill-1</TH>
  <TH>Rank-1</TH>
  <TH>Skill-2</TH>
  <TH>Rank-2</TH>
  <TH>Skill-3</TH>
  <TH>Rank-3</TH>
</TR>
<TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 3) {
  $count = $count + 1;
  $name = "monskill_tp_" . $count;
  $value = "monskill_val_" . $count;
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
mysqli_close($link);
?>
<TR>
  <TH>Skill-4</TH>
  <TH>Rank-4</TH>
  <TH>Skill-5</TH>
  <TH>Rank-5</TH>
  <TH>Skill-6</TH>
  <TH>Rank-6</TH>
</TR>
<TR>
<?
$count  = 3 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 6) {
  $count = $count + 1;
  $name = "monskill_tp_" . $count;
  $value = "monskill_val_" . $count;
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
mysqli_close($link);
?>

<TR>
  <TH>Skill-7</TH>
  <TH>Rank-7</TH>
  <TH>Skill-8</TH>
  <TH>Rank-8</TH>
  <TH>Skill-9</TH>
  <TH>Rank-9</TH>
</TR>
<TR>
<?
$count  = 6 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 9) {
  $count = $count + 1;
  $name = "monskill_tp_" . $count;
  $value = "monskill_val_" . $count;
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
mysqli_close($link);
?>
<P>
<BR>
<BR>
<TR>
  <TH>Armour</TH>
  <TH>Shield</TH>
  <TH>Primary Weapon</TH>
  <TH>Misile weapon</TH>
</TR>

<TR>
 <TD><SELECT NAME="mon_armour" VALUE="<? echo $mon_armour ?>">
<?
include 'includes/dd_db_conn.txt' ;
$select = "SELECT armour_cd, armour_tp, armour_bonus FROM armour " .
           "where armour_cd != '4' order by armour_cd, armour_bonus, armour_dex DESC";  
// echo "select" . $select; 
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row[armour_tp] ;
    $armour_bonus_sel = $row[armour_bonus] ;
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

echo <<<EOF
     <OPTION VALUE="$armour_tp_sel" $sel > $armour_tp_sel $armour_bonus_sel </OPTION>
EOF;
   }
mysqli_close($link);
?>
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
</TR>

<TR>
  <TH>Secondary Att 1</TH>
  <TH>Secondary Att 2</TH>
  <TH>Secondary Att 3</TH>
  <TH>Secondary Att 4</TH>
  <TH>Secondary Att 5</TH>
  <TH>Secondary Att 6</TH>
</TR>
<TR>
<?
$count = 0;

While ($count < 6){
  $count = $count + 1;
  $name = "mon_weap_s_" . $count;
  $mon_weap_s = $$name;

echo <<<EOF
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
}
mysqli_close($link);
?>
</TR>








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
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>

=======
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<h2>Add Monster</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,8); 
       if ($v == "" and $beg != "mon_feat" and $beg != "monskill" and $beg !="mon_spec") {
          $msg = "please fill in all fields";
       }
   }
   
   if ($msg == "") {
      $mon_full_att =" ";
      $mon_ac = " ";
      $mon_space = " ";
      $mon_reach = " ";
      $mon_hp =" ";
      $mon_init  = " ";
      $insert  = "INSERT INTO monster (mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield) " .
           "VALUES ( '$mon_name' ,'$mon_size' , '$mon_type' ,'$mon_hd' ,'$mon_hp' ,".
                     "'$mon_init' ,'$mon_speed' ,'$mon_ac_flat' , '$mon_ac' ,".
                     "'$mon_base_att' ,'$mon_full_att' ,'$mon_space' ,'$mon_reach' ,".
                     "'$mon_cr' ,'$mon_str' ,'$mon_dex' ,'$mon_con' ,'$mon_int' ,".	
                     "'$mon_wis' ,'$mon_chr' ,'$mon_desc','$mon_sv_fort',". 
                     "'$mon_sv_reflex',  '$mon_sv_will','$mon_armour', '$mon_shield')"; 
    
//    echo $insert . "</BR>;

      include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $insert);
      if (!$result) {
         $msg = "$result" ." Error inserting data";
      }
      else {
         $msg = "record sucessfully added" ;
          $fn = $ln = "" ;
   
//insert feats
         $count = 0;
         while ($count < 6){
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
         while ($count < 9){
//find the skill atribute and take off the skill value
           
           $count = $count + 1;
           $name = "monskill_tp_" . $count;
           $value = "monskill_val_" . $count;
           $mon_skill_val = $$value;
           $mon_skill = $$name;
//         echo $value . "  " . $mon_skill_val;
           if ($mon_skill != ""){
              $select = "SELECT skill_cd, skill_atr from skills ".
                      "WHERE skill_cd = '$mon_skill'";
              echo $select; 
              $result = mysqli_query($link, $select);
              $row = mysqli_fetch_array($result);
              $skill_atr = $row['skill_atr'];
              echo "skill atr = " . $skill_atr;
              $lower = strtolower($skill_atr);
              echo $lower;
              $field = "mon_" . $lower;
              echo "</BR>";
              echo "mon_str = " . $mon_str;
              $atr_val = $$field;
              echo  "field " . $field . " value " . $atr_val . " ***";
              $atr_pluss = (($atr_val - 10) / 2) -0.5;
              $atr_pluss = round($atr_pluss,0);
              $mon_skill_val = $mon_skill_val - $atr_pluss;          

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
         $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp)".
                   "VALUES ('$mon_name', 'P','$mon_weap_p')";       
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
           $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp)".
                     "VALUES ('$mon_name', 'R','$mon_weap_r')";       
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
         while ($count <6) {
            $count = $count + 1;
            $name = "mon_weap_s_" . $count;
            $mon_weap = $$name;
            $mon_attp = "S" . $count;
            if ($mon_weap != "No Mellee"){
               $insert = "INSERT INTO monweap (monweap_mon, monweap_attp, monweap_wp)".
                         "VALUES ('$mon_name', '$mon_attp','$mon_weap')";
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

?>


<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">


<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Name</TH>
  <TH>Size</TH>
  <TH>Type</TH>
  <TH>Speed</TH>
  <TH>Base Natural AC</TH>
  <TH>Base Attack</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="mon_name" VALUE="<? echo $mon_name ?>"/></TD> 
  <TD><SELECT NAME="mon_size" VALUE="<? echo $mon_size ?>">
<?
$select = "SELECT size_cat FROM size" ;
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
   <TD><INPUT TYPE="text" NAME="mon_type" VALUE="<? echo $mon_type ?>"/></TD> 
   <TD><INPUT TYPE="text" NAME="mon_speed" VALUE="<? echo $mon_speed ?>"/></TD> 
   <TD><INPUT TYPE="text" NAME="mon_ac_flat" VALUE="<? echo $mon_ac_flat ?>"/></TD> 
   <TD><INPUT TYPE="text" NAME="mon_base_att" VALUE="<? echo $mon_base_att ?>"/></TD>  
</TR> 
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

<TR>
  <TH>Hit Dice</TH>
  <TH>CR Rating</TH>
  <TH>Fort Save Type</TH>
  <TH>Reflex Save Type</TH>
  <TH>Will Save Type</TH>
</TR>
<TR>
  <TD><INPUT TYPE="text" NAME="mon_hd" VALUE="<? echo $mon_hd ?>"/></TD> 
  <TD><INPUT TYPE="text" NAME="mon_cr" VALUE="<? echo $mon_cr ?>"/></TD> 
  <TD><SELECT NAME="mon_sv_fort" VALUE="<? echo $mon_sv_fort ?>">
<?
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
<BR>
<BR>

<TR>
<TD COLSPAN="2">Monsters Feats: </TD>
</TR>

<TR>
<?
// FEATS
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 6) {
  $count = $count + 1;
  $name = "mon_feat_" . $count;
  $mon_feat = $$name;

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

</TR>

<TR>
  <TH>Skill-1</TH>
  <TH>Rank-1</TH>
  <TH>Skill-2</TH>
  <TH>Rank-2</TH>
  <TH>Skill-3</TH>
  <TH>Rank-3</TH>
</TR>
<TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 3) {
  $count = $count + 1;
  $name = "monskill_tp_" . $count;
  $value = "monskill_val_" . $count;
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
mysqli_close($link);
?>
<TR>
  <TH>Skill-4</TH>
  <TH>Rank-4</TH>
  <TH>Skill-5</TH>
  <TH>Rank-5</TH>
  <TH>Skill-6</TH>
  <TH>Rank-6</TH>
</TR>
<TR>
<?
$count  = 3 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 6) {
  $count = $count + 1;
  $name = "monskill_tp_" . $count;
  $value = "monskill_val_" . $count;
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
mysqli_close($link);
?>

<TR>
  <TH>Skill-7</TH>
  <TH>Rank-7</TH>
  <TH>Skill-8</TH>
  <TH>Rank-8</TH>
  <TH>Skill-9</TH>
  <TH>Rank-9</TH>
</TR>
<TR>
<?
$count  = 6 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 9) {
  $count = $count + 1;
  $name = "monskill_tp_" . $count;
  $value = "monskill_val_" . $count;
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
mysqli_close($link);
?>
<P>
<BR>
<BR>
<TR>
  <TH>Armour</TH>
  <TH>Shield</TH>
  <TH>Primary Weapon</TH>
  <TH>Misile weapon</TH>
</TR>

<TR>
 <TD><SELECT NAME="mon_armour" VALUE="<? echo $mon_armour ?>">
<?
include 'includes/dd_db_conn.txt' ;
$select = "SELECT armour_cd, armour_tp, armour_bonus FROM armour " .
           "where armour_cd != '4' order by armour_cd, armour_bonus, armour_dex DESC";  
// echo "select" . $select; 
  $result = mysqli_query($link, $select) ;
//  echo "result " $result;
  while ($row = mysqli_fetch_array($result)) {
    $armour_tp_sel = $row[armour_tp] ;
    $armour_bonus_sel = $row[armour_bonus] ;
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

echo <<<EOF
     <OPTION VALUE="$armour_tp_sel" $sel > $armour_tp_sel $armour_bonus_sel </OPTION>
EOF;
   }
mysqli_close($link);
?>
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
</TR>

<TR>
  <TH>Secondary Att 1</TH>
  <TH>Secondary Att 2</TH>
  <TH>Secondary Att 3</TH>
  <TH>Secondary Att 4</TH>
  <TH>Secondary Att 5</TH>
  <TH>Secondary Att 6</TH>
</TR>
<TR>
<?
$count = 0;

While ($count < 6){
  $count = $count + 1;
  $name = "mon_weap_s_" . $count;
  $mon_weap_s = $$name;

echo <<<EOF
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
}
mysqli_close($link);
?>
</TR>








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
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>

>>>>>>> 65450b134015a9177e74559b90657752af789db3
</HTML>