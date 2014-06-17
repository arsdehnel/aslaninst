<?php

	/*
		TO DO

		load editor style
		register post type for provider
		search form

	*/

add_action( 'init',               'aslaninst2014_init' );
add_action( 'wp_enqueue_scripts', 'aslaninst2014_enqueue_scripts' );

function aslaninst2014_init(){

	//register post types
    register_post_type( 'aslantinst_provider',
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
            'supports'              => array( 'title', 'editor' ),
            'menu_icon'				=> 'dashicons-nametag',
            'rewrite'				=> array('slug' => 'provider')
        )
    );
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

function aslantinst2014_providers_list( $id ){

	$args = array(
			'post_type' => 'aslantinst_provider',
			'post_status' => 'publish'
		);
	$providers = get_posts( $args );

	$return = '';
	foreach( $providers as $provider ):
		$return .= include(locate_template('snippets/provider-listing-entry.php'));
	endforeach;
	return $return;

}
register_nav_menus(
	array(
		'main' => 'Main Menu',
		'footer' => 'Footer Menu'
	)
);