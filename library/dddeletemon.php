<?PHP
//session_start();
global $wp_user;
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$ddpost = $url . $domain;
$mag = "";
/* New CT 15/6/18 */
$ddpost = home_url( add_query_arg( array(), $wp->request ) );
$mon_name = "";
//echo wp_user;
if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
    }
    if ($mon_name == "") {
       $msg = "please select monster" ;
    }

 // echo "msg $msg delete = $delete";

   
    if ($msg == "" and $delete = "Delete Monster") {
      $link = getDBLink();
      $delete = "delete from monster2 where mon_name = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monfeat2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monskill2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;

      $delete = "delete from monweap2 where monweap_mon = '$mon_name' and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monspec2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from montreas2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monorg2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monlang2 where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monskillrb where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $delete = "delete from monbuff where mon_name = '$mon_name'  and mon_key_1 = '$wp_user'";
      $result = mysqli_query($link, $delete) ;
      $msg =  $mon_name . " has been Deleted";
    }
}
echo <<<EOF
<HTML>
<HEAD>
</HEAD>
<BODY>
EOF;



echo <<<EOF
<h2>Delete Monster</h2>
EOF;

if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}
 $link = getDBLink();

?>
<FORM METHOD="post" ACTION="<?php echo $ddpost; ?>">
<TABLE BORDER="3" CELLPADDING="5">
<TR>
  <TH>Monter</TH>
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
</TR>
</TABLE>






<BR>
  <INPUT TYPE="submit" VALUE="Delete Monster" NAME="delete" style="height: 70px; width: 200px"  />
</FORM>

</BODY>
</HTML>