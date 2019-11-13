
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
get_header(); ?>

  <div id="primary" class="inner-width content-area">
    <main id="main" class="site-main" role="main">

      <?php
      // the query
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

      $wpb_all_query = new WP_Query(array('post_type'=>'news', 'post_status'=>'publish', 'posts_per_page'=>200,'paged' => $paged)); ?>

      <section>

          <div class="row">

            <div class="prod_list news_list">

          <?php if ( $wpb_all_query->have_posts() ) : ?>

            <!-- the loop -->
            <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>

            <?php

            $image_id = get_post_thumbnail_id();
            $imagesize = "large";

            $image_url = wp_get_attachment_image_src($image_id, $imagesize, true);

            ?>


            <div>
              <div class="thumb-featured">
                <img src="<?php echo $image_url[0]; ?>">
              </div>
              <div class="prod-info">
                <p class="prod-title"><strong><?php the_title(); ?></strong></p>
                <p><em><?php the_date(); ?></em></p>
                <p><?php the_excerpt(); ?></p>

                <a class="small-blue-btn" href="<?php the_permalink(); ?>" target="_self">Read more</a>
              </div>
            </div>

            <?php endwhile; ?>
            <!-- end of the loop -->



            </div>

            <div class="prod_list pagination">
              <?php

              $big = 999999999; // need an unlikely integer
 echo paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wpb_all_query->max_num_pages
) );

               ?>
            </div>

          </div>

      </section>

        <?php wp_reset_postdata(); ?>

      <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>

    </main>
  </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
