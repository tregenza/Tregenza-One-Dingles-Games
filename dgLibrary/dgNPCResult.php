<?php
/*  

		Handles plain text / print output of NPCs 

		CT - Only Pathpathfinder but should be easily adaptable to D&D 

*/

require_once(locate_template('library/dgNPCData.php'));


$NPCDataArray = getNPCData(); 

$htmlp = "";
$output = "";

/* Name, type, CR */
$htmlp .= wrapHTMLDGBlock(formatNPCName( $NPCDataArray, "dgNPCName" ));
$htmlp .= wrapHTMLDGBlock(formatNPCType( $NPCDataArray ), "dgNPCValueAlign dgNPCType");
$htmlp .= wrapHTMLDGBlock(formatNPCCR( $NPCDataArray ), "dgNPCCR");
$htmlp .= wrapHTMLDGBlock(formatNPCDescription( $NPCDataArray ), "dgNPCValueAlign dgNPCDescription");
$htmlp .= wrapHTMLDGBlock(formatNPCXP( $NPCDataArray ),"dgNPCXP");
$htmlp .= wrapHTMLDGBlock(formatNPCAlignment( $NPCDataArray ), "dgNPCValueAlign dgNPCAlignment");
$htmlp .= wrapHTMLDGBlock(formatNPCClass( $NPCDataArray ), "dgNPCClass");
$htmlp .= wrapHTMLDGBlock(formatNPCInit( $NPCDataArray ), "dgNPCInit");
$htmlp .= wrapHTMLDGBlock(formatNPCSenses( $NPCDataArray ), "dgNPCSenses");
$htmlp .= wrapHTMLDGBlock(formatNPCAura( $NPCDataArray ), "dgNPCAura");

$output .= wrapHTMLBlock( $htmlp, "dgNPCMain dgNPCHeaderBlock");
$htmlp = "";

$htmlp .= wrapHTMLDGBlock("Defense", "dgNPCBlockHeader");
$htmlp .= wrapHTMLDGBlock(formatNPCArmour( $NPCDataArray ), "dgNPCArmour");
$htmlp .= wrapHTMLDGBlock(formatNPCHP( $NPCDataArray ), "dgNPCHP");
$htmlp .= wrapHTMLDGBlock(formatNPCSaves( $NPCDataArray ), "dgNPCValueAlign dgNPCSaves");
$htmlp .= wrapHTMLDGBlock(formatNPCDefences( $NPCDataArray ), "dgNPCDefences");

$output .= wrapHTMLBlock( $htmlp, "dgNPCMain dgNPCDefenceBlock");
$htmlp = "";

$htmlp .= wrapHTMLDGBlock("Offense", "dgNPCBlockHeader");
$htmlp .= wrapHTMLDGBlock(formatNPCMovement( $NPCDataArray ), "dgNPCMovement");
$htmlp .= wrapHTMLDGBlock(formatNPCMelee( $NPCDataArray ), "dgNPCMelee");
$htmlp .= wrapHTMLDGBlock(formatNPCSpecialAttacks( $NPCDataArray ), "dgNPCSpecialAttacks");
$htmlp .= wrapHTMLDGBlock(formatNPCSpellLikeAbilities($NPCDataArray), "dgNPCSpellLike");
$htmlp .= wrapHTMLDGBlock(formatNPCSpellsKnown($NPCDataArray), "dgNPCSpellsKnown");

$output .= wrapHTMLBlock( $htmlp, "dgNPCMain dgNPCOffenseBlock");
$htmlp = "";

$htmlp .= wrapHTMLDGBlock("STATISTICS", "dgNPCBlockHeader");
$htmlp .= wrapHTMLDGBlock(formatNPCBasicStats( $NPCDataArray ), "dgNPCBasicStats");
$htmlp .= wrapHTMLDGBlock(formatNPCBaseAttack( $NPCDataArray ), "dgNPCBaseAttack");
$htmlp .= wrapHTMLDGBlock(formatNPCFeats( $NPCDataArray ), "dgNPCFeats");
$htmlp .= wrapHTMLDGBlock(formatNPCSkills( $NPCDataArray ), "dgNPCSkills");
$htmlp .= wrapHTMLDGBlock(formatNPCLanguages( $NPCDataArray ), "dgNPCLanguages");


$output .= wrapHTMLBlock( $htmlp, "dgNPCMain dgNPCStatisticsBlock");
$htmlp = "";


$htmlp .= wrapHTMLDGBlock("ECOLOGY", "dgNPCBlockHeader");
$htmlp .= wrapHTMLDGBlock(formatNPCEnvironment( $NPCDataArray ), "dgNPCEnvironment");
$htmlp .= wrapHTMLDGBlock(formatNPCOrganisation( $NPCDataArray ), "dgNPCOrganisation");
$htmlp .= wrapHTMLDGBlock(formatNPCTreasureType( $NPCDataArray ), "dgNPCTreasureType");

$output .= wrapHTMLBlock( $htmlp, "dgNPCMain dgNPCEcologyBlock");
$htmlp = "";


$htmlp .= wrapHTMLDGBlock("SPECIAL ABILITIES", "dgNPCBlockHeader");
$htmlp .= wrapHTMLDGBlock(formatNPCSpecialAbilities( $NPCDataArray ), "dgNPCSpecialAbilities");
$htmlp .= wrapHTMLDGBlock(formatNPCSpecialDescription( $NPCDataArray ), "dgNPCSpecialDescription");
$htmlp .= wrapHTMLDGBlock(formatNPCBuffingPrecast( $NPCDataArray ), "dgNPCBuffingPrecast");

$output .= wrapHTMLBlock( $htmlp, "dgNPCMain dgNPCSpecialAbilitiesBlock");
$htmlp = "";


doOutput($output);

function doOutput($htmlp) {
	/* Output */
	?>
	<!-- dgNPCOutput - Start -->
	<div class="dgNPCOutput">
	
	<?php echo $htmlp ?>
	
	</div>
 <?php
}


function formatNPCName( $NPCDataArray ) {
			$result = wrapHTMLLineHeader("Name :- ");
			$value = "";
			if (!empty($NPCDataArray['savemon_name'])) {
					$value .= $NPCDataArray['savemon_name']. " ";
			}
			if (!empty($NPCDataArray['savemon_camp']) || !empty($NPCDataArray['savemon_sub'])) {

				if (!empty($NPCDataArray['savemon_camp'])) {
						$value .= $NPCDataArray['savemon_camp']. " ";
				}
				$result .= " / ";
				if (!empty($NPCDataArray['savemon_sub'])) {
						$value .= $NPCDataArray['savemon_camp']. " ";
				}
		}			
		$result .= wrapHTMLValue($value);

			return $result;
}

function formatNPCType( $NPCDataArray ) {
			$result ="";
			if (!empty($NPCDataArray['mon_type'])) {
				$result .= $NPCDataArray['mon_type'];
			}
			return wrapHTMLValue($result, "dgNPCType");
}

function formatNPCCR( $NPCDataArray ) {
			$cr = calcTotalCR( $NPCDataArray );

			/* ??? Mon_temp ??? No idea what this is about */
			$result = " " . montempCR( $NPCDataArray, $cr);

			return $result;
}

function calcTotalCR( $NPCDataArray ) {
			$cr = 0;
			if (!empty($NPCDataArray['cr'])) {
				$cr = $NPCDataArray['cr'];
			}
			if (!empty($NPCDataArray['cr_path'])) {
				$cr += $NPCDataArray['cr_path'];
			}
			if ($cr > 1){
			  $cr = round($cr,0);
			}
			return $cr;
}

function formatNPCXP( $NPCDataArray ) {
			$cr = calcTotalCR( $NPCDataArray );	
			$xp = calcXP( $cr );

			$result = wrapHTMLLineHeader("XP") . wrapHTMLValue($xp);

			return $result;
}

