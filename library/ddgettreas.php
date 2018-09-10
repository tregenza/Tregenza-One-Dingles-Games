<<<<<<< HEAD
<?php
 global $treas_subtype, $treas_amount;
 global $weapon_type, $weapon, $special_x, $specific_x, $item_type_id;
  global $item_subtype, $item, $item_value, $item_bonus, $item_found ;
   global $weapon_type;
$focus1 = "focus1";
$focus2 = "focus1";
$total = 0;
$amount = 0;
$goods_desc = "";
$goods_total = 0;
$goods_average = 0;
$none = "";
$minor = "";
$medium = "";
$major = "";
$coins_desc = "";
$item_header_desc = "";
$specific = "";
$items_amount_total = 0;
$goods_amount = 0;
$goods_subtype = "";
$treas_amount = 0;
$cr = 0;
$magic_type_no = 0;
$count_new_x = 0;
$mon_hd = 0;

if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }

    if ($cr == "" and $magic_type == "") {
       $msg = "please select CR" ;
    }
    if ($magic_type != ""){
        $cr = "1";
        $coins = "0";
        $goods = "0";
        $items = "1";
    }
//    echo "mon_hd_1 " . $mon_hd_1 . "**";
    if ($msg == "") {
/*      $_SESSION['smon_name'] = $mon_name;
      $_SESSION['sclass1_tp'] = $class1_tp;
      $_SESSION['sclass1_level'] = $class1_level;
      $_SESSION['sclass1_focus'] = $class1_focus;
      $_SESSION['sclass2_tp'] = $class2_tp;
      $_SESSION['sclass2_level'] = $class2_level;
      $_SESSION['sclass2_focus'] = $class2_focus;
      $_SESSION['suser'] = $user_id;
      $_SESSION['snew'] = "YES";
      $_SESSION['selite'] = $elite; */

      $select = "SELECT count_new, count_old, count_oldmon_key from counttreas where count_key = 'KEY'";
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $count_new = $row['count_new'];
      $count_old = $row['count_old'];
      $count_oldmon_key = $row['count_oldmon_key'];
      $count_oldmon_key = $count_oldmon_key + 1;
      if ($count_oldmon_key > 9){
         $count_oldmon_key = 0;
      }
      if ($count_new_x == 1){
        $count_new = $count_new + 1;
      }else{
        $count_old = $count_old + 1;
      }
      $update  = "UPDATE counttreas SET count_new = '$count_new', count_old = '$count_old', count_oldmon_key = '$count_oldmon_key' WHERE " .
                      "count_key = 'KEY'";
      $result3 = mysqli_query($link, $update) ;
      $_SESSION['soldmon_key'] = $count_oldmon_key;


      function dice ($dice){
        $total =0;
//        echo "DICE= " . $dice;
        $dice = trim($dice);
        $dice = strtolower($dice);
        if (stripos($dice,"d")){
          $d = stripos($dice,"d");
//          echo " d = " . $d;
          $d = $d;
          $no = substr($dice, 0, $d);
          $len = strlen($dice);
          $d = $d +1;
          $die = substr($dice, $d, $len);
          $count = 0;
//          echo "die = " . $die . " no = " . $no;
          while ($count < $no){
            $count = $count +1;
            $ran = rand(1,$die);
            $total = $total + $ran;
          }
//          echo "total " . $total;
          return $total;

        }else{
        return $dice;
        }
      }


      function treasure ($cr, $pc, $treas_type) {
        $select = "select treas_dice, treas_mult, treas_subtype from treasure where treas_cr = '$cr' and treas_type = '$treas_type' " .
                 "and '$pc' >= treas_min and '$pc' <= treas_max";
//        echo $select;
        global $treas_subtype, $treas_amount;
        $link = getDBLink();
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result);
        $dice = $row['treas_dice'];
        $mult = $row['treas_mult'];
        $treas_subtype = $row['treas_subtype'];
        $die_throw = dice($dice);
        $treas_amount = $die_throw * $mult;
        return $treas_amount;
      }


      function item ($item_type, $pc, $retry_item) {
        global $weapon_type, $weapon, $special_x, $specific_x, $item_type_id;

        $item_type_id = $item_type;
        $special = substr($item_type,0,14);
        $magic = substr($item_type,14,2);

//        echo "special " . $special . " magic " . $magic;
        if ($special ==  "Special weapon"){
           if ($special_x == "Y"){
              return "error";
           }
           $special_x = "Y";
           if ($weapon_type == "Ranged"){
               $item_type = "Ranged special" . $magic;
           }else{
               $item_type = "Melee special" . $magic;
           }
        }
        if  ($special == "Specific weapo"){
           if ($specific_x == "Y"){
              return "error";
           }
           $specific_x = "Y";
           $weapon = "";
        }
        if ($retry_item != ""){
          if ($retry_item == "*weapons*"){
             $select = "select itemtype_subtype, itemtype_item, itemtype_value, itemtype_bonus, itemtype_found from itemtype where itemtype_id = '$item_type' " .
                    "and '$pc' >= itemtype_min and '$pc' <= itemtype_max and itemtype_bonus >''";
//             echo "RETRY WEAPON";
          }else{
            $like = $retry_item;
            $select = "select itemtype_subtype, itemtype_item, itemtype_value, itemtype_bonus, itemtype_found from itemtype where itemtype_id = '$item_type' " .
                    "and '$pc' >= itemtype_min and '$pc' <= itemtype_max and itemtype_subtype = '$like'";
//            echo $select;
          }
        }else{

          $select = "select itemtype_subtype, itemtype_item, itemtype_value, itemtype_bonus, itemtype_found from itemtype where itemtype_id = '$item_type' " .
                    "and '$pc' >= itemtype_min and '$pc' <= itemtype_max";
        }
//        echo  "</br>" . $select . "</br>";
        global $item_subtype, $item, $item_value, $item_bonus, $item_found ;
        $item_subtype = $item = $item_value = $item_bonus = $item_found = "";
        $link = getDBLink();
        $return = "error";
        $result = mysqli_query($link, $select) ;
        if ($result){
          if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $item_subtype = $row['itemtype_subtype'];
            $item = $row['itemtype_item'];
            $item_value = $row['itemtype_value'];
            $item_bonus = $row['itemtype_bonus'];
            $item_found = $row['itemtype_found'];
            $return = $item;
          }else{
            $return  = "error";
          }
         }else{
            return "error";
         }
