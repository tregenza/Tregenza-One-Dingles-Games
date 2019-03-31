<?php
/*
Template Name: Dingles Tools Page V2
Template Post Type: page

Template for Dingle's Games Tools.

It loads the relevent code for the specific DnD / Pathfinder tool via the Wordpress get_template_part function. [ https://developer.wordpress.org/reference/functions/get_template_part/ ]

This replaces the old ToolPage.php, ToolHeader.php, Alpha.php, Alpha2.php code.

Page specific content can be found in the library/page subdirectory and is named after the  page id. e.g. for page 43 (the basic tools page) the file is library/page/page-43.php


*/
?>

<?php

/* HIDE WARNING MESSAGE WHILE IN WORDPRESS DEBUG MODE */
/* Necessary because Dingles' tools has a shit load of them */
if (WP_DEBUG && WP_DEBUG_DISPLAY) {
	ini_set('error_reporting', E_ALL & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING );
}		

        ini_set('session.cache_limiter', 'private');
        session_start();
        header( 'Cache-Control: private, max-age=10800, pre-check=10800' ); 

		/* Load up some standard tools functions */
	require_once(locate_template('library/ddmonsterFunctions.php'));	

	/* Load the DG javascript. 
				Note this is called via the wp_footer action so that all releveant 
				page parts are loaded. And it depends on the static JS loaded via functions.php 
	*/
	function loadDynamicJS() {
		/* Load dynamically generated JS */
		/* Capture dynmically generated JS*/
		ob_start();
		include locate_template('library/ddmonsterJS.php');
		$dynamicJS = ob_get_clean();
		$result = 	wp_add_inline_script( 'dgJS', $dynamicJS);			/* add it to static JS loaded via the functions.php */
	
		if ( ! $result ) {
			error_log("Dynamic JS failed to load in Tools Page v2 Template");	
			die;
		}
	}
	add_action('wp_footer', 'loadDynamicJS');
	
?>

<?php
/*
			Standard Page (not post) layout
*/

$args = array(
								'template_type' => 'dgtools'
							);
set_query_var( 'to_template', $args);

?>

 <!-- Toolpage - get_header -->
	<?php 
	get_template_part('/template-parts/header/header', $args['template_type']); 
	?>
 <!-- Toolpage - get_sidebar -->
	<?php 
	get_template_part('/template-parts/sidebar/secundus', $args['template_type']); 
	?>

 <!-- Toolpage - section -->
<section id="content" role="main" class="tregenza-primus">
<!---- Toolpage - Start Loop --->
	<?php 
		get_template_part( 'template-parts/loop/loop', $args['template_type'] );  
	?>
<!---- Toolpage - End Loop --->

<!---- Toolpage - Archive Navigation --->
	<?php get_template_part( '/template-parts/loop/nav', 'below', $args['template_type'] ); ?>
 <!-- Toolpage - section END -->
</section>

		 <!-- Toolpage - get_sidebar -->
			<?php 
		get_template_part('/template-parts/sidebar/tertius', $args['template_type']); 
			?>
 <!-- Toolpage - get_footer -->
<?php 
		get_template_part('/template-parts/footer/footer'); 
?>