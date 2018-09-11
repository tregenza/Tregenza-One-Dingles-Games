<?
session_start();
//if (isSet($_COOKIE['dd_user_id'])){
//  $user_id = $_COOKIE['dd_user_id'];
//}else{
//  $user_id = "dd" . time();
//  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
//}
if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }
    if ($spell_name == "") {
       $msg = "please select spell" ;
    }
    if ($msg == "") {
      $_SESSION['spell_name'] = $spell_name;
    }
}
$background_blue = "LightSkyBlue";
$background_grey = "LightGrey";

echo <<<EOF
<HTML>
<HEAD>
<STYLE>
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
include 'includes/dd_menu.txt' ;

echo <<<EOF
<h2>Change Spell</h2>
EOF;


if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}

$local =  $_SERVER['SERVER_NAME'];
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location = '"http://' . $local . '/apache2-default/ddchangespell2.php"';
}else{
   $location =  '"ddchangespell2.php"';
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
  <TH>Spell</TH>
</TR>
<TR>
  <TD><SELECT NAME="spell_name" VALUE="<? echo $spell_name ?>">
<?
  $select = "SELECT spell_name from spell order by spell_name";
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
  while ($row = mysqli_fetch_array($result)) {

  $spell_sel = $row['spell_name'] ;

  if ($spell_sel == $spell_name)
     {
       $sel = " SELECTED" ;
      } else {
        $sel = "" ;
             }

echo <<<EOF
  <OPTION VALUE="$spell_sel" $sel > $spell_sel </OPTION>
EOF;
}
mysqli_close($link); 
?>
    </SELECT>
</TR>
</TABLE>






<BR>
  <INPUT TYPE="submit" VALUE="Change" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>
</HTML>