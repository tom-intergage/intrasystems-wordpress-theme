<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
$query = new WP_Query( 'post_type="post"' );
if ( $query->have_posts() ){



 // wp_list_categories('orderby=name&title_li=');
}
?>
	<div id="primary" class="content-area blog-posts loading">
		<main id="main" class="site-main">
		  <section>
     <div class="row" >
     <div class="case-studies-cat">
     <div class="categories">
     <div class="row">
      <?php
       wp_list_categories('orderby=name&exclude=1,463&title_li=');
       ?>
       </div>
       </div>
       <div class="show_all">
       <a href="<?php echo get_home_url(); ?>/projects/" class="button">All Projects</a>
       </div>
      </div></div>


    </section>
		<?php if ( have_posts() ) : ?>
		<section><div class="row">



			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

            <div class="single-case-study in-list">

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

            <?php echo "<p>".get_intramatting_excerpt(get_the_excerpt(), 5)."</p>";
            ?>

           <?php if (get_field('read_more_link') ){ ?>
            <a class="button"  href="<?php the_permalink() ?>">Read more</a>

         <?php
       }

         ?>

</div>
        <?php
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>
			</div></section>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

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
