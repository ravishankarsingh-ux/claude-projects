<?php
/**
 * Devadigm block theme setup.
 *
 * Everything global (colors, type, spacing, button styles) lives in
 * theme.json. This file only wires up the few things theme.json cannot:
 * the edge-case stylesheet, the constellation canvas scripts, and the
 * pattern category.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DEVADIGM_THEME_VERSION', '0.1.0' );

add_action( 'after_setup_theme', function () {
	// Load the edge-case stylesheet inside the editor too, so patterns
	// preview the same as the front end.
	add_editor_style( 'assets/css/devadigm-extras.css' );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'devadigm-style',
		get_stylesheet_uri(),
		array(),
		DEVADIGM_THEME_VERSION
	);

	wp_enqueue_style(
		'devadigm-extras',
		get_theme_file_uri( 'assets/css/devadigm-extras.css' ),
		array( 'devadigm-style' ),
		DEVADIGM_THEME_VERSION
	);

	// Motion (scroll/entrance animations) + the constellation canvases.
	// constellation.js no-ops for any canvas that is not in the DOM and
	// skips animation entirely under prefers-reduced-motion.
	wp_enqueue_script(
		'devadigm-motion',
		get_theme_file_uri( 'assets/js/motion.min.js' ),
		array(),
		DEVADIGM_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'devadigm-constellation',
		get_theme_file_uri( 'assets/js/constellation.js' ),
		array( 'devadigm-motion' ),
		DEVADIGM_THEME_VERSION,
		true
	);
} );

/**
 * Fixed full-page particle canvas behind all content. Decorative only,
 * so it is injected here rather than kept as an HTML block in every
 * template.
 */
add_action( 'wp_body_open', function () {
	echo '<canvas id="ambient-field" aria-hidden="true"></canvas>' . "\n";
} );

add_action( 'init', function () {
	register_block_pattern_category(
		'devadigm',
		array( 'label' => __( 'Devadigm', 'devadigm' ) )
	);
} );
