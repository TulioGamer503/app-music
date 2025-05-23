<?php
class ApiController {
    private $songModel;

    public function __construct() {
        $this->songModel = new Song();
        header('Content-Type: application/json');
    }

    public function getSongs() {
        if (!isLoggedIn()) {
            http_response_code(401);
            echo json_encode(['error' => 'No autorizado']);
            return;
        }

        $songs = $this->songModel->getSongsByUser($_SESSION['user_id']);
        echo json_encode($songs);
    }

    public function addSong() {
        if (!isLoggedIn()) {
            http_response_code(401);
            echo json_encode(['error' => 'No autorizado']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        $result = $this->songModel->addSong([
            'user_id' => $_SESSION['user_id'],
            'title' => $data['title'],
            'artist' => $data['artist'],
            'album' => $data['album'] ?? null,
            'year' => $data['year'] ?? null,
            'link' => $data['link'] ?? null
        ]);

        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => 'Canción agregada']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al agregar canción']);
        }
    }
}