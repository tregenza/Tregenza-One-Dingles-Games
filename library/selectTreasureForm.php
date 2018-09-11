<?PHP
/*
*
*		Select Monster Form
*
*/
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$ddpost = $url . $domain;
?>

<FORM METHOD="post" ACTION="<?php echo $ddpost; ?>">
<p>
<LABEL for="cr">
Challenge Rating
<SELECT NAME="cr" class="width4em">
<?php

   $count = 0;
   While ($count < 31){
   if ($count == $cr){
      $sel = " SELECTED";
   }else{
      $sel = "";
   }
?>
<OPTION VALUE="<?php echo $count; ?>" <?PHP echo $sel; ?> > <?PHP echo $count; ?></OPTION>
<?php
   $count = $count +1;
		                            }
?>
</SELECT>
</p>
<p>
Coins <SELECT NAME="coins" class="width6em">
<?php
if ($coins == "0"){
   $sel = " SELECTED";
} else {
   $sel = "";
}
?>
<OPTION VALUE="0" <?php echo $sel  ?>> X 0</OPTION>
<?php
if ($coins == "0.1"){
    $sel = " SELECTED";
} else {
    $sel = "";
}
?>
<OPTION VALUE="0.1" <?php echo $sel  ?>> X 0.1</OPTION>
<?php
if ($coins == "0.5"){
  $sel = " SELECTED";
} else {
  $sel = "";
}
?>
<OPTION VALUE="0.5" <?php echo $sel  ?>> X 0.5</OPTION>
<?php
$count = 1;
While ($count < 5){
    if ($count == $coins){
       $sel = " SELECTED";
    } else {
       $sel = "";
    }
?>
    <OPTION VALUE="<?php echo $count; ?>" <?PHP echo $sel; ?> > <?PHP echo "X " . $count; ?></OPTION>
<?php
    $count = $count +1;
}
?>
</SELECT>
Goods <SELECT NAME="goods" class="width6em">
<?php
if ($goods == "0"){
   $sel = " SELECTED";
} else {
   $sel = "";
}
?>
<OPTION VALUE="0" <?php echo $sel  ?>> X 0</OPTION>
<?php
if ($goods == "0.5"){
    $sel = " SELECTED";
} else {
    $sel = "";
}
?>
<OPTION VALUE="0.5" <?php echo $sel  ?>> X 0.5</OPTION>
<?php
$count = 1;
While ($count < 5){
    if ($count == $goods){
        $sel = " SELECTED";
    } else {
        $sel = "";
    }
?>
    <OPTION VALUE="<?php echo $count; ?>" <?PHP echo $sel; ?> > <?PHP echo "X " . $count; ?></OPTION>
<?php
    $count = $count +1;
}
?>
</SELECT>
Items <SELECT NAME="items" class="width6em">
<?php
if ($items == "0"){
   $sel = " SELECTED";
} else {
   $sel = "";
}
?>
    <OPTION VALUE="0" <?php echo $sel  ?>> X 0</OPTION>
<?php
if ($items == "0.5"){
    $sel = " SELECTED";
} else {
    $sel = "";
}
?>
<OPTION VALUE="0.5" <?php echo $sel  ?>> X 0.5</OPTION>
<?php
$count = 0;
While ($count < 5){
   if ($count == $items){
       $sel = " SELECTED";
   } else {
       $sel = "";
   }
?>
   <OPTION VALUE="<?php echo $count; ?>" <?PHP echo $sel; ?> > <?PHP echo "X " . $count; ?></OPTION>
<?php
   $count = $count +1;
}

?>
</p>
</SELECT>
</BR>
</BR>
<p>Or select number and type of magic items (Useful for items for sale in towns)</p>
</BR>
</BR>
<?php
if (isset($magic_type)){
   $$magic_type = " SELECTED";
}else{
   $none = " SELECTED";
   $minor = "";
   $medium = "";
   $major = "";
}
?>
Type <SELECT NAME="magic_type" class="width6em">
 <OPTION VALUE="" <?php echo $none  ?>>none</OPTION>
 <OPTION VALUE="minor" <?php echo $minor  ?>>minor</OPTION>
 <OPTION VALUE="medium" <?php echo $medium  ?>>medium</OPTION>
 <OPTION VALUE="major" <?php echo $major  ?>>major</OPTION>
</SELECT>
Number <SELECT NAME="magic_type_no" class="width6em">
<?php
$count = 0;
While ($count < 20){
   if ($count == $magic_type_no){
       $sel = " SELECTED";
   } else {
       $sel = "";
   }
?>

?>
   <OPTION VALUE="<?php echo $count; ?>" <?PHP echo $sel; ?> > <?PHP echo $count; ?></OPTION>
<?php
   $count = $count +1;
}
?>
 <p>
<INPUT class="button" id="generateTreasure" TYPE="submit" VALUE="Generate Treasure" tabindex=8 />
</LABEL>
 </p>

<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?php echo $count_new_x?>"/>
<INPUT TYPE="hidden" NAME="mon_hd", VALUE="<?php echo $mon_hd?>"/>




<div id="treasure">

<?php
if (isset($cr)){
}else{
  $cr = 0;
}
if ($cr != "" and $cr != 0){
?>
	<p><h3>Treasure </h3></p></br>
	<p><h5> Coins </h5>
	<?php echo $coins_desc; ?></p></br>

  	<p><h5> Goods </h5>
  	<?php $goods_amount ." ". $goods_subtype; ?></p></br>
	<p><?php echo $goods_desc; ?> </p>
	<p>Total Value: <?php echo $goods_total;?></p>  </br>
	<p><h5>Items</h5></p>
<?php
	if (  $items_amount_total != "") {
?>
		<p class="italic"><?php echo $item_header_desc;  ?></p>
<?php
	}
  $count5 = 0;
  While ($count5 < $items){
    $count5 += 1;
    $count4 = 0;
     while ($count4 < ($items_amount_total)){
       $count4 += 1;
        $descv = "itemdesc_" . $count5 . $count4;
        if (isset($$descv)){
        }else{
           $$descv = "";
        }
       $desc = $$descv;
       echo "<p>".$desc."</p>";
    }
  }
?>

<?php
}

?>
</FORM>

</div>

<?php
//include ($workingPath."/paypal5.php");
?>

