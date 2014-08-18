<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
	<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>

    <meta name="viewport" content="width=device-width">

    <!-- Wordpress Head Items -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/build/jquery-1.11.1.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/build/jquery.lettering.js"></script>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<div class="site-wrapper">
		<header class="site-header">
			<h1><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.jpg"></h1>
			<h2><?php wp_title('', true, 'right'); ?></h2>
			<address class="vcard">
			   	<div class="adr">
			   		<div class="addr-line">
				      	<div class="street-address">4141 Old Sibley Memorial Highway</div>
					</div>
			   		<div class="addr-line">
				      	<div class="locality">Eagan, MN</div >
				      	<div class="postal-code">55122</div >
				      	<div class="country-name sr-only">USA</div >
					</div>
			   	</div>
			   	<div class="tel">Phone: 651.686.8818</div>
			   	<div class="fax">Fax: 651.882.6280</div>
			</address>
			<ul class="connect-options">
				<li class="email"><a href="mailto:<?php echo antispambot( 'info@aslaninst.com' ); ?>"><?php echo antispambot( 'info@aslaninst.com' ); ?></a></li>
				<li class="facebook"><a href="https://www.facebook.com/pages/Aslan-Institute/57758293600">Facebook</a></li>
				<li class="constant-contact"><a href="http://visitor.r20.constantcontact.com/d.jsp?llr=cozbrycab&p=oi&m=1102482302402&sit=woe9n45db&f=e618077a-40b4-4a94-bb13-3d847164207e">Newsletter</a></li>
				<li class="my-account"><a href="/wp-admin">My Account</a></li>
			</ul>
		</header>
		<nav class="nav-main">
			<?php
				$items = wp_get_nav_menu_items( 'main' );
				$active_id = aslaninst2014_active_menu_lkup( $items );
				foreach( $items as $item ):
					if( $item->object_id == $active_id ):
					// if( is_page( $item->object_id ) ):
						$class = " active";
					else:
						$class = "";
					endif;
					?>
					<a href="<?php echo $item->url; ?>" class="<?php echo $class;?>">
						<?php echo $item->title; ?>
		  			</a>
		  			<?php
				endforeach;
			?>
		</nav>
		<div id="main" class="main">