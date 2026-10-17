<?php
// Router for PHP's built-in web server (used by start.sh on the host).
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '');
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false; // serve css/js/images directly
}
require_once __DIR__ . '/public/index.php';
