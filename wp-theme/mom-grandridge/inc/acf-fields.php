<?php
/**
 * Registers ACF/SCF field groups: one per section attached to the Home
 * page (fields prefixed "{section}_{field}" to avoid name collisions
 * between the ~12 groups that all attach to the same post), plus a
 * single Flexible Content field group ("Page Sections") available on
 * any page using the "Flexible Sections" template — its layouts reuse
 * the same field definitions unprefixed, since a row's own layout
 * already scopes its sub-fields.
 *
 * Entirely optional: every function here is a no-op if Secure Custom
 * Fields (or ACF) isn't installed/active — acf/init simply never fires.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Wrap one section's field defs into a Home-page field group.
 *
 * @param string $slug       Section slug, e.g. "hero".
 * @param string $label      Group title shown in wp-admin.
 * @param array  $defs       Unprefixed field defs from acf-field-defs.php.
 * @param int    $menu_order Controls the top-to-bottom order of groups
 *                           on the Home page's edit screen.
 */
function mgs_build_front_page_group( $slug, $label, $defs, $menu_order ) {
	$fields = array();
	foreach ( $defs as $def ) {
		$fields[] = array_merge(
			$def,
			array(
				'key'  => "field_mgs_{$slug}_{$def['name']}",
				'name' => "{$slug}_{$def['name']}",
			)
		);
	}

	return array(
		'key'                   => "group_mgs_{$slug}",
		'title'                 => $label,
		'fields'                => $fields,
		'location'              => array(
			array(
				array(
					'param'    => 'page_type',
					'operator' => '==',
					'value'    => 'front_page',
				),
			),
		),
		'menu_order'            => $menu_order,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
	);
}

/**
 * Wrap one section's field defs into a Flexible Content layout.
 *
 * @param string $slug  Section slug — MUST equal the matching
 *                       template-parts/{$slug}.php basename, since
 *                       page-flexible.php dispatches on this value.
 * @param string $label Layout label shown in the "Add Row" picker.
 * @param array  $defs  Unprefixed field defs from acf-field-defs.php.
 */
function mgs_build_flexible_layout( $slug, $label, $defs ) {
	$sub_fields = array();
	foreach ( $defs as $def ) {
		$sub_fields[] = array_merge(
			$def,
			array( 'key' => "field_mgs_layout_{$slug}_{$def['name']}" )
		);
	}

	return array(
		'key'        => "layout_mgs_{$slug}",
		'name'       => $slug,
		'label'      => $label,
		'display'    => 'block',
		'sub_fields' => $sub_fields,
	);
}

function mgs_register_acf_field_groups() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$order = 0;
	$layouts = array();

	foreach ( mgs_section_registry() as $slug => $section ) {
		if ( ! function_exists( $section['defs'] ) ) {
			continue;
		}
		$defs = call_user_func( $section['defs'] );

		acf_add_local_field_group( mgs_build_front_page_group( $slug, $section['label'], $defs, $order ) );
		$order += 10;

		if ( ! empty( $section['flexible'] ) ) {
			$layouts[] = mgs_build_flexible_layout( $slug, $section['label'], $defs );
		}
	}

	// A plain rich-text block, for freeform copy that doesn't fit one of
	// the named sections above.
	$layouts[] = array(
		'key'        => 'layout_mgs_rich_text',
		'name'       => 'rich_text',
		'label'      => 'Rich Text',
		'display'    => 'block',
		'sub_fields' => array(
			array(
				'key'   => 'field_mgs_layout_rich_text_content',
				'name'  => 'content',
				'label' => 'Content',
				'type'  => 'wysiwyg',
			),
		),
	);

	acf_add_local_field_group(
		array(
			'key'      => 'group_mgs_page_sections',
			'title'    => 'Page Sections',
			'fields'   => array(
				array(
					'key'     => 'field_mgs_page_sections',
					'name'    => 'page_sections',
					'label'   => 'Sections',
					'type'    => 'flexible_content',
					'layouts' => $layouts,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-flexible.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'mgs_register_acf_field_groups' );
