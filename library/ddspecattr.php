<<<<<<< HEAD
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<BODY>
<h2>Special Attributes</h2>
<?

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $key = substr($k,0,8);
       if ($v == "" and $key != "specattr") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {  
    $loop = 0;
    while ($loop < 9){ 
      $loop = $loop + 1;
      $specattr_typev = "specattr_type_" . $loop;
      $specattr_type  = $$specattr_typev;
      $specattr_idv    = "specattr_id_" . $loop;
      $specattr_id    = $$specattr_idv;
      $specattr_valuev = "specattr_value_" . $loop;
      $specattr_value  = $$specattr_valuev;
      $specattr_bonus_tpv = "specattr_bonus_tp_". $loop;
      $specattr_bonus_tp = $$specattr_bonus_tpv;

      if ($specattr_type !== "") {
        $insert = "INSERT into specattr
                 (specattr_spec, specattr_type, specattr_id, specattr_no, specattr_bonus_tp)
                 VALUES ('$special','$specattr_type','$specattr_id', '$specattr_value', '$specattr_bonus_tp')" ;
        echo $insert;
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
  <TH>Special</TH>
  <TD><SELECT NAME="special" VALUE="<? echo $special ?>">
<?
$select = "SELECT spec_name, spec_desc FROM specials order by spec_name" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$spec_sel = $row['spec_name'] ;
$spec_desc = $row['spec_desc'];
if ($spec_sel == $special)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$spec_sel" $sel > $spec_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TR>
</TABLE>
<TABLE BORDER="4" CELLPADDING="7">
<TR>
<TH>Spec Type</TH>
<TH>Spec Skill</TH>
<TH>Value</TH> 
<TH>Bonus Type</TH>
</TR>
<?
$loop = 0;
While ($loop < 9){
  $loop = $loop + 1;
  $specattr_typev = "specattr_type_" . $loop;
  $specattr_type  = $$specattr_typev;
  $specattr_idv    = "specattr_id_" . $loop;
  $specattr_id    = $$specattr_idv;
  $specattr_valuev = "specattr_value_" . $loop;
  $specattr_value  = $$specattr_valuev;
  $specattr_rfeatv  = "specattr_rfeat_" . $loop;
  $specattr_rfeat   = $$specattr_rfeatv;
  $specattr_bonus_tpv = "specattr_bonus_tp_". $loop;
  $specattr_bonus_tp = $$specattr_bonus_tpv;
echo <<<EOF
    <TD><SELECT NAME="$specattr_typev">
EOF;
  $select = "SELECT feattype_id, feattype_desc FROM feattype ORDER BY feattype_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_sel = $row['feattype_id'] ;
    $feattype_desc = $row['feattype_desc'];
    if ($feattype_sel == $specattr_type)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
              }
     $desc = $feattype_sel . " " . $feattype_desc; 
echo <<<EOF
     <OPTION VALUE="$feattype_sel" $sel > $desc </OPTION>
EOF;
   }
   mysqli_close($link);

echo <<<EOF
     </SELECT>
    </TD>
    <TD><SELECT NAME="$specattr_idv">
EOF;

  $select = "SELECT skill_cd FROM skills ORDER BY skill_cd" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_id_sel = $row['skill_cd'] ;
    if ($feattype_id_sel == $specattr_id)
     {
       $sel = " SELECTED" ;
     } else {
         $sel = "" ;
            }

echo <<<EOF
    <OPTION VALUE="$feattype_id_sel" $sel > $feattype_id_sel </OPTION>
EOF;
    }

  echo "/SELECT";
    mysqli_close($link);

echo "</TD>" ;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$specattr_valuev" VALUE= "$specattr_value"></TD>
  <TD><SELECT NAME="$specattr_bonus_tpv" VALUE="$specattr_bonus_tp">
EOF;

  $select = "SELECT magicbonus_tp FROM magicbonus order by magicbonus_tp" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

   $specattr_bonus_tp_sel = $row['magicbonus_tp'] ;
   if ($specattr_bonus_tp_sel == $specattr_bonus_tp){
       $sel = " SELECTED" ;
   } else {
      $sel = "" ;
   }

echo <<<EOF
      <OPTION VALUE="$specattr_bonus_tp_sel" $sel > $specattr_bonus_tp_sel </OPTION>
EOF;

  }

echo "</TD>";
echo "</TR>" ;
}

