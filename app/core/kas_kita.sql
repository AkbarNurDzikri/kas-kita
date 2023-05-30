CREATE DATABASE `kas-kita`;

CREATE TABLE `anggaran`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `periode` DATE NOT NULL,
  `kategori` ENUM('Gaji', 'Hutang', 'Sandang', 'Pangan', 'Papan', 'Pendidikan', 'Transportasi', 'Komunikasi', 'Jajan', 'Kebutuhan Bulanan', 'Lainnya') NOT NULL,
  `keterangan` VARCHAR(255) NOT NULL,
  `rupiah` INT NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL
);

CREATE TABLE `kas_kita`(
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `tanggal` DATE NOT NULL,
  `kategori` ENUM('Gaji', 'Hutang', 'Sandang', 'Pangan', 'Papan', 'Pendidikan', 'Transportasi', 'Komunikasi', 'Jajan', 'Kebutuhan Bulanan', 'Lainnya') NOT NULL,
  `keterangan` VARCHAR(255) NOT NULL,
  `pemasukan` INT NULL,
  `pengeluaran` INT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL
);