<?php
/*

dgNPCHTMLFunctions - HTML functions for NPC creation used by two
or more stages of the Select -> Generate -> Result process  

*/

/* Returns the HTML for class level selection */
	function getClassLevelHTML( $dgTools, $classNumber, $displayOnly = 0) {
		$max = calcMaxLevel($dgTools, $classNumber);	
		$npcNo = getCurrentNPCNo($dgTools);
		$class = $dgTools['NPCsArray'][$npcNo]['classes'][$classNumber];

		$html = "";
		if ( $displayOnly ) {
				$html .= $class['classlevel'];  
		} else	{
				$html .= '<SELECT class="" ';
				$html .= getNameID(array("NPCsArray",getCurrentNPCNo($dgTools),"classes",$classNumber,"classlevel"), "classlevel_".$classNumber);
				$html .= '>';
			                                                                                                         
				$html .= '<OPTION VALUE=""></OPTION>';
				$count = 1;
			 while ($count < $max){
					if ($count == $class['classlevel'] ){
						$sel = " SELECTED";
					} else {
						$sel = "";
					}
					$html .= '<OPTION VALUE="'.$count.'" '.$sel.' >'.$count.'</OPTION>';
					$count = $count +1;
				}
				$html .= '</SELECT>';
		}		
		return $html;
	
	}


/* Max allowable level for class */
function calcMaxLevel($dgTools, $classNumber) {
	
		$max = 6; /* Default for non-paying user */
		if ( dgHasUserPaid() == PAID_USER ) {
					switch ($dgTools['meta']['key_1']) {
						case DD35:
							$max = 31;
							break;
						case PATHFINDER:
							$max = 21;
							break;
					}
		}
		if ( $max > 6 && $classNumber == 3 ) {
					/* Prestige */
					$max = 11; 
	
					/* Special */
					$npcNo = getCurrentNPCNo($dgTools);		
					$class = $dgTools['NPCsArray'][$npcNo]['classes'][$classNumber]['class_tp'];
					if ( $class == "Archmage" ){
	       $max = 6;
	    }
		}
	
		return $max;
}


function getNPCSaveNameHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = "";	


		if ( !empty( $dgTools['NPCsArray'][$npcNo]['savemon_name'] )) {
				$result .= $dgTools['NPCsArray'][$npcNo]['savemon_name'];
		}

		$camp = "";
		$sub = "";

		if ( !empty($dgTools['NPCsArray'][$npcNo]['savemon_camp']) ) {
				$camp = $dgTools['NPCsArray'][$npcNo]['savemon_camp'];
		}
		if ( !empty($dgTools['NPCsArray'][$npcNo]['savemon_sub']) ) {
				$sub = $dgTools['NPCsArray'][$npcNo]['savemon_sub'];
		}

		if ( $camp || $sub ) {
				$result .= $camp ." / ".$sub;
		}
				
		return $result;
}

function getNPCRaceHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = $dgTools['NPCsArray'][$npcNo]['mon_name'];

		return $result;
}

function getNPCTemplatesHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = "";	

		$templates = "";

		if ( !empty($dgTools['NPCsArray'][$npcNo]['mon_templates'][1]) ) {
			$templates .= $dgTools['NPCsArray'][$npcNo]['mon_templates'][1];
		}

		if ( !empty($dgTools['NPCsArray'][$npcNo]['mon_templates'][2]) ) {
			if (!empty($templates) ) {
					$templates .= " / ";
			} 
			$templates .= $dgTools['NPCsArray'][$npcNo]['mon_templates'][2];
		}

		$result .= $templates;

		return $result;
}


function getNPCClassLevelsHTML($dgTools, $displayOnly = 0) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = "";

		if ( !empty( $dgTools['NPCsArray'][$npcNo]['classes'] ) ) { 
			$count = 0;
			foreach ($dgTools['NPCsArray'][$npcNo]['classes'] as $class ) {
					$count++;	
					if (!empty($class['class_tp']) && !$class['class_tp'] == '') {
			
							$classType = $class['class_tp'];
							$level = getClassLevelHTML($dgTools, $count, $displayOnly);
							$focus = " [ ".$class['classfocus']. " ] ";
							$domains = getNPCDomains($class);

							$result .= $classType. $focus.$level." ".$domains;
				}
			}
	}

	return $result;

}




