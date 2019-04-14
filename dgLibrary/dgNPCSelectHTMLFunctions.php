<?php
/*

dgSelectFormFunctions - Functions specific to the monster selection from 

NOTE - Default (e.g. not rule specific code). All functions must test
to check they haven't already been declared by rule specific code 

*/

if (!function_exists(monsterLetters) ) {

	function monsterLetters(){
	 $letters = " ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$html = "<div class='dgNPCSelectLetters'>";
	
	  for ($count = 0; $count <= 26; $count++){
	     $letter = substr($letters,$count,1);
	     $html .= '<INPUT NAME="submit" TYPE=Button Value = "' . $letter . '"  onClick=monsterSelection(this)>';
	  }
	
			$html .= "</div>";
	  return $html;
	}

}
	


if (!function_exists("getMonstersByLetter") ) {

	function getMonstersByLetter($dgTools, $letter){

 		$html_letter = "html_" . $letter;
		$key_1 = $dgTools['meta']['key_1'];

		$html = getNameID(array("NPCsArray",getCurrentNPCNo($dgTools),"mon_name"), "mon_name");
		$html .= ' >';

		$select = "SELECT mon_key_1, mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,";
		$select .= "mon_init ,mon_speed ,mon_ac_flat , mon_ac ,";
		$select .= "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,";
		$select .= "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," ;
		$select .= "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " ;
		$select .= 	"mon_armour, mon_shield from monster2 where ((mon_template <> 'T' and mon_template <>'AC') or mon_template is NULL) and (mon_key_1 = '$key_1' ";
		$select .= "or mon_key_1 = '".$dgTools['meta']['wp_user']."') ";
		$select .= " and (mon_delete <> 'Y' or mon_delete is NULL) and mon_name like '" . $letter . "%'  order by mon_name";

		$link = getDBLink();
		$result = mysqli_query($link, $select) ;

		if ( $result ) {	
			while ($row = mysqli_fetch_array($result)) {
		
				$mon_sel = $row['mon_name'] ;
				$mon_hd  = $row['mon_hd'] ;
				$mon_key_1 = $row['mon_key_1'];
				$sel = "" ;

		   $html .= '<OPTION VALUE="' .$mon_sel. '" '.$sel.' >'.$mon_sel.'</OPTION>';
			}
		}			
		mysqli_close($link);
		$html .= '</SELECT></LABEL>';
		return $html;
	} 
}


/* Returns the Monster Selection HTML */
if (!function_exists(getMonsterSelectionHTML) ) {

	function getMonsterSelectionHTML($dgTools) {
		$key_1 = $dgTools['meta']['key_1'];
		$wp_user = $dgTools['meta']['wp_user'];
		$npcNo = getCurrentNPCNo($dgTools);
		$currentlySelected = $dgTools['NPCsArray'][$npcNo]['mon_name'];
				
		$html = '<SELECT ';
		$html .= getNameID(array("NPCsArray",$dgTools['meta']['currentNPCNo'],"mon_name"), "mon_name");
		$html .= ' >';
		
		$select = "SELECT mon_key_1, mon_name ,mon_size , mon_type ,mon_hd ,mon_hp ,".
		                 "mon_init ,mon_speed ,mon_ac_flat , mon_ac ," .
		                 "mon_base_att ,mon_full_att ,mon_space ,mon_reach ,".
		                 "mon_cr ,mon_str ,mon_dex ,mon_con ,mon_int ," .
		                 "mon_wis ,mon_chr ,mon_desc,mon_sv_fort, mon_sv_reflex,  mon_sv_will, " .
		                 "mon_armour, mon_shield from monster2 where ((mon_template <> 'T' and mon_template <>'AC') or mon_template is NULL) and (mon_key_1 = '$key_1' or mon_key_1 = '$wp_user') " .
	                         " and (mon_delete <> 'Y' or mon_delete is NULL) order by mon_name";
	
		$link = getDBLink();
		$result = mysqli_query($link, $select) ;
	
		while ($row = mysqli_fetch_array($result)) {
	
			$mon_sel = $row['mon_name'] ;
			$mon_hd  = $row['mon_hd'] ;
			$mon_key_1 = $row['mon_key_1'];
			if ($mon_sel == $currentlySelected)     {
				$sel = " SELECTED" ;
			} else {
				$sel = "" ;
			}
			$html .= '<OPTION VALUE="' .$mon_sel. '" '.$sel.' >'.$mon_sel.'</OPTION>';
		}
		mysqli_close($link);
		$html .= '</SELECT>';
	
		return $html;
	
	}

}	

