<?php



function custom_post_registration() { 
   register_post_type( 'news',
   array('labels' =>
        array(
            'name' => __('News', 'axishousetheme'), 
            'singular_name' => __('News Article', 'axishousetheme'),
            'all_items' => __('All News Articles', 'axishousetheme'), 
            'add_new' => __('Add New', 'axishousetheme'), 
            'add_new_item' => __('Add News Article', 'axishousetheme'), 
            'edit' => __( 'Edit', 'axishousetheme' ), 
            'edit_item' => __('Edit News Article', 'axishousetheme'),
            'new_item' => __('New News Article', 'axishousetheme'), 
            'view_item' => __('View News Article', 'axishousetheme'), 
            'search_items' => __('Search News Articles', 'axishousetheme'), 
            'not_found' =>  __('Nothing found in the Database.', 'axishousetheme'), 
            'not_found_in_trash' => __('Nothing found in Bin', 'axishousetheme'), 
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Intrammating News Articles', 'axishousetheme' ), 
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
            'name' => __('Products', 'axishousetheme'), 
            'singular_name' => __('Product', 'axishousetheme'),
            'all_items' => __('All Products', 'axishousetheme'), 
            'add_new' => __('Add New', 'axishousetheme'), 
            'add_new_item' => __('Add New Product', 'axishousetheme'), 
            'edit' => __( 'Edit', 'axishousetheme' ), 
            'edit_item' => __('Edit Product', 'axishousetheme'),
            'new_item' => __('New Product', 'axishousetheme'), 
            'view_item' => __('View Product', 'axishousetheme'), 
            'search_items' => __('Search Product', 'axishousetheme'), 
            'not_found' =>  __('Nothing found in the Database.', 'axishousetheme'), 
            'not_found_in_trash' => __('Nothing found in Bin', 'axishousetheme'), 
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Here are Intrammating products', 'axishousetheme' ), 
         'public' => true,
         'publicly_queryable' => true,
         'exclude_from_search' => false,
         'show_ui' => true,
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
			'name' => __('Sectors', 'axishousetheme'), 
			'singular_name' => __('Sector', 'axishousetheme'),
			'all_items' => __('All Sectors', 'axishousetheme'), 
			'add_new' => __('Add New', 'axishousetheme'), 
			'add_new_item' => __('Add New Sector', 'axishousetheme'), 
			'edit' => __( 'Edit', 'axishousetheme' ), 
			'edit_item' => __('Edit Sector', 'axishousetheme'),
			'new_item' => __('New Sector', 'axishousetheme'), 
			'view_item' => __('View Sector', 'axishousetheme'), 
			'search_items' => __('Search Sector', 'axishousetheme'), 
			'not_found' =>  __('Nothing found in the Database.', 'axishousetheme'), 
			'not_found_in_trash' => __('Nothing found in Bin', 'axishousetheme'), 
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Here are Intrammating sectors', 'axishousetheme' ), 
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
            'name' => __('Icon Blocks', 'axishousetheme'), 
            'singular_name' => __('Icon Block', 'axishousetheme'),
            'all_items' => __('Icon Blocks', 'axishousetheme'), 
            'add_new' => __('Add New', 'axishousetheme'), 
            'add_new_item' => __('Add New Icon Block', 'axishousetheme'), 
            'edit' => __( 'Edit', 'axishousetheme' ), 
            'edit_item' => __('Edit Icon Block', 'axishousetheme'),
            'new_item' => __('New Icon Block', 'axishousetheme'), 
            'view_item' => __('View Icon Block', 'axishousetheme'), 
            'search_items' => __('Search Icon Block', 'axishousetheme'), 
            'not_found' =>  __('Nothing found in the Database.', 'axishousetheme'), 
            'not_found_in_trash' => __('Nothing found in Bin', 'axishousetheme'), 
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Here are Intrammating Icon Blocks', 'axishousetheme' ), 
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
            'name' => __('Manufacturers', 'axishousetheme'), 
            'singular_name' => __('Manufacturer', 'axishousetheme'),
            'all_items' => __('Manufacturers', 'axishousetheme'), 
            'add_new' => __('Add New', 'axishousetheme'), 
            'add_new_item' => __('Add New Manufacturer', 'axishousetheme'), 
            'edit' => __( 'Edit', 'axishousetheme' ), 
            'edit_item' => __('Edit Manufacturer', 'axishousetheme'),
            'new_item' => __('New Manufacturer', 'axishousetheme'), 
            'view_item' => __('View Manufacturer', 'axishousetheme'), 
            'search_items' => __('Search Manufacturer', 'axishousetheme'), 
            'not_found' =>  __('Nothing found in the Database.', 'axishousetheme'), 
            'not_found_in_trash' => __('Nothing found in Bin', 'axishousetheme'), 
            'parent_item_colon' => ''
         ), /* end of arrays */
         'description' => __( 'Here are Intrammating Manufacturers', 'axishousetheme' ), 
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
            'name' => __('Variations', 'axishousetheme'), 
            'singular_name' => __('Variation', 'axishousetheme'),
            'all_items' => __('All Variations', 'axishousetheme'), 
            'add_new' => __('Add New', 'axishousetheme'), 
            'add_new_item' => __('Add New Variation', 'axishousetheme'), 
            'edit' => __( 'Edit', 'axishousetheme' ), 
            'edit_item' => __('Edit Variation', 'axishousetheme'),
            'new_item' => __('New Variation', 'axishousetheme'), 
            'view_item' => __('View Variation', 'axishousetheme'), 
            'search_items' => __('Search Variation', 'axishousetheme'), 
            'not_found' =>  __('Nothing found in the Database.', 'axishousetheme'), 
            'not_found_in_trash' => __('Nothing found in Bin', 'axishousetheme'), 
            'parent_item_colon' => ''
         );
   
   
  register_post_type( 'variations', //********** CUSTOM POST WP NAME ************/
   array('labels' => $labels, /* end of arrays */
         'description' => __( 'Here are Intrammating products variations', 'axishousetheme' ), 
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
   
        ) 
   ); 
 
   register_taxonomy( 'var_finish',  
    	array('variations'),      
    	array('hierarchical' => true,               
    		'labels' => array(
    			'name' => __( 'Finish', 'axishousetheme' ), 
    			'singular_name' => __( 'Finish', 'axishousetheme' ), 
    			'search_items' =>  __( 'Search Finish', 'axishousetheme' ), 
    			'all_items' => __( 'All Finishes', 'axishousetheme' ), 
    			'parent_item' => __( 'Parent Finish', 'axishousetheme' ), 
    			'parent_item_colon' => __( 'Parent Custom Finish:', 'axishousetheme' ), 
    			'edit_item' => __( 'Edit Finish', 'axishousetheme' ), 
    			'update_item' => __( 'Update Finish', 'axishousetheme' ), 
    			'add_new_item' => __( 'Add New Finish', 'axishousetheme' ), 
    			'new_item_name' => __( 'New Finish Name', 'axishousetheme' ) 
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
   register_taxonomy( 'var_prod',  
    	array('variations'),      
    	array('hierarchical' => true,               
    		'labels' => array(
    			'name' => __( 'Main Product', 'axishousetheme' ), 
    			'singular_name' => __( 'Main Product', 'axishousetheme' ), 
    			'search_items' =>  __( 'Search Main Product', 'axishousetheme' ), 
    			'all_items' => __( 'All Main Products', 'axishousetheme' ), 
    			'parent_item' => __( 'Parent Main Product', 'axishousetheme' ), 
    			'parent_item_colon' => __( 'Parent Custom Main Product:', 'axishousetheme' ), 
    			'edit_item' => __( 'Edit Main Product', 'axishousetheme' ), 
    			'update_item' => __( 'Update Main Product', 'axishousetheme' ), 
    			'add_new_item' => __( 'Add New Main Product', 'axishousetheme' ), 
    			'new_item_name' => __( 'New Main Product Name', 'axishousetheme' ) 
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
    			'name' => __( 'Ages', 'axishousetheme' ), 
    			'singular_name' => __( 'Age', 'axishousetheme' ), 
    			'search_items' =>  __( 'Search Ages', 'axishousetheme' ), 
    			'all_items' => __( 'All Ages', 'axishousetheme' ), 
    			'parent_item' => __( 'Parent Age', 'axishousetheme' ), 
    			'parent_item_colon' => __( 'Parent Custom Age:', 'axishousetheme' ), 
    			'edit_item' => __( 'Edit Age', 'axishousetheme' ), 
    			'update_item' => __( 'Update Age', 'axishousetheme' ), 
    			'add_new_item' => __( 'Add New Age', 'axishousetheme' ), 
    			'new_item_name' => __( 'New Age Name', 'axishousetheme' ) 
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
			'name' => __( 'Ages', 'axishousetheme' ), 
			'singular_name' => __( 'Age', 'axishousetheme' ), 
			'search_items' =>  __( 'Search Ages', 'axishousetheme' ), 
			'all_items' => __( 'All Ages', 'axishousetheme' ), 
			'parent_item' => __( 'Parent Age', 'axishousetheme' ), 
			'parent_item_colon' => __( 'Parent Custom Age:', 'axishousetheme' ), 
			'edit_item' => __( 'Edit Age', 'axishousetheme' ), 
			'update_item' => __( 'Update Age', 'axishousetheme' ), 
			'add_new_item' => __( 'Add New Age', 'axishousetheme' ), 
			'new_item_name' => __( 'New Age Name', 'axishousetheme' ) 
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'by-age' ),
	)
);*/


?>