/* Calculate the XP for the CR */
function calcXP( $cr_total) {

	$link = getDBLink();
	if ($cr_total < 1){
	  $select = "select level_xp from level where lev_no = 1";
	  if ($result = mysqli_query($link, $select)){
	    $row = mysqli_fetch_array($result);
	    $xp = $row['level_xp'] * $cr_total;
	    $xp = round($xp,0);
	  }else{
	    $xp = "***";
	  }
	}else{
	  $select = "select level_xp from level where lev_no = '$cr_total'";
	  if ($result = mysqli_query($link, $select)){
	    $row = mysqli_fetch_array($result);
	    $xp = $row['level_xp'];
	  }else{
	    $xp = "***";
	  }
	}

	return $xp;
}
/*

TEST - No idea what this is ment to output. Something to do with the encounter generator?  

*/
function montempCR( $NPCDataArray, $cr_total ) {
	$result = "";
	if (!empty($NPCDataArray['mon_temp'])){
   if (!empty($NPCDataArray['mon_temp2'])){
       $result .=  wrapHTMLHighlight(" " . $NPCDataArray['mon_temp'] . " / " .$NPCDataArray['mon_temp2'] .  " " . $cr_total );
   }else{
       $result .=  wrapHTMLHighlight(" " . $NPCDataArray['mon_temp'] . "  " . $cr_total );
   }
	}else{
   $result  .= wrapHTMLLineHeader("CR ") . wrapHTMLValue($cr_total);
	}
	return $result;
}

function formatNPCDescription( $NPCDataArray ) {

	$result = "";	
	if ($NPCDataArray['mon_desc'] == $NPCDataArray['mon_name'] ||
			 $NPCDataArray['mon_desc'] == "-" || 
				$NPCDataArray['key_1'] != "path"  ||
			 strlen($NPCDataArray['mon_desc']) < 20 ) {
	
				$result .= wrapHTMLValue("","dgNPCDescription");
	} else {
	  $result .= wrapHTMLValue($NPCDataArray['mon_desc'],"dgNPCDescription");
	}
	return $result;
}


function formatSpecialsCommaSep( $specialSubArray ) {
	$result = "";
	if 	(!empty($specialSubArray)) {
			$myArray = array();
			foreach ( $specialSubArray as $line ) {

				if (!empty($line['specqual_abil'])) {
							$myText = wrapHTMLSpan(trim($line['specqual_abil']),"dgNPCSpecialEntryName");
							$myText .= wrapHTMLSpan(trim($line['specqual_desc']),"dgNPCSpecialEntryValue");
							$myArray[] = wrapHTMLBlock(trim($myText), "dgNPCSpecialEntry");
					} else if (!empty($line['monspec_name'])) {
							$myText = wrapHTMLSpan(trim($line['monspec_name']),"dgNPCSpecialEntryName");
							$myText  .= wrapHTMLSpan(trim($line['monspec_value']),"dgNPCSpecialEntryValue");
							$myArray[] = wrapHTMLBlock(trim($myText), "dgNPCSpecialEntry");
					}
					
			}
			

			$result .= implode($myArray);
	}
	return $result;
}

/*

TEST - Check all the permitations of the monster types / subtypes 

*/
function formatNPCAlignment( $NPCDataArray ) {

	$result = "";
	$result .= $NPCDataArray['mon_alignment'] .  " " . $NPCDataArray['mon_size'] . " " . $NPCDataArray['mon_type'];

	$ttype1 = "";
	$ttype2 = "";
	if ( !empty($NPCDataArray['tem_type'] ) ){
			$ttype1 = $NPCDataArray['tem_type'];
	}
	if (!empty($NPCDataArray['tem_type2'] ) ) {
			$ttype1 = $NPCDataArray['tem_type2'];
	}

	/* Set flags just to help make the logic clearer */
	$validMonFlag = 0;
	$magicBeast = 0;
	if ( $NPCDataArray['mon_type'] == 'Animal' or $NPCDataArray['mon_type'] == 'Vermin') {
				$validMonFlag = 1;	
	}
	if ( $ttype1 == 'Magical Beast' || $ttype2 == 'Magical Beast' ) {
				$magicBeast = 1;
	}

	if ( ($validMonFlag && $magicBeast) ||	!$magicBeast ) {
		if (!empty($ttype1) || !empty($ttype2) ) {
			$templates = " ( ";
			if (!empty($ttype1) ) {
					$templates .= $ttype1. " ";
			} 
			if (!empty($ttype2) ) {
					$templates .= $ttype2;
			}
			$template .= " ) ";
			$result .= wrapHTMLSpan($templates, "dgNPCAlignmentTemplates");				
		}
	}

	$specials = getSpecialArray($NPCDataArray);

	if (!empty($specials['SUB']) ) {
		$sub = 	formatSpecialsCommaSep($specials['SUB']);

		$result .= " ". wrapHTMLSpan($sub,"dgNPCAlignmentSub") ;
	}
	return wrapHTMLValue($result,"dgAlignValue");
}

function formatNPCClass( $NPCDataArray ) {
	$result = "";
	$classResult = "";
	if (!empty($NPCDataArray['class1_tp'])) {
			$classResult = formatNPCClassDomain( trim($NPCDataArray['class1_tp']), $NPCDataArray['class1_level'], $NPCDataArray['domain_11'], $NPCDataArray['domain_12'], $NPCDataArray['domain_13'], $NPCDataArray['class1_skill_points'], $NPCDataArray['class1_focus'] );
	}	
	$result = wrapHTMLDGBlock($result);

	if (!empty($NPCDataArray['class2_tp'])) {
			$classResult = formatNPCClassDomain( trim($NPCDataArray['class2_tp']), $NPCDataArray['class2_level'], $NPCDataArray['domain_21'], $NPCDataArray['domain_22'], $NPCDataArray['domain_23'], $NPCDataArray['class2_skill_points'], $NPCDataArray['class2_focus'] );
	}	
	$result = wrapHTMLDGBlock($result);

	if (!empty($NPCDataArray['class3_tp'])) {
			$classResult = formatNPCClassDomain( trim($NPCDataArray['class3_tp']), $NPCDataArray['class3_level'], $NPCDataArray['domain_31'], $NPCDataArray['domain_32'], $NPCDataArray['domain_33'], $NPCDataArray['class3_skill_points'], $NPCDataArray['class3_focus'] );
	}	
	$result = wrapHTMLDGBlock($classResult);
	
	return $result;
}

function formatNPCClassDomain( $class, $level, $domain1, $domain2, $domain3, $skillpoints, $focus ) {

	$result = "";

	if ($class != ""){
	   $result .=  wrapHTMLDGBlock($class . " Level " . $level . " (Skill Points " . $skillpoints  . ") " . $focus );
	}
	if ($domain1 != "" ){
	  if ($class == "Cleric"){
	       $result .= wrapHTMLDGBlock("(Domains  $domain1 and $domain2) ", "dgNPCDomains");
	  }else{
	     if ($class == "Wizard"){
	        $result .=  wrapHTMLDGBlock("(School $domain1  Prohibited  $domain2 , $domain3)", "dgNPCDomains");
	
	     }else{
	        $result .= wrapHTMLDGBlock("($domain1 $domain2) ", "dgNPCDomains");
	     }
	   }
	}

	return $result;

}

function formatNPCInit( $NPCDataArray ) {
	$result = "";

	$special = getSpecialArray($NPCDataArray);

	$result = wrapHTMLLineHeader( "Init ", "dgNPCInitHeader");
	
	$init = "";
	if ( empty($NPCDataArray['init']) ) {
		$init .= wrapHTMLSpan("0", "dgNPCInitValue");
	} else {
		if ( $NPCDataArray['init'] > 0 ) {
			$init .= wrapHTMLSpan("+" . $NPCDataArray['init'], "dgNPCInitValue");
		} else {
			$init .= wrapHTMLSpan($NPCDataArray['init'], "dgNPCInitValue");
		}
	}

	if 	(!empty($special['INIT'])) {
			foreach ( $special['INIT'] as $line ) {
				if (!empty($line['monspec_value'])) {
						$init .= wrapHTMLSpan($line['monspec_value'],"dgNPCInitSpecial");
						$init .= ",";
				}
			}
			$init = substr(trim($init), -1);
	}
	
	$result .= wrapHTMLValue($init, "dgNPCNaturalSize dgNPCInit");

	return $result;

}

