<?php
/*

	dgUtilityHTMLFunctions 	-				General helper functions for outputing HTML

*/

/*  
			Display page status message 
*/
	function getStatusMessageHTML( $msg ) {

		$html = "";
		$js = '<script>'; /* Start Building Javascript to tag specific elements */
		$jsFunction = 'function() {';

//$jsFunction .= 'alert("test");';

		/* $msg can e a string, an array of strings or an array of arrays */
		if (isset($msg) ) {
				if (is_array($msg) ){
						foreach ($msg as $message) {
								if (is_array($message)) {
										$html .= '<div class="error">'.$message['msg'].'</div>' ;
										$jsFunction .= 'jQuery(\''.$message['selector'].'\').addClass("dgError");';
			  				} else {	
										$html .= '<div class="error">'.$message.'</div>' ;
								}
						}
				} else {	
					$html .= '<div class="error">'.$msg.'</div>' ;
				}
		}		
		$jsFunction .= '}';
		$js .= 'jQuery(window).load('.$jsFunction.');'; 
		$js .= '</script>';
		$html .= $js;
		return $html;
	}
	
/*
		Get HTML for posting a form vaiable 
*/

	function getPostVariableHTML($variable, $variableID) {

		if ( empty($variableID) ) {
				throw new Exception( "Invalid post varaible ID ".$variableId);
				return "";
		}

		if (!isset($variable) ) {
				$variable = "";
		}

		$encoded = encodeForPost($variable);

		$html = '<INPUT TYPE="hidden" NAME="';
		$html .= $variableID;
		$html .= ', VALUE="';
		$html .= $encoded;
		$html .= '"/>';

		return $html;
	}



/* 
		Wraps a DIV around text with optional additional classes 
*/

	function wrapHTMLBlock($text, $additionalClasses = "") {
		$result = '<div ';
		if ( !empty($additionalClasses) ) {
			$result .= 'class="'.$additionalClasses.'"';
		}

		$result .= '>'.$text.'</div>';

		return $result;
	}
	

/* 
		Wraps a span around text with optional classes 
*/
function wrapHTMLSpan($text, $additionalClasses = "") {
		return '<span class="'.$additionalClasses.'">'.$text.'</span>';	
} 

/* 
		Wraps a span around text with a "dgLabel" class 
*/
function wrapHTMLLabelSpan($text, $additionalClasses = "") {
		return wrapHTMLSpan($text, "dgLabel ".$additionalClasses);	
} 

/* 
		Wraps a span around text with a "dgValue" class 
*/
function wrapHTMLValueSpan($text, $additionalClasses = "") {
		return wrapHTMLSpan($text, "dgValue ".$additionalClasses);	
} 



/* 
		get HTML for the standard variables controling page flow 
*/
	function getPageFlowVariablesHTML($type, $target, $status) {

			$html = getPageTypeHTML($type);
			$html .= getTargetPageHTML($target);
			$html .= getPageStatusHTML($status);

			return $html;
	}


/*
		Get HTML for posting the target page type 
*/

	function getTargetPageHTML($target) {

		if ( in_array($target, array(PAGE_TYPE_SELECT, PAGE_TYPE_GENERATE, PAGE_TYPE_RESULT) ) ){

			$html = "<INPUT TYPE='hidden' NAME='dgTools[meta][page_target]'";
			$html .= " VALUE='";
			$html .= $target;
			$html .= "'/>";
		} else {
				die ("Invalid target page type in dgUtilityHTMLFunctions : ".$target);
		}
		return $html;
	}


/*
		Get HTML for posting the current page type 
*/

	function getPageTypeHTML($type) {

		if ( in_array($type, array(PAGE_TYPE_SELECT, PAGE_TYPE_LOAD, PAGE_TYPE_GENERATE, PAGE_TYPE_RESULT) ) ){

			$html = "<INPUT TYPE='hidden' NAME='dgTools[meta][page_type]'";
			$html .= " VALUE='";
			$html .= $type;
			$html .= "'/>";
	
		} else {
				die ("Invalid current page type in dgUtilityHTMLFunctions : ".$type);
		}
		return $html;
	}




/*
		Returns html for the page status, which is always UNVETTED
*/

	function getPageStatusHTML($status) {

		if ( in_array($status, array(PAGE_STATUS_NEW, PAGE_STATUS_UNKNOWN, PAGE_STATUS_VETTED, PAGE_STATUS_ERROR) ) ){

			$html = "<INPUT TYPE='hidden' NAME='dgTools[meta][page_status]'";
			$html .= " VALUE='";
			$html .= $status;
			$html .= "'/>";

		} else {
				die ("dgUtilityHTMLFunctions - Unknown Status: ".$status);
		}
	
		return $html;
	}


