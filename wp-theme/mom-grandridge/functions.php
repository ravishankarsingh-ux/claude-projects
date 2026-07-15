<?php
/**
 * Mom Grandridge School theme bootstrap.
 *
 * Content editing depends on Secure Custom Fields (or ACF — same PHP
 * API) for the Home page's fields and the "Flexible Sections" page
 * template; see inc/acf-fields.php and README.md. Everything else
 * (the 4 custom post types, the contact form, the gallery page) is
 * plain WordPress core with no plugin dependency.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MGS_THEME_VERSION', '1.1.0' );
define( 'MGS_THEME_DIR', get_template_directory() );
define( 'MGS_THEME_URI', get_template_directory_uri() );

require_once MGS_THEME_DIR . '/inc/setup.php';
require_once MGS_THEME_DIR . '/inc/enqueue.php';
require_once MGS_THEME_DIR . '/inc/acf-field-defs.php';
require_once MGS_THEME_DIR . '/inc/template-tags.php';
require_once MGS_THEME_DIR . '/inc/acf-fields.php';
require_once MGS_THEME_DIR . '/inc/contact-form.php';
require_once MGS_THEME_DIR . '/inc/meta-box-helper.php';
require_once MGS_THEME_DIR . '/inc/post-types/program.php';
require_once MGS_THEME_DIR . '/inc/post-types/facility.php';
require_once MGS_THEME_DIR . '/inc/post-types/testimonial.php';
require_once MGS_THEME_DIR . '/inc/post-types/gallery-photo.php';
