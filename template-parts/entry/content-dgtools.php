<!--Template Parts / Entry / Content - Dingles Games Tools -->
<!--Content DG - the_content -->
<div class="tregenza_one_block tregenza_one_block_content" itemprop="articleBody">
	<?php 
		the_content(); 
	?>
	<!--Content DG - Page ID specific content -->
	<?php 
		/*  Get Dingle Games custom variables set in ddmonsterFunction.php */
		/* Still needed ??? */
		$args = get_query_var('dg_vars');
		extract($args);

//		$pageID = get_the_ID();
		$template = locate_template('dglibrary/page/toolpage-'.GENERIC_PAGE_ID.'.php' );
		if (!empty($template)) {
				require_once($template);
		} else {
				die('Unable To find dgLibrary/page/toolpage-'.GENERIC_PAGE_ID.'.php'); 
		}
	?>
</div>
<!--Content DG - the_content END -->