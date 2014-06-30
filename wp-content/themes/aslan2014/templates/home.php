<?php
/*
Template Name: Home
*/

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="content" id="post-<?php the_ID(); ?>">
		<div class="carousel">
			<ul class="horses">
			<?php
				echo aslaninst2014_splash_animation();
			?>
			</ul><!-- /.horses -->
		</div><!-- /.carousel -->
		<div class="features">
			<article class="feature">
				<img src="http://placehold.it/100x100">
				<h1>Feature #1</h1>
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
<?php endwhile; endif; ?>

<?php get_footer(); ?>
