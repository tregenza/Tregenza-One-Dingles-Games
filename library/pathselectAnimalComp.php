<?PHP
/*
*
*		Select Monster Form
*
*/
?>


<h1>Pathfinder RPG Animal Companion Generator</h1>

<p class="small">For a quick walk through of how to get the best out of the NPC generator, <a href="http://www.screencast.com/t/iN4nCLVvWnn">watch the screencast</a>.
</p>

<div id="monsterGenerator" >

<?php
	if ($msg != ""){
	  echo "<div class=\"error\">$msg</div>" ;
	}
	$key_1 = "path";
?>
	<FORM METHOD="post" ACTION="<?php echo $baseDomain.$urlPATH; ?>">
        <div>
<?php
             echo "<p>";
               $buttonHTML = "<INPUT class='button' id='generateMonster' TYPE='submit' VALUE='Generate Monster'/>" ;
               echo getAnimalCompanionSelectionHTML($mon_name );
?>
               <INPUT class="button" id="generateMonster2" TYPE="submit" VALUE="Generate Monster" tabindex=8 /
        </div>
	<div id="monsterClassSelection" class="table">
		<div class="tableRow">
			<h4>Select Classes Levels)</h4>
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
			     echo getClassLevelHTML( "1", $_POST["classLevel_1"] );
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
	     echo getSaveSelectionHTML($_POST["savemon_key"] );
?>
        </div>
	<div>
	   <INPUT class="button" id="generateMonster" TYPE="submit" VALUE="Generate Monster" tabindex=8 />
	</div>

   </FORM>
</div>

<?

if ($paid_user != "Y"){
  include 'paypal7.php';
}
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
   if (have_posts()) {
       the_post();
       comments_template();
    }
?>
</div>






