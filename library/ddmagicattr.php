<<<<<<< HEAD
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
<h2>Magic Items</h2>
<?

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $key = substr($k,0,6);
       if ($v == "" and $key != "magic_") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {
    $insert = "INSERT into magic2(magic_name,magic_body,magic_desc,magic_value,mon_key_1) ".
              "VALUES ('$magic_name','$magic_body','$magic_desc','$magic_value','dd35')";
    include 'includes/dd_db_conn.txt';

    if (!mysqli_query($link, $insert)) {
       $msg = "Error inserting data";
    }else {
       $msg = "record sucessfully added" ;
    }
    $loop = 0;
    while ($loop < 9){
      $loop = $loop + 1;
      $magic_specv = "magic_spec_" . $loop;
      $magic_spec  = $$magic_specv;
      $magic_typev = "magic_type_" . $loop;
      $magic_type  = $$magic_typev;
      $magic_nov = "magic_no_" . $loop;
      $magic_no  = $$magic_nov;
      $magic_bonus_tpv = "magic_bonus_tp_" . $loop;
      $magic_bonus_tp  = $$magic_bonus_tpv;
      $magic_featv = "magic_feat_" . $loop;
      $magic_feat  = $$magic_featv;
      $magic_skillv = "magic_skill_" . $loop;
      $magic_skill  = $$magic_skillv;
      if ($magic_spec !== "") {
        $insert = "INSERT into magicattr2
                 (magic_name, magic_spec, magic_type, magic_no, magic_bonus_tp,magic_feat,magic_skill,mon_key_1)
                 VALUES ('$magic_name','$magic_spec','$magic_type', '$magic_no', '$magic_bonus_tp','$magic_feat','$magic_skill','dd35')" ;
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
  <TH>Magic Item</TH>
  <TD><SELECT NAME="magic_name">
<?
$select = "SELECT itemtype_id, itemtype_item, itemtype_bonus, itemtype_subtype FROM itemtype where itemtype_id like 'Rings%' or itemtype_id like 'Wond%' ".
          "  or itemtype_id like 'Wand%'  or itemtype_id like 'Staff%'   or itemtype_id like 'Rod%' or itemtype_id like 'Potion%' " .
          " or itemtype_id like 'Arcane-%'  or itemtype_id like 'Divine-%' " .
           "ORDER BY itemtype_item, itemtype_bonus" ;
include 'includes/dd_db_conn.txt';
echo $select;
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$magic_sel = $row['itemtype_item'] ;
$magic_sel_bonus = $row['itemtype_bonus'];
$magic_id = $row['itemtype_id'];
$magic_sub = $row['itemtype_subtype'];
if (substr($magic_id,0,4) == "Ring"){
  $magic_sel =  "Ring of " . $magic_sel;
}
if (substr($magic_id,0,4) == "Wand"){
  $magic_sel =  "Wand of " . $magic_sel;
}
if (substr($magic_id,0,4) == "Staf"){
  $magic_sel =  "Staff of " . $magic_sel;
}
if (substr($magic_id,0,3) == "Rod"){
  $magic_sel =  "Rod of " . $magic_sel;
}
if (substr($magic_id,0,4) == "Poti"){
  $magic_sel =  "Potion of " . $magic_sel;
}
if (substr($magic_id,0,6) == "Divine"){
  $magic_sel =  "Scroll of " . $magic_sub;
}
if (substr($magic_id,0,6) == "Arcane"){
  $magic_sel =  "Scroll of " . $magic_sub;
}
if ($magic_sel_bonus != ""){
  $magic_sel .= " ($magic_sel_bonus)";
}
if ($magic_sel == $magic_name)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$magic_sel" $sel > $magic_sel </OPTION>
EOF;

}
mysqli_close($link);
?>
      </SELECT>
</TR>
<TR>
<TD>Body<SELECT NAME="magic_body">
<?
$select = "SELECT magicbody_id, magicbody_desc FROM magicbody" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

  $magicbody_sel = $row['magicbody_id'] ;
  $magicbody_desc = $row['magicbody_desc'];
  if ($magicbody_sel == $magic_body)
     {
      $sel = " SELECTED" ;
     } else {
      $sel = "" ;
     }
  $desc = $magicbody_sel . " " . $magicbody_desc;
echo <<<EOF
     <OPTION VALUE="$magicbody_sel" $sel > $desc </OPTION>
EOF;
}
?>
</SELECT>
<TD>Desc<INPUT TYPE="text" NAME="magic_desc" VALUE= "<?echo $magic_desc?>" ></TD>
<TD>Value<INPUT TYPE="text" NAME="magic_value" VALUE= "<?echo $magic_value?>" ></TD>
</BR>
</TABLE>
<TABLE>
<TR>
<TH>Magic Spec</TH>
<TH>Skill</TH>
<TH>Feat</TH>
<TH>Bonus</TH>
<TH>Bonus Type</TH>
</TR>
<?
$loop = 0;
While ($loop < 9){
  $loop = $loop + 1;
  $magic_specv = "magic_spec_" . $loop;
  $magic_spec  = $$magic_specv;
  $magic_typev = "magic_type_" . $loop;
  $magic_type  = $$magic_typev;
  $magic_nov = "magic_no_" . $loop;
  $magic_no  = $$magic_nov;
  $magic_bonus_tpv = "magic_bonus_tp_" . $loop;
  $magic_bonus_tp  = $$magic_bonus_tpv;
  $magic_skillv = "magic_skill_" . $loop;
  $magic_skill  = $$magic_skillv;
  $magic_featv = "magic_feat_" . $loop;
  $magic_feat  = $$magic_featv;



echo <<<EOF
    <TD><SELECT NAME="$magic_specv">
EOF;
  $select = "SELECT feattype_id, feattype_desc FROM feattype ORDER BY feattype_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $magic_spec_sel = $row['feattype_id'] ;
    $feattype_desc = $row['feattype_desc'];
    if ($magic_spec_sel == $magic_spec)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
              }
     $desc = $magic_spec_sel . " " . $feattype_desc;
echo <<<EOF
     <OPTION VALUE="$magic_spec_sel" $sel > $desc </OPTION>
EOF;
   }
   mysqli_close($link);

