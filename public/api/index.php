<?php
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/../../app/models/Database.php';
require_once __DIR__ . '/../../app/models/Song.php';
require_once __DIR__ . '/../../app/controllers/ApiController.php';

session_name(SESSION_NAME . '_API');
session_start();

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$apiBase = '/api';

$endpoint = str_replace($apiBase, '', $requestUri);

$apiController = new ApiController();

switch ($endpoint) {
    case '/songs':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $apiController->getSongs();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $apiController->addSong();
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Método no permitido']);
        }
        break;
        
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint no encontrado']);
        break;
}