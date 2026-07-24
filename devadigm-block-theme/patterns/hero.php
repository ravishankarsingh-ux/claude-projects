<?php
/**
 * Title: Hero
 * Slug: devadigm/hero
 * Categories: devadigm
 * Description: Homepage hero — eyebrow, display headline, intro copy, CTA button, and the brain constellation canvas.
 */
?>
<!-- wp:group {"tagName":"section","className":"section hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|96"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group section hero" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--96)"><!-- wp:columns {"verticalAlignment":"center","className":"section-inner hero-inner","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center section-inner hero-inner"><!-- wp:column {"verticalAlignment":"center","className":"hero-copy"} -->
<div class="wp-block-column is-vertically-aligned-center hero-copy"><!-- wp:paragraph {"className":"eyebrow","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|18"}}}} -->
<p class="eyebrow" style="margin-bottom:var(--wp--preset--spacing--18)">Cape Cod Web Development &amp; Marketing</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"fontSize":"display","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|24"}}}} -->
<h1 class="wp-block-heading has-display-font-size" style="margin-bottom:var(--wp--preset--spacing--24)">Websites that<br>work as hard<br>as you do.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"body-copy","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|24"}},"layout":{"selfStretch":"fixed","flexSize":"480px"}}} -->
<p class="body-copy" style="margin-bottom:var(--wp--preset--spacing--24)">Devadigm helps small and mid-sized businesses generate new leads and increase sales — with a consistent, relevant brand message across every digital platform you use.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#contact">Schedule a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"hero-visual-col"} -->
<div class="wp-block-column is-vertically-aligned-center hero-visual-col"><!-- wp:html -->
<div class="hero-visual"><canvas id="brain-constellation" aria-hidden="true"></canvas></div>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
