CREATE DATABASE IF NOT EXISTS suivi_cv;
USE suivi_cv;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    password VARCHAR(255)
);

INSERT INTO admin (username,password) VALUES ('admin', MD5('1234'));

CREATE TABLE candidats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150),
    telephone VARCHAR(20),
    poste VARCHAR(100),
    cv VARCHAR(255),
    lettre VARCHAR(255),
    statut VARCHAR(50) DEFAULT 'Reçu',
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);