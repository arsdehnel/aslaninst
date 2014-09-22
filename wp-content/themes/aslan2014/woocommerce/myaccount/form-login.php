<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="grid" id="customer_login">

	<div class="grid-2-12"></div>
	<div class="grid-4-12">

<?php endif; ?>

		<h2><?php _e( 'Login', 'woocommerce' ); ?></h2>

		<form method="post" class="login form-horizontal">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<div class="control-group">
				<label for="username" class="control-label"><?php _e( 'Username or email address', 'woocommerce' ); ?></label>
				<div class="controls">
					<input type="text" class="input-text" name="username" id="username" />
				</div>
			</div>
			<div class="control-group">
				<label for="password" class="control-label"><?php _e( 'Password', 'woocommerce' ); ?> </label>
				<div class="controls">
					<input class="input-text" type="password" name="password" id="password" />
				</div>
			</div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="control-group">
				<label for="rememberme" class="control-label"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
				<div class="controls">
					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> 
				</div>
			</div>
			<div class="form-actions">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" /> <a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
			</div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div><!-- /.grid-4-12 -->

	<div class="grid-4-12">

		<h2><?php _e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="register form-horizontal">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( get_option( 'woocommerce_registration_generate_username' ) === 'no' ) : ?>

				<div class="control-group">
					<label for="reg_username" class="control-label"><?php _e( 'Username', 'woocommerce' ); ?></label>
					<div class="controls">
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</div>
				</div>

			<?php endif; ?>

			<div class="control-group">
				<label for="reg_email" class="control-label"><?php _e( 'Email address', 'woocommerce' ); ?></label>
				<div class="controls">
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</div>
			</div>

			<div class="control-group">
				<label for="reg_password" class="control-label"><?php _e( 'Password', 'woocommerce' ); ?> </label>
				<div class="controls">
					<input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) echo esc_attr( $_POST['password'] ); ?>" />
				</div>
			</div>

			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

			<?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<div class="form-actions">
				<?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
				<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
			</div>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>
	<div class="grid-2-12"></div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>