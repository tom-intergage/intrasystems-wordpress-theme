<?php $output =""; ?>
  <section>
   <div class="row">
   <?php
      $args = array(
         'post_type' => 'sectors',
         'posts_per_page'=>'-1',

      );
      $the_query = new WP_Query($args);
      if ( $the_query->have_posts() ) { 
         $output .= "<div class='prod_list'>";
         while ( $the_query->have_posts() ) {
            $the_query->the_post();
            $output .= "<div>";
            $post_id = get_the_ID();
            $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'prod_featured-small' ); 
            if(!$prod_featured_img){
               $prod_featured_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' ); 
            }
            $output .="<div class='thumb-featured'><img src='".$prod_featured_img[0]."' ></div>";
            $logo_black = get_field('logo_black');
            $output .= "<div class='prod-info'><h3>".get_the_title()."</h3>";
            $my_excerpt = ah_tokenTruncate(get_the_excerpt(), "50");
              
            $my_excerpt = "<p>".$my_excerpt."</p>";
 
            $output .= $my_excerpt;
            $output .= "<a class='small-blue-btn' href='".get_the_permalink()."'>Read more</a>";
            $output .= "</div></div>";
         }
         $output .= "</div>";
         echo $output;
      } 
      wp_reset_postdata();
   ?>
   </div>
</section>