/* Returns the Monster Selection HTML */
if (!function_exists(getTemplateSelectionHTML) ) {

	function getTemplateSelectionHTML($dgTools, $templateNo) {
		$npcNo = getCurrentNPCNo($dgTools);
		$wp_user= $dgTools['meta']['wp_user'];
		$key_1 = $dgTools['meta']['key_1'];
		$html = '<SELECT ';
		$html .= getNameID(array("NPCsArray",$npcNo,"mon_templates",$templateNo), "mon_tem_".$templateNo);
		$html .= ' >';

		$mon_sel = '' ;
		$mon_hd  = 0 ;
	
		$currentlySelected = "";
		if ( isset($dgTools["NPCsArray"][$npcNo]["mon_templates"]) &&
							isset($dgTools["NPCsArray"][$npcNo]["mon_templates"][$templateNo])) {
				$currentlySelected = $dgTools["NPCsArray"][$npcNo]["mon_templates"][$templateNo];
		}


		$sel = "";
		if ($mon_sel == $currentlySelected)     {
		  $sel = " SELECTED" ;
		} 
	
		$html .= '<OPTION VALUE="'.$mon_sel.'" '.$sel.' >None</OPTION>';
	
	
		$select = "SELECT mon_name from monster2 where mon_template = 'T' and (mon_key_1 = '$wp_user' or mon_key_1 = '$key_1') " .
	                         " and (mon_delete <> 'Y' or mon_delete = NULL) order by mon_name";
	
		$link = getDBLink();
		$result = mysqli_query($link, $select) ;
	
		while ($row = mysqli_fetch_array($result)) {
	
			$mon_sel = $row['mon_name'] ;
	
			if ($mon_sel == $currentlySelected)     {
			  $sel = " SELECTED" ;
			} else {
			  $sel = "" ;
	  }
	
			$html .= '<OPTION VALUE="'.$mon_sel.'" '.$sel.' >'.$mon_sel.'</OPTION>';
		}
		mysqli_close($link);
	
		$html .= '</SELECT>';
	
		return $html;
	
	}

}
	
/* Returns the HTML for class selection */
if (!function_exists(getClassSelectionHTML) ) {

	function getClassSelectionHTML( $dgTools, $classNumber) {
		$prestige = "";
		$key_1 = $dgTools['meta']['key_1'];
		$npcNo = getCurrentNPCNo($dgTools);
		$class = $dgTools['NPCsArray'][$npcNo]['classes'][$classNumber];
		$currentlySelected = $class['class_tp'];
	
		if ($classNumber == 3){
			$prestige = "Y";
		}
	
		$html = '<SELECT ';
		$html .= getNameID(array("NPCsArray",$npcNo,"classes",$classNumber,"class_tp"), "class_tp_".$classNumber);
		$html .= ' class="classSelect"  onchange="changeField(this,'.$classNumber.')">';
	
		$select = "SELECT class_tp from class2 where (class_prest = '$prestige' or class_tp = '') and mon_key_1 = '$key_1' ORDER BY class_tp";
		$link = getDBLink();
		$result = mysqli_query($link, $select) ;
		while ($row = mysqli_fetch_array($result)) {
	
			$class_sel = $row['class_tp'] ;
			if ($class_sel == $currentlySelected ) {
				$sel = " SELECTED" ;
		    } else {
		    	$sel = "" ;
		    }
	
			$html .= '<OPTION VALUE="'.$class_sel.'" '.$sel.' >'.$class_sel.'</OPTION>';
		}
		mysqli_close($link);
		$html .= '</SELECT>';	
	
		return $html;
	}
	
}


	


if ( !function_exists("getEliteStatsHTML") ) {

	function getEliteStatsHTML($dgTools) {

		$radio = '<INPUT class="radio" TYPE = "radio"';
		$radio .= getNameID(array("NPCsArray",getCurrentNPCNo($dgTools),"elite"), "elite_y");
		$radio .= 'VALUE = "Y"';
		if ($dgTools['NPCsArray'][getCurrentNPCNo($dgTools)]['elite'] == "Y" ) {
				$radio .= 'checked="Y"';   
		}
		$radio .= '/>';

		return $radio;
	}

}


