<script>
var newwindow;
function poptastic(url)
{
	newwindow=window.open( url,'name','status=1,toolbar=1,resizable=1,scrollbars=1,location=1,height=800,width=900,directories=1');
	if (window.focus) {newwindow.focus()}
}
</script>
<?php
//$mon_name =  "Ogre";
//$class1_tp = "Adept";
$count = 0;
$mon_name1 =  $mon_name . " ";
if ($mon_name == "Human"){
  $mon_name1  = "";
}
$pos = strpos($mon_name, ",");
if ($pos > 0){
    $name1 = substr($mon_name,0, $pos);
    $name1 = trim($name1);
    $len =   strlen($mon_name);
    $pos +=1;
    $name2 =  substr($mon_name, $pos, $len);
    $name2 = trim($name2);
    $pos = strpos($name2, " ");
    if ($pos > 0){
      $name2 =  substr($name2,0, $pos);
      $name2 = trim($name2);
    }
 //   $name1 .=" ";
 //  $name2 .=" ";
//    echo $name1 . "/" . $name2;
    $select = "select count(*) from advert where  advert_desc like '%$name1%' and advert_desc like '%$name2%' ";
    $select2 = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert where " .
      " advert_desc like '%$name1%' and advert_desc like '%$name2%' ";
    $link = getDBLink();
//    echo $select2;
//include 'includes/dd_db_conn.txt';
    $result = mysqli_query($link, $select) ;
    $row = mysqli_fetch_array($result);
    $count = $row['0'];
    if ($count == 0 and ($name1 == "Demon" or $name1 == "Devil" or $name1 == "Dinosaur" or  $name1 == "Genie" or
        $name1 == "Monstrous" or $name1 == "Ooze" or $name1 == "Sphinx" or $name1 == "Sprite" or $name1 =="Whale")){
        $select = "select count(*) from advert where  advert_desc like '%$name2%' ";
        $select2 = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert where " .
          " advert_desc like '%$name2%' ";
        $link = getDBLink();
//include 'includes/dd_db_conn.txt';
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result);
        $count = $row['0'];
    }
}
if ($count == 0){
  $select = "select count(*) from advert where  advert_desc like '%$mon_name1%' and advert_desc like '%$class1_tp%' ";
  $select2 = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert where " .
      " advert_desc like '%$mon_name1%' and advert_desc like '%$class1_tp%' ";
//echo $select;
  $link = getDBLink();
//include 'includes/dd_db_conn.txt';
  $result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $count = $row['0'];
}
//echo $count;
if ($count == 0){
    if ($mon_name != "Human"){
        $select = "select count(*) from advert where  advert_desc like '%$mon_name1%'";
       $select2 = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert ".
                 "where  advert_desc like '%$mon_name1%'";
    }else{
        $select = "select count(*) from advert where  advert_desc like '%$class1_tp%'";
        $select2 = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert " .
                 "where  advert_desc like '%$class1_tp%'";
    }
//    echo $select2;
    $result = mysqli_query($link, $select) ;
    $row = mysqli_fetch_array($result);
    $count = $row['0'];
}
if ($count == 0){
    $pos = strpos($mon_name, ",");
    $adname = substr($mon_name,0, $pos);
    $adname = trim($adname);
    if ($adname != ""){
 //     echo $adname;

      $select = "select count(*) from advert where  advert_desc like '%$adname%'";
      $select2 = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert " .
                 "where  advert_desc like '%$adname%'";

      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $count = $row['0'];
    }
}
if ($count == 0){
    $adname = trim($adname);
    $pos = strpos($adname, " ") +1 ;
    if ($pos != 1){
      $len = strlen($adname);
      $adname = substr($adname, $pos, $len);
      $adname = trim($adname);
      if ($adname != ""){
        echo $adname;
        $select = "select count(*) from advert where  advert_desc like '%$adname%'";
        $select2 = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert " .
                   "where  advert_desc like '%$adname%'";

        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result);
        $count = $row['0'];
    }
  }
}





if ($count > 0 ) {
//   echo  "</br>" . $select2;
   $ran = rand(1,$count);
//   echo 'ran =  ' . $ran . 'count =' .  $count;
   $result = mysqli_query($link, $select2) ;
   $no = 0;
   while ($row = mysqli_fetch_array($result) and $no != $ran){
     $no += 1;
     if ($no == $ran ){
        $html = $row['advert_html'];
        $jpg = $row['advert_jpg'];
        $desc = $row['advert_desc'];
echo <<<EOF
   <p> 
   <b>Buy the Minature:</b>
   <a href ='javascript:poptastic("$html")'>$jpg $desc;
   </p>
EOF;
     }

   }

}



//$select = "select advert_supplier, advert_html, advert_jpg, advert_desc from advert where
//       "and

?>