echo <<<EOF
     </SELECT>
    </TD>
    <TD><SELECT NAME="$magic_skillv">
EOF;

  $select = "SELECT skill_cd FROM skills2 where skill_dd35 = 'Y' ORDER BY skill_cd" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $skill_sel = $row['skill_cd'] ;
    if ($skill_sel == $magic_skill)
     {
       $sel = " SELECTED" ;
     } else {
         $sel = "" ;
            }

echo <<<EOF
    <OPTION VALUE="$skill_sel" $sel > $skill_sel </OPTION>
EOF;
    }

  echo "/SELECT";
    mysqli_close($link);
echo <<<EOF
    <TD><SELECT NAME="$magic_featv" VALUE="$magic_feat">
EOF;

  $select = "SELECT feat_name FROM feats2 where mon_key_1 = 'dd35'" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feat_sel = $row['feat_name'] ;
    if ($feat_sel == $magic_feat){
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
  <TD><INPUT TYPE="text" NAME="$magic_nov" VALUE= $magic_no ></TD>
  <TD><SELECT NAME="$magic_bonus_tpv" VALUE="$magic_bonus_tp">
EOF;

  $select = "SELECT magicbonus_tp FROM magicbonus order by magicbonus_tp" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

   $magic_bonus_tp_sel = $row['magicbonus_tp'] ;
   if ($magic_bonus_tp_sel == $magic_bonus_tp){
       $sel = " SELECTED" ;
   } else {
      $sel = "" ;
   }

echo <<<EOF
      <OPTION VALUE="$magic_bonus_tp_sel" $sel > $magic_bonus_tp_sel </OPTION>
EOF;

  }

echo "</TR>" ;
echo   "<TR>";
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
<?
include 'includes/dd_menu.txt' ;
?>
<h2>Magic Items</h2>
<?

