<?php
/**
 *
 * Template Name: Resources
 *
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

	<div id="primary" class="inner-width content-area">
		<main id="main" class="site-main" role="main">

<?php 

while ( have_posts() ) : the_post(); 

?>

            <section>
            	<div class="row">

					<div class="news_list">

<?php

	if( have_rows('resources') ){

		while( have_rows('resources') ): the_row();

			$image = get_sub_field('image');

			//echo '<pre>';
			//print_r($image);
			//echo '</pre>';

			$file = get_sub_field('pdf');

?>
					    <div>
            				<div class="thumb-featured">
                				<img src="<?php echo $image['sizes']['resource-thumb']; ?>" alt="<?php echo get_sub_field('title'); ?>">
              				</div>
              				<div class="prod-info">
                				<p class="prod-title"><strong><?php echo get_sub_field('title'); ?></strong></p>
                				<p><?php echo get_sub_field('text'); ?></p>
                				<a class="small-blue-btn" href="<?php echo $file; ?>" target="_blank">Download PDF</a>
              				</div>
              				<div style="clear:both"></div>
            			</div>

<?php

		endwhile;

	}

?>
					</div>

				</div>

			</section>
	
<?php 

endwhile;

?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>