//        echo "item " . $item . " bonus " . $item_bonus;
        return $return;

      }

// start of program
//----------------------------
//
//
//
//
//
//
//
//
//



    $mult_input = 1;
    $coins_i = $coins;

    if ($coins == "0.1"){
       $coins_i = 1;
       $mult_input = 0.1;
    }
    if ($coins == "0.5"){
       $coins_i = 1;
       $mult_input = 0.5;
    }
    $coins_count = 1;

    while ($coins_count <= $coins_i){
//      echo "<BR> coins count " .$coins_count . " coins  " . $coins;
      $min = 1;
      $max = 100;
      $ran1 = rand($min ,$max);
// Get coins
      $treas_type = "coins";
      $pc = $ran1;
      $res = treasure($cr, $pc, $treas_type);
      if ($treas_amount != 0){
        $coins_subtype = $treas_subtype;
        $coins_amount = round(($treas_amount * $mult_input), 0);
        $coins_desc .= $coins_amount . $coins_subtype . ", ";
      }else{
        $coins_subtype = "";
        $coins_amount = 0;
      }
      $coins_count += 1;
    }

//      echo "TREASURE " . $treas_subtype . " " . $treas_amount;
    $mult_input = 1;
    $goods_i = $goods;
    if ($goods == "0.5"){
       $goods_i = 1;
       $mult_input = 0.5;
    }
   $goods_count = 1;
    while ($goods_count <= $goods_i){
//      echo "<BR> goods count " .$goods_count . " goods  " . $goods;
      $min = 1;
      $max = 100;
      $ran1 = rand($min ,$max);
// Get goods
      $treas_type = "goods";
      $pc = $ran1;

      $res = treasure($cr, $pc, $treas_type);
      if ($treas_amount != 0){
        $goods_subtype = $treas_subtype;
        $goods_amount =  round(($treas_amount * $mult_input), 0);
        $count = 0;
        while ($count < $goods_amount){
           $count = $count + 1;
           $pc = dice("1d100");
           $select = "select treasval_die, treasval_mult, treasval_type, treasval_average from treasval where treasval_subtype = '$goods_subtype' " .
                 "and '$pc' >= treasval_min and '$pc' <= treasval_max";
           $link = getDBLink();
           $result = mysqli_query($link, $select);
           $row = mysqli_fetch_array($result);
           $dice = $row['treasval_die'];
           $mult = $row['treasval_mult'];
           $treasval_type = $row['treasval_type'];
           $average = $row['treasval_average'];
           $die_throw = dice($dice);
           $treasval_amount = $die_throw * $mult;
           $treasval_average = $average;
           $goods_desc .=    $treasval_type . " (" . $treasval_amount . "gp) <br/>" ;
           $goods_total += $treasval_amount;
           $goods_average += $average;
        }
      }else{
        $goods_subtype = "";
        $goods_amount = 0;
      }
      $goods_count += 1;
    }
//      echo "TREASURE " . $treas_subtype . " " . $treas_amount;
// Get items
    $items_count = 1;
    $mult_input = 1;
    $items_i = $items;
    if ($items == "0.5"){
       $items_i = 1;
       $mult_input = 0.5;
    }
    if ($magic_type !=""){
        $items_i = 1;
    }
