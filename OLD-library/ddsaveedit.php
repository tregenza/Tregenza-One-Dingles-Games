<STYLE>
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
.specialaTable {
	position: relative;
         float: left;
}
.specialqTable {
	position: relative;
	Left: 200px;
}
</STYLE>
<?PHP
//
//
//  Edit Saves
//
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
//      echo "</BR>$k $v ";
    }

//    echo  "delete_ind = " . $delete_ind;
    if ($delete_ind != ""){
       $save_key_r =  "save_key_". $delete_ind;
//       echo $save_key_r . "=" . $$save_key_r;
       $del_key = $$save_key_r;
       $delete = "DELETE from savemon where savemon_key = '$del_key'";
//       echo "delete = " .  $delete;
       $link = getDBLink();
       $result = mysqli_query($link, $delete) ;
    }
//    echo "max $max_count";
    if ($max_count == 0 and $save_key_250 > ""){
        $max_count = 250;
    }
    $save_count = 0;
    while ($save_count < $max_count){
      $save_count +=1;
      $camp_r = "camp_" . $save_count;
      $sub_r = "sub_" . $save_count;
      $name_r  = "name_" . $save_count;
      $save_key_r = "save_key_". $save_count;
      $savemon_key = $$save_key_r;
      $savemon_camp = $$camp_r;
      $savemon_sub = $$sub_r;
      $savemon_name = $$name_r;
      $update = "update savemon set savemon_camp = '$savemon_camp', savemon_sub = '$savemon_sub', savemon_name = '$savemon_name' " .
                "where savemon_key = '$savemon_key'";
 //    echo $update;
      $link = getDBLink();
      $result = mysqli_query($link, $update) ;
    }
}
mysqli_close($link)


//require( $workingPath."/ddfix.php");
?>
<div class="noPrint">
	<h1>D&D 3.5 Saved NPCs</h1>
</div>
<FORM METHOD="post" ACTION="<?php echo $baseDomain.$urlPATH; ?>">
<div><STRONG>
To change the Campaign, area and name overtype the the grey areas in the corresponding boxes and the press the Update Campaign info button. Your saves will then be sorted
 into Campaign, Area and Name order.
 <BR></BR>
 Your Last created NPCs/Monsters cannot be altered as they will be overwritten by your next save. (You can, however, edit these and then save them).
 <BR></BR>Only montsters SAVED on the NPC/Monsters Generator can be changed.
<BR></BR>Note: Only the first 250 saved monsters can have their campaign data changed. If you have more you will have to delete some saves.
</STRONG>
</div>
<div>
<TD><INPUT class="button noPrint" TYPE="submit" NAME="Update" VALUE="Update Campaign info." style="height: 28px; width: 200px" /></TD>
<TABLE>
<TR>
<TH>Edit </TH>
<TH>Campaign</TH>
<TH>Area</TH>
<TH>Name</TH>
<TH>Desc</TH>
<TH>Print</TH>
<TH>Delete</TH>
</TR>
<?
if ($wp_user != ""){
//   echo "wp user " . $wp_user;
   $wp_user_x = trim($wp_user);
   $save_user = $user_id;
}else{
   $save_user = $user_id;
   $wp_user_x = $user_id;
}

//echo  "user id = " . $user_id;
$select = "SELECT savemon_key, savemon_monster, savemon_mon_name, savemon_class1_tp, savemon_class2_tp, savemon_class3_tp,  savemon_mon_temp, ".
           "savemon_class1_focus, savemon_class2_focus, savemon_class3_focus, " .
         " savemon_class1_level, savemon_class2_level, savemon_class3_level, savemon_name, savemon_camp, savemon_sub, savemon_cr, savemon_date " .
          " from savemon where savemon_user = '$save_user' or savemon_wp_user = '$wp_user_x' order by savemon_camp, savemon_sub, savemon_name, savemon_mon_name";
$link = getDBLink();
$result = mysqli_query($link, $select) ;
$save_count = 0;
while ($row = mysqli_fetch_array($result)) {
   $desc = "";
   $save_count += 1;
   $save_sel = $row['savemon_key'] ;
   $savemon_key = $save_sel;
   $savemon_mon_name = $row['savemon_mon_name'];
   $savemon_mon_temp = $row['savemon_mon_temp'];
   $savemon_class1_tp = $row['savemon_class1_tp'];
   $savemon_class2_tp = $row['savemon_class2_tp'];
   $savemon_class3_tp = $row['savemon_class3_tp'];
   $savemon_class1_level = $row['savemon_class1_level'];
   $savemon_class2_level = $row['savemon_class2_level'];
   $savemon_class3_level = $row['savemon_class3_level'];
   $savemon_name = $row['savemon_name'];
   $savemon_date = $row['savemon_date'];
   $savemon_camp = $row['savemon_camp'];
   $savemon_sub = $row['savemon_sub'];
   if ($savemon_date !=""){
       $date_x = date('Y-m-d H:i',$savemon_date);
   }
   if ($save_sel == $save_user or $save_sel == $wp_user){
      $last = "Y";
      $desc = "Last created ";
   }else{
      $desc = "";
      $last = "";
   }
   $desc .=  $savemon_mon_name;
   if ($savemon_mon_temp !=""){
      $desc .= ",(". $savemon_mon_temp . ")";
   }
   if ($savemon_class1_tp != ""){
      $desc .=  " " . $savemon_class1_tp . "($savemon_class1_level)";
   }
   if ($savemon_class2_tp != ""){
       $desc .=  " " . $savemon_class2_tp . "($savemon_class2_level)";
   }
   if ($savemon_class3_tp != ""){
       $desc .=  " " . $savemon_class3_tp . "($savemon_class3_level)";
   }
   $desc .=  " " . $date_x;
   $camp_r = "camp_" . $save_count;
   $sub_r = "sub_" . $save_count;
   $name_r  = "name_" . $save_count;
   $$camp_r = $savemon_camp;
   $$sub_r = $savemon_sub;
   $$name_r = $savemon_name;
   $save_key_r = "save_key_". $save_count;
   $$save_key_r = $save_sel;
echo <<<EOF
<TR>
<TD><INPUT class="button noPrint" TYPE="submit" NAME="edit_ind" VALUE="$save_count" style="height: 28px; width: 50px" /></TD>
EOF;
if ($last != "Y"){
echo <<<EOF
<TD><INPUT TYPE="text" NAME="$camp_r" VALUE="$savemon_camp" style="width: 100px"></TD>
<TD><INPUT TYPE="text" NAME="$sub_r" VALUE="$savemon_sub" style="width: 100px"></TD>
<TD><INPUT TYPE="text" NAME="$name_r" VALUE="$savemon_name" style="width: 100px"></TD>
EOF;
}else{
echo <<<EOF
<TD></TD>
<TD></TD>
<TD></TD>
EOF;
}
echo <<<EOF
<TD>$desc</TD>
<TD><INPUT class="button noPrint" TYPE="submit" NAME="print_ind" VALUE="$save_count" style="height: 28px; width: 100px"/></TD>
<TD><INPUT class="button noPrint" TYPE="submit" NAME="delete_ind" VALUE="$save_count" style="height: 28px; width: 50px" /></TD>
</TR>
<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
EOF;

}
echo <<<EOF
</TABLE>
<INPUT TYPE="hidden" NAME="max_count", VALUE="$save_count"/>
EOF;

?>

<TD><INPUT class="button noPrint" TYPE="submit" NAME="Update" VALUE="Update Campaign info." style="height: 28px; width: 200px" /></TD>
</div>
</FORM>