if ( !function_exists("getNonEliteStatsHTML") ) {

	function getNonEliteStatsHTML($dgTools) {

		$radio = '<INPUT class="radio" TYPE = "radio" ';
		$radio .= getNameID(array("NPCsArray",getCurrentNPCNo($dgTools),"elite"), "elite_n");
		$radio .= 'VALUE = "N"';
		/* Default unless elite already selected */
		if ($dgTools['NPCsArray'][getCurrentNPCNo($dgTools)]['elite'] !== "Y" ) {
				$radio .= 'checked="Y"';   
		}
		$radio .= '/>';

		return $radio;
	}

}



/*

						LOADING SAVES  -<<<<<<   NEEDS DOING

*/
	function getSaveSelectionHTML($currentlySelected) {
	 //       $currentlySelected = "";
	        global $user_id, $wp_user;
		$html = '<LABEL id="monsterTypeLabel">Saves <SELECT NAME="savemon_key" WIDTH="480" STYLE="width: 480px">';
	//        $html = '<TABLE ><TR><TH><b>Monster</b></TH><TH><b>Template</b></TH></TR>' .
	//                '<TR><TD><SELECT NAME="mon_name" >';
	        if ($wp_user != ""){
	//             echo "wp user " . $wp_user;
	             $save_key = trim($wp_user);
	             $save_user = $user_id;
	        }else{
	             $save_user = $user_id;
	             $save_key = $user_id;
	        }
	   //     echo "save_user $save_user save_key $save_key";
	        if ( $save_user != "" || $save_key != "" ) {
	                   if($save_user == ""){
	                       $save_user = "xxxxx";
	                   }
	                   if ($save_key == ""){
	                       $save_key = "xxxxxx";
	                   }
				// Only run the query if we have valid data otherwise it returns 100,000+ monsters and crashes
	
		        $select = "SELECT savemon_key, savemon_monster, savemon_mon_name, savemon_class1_tp, savemon_class2_tp, savemon_mon_temp, savemon_class1_focus, savemon_class2_focus, " .
		          " savemon_class1_level, savemon_class2_level, savemon_name, savemon_camp, savemon_sub, savemon_cr, savemon_date " .
		          " from savemon where savemon_user = '$save_user' or savemon_wp_user = '$save_key' order by savemon_date2 DESC";
	              //   echo $select;
			//	error_log("getSaveSelectionHTML  SQL --> ".$select);
	
				$link = getDBLink();
				$result = mysqli_query($link, $select) ;
	
				$desc = " None";
				$save_sel = "";
			    if ($save_sel == $currentlySelected)     {
					$sel = " SELECTED" ;
				} else {
					$sel = "" ;
				}
		        $html .= "<OPTION VALUE='$save_sel' $sel>$save_sel $desc </OPTION>";
				while ($row = mysqli_fetch_array($result)) {
	
					$save_sel = $row['savemon_key'] ;
					$savemon_mon_name = $row['savemon_mon_name'];
					$savemon_mon_temp = $row['savemon_mon_temp'];
			                $savemon_class1_tp = $row['savemon_class1_tp'];
			                $savemon_class2_tp = $row['savemon_class2_tp'];
			                $savemon_class1_level = $row['savemon_class1_level'];
			                $savemon_class2_level = $row['savemon_class1_level'];
			                $savemon_name = $row['savemon_name'];
			                $savemon_date = $row['savemon_date'];
			                $date_x = "";
			                if ($savemon_date !=""){
			                   $date_x = date('Y-m-d H:i',$savemon_date);
			                }
			                if ($save_sel == $save_user){
			                   $desc = "Last created ";
			                }else{
			                   $desc = "";
			                }
			                if ($savemon_name !=  ""){
			                   $desc .= $savemon_name . " ";
			                }
			                $desc .=  $savemon_mon_name;
			                if ($savemon_mon_temp !=""){
			                   $desc .= ",(". $savemon_mon_temp . ")";
			                }
			                if ($savemon_class1_tp != ""){
			                  $desc .=  " " . $savemon_class1_tp . "($savemon_class1_level)";
			                }
			                if ($savemon_class2_tp != ""){
			                  $desc .=  " " . $savemon_class2_tp . "($savemon_class2_level)";
			                }
			                $desc .=  " " . $date_x;
					if ($save_sel == $currentlySelected)     {
						$sel = " SELECTED" ;
					} else {
						$sel = "" ;
				    }
	
					$html .= "<OPTION VALUE='$save_sel' $sel>$desc </OPTION>";
				}
				mysqli_close($link);
	
			}
	
		$html .= '</SELECT></LABEL>';
	
		return $html;
	
	}


	function getFocusSelectHTML($dgTools, $refNo) {

			$html = '<SELECT ';
			$html .= getNameID(array("NPCsArray",getCurrentNPCNo($dgTools),"classes",$refNo,"classfocus"), "classfocus_".$refNo);
			$html .= '></SELECT>';

			return $html;
	}


	function getDomainsHTML($dgTools, $refNo) {
			$html = "";
			$html .= getDomainContentsHTML($dgTools, $refNo, 1);
			$html .= getDomainContentsHTML($dgTools, $refNo, 2);
			$html .= getDomainContentsHTML($dgTools, $refNo, 3);
			
			return $html;
	}


	function getDomainContentsHTML($dgTools, $refNo, $fieldNo) {
/*			
			$div = '<div class="" id="wrapper_domain_'.$refNo.$fieldNo.'">';
			$div .= '<label ';
			$div .= getNameId(array(),"label_domain_".$refNo.$fieldNo); 
			$div .= '></label>';
			$div .= '<div class="" id="value_domain_'.$refNo.$fieldNo.'">';*/
			$div = '<div class="" id="wrapper_domain_'.$refNo.$fieldNo.'">';
			$div .= '</div>';
/*			$div .= '</div>';*/
		
			return $div;
		
	}

	/* Returns the options HTML for class sub-types, e.g. Cleric Domains  */
	
	function getClassSubTypeOptionsHTML($filter, $currentlySelected) {
		
		$html = "";
		$select = "SELECT spellcl_id from spellcl Where ";
		$select = "spellcl_domain = '".$filter."' ";
		$select = "ORDER BY spellcl_id";
		$link = getDBLink();
	
	
		$result = mysqli_query($link, $select) ;
		while ($row = mysqli_fetch_array($result)) {
	
		    $domain_sel = $row['spellcl_id'] ;
		    if ($domain_sel == $currentlySelected ) {
				$sel = " SELECTED" ;
		    } else {
		    	$sel = "" ;
		    }
	
		    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
		}
		mysqli_close($link);
	
		return $html;
	}

	/* Returns the HTML for Cleric Domains selection */
	
	function getDomainSelectionHTML($currentlySelected) {
		
		$html = "";
		$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'Y' ORDER BY spellcl_id";
		$link = getDBLink();
	
	
		$result = mysqli_query($link, $select) ;
		while ($row = mysqli_fetch_array($result)) {
	
		    $domain_sel = $row['spellcl_id'] ;
		    if ($domain_sel == $currentlySelected ) {
				$sel = " SELECTED" ;
		    } else {
		    	$sel = "" ;
		    }
	
		    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
		}
		mysqli_close($link);
		$html .= '</SELECT>';
	
		return $html;
	}


	
	function getPsionSelectionHTML($currentlySelected) {
	
		$html = "";
	
		$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'P' ORDER BY spellcl_id";
		$link = getDBLink();
		$result = mysqli_query($link, $select) ;
		while ($row = mysqli_fetch_array($result)) {
	
		    $domain_sel = $row['spellcl_id'] ;
		    if ($domain_sel == $currentlySelected ) {
				$sel = " SELECTED" ;
		    } else {
		    	$sel = "" ;
		    }
	
		    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
		}
		mysqli_close($link);
		$html .= '</SELECT>';
	
		return $html;
	}


