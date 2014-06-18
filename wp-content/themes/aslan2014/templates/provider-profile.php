<img src="http://placehold.it/180x180" class="provider-thumb">
<div class="provider-details">
	<h3><?php echo the_title(); ?></h3>
	<ul>
		<li><strong>Email</strong><span><?php the_field('email'); ?></span></li>
		<li><strong>Phone</strong><span><?php the_field('phone_number'); ?></span></li>
		<li><strong>Specialties</strong><span><?php echo aslaninst2014_acf_taxonomy_to_string( get_field('specialties') ); ?></span></li>
		<li><strong>Insurances Accepted</strong><span><?php echo aslaninst2014_acf_taxonomy_to_string( get_field('insurances_accepted') ); ?></span></li>
	</ul>
	<?php
		if( strlen( get_field( 'website_url' ) ) ):
			?>
			<a href="#" class="provider-website">Link to Website</a>
			<?php
		endif;
	?>
</div>
<div class="provider-bio">
	<?php the_content(); ?>
</div>