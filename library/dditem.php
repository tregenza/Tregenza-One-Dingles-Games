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
<h2>Treasue Item</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,3);
       if ($v == "" and $beg != "max" and $beg != "min" and $beg !="sub" and $beg != "ite" and $beg != "val" and $beg != "bon" and $beg != "fou" ) {
          $msg = "please fill in all fields " .$k;
       }
   }

   if ($msg == "") {
      include 'includes/dd_db_conn.txt';

//insert skills
      $count = 0;
      while ($count < 100){
//find the skill atribute and take off the skill value
//
         $count   = $count + 1;
         $maxv    = "max_" . $count;
         $minv    = "min_" . $count;
         $subtypev = "subtype_" . $count;
         $valuev  = "value_" .$count;
         $itemv = "item_" . $count;
         $bonusv = "bonus_" . $count;
         $foundv = "found_" . $count;
         $max      = $$maxv;
         $min      = $$minv;
         $item  = $$itemv;
         $mult     = $$multv;
         $subtype = $$subtypev;
         $value = $$valuev;
         $bonus = $$bonusv;
         $found = $$foundv;
         if ($max != 0 and $max !=""){
            $insert = "INSERT INTO itemtype (itemtype_id , itemtype_max, itemtype_min, itemtype_subtype, itemtype_item, itemtype_value, itemtype_bonus, itemtype_found ) " .
                      "VALUES ('$type', '$max', '$min', '$subtype', '$item', '$value', '$bonus','$found')";
            echo $insert . " </BR>";
            $result = mysqli_query($link, $insert);
            if (!$result) {
                $msg = "$result" ." Error Item";
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
<TD><INPUT TYPE="text" NAME="type" VALUE = "$type">
EOF;
include 'includes/dd_db_conn.txt';
//$select = "SELECT treassub_type FROM treassub";
//$result = mysqli_query($link, $select) ;
//  echo "result " . $result;
//while ($row = mysqli_fetch_array($result)){
//  $type_sel = $row[treassub_type] ;
//    if ($type_sel == $type){
//      $sel = " SELECTED" ;
//    }else{
//       $sel = "" ;
//    }
//echo <<<EOF
//     <OPTION VALUE="$type_sel" $sel > $type_sel </OPTION>
//EOF;
//}
?>
</TD>
</TR>
</BR>
<TR>
  <TH>Min</TH>
  <TH>Max</TH>
  <TH>Sub type</TH>
  <TH>Item</TH>
  <TH>Bonus</TH>
  <TH>Value</TH>
  <TH>Found</TH>
</TR>
<?
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 100) {
  echo "<TR>";
  $count = $count + 1;
  $maxv = "max_" . $count;
  $minv    = "min_" . $count;
  $subtypev = "subtype_" . $count;
  $itemv    = "item_" . $count;
  $bonusv = "bonus_" . $count;
  $valuev    = "value_" . $count;
  $foundv  = "found_" . $count;
  $max   = $$maxv;
  $min      = $$minv;
  $subtype  = $$subtypev;
  $item = $$itemv;
  $value = $$valuev;
  $bonus = $$bonusv;
  $found = $$foundv;
echo <<<EOF
<TD><INPUT TYPE="text" NAME="$minv" VALUE="$min"/></TD>
<TD><INPUT TYPE="text" NAME="$maxv" VALUE="$max"/></TD>
<TD><INPUT TYPE="text" NAME="$subtypev" VALUE="$subtype"/></TD>
<TD><INPUT TYPE="text" NAME="$itemv" VALUE="$item"/></TD>
<TD><INPUT TYPE="text" NAME="$bonusv" VALUE="$bonus"/></TD>
<TD><INPUT TYPE="text" NAME="$valuev" VALUE="$value"/></TD>
<TD><INPUT TYPE="text" NAME="$foundv" VALUE="$found"/></TD>
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