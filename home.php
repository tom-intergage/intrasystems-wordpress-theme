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
$output = "";
$parallax_img  =  get_field('parallax_img' );
$parallax_thumb ="";
if($parallax_img){
   $size = 'parallax';
   $parallax_thumb = $parallax_img['sizes'][ $size ];

   if (!$parallax_thumb){
   $parallax_thumb = $parallax_img['sizes'][ 'full' ];
   }
}

get_header();

?>

<?php
$args = array('post_type'=> 'post',


             );
$query = new WP_Query( $args );
if ( $query->have_posts() ){
}
?>


	<div id="primary" class="blog-posts content-area">
		<main id="main" class="site-main">
		<section>
     <div class="row" >
     <div class="case-studies-cat">
     <div class="categories">
     <div class="row">
      <?php
       wp_list_categories('orderby=name&exclude=1,444,463&title_li=');
       ?>
       </div>
       </div>
       <div class="show_all">
       <li class="current-cat">
       <a href="<?php get_home_url(); ?>/projects/" class="large-blue-btn">All Projects</a>
       </li>
       </div>
      </div></div>


		</section>
		<section><div class="row">



			<?php while ( have_posts() ) : the_post(); ?>


          <div class="single-case-study">

              <?php
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
 $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'case-study-thumb' ); ?>

 <img src="<?php echo $image[0]; ?>">




<?php }else{
?>
 <img src="<?php echo get_template_directory_uri(); ?>/img/project-default.jpg">


<?php

  } ?>
           <?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>

            <?php echo "<p>".get_intramatting_excerpt(get_the_excerpt(), 5)."</p>"; ?>
             <?php if (get_field('read_more_link') ){ ?>



            <a class="button"  href="<?php the_permalink() ?>">Read more</a>

            <?php } ?>



         <?php

         ?>

</div>


			<?php endwhile; // End of the loop. ?>
			</div></section><section>
			<div class="row">
<?php
$big = 999999999; // need an unlikely integer
$args = array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $query->max_num_pages,
   'prev_text'          => __('< Previous ... '),
	'next_text'          => __(' ... Next >'),
   'after_page_number'  => ' | ',
);


echo paginate_links( $args );
?>
     </div>
      </section>


		</main><!-- #main -->
	</div><!-- #primary -->



  <?php get_template_part( 'template-parts/content', 'popup' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
function get_intramatting_excerpt($excerpt, $limit ){
  if (str_word_count($excerpt , 0) > $limit) {
          $words = str_word_count($excerpt , 2);
          $pos = array_keys($words);
          $excerpt  = substr($excerpt , 0, $pos[$limit]) . '...';
      }
      return $excerpt ;


}

?>
