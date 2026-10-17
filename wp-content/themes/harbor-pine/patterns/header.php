<?php
/**
 * Title: Harbor & Pine header
 * Slug: harbor-pine/header
 * Inserter: no
 */

defined('ABSPATH') || exit;

// The header's call-to-action number. Since theme 3.0 the company's details live
// in the `harbor_business_phone` option (Settings → Business details); this still
// reads the 2.x `header_phone` theme mod, which the 3.0 update removed, so it
// falls back to the placeholder.
$harbor_phone = get_theme_mod('header_phone', '{{phone}}');

$harbor_links = [
    'Services' => home_url('/services/'),
    'Our work' => home_url('/our-work/'),
    'About' => home_url('/about/'),
];
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.1rem","bottom":"1.1rem"}}},"backgroundColor":"base","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group has-base-background-color has-background" style="padding-top:1.1rem;padding-bottom:1.1rem">
<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.45rem","fontWeight":"700","lineHeight":"1"}},"fontFamily":"roboto-slab","textColor":"harbor"} -->
<p class="has-harbor-color has-text-color has-roboto-slab-font-family" style="font-size:1.45rem;font-weight:700;line-height:1"><a href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration:none;color:inherit">Harbor <span style="color:var(--wp--preset--color--pine)">&amp;</span> Pine</a></p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"1.75rem"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group">
<?php foreach ($harbor_links as $harbor_label => $harbor_url) : ?>
<!-- wp:paragraph {"style":{"typography":{"fontWeight":"600","fontSize":"0.95rem"}}} -->
<p style="font-size:0.95rem;font-weight:600"><a href="<?php echo esc_url($harbor_url); ?>" style="text-decoration:none;color:var(--wp--preset--color--contrast)"><?php echo esc_html($harbor_label); ?></a></p>
<!-- /wp:paragraph -->
<?php endforeach; ?>
<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700","fontSize":"0.95rem"}},"textColor":"harbor"} -->
<p class="has-harbor-color has-text-color" style="font-size:0.95rem;font-weight:700">Call <span class="harbor-phone"><?php echo esc_html($harbor_phone); ?></span></p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get a free quote</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
