<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package axishouse
 */

get_header(); ?>
<?php


?>
  

 

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php //get_template_part( 'template-parts/content', 'page' ); ?>
				
	

<?php
$mainAddress = false;
$post_object = get_field('head_office');
$output ="";

if ($post_object){
   $mainAddress = true;
   $post = $post_object;
	setup_postdata( $post ); 
         
$mainAddress = true;
$footer_tel = get_field('tel' ); 
$footer_fax = get_field('fax' ); 
$footer_email = get_field('email' ); 
$footer_address_1 = get_field('address_1' );
$footer_address_2 = get_field('address_2' );
$footer_city = get_field('city');
$footer_zipcode = get_field('zipcode');
$footer_email2 = "info@intramatting.london";    // new email added a
   
   wp_reset_postdata();
   
}elseif ( get_post_status ( 153 ) == 'publish' ) {
$mainAddress = true;
$footer_tel = get_field('tel', 153 ); 
$footer_fax = get_field('fax', 153 ); 
$footer_email = get_field('email', 153 ); 
$footer_address_1 = get_field('address_1', 153 );
$footer_address_2 = get_field('address_2', 153 );
$footer_city = get_field('city', 153 );
$footer_zipcode = get_field('zipcode', 153 );
}
?>
<section>
<div class="row">
<div class="locations">
	
<?php

if ($mainAddress){

?>
	<div class="address">

		<div class="location">
			 
			<h4>Head Office</h4>
			
			<?php
	         $output .= $footer_address_1."<br>";
	         $output .= $footer_address_2."<br>";
	         $output .= $footer_city."<br>";                        
	         $output .= $footer_zipcode."<br>";
	         $output .= "<span>t </span>".$footer_tel."<br>";
	         $output .= "<span>f </span>".$footer_fax."<br>";
	         //$output .= "<span>e </span><a href='mailto:info@intramatting.com'>".$footer_email."</a><br>";
	         //$output .= "<span>e </span><a href='mailto:info@intramatting.london'>".$footer_email2."</a>";
	      	?>
	                        
			<p><?php echo $output; ?></p>

		</div>
	</div>
<?php

}

//location: parent repeater
//place: child repeater ?>

	<h4>Request a callback</h4>
	<?php echo do_shortcode('[contact-form-7 id="5510" title="Contact Form"]');?>

<?php if( have_rows('location') ): ?>
	<div>
	<?php while( have_rows('location') ): the_row(); ?>
		<div class="location">
			<h4><?php the_sub_field('continent'); ?></h4>
			<?php if( have_rows('Place') ): ?>
            <p>
					<?php while( have_rows('Place') ): the_row();
						$city = get_sub_field('city');
                  $country = get_sub_field('country');
			?>
						<?php echo $city . ", ". $country."<br>"; ?>
					<?php endwhile; ?>
         </p>
					<?php // end loop #2 (nested) ?>
			<?php endif; ?>
		</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>
         </div>


         <div class="google-map">
          <?php echo do_shortcode('[ank_google_map]'); ?>
         </div>
         </div>
         
         
         </section>


				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					/*if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
               */
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
