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
       if ($v == "" and $k2 != "sp" and $k2 != "no" and $k2 != "le" and $k2 != "re") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {  
    $loop = 0;
    while ($loop < 15){
      $loop = $loop + 1;
      $spec_v           = "spec_" . $loop;
      $spec             = $$spec_v;
      $level_v          = "level_" .$loop;
      $level            = $$level_v;
      $no_v             = "no_" . $loop;
      $no               = $$no_v;
      $rem_v            = "rem_" . $loop;
      $rem              = $$rem_v;
      if ($spec != "" and $level !="") {
        $insert = "INSERT into spellclsp" .
                 "(spellcl_id, spec_name, spellclsp_level, spellclsp_no, mon_key_1,spellclsp_remove)" .
                 "VALUES ('$class','$spec', '$level','$no','$mon_key_1', '$rem')" ;
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
  <TD><SELECT NAME="class" VALUE="<?echo $class?> ">
<?
$select = "SELECT spellcl_id FROM spellcl" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$class_sel = $row['spellcl_id'] ;
if ($class_sel == $class)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$class_sel" $sel > $class_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TR>
<TR>
<TH>Level</TH>
<TH>spec</TH>
<TH>Number</TH>
<TH>Remove</TH>
</TR>
<?

$loop = 0;
While ($loop < 15){
  $loop = $loop + 1;
  $level_v = "level_". $loop;
  $level   = $$level_v;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$level_v" VALUE="$level"/></TD> 
EOF;
  $spec_v = "spec_" . $loop;
  $spec  = $$spec_v;
echo <<<EOF
    <TD><SELECT NAME="$spec_v">
EOF;
  $select = "SELECT spec_name FROM specials" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

  $spec_sel = $row['spec_name'] ;
  if ($spec_sel == $spec)
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
  $no_v = "no_". $loop;
  $no   = $$no_v;  
  $rem_v = "rem_". $loop;
  $rem   = $$rem_v;
echo <<<EOF
     </SELECT>
    </TD>
    <TD><INPUT TYPE="text" NAME="$no_v" VALUE="$no"/></TD> 
    <TD><INPUT TYPE="text" NAME="$rem_v" VALUE="$rem"/></TD>
    </TR>
EOF;
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
       if ($v == "" and $k2 != "sp" and $k2 != "no" and $k2 != "le" and $k2 != "re") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {  
    $loop = 0;
    while ($loop < 15){
      $loop = $loop + 1;
      $spec_v           = "spec_" . $loop;
      $spec             = $$spec_v;
      $level_v          = "level_" .$loop;
      $level            = $$level_v;
      $no_v             = "no_" . $loop;
      $no               = $$no_v;
      $rem_v            = "rem_" . $loop;
      $rem              = $$rem_v;
      if ($spec != "" and $level !="") {
        $insert = "INSERT into spellclsp" .
                 "(spellcl_id, spec_name, spellclsp_level, spellclsp_no, mon_key_1,spellclsp_remove)" .
                 "VALUES ('$class','$spec', '$level','$no','$mon_key_1', '$rem')" ;
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
  <TD><SELECT NAME="class" VALUE="<?echo $class?> ">
<?
$select = "SELECT spellcl_id FROM spellcl" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$class_sel = $row['spellcl_id'] ;
if ($class_sel == $class)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$class_sel" $sel > $class_sel </OPTION>
EOF;
}
mysqli_close($link);
?>
      </SELECT>
</TR>
<TR>
<TH>Level</TH>
<TH>spec</TH>
<TH>Number</TH>
<TH>Remove</TH>
</TR>
<?

$loop = 0;
While ($loop < 15){
  $loop = $loop + 1;
  $level_v = "level_". $loop;
  $level   = $$level_v;
echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$level_v" VALUE="$level"/></TD> 
EOF;
  $spec_v = "spec_" . $loop;
  $spec  = $$spec_v;
echo <<<EOF
    <TD><SELECT NAME="$spec_v">
EOF;
  $select = "SELECT spec_name FROM specials" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

  $spec_sel = $row['spec_name'] ;
  if ($spec_sel == $spec)
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
  $no_v = "no_". $loop;
  $no   = $$no_v;  
  $rem_v = "rem_". $loop;
  $rem   = $$rem_v;
echo <<<EOF
     </SELECT>
    </TD>
    <TD><INPUT TYPE="text" NAME="$no_v" VALUE="$no"/></TD> 
    <TD><INPUT TYPE="text" NAME="$rem_v" VALUE="$rem"/></TD>
    </TR>
EOF;
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