function formatNPCSenses($NPCDataArray) {
	$result ="";
	$special = getSpecialArray($NPCDataArray);
	
	$senses = wrapHTMLLineHeader("Senses", "dgNPCSensesHeader");
	$senses .= wrapHTMLBlock(formatSpecialsCommaSep($special['SEN']), "dgNPCValueAlign");

	$result .= $senses;

	return $result;
}

function formatNPCAura( $NPCDataArray ) {
	$result = "";
	
	if (!empty($NPCDataArray['print_aura'] )) {
	   $result .= wrapHTMLLineHeader("Aura"). $NPCDataArray['print_aura'];
	}
	return $result;
}
	
function formatNPCArmour( $NPCDataArray ) {
	$result = "";

	$magic_armour_d = formatNPCWeaponArmourMods( $NPCDataArray['magic_armour']) ;
		
	$magic_shield_d = formatNPCWeaponArmourMods( $NPCDataArray['magic_shield']);
	
	$mon_ac_d = round($NPCDataArray['mon_ac']);
	$ac_flat_d = round($NPCDataArray['ac_flat']);

	$ac_flat_d = round($ac_flat_d,0);
	
	$result .= wrapHTMLLineHeader("AC") . $mon_ac_d . ", Touch " . $NPCDataArray['ac_touch'] . ", flat footed " . $ac_flat_d;
		
	$result .= " (" . $magic_armour_d . " " . $NPCDataArray['mon_armour'] . ", " . $magic_shield_d . " " . $NPCDataArray['mon_shield'] . ") ".$NPCDataArray['AC_text'];

	$result = wrapHTMLDGBlock( $result , "dgACValues");
	
	if ( !empty($NPCDataArray['ac_desc'])) {
		$result .= wrapHTMLDGBlock( "( ".$NPCDataArray['ac_desc']." )", "dgNPCValueAlign dgNPCACDescription");
	}	
	
	return $result;	
}

function formatNPCWeaponArmourMods( $itemMod ) {
	$itemDesc = "";

	$itemModRounded = round($itemMod,0);
	
	if ($itemMod > $itemModRounded){
	   $itemDesc = "masterwork";
	} else {
	   if ($itemModRounded > 0 ){
	      $itemDesc = " +" . $itemModRounded;
	   }else{
	      $itemDesc = "";
	   }
	}

	return $itemDesc;
}

/* 

Test - Special HP text not tested as don't know what creatures have this info 

*/
function formatNPCHP( $NPCDataArray ) {
	$result = "";

	$result .= wrapHTMLLineHeader("HP");
		
	$result .= wrapHTMLValue($NPCDataArray['total_hps']. " ( "  . $NPCDataArray['total_hd'] . " )", "dgNPCHPValue");

	$specials = getSpecialArray($NPCDataArray);
	if (!empty($specials['HP']) ) {
		$hp = 	formatSpecialsCommaSep($specials['HP']);

		$result .= " ". wrapHTMLSpan($hp,"dgNPCHPAdditional") ;
	}
	return $result;
}


function formatNPCSaves( $NPCDataArray ) {
	$result = "";

	$result .= wrapHTMLLineHeader("Fort ", "dgNPCNaturalSize");
	if ($NPCDataArray['total_fort_sv'] >= 0){
	 $result .= "+" ;
	}

	$result .= wrapHTMLValue($NPCDataArray['total_fort_sv'], "dgNPCNaturalSize");
	
	$result .= wrapHTMLLineHeader("Ref ", "dgNPCNaturalSize");

	$value = "";
	if ($NPCDataArray['total_reflex_sv'] >= 0){
	 $value .= "+" ;
	}

	$result .= wrapHTMLValue($value . $NPCDataArray['total_reflex_sv'], "dgNPCNaturalSize");

	$result .= wrapHTMLLineHeader("Will ", "dgNPCNaturalSize");

	$value = "";
	if ($NPCDataArray['total_will_sv'] >= 0){
	  $value .= " +";
	}
	
	$result .= wrapHTMLValue($value.$NPCDataArray['total_will_sv'], "dgNPCNaturalSize");

	$result .= " ".wrapHTMLValue($NPCDataArray['save_text'], "dgNPCSpecialEntry dgNPCNatualSize");
	
	return $result;
}

function getSpecialArray($NPCDataArray) {
	return decodeNPCDataSubArray($NPCDataArray, 'specialAbilitiesArray');
}

function getFeatArray($NPCDataArray) {
	return decodeNPCDataSubArray($NPCDataArray, 'featsArray');
}
function getSkillArray($NPCDataArray) {
	return decodeNPCDataSubArray($NPCDataArray, 'skillArray');
}
function getSecondaryWeaponArray($NPCDataArray) {
	return decodeNPCDataSubArray($NPCDataArray, 'secondaryWeaponArray');
}
function getMonSpeedArray($NPCDataArray) {
	return decodeNPCDataSubArray($NPCDataArray, 'monSpeedArray');
}
function getSpecialAttackArray($NPCDataArray) {
	return decodeNPCDataSubArray($NPCDataArray, 'specialAttackArray');
}


function decodeNPCDataSubArray($NPCDataArray, $index) {
	$result = array();
	if ( !empty($NPCDataArray[$index])) {
		$result = unserialize(base64_decode(urldecode(	$NPCDataArray[$index])));
	}	
	return $result;
}


function formatNPCDefences( $NPCDataArray ) {
	$result = "";
	$result .= wrapHTMLDGBlock(wrapHTMLLineHeader("Defensive Abilities "));

	$special = getSpecialArray($NPCDataArray);

	if (isset($special['DEF']) && sizeof($special['DEF']) > 0 ) {
			foreach($special['DEF'] as $line ) {
				$block = "";
				$block .= wrapHTMLSpan($line['monspec_name'],"dgNPCSpecialAbilityName");
				if (!empty($line['dc']) || !empty($line['monspec_value']) ) {
					$block .= " : ";
				}

				if (!empty($line['dc'])) {
						$block .= formatNPCDC($line['dc']);
				}
				$block .= wrapHTMLSpan($line['monspec_value'],"dgNPCSpecialAbilityValue");
				$result .= wrapHTMLDGBlock($block,"dgNPCValueAlign dgNPCSpecialAbility");
			}
	}
	return $result;

}

/*

	TEST - Are other speed types working correctly ??? 

*/
function formatNPCMovement( $NPCDataArray ) {
	$result = "";

	$value = wrapHTMLLineHeader("Speed ");

	$monSpeedArray = getMonSpeedArray($NPCDataArray);

	$value .= formatSpeedType("", $monSpeedArray, 'land', "");
	$value .= formatSpeedType("Fly", $monSpeedArray, 'fly', ", ");
	$value .= formatSpeedType("Swim", $monSpeedArray, 'swim', ", ");
	$value .= formatSpeedType("Climb", $monSpeedArray, 'climb', ", ");
	$value .= formatSpeedType("Burrow", $monSpeedArray, 'burrow', ", ");

	$result .= wrapHTMLBlock($value, "dgNPCBlock");

	$specials = getSpecialArray($NPCDataArray);
	if (!empty($specials['SPEED']) ) {
		$speedExtra = 	formatSpecialsCommaSep($specials['SPEED']);
		$value = wrapHTMLSpan($speedExtra,"dgNPCSpecialEntry dgNPCSpeedAdditional");

		$result .= wrapHTMLBlock($value, "dgNPCBlock  dgNPCValueAlign" );
	}
	
	return $result;
}

