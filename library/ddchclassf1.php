<?
session_start();
$focus1 = "focus1";
$focus2 = "focus1";
if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }
    if ($class1_tp !="" and $class1_focus == "" and $msg == ""){
       $msg = "Now select skill focus";
    }
    if ($class1_tp !=""){
        $focus1 = "focus1v";
    }else{
        $focus1 = "focus1";
    }
    if ($msg == "") {
      $_SESSION['sclass1_tp'] = $class1_tp;
      $_SESSION['sclass1_focus'] = $class1_focus;
    }
//  echo "<div class=\"error\">$msg</div>" ;
}
else {
      $fn = $ln = "" ;
}
$background_blue = "LightSkyBlue";
$background_grey = "LightGrey";
echo <<<EOF
<HTML>
<HEAD>
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
.error {padding: 10px; color: #CC0000; font-weight: bold;}

.focus1 {
        visibility: hidden;
}
.focus1v {
        font-family: "Times New Roman";
        font-size: 1.0em;
}
.optionFighter (
        style="width: 40px";
}
</STYLE>
<SCRIPT>
EOF;

$loop = 0;
while ($loop < 1){
  $loop = $loop + 1;
  $select = "SELECT class_tp from class ORDER BY class_tp";
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
   while ($row = mysqli_fetch_array($result)) {
     $type = $row['class_tp'];
     if ($type != ""){
       $var =  $type . "Opt" . $loop;
       echo "var " . $var . " = '';";
       $func = "get" . $type . $loop;
       echo "function $func (number) {";
       $select2 = "SELECT DISTINCT classf_focus from classfocus where classf_class = '$type' ORDER BY classf_class";
//  echo $select . "</BR>";
       include 'includes/dd_db_conn.txt';
       $result2 = mysqli_query($link, $select2) ;
       while ($row2 = mysqli_fetch_array($result2)) {
          $classf_sel = $row2['classf_focus'] ;
          $focusv = "class" . $loop . "_focus";
          $focus = $$focusv;
          if ($classf_sel == $focus){
            $sel = " SELECTED" ;
          }else{
            $sel = "" ;
          }
echo <<<EOF
     $var = $var + '<OPTION VALUE="$classf_sel" > $classf_sel </OPTION>';
EOF;

       }

       echo "selectOptions = $var " . ";" ;
//         echo "alert(selectOptions);";
       echo "}";
     }
   }
}

echo <<<EOF
function changeField1(classtp) {
 if (classtp.value != ""){
   var classFeat = "focus1" + classtp.value;
//   classFeat = "'" + classFeat + "'";
//   alert(classFeat);
   var  functionRun = "get" + classtp.value + "1";
   var classOpt = classtp.value + "Opt1";
   var selectOptions = "";
//   alert (functionRun);
   window[functionRun]();
//  {functionRun(1)};
//   alert (window.selectOptions);
   document.getElementById("focus1").innerHTML = '<SELECT NAME="class1_focus">' + window.selectOptions;
 }
}
function changeField2(classtp) {
  if (classtp.value != ""){
   var classFeat = "focus2" + classtp.value;
//   classFeat = "'" + classFeat + "'";
//   alert(classFeat);
   var  functionRun = "get" + classtp.value + "2";
   var classOpt = classtp.value + "Opt2";
   var selectOptions = "";
//   alert (functionRun);
   window[functionRun]();
//  {functionRun(1)};
//   alert (window.selectOptions);
   document.getElementById("focus2").innerHTML = '<SELECT NAME="class2_focus">' + window.selectOptions;
  }
}
</SCRIPT>
</HEAD>
<BODY>
EOF;

include 'includes/dd_menu.txt' ;
echo <<<EOF
<h2>Change Class Focus</h2>
EOF;

$local =  $_SERVER['SERVER_NAME'];
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location = '"http://' . $local . '/apache2-default/ddchclassf2.php"';
}else{
   $location =  '"ddchclassf2.php"';
}
//echo $location;
if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}
if ($msg == "" and $_POST){
echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript">
     window.location = $location;
  </script>

EOF;
}


?>
<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">
<TABLE BORDER="3" CELLPADDING="5">

</BR>
<h3>Select Class</h3>

<TABLE>
<TR>
  <TH>class</TH>
  <TH>Skill Focus</TH>
</TR>

<TR>
  <TD><SELECT NAME="class1_tp" id="feat1" onchange='changeField1(class1_tp)'>
<?
  $select = "SELECT class_tp from class ORDER BY class_tp";
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)) {

  $class_sel = $row['class_tp'] ;
  if ($class_sel == $class1_tp)
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
    <TD id="focus1"><CLASS="<? echo $focus1 ?>"><INPUT TYPE = "text" NAME = "class1_focus"
       VALUE = "<? echo $class1_focus ?>" onfocus='changeField1(class1_tp)'</TD>
</TR>
</TABLE>


<BR>
  <INPUT TYPE="submit" VALUE="Submit" />
  <INPUT TYPE="reset"  VALUE="cancel" />
<?   echo $_SERVER['SERVER_NAME']; ?>
</FORM>

</BODY>
</HTML>