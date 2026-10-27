<?php
declare(strict_types=1);
require __DIR__ . '/../scripts/deploy/validate-response.php';

$theme = '<link rel="stylesheet" href="https://example.test/wp-content/themes/capucafe_wp_template/public/css/tailwind.css?ver=1">';
$cases = [
    'healthy theme' => [$theme . '<main>Capuccino Cafe</main>', true],
    // The original regression returned HTTP 200 and even served static CSS.
    'HTTP 200 with open_basedir warnings' => [$theme . 'Warning: file_exists(): open_basedir restriction in effect.', false],
    'HTML formatted PHP warning' => [$theme . '<b>Warning</b>: open_basedir restriction in effect.', false],
    'silent parent theme fallback' => ['<main>Storefront products</main>', false],
    'PHP fatal error' => [$theme . 'Fatal error: Uncaught Error: failed to load theme.', false],
];
foreach ($cases as $name => [$html, $expected]) {
    $actual = capucafe_deployment_response_errors($html) === [];
    if ($actual !== $expected) {
        fwrite(STDERR, "FAILED: $name\n");
        exit(1);
    }
    echo "PASS: $name\n";
}
