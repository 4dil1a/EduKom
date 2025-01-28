-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 04:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edukom`
--

-- --------------------------------------------------------

--
-- Table structure for table `seminars`
--

CREATE TABLE `seminars` (
  `seminar_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` varchar(600) NOT NULL,
  `penyelenggara` varchar(255) DEFAULT NULL,
  `bentuk_acara` varchar(255) NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seminars`
--

INSERT INTO `seminars` (`seminar_id`, `judul`, `deskripsi`, `penyelenggara`, `bentuk_acara`, `poster`, `status`, `created_at`, `updated_at`, `tanggal`) VALUES
(2, 'fvghbnj', 'vghj', 'cvbn', 'cvbn', 'seminar_posters/1736772423_7f13f41e469ff2318e94.png', 'published', '2025-01-13 12:47:03', '2025-01-13 12:47:03', '2025-01-17'),
(3, 'ola', 'hn', 'bn', 'bn', 'seminar_posters/1736921059_be6574bfaf2d4bedae07.png', 'draft', '2025-01-15 06:04:19', '2025-01-15 06:04:19', '2025-01-18'),
(4, 'asdfgbnm', 'dfvgbn', 'vbn', 'cvb', 'seminar_posters/1736922061_b02ef52cf1198017692a.png', 'published', '2025-01-15 06:21:01', '2025-01-15 06:21:01', '2025-01-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`seminar_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `seminars`
--
ALTER TABLE `seminars`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
