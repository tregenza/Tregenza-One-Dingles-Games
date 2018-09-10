<<<<<<< HEAD
<?
session_start();
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
  $count_old_x = 1;
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
  $count_new_x = 1;
}
$focus1 = "focus1";
$focus2 = "focus1";
if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }
    if ($mon_name == "") {
       $msg = "please select monster" ;
    }
    if ($class1_tp !="" and ((is_numeric($class1_level) == FALSE) or
       ($class1_level > 20) or ($class1_level < 1))) {
       $msg = "Select first class for monster and  level (1-20)";
    } else {
    if ($class2_tp !="" and ((is_numeric($class2_level) == FALSE) or
       ($class2_level > 20) or ($class2_level < 1))) {
       $msg = "Select second class for monster and level (1-20)";
    }
    }
    if ($class1_tp !="" and $class1_focus == "" and $msg == ""){
       $msg = "Now select skill focus";
    }
    if ($class2_tp !="" and $class2_focus == "" and $msg == ""){
       $msg = "Now select skill focus";
    }
    if ($class1_tp !=""){
        $focus1 = "focus1v";
    }else{
        $focus1 = "focus1";
    }
    if ($class2_tp !=""){
        $focus2 = "focus1v";
    }else{
        $focus2 = "focus1";
    }
    if ($class1_tp == "" and $class1_level != 0){
       $msg = "can not add levels to no class to add levels to monsters go to generate monster and change Racial hitdie";
    }
    if ($class2_tp == "" and $class2_level != 0){
       $msg = "can not add levels to no class to add levels to monsters go to generate monster and change Racial hitdie";
    }  
    echo $msg;
    if ($msg == "") {
      $_SESSION['smon_name'] = $mon_name;
      $_SESSION['sclass1_tp'] = $class1_tp;
      $_SESSION['sclass1_level'] = $class1_level;
      $_SESSION['sclass1_focus'] = $class1_focus;
      $_SESSION['sclass2_tp'] = $class2_tp;
      $_SESSION['sclass2_level'] = $class2_level;
      $_SESSION['sclass2_focus'] = $class2_focus;
      $_SESSION['suser'] = $user_id;
      $_SESSION['snew'] = "YES";
      $select = "SELECT count_new, count_old, count_oldmon_key from count where count_key = "KEY";
      include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $count_new = $row['count_new'];
      $count_old = $row['count_old'];
      $count_oldmon_key = $row['count_oldmon_key'];
      $count_oldmon_key = $count_oldmon_key + 1;
      if ($count_new_x == 1){
        $count_new = $count_new + 1;
      }else{
        $count_old = $count_old + 1;
      }
      $update  = "UPDATE count SET count_new = '$count_new', count_old = '$count_old', count_oldmon_key = '$count_oldmon_key' WHERE " .
                      "count_key = 'KEY'";
      $result3 = mysqli_query($link, $update) ;

    }
    $_SESSION['soldmon_key'] = $count_oldmon_key;
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
while ($loop < 2){
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
<h2>Select Monster</h2>
EOF;

$local =  $_SERVER['SERVER_NAME'];
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location = '"http://' . $local . '/dddismon.php"';
}else{
   $location =  '"http://' . $local . '/dddismon.php"';
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
<TR>
  <TH>Monster</TH>
</TR>
<TR>
  <TD><SELECT NAME="mon_name">
<?
$select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                 "mon_armour, mon_shield from monster order by mon_name";
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)) {

  $mon_sel = $row['mon_name'] ;
  $mon_hd  = $row['mon_hd'] ;
  if ($mon_sel == $mon_name)
     {
       $sel = " SELECTED" ;
      } else {
        $sel = "" ;
             }

echo <<<EOF
  <OPTION VALUE="$mon_sel" $sel > $mon_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
    </SELECT>
</TR>
</TABLE>

</BR>
<h3>Select Classes if required</h3>

<TABLE>
<TR>
  <TH>First class</TH>
  <TH>Level</TH>
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
    <TD><INPUT TYPE="text" NAME="class1_level" VALUE="<? echo $class1_level ?>"/></TD>
    <TD id="focus1"><CLASS="<? echo $focus1 ?>"><INPUT TYPE = "text" NAME = "class1_focus" 
       VALUE = "<? echo $class1_focus ?>" onfocus='changeField1(class1_tp)'</TD>
</TR>
</TABLE>




<TABLE>
<TR>
  <TH>Second class</TH>
  <TH>Level</TH>
  <TH>Skill Focus</TH>
</TR>

<TR>
  <TD><SELECT NAME="class2_tp" onchange='changeField2(class2_tp)'>
<?
  $select = "SELECT class_tp from class ORDER BY class_tp";
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)) {

  $class_sel = $row['class_tp'] ;
  if ($class_sel == $class2_tp)
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
    <TD><INPUT TYPE="text" NAME="class2_level" VALUE="<? echo $class2_level ?>"/></TD>
    <TD id="focus2"><CLASS="<? echo $focus2 ?>"><INPUT TYPE = "text" readonly = "readonly"
        NAME = "class2_focus" VALUE = "<? echo $class2_focus ?>"onfocus='changeField2(class2_tp)'</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?echo $count_new_x?>"/>
<INPUT TYPE="hidden" NAME="user", VALUE="<?echo $user_id?>"/>



<BR>
  <INPUT TYPE="submit" VALUE="Submit" />
  <INPUT TYPE="reset"  VALUE="cancel" />
<?   echo $_SERVER['SERVER_NAME']; ?>
</FORM>

</BODY>
</HTML>
=======
<?
session_start();
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
  $count_old_x = 1;
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
  $count_new_x = 1;
}
$focus1 = "focus1";
$focus2 = "focus1";
if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }
    if ($mon_name == "") {
       $msg = "please select monster" ;
    }
    if ($class1_tp !="" and ((is_numeric($class1_level) == FALSE) or
       ($class1_level > 20) or ($class1_level < 1))) {
       $msg = "Select first class for monster and  level (1-20)";
    } else {
    if ($class2_tp !="" and ((is_numeric($class2_level) == FALSE) or
       ($class2_level > 20) or ($class2_level < 1))) {
       $msg = "Select second class for monster and level (1-20)";
    }
    }
    if ($class1_tp !="" and $class1_focus == "" and $msg == ""){
       $msg = "Now select skill focus";
    }
    if ($class2_tp !="" and $class2_focus == "" and $msg == ""){
       $msg = "Now select skill focus";
    }
    if ($class1_tp !=""){
        $focus1 = "focus1v";
    }else{
        $focus1 = "focus1";
    }
    if ($class2_tp !=""){
        $focus2 = "focus1v";
    }else{
        $focus2 = "focus1";
    }
    if ($class1_tp == "" and $class1_level != 0){
       $msg = "can not add levels to no class to add levels to monsters go to generate monster and change Racial hitdie";
    }
    if ($class2_tp == "" and $class2_level != 0){
       $msg = "can not add levels to no class to add levels to monsters go to generate monster and change Racial hitdie";
    }  
    echo $msg;
    if ($msg == "") {
      $_SESSION['smon_name'] = $mon_name;
      $_SESSION['sclass1_tp'] = $class1_tp;
      $_SESSION['sclass1_level'] = $class1_level;
      $_SESSION['sclass1_focus'] = $class1_focus;
      $_SESSION['sclass2_tp'] = $class2_tp;
      $_SESSION['sclass2_level'] = $class2_level;
      $_SESSION['sclass2_focus'] = $class2_focus;
      $_SESSION['suser'] = $user_id;
      $_SESSION['snew'] = "YES";
      $select = "SELECT count_new, count_old, count_oldmon_key from count where count_key = "KEY";
      include 'includes/dd_db_conn.txt';
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $count_new = $row['count_new'];
      $count_old = $row['count_old'];
      $count_oldmon_key = $row['count_oldmon_key'];
      $count_oldmon_key = $count_oldmon_key + 1;
      if ($count_new_x == 1){
        $count_new = $count_new + 1;
      }else{
        $count_old = $count_old + 1;
      }
      $update  = "UPDATE count SET count_new = '$count_new', count_old = '$count_old', count_oldmon_key = '$count_oldmon_key' WHERE " .
                      "count_key = 'KEY'";
      $result3 = mysqli_query($link, $update) ;

    }
    $_SESSION['soldmon_key'] = $count_oldmon_key;
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
while ($loop < 2){
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
<h2>Select Monster</h2>
EOF;

$local =  $_SERVER['SERVER_NAME'];
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location = '"http://' . $local . '/dddismon.php"';
}else{
   $location =  '"http://' . $local . '/dddismon.php"';
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
<TR>
  <TH>Monster</TH>
</TR>
<TR>
  <TD><SELECT NAME="mon_name">
<?
$select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                 "mon_armour, mon_shield from monster order by mon_name";
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)) {

  $mon_sel = $row['mon_name'] ;
  $mon_hd  = $row['mon_hd'] ;
  if ($mon_sel == $mon_name)
     {
       $sel = " SELECTED" ;
      } else {
        $sel = "" ;
             }

echo <<<EOF
  <OPTION VALUE="$mon_sel" $sel > $mon_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
    </SELECT>
</TR>
</TABLE>

</BR>
<h3>Select Classes if required</h3>

<TABLE>
<TR>
  <TH>First class</TH>
  <TH>Level</TH>
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
    <TD><INPUT TYPE="text" NAME="class1_level" VALUE="<? echo $class1_level ?>"/></TD>
    <TD id="focus1"><CLASS="<? echo $focus1 ?>"><INPUT TYPE = "text" NAME = "class1_focus" 
       VALUE = "<? echo $class1_focus ?>" onfocus='changeField1(class1_tp)'</TD>
</TR>
</TABLE>




<TABLE>
<TR>
  <TH>Second class</TH>
  <TH>Level</TH>
  <TH>Skill Focus</TH>
</TR>

<TR>
  <TD><SELECT NAME="class2_tp" onchange='changeField2(class2_tp)'>
<?
  $select = "SELECT class_tp from class ORDER BY class_tp";
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)) {

  $class_sel = $row['class_tp'] ;
  if ($class_sel == $class2_tp)
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
    <TD><INPUT TYPE="text" NAME="class2_level" VALUE="<? echo $class2_level ?>"/></TD>
    <TD id="focus2"><CLASS="<? echo $focus2 ?>"><INPUT TYPE = "text" readonly = "readonly"
        NAME = "class2_focus" VALUE = "<? echo $class2_focus ?>"onfocus='changeField2(class2_tp)'</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?echo $count_new_x?>"/>
<INPUT TYPE="hidden" NAME="user", VALUE="<?echo $user_id?>"/>



<BR>
  <INPUT TYPE="submit" VALUE="Submit" />
  <INPUT TYPE="reset"  VALUE="cancel" />
<?   echo $_SERVER['SERVER_NAME']; ?>
</FORM>

</BODY>
</HTML>
>>>>>>> 65450b134015a9177e74559b90657752af789db3
