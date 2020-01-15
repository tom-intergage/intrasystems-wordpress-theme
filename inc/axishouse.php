<?php

/* OPTIONS PAGE */

function register_acf_options_pages() {

    // Check function exists.
    if( !function_exists('acf_add_options_page') )
        return;

    // register options page.
    $option_page = acf_add_options_page(array(
        'page_title'    => __('Theme General Settings'),
        'menu_title'    => __('Theme Settings'),
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

// Hook into acf initialization.
add_action('acf/init', 'register_acf_options_pages');

/* SCHEMA */

function bybe_remove_yoast_json($data){
  $data = array();
  return $data;
}

add_filter('wpseo_json_ld_output', 'bybe_remove_yoast_json', 10, 1);
add_action('after_setup_theme','axishouse_start', 16);
add_filter( 'wpcf7_load_css', '__return_false' );

function axishouse_start() {

    add_action('init', 'axishouse_head_cleanup');
    add_filter('the_generator', 'axishouse_rss_version');
    add_filter( 'wp_head', 'axishouse_remove_wp_widget_recent_comments_style', 1 );
    add_action('wp_head', 'axishouse_remove_recent_comments_style', 1);
    add_filter('gallery_style', 'axishouse_gallery_style');
    add_action('wp_enqueue_scripts', 'axishouse_scripts_and_styles', 999);
    axishouse_theme_support();
}
function axishouse_head_cleanup() {

	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
}

function axishouse_rss_version() { return ''; }

function axishouse_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
function axishouse_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}
function axishouse_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

function axishouse_scripts_and_styles() {
  global $wp_styles;
  if (!is_admin()) {
    $theme_version = wp_get_theme()->Version;

    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/bower_components/foundation/js/vendor/modernizr.js', array(), '2.5.3', false );

    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js', array( 'jquery' ), $theme_version, true );
     wp_enqueue_script( 'mixitup-js', get_template_directory_uri() . '/js/jquery.mixitup.min.js', array( 'jquery' ), $theme_version, true );
     wp_enqueue_script( 'simple-lightbox', get_template_directory_uri() . '/js/simple-lightbox.min.js', array( 'jquery' ), $theme_version, true );

//THIS IS THE OLD STYLESHEET
    wp_enqueue_style( 'joints-stylesheet', get_template_directory_uri() . '/inc/styles/style.min.css', array(), time(), 'all' );

    wp_enqueue_style( 'fontawesome-icons', get_template_directory_uri() . '/library/font-awesome/css/font-awesome.css', array(), $theme_version, 'all' );


   wp_enqueue_style('halofonts', 'https://fast.fonts.net/cssapi/a72e0631-c1c2-4d3f-ab3f-ec26ac85f08d.css');

   wp_enqueue_style( 'axishouse-style', get_stylesheet_uri(), array(), 3 );
   wp_enqueue_style( 'axishouse-main-style', get_template_directory_uri() . '/library/carousel/owl.carousel.css' );
   wp_enqueue_style( 'fancybox-css', get_template_directory_uri() . '/library/fancybox/jquery.fancybox.css' );
   wp_enqueue_style( 'axishouse-fonts', get_template_directory_uri() . '/library/intrasys-font/intrasys-font.css' );
  // wp_enqueue_style( 'axishouse-carousel', get_template_directory_uri() . '/library/carousel/owl.theme.css' );
  // wp_enqueue_style( 'axishouse-carousel-theme', get_template_directory_uri() . '/library/css/style.css' );

	wp_enqueue_script( 'axishouse-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'axishouse-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
   wp_enqueue_script( 'axishouse-carousel-js', get_template_directory_uri() . '/library/carousel/owl.carousel.min.js', array( 'jquery' ), '', true );
   wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/js/parallax.min.js', array( 'jquery' ), '', false );

   wp_enqueue_script( 'fancybox-js', get_template_directory_uri() . '/library/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.7', true );

   wp_enqueue_script( 'axishouse-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1', true );
   wp_enqueue_script( 'Hamburger', get_template_directory_uri() . '/js/hamburger.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
   // wp_enqueue_script( 'joints-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), $theme_version, true );

    /* - - - SHAPE SELECTOR JS - - - */
	if(get_queried_object_id() == 6744)
	{
		wp_enqueue_script( 'shapeselector', get_stylesheet_directory_uri().'/js/intrashape.js', array ( 'jquery' ), 1, true);
	}
    elseif( is_page_template( 'page-shape-selector.php' ) || is_singular( 'products' ) ){

      wp_enqueue_script( 'shapeselector', get_stylesheet_directory_uri().'/js/shape-selector.js', array ( 'jquery' ), 1, true);

    }
    /* - - - SHAPE SELECTOR JS - - - */

  }
}

function axishouse_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');
   add_post_type_support( 'page', 'excerpt' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	add_theme_support('automatic-feed-links'); //rss
   add_image_size( 'variations-thumb', 68, 50, true );
   add_image_size( 'showcase-thumb', 358, 194, true );
   add_image_size( 'showcase', 1920, 550, true );
   add_image_size( 'prod_profile', 840, 260, false );
   add_image_size( 'prod_featured', 540, 420 );
   add_image_size( 'prod_featured-small', 172, 334 );
   add_image_size( 'parallax', 1920, 1200 );
   add_image_size( 'sector-case-thumb', 164, 124, array('center','bottom' ));
   add_image_size( 'sector-case', 552, 550, array('center','bottom' ));
   add_image_size( 'case-study', 552, 550, array('center','bottom' ));
   add_image_size( 'case-study-thumb', 358, 256, array('center','bottom' ));
   add_image_size( 'resource-thumb', 700, 700, true);

   // shape selector images
   add_image_size( 'shape-selector-thumb', 310, 214, true);
   add_image_size( 'shape-selector', 1000, 800);

   // wp menus
	add_theme_support( 'menus' );

	//html5 support (http://themeshaper.com/2013/08/01/html5-support-in-wordpress-core/)
	add_theme_support( 'html5',
	         array(
	         	'comment-list',
	         	'comment-form',
	         	'search-form',
	         )
	);
}
function axishouse_footer_links() {
    wp_nav_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'jointstheme' ),   // nav name
    	'menu_class' => 'sub-nav',      // adding custom nav class
    	'theme_location' => 'footer',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'joints_footer_links_fallback'  // fallback function
	));
} /* end joints footer link */

add_action('wp_head', 'add_header_styles');

function add_header_styles() {
  if ( is_admin_bar_showing() ) {?>
    <style>
       /*
       body{
        margin-top:-32px;
       }
    .top-bar{margin-top: 32px; }
    @media screen and (max-width: 600px){
    .top-bar{margin-top: 46px; }
    #wpadminbar {position: fixed !important; }
    }*/
    </style>
  <?php }
}

if (!function_exists('bs_tokenTruncate')) {
function ah_tokenTruncate($string, $your_desired_width) {
					  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
					  $parts_count = count($parts);

					  $length = 0;
					  $last_part = 0;
					  for (; $last_part < $parts_count; ++$last_part) {
					    $length += strlen($parts[$last_part]);
					    if ($length > $your_desired_width) { break; }
					  }

					  return implode(array_slice($parts, 0, $last_part));
					}
				}





// get taxonomies terms links

/******************
Filter for Product Variations
********************/
function variations_filter($finishes) {
    $tax  = 'var_finish';
    $args = array (
      'orderby'     => 'name',
      'order' => 'DESC',
      'hide_empty'  => true,
     // 'exclude'     => array(17),
      'include'     => $finishes,
   );
    $terms = get_terms(  $tax , $args);

    if (is_array($terms)) {
      $count = count( $terms );
    }
   $count2 = count ($finishes);
    $string = "";
    $counter = 0;


    if ( $count > 0 && $count2 > 1):
        $string .="<div class='prod_var_list'>";

        foreach ( $terms as $term ) {
            $counter++;
            $term_link = get_term_link( $term, $tax );
           $string .="<div class='tax-variation tax-variation_".$counter." '>";
            $string .="<a href='". $term_link . "' class='prod-filter' title='" . $term->slug . "'>" . $term->name . "</a> ";
           $string .="</div>";
        }
         $string .="</div>";
    endif;
   return $string;
}

function ajax_filter_posts_scripts() {
  // Enqueue script
  wp_register_script('afp_script', get_template_directory_uri() . '/js/ajax-filters.js', false, null, false);
  wp_enqueue_script('afp_script');

  wp_localize_script( 'afp_script', 'afp_vars', array(
        'afp_nonce' => wp_create_nonce( 'afp_nonce' ), // Create nonce which we later will use to verify AJAX request
        'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'ajax_filter_posts_scripts', 100);

/*--------------------------------*/

// Script for getting posts
function ajax_filter_get_posts( $taxonomy) {

  // Verify nonce
  if( !isset( $_POST['afp_nonce'] ) || !wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ) )
    die('Permission denied');


   $taxonomy = $_POST['taxonomy'];
   $prod_id = $_POST['test_prod'];

  // echo "hello".$prod_id;

  // WP Query

 $output ="";

   while( have_rows('prod_var', $prod_id) ): the_row();

   $output .= "<div class='prod_variation'>";


   $output .= "<h3>".get_sub_field('var_cat')."</h3>";

   $variations = get_sub_field('variations');

  // $output.="<a title='".."'..".."";

   if($variations){

      foreach($variations as $v){

       //  echo get_term_link($v);
         $args  = array(
          'post_type' => 'variations',
          'tax_query' => array(
              array(
              'taxonomy' => 'var_prod',
              'field' => 'id',
              'terms' => $v->term_id
               ),
             array(
              'taxonomy' => 'var_finish',
              'field' => 'slug',
              'terms' => $taxonomy,
               ),
            )
          );
         $var_query = new WP_query($args);
         if($var_query->have_posts()){
            while($var_query->have_posts()){

               $var_query->the_post();
               $post_id = get_the_ID();
               $var_img = get_the_post_thumbnail( $post_id , 'variations-thumb');
               $var_img_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
              $output .= "<div class='variation' onMouseLeave='hideImage()' onMouseEnter='changeImage(\"".$var_img_full[0]."\")'>";

               $output .= "<div class='var_img'>".$var_img."</div>";
               $output .= get_field('var_label');
               $output .= "</div>";
            }
         }
         wp_reset_postdata();
      }
   }

   $output .= "<div style='clear:both;'><p>".get_sub_field('availability')."</p><div>";
   $output .= "</div>"; //end class=Prod_variation
	endwhile;



   echo $output;




  die();
}

add_action('wp_ajax_filter_posts', 'ajax_filter_get_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_get_posts');


/*--------------------------------*/

function my_myme_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    $mime_types['psd'] = 'image/vnd.adobe.photoshop'; //Adding photoshop files
    $mime_types['dwg'] = 'image/vnd.dwg';
    $mime_types['ifc'] = 'application/octet-stream';
    $mime_types['rfa'] = 'application/octet-stream';



    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

?>
