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
				'theme_location'   => 'primary',
				'container'        => 'div',
				'container_id'     => 'navLinks',
				'container_class'  => 'nav-links',
				'menu_class'       => '',
				'items_wrap'       => '%3$s',
				'link_before'      => '',
				'walker'           => new MGS_Nav_Walker(),
			)
		);
	} else {
		mgs_fallback_menu();
	}
}

/**
 * Minimal walker so menu items render as flat <a> links, matching the
 * existing markup/CSS exactly (no <ul><li> wrapper). Whichever menu item
 * has the CSS class "nav-cta" (set via Appearance > Menus > Screen
 * Options > CSS Classes) renders as the pill-button style instead of a
 * plain nav link — by default that's the "Admission" item, but the
 * client can move that styling to any item just by adding/removing the
 * class in the menu editor.
 */
class MGS_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( in_array( 'nav-cta', $item->classes, true ) ) {
			$output .= sprintf(
				'<a href="%1$s" class="nav-cta">%2$s</a>',
				esc_url( $item->url ),
				esc_html( $item->title )
			);
			return;
		}

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

/**
 * Auto-create and assign a starter Primary Navigation menu on theme
 * activation, pre-populated with the site's anchor links, so the client
 * lands on a real, immediately-editable menu in Appearance > Menus
 * instead of an empty location they'd have to build from scratch.
 * Never overwrites a menu that's already assigned.
 */
function mgs_create_default_menu() {
	$locations = get_theme_mod( 'nav_menu_locations' );
	if ( ! empty( $locations['primary'] ) ) {
		return;
	}

	$menu_name = __( 'Primary Menu', 'mom-grandridge' );
	$existing  = get_term_by( 'name', $menu_name, 'nav_menu' );
	$menu_id   = $existing ? $existing->term_id : wp_create_nav_menu( $menu_name );

	if ( is_wp_error( $menu_id ) || ! $menu_id ) {
		return;
	}

	$items = array(
		array( 'title' => __( 'Home', 'mom-grandridge' ), 'url' => home_url( '/#home' ) ),
		array( 'title' => __( 'About', 'mom-grandridge' ), 'url' => home_url( '/#about' ) ),
		array( 'title' => __( 'Classes', 'mom-grandridge' ), 'url' => home_url( '/#programs' ) ),
		array( 'title' => __( 'Facilities', 'mom-grandridge' ), 'url' => home_url( '/#facilities' ) ),
		array( 'title' => __( 'Gallery', 'mom-grandridge' ), 'url' => home_url( '/#life' ) ),
		array( 'title' => __( 'Parents', 'mom-grandridge' ), 'url' => home_url( '/#testimonials' ) ),
		array( 'title' => __( 'Contact', 'mom-grandridge' ), 'url' => home_url( '/#contact' ) ),
		array( 'title' => __( 'Admission', 'mom-grandridge' ), 'url' => home_url( '/#admissions' ), 'classes' => 'nav-cta' ),
	);

	foreach ( $items as $i => $item ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'      => $item['title'],
				'menu-item-url'        => $item['url'],
				'menu-item-classes'    => isset( $item['classes'] ) ? $item['classes'] : '',
				'menu-item-status'     => 'publish',
				'menu-item-position'   => $i + 1,
			)
		);
	}

	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}
add_action( 'after_switch_theme', 'mgs_create_default_menu' );
