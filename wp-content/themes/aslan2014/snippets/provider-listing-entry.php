<?php
	$provider_listing_entry_return = '<a href="'.get_permalink($provider->ID).'"';
	if( $provider->ID == $id ):
		$provider_listing_entry_return .= ' class="active"';
	endif;
	$provider_listing_entry_return .= '>';
	$provider_listing_entry_return .= $provider->post_title;
	//$provider_listing_entry_return .= var_dump($provider);
	$provider_listing_entry_return .= '</a>';
	return $provider_listing_entry_return;