<?php
/**
 * Title: Harbor & Pine footer
 * Slug: harbor-pine/footer
 * Inserter: no
 */

defined('ABSPATH') || exit;

$harbor_phone = (string) get_option('harbor_business_phone', '');
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"3.5rem","bottom":"3rem"},"margin":{"top":"4rem"}}},"backgroundColor":"harbor","textColor":"base","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group has-base-color has-harbor-background-color has-text-color has-background" style="margin-top:4rem;padding-top:3.5rem;padding-bottom:3rem">
<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column {"width":"42%"} -->
<div class="wp-block-column" style="flex-basis:42%">
<!-- wp:paragraph {"fontFamily":"roboto-slab","style":{"typography":{"fontSize":"1.35rem","fontWeight":"700"}}} -->
<p class="has-roboto-slab-font-family" style="font-size:1.35rem;font-weight:700">Harbor &amp; Pine Landscaping</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"#c9d6dc"}}} -->
<p class="has-text-color" style="color:#c9d6dc">Design, build and year-round care for gardens across Tacoma, Gig Harbor and University Place. Licensed, bonded and insured in Washington State.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"0.8rem","textTransform":"uppercase","letterSpacing":"0.1em"}}} -->
<p style="font-size:0.8rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Get in touch</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"color":{"text":"#c9d6dc"}}} -->
<p class="has-text-color" style="color:#c9d6dc"><?php echo esc_html($harbor_phone); ?><br>2817 N Proctor St, Tacoma, WA 98407<br>Mon–Fri 7am–5pm, Sat 8am–noon</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"0.8rem","textTransform":"uppercase","letterSpacing":"0.1em"}}} -->
<p style="font-size:0.8rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Services</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a style="color:#e7eef1" href="<?php echo esc_url(home_url('/services/')); ?>">Garden design</a><br><a style="color:#e7eef1" href="<?php echo esc_url(home_url('/services/')); ?>">Patios &amp; stonework</a><br><a style="color:#e7eef1" href="<?php echo esc_url(home_url('/services/')); ?>">Lawn &amp; garden care</a><br><a style="color:#e7eef1" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get a free quote</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.8rem"},"spacing":{"margin":{"top":"2.5rem"}},"color":{"text":"#9fb1b8"}}} -->
<p class="has-text-color" style="color:#9fb1b8;margin-top:2.5rem;font-size:0.8rem">© 2026 Harbor &amp; Pine Landscaping LLC · WA contractor lic. HARBOPL812QN · Harbor &amp; Pine is a fictional business, created to demonstrate Sarcio.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
