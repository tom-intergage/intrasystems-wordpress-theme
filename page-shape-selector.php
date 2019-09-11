<?php
/* Template Name: Shape Selector */
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

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<section id="shape-selector-step-1">

			<div class="row">

				<div class="excert-width">

					<h2 class="entry-title">Choose your shape</h2> 

<?php 

while ( have_posts() ) : the_post();

?>

					<?php the_content(); ?>

<?php

endwhile;

// End of the loop.

?>

					<ul id="shape-options">
						<li>
							<a href="#" id="triangle" data-examples="triangle-examples" data-downloads="triangle-downloads" data-shape="triangle">
								<span class="shape"><img src="/wp-content/themes/axishouse/img/shape-selector/triangle.png" alt="Triangle Shape Carpets"></span>
								<span class="txt">Triangle</span>
							</a>
						</li>
						<li>
							<a href="#" id="square" data-examples="square-examples" data-downloads="square-downloads" data-shape="square">
								<span class="shape"><img src="/wp-content/themes/axishouse/img/shape-selector/square.png" alt="Square Shape Carpets"></span>
								<span class="txt">Square</span>
							</a>
						</li>
						<li>
							<a href="#" id="rectangle" data-examples="rectangle-examples" data-downloads="rectangle-downloads" data-shape="rectangle">
								<span class="shape"><img src="/wp-content/themes/axishouse/img/shape-selector/rectangle.png" alt="Rectangle Shape Carpets"></span>
								<span class="txt">Rectangle</span>
							</a>
						</li>
						<li>
							<a href="#" id="diamond" data-examples="diamond-examples" data-downloads="diamond-downloads" data-shape="diamond">
								<span class="shape"><img src="/wp-content/themes/axishouse/img/shape-selector/diamond.png" alt="Diamond Shape Carpets"></span>
								<span class="txt">Diamond</span>
							</a>
						</li>
						<li>
							<a href="#" id="hexagon" data-examples="hexagon-examples" data-downloads="hexagon-downloads" data-shape="hexagon">
								<span class="shape"><img src="/wp-content/themes/axishouse/img/shape-selector/hexagon.png" alt="Hexagon Shape Carpets"></span>
								<span class="txt">Hexagon</span>
							</a>
						</li>
						<li>
							<a href="#" id="mixed" data-examples="mixed-examples" data-downloads="mixed-downloads" data-shape="mixed">
								<span class="shape"><img src="/wp-content/themes/axishouse/img/shape-selector/mixed.png" alt="Mixed Shape Carpets"></span>
								<span class="txt">Mixed</span>
							</a>
						</li>
					</ul>

					<div id="example-wrapper">

						<p>Please select an example below to learn more</p>

						<div id="triangle-examples" class="example-images">
<?php

// load triangle images
if( have_rows('triangle_example_images') ):

 	while ( have_rows('triangle_example_images') ) : the_row();

        $image = get_sub_field('image');
        $image_title = get_sub_field('image_title');
        $image_description = get_sub_field('image_description');

?>

							<a href="<?php echo $image['sizes']['shape-selector']; ?>" class="fancybox" rel="trianglegallery" title="<?php echo $image_title; ?>$<?php echo $image_description; ?>">
								<img src="<?php echo $image['sizes']['shape-selector-thumb']; ?>" alt="<?php echo $image_title; ?>" />
								<span><?php echo $image_title; ?></span>
							</a>

<?php 

    endwhile;

endif;

?>

						</div>

						<div id="square-examples" class="example-images">

<?php

// load square images
if( have_rows('square_example_images') ):

 	while ( have_rows('square_example_images') ) : the_row();

        $image = get_sub_field('image');
        $image_title = get_sub_field('image_title');
        $image_description = get_sub_field('image_description');

?>

							<a href="<?php echo $image['sizes']['shape-selector']; ?>" class="fancybox" rel="squaregallery" title="<?php echo $image_title; ?>$<?php echo $image_description; ?>">
								<img src="<?php echo $image['sizes']['shape-selector-thumb']; ?>" alt="<?php echo $image_title; ?>" />
								<span><?php echo $image_title; ?></span>
							</a>

