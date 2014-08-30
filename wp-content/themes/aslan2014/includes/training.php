<?php

	function training_init(){

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
	            'hierarchical'          => true,
	            'supports'              => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail' ),
	            'menu_icon'				=> 'dashicons-nametag',
	            'rewrite'				=> array('slug' => 'training')
	        )
	    );

	}

	function aslaninst2014_training_summaries( $category ){

		$args = array(
				'post_type' => 'aslaninst_training',
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'meta_key' => 'category',
				'meta_value' => $category,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
		$summaries = get_posts( $args );

		$return = '';
		foreach( $summaries as $summary ):
			$return .= include(locate_template('snippets/training-summary.php'));
		endforeach;
		return $return;

	}
