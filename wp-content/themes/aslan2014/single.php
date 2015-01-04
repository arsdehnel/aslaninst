<?php
/*
Template Name: Default & Router
* for this theme it's also acting as a router of sorts
* so all the templates can live together in the templates folder
* rather than a bunch of single-* files here in the root
*/

get_header(); ?>

<div class="main" role="main">
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  		<section class="content" id="post-<?php the_ID(); ?>">
    		<?php
    			if( get_post_type( get_the_ID() ) == 'aslaninst_provider' ):

    				//this is the header and excerpt
    				get_template_part( 'partials/provider', 'header' );

    				//the left rail selector pane
    				get_template_part( 'partials/provider', 'selector' );

    				//and the profile area
    				get_template_part( 'partials/provider', 'profile' );

    			elseif( get_post_type( get_the_ID() ) == 'aslaninst_training' ):

    				//this is the header and excerpt
    				get_template_part( 'partials/content', 'breadcrumbs' );

    				//this is the header and excerpt
    				get_template_part( 'partials/content', 'header' );

    				//and then we just needs the tabs
    				get_template_part( 'partials/content', 'tabs' );

    			else:

    				// echo get_post_type( get_the_ID() ) . ' has no customized template setup.';
    				echo the_content();

				endif;
    		?>
		</section><!-- /.content -->
  	<?php endwhile; endif; ?>
</div><!-- /.main -->

<?php get_footer(); ?>
