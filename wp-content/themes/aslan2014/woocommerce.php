<?php
/*
Template Name: Store
*/

get_header(); ?>

<div class="main" role="main">
  <section class="content" id="post-<?php the_ID(); ?>">
  	<?php

		//this is the header and excerpt
		get_template_part( 'partials/content', 'breadcrumbs' );

		//this is the header and excerpt
		// get_template_part( 'partials/content', 'header' );

        if( is_shop() ):

            // print_r( WooCommerce::query );

        endif;

		woocommerce_content();

  	?>
  </section><!-- /.content -->

</div><!-- /.main -->

<?php get_footer(); ?>
