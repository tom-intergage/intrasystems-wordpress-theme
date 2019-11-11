<?php
/**
 * axishouse functions and definitions
 *
 * @package axishouse
 */

 

if ( ! function_exists( 'axishouse_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function axishouse_setup() {

	add_action('init', 'axisSession', 1);
	function axisSession() {
	    if(!session_id()) {
	        session_start();
	    }
	}
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on axishouse, use a find and replace
	 * to change 'axishouse' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'axishouse', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(

		'primary' => esc_html__( 'Primary Menu', 'axishouse' ),
      'footer' => esc_html__( 'Footer Menu', 'axishouse' ),
      'mobile' => esc_html__( 'Mobile Menu', 'axishouse' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'axishouse_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // axishouse_setup
add_action( 'after_setup_theme', 'axishouse_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function axishouse_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'axishouse_content_width', 640 );
}
add_action( 'after_setup_theme', 'axishouse_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function axishouse_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'axishouse' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer1', 'axishouse' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer2', 'axishouse' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer3', 'axishouse' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'axishouse_widgets_init' );



// LOAD AXIS HOUSE CORE
require_once(get_template_directory().'/inc/axishouse.php');

// LOAD AXIS HOUSE
require_once(get_template_directory().'/inc/custom-post-type.php');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * CAD Form Fix
 */
add_action( 'wp_footer', 'cad_wp_footer' );

function cad_wp_footer() {
?>
<script type="text/javascript">



document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '21' == event.detail.contactFormId) {
		document.getElementById('wpcf7-f21-o1').style.display = 'none';
		document.getElementById('file_url1').style.display = 'block';
    } else if ('6992' == event.detail.contactFormId) {
		document.getElementById('file_url1').style.display = 'block';
	} else if ('7301' == event.detail.contactFormId) {
		document.getElementById('intralux_graphic_thankyou').style.display = 'block';
	}
}, false );
</script>
<?php
}


/**
 * SESSIONS FOR POP UP
 */
add_action('init', 'start_session', 1);

function start_session() {
	if(!session_id()) {
		session_start();
	}
}

@ini_set( 'upload_max_size' , '10M' );
