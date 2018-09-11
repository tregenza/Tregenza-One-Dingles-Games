<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<h2>Damage Results</h2>


<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       if ($v == "") {
          $msg = "please fill in all fields" ;
       }
   }
   if ($dam_size !== "") {
      $$dam_size = " SELECTED" ;
   }
   if ($msg == "") {
      $insert = "INSERT into damage 
                 (dam_base, dam_size,damage)
                 VALUES ('$dam_base','$dam_size','$damage')" ;
  
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


<TABLE BORDER="4" CELLPADDING="7">
<TR>
  <TH>Base Damage</TH>
  <TH>Size</TH>
  <TH>Damage</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="dam_base" VALUE="<? echo $dam_base ?>"/></TD> 
  <TD><SELECT NAME="dam_size" VALUE="<? echo $dam_size ?>">
<?
$select = "SELECT size_cat FROM size" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$size_sel = $row['size_cat'] ;
if ($size_sel == $dam_size)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$size_sel" $sel > $size_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
   <TD><INPUT TYPE="text" NAME="damage" VALUE="<? echo $damage ?>"/></TD> 
</TR>
</TABLE>

<BR>
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>
</HTML>