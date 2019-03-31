<?php
/*
*
*			dgGlobalHTMLFunctions			-		HTML & CSS useed site wide (not specifically dg Generators)
*
*/

/** ------ Load Additional Style Sheets ------ **/
function custom_style_sheet() {
	wp_enqueue_style( 'custom-styling', get_stylesheet_directory_uri() . '/css/style-tools.css' );
}
