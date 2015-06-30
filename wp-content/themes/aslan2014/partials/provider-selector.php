<div class="provider-select-wrapper">
	<a href="#" class="provider-select-toggle">view provider list</a>
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