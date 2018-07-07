<?PHP
/*
*
*		Select Monster Form
*
*/

/* CT 24/6/18 - Variable defs added to stop errors */
$mon_name = NULL;
$classFocus_1 = NULL;
$classLevel_1 = NULL;
$savemon_key = NULL;

if ( isset($_POST["classLevel_1"]) ){
	$classLevel_1 = $_POST["classLevel_1"];
}
if ( isset($_POST["savemon_key"] )){
	$savemon_key = $_POST["savemon_key"]; 
}
?>
<div id="monsterGenerator" >

<?php
	if ($msg != ""){
	  echo "<div class=\"error\">$msg</div>" ;
	}
	$key_1 = "path";
?>
	<FORM METHOD="post" ACTION="<?php echo getDgFormPostURL() ?>">
        <div>
<?php
             echo "<p>";
               $buttonHTML = "<INPUT class='button' id='generateMonster' TYPE='submit' VALUE='Generate Monster'/>" ;
               echo getAnimalCompanionSelectionHTML($mon_name );
?>
               <INPUT class="button" id="generateMonster2" TYPE="submit" VALUE="Generate Monster" tabindex=8 />
        </div>
	<div id="monsterClassSelection" class="table">
		<div class="tableRow">
			<h4>Select Classes Levels</h4>
		</div>
		<div class="tableRow">
			<div class="tableCell tableCellWidth30">
			    <h5>Class</h5>
			</div>
			<div class="tableCell tableCellWidth30">
			    <h5>Skill Focus</h5>
			</div>
			<div class="tableCell tableCellWidth30">
			   <h5>Char Level (Subtract 3 off the level for Rangers)</h5>
			</div>
		</div>


		<div class="tableRow">
			<div class="tableCell tableCellWidth30" >
				<INPUT TYPE="text" NAME="class_tp_1" class="classSelect" VALUE="Animal Companion" readonly "changeField('class_tp_1','1','Animal Companion'"/>
			</div>
                        <div class="tableCell tableCellWidth30" id="focus1">
   <?
                           $HTML = getAnimalCompanionFocus($classFocus_1);
                           echo $HTML;
   ?>
		        </div>
			<div class="tableCell tableCellWidth30">
		<?php
			     echo getClassLevelHTML( "1", $classLevel_1 );
		?>
			</div>
		</div>
                <div>
                     <div class="tableCell tableCellWidth30" id="domain_11">
		     </div>
	             <div class="tableCell tableCellWidth30" id="domain_12">
		     </div>
	             <div class="tableCell tableCellWidth30" id="domain_13">
		     </div>
                </div>

<?
//   				  <input type="hidden" value="1" id="theValue" />
//  <p><a href="javascript:;" onclick="addElement();">Add Some Classes</a></p>
// <div id="myDiv"> </div>

                $class_tp_2 = "";
                $classFocus_2 = "";
                $classLevel_2  = "0";
                $domain_21 = "";
                $domain_22 = "";
                $domain_23 = "";
                $class_tp_3 = "";
                $classFocus_3 = "";
                $classLevel_3  = "0";
                $domain_31 = "";
                $domain_32 = "";
                $domain_33 = "";
?>
               <INPUT TYPE="hidden" NAME="class_tp_2", VALUE="<?echo $class_tp_2?>"/>
               <INPUT TYPE="hidden" NAME="classFocus_2", VALUE="<?echo $classFocus_2?>"/>
               <INPUT TYPE="hidden" NAME="classLevel_2", VALUE="<?echo $classLevel_2?>"/>
               <INPUT TYPE="hidden" NAME="domain_21", VALUE="<?echo $domain_21?>"/>
               <INPUT TYPE="hidden" NAME="domain_22", VALUE="<?echo $domain_22?>"/>
               <INPUT TYPE="hidden" NAME="domain_23", VALUE="<?echo $domain_23?>"/>
               <INPUT TYPE="hidden" NAME="class_tp_3", VALUE="<?echo $class_tp_3?>"/>
               <INPUT TYPE="hidden" NAME="classFocus_3", VALUE="<?echo $classFocus_3?>"/>
               <INPUT TYPE="hidden" NAME="classLevel_3", VALUE="<?echo $classLevel_3?>"/>
               <INPUT TYPE="hidden" NAME="domain_31", VALUE="<?echo $domain_31?>"/>
               <INPUT TYPE="hidden" NAME="domain_32", VALUE="<?echo $domain_32?>"/>
               <INPUT TYPE="hidden" NAME="domain_33", VALUE="<?echo $domain_33?>"/>
        </div>
	<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?echo $count_new_x?>"/>
	<INPUT TYPE="hidden" NAME="status", VALUE="NEW"/>
	<INPUT TYPE="hidden" NAME="save_count", VALUE="<?echo $save_count?>"/>
<?
//                        echo "user_id" . $user_id;
?>      <div class="tableCell tableCellWidth100">
<?php
	     echo getSaveSelectionHTML($savemon_key);
?>
        </div>
	<div>
	   <INPUT class="button" id="generateMonster" TYPE="submit" VALUE="Generate Monster" tabindex=8 />
	</div>

   </FORM>
</div>






