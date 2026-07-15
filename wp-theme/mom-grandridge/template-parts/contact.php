<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_result = isset( $_GET['mgs_contact'] ) ? sanitize_key( wp_unslash( $_GET['mgs_contact'] ) ) : '';

$mgs_class_options = get_posts(
	array(
		'post_type'      => 'program',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'fields'         => 'ids',
	)
);
?>
<section class="section contact" id="contact">
	<div class="container split">
		<div class="contact-info">
			<p class="eyebrow reveal"><?php mgs_opt_e( 'contact', 'eyebrow' ); ?></p>
			<h2 class="section-title reveal"><?php mgs_opt_e( 'contact', 'heading_plain' ); ?> <span class="grad-2"><?php mgs_opt_e( 'contact', 'heading_accent' ); ?></span></h2>
			<div class="contact-cards">
				<div class="contact-card reveal"><i>📍</i><div><strong><?php esc_html_e( 'Office', 'mom-grandridge' ); ?></strong><span><?php echo nl2br( esc_html( mgs_opt( 'contact', 'address' ) ) ); ?></span></div></div>
				<div class="contact-card reveal"><i>📞</i><div><strong><?php esc_html_e( 'Contact', 'mom-grandridge' ); ?></strong><span><?php mgs_opt_e( 'contact', 'phone' ); ?></span></div></div>
				<div class="contact-card reveal"><i>✉️</i><div><strong><?php esc_html_e( 'Email', 'mom-grandridge' ); ?></strong><span><?php mgs_opt_e( 'contact', 'email' ); ?></span></div></div>
				<div class="contact-card reveal"><i>🕗</i><div><strong><?php esc_html_e( 'Open Hours', 'mom-grandridge' ); ?></strong><span><?php mgs_opt_e( 'contact', 'hours' ); ?></span></div></div>
			</div>
		</div>
		<form class="contact-form reveal<?php echo 'success' === $mgs_result ? ' form-success' : ''; ?>" data-tilt method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<h3><?php esc_html_e( 'Admission Enquiry', 'mom-grandridge' ); ?></h3>

			<?php if ( 'success' === $mgs_result ) : ?>
				<div class="form-banner form-banner-success"><?php mgs_opt_e( 'contact', 'success_message' ); ?></div>
			<?php elseif ( 'error' === $mgs_result ) : ?>
				<div class="form-banner form-banner-error"><?php mgs_opt_e( 'contact', 'error_message' ); ?></div>
			<?php endif; ?>

			<input type="hidden" name="action" value="mgs_contact_submit" />
			<?php wp_nonce_field( 'mgs_contact_submit', 'mgs_contact_nonce' ); ?>
			<input type="text" name="mgs_website" value="" autocomplete="off" tabindex="-1" style="position:absolute;left:-9999px;" aria-hidden="true" />

			<div class="form-row">
				<input type="text" name="mgs_name" placeholder="<?php esc_attr_e( "Parent's Name", 'mom-grandridge' ); ?>" required />
				<input type="tel" name="mgs_phone" placeholder="<?php esc_attr_e( 'Phone Number', 'mom-grandridge' ); ?>" required />
			</div>
			<input type="email" name="mgs_email" placeholder="<?php esc_attr_e( 'Email Address', 'mom-grandridge' ); ?>" required />
			<select name="mgs_class" required>
				<option value="" disabled selected><?php esc_attr_e( 'Class Applying For', 'mom-grandridge' ); ?></option>
				<?php foreach ( $mgs_class_options as $mgs_program_id ) : ?>
					<option><?php echo esc_html( get_the_title( $mgs_program_id ) ); ?></option>
				<?php endforeach; ?>
				<option><?php esc_html_e( 'Activity Classes', 'mom-grandridge' ); ?></option>
			</select>
			<textarea name="mgs_message" rows="4" placeholder="<?php esc_attr_e( 'Your Message', 'mom-grandridge' ); ?>"></textarea>
			<button type="submit" class="btn btn-primary btn-block"><span><?php esc_html_e( 'Send Message', 'mom-grandridge' ); ?></span> <i>→</i></button>
			<p class="form-note"><?php mgs_opt_e( 'contact', 'note_text' ); ?></p>
		</form>
	</div>
</section>
