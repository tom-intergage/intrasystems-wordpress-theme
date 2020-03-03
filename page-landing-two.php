<?php
/* Template Name: Landing-two */
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

							<?php echo do_shortcode('[contact-form-7 id="6547" title="Shopping Centres Strategy for Overcoming eCommerce"]'); ?>
						   
						   <p id='file_url1' style='display:none;'>Thanks! Click <a href='/wp-content/themes/intrasystems-wordpress-theme/pdf/intrasystems-shopping-centres-ebook.pdf' target="_blank">here</a> to download your file.</a></p> 
						
						</div>

         			</div>

					<div class="google-map">
          
          				<img src="/wp-content/themes/intrasystems-wordpress-theme/img/book-cover-2.jpg" alt="Shopping Centre's Strategy For Overcoming eCommerce" />
         
         			</div>
         
         		</div>
         
         	</section>

         	<section>

         		<div class="row">


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