function getNPCDomains($class) {
		$domains = "";
		if (!empty($class['class_tp']) && !$class['class_tp'] == '') {

				switch ($class['class_tp']) {
					case "Cleric":
							$domains .= "Domains ".$class['domain'][1]." & ".$class['domain'][2];
							break;
					case "Wizard":
							$domains .= "School ".$class['domain'][1]." Prohibited ".$class['domain'][2].", ".$class['domain'][3];
							break;
					case "Sorcerer":
							$domains .= "Bloodline ".$class['domain'][1];
							break;
					case "Witch":
							$domains .= $class['domain'][1];
							break;
					case "Cavalier":
							$domains .= "Bloodline ".$class['domain'][1];
							break;
					case "Inquisitor":
							$domains .= "Bloodline ".$class['domain'][1];
							break;
					case "Ranger":
							$domains .= "Archetype ".$class['domain'][1];
							break;
					case "Gunslinger":
							$domains .= "Archetype ".$class['domain'][1];
							break;
					case "Bloodrager":
							$domains .= $class['domain'][1];
							break;
					case "Summoner":
							$domains .= "Archetype ".$class['domain'][1];
							break;
		
			}
		}
		return $domains;
}

function getNPCTypeHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);
		$type = "";
		
		if ( !empty($dgTools['NPCsArray'][$npcNo]['mon_type'])) {
			$type .= $dgTools['NPCsArray'][$npcNo]['mon_type'];
		}

		if ( !empty($dgTools['NPCsArray'][$npcNo]['temp_type'])) {
			$type .= $dgTools['NPCsArray'][$npcNo]['tem_type'];
		}

		return $type;
}

function getNPCSizeHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = $dgTools['NPCsArray'][$npcNo]['mon_size'];
		return $result;
}


function getNPCCRHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);

		$result = "";
		if (!empty($dgTools['NPCsArray'][$npcNo]['cr'])){ 
				$result = $dgTools['NPCsArray'][$npcNo]['cr'];
		}
		return $result;
}

/*
$cr_total = $cr + $cr_path;
*/
function getClassLevelHTML2( $classNumber, $currentlySelected ) {
    global $wp_user, $paid_user, $class3_tp;
    global $key_1;
//    echo "Selected  $currentlySelected ";
    if ($key_1 == ""){
        $key_1 = "dd35";
    }
    if ($key_1 == "path"){
       $max = 21;
    }else{
       $max = 31;
    }
    if ($classNumber == 3){
       $max = 11;
    }
    if ($paid_user != "Y"){
       $max = 6;
    }
    if (($class3_tp == "Archmage" or $class3_tp == "Hierophant") and $classNumber == 3){
       $max = 6;
    }
    $html = '<SELECT class="width4em" NAME="class'.$classNumber. '_level" id="classlevel_'. $classNumber. '">';
    $count = 1;
    While ($count < $max){
		if ($count == $currentlySelected ){
			$sel = " SELECTED";
		} else {
			$sel = "";
		}
		$html .= '<OPTION VALUE="'.$count.'" '.$sel.' >'.$count.'</OPTION>';
		$count = $count +1;
	}
	$html .= '</SELECT>';

	return $html;

}

function getNPCHitDiceHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = $dgTools['NPCsArray'][$npcNo]['mon_hd'];
		return $result;
}

function getNPCHitPointsHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = $dgTools['NPCsArray'][$npcNo]['mon_hp'];
		return $result;
}

function getNPCOriginalBaseAttackHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);

		$result = "";
		if (!empty($dgTools['NPCsArray'][$npcNo]['mon_base_att'])){ 
				$result = $dgTools['NPCsArray'][$npcNo]['mon_base_att'];
				$result = addPlus($result);
		}
		return $result;
}

function getNPCCalculatedBaseAttackHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);

		$result = "";
		if (!empty($dgTools['NPCsArray'][$npcNo]['base_attack'])){ 
				$result = $dgTools['NPCsArray'][$npcNo]['base_attack'];
				$result = addPlus($result);
		}

		return $result;
}

function getNPCCMBHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);

		$result = "";
		if (!empty($dgTools['NPCsArray'][$npcNo]['base_cmb'])){ 
				$result = $dgTools['NPCsArray'][$npcNo]['base_cmb'];
				$result = addPlus($result);
		}
		return $result;
}

function getNPCCMDHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);

		$result = "";
		if (!empty($dgTools['NPCsArray'][$npcNo]['base_cmd'])){ 
				$result = $dgTools['NPCsArray'][$npcNo]['base_cmd'];
				$result = addPlus($result);
		}
		return $result;
}


function getNPCAttacksHTML($dgTools, $attackKey, $fieldType) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = "";

		if ( !empty($dgTools['NPCsArray'][$npcNo]['attacks']) &&
							is_array($dgTools['NPCsArray'][$npcNo]['attacks']) && 
							!empty($dgTools['NPCsArray'][$npcNo]['attacks'][$attackKey]) &&
							is_array($dgTools['NPCsArray'][$npcNo]['attacks'][$attackKey]) ){

				if ( !empty($dgTools['NPCsArray'][$npcNo]['attacks'][$attackKey][$fieldType]) ) {
						$result = $dgTools['NPCsArray'][$npcNo]['attacks'][$attackKey][$fieldType];
				}

		}	

		/* Tweak output based on the type of field */

		if ( $fieldType == "attack" ) {
				if (empty($result)) {
						$result = "0";
				}

				$result = addPlus($result);
		}

		if ( $fieldType == "crit" && !empty($result) ) {
				$result = "x".$result;
		}

		if ( $fieldType == "crit_ch" && empty($result) ) {
				$resut = "20";
		}

		return $result;
}


/*
function getNPCAttacksNameHTML($attack) {
		$result = "";
		if (!empty($attack['weapon']) ) {
				$result = $attack['weapon'];
		}
		return $result;
}

function getNPCAttacksAttackHTML($attack) {
		$result = "";
		if (!empty($attack['attack']) ) {
				$result = $attack['attack'];
		}
		return $result;
}

function getNPCAttacksFullAttackHTML($attack) {
		$result = "";
		if (!empty($attack['full_attack']) ) {
				$result = $attack['full_attack'];
		}
		return $result;
}

function getNPCAttacksDamageHTML($attack) {
		$result = "";
		if (!empty($attack['damage']) ) {
				$result = $attack['damage'];
		}
		return $result;
}

function getNPCAttacksMagicToHitModHTML($attack) {
		$result = "";
		if (!empty($attack['magic_to_hit_mod']) ) {
				$result = $attack['magic_to_hit_mod'];
		}
		return $result;
}

function getNPCAttacksMagicToDamageModHTML($attack) {
		$result = "";
		if (!empty($attack['magic_to_damage_mod']) ) {
				$result = $attack['magic_to_damage_mod'];
		}
		return $result;
}

function getNPCAttacksRangeHTML($attack) {
		$result = "";
		if (!empty($attack['range']) ) {
				$result = $attack['range'];
		}
		return $result;
}
*/

function getNPCACHTML($dgTools, $acType) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = "";

		if ( !empty($dgTools['NPCsArray'][$npcNo]['ac']) &&
							is_array($dgTools['NPCsArray'][$npcNo]['ac']) ){
				if ( !empty($dgTools['NPCsArray'][$npcNo]['ac'][$acType]) ) {
						$result = $dgTools['NPCsArray'][$npcNo]['ac'][$acType];
				}
		}	

		return $result;
}


function getNPCInitHTML($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);

		$result = "";
		if (!empty($dgTools['NPCsArray'][$npcNo]['init'])){ 
				$result = $dgTools['NPCsArray'][$npcNo]['init'];		
				$result = addPlus($result);
		}
		return $result;
}


function getNPCSpeedHTML($dgTools, $speedType) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = "";

		if ( !empty($dgTools['NPCsArray'][$npcNo]['mon_speed']) &&
							is_array($dgTools['NPCsArray'][$npcNo]['mon_speed']) ){
				if ( !empty($dgTools['NPCsArray'][$npcNo]['mon_speed'][$speedType]) &&
							$dgTools['NPCsArray'][$npcNo]['mon_speed'][$speedType] !== '0') {
						$result = $dgTools['NPCsArray'][$npcNo]['mon_speed'][$speedType];
				}
		}	
		return $result;
}