//    echo $items_i;
     while ($items_count <= $items_i){
//       echo "<BR> items count " .$items_count . " items " . $items;
      $treas_type = "items";
      $pc = dice("1d100");
//      $pc = 30;

      $res = treasure($cr, $pc, $treas_type);
      if ($magic_type != ""){
         $treas_subtype = $magic_type;
         $treas_amount = $magic_type_no;
      }
      if ($treas_amount != 0){
        $item_subtype = $treas_subtype;
        $item_subtype_x = $treas_subtype;
        $item_amount = round(($treas_amount * $mult_input),0);
        $item_header_desc .= $item_amount . " x " . $item_subtype . ", ";
        $item_found = "";
        $retry = "";
        $item_result = "";
        $result = "";
        $count = 0;
        while ($count < $item_amount){
          $count =  $count + 1;
          $count_total =  $items_count . $count;
          $item_subtype =  $item_subtype_x;
          $descv = "itemdesc_" . $count_total;
          if (isset($$descv)){
          }else{
             $$descv = "";
          }
          $pc = dice("1d100");
//          $pc = 11;
          $item_found = "";

          $result = item($item_subtype, $pc, "");
          if ($item != ""){
            if (isset($$descv)){
            }else{
              $$descv = "";
            }
            $$descv .= $item;
            if ($item_found == "Y"){
               $$descv .= "\n";
            }
          }
          $item_subtype_top = $item_subtype;
          $weapon = "";
          $weapon_type = "";
          $bonus_found = "";
          $bonus = "";
          $item_bonus = "";
          $type_save = "";
          $item_subtype_save ="";
//  find weapon
          if (substr($item_subtype,0,6) == "Weapon"){
//             echo "search weapon ";
             $item_subtype = "Weapon type";
             $pc = dice("1d100");
             $result = item($item_subtype, $pc, "");
             $count2 = 0;
              while ($result != "error" and $item_found !="Y" and $count2 < 20 and $item_subtype != ""){
                if ($retry_item != ""){
                  $found = "N";
                  $count3 = 0;
                  $item_subtype_save = $item_subtype;
                  while ($found == "N" and $count3 < 100){
                    $item_subtype = $item_subtype_save;
                    $pc = dice("1d100");
                    $count3 = $count3 + 1;
                    $result = item($item_subtype, $pc, $retry_item);
                    if ($result != "error" and ($item != "" or  $item_subtype !="")){
                      $found = "Y";
                      $retry_item = "";
                    }
//                 echo "retry " . $retry_item . "item " . $item;
                  }
                }else{
                   $pc = dice("1d100");
                   $result = item($item_subtype, $pc, "");

                }
                $retry_item = "";
                $retry = "";
                $count2 = $count2 + 1;
//              echo " count2 " . $count2 . " item_subtype " . $item_subtype . " item " . $item;
                if ($result != "error" and $item != ""){
                   $weapon =  $item;
                }
                if ($item_subtype == "" and $type_save != "" and $item_found != "Y"){
                   $item_subtype = $item_subtype_top;
                   $retry_item = $type_save;
                   $type_save = "";
                   $result = "";
                   $retry = "Y";
                }
              }
              if ($item_subtype_save == "ammunition"){
                 $weapon_type = "Ranged";
              }else{
                $select = "SELECT weap_range_tp from weapons WHERE weap_id = '$weapon'";
                $link = getDBLink();
                $result = mysqli_query($link, $select);
                $row = mysqli_fetch_array($result);
                if (mysqli_num_rows($result) > 0){
                   $weap_range_tp = $row['weap_range_tp'];
                   if ($weap_range_tp == "Ranged"){
                       $weapon_type = "Ranged";
                   }else{
                       $weapon_type = "Melee";
                   }
                }else{
                   $weapon_type = "melee";
                }
                global $weapon_type;
              }
              $item_subtype = $item_subtype_top;
              $bonus = $item_bonus;
//              echo "Found " . $weapon;
// end weapon
          }




//          $$descv = $item_subtype;
          $type_save = "";
          $retry_item = "";
          $count2 = 0;
          $item_found = "";
          $bonus_found = "";
          $specific_x = "";
          $special_x = "";
          $subtype_count = 0;
          $scroll_count = 0;
          while (($result != "error" and $item_found !="Y" and $count2 < 100) or ($subtype_count > 0 and $count2 < 100) ){
            if ($item_subtype != ""){
               $item_subtype_save = $item_subtype;
//               echo "subtype save = " . $item_subtype_save;
            }
            if ($retry_item != ""){
               $found = "N";
               $count3 = 0;
               $item_subtype_last = $item_subtype;
               while ($found == "N" and $count3 < 100){
                 $item_subtype = $item_subtype_last;
                 $pc = dice("1d100");
                 $count3 = $count3 + 1;
                 $result = item($item_subtype, $pc, $retry_item);
                 if ($weapon != ""){
                      if  ($item_found == "Y" and $item_bonus != ""){
                         $found = "Y";
                         $retry_item = "";
                      }
                 }
                 if ($result != "error" and ($item != "" or  $item_subtype !="") and $weapon == ""){
                    $found = "Y";
                    $retry_item = "";
                 }
//                 echo "retry " . $retry_item . "item " . $item;
               }
            }else{
              $pc = dice("1d100");

//              if ($count2 == 0 or $count2 == 1){
//                 echo "count2= " . $count2;
//                 $pc = 100;
//              }
         //     echo "item_subtype = " . $item_subtype;
              $result = item($item_subtype, $pc, "");
          //     echo " PC = " . $pc . "subtype = " . $item_subtype;

            }
            $retry_item = "";
            $retry = "";
            $count2 = $count2 + 1;
//            echo " count2 " . $count2 . " item_subtype " . $item_subtype . " item " . $item;
            if (($item_bonus == "1d3" or $item_bonus == "1d4" or $item_bonus == "1d6")
                and  ($item_type_id == "Scrolls-1" or $item_type_id == "Scrolls-2" or $item_type_id == "Scrolls-3" )){
                $scroll_count = dice($item_bonus) -1;
//                $scroll_count = 2;
//                echo "Scroll count " . $scroll_count;
                $item_bonus = "";


            }
            if ($item_bonus !=""){
               if ($specific == "Y"){
                  $bonus = $item_bonus;
               }else{
                  $bonus .= $item_bonus;
               }
            }
            if ($item_subtype != ""){
//              $$descv .= " " . $item_subtype;

              if ($item != ""){
                 $type_save = $item;
//                 $$descv .= $item;
              }
            }
            if ($subtype_count > 0){
               $subtype_count = $subtype_count - 1;
               $item_subtype = $item_subtype_save;
               $special_x = "";
            }

            if ($item == "***Roll twice***" or $item == "***Roll again***"){
                $special_x = "";
                $item_subtype = $item_subtype_save;
                $subtype_count += 2;
//                echo "ROLL AGAIN";
                $item = "";
            }else{
// check for duplicate
               if ($result != "error" and $item != ""){

                 $desc_x = $$descv;
                 if ($special_x == "Y"){
                    if (strpos($desc_x, $item)){
                      $special_x = "";
                      $item_subtype = $item_subtype_save;
                      $subtype_count += 1;
                      $item = "";
                    }else{
                       if ($item_found == "Y" and $bonus != "" ){
                          $$descv .= " " . $item . " ". $bonus. "\n";
                       }else{
                          $$descv .=  " " .$item . "\n";
                       }
                    }
                 }else{
                   if ($item_found == "Y" and $bonus != "" ){
                      $$descv .= " " . $item . " ".  $bonus . "\n";
                   }else{
                      $$descv .=  " " .$item . "\n";
                   }
                 }
               }
            }

            if ($item_subtype == "" and ($type_save != "" or $weapon != "") and $item_found != "Y"){
               $item_subtype = $item_subtype_top;
               if ($weapon != ""){
//                 echo "retry weapon *";
                 $retry_item = "*weapons*";
               }else{
                 $retry_item = $type_save;
               }
               $type_save = "";
               $result = "";
               $retry = "Y";
            }
            if ($item_found == "Y" and $scroll_count > 0){
             $scroll_count -= 1;
             $item_found = "";
             $item_subtype = $item_subtype_save;
             $$descv .=  ",";
            }
          }
          if ($weapon != "" and $bonus_found == ""){
            $bonus_found = "Y";
            if ($$descv != ""){
              $$descv .= " " . $weapon . " " . $bonus . "\n";
            }else{
              $$descv = $weapon .  " " . $bonus . "\n";
            }
          }

// end item while
        }
      }else{
        $item_subtype = "";
        $item_amount = 0;
      }
//      echo "TREASURE " . $treas_subtype . " " . $treas_amount;

      $items_amount_total += $item_amount;
//    echo "<BR> items_amount_total " . $items_amount_total . $descv . $$descv;
// end no items found
      $items_count += 1;
      if (isset($$descv)){
        $$descv .= "\n";
      }
    }

  }

