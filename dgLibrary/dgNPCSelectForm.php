<?PHP
/*
*
*		dgNPCSelect				-					Select NPC / Monster form  
*
*/


/*

	doDGDisplay - Display the form 

*/
if ( !function_exists("doDGDisplay")) {

	function doDGDisplay( $dgTools ) {
	
		if ( sizeof(empty($dgTools['NPCsArray']) ==0 )) {
			$dgTools['NPCsArray'][] = initNewNPC($dgTools);
			$dgTools['meta']['currentNPCNo'] = 0;
		}
	
		displayForm($dgTools);
	
	}

}


/*
		Main logic for displaying NPC select form.
*/
if ( !function_exists("displayForm") ) {
	
	function displayForm($dgTools) {
	
			$html = "";				

			$html .= getStatusMessageHTML($dgTools['meta']['msg']);

			$content = getLoadSavesHTML($dgTools); 

			$html .= dgMakeForm($content, $dgTools, PAGE_TYPE_LOAD, PAGE_TYPE_GENERATE, PAGE_STATUS_UNKNOWN, "dgNPCGeneratorLoadSave");

			$content = getNPCSelectHTML($dgTools);

			$html .= dgMakeForm($content, $dgTools, PAGE_TYPE_SELECT, PAGE_TYPE_GENERATE, PAGE_STATUS_UNKNOWN, "dgNPCGenerator");

			echo $html;
	}
	
}


function getNPCSelectHTML($dgTools) {
	
		$html = "";

		$npcNo = 1;

		/* Type */

		$block = "";
		$cssBlockTag = "dgNPCTemplateSelection";
		$blockLabel = "Select NPC Base Race / Species ";

		$rowValue = monsterLetters();	
		$rowLabel = "Monster Selection by Letter";
		$block .= dgMakeRowTopLabel($rowLabel, $rowValue); 

		$rowValue = getMonsterSelectionHTML($dgTools);	
		$rowLabel = "Type";
		$block .= dgMakeRow($rowLabel, $rowValue); 
			
		$rowValue = getDGButtons();	
		$block .= dgMakeRowNoLabel($rowValue); 
	
		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);
	
		/* Template */

		$block = "";
		$cssBlockTag = "dgNPCTemplateSelection";
		$blockLabel = "Select NPC Template";

		$rowValue = getTemplateSelectionHTML($dgTools, 1 );	
		$rowLabel = "Template 1";
		$block .= dgMakeRow($rowLabel, $rowValue); 
		
		$rowValue = getTemplateSelectionHTML($dgTools, 2 );	
		$rowLabel = "Template 2";
		$block .= dgMakeRow($rowLabel, $rowValue); 

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Class Focus Level */
	
		$block = "";
		$cssBlockTag = "dgNPCClassFocusLevelSelection";
		$blockLabel = "Select NPC Class, Focus & Level (Optional)";
/*
		$rowValue .= '<h4>Select Classes (optional)</h4>';
		$block .= dgMakeRowNoLabel($rowLabel, $rowValue); 
*/
		$tableHeader = array();
		$tableRows = array();
		$tableFooter = "";

		$tableHeader[] = 'Class';
		$tableHeader[] = 'Skill Focus';
		if ( dgHasUserPaid() !== PAID_USER) {
			$tableHeader[] .= 'Level <span>(max level for paid users is 20)<span>';
		} else {
			$tableLevel = 'level';
		}

		$tableRow = array();
		$tableRow[] = getClassSelectionHTML( $dgTools, 1);
		$tableRow[] = getFocusSelectHTML($dgTools, 1);
		$tableRow[] = getClassLevelHTML( $dgTools, 1);
			
		$tableRows[] = $tableRow;
		$tableRows[] = array(getDomainsHTML($dgTools, 1));
	
		if (dgHasUserPaid() == PAID_USER ) {
				$tableRow = array();
		
				$tableRow[] = getClassSelectionHTML( $dgTools, 2);
				$tableRow[] = getFocusSelectHTML($dgTools, 2);
				$tableRow[] = getClassLevelHTML( $dgTools, 2);
					
				$tableRows[] = $tableRow;
				$tableRows[] = array(getDomainsHTML($dgTools, 2));
		
				$tableRow = array();
		
				$tableRow[] = getClassSelectionHTML( $dgTools, 3);
				$tableRow[] = getFocusSelectHTML($dgTools, 3);
				$tableRow[] = getClassLevelHTML( $dgTools, 3);
					
				$tableRows[] = $tableRow;
				$tableRows[] = array(getDomainsHTML($dgTools, 3));
		} else {
				$tableFooter = 'Paid users can select a second class and a prestige class';
		}

		$block .= dgMakeRowTable($tableHeader, $tableRows, $tableFooter);		

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel );

		/* Elite */

		$block = "";
		$cssBlockTag = "dgNPCEliteStats";
		$blockLabel = "Initial Stats Value";

		$rowValue = getEliteStatsHTML( $dgTools);
		$rowLabel = "Elite 15, 14, 13, 12, 10, 8";	
		$block .= dgMakeRow($rowLabel, $rowValue );
		$rowValue = getNonEliteStatsHTML( $dgTools);
		$rowLabel = "Standard 13, 12, 11, 10, 9, 8";	
		$block .= dgMakeRow($rowLabel, $rowValue );

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);
	
		/*
	
					STILL  NEEDED ???
	
	
	</div>
		<INPUT TYPE="hidden" NAME="count_new_x", VALUE="<?php echo $count_new_x?>"/>
		<INPUT TYPE="hidden" NAME="status", VALUE="NEW"/>
		<INPUT TYPE="hidden" NAME="save_count", VALUE="<?php echo $save_count?>"/>
		<div class="   Width100">
	<?php
	
	$savemon_key = "";  // <---- FIX
						if (isset($_POST["savemon_key"])){
	      		$savemon_key =  $_POST["savemon_key"];
	      }
		     echo getSaveSelectionHTML($savemon_key);
	
	?>
	
	*/
	
		
		return $html;
	

}






?>