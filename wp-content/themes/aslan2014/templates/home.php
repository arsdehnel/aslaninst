<?php
/*
Template Name: Home
*/

get_header(); ?>

<section class="content" id="post-<?php the_ID(); ?>">
	<div class="carousel">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<ul class="horses">
			<?php
				echo aslaninst2014_splash_animation();
			?>
			</ul><!-- /.horses -->
		<?php endwhile; endif; ?>
	</div><!-- /.carousel -->
	<div class="features">
		<article class="feature">
			<?php
				$provider = get_field('provider_spotlight');
				// print_r( $provider );
				echo get_the_post_thumbnail( $provider->ID, 'thumbnail', array('class' => 'feature-thumb'));
			?>
			<h1>Provider Spotlight</h1>
			<h2><?php echo get_the_title( $provider->ID ); ?></h2>
			<div class="feature-details">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, porro, aperiam culpa non nobis dolores esse minima ducimus architecto sed.
			</div>
		</article>
		<article class="feature">
			<img src="http://placehold.it/100x100">
			<h1>Feature #2</h1>
			<div class="feature-details">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, porro, aperiam culpa non nobis dolores esse minima ducimus architecto sed.
			</div>
		</article>
		<article class="feature">
			<img src="http://placehold.it/100x100">
			<h1>Feature #3</h1>
			<div class="feature-details">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat, porro, aperiam culpa non nobis dolores esse minima ducimus architecto sed.
			</div>
		</article>
	</div><!-- /.features -->
</section><!-- /.content -->

<?php get_footer(); ?>