function formatSpeedType( $type, $monSpeedArray, $key,  $sep ) {
	$result = "";
	if (!empty($monSpeedArray[$key]) && $monSpeedArray[$key] > 0) {
		$result .= $sep . wrapHTMLLineHeader($type).wrapHTMLValue($monSpeedArray[$key]."ft.");
	}
	return $result;	
}

function formatAttackArray( $attack ) {
	$result = "";

	if (!empty($attack) && is_array($attack) ) {
			if ( !empty($attack['name']) ) {
				$result .= wrapHTMLSpan($attack['name'], "dgNPCWeaponName");
			} else { 
				$result .= wrapHTMLSpan("", "dgNPCWeaponName");
			}
			if ( !empty($attack['attack']) ) {
				if ($attack['attack'] >= 0 ) {
					$result .= "+";
				} 
				$result .= wrapHTMLSpan($attack['attack'], "dgNPCWeaponAttack");
			} else { 
				$result .= wrapHTMLSpan("", "dgNPCWeaponAttack");
			}
			if ( !empty($attack['damage']) ) {
				$result .= wrapHTMLSpan("( ".$attack['damage']." )", "dgNPCWeaponDamage");
			} else { 
				$result .= wrapHTMLSpan("", "dgNPCWeaponDamage");
			}
			if ( !empty($attack['crit']) ) {
				$result .= wrapHTMLSpan($attack['crit'], "dgNPCWeaponCrit");
			} else { 
				$result .= wrapHTMLSpan("", "dgNPCWeaponCrit");
			}
			if ( !empty($attack['other']) ) {
				$result .= wrapHTMLSpan($attack['other'], "dgNPCWeaponOther");
			} else { 
				$result .= wrapHTMLSpan("", "dgNPCWeaponOther");
			}
	}

	return $result;

}


function formatOtherAttacks($NPCDataArray) {

	$secondaryWeaponArray = getSecondaryWeaponArray($NPCDataArray);

	$results = "";

	$secondary = "";
	foreach($secondaryWeaponArray as $line ) {
		if ( !empty($line) ) {
			$output = formatAttackArray($line);	
			$secondary .= wrapHTMLSpan($output.",", "dgNPCSecondaryWeapon");
		}
	}
	/* strip last comma */
	if ( strrpos($secondary, "," ) )  {
		$secondary = substr($secondary, 0, strrpos($secondary, ",")-1  ) . substr($secondary, strrpos($secondary, ",")+1  ) ;	
	}

	$results .= wrapHTMLSpan($secondary,"dgNPCSecondaryWeapons");

/* 
* NOT WORKING <-----------------
* ??? Not clear what should be printed if no melee ???
*	 Start  ---------------------
*/
		if ($NPCDataArray['mon_weap_s1'] != "No Melee"){
//		  $results .= wrapHTMLDGBlock($NPCDataArray['print_secondary_attacks'],"dgNPCSecondaryAttacks");
		}
/* END  --------------------- */
		

if ($NPCDataArray['mon_weap_r'] != "None"){
						$range = " or ";
						if ( !empty($NPCDataArray['magic_r'])) {
							$range .= $NPCDataArray['magic_r'];
						}
					 $range .= $NPCDataArray['mon_weap_r'];
						$range .= " +" . $NPCDataArray['ranged_attack'];
						$range .= " (" .  $NPCDataArray['damage_r'];
						if ( !empty($NPCDataArray['crit_txt_r'])) {
					 		$range .= $NPCDataArray['crit_txt_r'];
						}
						$range .=  ") ";
						$range .= "range " . $NPCDataArray['weap_range_r'];
						$range .= " ".$NPCDataArray['magic_WEAPONR_SPEC_1']." ".$NPCDataArray['print_ranged'];

						$results .= $range;
		}
		
		if ($NPCDataArray['class1_tp'] == "Monk" or $NPCDataArray['class2_tp'] == "Monk") {
		  $results .= " or Flurry of blows +" . $NPCDataArray['flurry'] . " " . $NPCDataArray['flurry_damage'] ;
		}

   return $results;
}

function formatNPCSpaceReach( $NPCDataArray ) {
	$result = "";

	$result .= wrapHTMLLineHeader("Space ") . wrapHTMLValue($NPCDataArray['mon_space'] . "ft.");

	$result .= wrapHTMLLineHeader("Reach"). wrapHTMLValue($NPCDataArray['mon_reach']."ft.");

	if (!empty($NPCDataArray['reach_text']) ){
	   if (!empty($NPCDataArray['print_reach']) ){
	       $result .= wrapHTMLValue($NPCDataArray['print_reach']) . ", ";
	   }
	   $result .= $reach_text;
	}

	return $result;
}


/* 

TEST - Check combinations of weapons / attacks all work 

*/
function formatNPCMelee( $NPCDataArray ) {
	$result = "";

	$result .= wrapHTMLDGBlock(wrapHTMLLineHeader("Melee"));

	$single = "";

	$magic = "";
	$magic_s1 = "";
	$magic_r = "";
	$crit = "";
	$crit_r = "";

	$single .= wrapHTMLBlock(wrapHTMLLineHeader("Single Attack"), "dgNPCValueAlign");
	$singleValue = wrapHTMLSpan($NPCDataArray['mon_weap_p'],"dgNPCValue");

	if ( !empty($NPCDataArray['magic_tohit_p']) || !empty($NPCDataArray['magic_damage_p'] ) ) {
		$magic = formatNPCHitDamage($NPCDataArray['magic_tohit_p'], $NPCDataArray['magic_damage_p'] );
	}

	if ( !empty($NPCDataArray['magic_tohit_s1']) || !empty($NPCDataArray['magic_damage_s1'] ) ) {
		$magic_s1 = formatNPCHitDamage($NPCDataArray['magic_tohit_s1'], $NPCDataArray['magic_damage_s1'] );
	}

	if ( !empty($NPCDataArray['magic_tohit_r']) || !empty($NPCDataArray['magic_damage_r'] ) ) {
		$magic_r = formatNPCHitDamage($NPCDataArray['magic_tohit_r'], $NPCDataArray['magic_damage_r'] );
	}

	if ( !empty($NPCDataArray['crit_ch_p']) || !empty($NPCDataArray['crit_p'] ) ) {
		$crit = formatNPCCritical($NPCDataArray['crit_ch_p'], $NPCDataArray['crit_p']);
	}

	if ( !empty($NPCDataArray['crit_ch_r']) || !empty($NPCDataArray['crit_r'] ) ) {
		$crit_r = formatNPCCritical($NPCDataArray['crit_ch_r'], $NPCDataArray['crit_r']);
	}

	if (substr($NPCDataArray['single_attack'],0,1) !== "-"){
		$singleValue .= "+";
	}

	$singleValue .= $NPCDataArray['single_attack'];
	$singleValue .= " (" . $NPCDataArray['damage_p'] . $crit . ") ";
	$singleValue .= $NPCDataArray['magic_WEAPONA_SPEC_1'];

	if ( !empty($NPCDataArray['print_attack']) ) {
   $singleValue .= "(" . $NPCDataArray['print_attack'] . ")";
	}

	$single .= wrapHTMLDGBlock(wrapHTMlValue($singleValue,"dgNPCSingleAttackValue"),"dgNPCValueAlign");

	$result .= wrapHTMLDGBlock($single, "dgNPCSingleWeapon");

	$range = "";
	if (!empty($NPCDataArray['mon_weap_r']) && $NPCDataArray['mon_weap_r'] !== "None" )  {
				$range .= "or " . $magic_r . $NPCDataArray['mon_weap_r'];
				$range .= " +" . $NPCDataArray['single_ranged'];
				$range .= " (" . $NPCDataArray['damage_r'] .  $crit_r .") ";
				$range .= $NPCDataArray['magic_WEAPONR_SPEC_1']." ".$NPCDataArray['print_ranged'];
	}

	$result .= wrapHTMLDGBlock($range, "dgNPCValueAlign dgNPCRangeWeapon");

	$attacks = wrapHTMLDGBlock(wrapHTMLLineHeader("Full Attack"),"dgNPCValueAlign");
	$attacks .= wrapHTMLDGBlock(formatOtherAttacks( $NPCDataArray ),"dgNPCValueAlign");
	$attacks = wrapHTMLDGBlock($attacks, "dgNPCFullAttack");

	$attacks .= wrapHTMLDGBlock(formatNPCSpaceReach( $NPCDataArray ), "dgNPCReachSpace");

	$result .= wrapHTMLDGBlock($attacks, "dgNPCOtherAttacks");

	return $result;
}



