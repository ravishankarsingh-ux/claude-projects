<?php
/**
 * Header: <head>, preloader, 3D canvas, and the nav bar.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Mom Grandridge School, Serlingampally, Hyderabad — a safe, nurturing campus offering quality education from Daycare to Grade 7.', 'mom-grandridge' ) ); ?>" />
	<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎓</text></svg>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<!-- ══════════════ PRELOADER ══════════════ -->
	<div class="preloader" id="preloader">
		<div class="preloader-inner">
			<div class="preloader-logo">🎓</div>
			<div class="preloader-text"><?php echo esc_html( strtoupper( get_bloginfo( 'name' ) ) ); ?></div>
			<div class="preloader-bar"><span id="preloaderBar"></span></div>
			<div class="preloader-pct" id="preloaderPct">0%</div>
		</div>
	</div>

	<div class="scroll-progress" id="scrollProgress"></div>
	<div class="cursor-glow" id="cursorGlow"></div>

	<!-- ══════════════ THREE.JS 3D BACKGROUND ══════════════ -->
	<canvas id="bg3d"></canvas>

	<!-- ══════════════ NAVBAR ══════════════ -->
	<header class="nav" id="nav">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
			<?php mgs_render_logo(); ?>
			<span class="nav-logo-text"><?php bloginfo( 'name' ); ?></span>
		</a>
		<?php mgs_nav_menu(); ?>
		<button class="nav-burger" id="navBurger" aria-label="<?php esc_attr_e( 'Toggle menu', 'mom-grandridge' ); ?>">
			<span></span><span></span><span></span>
		</button>
	</header>

	<main>
