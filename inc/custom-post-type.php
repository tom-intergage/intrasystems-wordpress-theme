<?php



function custom_post_registration() {
   register_post_type( 'news',
   array('labels' =>
        array(
            'name' => __('News', 'intrasystemstheme'),
            'singular_name' => __('News Article', 'intrasystemstheme'),
            'all_items' => __('All News Articles', 'intrasystemstheme'),
            'add_new' => __('Add New', 'intrasystemstheme'),
            'add_new_item' => __('Add News Article', 'intrasystemstheme'),
            'edit' => __( 'Edit', 'intrasystemstheme' ),
            'edit_item' => __('Edit News Article', 'intrasystemstheme'),
            'new_item' => __('New News Article', 'intrasystemstheme'),
            'view_item' => __('View News Article', 'intrasystemstheme'),
            'search_items' => __('Search News Articles', 'intrasystemstheme'),
            'not_found' =>  __('Nothing found in the Database.', 'intrasystemstheme'),
            'not_found_in_trash' => __('Nothing found in Bin', 'intrasystemstheme'),
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Intrammating News Articles', 'intrasystemstheme' ),
         'public' => true,
         'publicly_queryable' => true,
         'exclude_from_search' => false,
         'show_ui' => true,
         'query_var' => true,
         'menu_position' =>10,
         'has_archive' => true,
         'rewrite'	=> array( 'slug' => 'news', 'with_front' => false ),
         'capability_type' => 'post',
         'hierarchical' => false,
         'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'sticky', 'page-attributes')
        )
   );
   register_post_type( 'products',
   array('labels' =>
        array(
            'name' => __('Products', 'intrasystemstheme'),
            'singular_name' => __('Product', 'intrasystemstheme'),
            'all_items' => __('All Products', 'intrasystemstheme'),
            'add_new' => __('Add New', 'intrasystemstheme'),
            'add_new_item' => __('Add New Product', 'intrasystemstheme'),
            'edit' => __( 'Edit', 'intrasystemstheme' ),
            'edit_item' => __('Edit Product', 'intrasystemstheme'),
            'new_item' => __('New Product', 'intrasystemstheme'),
            'view_item' => __('View Product', 'intrasystemstheme'),
            'search_items' => __('Search Product', 'intrasystemstheme'),
            'not_found' =>  __('Nothing found in the Database.', 'intrasystemstheme'),
            'not_found_in_trash' => __('Nothing found in Bin', 'intrasystemstheme'),
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Here are Intrammating products', 'intrasystemstheme' ),
         'public' => true,
         'publicly_queryable' => true,
         'exclude_from_search' => false,
         'show_ui' => true,
         'show_in_rest' => true,
         'query_var' => true,
         'menu_position' =>50,
         'menu_icon' => get_stylesheet_directory_uri() . '/img/wp-axishouse-icon.png',
         'rewrite'	=> array( 'slug' => 'products', 'with_front' => false ),
         'has_archive' => false,
         'capability_type' => 'post',
         'hierarchical' => false,
         'taxonomies' => array('category'),
         'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'sticky', 'page-attributes')
        )
   );
	register_post_type( 'sectors',

		array('labels' => array(
			'name' => __('Sectors', 'intrasystemstheme'),
			'singular_name' => __('Sector', 'intrasystemstheme'),
			'all_items' => __('All Sectors', 'intrasystemstheme'),
			'add_new' => __('Add New', 'intrasystemstheme'),
			'add_new_item' => __('Add New Sector', 'intrasystemstheme'),
			'edit' => __( 'Edit', 'intrasystemstheme' ),
			'edit_item' => __('Edit Sector', 'intrasystemstheme'),
			'new_item' => __('New Sector', 'intrasystemstheme'),
			'view_item' => __('View Sector', 'intrasystemstheme'),
			'search_items' => __('Search Sector', 'intrasystemstheme'),
			'not_found' =>  __('Nothing found in the Database.', 'intrasystemstheme'),
			'not_found_in_trash' => __('Nothing found in Bin', 'intrasystemstheme'),
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Here are Intrammating sectors', 'intrasystemstheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 50,
			'menu_icon' => get_stylesheet_directory_uri() . '/img/wp-axishouse-icon.png',
			'rewrite'	=> array( 'slug' => 'sectors', 'with_front' => false ),
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', 'sticky')
	 	)
	);
   register_post_type( 'icon_blocks',
   array('labels' =>
        array(
            'name' => __('Icon Blocks', 'intrasystemstheme'),
            'singular_name' => __('Icon Block', 'intrasystemstheme'),
            'all_items' => __('Icon Blocks', 'intrasystemstheme'),
            'add_new' => __('Add New', 'intrasystemstheme'),
            'add_new_item' => __('Add New Icon Block', 'intrasystemstheme'),
            'edit' => __( 'Edit', 'intrasystemstheme' ),
            'edit_item' => __('Edit Icon Block', 'intrasystemstheme'),
            'new_item' => __('New Icon Block', 'intrasystemstheme'),
            'view_item' => __('View Icon Block', 'intrasystemstheme'),
            'search_items' => __('Search Icon Block', 'intrasystemstheme'),
            'not_found' =>  __('Nothing found in the Database.', 'intrasystemstheme'),
            'not_found_in_trash' => __('Nothing found in Bin', 'intrasystemstheme'),
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Here are Intrammating Icon Blocks', 'intrasystemstheme' ),
         'public' => true,
         'publicly_queryable' => false,
         'exclude_from_search' => false,
         'show_ui' => true,
         'query_var' => true,
         'menu_position' =>50,
         'menu_icon' => get_stylesheet_directory_uri() . '/img/wp-axishouse-icon.png',
         'rewrite'	=> array( 'slug' => 'icon-blocks', 'with_front' => false ),
         'has_archive' => false,
         'capability_type' => 'post',
         'hierarchical' => false,
         'supports' => array( 'title', 'author', 'thumbnail', 'revisions', 'sticky')
        )
   );
   register_post_type( 'manufacturers',
   array('labels' =>
        array(
            'name' => __('Manufacturers', 'intrasystemstheme'),
            'singular_name' => __('Manufacturer', 'intrasystemstheme'),
            'all_items' => __('Manufacturers', 'intrasystemstheme'),
            'add_new' => __('Add New', 'intrasystemstheme'),
            'add_new_item' => __('Add New Manufacturer', 'intrasystemstheme'),
            'edit' => __( 'Edit', 'intrasystemstheme' ),
            'edit_item' => __('Edit Manufacturer', 'intrasystemstheme'),
            'new_item' => __('New Manufacturer', 'intrasystemstheme'),
            'view_item' => __('View Manufacturer', 'intrasystemstheme'),
            'search_items' => __('Search Manufacturer', 'intrasystemstheme'),
            'not_found' =>  __('Nothing found in the Database.', 'intrasystemstheme'),
            'not_found_in_trash' => __('Nothing found in Bin', 'intrasystemstheme'),
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Here are Intrammating Manufacturers', 'intrasystemstheme' ),
         'public' => true,
         'publicly_queryable' => false,
         'exclude_from_search' => false,
         'show_ui' => true,
         'query_var' => true,
         'menu_position' =>50,
         'menu_icon' => get_stylesheet_directory_uri() . '/img/wp-axishouse-icon.png',
         'rewrite'	=> array( 'slug' => 'icon-blocks', 'with_front' => false ),
         'has_archive' => false,
         'capability_type' => 'post',
         'hierarchical' => false,
         'supports' => array( 'title', 'author', 'thumbnail', 'revisions', 'sticky')
        )
   );






}
add_action( 'init', 'custom_post_registration');
add_action( 'init', 'prod_variations_reg');




function prod_variations_reg() {
   $labels = array(
            'name' => __('Variations', 'intrasystemstheme'),
            'singular_name' => __('Variation', 'intrasystemstheme'),
            'all_items' => __('All Variations', 'intrasystemstheme'),
            'add_new' => __('Add New', 'intrasystemstheme'),
            'add_new_item' => __('Add New Variation', 'intrasystemstheme'),
            'edit' => __( 'Edit', 'intrasystemstheme' ),
            'edit_item' => __('Edit Variation', 'intrasystemstheme'),
            'new_item' => __('New Variation', 'intrasystemstheme'),
            'view_item' => __('View Variation', 'intrasystemstheme'),
            'search_items' => __('Search Variation', 'intrasystemstheme'),
            'not_found' =>  __('Nothing found in the Database.', 'intrasystemstheme'),
            'not_found_in_trash' => __('Nothing found in Bin', 'intrasystemstheme'),
            'parent_item_colon' => ''
         );

  register_post_type( 'variations', //********** CUSTOM POST WP NAME ************/
   array('labels' => $labels, /* end of arrays */
         'description' => __( 'Here are Intrammating products variations', 'intrasystemstheme' ),
         'public' => false,
         'publicly_queryable' => false,
         'exclude_from_search' => true,
         'show_ui' => true,
         'query_var' => true,
         'menu_position' =>50,
         'menu_icon' => get_stylesheet_directory_uri() . '/img/wp-axishouse-icon.png',
         'rewrite'	=> array( 'slug' => 'variations', 'with_front' => false ),
         'has_archive' => true,
         'capability_type' => 'post',
         'hierarchical' => false,
         'supports' => array( 'title', 'thumbnail', 'revisions', 'sticky'),
         'show_in_rest' => true
        )
   );

   register_taxonomy( 'var_finish',
    	array('variations'),
    	array('hierarchical' => true,
    		'labels' => array(
    			'name' => __( 'Finish', 'intrasystemstheme' ),
    			'singular_name' => __( 'Finish', 'intrasystemstheme' ),
    			'search_items' =>  __( 'Search Finish', 'intrasystemstheme' ),
    			'all_items' => __( 'All Finishes', 'intrasystemstheme' ),
    			'parent_item' => __( 'Parent Finish', 'intrasystemstheme' ),
    			'parent_item_colon' => __( 'Parent Custom Finish:', 'intrasystemstheme' ),
    			'edit_item' => __( 'Edit Finish', 'intrasystemstheme' ),
    			'update_item' => __( 'Update Finish', 'intrasystemstheme' ),
    			'add_new_item' => __( 'Add New Finish', 'intrasystemstheme' ),
    			'new_item_name' => __( 'New Finish Name', 'intrasystemstheme' )
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
        'show_in_rest' => true
    	)
    );
   register_taxonomy( 'var_prod',
    	array('variations'),
    	array('hierarchical' => true,
    		'labels' => array(
    			'name' => __( 'Main Product', 'intrasystemstheme' ),
    			'singular_name' => __( 'Main Product', 'intrasystemstheme' ),
    			'search_items' =>  __( 'Search Main Product', 'intrasystemstheme' ),
    			'all_items' => __( 'All Main Products', 'intrasystemstheme' ),
    			'parent_item' => __( 'Parent Main Product', 'intrasystemstheme' ),
    			'parent_item_colon' => __( 'Parent Custom Main Product:', 'intrasystemstheme' ),
    			'edit_item' => __( 'Edit Main Product', 'intrasystemstheme' ),
    			'update_item' => __( 'Update Main Product', 'intrasystemstheme' ),
    			'add_new_item' => __( 'Add New Main Product', 'intrasystemstheme' ),
    			'new_item_name' => __( 'New Main Product Name', 'intrasystemstheme' )
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    	)
    );










}
/* Product Variations */




	/*
    register_taxonomy( 'by_age',
    	array('products'),
    	array('hierarchical' => true,
    		'labels' => array(
    			'name' => __( 'Ages', 'intrasystemstheme' ),
    			'singular_name' => __( 'Age', 'intrasystemstheme' ),
    			'search_items' =>  __( 'Search Ages', 'intrasystemstheme' ),
    			'all_items' => __( 'All Ages', 'intrasystemstheme' ),
    			'parent_item' => __( 'Parent Age', 'intrasystemstheme' ),
    			'parent_item_colon' => __( 'Parent Custom Age:', 'intrasystemstheme' ),
    			'edit_item' => __( 'Edit Age', 'intrasystemstheme' ),
    			'update_item' => __( 'Update Age', 'intrasystemstheme' ),
    			'add_new_item' => __( 'Add New Age', 'intrasystemstheme' ),
    			'new_item_name' => __( 'New Age Name', 'intrasystemstheme' )
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'by-age' ),
    	)
    );

   register_taxonomy( 'by_age',
                  array('products'),
                  array('hierarchical' => true,
		'labels' => array(
			'name' => __( 'Ages', 'intrasystemstheme' ),
			'singular_name' => __( 'Age', 'intrasystemstheme' ),
			'search_items' =>  __( 'Search Ages', 'intrasystemstheme' ),
			'all_items' => __( 'All Ages', 'intrasystemstheme' ),
			'parent_item' => __( 'Parent Age', 'intrasystemstheme' ),
			'parent_item_colon' => __( 'Parent Custom Age:', 'intrasystemstheme' ),
			'edit_item' => __( 'Edit Age', 'intrasystemstheme' ),
			'update_item' => __( 'Update Age', 'intrasystemstheme' ),
			'add_new_item' => __( 'Add New Age', 'intrasystemstheme' ),
			'new_item_name' => __( 'New Age Name', 'intrasystemstheme' )
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'by-age' ),
	)
);*/


?>
