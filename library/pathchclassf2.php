<?
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
}
session_start();
if (IsSet($_SESSION['sclass1_tp'])){
   $class_tp    = $_SESSION['sclass1_tp'];
   $class_focus = $_SESSION['sclass1_focus'];
   $class = $class_tp;
   $focus = $class_focus;
   include 'includes/dd_db_conn.txt';
   $select = "select classh_atr1, classh_atr2, classh_atr3, classh_atr4, classh_atr5, classh_atr6 from  classfocush2 " .
             "where classfh_class =  '$class_tp' and classfh_focus = '$class_focus' and mon_key_1 = 'path'";
   $result = mysqli_query($link, $select) ;
   $row = mysqli_fetch_array($result);
   $atr_1 = $row['classh_atr1'];
   $atr_2 = $row['classh_atr2'];
   $atr_3 = $row['classh_atr3'];
   $atr_4 = $row['classh_atr4'];
   $atr_5 = $row['classh_atr5'];
   $atr_6 = $row['classh_atr6'];

   $select =  "select classf_class, classf_focus , classf_skill,classf_tp, " .
                      "classf_xskill, classf_max from classfocus2 where " .
                       "classf_class = '$class_tp' and classf_focus = '$class_focus' and mon_key_1 = 'path'";
   include 'includes/dd_db_conn.txt';
   $result = mysqli_query($link, $select) ;
   $count = 0;
   while ($row = mysqli_fetch_array($result)) {
      $count = $count +1;
       $skillv  = "skill_" . $count;
       $tpv     = "tp_" . $count;
       $xskillv = "xskill_" . $count;
       $maxv    = "max_" . $count;
       $$skillv  = $row['classf_skill'];
       $$tpv      = $row['classf_tp'];
       $$xskillv  = $row['classf_xskill'];
       $$maxv     = $row['classf_max'];
       $max = $$maxv;
//       echo "</BR> $maxv $max";
   }
}else{
   echo   '<P><A HREF="ddchclassf1.php">Change Skill Focus</A>';
}




?>
<HTML>
<HEAD>
<STYLE>
<?
$background_blue = "#87CEFA";
$background_grey = "#D3D3D3";

