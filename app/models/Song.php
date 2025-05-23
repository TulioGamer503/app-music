<?php
class Song {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getSongsByUser($userId) {
        $this->db->query('SELECT * FROM songs WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function addSong($data) {
        $this->db->query('INSERT INTO songs (user_id, title, artist, album, year, link) VALUES (:user_id, :title, :artist, :album, :year, :link)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':artist', $data['artist']);
        $this->db->bind(':album', $data['album']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':link', $data['link']);

        return $this->db->execute();
    }

    public function updateSong($data) {
        $this->db->query('UPDATE songs SET title = :title, artist = :artist, album = :album, year = :year, link = :link WHERE id = :id AND user_id = :user_id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':artist', $data['artist']);
        $this->db->bind(':album', $data['album']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':link', $data['link']);

        return $this->db->execute();
    }

    public function deleteSong($id, $userId) {
        $this->db->query('DELETE FROM songs WHERE id = :id AND user_id = :user_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
}