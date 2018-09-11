<?php
//  Edit Saves
//
//require( $workingPath."/ddfix.php");
$cr_max = "1";
$cr_min = "1";
$terain = "All";
$type = "All";
if ($_POST) {
   $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $$k = $v ;
    }
}
if (isset($monster_name)){
}else{
   $monster_name = "";
}
if (isset($monster_temp)){
}else{
   $monster_temp = "";
}
if (isset($class)){
}else{
   $class = "";
}
$monster_name = trim($monster_name);
$monster_temp = trim($monster_temp);
$class = trim($class);
$current_user = wp_get_current_user();
$wp_user = $current_user->user_login;

$ddpost =  getDgFormPostURL();


?>
<FORM class="tregenza_one_dg_form" METHOD="post" ACTION="<?php echo $ddpost; ?>">
<?php
//$select = "select distinct savemon_terain from savemon order by savemon_terain";
//$link = getDBLink();
//$result = mysqli_query($link, $select) ;
//$save_count = 0;
//$html = '<LABEL>Terrain <SELECT NAME="terain" >';
//$terain_sel = "All";
//if ($terain_sel == $terain){
//	$sel = " SELECTED" ;
//} else {
//	$sel = "" ;
//}
//$html .= '<OPTION VALUE="'.$terain_sel.'" '.$sel.' >'.$terain_sel.'</OPTION>';
//while ($row = mysqli_fetch_array($result)) {
//   $terain_sel = $row['savemon_terain'] ;
//    if ($terain_sel == $terain){
//	$sel = " SELECTED" ;
//    } else {
//	$sel = "" ;
//    }
//    if ($terain_sel != ""){
//       $html .= '<OPTION VALUE="'.$terain_sel.'" '.$sel.' >'.$terain_sel.'</OPTION>';
//    }
//}
//mysqli_close($link);
//
//$html .= '</SELECT></LABEL>';
//echo $html;
$html = "<LABEL>Terain Contains <INPUT TYPE='text' NAME='terain' SIZE = 30 value = '$terain' ></LABEL>";
echo $html;


$select = "select distinct montype from montype2 where mon_key_1 = 'dd35'  order by montype";
$link = getDBLink();
$result = mysqli_query($link, $select) ;
$save_count = 0;
$html = '<LABEL>Type <SELECT NAME="type" >';
$type_sel = "All";
if ($type_sel == $type){
	$sel = " SELECTED" ;
} else {
	$sel = "" ;
}
$html .= '<OPTION VALUE="'.$type_sel.'" '.$sel.' >'.$type_sel.'</OPTION>';
while ($row = mysqli_fetch_array($result)) {
   $type_sel = $row['montype'] ;
    if ($type_sel == $type){
	$sel = " SELECTED" ;
    } else {
	$sel = "" ;
    }
    if ($type_sel != ""){
       $html .= '<OPTION VALUE="'.$type_sel.'" '.$sel.' >'.$type_sel.'</OPTION>';
    }
}
mysqli_close($link);

$html .= '</SELECT></LABEL>';
echo $html;




$html = '<LABEL>CR From <SELECT NAME="cr_min" >';
$sub = 0 ;
while ($sub < 40){
  $sub +=1;
   if ($sub == $cr_min){
	$sel = " SELECTED" ;
    } else {
	$sel = "" ;
    }
    $html .= '<OPTION VALUE="'.$sub.'" '.$sel.' >'.$sub.'</OPTION>';
}
$html .= '</SELECT></LABEL>';
echo $html;

