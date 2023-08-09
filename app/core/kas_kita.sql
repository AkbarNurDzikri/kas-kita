CREATE DATABASE `kas_kita`;

CREATE TABLE `anggaran`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `periode` DATE NOT NULL,
  `kategori` ENUM('Gaji', 'Hutang', 'Sandang', 'Pangan', 'Papan', 'Pendidikan', 'Transportasi', 'Komunikasi', 'Jajan', 'Kebutuhan Bulanan', 'Kesehatan', 'Lainnya') NOT NULL,
  `keterangan` VARCHAR(255) NOT NULL,
  `rupiah` INT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL
);

CREATE TABLE `kas_kita`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `tanggal` DATE NOT NULL,
  `kategori` ENUM('Gaji', 'Hutang', 'Sandang', 'Pangan', 'Papan', 'Pendidikan', 'Transportasi', 'Komunikasi', 'Jajan', 'Kebutuhan Bulanan', 'Kesehatan', 'Lainnya') NOT NULL,
  `keterangan` VARCHAR(255) NOT NULL,
  `pemasukan` INT NULL,
  `pengeluaran` INT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL
);

CREATE TABLE `users`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255),
  `email` VARCHAR(255),
  `password` VARCHAR(255),
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME DEFAULT NULL
);

CREATE TABLE `categories` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `nama_kategori`VARCHAR(255),
  `jenis_kategori` ENUM('Pemasukan', 'Pengeluaran'),
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME DEFAULT NULL,

  FOREIGN KEY (user_id) REFERENCES users(id)
);