/*
		Get HTML for posting the DGTools array as an encoded string  
*/

	function getPostDGToolsEncoded($dgTools) {

		if (!isset($dgTools) ) {
				$dgTools = "";
		}

		$encoded = encodeForPost($dgTools);

		$html = '<INPUT TYPE="hidden" NAME="';
		$html .= 'dgToolsENCODED';
		$html .= ', VALUE="';
		$html .= $encoded;
		$html .= '"/>';

		return $html;
	}


/*
		Get HTML fragment for Name & Id for form inputs / buttons etc
*/

	function getNameId($keys, $id) {
		$html = "";
		$name = "";
	
		if ( is_array($keys) && sizeof($keys) > 0 ) {
			$name = "dgTools";
			foreach($keys as $key) {
				$name .= '['.$key.']';
			}
		}

		$html .= ' NAME="'.$name.'" ID="'.$id.'" ';
		return $html;
	}




	function getDGButtons() {
			/*  
					Returns all the standard form buttons regardless of page type / status.				
					It is up to CSS to display / hide buttons as necessary.
			*/

		$buttons = "";
		$buttons .= wrapHTMLBlock(getGenerateButton(), "dgButtonsGenerate");	
		$buttons .= wrapHTMLBlock(getRecalcButton(), "dgButtonsRecalc");	
		$buttons .= wrapHTMLBlock(getPrintButton(), "dgButtonsPrint");	
		$buttons .= wrapHTMLBlock(getEditButton(), "dgButtonsEdit");	
		$buttons .= wrapHTMLBlock(getLoadButton(), "dgButtonsLoad");	

		$buttons = wrapHTMLBlock($buttons, "dgFormButtons");
		return $buttons;
	}



	function getRecalcButton() {

		$html = "<button class='button' TYPE='submit'";
		$html .= "NAME='dgTools[meta][page_target]'";
		$html .= "VALUE='".PAGE_TYPE_GENERATE."'>" ;
		$html .= "Recalculate";
		$html .= "</button>";

		return $html;
	}




	function getPrintButton() {

//		$jScript = 'jQuery("#dgToolsFormWrapper").removeClass("dgType_GENERATE");';
//		$jScript .= 'jQuery("#dgToolsFormWrapper").addClass("dgType_RESULT");';

//		$html = "<button class='button' TYPE='button'";
		$html = "<button class='button' TYPE='Submit'";
		$html .= "NAME='dgTools[meta][page_target]'";
//		$html .= "ONCLICK='".$jScript."' ";
		$html .= "VALUE='".PAGE_TYPE_RESULT."'>" ;
		$html .= "Print";
		$html .= "</button>";

		return $html;
	}


	function getEditButton() {

//		$jScript = 'jQuery("#dgToolsFormWrapper").removeClass("dgType_RESULT");';
//		$jScript .= 'jQuery("#dgToolsFormWrapper").addClass("dgType_GENERATE");';

//		$html = "<button class='button' TYPE='button'";
		$html = "<button class='button' TYPE='Submit'";
		$html .= "NAME='dgTools[meta][page_target]'";
//		$html .= "ONCLICK='".$jScript."' ";
		$html .= "VALUE='".PAGE_TYPE_GENERATE."'>" ;
		$html .= "Edit";
		$html .= "</button>";

		return $html;
	}


	function getGenerateButton() {

		$html = "<button class='button' TYPE='submit'";
		$html .= "NAME='dgTools[meta][page_target]'";
		$html .= "VALUE='".PAGE_TYPE_GENERATE."'>" ;
		$html .= "Generate";
		$html .= "</button>";

		return $html;
	}



	function getLoadButton() {

		$html = "<button class='button' TYPE='submit'";
		$html .= "NAME='dgTools[meta][page_target]'";
		$html .= "VALUE='".PAGE_TYPE_GENERATE."'>" ;
		$html .= "Load";
		$html .= "</button>";

		return $html;
	}



	function dgMakeForm($formContent, $dgTools, $pageType, $pageTarget, $pageStatus, $additionalClasses = "") {
			$formHeader = '<FORM class="tregenza_one_dg_form '.$additionalClasses;
			$formHeader .= '" METHOD="post" ACTION="';
			$formHeader .= getDgFormPostURL();
			$formHeader .= '" ';
//			$formHeader $ddpost; // <--- FIX
			$formHeader .= '>';

			$formHidden =  getPostDGToolsEncoded($dgTools);

			$formHidden .= getPageFlowVariablesHTML($pageType, $pageTarget, $pageStatus);

			$formFooter = '</FORM>';

			$buttons = getDGButtons();

			/* Assemble Form - 
					 Note Buttons must come after Hidden because buttons may overwrite some hidden variables 
			*/ 
			$form = $formHeader.$formContent.$formHidden.$buttons.$formFooter;		

			$html = wrapHTMLBlock($form, $additionalClasses);

			return $html;			
	}




	function dgMakeRow($rowLabel, $rowValue,  $additionalClasses = "") {
			
			$html = wrapHTMLLabelSpan($rowLabel);
			$html .= wrapHTMLValueSpan($rowValue);	
			
			$html = wrapHTMLBlock($html, "dgRow ".$additionalClasses);	

			return $html;
		
	}


	function dgMakeRowTopLabel($rowLabel, $rowValue,  $additionalClasses = "") {
			
			$html = wrapHTMLBlock($rowLabel,"dgLabel");
			$html .= wrapHTMLBlock($rowValue, "dgValue");	
			
			$html = wrapHTMLBlock($html, "dgRowTopLabel dgRow ".$additionalClasses);	

			return $html;
		
	}


	function dgMakeRowNoLabel($rowValue,  $additionalClasses = "") {
			
			$html = wrapHTMLValueSpan($rowValue);	
			
			$html = wrapHTMLBlock($html, "dgRowNoLabel dgRow ".$additionalClasses);	

			return $html;
		
	}


	function dgMakeRowNoValue($rowLabel,  $additionalClasses = "") {
			
			$html = wrapHTMLLabelSpan($rowLabel);	
			
			$html = wrapHTMLBlock($html, "dgRowNoValue dgRow ".$additionalClasses);	

			return $html;
		
	}


	function dgMakeBlock($contents,  $additionalClasses = "", $blockLabel = "") {

			if ( !empty($blockLabel)) {  
					$contents = 	wrapHTMLLabelSpan($blockLabel, "dgBlockLabel") . $contents;		
			}
			$html = wrapHTMLBlock($contents, "dgBlockOfRows ".$additionalClasses);	

			return $html;
		
	}


	function dgMakeRowTable($tableHeader, $tableRows, $tableFooter,  $additionalClasses = "") {
			
			$html = "";
			$headers = "";
			$rows = "";
			$footer = "";
			
			if (!empty($tableHeader) ) {
					foreach($tableHeader as $header) {
								$headers .= wrapHTMLSpan($header, "dgRowTableHeader");	
					}
			}
			$headers = wrapHTMLBlock($headers, "dgRowTableHeaders");			

		
			if (!empty($tableRows) ) {
					foreach($tableRows as $row) {
							$values = "";
							foreach($row as $value) {
									$values .= wrapHTMLValueSpan($value, "dgRowTableValue");									
							}
							$rows .= wrapHTMLBlock($values, "dgRowTableValues");			
					}
			}
			$rows = wrapHTMLBlock($rows, "dgRowTableRows");			

			if (!empty($tableFooter) ) {
					$footer = wrapHTMLBlock($tableFooter, "dgRowTableFooter");
			}			
			
			$table = $headers . $rows . $footer;
			$html = wrapHTMLBlock($table, "dgRowTable dgRow ".$additionalClasses);	

			return $html;
		
	}



	function dgMakeSubRow($rowValue, $rowLabel = NULL,  $additionalClasses = "") {

			$html = "";			
			if ($rowLabel) {
					$html .= wrapHTMLLabelSpan($rowLabel);
			}
			$html .= wrapHTMLValueSpan($rowValue);	
			
			$html = wrapHTMLSpan($html, "dgSubRow ".$additionalClasses);	

			return $html;
		
	}


	function dgMakeRowOfSubRows($rowValuesArray, $rowLabel = NULL,  $additionalClasses = "") {
			$html = "";
			if ( $rowLabel ) {
					$html .= wrapHTMLLabelSpan($rowLabel);
			}			
			foreach ($rowValuesArray as $subRow) {
				$html .= wrapHTMLValueSpan($subRow);	
			}
	
			$html = wrapHTMLBlock($html, "dgRow dgRowOfSubRows ".$additionalClasses);	

			return $html;
		
	}


?>