<header>Your Profile</header>
<div class="well-contents">
	<nav>
	<?php

		$profile_nav[] = array( 'href'  => '/my-account/'
			                   ,'label' => 'Account Home' );
		$profile_nav[] = array( 'href'  => '/my-account/edit-account/'
			                   ,'label' => 'Profile' );
		$profile_nav[] = array( 'href'  => '/my-account/edit-address/billing'
			                   ,'label' => 'Billing Address' );

		foreach( $profile_nav as $nav ):

			if( $nav['href'] == $_SERVER["REQUEST_URI"] ):
				echo '<span>'.$nav['label'].'</span>';
			else:
				echo '<a href="'.$nav['href'].'">'.$nav['label'].'</a>';
			endif;

		endforeach;

	?>
	</nav>
</div>