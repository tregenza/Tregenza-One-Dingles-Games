<?php
/*  

		dgUtilityDataFunctions - Handles tool related data and the general process
	 of handing data between different pages, session variables, cookies etc.

		---------------------------------------------------------------------------

		dgTools Array

		This array holds all the data needed by all the tools / pages. It's contents
		are created / passed between pages via an additive process. Each step adds new data
		or overwrites existing data with more correct version. 

		Initialise defaults - Creates the absolute bare bones data

		Add Session data - If there is a dgTools in the session data, incorporate its data.

		Add Encoded post data - A version of dgTools is encoded on many tool pages. This
		is incorporated into the array

		Add Form POST data - User entered data (e.g. NPC class/level) overwrites or adds to the data

		Add GET data - Certain key parts of the data can be set via $_GET (i.e. on the URL)
		and these are added. 
		
*/


	function initDGTools() {
			$dgTools = array();
			$dgTools['meta'] = initMeta();
			$dgTools['NPCsArray'] = array();
			$npcNo = getCurrentNPCNo($dgTools);
			$dgTools['NPCsArray'][$npcNo] = initNewNPC(	);

//error_log("InitDGTools XXX ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */

			if (isset($_GET['dgreset'])) {
					/* Debug option to force the tools to only use the default values.*/
					/* Useful if the dgTools array get bad data in it */
					error_log("dgUtilityFunctions - dgTools Reset");	
			} else {
//				$dgTools = mergeSessionDGTools($dgTools);
//error_log("InitDGTools after Session ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */
				$dgTools = mergeEncodedDGTools($dgTools);
error_log("InitDGTools after Encoded ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */
				$dgTools = mergePOSTDGTools($dgTools);
error_log("InitDGTools after POST ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */
				$dgTools = mergeGETDGTools($dgTools);
error_log("InitDGTools after GET ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */
			}

		/* Clean array */
		array_walk_recursive( $dgTools, cleanDGTools);

			return $dgTools;
	}

	function initMeta() {
		/* 
		
		Initilise Meta  
		
		Meta contains all data about the process of creating the NPC, not details on the NPC 
		
		*/

		/* Set defaults - Anything which later code must have a value for should have a default value here */
		$default = array();
		$default['key_1'] = PATHFINDER;										
		$default['page_status'] = PAGE_STATUS_NEW;			
		$default['page_type'] = PAGE_TYPE_SELECT;			
		$default['page_target'] = PAGE_TYPE_GENERATE;			
		$default['page_tool'] = PAGE_TOOL_NPC;			
		$default['page_output'] = OUTPUT_HTML;			
		$default['msg'] = MSG_ALL_OK;

		if(dgHasUserPaid() == 1){
		   $default['paid_user'] = PAID_USER;
		}else{
		   $default['paid_user'] = FREE_USER;
		}

		$current_user = wp_get_current_user();
		$default['wp_user'] = trim($current_user->user_login);
	
		$default['user_id'] = getCookieValue('dd_user_id');

		$default['currentNPCNo'] = 0;		
	
		return $default;

	}


/* Generates array for an new NPC with all the appropriate defaults */
if (!function_exists("initNewNPC") ) {
	function initNewNPC() {
	
		$newNPC = array();
	
		$newNPC['mon_name'] = "";
		$newNPC['mon_type'] = "";
		$newNPC['mon_templates'] = array();
		$newNPC['mon_templates'][1] = "";
		$newNPC['mon_templates'][2] = "";
		$newNPC['mon_tp_1'] = "";
		$newNPC['classes'] = array();
		$newNPC['classes'][1] = array();
		$newNPC['classes'][1]['class_tp'] = "";
		$newNPC['classes'][1]['classlevel'] = "";
		$newNPC['classes'][1]['classfocus'] = "";
		$newNPC['classes'][1]['domain'] = array();
		$newNPC['classes'][1]['domain'][1] = "";
		$newNPC['classes'][1]['domain'][2] = "";
		$newNPC['classes'][1]['domain'][3] = "";
		$newNPC['classes'][2] = array();
		$newNPC['classes'][2]['class_tp'] = "";
		$newNPC['classes'][2]['classlevel'] = "";
		$newNPC['classes'][2]['classfocus'] = "";
		$newNPC['classes'][2]['domain'] = array();
		$newNPC['classes'][2]['domain'][1] = "";
		$newNPC['classes'][2]['domain'][2] = "";
		$newNPC['classes'][2]['domain'][3] = "";
		$newNPC['classes'][3] = array();
		$newNPC['classes'][3]['class_tp'] = "";
		$newNPC['classes'][3]['classlevel'] = "";
		$newNPC['classes'][3]['classfocus'] = "";
		$newNPC['classes'][3]['domain'] = array();
		$newNPC['classes'][3]['domain'][1] = "";
		$newNPC['classes'][3]['domain'][2] = "";
		$newNPC['classes'][3]['domain'][3] = "";
		$newNPC['elite'] = "";
		$newNPC['mon_size'] = "";
		$newNPC['mon_hd'] = "";
		$newNPC['mon_hp'] = "";
		$newNPC['mon_speed'] = array();
		$newNPC['mon_speed']['base'] = "";
		$newNPC['mon_speed']['fly'] = "";
		$newNPC['mon_speed']['climb'] = "";
		$newNPC['mon_speed']['swim'] = "";
		$newNPC['mon_speed']['burrow'] = "";
		$newNPC['mon_ac'] = array();
		$newNPC['mon_ac']['flat'] = "";
		$newNPC['mon_ac']['deflect'] = "";
		$newNPC['mon_ac']['insight'] = "";
		$newNPC['mon_ac']['profane'] = "";
		$newNPC['mon_ac']['dodge'] = "";
		$newNPC['mon_ac']['luck'] = "";
		$newNPC['mon_base_att'] = "";
		$newNPC['mon_full_att'] = "";
		$newNPC['mon_space'] = "";
		$newNPC['mon_reach'] = "";
		$newNPC['mon_cr'] = "";
		$newNPC['mon_desc'] = "";
		$newNPC['mon_armour'] = "";
		$newNPC['mon_shield'] = "";
		$newNPC['montype_skillp'] = "";
		$newNPC['montype_att'] = "";
		$newNPC['montype_cr'] = "";
		$newNPC['mon_alignment'] = "";
		$newNPC['mon_environment'] = "";
		$newNPC['mon_level_adj'] = "";
		$newNPC['mon_skill_rule'] = "";
		$newNPC['savemon_key'] = "";
		$newNPC['count_new_x'] = "";
		$newNPC['save_count'] = "";
		$newNPC['specials'] = array();
		$newNPC['specials']['aura'] = array();
		$newNPC['specials']['spell'] = array();
		$newNPC['specials']['attack'] = array();
		$newNPC['specials']['range'] = array();
		$newNPC['specials']['CMD'] = array();
		$newNPC['specials']['CMB'] = array();
		$newNPC['specials']['reach'] = array();
		$newNPC['specials']['specialAttacks'] = array();
		$newNPC['specials']['specialAbilities'] = array();
		$newNPC['specials']['stats'] = array();
		$newNPC['specials']['stats']['str'] = array();
		$newNPC['specials']['stats']['con'] = array();
		$newNPC['specials']['stats']['dex'] = array();
		$newNPC['specials']['stats']['int'] = array();
		$newNPC['specials']['stats']['wis'] = array();
		$newNPC['specials']['stats']['chr'] = array();



		return $newNPC;
	
	}

}
	



/* 
	Get session dgTools and merge it into current version 
*/
/*
function mergeSessionDGTools($dgTools) {
	$result = $dgTools;

	if ( isset($_SESSION['dgTools'] )) {
		$sesDGTools = $_SESSION['dgTools'];
		$result = array_replace_recursive($dgTools, $sesDGTools);
	}

	return $result;
}
*/

/*
	Get encoded dgTools and merge into current version 
*/
function mergeEncodedDGTools($dgTools) {
	$result = $dgTools;

	if ( isset($_POST['dgToolsENCODED'] )) {
		$encDGTools = $_POST['dgToolsENCODED'];
		$encDGTools = decodeFromPost($encDGTools);
		$result = array_replace_recursive($dgTools, $encDGTools);
	}

	return $result;
}

/*
	Get plain text POST dgTools and merge into current version 

	Note that this relies on the PHP $_POST trick of handling arrays.
	See comments on http://php.net/manual/en/reserved.variables.post.php

*/
function mergePOSTDGTools($dgTools) {
	$result = $dgTools;

//error_log("$_POST". var_export($_POST,1));

	if ( !empty($_POST['dgTools'] )) {
		$postDGTools = $_POST['dgTools'];

//error_log("POST". var_export($postDGTools,1));

		/* When the user is loading a saved NPC, $_POST will pass an array for 
					load_savemon which contains only one value (the key of the saved NPC selected).
					This just extracts the value and stores in a variable (not array) in 
					dgTools */
		if ( !empty($postDGTools['NPCsArray'][getCurrentNPCNo($dgTools)]['load_savemon']) ) {
				$key_array = $postDGTools['NPCsArray'][getCurrentNPCNo($dgTools)]['load_savemon'];					
				$savemon_key = NULL;
				foreach($key_array as $temp_key) {
						$savemon_key = $temp_key;				
				}				
				$postDGTools['NPCsArray'][getCurrentNPCNo($dgTools)]['load_savemon'] = $savemon_key;
		}		

		/* Merge the values passed by $_Post with existing data */
		$result = array_replace_recursive($dgTools, $postDGTools);

//error_log("POST Post" .var_export($result,1));
	}

	return $result;
}

/*
	Get GET dgTools values and merge into current version 

	Due to security risks, only a few, specific values are supported 
*/
function mergeGETDGTools($dgTools) {
	$result = $dgTools;

	if (isset($_GET['key_1'])) {
		$key_1 = $_GET['key_1'];
		if ( in_array($key_1, array( PATHDINDER, DD35, PATHFINDER2) ) ) {
			$dgTools['meta']['key_1'] = $key_1;	
		} else {
			error_log("dgUtilityFunctions - Invalid key_1 passed in URL");	
		}
	}

	if (isset($_GET['page_tool'])) {
		$page_type = $_GET['page_type'];
		if ( in_array($page_type, array( PAGE_TOOL_NPC, PAGE_TOOL_TREASURE, PAGE_TOOL_ENCOUNTER) ) ) {
			$dgTools['meta']['page_type'] = $page_type;	
		} else {
			error_log("dgUtilityFunctions - Invalid page_type passed in URL");	
		}
	}


	if (isset($_GET['page_type'])) {
		$page_type = $_GET['page_type'];
		if ( in_array($page_type, array( PAGE_TYPE_SELECT, PAGE_TYPE_GENERATE, PAGE_TYPE_RESULT) ) ) {
			$dgTools['meta']['page_type'] = $page_type;	
		} else {
			error_log("dgUtilityFunctions - Invalid page_type passed in URL");	
		}
	}

	if (isset($_GET['page_target'])) {
		$page_target = $_GET['page_target'];
		if ( in_array($page_target, array( PAGE_TYPE_SELECT, PAGE_TYPE_GENERATE, PAGE_TYPE_RESULT) ) ) {
			$dgTools['meta']['page_target'] = $page_target;	
		} else {
			error_log("dgUtilityFunctions - Invalid page_target passed in URL");	
		}
	}

	return $result;
}




/*
			Encode a vairable / array ready for posting.
			Returns encoded string or emprty string if no data passed
*/
	function encodeForPost($data) {
			
		if (isset($data) ) {
			$encoded = urlencode(base64_encode(serialize($data)))	;		
		} else {
			$encoded = "";
		}

		return $encoded;

	}



/*
			Decodes a vairable / array passed via posting
			Returns decode variable or emprty string if no data passed
*/
	function decodeFromPost($rawdata) {
			
		if (isset($rawdata) ) {
			$decode = unserialize(base64_decode(urldecode($rawdata)));
		} else {
			$decode = "";
		}

		return $decode;

	}


/*
		Returns an encoded post variable ready for use
*/
	function getEncodedPostVariable($variableID) {
		$result = "";

		if (isset($_POST[$variableID] ) ) {
				$raw = $_POST[$variableID];
				$result = decodeFromPost($raw);
		}

		return $result;

	}

/*
		Returns an unencoded post /get variable ready for use
*/
/*
	function getUnencodedPostOrGetVariable($variableID, $default = "") {
		$result = $default;

		if (isset($_POST[$variableID] ) ) {
				$result = $_POST[$variableID];
		} else if ( isset($_GET[$variableID]) ) {
				$result = $_GET[$varaibleID];
		}

		return $result;

	}

*/
/*
			Get the value of a cookie. Returns empty string if not set.
*/
	function getCookieValue($cookieID) {
		$result = "";	

		if (isset($_COOKIE[$cookieID]) ) {
		   $result = $_COOKIE[$cookieID];
		}

		return $result;

	}
	
function addMSG($dgTools, $msg) {
		if (!empty($msg) ) {
				if (is_array($msg)) {
						if (isset($msg['msg'] ) ) {
								$msg['msg'] = wrapHTMLSpan($msg['msg'] , "dgToolsMSG");
						}
				} else {
						$msg = wrapHTMLSpan($msg, "dgToolsMSG");
				}
		}
		if ( $dgTools['meta']['msg'] === MSG_ALL_OK ) {
				$dgTools['meta']['msg'] = array($msg);
		} else {
				$dgTools['meta']['msg'][] = $msg;
		}

		return $dgTools;
}	

function cleanDGTools(&$value, $key ) {
		$value = trim($value);
}




?>