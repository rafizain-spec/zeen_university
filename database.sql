CREATE DATABASE IF NOT EXISTS db_zain_university;
USE db_zain_university;

-- 1. Tabel user
CREATE TABLE user (
  id_user INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(10) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama VARCHAR(100) NOT NULL,
  role ENUM('admin', 'dosen', 'mahasiswa') NOT NULL
);

-- 2. Tabel mahasiswa
CREATE TABLE mahasiswa (
  nim CHAR(10) PRIMARY KEY,
  nama_lengkap VARCHAR(100) NOT NULL,
  jurusan VARCHAR(50) NOT NULL
);

-- 3. Tabel dosen
CREATE TABLE dosen (
  nid CHAR(5) PRIMARY KEY,
  nama_lengkap VARCHAR(100) NOT NULL
);

-- 4. Tabel matakuliah
CREATE TABLE matakuliah (
  kode_mk CHAR(5) PRIMARY KEY,
  nama_mk VARCHAR(100) NOT NULL,
  sks INT(1) NOT NULL
);

-- 5. Tabel jadwal
CREATE TABLE jadwal (
  id_jadwal INT(11) AUTO_INCREMENT PRIMARY KEY,
  kode_mk CHAR(5) NOT NULL,
  hari ENUM('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu') NOT NULL,
  jam_mulai TIME NOT NULL,
  jam_selesai TIME NOT NULL,
  ruangan CHAR(5) NOT NULL,
  nid CHAR(5) NOT NULL,
  FOREIGN KEY (kode_mk) REFERENCES matakuliah(kode_mk) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (nid) REFERENCES dosen(nid) ON DELETE CASCADE ON UPDATE CASCADE
);

-- 6. Tabel krs
CREATE TABLE krs (
  id_krs INT(11) AUTO_INCREMENT PRIMARY KEY,
  nim CHAR(10) NOT NULL,
  id_jadwal INT(11) NOT NULL,
  pertemuan1 TIME NULL,
  pertemuan2 TIME NULL,
  pertemuan3 TIME NULL,
  pertemuan4 TIME NULL,
  pertemuan5 TIME NULL,
  nilai_tm INT(3) NULL,
  nilai_uts INT(3) NULL,
  nilai_uas INT(3) NULL,
  nilai_akhir DECIMAL(5,2) NULL,
  grade CHAR(1) NULL,
  FOREIGN KEY (nim) REFERENCES mahasiswa(nim) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_jadwal) REFERENCES jadwal(id_jadwal) ON DELETE CASCADE ON UPDATE CASCADE
);

-- DATA CONTOH (Password semua akun: 123456)
INSERT INTO user (username, password, nama, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Kampus', 'admin'),
('D0001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dr. Budi Santoso, M.Kom', 'dosen'),
('2026010001', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rafi Zain Vernando', 'mahasiswa');

INSERT INTO dosen (nid, nama_lengkap) VALUES
('D0001', 'Dr. Budi Santoso, M.Kom'),
('D0002', 'Siti Aminah, S.E., M.Ak');

INSERT INTO mahasiswa (nim, nama_lengkap, jurusan) VALUES
('2026010001', 'Rafi Zain Vernando', 'Rekayasa Teknologi');

INSERT INTO matakuliah (kode_mk, nama_mk, sks) VALUES
('MK001', 'Pemrograman Web Lanjut', 3),
('MK002', 'Arsitektur Sistem', 3);

INSERT INTO jadwal (kode_mk, hari, jam_mulai, jam_selesai, ruangan, nid) VALUES
('MK001', 'Senin', '08:00:00', '10:30:00', 'R-301', 'D0001'),
('MK002', 'Rabu', '13:00:00', '15:30:00', 'R-204', 'D0001');

INSERT INTO krs (nim, id_jadwal, nilai_tm, nilai_uts, nilai_uas, nilai_akhir, grade) VALUES
('2026010001', 1, 88, 85, 90, 87.80, 'A'),
('2026010001', 2, 80, 82, NULL, NULL, NULL);