?>
</TR>
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
<h2>Special Attributes</h2>
<?

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
       $key = substr($k,0,8);
       if ($v == "" and $key != "specattr") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {  
    $loop = 0;
    while ($loop < 9){ 
      $loop = $loop + 1;
      $specattr_typev = "specattr_type_" . $loop;
      $specattr_type  = $$specattr_typev;
      $specattr_idv    = "specattr_id_" . $loop;
      $specattr_id    = $$specattr_idv;
      $specattr_valuev = "specattr_value_" . $loop;
      $specattr_value  = $$specattr_valuev;
      $specattr_bonus_tpv = "specattr_bonus_tp_". $loop;
      $specattr_bonus_tp = $$specattr_bonus_tpv;

      if ($specattr_type !== "") {
        $insert = "INSERT into specattr
                 (specattr_spec, specattr_type, specattr_id, specattr_no, specattr_bonus_tp)
                 VALUES ('$special','$specattr_type','$specattr_id', '$specattr_value', '$specattr_bonus_tp')" ;
        echo $insert;
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
  <TH>Special</TH>
  <TD><SELECT NAME="special" VALUE="<? echo $special ?>">
<?
$select = "SELECT spec_name, spec_desc FROM specials order by spec_name" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$spec_sel = $row['spec_name'] ;
$spec_desc = $row['spec_desc'];
if ($spec_sel == $special)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$spec_sel" $sel > $spec_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TR>
</TABLE>
<TABLE BORDER="4" CELLPADDING="7">
<TR>
<TH>Spec Type</TH>
<TH>Spec Skill</TH>
<TH>Value</TH> 
<TH>Bonus Type</TH>
</TR>
<?
$loop = 0;
While ($loop < 9){
  $loop = $loop + 1;
  $specattr_typev = "specattr_type_" . $loop;
  $specattr_type  = $$specattr_typev;
  $specattr_idv    = "specattr_id_" . $loop;
  $specattr_id    = $$specattr_idv;
  $specattr_valuev = "specattr_value_" . $loop;
  $specattr_value  = $$specattr_valuev;
  $specattr_rfeatv  = "specattr_rfeat_" . $loop;
  $specattr_rfeat   = $$specattr_rfeatv;
  $specattr_bonus_tpv = "specattr_bonus_tp_". $loop;
  $specattr_bonus_tp = $$specattr_bonus_tpv;
echo <<<EOF
    <TD><SELECT NAME="$specattr_typev">
EOF;
  $select = "SELECT feattype_id, feattype_desc FROM feattype ORDER BY feattype_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_sel = $row['feattype_id'] ;
    $feattype_desc = $row['feattype_desc'];
    if ($feattype_sel == $specattr_type)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
              }
     $desc = $feattype_sel . " " . $feattype_desc; 
echo <<<EOF
     <OPTION VALUE="$feattype_sel" $sel > $desc </OPTION>
EOF;
   }
   mysqli_close($link);

echo <<<EOF
     </SELECT>
    </TD>
    <TD><SELECT NAME="$specattr_idv">
EOF;

  $select = "SELECT skill_cd FROM skills ORDER BY skill_cd" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_id_sel = $row['skill_cd'] ;
    if ($feattype_id_sel == $specattr_id)
     {
       $sel = " SELECTED" ;
     } else {
         $sel = "" ;
            }

echo <<<EOF
    <OPTION VALUE="$feattype_id_sel" $sel > $feattype_id_sel </OPTION>
EOF;
    }

  echo "/SELECT";
    mysqli_close($link);

echo "</TD>" ;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$specattr_valuev" VALUE= "$specattr_value"></TD>
  <TD><SELECT NAME="$specattr_bonus_tpv" VALUE="$specattr_bonus_tp">
EOF;

  $select = "SELECT magicbonus_tp FROM magicbonus order by magicbonus_tp" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

   $specattr_bonus_tp_sel = $row['magicbonus_tp'] ;
   if ($specattr_bonus_tp_sel == $specattr_bonus_tp){
       $sel = " SELECTED" ;
   } else {
      $sel = "" ;
   }

echo <<<EOF
      <OPTION VALUE="$specattr_bonus_tp_sel" $sel > $specattr_bonus_tp_sel </OPTION>
EOF;

  }

echo "</TD>";
echo "</TR>" ;
}

?>
</TR>
</TABLE>
<BR>
  <INPUT TYPE="submit" VALUE="Add to database" />
  <INPUT TYPE="reset"  VALUE="cancel" />
</FORM>

</BODY>
>>>>>>> 65450b134015a9177e74559b90657752af789db3
</HTML>