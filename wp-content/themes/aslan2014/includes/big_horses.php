<?php

	add_filter('manage_aslaninst_bighorse_posts_columns', 'aslaninst_bighorse_table_head');
	add_action( 'manage_aslaninst_bighorse_posts_custom_column', 'aslaninst_table_content', 10, 2 );

	function big_horses_init() {

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
	            'supports'              => array( 'editor', 'thumbnail', 'page-attributes' ),
	            'menu_icon'				=> 'dashicons-nametag'
	        )
	    );

	}

	function aslaninst2014_splash_animation(){

		$args = array(
				'posts_per_page' => -1,
				'post_type' => 'aslaninst_bighorse',
				'post_status' => 'publish',
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);
		$horses = get_posts( $args );

		$return = '';
		foreach( $horses as $horse ):
			$return .= include(locate_template('snippets/splash-animation-horse.php'));
		endforeach;
		return $return;

	}

	function aslaninst2014_animation_image_url( $post_id ){
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
		return $thumb[0];
	}

	function aslaninst_bighorse_table_head( $defaults ) {
		//unset($defaults['title']);
		unset($defaults['date']);
		$defaults['text'] = 'Text';
	    $defaults['menu_order'] = 'Order';
	    $defaults['author'] = 'Added By';
	    return $defaults;
	}

