<?php
	$training_summary_return = '<article>';
	$training_summary_return .= '<header>';
	$training_summary_return .= '<h3><a href="'.get_permalink($summary->ID).'">';
	$training_summary_return .= $summary->post_title;
	$training_summary_return .= '</a></h3>';
	$training_summary_return .= '</header>';
	$training_summary_return .= '<p>';
	$training_summary_return .= $summary->post_excerpt;
	$training_summary_return .= '</p>';
	$training_summary_return .= '<p class="read-more">';
	$training_summary_return .= '<a href="#">read more</a>';
	$training_summary_return .= '</p>';

	$training_summary_return .= '</article>';
	return $training_summary_return;