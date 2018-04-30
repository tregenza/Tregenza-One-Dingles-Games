<?PHP
/*
*
*		Select Monster Form
*
*/
?>

<FORM METHOD="post" ACTION="<? echo $_SERVER['PHP_SELF'] ?>">
<?
//if ($msg != ""){
//  echo "<div class=\"error\">$msg</div>" ;
//}
?>


		Email:
		<INPUT TYPE = "TEXT" NAME="email" VALUE = "<?PHP echo $email; ?>"$ >



<div>
<TR>
	<div>
		<h3>Enter Comment</h3>
	</div>
	<div>
	      <TABLE BORDER="1" CELLPADDING="1">
       <TR>
     <TD><TEXTAREA CLASS = "commentsPrint" NAME ="comment">
        <?echo $comment ?> </TEXTAREA>'
     </TD>
</TR>
</TABLE>
<? 
echo $thanks;
?>

	</div>
<div>




<BR>
  <INPUT class="button" id="generateComment" TYPE="submit" VALUE="Add Comment" tabindex=8 />
<!--  <INPUT class="button" TYPE="reset"  VALUE="cancel" />  -->
<!-- <?   echo $_SERVER['SERVER_NAME']; ?> -->

<?
include 'includes/dd_db_conn.txt';
$select =  "SELECT MAX(comments_key) FROM comments";
$result = mysqli_query($link, $select);
$row = mysqli_fetch_row($result);
$max_id = $row[0];
if ($max_id > 20){
  $start = $max_id - 20;
}else{
  $start = 1;
}
$select = "select  comments_date, comments_text from comments where comments_key >= '$start' ORDER BY comments_key DESC";
$result = mysqli_query($link, $select);
while ($row = mysqli_fetch_array($result)){
  $date2 = $row['comments_date'];
  $text = $row['comments_text'];
  echo "<BR></BR>";
  echo "<BR></BR>";
  echo $date2 . " " . $text;
}
?>
</FORM>
</div>
<div>
</div>
</div>
