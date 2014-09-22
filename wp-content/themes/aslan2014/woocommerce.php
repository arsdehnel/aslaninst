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
		get_template_part( 'partials/content', 'header' );

		woocommerce_content();

		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) :
			woocommerce_mini_cart();
		else:
            ?>
        	<h2>Your Cart!</h2>
			<p>
				Waiting and willing to be filled with your orders.
            </p>
            <?php
		endif;
  	?>
  </section><!-- /.content -->

</div><!-- /.main -->

<?php get_footer(); ?>