<?php 

    endwhile;

endif;

?>

						</div>

						<div id="rectangle-examples" class="example-images">

<?php

// load rectangle images
if( have_rows('rectangle_example_images') ):

 	while ( have_rows('rectangle_example_images') ) : the_row();

        $image = get_sub_field('image');
        $image_title = get_sub_field('image_title');
        $image_description = get_sub_field('image_description');

?>

							<a href="<?php echo $image['sizes']['shape-selector']; ?>" class="fancybox" rel="rectanglegallery" title="<?php echo $image_title; ?>$<?php echo $image_description; ?>">
								<img src="<?php echo $image['sizes']['shape-selector-thumb']; ?>" alt="<?php echo $image_title; ?>" />
								<span><?php echo $image_title; ?></span>
							</a>

<?php 

    endwhile;

endif;

?>
						</div>

						<div id="diamond-examples" class="example-images">

<?php

// load diamond images
if( have_rows('diamond_example_images') ):

 	while ( have_rows('diamond_example_images') ) : the_row();

        $image = get_sub_field('image');
        $image_title = get_sub_field('image_title');
        $image_description = get_sub_field('image_description');

?>

							<a href="<?php echo $image['sizes']['shape-selector']; ?>" class="fancybox" rel="diamondgallery" title="<?php echo $image_title; ?>$<?php echo $image_description; ?>">
								<img src="<?php echo $image['sizes']['shape-selector-thumb']; ?>" alt="<?php echo $image_title; ?>" />
								<span><?php echo $image_title; ?></span>
							</a>

<?php 

    endwhile;

endif;

?>

						</div>

						<div id="hexagon-examples" class="example-images">

<?php

// load hexagon images
if( have_rows('hexagon_example_images') ):

 	while ( have_rows('hexagon_example_images') ) : the_row();

        $image = get_sub_field('image');
        $image_title = get_sub_field('image_title');
        $image_description = get_sub_field('image_description');

?>

							<a href="<?php echo $image['sizes']['shape-selector']; ?>" class="fancybox" rel="hexagongallery" title="<?php echo $image_title; ?>$<?php echo $image_description; ?>">
								<img src="<?php echo $image['sizes']['shape-selector-thumb']; ?>" alt="<?php echo $image_title; ?>" />
								<span><?php echo $image_title; ?></span>
							</a>

<?php 

    endwhile;

endif;

?>

						</div>

						<div id="mixed-examples" class="example-images">

<?php

// load mixed images
if( have_rows('mixed_example_images') ):

 	while ( have_rows('mixed_example_images') ) : the_row();

        $image = get_sub_field('image');
        $image_title = get_sub_field('image_title');
        $image_description = get_sub_field('image_description');

?>

							<a href="<?php echo $image['sizes']['shape-selector']; ?>" class="fancybox" rel="mixedgallery" title="<?php echo $image_title; ?>$<?php echo $image_description; ?>">
								<img src="<?php echo $image['sizes']['shape-selector-thumb']; ?>" alt="<?php echo $image_title; ?>" />
								<span><?php echo $image_title; ?></span>
							</a>

<?php 

    endwhile;

endif;

?>

						</div>

						<div id="form-wrapper">

							<p><strong>Get your free Photoshop pattern document resource here:</strong></p>

							<?php echo do_shortcode('[contact-form-7 id="6623" title="Photoshop Download"]'); ?>

							<div style="clear:both"></div>

						</div>

						<div id="downloads-wrapper">

							<h2>Download Photoshop Resource Patterns</h2>

							<div id="triangle-downloads" class="psd-downloads">

<?php

// load triangle downloads
if( have_rows('triangle_downloads') ):

 	while ( have_rows('triangle_downloads') ) : the_row();

        $photoshop_file = get_sub_field('photoshop_file');
        $photoshop_file_name = get_sub_field('photoshop_file_name');

