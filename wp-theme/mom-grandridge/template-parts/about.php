<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_banner_id = (int) mgs_opt( 'about', 'banner_image', 0 );
?>
<section class="section about" id="about">
	<div class="container split">
		<div class="about-visual" data-tilt>
			<div class="about-card-main">
				<?php if ( $mgs_banner_id ) : ?>
					<?php
					echo wp_get_attachment_image(
						$mgs_banner_id,
						'mgs-poster',
						false,
						array( 'class' => 'about-photo', 'loading' => 'lazy' )
					);
					?>
				<?php else : ?>
					<div class="about-emoji">🏫</div>
				<?php endif; ?>
				<div class="about-card-shine"></div>
			</div>
			<div class="about-card-float about-card-a" data-speed="0.4"><?php mgs_opt_e( 'about', 'chip_a' ); ?></div>
			<div class="about-card-float about-card-b" data-speed="-0.3"><?php mgs_opt_e( 'about', 'chip_b' ); ?></div>
			<div class="about-card-float about-card-c" data-speed="0.6"><?php mgs_opt_e( 'about', 'chip_c' ); ?></div>
			<div class="orbit-ring"></div>
		</div>
		<div class="about-copy">
			<p class="eyebrow reveal"><?php mgs_opt_e( 'about', 'eyebrow' ); ?></p>
			<h2 class="section-title reveal"><?php mgs_opt_e( 'about', 'heading_plain' ); ?> <span class="grad-1"><?php mgs_opt_e( 'about', 'heading_accent' ); ?></span></h2>
			<p class="reveal"><?php mgs_opt_e( 'about', 'body' ); ?></p>
			<ul class="about-points">
				<li class="reveal"><i><?php mgs_opt_e( 'about', 'point1_icon' ); ?></i><div><strong><?php mgs_opt_e( 'about', 'point1_title' ); ?></strong><span><?php mgs_opt_e( 'about', 'point1_desc' ); ?></span></div></li>
				<li class="reveal"><i><?php mgs_opt_e( 'about', 'point2_icon' ); ?></i><div><strong><?php mgs_opt_e( 'about', 'point2_title' ); ?></strong><span><?php mgs_opt_e( 'about', 'point2_desc' ); ?></span></div></li>
				<li class="reveal"><i><?php mgs_opt_e( 'about', 'point3_icon' ); ?></i><div><strong><?php mgs_opt_e( 'about', 'point3_title' ); ?></strong><span><?php mgs_opt_e( 'about', 'point3_desc' ); ?></span></div></li>
			</ul>
			<blockquote class="principal-note reveal">
				<p>"<?php mgs_opt_e( 'about', 'quote_text' ); ?>"</p>
				<footer><strong><?php mgs_opt_e( 'about', 'quote_name' ); ?></strong> — <?php mgs_opt_e( 'about', 'quote_title' ); ?></footer>
			</blockquote>
			<a href="<?php echo esc_url( mgs_opt( 'about', 'cta_link' ) ); ?>" class="btn btn-primary reveal"><span><?php mgs_opt_e( 'about', 'cta_label' ); ?></span> <i>→</i></a>
		</div>
	</div>
</section>
