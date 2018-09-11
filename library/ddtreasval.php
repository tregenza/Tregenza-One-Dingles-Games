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
<h2>Treasue Value</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,3);
       if ($v == "" and $beg != "max" and $beg != "min" and $beg !="mul" and $beg != "sub" and $beg != "amo" and $beg != "typ" and $beg != "ave") {
          $msg = "please fill in all fields " .$k;
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
         $maxv    = "max_" . $count;
         $minv    = "min_" . $count;
         $amount_diev   = "amount_die_" . $count;
         $multv    = "mult_" . $count;
         $typev    = "type_" . $count;
         $averagev  = "average_" .$count;
         $max      = $$maxv;
         $min      = $$minv;
         $amount_die  = $$amount_diev;
         $mult     = $$multv;
         $type    = $$typev;
         $average = $$averagev;
         if ($max != 0 and $max !=""){
            $insert = "INSERT INTO treasval (treasval_subtype , treasval_max, treasval_min, treasval_die, treasval_mult, treasval_type, treasval_average) " .
                      "VALUES ('$subtype', '$max', '$min', '$amount_die', '$mult', '$type', '$average')";
            echo $insert . " </BR>";
            $result = mysqli_query($link, $insert);
            if (!$result) {
                $msg = "$result" ." Error treasval";
            } else {
              $msg = "record sucessfully added" ;

            }
         }
      }
      mysqli_close($link) ;
   }
   echo "<div class=\"error\">$msg</div>" ;
}

?>


<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">
<br>
<br>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
<?

echo <<<EOF
<TD><SELECT TYPE="text" NAME="subtype">
EOF;
include 'includes/dd_db_conn.txt';
$select = "SELECT treassub_type FROM treassub";
$result = mysqli_query($link, $select) ;
//  echo "result " . $result;
while ($row = mysqli_fetch_array($result)){
  $subtype_sel = $row[treassub_type] ;
    if ($subtype_sel == $subtype){
       $sel = " SELECTED" ;
    }else{
       $sel = "" ;
    }
echo <<<EOF
     <OPTION VALUE="$subtype_sel" $sel > $subtype_sel </OPTION>
EOF;
}
?>
  </SELECT>
  </TD>
</TR>
</BR>
<TR>
  <TH>Min</TH>
  <TH>Max</TH>
  <TH>Amount dice</TH>
  <TH>multiplier</TH>
  <TH>Average</TH>
  <TH>type</TH>
</TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 20) {
  echo "<TR>";
  $count = $count + 1;
  $maxv = "max_" . $count;
  $minv    = "min_" . $count;
  $amount_diev = "amount_die_" . $count;
  $multv    = "mult_" . $count;
  $subtypev    = "subtype_" . $count;
  $typev    = "type_" . $count;
  $averagev  = "average_" .$count;

  $max   = $$maxv;
  $min      = $$minv;
  $amount_die  = $$amount_diev;
  $mult     = $$multv;
  $subtype  = $$subtypev;
  $type = $$typev;
  $average = $$averagev;
echo <<<EOF
<TD><INPUT TYPE="text" NAME="$minv" VALUE="$min"/></TD>
<TD><INPUT TYPE="text" NAME="$maxv" VALUE="$max"/></TD>
<TD><INPUT TYPE="text" NAME="$amount_diev" VALUE="$amount_die"/></TD>
<TD><INPUT TYPE="text" NAME="$multv" VALUE="$mult"/></TD>
<TD><INPUT TYPE="text" NAME="$averagev" VALUE="$average"/></TD>
<TD><INPUT TYPE="text" NAME="$typev" VALUE="$type"/></TD>
EOF;
?>
</TR>
<?
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