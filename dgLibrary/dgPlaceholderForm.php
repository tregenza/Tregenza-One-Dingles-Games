<?PHP
/*
*
*		dgPlaceholderForm				-					Does nothing. For development / debugging   
*
*/


/*

	doDGDisplay - Display the form 

*/
if ( !function_exists("doDGDisplay")) {

	function doDGDisplay( $dgTools ) {
	
		displayForm($dgTools, 0);
	
	}

}

/*

 Display the form 

*/
if ( !function_exists("displayForm")) {

	function displayForm($dgTools, $npcNo) {

			$html = "";				

			$msg = getStatusMessageHTML($dgTools['meta']['msg']);

			$formHeader = '<FORM class="tregenza_one_dg_form" METHOD="post" ACTION="';
			$formHeader .= getDgFormPostURL();
			$formHeader .= '">';

			$formContent = "";
			$formContent .= "Placeholder HELLO WORLD Placeholder";

			$formHidden = "";
			$formHidden =  getPostDGToolsEncoded($dgTools);

			$formHidden .= getPageFlowVariablesHTML(PAGE_TYPE_SELECT, PAGE_TYPE_SELECT, PAGE_STATUS_UNKNOWN);

			$formFooter = '</FORM>';

			$form = $formHeader.$formContent.$formHidden.$formFooter;		
//			$form = $formHeader.$formContent.$formFooter;		

			$html = wrapHTMLBlock($msg.$form, "dgForm");	

			echo $html;

	}

}

