<?php

declare(strict_types=1);

/**
 * Harbor & Pine theme setup. A child of Twenty Twenty-Five; this theme adds the
 * company's colours, type, header, footer and front page.
 */

defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', static function (): void {
    wp_enqueue_style('harbor-pine', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));
});

// Pages are written at build time (provision.php) with %home_url% and
// %theme_uri% in their links; resolve them for the host this request came in on.
add_filter('the_content', static fn (string $content): string => strtr($content, [
    '%home_url%' => untrailingslashit(home_url()),
    '%theme_uri%' => get_stylesheet_directory_uri(),
]), 1);

// The front page's canonical address is the bare base (`/harbor-pine`, which is
// what WP_HOME holds), but WordPress' canonical redirect always trailing-slashes
// the front page, and the router 301s the slashed form back, so the two would
// loop. Drop that slash from a front-page redirect (so `/harbor-pine/index.php`
// lands on `/harbor-pine` in one hop), and skip the redirect entirely when the
// slash was all it would change. A site served at the host root keeps its `/`.
add_filter('redirect_canonical', static function ($redirect, $requested) {
    if (!is_string($redirect) || !is_front_page()) {
        return $redirect;
    }
    [$url, $query] = array_pad(explode('?', $redirect, 2), 2, null);
    if (trim((string) wp_parse_url($url, PHP_URL_PATH), '/') !== '') {
        $redirect = untrailingslashit($url) . ($query === null ? '' : '?' . $query);
    }
    return $redirect === $requested ? false : $redirect;
}, 10, 2);
