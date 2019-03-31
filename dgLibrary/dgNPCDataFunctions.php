<?php
/*

dgNPCDataFunctions 	-			Passing & managing NPC related data

*/


/*
			Check the current NPC data is valid - NOTE - Does not change NPC data. Only checks it an updates META
*/
function vetNPC($dgTools) {
		$npcNo = getCurrentNPCNo($dgTools);

		if ($dgTools['NPCsArray'][$npcNo]['mon_name'] == "") {
				$dgTools = addMSG($dgTools, array("selector" => "#mon_name","msg" => "Please select a species"));
		}

		/* Check Classes */
		$classes = $dgTools['NPCsArray'][$npcNo]['classes'];
		$hasClass = 0;
		$classCount = 1;
		foreach ($classes as $class) {
				$dgTools = validateClass($dgTools, $class, $classCount);
				$classCount++;
				if (!empty($class['class_tp']) && $class['class_tp']!==" " ) {
						$hasClass = 1;
				}
		}

		/* Check if its a template that there is one class */
  if ($hasClass === 0){
				/* No Class, but are we a zero dice template? */
					$dice = getMonsterTemplateHD($dgTools);
					if ( $dice === 0 ) {
							$dgTools = addMSG($dgTools, array("selector" => "#class_tp_1, #classlevel_1, #classfocus_1","msg" => "This Monster requires a class and level as it is only a template (it is set up with 0 hit die)"));
					}
    }

			/* Check if prestige class is valid */
    if ($dgTools['NPCsArray'][$npcNo]['classes'][3]['class_tp'] != ""){
      $total_level = 0;
						$total_level += intval($dgTools['NPCsArray'][$npcNo]['classes'][1]['classlevel']);
						$total_level += intval($dgTools['NPCsArray'][$npcNo]['classes'][2]['classlevel']);
						$total_level += $dgTools['NPCsArray'][$npcNo]['mon_hd_original'];
      if ($total_level < 5){
							$dgTools = addMSG($dgTools, array("selector" => "#class_tp_3","msg" => "Must have at least 5 levels and/or hit die to select a prestige class"));
      }
    }

				/* Check Templates */
				$templates =  $dgTools['NPCsArray'][$npcNo]['mon_templates'];
    if ($templates[1] == $templates[2] && $templates[1] != ""){
							$dgTools = addMSG($dgTools, array("selector" => "#class_tp_2", "msg" => "Second template must be different to the first template"));
    }

			/* No idea what this does ??? */
    if ($dgTools['NPCsArray'][$npcNo]['classes'][1]['class_tp'] !=""){
        $dgTools['NPCsArray'][$npcNo]['focus1'] = "focus1v";
    }else{
        $dgTools['NPCsArray'][$npcNo]['focus1'] = "focus1";
    }
    if ($dgTools['NPCsArray'][$npcNo]['classes'][2]['class_tp'] !=""){
        $dgTools['NPCsArray'][$npcNo]['focus1'] = "focus1v";
    }else{
        $dgTools['NPCsArray'][$npcNo]['focus1'] = "focus1";
    }
    if ($dgTools['NPCsArray'][$npcNo]['classes'][3]['class_tp'] !=""){
        $dgTools['NPCsArray'][$npcNo]['focus1'] = "focus1v";
    }else{
        $dgTools['NPCsArray'][$npcNo]['focus1'] = "focus1";
    }


/*
			STILL NEEDED ??????????  <-------- 
	
      $_SESSION['smon_name'] = $mon_name;
      $_SESSION['sclass1_tp'] = $class_tp_1;
      $_SESSION['sclass1_level'] = $classLevel_1;
      $_SESSION['sclass1_focus'] = $classFocus_1;
      $_SESSION['sclass1_domain1'] = $domain_11;
      $_SESSION['sclass1_domain2'] = $domain_12;
      $_SESSION['sclass2_tp'] = $class_tp_2;
      $_SESSION['sclass2_level'] = $classLevel_2;
      $_SESSION['sclass2_focus'] = $classFocus_2;
      $_SESSION['sclass2_domain1'] = $domain_21;
      $_SESSION['sclass2_domain2'] = $domain_22;

      $_SESSION['suser'] = $user_id;
 //     echo "user" . $user;
      $_SESSION['snew'] = "YES";
      $_SESSION['selite'] = $elite;
      $_SESSION['smon_template'] = $mon_tem;
  //    echo "mon_tem " . $mon_tem;
       $_SESSION['smon_template2'] = $mon_tem2;
      $_SESSION['ssavemon_key'] = $savemon_key;
//      echo "function user_id " . $user_id;

*/

			if ( $dgTools['meta']['msg'] == MSG_ALL_OK ) {

      $select = "SELECT count_new, count_old, count_oldmon_key from count where count_key = 'KEY'";
      $link = getDBLink();
      $result = mysqli_query($link, $select) ;
      $row = mysqli_fetch_array($result);
      $count_new = $row['count_new'];
      $count_old = $row['count_old'];
      $count_oldmon_key = $row['count_oldmon_key'];
      $count_oldmon_key = $count_oldmon_key + 1;
      if (isset($count_new_x)){
      }else{
          $count_new_x = "";
      }
      if ($count_oldmon_key > 9){
         $count_oldmon_key = 0;
      }
      if ($count_new_x == 1){
        $count_new = $count_new + 1;
      }else{
        $count_old = $count_old + 1;
      }
      $update  = "UPDATE count SET count_new = '$count_new', count_old = '$count_old', count_oldmon_key = '$count_oldmon_key' WHERE " .
                      "count_key = 'KEY'";
      $result3 = mysqli_query($link, $update) ;
/*  
 ?????

      $_SESSION['soldmon_key'] = $count_oldmon_key;
      global $save_count;

*/
      $save_count = $count_new +  $count_old;

					$dgTools['NPCsArray'][$npcNo]['save_count'] = $save_count;

    }

		return $dgTools;
}
/* 
		Check class data
*/
function validateClass($dgTools, $class, $classNo) {

		if ( empty($class['class_tp']) && empty($class['classlevel'])  && empty($class['classfocus']) ) {
				/* Empty. No Action needed */
		} else {
			if ($class['class_tp'] == "" ) {
					$dgTools = addMSG($dgTools, array("selector" => "#class_tp_".$classNo,"msg" => "Class ".$classNo." is missing a class."));
			}
			if ($class['classlevel'] == "" ) {
					$dgTools = addMSG($dgTools, array("selector" => "#classlevel_".$classNo,"msg" => "Class ".$classNo." is missing a level."));
			}
			if ($class['classfocus'] == "" ) {
					$dgTools = addMSG($dgTools, array("selector" => "#classfocus_".$classNo,"msg" => "Class ".$classNo." is missing a focus."));
			}
	
			

    if ($class['class_tp'] == "Cleric" && 
						( $class['domain'][1] == $class['domain'][2] || $class['domain'][1] == "" || $class['domain'][2] == "" ) ) {
						$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."2","msg" => "Cleric: Must have two different domains"));
    }

    if ($class['class_tp'] == "Wizard"){
      if ($class['domain'][1] ==  "" && ($class['domain'][2] != "" || $class['domain'][3] !="")){
								$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."3","msg" => "Wizard: Only select prohibited school when when you select a specialized school"));
						}
      if ($class['domain'][1] !=  "" && $class['domain'][1] !=  "Universal" && $class['domain'][2] == "" ) {
								$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."2","msg" => "Wizard: If Specializing then must enter a Prohibited school"));
					}
					/* Slightly different handling for Universal or Divinaton */
					if ($class['domain'][1] ==  "Universal" || ( $dgTools['meta']['key_1'] == DD35 && $class['domain'][1] ==  "Divination" ) ) { 
		      if ($class['domain'][1] ==  "Universal" && ( $class['domain'][2] == "" || $class['domain'][3] == "") ) {
										$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."2","msg" => "Wizard: Universal Wizards do not need a prohibited school"));
							}
					
							if ( $dgTools['meta']['key_1'] == DD35 && $class['domain'][1] ==  "Divination" ) {
		     			if ( $class['domain'][2] != "" && $class['domain'][3] != "")  {
											$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."3","msg" => "Wizard: Divination only requires one prohibited school"));
									}
							}
					} else {
	      if ($class['domain'][1] !=  "" ){
	      			if ($class['domain'][2] == "" ){
											$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."2","msg" => "Wizard: Two prohibited schools required"));
									} else if ($class['domain'][3] =="") {
											$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."3","msg" => "Wizard: Two prohibited schools required"));
									}
	      }
	      if ($class['domain'][1] !=  "" && 
									($class['domain'][1] == $class['domain'][2] || 
										$class['domain'][1] == $class['domain'][3]  ||
										$class['domain'][2] == $class['domain'][3] ))  {
										$dgTools = addMSG($dgTools, array("selector" => '#domain_'.$classNo.'2, #domain_'.$classNo.'3',"msg" => "Wizard: Specialised and prohibited schools must all be different"));
							}
    		}
			}
   if ($class['class_tp'] == "Psion"){
	  			if ($class['domain'][1] == "") {
							$dgTools = addMSG($dgTools, array("selector" => "#domain_".$classNo."1]","msg" => "Psion: Must select a Psionic Discipline") );
    		}
			}
	}

	return $dgTools;
}


