<?php
/*
Template Name: Home
*/

// $provider = get_field('provider_spotlight');
// $event = get_field('calendar_event');
$event_page = get_page( $event->ID );
// $training = get_field('training_spotlight');
$training_page = get_page( $training->ID );

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
			<h1>Training Institute Spotlight</h1>
			<div class="feature-inner">
				<?php
					if( has_post_thumbnail( $training->ID ) ):
						echo get_the_post_thumbnail( $training->ID, 'thumbnail' );
					endif;
				?>
				<h2><?php echo $training_page->post_title; ?></h2>
				<p><?php echo the_field( 'training_spotlight_message' ); ?></p>
				<div class="actions">
					<a href="<?php echo get_the_permalink( $training->ID ); ?>" class="btn">View This Event</a>
				</div>
				<div class="actions">
					<a href="<?php echo get_the_permalink( $training->ID ); ?>" class="btn">View This Training</a>
				</div>
			</div>
		</article>
		<article class="feature">
			<h1>Upcoming Event at Aslan</h1>
			<div class="feature-inner">
				<?php
					if( has_post_thumbnail( $event->ID ) ):
						echo get_the_post_thumbnail( $event->ID, 'thumbnail' );
					else:
						?>
						<img src="<?php echo get_template_directory_uri() ?>/assets/images/icon-feature-calendar.png">
						<?php
					endif;
				?>
				<h2><?php echo $event_page->post_title; ?></h2>
				<p><?php echo the_field( 'calendar_event_message' ); ?></p>
				<div class="actions">
					<a href="<?php echo get_the_permalink( $event->ID ); ?>" class="btn">View This Event</a>
				</div>
			</div>
		</article>
		<article class="feature">
			<h1>Provider Spotlight</h1>
			<div class="feature-inner">
				<?php
					echo get_the_post_thumbnail( $provider->ID, 'thumbnail' );
				?>
				<h2><?php echo get_the_title( $provider->ID ); ?></h2>
				<p><?php echo the_field( 'provider_spotlight_message' ); ?></p>
				<div class="actions">
					<a href="<?php echo get_the_permalink( $provider->ID ); ?>" class="btn">View This Provider's Profile</a>
				</div>
			</div>
		</article>
	</div><!-- /.features -->
</section><!-- /.content -->

<?php get_footer(); ?>
