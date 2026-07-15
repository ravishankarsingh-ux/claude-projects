<?php
/**
 * Reusable wp.media image-picker field for the Theme Options page.
 *
 * Uses only the media uploader bundled with WordPress core (wp.media) —
 * no external media-library plugin. Stores the attachment ID (not a raw
 * URL) so wp_get_attachment_image() / responsive srcset work normally.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render an image-picker field.
 *
 * @param string $group Options tab/group name (matches the option name suffix).
 * @param string $key   Field key within that group.
 * @param string $desc  Optional helper text shown under the field.
 */
function mgs_media_field( $group, $key, $desc = '' ) {
	$field_id      = "mgs-media-{$group}-{$key}";
	$attachment_id = (int) mgs_opt( $group, $key, 0 );
	$thumb_url     = $attachment_id ? wp_get_attachment_image_url( $attachment_id, 'medium' ) : '';

	printf(
		'<input type="hidden" class="mgs-media-value" id="%1$s" name="mgs_opt_%2$s[%3$s]" value="%4$s" />',
		esc_attr( $field_id ),
		esc_attr( $group ),
		esc_attr( $key ),
		esc_attr( $attachment_id )
	);
	printf(
		'<div class="mgs-media-preview" style="margin-bottom:8px;%1$s"><img src="%2$s" style="max-width:220px;height:auto;display:block;border-radius:6px;" /></div>',
		$thumb_url ? '' : 'display:none;',
		esc_url( $thumb_url )
	);
	printf(
		'<button type="button" class="button mgs-media-button" data-target="%1$s">%2$s</button> ',
		esc_attr( $field_id ),
		esc_html__( 'Choose Image', 'mom-grandridge' )
	);
	printf(
		'<button type="button" class="button mgs-media-remove" data-target="%1$s" style="%2$s">%3$s</button>',
		esc_attr( $field_id ),
		$thumb_url ? '' : 'display:none;',
		esc_html__( 'Remove', 'mom-grandridge' )
	);
	if ( $desc ) {
		printf( '<p class="description">%s</p>', esc_html( $desc ) );
	}
}
