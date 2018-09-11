<?php
/*
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
}
*/
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
    if ($msg == "") {
      $_SESSION['smon_name'] = $mon_name;
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
//include 'includes/dd_menu.txt' ;
$link = getDBLink();
echo <<<EOF
<h2>Change Monster</h2>
EOF;

$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$ddpost = $url . $domain;
//echo $location;
if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}
/*
if ($msg == "" and $_POST){
echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript">
     window.location = $location;
  </script>
EOF;
}
*/
?>
<FORM METHOD="post" ACTION="<?php echo $ddpost; ?>">
<TABLE BORDER="3" CELLPADDING="5">
<TR>
  <TH>Monster</TH>
</TR>
<TR>
  <TD><SELECT NAME="mon_name" VALUE="<?php echo $mon_name ?>">
<?php
  $select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield from monster2 where mon_key_1 = '$wp_user' order by mon_name";
//  include 'includes/dd_db_conn.txt';
  $link = getDBLink();
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
</TD>
</TR>
</TABLE>






<BR>
  <INPUT TYPE="submit" VALUE="Change Monster" style="height: 70px; width: 200px" />
</FORM>

</BODY>
</HTML>