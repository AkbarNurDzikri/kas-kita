CREATE DATABASE `recycle`;

CREATE TABLE `users`(
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255) NOT NULL,
  `fullname` VARCHAR(255) NOT NULL,
  `ibu_kandung` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `is_active` INT(1) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME DEFAULT NULL
);

CREATE TABLE `reports`(
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `tanggal` DATE NOT NULL,
  `shift` INT NOT NULL,
  `operator1` VARCHAR(255),
  `operator2` VARCHAR(255),
  `temp_extru1` INT NOT NULL,
  `temp_filterzone1` INT NOT NULL,
  `temp_die1` INT NOT NULL,
  `temp_extru2` INT NOT NULL,
  `temp_filterzone2` INT NOT NULL,
  `temp_die2` INT NOT NULL,
  `temp_extru3` INT,
  `temp_extru4` INT,
  `rpm_rollfeeder` INT NOT NULL,
  `rpm_screw` INT NOT NULL,
  `rpm_pelletizer` INT NOT NULL,
  `machine` ENUM('Plasmac', 'YEI'),
  `output` INT NOT NULL,
  `waste_awal` DECIMAL(6,2) NOT NULL,
  `created_by` INT NOT NULL,
  `updated_by` INT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,

  FOREIGN KEY(`created_by`) REFERENCES users(`id`),
  FOREIGN KEY(`updated_by`) REFERENCES users(`id`)
);

CREATE TABLE `report_details`(
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `report_id` INT NOT NULL,
  `time_start` TIME NOT NULL,
  `time_finish` TIME NOT NULL,
  `bm1_material_specs` VARCHAR(255),
  `bm1_material_qty` DECIMAL(6,2),
  `bm2_material_specs` VARCHAR(255),
  `bm2_material_qty` DECIMAL(6,2),
  `other_material_specs` VARCHAR(255),
  `other_material_type` ENUM('Trim', 'Roll', 'Sesetan'),
  `other_material_category` ENUM('Clear', 'White', 'Zak Resin', 'Reject'),
  `other_material_qty` DECIMAL(6,2),
  `product_type` ENUM('Clear', 'White', 'Noblen', 'Purging') NOT NULL,
  `product_qty` DECIMAL(6,2) NOT NULL,
  `waste_type` ENUM('Powder', 'Frozen'),
  `waste_qty` DECIMAL(6,2) NULL,
  `remarks` TEXT NULL,
  `created_by` INT NOT NULL,
  `updated_by` INT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,

  FOREIGN KEY(`report_id`) REFERENCES reports(`id`),
  FOREIGN KEY(`created_by`) REFERENCES users(`id`),
  FOREIGN KEY(`updated_by`) REFERENCES users(`id`)
);