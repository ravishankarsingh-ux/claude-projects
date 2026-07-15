<?php
/**
 * Admission enquiry form handler — real email via wp_mail(), no plugin.
 *
 * Flow: template-parts/contact.php posts to admin-post.php with a nonce
 * and a honeypot field -> mgs_handle_contact_submit() validates, sends
 * mail, and redirects back to #contact with a ?mgs_contact=success|error
 * query var that the template reads to render the confirmation state.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_handle_contact_submit() {
	check_admin_referer( 'mgs_contact_submit', 'mgs_contact_nonce' );

	$redirect_base = wp_get_referer() ? wp_get_referer() : home_url( '/' );

	// Honeypot: real visitors never fill this hidden field in. Silently
	// pretend success so bots don't learn anything from the response.
	if ( ! empty( $_POST['mgs_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'mgs_contact', 'success', $redirect_base ) . '#contact' );
		exit;
	}

	$name  = isset( $_POST['mgs_name'] ) ? sanitize_text_field( wp_unslash( $_POST['mgs_name'] ) ) : '';
	$phone = isset( $_POST['mgs_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['mgs_phone'] ) ) : '';
	$email = isset( $_POST['mgs_email'] ) ? sanitize_email( wp_unslash( $_POST['mgs_email'] ) ) : '';
	$class = isset( $_POST['mgs_class'] ) ? sanitize_text_field( wp_unslash( $_POST['mgs_class'] ) ) : '';
	$message = isset( $_POST['mgs_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['mgs_message'] ) ) : '';

	$valid = $name && $phone && $email && is_email( $email ) && $class;

	if ( $valid ) {
		$to = mgs_opt( 'contact', 'form_recipient_email', '' );
		if ( ! $to || ! is_email( $to ) ) {
			$to = get_option( 'admin_email' );
		}

		$subject = sprintf(
			/* translators: %s: parent's name */
			__( 'New Admission Enquiry from %s', 'mom-grandridge' ),
			$name
		);

		$body = "A new admission enquiry was submitted on " . get_bloginfo( 'name' ) . ":\n\n"
			. "Parent's Name: {$name}\n"
			. "Phone: {$phone}\n"
			. "Email: {$email}\n"
			. "Class Applying For: {$class}\n"
			. "Message:\n{$message}\n";

		$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

		$sent = wp_mail( $to, $subject, $body, $headers );

		wp_safe_redirect( add_query_arg( 'mgs_contact', $sent ? 'success' : 'error', $redirect_base ) . '#contact' );
		exit;
	}

	wp_safe_redirect( add_query_arg( 'mgs_contact', 'error', $redirect_base ) . '#contact' );
	exit;
}
add_action( 'admin_post_mgs_contact_submit', 'mgs_handle_contact_submit' );
add_action( 'admin_post_nopriv_mgs_contact_submit', 'mgs_handle_contact_submit' );

/**
 * Log delivery failures for production visibility — still zero-plugin,
 * just core's own action hook.
 */
function mgs_log_mail_failure( $wp_error ) {
	error_log( 'Mom Grandridge contact form: wp_mail failed — ' . $wp_error->get_error_message() ); // phpcs:ignore
}
add_action( 'wp_mail_failed', 'mgs_log_mail_failure' );
