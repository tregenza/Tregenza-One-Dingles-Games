<!---- Template Parts / Entry / Content - Dingles Games Tools --->
<?php
		
		/* Dingles Games code has a lot of hardcoded style attributes in the HTML.
					This is shit and makes applying CSS much harder.
				So this code uses an output bufer (ob_start / ob_end) to scrub the styles by 
				 renaming style attributes as stylex . 

				This is a shit way of doing it as the real solution is to scrub all styles from the original code.
*/

			function	cleanStyles($buffer) {
					/* strip style tags using double quotes */
					$newBuffer = preg_replace('/style=/is', 'stylex=', $buffer, -1, $count);				
					return $newBuffer;
			}

?>

<!---- Content DG - the_content --->
<div class="tregenza_one_block tregenza_one_block_content" itemprop="articleBody">
	<?php 
		the_content(); 
	?>
	<!---- Content DG - Page ID specific content --->
	<?php 
		/*  Get Dingle Games custom variables set in ddmonsterFunction.php */
		$args = get_query_var('dg_vars');
		extract($args);

		ob_start("cleanStyles");

		$pageID = get_the_ID();
		require_once(locate_template('library/page/toolpage-'.$pageID.'.php' ));

		ob_end_flush();

	?>
</div>