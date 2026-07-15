<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_gallery = new WP_Query(
	array(
		'post_type'      => 'gallery_photo',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="life" id="life">
	<div class="life-pin">
		<div class="life-head">
			<p class="eyebrow center">— <?php esc_html_e( 'Life at', 'mom-grandridge' ); ?> <?php bloginfo( 'name' ); ?></p>
			<h2 class="section-title center"><?php esc_html_e( 'Every Day is an', 'mom-grandridge' ); ?> <span class="grad-2"><?php esc_html_e( 'Adventure', 'mom-grandridge' ); ?></span></h2>
		</div>
		<div class="life-track" id="lifeTrack">
			<?php
			while ( $mgs_gallery->have_posts() ) :
				$mgs_gallery->the_post();
				$mgs_thumb_id = get_post_thumbnail_id();
				if ( ! $mgs_thumb_id ) {
					continue; // A gallery card with no photo has nothing to show.
				}
				$mgs_alt = get_post_meta( $mgs_thumb_id, '_wp_attachment_image_alt', true );
				if ( ! $mgs_alt ) {
					$mgs_alt = get_the_title();
				}
				$mgs_img = wp_get_attachment_image(
					$mgs_thumb_id,
					'mgs-gallery',
					false,
					array(
						'class'   => 'life-photo',
						'alt'     => $mgs_alt,
						'loading' => 'lazy',
						'onerror' => "this.closest('.life-card').style.display='none'",
					)
				);

				if ( has_excerpt() ) :
					// "Feature card" shape — matches the site's original editorial photos.
					?>
					<div class="life-card life-card-photo">
						<?php echo $mgs_img; // phpcs:ignore -- built by wp_get_attachment_image, already escaped. ?>
						<h3><?php the_title(); ?></h3>
						<p><?php echo esc_html( get_the_excerpt() ); ?></p>
					</div>
					<?php
				else :
					// Plain caption-overlay shape — matches the uploaded gallery photos.
					?>
					<div class="life-card life-card-photo life-card-gallery">
						<?php echo $mgs_img; // phpcs:ignore -- built by wp_get_attachment_image, already escaped. ?>
						<span class="life-caption"><?php the_title(); ?></span>
					</div>
					<?php
				endif;
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
