<?php
/**
 * Template Name: Page Install
 *
 */
$output = "";


get_header(); 

?>
   

   

	<div id="primary" class="content-area sections-page">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?> 
            <?php // Page content ?>
            <?php
               if($post->content !==''){

               

            ?>
            <section>
            <div class="row">
            <div class="excerpt-width">
            <?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <?php //echo "<p>".get_the_excerpt()."</p>"; ?>
            <?php echo the_content(); ?>
            
				   <?php //get_template_part( 'template-parts/content', 'page' ); ?>
               </div>
               </div>
				</section>
				
				<?php 
         }

            // Page sections ?>
				
			
				<?php
               if( have_rows('sections') ){
                  $counter = 1;
                
                  while( have_rows('sections') ): the_row(); 
           
                     $section_banner_type= get_sub_field('video_img');
                     $section_title = get_sub_field('section_title');
                     $section_desc = get_sub_field('section_desc');
                     $section_content = get_sub_field('section_content');
                     $output = "";
                  
                  if ($section_banner_type == 'video'){
                     
                        $iframe = get_sub_field('section_video'); 
                     
                     if ($iframe){
                        preg_match('/src="(.+?)"/', $iframe, $matches);
                        $src = $matches[1];
                        $params = array(
                            'controls'    => 0,
                            'hd'        => 1,
                            'autohide'    => 1
                        );
                        $new_src = add_query_arg($params, $src);
                        $iframe = str_replace($src, $new_src, $iframe);
                        $attributes = 'frameborder="0"';
                        $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
                       // $output .= "<section>";
                        $output .= "<a class='various fancybox.iframe' href='".$src."?autoplay=1'>";
                        $output .= "<div class='embed-section-video'>";
                        //$output .= $src;
                        //$output .= "<div class='embed-container'>";
                        //$output .= $iframe;
                        //$output .= "</div>";
                        $output .= "</div>";
                        $output .= "</a>";
                        //$output .= "</section>";
                     }
                    ?>

                       <?php

                       $output .= "<a class='various fancybox.iframe' href='".$src."?autoplay=1'>";
                       $output .= "<section class=' secondary_bg video text-center'>";
                       $output .= "<div >";
                       $output .= "<div class='row'>";

                       $output .= "<h3>";
                       $output .= "Watch our installation video";
                       $output .= "</h3>";
                       $output .= "</div>";
                       $output .= "</div>";
                       $output .= "</section></a>";

                        
 
                  }elseif($section_banner_type == 'image'){
                    // $output .= "hello";
                     
                     $section_img = get_sub_field('section_img'); 
                     
                     if($section_img){
                        $size = 'parallax';
                        $parallax_thumb = $section_img['sizes'][ $size ];

                        if (!$parallax_thumb){
                        $parallax_thumb = $section_img['sizes'][ 'full' ];  
                        }
                     }
                     
                     if($parallax_thumb){
                        
                        
                        $output .= "<div class='page-header'  style='background-image: url(".$parallax_thumb.");' ></div>";
                           
                           
                        
                     }
                     
                     
                  }
                  echo $output;

                  
                  ?>

                  <?php if ($counter % 2 ===0){
                     $extraClass = ' gray_bg';
                  }
                  else $extraClass = '';
                  ?>
                  <section class="<?php echo $extraClass; ?>">
                  <div class="row">
                  <div class="inner-width text-center">
                  <?php
                  echo "<h2>".$section_title."</h2>";
                  ?>
                  
                  <?php
                  ?>
                  <div class="section_content">
                  <?php
                  if($section_desc){
                  echo $section_desc;
                  }
                  echo $section_content;
                  ?></div>
                  </div></div></section>

                  
                  <?php
                  $counter++;

                  endwhile; 
?>
<section class="gray_bg text-center image-gallery">
<div class="row">
                  <?php


                     if( have_rows('image_gallery') ):

                        // loop through the rows of data
                         while ( have_rows('image_gallery') ) : the_row();
                     ?>
                     <div class="gallery_item small-12 medium-4 columns ">
                     <?php

                             // display a sub field value
                             $image = get_sub_field('image');
                             echo wp_get_attachment_image( $image , 'full' );
                             
                     ?>
                     </div>

                     <?Php

                         endwhile;

                     else :

                         // no rows found

                     endif;
                     ?>

                  </div>
                  </section>
<?php
               } 


?>
<?php endwhile; // End of the loop. ?>


				   

			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
