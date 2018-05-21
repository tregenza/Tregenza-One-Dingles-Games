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
	<FORM METHOD="post" ACTION="<?php echo $ddpost; ?>">
        <div>
<?php
             echo "<p>";
             echo "Monster Selection by Letter: " ;
             echo monsterLetters();
             $buttonHTML = "<INPUT class='button' id='generateMonster' TYPE='submit' VALUE='Generate Monster'/>" ;
             echo getMonsterSelectionHTML($mon_name );
?>
               <INPUT class="button" id="generateMonster2" TYPE="submit" VALUE="Generate Monster" tabindex=8 /
<?php
             echo "</p>";
             echo "<p>";
	     echo getTemplateSelectionHTML($mon_tem );
	     echo "</p>";
	     echo "<p>";
	     echo getTemplateSelection2HTML($mon_tem2 );
	     echo "</p>";
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

//if ($paid_user != "Y"){
 // include 'paypal7.php';
//}
?>

<div id="intro" class="lightBorder justify">
    <p class="small">This tool is for DMs who are tired of spending an hour generating a monster or NPC only to see their players kill it in a few brief rounds of combat. Using this monster generator, a DM can create a 20th level Stone Giant fighter in a minute or two or 3rd level Drider cleric in just a few seconds.  Allowing you, the GM, to either experiment to find the right monster to really challenge your party or simply use the time you save creating monsters to write more adventures.</p>
    <p class="small">The monster and NPC generators follows all the rules of Pathfinder Roleplaying game for creating monsters with classes and NPCs. So the monsters / NPC you create with this tool are just as good as the ones you would create by hand. The results can be printed out directly from the web page or use the plain text option to cut & paste the monster into your adventure.</p>
    <p class="small">The tool is easy to use. Simply select the monster and optionally select its classes, levels and its skill focus. The focus controls how the monster's / NPCs skill points are used, ensuring that your monster / NPC has the right skills to terrorise your party.  Special attacks and class abilities are allocated automatically but the monster generator / NPC generator lets the GM select the feats. Monsters / NPCs also start with their default weapons and attacks but these can be changed, as can the monster's ability scores and size.</p>
    <p class="small">Once you are happy with your changes press the RECALCLATE button to see how the changes effect the monster.</p>
    <p class="small">The monster generator and NPC Generator are free to use and supplied "as is". If you have any questions or problems, please write to us: CONTACT (at) DinglesGames (dot) com.</p>
    <p class="small">Pathfinder is a registered trademark of Paizo Publishing, LLC, and the Pathfinder Roleplaying Game and the Pathfinder Roleplaying Game Compatibility Logo are trademarks of Paizo Publishing, LLC, and are used under the Pathfinder Roleplaying Game Compatibility License. See http://paizo.com/pathfinderRPG/compatibility for more information on the compatibility license.</p>
    <p class="small">Open Game License v 1.0a Copyright 2000, Wizards of the Coast, Inc.System Reference Document. Copyright 2000, Wizards of the Coast, Inc.; Authors Jonathan Tweet, Monte Cook, Skip Williams, based on material by E. Gary Gygax and Dave Arneson. Pathfinder RPG Core Rulebook. Copyright 2009, Paizo Publishing, LLC; Author: Jason Bulmahn, based on material by Jonathan Tweet, Monte Cook, and Skip Williams. The Book of Experimental Might. Copyright 2008, Monte J. Cook. All rights reserved. Tome of Horrors. Copyright 2002, Necromancer Games, Inc.; Authors: Scott Greene, with Clark Peterson, Erica Balsley, Kevin Baase, Casey Christofferson, Lance Hawvermale, Travis Hawvermale, Patrick Lawinger, and Bill Webb; Based on original content from TSR.</p>
    <p class="small">Advanced Players Guide. Copyright 2010, Paizo Publishing, LLC; Author: Jason Bulmahn.</p>
</div>
<div class="lightBorder justify">
<?php
//   if (have_posts()) {
//       the_post();
//       comments_template();
//    }
?>
</div>





