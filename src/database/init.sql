-- Criação da tabela de cursos
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Criação da tabela de slideshow
CREATE TABLE IF NOT EXISTS slideshow (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    button_text VARCHAR(50) NOT NULL,
    button_link VARCHAR(255) NOT NULL,
    order_position INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserção de dados iniciais para o slideshow
INSERT INTO slideshow (title, description, image_url, button_text, button_link, order_position) VALUES
('LOREM IPSUM', 'Aenean lacinia bibendum nulla sed consectetur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 'https://picsum.photos/1920/1080?random=1', 'VER CURSO', '#', 1),
('DOLOR SIT AMET', 'Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus.', 'https://picsum.photos/1920/1080?random=2', 'SAIBA MAIS', '#', 2),
('CONSECTETUR ELIT', 'Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.', 'https://picsum.photos/1920/1080?random=3', 'COMEÇAR', '#', 3);