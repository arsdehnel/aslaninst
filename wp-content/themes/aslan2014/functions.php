<?php

	add_action( 'init'                 , 'aslaninst2014_init' );
	add_action( 'wp_enqueue_scripts'   , 'aslaninst2014_enqueue_scripts' );
	add_action( 'admin_enqueue_scripts', 'aslaninst2014_admin_queue_scripts' );

	include_once( 'includes/big_horses.php' );
	include_once( 'includes/providers.php' );
	include_once( 'includes/tabs.php' );
	include_once( 'includes/training.php' );

	function aslaninst_table_content( $column_name, $post_id ) {

	    if ($column_name == 'parent') {
		    $parent_id = get_post_meta( $post_id, 'aslaninst_tab_parent_id', true );
	    	echo get_the_title( $parent_id );
	    }

	    if ($column_name == 'text') {
		    echo get_the_content( $post_id );
	    }

	    if ($column_name == 'menu_order') {
	    	$thispost = get_post($post_id);
			echo $thispost->menu_order;
	    }

	}

	function aslaninst2014_init(){

		providers_init();
		tabs_init();
		big_horses_init();
		training_init();

	    // custom post type needs the rules to be refreshed
	    // really this should just need to be done once whenever this file is changed
	    // so they can be cached for subsequent changes
	    // flush_rewrite_rules();

	    add_theme_support( 'post-thumbnails', array( 'aslaninst_bighorse', 'aslaninst_training', 'aslaninst_provider' ) );

	}

	function aslaninst2014_enqueue_scripts(){
		wp_enqueue_style( 'aslaninst2014-style', get_stylesheet_uri(), array() );
	}
	function aslaninst2014_admin_queue_scripts( $hook ){
		wp_enqueue_style( 'aslaninst2014-style', get_template_directory_uri() . '/admin.css', array() );
	}


	function get_top_level_page_obj( $slug ){

		$args = array(
		  'name' => $slug,
		  'post_type' => 'page',
		  'post_status' => 'publish',
		  'posts_per_page' => 1
		);
		$posts = get_posts($args);
		return $posts[0];

	}

	function aslaninst2014_active_menu_lkup( $items ){
		global $wp_query;
		$post_id = $wp_query->get_queried_object_id();

		// convert incoming array of objects to plain array
		foreach( $items as $item ):
			$nav_items[$item->object_id] = $item->object_id;
		endforeach;

		// see if we're on a page that is in the nav
		if( array_key_exists( $post_id, $nav_items ) ):
			return $post_id;
		else:

			// now we've got to figure out which one this page relates to
			$post_type = get_post_type( $post_id );

			if( $post_type == "aslaninst_training" ):
				return get_top_level_page_obj( 'training' )->ID;
			elseif( $post_type == "aslaninst_provider" ):
				return get_top_level_page_obj( 'providers' )->ID;
			elseif( $post_type == "ai1ec_event" ):
				return get_top_level_page_obj( 'calendar' )->ID;
			else:
				echo $post_type;
			endif;

		endif;
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