<nav class="nav-breadcrumbs">
	<?php

	if( get_post_type( get_the_ID() ) == 'aslaninst_training' ):

		?>
		<a href="/training">Back to Training Home</a>
		<span class="divider">></span>
		<span><?php the_title(); ?></span>
		<?php

	elseif( get_post_type( get_the_ID() ) == 'product' ):

		?>
		<a href="/store">Back to Store</a>
		<span class="divider">></span>
		<span><?php the_title(); ?></span>
		<?php

	endif;

?>
</nav><!-- /.breadcrumbs -->