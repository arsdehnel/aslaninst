<div class="provider-profile" id="provider-profile">
	<?php
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  			echo get_the_post_thumbnail( $post->ID, 'thumbnail', array('class' => 'provider-thumb'));
		}
	?>
	<div class="provider-details">
		<h3><?php echo the_title(); ?></h3>
		<ul>
			<li><strong>Email</strong><span><a href="mailto:<?php echo antispambot( the_field('email') ); ?>"><?php echo antispambot( the_field('email') ); ?></a></span></li>
			<li><strong>Phone</strong><span><?php the_field('phone_number'); ?></span></li>
			<li><strong>Specialties</strong><span><?php echo aslaninst2014_acf_taxonomy_to_string( get_field('specialties') ); ?></span></li>
			<li><strong>Insurances Accepted</strong><span><?php echo aslaninst2014_acf_taxonomy_to_string( get_field('insurances_accepted') ); ?></span></li>
		</ul>
		<?php
			if( strlen( get_field( 'website_url' ) ) ):
				?>
				<a href="<?php echo get_field( 'website_url' ); ?>" class="provider-website" target="_blank">Visit Website</a>
				<?php
			endif;
		?>
	</div>
	<div class="provider-bio">
		<?php the_content(); ?>
	</div>
</div><!-- /.provider-profile -->