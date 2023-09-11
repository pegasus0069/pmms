-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 10:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(255) NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `body`, `owner_id`, `created_at`) VALUES
(1, 'Test Annoucement', 'THIS IS A TEST', 1, '2023-09-09 22:13:48'),
(2, 'Announcement Test', 'Hello This is a Test!', 5, '2023-09-09 23:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dept_id` varchar(6) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Pending','Approved','Rejected','Resolved') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `subject`, `description`, `dept_id`, `user_id`, `status`, `created_at`) VALUES
(1, 'Separate Complaints Sections', 'I think Separate Complaints Sections can be added', 'WEB', 2, 'Approved', '2020-04-28 06:43:41'),
(2, 'New CBSE Policy', 'I think new CBSE Policy can be implemented in School.', 'ACAD', 2, 'Pending', '2020-04-28 06:44:33'),
(3, 'Bug in Website', 'Hey,\r\nThere\'s a bug in your website in complaints Section.\r\nThanks', 'WEB', 3, 'Resolved', '2020-04-28 06:47:33'),
(4, 'IRAS not working', 'Iras is not accepting any requests!', 'WEB', 4, 'Resolved', '2023-09-09 22:12:06'),
(5, 'Course List Not Fixed Yet', 'Please fix the course list as soon as possible', 'CSE', 4, 'Resolved', '2023-09-09 22:26:33'),
(6, 'Test Subject', 'Test TEST TESTE', 'CSE', 4, 'Approved', '2023-09-09 22:30:11'),
(7, 'Test Subject', 'This is a test description', 'CSE', 4, 'Resolved', '2023-09-10 00:08:56'),
(8, 'Hello World', 'This is a test', 'CITS', 5, 'Pending', '2023-09-10 01:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `created_at`) VALUES
(1, 'Web Portal', 'WEB', '2020-04-28 05:29:11'),
(2, 'Academics', 'ACAD', '2020-04-28 06:01:16'),
(3, 'Central Information Technology Services', 'CITS', '2023-09-09 22:15:26'),
(4, 'Finance and Accounts Department', 'F&A', '2023-09-09 22:16:24'),
(5, 'Purchase and Procurement Department', 'P&P', '2023-09-09 22:17:41'),
(6, 'Human Resource Department', 'HR', '2023-09-09 22:18:52'),
(7, 'Facilities Department', 'FAC', '2023-09-09 22:20:02'),
(8, 'Operations and Maintenance Department', 'O&M', '2023-09-09 22:20:22'),
(9, 'Department of Computer Science and Engineering', 'CSE', '2023-09-09 22:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('Admin','Resolver','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `dept_id` varchar(6) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profileDefault.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `role`, `dept_id`, `password`, `profile_picture`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '7415555536', 'admin@demo.com', NULL, 'Admin', 'WEB', '$2y$10$7lVTZZPvtaKWJzhORD7lvOK.GQztZhckOnNFAdgM.1trYm2U3nhpa', 'arnoy.png', NULL, '2020-04-28 05:47:28', '2023-09-09 22:23:00'),
(2, 'User', '1234567890', 'user@demo.com', NULL, 'user', NULL, '$2y$10$tg7vvxjaQSWwXr6OE4ESa.fKfFrzF/8o8rkXSE2dBxqQs0EScGc4K', 'profileDefault.png', NULL, '2020-04-28 06:11:22', NULL),
(3, 'Caretaker', '4294967295', 'caretaker@demo.com', NULL, 'Resolver', 'ACAD', '$2y$10$FN8Rm9IBiL69.qApSKXKqOHAhN1VVGn5li/s6EOcrbQgnNC3kyIyS', 'profileDefault.png', NULL, '2020-04-28 06:40:01', NULL),
(4, 'Noor-E-Sadman', '01717916061', 'arnoyk123@gmail.com', NULL, 'User', NULL, '$2y$10$MnT6i16iVMNiBQeMFaeA1eJevZyk7gvX3X52BA1c51/zi9vrIz7be', 'arnoy.jpg', NULL, '2023-09-09 22:10:13', '2023-09-10 00:19:18'),
(5, 'Mahady Hasan', '1717916061', 'mahady@iub.edu.bd', NULL, 'Resolver', 'CSE', '$2y$10$a5CpTfFiPFAuprVVCQT4VeJdRdHTkfGlM9SUQpRsWQ8r7V8hVLGvO', 'mahady.jpeg', NULL, '2023-09-09 22:22:06', '2023-09-09 23:40:38'),
(7, 'CITS Admin', '1717916061', 'cits@iub.edu.bd', NULL, 'Resolver', 'CITS', '$2y$10$nfFBE6ThiS.K4okrpANi5eP14SL4nwDl0MYOw9LPHo7mO0lalZ9m6', 'profileDefault.png', NULL, '2023-09-10 01:08:09', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey_announcements_owner_id` (`owner_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey_complaints_user_id` (`user_id`),
  ADD KEY `fkey_complaints_dept_id` (`dept_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `depart_code_unique` (`code`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `foreign_key_dept_id` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `fkey_announcements_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `fkey_complaints_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkey_complaints_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `foreign_key_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`code`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
