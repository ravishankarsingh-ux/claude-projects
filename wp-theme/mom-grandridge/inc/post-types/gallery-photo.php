<?php
/**
 * "Gallery Photo" custom post type — the horizontal-scroll Gallery section.
 *
 * No custom meta needed at all:
 *   - Title          = the caption shown on the card
 *   - Featured image  = the photo itself (required) — alt text comes from
 *                       the attachment's own native Alt Text field
 *   - Excerpt (optional) = when filled in, the card renders as the larger
 *                       "feature" shape (title + description) matching the
 *                       site's original two editorial photos; when left
 *                       empty, it renders as the plain caption-overlay
 *                       shape used by the rest of the gallery.
 *   - page-attributes = manual ordering in the horizontal scroll track
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_register_gallery_photo_cpt() {
	register_post_type(
		'gallery_photo',
		array(
			'labels'       => array(
				'name'          => __( 'Gallery Photos', 'mom-grandridge' ),
				'singular_name' => __( 'Gallery Photo', 'mom-grandridge' ),
				'add_new_item'  => __( 'Add New Gallery Photo', 'mom-grandridge' ),
				'edit_item'     => __( 'Edit Gallery Photo', 'mom-grandridge' ),
				'all_items'     => __( 'Gallery', 'mom-grandridge' ),
				'menu_name'     => __( 'Gallery', 'mom-grandridge' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-format-gallery',
			'supports'     => array( 'title', 'excerpt', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
			'show_in_rest' => false,
		)
	);
}
add_action( 'init', 'mgs_register_gallery_photo_cpt' );

/**
 * Nudge the client toward setting a featured image — the caption alone
 * without a photo would render an empty card on the front end.
 */
function mgs_gallery_photo_admin_notice() {
	$screen = get_current_screen();
	if ( ! $screen || 'gallery_photo' !== $screen->post_type || 'post' !== $screen->base ) {
		return;
	}
	echo '<div class="notice notice-info inline"><p>' .
		esc_html__( 'Set a Featured Image below — that\'s the actual photo shown in the Gallery section. The Excerpt is optional; fill it in for a larger caption card, or leave it blank for a simple photo card.', 'mom-grandridge' ) .
		'</p></div>';
}
add_action( 'edit_form_after_title', 'mgs_gallery_photo_admin_notice' );
