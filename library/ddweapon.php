<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>

<BODY>
<h2>Add Weapons</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,3);
       if ($v == "" and $k != "damage2" and $k != "range" and $k != "range_str") {
          $msg = "please fill in all fields";
       }
   }
   if ($msg == "") { 
      include 'includes/dd_db_conn.txt';

//insert weapon
      if ($weapon != ""){ 
         $insert = "INSERT INTO weapons (weap_id, weap_dam , weap_dam2,weap_crit, weap_crit_ch, " .
             "weap_type,weap_range, weap_cat,weap_range_tp,weap_range_str)". 
             "VALUES ('$weapon', '$damage', '$damage2','$critical', '$crit_ch'," .
             "'$type','$range', '$cat','$range_type','$range_str')";
         echo $insert . " </BR>";
         $result = mysqli_query($link, $insert);
         mysqli_close($link) ;
         if (!$result) {
             $msg = "$result" ." Error inserting weapon";
         }
         else {
           $msg = "record sucessfully added" ;
            $fn = $ln = "" ;   
              }
       }
   }
   echo "<div class=\"error\">$msg</div>" ;
} 
?>
<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>Weapon</TH>
  <TH>Damage1</TH>
  <TH>Damage2</TH>
  <TH>Critical</TH>
  <TH>Crit chance</TH>
  <TH>Type</TH>
  <TH>Range</TH>
  <TH>Catagory</TH>
  <TH>Reach</TH>
  <TH>Allow str for Ranged</TH>
</TR>

<TR>
  <TD><INPUT TYPE="text" NAME="weapon" VALUE="<? echo $weapon ?>"/></TD>  
  <TD><SELECT NAME="damage">
<?
$select = "SELECT DISTINCT dam_base FROM damage" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

  $damage_sel = $row['dam_base'] ;
  if ($damage_sel == $damage)
   {
    $sel = " SELECTED" ;
   } else {
     $sel = "" ;
          }
echo <<<EOF
  <OPTION VALUE="$damage_sel" $sel > $damage_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
  <TD><SELECT NAME="damage2">
<?
$select = "SELECT DISTINCT dam_base FROM damage" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$damage_sel = $row['dam_base'] ;
if ($damage_sel == $damage2)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$damage_sel" $sel > $damage_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
<?
$c2 = $c3 = $c4 = $c34 = ""; 
if ($critical != ""){
    $criticalv = "c" . $critical;
    $$criticalv = " SELECTED";
   }
echo <<<EOF
<TD><SELECT NAME="critical">
      <OPTION VALUE="2"  $c20 >x2</OPTION>
      <OPTION VALUE="3"  $c19 >x3</OPTION>
      <OPTION VALUE="4"  $c18 >x4</OPTION>
      <OPTION VALUE="34"  $c17 >x3/x4</OPTION>      
  </SELECT>
EOF;
$c20 = $c19 = $c18 = $c17 = $c16 = ""; 
if ($criti_ch != ""){
    $criti_chv = "c" . $critical;
    $$crit_chv = " SELECTED";
   }
echo <<<EOF
<TD><SELECT NAME="crit_ch">
      <OPTION VALUE="20"  $c20 >20</OPTION>
      <OPTION VALUE="19"  $c19 >19-20</OPTION>
      <OPTION VALUE="18"  $c18 >18-20</OPTION>
      <OPTION VALUE="17"  $c17 >17-20</OPTION>
      <OPTION VALUE="16"  $c16 >16-20</OPTION> 
  </SELECT>
EOF;

$c1H = $c2H = $cLT = $cDB = $cUN = ""; 
if ($type != ""){
    $typev = "c" . $type;
    $$typev = " SELECTED";
   }
echo <<<EOF
<TD><SELECT NAME="type">
      <OPTION VALUE="1H"  $c1H >one handed</OPTION>
      <OPTION VALUE="2H"  $c2H >two handed</OPTION>
      <OPTION VALUE="LT"  $cLT >light</OPTION>
      <OPTION VALUE="DB"  $cDB >double</OPTION>
      <OPTION VALUE="UN"  $cUN >unarmed</OPTION> 
  </SELECT>
EOF;

?>
   <TD><INPUT TYPE="text" NAME="range" VALUE="<? echo $range ?>"/></TD> 
<?
$c0 = $c1 = $c2 = $c3 = $c4 = ""; 
if ($cat != ""){
    $catv = "c" . substr($cat,0,1);
    $$catv = " SELECTED";
   }
echo <<<EOF
<TD><SELECT NAME="cat">
      <OPTION VALUE="0-Natural" $c0 >Natural Attack</OPTION>
      <OPTION VALUE="1-Simple"  $c1 >Simple</OPTION>
      <OPTION VALUE="2-Martial" $c2 >Martial</OPTION>
      <OPTION VALUE="3-Exotic"  $c3 >Exotic</OPTION>       
  </SELECT>
EOF;
$cNatural = $cRanged = $cMelee = ""; 
if ($range_type != ""){
    $range_typev = "c" . $range_type;
    $$range_typev = " SELECTED";
}
echo <<<EOF
<TD><SELECT NAME="range_type">
      <OPTION VALUE="Natural" $cNatural >Natural Attack</OPTION>
      <OPTION VALUE="Ranged"  $cRanged >Ranged</OPTION>
      <OPTION VALUE="Melee" $cMelee >Melee</OPTION>
  </SELECT>
EOF;
?>
   <TD><INPUT TYPE="text" NAME="range_str" VALUE="<? echo $range_str ?>"/></TD> 
</TR> 
</TABLE>

<BR>
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>

</HTML>