//  echo "<div class=\"error\">$msg</div>" ;
// end post
}else{
   $fn = $ln = "" ;
}
if (isset($coins)){
}else{
   $coins = "";
}

if (isset($goods)){
}else{
   $goods = "";
}

if (isset($items)){
}else{
   $items = "";
}

if ($coins ==""){
   $coins = 1;
}
if ($goods ==""){
   $goods = 1;
}
if ($items ==""){
   $items = 1;
}

?>
			<h1>D&D 3.5 Treasure Generator</h1>
			<p>Welcome to Dingle's Games <em>free</em> treasure generator for D&D 3.5.</p>

<?PHP
if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}
?>
<?PHP
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$workingPath = $url;
		require_once(locate_template('library/selectTreasureForm.php'));



?>

			<div id="intro" class="lightBorder justify">
			<p class="small">This tool is for DMs who are tired of spending an hour generating treasue only to see their players just cash it all in for gold. Using this treasure generator, a DM can create upto a 20CR Treasure hoared in a few seconds.</p>
			<p class="small">Once you have selected a CR press the CALCLATE button to create to create the treasure.</p>
			<p class="small">The treasure generator is free to use and supplied "as is". If you have any questions or problems, please write to us: CONTACT (at) DinglesGames (dot) com.</p>
			</div>

		


