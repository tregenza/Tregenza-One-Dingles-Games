<?PHP
//
//
//  Edit Saves
//

$postURL = getDgFormPostURL();

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
	mysqli_close($link);
}
?>
<div class="dg_dashboard">
<div class="noPrint">
	<h1>Saved NPCs</h1>
</div>
<FORM class="tregenza_one_dg_form" METHOD="post" ACTION="<?php echo $postURL; ?>">
<div>
<p>To change the Campaign, area and name overtype the the grey areas in the corresponding boxes and the press the Update Campaign info button. Your saves will then be sorted
 into Campaign, Area and Name order.</p>
<p>Your Last created NPCs/Monsters cannot be altered as they will be overwritten by your next save. (You can, however, edit these and then save them).</p>
<p>Only monsters SAVED on the NPC/Monsters Generator can be changed.</p>
<p>Note: Only the first 250 saved monsters can have their campaign data changed. If you have more you will have to delete some saves.</p>
</div>
<div>
<INPUT class="button noPrint" TYPE="submit" NAME="Update" VALUE="Update Campaign info." style="" />
<div class="formResults">
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

	if ($last != "Y"){
echo <<<EOF

		<div class="formResultsRow">
		<dl>
		<dt>Description</dt>
		<dd>$desc</dd>
		<dt>Campaign</dt>
		<dd><INPUT TYPE="text" NAME="$camp_r" VALUE="$savemon_camp"></dd>
		<dt>Area</dt>
		<dd><INPUT TYPE="text" NAME="$sub_r" VALUE="$savemon_sub" ></dd>
		<dt>Name</dt>
		<dd><INPUT TYPE="text" NAME="$name_r" VALUE="$savemon_name" ></dd>
		<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
		</dl>
		<p>
		<button class="noPrint" TYPE="submit" NAME="edit_ind" VALUE="$save_count" >Edit</button>
		<button class="noPrint" TYPE="submit" NAME="print_ind" VALUE="$save_count" >Print</button>
		<button class="noPrint" onclick="if (!confirm('Delete NPC: Are You Sure?')) return false;" TYPE="submit" NAME="delete_ind" VALUE="$save_count" >Delete</button>
		</p>
		</div>
EOF;

	}else{
	}
	
}

echo "</div>";

echo <<<EOF
<INPUT TYPE="hidden" NAME="max_count", VALUE="$save_count"/>
EOF;

?>

<INPUT class="button noPrint" TYPE="submit" NAME="Update" VALUE="Update Campaign info." />
</div>
</FORM>
</div>

