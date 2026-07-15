<?php
/**
 * "Testimonial" custom post type — the parent-reviews slider.
 *
 * Title = parent name, Editor = the quote, Featured image = optional real
 * avatar photo, page-attributes = slide order. Role/stars/emoji-fallback
 * are the fields that need custom meta.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_register_testimonial_cpt() {
	register_post_type(
		'testimonial',
		array(
			'labels'       => array(
				'name'          => __( 'Testimonials', 'mom-grandridge' ),
				'singular_name' => __( 'Testimonial', 'mom-grandridge' ),
				'add_new_item'  => __( 'Add New Testimonial', 'mom-grandridge' ),
				'edit_item'     => __( 'Edit Testimonial', 'mom-grandridge' ),
				'all_items'     => __( 'Testimonials', 'mom-grandridge' ),
				'menu_name'     => __( 'Testimonials', 'mom-grandridge' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-format-quote',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
			'show_in_rest' => false,
		)
	);
}
add_action( 'init', 'mgs_register_testimonial_cpt' );

function mgs_testimonial_meta_fields() {
	return array(
		'testimonial_role'   => array(
			'label' => __( 'Role / class', 'mom-grandridge' ),
			'desc'  => __( 'e.g. "Grade 3 Parent"', 'mom-grandridge' ),
		),
		'testimonial_stars'  => array(
			'label'     => __( 'Star rating', 'mom-grandridge' ),
			'type'      => 'number',
			'min'       => 1,
			'max'       => 5,
			'sanitize'  => 'absint',
		),
		'testimonial_avatar' => array(
			'label' => __( 'Avatar emoji (fallback)', 'mom-grandridge' ),
			'desc'  => __( 'Used only if no featured image is set. e.g. 👩 👨', 'mom-grandridge' ),
		),
	);
}

function mgs_add_testimonial_meta_box() {
	add_meta_box(
		'mgs_testimonial_details',
		__( 'Testimonial Details', 'mom-grandridge' ),
		'mgs_render_testimonial_meta_box',
		'testimonial',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'mgs_add_testimonial_meta_box' );

function mgs_render_testimonial_meta_box( $post ) {
	mgs_render_meta_box_fields( mgs_testimonial_meta_fields(), $post );
}

function mgs_save_testimonial_meta( $post_id ) {
	mgs_save_meta_box_fields( $post_id, mgs_testimonial_meta_fields() );
}
add_action( 'save_post_testimonial', 'mgs_save_testimonial_meta' );

function mgs_register_testimonial_meta() {
	$string_fields = array( 'testimonial_role', 'testimonial_avatar' );
	foreach ( $string_fields as $key ) {
		register_post_meta(
			'testimonial',
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => false,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function() {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
	register_post_meta(
		'testimonial',
		'testimonial_stars',
		array(
			'type'              => 'integer',
			'single'            => true,
			'show_in_rest'      => false,
			'sanitize_callback' => 'absint',
			'auth_callback'     => function() {
				return current_user_can( 'edit_posts' );
			},
		)
	);
}
add_action( 'init', 'mgs_register_testimonial_meta' );