function formatNPCHitDamage( $tohit, $damage ) {
	$result = "";

	$magic_to_hit = 0;
	$magic_damage = 0;
	$magic = "";

	if ( !empty($tohit )) {
		$magic_to_hit = $tohit;
	}

	if ( !empty($damage) ) {
		$magic_damage = $damage;
	}
	
	if ($magic_to_hit || $magic_damage ){
				$result = "(";		

	   if (substr($magic_to_hit,0,1) == "+"){
					$result .= $magic_to_hit . "/" ;		
				} else {
					$result .= "+" . $magic_to_hit. "/+";
				}

				$result .= $magic_damage. ") ";
	}

	return $result;
}

/*

TEST - Original logic extemely confusing. This simplar version should do it but needs checking 

*/
function formatNPCCritical($critMultiplier, $critChance) {
	$result = "";

	/* Non-default crit chance? */
	if (!empty($critChance) && $critChance !== "20" ) {
			$result .= "/".$critChance."-20";					
	} 

	/* Non-default multiplier? */
	if ( isset($critMultiplier) && $critMultiplier !== 2 && $critMultiplier !== 0 ) {
					$result .= " X ".$critMultiplier;				
	} 
	
	$result;
}

/* 

WORK NEED - Special attacks formatted somewhere else and contains BR tags etc

*/
function formatNPCSpecialAttacks($NPCDataArray) {
	$result = "";

	$specialAttackArray = getSpecialAttackArray($NPCDataArray);
	$attacks = "";

	foreach($specialAttackArray as $specialAttack) {
		if ( $specialAttack['type'] !== 'SPELL' ) {
			$attack = "";
			if ( !empty($specialAttack['name'] ) ) {
					$attack .= wrapHTMLSpan($specialAttack['name'],"dgNPCSubValue dgNPCSpecialAttackName");
			}
			if ( !empty($specialAttack['dc'] ) ) {
					$attack .= wrapHTMLSpan($specialAttack['dc'],"dgNPCSubValue dgNPCSpecialAttackDC");
			}
			if ( !empty($specialAttack['desc'] ) ) {
					$attack .= wrapHTMLSpan($specialAttack['desc'],"dgNPCSubValue dgNPCSpecialAttackDesc");
			}
			if ( !empty($specialAttack['spec_no'] ) ) {
					$attack .= wrapHTMLSpan($specialAttack['spec_no'],"dgNPCSubValue dgNPCSpecialAttackSpecNo");
			}
			if ( !empty($attack) ) {
					$attacks .= wrapHTMLDGBlock($attack,"dgNPCSpecialAttackEntry");
			}			
		}
	}
	$result .= wrapHTMLLineHeader("Special Attacks");

	$result .= wrapHTMLDGBlock($attacks, "dgNPCValueAlign");
	
	return $result;
}

function formatNPCSpellLikeAbilities($NPCDataArray) {
	$result = "";

	if (!empty($NPCDataArray['print_spell_abil']) or !empty($NPCDataArray['htmlp_spell_abil']) ){
	   $result .=  wrapHTMLDGBlock(wrapHTMLLineHeader("Spell-like Abilities"));
	
				/* Strip spell abilities of BR tags and replaces with DIVs */	
				$spell_abil_array = preg_split(":</?br>:is", $NPCDataArray['htmlp_spell_abil']);
				foreach ($spell_abil_array as $line) {
						$result .= wrapHTMLDGBlock($line);
				}	
	}

	return $result;
}

function getSpellsKnown($NPCDataArray) {

	$result = "";		
	$flag = 0;

	$possibleSpellClasses = array( 'class1_spat', 'class2_spat', 
					'class3_spat', 'classm_spat');
	$possiblePsiClasses = array( 'class1_psi', 'class2_psi', 
					'class3_psi', 'classm_psi' );

	for  ( $count =0; $count < 4; $count++) { 
		$spells = "";
		if ( !empty($NPCDataArray[$possibleSpellClasses[$count]] )) {
			calcSpellsKnown($NPCDataArray, $possibleSpellClasses[$count], $count+1);			
			$spells = formatNPCKnownSpellsByClassLevel($NPCDataArray, $count+1);
		} else if ( !empty($NPCDataArray[$possiblePsiClasses[$count]]) && $NPCDataArray[$possiblePsiClasses[$count]] == "Y" ) {
			calcSpellsKnown($NPCDataArray, $possiblePsiClasses[$count], $count+1);
			$spells = formatNPCKnownSpellsByClassLevel($NPCDataArray, $count+1);
		}

		if ( $spells ) {
			$class = $NPCDataArray['class'.($count+1)."_tp"];
	  $result .= wrapHTMLDGBlock(wrapHTMLLineHeader( $class . " Spells"), "dgClassSpellsHeader");
	  $result .= wrapHTMLDGBlock($spells,"dgNPCSpellsKnownList");
		}
	}
	return $result;
}

/* Populates temp table with known spells */
function calcSpellsKnown($NPCDataArray, $classFlag, $classNumber){   

		$classPrefix = 'class'.$classNumber;
  $level_v =  $classPrefix. "_level";
  $level = $NPCDataArray[$level_v];

  $spell_level = 0;
  $count = 1;

  $name_v = $classPrefix . "_spell_level" . $spell_level . "_" . $count;
		$name = "";
		if ( !empty($NPCDataArray[$name_v]) ) {		
	  $name = $NPCDataArray[$name_v];
		}
  $class_spell_level_v = $classPrefix . "_spell_level";
		$class_spell_level = "";
		if ( !empty($NPCDataArray[$class_spell_level_v]) ) {		
	  $class_spell_level = $NPCDataArray[$class_spell_level_v];
		}


		/* Clear old temp data */
		$user = $NPCDataArray['user'];
  $delete = "delete from spelltemp where spellt_user = '$user'";
  $link = getDBLink();
  $result = mysqli_query($link, $delete) ;



		/* Populate temp tables */
  while ($spell_level < 10){
     while($count < 15){
      if (!empty($name)){
        $insert = "INSERT INTO spelltemp (spellt_user, spellt_class_no, spellt_level, spellt_spell, spellt_count) " .
                  "VALUES ('$user', '$classNumber', '$spell_level', '$name', '1')";
    //    echo "<div>$insert</div>";
        if (!mysqli_query($link, $insert)){
           $select = "SELECT spellt_count from spelltemp where spellt_user = '$user' and spellt_class_no = '$classNumber' and " .
                  " spellt_level = '$spell_level' and spellt_spell = '$name'";
//           echo "select count " . $select;
           $result = mysqli_query($link, $select);
           $row = mysqli_fetch_array($result);
           $spellt_count = $row['spellt_count'];
//           echo "spellt_count " . $spellt_count;
           $spellt_count += 1;
           $update = "UPDATE spelltemp SET spellt_count = '$spellt_count' WHERE spellt_user = '$user' and spellt_class_no = '$classNumber' and " .
                  " spellt_level = '$spell_level' and spellt_spell = '$name'";
//           echo "update " . $update;
           $result = mysqli_query($link, $update);
        }
      }
      $count += 1;

				  $name_v = $classPrefix . "_spell_level" . $spell_level . "_" . $count;
						$name = "";
						if ( !empty($NPCDataArray[$name_v]) ) {		
					  $name = $NPCDataArray[$name_v];
						}
			

     }
     $spell_level += 1;
     $count = 1;

				  $name_v = $classPrefix . "_spell_level" . $spell_level . "_" . $count;
						$name = "";
						if ( !empty($NPCDataArray[$name_v]) ) {		
					  $name = $NPCDataArray[$name_v];
						}
  }

	return true;
}

