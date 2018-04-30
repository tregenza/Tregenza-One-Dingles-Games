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
       if ($v == "" and $k2 != "sp" and $k2 != "no" and $k2 != "le") {
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
   
      if ($spec != "" and $level !="") {
        $insert = "INSERT into classsp2" .
                 "(classsp_class, classsp_spec, classsp_level, classsp_no, mon_key_1)" .
                 "VALUES ('$class','$spec', '$level','$no','$mon_key_1')" ;
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
$select = "SELECT class_tp FROM class2 where mon_key_1 = '$mon_key_1'" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$class_sel = $row['class_tp'] ;
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
echo <<<EOF
     </SELECT>
    </TD>
    <TD><INPUT TYPE="text" NAME="$no_v" VALUE="$no"/></TD> 
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
</HTML>