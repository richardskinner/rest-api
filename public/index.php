<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Framework\Core\Framework;

try {
    Framework::run();
} catch (Exception $exception) {
    $code = $exception->getCode() ? $exception->getCode() : 500;
    http_response_code($code);
    echo json_encode([
        'code' => $code,
        'message' => $exception->getMessage()
    ]);
    exit;
}
