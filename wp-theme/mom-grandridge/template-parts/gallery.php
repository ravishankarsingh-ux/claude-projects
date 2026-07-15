<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_home_limit = (int) mgs_opt( 'gallery', 'home_limit', 10 );
if ( $mgs_home_limit < 1 ) {
	$mgs_home_limit = 10;
}

$mgs_total_count = (int) wp_count_posts( 'gallery_photo' )->publish;

$mgs_gallery = new WP_Query(
	array(
		'post_type'      => 'gallery_photo',
		'posts_per_page' => $mgs_home_limit,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="life" id="life">
	<div class="life-pin">
		<div class="life-head">
			<p class="eyebrow center"><?php mgs_opt_e( 'gallery', 'eyebrow' ); ?></p>
			<h2 class="section-title center"><?php mgs_opt_e( 'gallery', 'heading_plain' ); ?> <span class="grad-2"><?php mgs_opt_e( 'gallery', 'heading_accent' ); ?></span></h2>
			<?php if ( $mgs_total_count > $mgs_home_limit ) : ?>
				<a href="<?php echo esc_url( mgs_get_gallery_page_url() ); ?>" class="program-link life-view-all"><?php mgs_opt_e( 'gallery', 'view_all_label' ); ?></a>
			<?php endif; ?>
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
