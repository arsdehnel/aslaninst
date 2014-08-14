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

add_action( 'add_meta_boxes', function() { add_meta_box('aslaninst_tabs', 'Tab Details', 'tab_details_meta_box', 'aslaninst_tabs', 'side', 'high');});
add_action( 'save_post', 'aslaninsttabs_save_meta_box' );

include_once( 'includes/providers.php' );

function tab_details_meta_box($post) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'tab_details_meta_box', 'tab_details_meta_box_nonce' );

	$tab_parent_id = get_post_meta( $post->ID, 'aslaninst_tab_parent_id', true );

	echo '<label for="aslaninst_tab_parent_id">';
	_e( 'Parent page: ', 'aslaninst_theme' );
	echo '</label> ';

	// get the singular names so we can display that pretty name in the parent drop down
	$post_types['aslaninst_training'] = get_post_type_object( 'aslaninst_training' )->labels->name;
	$post_types['page'] = get_post_type_object( 'page' )->labels->name;

	// start with just the opening select
	$dropdown = '<select name="aslaninst_tab_parent_id" id="aslaninst_tab_parent_id">';

	foreach( $post_types as $post_type => $post_type_label  ):

		$dropdown .= '<optgroup label="'.$post_type_label.'">';

		// get all the possible parents
		$parents = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC' ) );

		// build the dropdown
		if( is_array( $parents ) && count( $parents ) > 0 ):
			foreach( $parents as $parent ):
				$dropdown .= '<option value="'.$parent->ID.'"';
				if( $parent->ID == $tab_parent_id ):
					$dropdown .= " selected";
				endif;
				$dropdown .= '>'.$parent->post_title.'</option>';
			endforeach;
		endif;

		$dropdown .= '</optgroup>';

	endforeach;

	// finish it up
	$dropdown .= '</select>';
	echo $dropdown;

}

function aslaninsttabs_save_meta_box( $post_id ){

	//echo 'something';

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['tab_details_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['tab_details_meta_box_nonce'], 'tab_details_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Make sure that it is set.
	if ( isset( $_POST['aslaninst_tab_parent_id'] ) ) {
		update_post_meta( $post_id, 'aslaninst_tab_parent_id', $_POST['aslaninst_tab_parent_id'] );
	}

}

add_filter('manage_aslaninst_bighorse_posts_columns', 'aslaninst_bighorse_table_head');

function aslaninst_bighorse_table_head( $defaults ) {
	//unset($defaults['title']);
	unset($defaults['date']);
	$defaults['text'] = 'Text';
    $defaults['menu_order'] = 'Order';
    $defaults['author'] = 'Added By';
    return $defaults;
}


add_filter('manage_aslaninst_tabs_posts_columns', 'aslaninst_tabs_table_head');

function aslaninst_tabs_table_head( $defaults ) {
    $defaults['title'] = 'Tab Text';
    $defaults['parent'] = 'Parent Page';
    $defaults['menu_order'] = 'Order';
    $defaults['author'] = 'Added By';
    return $defaults;
}

add_action( 'manage_aslaninst_tabs_posts_custom_column', 'aslaninst_table_content', 10, 2 );
add_action( 'manage_aslaninst_bighorse_posts_custom_column', 'aslaninst_table_content', 10, 2 );

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

add_filter('manage_aslaninst_tabs_posts_columns', 'aslaninst_tabs_reorder_columns');
function aslaninst_tabs_reorder_columns($columns) {
	$new = array();
	foreach($columns as $key => $title) {
		if ( $key == 'title' ){
      		$new['parent'] = 'Thumbnail';
  		}
  		$new[$key] = $title;
  	}
  	return $new;
}

function aslaninst2014_init(){

	providers_init();

	/**
	 * TRAINING
	 *
	 */

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

	/**
	 * BIG HORSES
	 *
	 */

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

	/**
	 * TABS
	 *
	 */

    register_post_type( 'aslaninst_tabs',
        array(
            'labels' => array(
                'name'          => __( 'Tabs' ),
                'singular_name' => __( 'Tab' ),
                'add_new_item'  => __( 'Add Tab' ),
                'edit_item'     => __( 'Edit Tab' )
            ),
            'description'           => 'Tabs that will be a part of the page post types',
            'public'                => true,
            'exclude_from_search'   => true,
            'supports'              => array( 'title', 'editor', 'page-attributes' ),
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

function aslaninst2014_training_summaries( $category ){

	$args = array(
			'post_type' => 'aslaninst_training',
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