=======
<?php
$focus1 = "focus1";
$focus2 = "focus1";
$total = 0;
$amount = 0;
$goods_desc = "";
$goods_total = 0;
$goods_average = 0;
$none = "";
$minor = "";
$medium = "";
$major = "";
$coins_desc = "";
$item_header_desc = "";
$specific = "";
$items_amount_total = 0;
$goods_amount = 0;
$goods_subtype = "";


if ($_POST) {
    $msg = "" ;
    foreach ($_POST  as $k => $v) {
       $v = trim($v) ;
       $v = strip_tags($v);
       $$k = $v ;
    }

    if ($cr == "" and $magic_type == "") {
       $msg = "please select CR" ;
    }
    if ($magic_type != ""){
        $cr = "1";
        $coins = "0";
        $goods = "0";
        $items = "1";
    }
//    echo "mon_hd_1 " . $mon_hd_1 . "**";
    if ($msg == "") {
/*      $_SESSION['smon_name'] = $mon_name;
      $_SESSION['sclass1_tp'] = $class1_tp;
      $_SESSION['sclass1_level'] = $class1_level;
      $_SESSION['sclass1_focus'] = $class1_focus;
      $_SESSION['sclass2_tp'] = $class2_tp;
      $_SESSION['sclass2_level'] = $class2_level;
      $_SESSION['sclass2_focus'] = $class2_focus;
      $_SESSION['suser'] = $user_id;
      $_SESSION['snew'] = "YES";
      $_SESSION['selite'] = $elite; */

      $select = "SELECT count_new, count_old, count_oldmon_key from counttreas where count_key = 'KEY'";
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $count_new = $row['count_new'];
      $count_old = $row['count_old'];
      $count_oldmon_key = $row['count_oldmon_key'];
      $count_oldmon_key = $count_oldmon_key + 1;
      if ($count_oldmon_key > 9){
         $count_oldmon_key = 0;
      }
      if ($count_new_x == 1){
        $count_new = $count_new + 1;
      }else{
        $count_old = $count_old + 1;
      }
      $update  = "UPDATE counttreas SET count_new = '$count_new', count_old = '$count_old', count_oldmon_key = '$count_oldmon_key' WHERE " .
                      "count_key = 'KEY'";
      $result3 = mysqli_query($link, $update) ;
      $_SESSION['soldmon_key'] = $count_oldmon_key;


      function dice ($dice){
        $total =0;
//        echo "DICE= " . $dice;
        $dice = trim($dice);
        $dice = strtolower($dice);
        if (stripos($dice,"d")){
          $d = stripos($dice,"d");
//          echo " d = " . $d;
          $d = $d;
          $no = substr($dice, 0, $d);
          $len = strlen($dice);
          $d = $d +1;
          $die = substr($dice, $d, $len);
          $count = 0;
//          echo "die = " . $die . " no = " . $no;
          while ($count < $no){
            $count = $count +1;
            $ran = rand(1,$die);
            $total = $total + $ran;
          }
//          echo "total " . $total;
          return $total;

        }else{
        return $dice;
        }
      }


      function treasure ($cr, $pc, $treas_type) {
        $select = "select treas_dice, treas_mult, treas_subtype from treasure where treas_cr = '$cr' and treas_type = '$treas_type' " .
                 "and '$pc' >= treas_min and '$pc' <= treas_max";
//        echo $select;
        global $treas_subtype, $treas_amount;
        $link = getDBLink();
        $result = mysqli_query($link, $select) ;
        $row = mysqli_fetch_array($result);
        $dice = $row['treas_dice'];
        $mult = $row['treas_mult'];
        $treas_subtype = $row['treas_subtype'];
        $die_throw = dice($dice);
        $treas_amount = $die_throw * $mult;
        return $treas_amount;
      }


      function item ($item_type, $pc, $retry_item) {
        global $weapon_type, $weapon, $special_x, $specific_x, $item_type_id;

        $item_type_id = $item_type;
        $special = substr($item_type,0,14);
        $magic = substr($item_type,14,2);

//        echo "special " . $special . " magic " . $magic;
        if ($special ==  "Special weapon"){
           if ($special_x == "Y"){
              return "error";
           }
           $special_x = "Y";
           if ($weapon_type == "Ranged"){
               $item_type = "Ranged special" . $magic;
           }else{
               $item_type = "Melee special" . $magic;
           }
        }
        if  ($special == "Specific weapo"){
           if ($specific_x == "Y"){
              return "error";
           }
           $specific_x = "Y";
           $weapon = "";
        }
        if ($retry_item != ""){
          if ($retry_item == "*weapons*"){
             $select = "select itemtype_subtype, itemtype_item, itemtype_value, itemtype_bonus, itemtype_found from itemtype where itemtype_id = '$item_type' " .
                    "and '$pc' >= itemtype_min and '$pc' <= itemtype_max and itemtype_bonus >''";
//             echo "RETRY WEAPON";
          }else{
            $like = $retry_item;
            $select = "select itemtype_subtype, itemtype_item, itemtype_value, itemtype_bonus, itemtype_found from itemtype where itemtype_id = '$item_type' " .
                    "and '$pc' >= itemtype_min and '$pc' <= itemtype_max and itemtype_subtype = '$like'";
//            echo $select;
          }
        }else{

          $select = "select itemtype_subtype, itemtype_item, itemtype_value, itemtype_bonus, itemtype_found from itemtype where itemtype_id = '$item_type' " .
                    "and '$pc' >= itemtype_min and '$pc' <= itemtype_max";
        }
//        echo  "</br>" . $select . "</br>";
        global $item_subtype, $item, $item_value, $item_bonus, $item_found ;
        $item_subtype = $item = $item_value = $item_bonus = $item_found = "";
        $link = getDBLink();
        $return = "error";
        $result = mysqli_query($link, $select) ;
        if ($result){
          if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $item_subtype = $row['itemtype_subtype'];
            $item = $row['itemtype_item'];
            $item_value = $row['itemtype_value'];
            $item_bonus = $row['itemtype_bonus'];
            $item_found = $row['itemtype_found'];
            $return = $item;
          }else{
            $return  = "error";
          }
         }else{
            return "error";
         }
//        echo "item " . $item . " bonus " . $item_bonus;
        return $return;

      }

// start of program
//----------------------------
//
//
//
//
//
//
//
//
//



    $mult_input = 1;
    $coins_i = $coins;

    if ($coins == "0.1"){
       $coins_i = 1;
       $mult_input = 0.1;
    }
    if ($coins == "0.5"){
       $coins_i = 1;
       $mult_input = 0.5;
    }
    $coins_count = 1;

    while ($coins_count <= $coins_i){
//      echo "<BR> coins count " .$coins_count . " coins  " . $coins;
      $min = 1;
      $max = 100;
      $ran1 = rand($min ,$max);
// Get coins
      $treas_type = "coins";
      $pc = $ran1;
      $res = treasure($cr, $pc, $treas_type);
      if ($treas_amount != 0){
        $coins_subtype = $treas_subtype;
        $coins_amount = round(($treas_amount * $mult_input), 0);
        $coins_desc .= $coins_amount . $coins_subtype . ", ";
      }else{
        $coins_subtype = "";
        $coins_amount = 0;
      }
      $coins_count += 1;
    }

//      echo "TREASURE " . $treas_subtype . " " . $treas_amount;
    $mult_input = 1;
    $goods_i = $goods;
    if ($goods == "0.5"){
       $goods_i = 1;
       $mult_input = 0.5;
    }
   $goods_count = 1;
    while ($goods_count <= $goods_i){
//      echo "<BR> goods count " .$goods_count . " goods  " . $goods;
      $min = 1;
      $max = 100;
      $ran1 = rand($min ,$max);
// Get goods
      $treas_type = "goods";
      $pc = $ran1;

      $res = treasure($cr, $pc, $treas_type);
      if ($treas_amount != 0){
        $goods_subtype = $treas_subtype;
        $goods_amount =  round(($treas_amount * $mult_input), 0);
        $count = 0;
        while ($count < $goods_amount){
           $count = $count + 1;
           $pc = dice("1d100");
           $select = "select treasval_die, treasval_mult, treasval_type, treasval_average from treasval where treasval_subtype = '$goods_subtype' " .
                 "and '$pc' >= treasval_min and '$pc' <= treasval_max";
           $link = getDBLink();
           $result = mysqli_query($link, $select);
           $row = mysqli_fetch_array($result);
           $dice = $row['treasval_die'];
           $mult = $row['treasval_mult'];
           $treasval_type = $row['treasval_type'];
           $average = $row['treasval_average'];
           $die_throw = dice($dice);
           $treasval_amount = $die_throw * $mult;
           $treasval_average = $average;
           $goods_desc .=    $treasval_type . " (" . $treasval_amount . "gp) <br/>" ;
           $goods_total += $treasval_amount;
           $goods_average += $average;
        }
      }else{
        $goods_subtype = "";
        $goods_amount = 0;
      }
      $goods_count += 1;
    }
//      echo "TREASURE " . $treas_subtype . " " . $treas_amount;
// Get items
    $items_count = 1;
    $mult_input = 1;
    $items_i = $items;
    if ($items == "0.5"){
       $items_i = 1;
       $mult_input = 0.5;
    }
    if ($magic_type !=""){
        $items_i = 1;
    }
//    echo $items_i;
     while ($items_count <= $items_i){
//       echo "<BR> items count " .$items_count . " items " . $items;
      $treas_type = "items";
      $pc = dice("1d100");
//      $pc = 30;

      $res = treasure($cr, $pc, $treas_type);
      if ($magic_type != ""){
         $treas_subtype = $magic_type;
         $treas_amount = $magic_type_no;
      }
      if ($treas_amount != 0){
        $item_subtype = $treas_subtype;
        $item_subtype_x = $treas_subtype;
        $item_amount = round(($treas_amount * $mult_input),0);
        $item_header_desc .= $item_amount . " x " . $item_subtype . ", ";
        $item_found = "";
        $retry = "";
        $item_result = "";
        $result = "";
        $count = 0;
        while ($count < $item_amount){
          $count =  $count + 1;
          $count_total =  $items_count . $count;
          $item_subtype =  $item_subtype_x;
          $descv = "itemdesc_" . $count_total;
          if (isset($$descv)){
          }else{
             $$descv = "";
          }
          $pc = dice("1d100");
//          $pc = 11;
          $item_found = "";

          $result = item($item_subtype, $pc, "");
          if ($item != ""){
            if (isset($$descv)){
            }else{
              $$descv = "";
            }
            $$descv .= $item;
            if ($item_found == "Y"){
               $$descv .= "\n";
            }
          }
          $item_subtype_top = $item_subtype;
          $weapon = "";
          $weapon_type = "";
          $bonus_found = "";
          $bonus = "";
          $item_bonus = "";
          $type_save = "";
          $item_subtype_save ="";
//  find weapon
          if (substr($item_subtype,0,6) == "Weapon"){
//             echo "search weapon ";
             $item_subtype = "Weapon type";
             $pc = dice("1d100");
             $result = item($item_subtype, $pc, "");
             $count2 = 0;
              while ($result != "error" and $item_found !="Y" and $count2 < 20 and $item_subtype != ""){
                if ($retry_item != ""){
                  $found = "N";
                  $count3 = 0;
                  $item_subtype_save = $item_subtype;
                  while ($found == "N" and $count3 < 100){
                    $item_subtype = $item_subtype_save;
                    $pc = dice("1d100");
                    $count3 = $count3 + 1;
                    $result = item($item_subtype, $pc, $retry_item);
                    if ($result != "error" and ($item != "" or  $item_subtype !="")){
                      $found = "Y";
                      $retry_item = "";
                    }
//                 echo "retry " . $retry_item . "item " . $item;
                  }
                }else{
                   $pc = dice("1d100");
                   $result = item($item_subtype, $pc, "");

                }
                $retry_item = "";
                $retry = "";
                $count2 = $count2 + 1;
//              echo " count2 " . $count2 . " item_subtype " . $item_subtype . " item " . $item;
                if ($result != "error" and $item != ""){
                   $weapon =  $item;
                }
                if ($item_subtype == "" and $type_save != "" and $item_found != "Y"){
                   $item_subtype = $item_subtype_top;
                   $retry_item = $type_save;
                   $type_save = "";
                   $result = "";
                   $retry = "Y";
                }
              }
              if ($item_subtype_save == "ammunition"){
                 $weapon_type = "Ranged";
              }else{
                $select = "SELECT weap_range_tp from weapons WHERE weap_id = '$weapon'";
                $link = getDBLink();
                $result = mysqli_query($link, $select);
                $row = mysqli_fetch_array($result);
                if (mysqli_num_rows($result) > 0){
                   $weap_range_tp = $row['weap_range_tp'];
                   if ($weap_range_tp == "Ranged"){
                       $weapon_type = "Ranged";
                   }else{
                       $weapon_type = "Melee";
                   }
                }else{
                   $weapon_type = "melee";
                }
                global $weapon_type;
              }
              $item_subtype = $item_subtype_top;
              $bonus = $item_bonus;
//              echo "Found " . $weapon;
// end weapon
          }




//          $$descv = $item_subtype;
          $type_save = "";
          $retry_item = "";
          $count2 = 0;
          $item_found = "";
          $bonus_found = "";
          $specific_x = "";
          $special_x = "";
          $subtype_count = 0;
          $scroll_count = 0;
          while (($result != "error" and $item_found !="Y" and $count2 < 100) or ($subtype_count > 0 and $count2 < 100) ){
            if ($item_subtype != ""){
               $item_subtype_save = $item_subtype;
//               echo "subtype save = " . $item_subtype_save;
            }
            if ($retry_item != ""){
               $found = "N";
               $count3 = 0;
               $item_subtype_last = $item_subtype;
               while ($found == "N" and $count3 < 100){
                 $item_subtype = $item_subtype_last;
                 $pc = dice("1d100");
                 $count3 = $count3 + 1;
                 $result = item($item_subtype, $pc, $retry_item);
                 if ($weapon != ""){
                      if  ($item_found == "Y" and $item_bonus != ""){
                         $found = "Y";
                         $retry_item = "";
                      }
                 }
                 if ($result != "error" and ($item != "" or  $item_subtype !="") and $weapon == ""){
                    $found = "Y";
                    $retry_item = "";
                 }
//                 echo "retry " . $retry_item . "item " . $item;
               }
            }else{
              $pc = dice("1d100");

//              if ($count2 == 0 or $count2 == 1){
//                 echo "count2= " . $count2;
//                 $pc = 100;
//              }
         //     echo "item_subtype = " . $item_subtype;
              $result = item($item_subtype, $pc, "");
          //     echo " PC = " . $pc . "subtype = " . $item_subtype;

            }
            $retry_item = "";
            $retry = "";
            $count2 = $count2 + 1;
//            echo " count2 " . $count2 . " item_subtype " . $item_subtype . " item " . $item;
            if (($item_bonus == "1d3" or $item_bonus == "1d4" or $item_bonus == "1d6")
                and  ($item_type_id == "Scrolls-1" or $item_type_id == "Scrolls-2" or $item_type_id == "Scrolls-3" )){
                $scroll_count = dice($item_bonus) -1;
//                $scroll_count = 2;
//                echo "Scroll count " . $scroll_count;
                $item_bonus = "";


            }
            if ($item_bonus !=""){
               if ($specific == "Y"){
                  $bonus = $item_bonus;
               }else{
                  $bonus .= $item_bonus;
               }
            }
            if ($item_subtype != ""){
//              $$descv .= " " . $item_subtype;

              if ($item != ""){
                 $type_save = $item;
//                 $$descv .= $item;
              }
            }
            if ($subtype_count > 0){
               $subtype_count = $subtype_count - 1;
               $item_subtype = $item_subtype_save;
               $special_x = "";
            }

            if ($item == "***Roll twice***" or $item == "***Roll again***"){
                $special_x = "";
                $item_subtype = $item_subtype_save;
                $subtype_count += 2;
//                echo "ROLL AGAIN";
                $item = "";
            }else{
// check for duplicate
               if ($result != "error" and $item != ""){

                 $desc_x = $$descv;
                 if ($special_x == "Y"){
                    if (strpos($desc_x, $item)){
                      $special_x = "";
                      $item_subtype = $item_subtype_save;
                      $subtype_count += 1;
                      $item = "";
                    }else{
                       if ($item_found == "Y" and $bonus != "" ){
                          $$descv .= " " . $item . " ". $bonus. "\n";
                       }else{
                          $$descv .=  " " .$item . "\n";
                       }
                    }
                 }else{
                   if ($item_found == "Y" and $bonus != "" ){
                      $$descv .= " " . $item . " ".  $bonus . "\n";
                   }else{
                      $$descv .=  " " .$item . "\n";
                   }
                 }
               }
            }

            if ($item_subtype == "" and ($type_save != "" or $weapon != "") and $item_found != "Y"){
               $item_subtype = $item_subtype_top;
               if ($weapon != ""){
//                 echo "retry weapon *";
                 $retry_item = "*weapons*";
               }else{
                 $retry_item = $type_save;
               }
               $type_save = "";
               $result = "";
               $retry = "Y";
            }
            if ($item_found == "Y" and $scroll_count > 0){
             $scroll_count -= 1;
             $item_found = "";
             $item_subtype = $item_subtype_save;
             $$descv .=  ",";
            }
          }
          if ($weapon != "" and $bonus_found == ""){
            $bonus_found = "Y";
            if ($$descv != ""){
              $$descv .= " " . $weapon . " " . $bonus . "\n";
            }else{
              $$descv = $weapon .  " " . $bonus . "\n";
            }
          }

// end item while
        }
      }else{
        $item_subtype = "";
        $item_amount = 0;
      }
//      echo "TREASURE " . $treas_subtype . " " . $treas_amount;

      $items_amount_total += $item_amount;
//    echo "<BR> items_amount_total " . $items_amount_total . $descv . $$descv;
// end no items found
      $items_count += 1;
      if (isset($$descv)){
        $$descv .= "\n";
      }
    }

  }

