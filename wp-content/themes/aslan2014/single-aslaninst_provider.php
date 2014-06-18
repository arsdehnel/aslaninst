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
	    				echo aslaninst2014_providers_list( get_the_id() );
	    			?>
    			</nav><!-- /.provider-select -->
    		</div><!-- /.provider-select-wrapper -->
    		<div class="provider-profile" id="provider-profile">
    			<?php
    				get_template_part( 'templates/provider', 'profile' );
    			?>
    		</div><!-- /.provider-profile -->
		</section><!-- /.content -->
  	<?php endwhile; endif; ?>
</div><!-- /.main -->

<?php get_footer(); ?>