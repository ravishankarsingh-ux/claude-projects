<?php
/**
 * Theme Options admin page — a tabbed settings screen built on the core
 * Settings API (register_setting/settings_fields), with each tab stored
 * as its own option so saving one tab never risks another's data.
 *
 * The field list below is the single source of truth: it drives both
 * rendering and sanitization, so the two can never drift out of sync.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Full tab + field schema. Field types: text, textarea, html (textarea,
 * limited HTML allowed), number, email, url, image (attachment ID).
 */
function mgs_option_tabs() {
	return array(
		'hero'         => array(
			'label'  => __( 'Hero', 'mom-grandridge' ),
			'fields' => array(
				'badge'               => array( 'label' => 'Badge text', 'type' => 'text', 'default' => '✨ Admission Open — Academic Year 2026–27' ),
				'title_line1_plain'   => array( 'label' => 'Title line 1 (plain)', 'type' => 'text', 'default' => 'Nurturing' ),
				'title_line1_accent'  => array( 'label' => 'Title line 1 (accent)', 'type' => 'text', 'default' => 'Minds.' ),
				'title_line2_plain'   => array( 'label' => 'Title line 2 (plain)', 'type' => 'text', 'default' => 'Building' ),
				'title_line2_accent'  => array( 'label' => 'Title line 2 (accent)', 'type' => 'text', 'default' => 'Futures.' ),
				'subtitle_strong'     => array( 'label' => 'Subtitle — bold lead-in', 'type' => 'text', 'default' => 'Life. Line. Knowledge.' ),
				'subtitle_body'       => array( 'label' => 'Subtitle — body', 'type' => 'textarea', 'default' => 'Mom Grandridge School is a safe, joyful learning community in Serlingampally, Hyderabad, where every child is valued, nurtured and inspired to succeed — from Daycare to Grade 7.' ),
				'cta_primary_label'   => array( 'label' => 'Primary button label', 'type' => 'text', 'default' => 'Enroll Now' ),
				'cta_primary_link'    => array( 'label' => 'Primary button link', 'type' => 'text', 'default' => '#admissions' ),
				'cta_secondary_label' => array( 'label' => 'Secondary button label', 'type' => 'text', 'default' => 'Explore the School' ),
				'cta_secondary_link'  => array( 'label' => 'Secondary button link', 'type' => 'text', 'default' => '#about' ),
				'chip_1'              => array( 'label' => 'Chip 1', 'type' => 'text', 'default' => '👶 Daycare to Grade 7' ),
				'chip_2'              => array( 'label' => 'Chip 2', 'type' => 'text', 'default' => '🏊 Splash Pool' ),
				'chip_3'              => array( 'label' => 'Chip 3', 'type' => 'text', 'default' => '🎨 Art & Craft Workshops' ),
				'chip_4'              => array( 'label' => 'Chip 4', 'type' => 'text', 'default' => '🚌 Safe Transport' ),
				'scroll_text'         => array( 'label' => 'Scroll hint text', 'type' => 'text', 'default' => 'Learn · Grow · Succeed' ),
			),
		),
		'marquee'      => array(
			'label'  => __( 'Marquee', 'mom-grandridge' ),
			'fields' => array(
				'items' => array(
					'label'   => 'Marquee phrases (one per line)',
					'type'    => 'textarea',
					'default' => "🎓 Admission Open 2026–27\nLife · Line · Knowledge\nQuality Education\nCharacter Building\nHolistic Development\nValues & Discipline\nYour Future. Our Mission.",
				),
			),
		),
		'about'        => array(
			'label'  => __( 'About', 'mom-grandridge' ),
			'fields' => array(
				'eyebrow'        => array( 'label' => 'Eyebrow', 'type' => 'text', 'default' => '— Welcome to Mom Grandridge School' ),
				'heading_plain'  => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'Where Every Child is' ),
				'heading_accent' => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'Valued, Nurtured & Inspired' ),
				'body'           => array( 'label' => 'Body paragraph', 'type' => 'textarea', 'default' => 'Our vision is simple: to inspire excellence, foster creativity and cultivate young artists. We believe learning is a lifelong journey — so we encourage our students to think deeply through practical experiments and to learn from their mistakes. Through a rich mix of academics, sports and arts, every student builds the confidence to make a meaningful impact on the world.' ),
				'point1_icon'    => array( 'label' => 'Point 1 icon', 'type' => 'text', 'default' => '📖' ),
				'point1_title'   => array( 'label' => 'Point 1 title', 'type' => 'text', 'default' => 'Quality Education' ),
				'point1_desc'    => array( 'label' => 'Point 1 description', 'type' => 'text', 'default' => 'Strong academics with a good student–teacher ratio and personal attention for every learner.' ),
				'point2_icon'    => array( 'label' => 'Point 2 icon', 'type' => 'text', 'default' => '💡' ),
				'point2_title'   => array( 'label' => 'Point 2 title', 'type' => 'text', 'default' => 'Character Building' ),
				'point2_desc'    => array( 'label' => 'Point 2 description', 'type' => 'text', 'default' => 'Values and discipline woven into everyday school life.' ),
				'point3_icon'    => array( 'label' => 'Point 3 icon', 'type' => 'text', 'default' => '🌱' ),
				'point3_title'   => array( 'label' => 'Point 3 title', 'type' => 'text', 'default' => 'Holistic Development' ),
				'point3_desc'    => array( 'label' => 'Point 3 description', 'type' => 'text', 'default' => 'Sports, arts and life skills growing alongside studies.' ),
				'chip_a'         => array( 'label' => 'Floating chip A', 'type' => 'text', 'default' => '🏊 Splash Pool' ),
				'chip_b'         => array( 'label' => 'Floating chip B', 'type' => 'text', 'default' => '🎨 Art & Craft' ),
				'chip_c'         => array( 'label' => 'Floating chip C', 'type' => 'text', 'default' => '🚌 Safe Transport' ),
				'quote_text'     => array( 'label' => 'Principal quote', 'type' => 'textarea', 'default' => 'With passion, dedication and a heart full of care, we create a safe and nurturing environment where every child grows, learns and shines.' ),
				'quote_name'     => array( 'label' => 'Principal name', 'type' => 'text', 'default' => 'Shaik Ruksana' ),
				'quote_title'    => array( 'label' => 'Principal title', 'type' => 'text', 'default' => 'Principal · 15+ years of experience in child care' ),
				'banner_image'   => array( 'label' => 'Banner photo', 'type' => 'image' ),
				'cta_label'      => array( 'label' => 'Button label', 'type' => 'text', 'default' => 'See Our Classes' ),
				'cta_link'       => array( 'label' => 'Button link', 'type' => 'text', 'default' => '#programs' ),
			),
		),
		'purpose'      => array(
			'label'  => __( 'Logo Purpose', 'mom-grandridge' ),
			'fields' => array(
				'eyebrow'        => array( 'label' => 'Eyebrow', 'type' => 'text', 'default' => '— Our Logo. Our Purpose.' ),
				'heading_plain'  => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'More Than a Symbol —' ),
				'heading_accent' => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'A Promise' ),
				'subtitle'       => array( 'label' => 'Subtitle', 'type' => 'textarea', 'default' => 'Every element of our logo represents our commitment to nurturing minds and building a better tomorrow.' ),
				'sun_icon'       => array( 'label' => 'Sun — icon', 'type' => 'text', 'default' => '🌞' ),
				'sun_title'      => array( 'label' => 'Sun — title', 'type' => 'text', 'default' => 'The Sun' ),
				'sun_tag'        => array( 'label' => 'Sun — tag', 'type' => 'text', 'default' => 'Hope & Inspiration' ),
				'sun_desc'       => array( 'label' => 'Sun — description', 'type' => 'textarea', 'default' => 'The rising sun represents new beginnings, positivity and the endless possibilities that education brings.' ),
				'pencil_icon'    => array( 'label' => 'Pencil — icon', 'type' => 'text', 'default' => '✏️' ),
				'pencil_title'   => array( 'label' => 'Pencil — title', 'type' => 'text', 'default' => 'The Pencil' ),
				'pencil_tag'     => array( 'label' => 'Pencil — tag', 'type' => 'text', 'default' => 'Learning & Growth' ),
				'pencil_desc'    => array( 'label' => 'Pencil — description', 'type' => 'textarea', 'default' => 'The pencil stands for the power of learning, creativity and the tools we give our students to shape their future.' ),
				'pillars_icon'   => array( 'label' => 'Pillars — icon', 'type' => 'text', 'default' => '🏛️' ),
				'pillars_title'  => array( 'label' => 'Pillars — title', 'type' => 'text', 'default' => 'The Pillars' ),
				'pillars_tag'    => array( 'label' => 'Pillars — tag', 'type' => 'text', 'default' => 'Strength & Values' ),
				'pillars_desc'   => array( 'label' => 'Pillars — description', 'type' => 'textarea', 'default' => 'The pillars symbolise strong values, discipline and the solid foundation we build in every child for a confident tomorrow.' ),
				'book_icon'      => array( 'label' => 'Open Book — icon', 'type' => 'text', 'default' => '📖' ),
				'book_title'     => array( 'label' => 'Open Book — title', 'type' => 'text', 'default' => 'The Open Book' ),
				'book_tag'       => array( 'label' => 'Open Book — tag', 'type' => 'text', 'default' => 'Knowledge & Wisdom' ),
				'book_desc'      => array( 'label' => 'Open Book — description', 'type' => 'textarea', 'default' => 'The open book reflects knowledge without limits, curiosity and the joy of discovering, growing and learning for life.' ),
				'leaves_icon'    => array( 'label' => 'Leaves — icon', 'type' => 'text', 'default' => '🌿' ),
				'leaves_title'   => array( 'label' => 'Leaves — title', 'type' => 'text', 'default' => 'The Leaves' ),
				'leaves_tag'     => array( 'label' => 'Leaves — tag', 'type' => 'text', 'default' => 'Nurturing & Care' ),
				'leaves_desc'    => array( 'label' => 'Leaves — description', 'type' => 'textarea', 'default' => 'The leaves show our nurturing environment where every child is cared for, encouraged and supported to bloom.' ),
				'promise_text'   => array( 'label' => 'Promise line (basic HTML allowed, e.g. <strong>)', 'type' => 'html', 'default' => '⭐ Our logo is more than a symbol — <strong>it is our promise to every child and every parent.</strong> ⭐' ),
				'poster_image'   => array( 'label' => 'Poster image', 'type' => 'image' ),
			),
		),
		'messages'     => array(
			'label'  => __( 'Messages', 'mom-grandridge' ),
			'fields' => array(
				'parents_icon'  => array( 'label' => 'Parents card — icon', 'type' => 'text', 'default' => '👨‍👩‍👧' ),
				'parents_title' => array( 'label' => 'Parents card — title', 'type' => 'text', 'default' => 'Message to Our Parents' ),
				'parents_body'  => array( 'label' => 'Parents card — body', 'type' => 'textarea', 'default' => 'Your collaboration is our greatest strength. Let us work hand-in-hand to build a bright future for our children.' ),
				'students_icon'  => array( 'label' => 'Students card — icon', 'type' => 'text', 'default' => '🧒' ),
				'students_title' => array( 'label' => 'Students card — title', 'type' => 'text', 'default' => 'Message to Our Students' ),
				'students_body'  => array( 'label' => 'Students card — body', 'type' => 'textarea', 'default' => 'Dream big and work hard. Think deeply, experiment boldly and learn from every mistake — your future is our mission.' ),
			),
		),
		'stats'        => array(
			'label'  => __( 'Stats', 'mom-grandridge' ),
			'fields' => array(
				'stat1_value'  => array( 'label' => 'Stat 1 — value', 'type' => 'number', 'default' => 500 ),
				'stat1_suffix' => array( 'label' => 'Stat 1 — suffix', 'type' => 'text', 'default' => '+' ),
				'stat1_label'  => array( 'label' => 'Stat 1 — label', 'type' => 'text', 'default' => 'Happy Students' ),
				'stat1_icon'   => array( 'label' => 'Stat 1 — icon', 'type' => 'text', 'default' => '🧒' ),
				'stat2_value'  => array( 'label' => 'Stat 2 — value', 'type' => 'number', 'default' => 8 ),
				'stat2_suffix' => array( 'label' => 'Stat 2 — suffix', 'type' => 'text', 'default' => '+' ),
				'stat2_label'  => array( 'label' => 'Stat 2 — label', 'type' => 'text', 'default' => 'Years of Establishment' ),
				'stat2_icon'   => array( 'label' => 'Stat 2 — icon', 'type' => 'text', 'default' => '🎖️' ),
				'stat3_value'  => array( 'label' => 'Stat 3 — value', 'type' => 'number', 'default' => 12 ),
				'stat3_suffix' => array( 'label' => 'Stat 3 — suffix', 'type' => 'text', 'default' => '' ),
				'stat3_label'  => array( 'label' => 'Stat 3 — label', 'type' => 'text', 'default' => 'Class Levels — Daycare to Grade 7' ),
				'stat3_icon'   => array( 'label' => 'Stat 3 — icon', 'type' => 'text', 'default' => '🏫' ),
				'stat4_value'  => array( 'label' => 'Stat 4 — value', 'type' => 'number', 'default' => 30 ),
				'stat4_suffix' => array( 'label' => 'Stat 4 — suffix', 'type' => 'text', 'default' => '+' ),
				'stat4_label'  => array( 'label' => 'Stat 4 — label', 'type' => 'text', 'default' => 'Qualified Teachers' ),
				'stat4_icon'   => array( 'label' => 'Stat 4 — icon', 'type' => 'text', 'default' => '👩‍🏫' ),
			),
		),
		'programs'     => array(
			'label'  => __( 'Classes Intro', 'mom-grandridge' ),
			'fields' => array(
				'eyebrow'             => array( 'label' => 'Eyebrow', 'type' => 'text', 'default' => '— Classes Available' ),
				'heading_plain'       => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'Strong Foundation Today,' ),
				'heading_accent'      => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'Bright Future Tomorrow' ),
				'subtitle'            => array( 'label' => 'Subtitle', 'type' => 'textarea', 'default' => 'A seamless learning path from daycare age all the way to Grade 7.' ),
				'activity_icon'       => array( 'label' => 'Activity note — icon', 'type' => 'text', 'default' => '🎭' ),
				'activity_text'       => array( 'label' => 'Activity note — text (basic HTML allowed)', 'type' => 'html', 'default' => '<strong>Plus: Activity Classes</strong> — skill-building and hobby sessions beyond the regular curriculum, for every age group.' ),
				'activity_link_label' => array( 'label' => 'Activity note — link label', 'type' => 'text', 'default' => 'Ask us →' ),
				'activity_link_target' => array( 'label' => 'Activity note — link target', 'type' => 'text', 'default' => '#contact' ),
				'poster_image'        => array( 'label' => 'Poster image', 'type' => 'image' ),
			),
		),
		'facilities'   => array(
			'label'  => __( 'Facilities Intro', 'mom-grandridge' ),
			'fields' => array(
				'eyebrow'        => array( 'label' => 'Eyebrow', 'type' => 'text', 'default' => '— Our Salient Features' ),
				'heading_plain'  => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'Built for' ),
				'heading_accent' => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'Big Imaginations' ),
			),
		),
		'gallery'      => array(
			'label'  => __( 'Gallery Intro', 'mom-grandridge' ),
			'fields' => array(
				'eyebrow'         => array( 'label' => 'Eyebrow', 'type' => 'text', 'default' => '— Life at Mom Grandridge' ),
				'heading_plain'   => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'Every Day is an' ),
				'heading_accent'  => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'Adventure' ),
				'home_limit'      => array( 'label' => 'Photos shown on the home page', 'type' => 'number', 'default' => 10, 'desc' => 'The rest only appear on the full Gallery page.' ),
				'view_all_label'  => array( 'label' => 'View-all button label', 'type' => 'text', 'default' => 'View Full Gallery →' ),
			),
		),
		'testimonials' => array(
			'label'  => __( 'Testimonials Intro', 'mom-grandridge' ),
			'fields' => array(
				'eyebrow'        => array( 'label' => 'Eyebrow', 'type' => 'text', 'default' => '— What Parents Say' ),
				'heading_plain'  => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'Loved by' ),
				'heading_accent' => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'Families' ),
			),
		),
		'admissions'   => array(
			'label'  => __( 'Admissions CTA', 'mom-grandridge' ),
			'fields' => array(
				'heading_plain'     => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'Admission Open —' ),
				'heading_accent'    => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'Academic Year 2026–27' ),
				'body'              => array( 'label' => 'Body text', 'type' => 'textarea', 'default' => 'Where every child is valued, nurtured and inspired to succeed. Classes available from Daycare (6 months) to Grade 7 — limited seats available. Enroll now!' ),
				'cta_primary_label' => array( 'label' => 'Primary button label', 'type' => 'text', 'default' => 'Enroll Now' ),
				'cta_primary_link'  => array( 'label' => 'Primary button link', 'type' => 'text', 'default' => '#contact' ),
				'phone_display'     => array( 'label' => 'Phone button label', 'type' => 'text', 'default' => '📞 +91 96407 37373' ),
				'phone_tel'         => array( 'label' => 'Phone number (for tel: link)', 'type' => 'text', 'default' => '+919640737373' ),
				'poster_image'      => array( 'label' => 'Poster image', 'type' => 'image' ),
			),
		),
		'contact'      => array(
			'label'  => __( 'Contact', 'mom-grandridge' ),
			'fields' => array(
				'eyebrow'               => array( 'label' => 'Eyebrow', 'type' => 'text', 'default' => '— Get in Touch' ),
				'heading_plain'         => array( 'label' => 'Heading (plain)', 'type' => 'text', 'default' => 'Send Us a' ),
				'heading_accent'        => array( 'label' => 'Heading (accent)', 'type' => 'text', 'default' => 'Message' ),
				'address'               => array( 'label' => 'Office address', 'type' => 'textarea', 'default' => "No. 2-38/2, Plot No.2, Tara Nagar,\nS2 Circle, Serlingampally, Hyderabad - 19" ),
				'phone'                 => array( 'label' => 'Phone (displayed)', 'type' => 'text', 'default' => '+91 96407 37373' ),
				'email'                 => array( 'label' => 'Email (displayed)', 'type' => 'email', 'default' => 'admin@momgrandridgeschool.com' ),
				'hours'                 => array( 'label' => 'Office hours', 'type' => 'text', 'default' => 'Monday – Saturday, 8 AM – 6 PM' ),
				'form_recipient_email'  => array( 'label' => 'Enquiry form recipient email', 'type' => 'email', 'default' => 'admin@momgrandridgeschool.com', 'desc' => 'Falls back to the site admin email if left blank.' ),
				'success_message'       => array( 'label' => 'Form success message', 'type' => 'text', 'default' => "✓ Thank you! We'll be in touch within one working day." ),
				'error_message'         => array( 'label' => 'Form error message', 'type' => 'text', 'default' => 'Something went wrong — please try again, or call us directly.' ),
				'note_text'             => array( 'label' => 'Form footnote', 'type' => 'text', 'default' => 'We usually respond within one working day.' ),
			),
		),
		'footer'       => array(
			'label'  => __( 'Footer', 'mom-grandridge' ),
			'fields' => array(
				'blurb'          => array( 'label' => 'Brand blurb', 'type' => 'textarea', 'default' => 'With passion, dedication and a heart full of care, we create a safe and nurturing environment where every child grows, learns and shines.' ),
				'facebook_url'   => array( 'label' => 'Facebook URL', 'type' => 'url', 'default' => '#' ),
				'instagram_url'  => array( 'label' => 'Instagram URL', 'type' => 'url', 'default' => '#' ),
				'youtube_url'    => array( 'label' => 'YouTube URL', 'type' => 'url', 'default' => '#' ),
				'copyright_text' => array( 'label' => 'Copyright line', 'type' => 'text', 'default' => '© 2026 Mom Grandridge School — Life. Line. Knowledge. All rights reserved.' ),
			),
		),
	);
}

