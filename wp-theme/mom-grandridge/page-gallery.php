<?php
/**
 * Template Name: Full Gallery
 *
 * A standalone page listing every Gallery Photo, each opening in the
 * same popup lightbox used on the home page. To use it: create a
 * WordPress Page (e.g. titled "Gallery"), assign this template under
 * Page Attributes, and publish it — the home page's teaser section
 * will automatically link to it once it's found.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$mgs_gallery_all = new WP_Query(
	array(
		'post_type'      => 'gallery_photo',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="section gallery-page" style="padding-top: calc(var(--nav-h) + 60px);">
	<div class="container">
		<div class="gallery-page-hero">
			<p class="eyebrow center reveal"><?php mgs_opt_e( 'gallery', 'eyebrow' ); ?></p>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<h1 class="section-title center reveal"><?php the_title(); ?></h1>
				<?php if ( trim( get_the_content() ) ) : ?>
					<div class="section-sub center reveal"><?php the_content(); ?></div>
				<?php endif; ?>
				<?php
			endwhile;
			?>
		</div>

		<div class="gallery-grid">
			<?php
			while ( $mgs_gallery_all->have_posts() ) :
				$mgs_gallery_all->the_post();
				$mgs_thumb_id = get_post_thumbnail_id();
				if ( ! $mgs_thumb_id ) {
					continue; // A gallery card with no photo has nothing to show.
				}
				$mgs_alt = get_post_meta( $mgs_thumb_id, '_wp_attachment_image_alt', true );
				if ( ! $mgs_alt ) {
					$mgs_alt = get_the_title();
				}
				?>
				<div class="gallery-grid-item reveal">
					<?php
					echo wp_get_attachment_image(
						$mgs_thumb_id,
						'mgs-gallery',
						false,
						array(
							'class'   => 'life-photo',
							'alt'     => $mgs_alt,
							'loading' => 'lazy',
						)
					);
					?>
					<span class="life-caption"><?php the_title(); ?></span>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<?php
get_footer();
