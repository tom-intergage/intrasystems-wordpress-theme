<?php
/* Template Name: Landing */
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

			<section>

				<div class="row">

					<div class="excert-width">

						<h1 class="entry-title"><?php the_title(); ?></h1>

<?php 

while ( have_posts() ) : the_post();

?>

						<?php the_content(); ?>

					</div>

				</div>

			</section>
				
			<section>

				<div class="row">

					<div class="locations">

						<h4>Get your free whitepaper here:</h4>

						<div id='form-download' class='popup-form-download'>

							<?php echo do_shortcode('[contact-form-7 id="5846" title="WHITEPAPER: BIM vs CAD"]'); ?>
						   
						   <p id='file_url1' style='display:none;'>Thanks! Click <a href='/wp-content/themes/intergage-wordpress-theme/pdf/BIMvCAD-v2.pdf' target="_blank">here</a> to download your file.</a></p> 
						
						</div>

         			</div>

					<div class="google-map">
          
          				<img src="/wp-content/themes/intergage-wordpress-theme/img/book-cover.jpg" alt="BIM Vs CAD" />
         
         			</div>
         
         		</div>
         
         	</section>

         	<section>

         		<div class="row">

         			<p><strong class="blue-txt">Our whitepaper is for anyone within the architectural industry who uses Building Information Modelling or Computer Aided Design</strong></p>

         			<p>You can expect to learn exactly what both BIM and CAD are, how they have evolved over the years and get real insight into the opinions and experiences of industry experts who use these processes on a regular basis. If you’re unsure which process you should be using, this whitepaper will help you to make an informed decision backed by historical evidence and the results of our survey completed by industry experts. Download now to discover more.</p>

         		</div>

         	</section>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<script>
	var wpcf7Elm = document.querySelector( '.wpcf7' );
 
	wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
	    document.getElementById('file_url1').style.display = "block";
	}, false );
	</script>


<?php get_sidebar(); ?>
<?php get_footer(); ?>