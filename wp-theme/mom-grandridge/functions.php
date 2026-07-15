<?php
/**
 * Mom Grandridge School theme bootstrap.
 *
 * Every WordPress function this theme relies on is a WordPress core
 * function — there is no plugin dependency (no ACF, no page builder).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MGS_THEME_VERSION', '1.0.0' );
define( 'MGS_THEME_DIR', get_template_directory() );
define( 'MGS_THEME_URI', get_template_directory_uri() );

require_once MGS_THEME_DIR . '/inc/setup.php';
require_once MGS_THEME_DIR . '/inc/enqueue.php';
require_once MGS_THEME_DIR . '/inc/template-tags.php';
require_once MGS_THEME_DIR . '/inc/media-uploader.php';
require_once MGS_THEME_DIR . '/inc/theme-options.php';
require_once MGS_THEME_DIR . '/inc/contact-form.php';
require_once MGS_THEME_DIR . '/inc/meta-box-helper.php';
require_once MGS_THEME_DIR . '/inc/post-types/program.php';
require_once MGS_THEME_DIR . '/inc/post-types/facility.php';
require_once MGS_THEME_DIR . '/inc/post-types/testimonial.php';
require_once MGS_THEME_DIR . '/inc/post-types/gallery-photo.php';
