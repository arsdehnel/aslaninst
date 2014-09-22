<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page 
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.0.15
 */

?>
	<div class="grid-3-12 well well-nav">
		<?php wc_get_template( 'myaccount/my-profile-nav.php' ); ?>
	</div>
	<div class="grid-6-12">
		<h2 class="woocommerce-header">Order <?php echo $order->get_order_number(); ?></h2>
		<?php
			if ( $notes = $order->get_customer_order_notes() ) :
				?>
				<h3><?php _e( 'Order Updates', 'woocommerce' ); ?></h3>
				<ol class="commentlist notes">
					<?php foreach ( $notes as $note ) : ?>
					<li class="comment note">
						<div class="comment_container">
							<div class="comment-text">
								<p class="meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
								<div class="description">
									<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
								</div>
				  				<div class="clear"></div>
				  			</div>
							<div class="clear"></div>
						</div>
					</li>
					<?php endforeach; ?>
				</ol>
				<?php
			endif;

			do_action( 'woocommerce_view_order', $order_id );
			echo '<p class="order-info">' . sprintf( __( 'Order %s was placed on %s and is currently %s.', 'woocommerce' ), $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), __( $status->name, 'woocommerce' ) ) . '</p>';
		?>
	</div>
	<div class="grid-3-12 well">
		<header>Order Details</header>
		<div class="well-contents">
			<p>
				If you have any questions about this order or anything else order-related please contact us at XXX@peerministry.org and we will be happy to help you.
			</p>
		</div>
	</div>
