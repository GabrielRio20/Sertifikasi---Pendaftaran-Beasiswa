CREATE DATABASE beasiswa_db;

USE beasiswa_db;

CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL DEFAULT 'mahasiswa',
    phone VARCHAR(15),
    ipk DECIMAL(3,2) NOT NULL
);

CREATE TABLE pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id INT NOT NULL,
    beasiswa VARCHAR(50) NOT NULL,
    berkas VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    semester VARCHAR(10), 
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) ON DELETE CASCADE
);