function getNPCSaveHTML($dgTools, $saveType) {
		$npcNo = getCurrentNPCNo($dgTools);
		$result = "";

		if ( !empty($dgTools['NPCsArray'][$npcNo]['saves']) &&
							is_array($dgTools['NPCsArray'][$npcNo]['saves']) ){
				if ( !empty($dgTools['NPCsArray'][$npcNo]['saves'][$saveType]) &&
							$dgTools['NPCsArray'][$npcNo]['saves'][$saveType] !== '0') {
						$result = $dgTools['NPCsArray'][$npcNo]['saves'][$saveType];
				}
		}	

		$result = addPlus($result);

		return $result;
}


function addPlus($value) {

		$value = trim($value);

		if ( is_numeric($value) && $value > 0 ) {
				$value = "+".$value;
		} 
		
		return $value;
}


function getNPCSpecialAttacksHTML($dgTools) {
		$result = "";

		$npcNo = $dgTools['meta']['currentNPCNo'];
		$attacks = $dgTools['NPCsArray'][$npcNo]['specials']['specialAttacks'];
		
		$result = getNPCSpecialsHTML($attacks);	
		return $result;
}

function getNPCRaceSpecialAbilitiesHTML($dgTools) {
		$result = "";

		$npcNo = $dgTools['meta']['currentNPCNo'];
		$abilities = $dgTools['NPCsArray'][$npcNo]['specials']['specialAbilities'];
		
		$result = getNPCSpecialsHTML($abilities);	
		return $result;
}

function getNPCClassSpecialAbilitiesHTML($dgTools) {
		$result = "";

		$npcNo = $dgTools['meta']['currentNPCNo'];
		$abilities = $dgTools['NPCsArray'][$npcNo]['specials']['class'];
		
		$result = getNPCSpecialsHTML($abilities);	
		return $result;
}


function getNPCSpecialsHTML($specials) {
		$result = "";

		if (!empty($specials) ) {
				foreach ($specials as $specialKey => $specialArray) {
						$block = "";
						$cssBlockTag = "dgSpecialBlock";
						$blockLabel = $specialKey;

						if (!empty($specialArray['monspec_value'])) {
								$cssTag = "dgSpecialValue";
								$block .= dgMakeRowNoLabel($specialArray['monspec_value'], $cssTag);
						}														

						if (!empty($specialArray['specatta_abil'])) {
								$cssTag = "dgSpecialAttaAbil";
								$block .= dgMakeRowNoLabel($specialArray['specatta_abil'], $cssTag);
						}								

						if (!empty($specialArray['specatta_save'])) {
								$cssTag = "dgSpecialAttaSave";
								$block .= dgMakeRowNoLabel($specialArray['specatta_save'], $cssTag);
						}								
	
						if (!empty($specialArray['specatta_type'])) {
								$cssTag = "dgSpecialAttaType";
								$block .= dgMakeRowNoLabel($specialArray['specatta_type'], $cssTag);
						}								

						if (!empty($specialArray['spec_desc'])) {
								$cssTag = "dgSpecialClassDesc";
								$block .= dgMakeRowNoLabel($specialArray['spec_desc'], $cssTag);
						}								

						$result .= dgMakeBlock($block, $cssBlockTag, $blockLabel);
				}

		} 

		return $result;
}

function getNPCStatRowHTML($dgTools, $stat) {
		$result = "";
		$npcNo = $dgTools['meta']['currentNPCNo'];
		$tableRow = array();

		$tableRow[] = getNPCStatNameHTML( $dgTools, $stat);
		$tableRow[] = getNPCStatOriginalHTML( $dgTools, $stat);
		$tableRow[] = getNPCStatMagicHTML( $dgTools, $stat);
		$tableRow[] = getNPCStatTotalHTML( $dgTools, $stat);
		$tableRow[] = getNPCStatBonusHTML( $dgTools, $stat);

//		$result = dgMakeRow($tableRow, "dgNPCStat".strtoupper($stat));

		$result = $tableRow;
		return $result;

}

