<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section admissions" id="admissions">
	<div class="container">
		<div class="cta-panel reveal" data-tilt>
			<div class="cta-shapes"><span></span><span></span><span></span><span></span></div>
			<h2><?php mgs_opt_e( 'admissions', 'heading_plain' ); ?> <span class="grad-3"><?php mgs_opt_e( 'admissions', 'heading_accent' ); ?></span></h2>
			<p><?php mgs_opt_e( 'admissions', 'body' ); ?></p>
			<div class="cta-actions">
				<a href="<?php echo esc_url( mgs_opt( 'admissions', 'cta_primary_link' ) ); ?>" class="btn btn-light"><span><?php mgs_opt_e( 'admissions', 'cta_primary_label' ); ?></span> <i>→</i></a>
				<a href="tel:<?php echo esc_attr( mgs_opt( 'admissions', 'phone_tel' ) ); ?>" class="btn btn-outline"><span><?php mgs_opt_e( 'admissions', 'phone_display' ); ?></span></a>
			</div>
			<?php mgs_option_image( 'admissions', 'poster_image', array( 'class' => 'cta-poster', 'alt' => __( 'Admission Open', 'mom-grandridge' ) ) ); ?>
		</div>
	</div>
</section>
