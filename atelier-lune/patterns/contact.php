<?php
/**
 * Title: Contact
 * Slug: atelier-lune/contact
 * Categories: atelier-lune
 * Description: Cream contact section. The form is placeholder markup — replace the Custom HTML block with a Contact Form 7 / WPForms shortcode block for a working form.
 */
?>
<!-- wp:group {"tagName":"section","anchor":"contact","className":"contact","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|xl"}}},"backgroundColor":"cream","layout":{"type":"constrained"}} -->
<section class="wp-block-group contact has-cream-background-color has-background" id="contact" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--xl)"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"45%"} -->
<div class="wp-block-column" style="flex-basis:45%"><!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Contact</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Book a fitting</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Tell us a little about what you're looking for and we'll follow up to schedule a first fitting at the studio.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"55%"} -->
<div class="wp-block-column" style="flex-basis:55%"><!-- wp:html -->
<form class="contact-form" action="#" method="post">
	<div class="field">
		<label for="al-name">Name</label>
		<input id="al-name" name="name" type="text" required>
	</div>
	<div class="field">
		<label for="al-email">Email</label>
		<input id="al-email" name="email" type="email" required>
	</div>
	<div class="field">
		<label for="al-message">What are you looking for?</label>
		<textarea id="al-message" name="message"></textarea>
	</div>
	<button type="submit">Request a fitting</button>
</form>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
