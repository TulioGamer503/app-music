<?php
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../app/models/Database.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/SongController.php';

session_name(SESSION_NAME);
session_start();

function view($path, $data = []) {
    extract($data);
    require __DIR__ . "/../app/views/{$path}.php";
}

function redirect($url) {
    header("Location: /{$url}");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case '/':
        redirect(isLoggedIn() ? 'songs' : 'login');
        break;
        
    case '/login':
        $authController = new AuthController();
        $method === 'POST' ? $authController->login() : view('auth/login');
        break;
        
    case '/register':
        $authController = new AuthController();
        $method === 'POST' ? $authController->register() : view('auth/register');
        break;
        
    case '/logout':
        (new AuthController())->logout();
        break;
        
    case '/songs':
        $songController = new SongController();
        $songController->index();
        break;
        
    case '/songs/create':
        $songController = new SongController();
        $method === 'POST' ? $songController->create() : view('songs/create');
        break;
        
    case (preg_match('/^\/songs\/edit\/(\d+)$/', $request, $matches) ? true : false):
        $songController = new SongController();
        $songController->edit($matches[1]);
        break;
        
    case (preg_match('/^\/songs\/delete\/(\d+)$/', $request, $matches) ? true : false):
        $songController = new SongController();
        $songController->delete($matches[1]);
        break;
        
    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}