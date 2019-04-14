<?PHP
/*
*
*		dgNPCGenerateForm				-					Main NPC generate NPC form  
*
*/


/*

	doDGDisplay - Display the form 

*/
if ( !function_exists("doDGDisplay")) {

	function doDGDisplay( $dgTools ) {
	
		if ( sizeof(empty($dgTools['NPCsArray']) ==0 )) {
//				die("dgNPCGenerateForm - No NPC defined ");
		}

		displayForm($dgTools, 0);
	
	}

}

/*

	doDGDisplay - Display the form 

*/
function displayForm($dgTools, $npcNo) {

			$html = "";				

			$html  = getStatusMessageHTML($dgTools['meta']['msg']);

echo  "HELLO WORLD GENERATE";
echo  var_export($dgTools,1);


			/* Recalc the NPC */			
			$npc = $dgTools['NPCsArray'][$npcNo];
			$dgTools['NPCsArray'][$npcNo] = recalculate($npc);

			/* Display the form */
			$html = "";				

			$html .= getStatusMessageHTML($dgTools['meta']['msg']);
			
			$content = getNPCGenerateHTML($dgTools, $npcNo);

			$html .= dgMakeForm($content, $dgTools, PAGE_TYPE_GENERATE, PAGE_TYPE_GENERATE, PAGE_STATUS_UNKNOWN, "dgNPCGenerator");

			echo $html;

}


/* 
				Recalculate everything based on user input.

				Note: The function accepts and returns an single NPC array, and
				not the entire dgTools array. 
	
*/	
function recalculate($dgNPC) {
		return $dgNPC;
}

