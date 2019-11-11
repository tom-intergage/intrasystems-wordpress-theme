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
			?>


         <div class="row sectors">

            <div class="sector-content <?php echo $extraClass; ?>">
            <?php  the_content(); ?>

            <?php
               $spec_guidelines = get_field('spec_guidelines');
               if ($spec_guidelines){


            ?>
               <div class="specification">
                  <h3>Specification Guidelines</h3>
                  <?php echo $spec_guidelines; ?>
               </div>

            <?php
               }
            ?>
            </div>
            <?php if( have_rows('carousel_items') ){ ?>

            <div class="sector-cases">



<?php
// Big image

if( have_rows('carousel_items') ){
  $output .="<div id='sync1' class='owl-carousel'> ";
   while( have_rows('carousel_items') ): the_row();
      $image = get_sub_field('c_img'); // Return object/array
      $thumb = $image['sizes']['sector-case'];
      $output .="<div class='item' style='background-image:url(\"".$thumb."\");'>";
     // $output .= "<img src='". $thumb."' >";
      $output .= "<div class='row'>";
      $output .= "<div class='plus'>";

      $output .= "</div>";

      $output .= "</div>";
   /*
      $output .= "<div class='popup-box'>";
      $output .= get_sub_field('c_title');
      $output .= get_sub_field('c_desc');

      $output .= "</div>";*/

      $output .= "<div class='popup-box'>";
      $output .= "<div class='popup-inner'>";
      $output .= "<div class='popup-close'>";
      $output .= "</div>";

      $output .= "<div class='popup-content'>";
      $output .= "<h3>".get_sub_field('c_title')."</h3>";
      $output .= "<p>".get_sub_field('c_desc')."</p>";
      $product = get_sub_field('c_prod');
   if($product){
      $post = $product;
      setup_postdata($post);
      $output .= "<div class='sector_prod medium_exemption'>";
            $post_id = get_the_ID();
            $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'prod_featured-small' );
            if(!$prod_featured_img){
               $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
            }
            $output .="<div class='thumb-featured'><img src='".$prod_featured_img[0]."' ></div>";
            $logo_black = get_field('logo_black');
            $output .= "<div class='prod-info'><img src='".$logo_black['url']."' alt='".get_the_title()."'>";

            $output .= "<a class='small-blue-btn' href='".get_the_permalink()."'>Read more</a>";
            $output .= "</div></div>";
            $output .="<div class='clear'></div>";


      wp_reset_postdata();
   }

      $output .= "</div>";
      $output .= "</div>";
   $output .= "</div>";
   $output .="</div>";
	endwhile;
   $output .="</div>";
}
//Thumbnails

if( have_rows('carousel_items') ){
$output .= "<div class='slideshow'>";
  $output .="<div id='sync2' class='owl-carousel'> ";
   while( have_rows('carousel_items') ): the_row();

      $output .="<div class='item'>";
      $image = get_sub_field('c_img');
      $thumb = $image['sizes']['sector-case-thumb'];
      $output .= "<img src='". $thumb."' >";
      $output .="</div>";
	endwhile;
   $output .="</div>";
$output .= "</div>"; // Closing div of prod_info
}

echo $output;
?>

              <?php ?>

            </div>

            <?php } ?>
         </div>
      </section>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.

			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