/* 
		Queries the database and returns the number of HD on the monster template
*/
function getMonsterTemplateHD($dgTools) {

		$select = "SELECT mon_hd from monster2 where mon_name = '".
						$dgTools['NPCsArray'][getCurrentNPCNo($dgTools)]['mon_name']."' and (mon_key_1 = '".
						$dgTools['meta']['wp_user']."' or mon_key_1 ='".
						$dgTools['meta']['key_1']."') ";
		$link = getDBLink();
		$result = mysqli_query($link, $select) ;
  $row = mysqli_fetch_array($result);
  $hitdice = trim($row['mon_hd']) ;		$dice = 0;
		$dPos = stripos($hitdice,"D");
		if ($dPos == FALSE){
  				$dice = intval(substr($hitdice,0,1));
		}else{
					$dice = intval(substr($hitdice,0,$dPos));
		}
		return $dice;
}

/* Returns array of saved NPCs */
function getUserSavedNPCS($dgTools, $max = NULL) {


		$table = "savemon";
/*		$fieldList = array("savemon_key", "savemon_monster",
													"savemon_mon_name", "savemon_class1_tp", "savemon_class2_tp",
													"savemon_mon_temp", "savemon_class1_focus", "savemon_class2_focus",
													"savemon_class1_level", "savemon_class2_level", "savemon_name", 
													"savemon_camp", "savemon_sub", "savemon_cr", "savemon_date");
*/		
		$fieldList = "*";
		$orderby = "savemon_date2 DESC";

		$wp_user = $dgTools['meta']['wp_user'];
		$user_id = $dgTools['meta']['user_id'];
		$where = NULL;

		$where_a = NULL;

		if ( !empty($user_id)) {
				$where_a = "savemon_user = '".$user_id."'";
		}

		$where_b = NULL;

		if ( !empty($save_user)) {
				$where_b = "savemon_wp_user = '".$wp_user."'";
		}


		if ( !$where_a || !$where_b ) {
				/* Only run SQL if we have a valid WHERE clause otherwise 100,000 monsters will be returned */
				if ( $where_a && $where_b ) {
						$where = $where_a." OR ".$where_b;
				} else if ( $where_a) {
						$where = $where_a;
				} else {
						$where = $where_b;
				}

		}

		if (isset($max) ) {
				$limit = "limit ".$max;
		} else {
				$limit = NULL;
		}


/* DEBUG ONLY */
$where = NULL;
/* END DEBUG ONLY */

		$result = runSQLSelect($table, $fieldList, $where, $orderby, NULL, $limit);	

		return $result;
}


/* Load default  monster / class data */
function makeNPC($dgTools) {

		$npcNo = getCurrentNPCNo($dgTools);

		/* Load base monster data */
		$mon_name = $dgTools['NPCsArray'][$npcNo]['mon_name'];
		$mon_type = $dgTools['NPCsArray'][$npcNo]['mon_type'];
		$key_1 = $dgTools['meta']['key_1'];

		if (empty($mon_type) ) {
				$mon_type = getMonsterType($mon_name, $key_1);
		} 

		$baseMonster = loadMonsterBase($mon_name, NULL, 
										$dgTools['meta']['wp_user'], $dgTools['meta']['key_1']);

		/* Merge base monsters with details (like class / levels) passed from the select form */
		$baseMonster = array_merge($baseMonster, $dgTools['NPCsArray'][$npcNo]);

		$dgTools['NPCsArray'][$npcNo] = $baseMonster;

		$dgTools = generateNPC($dgTools, $npcNo);

		return $dgTools;

}


/*
		Loads a saved NPC based on the load_savemon value of the current NPC
*/
function loadNPC($dgTools) {

		$savemon_key = $dgTools['NPCsArray'][getCurrentNPCNo($dgTools)]['load_savemon'];

		if ( !$savemon_key) {
				/* This should not happen */				
				error_log("dgNPCDataFunctions/loadNPC : No savemon_key passed in dgTools");
				die("dgNPCDataFunctions/loadNPC : No savemon_key passed in dgTools");
		}

		$table = "savemon";
		$fieldList = "*";
		$orderby = NULL;
		$where = "savemon_key = '".$savemon_key."'";

		$savemonResults = runSQLSelect($table, $fieldList, $where, $orderby);	

		if (!$savemonResults|| sizeof($savemonResults) !== 1 ) {
				/* This should not happen */				
				error_log("dgNPCDataFunctions/loadNPC : No record found or multiple records found");
				die("dgNPCDataFunctions/loadNPC : No record found or multiple records found");			
		}

		$savemon = 	$savemonResults[0];
	
		/*  DEBUG CODE ----- REMOVE FROM LIVE SYSTEM */
//		error_log("dgUtilityDataFunctions/mergeSavemonDGTools - Pre-merge data dump - DGTools");
//		error_log(var_export($dgTools,1));		
//		error_log("dgUtilityDataFunctions/mergeSavemonDGTools - Pre-merge data dump - flatArray");
//		error_log(var_export($savemon,1));		
		/*   DEBUG CODE ----- END */

		$npcNo = getCurrentNPCNo($dgTools);

		/* Get the 	data needed to load the base monster */
		$savemon_mon_name= $savemon['savemon_mon_name'];
		$savemon_mon_type = $savemon['savemon_mon_type'];

		/* Load base monster data */
		$baseMonster = loadMonsterBase($savemon_mon_name, $savemon_mon_type, 
										$dgTools['meta']['wp_user'], $dgTools['meta']['key_1']);

		$dgTools['NPCsArray'][$npcNo] = $baseMonster;

		/* Extract the saved data from the big savemonster field */		
		$dgTools = processSavemonMonster($dgTools, $savemon['savemon_monster']);

		$dgTools = generateNPC($dgTools, $npcNo);

		return $dgTools;
}


