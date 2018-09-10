<<<<<<< HEAD
<?
header('Content-Type: text/xml');

$f = $_GET['f'];
if (isset($f)){
   $link = mysqli_connect('localhost','root','','dd') ;
//   include 'includes/dd_db_conn.txt' ;
   $select1 = "SELECT feat_name, feat_desc FROM feats where feat_name = '$f'" ;
//   echo $select1;
   $result1 = mysqli_query($link, $select1) ;
   while ($row1 = mysqli_fetch_array($result1)) { 
     $feat_name = $row1[feat_name]; 
     $feat_desc = $row1[feat_desc];
     $feat_helpv  = $feat_name;
     $feat_help  = $feat_name . "\n" .  $feat_desc . "\n";
     $select2 = "select featattr_type, feattype_desc, featattr_id, featattr_rfeat, featattr_no from featattr, feattype " .
       "where featattr_feat = '$f' and featattr_type = feattype_id ";
//   echo  "</BR>" . $select2;   
     $result2 = mysqli_query($link, $select2) ;
     if ($result2){
       while ($row2 = mysqli_fetch_array($result2)) {
          $desc     = $row2[feattype_desc];
          $attr_id  = $row2[featattr_id];
          $attr_rfeat = $row2[featattr_rfeat];
          $attr_no    = $row2[featattr_no];
          $feat_help = $feat_help .  $desc . " " .  $attr_id . " " . $attr_rfeat ." " . $attr_no ."\n" ;
        
       }
     }    
   }
//   echo "</BR> $feat_help";
}
?>
<?php echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>
<?
//$feat_help = "test";
echo <<<EOF
alert("in ddfeathelp");
<response>
  <result>$feat_help</result>
</response>
EOF;
?>




=======
<?
header('Content-Type: text/xml');

$f = $_GET['f'];
if (isset($f)){
   $link = mysqli_connect('localhost','root','','dd') ;
//   include 'includes/dd_db_conn.txt' ;
   $select1 = "SELECT feat_name, feat_desc FROM feats where feat_name = '$f'" ;
//   echo $select1;
   $result1 = mysqli_query($link, $select1) ;
   while ($row1 = mysqli_fetch_array($result1)) { 
     $feat_name = $row1[feat_name]; 
     $feat_desc = $row1[feat_desc];
     $feat_helpv  = $feat_name;
     $feat_help  = $feat_name . "\n" .  $feat_desc . "\n";
     $select2 = "select featattr_type, feattype_desc, featattr_id, featattr_rfeat, featattr_no from featattr, feattype " .
       "where featattr_feat = '$f' and featattr_type = feattype_id ";
//   echo  "</BR>" . $select2;   
     $result2 = mysqli_query($link, $select2) ;
     if ($result2){
       while ($row2 = mysqli_fetch_array($result2)) {
          $desc     = $row2[feattype_desc];
          $attr_id  = $row2[featattr_id];
          $attr_rfeat = $row2[featattr_rfeat];
          $attr_no    = $row2[featattr_no];
          $feat_help = $feat_help .  $desc . " " .  $attr_id . " " . $attr_rfeat ." " . $attr_no ."\n" ;
        
       }
     }    
   }
//   echo "</BR> $feat_help";
}
?>
<?php echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'; ?>
<?
//$feat_help = "test";
echo <<<EOF
alert("in ddfeathelp");
<response>
  <result>$feat_help</result>
</response>
EOF;
?>




>>>>>>> 65450b134015a9177e74559b90657752af789db3
