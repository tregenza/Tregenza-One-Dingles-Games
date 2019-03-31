<?php
/*
Template Name: Dingles Tools Page V3
Template Post Type: page

		------------------------------------------------------------------------

		toolpagev3.php 

		Starting point for all Dingle Games generator / tools code.

		Mainly handles the loading of relevant template parts, not tools specifc code.

		------------------------------------------------------------------------

		Code Flow & Scope 

		toolpagev3.php is a page template and loaded when anypage using this template
		is displayed.

		This code should only handle Wordpress / Theme related tasks. All dgTools related
		code shuld be in specific page/toolpage-<id>.php files.	

		It happens after functions.php and in a different thread (scope) of code so
		cannot use variables defined in functions.php. It can use any functions 
		defined in functions.php because functions are always global in PHP. 

		Global variables defined elsewhere can be accessed (because they are global)
		but if you are using globals, you are doing it wrong.

		------------------------------------------------------------------------

		Template Parts & Scope 

		As per a standard Wordpress template, each part of the page is loaded seperately. 
		This places them in their own variable scope so varibles defined in toolpagev3.php
		are not available to them.

		The template parts arrangement allows Dingle Games tools to use the standard theme 
		layout. 

		Where dg tools need a specific layout, the individual template parts can be added
		to the template-parts directory (of the Dingle Games child theme, not the main Tregenza-one
		theme. 

		Note that the comments template section has an entry in /template-parts/ to hide 
		comments on most tool related pages.

		------------------------------------------------------------------------
		
		/dgLibrary/page/toolpage-2858.php

		Using the standard theme / template / Wordpress logic the code flows 
		(via code in /template-parts/entry/content-dgtools.php) to load 
		/dgLibrary/page/toolpage-2858.php.

		This is where all the Dingle Games logic / processing etc really takes place.			

		------------------------------------------------------------------------

*/





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