/* Generate NPC - Once basic monster created or loaded from saved data,
this handles all the rest */
function generateNPC($dgTools, $npcNo) {

		$dgTools = loadClassDetails($dgTools, $npcNo);

		$dgTools = calcHitDiceAndLevels($dgTools, $npcNo);

		$dgTools = loadMonsterSpecialAbilities($dgTools, $npcNo);

		$dgTools = loadFeats($dgTools, $npcNo);

		$dgTools = loadBuffs($dgTools, $npcNo);

		$dgTools = loadClassSpecialAbilities($dgTools, $npcNo);

		$dgTools = calcSkills($dgTools, $npcNo);

		$dgTools = calcSpellLists($dgTools, $npcNo);

		return $dgTools;
}



/*
			
		Handle the savemon_monster (Original format) field containing the bulk of the monsters' data 
*/
function processSavemonMonster($dgTools, $savemon_monster) {

		$npcNo = getCurrentNPCNo($dgTools);

		/* Set up arrays of valid variables */

		$skills = array("bluff", "climb", "concentration", "diplomacy", "disguise", 
				"gather_information", "handle_animal", "hide", "intimidate", 
				"jump", "know_arcana", "know_arch", "know_dungeon", "know_the_planes", "know_geography",
				"know_history", "know_local", "know_nature", "know_nobility", "know_religion",
				"linguistics", "listen", "profession",  
				"move_silently", "perform", "perform_dance", "perform_oratory",
				"perception", "ride", "search", "sense_motive", "spot", "spellcraft",
					"survival", "swim");

		/* Big array for most variables built up in chunks to ease development & debugging*/
		$validMisc = array();
		$basics = array(	"mon_name", "mon_size", "mon_hd", "mon_space","mon_reach", 
					"mon_environment", "mon_type", "cr_path", "mon_desc", 
					"cr",  "mon_alignment");
		$validMisc = array_merge($validMisc, $basics);	
		$saved = array("savemon_camp", "savemon_sub", "savemon_temp_type", 
						"savemon_desc", "savemon_temp2_type", "savemon_name");
		$validMisc = array_merge($validMisc, $saved);	
		$psi = array("psi_cmb", "psi_pts", "psidcstr", "psidcint", "psidcdex",
					"psidccon", "psidcwis", "psidcchr");
		$validMisc = array_merge($validMisc, $psi);	
		$other = array("init"	, 
						"total_gp", "total_hps", "elite");	
		$validMisc = array_merge($validMisc, $other);	

		/* Saving Throws */
		$saves = array("total_fort_sv", "total_reflex_sv", "total_will_sv", 
						"mon_sv_fort", "mon_sv_will", "mon_sv_reflex");


		/* Attack related field */
		$combat = array("base_attack", "base_grapple", "base_cmb", "base_cmd","flurry", 
					"flurry_damage", "single_attack", "single_ranged", "full_attack", 
					"ranged_attack", "weap_range_r");

		/* AC related fields */
		$ac = array(	"ac_flat", "ac_touch", "mon_ac_flat", "mon_ac", "mon_armour", 
					"mon_shield", "ac_desc");	

		/* Stats Releated Fields */
		$stats = array("mon_str", "mon_dex",
					"mon_con", "mon_int", "mon_wis", "mon_chr", "mon_str_m", "mon_dex_m",
					"mon_con_m", "mon_int_m", "mon_wis_m", "mon_chr_m", "mon_str_bonus", "mon_dex_bonus",
					"mon_con_bonus", "mon_int_bonus", "mon_wis_bonus", "mon_chr_bonus");	


		/* Ignore fields - these can alwayss be ignored */
		$ignore = array("class_tp_3", "classlevel_3", "classfocus_3", "save_text", "ac_text",
									"sen_text", "init_text", "speed_text", "reach_text", "resist_text", 
									"game", "status", "mon_print");

		/* Extract SAVED data String into array */
		parse_str($savemon_monster,$monster_a);
		/* Clean up special characters */
		foreach ($monster_a as $k => $v) {
				$v = trim($v) ;
				$v = str_replace("Â¨", "+", $v);
				$v = str_replace("|", "'", $v);
				$v = str_replace("#", "&", $v);
		}

		/* Convert saved data into multi-dementional array by matching fields */
		foreach ($monster_a as $key => $value ) {
				$key = trim($key);
				$value = trim($value);

				/* JUNK data */
				if ( strncmp($key,"print", 5) == 0 || strncmp($key,"htmlp", 5) == 0) {
						/* Old junk, just ignore */
						continue;
				}

				/* Ignore */
				$igFlag = NULL;
				foreach ($ignore as $igKey) {
						if (strtolower($key) === $igKey ) {
									/* Junk */
									$igFlag = $key;
						}
				}
				if ( $igFlag ) {
						continue;
				}

				/* Templates */
				if ( strtolower($key) === "mon_temp" || strtolower($key) === "mon_temp2") {
						$tpNo = 1;
						if (strtolower($key) === "mon_temp2") {
								$tpNo = 2;
						}
						$dgTools['NPCsArray'][$npcNo]['mon_templates'][$tpNo] = $value;
						continue;
				}

				/* Classes */
				if ( strncmp($key,"class", 5) == 0 || strncmp($key,"domain", 6) == 0) {
						$classNo = NULL;
						$classKey = NULL;
						$classKeyNo = NULL;
						/* Get which class - its encoded inconsistently */
						if ( strncmp($key,"domain", 6) == 0 ) {
								$classNo = intval(substr($key,-2,1));								
								$classKeyNo = intval(substr($key, -1));
								$classKey = "domains";			
						} else {
								$classNo = intval(substr($key,-1));
								if ( !$classNo ) { 
										$classNo = intval(substr($key,5,1));
								}
						}
						if ( strtolower(substr($key, 7,2)) == "tp" ) {
								$classKey = "class_tp";
						} else if ( strtolower(substr($key,7,5 )) == "focus" ) {
								$classKey = "classfocus";
						} else if ( strtolower(substr($key,7,5 )) == "level" ) {
								$classKey = "classlevel";
						} else if ( strtolower(substr($key,7,4 )) == "spat" ) {
								$classKey = "spat";
						} else if ( strtolower(substr($key,6,11 )) == "spell_level" ) {
								$classKey = "spell_level";
						} else if ( strtolower(substr($key,7,12 )) == "skill_points" ) {
								$classKey = "skill_points";
						} else if ( strtolower(substr($key,7,3 )) == "psi" ) {
								$classKey = "skill_points";
						} else if ( strtolower(substr($key,7,5)) == "spell" ) {
								$classKey = "spells";
								$classKeyNo = intval(substr($key, -1));			
						}

						if ( $classKey ) {
								if ( $classKeyNo ) {
										if ( empty($dgTools['NPCsArray'][$npcNo]['classes'][$classNo][$classKey] ) ) {
												$dgTools['NPCsArray'][$npcNo]['classes'][$classNo][$classKey] = array();
										}
										$dgTools['NPCsArray'][$npcNo]['classes'][$classNo][$classKey][$classKeyNo] = $value;
								} else {
										$dgTools['NPCsArray'][$npcNo]['classes'][$classNo][$classKey] = $value;
								}
						} else {
								error_log("dgUtilityDataFunctions/processSavemonMonster - Unmatched CLASS Key : ".$key." => ".$value);
						}
						continue;
				} 

				/* Attacks */
				if ( strncmp($key,"damage", 6) == 0 || strncmp($key,"crit", 4) == 0 ||
											strncmp($key,"crit_ch", 7) == 0 || strncmp($key,"attack", 6)  == 0 ||
											strncmp($key,"mon_weap", 7) == 0 			) {
						if ( $value === '' ) {
								/* Empty - Ignore */
								continue;
						}

						$statType = NULL;
						if ( strncmp($key,"damage", 6) == 0 ) {
								$statType = "damage";
						} 
						if (strncmp($key,"crit", 4) == 0 ) {
								if ( strncmp($key,"crit_ch", 7) == 0 ) {
										$statType = "crit_ch";
								} else {
										$statType = "crit";
								}
						} 
						if ( strncmp($key,"attack", 6)  == 0 ) { 
								$statType = "attack";
						}
						$pos = strrpos($key,"_");
						if ( strncmp($key,"mon_weap", 7) == 0 ) {
								$statType = "weapon";
						}
						$attackRef = substr($key, $pos+1);

						/* Set Up Attacks array if needed */
						if ( empty($dgTools['NPCsArray'][$npcNo]['attacks'])) {
								$dgTools['NPCsArray'][$npcNo]['attacks'] = array();
						}
						
						/* Grab a reference to the attacks array for convience */
						$attacks =& $dgTools['NPCsArray'][$npcNo]['attacks'];

						/* Work out which part of the attacks array this info belongs in.
								Old DG data format only allowed one primary attack and one ranged weapon.
								Use 'p' for key to primary record, 'r' for key to range. Standard attacks
								just use the attack number */
						$attType = NULL;
						$attNo = NULL;
						switch ($attackRef) {
								case 'p':
										$attType = "primary";
										$attNo = 'p'; 
										break;
								case 'r':
										$attType = "range";
										$attNo = 'r';
										break;
								default:
										if (substr($attackRef,0,1) == 's') {
												$attType = "standard";
												$attNo = intval(substr($attackRef,1));
										}
										break;
						} 

						if ( $attNo == NULL || $attType == NULL || $statType == NULL ) {
									/* This should never happen */
								error_log("dgUtilityDataFunctions/processSavemonMonster - Unmatched ATTACK Key : ".$key." => ".$value. " ---- ".$attType." / ".$attNo." / ".$statType);
						} else {
								if ( empty($attacks[$attNo]) || !is_array($attacks[$attNo])) {
										/* New attack */
										$attacks[$attNo] = array("type" => $attType);
								} 

								/* Clean up the value for Damage which seems to have encoded characters */
								if ( $statType == 'damage') {
										$dPos = stripos($value, "d");
										$endDPos = NULL;
										if ( $dPos != FALSE && $dPos > 0 ) {
												if ( substr($value, $dPos+1, 1) == '4' || substr($value, $dPos+1, 1) == '6'
															|| substr($value, $dPos+1, 1) == '8' ) {
															/* d4 / d6 / d8 */ 
															$endDPos = $dPos + 2;													
												} else if ( substr($value, $dPos+1, 2) == '10' || substr($value, $dPos+1, 2) == '12' ) {
															/* d10 / d12 */
															$endDPos = $dPos + 3;													
												}
												if ( $dPos ) {
														$value = substr($value,0, $endDPos) . "+" . substr($value, $endDPos+1);
												}
										}
								}
								$attacks[$attNo][$statType] = $value;
						}
						continue;
				} 

				/* Attacks / Other - Some attack information is held differently ??? NOT SURE ??? */
				if ( in_array(strtolower($key), $combat) ) {
						$dgTools['NPCsArray'][$npcNo][$key] = $value;
				}

				/* Skills */
				if ( in_array(strtolower($key), $skills) ) {
						if ( empty($dgTools['NPCsArray'][$npcNo]['skills']) ) {
								$dgTools['NPCsArray'][$npcNo]['skills'] = array();
						}
						$dgTools['NPCsArray'][$npcNo]['skills'][$key] = $value;
						continue;
				}

				/* Magic */
				if ( strncmp($key,"magic", 5) == 0 ) {
						$magicType = "desc";
						$pos1 = strpos($key, "_");
						$pos2 = strpos($key, "_", $pos1+1);
						if ( substr($key,$pos2+1,4) == "SPEC" ) {
								$magicType = "special";
							}
						$magicNo = intval(substr($key,-1));
						$magicItem = substr($key,$pos1+1, $pos2-$pos1);

						if ( empty(	$dgTools['NPCsArray'][$npcNo]['magic']) ) {
								$dgTools['NPCsArray'][$npcNo]['magic']	= array();
						}
						if ( empty(	$dgTools['NPCsArray'][$npcNo]['magic'][$magicItem]) ) {
								$dgTools['NPCsArray'][$npcNo]['magic'][$magicItem]	= array();
						}
						if ( empty(	$dgTools['NPCsArray'][$npcNo]['magic'][$magicItem][$magicNo]) ) {
								$dgTools['NPCsArray'][$npcNo]['magic'][$magicItem][$magicNo]	= array();
						}
						$dgTools['NPCsArray'][$npcNo]['magic'][$magicItem][$magicNo][$magicType]	= $value;

						continue;						
				}

				/* Languages */
				if ( strncmp($key,"monlang", 7 ) == 0 ) {
						$langNo = intval(substr($key, -1));
						if ( empty(	$dgTools['NPCsArray'][$npcNo]['languages']) ) {
								$dgTools['NPCsArray'][$npcNo]['languages'] = array();
						}
						$dgTools['NPCsArray'][$npcNo]['languages'][$langNo] = $value;
			
						continue;
				}

				/* Buffs */
				if ( strncmp($key,"buff_spell", 10 ) == 0 ) {
						$buffType = "buff_spell";
						$buffNo = intval(substr($key, -1));
						if ( empty(	$dgTools['NPCsArray'][$npcNo][$buffType]) ) {
								$dgTools['NPCsArray'][$npcNo][$buffType] = array();
						}
						$dgTools['NPCsArray'][$npcNo][$buffType][$buffNo] = $value;
						continue;
				}

				/* Buffx  ???? Not sure what these are */
				if ( strncmp($key,"buffx_level", 11 ) == 0 ) {
						$buffType = "buffx_level";
						$buffNo = intval(substr($key, -1));
						if ( empty(	$dgTools['NPCsArray'][$npcNo][$buffType]) ) {
								$dgTools['NPCsArray'][$npcNo][$buffType] = array();
						}
						$dgTools['NPCsArray'][$npcNo][$buffType][$buffNo] = $value;
						continue;
				}


				/* FEATS -  More work needed ??? Not sure of the data structure */
				if ( strncmp($key,"feat", 4 ) == 0 ) {
						$featType = substr($key, 5);
						if ( empty(	$dgTools['NPCsArray'][$npcNo]["feats"]) ) {
								$dgTools['NPCsArray'][$npcNo]["feats"] = array();
						}
						$dgTools['NPCsArray'][$npcNo]["feats"][$featType] = $value;
						continue;
				}

				/* SPEED */
				if ( strncmp($key, "mon_speed", 9 ) == 0 || strncmp($key, "speed_land", 10) == 0) {
						if ( strncmp($key, "speed_land", 10) == 0) {
								$type = "land";								 
						} else {
								$type = substr($key,10);
						}
						if ( !$type ) {
								$dgTools['NPCsArray'][$npcNo]['mon_speed']['base'] = $value;								
						} else {
								$dgTools['NPCsArray'][$npcNo]['mon_speed'][$type] = $value;								
						}
 						continue;
				} 

				/* AC */
				if ( in_array(strtolower($key), $ac) ) {
						if (	empty($dgTools['NPCsArray'][$npcNo]['ac']) ||
										!is_array($dgTools['NPCsArray'][$npcNo]['ac']) ) {
												$dgTools['NPCsArray'][$npcNo]['ac'] = array();
						}
						if ( substr($key,0, 3) == 'ac_' ) {
								/* Type of AC */
								$acType = substr($key,3);	
						} else {
								/* Junk ?? Not sure - Store it anyway ?? */
								$acType = $key;
						}
						$dgTools['NPCsArray'][$npcNo]['ac'][$acType] = $value;
						continue;
				}

				/* Saves */
				if ( in_array(strtolower($key), $saves) ) {
						if (	empty($dgTools['NPCsArray'][$npcNo]['saves']) ||
										!is_array($dgTools['NPCsArray'][$npcNo]['saves']) ) {
												$dgTools['NPCsArray'][$npcNo]['saves'] = array();
						}
						if ( substr($key,0, 6) == 'total_' ) {
								/* Total saves */
								$saveType = substr($key,6);	
						} else {
								/* Mon_SV_ */
								$saveType = substr($key,7);	
						}
						$dgTools['NPCsArray'][$npcNo]['saves'][$saveType] = $value;
						continue;
				}

				/* Stats */
				if ( in_array(strtolower($key), $stats) ) {
						if (	empty($dgTools['NPCsArray'][$npcNo]['stats']) ||
										!is_array($dgTools['NPCsArray'][$npcNo]['stats']) ) {
												$dgTools['NPCsArray'][$npcNo]['stats'] = array();
						}
						if ( substr($key,0, 4) == 'mon_' ) {
								$statType = substr($key,4);	
								$dgTools['NPCsArray'][$npcNo]['stats'][$statType] = $value;
								continue;
						}
				}



				/* Stats and other misc - Just store them in the array unmodified*/
				if ( in_array(strtolower($key), $validMisc) ) {
						$dgTools['NPCsArray'][$npcNo][$key] = $value;
						continue;
				}	

				/* If we reach this point, it is junk / unwanted data */
				/* DEBUG CODE - REMOVE FOR LIVE */
				error_log("dgUtilityDataFunctions/processSavemonMonster - Unmatched Key : ".$key." => ".$value);
				/*  END DEBUG */
		}


		return $dgTools;

}


