<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_facilities = new WP_Query(
	array(
		'post_type'      => 'facility',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="section facilities" id="facilities">
	<div class="container">
		<p class="eyebrow center reveal"><?php mgs_opt_e( 'facilities', 'eyebrow' ); ?></p>
		<h2 class="section-title center reveal"><?php mgs_opt_e( 'facilities', 'heading_plain' ); ?> <span class="grad-1"><?php mgs_opt_e( 'facilities', 'heading_accent' ); ?></span></h2>
		<div class="facilities-grid">
			<?php
			while ( $mgs_facilities->have_posts() ) :
				$mgs_facilities->the_post();
				?>
				<div class="facility reveal">
					<div class="facility-icon"><?php echo esc_html( get_post_meta( get_the_ID(), 'facility_icon', true ) ); ?></div>
					<h3><?php the_title(); ?></h3>
					<?php the_content(); // wpautop wraps this in its own <p>, matching ".facility > p". ?>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
