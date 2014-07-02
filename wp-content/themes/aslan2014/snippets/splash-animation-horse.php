<?php
	$splash_animation_horse_return = '<li class="horse" data-duration="'.get_field('frame_duration', $horse->ID).'" style="background-image: url('.aslaninst2014_animation_image_url($horse->ID).');">';
	$splash_animation_horse_return .= '<div class="horse-content location-'.get_field('text_location', $horse->ID).'">';
	$splash_animation_horse_return .= $horse->post_content;
	$splash_animation_horse_return .= '</div><!-- /.horse -->';
	$splash_animation_horse_return .= '</li>';
	return $splash_animation_horse_return;