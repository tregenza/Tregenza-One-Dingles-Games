<HTML>
<HEAD>
<STYLE>
.error {padding: 10px; color: #CC0000; font-weight: bold;}
</STYLE>
</HEAD>
<BODY>
<?
include 'includes/dd_menu.txt' ;
?>
<h2>Spells</h2>
<?

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $key = substr($k,0,10);
       if ($v == "" and $key != "spellclass" and $key != "spell_type") {
          $msg = "please fill in all fields " . $k . " " . $key;
       }
   }
  if ($msg == "") {
    $insert = "INSERT into spell
              (spell_name, spell_desc, spell_school, spell_type1, spell_type2, spell_type3, spell_type4, spell_comp, spell_range,
               spell_duration, spell_area, spell_save, spell_resist, spell_psi_power_pts)
              VALUES ('$spell_name','$spell_desc','$spell_school', '$spell_type_1', '$spell_type_2', '$spell_type_3', '$spell_type_4','$spell_comp', " .
               " '$spell_range', '$spell_duration', '$spell_area','$spell_save','$spell_resist','$spell_psi_power_pts')" ;
    include 'includes/dd_db_conn.txt';
    echo $insert;
    if (!mysqli_query($link, $insert)) {
         $msg = "Error inserting data spell";
     }else{
         $msg = "record sucessfully added" ;
    }
    $loop = 0;
    while ($loop < 9){
      $loop = $loop + 1;
      $spellclass_classv = "spellclass_class_" . $loop;
      $spellclass_class  = $$spellclass_classv;
      $spellclass_levelv    = "spellclass_level_" . $loop;
      $spellclass_level    = $$spellclass_levelv;


      if ($spellclass_level !== "") {
        $insert = "INSERT into spellclass
                 (spellclass_name, spellclass_class, spellclass_level)
                 VALUES ('$spell_name','$spellclass_class','$spellclass_level')" ;
//        echo $insert;
        include 'includes/dd_db_conn.txt';

        if (!mysqli_query($link, $insert)) {
         $msg = "Error inserting data spellclass";
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
  <TH>Spell</TH>
  <TD><INPUT TYPE = "text" NAME="spell_name" VALUE = "<?echo $spell_name?>">
<?
/*
$select = "SELECT DISTINCT itemtype_item FROM itemtype WHERE itemtype_id LIKE 'Arcane level%' OR itemtype_id LIKE 'Divine level%' ORDER BY itemtype_item";
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$spell_sel = $row['itemtype_item'] ;
if ($spell_sel == $spell_name)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$spell_sel" $sel > $spell_sel </OPTION>
EOF;
}
mysqli_close($link);
*/
?>
</TR>
</BR>
<TR>
<TD>Description</TD>
</TR>
<TR>
<TD><INPUT TYPE="text" NAME="spell_desc" VALUE= "<?echo $spell_desc ?>"></TD>
<TD>
</TR>
<TR>
<TD>School</TD>
<?
echo <<<EOF
    <TD><SELECT NAME="spell_school">
EOF;
  $spell_school_sel = "Psionic";
  if ($spell_school_sel == $spell_school){
     $sel = " SELECTED" ;
  } else {
     $sel = "" ;
  }

echo <<<EOF
   <OPTION VALUE="$spell_school_sel" $sel > $spell_school_sel </OPTION>
EOF;
  $select = "SELECT spellschool_id FROM spellschool ORDER BY spellschool_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $spell_school_sel = $row['spellschool_id'] ;
    if ($spell_school_sel == $spell_school)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
    }
echo <<<EOF
     <OPTION VALUE="$spell_school_sel" $sel > $spell_school_sel </OPTION>
EOF;
  }
?>
</TD>
<TR>
<TD>Components</TD>
<TD><INPUT TYPE="text" NAME="spell_comp" VALUE= "<?echo $spell_comp?>"></TD>
</TR>
<TR>
<TD>Range</TD>
<?
echo <<<EOF
    <TD><SELECT NAME="spell_range">
EOF;

  $select = "SELECT spellrange_id FROM spellrange ORDER BY spellrange_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $spell_range_sel = $row['spellrange_id'] ;
    if ($spell_range_sel == $spell_range)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
    }

echo <<<EOF
     <OPTION VALUE="$spell_range_sel" $sel > $spell_range_sel </OPTION>
EOF;
  }
?>
</TR>
<TR>
<TD>Area</TD>
<TD><INPUT TYPE="text" NAME="spell_area" VALUE= "<?echo $spell_area?>"></TD>
</TR>
<TR>
<TD>Duration</TD>
<TD><INPUT TYPE="text" NAME="spell_duration" VALUE= "<?echo $spell_duration?>"></TD>
</TR>
<TR>
<TD>Saving Throw</TD>
<TD><INPUT TYPE="text" NAME="spell_save" VALUE= "<?echo $spell_save?>"></TD>
</TR>
<TR>
<TD>Resistance</TD>
<TD><INPUT TYPE="text" NAME="spell_resist" VALUE= "<?echo $spell_resist?>"></TD>
</TR>
<TR>
<TD>Power Points</TD>
<TD><INPUT TYPE="text" NAME="spell_psi_power_pts" VALUE= "<?echo $spell_psi_power_pts?>"></TD>
</TR>
<TR>
<TD>type 1</TD>
<TD>type 2</TD>
<TD>type 3</TD>
<TD>type 4</TD>
</TR>
<TR>
<?
$count = 0;
while ($count < 4){
  $count = $count +1;
  $type_v = "spell_type_" . $count;
   echo <<<EOF
    <TD><SELECT NAME="$type_v">
EOF;
  $select = "SELECT spelltype_id FROM spelltype ORDER BY spelltype_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $spell_type_sel = $row['spelltype_id'] ;
    if ($spell_type_sel == $$type_v)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
       }
echo <<<EOF
     <OPTION VALUE="$spell_type_sel" $sel > $spell_type_sel </OPTION>
EOF;
  }
}
?>
<TR>
<TH>Class</TH>
<TH>Level</TH>
</TR>
<?
$loop = 0;
While ($loop < 9){
  $loop = $loop + 1;
  $spellclass_classv = "spellclass_class_" . $loop;
  $spellclass_class  = $$spellclass_classv;
  $spellclass_levelv    = "spellclass_level_" . $loop;
  $spellclass_level    = $$spellclass_levelv;
  echo <<<EOF
    <TD><SELECT NAME="$spellclass_classv">
EOF;
  $select = "SELECT spellcl_id FROM spellcl ORDER BY spellcl_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $spellclass_class_sel = $row['spellcl_id'] ;
    if ($spellclass_class_sel == $spellclass_class)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
    }
echo <<<EOF
     <OPTION VALUE="$spellclass_class_sel" $sel > $spellclass_class_sel </OPTION>
EOF;
  }
  mysqli_close($link);

echo <<<EOF
     </SELECT>
    </TD>
EOF;

echo <<<EOF
  <TD><INPUT TYPE="text" NAME="$spellclass_levelv" VALUE= $spellclass_level></TD>
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
</HTML>