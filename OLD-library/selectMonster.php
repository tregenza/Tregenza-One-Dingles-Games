<?PHP
/*
*
*		Select Monster Form
*
*/
?>


	<h1>D&D 3.5 Monster Generator</h1>
	
	<p>Welcome to Dingle's Games monster generator for D&D 3.5.</p>
	<p class="small">For a quick walk through of how to get the best out of the monster generator, <a href="http://www.screencast.com/t/iN4nCLVvWnn">watch the screencast</a>.</p>

	<div id="monsterGenerator" >

<?php
	if ($msg != ""){
	  echo "<div class=\"error\">$msg</div>" ;
	}
?>
		<FORM METHOD="post" ACTION="<?php echo $baseDomain.$urlPATH; ?>">
		<?php
		
			echo getMonsterSelectionHTML( $mon_name );
		
		?>
			
			
		
			<div id="monsterClassSelection" class="table">
				<div class="tableRow">
					<h4>Select Classes (optional)</h3>
				</div>
				<div class="tableRow">
					<div class="tableCell tableCellWidth30">
						<h5>Class</h4>
					</div>
					<div class="tableCell tableCellWidth30">
						<h5>Skill Focus</h4>
					</div>
					<div class="tableCell tableCellWidth30">
						<h5>Level</h4>
					</div>
				</div>
				<div class="tableRow">
					<div class="tableCell tableCellWidth30">
		<?php			
						echo getClassSelectionHTML( "1", $_POST["class_tp_1"]);
		?>	
					</div>
					<div class="tableCell tableCellWidth30" id="focus1">
						<SELECT NAME="classFocus_1" ID="classFocus_1">			
						</SELECT>						
		            </div>
					<div class="tableCell tableCellWidth30">
		<?php
						echo getClassLevelHTML( "1", $_POST["classLevel_1"] );
		?>
					</div>
				</div>
				<div class="tableRow">
					<div class="tableCell tableCellWidth30">
		<?php
						echo getClassSelectionHTML( "2", $_POST["class_tp_2"] );			
		?>		
				    </div>
					<div class="tableCell tableCellWidth30" id="focus2">
						<SELECT NAME="classFocus_2" ID="classFocus_2">
						</SELECT>
					</div>
				    <div class="tableCell tableCellWidth30">
		<?php
						echo getClassLevelHTML( "2", $_POST["classLevel_2"] );
		?>
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
				<div class="tableRow">
					<div class="tableCell tableCellWidth30">
						<h5>Initial Stat values:</h5>
					</div>
					<div class="tableCell ">
						<p>
						<INPUT class="radio" TYPE = "radio" NAME = "elite" VALUE = "Y" <?echo $elite_sel_y ?>/>
						Elite (15, 14, 13, 12, 10, 8)</p>
						</p>
						<p>
						<INPUT class="radio" TYPE = "radio" NAME = "elite" VALUE = "N" <?echo $elite_sel_n ?>/>
						Nonelite (13, 12, 11, 10, 9, 8)</p>
 					</div>
					<div class="tableCell ">
 					</div>
				</div>
			</div>
			<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?echo $count_new_x?>"/>
			<INPUT TYPE="hidden" NAME="mon_hd", VALUE="<?echo $mon_hd?>"/>
			
			<INPUT TYPE="hidden" NAME="status", VALUE="NEW"/>
		
			<div>
				<INPUT class="button" id="generateMonster" TYPE="submit" VALUE="Generate Monster" tabindex=8 />
			</div>
<div>
<BR></BR>
<B>
NB: If you are creating a spell caster, or want to add magic items or templates use the NPC Generator (on Navigation Menu)
</B>
</div>

		</FORM>
	</div>
<?
require($workingPath."/ddgoogle.php");
?>
	<div id="intro" class="lightBorder justify">
		<p class="small">This tool is for DMs who are tired of spending an hour generating a monster only to see their players kill it in a few brief rounds of combat. Using this monster generator, a DM can create a 20th level Stone Giant fighter in a minute or two or 3rd level Drider cleric in just a few seconds.  Allowing you, the GM, to either experiment to find the right monster to really challenge your party or simply use the time you save creating monsters to write more adventures.</p>
		<p class="small">The monster generator follows all the rules of D&D 3.5 for creating monsters with classes. So the monsters you create with this tool are just as good as the ones you would create by hand. The results can be printed out directly from the web page or use the plain text option to cut & paste the monster into your adventure.</p>
		<p class="small">The tool is easy to use. Simply select the monster and optionally select its classes, levels and its skill focus. The focus controls how the monster's skill points are used, ensuring that your monster has the right skills to terrorise your party.  Special attacks and class abilities are allocated automatically but the monster generator lets the GM select the feats. Monsters also start with their default weapons and attacks but these can be changed, as can the monster's ability scores and size.</p>
		<p class="small">Once you are happy with your changes press the RECALCLATE button to see how the changes effect the monster.</p>
		<p class="small">The monster generator is free to use and supplied "as is". If you have any questions or problems, please write to us: CONTACT (at) DinglesGames (dot) com.</p>
	</div>
		
	<div class="lightBorder justify">
		<?php if (have_posts()) {
		
			the_post(); 
		
			comments_template(); 
			
		} ?>
	</div>

		
<?php



