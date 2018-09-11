<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<BODY>
<h2>Pathfinder Class Feats</h2>
<?
$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $key = substr($k,0,4);
       if ($v == "" and $key != "feat" and $key != "leve" and $key!= "del_") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {  
    $loop = 0;
    while ($loop < 10){ 
      $loop = $loop + 1;
      $feat_v           = "feat_" . $loop;
      $feat             = $$feat_v;
      $level_v          = "level_" .$loop;
      $level            = $$level_v;
      $del_feat_v       = "del_feat_" .$loop;
      $del_feat         = $$del_feat_v;

      if ($feat !== "") {
        $insert = "INSERT into classfeats2" .
                 "(classfeat_class, classfeat_feat, classfeat_level,mon_key_1, classfeat_del_feat)" .
                 "VALUES ('$class','$feat', '$level','path', '$del_feat')" ;
        echo "</BR>" . $insert;

        include 'includes/dd_db_conn.txt';

        if (!mysqli_query($link, $insert)) {
           $msg = "Error inserting data";
        } else {
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
$select = "SELECT spellcl_id FROM spellcl order by spellcl_id " ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$class_sel = $row[0] ;
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
<TH>Feat</TH>
<TH>Min Level</TH>
<TH>Remove Feat from Base Class?</TH>
</TR>
<?
$loop = 0;
While ($loop < 10){
  $loop = $loop + 1;
  $feat_v = "feat_" . $loop;
  $feat  = $$feat_v;

echo <<<EOF
    <TD><SELECT NAME="$feat_v">
EOF;
  $select = "SELECT feat_name FROM feats2" ;
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
  $level_v = "level_". $loop;
  $level   = $$level_v;
  $del_feat_v = "del_feat_". $loop;
  $del_feat   = $$del_feat_v;
echo <<<EOF
     </SELECT>
    </TD>
    <TD><INPUT TYPE="text" NAME="$level_v" VALUE="$level"/></TD> 
    <TD><INPUT TYPE="text" NAME="$del_feat_v" VALUE="$del_feat"/></TD>
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