/*
			Gets all the HTML needed for the generate NPC form
*/	
function getNPCGenerateHTML($dgTools) {

		$npcNo = getCurrentNPCNo($dgTools);

		$html = "";

		/* Header & Basics*/

		$block = "";	
		$cssBlockTag = "dgNPCStatsHeader";
		$blockLabel = "";		

		$rowLabel = "Name";
		$cssTag = "dgNPCSaveName";
		$value = getNPCSaveNameHTML($dgTools);
		if ( !empty( $value ) ) { 
				$block .= dgMakeRow($rowLabel, $value, $cssTag);
		}

		$rowLabel = NULL;
		$cssTag = "dgNPCRaceCR";
		$subRows = array();
		$race = getNPCRaceHTML($dgTools);
		$subRows[] = dgMakeSubRow($race);
		$templates = getNPCTemplatesHTML($dgTools);
		$subRows[] = dgMakeSubRow($templates);
		$npcCR = getNPCCRHTML($dgTools);
/*		$subRows[] = dgMakeSubRow("", $npcCR); */
		$block .= dgMakeRowOfSubRows($subRows, $rowLabel, $cssTag);		
		
		$rowLabel = NULL;
		$cssTag = "dgNPCClassLevel";		
		$value = getNPCClassLevelsHTML($dgTools, 1);
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$rowLabel = "Type";
		$cssTag = "dgNPCType";		
		$value = getNPCTypeHTML($dgTools);
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Size";
		$cssTag = "dgNPCType";		
		$value = getNPCSizeHTML($dgTools);
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "CR";
		$cssTag = "dgNPCCR";
		$value = getNPCCRHTML($dgTools);
		$block .= dgMakeRow($rowLabel, $value, $cssTag, $blockLabel);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Hit Dice */

		$block = "";
		$cssBlockTag =  "dgNPCHitDice";
		$blockLabel = "Racial Hit Dice";

		$cssTag = "dgNPCType";
		$value = getNPCHitDiceHTML($dgTools);
		$block .= dgMakeRowNoLabel($value, $cssTag);
		
		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Hit Points */
	
		$block = "";
		$cssBlockTag =  "dgNPCHitPoints";
		$blockLabel = "Hit Points";

		$cssTag = "dgNPCHitPoints";
		$value = getNPCHitPointsHTML($dgTools);
		$block .= dgMakeRowNoLabel($value, $cssTag);
		
		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Base Attack / CMB / CMD */
	
		$block = "";
		$cssBlockTag = "dgNPCBaseAttackEtc";
		$blockLabel = "Original Monster Base Attack";

		$cssTag = "dgNPCOriginalBaseAttack";
		$value = getNPCOriginalBaseAttackHTML($dgTools);
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$rowLabel = "Calculated Base Attack";
		$cssTag = "dgNPCCalculatdBaseAttack";
		$value = getNPCCalculatedBaseAttackHTML($dgTools);
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Calculated CMB";
		$cssTag = "dgNPCCMB";
		$value = getNPCCMBHTML($dgTools);
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Calculated CMD";
		$cssTag = "dgNPCCMD";
		$value = getNPCCMDHTML($dgTools);
		$block .= dgMakeRow($rowLabel, $value, $cssTag);
		
		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);


		/* Attacks */
		if (!empty($dgTools['NPCsArray'][$npcNo]['attacks']) ) {
		
				foreach ($dgTools['NPCsArray'][$npcNo]['attacks'] as $attackKey => $attack) {
		
						if (strtolower($attack['weapon']) !== "none") {
		
								$block = "";
								$cssBlockTag = "dgNPCAttacks";
								$blockLabel = "Attack";
				
								$rowLabel = NULL;
								$cssTag =  "dgNPCAttacksWeapon";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'weapon');
								$block .= dgMakeRowNoLabel($value, $cssTag);
						
								$rowLabel = "Type";
								$cssTag =  "dgNPCAttacksType";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'type');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
				
								$rowLabel = "Attack";
								$cssTag =  "dgNPCAttacksAttack";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'attack');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
						
								$rowLabel = "Full Attack";
								$cssTag =  "dgNPCAttacksFullAttack";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'full');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
						
								$rowLabel = "Damage";
								$cssTag =  "dgNPCAttacksDamage";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'damage');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
						
								$rowLabel = "Magic To Hit Modifier";
								$cssTag =  "dgNPCAttacksMagicToHitMod";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'magic_to_hit_mod');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
						
								$rowLabel = "Magic To Hit Damage";
								$cssTag =  "dgNPCAttacksMagicToDamageMod";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'magic_to_damage_mod');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
				
								$rowLabel = "Critical";
								$cssTag =  "dgNPCAttacksCritical";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'crit');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
				
								$rowLabel = "Critical Chance";
								$cssTag =  "dgNPCAttacksCriticalChance";
								$value = getNPCAttacksHTML($dgTools, $attackKey, 'crit_ch');
								$block .= dgMakeRow($rowLabel, $value, $cssTag);
						
								$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);
				
						}
				}
		}

		/* AC */
	
		$block = "";
		$cssBlockTag = "dgNPCAC";
		$blockLabel = "AC";

		$rowLabel = NULL;
		$cssTag =  "dgNPCMonAC";
		$value = getNPCACHTML($dgTools,"mon_ac");
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$rowLabel = "Total AC";
		$cssTag =  "dgNPCACTotal";
		$value = getNPCACHTML($dgTools, "total");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Deflection";
		$cssTag =  "dgNPCACDeflection";
		$value = getNPCACHTML($dgTools, "deflection");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Natural";
		$cssTag =  "dgNPCACNatural";
		$value = getNPCACHTML($dgTools, "natural");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Touch";
		$cssTag =  "dgNPCACTouch";
		$value = getNPCACHTML($dgTools, "touch");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Flat Footed";
		$cssTag =  "dgNPCACFlatFooted";
		$value = getNPCACHTML($dgTools, "flat");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Armour";
		$cssTag =  "dgNPCArmour";
		$value = getNPCACHTML($dgTools, "armour");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Armour Magic Modifier";
		$cssTag =  "dgNPCArmour";
		$value = getNPCACHTML($dgTools, "armour_magic_mod");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Shield";
		$cssTag =  "dgNPCShield";
		$value = getNPCACHTML($dgTools, "shield");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Shield Maigc Modifier";
		$cssTag =  "dgNPCShield";
		$value = getNPCACHTML($dgTools, "shield_magic_mod");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);


		/* Inititive */
	
		$block = "";
		$cssBlockTag = "dgNPCInit";
		$blockLabel = "Initative";

		$rowLabel = NULL;
		$cssTag =  "dgNPCInit";
		$value = getNPCInitHTML($dgTools);
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Speed */
	
		$block = "";
		$cssBlockTag = "dgNPCSpeed";
		$blockLabel = "Speed";

		$rowLabel = NULL;
		$cssTag =  "dgNPCSpeedBase";
		$value = getNPCSpeedHTML($dgTools,"base");
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$rowLabel = "Fly";
		$cssTag =  "dgNPCSpeedFly";
		$value = getNPCSpeedHTML($dgTools, "fly");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Swim";
		$cssTag =  "dgNPCSpeedSwim";
		$value = getNPCSpeedHTML($dgTools, "Swim");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Climb";
		$cssTag =  "dgNPCSpeedClimb";
		$value = getNPCSpeedHTML($dgTools, "Climb");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$rowLabel = "Burrow";
		$cssTag =  "dgNPCSpeedburrow";
		$value = getNPCSpeedHTML($dgTools, "Burrow");
		$block .= dgMakeRow($rowLabel, $value, $cssTag);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Fortitude */
	
		$block = "";
		$cssBlockTag = "dgNPCFort";
		$blockLabel = "Fortitude";

		$rowLabel = NULL;
		$cssTag =  "dgNPCFort";
		$value = getNPCSaveHTML($dgTools, 'fort_sv');
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Reflex */
	
		$block = "";
		$cssBlockTag = "dgNPCReflex";
		$blockLabel = "Reflex";

		$rowLabel = NULL;
		$cssTag =  "dgNPCReflex";
		$value = getNPCSaveHTML($dgTools, 'reflex_sv');
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Will */
	
		$block = "";
		$cssBlockTag = "dgNPCWill";
		$blockLabel = "Will";

		$rowLabel = NULL;
		$cssTag =  "dgNPCWill";
		$value = getNPCSaveHTML($dgTools, 'will_sv');
		$block .= dgMakeRowNoLabel($value, $cssTag);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Special Attacks */
	
		$block = "";
		$cssBlockTag = "dgNPCSpecialAttacks";
		$blockLabel = "Special Attacks";
		$block .= getNPCSpecialAttacksHTML($dgTools);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);


		/* Race Special Abilities */
	
		$block = "";
		$cssBlockTag = "dgNPCSpecialAbilities";
		$blockLabel = "Race Special Abilities";
		$block .= getNPCRaceSpecialAbilitiesHTML($dgTools);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);


		/* Attributes */
	
		$block = "";
		$cssBlockTag = "dgNPCAttributes";
		$blockLabel = "Attributes";

		$tableHeader = array();
		$tableRows = array();
		$tableFooter = "";

		$tableHeader[] = 'Ability';
		$tableHeader[] = 'Original';
		$tableHeader[] = 'Magic';
		$tableHeader[] = 'Total';
		$tableHeader[] = 'Bonus';
		
		$cssTag = "dgNPCStatStr";
		$tableRow = getNPCStatRowHTML( $dgTools, "str");
		$tableRows[] = $tableRow;

		$cssTag = "dgNPCStatDex";
		$tableRow = getNPCStatRowHTML( $dgTools, "dex");
		$tableRows[] = $tableRow;

		$cssTag = "dgNPCStatCon";
		$tableRow = getNPCStatRowHTML( $dgTools, "con");
		$tableRows[] = $tableRow;

		$cssTag = "dgNPCStatInt";
		$tableRow = getNPCStatRowHTML( $dgTools, "int");
		$tableRows[] = $tableRow;

		$cssTag = "dgNPCStatWis";
		$tableRow = getNPCStatRowHTML( $dgTools, "wis");
		$tableRows[] = $tableRow;

		$cssTag = "dgNPCStatChr";
		$tableRow = getNPCStatRowHTML( $dgTools, "chr");
		$tableRows[] = $tableRow;

		$block .= dgMakeRowTable($tableHeader, $tableRows, $tableFooter);		

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel );


		/* Feats */
	
		$block = "";
		$cssBlockTag = "dgNPCFeats";
		$blockLabel = "Feats";

		$block .= getNPCFeatsHTML($dgTools);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Skills */
	
		$block = "";
		$cssBlockTag = "dgNPCSkills";
		$blockLabel = "Skills";

		$cssTag = "dgMonsterSkillPoints";
		$label = "Skill Points - ".$dgTools['NPCsArray'][$npcNo]['mon_name'];		
		$value = $dgTools['NPCsArray'][$npcNo]['montype_skillp'];		
		$block .= dgMakeRow($label, $value, $cssTag);

		$cssTag = "dgNPCSkillPointToSpend";
		$label = "Skill Points to Spend";
