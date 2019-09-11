<?php $output =""; ?>
  <section>
   <div class="row">
   <?php
      $args = array(
         'post_type'       => 'products',
         'order'           => 'ASC',
         'orderby'         => 'menu_order',     
         'posts_per_page'  => '-1'
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
            $output .= "<div class='prod-info'>";
            if($logo_black){
               $output .= "<img src='".$logo_black['url']."' alt='".$logo_black['alt']."'>";
            }
            else{
               $output .="<p class='raleway-font'>".get_the_title()."</p>";
            }

            $my_excerpt = "<p>".get_the_excerpt()."</p>";
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