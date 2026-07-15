<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_testimonials = new WP_Query(
	array(
		'post_type'      => 'testimonial',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="section testimonials" id="testimonials">
	<div class="container">
		<p class="eyebrow center reveal"><?php mgs_opt_e( 'testimonials', 'eyebrow' ); ?></p>
		<h2 class="section-title center reveal"><?php mgs_opt_e( 'testimonials', 'heading_plain' ); ?> <span class="grad-1"><?php mgs_opt_e( 'testimonials', 'heading_accent' ); ?></span></h2>
		<div class="testi-slider reveal" id="testiSlider">
			<?php
			$mgs_ti = 0;
			while ( $mgs_testimonials->have_posts() ) :
				$mgs_testimonials->the_post();
				$mgs_ti++;
				$mgs_stars     = (int) get_post_meta( get_the_ID(), 'testimonial_stars', true );
				$mgs_role      = get_post_meta( get_the_ID(), 'testimonial_role', true );
				$mgs_avatar_fb = get_post_meta( get_the_ID(), 'testimonial_avatar', true );
				?>
				<div class="testi-slide<?php echo 1 === $mgs_ti ? ' active' : ''; ?>">
					<div class="testi-stars"><?php echo esc_html( mgs_render_stars( $mgs_stars ? $mgs_stars : 5 ) ); ?></div>
					<?php the_content(); // wpautop wraps this as the quote paragraph. ?>
					<div class="testi-author">
						<span class="testi-avatar">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'thumbnail', array( 'alt' => get_the_title() ) ); ?>
							<?php else : ?>
								<?php echo esc_html( $mgs_avatar_fb ? $mgs_avatar_fb : '👤' ); ?>
							<?php endif; ?>
						</span>
						<div><strong><?php the_title(); ?></strong><span><?php echo esc_html( $mgs_role ); ?></span></div>
					</div>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
			<div class="testi-dots" id="testiDots"></div>
		</div>
	</div>
</section>
