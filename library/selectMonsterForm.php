<?PHP
/*
*
*		Select Monster Form
*
*/
?>

<FORM METHOD="post" ACTION="http://test.dinglesgames.com/tools/MonsterGenerator/dnd35/">
<?
//if ($msg != ""){
//  echo "<div class=\"error\">$msg</div>" ;
//}
?>
	<LABEL id="monsterTypeLabel">

		Monster
		<SELECT NAME="mon_name" >

<?PHP

		$select = "SELECT mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
		                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
		                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
		                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
		                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
		                 "mon_armour, mon_shield from monster order by mon_name";
		                 	
		include 'includes/dd_db_conn.txt';
		$result = mysqli_query($link, $select) ;

		while ($row = mysqli_fetch_array($result)) {

			$mon_sel = $row['mon_name'] ;
			$mon_hd  = $row['mon_hd'] ;

			if ($mon_sel == $mon_name)     {
				$sel = " SELECTED" ;
			} else {
        		$sel = "" ;
            }
?>
		<OPTION VALUE="<?PHP echo $mon_sel; ?>" <?PHP echo $sel; ?> ><?PHP echo $mon_sel; ?></OPTION>
<?PHP

		}
		mysqli_close($link);
?>
 	   </SELECT>
	</LABEL>


<div id="monsterClassSelection" class="table">
	<div class="tableRow">
		<h3>Select Classes (optional)</h3>
	</div>
	<div class="tableRow">
		<div class="tableCell tableCellWidth30">
			<h4>Class</h4>
		</div>
		<div class="tableCell tableCellWidth30">
			<h4>Level</h4>
		</div>
		<div class="tableCell tableCellWidth30">
			<h4>Skill Focus</h4>
		</div>
	</div>
	<div class="tableRow">
		<div class="tableCell tableCellWidth30">
			<SELECT NAME="class1_tp" class="classSelect" onchange='changeField1(class1_tp)' >
<?PHP
			$select = "SELECT class_tp from class ORDER BY class_tp";
			include $includePathLocal."/includes/dd_db_conn.txt";
			$result = mysqli_query($link, $select) ;
			while ($row = mysqli_fetch_array($result)) {
				$class_sel = $row['class_tp'] ;
				if ($class_sel == $class1_tp)  {
					$sel = " SELECTED" ;
				} else {
					$sel = ""; 
			    }
?>
			<OPTION VALUE="<?php echo $class_sel; ?>" <?PHP echo $sel; ?> > <?PHP echo $class_sel; ?></OPTION>
<?PHP
			}
			
			mysqli_close($link);
?>
		    </SELECT>
		</div>
		<div class="tableCell tableCellWidth30">
                           <SELECT NAME="class1_level">
<?
                            $count = 0;
                            While ($count < 21){
                                 if ($count == $class1_level){
                                     $sel = " SELECTED";
                                 } else {
                                     $sel = "";
                                 }
?>
                               	<OPTION VALUE="<?php echo $count; ?>" <?PHP echo $sel; ?> > <?PHP echo $count; ?></OPTION>
<?
                               	$count = $count +1;
                            }
?>
                           </SELECT>
		</div>
		<div class="tableCell tableCellWidth30" id="focus1">
			<INPUT TYPE="text" class="text focusSelect" id="focus1" readonly="readonly" NAME="class1_focus"  VALUE="<? echo $class1_focus ?>" onfocus='changeField1(class1_tp)'>
                </div>
	</div>
	<div class="tableRow">
		<div class="tableCell tableCellWidth30">
			<SELECT NAME="class2_tp" class="classSelect"  onchange='changeField2(class2_tp)'>
<?PHP
			$select = "SELECT class_tp from class ORDER BY class_tp";
			include 'includes/dd_db_conn.txt';
			$result = mysqli_query($link, $select) ;
			while ($row = mysqli_fetch_array($result)) {
			
				$class_sel = $row['class_tp'] ;
				if ($class_sel == $class2_tp) {
					$sel = " SELECTED" ;
			    } else {
			    	$sel = "" ;
			    }
?>
				<OPTION VALUE="<?PHP echo $class_sel; ?>" <?php ECHO $sel; ?> > <?PHP echo $class_sel ?> </OPTION>
<?PHP
			}
			mysqli_close($link);
?>
		    </SELECT>

		</div>
		<div class="tableCell tableCellWidth30">
		        <SELECT NAME="class2_level">
<?
                            $count = 0;
                            While ($count < 21){
                                 if ($count == $class2_level){
                                     $sel = " SELECTED";
                                 } else {
                                     $sel = "";
                                 }
?>
                               	<OPTION VALUE="<?php echo $count; ?>" <?PHP echo $sel; ?> > <?PHP echo $count; ?></OPTION>
<?
                               	$count = $count +1;
                            }
?>
                           </SELECT>
		</div>
		<div class="tableCell tableCellWidth30" id="focus2">

			<INPUT TYPE="text" class="text focusSelect" id="focus2" readonly = "readonly"   NAME = "class2_focus" VALUE = "<?PHP echo $class2_focus ?>" onfocus='changeField2(class2_tp)'>

		</div>
	</div>
<?
    $elite_sel_y = "";
    $elite_sel_n = "";
    if ($elite == "Y"){
      $elite_sel_y = "CHECKED";
    }else{
      $elite_sel_n = "CHECKED";
    }
?>
<div>
   <br></br>
   <br></br>
   Create an Elite ability array for the monster?
   <br></br>
   <INPUT TYPE = "radio" NAME = "elite" VALUE = "Y" <?echo $elite_sel_y ?>/>Y
   <INPUT TYPE = "radio" NAME = "elite" VALUE = "N" <?echo $elite_sel_n ?>/>N
</div>

<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?echo $count_new_x?>"/>
<INPUT TYPE="hidden" NAME="mon_hd", VALUE="<?echo $mon_hd?>"/>

<INPUT TYPE="hidden" NAME="status", VALUE="NEW"/>

<div>

<BR>
  <INPUT class="button" id="generateMonster" TYPE="submit" VALUE="Generate Monster" tabindex=8 />
<!--  <INPUT class="button" TYPE="reset"  VALUE="cancel" />  -->
<!-- <?   echo $_SERVER['SERVER_NAME']; ?> -->
</FORM>
</div>
<div>
If you are creating a spell caster use the NPC Generator and you will be allowed to select the spells
</div>
<?
require($workingPath."/ddgoogle.php");
?>
</div>
