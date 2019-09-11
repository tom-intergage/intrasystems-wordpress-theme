<?php
/* Template Name: Landing-four */
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

						<h4>Register your interest here:</h4>

						<div id='form-download' class='popup-form-download'>

							<?php echo do_shortcode('[contact-form-7 id="6970" title="New Product Launch"]'); ?>
						   
						   <p id='file_url1' style='display:none;'>Thanks for registering your interest!</p> 
						
						</div>

         			</div>

					<div class="google-map">
          
          				<img src="/wp-content/uploads/2018/10/intrashape-img2.png" alt="New Product Launch" />
         
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