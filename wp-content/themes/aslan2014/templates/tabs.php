<?php
/*
Template Name: Tabs
*/

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="content" id="post-<?php the_ID(); ?>">
	<header>
			<h2><?php the_title(); ?></h2>
			<p><?php the_content(); ?></p>
	</header>
	<?php
		//and then we just needs the tabs
		get_template_part( 'partials/content', 'tabs' );
	?>
</section><!-- /.content -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>
