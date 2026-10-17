<?php
/**
 * Plugin Name: Harbor & Pine Quote Requests
 * Description: The "Get a free quote" form ([harbor_quote_form]) and the inbox it fills under Quote requests.
 * Version: 1.4.0
 * Author: Harbor & Pine Landscaping
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

const HARBOR_QUOTE_SERVICES = [
    'design' => 'Garden design',
    'patio' => 'Patio or stonework',
    'firepit' => 'Fire pit or outdoor living',
    'care' => 'Lawn & garden care',
    'other' => 'Something else',
];

add_action('init', static function (): void {
    register_post_type('quote_request', [
        'label' => 'Quote requests',
        'labels' => ['singular_name' => 'Quote request'],
        'menu_icon' => 'dashicons-clipboard',
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'editor', 'custom-fields'],
    ]);
});

/**
 * Validate one request. Returns the cleaned fields, or an error message for
 * the visitor.
 *
 * @param array<string,mixed> $input
 * @return array{fields?:array<string,string>,error?:string}
 */
function harbor_validate_quote(array $input): array
{
    $field = static fn (string $name): string => trim(sanitize_text_field(wp_unslash((string) ($input[$name] ?? ''))));

    $fields = [
        'email' => sanitize_email($field('email')),
        'message' => trim(sanitize_textarea_field(wp_unslash((string) ($input['message'] ?? '')))),
        'name' => $field('name'),
        'phone' => $field('phone'),
        'service' => $field('service'),
        'zip' => $field('zip'),
    ];

    if ($fields['name'] === '') {
        return ['error' => 'Please tell us your name.'];
    }
    if (!is_email($fields['email'])) {
        return ['error' => 'Please enter a valid email address.'];
    }
    // 1.4: phone numbers are stored in the 10-digit format the dispatch app
    // expects. The site skips this check while a Sarcio fix says so.
    if (!(function_exists('sarcio_skips') && sarcio_skips('quote_phone_format'))
        && preg_match('/^\d{10}$/', $fields['phone']) !== 1) {
        return ['error' => 'Please enter a valid phone number.'];
    }
    if (!array_key_exists($fields['service'], HARBOR_QUOTE_SERVICES)) {
        return ['error' => 'Please choose the kind of project.'];
    }
    return ['fields' => $fields];
}

/** `POST admin-ajax.php?action=harbor_quote`: file the request in the inbox. */
function harbor_handle_quote(): void
{
    $result = harbor_validate_quote($_POST); // phpcs:ignore WordPress.Security.NonceVerification.Missing -- a public form, rate-limited by the host.
    if (isset($result['error'])) {
        wp_send_json(['error' => $result['error']], 400);
    }
    $fields = $result['fields'];
    wp_insert_post([
        'meta_input' => $fields,
        'post_content' => $fields['message'],
        'post_status' => 'private',
        'post_title' => sprintf('%s · %s', $fields['name'], HARBOR_QUOTE_SERVICES[$fields['service']]),
        'post_type' => 'quote_request',
    ]);
    wp_send_json(['ok' => true, 'message' => sprintf('Thanks, %s! We\'ll call you within one business day to book your free site visit.', strtok($fields['name'], ' '))], 201);
}
add_action('wp_ajax_harbor_quote', 'harbor_handle_quote');
add_action('wp_ajax_nopriv_harbor_quote', 'harbor_handle_quote');

add_shortcode('harbor_quote_form', static function (): string {
    $options = '';
    foreach (HARBOR_QUOTE_SERVICES as $value => $label) {
        $options .= sprintf('<option value="%s">%s</option>', esc_attr($value), esc_html($label));
    }
    ob_start();
    ?>
<form class="harbor-quote-form" id="harbor-quote-form" novalidate>
  <div class="row">
    <div class="field"><label for="hq-name">Your name</label><input id="hq-name" name="name" autocomplete="name" required></div>
    <div class="field"><label for="hq-phone">Phone</label><input id="hq-phone" name="phone" type="tel" autocomplete="tel" placeholder="(253) 555-0100" required></div>
  </div>
  <div class="row">
    <div class="field"><label for="hq-email">Email</label><input id="hq-email" name="email" type="email" autocomplete="email" required></div>
    <div class="field"><label for="hq-zip">ZIP code</label><input id="hq-zip" name="zip" autocomplete="postal-code" inputmode="numeric"></div>
  </div>
  <div class="field"><label for="hq-service">What can we help with?</label><select id="hq-service" name="service"><?php echo $options; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?></select></div>
  <div class="field"><label for="hq-message">Tell us about your yard</label><textarea id="hq-message" name="message" rows="5" placeholder="Size, slope, what you'd love to see out there…"></textarea></div>
  <button type="submit">Request my free quote</button>
  <div class="harbor-quote-result" id="harbor-quote-result" role="status" hidden></div>
</form>
<script>
  document.getElementById('harbor-quote-form').addEventListener('submit', async function (event) {
    event.preventDefault();
    var result = document.getElementById('harbor-quote-result');
    var data = new FormData(event.target);
    data.append('action', 'harbor_quote');
    result.hidden = false;
    result.className = 'harbor-quote-result';
    result.textContent = 'Sending…';
    var response = await fetch(<?php echo wp_json_encode(admin_url('admin-ajax.php')); ?>, { method: 'POST', body: data });
    var body = await response.json().catch(function () { return {}; });
    result.className = 'harbor-quote-result ' + (response.ok ? 'is-ok' : 'is-error');
    result.textContent = response.ok ? body.message : (body.error || 'Something went wrong. Please call us instead.');
    if (response.ok) { event.target.reset(); }
  });
</script>
    <?php
    return (string) ob_get_clean();
});
