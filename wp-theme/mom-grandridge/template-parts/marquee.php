<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_marquee_items = mgs_opt_lines( 'marquee', 'items' );
?>
<div class="marquee" aria-hidden="true">
	<div class="marquee-track">
		<?php
		// Rendered twice back-to-back so the CSS scroll animation loops seamlessly.
		for ( $mgs_pass = 0; $mgs_pass < 2; $mgs_pass++ ) :
			foreach ( $mgs_marquee_items as $mgs_item ) :
				?>
				<span><?php echo esc_html( $mgs_item ); ?></span><span>✦</span>
				<?php
			endforeach;
		endfor;
		?>
	</div>
</div>
