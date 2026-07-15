<?php
/**
 * Template Name: Flexible Sections
 *
 * A modular page builder: assign this template to any Page, and its
 * "Sections" field (Appearance is handled by ACF/Secure Custom Fields'
 * Flexible Content field) lets the editor add/reorder/remove section
 * blocks — Hero, Gallery, Testimonials, etc., each reusing the exact
 * same template-parts/*.php files the Home page uses — plus a plain
 * "Rich Text" block for freeform copy.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	if ( function_exists( 'have_rows' ) && have_rows( 'page_sections' ) ) :
		while ( have_rows( 'page_sections' ) ) :
			the_row();
			$mgs_layout = get_row_layout();

			if ( 'rich_text' === $mgs_layout ) {
				?>
				<section class="section rich-text-block">
					<div class="container"><?php echo apply_filters( 'the_content', get_sub_field( 'content' ) ); ?></div>
				</section>
				<?php
			} else {
				get_template_part( 'template-parts/' . $mgs_layout );
			}
		endwhile;
	else :
		// No sections added yet — fall back to the page's own editor
		// content so the page isn't blank.
		?>
		<section class="section" style="padding-top: calc(var(--nav-h) + 60px);">
			<div class="container"><?php the_content(); ?></div>
		</section>
		<?php
	endif;

endwhile;

get_footer();
