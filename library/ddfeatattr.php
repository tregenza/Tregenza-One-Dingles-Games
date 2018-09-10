<<<<<<< HEAD
<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<BODY>
<h2>Feat Attributes</h2>
<?

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $key = substr($k,0,8);
       if ($v == "" and $key != "featattr") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {  
    $loop = 0;
    while ($loop < 9){ 
      $loop = $loop + 1;
      $featattr_typev = "featattr_type_" . $loop;
      $featattr_type  = $$featattr_typev;
      $featattr_idv    = "featattr_id_" . $loop;
      $featattr_id    = $$featattr_idv;
      $featattr_valuev = "featattr_value_" . $loop;
      $featattr_value  = $$featattr_valuev;
      $featattr_rfeatv = "featattr_rfeat_" . $loop;
      $featattr_rfeat  = $$featattr_rfeatv;


      if ($featattr_type !== "") {
        $insert = "INSERT into featattr 
                 (featattr_feat, featattr_type, featattr_id, featattr_no, featattr_rfeat)
                 VALUES ('$feat','$featattr_type','$featattr_id', '$featattr_value','$featattr_rfeat')" ;
//        echo $insert;
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
  <TH>Feat</TH>
  <TD><SELECT NAME="feat" VALUE="<? echo $feat ?>">
<?
$select = "SELECT feat_name FROM feats" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$feat_sel = $row['feat_name'] ;
if ($feat_sel == $feat)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$feat_sel" $sel > $feat_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TR>
</BR>
<TR>
<TH>Feat Type</TH>
<TH>Feat Skill</TH>
<TH>Required Feat</TH>
<TH>Value</TH> 
</TR>
<?
$loop = 0;
While ($loop < 9){
  $loop = $loop + 1;
  $featattr_typev = "featattr_type_" . $loop;
  $featattr_type  = $$featattr_typev;
  $featattr_idv    = "featattr_id_" . $loop;
  $featattr_id    = $$featattr_idv;
  $featattr_valuev = "featattr_value_" . $loop;
  $featattr_value  = $$featattr_valuev;
  $featattr_rfeatv  = "featattr_rfeat_" . $loop;
  $featattr_rfeat   = $$featattr_rfeatv;
echo <<<EOF
    <TD><SELECT NAME="$featattr_typev">
EOF;
  $select = "SELECT feattype_id, feattype_desc FROM feattype ORDER BY feattype_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_sel = $row['feattype_id'] ;
    $feattype_desc = $row['feattype_desc'];
    if ($feattype_sel == $featattr_type)
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
    <TD><SELECT NAME="$featattr_idv">
EOF;

  $select = "SELECT skill_cd FROM skills ORDER BY skill_cd" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_id_sel = $row['skill_cd'] ;
    if ($feattype_id_sel == $featattr_id)
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
echo <<<EOF
    <TD><SELECT NAME="$featattr_rfeatv" VALUE="$featattr_rfeat">
EOF;

  $select = "SELECT feat_name FROM feats" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feat_sel = $row['feat_name'] ;
    if ($feat_sel == $featattr_rfeat)
     {
       $sel = " SELECTED" ;
     } else {
        $sel = "" ;
            }

echo <<<EOF
      <OPTION VALUE="$feat_sel" $sel > $feat_sel </OPTION>
EOF;
  }
  mysqli_close($link);

echo "</SELECT>";
echo "</TD>" ;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$featattr_valuev" VALUE= $featattr_value ></TD> 
EOF;
echo "</TR>" ;
echo   "</BR>";
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
<h2>Feat Attributes</h2>
<?

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $key = substr($k,0,8);
       if ($v == "" and $key != "featattr") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {  
    $loop = 0;
    while ($loop < 9){ 
      $loop = $loop + 1;
      $featattr_typev = "featattr_type_" . $loop;
      $featattr_type  = $$featattr_typev;
      $featattr_idv    = "featattr_id_" . $loop;
      $featattr_id    = $$featattr_idv;
      $featattr_valuev = "featattr_value_" . $loop;
      $featattr_value  = $$featattr_valuev;
      $featattr_rfeatv = "featattr_rfeat_" . $loop;
      $featattr_rfeat  = $$featattr_rfeatv;


      if ($featattr_type !== "") {
        $insert = "INSERT into featattr 
                 (featattr_feat, featattr_type, featattr_id, featattr_no, featattr_rfeat)
                 VALUES ('$feat','$featattr_type','$featattr_id', '$featattr_value','$featattr_rfeat')" ;
//        echo $insert;
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
  <TH>Feat</TH>
  <TD><SELECT NAME="feat" VALUE="<? echo $feat ?>">
<?
$select = "SELECT feat_name FROM feats" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$feat_sel = $row['feat_name'] ;
if ($feat_sel == $feat)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$feat_sel" $sel > $feat_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TR>
</BR>
<TR>
<TH>Feat Type</TH>
<TH>Feat Skill</TH>
<TH>Required Feat</TH>
<TH>Value</TH> 
</TR>
<?
$loop = 0;
While ($loop < 9){
  $loop = $loop + 1;
  $featattr_typev = "featattr_type_" . $loop;
  $featattr_type  = $$featattr_typev;
  $featattr_idv    = "featattr_id_" . $loop;
  $featattr_id    = $$featattr_idv;
  $featattr_valuev = "featattr_value_" . $loop;
  $featattr_value  = $$featattr_valuev;
  $featattr_rfeatv  = "featattr_rfeat_" . $loop;
  $featattr_rfeat   = $$featattr_rfeatv;
echo <<<EOF
    <TD><SELECT NAME="$featattr_typev">
EOF;
  $select = "SELECT feattype_id, feattype_desc FROM feattype ORDER BY feattype_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_sel = $row['feattype_id'] ;
    $feattype_desc = $row['feattype_desc'];
    if ($feattype_sel == $featattr_type)
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
    <TD><SELECT NAME="$featattr_idv">
EOF;

  $select = "SELECT skill_cd FROM skills ORDER BY skill_cd" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feattype_id_sel = $row['skill_cd'] ;
    if ($feattype_id_sel == $featattr_id)
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
echo <<<EOF
    <TD><SELECT NAME="$featattr_rfeatv" VALUE="$featattr_rfeat">
EOF;

  $select = "SELECT feat_name FROM feats" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feat_sel = $row['feat_name'] ;
    if ($feat_sel == $featattr_rfeat)
     {
       $sel = " SELECTED" ;
     } else {
        $sel = "" ;
            }

echo <<<EOF
      <OPTION VALUE="$feat_sel" $sel > $feat_sel </OPTION>
EOF;
  }
  mysqli_close($link);

echo "</SELECT>";
echo "</TD>" ;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$featattr_valuev" VALUE= $featattr_value ></TD> 
EOF;
echo "</TR>" ;
echo   "</BR>";
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