/* 
		Loads the default monster stats from the DB and returns in as 'NPCArray' 
*/
function loadMonsterBase($mon_name, $mon_type, $wp_user, $key_1) {

/*
   $select = "SELECT monster2.mon_key_1,mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
                   "mon_init ,mon_speed , mon_speed_fly, mon_speed_climb, mon_speed_swim, mon_speed_burrow, ".
                   "mon_ac_flat , mon_ac ," .
                   "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
                   "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
                   "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
                   "mon_armour, mon_shield, montype_skillp, montype_att, montype_cr, mon_template, mon_alignment, mon_environment, mon_level_adj," .
                   " mon_ac_deflect, mon_ac_insight, mon_ac_profane, mon_ac_dodge, mon_ac_luck, mon_skill_rule ".
                   "from monster2, montype2 where mon_name = '$mon_name' and mon_type = montype and (monster2.mon_key_1 = '$wp_user' or monster2.mon_key_1 = '$key_1')" .
                   " and montype2.mon_key_1 = '$key_1'";
*/
		$table = "monster2, montype2";

		$fieldList = array("monster2.mon_key_1", "mon_name", "mon_size",
															"mon_type", "mon_hd", "mon_hp",
															"mon_init", "mon_speed", "mon_speed_fly", "mon_speed_climb", 
															"mon_speed_swim", "mon_speed_burrow", 
															"mon_ac_flat", "mon_ac",
															"mon_base_att", "mon_full_att", "mon_space", "mon_reach",
															"mon_cr", "mon_str", "mon_dex", "mon_con", "mon_int",
															"mon_wis", "mon_chr", "mon_desc", "mon_sv_fort", "mon_sv_reflex",
															"mon_sv_will",
															"mon_armour", "mon_shield", "montype_skillp", "montype_att",
															"montype_cr", "mon_template", "mon_alignment", "mon_environment",
															"mon_level_adj", "mon_ac_deflect", "mon_ac_insight", "mon_ac_profane", "mon_ac_dodge", 
															"mon_ac_luck", "mon_skill_rule");
		$orderby = NULL;
		$where = "mon_name = '".$mon_name."'";
		$where .= " AND monster2.mon_type = montype2.montype";
		$where .= " AND (monster2.mon_key_1 = '".$wp_user."' OR monster2.mon_key_1 = '".$key_1."')";
		$where .= " AND montype2.mon_key_1 = '".$key_1."'";
		$result = runSQLSelect($table, $fieldList, $where, $orderby);	

		if (!$result || sizeof($result) !== 1 ) {
				/* This should not happen */				
				error_log("dgNPCDataFunctions/loadMonsterBase : No record found or multiple records found");
				die("dgNPCDataFunctions/loadMonsterBase : No record found or multiple records found");			
		}

		$base = $result[0];

		$newNPC = initNewNPC();

		$newNPC['mon_name'] = $base['mon_name'];
		$newNPC['mon_size'] = $base['mon_size'];
		$newNPC['mon_type'] = $base['mon_type'];
		$newNPC['mon_hd'] = $base['mon_hd'];
		$newNPC['mon_hp'] = $base['mon_hp'];
		$newNPC['mon_init'] = $base['mon_init'];
		$newNPC['mon_speed']['base'] = $base['mon_speed'];
		$newNPC['mon_speed']['fly'] = $base['mon_speed_fly'];
		$newNPC['mon_speed']['climb'] = $base['mon_speed_climb'];
		$newNPC['mon_speed']['swim'] = $base['mon_speed_swim'];
		$newNPC['mon_speed']['burrow'] = $base['mon_speed_burrow'];		
		$newNPC['mon_templates'] = array();
		$newNPC['mon_templates'][1] = $base['mon_template'];
		$newNPC['mon_ac'] = array();
		$newNPC['mon_ac']['flat'] = $base['mon_ac_flat'];
		$newNPC['mon_ac']['deflect'] = $base['mon_ac_deflect'];
		$newNPC['mon_ac']['insight'] = $base['mon_ac_insight'];
		$newNPC['mon_ac']['profane'] = $base['mon_ac_profane'];
		$newNPC['mon_ac']['dodge'] = $base['mon_ac_dodge'];
		$newNPC['mon_ac']['luck'] = $base['mon_ac_luck'];
		$newNPC['mon_base_att'] = $base['mon_base_att'];
		$newNPC['mon_full_att'] = $base['mon_full_att'];
		$newNPC['mon_space'] = $base['mon_space'];
		$newNPC['mon_reach'] = $base['mon_reach'];
		$newNPC['mon_cr'] = $base['mon_cr'];
		$newNPC['stats']['str'] = $base['mon_str'];
		$newNPC['stats']['dex'] = $base['mon_dex'];
		$newNPC['stats']['con'] = $base['mon_con'];
		$newNPC['stats']['int'] = $base['mon_int'];
		$newNPC['stats']['wis'] = $base['mon_wis'];
		$newNPC['stats']['chr'] = $base['mon_chr'];
		$newNPC['mon_desc'] = $base['mon_desc'];
		$newNPC['saves']['sv_fort'] = $base['mon_sv_fort'];
		$newNPC['saves']['sv_reflex'] = $base['mon_sv_reflex'];
		$newNPC['saves']['sv_will'] = $base['mon_sv_will'];
		$newNPC['mon_armour'] = $base['mon_armour'];
		$newNPC['mon_shield'] = $base['mon_shield'];
		$newNPC['montype_skillp'] = $base['montype_skillp'];
		$newNPC['montype_att'] = $base['montype_att'];
		$newNPC['montype_cr'] = $base['montype_cr'];
		$newNPC['mon_alignment'] = $base['mon_alignment'];
		$newNPC['mon_environment'] = $base['mon_environment'];
		$newNPC['mon_level_adj'] = $base['mon_level_adj'];
		$newNPC['mon_skill_rule'] = $base['mon_skill_rule'];


		return $newNPC;

}