//		$value = $dgTools['NPCsArray']['skillpoints_spare'];		// <--- ??? Guess
		$value = "999";		// <--- ??? HACK - TEMP - REMOVE
		$block .= dgMakeRow($label, $value, $cssTag);

		$tableHeader = array();
		$tableRows = array();
		$tableFooter = "";

		$tableHeader[] = '';
		$tableHeader[] = 'Total';
		$tableHeader[] = 'Ranks';
		$tableHeader[] = 'Stat Bonus';
		$tableHeader[] = 'Misc Bonus';

		if ( !empty($dgTools['NPCsArray'][$npcNo]['skills']) ) {
				$skills = $dgTools['NPCsArray'][$npcNo]['skills']	;	

				foreach ($skills as $skillRef => $skillArray) {
						$cssTag = "dgNPCSkillRow";
						$tableRow = getNPCSkillRowHTML( $skillArray);
						$tableRows[] = $tableRow;
				}
		}

		$block .= dgMakeRowTable($tableHeader, $tableRows, $tableFooter);		

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel );


		/* Pre-Buff */
	
		$block = "";
		$cssBlockTag = "dgNPCBuffss";
		$blockLabel = "Pre-Buffed Spells / Powers";

		$tableHeader = array();
		$tableRows = array();
		$tableFooter = "";

		$tableHeader[] = 'Caster Level';
		$tableHeader[] = 'Spell / Power';

		if (!empty($dgTools['NPCsArray'][$npcNo]['buffs'])) {
				$buffs = $dgTools['NPCsArray'][$npcNo]['buffs']	;	
		
				foreach ($buffs as $buffRef => $buffArray) {
						$cssTag = "dgNPCBuffRow";
						$tableRow = getNPCBuffRowHTML( $buffArray);
						$tableRows[] = $tableRow;
				}
		}		

		$block .= dgMakeRowTable($tableHeader, $tableRows, $tableFooter);		

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel );

		/* Spells */
	
		$block = "";
		$cssBlockTag = "dgNPCSpells";
		$blockLabel = "Spells";

		$perLevel = getNPCSpellsPerLevelHTML($dgTools, $npcNo);	

		if (!empty($perLevel)) {
				$block .= $perLevel;
		}	

		$spellLists = getNPCSelectedSpellsHTML($dgTools, $npcNo);	
		
		if (!empty($spellLists)) {
				$block .= $spellLists;
		}	

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel );


		/* Class Special Abilities */
	
		$block = "";
		$cssBlockTag = "dgNPCClassSpecial";
		$blockLabel = "Class Special Abilities";
		$block .= getNPCClassSpecialAbilitiesHTML($dgTools);

		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);




		/* Magic Items */
		$fixedSlots = array("Head", "Eyes", "Neck", "Vest", "Belt", "Cloak", "Braces", "Gloves", "Ring-1", "Ring-2", "Boots");		
		$multiSlots = array("Potion", "Scroll", "Wand", "Misc");	

		$block = "";
		$cssBlockTag = "dgNPCMagicItems";
		$blockLabel = "Magic Items";

		if ( !empty($dgTools['NPCsArray'][$npcNo]['items'])) {
				$items = $dgTools['NPCsArray'][$npcNo]['items'];
		} else {
				$items = "";	
		}

		/* Weapons */
		$cssTag = "dgNPCMagicItemWepPrime";
		$label = "Weapon - Primary";
		$subRows = getNPCItemHTML($dgTools, $npcNo, "weapon", "primary", 1);
		$block .= dgMakeRowOfSubRows($subRows, $label, $cssTag);

		$cssTag = "dgNPCMagicItemWepSecondary";
		$label = "Weapon - Secondary";
		$subRows = getNPCItemHTML($dgTools, $npcNo, "weapon", "secondary", 1);
		$block .= dgMakeRowOfSubRows($subRows, $label, $cssTag);

		$cssTag = "dgNPCMagicItemWepRanged";
		$label = "Weapon - Ranged";
		$subRows = getNPCItemHTML($dgTools, $npcNo, "weapon", "ranged", 1);
		$block .= dgMakeRowOfSubRows($subRows, $label, $cssTag);
		
		/* Armour */
		$cssTag = "dgNPCMagicItemArmour";
		$label = "Armour";
		$subRows = getNPCItemHTML($dgTools, $npcNo, "armour", null, 1);
		$block .= dgMakeRowOfSubRows($subRows, $label, $cssTag);

		/* Shield */
		$cssTag = "dgNPCMagicItemShield";
		$label = "Shield";
		$subRows = getNPCItemHTML($dgTools, $npcNo, "sheild", null, 1);
		$block .= dgMakeRowOfSubRows($subRows, $label, $cssTag);

		/* Fixed Slots */
		$cssTag = "dgNPCMagicItemSlot";
		foreach ($fixedSlots as $slot) {
				$label = $slot;
				$subRows = getNPCItemHTML($dgTools, $npcNo, $slot, null, 1);
				$block .= dgMakeRowOfSubRows($subRows, $label, $cssTag."_".$slot);		
		}

		/* Multi Slots */
		$cssTag = "dgNPCMagicItemSlot";
		foreach ($multiSlots as $slot) {
				$label = $slot;
				$subRows = getNPCItemHTML($dgTools, $npcNo, $slot, null, 0);
				$block .= dgMakeRowOfSubRows($subRows, $label, $cssTag."_".$slot);		
		}


		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

		/* Notes */
	
		$block = "";
		$cssBlockTag = "dgNPCNotes";
		$blockLabel = "Notes";
		
		$cssTag = "dgNPCNotesField";
		$value = "";
		if ( !empty($dgTools['NPCsArray'][$npcNo]['notes'] )) {
				$value = 	$dgTools['NPCsArray'][$npcNo]['notes'];
		}	
		$block .= dgMakeRowNoLabel($value, $cssTag);
		
		$html .= dgMakeBlock($block, $cssBlockTag, $blockLabel);


		return $html;
	

}