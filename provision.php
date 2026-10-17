<?php

declare(strict_types=1);

/**
 * Write Harbor & Pine's site: the business details, the services, work, about
 * and quote pages. Run by setup.php after the install, in a process of its own
 * so WordPress loads the way it does on a normal request.
 *
 *   php provision.php --dir=/var/www/wp
 *
 * Idempotent: a site already written at this version is left alone.
 */

const HARBOR_SITE_VERSION = '2026.10.1';

$opts = getopt('', ['dir:']);
$dir = rtrim((string) ($opts['dir'] ?? ''), '/');
if ($dir === '' || !is_file($dir . '/wp-load.php')) {
    fwrite(STDERR, "[provision] error: --dir must point at the install\n");
    exit(1);
}

$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_HOST'] ?? 'localhost';
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['REQUEST_METHOD'] = 'GET';
define('WP_USE_THEMES', false);
require_once $dir . '/wp-load.php';

function say(string $message): void
{
    fwrite(STDERR, "[provision] $message\n");
}

if (get_option('harbor_site_version') === HARBOR_SITE_VERSION) {
    say('site already written');
    exit(0);
}

say('business details');
update_option('blogname', 'Harbor & Pine Landscaping');
update_option('blogdescription', 'Garden design, stonework and care in Tacoma, WA');
update_option('harbor_business_phone', '(253) 555-0142');

// Page content is written once, at build time, but served under whatever host
// and base path the container runs at, so links carry tokens the theme swaps
// for the live addresses (see functions.php).
$image = static fn (string $file): string => '%theme_uri%/assets/images/' . $file;
$quote = '%home_url%/get-a-quote/';

$pages = [
    'services' => ['Services', <<<HTML
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.15rem"}}} -->
    <p style="font-size:1.15rem">From a single planting bed to a whole new back yard, every project is designed and built by our own crew. No subcontractors, one point of contact from first visit to final walk-through.</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":3} -->
    <h3 class="wp-block-heading">Garden design</h3>
    <!-- /wp:heading -->
    <!-- wp:paragraph -->
    <p>Planting plans drawn for your light, soil and drainage, using natives and Northwest-hardy perennials that look after themselves. Design fees are credited back when we build the plan.</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":3} -->
    <h3 class="wp-block-heading">Patios &amp; stonework</h3>
    <!-- /wp:heading -->
    <!-- wp:paragraph -->
    <p>Bluestone, basalt and permeable pavers on a compacted base built for our wet winters. Dry-stack walls, steps and edging.</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":3} -->
    <h3 class="wp-block-heading">Fire pits &amp; outdoor living</h3>
    <!-- /wp:heading -->
    <!-- wp:paragraph -->
    <p>Gas and wood-burning fire pits, seat walls, pergolas and low-voltage lighting.</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":3} -->
    <h3 class="wp-block-heading">Lawn &amp; garden care</h3>
    <!-- /wp:heading -->
    <!-- wp:paragraph -->
    <p>Weekly or every-other-week visits from March to November, with winter clean-ups in between. Plans start at \$145 a month.</p>
    <!-- /wp:paragraph -->
    <!-- wp:buttons -->
    <div class="wp-block-buttons"><!-- wp:button -->
    <div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="{$quote}">Get a free quote</a></div>
    <!-- /wp:button --></div>
    <!-- /wp:buttons -->
    HTML],
    'our-work' => ['Our work', <<<HTML
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.15rem"}}} -->
    <p style="font-size:1.15rem">A few recent projects from around the South Sound.</p>
    <!-- /wp:paragraph -->
    <!-- wp:columns -->
    <div class="wp-block-columns"><!-- wp:column -->
    <div class="wp-block-column"><!-- wp:image {"className":"harbor-card"} -->
    <figure class="wp-block-image harbor-card"><img src="{$image('work-patio.jpg')}" alt="Patio with lounge chairs"/><figcaption class="wp-element-caption">North End, Tacoma · patio, lighting and planting</figcaption></figure>
    <!-- /wp:image --></div>
    <!-- /wp:column -->
    <!-- wp:column -->
    <div class="wp-block-column"><!-- wp:image {"className":"harbor-card"} -->
    <figure class="wp-block-image harbor-card"><img src="{$image('work-path.jpg')}" alt="A garden path through planting"/><figcaption class="wp-element-caption">Gig Harbor · woodland path and native planting</figcaption></figure>
    <!-- /wp:image --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns -->
    <!-- wp:columns -->
    <div class="wp-block-columns"><!-- wp:column -->
    <div class="wp-block-column"><!-- wp:image {"className":"harbor-card"} -->
    <figure class="wp-block-image harbor-card"><img src="{$image('service-patio.jpg')}" alt="A circular stone patio"/><figcaption class="wp-element-caption">University Place · basalt patio and seat wall</figcaption></figure>
    <!-- /wp:image --></div>
    <!-- /wp:column -->
    <!-- wp:column -->
    <div class="wp-block-column"><!-- wp:image {"className":"harbor-card"} -->
    <figure class="wp-block-image harbor-card"><img src="{$image('service-firepit.jpg')}" alt="A stone fire pit"/><figcaption class="wp-element-caption">Fircrest · wood-burning fire pit</figcaption></figure>
    <!-- /wp:image --></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns -->
    HTML],
    'about' => ['About us', <<<HTML
    <!-- wp:media-text {"mediaType":"image","mediaWidth":44} -->
    <div class="wp-block-media-text is-stacked-on-mobile" style="grid-template-columns:44% auto"><figure class="wp-block-media-text__media"><img src="{$image('about-crew.jpg')}" alt="One of our crew trimming a front garden"/></figure><div class="wp-block-media-text__content"><!-- wp:paragraph -->
    <p>Dana Okafor started Harbor &amp; Pine in 2008 with one truck and a lot of Tacoma clay. Today we're a crew of fourteen gardeners, stonemasons and designers, still based on North Proctor Street.</p>
    <!-- /wp:paragraph -->
    <!-- wp:paragraph -->
    <p>We're licensed, bonded and insured in Washington, and every lead on site has at least five years with us.</p>
    <!-- /wp:paragraph --></div></div>
    <!-- /wp:media-text -->
    HTML],
    'get-a-quote' => ['Get a free quote', <<<'HTML'
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"1.15rem"}}} -->
    <p style="font-size:1.15rem">Tell us a little about your yard and we'll call you within one business day to book a free site visit.</p>
    <!-- /wp:paragraph -->
    <!-- wp:shortcode -->
    [harbor_quote_form]
    <!-- /wp:shortcode -->
    HTML],
];

say('pages');
foreach ($pages as $slug => [$title, $content]) {
    $existing = get_page_by_path($slug);
    $post = ['post_content' => preg_replace('/^    /m', '', $content), 'post_name' => $slug, 'post_status' => 'publish', 'post_title' => $title, 'post_type' => 'page'];
    if ($existing) {
        $post['ID'] = $existing->ID;
        wp_update_post($post);
    } else {
        wp_insert_post($post);
    }
}

foreach (['hello-world' => 'post', 'sample-page' => 'page'] as $slug => $type) {
    $post = get_page_by_path($slug, OBJECT, $type);
    if ($post) {
        wp_delete_post($post->ID, true);
    }
}

flush_rewrite_rules(true);
update_option('harbor_site_version', HARBOR_SITE_VERSION);
say('site written');
