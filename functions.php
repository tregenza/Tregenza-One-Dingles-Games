<?php
/*
		Functions.php for Dingles Games, child theme of Tregenza-One

		Loaded on all pages, it mananges session data and other key functions
		need across dingles games.

		-------------------------------------------------------------------

		Code Flow & Variable Scope 

		Functions.php is executed early in the Wordpress sequence, before page templates.

		It is a seperate thread (scope) of code from the templates which means variable defined 
		in this thread are not available in Page Templates.

		-------------------------------------------------------------------

		Purpose

		This file should only contain code relating to the entire site, not
		specific to NPC / treasure generators etc.

		This includes Dingle Games related membership and WooCommerce functionality.

		Plus any theme / plugin related code needed by the site but not dgTool related.				 	

		-------------------------------------------------------------------

*/


/* 
/* HIDE WARNING MESSAGE WHILE IN WORDPRESS DEBUG MODE 
* 		Necessary because Dingles' tools has a shit load of warning errors 
*
*/
if (WP_DEBUG && WP_DEBUG_DISPLAY) {
	ini_set('error_reporting', E_ALL & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING );
}		


/*
			Init Session
*/
ini_set('session.cache_limiter', 'private');
session_start();
header( 'Cache-Control: private, max-age=10800, pre-check=10800' ); 

header('X-XSS-Protection: 0');			/* <--- This is needed to prevent Chrome error - "Chrome detected unusual code ...". Might be just a development issue. Try removing from live site */ 

/* 
		Define Constants 
*/
define (PATHFINDER, "path");  /* Pathfinder rules ver 1 */
define (PATHFINDER2, "path2");  /* Pathfinder rules ver 2 */
define (DD35, "dd35");  /* D&D 3.5 */
		
define (PAGE_STATUS_NEW, "NEW");   /* First time the page has been loaded */
define (PAGE_STATUS_VETTED, "VETTED");  /* Page contents have been vetted */
define (PAGE_STATUS_UNKNOWN, "UNKNOWN");  /*  Page contents need to vetted */
define (PAGE_STATUS_ERROR, "ERROR");  /*  Something is wrong with the data */

define (PAGE_TYPE_SELECT, "SELECT");		/* Initial Selection Screen */
define (PAGE_TYPE_LOAD, "LOAD");		/* Load saveed data */
define (PAGE_TYPE_GENERATE, "GENERATE");		/* Main screen for editing data */
define (PAGE_TYPE_RESULT, "RESULT");		/* Display results only screen */

define (PAGE_TOOL_NPC, "NPC");				/* NPC / Monster Generator */
define (PAGE_TOOL_TREASURE, "TREASURE");				/* Treasure Generator */
define (PAGE_TOOL_ENCOUNTER, "ENCOUNTER");				/* Enconunter Generator */
define (PAGE_TOOL_ANIMAL, "ANIMAL");				/* Enconunter Generator */


define (PAGE_NEW, "NEW");
define (PAGE_VETTED, "VETTED");
define (PAGE_UNVETTED, "UNVETTED");
define (PAGE_UNKNOWN, "UNKOWN");					/* ??? Still needed ??? */

		
define (OUTPUT_HTML, "HTML");
define (OUTPUT_TEXT, "TEXT");
define (OUTPUT_SHORT_TEXT, "SHORT TEXT");
		
define (PAID_USER, True);
define (FREE_USER, False);
		
define (MSG_ALL_OK, "");
		
/* 
		Load all dgGlobal files from dgLibrary 
*/
$path = get_stylesheet_directory();
foreach( glob($path.'/dgLibrary/dgGlobal*.php') as $file ) {
	require_once( $file ) ;
}

/*
	

*/



/* 
		Add actions to the Wordpress hooks 
*/
add_action('wp_footer', 'loadPageJS');				/* Load dg custom javascript */		
add_action('wp_enqueue_scripts', 'custom_style_sheet');  /* load dg CSS */
//add_action( 'init', 'tools_cookie' );		/* ??? */
add_action( 'woocommerce_payment_complete', 'mysite_woocommerce_payment_complete', 10, 1 );  /* Update memberships on sales */


?>