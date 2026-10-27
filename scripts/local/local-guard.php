<?php
/**
 * Plugin Name: Capucafe — local development guard
 * Description: Installed only in the local WordPress copy by scripts/local/setup.sh.
 */
if (!defined('ABSPATH')) {
    exit;
}
add_filter('pre_wp_mail', '__return_true');
add_filter('pre_option_cron', '__return_empty_array');
add_filter('woocommerce_available_payment_gateways', '__return_empty_array', PHP_INT_MAX);
add_filter('pre_http_request', function ($preempt, $args, $url) {
    $host = wp_parse_url($url, PHP_URL_HOST);
    if (in_array($host, ['localhost', '127.0.0.1', '::1'], true) || ($host && str_ends_with($host, '.local'))) {
        return $preempt;
    }
    return new WP_Error('capucafe_local_http_blocked', 'External HTTP calls are disabled in this local copy.');
}, PHP_INT_MAX, 3);
add_filter('woocommerce_webhook_should_deliver', '__return_false', PHP_INT_MAX);
add_action('admin_notices', function () {
    echo '<div class="notice notice-info"><p>Capuccino Dev: e-mail, cron, webhooks, payments and external HTTP requests are disabled.</p></div>';
});