function getBloodlineSelectionHTML($currentlySelected) {

	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'S' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

function getOracleSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ORA' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getOracleCurseSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ORACUR' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

function getBloodragerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'BLRAGE' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getWarpriestSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'WARPR' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

function getOrderSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'C' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

function getCavalierSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'CAV' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getPatronSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'WI' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

function getPsyWarrSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'PW' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}

function getRangerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'RAN' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getRogueSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ROG' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getDruidSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'DRU' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getDruidDomainSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_druid = 'Y' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getBardSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'BAR' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}
function getBarbarianSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'BARB' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getAlchemistSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'ALCH' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getFighterSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'FIGHT' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getMonkSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'MONK' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getGunslingerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'GUNSL' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getSummonerSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellcl_id from spellcl Where spellcl_domain = 'SUMM' ORDER BY spellcl_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellcl_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


function getSchoolSelectionHTML($currentlySelected) {

//	$html = '<SELECT type="hidden"  NAME="domain_'.$classNumber. $domainNumber . '" class="classSelect" ID="class_tp_'.$classNumber.'">';
	$html = "";

	$select = "SELECT spellschool_id from spellschool ORDER BY spellschool_id";
	$link = getDBLink();
	$result = mysqli_query($link, $select) ;
	$domain_sel = "None";
        $html .= '<OPTION VALUE="" >'.$domain_sel.'</OPTION>';
	while ($row = mysqli_fetch_array($result)) {

	    $domain_sel = $row['spellschool_id'] ;
	    if ($domain_sel == $currentlySelected ) {
			$sel = " SELECTED" ;
	    } else {
	    	$sel = "" ;
	    }

	    $html .= '<OPTION VALUE="'.$domain_sel.'" '.$sel.' >'.$domain_sel.'</OPTION>';
	}
	mysqli_close($link);
	$html .= '</SELECT>';

	return $html;
}


