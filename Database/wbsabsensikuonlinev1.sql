-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 07:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbsabsensikuonlinev1`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` int(8) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `building_scanner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `code`, `name`, `address`, `building_scanner`) VALUES
(1, 'SWGA4/2021', 'Kantor Pusat - Gedung B', '401XD Group, Jl. Sumbawa, Ulak Karang Utara, Padang, Sumatera Barat, 25133', ''),
(2, 'SWZ8Z/2021', 'Kantor Pusat - Gedung A', '401XD Group, Jl. Sumbawa, Ulak Karang Utara, Padang, Sumatera Barat, 25133', ''),
(3, 'SWYRA/2021', 'Kantor Pusat - Gedung C', '401XD Group, Jl. Sumbawa, Ulak Karang Utara, Padang, Sumatera Barat, 25133', ''),
(4, 'SWQM6/2021', 'Kantor Pusat - Gedung D', '401XD Group, Jl. Sumbawa, Ulak Karang Utara, Padang, Sumatera Barat, 25133', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employees_code` varchar(20) NOT NULL,
  `employees_email` varchar(30) NOT NULL,
  `employees_password` varchar(100) NOT NULL,
  `employees_name` varchar(50) NOT NULL,
  `position_id` int(5) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_login` datetime NOT NULL,
  `created_cookies` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employees_code`, `employees_email`, `employees_password`, `employees_name`, `position_id`, `shift_id`, `building_id`, `photo`, `created_login`, `created_cookies`) VALUES
(12, 'sarimurni', 'sarimurni@gmail.com', '2e6f502934b03709793953eb87db5410b86cb1d5a071d2f1ba21a090bd08ec81', 'Sari murni', 2, 4, 2, '2021-06-26f3ccdd27d2000e3f9255a7e3e2c48800.jpg', '2022-01-12 14:50:42', 'f34937a705f3d24229f6d7963deeb753'),
(13, 'sariayu', 'sariayu@gmail.com', '95a9b9bde273b18257593ec682b5d7afa4a272a4688187147b247d4fd444ae88', 'Sari Ayu', 1, 4, 2, '2021-06-26156005c5baf40ff51a327f1c34f2975b.jpg', '2022-01-12 14:31:10', '686a241b6380fda8e63503b8b75c21cd'),
(14, 'sarinovita', 'sarinovita@gmail.com', 'f979d4ec2952c8a6d92ff625c3dadd6c953915cfa36db36f6b43b77838003d55', 'Sari Novita', 1, 3, 2, '2021-06-26799bad5a3b514f096e69bbc4a7896cd9.jpg', '2021-06-26 04:53:00', '-'),
(15, 'bagongahmad', 'bagongahmad@gmail.com', 'ed68761997e0654b47f557f6d16a8474f88f5214f7fa2b24aeee159227b93987', 'Bagong Ahmad', 1, 3, 2, '2021-06-26d0096ec6c83575373e3a21d129ff8fef.jpg', '2021-06-26 04:54:00', '-'),
(16, 'julianto', 'julianto@gmail.com', '70b74ddde2eb65ddefda8022b44b3c320167ca1c4c4fe4e440cf058d755b31da', 'Julianto', 1, 3, 2, '2021-06-26032b2cc936860b03048302d991c3498f.jpg', '2021-06-26 04:55:00', '-'),
(17, 'badruljuki', 'badruljuki@gmail.com', '1297180357ece67fbea395c5512a09e959c727f7fe799098dc2e1643c715282c', 'Badrul Juki', 7, 5, 2, '2021-06-2618e2999891374a475d0687ca9f989d83.jpg', '2021-06-26 05:01:49', '71a38d0569ec34d40b5ef616075fed28'),
(18, 'OM001-2021', 'juki@gmail.com', '37315056995e4df1d459323dd839ff7d3db247deea647f596a9088cd26d03e10', 'Juki', 7, 4, 2, 'OM001-2021-caffa595a27d8533e7bc218c73908eaf-2341-.jpg', '2021-06-30 23:40:35', '9e9ee83b0dbd8d3f6dd19f8687a0aef9');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(5) NOT NULL,
  `position_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`) VALUES
