<?php
/**
 * The one-page home layout — assembles every section in order.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/home-sections' );
get_footer();
