<?php

	// add_filter( 'tribe-events-bar-filters',  'setup_my_field_in_bar', 1, 1 );

	function setup_my_field_in_bar( $filters ) {
		$filters['tribe-bar-event-type'] = array(
			'name' => 'tribe-bar-event-type',
			'caption' => 'Event Type',
			'html' => '<select name="tribe-bar-event-type" id="tribe-bar-event-type" multiple><option value="aslan">Aslan Event</option></select>'
		);

		return $filters;
	}

	// add_filter( 'tribe_events_pre_get_posts', 'setup_my_bar_field_in_query', 10, 1 );

	function setup_my_bar_field_in_query( $query ){
		if ( !empty( $_REQUEST['tribe-bar-event-type'] ) ) {
			//echo 'yay';
			$query->query_vars['event-type'] = $_REQUEST['tribe-bar-event-type'];
		}

		return $query;
	}