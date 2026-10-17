<?php
/**
 * Title: Harbor & Pine home
 * Slug: harbor-pine/home
 * Inserter: no
 */

defined('ABSPATH') || exit;

$harbor_image = static fn (string $file): string => esc_url(get_theme_file_uri('assets/images/' . $file));
$harbor_phone = get_theme_mod('header_phone', '{{phone}}');
$harbor_services = [
    ['Garden design', 'A planting plan drawn for your light, soil and the way you use the yard, with a 3D sketch before anything goes in the ground.', 'service-design.jpg'],
    ['Patios & stonework', 'Bluestone and basalt patios, dry-stack walls and steps that stay put through a Tacoma winter.', 'service-patio.jpg'],
    ['Fire pits & outdoor living', 'Gas and wood-burning fire pits, seat walls and low-voltage lighting for evenings outside.', 'service-firepit.jpg'],
    ['Lawn & garden care', 'Weekly or every-other-week visits: mowing, pruning, leaf clean-up and seasonal colour.', 'service-maintenance.jpg'],
];
?>
<!-- wp:cover {"url":"<?php echo $harbor_image('hero-garden.jpg'); ?>","dimRatio":50,"overlayColor":"contrast","minHeight":600,"isDark":true,"align":"full","style":{"spacing":{"padding":{"top":"7rem","bottom":"7rem"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-cover alignfull is-dark" style="padding-top:7rem;padding-bottom:7rem;min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-50 has-background-dim"></span><img class="wp-block-cover__image-background" alt="A terraced front garden with stone steps" src="<?php echo $harbor_image('hero-garden.jpg'); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
<!-- wp:paragraph {"textColor":"cedar","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.12em","fontSize":"0.85rem","fontWeight":"700"}}} -->
<p class="has-cedar-color has-text-color" style="font-size:0.85rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase">Tacoma · Gig Harbor · University Place</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"textColor":"base","style":{"typography":{"fontSize":"clamp(2.5rem, 5vw, 4.25rem)","lineHeight":"1.05"}}} -->
<h1 class="wp-block-heading has-base-color has-text-color" style="font-size:clamp(2.5rem, 5vw, 4.25rem);line-height:1.05">Gardens built for<br>Pacific Northwest living.</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"textColor":"base","style":{"typography":{"fontSize":"1.2rem"}}} -->
<p class="has-base-color has-text-color" style="font-size:1.2rem">Design, stonework and year-round care from a local crew that's been planting the South Sound for 18 years.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"backgroundColor":"cedar","textColor":"contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-cedar-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get a free quote</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
<!-- wp:paragraph {"textColor":"base","style":{"typography":{"fontWeight":"600"}}} -->
<p class="has-base-color has-text-color" style="font-weight:600">Or call us: <span class="harbor-phone"><?php echo esc_html($harbor_phone); ?></span></p>
<!-- /wp:paragraph -->
</div></div>
<!-- /wp:cover -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"4.5rem"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group" style="padding-top:4.5rem">
<!-- wp:heading -->
<h2 class="wp-block-heading">What we do</h2>
<!-- /wp:heading -->
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"1.5rem"}}}} -->
<div class="wp-block-columns">
<?php foreach ($harbor_services as [$harbor_title, $harbor_blurb, $harbor_file]) : ?>
<!-- wp:column {"className":"harbor-card"} -->
<div class="wp-block-column harbor-card">
<!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="<?php echo $harbor_image($harbor_file); ?>" alt="<?php echo esc_attr($harbor_title); ?>"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.2rem"}}} -->
<h3 class="wp-block-heading" style="font-size:1.2rem"><?php echo esc_html($harbor_title); ?></h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"textColor":"slate","style":{"typography":{"fontSize":"0.95rem"}}} -->
<p class="has-slate-color has-text-color" style="font-size:0.95rem"><?php echo esc_html($harbor_blurb); ?></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<?php endforeach; ?>
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"},"margin":{"top":"4rem"}}},"backgroundColor":"mist","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group has-mist-background-color has-background" style="margin-top:4rem;padding-top:4rem;padding-bottom:4rem">
<!-- wp:heading -->
<h2 class="wp-block-heading">How a project works</h2>
<!-- /wp:heading -->
<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3,"textColor":"pine","style":{"typography":{"fontSize":"1.1rem"}}} -->
<h3 class="wp-block-heading has-pine-color has-text-color" style="font-size:1.1rem">1. Free site visit</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Tell us about your yard and we'll come out within a week to walk it with you, measure up and talk budget.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3,"textColor":"pine","style":{"typography":{"fontSize":"1.1rem"}}} -->
<h3 class="wp-block-heading has-pine-color has-text-color" style="font-size:1.1rem">2. Design &amp; fixed quote</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>You get a drawn plan and one fixed price. No surprises once the digging starts.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3,"textColor":"pine","style":{"typography":{"fontSize":"1.1rem"}}} -->
<h3 class="wp-block-heading has-pine-color has-text-color" style="font-size:1.1rem">3. Build &amp; care</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Our own crew builds it, cleans up every evening, and can keep it looking its best season after season.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"4.5rem"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group" style="padding-top:4.5rem">
<!-- wp:media-text {"mediaType":"image","mediaWidth":46,"style":{"border":{"radius":"14px"}}} -->
<div class="wp-block-media-text is-stacked-on-mobile" style="border-radius:14px;grid-template-columns:46% auto"><figure class="wp-block-media-text__media"><img src="<?php echo $harbor_image('work-patio.jpg'); ?>" alt="A finished patio with lounge chairs and stepping stones"/></figure><div class="wp-block-media-text__content">
<!-- wp:paragraph {"textColor":"pine","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontSize":"0.8rem","fontWeight":"700"}}} -->
<p class="has-pine-color has-text-color" style="font-size:0.8rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Recent project · North End, Tacoma</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.35rem","lineHeight":"1.45"}},"fontFamily":"roboto-slab"} -->
<p class="has-roboto-slab-font-family" style="font-size:1.35rem;line-height:1.45">“They turned a muddy slope into the part of the house we use most. The crew was on time every day and the price never moved.”</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"textColor":"slate"} -->
<p class="has-slate-color has-text-color">Renee &amp; Marcus O., patio, lighting and planting</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url(home_url('/our-work/')); ?>">See more of our work</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div></div>
<!-- /wp:media-text -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"},"margin":{"top":"4.5rem"}},"border":{"radius":"16px"}},"backgroundColor":"pine","textColor":"base","layout":{"type":"constrained","contentSize":"1100px"}} -->
<div class="wp-block-group has-base-color has-pine-background-color has-text-color has-background" style="border-radius:16px;margin-top:4.5rem;padding:3rem 2rem">
<!-- wp:heading {"textAlign":"center","textColor":"base"} -->
<h2 class="wp-block-heading has-text-align-center has-base-color has-text-color">Booking spring projects now</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Tell us about your yard and we'll set up a free site visit within a week.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
<!-- wp:button {"backgroundColor":"cedar","textColor":"contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-cedar-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url(home_url('/get-a-quote/')); ?>">Get a free quote</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
