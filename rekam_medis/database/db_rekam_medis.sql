CREATE DATABASE IF NOT EXISTS db_rekam_medis;
USE db_rekam_medis;

-- 1. Tabel Pasien
CREATE TABLE IF NOT EXISTS pasien (
    id_pasien INT AUTO_INCREMENT PRIMARY KEY,
    no_rm VARCHAR(20) NOT NULL,
    nama_pasien VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    tanggal_lahir DATE NOT NULL,
    alamat TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel Dokter
CREATE TABLE IF NOT EXISTS dokter (
    id_dokter INT AUTO_INCREMENT PRIMARY KEY,
    nama_dokter VARCHAR(100) NOT NULL,
    spesialisasi VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Obat
CREATE TABLE IF NOT EXISTS obat (
    id_obat INT AUTO_INCREMENT PRIMARY KEY,
    nama_obat VARCHAR(100) NOT NULL,
    satuan VARCHAR(30) NOT NULL,
    stok INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Rekam Medis
CREATE TABLE IF NOT EXISTS rekam_medis (
    id_rekam INT AUTO_INCREMENT PRIMARY KEY,
    id_pasien INT NOT NULL,
    id_dokter INT NOT NULL,
    id_obat INT NOT NULL,
    tanggal_periksa DATE NOT NULL,
    keluhan TEXT NOT NULL,
    diagnosa TEXT NOT NULL,
    tindakan TEXT NOT NULL,
    resep VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_pasien) REFERENCES pasien(id_pasien) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_dokter) REFERENCES dokter(id_dokter) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_obat) REFERENCES obat(id_obat) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data Dummy Pasien
INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat) VALUES
('RM-001', 'Ahmad Subagja', 'L', '1992-05-14', 'Jl. Merdeka No. 12, Tuban'),
('RM-002', 'Siti Rahmawati', 'P', '1998-08-22', 'Jl. Basuki Rahmat No. 45, Tuban'),
('RM-003', 'Budi Santoso', 'L', '1985-11-03', 'Jl. Veteran No. 8, Tuban');

-- Data Dummy Dokter
INSERT INTO dokter (nama_dokter, spesialisasi) VALUES
('dr. Andi Wijaya, Sp.PD', 'Spesialis Penyakit Dalam'),
('dr. Citra Lestari, Sp.A', 'Spesialis Anak');

-- Data Dummy Obat
INSERT INTO obat (nama_obat, satuan, stok) VALUES
('Paracetamol 500mg', 'Tablet', 100),
('Amoxicillin 500mg', 'Kapsul', 50),
('OBH Sirup 100ml', 'Botol', 30);

-- Data Dummy Rekam Medis
INSERT INTO rekam_medis (id_pasien, id_dokter, id_obat, tanggal_periksa, keluhan, diagnosa, tindakan, resep) VALUES
(1, 1, 1, '2026-03-01', 'Demam tinggi dan sakit kepala sejak 2 hari', 'Febris (Demam)', 'Pemeriksaan Fisik & Edukasi', 'Paracetamol 3x1 sehari sesudah makan'),
(2, 2, 3, '2026-03-02', 'Batuk berdahak dan tenggorokan gatal', 'ISPA', 'Pemeriksaan Tenggorokan', 'OBH Sirup 3x1 sendok makan');
