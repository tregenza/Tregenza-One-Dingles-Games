<<<<<<< HEAD
<?php
if (isSet($_COOKIE['dd_user_id'])){
  $user_id = $_COOKIE['dd_user_id'];
}else{
  $user_id = "dd" . time();
  setcookie('dd_user_id',$user_id, time() + (60*60*24*365));
}
?>
<HTML>
<HEAD>
<?php
/*
<STYLE>
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
*/
?>
</HEAD>

<BODY>
EOF;

include 'includes/dd_menu.txt';
?>
<h2>Treasue for CR</h2>
<?php
$cr = 0;
$magic_type_no = 0;
$count_new_x = 0;
$mon_hd = 0;

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,3);
       if ($v == "" and $beg != "max" and $beg != "min" and $beg !="mul" and $beg != "sub" and $beg != "amo") {
          $msg = "please fill in all fields " .$k;
       }
   }

   if ($msg == "") {
  //    include 'includes/dd_db_conn.txt';
     $link = getDBLink();

//insert skills
      $count = 0;
      while ($count < 10){
//find the skill atribute and take off the skill value
//
         $count   = $count + 1;
         $maxv    = "max_" . $count;
         $minv    = "min_" . $count;
         $amount_diev   = "amount_die_" . $count;
         $multv    = "mult_" . $count;
         $subtypev    = "subtype_" . $count;

         $max      = $$maxv;
         $min      = $$minv;
         $amount_die  = $$amount_diev;
         $mult     = $$multv;
         $subtype    = $$subtypev;
         if ($max != 0 and $max !=""){
            $insert = "INSERT INTO treasure (treas_cr, treas_type , treas_max, treas_min, treas_dice, treas_mult, treas_subtype) " .
                      "VALUES ('$cr', '$type', '$max', '$min', '$amount_die', '$mult', '$subtype')";
            echo $insert . " </BR>";
            $result = mysqli_query($link, $insert);
            if (!$result) {
                $msg = "$result" ." Error treasure";
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


<FORM METHOD="post" ACTION="<?php echo $_SERVER['PHP_SELF'] ?>">
<br>
<br>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>CR Rating</TH>
  <TH>Treasure Type</TD>
</TR>

<TR>
  <TD><SELECT NAME="cr">
<?php
$count = 0;
while ($count < 40){
$count += 1;
$cr_sel = $count;
if ($cr_sel == $cr){
    $sel = " SELECTED" ;
}else{
  $sel = "" ;
}

echo <<<EOF
  <OPTION VALUE="$cr_sel" $sel > $cr_sel </OPTION>
EOF;
}
$coins = $goods = $items = "";
   if ($type != ""){
      $$type = " SELECTED";
   }
echo <<<EOF
  <TD><SELECT NAME="type">
      <OPTION VALUE="coins"  $coins >Coins</OPTION>
      <OPTION VALUE="goods"  $goods >Goods</OPTION>
      <OPTION VALUE="items"  $items >Items</OPTION>
  </SELECT>
  </TD>
EOF;
?>
</TR>
</BR>
<TR>
  <TH>Min</TH>
  <TH>Max</TH>
  <TH>Amount dice</TH>
  <TH>multiplier</TH>
  <TH>type</TH>
</TR>
<?php
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 10) {
  echo "<TR>";
  $count = $count + 1;
  $maxv = "max_" . $count;
  $minv    = "min_" . $count;
  $amount_diev = "amount_die_" . $count;
  $multv    = "mult_" . $count;
  $subtypev    = "subtype_" . $count;
  $max   = $$maxv;
  $min      = $$minv;
  $amount_die  = $$amount_diev;
  $mult     = $$multv;
  $subtype  = $$subtypev;
echo <<<EOF
<TD><INPUT TYPE="text" NAME="$minv" VALUE="$min"/></TD>
<TD><INPUT TYPE="text" NAME="$maxv" VALUE="$max"/></TD>
<TD><INPUT TYPE="text" NAME="$amount_diev" VALUE="$amount_die"/></TD>
<TD><INPUT TYPE="text" NAME="$multv" VALUE="$mult"/></TD>
<TD><SELECT TYPE="text" NAME="$subtypev">
EOF;

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
<?php
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
<?php
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
<?php
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
<h2>Treasue for CR</h2>
<?php
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $beg = substr($k,0,3);
       if ($v == "" and $beg != "max" and $beg != "min" and $beg !="mul" and $beg != "sub" and $beg != "amo") {
          $msg = "please fill in all fields " .$k;
       }
   }

   if ($msg == "") {
      include 'includes/dd_db_conn.txt';

//insert skills
      $count = 0;
      while ($count < 10){
//find the skill atribute and take off the skill value
//
         $count   = $count + 1;
         $maxv    = "max_" . $count;
         $minv    = "min_" . $count;
         $amount_diev   = "amount_die_" . $count;
         $multv    = "mult_" . $count;
         $subtypev    = "subtype_" . $count;

         $max      = $$maxv;
         $min      = $$minv;
         $amount_die  = $$amount_diev;
         $mult     = $$multv;
         $subtype    = $$subtypev;
         if ($max != 0 and $max !=""){
            $insert = "INSERT INTO treasure (treas_cr, treas_type , treas_max, treas_min, treas_dice, treas_mult, treas_subtype) " .
                      "VALUES ('$cr', '$type', '$max', '$min', '$amount_die', '$mult', '$subtype')";
            echo $insert . " </BR>";
            $result = mysqli_query($link, $insert);
            if (!$result) {
                $msg = "$result" ." Error treasure";
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


<FORM METHOD="post" ACTION="<?php echo $_SERVER['PHP_SELF'] ?>">
<br>
<br>
<TABLE BORDER="1" CELLPADDING="1">
<TR>
  <TH>CR Rating</TH>
  <TH>Treasure Type</TD>
</TR>

<TR>
  <TD><SELECT NAME="cr">
<?php
$count = 0;
while ($count < 40){
$count += 1;
$cr_sel = $count;
if ($cr_sel == $cr){
    $sel = " SELECTED" ;
}else{
  $sel = "" ;
}

echo <<<EOF
  <OPTION VALUE="$cr_sel" $sel > $cr_sel </OPTION>
EOF;
}
$coins = $goods = $items = "";
   if ($type != ""){
      $$type = " SELECTED";
   }
echo <<<EOF
  <TD><SELECT NAME="type">
      <OPTION VALUE="coins"  $coins >Coins</OPTION>
      <OPTION VALUE="goods"  $goods >Goods</OPTION>
      <OPTION VALUE="items"  $items >Items</OPTION>
  </SELECT>
  </TD>
EOF;
?>
</TR>
</BR>
<TR>
  <TH>Min</TH>
  <TH>Max</TH>
  <TH>Amount dice</TH>
  <TH>multiplier</TH>
  <TH>type</TH>
</TR>
<?php
$count  = 0 ;
include 'includes/dd_db_conn.txt' ;
While ($count < 10) {
  echo "<TR>";
  $count = $count + 1;
  $maxv = "max_" . $count;
  $minv    = "min_" . $count;
  $amount_diev = "amount_die_" . $count;
  $multv    = "mult_" . $count;
  $subtypev    = "subtype_" . $count;
  $max   = $$maxv;
  $min      = $$minv;
  $amount_die  = $$amount_diev;
  $mult     = $$multv;
  $subtype  = $$subtypev;
echo <<<EOF
<TD><INPUT TYPE="text" NAME="$minv" VALUE="$min"/></TD>
<TD><INPUT TYPE="text" NAME="$maxv" VALUE="$max"/></TD>
<TD><INPUT TYPE="text" NAME="$amount_diev" VALUE="$amount_die"/></TD>
<TD><INPUT TYPE="text" NAME="$multv" VALUE="$mult"/></TD>
<TD><SELECT TYPE="text" NAME="$subtypev">
EOF;

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
<?php
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