<!- Template Parts / Entry / Comments - dg-tools ->
<?php
/*
		DG comments template. Only show on initial tools pages (monster selection etc) not the results 
*/

	if (isset($_POST[ "status" ]) && $_POST["status"] == "VETTED" ) {
		return;
}

/*  - Everything below here is a copy of the standard tregenza-one comments template */

	/* Define Callback function for handling individual templates */
function format_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

 if ( $args['style'] === 'div' ) {
		$tag = 'div';
		$add_below = 'comment';
		$commentClasses = "parent ";
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
		$commentClasses = "";
	}
	$commentClasses .= 'tregenza_one_block tregenza_one_block_comment ';
	$wrapperClass = comment_class( $commentClasses, null, null, false);
	echo '<'.$tag.' '.$wrapperClass.' id="comment-'.get_comment_ID().'" >';

	echo '<div class="tregenza_one_block_comment_avatar">';
	echo get_avatar($comment, $args['avatar_size']);
	echo '</div>';	

	echo '<div class="tregenza_one_block_comment_datetime">';
	echo '<a class="commentDateTimeLink toMinorButton" ';
	echo ' href="'.htmlspecialchars ( get_comment_link( $comment->comment_ID ) ).'" >';
	echo '<span class="comment-date">'.get_comment_date().'</span>';
	echo '<span class="comment-time">'.get_comment_time().'</span>';
	echo '</a>';
	echo '</div>';

	echo '<div class="tregenza_one_block_comment_author">';
	$author = get_comment_author();
	$authorUrl = get_comment_author_url();			
	echo '<a class="commentAuthorLink toMinorButton" href="'.$authorUrl.'" rel="external nofollow">';
	echo $author;
	echo '</a>';	
	echo '</div>';

	echo '<div class="tregenza_one_block_comment_moderation">';
	if ($comment->comment_approved == '0') {
		_e('Your comment is awaiting moderation.');
	}
	echo '</div>';

	echo '<div class="tregenza_one_block_comment_text">';
	comment_text(); 
	echo '</div>';

	echo '<div class="tregenza_one_block_comment_reply">';
	echo comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;
	echo '</div>';
	
/* 	echo '</li>';  */

}

/*  define function for adding class to pagination links */
function	addPageStyles($buffer) {
					/* class with double quotes */
					$newBuffer = str_replace('a class="', 'a class="toMinorButton ', $buffer);
					/* class with single quotes */
					$newBuffer = str_replace("a class='", "a class='toMinorButton ", $newBuffer);
					return $newBuffer;
			}


if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		return; 
}

?>
<!-- Template Parts / Entry / Coments - dgtools -->
<section id="comments" class="tregenza_one_block tregenza_one_block_comments">
	<?php 
		if ( have_comments() ) { 
			global $comments_by_type;
			$comments_by_type = separate_comments( $comments );
			if ( ! empty( $comments_by_type['comment'] ) ) { 
		?>
		<section id="comments-list" class="comments">
			<h3 class="comments-title" itemprop="commentCount">
				<?php 
					comments_number(); 
				?>
			</h3>
			<?php
		 			if ( get_comment_pages_count() > 1 ) { 
			?>
						<nav id="comments-nav-above" class="comments-navigation" role="navigation">
							<div class="paginated-comments-links"><?php 
				
									/*  Big Hack as there is no easy way to add classes to pagination links */
									ob_start("addPageStyles");

									paginate_comments_links(); 
								
									ob_end_flush();
								

							?></div>
						</nav>
			<?php 
					} 
			?>
			<ul>
				<?php 
					wp_list_comments( 'type=comment&callback=format_comment&avatar_size=64' ); 
				?>
			</ul>
			<?php 
				if ( get_comment_pages_count() > 1 ) { 
			?>
					<nav id="comments-nav-below" class="comments-navigation" role="navigation">
						<div class="paginated-comments-links"><?php 
				
									/*  Big Hack as there is no easy way to add classes to pagination links */
									ob_start("addPageStyles");

									paginate_comments_links(); 
								
									ob_end_flush();
								

							?></div>
					</nav>
			<?php 
				} 
			?>
<!-- Template Parts / Entry / Coments - END -->
			</section>

	<?php 
		}
 
		if ( ! empty( $comments_by_type['pings'] ) ) { 
			$ping_count = count( $comments_by_type['pings'] ); 
	?>
	<section id="trackbacks-list" class="comments">
		<h3 class="comments-title"><?php echo '<span class="ping-count">' . $ping_count . '</span> ' . ( $ping_count > 1 ? __( 'Trackbacks', 'blankslate' ) : __( 'Trackback', 'blankslate' ) ); ?></h3>
		<ul>
			<?php 
				wp_list_comments( 'type=pings' ); 
			?>
		</ul>
	</section>
	<?php 
		}
	}
	if ( comments_open() ) {
		comment_form();
	}
	?>
</section>