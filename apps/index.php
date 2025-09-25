<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_URI'] == '/health-check') {
    echo json_encode(['status' => 'healthy']);
    exit;
}

echo json_encode([
    'message' => 'PHP Application is running!',
    'version' => PHP_VERSION,
    'server' => $_SERVER['SERVER_NAME'],
    'timestamp' => date('Y-m-d H:i:s')
]);
