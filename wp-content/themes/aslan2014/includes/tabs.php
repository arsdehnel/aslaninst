<?php

	add_filter('manage_aslaninst_tabs_posts_columns', 'aslaninst_tabs_table_head');
	add_filter('manage_aslaninst_tabs_posts_columns', 'aslaninst_tabs_reorder_columns');
	add_action('manage_aslaninst_tabs_posts_custom_column', 'aslaninst_table_content', 10, 2 );
	add_action( 'add_meta_boxes', function() { add_meta_box('aslaninst_tabs', 'Tab Details', 'tab_details_meta_box', 'aslaninst_tabs', 'side', 'high');});
	add_action( 'save_post', 'aslaninsttabs_save_meta_box' );

	function tabs_init() {

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

	}

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

	function aslaninst_tabs_table_head( $defaults ) {
	    $defaults['title'] = 'Tab Text';
	    $defaults['parent'] = 'Parent Page';
	    $defaults['menu_order'] = 'Order';
	    $defaults['author'] = 'Added By';
	    return $defaults;
	}

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
