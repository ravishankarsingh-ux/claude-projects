<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$mgs_programs = new WP_Query(
	array(
		'post_type'      => 'program',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	)
);
?>
<section class="section programs" id="programs">
	<div class="container">
		<p class="eyebrow center reveal"><?php mgs_opt_e( 'programs', 'eyebrow' ); ?></p>
		<h2 class="section-title center reveal"><?php mgs_opt_e( 'programs', 'heading_plain' ); ?> <span class="grad-2"><?php mgs_opt_e( 'programs', 'heading_accent' ); ?></span></h2>
		<p class="section-sub center reveal"><?php mgs_opt_e( 'programs', 'subtitle' ); ?></p>
		<div class="programs-grid">
			<?php
			$mgs_pi = 0;
			while ( $mgs_programs->have_posts() ) :
				$mgs_programs->the_post();
				$mgs_pi++;
				$mgs_accent = 'pi-' . ( ( ( $mgs_pi - 1 ) % 4 ) + 1 );
				?>
				<article class="program-card reveal" data-tilt>
					<div class="program-icon <?php echo esc_attr( $mgs_accent ); ?>"><?php echo esc_html( get_post_meta( get_the_ID(), 'program_icon', true ) ); ?></div>
					<h3><?php the_title(); ?></h3>
					<p class="program-age"><?php echo esc_html( get_post_meta( get_the_ID(), 'program_age', true ) ); ?></p>
					<?php the_content(); // wpautop already wraps this in its own <p>, matching the design's ".program-card > p" selector. ?>
					<a href="#admissions" class="program-link"><?php esc_html_e( 'Enroll now →', 'mom-grandridge' ); ?></a>
				</article>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<div class="activity-note reveal">
			<span><?php mgs_opt_e( 'programs', 'activity_icon' ); ?></span>
			<p><?php echo wp_kses_post( mgs_opt( 'programs', 'activity_text' ) ); ?></p>
			<a href="<?php echo esc_url( mgs_opt( 'programs', 'activity_link_target' ) ); ?>" class="program-link"><?php mgs_opt_e( 'programs', 'activity_link_label' ); ?></a>
		</div>
		<?php mgs_option_image( 'programs', 'poster_image', array( 'alt' => __( 'Our Classes', 'mom-grandridge' ) ) ); ?>
	</div>
</section>
