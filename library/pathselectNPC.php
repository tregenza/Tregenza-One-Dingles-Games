<?PHP
/*
*
*		Select Monster Form
*
*/
$ddpost = getDgFormPostUrl();

?>

<div id="monsterGenerator" >

<?php
	if ($msg != ""){
	  echo "<div class=\"error\">$msg</div>" ;
	}
	$key_1 = "path";
	if (isset($mon_name)){
        }else{
            $mon_name = "";
        }
        if (isset($mon_tem)){
        }else{
            $mon_tem = "";
        }
        if (isset($mon_tem2)){
        }else{
            $mon_tem2 = "";
        }
        if (isset($class_tp_1)){
        }else{
            $class_tp_1 = "";
        }
        if (isset($class_tp_2)){
        }else{
            $class_tp_2 = "";
        }
        if (isset($class_tp_3)){
        }else{
            $class_tp_3 = "";
        }
        if (isset($classLevel_1)){
        }else{
            $classLevel_1 = "";
        }
        if (isset($classLevel_2)){
        }else{
            $classLevel_2 = "";
        }
        if (isset($classLevel_3)){
        }else{
            $classLevel_3 = "";
        }
        if (isset($elite)){
        }else{
            $elite = "";
        }
        if (isset($savemon_key)){
        }else{
            $savemon_key = "";
        }
        if (isset($count_new_x)){
        }else{
            $count_new_x = "";
        }
        if (isset($save_count)){
        }else{
            $save_count = "";
        }


?>
	<FORM class="tregenza_one_dg_form" METHOD="post" ACTION="<?php echo $ddpost; ?>">
        <div class="monsterTypeSelection">
<?php
             echo "<p>";
             echo "Monster Selection by Letter: " ;
             echo "</p>";
             echo monsterLetters();
             $buttonHTML = "<INPUT class='button' id='generateMonster' TYPE='submit' VALUE='Generate Monster'/>" ;
             echo getMonsterSelectionHTML($mon_name );
?>
								</div>
               <INPUT class="button" id="generateMonster2" TYPE="submit" VALUE="Generate Monster" tabindex=8 />
        <div class="monsterTemplateSelection">
<?php
	     echo getTemplateSelectionHTML($mon_tem );
	     echo getTemplateSelection2HTML($mon_tem2 );
?>
        </div>
	<div id="monsterClassSelection" class="table">
		<div class="tableRow">
			<h4>Select Classes (optional)</h4>
                        <h6>Paid users can select a second class and a prestige class</h6>
		</div>
		<div class="tableRow">
			<div class="tableCell tableCellWidth30">
			    <h5>Class</h5>
			</div>
			<div class="tableCell tableCellWidth30">
			    <h5>Skill Focus</h5>
			</div>
			<div class="tableCell tableCellWidth30">
			   <h5>Level (max level for paid users is 20)</h5>
			</div>
		</div>


		<div class="tableRow">
			<div class="tableCell tableCellWidth30">
		<?php
                                if (isset($_POST["class_tp_1"])){
                                  $class_tp_1 = $_POST["class_tp_1"];
                                }
                                echo getClassSelectionHTML( "1", $class_tp_1);

		?>
			</div>
                        <div class="tableCell tableCellWidth30" id="focus1">
				<SELECT NAME="classFocus_1" ID="classFocus_1">
				</SELECT>
		        </div>
			<div class="tableCell tableCellWidth30">
		<?php
                             if (isset($_POST["classLevel_1"])){
                                $classLevel_1 =  $_POST["classLevel_1"];
                             }
	    		     echo getClassLevelHTML( "1", $classLevel_1);

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

