<?php
/**
 * Per-section ACF field definitions — the single source of truth reused
 * to build both:
 *   - the Home page's field groups (inc/acf-fields.php, name prefixed
 *     "{section}_{field}" to avoid collisions between the ~12 groups
 *     that all attach to the same post), and
 *   - the Flexible Content "Page Sections" layouts available on any
 *     other page (unprefixed — a row's own layout already scopes it).
 *
 * Field names here are deliberately unprefixed; every function returns
 * a plain array of ACF field definitions using 'default_value' (not the
 * old Theme Options schema's 'default' key).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mgs_hero_field_defs() {
	return array(
		array( 'name' => 'badge', 'label' => 'Badge text', 'type' => 'text', 'default_value' => '✨ Admission Open — Academic Year 2026–27' ),
		array( 'name' => 'title_line1_plain', 'label' => 'Title line 1 (plain)', 'type' => 'text', 'default_value' => 'Nurturing' ),
		array( 'name' => 'title_line1_accent', 'label' => 'Title line 1 (accent)', 'type' => 'text', 'default_value' => 'Minds.' ),
		array( 'name' => 'title_line2_plain', 'label' => 'Title line 2 (plain)', 'type' => 'text', 'default_value' => 'Building' ),
		array( 'name' => 'title_line2_accent', 'label' => 'Title line 2 (accent)', 'type' => 'text', 'default_value' => 'Futures.' ),
		array( 'name' => 'subtitle_strong', 'label' => 'Subtitle — bold lead-in', 'type' => 'text', 'default_value' => 'Life. Line. Knowledge.' ),
		array( 'name' => 'subtitle_body', 'label' => 'Subtitle — body', 'type' => 'textarea', 'default_value' => 'Mom Grandridge School is a safe, joyful learning community in Serlingampally, Hyderabad, where every child is valued, nurtured and inspired to succeed — from Daycare to Grade 7.' ),
		array( 'name' => 'cta_primary_label', 'label' => 'Primary button label', 'type' => 'text', 'default_value' => 'Enroll Now' ),
		array( 'name' => 'cta_primary_link', 'label' => 'Primary button link', 'type' => 'text', 'default_value' => '#admissions' ),
		array( 'name' => 'cta_secondary_label', 'label' => 'Secondary button label', 'type' => 'text', 'default_value' => 'Explore the School' ),
		array( 'name' => 'cta_secondary_link', 'label' => 'Secondary button link', 'type' => 'text', 'default_value' => '#about' ),
		array( 'name' => 'chip_1', 'label' => 'Chip 1', 'type' => 'text', 'default_value' => '👶 Daycare to Grade 7' ),
		array( 'name' => 'chip_2', 'label' => 'Chip 2', 'type' => 'text', 'default_value' => '🏊 Splash Pool' ),
		array( 'name' => 'chip_3', 'label' => 'Chip 3', 'type' => 'text', 'default_value' => '🎨 Art & Craft Workshops' ),
		array( 'name' => 'chip_4', 'label' => 'Chip 4', 'type' => 'text', 'default_value' => '🚌 Safe Transport' ),
		array( 'name' => 'scroll_text', 'label' => 'Scroll hint text', 'type' => 'text', 'default_value' => 'Learn · Grow · Succeed' ),
	);
}

function mgs_marquee_field_defs() {
	return array(
		array(
			'name'          => 'items',
			'label'         => 'Marquee phrases (one per line)',
			'type'          => 'textarea',
			'default_value' => "🎓 Admission Open 2026–27\nLife · Line · Knowledge\nQuality Education\nCharacter Building\nHolistic Development\nValues & Discipline\nYour Future. Our Mission.",
		),
	);
}

function mgs_about_field_defs() {
	return array(
		array( 'name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => '— Welcome to Mom Grandridge School' ),
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'Where Every Child is' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'Valued, Nurtured & Inspired' ),
		array( 'name' => 'body', 'label' => 'Body paragraph', 'type' => 'textarea', 'default_value' => 'Our vision is simple: to inspire excellence, foster creativity and cultivate young artists. We believe learning is a lifelong journey — so we encourage our students to think deeply through practical experiments and to learn from their mistakes. Through a rich mix of academics, sports and arts, every student builds the confidence to make a meaningful impact on the world.' ),
		array( 'name' => 'point1_icon', 'label' => 'Point 1 icon', 'type' => 'text', 'default_value' => '📖' ),
		array( 'name' => 'point1_title', 'label' => 'Point 1 title', 'type' => 'text', 'default_value' => 'Quality Education' ),
		array( 'name' => 'point1_desc', 'label' => 'Point 1 description', 'type' => 'text', 'default_value' => 'Strong academics with a good student–teacher ratio and personal attention for every learner.' ),
		array( 'name' => 'point2_icon', 'label' => 'Point 2 icon', 'type' => 'text', 'default_value' => '💡' ),
		array( 'name' => 'point2_title', 'label' => 'Point 2 title', 'type' => 'text', 'default_value' => 'Character Building' ),
		array( 'name' => 'point2_desc', 'label' => 'Point 2 description', 'type' => 'text', 'default_value' => 'Values and discipline woven into everyday school life.' ),
		array( 'name' => 'point3_icon', 'label' => 'Point 3 icon', 'type' => 'text', 'default_value' => '🌱' ),
		array( 'name' => 'point3_title', 'label' => 'Point 3 title', 'type' => 'text', 'default_value' => 'Holistic Development' ),
		array( 'name' => 'point3_desc', 'label' => 'Point 3 description', 'type' => 'text', 'default_value' => 'Sports, arts and life skills growing alongside studies.' ),
		array( 'name' => 'chip_a', 'label' => 'Floating chip A', 'type' => 'text', 'default_value' => '🏊 Splash Pool' ),
		array( 'name' => 'chip_b', 'label' => 'Floating chip B', 'type' => 'text', 'default_value' => '🎨 Art & Craft' ),
		array( 'name' => 'chip_c', 'label' => 'Floating chip C', 'type' => 'text', 'default_value' => '🚌 Safe Transport' ),
		array( 'name' => 'quote_text', 'label' => 'Principal quote', 'type' => 'textarea', 'default_value' => 'With passion, dedication and a heart full of care, we create a safe and nurturing environment where every child grows, learns and shines.' ),
		array( 'name' => 'quote_name', 'label' => 'Principal name', 'type' => 'text', 'default_value' => 'Shaik Ruksana' ),
		array( 'name' => 'quote_title', 'label' => 'Principal title', 'type' => 'text', 'default_value' => 'Principal · 15+ years of experience in child care' ),
		array( 'name' => 'banner_image', 'label' => 'Banner photo', 'type' => 'image', 'return_format' => 'id' ),
		array( 'name' => 'cta_label', 'label' => 'Button label', 'type' => 'text', 'default_value' => 'See Our Classes' ),
		array( 'name' => 'cta_link', 'label' => 'Button link', 'type' => 'text', 'default_value' => '#programs' ),
	);
}

function mgs_purpose_field_defs() {
	return array(
		array( 'name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => '— Our Logo. Our Purpose.' ),
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'More Than a Symbol —' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'A Promise' ),
		array( 'name' => 'subtitle', 'label' => 'Subtitle', 'type' => 'textarea', 'default_value' => 'Every element of our logo represents our commitment to nurturing minds and building a better tomorrow.' ),
		array( 'name' => 'sun_icon', 'label' => 'Sun — icon', 'type' => 'text', 'default_value' => '🌞' ),
		array( 'name' => 'sun_title', 'label' => 'Sun — title', 'type' => 'text', 'default_value' => 'The Sun' ),
		array( 'name' => 'sun_tag', 'label' => 'Sun — tag', 'type' => 'text', 'default_value' => 'Hope & Inspiration' ),
		array( 'name' => 'sun_desc', 'label' => 'Sun — description', 'type' => 'textarea', 'default_value' => 'The rising sun represents new beginnings, positivity and the endless possibilities that education brings.' ),
		array( 'name' => 'pencil_icon', 'label' => 'Pencil — icon', 'type' => 'text', 'default_value' => '✏️' ),
		array( 'name' => 'pencil_title', 'label' => 'Pencil — title', 'type' => 'text', 'default_value' => 'The Pencil' ),
		array( 'name' => 'pencil_tag', 'label' => 'Pencil — tag', 'type' => 'text', 'default_value' => 'Learning & Growth' ),
		array( 'name' => 'pencil_desc', 'label' => 'Pencil — description', 'type' => 'textarea', 'default_value' => 'The pencil stands for the power of learning, creativity and the tools we give our students to shape their future.' ),
		array( 'name' => 'pillars_icon', 'label' => 'Pillars — icon', 'type' => 'text', 'default_value' => '🏛️' ),
		array( 'name' => 'pillars_title', 'label' => 'Pillars — title', 'type' => 'text', 'default_value' => 'The Pillars' ),
		array( 'name' => 'pillars_tag', 'label' => 'Pillars — tag', 'type' => 'text', 'default_value' => 'Strength & Values' ),
		array( 'name' => 'pillars_desc', 'label' => 'Pillars — description', 'type' => 'textarea', 'default_value' => 'The pillars symbolise strong values, discipline and the solid foundation we build in every child for a confident tomorrow.' ),
		array( 'name' => 'book_icon', 'label' => 'Open Book — icon', 'type' => 'text', 'default_value' => '📖' ),
		array( 'name' => 'book_title', 'label' => 'Open Book — title', 'type' => 'text', 'default_value' => 'The Open Book' ),
		array( 'name' => 'book_tag', 'label' => 'Open Book — tag', 'type' => 'text', 'default_value' => 'Knowledge & Wisdom' ),
		array( 'name' => 'book_desc', 'label' => 'Open Book — description', 'type' => 'textarea', 'default_value' => 'The open book reflects knowledge without limits, curiosity and the joy of discovering, growing and learning for life.' ),
		array( 'name' => 'leaves_icon', 'label' => 'Leaves — icon', 'type' => 'text', 'default_value' => '🌿' ),
		array( 'name' => 'leaves_title', 'label' => 'Leaves — title', 'type' => 'text', 'default_value' => 'The Leaves' ),
		array( 'name' => 'leaves_tag', 'label' => 'Leaves — tag', 'type' => 'text', 'default_value' => 'Nurturing & Care' ),
		array( 'name' => 'leaves_desc', 'label' => 'Leaves — description', 'type' => 'textarea', 'default_value' => 'The leaves show our nurturing environment where every child is cared for, encouraged and supported to bloom.' ),
		array( 'name' => 'promise_text', 'label' => 'Promise line (basic HTML allowed, e.g. <strong>)', 'type' => 'textarea', 'default_value' => '⭐ Our logo is more than a symbol — <strong>it is our promise to every child and every parent.</strong> ⭐' ),
		array( 'name' => 'poster_image', 'label' => 'Poster image', 'type' => 'image', 'return_format' => 'id' ),
	);
}

function mgs_messages_field_defs() {
	return array(
		array( 'name' => 'parents_icon', 'label' => 'Parents card — icon', 'type' => 'text', 'default_value' => '👨‍👩‍👧' ),
		array( 'name' => 'parents_title', 'label' => 'Parents card — title', 'type' => 'text', 'default_value' => 'Message to Our Parents' ),
		array( 'name' => 'parents_body', 'label' => 'Parents card — body', 'type' => 'textarea', 'default_value' => 'Your collaboration is our greatest strength. Let us work hand-in-hand to build a bright future for our children.' ),
		array( 'name' => 'students_icon', 'label' => 'Students card — icon', 'type' => 'text', 'default_value' => '🧒' ),
		array( 'name' => 'students_title', 'label' => 'Students card — title', 'type' => 'text', 'default_value' => 'Message to Our Students' ),
		array( 'name' => 'students_body', 'label' => 'Students card — body', 'type' => 'textarea', 'default_value' => 'Dream big and work hard. Think deeply, experiment boldly and learn from every mistake — your future is our mission.' ),
	);
}

function mgs_stats_field_defs() {
	return array(
		array( 'name' => 'stat1_value', 'label' => 'Stat 1 — value', 'type' => 'number', 'default_value' => 500 ),
		array( 'name' => 'stat1_suffix', 'label' => 'Stat 1 — suffix', 'type' => 'text', 'default_value' => '+' ),
		array( 'name' => 'stat1_label', 'label' => 'Stat 1 — label', 'type' => 'text', 'default_value' => 'Happy Students' ),
		array( 'name' => 'stat1_icon', 'label' => 'Stat 1 — icon', 'type' => 'text', 'default_value' => '🧒' ),
		array( 'name' => 'stat2_value', 'label' => 'Stat 2 — value', 'type' => 'number', 'default_value' => 8 ),
		array( 'name' => 'stat2_suffix', 'label' => 'Stat 2 — suffix', 'type' => 'text', 'default_value' => '+' ),
		array( 'name' => 'stat2_label', 'label' => 'Stat 2 — label', 'type' => 'text', 'default_value' => 'Years of Establishment' ),
		array( 'name' => 'stat2_icon', 'label' => 'Stat 2 — icon', 'type' => 'text', 'default_value' => '🎖️' ),
		array( 'name' => 'stat3_value', 'label' => 'Stat 3 — value', 'type' => 'number', 'default_value' => 12 ),
		array( 'name' => 'stat3_suffix', 'label' => 'Stat 3 — suffix', 'type' => 'text', 'default_value' => '' ),
		array( 'name' => 'stat3_label', 'label' => 'Stat 3 — label', 'type' => 'text', 'default_value' => 'Class Levels — Daycare to Grade 7' ),
		array( 'name' => 'stat3_icon', 'label' => 'Stat 3 — icon', 'type' => 'text', 'default_value' => '🏫' ),
		array( 'name' => 'stat4_value', 'label' => 'Stat 4 — value', 'type' => 'number', 'default_value' => 30 ),
		array( 'name' => 'stat4_suffix', 'label' => 'Stat 4 — suffix', 'type' => 'text', 'default_value' => '+' ),
		array( 'name' => 'stat4_label', 'label' => 'Stat 4 — label', 'type' => 'text', 'default_value' => 'Qualified Teachers' ),
		array( 'name' => 'stat4_icon', 'label' => 'Stat 4 — icon', 'type' => 'text', 'default_value' => '👩‍🏫' ),
	);
}

function mgs_programs_field_defs() {
	return array(
		array( 'name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => '— Classes Available' ),
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'Strong Foundation Today,' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'Bright Future Tomorrow' ),
		array( 'name' => 'subtitle', 'label' => 'Subtitle', 'type' => 'textarea', 'default_value' => 'A seamless learning path from daycare age all the way to Grade 7.' ),
		array( 'name' => 'activity_icon', 'label' => 'Activity note — icon', 'type' => 'text', 'default_value' => '🎭' ),
		array( 'name' => 'activity_text', 'label' => 'Activity note — text (basic HTML allowed)', 'type' => 'textarea', 'default_value' => '<strong>Plus: Activity Classes</strong> — skill-building and hobby sessions beyond the regular curriculum, for every age group.' ),
		array( 'name' => 'activity_link_label', 'label' => 'Activity note — link label', 'type' => 'text', 'default_value' => 'Ask us →' ),
		array( 'name' => 'activity_link_target', 'label' => 'Activity note — link target', 'type' => 'text', 'default_value' => '#contact' ),
		array( 'name' => 'poster_image', 'label' => 'Poster image', 'type' => 'image', 'return_format' => 'id' ),
	);
}

function mgs_facilities_field_defs() {
	return array(
		array( 'name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => '— Our Salient Features' ),
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'Built for' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'Big Imaginations' ),
	);
}

function mgs_gallery_field_defs() {
	return array(
		array( 'name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => '— Life at Mom Grandridge' ),
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'Every Day is an' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'Adventure' ),
		array( 'name' => 'home_limit', 'label' => 'Photos shown on the home page', 'type' => 'number', 'default_value' => 10, 'instructions' => 'The rest only appear on the full Gallery page.' ),
		array( 'name' => 'view_all_label', 'label' => 'View-all button label', 'type' => 'text', 'default_value' => 'View Full Gallery →' ),
	);
}

function mgs_testimonials_field_defs() {
	return array(
		array( 'name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => '— What Parents Say' ),
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'Loved by' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'Families' ),
	);
}

function mgs_admissions_field_defs() {
	return array(
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'Admission Open —' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'Academic Year 2026–27' ),
		array( 'name' => 'body', 'label' => 'Body text', 'type' => 'textarea', 'default_value' => 'Where every child is valued, nurtured and inspired to succeed. Classes available from Daycare (6 months) to Grade 7 — limited seats available. Enroll now!' ),
		array( 'name' => 'cta_primary_label', 'label' => 'Primary button label', 'type' => 'text', 'default_value' => 'Enroll Now' ),
		array( 'name' => 'cta_primary_link', 'label' => 'Primary button link', 'type' => 'text', 'default_value' => '#contact' ),
		array( 'name' => 'phone_display', 'label' => 'Phone button label', 'type' => 'text', 'default_value' => '📞 +91 96407 37373' ),
		array( 'name' => 'phone_tel', 'label' => 'Phone number (for tel: link)', 'type' => 'text', 'default_value' => '+919640737373' ),
		array( 'name' => 'poster_image', 'label' => 'Poster image', 'type' => 'image', 'return_format' => 'id' ),
	);
}

function mgs_contact_field_defs() {
	return array(
		array( 'name' => 'eyebrow', 'label' => 'Eyebrow', 'type' => 'text', 'default_value' => '— Get in Touch' ),
		array( 'name' => 'heading_plain', 'label' => 'Heading (plain)', 'type' => 'text', 'default_value' => 'Send Us a' ),
		array( 'name' => 'heading_accent', 'label' => 'Heading (accent)', 'type' => 'text', 'default_value' => 'Message' ),
		array( 'name' => 'address', 'label' => 'Office address', 'type' => 'textarea', 'default_value' => "No. 2-38/2, Plot No.2, Tara Nagar,\nS2 Circle, Serlingampally, Hyderabad - 19" ),
		array( 'name' => 'phone', 'label' => 'Phone (displayed)', 'type' => 'text', 'default_value' => '+91 96407 37373' ),
		array( 'name' => 'email', 'label' => 'Email (displayed)', 'type' => 'email', 'default_value' => 'admin@momgrandridgeschool.com' ),
		array( 'name' => 'hours', 'label' => 'Office hours', 'type' => 'text', 'default_value' => 'Monday – Saturday, 8 AM – 6 PM' ),
		array( 'name' => 'form_recipient_email', 'label' => 'Enquiry form recipient email', 'type' => 'email', 'default_value' => 'admin@momgrandridgeschool.com', 'instructions' => 'Falls back to the site admin email if left blank.' ),
		array( 'name' => 'success_message', 'label' => 'Form success message', 'type' => 'text', 'default_value' => "✓ Thank you! We'll be in touch within one working day." ),
		array( 'name' => 'error_message', 'label' => 'Form error message', 'type' => 'text', 'default_value' => 'Something went wrong — please try again, or call us directly.' ),
		array( 'name' => 'note_text', 'label' => 'Form footnote', 'type' => 'text', 'default_value' => 'We usually respond within one working day.' ),
	);
}

function mgs_footer_field_defs() {
	return array(
		array( 'name' => 'blurb', 'label' => 'Brand blurb', 'type' => 'textarea', 'default_value' => 'With passion, dedication and a heart full of care, we create a safe and nurturing environment where every child grows, learns and shines.' ),
		array( 'name' => 'facebook_url', 'label' => 'Facebook URL', 'type' => 'url', 'default_value' => '#' ),
		array( 'name' => 'instagram_url', 'label' => 'Instagram URL', 'type' => 'url', 'default_value' => '#' ),
		array( 'name' => 'youtube_url', 'label' => 'YouTube URL', 'type' => 'url', 'default_value' => '#' ),
		array( 'name' => 'copyright_text', 'label' => 'Copyright line', 'type' => 'text', 'default_value' => '© 2026 Mom Grandridge School — Life. Line. Knowledge. All rights reserved.' ),
	);
}

/**
 * Maps each section to its field-defs function and whether it's offered
 * as a selectable Flexible Content layout on other pages. Footer is
 * excluded: it's sitewide chrome rendered by footer.php on every page,
 * not a per-page content section.
 */
