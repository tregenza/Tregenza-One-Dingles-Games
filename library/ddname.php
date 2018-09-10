<<<<<<< HEAD
<?

session_start();
$link = getDBLink();
$select = "select name_tp, name_txt, name_orc, name_elf, name_human, name_sex from  names ";

$result = mysqli_query($link, $select) ;
$count = 0;
while ($row = mysqli_fetch_array($result)) {
   $count = $count +1;
   $tpv  = "tp_" . $count;
   $txtv     = "txt_" . $count;
   $orcv = "orc_" . $count;
   $elfv    = "elf_" . $count;
   $humanv = "human_" . $count;
   $sexv  = "sex_" . $count;
   $$tpv  = $row['name_tp'];
   $$txtv      = $row['name_txt'];
   $$orcv  = $row['name_orc'];
   $$elfv     = $row['name_elf'];
   $$humanv = $row['name_human'];
   $$sexv = $row['name_sex'];
}
$max = $count;




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

$link = getDBLink();
?>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }

   if ($msg == "") {
      $count = 0;
      $delete ="delete from names'";
      $result = mysqli_query($link, $delete);
      while ($count < 200){
//find the skill atribute and take off the skill value
//
         $count   = $count + 1;
         $tpv  = "tp_" . $count;
         $txtv     = "txt_" . $count;
         $orcv = "orc_" . $count;
         $elfv    = "elf_" . $count;
         $humanv = "human_" . $count;
         $sexv  = "sex_" . $count;
         $tp = $$tpv ;
         $txt = $$txtv;
         $orc = $$orcv;
         $elf = $$elfv;
         $human = $$humanv;
         $sex = $$sexv;
         if ($txt != ""){
            $insert = "INSERT INTO names (name_tp, name_txt , name_orc,name_elf, name_human, name_sex)" .
                      "VALUES ('$tp', '$txt', '$orc', '$elf', '$human', '$sex')";
//            echo $insert . " </BR>";
            $result = mysqli_query($link, $insert);
            if (!$result) {
                $msg = "$result" ." Error inserting names";
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




?>
</TR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Type</TH>
  <TH>Txt</TH>
  <TH>Orc</TH>
  <TH>Elf</TH>
  <TH>Human</TH>
  <TH>Sex</TH>
</TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 200) {
  echo "<TR>";
  $count = $count + 1;
  $tpv  = "tp_" . $count;
  $txtv     = "txt_" . $count;
  $orcv = "orc_" . $count;
  $elfv    = "elf_" . $count;
  $humanv = "human_" . $count;
  $sexv  = "sex_" . $count;
  $tp = $$tpv ;
  $txt = $$txtv;
  $orc = $$orcv;
  $elf = $$elfv;
  $human = $$humanv;
  $sex = $$sexv;


echo <<<EOF
    <TD><INPUT TYPE="text" NAME="$tpv" VALUE="$tp"/></TD>
    <TD><INPUT TYPE="text" NAME="$txtv" VALUE="$txt"/></TD>
    <TD><SELECT NAME ="$orcv">
EOF;

      if ($$orcv == "Y"){
         $x1 = "";
         $x2 = "SELECTED";
         $x3 = ""
      }else{
         if ($$orcv = "B"){
            $x1 = "";
            $x2 = "";
            $x3 = "SELECTED";
         }else{
            $x1 = "SELECTED";
            $x2 = "";
            $x3 = "";
      }
echo <<<EOF
      <OPTION VALUE=""   $x1 > </OPTION>
      <OPTION VALUE="Y"  $x2 >Y </OPTION>
      <OPTION VALUE="B"  $x3 >B </OPTION>
  </SELECT>
    <TD><SELECT NAME ="$orcv">
EOF;

      if ($$orcv == "Y"){
         $x1 = "";
         $x2 = "SELECTED";
         $x3 = ""
      }else{
         if ($$orcv = "B"){
            $x1 = "";
            $x2 = "";
            $x3 = "SELECTED";
         }else{
            $x1 = "SELECTED";
            $x2 = "";
            $x3 = "";
      }
echo <<<EOF
      <OPTION VALUE=""   $x1 > </OPTION>
      <OPTION VALUE="Y"  $x2 >Y </OPTION>
      <OPTION VALUE="B"  $x3 >B </OPTION>
  </SELECT>






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

=======
<?

session_start();
$link = getDBLink();
$select = "select name_tp, name_txt, name_orc, name_elf, name_human, name_sex from  names ";

$result = mysqli_query($link, $select) ;
$count = 0;
while ($row = mysqli_fetch_array($result)) {
   $count = $count +1;
   $tpv  = "tp_" . $count;
   $txtv     = "txt_" . $count;
   $orcv = "orc_" . $count;
   $elfv    = "elf_" . $count;
   $humanv = "human_" . $count;
   $sexv  = "sex_" . $count;
   $$tpv  = $row['name_tp'];
   $$txtv      = $row['name_txt'];
   $$orcv  = $row['name_orc'];
   $$elfv     = $row['name_elf'];
   $$humanv = $row['name_human'];
   $$sexv = $row['name_sex'];
}
$max = $count;




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

$link = getDBLink();
?>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }

   if ($msg == "") {
      $count = 0;
      $delete ="delete from names'";
      $result = mysqli_query($link, $delete);
      while ($count < 200){
//find the skill atribute and take off the skill value
//
         $count   = $count + 1;
         $tpv  = "tp_" . $count;
         $txtv     = "txt_" . $count;
         $orcv = "orc_" . $count;
         $elfv    = "elf_" . $count;
         $humanv = "human_" . $count;
         $sexv  = "sex_" . $count;
         $tp = $$tpv ;
         $txt = $$txtv;
         $orc = $$orcv;
         $elf = $$elfv;
         $human = $$humanv;
         $sex = $$sexv;
         if ($txt != ""){
            $insert = "INSERT INTO names (name_tp, name_txt , name_orc,name_elf, name_human, name_sex)" .
                      "VALUES ('$tp', '$txt', '$orc', '$elf', '$human', '$sex')";
//            echo $insert . " </BR>";
            $result = mysqli_query($link, $insert);
            if (!$result) {
                $msg = "$result" ." Error inserting names";
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




?>
</TR>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Type</TH>
  <TH>Txt</TH>
  <TH>Orc</TH>
  <TH>Elf</TH>
  <TH>Human</TH>
  <TH>Sex</TH>
</TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 200) {
  echo "<TR>";
  $count = $count + 1;
  $tpv  = "tp_" . $count;
  $txtv     = "txt_" . $count;
  $orcv = "orc_" . $count;
  $elfv    = "elf_" . $count;
  $humanv = "human_" . $count;
  $sexv  = "sex_" . $count;
  $tp = $$tpv ;
  $txt = $$txtv;
  $orc = $$orcv;
  $elf = $$elfv;
  $human = $$humanv;
  $sex = $$sexv;


echo <<<EOF
    <TD><INPUT TYPE="text" NAME="$tpv" VALUE="$tp"/></TD>
    <TD><INPUT TYPE="text" NAME="$txtv" VALUE="$txt"/></TD>
    <TD><SELECT NAME ="$orcv">
EOF;

      if ($$orcv == "Y"){
         $x1 = "";
         $x2 = "SELECTED";
         $x3 = ""
      }else{
         if ($$orcv = "B"){
            $x1 = "";
            $x2 = "";
            $x3 = "SELECTED";
         }else{
            $x1 = "SELECTED";
            $x2 = "";
            $x3 = "";
      }
echo <<<EOF
      <OPTION VALUE=""   $x1 > </OPTION>
      <OPTION VALUE="Y"  $x2 >Y </OPTION>
      <OPTION VALUE="B"  $x3 >B </OPTION>
  </SELECT>
    <TD><SELECT NAME ="$orcv">
EOF;

      if ($$orcv == "Y"){
         $x1 = "";
         $x2 = "SELECTED";
         $x3 = ""
      }else{
         if ($$orcv = "B"){
            $x1 = "";
            $x2 = "";
            $x3 = "SELECTED";
         }else{
            $x1 = "SELECTED";
            $x2 = "";
            $x3 = "";
      }
echo <<<EOF
      <OPTION VALUE=""   $x1 > </OPTION>
      <OPTION VALUE="Y"  $x2 >Y </OPTION>
      <OPTION VALUE="B"  $x3 >B </OPTION>
  </SELECT>






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

>>>>>>> 65450b134015a9177e74559b90657752af789db3
</HTML>