?>

								<a href="<?php echo $photoshop_file['url']; ?>" target="_blank">
									<img src="/wp-content/themes/axishouse/img/shape-selector/photoshop-icon.png" alt="File Name" />
									<span><?php echo $photoshop_file_name; ?></span>
								</a>

<?php 

    endwhile;

endif;

?>

							</div>

							<div id="square-downloads" class="psd-downloads">

<?php

// load square downloads
if( have_rows('square_downloads') ):

 	while ( have_rows('square_downloads') ) : the_row();

        $photoshop_file = get_sub_field('photoshop_file');
        $photoshop_file_name = get_sub_field('photoshop_file_name');

?>

								<a href="<?php echo $photoshop_file['url']; ?>" target="_blank">
									<img src="/wp-content/themes/axishouse/img/shape-selector/photoshop-icon.png" alt="File Name" />
									<span><?php echo $photoshop_file_name; ?></span>
								</a>

<?php 

    endwhile;

endif;

?>

							</div>

							<div id="rectangle-downloads" class="psd-downloads">

<?php

// load rectangle downloads
if( have_rows('rectangle_downloads') ):

 	while ( have_rows('rectangle_downloads') ) : the_row();

        $photoshop_file = get_sub_field('photoshop_file');
        $photoshop_file_name = get_sub_field('photoshop_file_name');

?>

								<a href="<?php echo $photoshop_file['url']; ?>" target="_blank">
									<img src="/wp-content/themes/axishouse/img/shape-selector/photoshop-icon.png" alt="File Name" />
									<span><?php echo $photoshop_file_name; ?></span>
								</a>

<?php 

    endwhile;

endif;

?>

							</div>

							<div id="diamond-downloads" class="psd-downloads">

<?php

// load diamond downloads
if( have_rows('diamond_downloads') ):

 	while ( have_rows('diamond_downloads') ) : the_row();

        $photoshop_file = get_sub_field('photoshop_file');
        $photoshop_file_name = get_sub_field('photoshop_file_name');

?>

								<a href="<?php echo $photoshop_file['url']; ?>" target="_blank">
									<img src="/wp-content/themes/axishouse/img/shape-selector/photoshop-icon.png" alt="File Name" />
									<span><?php echo $photoshop_file_name; ?></span>
								</a>

<?php 

    endwhile;

endif;

?>

							</div>

							<div id="hexagon-downloads" class="psd-downloads">

<?php

// load hexagon downloads
if( have_rows('hexagon_downloads') ):

 	while ( have_rows('hexagon_downloads') ) : the_row();

        $photoshop_file = get_sub_field('photoshop_file');
        $photoshop_file_name = get_sub_field('photoshop_file_name');

?>

								<a href="<?php echo $photoshop_file['url']; ?>" target="_blank">
									<img src="/wp-content/themes/axishouse/img/shape-selector/photoshop-icon.png" alt="File Name" />
									<span><?php echo $photoshop_file_name; ?></span>
								</a>

<?php 

    endwhile;

endif;

?>

							</div>

							<div id="mixed-downloads" class="psd-downloads">

<?php

// load hexagon downloads
if( have_rows('mixed_downloads') ):

 	while ( have_rows('mixed_downloads') ) : the_row();

        $photoshop_file = get_sub_field('photoshop_file');
        $photoshop_file_name = get_sub_field('photoshop_file_name');

?>

								<a href="<?php echo $photoshop_file['url']; ?>" target="_blank">
									<img src="/wp-content/themes/axishouse/img/shape-selector/photoshop-icon.png" alt="File Name" />
									<span><?php echo $photoshop_file_name; ?></span>
								</a>

<?php 

    endwhile;

endif;

?>


							</div>

						</div>

					</div>

				</div>

			</div>

		</section>

	</main><!-- #main -->

</div><!-- #primary -->

<script>
var wpcf7Elm = document.querySelector( '.wpcf7' );

wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
    document.getElementById('downloads-wrapper').style.display = "block";
}, false );
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>