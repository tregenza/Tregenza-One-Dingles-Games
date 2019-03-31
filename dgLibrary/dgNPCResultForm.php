<?PHP
/*
*
*		dgNPCResultForm				-					Print friendly output for NPCs  
*
*/


/*

	doDGDisplay - Display the form 

*/
if ( !function_exists("doDGDisplay")) {

	function doDGDisplay( $dgTools ) {
	
		if ( sizeof(empty($dgTools['NPCsArray']) ==0 )) {
				error_log("dgNPCResultForm - No NPC Defined ");
//				die ("dgNPCResultForm - No NPC Defined ");
		}
	
		displayForm($dgTools, 0);
	
	}

}



/*

 Display the form 

*/
if ( !function_exists("displayForm")) {

	function displayForm($dgTools) {

			$html = "";				

echo var_export($dgTools,1);

			$msg = getStatusMessageHTML($dgTools['meta']['msg']);

			$formContent = "";
			$formContent .= "dgNPCResults Form";

			$formContent .= getResultFormHTML($dgTools);

			$html = dgMakeForm($formContent, "dgNPCGenerator");	

			echo $html;

	}

}


function getResultFormHTML($dgTools) {

		return $html;
}