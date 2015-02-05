<?php

	add_action( 'init'                 , 'aslaninst2014_init' );
	add_action( 'wp_enqueue_scripts'   , 'aslaninst2014_enqueue_scripts' );
	add_action( 'admin_enqueue_scripts', 'aslaninst2014_admin_queue_scripts' );
	add_action( 'pre_get_posts'        , 'wc_add_meta_query', 20 );
    add_filter( 'add_to_cart_redirect' , 'redirect_to_checkout');
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

	include_once( 'includes/big_horses.php' );
	include_once( 'includes/providers.php' );
	include_once( 'includes/tabs.php' );
	include_once( 'includes/training.php' );
	include_once( 'includes/calendar.php' );
	include_once( 'includes/store.php' );

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

	    add_theme_support( 'post-thumbnails', array( 'aslaninst_bighorse', 'aslaninst_training', 'aslaninst_provider', 'tribe_events' ) );
		add_theme_support( 'woocommerce' );
	}

	function aslaninst2014_enqueue_scripts(){
		wp_enqueue_style( 'aslaninst2014-style', get_stylesheet_uri(), array() );
    	wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-lettering', get_template_directory_uri() . '/assets/scripts/build/jquery.lettering.js' );
		// wp_enqueue_script( 'select2', get_template_directory_uri() . '/assets/scripts/build/select2.min.js', null, null, true );
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
			elseif( $post_type == "tribe_events" ):
				return get_top_level_page_obj( 'calendar' )->ID;
			elseif( $post_type == "page" || $post_type == 'product' ):
				return get_top_level_page_obj( 'store' )->ID;
			else:
				echo $post_type;
			endif;

		endif;
	}

	function aslaninst2014_acf_taxonomy_to_string( $acf_array ){

		if( is_array( $acf_array ) && count( $acf_array ) > 0 ):

			foreach( $acf_array as $entry ):
				$return[] = $entry->name;
			endforeach;

			return implode( ', ', $return );

		else:

			return 'N/A';

		endif;

	}

	register_nav_menus(
		array(
			'main' => 'Main Menu',
			'footer' => 'Footer Menu'
		)
	);