<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart product-variations" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php if ( ! empty( $available_variations ) ) : ?>
		<div class="variations">
				<?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
					<div class="btn-group">
						<button type="button" class="button dropdown-toggle" data-toggle="dropdown">
							Add to Cart <span class="caret"></span>
						</button>
						<ul class="dropdown-menu add-to-cart" role="menu" data-attribute-name="<?php echo sanitize_title( $name ); ?>">
							<?php
								if ( is_array( $options ) ) {

									if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
										$selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
									} elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
										$selected_value = $selected_attributes[ sanitize_title( $name ) ];
									} else {
										$selected_value = '';
									}

									// Get terms if this is a taxonomy - ordered
									if ( taxonomy_exists( $name ) ) {

										$orderby = wc_attribute_orderby( $name );

										switch ( $orderby ) {
											case 'name' :
												$args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
											break;
											case 'id' :
												$args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false, 'hide_empty' => false );
											break;
											case 'menu_order' :
												$args = array( 'menu_order' => 'ASC', 'hide_empty' => false );
											break;
										}

										$terms = get_terms( $name, $args );

										foreach ( $terms as $term ) {
											if ( ! in_array( $term->slug, $options ) )
												continue;

											echo '<li><a href="#" data-variation-id="' . esc_attr( $term->slug ) . '">'.apply_filters( 'woocommerce_variation_option_name', $term->name ).'</a></li>';

											//<a href="/shop/?add-to-cart=78" rel="nofollow" data-product_id="78" data-product_sku="CANDLE" class="button add_to_cart_button product_type_simple">Add to cart</a>

										}
									} else {

										foreach ( $options as $option ) {
											echo '<li><a href="#" data-variation-id="' . esc_attr( sanitize_title( $option ) ) . '">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</a></li>';
										}

									}
								}
							?>
						</ul><!-- /.dropdown-menu -->
					</div><!-- /.btn-group -->
					<?php
						echo '<input type="hidden" name="attribute_' . sanitize_title( $name ).'" value="" />';
						if ( sizeof($attributes) == $loop )
							echo '<a class="reset_variations" href="#reset">' . __( 'Clear selection', 'woocommerce' ) . '</a>';
					?>
		        <?php endforeach;?>
			</div><!-- /.variations -->
		
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php do_action( 'woocommerce_before_single_variation' ); ?>

			<div class="variations_button">
				<button type="submit" class="single_add_to_cart_button button alt hide"><?php echo $product->single_add_to_cart_text(); ?></button>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" value="" />

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php else : ?>

		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>

	<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
