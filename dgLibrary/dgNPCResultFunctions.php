<?php
/*

dgNPCResultFunctions   -   
*/

/* Wraps a span around text with optional classes */
function wrapHTMLSpan($text, $additionalClasses = "") {
		return '<span class="'.$additionalClasses.'">'.$text.'</span>';	
} 

/* Wraps the Bold / Highlight class span around text */
function wrapHTMLHighlight($text, $additionalClasses = "") {
		return wrapHTMLSpan($text, "dgNPCHighlight ".$additionalClasses);	
} 

function wrapHTMLLineHeader($text, $additionalClasses = "") {
		return wrapHTMLSpan($text, "dgNPCHighlight dgNPCLineHeader ".$additionalClasses);	
} 

function wrapHTMLParaHeader($text, $additionalClasses = "") {
		return wrapHTMLSpan($text, "dgNPCHighlight dgNPCLineHeader dgNPCParaHeader ".$additionalClasses);	
} 

function wrapHTMLValue($text, $additionalClasses = "") {
		return wrapHTMLSpan($text, "dgNPCValue ".$additionalClasses);	
} 

/* Wraps a dgBlock DIV around text with optional additional classes */
function wrapHTMLDGBlock($text, $additionalClasses = "") {
		return wrapHTMLBlock($text, "dgBlock ".$additionalClasses);
}


