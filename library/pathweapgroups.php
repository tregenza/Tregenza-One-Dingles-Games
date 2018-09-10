<<<<<<< HEAD
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<BODY>
<h2>Pathfinder Class Specials</h2>
<?
$mon_key_1 = "path";

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $k2 = substr($k,0,2);
       $key = substr($k,0,6);
//       if ($v == "" and $k2 != "sp" and $k2 != "no" and $k2 != "le") {
//          $msg = "please fill in all fields" ;
//       }
   }
  if ($msg == "") {
    $loop = 0;
    while ($loop < 15){
      $loop = $loop + 1;
      $weap_v           = "weap_" . $loop;
      $weap_id          = $$weap_v;


      if ($weap_id != "") {
        $insert = "INSERT into weapgroups" .
                 "(weapgroup_id, weap_id)" .
                 "VALUES ('$weapgroup_id','$weap_id')" ;
        echo "</BR>" . $insert;

        include 'includes/dd_db_conn.txt';

        if (!mysqli_query($link, $insert)) {
         $msg = "Error inserting data";
        }
        else {
           $msg = "record sucessfully added" ;
             }
      mysqli_close($link) ;
      }
    }
     echo "<div> $msg</div>" ;
  }else{
     echo "<div class=\"error\">$msg</div>" ;
  }
}

?>
<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">
<TABLE BORDER="4" CELLPADDING="7">
<TR>
  <TH>Class</TH>
  <TD><SELECT NAME="weapgroup_id">
<?
$select = "SELECT weapgroup_id FROM weapgroup" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$weapgroup_sel = $row['weapgroup_id'] ;
if ($weapgroup_sel == $weapgroup_id)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$weapgroup_sel" $sel > $weapgroup_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TD>
</TR>
<TR>
<TH>Weapon</TH>
</TR>
<TR>
<?

$loop = 0;
While ($loop < 15){
  $loop = $loop + 1;
  $weap_v = "weap_". $loop;
  $weap_id   = $$weap_v;
echo <<<EOF
    <TD><SELECT NAME="$weap_v">
EOF;
  $select = "SELECT weap_id FROM weapons" ;
  if ($weap_sel == ""){
     $sel = " SELECTED" ;
   } else {
      $sel = "" ;
   }

echo <<<EOF
    <OPTION VALUE="" $sel >  </OPTION>
EOF;


  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

  $weap_sel = $row['weap_id'] ;
  if ($weap_sel == $weap_id)
     {
      $sel = " SELECTED" ;
     } else {
      $sel = "" ;
            }

echo <<<EOF
    <OPTION VALUE="$weap_sel" $sel > $weap_sel </OPTION>
EOF;
  }
echo <<<EOF
  </TD>
  </TR>
EOF;
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
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<BODY>
<h2>Pathfinder Class Specials</h2>
<?
$mon_key_1 = "path";

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $k2 = substr($k,0,2);
       $key = substr($k,0,6);
//       if ($v == "" and $k2 != "sp" and $k2 != "no" and $k2 != "le") {
//          $msg = "please fill in all fields" ;
//       }
   }
  if ($msg == "") {
    $loop = 0;
    while ($loop < 15){
      $loop = $loop + 1;
      $weap_v           = "weap_" . $loop;
      $weap_id          = $$weap_v;


      if ($weap_id != "") {
        $insert = "INSERT into weapgroups" .
                 "(weapgroup_id, weap_id)" .
                 "VALUES ('$weapgroup_id','$weap_id')" ;
        echo "</BR>" . $insert;

        include 'includes/dd_db_conn.txt';

        if (!mysqli_query($link, $insert)) {
         $msg = "Error inserting data";
        }
        else {
           $msg = "record sucessfully added" ;
             }
      mysqli_close($link) ;
      }
    }
     echo "<div> $msg</div>" ;
  }else{
     echo "<div class=\"error\">$msg</div>" ;
  }
}

?>
<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">
<TABLE BORDER="4" CELLPADDING="7">
<TR>
  <TH>Class</TH>
  <TD><SELECT NAME="weapgroup_id">
<?
$select = "SELECT weapgroup_id FROM weapgroup" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$weapgroup_sel = $row['weapgroup_id'] ;
if ($weapgroup_sel == $weapgroup_id)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$weapgroup_sel" $sel > $weapgroup_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TD>
</TR>
<TR>
<TH>Weapon</TH>
</TR>
<TR>
<?

$loop = 0;
While ($loop < 15){
  $loop = $loop + 1;
  $weap_v = "weap_". $loop;
  $weap_id   = $$weap_v;
echo <<<EOF
    <TD><SELECT NAME="$weap_v">
EOF;
  $select = "SELECT weap_id FROM weapons" ;
  if ($weap_sel == ""){
     $sel = " SELECTED" ;
   } else {
      $sel = "" ;
   }

echo <<<EOF
    <OPTION VALUE="" $sel >  </OPTION>
EOF;


  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

  $weap_sel = $row['weap_id'] ;
  if ($weap_sel == $weap_id)
     {
      $sel = " SELECTED" ;
     } else {
      $sel = "" ;
            }

echo <<<EOF
    <OPTION VALUE="$weap_sel" $sel > $weap_sel </OPTION>
EOF;
  }
echo <<<EOF
  </TD>
  </TR>
EOF;
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