function formatSpellLevelText($NPCDataArray, $classNumber, $spell_level, $stat_bonus, $max_level) {
		$result = "";

  $class_v =  "class".$classNumber. "_tp";
  $class = $NPCDataArray[$class_v];

		$dc = 10 + $spell_level + $stat_bonus;
		$spell_no_v = "class" . $classNumber . "_spell" . $spell_level;
		$spell_no = $NPCDataArray[$spell_no_v];
		$spell_no_dis = $spell_no;
		$domain_r = "domain_" . $classNumber . "1";
		$domain = $NPCDataArray[$domain_r];
		if (($spell_level > 0 )and ($class == "Witch" or ($class == "Wizard" and $domain != "" and $domain !="Universal"))){
				$spell_no_dis = $spell_no + 1;
		}

		$result .= wrapHTMLLineHeader("Level $spell_level ($spell_no_dis) DC " . $dc , "dgNPCSpellLevelHeading");
		if ($spell_level > $max_level and !empty($spat)){
			$result .= "** Needs $spat of ". (10 + $spell_level) . " to cast **";
		}
	 $result = wrapHTMLDGBlock($result, "dgNPCSpellLevelHeader");
		return $result; 
}

function cleanSpellName( $name ) {

		$names = array();
		$names[0] = $name;
		$names[1] = $name;	

		$star = stripos($names[0],"*");
		if ($star > 0){
			$star += 1;
			$len =strlen($names[0]);
			$names[1] = substr($names[0],$star,$len);
			$names[1] = trim($names[1]);
			$names[0] = str_replace("*"," ",$names[0]);
			//         echo $name;
		}

		return $names;
}

function getSpellsArrayByClassLevel($NPCDataArray, $classNumber) {
		$spellsArray = array();

		$user = $NPCDataArray['user'];	

  $spat_v = "class" . $classNumber . "_spat";
		$spat = "";
		if ( !empty($NPCDataArray[$spat_v]) ) {
	 		$spat = $NPCDataArray[$spat_v];
		}
  $psi_v = "class" . $classNumber . "_psi";
		$psi = "";
		if ( !empty($NPCDataArray[$psi_v]) ) {
	  $psi = $NPCDataArray[$psi_v];
		}
  $stat_v = "mon_" . strtolower($spat);
		$stat = "";
		if ( !empty( $NPCDataArray[$stat_v] ) ) {
			$stat = $NPCDataArray[$stat_v];
		}
  $stat_bonus_v =   "mon_" . strtolower($spat) . "_bonus";
		$stat_bonus = "";
		if ( !empty( $NPCDataArray[$stat_bonus_v] ) ) {
			$stat_bonus = $NPCDataArray[$stat_bonus_v];
		}
  $class_spell_level_v = 'class'.$classNumber."_spell_level";
		$class_spell_level = "";
		if ( !empty($NPCDataArray[$class_spell_level_v]) ) {		
	  $class_spell_level = $NPCDataArray[$class_spell_level_v];
		}

  $conc = $class_spell_level + $stat_bonus;

  $spell_level = 0;
  $count = 0;

		$spellsArray['class'] = array();
		$spellsArray['class']['stat_bonus']=$stat_bonus;
		$spellsArray['class']['conc']=$conc;
		$spellsArray['class']['class_spell_level'] = $class_spell_level;
		$spellsArray['levels'] = array();

  $stat_b = magicstat($spat);
  $stat += $stat_b;
  $max_level = $stat - 10;
  while ($spell_level < 10){

			$spellsArrayLevel = array();

    $select1 = "SELECT spellt_count, spellt_spell from spelltemp where spellt_user = '$user' and spellt_class_no = '$classNumber' and " .
                  " spellt_level = '$spell_level' order by spellt_spell";
    $link = getDBLink();
    $result1 = mysqli_query($link, $select1);

    While($rowLevel = mysqli_fetch_array($result1)){
						$spellsArrayLevel['level']=compact('classNumber', 'spell_level', 'stat_bonus', 'max_level');
						$spellsArrayLevel['spells']=array();

					 $names = cleanSpellName($rowLevel['spellt_spell']);
      $name = $names[0];
      $name2 = $names[1];


      $select = "SELECT spell_school, spell_desc, spell_type1, spell_type2, spell_type3, spell_type4, spell_comp, spell_range, spell_duration, spell_save," .
                 "spell_area, spell_psi_power_pts, spell_resist, spell_psi_focus, spell_cast_time, spell_book  from spell" .
                 " where spell_name = '$name2'";
      $link = getDBLink();
      $result = mysqli_query($link, $select);

      while ($rowSpell = mysqli_fetch_array($result)){
      		$rowSpell['spellt_count'] = $rowLevel['spellt_count'];
							$rowSpell['spell_name'] = $name;
        $rowSpell['spell_desc'] = trim($rowSpell['spell_desc']);
        $rowSpell['spell_dc'] = "";
        if ($rowSpell['spell_psi_power_pts'] > 0){
           $rowSpell['spell_psi_power_pts'] = ($spell_level * 2) -1;
        }

        $select2 = "select spellrange_desc from spellrange where spellrange_id = '".$rowSpell['spell_range']."'";
        $result2 = mysqli_query($link, $select2);
         if (mysqli_num_rows($result2) > 0) {
           $rowRange = mysqli_fetch_array($result2);
        }
        if (isset($rowRange['spellrange_desc'])){
           $rowSpell['spellrange_desc'] = $rowRange['spellrange_desc'];
        }else{
            $rowSpell['spellrange_desc'] = "";
        }

							$spellsArrayLevel['spells'][] = $rowSpell;
      }
					

    }

				if ( sizeof($spellsArrayLevel)>0) {
					$spellsArray['levels'][] = $spellsArrayLevel;
				}

    $spell_level = $spell_level +1;

  }
		return $spellsArray;
}

function formatNPCKnownSpellsByClassLevel($NPCDataArray, $classNumber) { 
	$resultText = "";
	
	$spellsArray = getSpellsArrayByClassLevel($NPCDataArray, $classNumber);
		
  $resultText .= wrapHTMLDGBlock(wrapHTMLLineHeader("CL ".$spellsArray['class']['class_spell_level']." Concentration ".$spellsArray['class']['conc']), "dgNPCSpellLevelHeader");

		foreach($spellsArray['levels'] as $spellArrayLevel) {
/*
if ( !isset($spellArrayLevel['level'] )) {
var_dump($spellArrayLevel);
}*/
			$spell_level = $spellArrayLevel['level']['spell_level'];

			$stat_bonus = $spellArrayLevel['level']['stat_bonus'];
			$max_level = $spellArrayLevel['level']['max_level'];

			$spellLevelText = formatSpellLevelText($NPCDataArray, $classNumber, $spell_level, $stat_bonus, $max_level);

			$spells = $spellArrayLevel['spells'];
	
				foreach ($spells as $spell) {
							extract($spell);
	        $spellNameText = $spell_name. "(" . $spell_school. ")" . "[" . $spell_type1 . " " . $spell_type2 . " " . $spell_type3 . " " . $spell_type4 . "]" .
	                " X " . $spellt_count;
	
	        $spellBasics = $spell_comp . " rng: " . $spell_range . " " . $spellrange_desc . " CT:" . $spell_cast_time . " Dur: " . $spell_duration  ;
	        $spellAdd =  "SV ". $spell_save . " Area: " . $spell_area .  " Book: $spell_book";
								$psiPP = "";
								$spellDesc = "";
	
	        if ($spell_psi_power_pts > 0 and !empty($NPCDataArray['psi']) && $NPCDataArray['psi'] == "Y"){
	 				 	      $psiPP = " Power Points " . $spell_psi_power_pts;
	        }
	
	        if (!empty($spell_desc)  and $spell_desc != "-"){
											$spellDesc = " Description: " . $spell_desc;
	        }
	
								$spellText = wrapHTMLDGBlock($spellNameText, "dgNPCSpellName");
								$spellText .= wrapHTMLDGBlock($spellBasics, "dgNPCSpellBasics");
								$spellText .= wrapHTMLDGBlock($spellAdd, "dgNPCSpellAdditional");
								$spellText .= wrapHTMLDGBlock($psiPP, "dgNPCPsiPoints");
								$spellText .=	 wrapHTMLDGBlock($spellDesc, "dgNPCspellDescription");
	
								$resultText .= wrapHTMLDGBlock($spellText, "dgNPCSpellKnown");
	  }
		}

  return $resultText;
}



