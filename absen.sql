-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 27, 2024 at 03:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `building_id` int NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `building_scanner` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`building_id`, `code`, `name`, `address`, `building_scanner`) VALUES
(2, 'SWZ8Z/2021', 'Lapangan', 'By Location', ''),
(3, 'SWYRA/2021', 'Kantor', 'Jl. Proklamator No.170 A Kel. Bandar Jaya, Kec. Terbanggi Besar, Kab. Lampung Tengah, Lampung 34163', '');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `employees_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `employees_email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `employees_password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `employees_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `position_id` int NOT NULL,
  `shift_id` int NOT NULL,
  `building_id` int NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_login` datetime NOT NULL,
  `created_cookies` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `laporan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employees_code`, `employees_email`, `employees_password`, `employees_name`, `position_id`, `shift_id`, `building_id`, `photo`, `created_login`, `created_cookies`, `laporan`) VALUES
(12, 'sarimurni', 'sarimurni@gmail.com', '2e6f502934b03709793953eb87db5410b86cb1d5a071d2f1ba21a090bd08ec81', 'Sari murni', 2, 5, 2, 'sarimurni-006903c05f42fad6af328532db51b1a5-1323-.png', '2024-01-27 20:14:19', 'f34937a705f3d24229f6d7963deeb753', ''),
(13, 'sariayu', 'sariayu@gmail.com', '95a9b9bde273b18257593ec682b5d7afa4a272a4688187147b247d4fd444ae88', 'Sari Ayu', 1, 4, 2, '2021-06-26156005c5baf40ff51a327f1c34f2975b.jpg', '2022-01-12 14:31:10', '686a241b6380fda8e63503b8b75c21cd', ''),
(14, 'sarinovita', 'sarinovita@gmail.com', 'f979d4ec2952c8a6d92ff625c3dadd6c953915cfa36db36f6b43b77838003d55', 'Sari Novita', 1, 3, 2, '2021-06-26799bad5a3b514f096e69bbc4a7896cd9.jpg', '2021-06-26 04:53:00', '-', ''),
(15, 'bagongahmad', 'bagongahmad@gmail.com', 'ed68761997e0654b47f557f6d16a8474f88f5214f7fa2b24aeee159227b93987', 'Bagong Ahmad', 1, 3, 2, '2021-06-26d0096ec6c83575373e3a21d129ff8fef.jpg', '2021-06-26 04:54:00', '-', ''),
(16, 'julianto', 'julianto@gmail.com', '70b74ddde2eb65ddefda8022b44b3c320167ca1c4c4fe4e440cf058d755b31da', 'Julianto', 1, 5, 2, 'julianto-e7af2bdeb733e88b3836bc7ab0b7165c-1658-.png', '2024-01-27 21:59:01', '31b4f45e2e2b2767f2f8feb6e1203b31', ''),
(17, 'badruljuki', 'badruljuki@gmail.com', '1297180357ece67fbea395c5512a09e959c727f7fe799098dc2e1643c715282c', 'Badrul Juki', 7, 5, 2, '2021-06-2618e2999891374a475d0687ca9f989d83.jpg', '2024-01-19 14:23:20', '71a38d0569ec34d40b5ef616075fed28', ''),
(18, 'OM001-2021', 'juki@gmail.com', '37315056995e4df1d459323dd839ff7d3db247deea647f596a9088cd26d03e10', 'Juki', 7, 4, 2, 'OM001-2021-caffa595a27d8533e7bc218c73908eaf-2341-.jpg', '2021-06-30 23:40:35', '9e9ee83b0dbd8d3f6dd19f8687a0aef9', ''),
(19, 'OM001-2024', 'naa@gmail.com', '4c547e68c0e89f0dda8498cceeffc54ad237de1a5018f332b99e0fe3af66b553', 'inaa', 2, 3, 1, '', '2024-01-11 13:21:06', 'f354a98ad605c58bcb6028c1eb23a5be', ''),
(20, '20242', 'ferisna.yanti21@students.unila', '773d78002c25974c6f6042e059351c08a176f4cfecf3b5acd51ce4671019a3a1', 'Ferisna Yanti Hima', 2, 4, 4, '2024-01-128120b50032755eac96e4b5a9ae365021.jpg', '2024-01-13 12:47:04', '236b465eab1e91b2c2f8e2136087d5db', ''),
(21, '20241', 'adityasdanu@gmail.com', 'f646f0a69b0642951ad80ca8483219f35cfcba266e57e26eb26fac501de025be', 'Adityas Danu Wirya', 2, 5, 2, '2024-01-1535d14ce27bb2c3b78b12099de71474ae.jpg', '2024-01-17 10:17:03', 'e2359a0b9a1fcfa508c8c2513521bffd', ''),
(22, '20242', 'shafiraandayaputri@gmail.com', '4e700044683f6d1a30ab20e4e61d024359c5a48270143f048e00c56d4ab850cd', 'Shafira Andaya Putri', 2, 5, 1, '2024-01-1535d14ce27bb2c3b78b12099de71474ae.jpg', '2024-01-19 14:25:09', 'cd95ece2299cf93ce1828bde26164542', ''),
(23, 'retno', 'retno@gmail.com', '27a98090b03df119f2ada3385c3fc164992e5cb28689826ab88c2019e9dc2c8a', 'retno lestari', 2, 5, 1, '2024-01-17054cdeecb61e884fa643ec8ed7cda657.jpg', '2024-01-17 11:01:00', 'd79ef92d229688ef0a182ffdabcebb5d', ''),
(24, '202419', 'retno@gmail.com', 'e26dd42f7bb88e6c2b373a4ab8abbb0c735e80dc5f6f84f346e2177d5955008a', 'retno lestari', 2, 5, 3, '2024-01-17054cdeecb61e884fa643ec8ed7cda657.jpg', '2024-01-17 11:02:45', 'd79ef92d229688ef0a182ffdabcebb5d', ''),
(25, '2016', 'shafiraandaya@gmail.com', '240c13b661575ef7faee323aa17efcf4ca92e2546663fed1eebe647db4cf15d3', 'Shafira Andaya Putri', 7, 5, 3, '2024-01-1735d14ce27bb2c3b78b12099de71474ae.jpg', '2024-01-17 11:06:46', '7dc76187bb77ca835d9ec3d718af496e', ''),
(26, '20249', 'inagans@gmail.com', 'bd63388469439522c14ac5efd1a135988302e482e41677364b1cb13d8f3794b0', 'Ferisna Yanti', 2, 5, 3, '2024-01-17b3579bbe08dea757a091eb55bc34b47d.jpg', '2024-01-17 11:15:57', '9bd02224d7beac9230f939a7c5232f75', ''),
(27, '1234321', 'aways@gmail.com', '044b4d28a9d1016085bacb63a3e425389630131302ca1686667a2e2c69aa56ed', 'Annas', 2, 4, 3, '2024-01-172592c518a35f7beabf9cc2a995212065.jpeg', '2024-01-19 12:36:07', '64b27a3ad9ede55ebd9b0bd649b5570c', ''),
(28, '6574', 'firaina@gmail.com', '604d51c372c0bc94ae5aa93b895596fe1d85fe6a65b0c4cb4cb9aee5060c71d2', 'Firaina Yuna Hariska', 2, 5, 3, '2024-01-1935d14ce27bb2c3b78b12099de71474ae.jpg', '2024-01-21 18:32:42', 'a3dd8acfb6ef7d6f761075356e17c279', '');

-- --------------------------------------------------------

--
-- Table structure for table `item_kpi`
--

CREATE TABLE `item_kpi` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `bade` int DEFAULT '0',
  `npl` int DEFAULT '0',
  `par` int DEFAULT '0',
  `behavior` int DEFAULT '0',
  `knowledge` int DEFAULT '0',
  `service` int DEFAULT '0',
  `score` decimal(5,2) DEFAULT NULL,
  `year` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_kpi`