function getNPCStatNameHTML($dgTools, $stat) {
		$result = "";
				
		$result = ucFirst($stat);

		return $result;
}


function getNPCStatHTML($dgTools, $stat) {
		$result = "";

		$npcNo = $dgTools['meta']['currentNPCNo'];

		if (!empty($dgTools['NPCsArray'][$npcNo]['stats'])){
				$statArray = $dgTools['NPCsArray'][$npcNo]['stats']	;
				if (!empty($statArray[$stat])) {
						$result = $statArray[$stat];				
				}		
		}

		return $result;
}


function getNPCStatOriginalHTML($dgTools, $stat) {
		$result = getNPCStatHTML($dgTools,$stat);
		return $result;
}


function getNPCStatMagicHTML($dgTools, $stat) {
		$result = getNPCStatHTML($dgTools,$stat."_m");
		return $result;
}


function getNPCStatTotalHTML($dgTools, $stat) {
		$result = getNPCStatHTML($dgTools,$stat."_total");
		return $result;
}


function getNPCStatBonusHTML($dgTools, $stat) {
		$result = getNPCStatHTML($dgTools,$stat."_bonus");
		return $result;
}


function getNPCFeatsHTML($dgTools) {
		$result = "";

		$npcNo = getCurrentNPCNo($dgTools);

		if ( !empty($dgTools['NPCsArray'][$npcNo]['feats']) &&
						!empty($dgTools['NPCsArray'][$npcNo]['feats']['active']) ) {
				$feats = $dgTools['NPCsArray'][$npcNo]['feats']['active'];
		}

		if (!empty($feats) ) {
				foreach ($feats as $featNo => $featArray) {
						$block = "";
						$cssBlockTag = "dgNPCFeatBlock";
						$blockLabel = "";

						if (!empty($featArray['feat_name'])) {
								$blockLabel = $featArray['feat_name'];
						}														

						if (!empty($featArray['feat_desc'])) {
								$cssTag = "dgFeatDesc";
								$block .= dgMakeRowNoLabel($featArray['feat_desc'], $cssTag);
						}								

						$result .= dgMakeBlock($block, $cssBlockTag, $blockLabel);
				}

		} 

		return $result;
}



function getNPCSkillRowHTML( $skillArray) {
		$result = "";
		$tableRow = array();

		$tableRow[] = $skillArray['skill'];
		$tableRow[] = $skillArray['ranks'];
		$tableRow[] = $skillArray['stat_bonus'];
		$tableRow[] = $skillArray['misc_bonus'];
		$tableRow[] = $skillArray['total'];

		$result = $tableRow;
		return $result;

}




function getNPCBuffRowHTML( $buffArray) {
		$result = "";
		$tableRow = array();

		$tableRow[] = $buffArray['monbuff_level'];
		$tableRow[] = $buffArray['monbuff_spell'];

		$result = $tableRow;
		return $result;

}


function getNPCSpellsPerLevelHTML($dgTools, $npcNo) {
		/* Spells per class / level */
		$result = "";

		$tableHeader = array();
		$tableRows = array();
		$tableFooter = "";

		$tableHeader[0] = 'Class';
		$tableHeader[1] = '0th';
		$tableHeader[2] = '1st';
		$tableHeader[3] = '2nd';
		$tableHeader[4] = '3rd';
		$tableHeader[5] = '4th';
		$tableHeader[6] = '5th';
		$tableHeader[7] = '6th';
		$tableHeader[8] = '7th';
		$tableHeader[9] = '8th';
		$tableHeader[10] = '9th';

		if (!empty($dgTools['NPCsArray'][$npcNo]['classes'])) {
				$classes = $dgTools['NPCsArray'][$npcNo]['classes'];	
		
				foreach ($classes as $classRef => $classArray) {
						if ( !empty($classArray['spellsPerLevel']) ) {
								$tableRow = array();
								$cssTag = "dgNPCClassSepllRow";
								$tableRow[0] = $classArray['class_tp'];
								foreach ($classArray['spellsPerLevel'] as $level => $spellCount ) {
										$tableRow[$level +1] = $spellCount;
								}
								$tableRows[] = $tableRow;
						}
				}
		}		
		if (sizeof($tableRows>0)) {
				$result = dgMakeRowTable($tableHeader, $tableRows, $tableFooter);						
		}

		return $result;
}


