<?php
/**
 * Minimal fallback template for any ad-hoc WordPress page the client
 * creates later (e.g. a Privacy Policy or Terms page).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
	<section class="section" style="padding-top: calc(var(--nav-h) + 60px);">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<h1 class="section-title"><?php the_title(); ?></h1>
				<div class="page-content"><?php the_content(); ?></div>
				<?php
			endwhile;
			?>
		</div>
	</section>
<?php
get_footer();
