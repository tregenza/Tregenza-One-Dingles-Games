<?
$select = "select savemon_mon_name, savemon_key, savemon_terain from savemon";
$link = getDBLink();
$result = mysqli_query($link, $select) ;
$save_count = 0;
while ($row = mysqli_fetch_array($result)) {
   $save_sel = $row['savemon_key'] ;
   $savemon_key = $save_sel;
   $savemon_mon_name = $row['savemon_mon_name'];
   $savemon_terain = $row['savemon_terain'];
   $select2 = "select mon_environment from monster where mon_name = '$savemon_mon_name'";
   $link = getDBLink();
   $result2 = mysqli_query($link, $select2) ;
   $row2 = mysqli_fetch_array($result2);
   $mon_terain = $row2['mon_environment'];
   if ($mon_terain != $savemon_terain ){
      echo "<BR></BR> $savemon_mon old = $savemon_terain new = $mon_terain";
      $update = "update savemon set savemon_terain = '$mon_terain' where savemon_key = '$savemon_key'";
      $result3 = mysqli_query($link, $update) ;
   }
}
?>