function mgs_add_options_page() {
	add_menu_page(
		__( 'Theme Options', 'mom-grandridge' ),
		__( 'Theme Options', 'mom-grandridge' ),
		'manage_options',
		'mgs-theme-options',
		'mgs_render_options_page',
		'dashicons-admin-customizer',
		61
	);
}
add_action( 'admin_menu', 'mgs_add_options_page' );

function mgs_register_settings() {
	foreach ( mgs_option_tabs() as $tab_slug => $tab ) {
		register_setting(
			'mgs_opt_' . $tab_slug . '_group',
			'mgs_opt_' . $tab_slug,
			array(
				'sanitize_callback' => function( $value ) use ( $tab ) {
					return mgs_sanitize_tab_fields( $value, $tab['fields'] );
				},
			)
		);
	}
}
add_action( 'admin_init', 'mgs_register_settings' );

function mgs_sanitize_tab_fields( $value, $fields ) {
	$clean = array();
	if ( ! is_array( $value ) ) {
		return $clean;
	}
	foreach ( $fields as $key => $field ) {
		if ( ! isset( $value[ $key ] ) ) {
			continue;
		}
		$raw = wp_unslash( $value[ $key ] );
		switch ( $field['type'] ) {
			case 'textarea':
				$clean[ $key ] = sanitize_textarea_field( $raw );
				break;
			case 'html':
				$clean[ $key ] = wp_kses_post( $raw );
				break;
			case 'number':
				$clean[ $key ] = absint( $raw );
				break;
			case 'email':
				$clean[ $key ] = sanitize_email( $raw );
				break;
			case 'url':
				$clean[ $key ] = esc_url_raw( $raw );
				break;
			case 'image':
				$clean[ $key ] = absint( $raw );
				break;
			default:
				$clean[ $key ] = sanitize_text_field( $raw );
		}
	}
	return $clean;
}