/* Returns HTML for loading saved NPCs */
function getLoadSavesHTML($dgTools) {
		$html = "";
		$monsterBlocks = "";
		$results = getUserSavedNPCs($dgTools, 10);  /* 10 most recent saves */

		if ($results ) {
				$count = 0;
				foreach ($results as $row ) {
							$block = "";
							$cssBlockTag = "dgSavedNPC";
							$blockLabel = NULL;

							$rowValue = '<input type="radio" ';
							$rowValue .= getNameID(array("NPCsArray",getCurrentNPCNo($dgTools),"load_savemon",$count), "load_savemon_".$count);
							$rowValue .= 'value="';
							$rowValue .= $row['savemon_key'];
							$rowValue .= '" >';
							$block .= dgMakeRowNoLabel($rowValue); 

							$date_x = "";
	       if ($row['savemon_date'] !=""){
									$date_x = date('Y-m-d H:i',$row['savemon_date']);
	       }
							$rowValue = $date_x;
							$rowLabel = "Last Saved";
							$block .= dgMakeRow($rowLabel, $rowValue); 

							$rowValue = "";
							if ($row['savemon_mon_name'] !=  ""){
									$rowValue = $row['savemon_mon_name'];
							}
							$rowLabel = "Name";
							$block .= dgMakeRow($rowLabel, $rowValue); 

							$rowValue = "";
							if ($row['savemon_mon_temp'] !=  ""){
									$rowValue .= $row['savemon_mon_temp'];
							}
							if ($row['savemon_mon_temp2'] !=  ""){
									if ($rowValue != "" ) {
											$rowValue .= " / ".$row['savemon_mon_temp'];
									} else {
											$rowValue .= $row['savemon_mon_temp'];
									}
							}

							$rowLabel = "Template";
							$block .= dgMakeRow($rowLabel, $rowValue); 

							$rowValue = "";
							if ($row['savemon_class1_tp'] !=  ""){
									$rowValue .= $row['savemon_class1_tp']; 
									$rowValue .= "/".$row['savemon_class1_level'];
							}
							if ($row['savemon_class2_tp'] !=  ""){
									$rowValue .= $row['savemon_class2_tp']; 
									$rowValue .= "/".$row['savemon_class2_level'];
							}
							$rowLabel = "Classes";
							$block .= dgMakeRow($rowLabel, $rowValue); 

								
							$monsterBlocks .= dgMakeBlock($block, $cssBlockTag, $blockLabel);

							$count++;
				}
		}

		$html = wrapHTMLBlock($monsterBlocks, "dgSavedNPCS");
		return $html;
}