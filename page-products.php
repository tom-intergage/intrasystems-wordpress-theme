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
   


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?> 
            <section>
            <div class="row">
            <div class="excerpt-width">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <?php echo "<p>".get_the_content()."</p>"; ?>
            <a class="large-blue-btn" href="/wp-content/themes/axishouse/pdf/Intrasystems-Brochure.pdf" target="_blank">Brochure Download</a>
            
				   <?php //get_template_part( 'template-parts/content', 'page' ); ?>
               </div>
               </div>
            </section>
            
            
				
            <?php

            get_template_part( 'template-parts/product', 'list' );
           
           
            ?>
				
         <?php
         
         ?>
         <?php if($parallax_thumb == "not a real value"){ ?>
			<div class="page-header parallax-window" data-parallax="scroll" data-position-y="bottom" data-image-src="<?php echo $parallax_thumb;  ?>">


         </div>
         <?php }?>
			
		
            <section>
            <div class="row">
            <div class="excerpt-width">
            
            <?php
               $id = 24;
               $temp = $post;
               $post = get_post( $id );
               setup_postdata( $post );
               ?>

               <h2 class="h1"><?php the_title(); ?></h2>

              <?php the_excerpt(); ?>
               <?php  echo "<a class='large-blue-btn' href='".get_the_permalink()."'>Read more</a>"; ?>

               <?php
               wp_reset_postdata();
               $post = $temp;
               ?>
               </div>
               </div>
            
            </section>
            


			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
