<<<<<<< HEAD
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<h2>Add Skills</h2>


<?
$STR = $INT = $WIS = $CON = $CHR = $DEX = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       if ($v == "") {
          $msg = "please fill in both fields" ;
       }
   }
   if ($skill_atr !== "") {
     $$skill_atr = " SELECTED" ;
   }
   if ($msg == "") {
      $insert = "INSERT into skills 
                 (skill_cd, skill_atr)
                 VALUES ('$skill_cd','$skill_atr')" ;
  
      include 'includes/dd_db_conn.txt';

      if (!mysqli_query($link, $insert)) {
         $msg = "Error inserting data";
      }
      else {
         $msg = "record sucessfully added" ;
          $fn = $ln = "" ;
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


<TABLE BORDER="3" CELLPADDING="5">
<TR>
  <TH>Skill</TH>
  <TH>Key Ability</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="skill_cd" VALUE="<? echo $skill_cd ?>"/></TD> 
  <TD><SELECT NAME="skill_atr" VALUE="<? echo $skill_atr ?>">
      <OPTION VALUE="STR" <? echo $STR ?>>STR</OPTION>
      <OPTION VALUE="INT" <? echo $INT ?>>INT</OPTION>
      <OPTION VALUE="WIS" <? echo $WIS ?>>WIS</OPTION>
      <OPTION VALUE="DEX" <? echo $DEX ?>>DEX</OPTION>
      <OPTION VALUE="CON" <? echo $CON ?>>CON</OPTION>
      <OPTION VALUE="CHR" <? echo $CHR ?>>CHR</OPTION> 
      </SELECT>
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
<h2>Add Skills</h2>


<?
$STR = $INT = $WIS = $CON = $CHR = $DEX = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       if ($v == "") {
          $msg = "please fill in both fields" ;
       }
   }
   if ($skill_atr !== "") {
     $$skill_atr = " SELECTED" ;
   }
   if ($msg == "") {
      $insert = "INSERT into skills 
                 (skill_cd, skill_atr)
                 VALUES ('$skill_cd','$skill_atr')" ;
  
      include 'includes/dd_db_conn.txt';

      if (!mysqli_query($link, $insert)) {
         $msg = "Error inserting data";
      }
      else {
         $msg = "record sucessfully added" ;
          $fn = $ln = "" ;
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


<TABLE BORDER="3" CELLPADDING="5">
<TR>
  <TH>Skill</TH>
  <TH>Key Ability</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="skill_cd" VALUE="<? echo $skill_cd ?>"/></TD> 
  <TD><SELECT NAME="skill_atr" VALUE="<? echo $skill_atr ?>">
      <OPTION VALUE="STR" <? echo $STR ?>>STR</OPTION>
      <OPTION VALUE="INT" <? echo $INT ?>>INT</OPTION>
      <OPTION VALUE="WIS" <? echo $WIS ?>>WIS</OPTION>
      <OPTION VALUE="DEX" <? echo $DEX ?>>DEX</OPTION>
      <OPTION VALUE="CON" <? echo $CON ?>>CON</OPTION>
      <OPTION VALUE="CHR" <? echo $CHR ?>>CHR</OPTION> 
      </SELECT>
</TR>
</TABLE>

<BR>
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>
>>>>>>> 65450b134015a9177e74559b90657752af789db3
</HTML>