/*

TEST - Needs testing

*/
function formatNPCSpellsKnown($NPCDataArray) {
	$result = "";

	$spells = getSpellsKnown($NPCDataArray);

	if ( !empty( $spells )) {
	  $result .= wrapHTMLDGBlock(wrapHTMLLineHeader("Spells Known: "));
		if ($NPCDataArray['psi_pts'] > 0){
		   $result .= wrapHTMLDGBlock("Power Points " . $NPCDataArray['psi_pts']);
		}
		$result .= $spells;
	}

	return $result;

}

function formatStatBonus($NPCDataArray, $stat){
   $result = "";
   $stat_v = "mon_" . $stat;
   $stat_m_v = "mon_" . $stat . "_m";
   if (!empty($NPCDataArray[$stat_v]) ) {
      if (!empty($NPCDataArray[$stat_m_v]) && $NPCDataArrat[$stat_m_v] !== 0 ) {
        $total = $NPCDataArray[$stat_v]  + $NPCDataArray[$stat_m_v];
							if ( $NPCDataArray[$stat_m_v] > 0) {
         $result = " + ";
      		} else if ($NPCDataArray[$stat_m_v] < 0){
         $result = " ";
							}
					 		$result .= $NPCDataArray[$stat_m_v] . " = " . $total;
      }
   }
   return $result;
}

/* 

BUG / Test - All stat bonuses are comming out as zero in NPCDataArray. Probable bug in monser generation

*/
function formatNPCBasicStats($NPCDataArray) {
	$result = "";
	$result .= wrapHTMLLineHeader("Str ") . $NPCDataArray['mon_str'] . formatStatBonus($NPCDataArray,"str") . ", ";
	$result .= wrapHTMLLineHeader("Dex ") . $NPCDataArray['mon_dex'] . formatStatBonus($NPCDataArray,"dex") . ", ";
	$result .= wrapHTMLLineHeader("Con ") . $NPCDataArray['mon_con'] . formatStatBonus($NPCDataArray,"con") . ", ";
	$result .= wrapHTMLLineHeader("Int ") . $NPCDataArray['mon_int'] . formatStatBonus($NPCDataArray,"int") .  ", ";
	$result .= wrapHTMLLineHeader("Wis ") . $NPCDataArray['mon_wis'] . formatStatBonus($NPCDataArray,"wis"). ", ";
	$result .= wrapHTMLLineHeader("Cha ") . $NPCDataArray['mon_chr'] . formatStatBonus($NPCDataArray,"chr") ;	
	return $result;
}


function formatNPCBaseAttack($NPCDataArray) {
	$result = "";
	
		$result  .= wrapHTMLLineHeader("Base Attack") ." ". $NPCDataArray['base_attack'];

// ;(".wrapHTMLLineHeader("grapple"). " $base_grapple) $print_CMB  ;".wrapHTMLLineHeader("CMD")." $base_cmd $print_CMD " ;
		
		if (!empty($NPCDataArray['key_1']) && $NPCDataArray['key_1'] == "path"){
				$result .= wrapHTMLLineHeader(" CMB "). $NPCDataArray['base_cmb']." ";

		  if ($NPCDataArray['base_cmb'] != $NPCDataArray['base_grapple']){
		      $result .= " ;(".wrapHTMLLineHeader("grapple"). " ".$NPCDataArray['base_grapple']. " ";
		  }

				$result .= $NPCDataArray['print_CMB'] ;
				$result .= "; ".wrapHTMLLineHeader("CMD")." ".$NPCDataArray['base_cmd']." ".$NPCDataArray['print_CMD'];
		}else{
		  $result  .= " Grapple " . $NPCDataArray['base_grapple'];
				$result  .=  " ".$NPCDataArray['print_CMB']." ".$NPCDataArray['print_CMD']."  ";
		}
	return $result;
}


function formatNPCFeats($NPCDataArray) {
	$result = "";

	$result .= wrapHTMLDGBlock(wrapHTMLLineHeader("Feats"));
	$resultFeats = "";
	
	$featsArray = getFeatArray($NPCDataArray);

	foreach( $featsArray as $classFeats) {
		$resultFeatsClass = "";
		foreach ($classFeats as $feat) {
			$featText = $feat['feat'];
			if ( !empty($feat['feat_desc']) ) {
					$featText .= " : ".$feat['feat_desc'];
			}
			$resultFeatsClass .= wrapHTMLDGBlock($featText, "dgNPCFeat");
		}
		$resultFeats .= wrapHTMLDGBlock($resultFeatsClass, "dgNPCFeatsClass");
	}
	$result .= wrapHTMLDGBlock($resultFeats, "dgNPCFeatsList");	

	
	return $result;
}

function formatNPCSkills($NPCDataArray) {
	$result = "";
	$skillArray = 	getSkillArray($NPCDataArray);

	$result .= wrapHTMLDGBlock(wrapHTMLLineHeader("Skills ") ) ;

	foreach($skillArray as $skillArrayEntry) {
		$result .= $skillArrayEntry['skill'];
		$result .= " ".$skillArrayEntry['mod'];
		if (isset($skillArrayEntry['skillText'])) {
				$result .= " ".$skillArrayEntry['skillText'];
		}
		$result .= ", "; 

	}
	if (substr($result, -2) == ', ' ) {
		$result = substr($result,0, sizeof($result)-2);
	}


	return $result;
}

function formatNPCLanguages($NPCDataArray) {
	$result = "";

	$result .= wrapHTMLLineHeader("Languages ") . $NPCDataArray['monlang1'];
	$count = 1;
	while ($count < 6){
	  $count += 1;
	  $monlang_r = "monlang" . $count;
	  if (!empty($NPCDataArray[$monlang_r]) ){
					$result .= ", ".$NPCDataArray[$monlang_r];	
	  }
	}

	return $result;

}

function getNPCOrganisation($NPCDataArray) {
		$resultText = "";

		$key_1 = "path";	
  if ($NPCDataArray['key_1'] == ""){
     $key_1 = "dd35";
  }
  $link = getDBLink();
  $select = "select monorg_id, monorg_min, monorg_max from monorg2 where " .
            "mon_name = '".$NPCDataArray['mon_name'] ."' and mon_key_1 = '$key_1' order by monorg_min" ;
  $result = mysqli_query($link, $select);

  $count = 0;
  while ($row = mysqli_fetch_array($result)){
     $count += 1;
     if ($count > 1){
        $resultText .= ", ";
     }
     $org_id = $row['monorg_id'];
     $org_min = $row['monorg_min'];
     $org_max = $row['monorg_max'];
     if ($org_min != $org_max and ($org_min != "1" or $org_min != "2")){
       $resultText  .= $org_id . " " . $org_min . "-" . $org_max;
     }else{
       $resultText  .= $org_id;
     }
  }

	return $resultText;
}

