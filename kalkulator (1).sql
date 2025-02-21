-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 03:06 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalkulator`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity`, `description`, `timestamp`) VALUES
(0, 1, 'login', 'User logged in.', '2025-02-19 10:28:42'),
(1, 1, 'General', 'User accessed General View', '2025-01-14 12:51:25'),
(2, 1, 'Temperature', 'User accessed Temperature View', '2025-01-15 05:25:13'),
(3, 1, 'General', 'User accessed General View', '2025-01-15 05:26:02'),
(4, 1, 'Scientific', 'User accessed Scientific View', '2025-01-15 05:26:06'),
(5, 1, 'Programming', 'User accessed Programming View', '2025-01-15 05:26:14'),
(6, 1, 'Date Calculation', 'User accessed Date Calculation View', '2025-01-15 05:26:23'),
(7, 1, 'Temperature', 'User accessed Temperature View', '2025-01-15 05:26:54'),
(8, 1, 'Scientific', 'User accessed Scientific View', '2025-01-15 05:39:06'),
(9, 1, 'Programming', 'User accessed Programming View', '2025-01-15 05:39:20'),
(10, 1, 'Scientific', 'User accessed Scientific View', '2025-01-15 05:39:26'),
(11, 1, 'Scientific', 'User accessed Scientific View', '2025-01-15 07:34:55'),
(12, 1, 'Scientific', 'User accessed Scientific View', '2025-01-15 07:35:08'),
(13, 1, 'login', 'User logged in.', '2025-02-19 02:32:07'),
(14, 1, 'login', 'User logged in.', '2025-02-19 02:33:28'),
(15, 1, 'logout', 'User logged out.', '2025-02-19 02:37:09'),
(16, 1, 'login', 'User logged in.', '2025-02-19 02:38:54'),
(17, 1, 'login', 'User logged in.', '2025-02-19 02:40:10'),
(18, 1, 'logout', 'User logged out.', '2025-02-19 02:41:19'),
(19, 1, 'login', 'User logged in.', '2025-02-19 02:44:42'),
(20, 1, 'General', 'User accessed General View', '2025-02-19 02:46:24'),
(21, 1, 'General', 'User accessed General View', '2025-02-19 02:46:46'),
(22, 1, 'General', 'User accessed General View', '2025-02-19 02:46:46'),
(23, 1, 'General', 'User accessed General View', '2025-02-19 03:12:35'),
(24, 1, 'General', 'User accessed General View', '2025-02-19 03:14:28'),
(25, 1, 'General', 'User accessed General View', '2025-02-19 03:15:23'),
(26, 1, 'General', 'User accessed General View', '2025-02-19 03:30:06'),
(27, 1, 'General', 'User accessed General View', '2025-02-19 03:33:32'),
(28, 1, 'General', 'User accessed General View', '2025-02-19 03:38:05'),
(29, 1, 'General', 'User accessed General View', '2025-02-19 03:41:03'),
(30, 1, 'General', 'User accessed General View', '2025-02-19 03:41:46'),
(31, 1, 'General', 'User accessed General View', '2025-02-19 03:42:53'),
(32, 1, 'General', 'User accessed General View', '2025-02-19 03:43:58'),
(33, 1, 'General', 'User accessed General View', '2025-02-19 03:43:59'),
(34, 1, 'General', 'User accessed General View', '2025-02-19 03:46:39'),
(35, 1, 'General', 'User accessed General View', '2025-02-19 03:46:40'),
(36, 1, 'General', 'User accessed General View', '2025-02-19 03:50:45'),
(37, 1, 'General', 'User accessed General View', '2025-02-19 03:53:00'),
(38, 1, 'General', 'User accessed General View', '2025-02-19 03:53:01'),
(39, 1, 'General', 'User accessed General View', '2025-02-19 03:58:40'),
(40, 1, 'General', 'User accessed General View', '2025-02-19 03:59:06'),
(41, 1, 'General', 'User accessed General View', '2025-02-19 04:00:21'),
(42, 1, 'General', 'User accessed General View', '2025-02-19 04:01:16'),
(43, 1, 'General', 'User accessed General View', '2025-02-19 04:01:41'),
(44, 1, 'General', 'User accessed General View', '2025-02-19 04:03:27'),
(45, 1, 'General', 'User accessed General View', '2025-02-19 04:03:28'),
(46, 1, 'General', 'User accessed General View', '2025-02-19 04:03:40'),
(47, 1, 'General', 'User accessed General View', '2025-02-19 04:03:41'),
(48, 1, 'General', 'User accessed General View', '2025-02-19 04:08:07'),
(49, 1, 'General', 'User accessed General View', '2025-02-19 04:12:36'),
(50, 1, 'General', 'User accessed General View', '2025-02-19 04:13:16'),
(51, 1, 'General', 'User accessed General View', '2025-02-19 04:13:17'),
(52, 1, 'General', 'User accessed General View', '2025-02-19 04:18:27'),
(53, 1, 'General', 'User accessed General View', '2025-02-19 04:18:50'),
(54, 1, 'General', 'User accessed General View', '2025-02-19 04:19:18'),
(55, 1, 'General', 'User accessed General View', '2025-02-19 04:19:18'),
(56, 1, 'General', 'User accessed General View', '2025-02-19 04:23:37'),
(57, 1, 'General', 'User accessed General View', '2025-02-19 04:33:37'),
(58, 1, 'General', 'User accessed General View', '2025-02-19 04:33:38'),
(59, 1, 'General', 'User accessed General View', '2025-02-19 04:34:09'),
(60, 1, 'General', 'User accessed General View', '2025-02-19 04:34:19'),
(61, 1, 'General', 'User accessed General View', '2025-02-19 04:34:19'),
(62, 1, 'General', 'User accessed General View', '2025-02-19 04:34:29'),
(63, 1, 'General', 'User accessed General View', '2025-02-19 04:34:30'),
(64, 1, 'General', 'User accessed General View', '2025-02-19 04:38:36'),
(65, 1, 'General', 'User accessed General View', '2025-02-19 04:38:36'),
(66, 1, 'General', 'User accessed General View', '2025-02-19 04:38:40'),
(67, 1, 'General', 'User accessed General View', '2025-02-19 04:48:32'),
(68, 1, 'General', 'User accessed General View', '2025-02-19 04:48:33'),
(69, 1, 'General', 'User accessed General View', '2025-02-19 04:51:04'),
(70, 1, 'General', 'User accessed General View', '2025-02-19 04:51:04'),
(71, 1, 'General', 'User accessed General View', '2025-02-19 05:01:56'),
(72, 1, 'General', 'User accessed General View', '2025-02-19 06:41:44'),
(73, 1, 'General', 'User accessed General View', '2025-02-19 06:41:53'),
(74, 1, 'General', 'User accessed General View', '2025-02-19 06:41:54'),
(75, 1, 'General', 'User accessed General View', '2025-02-19 06:42:43'),
(76, 1, 'General', 'User accessed General View', '2025-02-19 06:45:19'),
(77, 1, 'General', 'User accessed General View', '2025-02-19 06:45:41'),
(78, 1, 'General', 'User accessed General View', '2025-02-19 06:46:01'),
(79, 1, 'General', 'User accessed General View', '2025-02-19 06:46:08'),
(80, 1, 'General', 'User accessed General View', '2025-02-19 06:46:24'),
(81, 1, 'General', 'User accessed General View', '2025-02-19 06:46:28'),
(82, 1, 'General', 'User accessed General View', '2025-02-19 06:46:54'),
(83, 1, 'General', 'User accessed General View', '2025-02-19 06:47:02'),
(84, 1, 'General', 'User accessed General View', '2025-02-19 06:47:03'),
(85, 1, 'General', 'User accessed General View', '2025-02-19 06:48:03'),
(86, 1, 'General', 'User accessed General View', '2025-02-19 06:48:26'),
(87, 1, 'General', 'User accessed General View', '2025-02-19 06:48:44'),
(88, 1, 'General', 'User accessed General View', '2025-02-19 06:48:44'),
(89, 1, 'General', 'User accessed General View', '2025-02-19 06:49:56'),
(90, 1, 'General', 'User accessed General View', '2025-02-19 06:49:57'),
(91, 1, 'General', 'User accessed General View', '2025-02-19 06:49:59'),
(92, 1, 'General', 'User accessed General View', '2025-02-19 06:50:19'),
(93, 1, 'General', 'User accessed General View', '2025-02-19 06:50:19'),
(94, 1, 'General', 'User accessed General View', '2025-02-19 06:50:21'),
(95, 1, 'General', 'User accessed General View', '2025-02-19 06:50:35'),
(96, 1, 'General', 'User accessed General View', '2025-02-19 06:50:35'),
(97, 1, 'General', 'User accessed General View', '2025-02-19 06:50:47'),
(98, 1, 'General', 'User accessed General View', '2025-02-19 06:51:12'),
(99, 1, 'General', 'User accessed General View', '2025-02-19 06:51:12'),
(100, 1, 'General', 'User accessed General View', '2025-02-19 06:52:17'),
(101, 1, 'General', 'User accessed General View', '2025-02-19 06:52:18'),
(102, 1, 'General', 'User accessed General View', '2025-02-19 06:52:21'),
(103, 1, 'General', 'User accessed General View', '2025-02-19 06:52:26'),
(104, 1, 'General', 'User accessed General View', '2025-02-19 06:52:29'),
(105, 1, 'General', 'User accessed General View', '2025-02-19 06:52:31'),
(106, 1, 'General', 'User accessed General View', '2025-02-19 06:52:47'),
(107, 1, 'General', 'User accessed General View', '2025-02-19 06:52:49'),
(108, 1, 'General', 'User accessed General View', '2025-02-19 06:52:55'),
(109, 1, 'General', 'User accessed General View', '2025-02-19 06:52:56'),
(110, 1, 'General', 'User accessed General View', '2025-02-19 06:53:57'),
(111, 1, 'General', 'User accessed General View', '2025-02-19 06:54:57'),
(112, 1, 'General', 'User accessed General View', '2025-02-19 06:55:05'),
(113, 1, 'General', 'User accessed General View', '2025-02-19 06:55:08'),
(114, 1, 'General', 'User accessed General View', '2025-02-19 06:55:09'),
(115, 1, 'General', 'User accessed General View', '2025-02-19 06:55:11'),
(116, 1, 'General', 'User accessed General View', '2025-02-19 06:55:50'),
(117, 1, 'General', 'User accessed General View', '2025-02-19 06:56:02'),
(118, 1, 'General', 'User accessed General View', '2025-02-19 06:56:32'),
(119, 1, 'General', 'User accessed General View', '2025-02-19 06:56:35'),
(120, 1, 'General', 'User accessed General View', '2025-02-19 06:56:36'),
(121, 1, 'General', 'User accessed General View', '2025-02-19 06:56:48'),
(122, 1, 'General', 'User accessed General View', '2025-02-19 06:56:48'),
(123, 1, 'General', 'User accessed General View', '2025-02-19 06:57:34'),
(124, 1, 'General', 'User accessed General View', '2025-02-19 06:58:43'),
(125, 1, 'General', 'User accessed General View', '2025-02-19 06:58:48'),
(126, 1, 'logout', 'User logged out.', '2025-02-19 06:58:50'),
(127, 1, 'login', 'User logged in.', '2025-02-19 06:59:01'),
(128, 1, 'login', 'User logged in.', '2025-02-19 07:00:04'),
(129, 1, 'login', 'User logged in.', '2025-02-19 07:06:30'),
(130, 1, 'General', 'User accessed General View', '2025-02-19 07:12:07'),
(131, 1, 'General', 'User accessed General View', '2025-02-19 07:13:41'),
(132, 1, 'logout', 'User logged out.', '2025-02-19 07:13:51'),
(133, 4, 'login', 'User logged in.', '2025-02-19 07:14:16'),
(134, 4, 'logout', 'User logged out.', '2025-02-19 07:15:34'),
(135, 1, 'login', 'User logged in.', '2025-02-19 07:15:43'),
(136, 1, 'General', 'User accessed General View', '2025-02-19 07:15:57'),
(137, 1, 'General', 'User accessed General View', '2025-02-19 07:16:00'),
(138, 1, 'General', 'User accessed General View', '2025-02-19 07:18:07'),
(139, 1, 'General', 'User accessed General View', '2025-02-19 07:18:08'),
(140, 1, 'General', 'User accessed General View', '2025-02-19 07:28:24'),
(141, 1, 'General', 'User accessed General View', '2025-02-19 07:28:35'),
(142, 1, 'General', 'User accessed General View', '2025-02-19 07:28:41'),
(143, 1, 'General', 'User accessed General View', '2025-02-19 07:28:42'),
(144, 1, 'General', 'User accessed General View', '2025-02-19 07:28:57'),
(145, 1, 'General', 'User accessed General View', '2025-02-19 07:32:20'),
(146, 1, 'General', 'User accessed General View', '2025-02-19 07:32:48'),
(147, 1, 'General', 'User accessed General View', '2025-02-19 07:32:48'),
(148, 1, 'General', 'User accessed General View', '2025-02-19 07:33:37'),
(149, 1, 'General', 'User accessed General View', '2025-02-19 07:33:37'),
(150, 1, 'General', 'User accessed General View', '2025-02-19 07:34:26'),
(151, 1, 'General', 'User accessed General View', '2025-02-19 07:34:34'),
(152, 1, 'General', 'User accessed General View', '2025-02-19 07:34:51'),
(153, 1, 'General', 'User accessed General View', '2025-02-19 07:40:58'),
(154, 1, 'General', 'User accessed General View', '2025-02-19 07:43:29'),
(155, 1, 'General', 'User accessed General View', '2025-02-19 07:43:33'),
(156, 1, 'General', 'User accessed General View', '2025-02-19 07:43:47'),
(157, 1, 'General', 'User accessed General View', '2025-02-19 07:46:32'),
(158, 1, 'General', 'User accessed General View', '2025-02-19 07:46:39'),
(159, 1, 'General', 'User accessed General View', '2025-02-19 07:48:15'),
(160, 1, 'General', 'User accessed General View', '2025-02-19 07:48:17'),
(161, 1, 'General', 'User accessed General View', '2025-02-19 07:48:55'),
(162, 1, 'General', 'User accessed General View', '2025-02-19 07:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `calculations`
--

CREATE TABLE `calculations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `input` varchar(90) DEFAULT NULL,
  `result` varchar(90) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calculations`
--

INSERT INTO `calculations` (`id`, `id_user`, `input`, `result`, `created_at`) VALUES
(84, 1, 'Price: Rp 1.089.820, Discount: 69%', 'Rp 337844.20', '2025-02-20 12:44:48'),
(85, 1, 'Price: Rp 99.999.999, Discount: 80%', 'Rp 19999999.80', '2025-02-20 12:45:48'),
(90, 1, 'Price: Rp 56.578, Discount: 12%', 'Rp 49788.64', '2025-02-20 14:58:00'),
(91, 1, 'Price: Rp 1.234, Discount: 7.3%', 'Rp 1143.9180000000001', '2025-02-21 01:11:40'),
(92, 1, 'Price: Rp 1.234, Discount: 70.3%', 'Rp 366.49800000000005', '2025-02-21 01:11:49'),
(93, 1, 'Price: Rp 89.000, Discount: 37%', 'Rp 56070', '2025-02-21 01:13:34'),
(94, 1, 'Price: Rp 89.000, Discount: 37%', 'Rp 56070', '2025-02-21 01:13:43'),
(95, 1, 'Price: Rp 89.000, Discount: 34.56%', 'Rp 58241.6', '2025-02-21 01:15:13'),
(96, 1, 'Price: Rp 89.000, Discount: 34.59%', 'Rp 58214.899999999994', '2025-02-21 01:15:19'),
(97, 1, 'Price: Rp 89.000, Discount: 12.43%', 'Rp 77937', '2025-02-21 01:16:35'),
(98, 1, 'Price: Rp 89.000, Discount: 34.59%', 'Rp 58215', '2025-02-21 01:16:49'),
(99, 1, 'Price: Rp 20.000, Discount: 10%', 'Rp 18000', '2025-02-21 01:33:43'),
(100, 1, 'Price: Rp 9.090, Discount: 89.8%', 'Rp 927', '2025-02-21 01:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `logo`) VALUES
(1, 'Calculator Math', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_asli` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` enum('aktif','deleted','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_asli`, `username`, `email`, `foto`, `level`, `pw`, `alamat`, `updated_by`, `updated_at`, `status`) VALUES
(1, 'IvanTill game is game', 'admin', 'IvanTill@gmail.com', 'ivan.png', 2, 'c4ca4238a0b923820dcc509a6f75849b', 'Ivanisalive jln. Tillisalive', 1, 2025, 'aktif'),
(2, 'jenn', 'duck ivan', 'duckivan@gmail.com', '', 1, '202cb962ac59075b964b07152d234b70', 'popopop', NULL, NULL, 'aktif'),
(3, 'jenn', 'Ivantill', 'ivansbf@gmail.com', '', 1, '202cb962ac59075b964b07152d234b70', 'ivan', NULL, NULL, 'aktif'),
(4, 'pak irfan', 'aa', 'jiaqian060707@gmail.com', 'ivan_1.jpg', 1, 'c4ca4238a0b923820dcc509a6f75849b', '', NULL, NULL, 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculations`
--
ALTER TABLE `calculations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculations`
--
ALTER TABLE `calculations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
