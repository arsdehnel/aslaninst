<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices(); ?>

	<?php do_action( 'woocommerce_before_my_account' ); ?>
		<div class="grid-3-12 well well-nav">
			<?php wc_get_template( 'myaccount/my-profile-nav.php' ); ?>
		</div>
		<div class="grid-6-12">
			<div class="container">
				<?php
					printf(
						__( '<h2 class="woocommerce-header">Hello <strong>%1$s</strong></h2><span class="container-action">Not %1$s? <a href="%2$s">Sign out</a></span>', 'woocommerce' ) . ' ',
						$current_user->display_name,
						wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )
					);
				?>
			</div>
			<p>
				Welcome to your account dashboard! From here you can view your recent orders, manage your shipping and billing addresses and maintain your profile.
			</p>
			<div class="container form-horizontal">
				<h3>Your Profile</h3>
				<a href="<?php echo wc_customer_edit_account_url(); ?>" class="container-action">Edit Your Profile</a>
				<div class="control-group">
					<label class="control-label">First Name</label>
					<div class="controls">
						<span class="uneditable-input"><?php echo array_pop( get_user_meta( $current_user->ID, 'first_name' ) ); ?></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Last Name</label>
					<div class="controls">
						<span class="uneditable-input"><?php echo array_pop( get_user_meta( $current_user->ID, 'last_name' ) ); ?></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">E-mail Address</label>
					<div class="controls">
						<span class="uneditable-input"><?php echo $current_user->data->user_email; ?></span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Registration Date</label>
					<div class="controls">
						<span class="uneditable-input"><?php echo $current_user->data->user_registered; ?></span>
					</div>
				</div>

			</div>
		</div>
		<div class="grid-3-12 well">
			<?php wc_get_template( 'myaccount/my-address.php' ); ?>
			<header>Order Information</header>
			<div class="well-contents">
				<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
				<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>
				<?php do_action( 'woocommerce_after_my_account' ); ?>
			</div>
		</div>