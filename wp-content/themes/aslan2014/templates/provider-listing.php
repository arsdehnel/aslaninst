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
	<a href="#" class="provider-select-toggle">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<g>
				<rect x="55" y="0" width="56" height="45" rx="20" ry="20"></rect>
				<rect x="156" y="0" width="299" height="45" rx="20" ry="20"></rect>
			</g>
			<g>
				<rect x="156" y="100" width="299" height="45" rx="20" ry="20"></rect>
				<rect x="55" y="100" width="56" height="45" rx="20" ry="20"></rect>
			</g>
			<g>
				<rect x="156" y="200" width="299" height="45" rx="20" ry="20"></rect>
				<rect x="55" y="200" width="56" height="45" rx="20" ry="20"></rect>
			</g>
		</svg>
		view provider list
	</a>
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