--

INSERT INTO `item_kpi` (`id`, `user_id`, `bade`, `npl`, `par`, `behavior`, `knowledge`, `service`, `score`, `year`) VALUES
(1, 16, 102, 90, 106, 100, 100, 90, '97.80', 2024),
(2, 16, 0, 200, 200, 0, 0, 0, '70.00', 2025);

--
-- Triggers `item_kpi`
--
DELIMITER $$
CREATE TRIGGER `calculate_score_trigger` BEFORE INSERT ON `item_kpi` FOR EACH ROW BEGIN

    SET NEW.score = 0.35 * NEW.bade + 0.25 * NEW.npl + 0.10 * NEW.par + 0.10 * NEW.behavior + 0.10 * NEW.knowledge + 0.10 * NEW.service;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calculate_score_trigger_update` BEFORE UPDATE ON `item_kpi` FOR EACH ROW BEGIN
    SET NEW.score = 0.35 * NEW.bade + 0.25 * NEW.npl + 0.10 * NEW.par + 0.10 * NEW.behavior + 0.10 * NEW.knowledge + 0.10 * NEW.service;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kpi`
--

CREATE TABLE `kpi` (
  `id` int NOT NULL,
  `bade` bigint NOT NULL,
  `badenpl` bigint NOT NULL,
  `badepar` bigint NOT NULL,
  `npl` double NOT NULL,
  `par` double NOT NULL,
  `month` varchar(20) NOT NULL,
  `user_id` int NOT NULL,
  `credit` bigint NOT NULL,
  `year` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kpi`
--

INSERT INTO `kpi` (`id`, `bade`, `badenpl`, `badepar`, `npl`, `par`, `month`, `user_id`, `credit`, `year`) VALUES
(2, 3496011226, 218423992, 451320942, 6.25, 12.91, 'BASE', 0, 0, 0),
(3, 3621011226, 217923992, 471394778, 6.0183185966185, 13.018318596618, 'januari', 0, 125000000, 0),
(4, 3746011226, 217423992, 479644778, 5.804146834663, 12.804146834663, 'februari', 0, 125000000, 0),
(5, 3871011226, 216923992, 487894778, 5.6038068436229, 12.603806843623, 'maret', 0, 125000000, 0),
(6, 3986011226, 216423992, 495444778, 5.4295881202819, 12.429588120282, 'april', 0, 115000000, 0),
(7, 4101011226, 215923992, 502994778, 5.265140232513, 12.265140232513, 'mei', 0, 115000000, 0),
(8, 4216011226, 215423992, 510544778, 5.1096636240313, 12.109663624031, 'juni', 0, 115000000, 0),
(9, 4326011226, 214923992, 517744778, 4.9681792480859, 11.968179248086, 'juli', 0, 110000000, 0),
(10, 4436011226, 214423992, 524944778, 4.833711662929, 11.833711662929, 'agustus', 0, 110000000, 0),
(11, 4546011226, 213923992, 532144778, 4.7057515119299, 11.70575151193, 'september', 0, 110000000, 0),
(12, 4651011226, 213423992, 538994778, 4.5887653593894, 11.588765359389, 'oktober', 0, 105000000, 0),
(13, 4756011226, 212923992, 545844778, 4.4769446891966, 11.476944689197, 'november', 0, 105000000, 0),
(14, 4861011226, 212423992, 552694778, 4.3699547712174, 11.369954771217, 'desember', 0, 105000000, 0),
(17, 3533157794, 218423992, 349028092, 6.18, 9.88, 'januari', 16, 458000000, 2024),
(18, 3680912005, 218423992, 349028092, 5.93, 9.48, 'februari', 16, 283000000, 2024),
(19, 3691599627, 218423992, 546948694, 5.92, 14.82, 'maret', 16, 148500000, 2024),
(20, 3940245127, 268423992, 575428642, 6.81, 14.6, 'april', 16, 403000000, 2024),
(21, 3993578650, 267923992, 512151642, 6.71, 12.82, 'mei', 16, 263000000, 2024),
(22, 4082121890, 294504886, 448612101, 7.21, 10.99, 'juni', 16, 335000000, 2024),
(23, 4267666175, 287818586, 474929386, 6.74, 11.13, 'juli', 16, 303000000, 2024),
(24, 4270566676, 267204886, 610800876, 6.26, 14.3, 'agustus', 16, 348000000, 2024),
(25, 4156954923, 257324992, 765248973, 6.19, 18.41, 'september', 16, 217000000, 2024),
(26, 4094752387, 257323992, 528883882, 6.28, 12.92, 'oktober', 16, 246000000, 2024),
(27, 4797407860, 257914742, 617236410, 5.38, 12.87, 'november', 16, 968000000, 2024),
(28, 4938780768, 234464742, 520432718, 4.75, 10.54, 'desember', 16, 225000000, 2024),
(29, 1, 1, 1, 100, 100, 'januari', 16, 1, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int NOT NULL,
  `files` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `files`, `user_id`, `status`, `tanggal`) VALUES
(18, 'sarimurni-45c1f97a08c8f37eeac37c364b642fc1-20240127-file.pdf', 12, 'Accepted', '2024-01-27'),
(19, 'sarimurni-45c1f97a08c8f37eeac37c364b642fc1-20240127-file.pdf', 12, 'Accepted', '2024-01-27'),
(20, 'julianto-45c1f97a08c8f37eeac37c364b642fc1-20240127-file.pdf', 16, '', '2024-01-27'),
(21, 'julianto-d874b06aed63c29999c7485f6b0ea135-20240127-file.pdf', 16, '', '2024-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int NOT NULL,
  `position_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`) VALUES
(1, 'CRA'),
(2, 'Accounting'),
(7, 'Asset Quality/Risk Management'),
(10, 'Audit Intern/SPI'),
(11, 'Account Officer'),
(12, 'Credit Admin'),
(13, 'Teller'),
(14, 'Customer Service'),
(15, 'Marketing Funding'),
(16, 'CSO'),
(17, 'Legal Officer');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `presence_id` int NOT NULL,
  `employees_id` int NOT NULL,
  `presence_date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `picture_in` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `picture_out` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `present_id` int NOT NULL COMMENT 'Masuk,Pulang,Tidak Hadir',
  `presence_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `information` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`presence_id`, `employees_id`, `presence_date`, `time_in`, `time_out`, `picture_in`, `picture_out`, `present_id`, `presence_address`, `information`) VALUES
(26, 12, '2021-06-26', '05:05:00', '11:05:00', 'sari-murni-in-2021-06-26-12.jpg', 'sari-murni-out-2021-06-26-12.jpg', 1, '-1.4851831,102.43805809999999', ''),
(27, 12, '2021-06-30', '23:37:00', '00:00:00', 'sari-murni-in-2021-06-30-12.jpg', '', 1, '-1.4851831,102.43805809999999', ''),
(28, 18, '2021-06-30', '23:42:00', '00:00:00', 'juki--in-2021-06-30-18.jpg', '', 1, '-1.4851831,102.43805809999999', ''),
(29, 13, '2022-01-12', '14:31:00', '00:00:00', 'sari-ayu-in-2022-01-12-13.jpg', '', 1, '-1.6101229,103.6131203', ''),
(30, 19, '2024-01-11', '10:03:00', '10:04:00', 'inaa-in-2024-01-11-19.jpg', 'inaa-out-2024-01-11-19.jpg', 1, '-4.941937781966051,105.21380559658742', ''),
(31, 12, '2024-01-11', '10:09:00', '13:21:00', 'sari-murni-in-2024-01-11-12.jpg', 'sari-murni-out-2024-01-11-12.jpg', 1, '-4.941805061194496,105.21395196735733', ''),
(32, 12, '2024-01-12', '10:32:00', '10:33:00', 'sari-murni-in-2024-01-12-12.jpg', 'sari-murni-out-2024-01-12-12.jpg', 1, '-4.941833677407365,105.21385930474601', ''),
(33, 17, '2024-01-13', '10:39:00', '10:39:00', 'badrul-juki-in-2024-01-13-17.jpg', 'badrul-juki-out-2024-01-13-17.jpg', 1, '-4.89361,105.2077912', ''),
(34, 21, '2024-01-15', '09:51:00', '00:00:00', 'adityas-danu-wirya-in-2024-01-15-21.jpg', '', 1, '-5.1806208,105.6800768', ''),
(35, 22, '2024-01-15', '11:48:00', '11:51:00', 'shafira-andaya-putri-in-2024-01-15-22.jpg', 'shafira-andaya-putri-out-2024-01-15-22.jpg', 2, '-5.1806208,105.6800768', ''),
(36, 22, '2024-01-16', '09:05:00', '09:10:00', 'shafira-andaya-putri-in-2024-01-16-22.jpg', 'shafira-andaya-putri-out-2024-01-16-22.jpg', 1, '-4.9421023,105.2140414', ''),
(37, 21, '2024-01-17', '09:20:00', '10:17:00', 'adityas-danu-wirya-in-2024-01-17-21.jpg', 'adityas-danu-wirya-out-2024-01-17-21.jpg', 1, '', ''),
(38, 17, '2024-01-17', '10:19:00', '00:00:00', 'badrul-juki-in-2024-01-17-17.jpg', '', 1, '-5.3837824,105.2540928', ''),
(39, 23, '2024-01-17', '10:21:00', '10:49:00', 'retno-lestari-in-2024-01-17-23.jpg', 'retno-lestari-out-2024-01-17-23.jpg', 1, '-5.3837824,105.2540928', ''),
(40, 24, '2024-01-17', '11:02:00', '11:05:00', 'retno-lestari-in-2024-01-17-24.jpg', 'retno-lestari-out-2024-01-17-24.jpg', 1, '-5.3837824,105.2540928', ''),
(41, 25, '2024-01-17', '11:08:00', '11:13:00', 'shafira-andaya-putri-in-2024-01-17-25.jpg', 'shafira-andaya-putri-out-2024-01-17-25.jpg', 1, '-5.3837824,105.2540928', ''),
(42, 26, '2024-01-17', '11:17:00', '00:00:00', 'ferisna-yanti-in-2024-01-17-26.jpg', '', 1, '-5.3837824,105.2540928', ''),
(43, 27, '2024-01-17', '11:32:00', '00:00:00', 'annas-in-2024-01-17-27.jpg', '', 1, '-5.3837824,105.2540928', ''),
(44, 27, '2024-01-19', '12:36:00', '14:10:00', 'annas-in-2024-01-19-27.jpg', 'annas-out-2024-01-19-27.jpg', 1, '-5.4001664,105.2672', ''),
(45, 17, '2024-01-19', '14:12:00', '00:00:00', 'badrul-juki-in-2024-01-19-17.jpg', '', 1, '-5.4001664,105.2672', ''),
(46, 22, '2024-01-19', '14:25:00', '00:00:00', 'shafira-andaya-putri-in-2024-01-19-22.jpg', '', 1, '-5.4001664,105.2672', ''),
(47, 28, '2024-01-19', '14:30:00', '00:00:00', 'firaina-yuna-hariska-in-2024-01-19-28.jpg', '', 1, '-5.4001664,105.2672', ''),
(48, 28, '2024-01-21', '18:32:00', '20:27:00', 'firaina-yuna-hariska-in-2024-01-21-28.jpg', 'firaina-yuna-hariska-out-2024-01-21-28.jpg', 1, '-5.3706752,105.2934144', ''),
(49, 16, '2024-01-24', '17:37:00', '17:37:00', 'julianto-in-2024-01-24-16.jpg', 'julianto-out-2024-01-24-16.jpg', 1, '-5.0962882,105.3205391', 'Sakit');

-- --------------------------------------------------------

--
-- Table structure for table `present_status`
--

CREATE TABLE `present_status` (
  `present_id` int NOT NULL,
  `present_name` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `shift_id` int NOT NULL,
  `shift_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_name`, `time_in`, `time_out`) VALUES
(4, 'Lending', '08:00:00', '17:00:00'),
(5, 'Funding', '07:45:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `site_id` int NOT NULL,
  `site_url` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `site_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `site_phone` char(12) COLLATE utf8mb4_general_ci NOT NULL,
  `site_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `site_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `site_logo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `site_email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `site_email_domain` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`site_id`, `site_url`, `site_name`, `site_phone`, `site_address`, `site_description`, `site_logo`, `site_email`, `site_email_domain`) VALUES