$SIZE = "" ;
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
       $key = substr($k,0,6);
       if ($v == "" and $key != "magic_") {
          $msg = "please fill in all fields" ;
       }
   }
  if ($msg == "") {
    $insert = "INSERT into magic2(magic_name,magic_body,magic_desc,magic_value,mon_key_1) ".
              "VALUES ('$magic_name','$magic_body','$magic_desc','$magic_value','dd35')";
    include 'includes/dd_db_conn.txt';

    if (!mysqli_query($link, $insert)) {
       $msg = "Error inserting data";
    }else {
       $msg = "record sucessfully added" ;
    }
    $loop = 0;
    while ($loop < 9){
      $loop = $loop + 1;
      $magic_specv = "magic_spec_" . $loop;
      $magic_spec  = $$magic_specv;
      $magic_typev = "magic_type_" . $loop;
      $magic_type  = $$magic_typev;
      $magic_nov = "magic_no_" . $loop;
      $magic_no  = $$magic_nov;
      $magic_bonus_tpv = "magic_bonus_tp_" . $loop;
      $magic_bonus_tp  = $$magic_bonus_tpv;
      $magic_featv = "magic_feat_" . $loop;
      $magic_feat  = $$magic_featv;
      $magic_skillv = "magic_skill_" . $loop;
      $magic_skill  = $$magic_skillv;
      if ($magic_spec !== "") {
        $insert = "INSERT into magicattr2
                 (magic_name, magic_spec, magic_type, magic_no, magic_bonus_tp,magic_feat,magic_skill,mon_key_1)
                 VALUES ('$magic_name','$magic_spec','$magic_type', '$magic_no', '$magic_bonus_tp','$magic_feat','$magic_skill','dd35')" ;
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
  <TH>Magic Item</TH>
  <TD><SELECT NAME="magic_name">
<?
$select = "SELECT itemtype_id, itemtype_item, itemtype_bonus, itemtype_subtype FROM itemtype where itemtype_id like 'Rings%' or itemtype_id like 'Wond%' ".
          "  or itemtype_id like 'Wand%'  or itemtype_id like 'Staff%'   or itemtype_id like 'Rod%' or itemtype_id like 'Potion%' " .
          " or itemtype_id like 'Arcane-%'  or itemtype_id like 'Divine-%' " .
           "ORDER BY itemtype_item, itemtype_bonus" ;
include 'includes/dd_db_conn.txt';
echo $select;
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

$magic_sel = $row['itemtype_item'] ;
$magic_sel_bonus = $row['itemtype_bonus'];
$magic_id = $row['itemtype_id'];
$magic_sub = $row['itemtype_subtype'];
if (substr($magic_id,0,4) == "Ring"){
  $magic_sel =  "Ring of " . $magic_sel;
}
if (substr($magic_id,0,4) == "Wand"){
  $magic_sel =  "Wand of " . $magic_sel;
}
if (substr($magic_id,0,4) == "Staf"){
  $magic_sel =  "Staff of " . $magic_sel;
}
if (substr($magic_id,0,3) == "Rod"){
  $magic_sel =  "Rod of " . $magic_sel;
}
if (substr($magic_id,0,4) == "Poti"){
  $magic_sel =  "Potion of " . $magic_sel;
}
if (substr($magic_id,0,6) == "Divine"){
  $magic_sel =  "Scroll of " . $magic_sub;
}
if (substr($magic_id,0,6) == "Arcane"){
  $magic_sel =  "Scroll of " . $magic_sub;
}
if ($magic_sel_bonus != ""){
  $magic_sel .= " ($magic_sel_bonus)";
}
if ($magic_sel == $magic_name)
   {
    $sel = " SELECTED" ;
   } else {
    $sel = "" ;
          }

echo <<<EOF
  <OPTION VALUE="$magic_sel" $sel > $magic_sel </OPTION>
EOF;

}
mysqli_close($link);
?>
      </SELECT>
</TR>
<TR>
<TD>Body<SELECT NAME="magic_body">
<?
$select = "SELECT magicbody_id, magicbody_desc FROM magicbody" ;
include 'includes/dd_db_conn.txt';
$result = mysqli_query($link, $select) ;

while ($row = mysqli_fetch_array($result)) {

  $magicbody_sel = $row['magicbody_id'] ;
  $magicbody_desc = $row['magicbody_desc'];
  if ($magicbody_sel == $magic_body)
     {
      $sel = " SELECTED" ;
     } else {
      $sel = "" ;
     }
  $desc = $magicbody_sel . " " . $magicbody_desc;
echo <<<EOF
     <OPTION VALUE="$magicbody_sel" $sel > $desc </OPTION>
EOF;
}
?>
</SELECT>
<TD>Desc<INPUT TYPE="text" NAME="magic_desc" VALUE= "<?echo $magic_desc?>" ></TD>
<TD>Value<INPUT TYPE="text" NAME="magic_value" VALUE= "<?echo $magic_value?>" ></TD>
</BR>
</TABLE>
<TABLE>
<TR>
<TH>Magic Spec</TH>
<TH>Skill</TH>
<TH>Feat</TH>
<TH>Bonus</TH>
<TH>Bonus Type</TH>
</TR>
<?
$loop = 0;
While ($loop < 9){
  $loop = $loop + 1;
  $magic_specv = "magic_spec_" . $loop;
  $magic_spec  = $$magic_specv;
  $magic_typev = "magic_type_" . $loop;
  $magic_type  = $$magic_typev;
  $magic_nov = "magic_no_" . $loop;
  $magic_no  = $$magic_nov;
  $magic_bonus_tpv = "magic_bonus_tp_" . $loop;
  $magic_bonus_tp  = $$magic_bonus_tpv;
  $magic_skillv = "magic_skill_" . $loop;
  $magic_skill  = $$magic_skillv;
  $magic_featv = "magic_feat_" . $loop;
  $magic_feat  = $$magic_featv;



echo <<<EOF
    <TD><SELECT NAME="$magic_specv">
EOF;
  $select = "SELECT feattype_id, feattype_desc FROM feattype ORDER BY feattype_id" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $magic_spec_sel = $row['feattype_id'] ;
    $feattype_desc = $row['feattype_desc'];
    if ($magic_spec_sel == $magic_spec)
       {
        $sel = " SELECTED" ;
       } else {
        $sel = "" ;
              }
     $desc = $magic_spec_sel . " " . $feattype_desc;
echo <<<EOF
     <OPTION VALUE="$magic_spec_sel" $sel > $desc </OPTION>
EOF;
   }
   mysqli_close($link);

echo <<<EOF
     </SELECT>
    </TD>
    <TD><SELECT NAME="$magic_skillv">
EOF;

  $select = "SELECT skill_cd FROM skills2 where skill_dd35 = 'Y' ORDER BY skill_cd" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $skill_sel = $row['skill_cd'] ;
    if ($skill_sel == $magic_skill)
     {
       $sel = " SELECTED" ;
     } else {
         $sel = "" ;
            }

echo <<<EOF
    <OPTION VALUE="$skill_sel" $sel > $skill_sel </OPTION>
EOF;
    }

  echo "/SELECT";
    mysqli_close($link);
echo <<<EOF
    <TD><SELECT NAME="$magic_featv" VALUE="$magic_feat">
EOF;

  $select = "SELECT feat_name FROM feats2 where mon_key_1 = 'dd35'" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

    $feat_sel = $row['feat_name'] ;
    if ($feat_sel == $magic_feat){
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
  <TD><INPUT TYPE="text" NAME="$magic_nov" VALUE= $magic_no ></TD>
  <TD><SELECT NAME="$magic_bonus_tpv" VALUE="$magic_bonus_tp">
EOF;

  $select = "SELECT magicbonus_tp FROM magicbonus order by magicbonus_tp" ;
  include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;

  while ($row = mysqli_fetch_array($result)) {

   $magic_bonus_tp_sel = $row['magicbonus_tp'] ;
   if ($magic_bonus_tp_sel == $magic_bonus_tp){
       $sel = " SELECTED" ;
   } else {
      $sel = "" ;
   }

echo <<<EOF
      <OPTION VALUE="$magic_bonus_tp_sel" $sel > $magic_bonus_tp_sel </OPTION>
EOF;

  }

echo "</TR>" ;
echo   "<TR>";
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