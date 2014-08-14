<?php

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