function loadMonsterSpecialAbilities($dgTools, $npcNo) {

		/* Load Special Abilities */

/*
  $select = "SELECT monspec_name, monspec_value, specatta_abil, specatta_save, specatta_type from monspec2, specatta where monspec_tp = 'A' and (mon_name = '$mon_namex' or mon_name = '$mon_temp' or mon_name = '$mon_temp2')" .
            "and monspec_name = speca_name and (mon_key_1 = '$wp_user' or  mon_key_1 = '$key_1')" .
            " and ((monspec_min = 0 and monspec_max = 0) or (monspec_min = '' and monspec_max = '') or (monspec_min <= '$total_level' and monspec_max = 0)" .
            "or (monspec_min <= '$total_level' and monspec_max >= '$total_level')  ) order by monspec_name";
*/

		$wp_user = $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];
		$total_level = $dgTools['NPCsArray'][$npcNo]['total_level'];

		$mon_namex = $dgTools['NPCsArray'][$npcNo]['mon_name'];

		$table = "monspec2";

/*
		$fieldList = array("monspec_name", "monspec_value", "specatta_abil", 
										"specatta_save", "specatta_type");
*/

		$fieldList = "*";

		$orderby = "monspec_name";

		$joins = " specatta ON monspec_name = speca_name";

//		$where = "monspec_tp = 'A'";
//		$where .= " AND monspec_name = speca_name";
//		$where .= " AND";

		$where = " ( ";
		$where .= " mon_name = '".$mon_namex."' ";
		foreach ($dgTools['NPCsArray'][$npcNo]['mon_templates'] as $template) {
				if (!empty($template)) {
						$where .= "' OR mon_name = '".$template."'";
				}
		}
		$where .= " ) ";
		$where .= " AND ";
		$where .= " ( ";
		$where .= " mon_key_1 = '".$wp_user."'";
		$where .= " OR mon_key_1 = '".$key_1."'";
		$where .= " )";
		$where .= " AND ";
		$where .= " ( ";
		$where .= " (monspec_min = 0 AND monspec_max = 0)";
		$where .= " OR (monspec_min = '' and monspec_max = '')";
		$where .= " OR (monspec_min <= ".$total_level." and monspec_max = 0)";
		$where .= " OR (monspec_min <= ".$total_level." and monspec_max >= ".$total_level.")";
		$where .= " ) ";

		$result = runSQLSelect($table, $fieldList, $where, $orderby, $joins);	

		$stats = array("str","dex","con","int", "wis", "chr");

		if ($result || sizeof($result) > 0 ) {
				foreach($result as $row) {
						$specialArray = array();
						foreach($row as $fieldName => $fieldValue) {
								$specialArray[$fieldName] = $fieldValue;
						}

						/* What type of special is it? */

						if ( empty($specialArray['specatta_type']) ) {
								/* unlabel / default */		
								if ($specialArray['monspec_tp'] == "S" ) {
										/* Race Special Ability */
										$dgTools['NPCsArray'][$npcNo]['specials']['specialAbilities'][$row['monspec_name']] = $specialArray;
								} else { 
										/* Special Attack */
										$dgTools['NPCsArray'][$npcNo]['specials']['specialAttacks'][$row['monspec_name']] = $specialArray;
								}
						}		else {
									$specType = strtolower($specialArray['specatta_type']);

									if ( in_array($specType , $stats ) ) {
											/* A stat mod */							
											$dgTools['NPCsArray'][$npcNo]['specials']['stats'][$specType][$row['monspec_name']] = $specialArray;
									}		else {
											$dgTools['NPCsArray'][$npcNo]['specials'][$specType][$row['monspec_name']] = $specialArray;
									}	
						}
				}

		}
		return $dgTools;

}


