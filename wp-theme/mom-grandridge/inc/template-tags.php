<?php
/**
 * Small helper functions shared by template-parts.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Read one field from a Theme Options tab.
 *
 * Each tab is stored as its own option (e.g. "mgs_opt_hero") holding an
 * associative array, so saving one tab never touches another tab's data.
 *
 * @param string $group   Tab name, e.g. "hero", "about", "contact".
 * @param string $key     Field key within that tab.
 * @param mixed  $default Fallback value if unset.
 */
function mgs_opt( $group, $key, $default = '' ) {
	$all = get_option( 'mgs_opt_' . $group, array() );
	if ( ! is_array( $all ) || ! isset( $all[ $key ] ) || '' === $all[ $key ] ) {
		return $default;
	}
	return $all[ $key ];
}

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
 * Split a textarea option (one item per line) into a clean array —
 * used for the Marquee tab.
 */
function mgs_opt_lines( $group, $key, $default_lines = array() ) {
	$raw = mgs_opt( $group, $key, '' );
	if ( '' === $raw ) {
		return $default_lines;
	}
	$lines = preg_split( '/\r\n|\r|\n/', $raw );
	$lines = array_map( 'trim', $lines );
	return array_values( array_filter( $lines, 'strlen' ) );
}