<?php
//   				  <input type="hidden" value="1" id="theValue" />
//  <p><a href="javascript:;" onclick="addElement();">Add Some Classes</a></p>
// <div id="myDiv"> </div>
if ($paid_user == "Y"){
?>

		<div class="tableRow">
		     <div class="tableCell tableCellWidth30">
		<?php
                        if (isset($_POST["class_tp_2"])){
                            $class_tp_2 = $_POST["class_tp_2"];
                        }
                        echo getClassSelectionHTML( "2", $class_tp_2);

		?>
		     </div>
		      <div class="tableCell tableCellWidth30" id="focus2">
		  	 <SELECT NAME="classFocus_2" ID="classFocus_2">
			 </SELECT>
		      </div>
                      <div class="tableCell tableCellWidth30">
		<?php
		         if (isset($_POST["classLevel_2"])){
                            $classLevel_2 =  $_POST["classLevel_2"];
                         }
                         echo getClassLevelHTML( "2", $classLevel_2 );

		?>
		      </div>
		</div>
                <div>
		      <div class="tableCell tableCellWidth30" id="domain_21">
                      </div>
		      <div class="tableCell tableCellWidth30" id="domain_22">
		      </div>
		      <div class="tableCell tableCellWidth30" id="domain_23">
		      </div>
                </div>
                <div class="tableRow">
		     <div class="tableCell tableCellWidth30">
		        <h5>Prestige</h5>
		     </div>
		</div>
		<div class="tableRow">
		    <div class="tableCell tableCellWidth30">
		<?php
                        if (isset($_POST["class_tp_3"])){
                              $class_tp_3 = $_POST["class_tp_3"];
                        }else{
                              $class_tp_3 = "";
                        }
                        echo getClassSelectionHTML( "3", $class_tp_3);
		?>
		    </div>
		    <div class="tableCell tableCellWidth30" id="focus3">
			<SELECT NAME="classFocus_3" ID="classFocus_3">
			</SELECT>
		    </div>
		    <div class="tableCell tableCellWidth30">
		<?php
                        if (isset($_POST["classLevel_3"])){
		            $classLevel_3 = $_POST["classLevel_3"];
                        }
			echo getClassLevelHTML( "3", $classLevel_3 );
		?>
		   </div>
		</div>
                <div>
		   <div class="tableCell tableCellWidth30" id="domain_31">
		   </div>
		   <div class="tableCell tableCellWidth30" id="domain_32">
		   </div>
		   <div class="tableCell tableCellWidth30" id="domain_33">
		   </div>
                </div>

                <?php
}else{
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
               <INPUT TYPE="hidden" NAME="class_tp_2", VALUE="<?php echo $class_tp_2?>"/>
               <INPUT TYPE="hidden" NAME="classFocus_2", VALUE="<?php echo $classFocus_2?>"/>
               <INPUT TYPE="hidden" NAME="classLevel_2", VALUE="<?php echo $classLevel_2?>"/>
               <INPUT TYPE="hidden" NAME="domain_21", VALUE="<?php echo $domain_21?>"/>
               <INPUT TYPE="hidden" NAME="domain_22", VALUE="<?php echo $domain_22?>"/>
               <INPUT TYPE="hidden" NAME="domain_23", VALUE="<?php echo $domain_23?>"/>
               <INPUT TYPE="hidden" NAME="class_tp_3", VALUE="<?php echo $class_tp_3?>"/>
               <INPUT TYPE="hidden" NAME="classFocus_3", VALUE="<?php echo $classFocus_3?>"/>
               <INPUT TYPE="hidden" NAME="classLevel_3", VALUE="<?php echo $classLevel_3?>"/>
               <INPUT TYPE="hidden" NAME="domain_31", VALUE="<?php echo $domain_31?>"/>
               <INPUT TYPE="hidden" NAME="domain_32", VALUE="<?php echo $domain_32?>"/>
               <INPUT TYPE="hidden" NAME="domain_33", VALUE="<?php echo $domain_33?>"/>
<?php
}
		$elite_sel_y = "";
		$elite_sel_n = "";
		if ($elite == "Y"){
	            $elite_sel_y = "CHECKED";
		}else{
		    $elite_sel_n = "CHECKED";
		}
?>
		<div class="tableRow">
		    <div class="tableCell tableCellWidth30">
		       <h5>Initial Stat values:</h5>
		    </div>
		    <div class="tableCell ">
		      <p>
		           <INPUT class="radio" TYPE = "radio" NAME = "elite" VALUE = "Y" <?php echo $elite_sel_y ?>/>
                                  Elite (15, 14, 13, 12, 10, 8)
                      </p>
                       <p>
		           <INPUT class="radio" TYPE = "radio" NAME = "elite" VALUE = "N" <?php echo $elite_sel_n ?>/>
                                 Nonelite (13, 12, 11, 10, 9, 8)
                      </p>
		    </div>
                </div>
        </div>
	<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?php echo $count_new_x?>"/>
	<INPUT TYPE="hidden" NAME="status", VALUE="NEW"/>
	<INPUT TYPE="hidden" NAME="save_count", VALUE="<?php echo $save_count?>"/>
<?php
//                        echo "user_id" . $user_id;
?>      <div class="tableCell tableCellWidth100">
<?php
             if (isset($_POST["savemon_key"])){
                 $savemon_key =  $_POST["savemon_key"];
             }
	     echo getSaveSelectionHTML($savemon_key);
?>
        </div>
	<div>
	   <INPUT class="button" id="generateMonster" TYPE="submit" VALUE="Generate Monster" tabindex=8 />
	</div>

   </FORM>
</div>

<?php



