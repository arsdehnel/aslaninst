<?php

	function providers_init(){

		add_post_type_support( 'page', 'excerpt' );

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
	            'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
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


	}

	function get_provider_listing_post(){

		$the_slug = 'providers';
		$args = array(
		  'name' => 'providers',
		  'post_type' => 'page',
		  'post_status' => 'publish',
		  'posts_per_page' => 1
		);
		$my_posts = get_posts($args);
		return $my_posts[0];

	}

	function aslaninst2014_providers_list( $id, $member_type ){

		$args = array(
				'post_type' => 'aslaninst_provider',
				'post_status' => 'publish',
				'meta_key' => 'member_type',
				'meta_value' => $member_type,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
		$providers = get_posts( $args );

		$return = '';
		foreach( $providers as $provider ):
			$return .= include(locate_template('snippets/provider-listing-entry.php'));
		endforeach;
		return $return;

	}
