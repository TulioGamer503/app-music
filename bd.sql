-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS music_app;
USE music_app;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de canciones
CREATE TABLE IF NOT EXISTS songs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    album VARCHAR(255),
    year INT,
    link VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CHECK (year >= 1900 AND year <= YEAR(CURRENT_DATE) + 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Índices para mejorar el rendimiento
CREATE INDEX idx_songs_user ON songs(user_id);
CREATE INDEX idx_songs_artist ON songs(artist);
CREATE INDEX idx_songs_album ON songs(album);

-- Datos iniciales de prueba (opcional)
INSERT INTO users (name, email, password) VALUES 
('Usuario Demo', 'demo@musicapp.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- password: password
('Artista Ejemplo', 'artista@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO songs (user_id, title, artist, album, year, link) VALUES
(1, 'Bohemian Rhapsody', 'Queen', 'A Night at the Opera', 1975, 'https://youtu.be/fJ9rUzIMcZQ'),
(1, 'Imagine', 'John Lennon', 'Imagine', 1971, 'https://youtu.be/DVg2EJvvlF8'),
(2, 'Blinding Lights', 'The Weeknd', 'After Hours', 2020, 'https://youtu.be/4NRXx6U8ABQ'),
(2, 'Shape of You', 'Ed Sheeran', '÷', 2017, 'https://youtu.be/JGwWNGJdvx8');