<?php
/**
 * The universal fallback template WordPress requires every theme to
 * have. front-page.php serves the site's front page in normal use, so
 * this only renders if something unusual causes WordPress to fall back
 * to it — in which case it still shows the real one-page site rather
 * than a blank or broken page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
get_template_part( 'template-parts/home-sections' );
get_footer();