$html = '<LABEL>CR To <SELECT NAME="cr_max" >';
$sub = 0 ;
while ($sub < 40){
  $sub +=1;
   if ($sub == $cr_max){
	$sel = " SELECTED" ;
    } else {
	$sel = "" ;
    }
    $html .= '<OPTION VALUE="'.$sub.'" '.$sel.' >'.$sub.'</OPTION>';
}
$html .= '</SELECT></LABEL>';
echo $html;
$link = getDBLink();
/*
$select = "select savemon_key, savemon_mon_name, savemon_mon_temp from savemon";
echo $select;
$result = mysqli_query($link, $select) ;
while ($row = mysqli_fetch_array($result)) {
   $savemon_key = $row['savemon_key'];
   echo $savemon_key;
   $savemon_mon_name = $row['savemon_mon_name'];
   $savemon_mon_temp = $row['savemon_mon_temp'];
   $mon_type = "";
   $temp_type = "";
   $select2 = "select mon_type from monster2 where mon_name = '$savemon_mon_name' and mon_key_1 = 'dd35'";
   $result2 = mysqli_query($link, $select2) ;
   $row2 = mysqli_fetch_array($result2);
   $mon_type = $row2['mon_type'];
   $select2 = "select mon_type from monster2 where mon_name = '$savemon_mon_temp' and mon_key_1 = 'dd35'";
   $result2 = mysqli_query($link, $select2) ;
   $row2 = mysqli_fetch_array($result2);
   $temp_type = $row2['mon_type'];
   $update = "update savemon set savemon_mon_type = '$mon_type', savemon_temp_type = '$temp_type' where savemon_key = '$savemon_key'";
   $result3 = mysqli_query($link, $update) ;
}
*/
?>

<INPUT class="button noPrint" TYPE="submit" NAME="Fetch" VALUE="Fetch Encounters" style="height: 28px; width: 200px" />

