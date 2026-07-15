<?php
/**
 * Front-end and admin asset loading.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_enqueue_assets() {
	wp_enqueue_style( 'mgs-style', MGS_THEME_URI . '/assets/css/style.css', array(), MGS_THEME_VERSION );

	wp_enqueue_script( 'mgs-three', MGS_THEME_URI . '/assets/vendor/three.min.js', array(), MGS_THEME_VERSION, true );
	wp_enqueue_script( 'mgs-gsap', MGS_THEME_URI . '/assets/vendor/gsap.min.js', array(), MGS_THEME_VERSION, true );
	wp_enqueue_script( 'mgs-scrolltrigger', MGS_THEME_URI . '/assets/vendor/ScrollTrigger.min.js', array( 'mgs-gsap' ), MGS_THEME_VERSION, true );
	wp_enqueue_script(
		'mgs-main',
		MGS_THEME_URI . '/assets/js/main.js',
		array( 'mgs-three', 'mgs-gsap', 'mgs-scrolltrigger' ),
		MGS_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'mgs_enqueue_assets' );

/**
 * Load the media-uploader JS only on our Theme Options admin screen.
 */
function mgs_admin_enqueue_assets( $hook ) {
	if ( 'toplevel_page_mgs-theme-options' !== $hook ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script(
		'mgs-admin-options',
		MGS_THEME_URI . '/assets/js/admin-options.js',
		array( 'jquery' ),
		MGS_THEME_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', 'mgs_admin_enqueue_assets' );