function mgs_section_registry() {
	return array(
		'hero'         => array( 'label' => 'Hero', 'defs' => 'mgs_hero_field_defs', 'flexible' => true ),
		'marquee'      => array( 'label' => 'Marquee', 'defs' => 'mgs_marquee_field_defs', 'flexible' => true ),
		'about'        => array( 'label' => 'About', 'defs' => 'mgs_about_field_defs', 'flexible' => true ),
		'purpose'      => array( 'label' => 'Logo Purpose', 'defs' => 'mgs_purpose_field_defs', 'flexible' => true ),
		'messages'     => array( 'label' => 'Messages', 'defs' => 'mgs_messages_field_defs', 'flexible' => true ),
		'stats'        => array( 'label' => 'Stats', 'defs' => 'mgs_stats_field_defs', 'flexible' => true ),
		'programs'     => array( 'label' => 'Classes Intro', 'defs' => 'mgs_programs_field_defs', 'flexible' => true ),
		'facilities'   => array( 'label' => 'Facilities Intro', 'defs' => 'mgs_facilities_field_defs', 'flexible' => true ),
		'gallery'      => array( 'label' => 'Gallery Intro', 'defs' => 'mgs_gallery_field_defs', 'flexible' => true ),
		'testimonials' => array( 'label' => 'Testimonials Intro', 'defs' => 'mgs_testimonials_field_defs', 'flexible' => true ),
		'admissions'   => array( 'label' => 'Admissions CTA', 'defs' => 'mgs_admissions_field_defs', 'flexible' => true ),
		'contact'      => array( 'label' => 'Contact', 'defs' => 'mgs_contact_field_defs', 'flexible' => true ),
		'footer'       => array( 'label' => 'Footer', 'defs' => 'mgs_footer_field_defs', 'flexible' => false ),
	);
}

/**
 * Flatten the registry into "{group}_{field}" => default_value, reused
 * by mgs_opt()'s runtime fallback so it can never drift from what's
 * configured as each ACF field's own default_value.
 */
function mgs_default_values() {
	static $flat = null;
	if ( null !== $flat ) {
		return $flat;
	}
	$flat = array();
	foreach ( mgs_section_registry() as $group => $section ) {
		if ( ! function_exists( $section['defs'] ) ) {
			continue;
		}
		foreach ( call_user_func( $section['defs'] ) as $field ) {
			$flat[ "{$group}_{$field['name']}" ] = isset( $field['default_value'] ) ? $field['default_value'] : '';
		}
	}
	return $flat;
}

function mgs_field_default( $group, $key ) {
	$flat = mgs_default_values();
	$k    = "{$group}_{$key}";
	return array_key_exists( $k, $flat ) ? $flat[ $k ] : '';
}
