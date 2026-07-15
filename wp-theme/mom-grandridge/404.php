<?php
/**
 * Minimal 404 template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
	<section class="section" style="padding-top: calc(var(--nav-h) + 60px); text-align: center;">
		<div class="container">
			<h1 class="section-title"><?php esc_html_e( 'Page Not Found', 'mom-grandridge' ); ?></h1>
			<p class="section-sub center"><?php esc_html_e( "Sorry, we couldn't find that page.", 'mom-grandridge' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><span><?php esc_html_e( 'Back to Home', 'mom-grandridge' ); ?></span> <i>→</i></a>
		</div>
	</section>
<?php
get_footer();