//  echo "<div class=\"error\">$msg</div>" ;
// end post
}else{
   $fn = $ln = "" ;
}
if (isset($coins)){
}else{
   $coins = "";
}

if (isset($goods)){
}else{
   $goods = "";
}

if (isset($items)){
}else{
   $items = "";
}

if ($coins ==""){
   $coins = 1;
}
if ($goods ==""){
   $goods = 1;
}
if ($items ==""){
   $items = 1;
}

?>
			<h1>D&D 3.5 Treasure Generator</h1>
			<p>Welcome to Dingle's Games <em>free</em> treasure generator for D&D 3.5.</p>

<?PHP
if ($msg != ""){
  echo "<div class=\"error\">$msg</div>" ;
}
?>
<?PHP
$url = get_site_url();
//echo "url = $url";
$domain =    $_SERVER['REQUEST_URI'];
//echo "domain = $domain";
$workingPath = $url;
		require_once(locate_template('library/selectTreasureForm.php'));



?>

			<div id="intro" class="lightBorder justify">
			<p class="small">This tool is for DMs who are tired of spending an hour generating treasue only to see their players just cash it all in for gold. Using this treasure generator, a DM can create upto a 20CR Treasure hoared in a few seconds.</p>
			<p class="small">Once you have selected a CR press the CALCLATE button to create to create the treasure.</p>
			<p class="small">The treasure generator is free to use and supplied "as is". If you have any questions or problems, please write to us: CONTACT (at) DinglesGames (dot) com.</p>
			</div>

		


>>>>>>> 65450b134015a9177e74559b90657752af789db3