function getNPCAttack($dgTools, $attType = NULL, $attKey = NULL) {
		$npcNo = getCurrentNPCNo($dgTools);
		$attack = NULL;
		if ( $attType == NULL && $attKey == NULL ) {
				return $attack;
		}

		if ( $attType == "primary" || $attKey = 'p' ) { 
				/* Get the first attack marked as primary */	
				foreach ( $dgTools['NPCsArray'][$npcNo]['attacks'] as $lpAttack ) {
						if ( is_set($lpAttack['type']) && $lpAttack['type'] == 'primary' ) {
								$attack = $lpAttack;
								break;	 
						}
				}
		} else if ( $attType == "range" || $attKey = 'r' ) { 
				/* Get the first attack marked as range */	
				foreach ( $dgTools['NPCsArray'][$npcNo]['attacks'] as $lpAttack ) {
						if ( is_set($lpAttack['type']) && $lpAttack['type'] == 'primary' ) {
								$attack = $lpAttack;
								break;	 
						}
				}
		} else {
				if ( !empty($dgTools['NPCsArray'][$npcNo]['attacks'][$attKey]) && 
							is_array($dgTools['NPCsArray'][$npcNo]['attacks'][$attKey]) ) {
						$attack = $dgTools['NPCsArray'][$npcNo]['attacks'][$attKey];		
				}
		}

}



function calcHitDiceAndLevels($dgTools, $npcNo) {

		$mon_level = 0;
		$mon_die = "D8";
		$mon_hp = 0;

		$total_level = 0;

		/* Get Base Hit Dice */
		if ( !empty($dgTools['NPCsArray'][$npcNo]['mon_hd'] )) {
				$d = strpos($dgTools['NPCsArray'][$npcNo]['mon_hd'], "d");
				if ( $d == FALSE ) {
							$mon_level = (int)$dgTools['NPCsArray'][$npcNo]['mon_hd'];				
				} else {
							$len = strlen($dgTools['NPCsArray'][$npcNo]['mon_hd'],0, $d);
							$mon_level = (int)substr($dgTools['NPCsArray'][$npcNo]['mon_hd'],0, $d);
							$mon_die = substr($dgTools['NPCsArray'][$npcNo]['mon_hd'], $d, $len);
				} 
		}			

		$dgTools['NPCsArray'][$npcNo]['mon_level'] = $mon_level;
		$dgTools['NPCsArray'][$npcNo]['mon_die'] = $mon_die;

		$total_level += $mon_level;

		/* Class Level / Dice */
		foreach ( $dgTools['NPCsArray'][$npcNo]['classes'] as $classKey => $class ) {

				if ( !empty($class['classlevel']) && is_numeric($class['classlevel'])) {
						$total_level += $class['classlevel'];
				}
		}

		$dgTools['NPCsArray'][$npcNo]['total_level'] = $total_level;
	
		return $dgTools;
}


/* Load Class Details */
function loadClassDetails($dgTools, $npcNo) {

		$wp_user = $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];

		$table = "class2";

		$fieldList = "*";

		$orderby = "";

		foreach( $dgTools['NPCsArray'][$npcNo]['classes'] as $classNo => $classArray ) {

				if ( !empty($classArray['class_tp']) ) {
						$className = $classArray['class_tp'];
		
						$where = "";
						$where .= " class_tp= '".$className."' ";
						$where .= " AND mon_key_1 = '".$key_1."'";
				
						$result = runSQLSelect($table, $fieldList, $where, $orderby);	
		
						if ($result || sizeof($result) > 0 ) {
		
								foreach($result as $row) {
										foreach ($row as $fieldName => $value ) {
												$dgTools['NPCsArray'][$npcNo]['classes'][$classNo][$fieldName] = $value; 
										}
								}
						}
				}
		}
		return $dgTools;					

}



/*  Load Feats */
function loadFeats($dgTools, $npcNo) {

		/*  XXXXXX     FEATS need a lot of attention because I can't work out how they should work */


		$dgTools = loadPossibleClassFeats($dgTools, $npcNo);		
		$dgTools = loadMonsterFeats($dgTools, $npcNo);

		return $dgTools;
			
}