echo <<<EOF
.error {padding: 10px; color: #CC0000; font-weight: bold;}

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
</STYLE>
</HEAD>

<BODY>
EOF;

include 'includes/dd_menu.txt';
?>
<p>
Here you can change a class focus.
<p>
If a skill is a cross skill for the character class select a Y  in the cross skill column.
<p>
The skill max is used to set a maximum rank for a skill, e.g if you set heal to a skill max of 5
the monster generator will only allocate a maximum of 5 ranks to the Heal skill.
<br>
<br>
<h2>Change Class Focus</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $beg = substr($k,0,3);
       if ($v == "" and $beg != "ski" and $beg != "xsk" and $beg !="max") {
          $msg = "please fill in all fields";
       }
   }
   $count1 = 0;
   while ($count1 < 6){
     $count1 = $count1  + 1;
     $count2 = 0;
     while ($count2 < 6){
       $count2 = $count2 + 1;
       $atrv1 = "atr_" . $count1;
       $atrv2 = "atr_" . $count2;
       $atra = $$atrv1;
       $atrb = $$atrv2;
       if ($count1 != $count2){
          if ($atra == $atrb){
            $msg = "$atra appears more than once in stats priorities";
          }
       }
     }
   }

   if ($msg == "") {
      include 'includes/dd_db_conn.txt';
      $insert = "insert into classfocush2 (classfh_class, classfh_focus, mon_key_1, classh_atr1, classh_atr2, classh_atr3, classh_atr4, " .
                "classh_atr5, classh_atr6, classfh_nochange, classfh_user) VALUES " .
                "('$class_tp', '$class_focus', 'path', '$atr_1', '$atr_2','$atr_3','$atr_4','$atr_5','$atr_6',' ','$user_id' )";
      echo ($insert);
      $result = mysqli_query($link, $insert);
      $update = "update classfocush2 set classh_atr1 ='$atr_1', classh_atr2 ='$atr_2', classh_atr3 ='$atr_3', classh_atr4 ='$atr_4', " .
                "classh_atr5 ='$atr_5', classh_atr6 ='$atr_6' where classfh_class =  '$class_tp' and classfh_focus = '$class_focus' and mon_key_1 = 'path'";
      $result = mysqli_query($link, $update);
//insert skills
      $count = 0;
      $delete ="delete from classfocus2 where classf_class = '$class_tp' and classf_focus = '$class_focus' and mon_key_1 = 'path'";
      $result = mysqli_query($link, $delete);
      while ($count < 20){
//find the skill atribute and take off the skill value
//
         $count   = $count + 1;
         $skillv  = "skill_" . $count;
         $tpv     = "tp_" . $count;
         $xskillv = "xskill_" . $count;
         $maxv    = "max_" . $count;
         $skill   = $$skillv;
         $tp      = $$tpv;
         $xskill  = $$xskillv;
         $max     = $$maxv;
         if ($max == 0){
             $max = 40;
         }
         if ($skill != ""){
            $insert = "INSERT INTO classfocus2 (classf_class, classf_focus , classf_skill,classf_tp, " .
                      "classf_xskill, classf_max, mon_key_1)".
                      "VALUES ('$class_tp', '$class_focus', '$skill', '$tp', '$xskill', '$max', 'path')";
//            echo $insert . " </BR>";
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
      mysqli_close($link) ;
   }
   echo "<div class=\"error\">$msg</div>" ;
} else {
      $fn = $ln = "" ;
}

?>


<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">


<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Class</TH>
  <TH>Focus</TH>
</TR>
<TR>
  <TD><? echo $class_tp ?></TD>
<?
  echo "<TD><INPUT TYPE='text' NAME='class_focus' VALUE='$class_focus'/></TD> ";
?>
  <TD><? echo $class_focus ?></TD>
</TR>
</BR>
<TR>
<TH>Ability Score Priorities</TH>
</TR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
<TH>1st</TH>
<TH>2nd</TH>
<TH>3rd</TH>
<TH>4th</TH>
<TH>5th</TH>
<TH>6th</TH>
</TR>
<TR>
<?
$count = 0;
$STR = $DEX = $CON = $INT = $WIS = $CHR = "";
while ($count < 6){
  $count = $count +1;
  $STR = $DEX = $CON = $INT = $WIS = $CHR = "";
  $atrv = "atr_" . $count;
  $atr = $$atrv;
  $$atr =  " SELECTED";
echo <<<EOF
    <TD><SELECT NAME="$atrv">
    <OPTION VALUE="STR"  $STR >STR</OPTION>
    <OPTION VALUE="DEX"  $DEX >DEX</OPTION>
    <OPTION VALUE="CON"  $CON >CON</OPTION>
    <OPTION VALUE="INT"  $INT >INT</OPTION>
    <OPTION VALUE="WIS"  $WIS >WIS</OPTION>
    <OPTION VALUE="CHR"  $CHR >CHR</OPTION>
EOF;
}
?>
</TR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Skill</TH>
  <TH>Type</TH>
  <TH>cross skill</TH>
  <TH>skill max</TH>
</TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 20) {
  echo "<TR>";
  $count = $count + 1;
  $skillv = "skill_" . $count;
  $tpv    = "tp_" . $count;
  $xskillv = "xskill_" . $count;
  $maxv    = "max_" . $count;
  $skill   = $$skillv;
  $tp      = $$tpv;
  $xskill  = $$xskillv;
  $max     = $$maxv;

echo <<<EOF
    <TD><SELECT NAME="$skillv" VALUE="<? echo $skill ?>">
EOF;

  $select = "SELECT skill_cd FROM skills order by skill_cd" ;
 
  $result = mysqli_query($link, $select) ;
//  echo "result " . $result;
  while ($row = mysqli_fetch_array($result)) {
    $skill_sel = $row[skill_cd] ;
      if ($skill_sel == $skill){
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
   $P1 = $P2 = $P3 = $P4 = $S1 = $S2 = ""; 
   if ($tp != ""){
      $$tp = " SELECTED";
   }

echo <<<EOF
  <TD><SELECT NAME="$tpv">
      <OPTION VALUE="P1"  $P1 >Primary first select</OPTION>
      <OPTION VALUE="P2"  $P2 >Primary Second select</OPTION>
      <OPTION VALUE="P3"  $P3 >Primary third select</OPTION>
      <OPTION VALUE="P4"  $P4 >Primary forth select</OPTION>
      <OPTION VALUE="S1"  $S1 >Secondary first</OPTION>
      <OPTION VALUE="S2"  $S2 >Secondary Second</OPTION> 
  </SELECT>
  </TD>
      <TD><SELECT NAME ="$xskillv">
EOF;

      if ($$xskillv == "Y"){
         $x1 = "";
         $x2 = "SELECTED";
      }else{
         $x1 = "SELECTED";
         $x2 = "";
      }
echo <<<EOF
      <OPTION VALUE=""   $x1 > </OPTION>
      <OPTION VALUE="Y"  $x2 >Y </OPTION>
  </SELECT>
  </TD>
    <TD><INPUT TYPE="text" NAME="$maxv" VALUE="$max"/></TD>
   </TR>
EOF;
   

}
mysqli_close($link);
?>
  
</TABLE>

<BR>
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>

</HTML>