function getNPCSelectedSpellsHTML($dgTools, $npcNo) {
		/* Spells per class / level */
		$result = "";

		if (!empty($dgTools['NPCsArray'][$npcNo]['classes'])) {
				$classes = $dgTools['NPCsArray'][$npcNo]['classes'];	
				$spells = 	$dgTools['NPCsArray'][$npcNo]['spells'];

				foreach ($classes as $classRef => $classArray) {
						if ( !empty($classArray['spellsPerLevel']) ) {

								$value = "Spell List For ".$classArray['class_tp'];
								$cssTag = "dgNPCSpellListTitle";
								$result .= dgMakeRowNoLabel($value, $cssTag);  // <---- HACK NEEDS FIXING

								$value = "CLASS XXX CONCENTRATION XXX";
								$cssTag = "dgNPCSpellListLevelTitle";
								$result .= dgMakeRowNoLabel($value, $cssTag);  // <---- HACK NEEDS FIXING


								$cssRowTag = "dgNPCClassSpellListLevel";

								foreach ($classArray['spellsPerLevel'] as $level => $spellCount ) {

										if ( !empty($dgTools['NPCsArray'][$npcNo]['spellsSelected']) &&
															!empty($dgTools['NPCsArray'][$npcNo]['spellsSelected'][$classArray['class_tp']]) &&
															!empty($dgTools['NPCsArray'][$npcNo]['spellsSelected'][$level]	[$classArray['class_tp']]) ){
														$spellsSelected = $dgTools['NPCsArray'][$npcNo]['spellsSelected'][$classArray['class_tp']][$level];
										} else {
												$spellsSelected = array();
										}
		
										$subRows = array();
										for( $spellNo = 0; $spellNo <= $spellCount; $spellNo++ ) {
												$spellName = "UNSELECTED SPELL";			//  <--- HACK NEEDS FIX 
												$cssTag = "dgNPCSpellListSpell"; 
												if ( !empty($spellsSelected[$spellNo] ) ) {
														$spellName = $spellsSelected[$spellNo];
												} 
												$subRows[] = dgMakeSubRow("",$spellName, $cssTag);
										}
										$result .= dgMakeRowOfSubRows($subRows, "LEVEL LABEL", $cssRowTag);
								}
						}
				}
		}		

		return $result;
}


/* HTML for a particular item. Note the maxCount = 0 means that all of those items are returned */
function getNPCItemHTML($itemsArray, $itemType, $itemSubType = "", $maxCount = 0) {
		
		$subRows = array();
		$cssTag = "dgNPCItems".$itemType.$itemSubType;					

		if ( !empty($itemsArray) && !empty($itemsArray[$itemType]) ) {
					$itemCount = 0;
					foreach ($itemsArray[$itemType] as $itemArray) {
							/* Is it correct subtype or subtype not relevent? */
							if ( ( empty($itemArray['item_subtype']) && empty($itemSubType) ) ||
												( !empty($itemArray['item_subtype']) && $itemArray['item_subtype'] = $itemSubType ) ) {
										/* Item */
										$subRows[] = dgMakeSubRowNoLabel($itemArray['item_name'], $cssTag."_item");

									/* Special Fields for certain items */
									switch ($itemType) {
											case "weapon":
													$subRows[] = dgMakeSubRowNoLabel($itemArray['item_special'], $cssTag."_special");
													if ( $itemSubType !== "ranged" ) {
															$subRows[] = dgMakeSubRowNoLabel($itemArray['item_material'], $cssTag."_special");											
													}
													break;
											case "shield" :
													$subRows[] = dgMakeSubRowNoLabel($itemArray['item_special'], $cssTag."_special");
	 												break;
											case "armour" :
													$subRows[] = dgMakeSubRowNoLabel($itemArray['item_special'], $cssTag."_special");
	 												break;
									}
									$itemCount++;
							} 
							if ( $maxCount > 0 && $itemCount >= $maxCount ) {
									/* Break out of the foreach loop */
									break;
							}		

					}									
		}

		return $subRows;		
}