function loadMonsterFeats($dgTools, $npcNo) {
		
		$wp_user = $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];
		$mon_name = $dgTools['NPCsArray'][$npcNo]['mon_name'];

		/* Load how many class feats the NPC has */

		$table = "monfeat";

		$joins = "feats2 on monfeat = feat_name";

		$fieldList = "*";

		$orderby = "feat_name";

		$where = "";
		$where .= " ( ";
		$where .= " mon_key_1 = '".$wp_user."'";
		$where .= " OR mon_key_1 = '".$key_1."'";
		$where .= " )";
		$where .= " AND feats2.mon_key_1 = '".$key_1."'";
		$where .= " AND mon_name = '".$mon_name."'";

		$result = runSQLSelect($table, $fieldList, $where, $orderby, $joins);	

		if ( empty($dgTools['NPCsArray'][$npcNo]['feats'])) {
				$dgTools['NPCsArray'][$npcNo]['feats']['possible'] = array();
		}

		if ( empty($dgTools['NPCsArray'][$npcNo]['feats']['active'])) {
				$dgTools['NPCsArray'][$npcNo]['feats']['active'] = array();
		}

		if ($result || sizeof($result) > 0 ) {
				$dgTools['NPCsArray'][$npcNo]['mon_feats'] = 0;
				$dgTools['NPCsArray'][$npcNo]['mon_free_feats'] = 0;
	
				$freeFeats = array("armour prof light", "rrmour prof medium", "armour prof heavy",
									"simple weapon proficiency", "martial weap prof", "shield proficiency");

				foreach($result as $row) {
						$dgTools['NPCsArray'][$npcNo]['feats']['active'][] = $row;		
						$dgTools['NPCsArray'][$npcNo]['mon_feats']++;
						/* Check for free feats */
						if 	(in_array(strtolower($row['feat_name']), $freeFeats) ) {
								$dgTools['NPCsArray'][$npcNo]['mon_free_feats']++;								
						}
				}
		}

		return $dgTools;					

}


/* Load Possible Class Feats */
function loadPossibleClassFeats($dgTools, $npcNo) {
//       $select = "select classl_feat from classlev2 where classl_tp = '$class' and classl_lev = $level and mon_key_1 = '$key_1'";

		$wp_user = $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];

		/* Load how many class feats the NPC has */

		$table = "classlev2";

		$fieldList = "*";

		$orderby = "classl_feat";

		$where = "";

		$where .= " ( ";
		$firstFlag = TRUE;
		foreach ($dgTools['NPCsArray'][$npcNo]['classes'] as $classArray) {
				if ( !empty($classArray['class_tp']) ) {	
						if (!$firstFlag) {
								$where .= " OR ";
						}
						$where .= "( classl_tp = '".$classArray['class_tp']."' ";
						$where .= " AND classl_lev = '".$classArray['classlevel']."' ) ";
						$firstFlag = false;				
				}		
		}
		$where .= ") ";
		$where .= " AND mon_key_1 = '".$key_1."' ";

		$result = runSQLSelect($table, $fieldList, $where, $orderby);	

		if ( empty($dgTools['NPCsArray'][$npcNo]['feats'])) {
				$dgTools['NPCsArray'][$npcNo]['feats']['possible'] = array();
		}

		if ( empty($dgTools['NPCsArray'][$npcNo]['feats']['possible'])) {
				$dgTools['NPCsArray'][$npcNo]['feats']['possible']['class'] = array();
		}

		if ($result || sizeof($result) > 0 ) {
				foreach($result as $row) {
						$dgTools['NPCsArray'][$npcNo]['feats']['possible']['class'][] = $row;		
				}
		}




		return $dgTools;
}


function getMonsterType($mon_name, $key_1) {
		$table = "monster2";
		$fieldList = "mon_type";
		$orderby = NULL;

		$where = "mon_name = '".$mon_name."'";
		$where .= " AND mon_key_1 = '".$key_1."' ";
		$result = runSQLSelect($table, $fieldList, $where, $orderby);	

		if (!$result || sizeof($result) !== 1 ) {
				/* This should not happen */				
				error_log("dgNPCDataFunctions/getMonsterType : No record found or multiple records found");
				die("dgNPCDataFunctions/getMonsterType : No record found or multiple records found");			
		}

		return $result[0]['mon_type'];
	
}


/* Calculate the number of skills points etc */
function calcSkills($dgTools, $npcNo) {


/*

				XXXXXX    NEEDS  TO   BE   DONE   XXXXXXX


				JUST DONE ENOUGH TO GET THE BASICS WORKING 

*/

		$wp_user = $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];
		$mon_name = $dgTools['NPCsArray'][$npcNo]['mon_name'];

		/* Calculate max points etc */

		if ( $dgTools['meta']['key_1']	== DD35 ) {
				$max_skill = $dgTools['NPCsArray'][$npcNo]['total_level'] + 3;
				$max_xskill = round($max_skill /2);
		} else {
				$max_skill = $dgTools['NPCsArray'][$npcNo]['total_level'];
				$max_xskill = $max_skill;
		}

		$total_skill_points = $dgTools['NPCsArray'][$npcNo]['montype_skillp'];

		$skillsLoop = array();

		foreach ($dgTools['NPCsArray'][$npcNo]['classes'] as $classArray)  {
				if ( !empty($classArray['class_tp']) ) {
						$total_skill_points += $classArray['class_skillp'];
						$tempArray = array();
						/* Primary */
						$tempArray['sel'] = 'P';
						$tempArray['class_tp'] = $classArray['class_tp'];
						$tempArray['class_focus'] = $classArray['classfocus'];
						$tempArray['skill_points'] = 9;   //  <-------    HACK FOR TESTING ----  NEEDS WORK 
						$skillsLoop[] = $tempArray;
						/* secondary */
						$tempArray['sel'] = 'S';
						$tempArray['skill_points'] = 5;   //  <-------    HACK FOR TESTING ----  NEEDS WORK 
						$skillsLoop[] = $tempArray;
				}
		}

		/* Workout Temp / Possible Skills ??? */

		foreach ($skillsLoop as $skillTemp)  {
				
				/* Get MIN */
				$table = "skilltemp";

				$fieldList = "MIN(skillt_rank)";

				$joins = "classfocus2 ON classf_tp = skillt_skill";

				$orderby = NULL;

				$where = "";
				$where .= " classf_class = '".$skillTemp['class_tp']."' ";
				$where .= " AND classf_focus = '".$skillTemp['class_focus']."' ";
				$where .= " AND classf_tp LIKE '".$skillTemp['sel']."%' ";   //  <-- THIS LINE IS WRONG No IDEA WHAT THIS IS MEANT TO DO 
				$where .= " AND skillt_rank < ".$max_skill;
				$where .= " AND skillt_rank < classf_max";
				$where .= " AND mon_key_1 = '"	.$key_1."' ";
				 		
				$result = runSQLSelect($table, $fieldList, $where, $orderby, $joins);	
		
				$min = 0;
				if ($result || sizeof($result) == 1 ) {
						$min = $result[0]['MIN(skillt_rank)'];
						if (empty($min) ) {
								$min = 0;
						}
				} else {
						// Should there always be a result? Should we throw an error?
				}

				/*  Get DATA */
				$table = "skilltemp";

				$fieldList = "skillt_skill, skillt_rank, skillt_xskill, classf_xskill";

				$joins = "classfocus2 ON classf_tp = skillt_skill";

				$orderby = NULL;

				$where = "";
				$where .= " classf_class = '".$skillTemp['class_tp']."' ";
				$where .= " AND classf_focus = '".$skillTemp['class_focus']."' ";
				$where .= " AND classf_tp LIKE '".$skillTemp['sel']."%' ";   //  <-- THIS LINE IS WRONG No IDEA WHAT THIS IS MEANT TO DO 
				$where .= " AND skillt_rank < ".$max_skill;
				$where .= " AND skillt_rank < classf_max";
				$where .= " AND skillt_rank = ".$min;
				$where .= " AND skillt_user = '"	.$wp_user."' ";
				 		
				$result = runSQLSelect($table, $fieldList, $where, $orderby, $joins);	

			

		}


		/******

				SOMETHING MAGICAL HAPPENS HERE TO GET THE SKILLS


		*******/	
		
		/*  DUMMY SKILL FOR TESTING */
		$skill = array();
		$skill['skill'] = "Dummy Skill";
		$skill['ranks'] = 5;
		$skill['stat_bonus'] = 1;
		$skill['misc_bonus'] = 2;
		$skill['total'] = 8;
		$dgTools['NPCsArray'][$npcNo]['skills']['Dummy Skill'] = $skill;
						


		return $dgTools;		

}


