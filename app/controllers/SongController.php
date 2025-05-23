<?php
class SongController {
    private $songModel;

    public function __construct() {
        $this->songModel = new Song();
    }

    public function index() {
        if (!isLoggedIn()) {
            redirect('login');
        }

        $songs = $this->songModel->getSongsByUser($_SESSION['user_id']);
        view('songs/index', ['songs' => $songs]);
    }

    public function create() {
        if (!isLoggedIn()) {
            redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'artist' => trim($_POST['artist']),
                'album' => trim($_POST['album']),
                'year' => trim($_POST['year']),
                'link' => trim($_POST['link'])
            ];

            if ($this->songModel->addSong($data)) {
                redirect('songs');
            } else {
                die('Error al agregar canción');
            }
        } else {
            view('songs/create');
        }
    }

    public function edit($id) {
        if (!isLoggedIn()) {
            redirect('login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'artist' => trim($_POST['artist']),
                'album' => trim($_POST['album']),
                'year' => trim($_POST['year']),
                'link' => trim($_POST['link'])
            ];

            if ($this->songModel->updateSong($data)) {
                redirect('songs');
            } else {
                die('Error al actualizar canción');
            }
        } else {
            $song = $this->songModel->getSongById($id);
            if ($song && $song->user_id == $_SESSION['user_id']) {
                view('songs/edit', ['song' => $song]);
            } else {
                redirect('songs');
            }
        }
    }

    public function delete($id) {
        if (!isLoggedIn()) {
            redirect('login');
        }

        if ($this->songModel->deleteSong($id, $_SESSION['user_id'])) {
            redirect('songs');
        } else {
            die('Error al eliminar canción');
        }
    }
}