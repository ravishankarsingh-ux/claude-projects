<?php
/**
 * Shared render/save logic for the simple text-field meta boxes used by
 * all four custom post types (program, facility, testimonial, gallery_photo).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render a meta box body from a field definition array.
 *
 * @param array   $fields Map of meta_key => ['label'=>, 'type'=>, 'desc'=>, 'min'=>, 'max'=>].
 * @param WP_Post $post
 */
function mgs_render_meta_box_fields( $fields, $post ) {
	wp_nonce_field( 'mgs_save_meta_box', 'mgs_meta_box_nonce' );
	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		echo '<p>';
		printf( '<label for="%1$s"><strong>%2$s</strong></label><br />', esc_attr( $key ), esc_html( $field['label'] ) );

		if ( ! empty( $field['type'] ) && 'textarea' === $field['type'] ) {
			printf(
				'<textarea id="%1$s" name="%1$s" rows="3" style="width:100%%;">%2$s</textarea>',
				esc_attr( $key ),
				esc_textarea( $value )
			);
		} else {
			$type       = ! empty( $field['type'] ) ? $field['type'] : 'text';
			$minmax     = '';
			if ( 'number' === $type ) {
				$minmax = sprintf( ' min="%1$s" max="%2$s"', esc_attr( $field['min'] ?? 0 ), esc_attr( $field['max'] ?? 100 ) );
			}
			printf(
				'<input type="%1$s" id="%2$s" name="%2$s" value="%3$s" style="width:100%%;"%4$s />',
				esc_attr( $type ),
				esc_attr( $key ),
				esc_attr( $value ),
				$minmax // phpcs:ignore -- already escaped above
			);
		}

		if ( ! empty( $field['desc'] ) ) {
			printf( '<br /><span class="description">%s</span>', esc_html( $field['desc'] ) );
		}
		echo '</p>';
	}
}

/**
 * Save handler shared by all CPT meta boxes. Call from a save_post_{type}
 * hook, passing the same field definitions used to render the box.
 *
 * @param int   $post_id
 * @param array $fields
 */
function mgs_save_meta_box_fields( $post_id, $fields ) {
	if ( ! isset( $_POST['mgs_meta_box_nonce'] ) ||
		! wp_verify_nonce( wp_unslash( $_POST['mgs_meta_box_nonce'] ), 'mgs_save_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( $fields as $key => $field ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$sanitize = ! empty( $field['sanitize'] ) ? $field['sanitize'] : 'sanitize_text_field';
		$value    = call_user_func( $sanitize, wp_unslash( $_POST[ $key ] ) );
		update_post_meta( $post_id, $key, $value );
	}
}
