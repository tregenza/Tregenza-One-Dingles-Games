<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<h2>Add Skill Synergies</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,6);
       if ($v == "" and $beg != "skill2" ) {
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
         $skillv  = "skill2_" . $count;
         $skill2   = $$skillv;
         if ($skill1 != "" and $skill2 != ""){ 
            $insert = "INSERT INTO skillsyn (skillsyn_skill1, skillsyn_skill2 ) ". 
                      "VALUES ('$skill1', '$skill2')";
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
      echo "</BR> $msg";
      $fn = $ln = "" ;
}

?>


<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">


<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Basic Skill</TH>
</TR>

<TR>
  <TD><SELECT NAME="skill1"">
<?
$select = $select = "SELECT skill_cd FROM skills order by skill_cd" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

   $skill_sel = $row[skill_cd] ;
   if ($skill_sel == $skill1)
      {
       $sel = " SELECTED" ;
      } else {
       $sel = "" ;
       }

echo <<<EOF
  <OPTION VALUE="$skill_sel" $sel > $skill_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
   
</TR> 
</BR>


<TR>
  <TH>Gives a bonus to Skills</TH>
</TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 20) {
  echo "<TR>";
  $count = $count + 1;
  $skillv = "skill2_" . $count;
  $skill  = $$skillv;  

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
}



mysqli_close($link);
?>
</SELECT>  
</TABLE>

<BR>
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>

</HTML>