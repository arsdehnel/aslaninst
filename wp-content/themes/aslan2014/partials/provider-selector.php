<div class="provider-select-wrapper">
	<a href="#" class="provider-select-toggle">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<g>
				<rect x="55" y="234" width="56" height="45" rx="20" ry="20"></rect>
				<rect x="156" y="234" width="299" height="45" rx="20" ry="20"></rect>
			</g>
			<g>
				<rect x="156" y="334" width="299" height="45" rx="20" ry="20"></rect>
				<rect x="55" y="334" width="56" height="45" rx="20" ry="20"></rect>
			</g>
			<g>
				<rect x="156" y="434" width="299" height="45" rx="20" ry="20"></rect>
				<rect x="55" y="434" width="56" height="45" rx="20" ry="20"></rect>
			</g>
		</svg>
		view provider list
	</a>
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