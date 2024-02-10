<?php
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $response = ['message' => 'Hello, this is a simple API!'];
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