<?php
	/* Edit to hide results until user selects something - CT 21/6/18 */
		
	if ( isset($_POST['Fetch']) && $_POST['Fetch'] !== "" ) {
	
?> 

<h3>Matching Encounters</h3>
<div class="formResults">

<?php
$current_user = wp_get_current_user();
$wp_user = $current_user->user_login;
$user_id = $_COOKIE['dd_user_id'];
if ($wp_user != ""){
//   echo "wp user " . $wp_user;
   $save_key = trim($wp_user);
   $save_user = $user_id;
}else{
   $save_user = $user_id;
}
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$ddpost = $url . $domain;
//echo  "user id = " . $user_id;
//$terain_select = "XXX";
//if ($terain !=""){
//   $terain_select = $terain;
//   if ($terain == "All" or $terain == "ALL"){
//      $terain_select = "%";
//   }
//}
if ($terain > "" and $terain !== "All"){
   $terain_search = "%" . $terain . "%";
}else{
    $terain_search = "%";
}
if ($type == "All"){
   $select = "SELECT savemon_key, savemon_monster, savemon_mon_name, savemon_class1_tp, savemon_class2_tp, savemon_class3_tp, savemon_mon_temp, " .
            "savemon_class1_focus, savemon_class2_focus, savemon_class3_focus," .
           " savemon_class1_level, savemon_class2_level, savemon_class3_level, savemon_name, savemon_camp, savemon_sub, savemon_date, savemon_terain, savemon_cr, " .
           " CAST(savemon_cr as DECIMAL(2,2)) " .
            " from savemon  use INDEX (savemon_cr_index)  where savemon_terain like '$terain_search' and savemon_cr >= $cr_min and savemon_cr <= $cr_max and savemon_terain <>''" .
            " and savemon_key NOT LIKE 'dd%' and (savemon_mon_key_1 = 'dd35' or savemon_mon_key_1 = '')" .
            " order by CAST(savemon_cr as unsigned) ASC, savemon_terain,  savemon_monster";
}else{
    $select = "SELECT distinct savemon_key, savemon_monster, savemon_mon_name, savemon_class1_tp, savemon_class2_tp, savemon_class3_tp, savemon_mon_temp, " .
            "savemon_class1_focus, savemon_class2_focus, savemon_class3_focus," .
           " savemon_class1_level, savemon_class2_level, savemon_class3_level, savemon_name, savemon_camp, savemon_sub, savemon_date, savemon_terain, savemon_cr, " .
           " CAST(savemon_cr as DECIMAL(2,2)) " .
            " from savemon  use INDEX (savemon_cr_index)  where (savemon_mon_type = '$type' or savemon_temp_type = '$type') " .
            " and savemon_terain like '$terain_search' and savemon_cr >= $cr_min and savemon_cr <= $cr_max and savemon_terain <>''" .
            " and savemon_key NOT LIKE 'dd%' and (savemon_mon_key_1 = 'dd35' or savemon_mon_key_1 = '')" .
            " order by CAST(savemon_cr as unsigned) ASC, savemon_terain,  savemon_mon_name";
}
//echo $select;
$link = getDBLink();
$result = mysqli_query($link, $select) ;
$save_countx = 0;
while ($row = mysqli_fetch_array($result)) {
   $desc = "";
//   $save_count += 1;
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
   $savemon_terain  = $row['savemon_terain'];
   $savemon_cr = $row['savemon_cr'];
   $savemon_monster = $row['savemon_monster'];
   //       addslashes($str)
   parse_str($savemon_monster,$monster_a);

//      $monster_a = array('$savemon_monster');
//      echo $savemon_monster;
   foreach ($monster_a as $k => $v) {
      $v = trim($v) ;
      $v = str_replace("¬", "+", $v);
      $v = str_replace("|", "'", $v);
      $$k = $v ;
   }
   $total_gp = "0";
//$total_spent = "0";
   $cr_round  = round(($savemon_cr -0.49),0);
   $select2 = "SELECT level_gp from level where lev_no = '$cr_round'";
   $result2 = mysqli_query($link, $select2) ;
   while ($row2 = mysqli_fetch_array($result2)) {
      $total_gp = $row2['level_gp'];
   }
   $mon_ok = "";
//   echo $total_spent . "/" . $total_gp;
   if ($total_spent <= ($total_gp * 2.0)){
      $mon_ok = "Y";
      $save_countx += 1;
   }
   if ($savemon_date !=""){
       $date_x = date('Y-m-d H:i',$savemon_date);
   }
   if ($save_sel == $save_user){
      $desc = "Last created ";
   }else{
      $desc = "";
   }
   $desc .=  $savemon_mon_name;
   if ($savemon_mon_temp !=""){
      $desc .= ",(". $savemon_mon_temp . ")";
   }
   if ($savemon_class1_tp != ""){
      $desc .=  " " . $savemon_class1_tp . "($savemon_class1_level)";
   }
   if ($domain_11 != ""){
      $desc .= " ($domain_11";
   }
   if ($domain_12 != ""){
      $desc .=  ",$domain_12";
   }
   if ($domain_11 != ""){
      $desc .= ")";
   }
   if ($savemon_class2_tp != ""){
       $desc .=  " " . $savemon_class2_tp . "($savemon_class2_level)";
   }
   if ($domain_21 != ""){
      $desc .= " ($domain_21";
   }
   if ($domain_22 != ""){
      $desc .=  ",$domain_22";
   }
   if ($domain_21 != ""){
      $desc .= ")";
   }
    if ($savemon_class3_tp != ""){
       $desc .=  " " . $savemon_class3_tp . "($savemon_class3_level)";
   }
//   $desc .=  " " . $date_x;
   $camp_r = "camp_" . $save_countx;
   $sub_r = "sub_" . $save_countx;
   $name_r  = "name_" . $save_countx;
   $$camp_r = $savemon_camp;
   $$sub_r = $savemon_sub;
   $$name_r = $savemon_name;
   $save_key_r = "save_key_". $save_countx;
   $$save_key_r = $save_sel;
   if ($mon_ok == "Y"){
echo <<<EOF
<div class="formResultsRow">
<dl>
<dt>Description</dt>
<dd>$desc</dd>
<dt>Terrain</dt>
<dd>$savemon_terain</dd>
<dt>CR</dt>
<dd>$savemon_cr</dd>
<dt>GP Magic</dt>
<dd>$total_spent</dd>
</dl>
<p>
<button class="noPrint" TYPE="submit" NAME="print_indx" VALUE="$save_countx" >View</button>
<button class="noPrint" TYPE="submit" NAME="edit_ind" VALUE="$save_countx" >Edit</button>
</p>
</div>
<INPUT TYPE="hidden" NAME="$save_key_r", VALUE="$savemon_key"/>
EOF;
   }
}

echo <<<EOF
<INPUT TYPE="hidden" NAME="max_count", VALUE="$save_countx"/>
EOF;

?>
</TABLE>
<?php
if ($save_countx == 0){
  echo "<STRONG><BR></BR>No Encounter Found<BR></BR></STRONG>";
}
?>
</div>
<?php

	}		/* End of if to hide encounters before criteria selected */
?>
</FORM>


