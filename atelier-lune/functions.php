<?php
/**
 * Atelier Lune block theme setup.
 *
 * Global design tokens live in theme.json. This file wires up only what
 * theme.json cannot: the signature-element stylesheet (cutting lines,
 * selvedge, fabric swatches, palette chips) and the pattern category.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ATELIER_LUNE_VERSION', '0.1.0' );

add_action( 'after_setup_theme', function () {
	// Signature-element styles inside the editor too, so patterns
	// preview identically to the front end.
	add_editor_style( 'assets/css/signature.css' );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'atelier-lune-style',
		get_stylesheet_uri(),
		array(),
		ATELIER_LUNE_VERSION
	);

	wp_enqueue_style(
		'atelier-lune-signature',
		get_theme_file_uri( 'assets/css/signature.css' ),
		array( 'atelier-lune-style' ),
		ATELIER_LUNE_VERSION
	);
} );

add_action( 'init', function () {
	register_block_pattern_category(
		'atelier-lune',
		array( 'label' => __( 'Atelier Lune', 'atelier-lune' ) )
	);
} );
