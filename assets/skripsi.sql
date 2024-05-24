-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 08:30 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `merk` varchar(200) NOT NULL,
  `tipe` varchar(200) NOT NULL,
  `nopol` varchar(200) NOT NULL,
  `rental` varchar(200) NOT NULL,
  `telp` varchar(200) NOT NULL,
  `warna` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `merk`, `tipe`, `nopol`, `rental`, `telp`, `warna`) VALUES
(7, 'Honda', 'ADV155', 'DK 0001 AA', 'Tegal Gundul Rental', '08970274762', 'hijau'),
(11, 'kawasaki', 'ninja', 'dk 1234 dk', 'canggu rental', '0987345', 'merah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`) VALUES
(1, 'alicia', 'aliciabigo16@gmail.com', 'default.jpg', '$2y$10$MH7uZbcaEWz7E6YJccaT3O/Lz1dk2sCSCNj19oDfZAzXTxk0eNELy', 2),
(2, 'gilang', 'gilang@gmail.com', 'default.jpg', '$2y$10$awEuyYN/ZR00/mg/9PqKK.tE5YYnsH6aDiKqChfX8PuIwvQE3cJyS', 2),
(3, 'wahyu', 'wahyudigilang83@gmail.com', 'default.jpg', '$2y$10$Sj.mO6Q1ualyg/0IS4axP.Rhz24i47pH06/Iz2y0oZDEGTQEBEB2W', 2),
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

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
