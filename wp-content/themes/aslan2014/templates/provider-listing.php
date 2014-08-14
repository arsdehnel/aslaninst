<?php
/*
Template Name: Provider Listing
*/

get_header();

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="content" id="post-<?php the_ID(); ?>">
	<header>
			<h2><?php the_title(); ?></h2>
			<p><?php the_excerpt(); ?></p>
	</header>
	<div class="provider-select-wrapper">
		<p>Leadership Team</p>
		<nav class="provider-select leadership">
			<?php
				echo aslaninst2014_providers_list( get_the_id(), 'leadership' );
			?>
		</nav><!-- /.provider-select -->
		<p>Providers</p>
		<nav class="provider-select providers">
			<?php
				echo aslaninst2014_providers_list( get_the_id(), 'provider' );
			?>
		</nav><!-- /.provider-select -->
	</div><!-- /.provider-select-wrapper -->
	<div class="provider-profile" id="provider-profile">
		<p><?php the_content(); ?></p>
	</div><!-- /.provider-profile -->
</section><!-- /.content -->
<?php endwhile; endif; ?>

<?php get_footer(); ?>