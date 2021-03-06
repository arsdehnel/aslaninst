<?php

    function wc_add_meta_query($query) {

        // TODO: fix product query here
        if (function_exists('is_shop') && is_shop() && is_main_query() && is_post_type_archive( 'product' ) && !is_admin() ) {
        // echo 'yay';
            $query->set('category', '-53');
            // print_r( $query );
        }
        // return $query;
    }

    function redirect_to_checkout() {
        global $woocommerce;

        //Get product ID
        $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );

        //Check if product ID is in a certain taxonomy
        if( has_term( 'event-registration', 'product_cat', $product_id ) ){

            //Get checkout URL
            $return_url = get_permalink(get_option('woocommerce_checkout_page_id'));


        }else{

            $return_url = $woocommerce->cart->get_cart_url();

        }

        //Return the new URL
        return $return_url;
    }
