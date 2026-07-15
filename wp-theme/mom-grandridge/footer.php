<?php
/**
 * Footer: closes <main>, renders the footer, back-to-top button and the
 * lightbox markup, then wp_footer()/closing tags.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</main>

	<!-- ══════════════ FOOTER ══════════════ -->
	<footer class="footer">
		<div class="container footer-grid">
			<div class="footer-brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
					<?php mgs_render_logo(); ?>
					<span class="nav-logo-text"><?php bloginfo( 'name' ); ?></span>
				</a>
				<p><?php mgs_opt_e( 'footer', 'blurb' ); ?></p>
				<div class="footer-social">
					<a href="<?php echo esc_url( mgs_opt( 'footer', 'facebook_url', '#' ) ); ?>" aria-label="Facebook">ⓕ</a>
					<a href="<?php echo esc_url( mgs_opt( 'footer', 'instagram_url', '#' ) ); ?>" aria-label="Instagram">◉</a>
					<a href="<?php echo esc_url( mgs_opt( 'footer', 'youtube_url', '#' ) ); ?>" aria-label="YouTube">▶</a>
				</div>
			</div>
			<div class="footer-col">
				<h4><?php esc_html_e( 'Overview', 'mom-grandridge' ); ?></h4>
				<a href="#about"><?php esc_html_e( 'About Us', 'mom-grandridge' ); ?></a>
				<a href="#programs"><?php esc_html_e( 'Classes', 'mom-grandridge' ); ?></a>
				<a href="#facilities"><?php esc_html_e( 'Facilities', 'mom-grandridge' ); ?></a>
				<a href="#life"><?php esc_html_e( 'Gallery', 'mom-grandridge' ); ?></a>
			</div>
			<div class="footer-col">
				<h4><?php esc_html_e( 'Admission', 'mom-grandridge' ); ?></h4>
				<a href="#admissions"><?php esc_html_e( 'Enroll Now', 'mom-grandridge' ); ?></a>
				<a href="#contact"><?php esc_html_e( 'Enquiry', 'mom-grandridge' ); ?></a>
				<a href="#contact"><?php esc_html_e( 'Campus Visit', 'mom-grandridge' ); ?></a>
				<a href="#testimonials"><?php esc_html_e( 'Parent Reviews', 'mom-grandridge' ); ?></a>
			</div>
			<div class="footer-col">
				<h4><?php esc_html_e( 'Head Office', 'mom-grandridge' ); ?></h4>
				<a href="#contact">📍 <?php echo esc_html( str_replace( "\n", ', ', mgs_opt( 'contact', 'address' ) ) ); ?></a>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', mgs_opt( 'contact', 'phone' ) ) ); ?>">📞 <?php mgs_opt_e( 'contact', 'phone' ); ?></a>
				<a href="mailto:<?php echo esc_attr( mgs_opt( 'contact', 'email' ) ); ?>">✉️ <?php mgs_opt_e( 'contact', 'email' ); ?></a>
			</div>
		</div>
		<div class="footer-bottom">
			<p><?php mgs_opt_e( 'footer', 'copyright_text' ); ?></p>
		</div>
	</footer>

	<button class="back-top" id="backTop" aria-label="<?php esc_attr_e( 'Back to top', 'mom-grandridge' ); ?>">↑</button>

	<!-- ══════════════ LIGHTBOX ══════════════ -->
	<div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-label="<?php esc_attr_e( 'Image viewer', 'mom-grandridge' ); ?>">
		<button class="lightbox-close" id="lightboxClose" aria-label="<?php esc_attr_e( 'Close image viewer', 'mom-grandridge' ); ?>">✕</button>
		<button class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="<?php esc_attr_e( 'Previous image', 'mom-grandridge' ); ?>">‹</button>
		<img class="lightbox-img" id="lightboxImg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> photo" />
		<button class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="<?php esc_attr_e( 'Next image', 'mom-grandridge' ); ?>">›</button>
	</div>

	<?php wp_footer(); ?>
</body>
</html>
