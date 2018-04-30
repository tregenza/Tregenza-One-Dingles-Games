<?
$delete = "delete from advert where advert_supplier = 'rpgminatures'";
include 'includes/dd_db_conn.txt';

$result = mysqli_query($link, $delete) ;
$supplier = "rpgminatures";
$lines = file('minis.rpgminatures.txt');
//$lines  = file('www.legendgames.co.uk/minis.txt');
 foreach ($lines as $line_num => $line){
//     echo "<br>" . $line_num . " " . $line . "</br>";
     $text = $line;
     $key = $line_num;
     $pos = strpos($text, "<img src") -11 ;
     $pos1 = $pos;
     $html = substr($text, 9, $pos);
     $pos += 1;
     $len = strlen($text);
     $text = substr($text, $pos, $len);
     $pos = strpos ($text , "</a><br/>");
     $jpg= substr($text, 10,  $pos);
     $len = strlen($text);
     $pos += 10;
     $desc = substr($text ,$pos , $len);
     $desc = trim($desc);
     $len = strpos($desc,"%") ;
     $desc = substr($desc,0, $len);
//     echo "html " . $html . "</br>" ;
//     echo "jpg " . $jpg . "</br>";
     echo  "desc = " .  $desc . "</br>";
//     $html = str_replace($html, "'", "\'");
//     $jpg = str_replace($jpg, "'", "\'");
//     $desc = str_replace($desc, "'", "\'");

     if ($pos1 > 0){
        $insert = "insert into advert (advert_supplier, advert_key, advert_text, advert_html, advert_jpg, advert_desc) " .
                  "values ('$supplier', '$key', '$line2', '$html', '$jpg','$desc')";
 //       echo "$insert";


        if (!mysqli_query($link, $insert)) {
           $msg = "Error inserting data";
        }else{
           $msg = "record sucessfully added" ;
        }
     }
 }
$delete = "delete from advert where advert_supplier = 'rpgminatures' and " .
          "(advert_html like '%SSB%  or " .
           "advert_html like '%JEDI%  or " .
           "advert_html like '%GALAXY%  or " .
           "advert_html like '%Imperial%  or " .
           "advert_html like '%Clone_war%  or " .
           "advert_html like '%F_U%  or " .
           "advert_html like '%R_and_I%  or " .
           "advert_html like '%A_and_E%  or " .
           "advert_html like '%BOUNTY_HUNTER%  or " .
           "advert_html like '%Rots%  or " .
           "advert_html like '%Rebel_Storm%  or " .
           "advert_html like '%Star_Wars%  or " .
           "advert_html like '%Old_Republic%)";



include 'includes/dd_db_conn.txt';

$result = mysqli_query($link, $delete) ;





 ?>