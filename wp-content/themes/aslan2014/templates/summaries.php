<?php
/*
Template Name: Summaries
*/

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="content" id="post-<?php the_ID(); ?>">
	<header>
			<h2><?php the_title(); ?></h2>
			<p><?php the_content(); ?></p>
	</header>
	<div class="training-summary-wrapper primary">
		<?php
			echo aslaninst2014_training_summaries( 'primary' );
		?>
	</div><!-- /.training-summary-wrapper.primary -->
	<div class="training-summary-wrapper secondary">
		<h2>Other Training Opportunities</h2>
		<?php
			echo aslaninst2014_training_summaries( 'secondary' );
		?>
	</div><!-- /.training-summary-wrapper.secondary -->
</section><!-- /.content -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>
