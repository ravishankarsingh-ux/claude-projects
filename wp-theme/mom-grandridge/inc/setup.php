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

		$classes  = array( 'nav-link' );
		$is_anchor = false !== strpos( $item->url, '#' );

		if ( $is_anchor ) {
			// Same-page anchor links (#about, #programs, ...): the
			// IntersectionObserver in main.js owns "active" state as the
			// visitor scrolls between sections. WordPress's own
			// current-menu-item detection ignores URL fragments, so every
			// anchor link resolves to the same page and would incorrectly
			// get marked "current" at once — only default Home to active,
			// matching the state at page load before any scrolling.
			if ( '#home' === ltrim( $item->url, '/' ) ) {
				$classes[] = 'active';
			}
		} elseif ( in_array( 'current-menu-item', $item->classes, true ) ) {
			// A real, distinct URL (e.g. a linked Page) — WordPress's
			// current-item detection is accurate here, so trust it.
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

	// Bare same-page anchors, not home_url()-prefixed absolute URLs — the
	// scroll-highlighting JS in main.js extracts the section id straight
	// from the href (href.slice(1)), so a full URL here would break it.
	$items = array(
		array( 'title' => __( 'Home', 'mom-grandridge' ), 'url' => '#home' ),
		array( 'title' => __( 'About', 'mom-grandridge' ), 'url' => '#about' ),
		array( 'title' => __( 'Classes', 'mom-grandridge' ), 'url' => '#programs' ),
		array( 'title' => __( 'Facilities', 'mom-grandridge' ), 'url' => '#facilities' ),
		array( 'title' => __( 'Gallery', 'mom-grandridge' ), 'url' => '#life' ),
		array( 'title' => __( 'Parents', 'mom-grandridge' ), 'url' => '#testimonials' ),
		array( 'title' => __( 'Contact', 'mom-grandridge' ), 'url' => '#contact' ),
		array( 'title' => __( 'Admission', 'mom-grandridge' ), 'url' => '#admissions', 'classes' => 'nav-cta' ),
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

/**
 * One-time repair for menus already created by an earlier version of
 * this theme, which used full home_url()-prefixed anchor URLs (e.g.
 * "https://site.test/#about") instead of bare fragments ("#about") —
 * that breaks the scroll-highlighting JS and also makes every anchor
 * link look "current" to WordPress at once. Runs once (flagged via an
 * option) and needs no action from the site owner.
 */
function mgs_fix_legacy_menu_anchor_urls() {
	if ( get_option( 'mgs_menu_anchor_fix_done' ) ) {
		return;
	}

	$locations = get_theme_mod( 'nav_menu_locations' );
	if ( empty( $locations['primary'] ) ) {
		update_option( 'mgs_menu_anchor_fix_done', 1 );
		return;
	}

	$menu_id = $locations['primary'];
	$items   = wp_get_nav_menu_items( $menu_id );
	$home    = untrailingslashit( home_url() );

	if ( $items ) {
		foreach ( $items as $menu_item ) {
			if ( 0 === strpos( $menu_item->url, $home . '/#' ) ) {
				wp_update_nav_menu_item(
					$menu_id,
					$menu_item->ID,
					array(
						'menu-item-title'   => $menu_item->title,
						'menu-item-url'     => substr( $menu_item->url, strlen( $home ) + 1 ),
						'menu-item-status'  => 'publish',
						'menu-item-classes' => implode( ' ', (array) $menu_item->classes ),
					)
				);
			}
		}
	}

	update_option( 'mgs_menu_anchor_fix_done', 1 );
}
add_action( 'admin_init', 'mgs_fix_legacy_menu_anchor_urls' );