function mgs_render_options_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$tabs        = mgs_option_tabs();
	$active_tab  = isset( $_GET['tab'] ) && isset( $tabs[ $_GET['tab'] ] ) ? sanitize_key( $_GET['tab'] ) : array_key_first( $tabs );
	$tab         = $tabs[ $active_tab ];
	$option_name = 'mgs_opt_' . $active_tab;
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Mom Grandridge School — Theme Options', 'mom-grandridge' ); ?></h1>

		<h2 class="nav-tab-wrapper">
			<?php foreach ( $tabs as $slug => $t ) : ?>
				<a href="<?php echo esc_url( add_query_arg( array( 'page' => 'mgs-theme-options', 'tab' => $slug ) ) ); ?>"
					class="nav-tab <?php echo $slug === $active_tab ? 'nav-tab-active' : ''; ?>">
					<?php echo esc_html( $t['label'] ); ?>
				</a>
			<?php endforeach; ?>
		</h2>

		<form method="post" action="options.php">
			<?php settings_fields( $option_name . '_group' ); ?>
			<table class="form-table" role="presentation">
				<?php foreach ( $tab['fields'] as $key => $field ) : ?>
					<tr>
						<th scope="row"><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label></th>
						<td><?php mgs_render_option_field( $active_tab, $key, $field ); ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

