<?php

	/*
		TO DO

		load editor style
		register post type for provider
		search form

	*/

add_action( 'init'                 , 'aslaninst2014_init' );
add_action( 'wp_enqueue_scripts'   , 'aslaninst2014_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'aslaninst2014_admin_queue_scripts' );

function aslaninst2014_init(){

	/**
	 * PROVIDERS
	 *
	 */

	//post type
    register_post_type( 'aslaninst_provider',
        array(
            'labels' => array(
                'name'          => __( 'Providers' ),
                'singular_name' => __( 'Provider' ),
                'add_new_item'  => __( 'Add Provider' ),
                'edit_item'     => __( 'Update Provider' )
            ),
            'description'           => 'Providers for listing page',
            'public'                => true,
            'exclude_from_search'   => false,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon'				=> 'dashicons-nametag',
            'rewrite'				=> array('slug' => 'provider')
        )
    );

    //taxonomy for insurances
	$labels = array(
		'name'              => _x( 'Insurances', 'taxonomy general name' ),
		'singular_name'     => _x( 'Insurance', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Insurances Accepted' ),
		'all_items'         => __( 'All Insurances' ),
		'edit_item'         => __( 'Edit Insurance' ),
		'update_item'       => __( 'Update Insurance' ),
		'add_new_item'      => __( 'Add New Insurance' ),
		'new_item_name'     => __( 'New Insurance' ),
		'menu_name'         => __( 'Insurance Options' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'insurances' ),
	);

	register_taxonomy( 'aslaninst_insurance', array( 'aslaninst_provider' ), $args );

    //and a taxonomy for specialties
	$labels = array(
		'name'              => _x( 'Specialties', 'taxonomy general name' ),
		'singular_name'     => _x( 'Specialty', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Specialties' ),
		'all_items'         => __( 'All Specialties' ),
		'edit_item'         => __( 'Edit Specialty' ),
		'update_item'       => __( 'Update Specialty' ),
		'add_new_item'      => __( 'Add New Specialty' ),
		'new_item_name'     => __( 'New Specialty' ),
		'menu_name'         => __( 'Specialties' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'specialties' ),
	);

	register_taxonomy( 'aslaninst_specialty', array( 'aslaninst_provider' ), $args );

    register_post_type( 'aslaninst_training',
        array(
            'labels' => array(
                'name'          => __( 'Training Sessions' ),
                'singular_name' => __( 'Training' ),
                'add_new_item'  => __( 'Add Training' ),
                'edit_item'     => __( 'Update Training' )
            ),
            'description'           => 'Training opportunity',
            'public'                => true,
            'exclude_from_search'   => false,
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'				=> 'dashicons-nametag',
            'rewrite'				=> array('slug' => 'training')
        )
    );
    register_post_type( 'aslaninst_bighorse',
        array(
            'labels' => array(
                'name'          => __( 'Splash Animation' ),
                'singular_name' => __( 'Animation Frame' ),
                'add_new_item'  => __( 'Add Frame' ),
                'edit_item'     => __( 'Adjust Frame' )
            ),
            'description'           => 'Frames for the large animation on the homepage',
            'public'                => true,
            'exclude_from_search'   => true,
            'supports'              => array( 'editor', 'thumbnail' ),
            'menu_icon'				=> 'dashicons-nametag'
        )
    );

    //custom post type needs the rules to be refreshed
    //really this should just need to be done once whenever this file is changed
    //so they can be cached for subsequent changes
    flush_rewrite_rules();

    add_theme_support( 'post-thumbnails', array( 'aslaninst_bighorse', 'aslaninst_provider' ) );

}

function aslaninst2014_enqueue_scripts(){
	wp_enqueue_style( 'aslaninst2014-style', get_stylesheet_uri(), array() );
}
function aslaninst2014_admin_queue_scripts( $hook ){
	wp_enqueue_style( 'aslaninst2014-style', get_template_directory_uri() . '/admin.css', array() );
}

function aslaninst2014_providers_list( $id ){

	$args = array(
			'post_type' => 'aslaninst_provider',
			'post_status' => 'publish'
		);
	$providers = get_posts( $args );

	$return = '';
	foreach( $providers as $provider ):
		$return .= include(locate_template('snippets/provider-listing-entry.php'));
	endforeach;
	return $return;

}

function aslaninst2014_splash_animation(){

	$args = array(
			'post_type' => 'aslaninst_bighorse',
			'post_status' => 'publish'
		);
	$horses = get_posts( $args );

	$return = '';
	foreach( $horses as $horse ):
		$return .= include(locate_template('snippets/splash-animation-horse.php'));
	endforeach;
	return $return;

}

function aslaninst2014_training_summaries( $category ){

	$args = array(
			'post_type' => 'aslaninst_training',
			'post_status' => 'publish',
			'meta_key' => 'category',
			'meta_value' => 'primary'
		);
	$summaries = get_posts( $args );

	$return = '';
	foreach( $summaries as $summary ):
		$return .= include(locate_template('snippets/training-summary.php'));
	endforeach;
	return $return;

}

function aslaninst2014_acf_taxonomy_to_string( $acf_array ){

	foreach( $acf_array as $entry ):
		$return[] = $entry->name;
	endforeach;

	return implode( ', ', $return );

}


register_nav_menus(
	array(
		'main' => 'Main Menu',
		'footer' => 'Footer Menu'
	)
);