function loadBuffs($dgTools, $npcNo) {
		
		$wp_user = $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];
		$mon_name = $dgTools['NPCsArray'][$npcNo]['mon_name'];

		$table = "monbuff";

		$fieldList = "*";

		$orderby = "monbuff_level, monbuff_spell";

		$where = "";
		$where .= " mon_key_1 = '".$key_1."'";
		$where .= " AND mon_name = '".$mon_name."'";

		$result = runSQLSelect($table, $fieldList, $where, $orderby);	

		if ( empty($dgTools['NPCsArray'][$npcNo]['buffs'])) {
				$dgTools['NPCsArray'][$npcNo]['buffs'] = array();
		}

		if ($result || sizeof($result) > 0 ) {
				foreach ($result as $row) {
						$buff = array();
						foreach ($row as $fieldName => $fieldValue) {
								$buff[$fieldName] = $fieldValue;
						}
						$dgTools['NPCsArray'][$npcNo]['buffs'][] = $buff;
				}
		}

		return $dgTools;					

}


function calcSpellLists($dgTools, $npcNo) {

		$minSpellLevel = 0;
		$maxSpellLevel = 9;
		$maxSpells = 0;
		$statName = "";
		$statValue = 0;
		$statBonus = 0;

		/* Min spell Level */
		$specialClasses1 = array("Paladin", "Ranger", "Assassin", "Blackguard", 
						"Antiplaladin", "Bloodrager", "Alchemist", "Demon Lord", "Investigator");
		$specialClasses1DND = array("Psion", "Psychic Warrior");
		$specialClasses0 = array("Bard", "Sorcerer", "Assassin", "Summoner", 
							"Unchained Summoner", "Demon Lord", "Skald", "Psion", "Psychic Warrior", 
							"Inquisitor", "Oracle", "Hunter", "Arcanist");
							
		$classes = $dgTools['NPCsArray'][$npcNo]['classes'];
		
		foreach ($classes as $classNo => $classArray) {
				if ( !empty($classArray['class_tp']) ) {
						if (in_array($classArray['class_tp'], $specialClasses1) ) {
								$minSpellLevel = 1;
						}
						if ( $dgTools['meta']['key_1'] == DD35 && in_array($classArray['class_tp'], $specialClasses1DND)) {
								$minSpellLevel = 1	;			
						} 
						if ( in_array($classArray['class_tp'], $specialClasses0 )) {
								$minSpellLevel = 0;						
						}
		
						/* XXX WORK WHICH STAT TO USE */
						$stat = "int";
						$statValue = $dgTools['NPCsArray'][$npcNo]['stats'][$stat];
		
						/* XXX WORK OUT MAX SPELL LEVEL ???? */
						$maxSpellLevel = $statValue - 10;
		
						/* XXX  WORK OUT NUMBER OF ALLOWED SPELLS BASED ON STAT / DOMAINs etc ???? */
						$maxSpells = 999;				
						$dgTools['NPCsArray'][$npcNo]['classes'][$classNo]['spellsPerLevel'] = array();
						for( $lp = $minSpellLevel; $lp <= $maxSpellLevel; $lp++ ) {
									//  HACK TO GET THINGs WORKING
									$spellsForLevel = 9;
									$dgTools['NPCsArray'][$npcNo]['classes'][$classNo]['spellsPerLevel'][$lp] = $spellsForLevel;
						}
						/* XXX  WORK OUT STAT BONUS FOR DC???? */
						$statBonus = 0;
			
						/*  XXXX THIS IS A HACK TO GET THINGS WORKING */
						$maxSpellLevel = 9;
						$minSpellLevel = 0;
		
		
						/*  Load spell lists */
		
						$wp_user = $dgTools['meta']['wp_user'];
						$key_1 = $dgTools['meta']['key_1'];
				
						$table = "spellclass";
				
						$joins = "spell ON spellclass_name = spell_name";
		
						$fieldList = "*";
				
						$orderby = "spellclass_level, spell_name";
				
						$where = "";
						$where .= " spellclass_level >= ".$minSpellLevel;
						$where .= " AND spellclass_level <= ".$maxSpellLevel;
		
						/* Add WHERE clause for class / domains. */
						switch ($classArray['class_tp']) {
								case "Cleric":
										$where .= " AND spellclass_class = '".$classArray['class_tp']."' ";
										$where .= " AND ( spell_school = '".$classArray['domain'][1]."' ";
										$where .= " OR spell_school = '".$classArray['domain'][2]."' ) ";
										break;
								case "Wizard":
										$where .= " AND spellclass_class = '".$classArray['class_tp']."' ";
										$where .= " AND spell_school = '".$classArray['domain'][1]."' ";
										break;
								default:
										/*   HACK  - LOGIC FOR OTHE CLASSES NEEDS ADDING */
										$where .= " AND spellclass_class = '".$classArray['class_tp']."' ";
										break;
						}		
		
		
						$result = runSQLSelect($table, $fieldList, $where, $orderby, $joins);	
				
						if ( empty($dgTools['NPCsArray'][$npcNo]['spells'])) {
								$dgTools['NPCsArray'][$npcNo]['spells'] = array();
						}
				
						if ($result || sizeof($result) > 0 ) {
								foreach ($result as $row) {
										$spell = array();
										foreach ($row as $fieldName => $fieldValue) {
												$spell[$fieldName] = $fieldValue;
										}
										$dgTools['NPCsArray'][$npcNo]['spells'][] = $spell;
								}
						}
				}		
	

		}
		
		return $dgTools;
}


function loadClassSpecialAbilities($dgTools, $npcNo) {

		$wp_user = $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];

		$table = "classsp";

		$joins = "specials ON classsp_spec = spec_name";

		$fieldList = "classsp_spec, spec_desc, sum(classsp_no), spec_display";

		$rawSQL = "GROUP BY classsp_spec";	

		$orderby = "";

		foreach ($dgTools['NPCsArray'][$npcNo]['classes'] as $classArray) {

				if ( !empty($classArray['class_tp'] )) {

						$where = "";
						$where .= " classsp_class = '".$classArray['class_tp']."'";
						$where .= " AND classsp_level <= '".$classArray['classlevel']."'";
				
						$result = runSQLSelect($table, $fieldList, $where, $orderby, $joins, $rawSQL);	

						if ( empty($dgTools['NPCsArray'][$npcNo]['specials'])) {
								$dgTools['NPCsArray'][$npcNo]['specials'] = array();
						}

						if ( empty($dgTools['NPCsArray'][$npcNo]['specials']['class'])) {
								$dgTools['NPCsArray'][$npcNo]['specials']['class'] = array();
						}
			
						if ($result || sizeof($result) > 0 ) {
								foreach ($result as $row) {
										$special = array();
										foreach ($row as $fieldName => $fieldValue) {
												$special[$fieldName] = $fieldValue;
										}
										$dgTools['NPCsArray'][$npcNo]['specials']['class'][$special['classsp_spec']] = $special;
								}
						}

				}

			}				

			return $dgTools;					
}

