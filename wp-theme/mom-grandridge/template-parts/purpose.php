<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// CSS classes are fixed to each logo element's real-world position —
// only the text/emoji per card is editable, per the theme's plan.
$mgs_purpose_cards = array(
	array( 'key' => 'sun', 'class' => 'pu-sun' ),
	array( 'key' => 'pencil', 'class' => 'pu-pencil' ),
	array( 'key' => 'pillars', 'class' => 'pu-pillar' ),
	array( 'key' => 'book', 'class' => 'pu-book' ),
	array( 'key' => 'leaves', 'class' => 'pu-leaf' ),
);
?>
<section class="section purpose" id="purpose">
	<div class="container">
		<p class="eyebrow center reveal"><?php mgs_opt_e( 'purpose', 'eyebrow' ); ?></p>
		<h2 class="section-title center reveal"><?php mgs_opt_e( 'purpose', 'heading_plain' ); ?> <span class="grad-1"><?php mgs_opt_e( 'purpose', 'heading_accent' ); ?></span></h2>
		<p class="section-sub center reveal"><?php mgs_opt_e( 'purpose', 'subtitle' ); ?></p>
		<div class="purpose-grid">
			<?php foreach ( $mgs_purpose_cards as $mgs_card ) : ?>
				<div class="purpose-card reveal">
					<div class="purpose-icon <?php echo esc_attr( $mgs_card['class'] ); ?>"><?php mgs_opt_e( 'purpose', $mgs_card['key'] . '_icon' ); ?></div>
					<h3><?php mgs_opt_e( 'purpose', $mgs_card['key'] . '_title' ); ?></h3>
					<p class="purpose-tag"><?php mgs_opt_e( 'purpose', $mgs_card['key'] . '_tag' ); ?></p>
					<p><?php mgs_opt_e( 'purpose', $mgs_card['key'] . '_desc' ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<p class="purpose-promise reveal"><?php echo wp_kses_post( mgs_opt( 'purpose', 'promise_text' ) ); ?></p>
		<?php mgs_option_image( 'purpose', 'poster_image', array( 'alt' => __( 'Our Logo, Our Purpose', 'mom-grandridge' ) ) ); ?>
	</div>
</section>
