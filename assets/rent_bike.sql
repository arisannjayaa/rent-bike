/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `alternatif` (
  `id` int NOT NULL AUTO_INCREMENT,
  `merk` varchar(200) NOT NULL,
  `tipe` varchar(200) NOT NULL,
  `nopol` varchar(200) NOT NULL,
  `rental` varchar(200) NOT NULL,
  `telp` varchar(200) NOT NULL,
  `warna` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `kriteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `alternatif` (`id`, `merk`, `tipe`, `nopol`, `rental`, `telp`, `warna`) VALUES
(7, 'Honda', 'ADV155', 'DK 0001 AA', 'Tegal Gundul Rental', '08970274762', 'hijau');
INSERT INTO `alternatif` (`id`, `merk`, `tipe`, `nopol`, `rental`, `telp`, `warna`) VALUES
(11, 'kawasaki', 'ninja', 'dk 1234 dk', 'canggu rental', '0987345', 'merah');
INSERT INTO `alternatif` (`id`, `merk`, `tipe`, `nopol`, `rental`, `telp`, `warna`) VALUES
(12, 'ds', 'dsd', 'dsd', 'dsd', 'dsds', 'dsd');

INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(8, 'C1', 'Harga Sewa', 'Cost', '1');
INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(9, 'C2', 'Tahun Produksi Motor', 'Benefit', '3');
INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(10, 'C3', 'Kekuatan Mesin', 'Benefit', '6');
INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(11, 'C4', 'Konsumsi Bahan Bakar', 'Benefit', '39');

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`) VALUES
(1, 'alicia', 'aliciabigo16@gmail.com', 'default.jpg', '$2y$10$MH7uZbcaEWz7E6YJccaT3O/Lz1dk2sCSCNj19oDfZAzXTxk0eNELy', 2);
INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`) VALUES
(2, 'gilang', 'gilang@gmail.com', 'default.jpg', '$2y$10$awEuyYN/ZR00/mg/9PqKK.tE5YYnsH6aDiKqChfX8PuIwvQE3cJyS', 2);
INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`) VALUES
(3, 'wahyu', 'wahyudigilang83@gmail.com', 'default.jpg', '$2y$10$Sj.mO6Q1ualyg/0IS4axP.Rhz24i47pH06/Iz2y0oZDEGTQEBEB2W', 2);
INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`) VALUES
(4, 'bebek', 'bebek@gmail.com', 'default.jpg', '$2y$10$lDsh8jCfclRryap/utPRpege9S6DcXY6NQd7MB4A3rVoUXicuXbPm', 2),
(5, 'ayam', 'ayam@gmail.com', 'default.jpg', '$2y$10$6.NGFm8qOCKERgDobmHL7ubDCcLkbPVVUe6QCG5RM9WIbW.Af6iBa', 2),
(6, 'kuda', 'kuda@gmail.com', 'default.jpg', '$2y$10$L.eavgrD56k4E45tjjm5mOskbBwgwvAQ0gxQoWxyUjXoRQbEoNjs6', 2),
(7, 'aaa', 'aaa@gmail.com', 'default.jpg', '$2y$10$1sgdNKDfdUTwfZpnteBKluRILrXR7QR4LLOX3XcHX5n4aAvKBzAuq', 2),
(8, 'bbb', 'bbb@gmail.com', 'default.jpg', '$2y$10$C69jPT3z6gQ.h0u30JOKReN/HSoBQgSbpbdRzOae4feEJnMcFCFwm', 2),
(9, 'ooo', 'ooo@gmail.com', 'default.jpg', '$2y$10$vMgIWVkFqmmY9RakvzUZJu1IpTSqzlILfxc3.gEB0csxfBdhFugF2', 2),
(10, 'vape', 'vape@gmail.com', 'pas_foto_3x44.jpg', '$2y$10$Lzl1Gd3jRT4Sbt72Otu8/eIAYMJtHDgKF4XMDPGDpRJynw9UGWmJm', 2),
(11, 'nano', 'nano@gmail.com', 'default.jpg', '$2y$10$YQGYWugJjei.R9vHc/48T.fs.MbddAdQK95KCMby4PqSacVuKuxYO', 2),
(12, 'admin', 'admin@gmail.com', 'default.jpg', '$2y$10$vAK2iWGYPn/otr22jo05EuKHO/Kld2BK6i9dYMJDn/6ni7qgn/a0W', 1),
(13, 'Admin', 'adm@gmail.com', 'IMG_6058_JPEG.jpg', '$2y$10$ZgxOaTluB6xxS3wRrEweRe9bjPnrpltkeIyXWRwUACM4mseRn0yrq', 1);

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator');
INSERT INTO `user_role` (`id`, `role`) VALUES
(2, 'member');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;