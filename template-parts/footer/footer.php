<?php
/***
*
*		TregenzaOne-Dingles-Games Footer
*
*		As per Tregenza-One standard footer but extra code added to load dynamic JS
*
*
***/
?>
	</div>  <!-- End of hfeed  -->

	 <!-- Footer  -->
		 <!-- Footer - End of #container  -->
		</div> 
		 <!-- footer - dynamic_sidebar-footer-widgets  -->
		<aside id="footSidebar" class="blockVariable">
				 <!-- Footer Menu  -->
			<?php
					if (has_nav_menu('footerMenu')) {
						echo '<nav class="footerMenuWrapper">';
						wp_nav_menu(array( 'theme_location' => 'footerMenu', 'container_id' => 'footerMenu' , 'container_class' => 'footerMenuContainer' ) );
						echo '</nav>';
					}	
		?>
				 <!-- Footer Widget  -->
		<?php
				/* Widget Area */
				dynamic_sidebar('footer-widget-bar');
			?>
		</aside>
		<footer id="footer" role="contentinfo" class="clear blockVariable">
		 <!-- Footer - wp_footer  -->
		<?php 
var_dump($_SESSION['dgTEST']);
			wp_footer(); 
		?>
		 <!-- Footer - wp_footer END  -->
		</footer>
		
	</body>

</html>