<?php
/**
 * Template Name: Page with Sections
 *
 */
$output = "";


get_header(); 

?>
   

   

	<div id="primary" class="content-area sections-page">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?> 
            <?php // Page content ?>
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
				
				<?php // Page sections ?>
				
			
				<?php
               if( have_rows('sections') ){
                
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
                        
                        
                        $output .= "<div class='page-header parallax-window' data-parallax='scroll' data-position-y='bottom'  data-image-src='". $parallax_thumb."'></div>";
                           
                           
                        
                     }
                     
                     
                  }
                  echo $output;

                  
                  ?>
                  <section>
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

                  endwhile; 
               } 


?>
<?php endwhile; // End of the loop. ?>

<?php
if(get_field('search_filter')){
   
   $args = array(
      'post_type' =>'products',
      'posts_per_page' => -1,
   );
   $the_query = new WP_Query( $args );
   $output = '';
   // The Loop
   if ( $the_query->have_posts() ) {

   ?>
   <section class="secondary_bg">
      <div class="row ">
         <div class="ah-search">
            <form class="controls" id="Filters">
               <fieldset class="filter-group search">
                  <input id="filterQuery" type="text" placeholder="Search ..." />
               </fieldset>
               <div class="search-btn">
                  <a id="Reset" class="large-blue-btn">Show all</a>
               </div>
            </form>
         </div>
      </div>
   </section>
   <?php

   $output ="";
   $output .= "<section>";
   $output .= "<div class='row'>";
   $output .= "<div id='Container' class='container'>";
   $output .= "<div class='fail-message'><span>No items were found matching the selected filters</span></div> ";
   $output .="<div class='prod_list'>";   

      while ( $the_query->have_posts() ) {
         $the_query->the_post();

         $output .= "<div class='mix ".strtolower(get_the_title())." '>";
         $post_id = get_the_ID();
         $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'prod_featured-small' ); 
         if(!$prod_featured_img){
            $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' ); 
         }
         $output .="<div class='thumb-featured'><img src='".$prod_featured_img[0]."' ></div>";
         $logo_black = get_field('logo_black');
         $output .= "<div class='prod-info'>";
         
            if($logo_black){
            $output .= "<img src='".$logo_black['url']."' alt='".$logo_black['alt']."'>";
            }
            else{
               $output .="<p><strong>".get_the_title()."</strong></p>";  
            }         
         
        
         $my_excerpt = "<p>".get_the_excerpt()."</p>";
         $output .= $my_excerpt;
         $output .= "<a class='small-blue-btn' href='".get_the_permalink()."'>Read more</a>";
         $output .= "</div></div>";

      }
      $output .= "</div>";
      $output .= "</div>";
      $output .= "</div>";
      $output .= "</section>";

      echo $output;

      }
   wp_reset_postdata();
   ?>

   <script type="text/javascript">
      jQuery(document).ready(function ($) {

         multiFilter.init();
         $('#Container').mixItUp({
            controls: {
               enable: false
            },
            animation: {
               easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
               queueLimit: 3,
               duration: 600
            }
         });
      });
   </script>


   <?php } //end show filter
         ?>
				   

			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
