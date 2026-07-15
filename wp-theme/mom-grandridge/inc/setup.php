<?php
/**
 * Core theme supports, nav menus, and image sizes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_setup() {
	load_theme_textdomain( 'mom-grandridge', MGS_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 120,
			'width'       => 160,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'mom-grandridge' ),
			'footer'  => __( 'Footer Navigation', 'mom-grandridge' ),
		)
	);

	add_image_size( 'mgs-gallery', 640, 480, true );
	add_image_size( 'mgs-poster', 1536, 1024, false );
}
add_action( 'after_setup_theme', 'mgs_setup' );

/**
 * Fallback nav menu matching the current static site's anchors, shown until
 * the client assigns a real menu under Appearance > Menus.
 */
function mgs_fallback_menu() {
	$links = array(
		'#home'         => __( 'Home', 'mom-grandridge' ),
		'#about'        => __( 'About', 'mom-grandridge' ),
		'#programs'     => __( 'Classes', 'mom-grandridge' ),
		'#facilities'   => __( 'Facilities', 'mom-grandridge' ),
		'#life'         => __( 'Gallery', 'mom-grandridge' ),
		'#testimonials' => __( 'Parents', 'mom-grandridge' ),
		'#contact'      => __( 'Contact', 'mom-grandridge' ),
	);

	echo '<div class="nav-links" id="navLinks">';
	$first = true;
	foreach ( $links as $href => $label ) {
		printf(
			'<a href="%1$s" class="nav-link%2$s">%3$s</a>',
			esc_url( $href ),
			$first ? ' active' : '',
			esc_html( $label )
		);
		$first = false;
	}
	printf(
		'<a href="%1$s" class="nav-cta">%2$s</a>',
		esc_url( '#admissions' ),
		esc_html__( 'Admission', 'mom-grandridge' )
	);
	echo '</div>';
}

function mgs_nav_menu() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => 'div',
				'container_id'   => 'navLinks',
				'container_class' => 'nav-links',
				'menu_class'     => '',
				'items_wrap'     => '%3$s',
				'link_before'    => '',
				'walker'         => new MGS_Nav_Walker(),
			)
		);
	} else {
		mgs_fallback_menu();
	}
}

/**
 * Minimal walker so menu items render as flat <a class="nav-link"> links,
 * matching the existing markup/CSS exactly (no <ul><li> wrapper).
 */
class MGS_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = array( 'nav-link' );
		if ( in_array( 'current-menu-item', $item->classes, true ) ) {
			$classes[] = 'active';
		}
		$output .= sprintf(
			'<a href="%1$s" class="%2$s">%3$s</a>',
			esc_url( $item->url ),
			esc_attr( implode( ' ', $classes ) ),
			esc_html( $item->title )
		);
	}
	public function end_el( &$output, $item, $depth = 0, $args = null ) {}
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
}
