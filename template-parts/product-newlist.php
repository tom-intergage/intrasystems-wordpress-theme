<?php $output = ""; ?>

<script>
   jQuery(document).ready(function() {

      jQuery('.show_all').wrapInner('<li class="current-cat"></li>');

      jQuery('.products-filter li a').click(function(e) {
         e.preventDefault();
         var newCategory = jQuery(this).text();
         jQuery('.products-filter li').removeClass('current-cat');
         jQuery(this).closest('li').addClass('current-cat');
         console.log(newCategory);
         if (newCategory == "All Products") {
            jQuery('.individual-product').css({
               display: "block"
            });
         } else {



            jQuery('.individual-product').css({
               display: "none"
            });

            jQuery('.individual-product.' + newCategory).css({
               display: "block"
            });
         }


      });

   });
</script>

<style>
   .prod_list {
      flex-wrap: wrap;
      display: flex;
   }
</style>

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
      if ($the_query->have_posts()) {
         ?>
         <div class="case-studies-cat products-filter">
            <div class="categories">
               <div class="row">

                  <?php
                     wp_list_categories('orderby=name&child_of=463&title_li=');

                     ?>

               </div>
            </div>
            <div class="show_all">
               <a href="<?php echo get_home_url(); ?>/products/" class="large-blue-btn">All Products</a>
            </div>
         </div>
      <?php

         $output .= "<div class='prod_list'>";
         while ($the_query->have_posts()) {
            $the_query->the_post();
            if (in_category('Matting')) {
               $output .= "<div class='individual-product Matting'>";
            }
            else if (in_category('Ceilings')) {
               $output .= "<div class='individual-product Ceilings'>";
            } 
            else if (in_category('Grilles')) {
               $output .= "<div class='individual-product Grilles'>";
            }  else {
               $output .= "<div class='individual-product'>";
            }
            $post_id = get_the_ID();
            $prod_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'prod_featured-small');
            if (!$prod_featured_img) {
               $prod_featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
            }
            $output .= "<div class='thumb-featured'><img src='" . $prod_featured_img[0] . "' ></div>";
            $logo_black = get_field('logo_black');
            $output .= "<div class='prod-info'>";
            if ($logo_black) {
               $output .= "<img src='" . $logo_black['url'] . "' alt='" . $logo_black['alt'] . "'>";
            } else {
               $output .= "<p class='raleway-font'>" . get_the_title() . "</p>";
            }

            $my_excerpt = "<p>" . get_the_excerpt() . "</p>";
            $output .= $my_excerpt;
            $output .= "<a class='small-blue-btn' href='" . get_the_permalink() . "'>Read more</a>";
            $output .= "</div></div>";
         }
         $output .= "</div>";
         echo $output;
      }
      wp_reset_postdata();
      ?>
   </div>
</section>