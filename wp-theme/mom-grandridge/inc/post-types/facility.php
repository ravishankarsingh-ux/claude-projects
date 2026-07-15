<?php
/**
 * "Facility" custom post type — the Facilities grid cards.
 *
 * Title = facility name, Editor = one-line description, page-attributes
 * = manual order. Icon is the only field that needs custom meta.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_register_facility_cpt() {
	register_post_type(
		'facility',
		array(
			'labels'       => array(
				'name'          => __( 'Facilities', 'mom-grandridge' ),
				'singular_name' => __( 'Facility', 'mom-grandridge' ),
				'add_new_item'  => __( 'Add New Facility', 'mom-grandridge' ),
				'edit_item'     => __( 'Edit Facility', 'mom-grandridge' ),
				'all_items'     => __( 'Facilities', 'mom-grandridge' ),
				'menu_name'     => __( 'Facilities', 'mom-grandridge' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-building',
			'supports'     => array( 'title', 'editor', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
			'show_in_rest' => false,
		)
	);
}
add_action( 'init', 'mgs_register_facility_cpt' );

function mgs_facility_meta_fields() {
	return array(
		'facility_icon' => array(
			'label' => __( 'Icon (emoji)', 'mom-grandridge' ),
			'desc'  => __( 'e.g. 🧑‍🏫 🎨 📽️', 'mom-grandridge' ),
		),
	);
}

function mgs_add_facility_meta_box() {
	add_meta_box(
		'mgs_facility_details',
		__( 'Facility Details', 'mom-grandridge' ),
		'mgs_render_facility_meta_box',
		'facility',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'mgs_add_facility_meta_box' );

function mgs_render_facility_meta_box( $post ) {
	mgs_render_meta_box_fields( mgs_facility_meta_fields(), $post );
}

function mgs_save_facility_meta( $post_id ) {
	mgs_save_meta_box_fields( $post_id, mgs_facility_meta_fields() );
}
add_action( 'save_post_facility', 'mgs_save_facility_meta' );

function mgs_register_facility_meta() {
	register_post_meta(
		'facility',
		'facility_icon',
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
add_action( 'init', 'mgs_register_facility_meta' );
