<?
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
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
<h2>Add Class Focus</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,3);
       if ($v == "" and $beg != "ski" and $beg != "xsk" and $beg !="max") {
          $msg = "please fill in all fields";
       }
   }
   
   if ($msg == "") { 
      include 'includes/dd_db_conn.txt';

//insert skills
      $count = 0;
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
            $insert = "INSERT INTO classfocush (classfh_class, classfh_focus , classfh_user, classfh_nochange) " .
                      "VALUES ('$class', '$focus', '$user_id', '')";
//            echo $insert . " </BR>";
            $result = mysqli_query($link, $insert);
            $insert = "INSERT INTO classfocus (classf_class, classf_focus , classf_skill,classf_tp, " .
                      "classf_xskill, classf_max)". 
                      "VALUES ('$class', '$focus', '$skill', '$tp', '$xskill', '$max')";
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
<p>
Here you can create your own class focus.
<p>
If a skill is a cross skill for the character class select a Y  in the cross skill column.
<p>
The skill max is used to set a maximum rank for a skill, e.g if you set heal to a skill max of 5
the monster generator will only allocate a maximum of 5 ranks to the Heal skill.  
<p>
If you set no maximum it will default to 40.
<br>
<br>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Class</TH>
  <TH>Focus</TH>
</TR>

<TR>
  <TD><SELECT NAME="class" VALUE="<? echo $class ?>">
<?
$select = "SELECT class_tp FROM class" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$class_sel = $row['class_tp'] ;
if ($class_sel == $class)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$class_sel" $sel > $class_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
   <TD><INPUT TYPE="text" NAME="focus" VALUE="<? echo $focus ?>"/></TD> 
</TR> 
</BR>


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
    <TD><SELECT NAME="$skillv">
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