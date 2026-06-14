-- Buat database
CREATE DATABASE praktikum_crud;
USE praktikum_crud;
-- Tabel data mahasiswa
CREATE TABLE mahasiswa (
id INT AUTO_INCREMENT PRIMARY KEY,
nim VARCHAR(20) NOT NULL UNIQUE,
nama VARCHAR(100) NOT NULL,
jurusan VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
alamat TEXT,
foto VARCHAR(255) DEFAULT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Tabel pengguna untuk sistem login
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(100) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
full_name VARCHAR(100) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Insert akun admin default (password: admin123)
INSERT INTO users (username, email, password, full_name)
VALUES ('admin', 'admin@localhost.com',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'Administrator');
