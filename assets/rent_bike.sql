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
  `bike_id` int DEFAULT NULL,
  `criteria_id` int DEFAULT NULL,
  `subcriteria_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `criteria_id` (`criteria_id`),
  KEY `subcriteria_id` (`subcriteria_id`),
  KEY `bike_id` (`bike_id`),
  CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`criteria_id`) REFERENCES `kriteria` (`id`),
  CONSTRAINT `alternatif_ibfk_2` FOREIGN KEY (`subcriteria_id`) REFERENCES `subkriteria` (`id`),
  CONSTRAINT `alternatif_ibfk_3` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `bike` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `year_release` year DEFAULT NULL,
  `engine_power` varchar(255) DEFAULT NULL,
  `fuel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `kriteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `subkriteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `criteria_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_criteria_id` (`criteria_id`),
  CONSTRAINT `fk_criteria_id` FOREIGN KEY (`criteria_id`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

INSERT INTO `alternatif` (`id`, `bike_id`, `criteria_id`, `subcriteria_id`) VALUES
(9, 1, 8, 1);
INSERT INTO `alternatif` (`id`, `bike_id`, `criteria_id`, `subcriteria_id`) VALUES
(10, 1, 9, 8);
INSERT INTO `alternatif` (`id`, `bike_id`, `criteria_id`, `subcriteria_id`) VALUES
(11, 1, 10, 13);
INSERT INTO `alternatif` (`id`, `bike_id`, `criteria_id`, `subcriteria_id`) VALUES
(12, 1, 11, 19),
(13, 3, 8, 3),
(14, 3, 9, 8),
(15, 3, 10, 14),
(16, 3, 11, 19),
(17, 2, 8, 3),
(18, 2, 9, 8),
(19, 2, 10, 14),
(20, 2, 11, 18);

INSERT INTO `bike` (`id`, `name`, `price`, `year_release`, `engine_power`, `fuel`) VALUES
(1, 'Honda Beat', 15000000, '2020', '110 cc', '30 km');
INSERT INTO `bike` (`id`, `name`, `price`, `year_release`, `engine_power`, `fuel`) VALUES
(2, 'Yamaha Nmax', 30000000, '2019', '190 cc', '30 km');
INSERT INTO `bike` (`id`, `name`, `price`, `year_release`, `engine_power`, `fuel`) VALUES
(3, 'Suzuki Satria F160', 45000000, '2024', '155 cc', '53 km');

INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(8, 'C1', 'Harga Sewa', 'Cost', 0.34);
INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(9, 'C2', 'Tahun Produksi Motor', 'Benefit', 0.15);
INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(10, 'C3', 'Kekuatan Mesin', 'Benefit', 0.13);
INSERT INTO `kriteria` (`id`, `code`, `name`, `attribute`, `weight`) VALUES
(11, 'C4', 'Konsumsi Bahan Bakar', 'Benefit', 0.38);

INSERT INTO `subkriteria` (`id`, `criteria_id`, `name`, `weight`) VALUES
(1, 8, 'Harga > Rp 400.000', '1');
INSERT INTO `subkriteria` (`id`, `criteria_id`, `name`, `weight`) VALUES
(2, 8, 'Rp 300.000 -  Rp 400.000', '2');
INSERT INTO `subkriteria` (`id`, `criteria_id`, `name`, `weight`) VALUES
(3, 8, 'Rp 200.000 - Rp 300.000', '3');
INSERT INTO `subkriteria` (`id`, `criteria_id`, `name`, `weight`) VALUES
(4, 8, 'Rp 100.000 - Rp 200.000', '4'),
(6, 8, 'Harga < Rp.  100.000', '5'),
(7, 9, 'Tahun < 2015', '1'),
(8, 9, '2015 – 2017', '2'),
(9, 9, '2017 – 2019', '3'),
(10, 9, '2019 – 2021', '4'),
(11, 9, 'Tahun > 2021', '5'),
(12, 10, 'Mesin < 100 cc', '1'),
(13, 10, '100 cc – 110 cc', '2'),
(14, 10, '110 cc – 125 cc', '3'),
(15, 10, '125 cc – 150 cc', '4'),
(16, 10, 'Mesin > 150 cc', '5'),
(17, 11, 'KKB < 35Km/L', '1'),
(18, 11, '35Km/L – 40Km/L', '2'),
(19, 11, '40Km/L – 55Km/L', '2'),
(20, 11, '55Km/L – 60Km/L', '4'),
(21, 11, 'KBB > 60Km/L', '5');

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
