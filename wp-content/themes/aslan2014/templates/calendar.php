<?php
/*
Template Name: Provider Listing
*/

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="content" id="post-<?php the_ID(); ?>">
		<header>
				<h2><?php the_title(); ?></h2>
		</header>
		<div class="calendar-wrapper">
			<?php the_content(); ?>
		</div><!-- /.calendar-wrapper -->
	</section><!-- /.content -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>