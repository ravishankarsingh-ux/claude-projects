<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section stats" id="stats">
	<div class="container">
		<div class="stats-grid">
			<?php for ( $mgs_i = 1; $mgs_i <= 4; $mgs_i++ ) : ?>
				<div class="stat-card reveal" data-tilt>
					<div class="stat-num"><span class="counter" data-target="<?php echo esc_attr( mgs_opt( 'stats', "stat{$mgs_i}_value" ) ); ?>">0</span><?php mgs_opt_e( 'stats', "stat{$mgs_i}_suffix" ); ?></div>
					<p><?php mgs_opt_e( 'stats', "stat{$mgs_i}_label" ); ?></p>
					<div class="stat-icon"><?php mgs_opt_e( 'stats', "stat{$mgs_i}_icon" ); ?></div>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>
