<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package axishouse
 */

?>

<?php
if ( get_post_status ( 153 ) == 'publish' ) {

$footer_tel = get_field('tel', 153 ); 
$footer_fax = get_field('fax', 153 ); 
$footer_email = get_field('email', 153 ); 
$footer_address_1 = get_field('address_1', 153 );
$footer_address_2 = get_field('address_2', 153 );
$footer_city = get_field('city', 153 );
$footer_zipcode = get_field('zipcode', 153 );

}?>
   


	</div><!-- #content -->
	
	<footer id="colophon" class="site-footer">
		
		<!--<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'axishouse' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'axishouse' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'axishouse' ), 'axishouse', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div>
		
		-->
		
		<!-- .site-info -->
		
		<div class="grey-pre-footer">

		   A truly global brand, with specifiers and installers throughout Europe, Asia, North &amp; South America, Australia and New Zealand. 
		</div>
		
	<div class="footer-black">
		<div class="footer-top" style="display:none">
	      	<div class="footer-contact">
			   <div class="f_tel rwd-line"><p><span class="blue-highlight">t</span> <?php echo $footer_tel;  ?></p></div>
			   <div class="f_email rwd-line"><p><span class="blue-highlight">e</span> <a href="mailto:<?php echo $footer_email;  ?>"><?php echo $footer_email;  ?></a> </p> </div>
			</div>
			<div class="footer-logos">
			<span class="rwd-line">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-intramatting-white-footer.png" alt="Intramatting"  class="logo">
            	<img src="<?php echo get_template_directory_uri(); ?>/img/logo-intraweave-white.png" alt="Intraweave"  class="logo">
            </span>
			<span class="rwd-line">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-intratile-white.png" alt="Intratile"  class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-intragrille-white.png" alt="Intragrille"  class="logo"></span>
			</div>
		</div>

		<div class="footer-middle">

			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div id="footer-widget-1" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div id="footer-widget-2" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
				<div id="footer-widget-3" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
			<?php endif; ?>

			<div class="clearfix"></div>

		</div>
		
		<div class="footer-bottom">
	
		<div class="footer-copyright">
    
      
		   &copy; <?php echo date('Y'); ?> All rights reserved - INTRAsystems is a brand of Axis House Ltd. Axis House Ltd is a limited company registered in England and Wales with registered number 11583672 and with its registered office at:
		   <?php echo $footer_address_1;  ?>
		   <?php echo $footer_address_2;  ?> 
		   <?php echo $footer_city;  ?> 
		   <?php echo $footer_zipcode;  ?> 
		   <span class="rwd-line">t <?php echo $footer_tel; ?></span> 
		   <span class="rwd-line">f <?php echo $footer_fax; ?> </span> 
		   <span class="rwd-line">e <a href="mailto:<?php echo $footer_email; ?>"><?php echo $footer_email; ?></a>  </span>
		   
		</div>
		
		<div class="footer-navigation"> 
		   <nav>
			   <!--<button class="menu-toggle" aria-controls="footer-menu" aria-expanded="false"><?php esc_html_e( 'Footer Menu', 'axishouse' ); ?></button>-->
			   <?php //wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu' ) ); ?>
			   <?php axishouse_footer_links(); ?>
		   </nav><!-- #site-navigation -->
		</div>
	
		</div>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php get_template_part( 'template-parts/content', 'popup' ); ?>

</body>
</html>
