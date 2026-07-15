<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="hero" id="home">
	<div class="hero-content">
		<div class="hero-badge reveal-hero"><?php mgs_opt_e( 'hero', 'badge' ); ?></div>
		<h1 class="hero-title">
			<span class="line"><span><?php mgs_opt_e( 'hero', 'title_line1_plain' ); ?></span>&nbsp;<span class="grad-1"><?php mgs_opt_e( 'hero', 'title_line1_accent' ); ?></span></span>
			<span class="line"><span><?php mgs_opt_e( 'hero', 'title_line2_plain' ); ?></span>&nbsp;<span class="grad-2"><?php mgs_opt_e( 'hero', 'title_line2_accent' ); ?></span></span>
		</h1>
		<p class="hero-sub reveal-hero">
			<strong><?php mgs_opt_e( 'hero', 'subtitle_strong' ); ?></strong> — <?php mgs_opt_e( 'hero', 'subtitle_body' ); ?>
		</p>
		<?php
		$mgs_hero_primary_label   = mgs_opt( 'hero', 'cta_primary_label' );
		$mgs_hero_secondary_label = mgs_opt( 'hero', 'cta_secondary_label' );
		?>
		<?php if ( '' !== $mgs_hero_primary_label || '' !== $mgs_hero_secondary_label ) : ?>
		<div class="hero-actions reveal-hero">
			<?php if ( '' !== $mgs_hero_primary_label ) : ?>
			<a href="<?php echo esc_url( mgs_opt( 'hero', 'cta_primary_link' ) ); ?>" class="btn btn-primary"><span><?php echo esc_html( $mgs_hero_primary_label ); ?></span> <i>→</i></a>
			<?php endif; ?>
			<?php if ( '' !== $mgs_hero_secondary_label ) : ?>
			<a href="<?php echo esc_url( mgs_opt( 'hero', 'cta_secondary_link' ) ); ?>" class="btn btn-ghost"><span><?php echo esc_html( $mgs_hero_secondary_label ); ?></span></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<div class="hero-chips reveal-hero">
			<div class="chip float-1"><?php mgs_opt_e( 'hero', 'chip_1' ); ?></div>
			<div class="chip float-2"><?php mgs_opt_e( 'hero', 'chip_2' ); ?></div>
			<div class="chip float-3"><?php mgs_opt_e( 'hero', 'chip_3' ); ?></div>
			<div class="chip float-1"><?php mgs_opt_e( 'hero', 'chip_4' ); ?></div>
		</div>
	</div>
	<div class="hero-scroll">
		<div class="mouse"><span></span></div>
		<p><?php mgs_opt_e( 'hero', 'scroll_text' ); ?></p>
	</div>
	<div class="hero-glow hero-glow-1"></div>
	<div class="hero-glow hero-glow-2"></div>
</section>
