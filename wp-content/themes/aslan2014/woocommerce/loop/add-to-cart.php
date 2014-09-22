<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		//this add_to_cart_button class makes the request go ajax but there is no alert that it worked
		//so for the initial peerministry release we're removing that so it just does a normal http request
		//and we can show the result
		//$product->is_purchasable() ? 'add_to_cart_button' : '',
		'',             
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() )
	),
$product );
