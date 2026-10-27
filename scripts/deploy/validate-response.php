<?php
declare(strict_types=1);

// Deployment CLI only; never expose a diagnostic endpoint through the theme.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

function capucafe_deployment_response_errors(string $html): array
{
    $errors = [];
    if (preg_match('/open_basedir\s+restriction|Fatal\s+error|Uncaught\s+(?:Error|Exception)|Failed\s+opening\s+required|There has been a critical error|W witrynie wystąpił krytyczny błąd/i', $html)) {
        $errors[] = 'The response contains a PHP access restriction or fatal error.';
    }
    if (strpos($html, '/wp-content/themes/capucafe_wp_template/public/css/tailwind.css') === false) {
        $errors[] = 'The response is missing the custom theme stylesheet; WordPress may have fallen back to Storefront.';
    }
    return $errors;
}

if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    $path = $argv[1] ?? '';
    if (!is_file($path) || !is_readable($path)) {
        fwrite(STDERR, "Expected a readable saved HTTP response.\n");
        exit(2);
    }
    $errors = capucafe_deployment_response_errors((string) file_get_contents($path));
    if ($errors) {
        fwrite(STDERR, implode("\n", $errors) . "\n");
        exit(1);
    }
    echo "Custom theme response verified.\n";
}
