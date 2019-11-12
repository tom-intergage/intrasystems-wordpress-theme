<?php
/**
 * The template for displaying all single posts.
 *
 * @package axishouse
 */

get_header(); ?>
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">
<?php
$output           =  "";
$parallax         =  get_field('parallax_img' );

if($parallax){
   $size = 'parallax';
   $parallax_thumb = $parallax['sizes'][ $size ];
   if (!$parallax_thumb){
   $parallax_thumb = $parallax['sizes'][ 'full' ];
   }
}

$case_study = false;
$extraClass = "";
if( have_rows('carousel_items') ){
   $case_study = true;
   $extraClass = " half_col";
}


?>
		<?php while ( have_posts() ) : the_post(); ?>


			<?php
			$id = get_the_ID();

			if ( have_rows( 'layouts', $id ) ) :

			    while ( have_rows( 'layouts', $id ) ) :

			      the_row();

			        get_template_part( 'layouts/' . get_row_layout() );

			    endwhile;

			endif;
			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
