<?php
/**
 * The main template file
 *
 */

get_header(); ?>

<div id="main">
	<!-- main! -->
</div>
<?php

	if ( have_posts() ) :

		// Start the Loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */

			echo the_title();

		endwhile;

	endif;

	get_footer();


