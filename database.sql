CREATE DATABASE contact_manager;
USE contact_manager;

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- password: ChangeMe!2026
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$pwk8x3J4KPjkoYFmkS0usu0ShZAH1/kniAw39k5pypJHZK3Yy2QHW');