(1, 'STAFF'),
(2, 'ACCOUNTING'),
(7, 'MANAGER');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `presence_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `presence_date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `picture_in` varchar(150) NOT NULL,
  `picture_out` varchar(150) NOT NULL,
  `present_id` int(11) NOT NULL COMMENT 'Masuk,Pulang,Tidak Hadir',
  `presence_address` text NOT NULL,
  `information` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`presence_id`, `employees_id`, `presence_date`, `time_in`, `time_out`, `picture_in`, `picture_out`, `present_id`, `presence_address`, `information`) VALUES
(26, 12, '2021-06-26', '05:05:00', '11:05:00', 'sari-murni-in-2021-06-26-12.jpg', 'sari-murni-out-2021-06-26-12.jpg', 1, '-1.4851831,102.43805809999999', ''),
(27, 12, '2021-06-30', '23:37:00', '00:00:00', 'sari-murni-in-2021-06-30-12.jpg', '', 1, '-1.4851831,102.43805809999999', ''),
(28, 18, '2021-06-30', '23:42:00', '00:00:00', 'juki--in-2021-06-30-18.jpg', '', 1, '-1.4851831,102.43805809999999', ''),
(29, 13, '2022-01-12', '14:31:00', '00:00:00', 'sari-ayu-in-2022-01-12-13.jpg', '', 1, '-1.6101229,103.6131203', '');

-- --------------------------------------------------------

--
-- Table structure for table `present_status`
--

CREATE TABLE `present_status` (
  `present_id` int(6) NOT NULL,
  `present_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `present_status`
--

INSERT INTO `present_status` (`present_id`, `present_name`) VALUES
(1, 'Hadir'),
(2, 'Sakit'),
(3, 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` varchar(20) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_name`, `time_in`, `time_out`) VALUES
(3, 'SHIFT SIANG', '13:00:00', '17:00:00'),
(4, 'SHIFT PAGI', '07:00:00', '11:00:00'),
(5, 'FULL TIME', '07:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `site_id` int(4) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_phone` char(12) NOT NULL,
  `site_address` text NOT NULL,
  `site_description` text NOT NULL,
  `site_logo` varchar(50) NOT NULL,
  `site_email` varchar(30) NOT NULL,
  `site_email_domain` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`site_id`, `site_url`, `site_name`, `site_phone`, `site_address`, `site_description`, `site_logo`, `site_email`, `site_email_domain`) VALUES
(1, 'http://localhost:8074/project/AbsensiOnlineV1', 'Absensi Online - Foto Selfie & Auto Detect Lokasi', '082377823390', '401XD Group, Jl. Sumbawa, Ulak Karang Utara, Kec. Padang Utara, Kota Padang, Sumatera Barat 25133', 'Aplikasi Sistem Absensi Online Berbasis Foto Selfie dan Auto Detect Lokasi. Absen Karyawan Kini Jadi Lebih Efisien. Sistem absensi dengan verifikasi foto selfie atau webcam, dilengkapi fitur deteksi lokasi pengguna yang akurat.', 'logo-absensipng.png', 'mycoding@401xd.com', 'mycoding@401xd.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `registered` datetime NOT NULL,
  `created_login` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `session` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `fullname`, `registered`, `created_login`, `last_login`, `session`, `ip`, `browser`, `level`) VALUES
(1, 'admin', 'mycoding@401xd.com', '88b3340abaa6acbf87abe45f68fa8960224c1e36f6a96433bcbc490c84c9c6d2', 'ADMIN', '2021-02-03 10:22:00', '2022-01-12 14:50:24', '2021-07-02 13:40:16', '-', '1', 'Google Crome', 1),
(3, 'operator', '401xdssh@gmail.com', 'c0fc26e449ec10285f6b28a7f92b91dc4497af26dbf02aade5bd798c567390dc', 'OPERATOR', '2021-06-24 22:46:00', '2021-07-02 13:31:19', '2021-07-02 13:39:25', '-', '1', 'Google Crome', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` int(4) NOT NULL,
  `level_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'Operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`presence_id`);

--
-- Indexes for table `present_status`
--
ALTER TABLE `present_status`
  ADD PRIMARY KEY (`present_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `presence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `present_status`
--
ALTER TABLE `present_status`
  MODIFY `present_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `site_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
