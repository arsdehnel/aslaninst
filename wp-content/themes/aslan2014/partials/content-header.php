<header class="post-header">
	<h2><?php the_title(); ?></h2>
	<p><?php the_excerpt(); ?></p>
    <?php
        if( get_field('registration_type') == "ecommerce" ):
            $shortcode = '[add_to_cart_url id="'.get_field('registration_product')->ID.'"]';
            echo '<a class="register-now-button" href="'.do_shortcode($shortcode).'">Register Now</a>';
        elseif( get_field('registration_type') == "email" ):
            echo 'email registration_type';
        endif;
    ?>
</header>