function getNPCTreasureType($NPCDataArray){
		$resultText = "";
	
		$key_1 = "path";
  if (empty($NPCDataArray['key_1'])){
     $key_1 = "dd35";
  }
  $link = getDBLink();
 
  $select = "select montreas_tp, montreas_mult from montreas2 where " .
        "mon_name = '".$NPCDataArray['mon_name']."' and mon_key_1 = '$key_1'";
  $result = mysqli_query($link, $select);

  $count = 0;
  while ($row = mysqli_fetch_array($result)){
     $treas_tp = $row['montreas_tp'];
     $treas_mult = $row['montreas_mult'];
     $count += 1;
     if ($count > 1){
        $resultText .= ", ";
     }
     $resultText .= $treas_tp;
     if ($treas_mult != "1" and $treas_mult != "0"){
        $resultText .= " x " . $resultText;
     }
  }

	return $resultText;
}



function formatNPCEnvironment($NPCDataArray) {
	$result = "";
	$result .= wrapHTMLLineHeader("Environment ") . $NPCDataArray['mon_environment'] ;

	return $result;
}

function formatNPCOrganisation($NPCDataArray) {
	$result = "";
	$result .= wrapHTMLLineHeader("Organization ") . getNPCOrganisation($NPCDataArray);

	return $result;
}

function formatNPCTreasureType($NPCDataArray) {
	$result = "";
	$result	.= wrapHTMLLineHeader("Treasure ") . getNPCTreasureType($NPCDataArray) ;

	return $result;
}

function formatNPCDC( $dcValue , $extraClass = "") {
		$result = wrapHTMLSpan("DC (".$dcValue.") ", "dgNPCAbilityDC ".$extraClass);						
		return $result;
}

function formatNPCSpecialAbilities($NPCDataArray) {
	$result = "";

		$specialQualitiesArray = 	unserialize(base64_decode(urldecode(	$NPCDataArray['specialAbilitiesArray'])));
/*
var_dump($specialQualitiesArray);
*/
	if (!empty($specialQualitiesArray['other'])) {
		foreach ($specialQualitiesArray['other'] as $key => $line) {
				$text = wrapHTMLLineHeader(wrapHTMLSpan($line['monspec_name'],"dgNPCSpecialQualityName"));
				if ( !empty($line['dc']) || !empty($line['monspec_value'])) {	
					$text .= " : ";
				}
				if ( !empty($line['dc'] )) {
						$text .= formatNPCDC($line['dc'], "dgNPCSpecialQualityDC");						
				}
				$text .= wrapHTMLSpan($line['monspec_value'],"dgSpecialQualityValue");

			$result .= wrapHTMLDGBlock($text, "dgNPCSpecialQualitiy");
		}
	}
	return $result;		
}

function formatNPCSpecialDescription($NPCDataArray) {
	$result = "";

	if ( !empty($NPCDataArray['$print_specdesc'])) {
		$result .= $print_specdesc;
	} 

	return $result;

}

function formatNPCBuffingPrecast($NPCDataArray) {
		$result = "";
		
	if ( !empty($NPCDataArray['htmlp_buff'])) {		
     $htmlp .=  wrapHTMLDGBlock(wrapHTMLLineHeader("Buffing spells pre-cast:"));
				 $htmlp .= wrapHTMLDGBlock($NPCDataArray['htmlp_buff'],"dgNPCSpellsPreBuff");
 }

	return $result;
}

/*   *******   SHITTY CODE  AHEAD   *******  */
/*  The printMagic function sets globals!!!! for the magic_html_print and others */
//$print .= printMagic();

//$htmlp .= wrapHTMLDGBlock(urlencode($magic_html_print), "dgMagicPrint");

$magicItems = getMagicItems();


$htmlp .= "  MAGIC ITEMS HERE !!!!! ";
$htmlp .= var_export($magicItems,1);

$htmlp .= wrapHTMLDGBlock(wrapHTMLLineHeader("Magic Items (Max Value = ".$magicItems['Max Value']));

foreach ($magicItems as $magicType) {

	$htmlpSuperBlock = "";

	foreach ($magicType as $magicItem) {
		if ( isset($magicItem['magic_item'])) {
	
		 $htmlpBlock = "";
			$htmlpBlock .= wrapHTMLLineHeader($magicItem['magic_item'],"dgMagicItemName");	
		
			if (isset($magicItem['magic_desc'] ) ) {
					$htmlpBlock .= wrapHTMLLineHeader($magicItem['magic_desc'],"dgMagicItemDescription");	
			}
			$htmlpSuperBlock .= wrapHTMLDGBlock($htmlpBlock);
				
		}
		if ( isset($htmlpSuperBlock)) {
			$htmlp .= wrapHTMLDGBlock($htmlpSuperBlock,"dgMagicItemType");

		}

	}

}


$htmlp .= wrapHTMLDGBlock(wrapHTMLLineHeader("Total Value = ".$magicItems['Total Value']));


return; /* <---- */


$update  = "UPDATE lastmon SET lastmon_mon_name = '$mon_name', lastmon_class1_tp = '$class1_tp', lastmon_class1_level = '$class1_level', " .
      "lastmon_class1_focus = '$class1_focus', lastmon_class2_tp = '$class2_tp', lastmon_class2_level = '$class2_level', lastmon_class2_focus = '$class2_focus', " .
      "lastmon_text = '$print'  WHERE lastmon_count = '$oldmon_key'";
$link = getDBLink();
$result3 = mysqli_query($link, $update) ;
$_SESSION['sprint'] = $print;
$local =  $_SERVER['SERVER_NAME'];
//  <-- CT 29/11/08
$local .= dirname($_SERVER['PHP_SELF'] ); 		// Append the current path
//  END -->
if ($local == "paulds-1.vm.bytemark.co.uk"){
   $location = 'http://' . $local . '/dddismon.php';
}else{
   $location =  'http://' . $local . '/dddismon.php';
}
?>
<?php
?>
<?php
//echo $_SERVER['HTTP_USER_AGENT'];
//if (eregi("MSIE",$_SERVER['HTTP_USER_AGENT'])) {
  $location = "javascript:history.go(-1)";
//}else{
  $location = "javascript:history.go(-1)";
//}


?>
<!-- pathdisMonsterPrint monsterPlainText  -->
<div class="monsterPlainText">
<div class="monsterPlainTextStats">

<?php  echo $htmlp ?>

<div class="monsterPlainTextNotes">
<p>
<b>Descriptions/Notes</b>
</p>
<?php
$line_count = 0;
$save_len = strlen($savemon_desc);
$line_len = round(($save_len / 60),0);
$lines = stripos($savemon_desc,"\n") ;
$desc = $savemon_desc;
while ($lines > 0 and $lines == TRUE){
   $line_count +=1;
   $desc = substr($desc, ($lines + 1), $save_len);
   $lines = stripos($desc,"\n");
}
// echo "lines $line_count $line_len" ;
$rows = $line_count + $line_len + 1;
?>
<TEXTAREA NAME="savemon_desc" class="desc" ROWS="<?php echo $rows?>" COLS="60" readonly><?php echo $savemon_desc ?> </TEXTAREA>
</div>

<!-- pathdisMonster - monsterPlainTextStats END -->
</div>

<?php
if (!isset($print_indx)){
    $print_indx = "";
}
?>

<div class="monsterPlainTextOptions">
        <INPUT TYPE="hidden" NAME="print", VALUE="<?php echo $print?>"/>
        <INPUT TYPE="hidden" NAME="mon_print", VALUE="<?php echo $print?>"/>
        <INPUT TYPE="hidden" NAME="print_indx", VALUE="<?php echo $print_indx?>"/>
				<INPUT class="button noPrint" TYPE="button" VALUE="Return" onClick="location.href='<?php echo $location?>'"/>
</div>

</div>
<!-- pathdisMonsterPrint monsterPlainText END -->