<?php $output = ""; $category = get_field('category');?>

<section>
   <div class="row" id="row-of-products">
      <?php

      if ($category) {
      $args = array(
        'cat' => $category->term_id,
         'post_type'       => 'products',
         'order'           => 'ASC',
         'orderby'         => 'menu_order',
         'posts_per_page'  => '-1'
      );
      }
      else {
        $args = array(
           'post_type'       => 'products',
           'order'           => 'ASC',
           'orderby'         => 'menu_order',
           'posts_per_page'  => '-1'
        );
      }
      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) {
         ?>
         <div class="case-studies-cat products-filter">
            <div class="categories">
               <div class="row">

                  <?php
                     //wp_list_categories('orderby=name&child_of=463&title_li=');
                     $taxonomies = get_terms( array(
                       'orderby'       => 'name',
                       'child_of'           => 463,
                       'taxonomy' => 'category'
                     ));

                     if ( !empty($taxonomies) ) :

                           $outputC = '';

                           foreach( $taxonomies as $subcategory ) {
                             //print_r($subcategory);
                             $ad = '';
                             if ($category) {
                               if ($category->term_id == $subcategory->term_id) $ad = ' current-cat';
                             }

                             $outputC .= '<li class="cat-item cat-item-'.esc_attr( $subcategory->term_id ).$ad.'"><a href="'.get_site_url().'/'.esc_attr( $subcategory->slug ).'-products/">'. esc_html( $subcategory->name ) .'</a></li>';
                             }
                             echo $outputC;
                           endif;
                     ?>

               </div>
            </div>
            <div class="show_all">
              <?php

              $ad = ($category) ? 'large-white-btn' : 'large-blue-btn';

              ?>
               <a href="<?php echo get_home_url(); ?>/products/" class="<?php echo $ad ?>">All Products</a>
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
