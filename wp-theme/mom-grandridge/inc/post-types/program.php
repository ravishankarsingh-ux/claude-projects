<?php
/**
 * "Program" (Classes) custom post type — Daycare, Pre-Primary, Primary, etc.
 *
 * Title = program name, Editor = description, page-attributes = manual
 * order. Icon + age range are the only fields that need custom meta.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_register_program_cpt() {
	register_post_type(
		'program',
		array(
			'labels'       => array(
				'name'               => __( 'Classes', 'mom-grandridge' ),
				'singular_name'      => __( 'Class', 'mom-grandridge' ),
				'add_new_item'       => __( 'Add New Class', 'mom-grandridge' ),
				'edit_item'          => __( 'Edit Class', 'mom-grandridge' ),
				'all_items'          => __( 'Classes', 'mom-grandridge' ),
				'menu_name'          => __( 'Classes', 'mom-grandridge' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-welcome-learn-more',
			'supports'     => array( 'title', 'editor', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
			'show_in_rest' => false,
		)
	);
}
add_action( 'init', 'mgs_register_program_cpt' );

function mgs_program_meta_fields() {
	return array(
		'program_icon' => array(
			'label' => __( 'Icon (emoji)', 'mom-grandridge' ),
			'desc'  => __( 'e.g. 🍼 🧸 📖 🔬', 'mom-grandridge' ),
		),
		'program_age'  => array(
			'label' => __( 'Age / Grade range', 'mom-grandridge' ),
			'desc'  => __( 'e.g. "Grades 1 – 5"', 'mom-grandridge' ),
		),
	);
}

function mgs_add_program_meta_box() {
	add_meta_box(
		'mgs_program_details',
		__( 'Program Details', 'mom-grandridge' ),
		'mgs_render_program_meta_box',
		'program',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'mgs_add_program_meta_box' );

function mgs_render_program_meta_box( $post ) {
	mgs_render_meta_box_fields( mgs_program_meta_fields(), $post );
}

function mgs_save_program_meta( $post_id ) {
	mgs_save_meta_box_fields( $post_id, mgs_program_meta_fields() );
}
add_action( 'save_post_program', 'mgs_save_program_meta' );

function mgs_register_program_meta() {
	register_post_meta(
		'program',
		'program_icon',
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
	register_post_meta(
		'program',
		'program_age',
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
add_action( 'init', 'mgs_register_program_meta' );
