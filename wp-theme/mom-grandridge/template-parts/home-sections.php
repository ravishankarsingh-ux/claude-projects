<?php
/**
 * The one-page layout's section order — shared by front-page.php and
 * index.php (WordPress requires index.php to exist regardless of
 * front-page.php, as the theme's universal fallback template).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/marquee' );
get_template_part( 'template-parts/about' );
get_template_part( 'template-parts/purpose' );
get_template_part( 'template-parts/messages' );
get_template_part( 'template-parts/stats' );
get_template_part( 'template-parts/programs' );
get_template_part( 'template-parts/facilities' );
get_template_part( 'template-parts/gallery' );
get_template_part( 'template-parts/testimonials' );
get_template_part( 'template-parts/admissions' );
get_template_part( 'template-parts/contact' );
