<!--Template Parts / Entry / Content - Dingles Games Tools -->
<!--Content DG - the_content -->
<div class="tregenza_one_block tregenza_one_block_content" itemprop="articleBody">
	<?php 
		the_content(); 
	?>
	<!--Content DG - Page ID specific content -->
	<?php 
		/*  Get Dingle Games custom variables set in ddmonsterFunction.php */
		$args = get_query_var('dg_vars');
		extract($args);

		$pageID = get_the_ID();
		require_once(locate_template('dglibrary/page/toolpage-'.$pageID.'.php' ));


	?>
</div>
<!--Content DG - the_content END -->