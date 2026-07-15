<?php
/**
 * Small helper functions shared by template-parts.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Read one field's value, from whichever context we're rendering in:
 *
 *   - Inside an active ACF Flexible Content row (a section block on
 *     some other page, via page-flexible.php): reads the row's own
 *     unprefixed sub-field. get_row_layout() only returns a (truthy)
 *     layout name while such a loop is actively iterating.
 *   - Everywhere else (the Home page, or a context with no current
 *     post at all — e.g. the contact-form admin-post.php handler):
 *     reads the prefixed "{group}_{key}" field from the Home page.
 *
 * Either way, an empty/missing value falls back to the section's
 * central default (see acf-field-defs.php's mgs_field_default()) — so
 * the site never renders blank content, even before Secure Custom
 * Fields is installed or before any field has been edited.
 *
 * @param string $group   Section slug, e.g. "hero", "about", "contact".
 * @param string $key     Field key within that section.
 * @param mixed  $default Last-resort fallback if there's no default_value either.
 */
function mgs_opt( $group, $key, $default = null ) {
	$in_row = function_exists( 'get_row_layout' ) && get_row_layout();

	if ( $in_row ) {
		$value = function_exists( 'get_sub_field' ) ? get_sub_field( $key ) : null;
	} else {
		$home_id = mgs_get_home_page_id();
		$value   = ( $home_id && function_exists( 'get_field' ) ) ? get_field( "{$group}_{$key}", $home_id ) : null;
	}

	if ( null === $value || '' === $value || false === $value ) {
		$value = mgs_field_default( $group, $key );
	}

	if ( '' === $value && null !== $default ) {
		return $default;
	}

	return $value;
}

/**
 * The Home page's post ID, per Settings > Reading's static front page.
 * Returns 0 if no static front page has been configured yet.
 */
function mgs_get_home_page_id() {
	return (int) get_option( 'page_on_front' );
}

/**
 * Nudge the site owner if there's nowhere for the Home page's field
 * groups to attach to — ACF's "front_page" location rule can't match
 * without a static front page configured.
 */
function mgs_maybe_notice_no_front_page() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( mgs_get_home_page_id() ) {
		return;
	}
	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'Mom Grandridge School: no static front page is set. Go to Settings → Reading and choose a page as your homepage so the Hero/About/… fields appear on its edit screen.', 'mom-grandridge' )
	);
}
add_action( 'admin_notices', 'mgs_maybe_notice_no_front_page' );

/**
 * Echo an option value already escaped for HTML text content.
 */
function mgs_opt_e( $group, $key, $default = '' ) {
	echo esc_html( mgs_opt( $group, $key, $default ) );
}

/**
 * Render a star rating as repeated ★ characters (matches the current
 * static site's plain-text .testi-stars markup).
 */
function mgs_render_stars( $count ) {
	$count = max( 0, min( 5, (int) $count ) );
	return str_repeat( '★', $count );
}

/**
 * Render an <img> from an attachment ID stored in a Theme Options image
 * field, with the same onerror hide-on-fail behaviour as the static site.
 */
function mgs_option_image( $group, $key, $args = array() ) {
	$attachment_id = (int) mgs_opt( $group, $key, 0 );
	if ( ! $attachment_id ) {
		return;
	}

	$defaults = array(
		'size'  => 'mgs-poster',
		'class' => 'section-poster reveal',
		'alt'   => '',
	);
	$args = wp_parse_args( $args, $defaults );

	echo wp_get_attachment_image(
		$attachment_id,
		$args['size'],
		false,
		array(
			'class'   => esc_attr( $args['class'] ),
			'alt'     => esc_attr( $args['alt'] ),
			'loading' => 'lazy',
			'onerror' => "this.style.display='none'",
		)
	);
}

/**
 * Render the site logo: the client's uploaded custom-logo (Customizer)
 * if set, else the bundled fallback image, else an emoji placeholder —
 * matching the static site's onerror-fallback behaviour.
 */
function mgs_render_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		echo wp_get_attachment_image(
			$custom_logo_id,
			'medium',
			false,
			array( 'class' => 'nav-logo-img' )
		);
		return;
	}

	printf(
		'<img src="%1$s" alt="%2$s" class="nav-logo-img" onerror="this.style.display=\'none\'; this.nextElementSibling.style.display=\'inline\'" />',
		esc_url( MGS_THEME_URI . '/assets/img/Logo.jpeg' ),
		esc_attr( get_bloginfo( 'name' ) . ' ' . __( 'logo', 'mom-grandridge' ) )
	);
	echo '<span class="nav-logo-icon" style="display:none">🎓</span>';
}

/**
 * Find the URL of whichever WordPress Page is using the "Full Gallery"
 * page template, so the home page's teaser section can link to it
 * without the admin needing to paste a URL anywhere.
 */
function mgs_get_gallery_page_url() {
	$pages = get_posts(
		array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'meta_key'       => '_wp_page_template',
			'meta_value'     => 'page-gallery.php',
			'fields'         => 'ids',
		)
	);
	return $pages ? get_permalink( $pages[0] ) : '#';
}

/**
 * Split a textarea option (one item per line) into a clean array —
 * used for the Marquee tab.
 */
function mgs_opt_lines( $group, $key, $default_lines = array() ) {
	$raw = mgs_opt( $group, $key, '' );
	if ( ! is_string( $raw ) || '' === $raw ) {
		return $default_lines;
	}
	$lines = preg_split( '/\r\n|\r|\n/', $raw );
	$lines = array_map( 'trim', $lines );
	return array_values( array_filter( $lines, 'strlen' ) );
}
