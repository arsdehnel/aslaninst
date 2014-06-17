<?php
/*
Template Name: Provider Listing
*/

get_header(); ?>

<div class="main" role="main">
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  		<section class="content" id="post-<?php the_ID(); ?>">
    		<header>
      			<h2><?php the_title(); ?></h2>
      			<p><?php the_content(); ?></p>
    		</header>
    		<div class="provider-select-wrapper">
    			<p>Select Provider</p>
    			<nav class="provider-select">
	    			<?php
	    				echo aslantinst2014_providers_list( get_the_id() );
	    			?>
    			</nav><!-- /.provider-select -->
    		</div><!-- /.provider-select-wrapper -->
    		<div class="provider-profile" id="provider-profile">
				<?php
					//if ( have_posts() ) :

						// Start the Loop.
					//	while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */

							echo the_title();

					//	endwhile;

					//endif;
				?>
    		</div><!-- /.provider-profile -->
		</section><!-- /.content -->
  	<?php endwhile; endif; ?>
</div><!-- /.main -->

<?php get_footer(); ?>