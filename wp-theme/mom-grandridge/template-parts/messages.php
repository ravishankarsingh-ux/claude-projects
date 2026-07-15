<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section messages" id="messages">
	<div class="container">
		<div class="messages-grid">
			<div class="message-card reveal" data-tilt>
				<div class="facility-icon"><?php mgs_opt_e( 'messages', 'parents_icon' ); ?></div>
				<h3><?php mgs_opt_e( 'messages', 'parents_title' ); ?></h3>
				<p><?php mgs_opt_e( 'messages', 'parents_body' ); ?></p>
			</div>
			<div class="message-card reveal" data-tilt>
				<div class="facility-icon"><?php mgs_opt_e( 'messages', 'students_icon' ); ?></div>
				<h3><?php mgs_opt_e( 'messages', 'students_title' ); ?></h3>
				<p><?php mgs_opt_e( 'messages', 'students_body' ); ?></p>
			</div>
		</div>
	</div>
</section>
