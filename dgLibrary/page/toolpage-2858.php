<!-- Toolpage 2858 Start -->
<?php
/*

	Page 2858 - Multi-System NPC/Monster/Animal Companion Generator Form

	Loads / displays appropriate content dependent on required use.

	*** ALL *** Dingle Games monster generators etc should work through this form.

		------------------------------------------------------------------------

		Variable Scope 

		dgLoad handles loading of most code (see /dglibrary/README.txt). As a 
		function it has its own variable scope and files loaded within it
		operate in dgLoad's scrope not this code's (toolpage-2585) scope.

		Key variables, such as $dgTools need to be initialised 
		here and then passed to the required functions as a parameter.

*/      


/*

		Load utility functions needed by the tools

*/
require_once(locate_template('dgLibrary/dgUtilityFunctions.php'));	
require_once(locate_template('dgLibrary/dgUtilityDataFunctions.php'));	
require_once(locate_template('dgLibrary/dgUtilityHTMLFunctions.php'));	


$dgTools = initDGTools();

// error_log("Initial dgTools ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */


/* Enqueue placeholder JS (so we can added to it later) */
wp_enqueue_script( 'dgJS', get_stylesheet_directory_uri() .'/dgLibrary/dgPlaceholder.js', null, null, true );



/* 
	Decide what to do based on the tool in use, the type of page and it's status 
	
	page_tool = the Dingle Games tool in use
	page_type = the type of page currently displayed 	
	page_target = the type of page the user wants to display 	
	page_status = the correctness of the data	

	First validate the data. 

	If it is OK, display the page_target otherwise stay on the current page (page_type)


*/

$dgTools['meta']['msg'] = MSG_ALL_OK;

error_log("Pre-Vetting dgTools ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */

/* Assume all data is unvalidated and check it before going any further */
switch ($dgTools['meta']['page_tool']) {
		case PAGE_TOOL_NPC:
				dgLoad(NULL, 'dgNPCDataFunctions');
				switch ($dgTools['meta']['page_type'] ) {
					case PAGE_TYPE_SELECT:
							if ( $dgTools['meta']['page_status'] != PAGE_STATUS_NEW ) {
									/* Not a brand new page / request */
									/* Vet Data */
									$dgTools = vetNPC($dgTools);
									if ($dgTools['meta']['msg'] == MSG_ALL_OK) {
											/* Vetting OK */
											$dgTools['meta']['page_status'] = PAGE_STATUS_VETTED;
											$dgTools = makeNPC($dgTools);  /* Load standard monster / class */
									}
							}
	 						break;
					case PAGE_TYPE_LOAD:
							/* Load existing NPC */					
							$dgTools = loadNPC($dgTools);	/* Load standard monster / class plus saved data */	
							if ($dgTools['meta']['msg'] == MSG_ALL_OK) {
									/* Vetting OK so switch to target page */
									$dgTools['meta']['page_status'] = PAGE_STATUS_VETTED;
							}

							break;	
					case PAGE_TYPE_RESULT:
							/* Result page should change any data but drop through and treat as a generate page just to be safe */
					case PAGE_TYPE_GENERATE:
	/*						$meta['page_status'] =   XXXX vet function */
	/* TEST */
									$dgTools['meta']['page_status'] = PAGE_STATUS_VETTED;
							break;
					}
				break;
		case PAGE_TOOL_TREASURE:
		case PAGE_TOOL_ENCOUTER:
		default:		
				break;
}	

error_log("Post-Vetting dgTools ".var_export($dgTools,1));  /* <---- DEBUG Remove In Live System */


/* Page status should either be vetted or error by this stage */
if ( $dgTools['meta']['page_status'] == PAGE_STATUS_VETTED)  {
	/* Everything good, so switch to the target page */
	$dgTools['meta']['page_type'] = $dgTools['meta']['page_target'];
}

/* Display appropriate page / form */
switch ($dgTools['meta']['page_tool']) {
	case PAGE_TOOL_NPC:
		/* NPC Generator */
		switch ($dgTools['meta']['page_type']) {
			case PAGE_TYPE_SELECT:
				/* init NPC Data if needed */
				dgLoad($dgTools, "dgNPCSelectHTMLFunctions");
				dgLoad($dgTools, "dgNPCSelectForm");
				dgLoad($dgTools, "dgNPCHTMLFunctions");
				loadDynamicJSFile($dgTools, 'dgLibrary/dgNPCSelectJs.php');
				break;
			case PAGE_TYPE_GENERATE:
  			dgLoad($dgTools, "dgNPCGenerateHTMLFunctions");
				dgLoad($dgTools, "dgNPCGenerateForm");
				dgLoad($dgTools, "dgNPCHTMLFunctions");
//				loadDynamicJSFile($dgTools, 'dgLibrary/dgNPCGenerateJs.php');
				break;
			case PAGE_TYPE_RESULT:
//				dgLoad($dgTools, "dgNPCResultHTMLFunctions");
				dgLoad($dgTools, "dgNPCResultForm");
				dgLoad($dgTools, "dgNPCHTMLFunctions");
//				loadDynamicJSFile($dgTools, 'dgLibrary/dgNPCResultJs.php');
				break;
			default:
					error_log("Invalid Page Type in TOOLPAGE");
					error_log(var_export($dgTools,1));
					die("TOOLPAGE : Invalid Page Type");
		}
		break;


	case PAGE_TOOL_TREASURE:
//				dgLoad($dgTools, "dgPlaceholderForm");
			break;


	case PAGE_TOOL_ENCOUNTER:
			break;

	default:
			error_log(var_export($dgTools,1));
			die("Invalid Tool");
}


/* Add Div/CSS wrapper to for page type & status */
$dgClasses = "dgStatus_" . $dgTools['meta']['page_status'];
$dgClasses .= " "."dgType_" . $dgTools['meta']['page_type'];
$dgClasses .= " "."dgTool_" . $dgTools['meta']['page_tool'];
echo '<div id="dgToolsFormWrapper" class="'.$dgClasses.'">';

/* Reset page_status to Unknown so that when the user submits the form it gets check properly */
$dgTools['meta']['page_status'] = PAGE_STATUS_UNKNOWN;

/* Call standard display function common to all pages */
doDGDisplay($dgTools, 0); 

/* Close Wrapper */
echo '</div>';


?>
<!-- Toolpage 2858 END -->