(1, 'http://localhost/Absen-Online-New-main', 'Sistem Absensi dan KPI', '(0725) 52915', 'Jl. Proklamator 170A, Kel. Bandar Jaya, Kec. Terbanggi Besar, Kab. Lampung Tengah, Lampung 34163', '-', 'img_20240111_124842png.png', 'bprbahteraarthajaya@gmail.com', 'ferisnayantihima@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `registered` datetime NOT NULL,
  `created_login` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `session` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `browser` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `fullname`, `registered`, `created_login`, `last_login`, `session`, `ip`, `browser`, `level`) VALUES
(1, 'admin', 'ferisnayantihima@gmail.com', '88b3340abaa6acbf87abe45f68fa8960224c1e36f6a96433bcbc490c84c9c6d2', 'ADMIN', '2021-02-03 10:22:00', '2024-01-27 22:00:32', '2024-01-26 21:55:14', '-', '1', 'Google Crome', 1),
(3, 'operator', 'shafiraandayaputri@gmail.com', '4bba81f5d902e27e808a230bc5ae79cb19ccfccca09c52593e3136d84c4ebaac', 'OPERATOR', '2021-06-24 22:46:00', '2021-07-02 13:31:19', '2021-07-02 13:39:25', '-', '1', 'Google Crome', 2),
(4, 'danikuniawan', 'danikurniawan@gmail.com', '6c458f11d2dd9c394d8c62506c2cc1814329cd668f0060b654af7ed38865cc63', 'Dani Kurniawan', '2024-01-19 14:47:00', '2024-01-19 14:47:00', '2024-01-19 14:47:00', '0', '1', 'Google Crome', 2),
(5, 'hendrasironi', 'hendrasironi@gmail.com', '59dc767107a1682e056e7d1ea183f14eeecbd2a849c6311927316a4645cace92', 'Hendra Sironi ', '2024-01-19 15:14:00', '2024-01-19 15:14:00', '2024-01-19 15:14:00', '0', '1', 'Google Crome', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` int NOT NULL,
  `level_name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int NOT NULL,
  `tahun` int DEFAULT NULL,
  `employees_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `tahun`, `employees_id`) VALUES
(1, 2024, 16),
(9, 2024, 12),
(10, 2025, 16),
(11, 2026, 16);

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
-- Indexes for table `item_kpi`
--
ALTER TABLE `item_kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kpi`
--
ALTER TABLE `kpi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
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
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_id` (`employees_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `item_kpi`
--
ALTER TABLE `item_kpi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kpi`
--
ALTER TABLE `kpi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `presence_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `present_status`
--
ALTER TABLE `present_status`
  MODIFY `present_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `site_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `years`
--
ALTER TABLE `years`
  ADD CONSTRAINT `years_ibfk_1` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