function mgs_render_option_field( $group, $key, $field ) {
	$name  = "mgs_opt_{$group}[{$key}]";
	$value = mgs_opt( $group, $key, isset( $field['default'] ) ? $field['default'] : '' );

	switch ( $field['type'] ) {
		case 'textarea':
		case 'html':
			printf(
				'<textarea name="%1$s" rows="4" class="large-text">%2$s</textarea>',
				esc_attr( $name ),
				esc_textarea( $value )
			);
			break;
		case 'image':
			mgs_media_field( $group, $key, isset( $field['desc'] ) ? $field['desc'] : '' );
			break;
		case 'number':
			printf(
				'<input type="number" name="%1$s" value="%2$s" class="small-text" />',
				esc_attr( $name ),
				esc_attr( $value )
			);
			break;
		default: // text, email, url all render as plain text inputs with the browser doing basic validation.
			$input_type = in_array( $field['type'], array( 'email', 'url' ), true ) ? $field['type'] : 'text';
			printf(
				'<input type="%1$s" name="%2$s" value="%3$s" class="regular-text" />',
				esc_attr( $input_type ),
				esc_attr( $name ),
				esc_attr( $value )
			);
	}

	if ( ! empty( $field['desc'] ) && 'image' !== $field['type'] ) {
		printf( '<p class="description">%s</p>', esc_html( $field['desc'] ) );
	}
}
