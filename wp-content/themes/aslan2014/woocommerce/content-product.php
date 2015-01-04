<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
    $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
    return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
    $classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
    $classes[] = 'last';

// TODO: remove stupid category filter from this loop
?>
<?php if( strlen( $product->get_categories() ) == 0 ): ?>
<article <?php post_class( $classes ); ?>>

    <header>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    </header>

    <?php wc_get_template( 'single-product/product-image.php' ); ?>
    <?php wc_get_template( 'single-product/short-description.php' ); ?>

    <footer>
        <?php wc_get_template( 'single-product/price.php' ); ?>
        <?php wc_get_template( 'single-product/add-to-cart/simple.php' ); ?>
    </footer>

</article>
<?php endif; ?>