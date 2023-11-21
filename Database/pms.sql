-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2023 at 11:19 PM
-- Server version: 8.0.35-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fablabiu_pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `complaint_id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `complaint_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 1, 5, 'Hello', '2023-09-12 02:51:13'),
(55, 8, 7, 'The problem is solved!', '2023-09-21 01:49:42'),
(56, 11, 7, 'Helo', '2023-09-21 02:26:32'),
(57, 12, 4, 'hello', '2023-09-21 02:37:28'),
(58, 12, 7, 'Hi', '2023-09-21 02:43:02'),
(59, 13, 7, 'Hello', '2023-09-21 02:50:05'),
(60, 13, 8, 'Hello!', '2023-09-21 02:53:48'),
(61, 13, 8, 'The routers will be purchased soon!', '2023-09-21 02:54:50'),
(62, 13, 8, 'The procurement is done!', '2023-09-21 02:55:14'),
(63, 13, 7, 'hello', '2023-09-21 02:59:06'),
(64, 13, 7, 'The products doesnt matches the specification provide earlier.', '2023-09-21 02:59:22'),
(65, 13, 7, 'The products doesn&#039;t matches the specification provide earlier.', '2023-09-21 03:05:05'),
(66, 13, 8, 'The changes are made according to your requirements!', '2023-09-21 03:12:51'),
(67, 14, 4, 'Please find the procurement details.', '2023-09-21 03:24:41'),
(68, 14, 8, 'Procurement request received.', '2023-09-21 03:25:36'),
(69, 14, 8, 'The procurement is completed please check the specifications of the computers.', '2023-09-21 03:26:16'),
(70, 16, 7, 'please take necessary actions. ', '2023-09-21 14:16:34'),
(71, 16, 8, 'We have taken necessary measures. ', '2023-09-21 14:17:44'),
(72, 14, 4, 'Hello', '2023-09-27 06:11:19'),
(73, 21, 7, 'Hello!', '2023-11-12 05:08:45'),
(74, 21, 7, 'Hello!', '2023-11-12 05:08:58'),
(75, 21, 7, 'The problem is resolved.', '2023-11-12 05:09:27'),
(76, 22, 7, 'Hello', '2023-11-12 05:52:33'),
(77, 22, 7, 'The problem is still unresolved.', '2023-11-12 06:03:49'),
(78, 29, 11, 'Hello', '2023-11-21 08:31:01'),
(79, 30, 7, 'The problem is solved!', '2023-11-21 08:41:11'),
(80, 28, 13, 'Test', '2023-11-21 09:01:50'),
(81, 31, 13, 'Resolved', '2023-11-21 09:03:01'),
(82, 32, 15, 'Hello', '2023-11-21 09:20:42'),
(83, 32, 7, 'Hello', '2023-11-21 09:21:44'),
(84, 32, 7, 'Resolved', '2023-11-21 09:22:18'),
(85, 32, 15, 'The problem is not solved yet properly', '2023-11-21 09:23:00'),
(86, 28, 14, 'Test', '2023-11-21 09:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint UNSIGNED NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dept_id` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('Pending','Approved','Unresolved','Resolved','Completed') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `service_name` text COLLATE utf8mb4_general_ci,
  `service_category` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `subject`, `description`, `dept_id`, `user_id`, `status`, `created_at`, `service_name`, `service_category`) VALUES
(1, 'Separate Complaints Sections', 'I think Separate Complaints Sections can be added', 'WEB', 2, 'Resolved', '2020-04-28 06:43:41', NULL, ''),
(3, 'Bug in Website', 'Hey,\r\nThere\'s a bug in your website in complaints Section.\r\nThanks', 'WEB', 3, 'Resolved', '2020-04-28 06:47:33', NULL, ''),
(4, 'IRAS not working', 'Iras is not accepting any requests!', 'WEB', 4, 'Approved', '2023-09-09 22:12:06', NULL, ''),
(5, 'Course List Not Fixed Yet', 'Please fix the course list as soon as possible', 'CSE', 4, 'Approved', '2023-09-09 22:26:33', NULL, ''),
(6, 'Test Subject', 'Test TEST TESTE', 'CSE', 4, 'Approved', '2023-09-09 22:30:11', NULL, ''),
(7, 'Test Subject', 'This is a test description', 'CSE', 4, 'Approved', '2023-09-10 00:08:56', NULL, ''),
(8, 'Hello World', 'This is a test', 'CITS', 5, 'Resolved', '2023-09-10 01:06:50', NULL, ''),
(9, 'Admin Test', 'Admin Test ', 'WEB', 5, 'Approved', '2023-09-11 23:49:21', NULL, ''),
(11, 'Test Run', 'Heloo This is a Test!', 'CITS', 4, 'Approved', '2023-09-21 02:25:53', NULL, ''),
(12, 'Hello Test', 'This is another test job!', 'CITS', 4, 'Approved', '2023-09-21 02:35:30', NULL, ''),
(13, 'Router RFQ', 'Please buy the following routers!', 'P&P', 7, 'Approved', '2023-09-21 02:49:50', NULL, ''),
(14, 'CSCLAB4 Computer RFQ', 'Please procure 10 units of high configuration Desktop Computers.', 'P&P', 4, 'Approved', '2023-09-21 03:24:08', NULL, ''),
(15, 'Hello test', 'Testing going', 'CITS', 7, 'Pending', '2023-09-21 09:52:54', NULL, ''),
(16, 'AC needs to be purchansed', 'need 2 ton ac in the data center', 'P&P', 7, 'Unresolved', '2023-09-21 14:16:05', NULL, ''),
(18, 'Router required at Fablab', 'Two routers are required to support an event at Fablab.', 'CITS', 7, 'Pending', '2023-11-12 03:57:46', NULL, ''),
(19, 'Router required at Fablab', 'Router required at Fablab', 'CITS', 7, 'Pending', '2023-11-12 04:08:42', NULL, ''),
(20, 'Router required at Fablab', 'Router required at Fablab', 'CITS', 7, 'Pending', '2023-11-12 04:10:07', 'Network Infrastructure', 'CITS'),
(21, 'Lab Computer Number 001 is not working', 'Lab Computer Number 001 is not working', 'CITS', 7, 'Approved', '2023-11-12 05:08:12', 'Computer Labs', 'CITS'),
(22, 'Router required at Fablab', 'Test purpose', 'CITS', 7, 'Unresolved', '2023-11-12 05:52:16', 'Learning Management Systems (LMS)', 'CITS'),
(23, 'Router required at Fablab', 'Router required at Fablab', 'CITS', 8, 'Pending', '2023-11-20 22:25:25', 'Learning Management Systems (LMS)', 'CITS'),
(24, 'Test Subject', 'Test description', 'FAC', 10, 'Pending', '2023-11-21 08:01:02', 'Legal Issue ', ''),
(25, 'Test Service', 'Test Service', 'FAC', 10, 'Pending', '2023-11-21 08:01:37', 'Legal Issue ', ''),
(26, 'Legal Issue Test', 'Legal Issue Test', 'FAC', 10, 'Pending', '2023-11-21 08:06:47', 'Legal Issue ', ''),
(27, 'Test Subject', 'Test description', 'FAC', 7, 'Pending', '2023-11-21 08:08:37', 'Legal Issue ', ''),
(28, 'Test Subject', 'Test Subject', 'O&M', 7, 'Resolved', '2023-11-21 08:09:50', 'Power Supply and Distribution', ''),
(29, 'TEST Subject', 'Test Subject', 'CITS', 11, 'Pending', '2023-11-21 08:30:45', 'Email and Communication', ''),
(30, 'Test Subject', 'Test Description', 'CITS', 12, 'Approved', '2023-11-21 08:39:56', 'Email and Communication', ''),
(31, 'Test Subject', 'Test Subject', 'O&M', 13, 'Approved', '2023-11-21 09:02:32', 'Generator support', ''),
(32, 'Test Subject', 'Test Description', 'CITS', 15, 'Approved', '2023-11-21 09:20:13', 'Technical Support', '');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `created_at`) VALUES
(1, 'Web Portal Access', 'WEB', '2023-11-12 00:58:07'),
(3, 'Central Information Technology Services', 'CITS', '2023-09-09 22:15:26'),
(4, 'Finance and Accounts Department', 'F&A', '2023-09-09 22:16:24'),
(5, 'Purchase and Procurement Department', 'P&P', '2023-09-09 22:17:41'),
(6, 'Human Resource Department', 'HR', '2023-09-09 22:18:52'),
(7, 'Facilities and Protocol Department', 'FAC', '2023-09-09 22:20:02'),
(8, 'Operations and Maintenance Department', 'O&M', '2023-09-09 22:20:22'),
(9, 'Department of Computer Science and Engineering', 'CSE', '2023-09-09 22:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `department_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `department_id`, `created_at`, `category`) VALUES
(2, 'Plumbing', 'Plumbing services', 8, '2023-11-20 02:01:30', 'Civil Works'),
(3, 'Painting', 'Painting work requirements', 8, '2023-11-20 02:01:45', 'Civil Works'),
(4, 'Lighting', 'Any sort of lighting issue service', 8, '2023-11-20 02:02:00', 'Electrical Works'),
(5, 'Network Infrastructure', 'Providing and maintaining a robust and secure network infrastructure to ensure reliable internet connectivity across campus.', 3, '2023-11-20 02:02:14', 'CITS'),
(6, 'Email and Communication', 'Offering email services and communication tools tofacilitate effective collaboration and communication among students, faculty, and staff.', 3, '2023-11-20 02:02:23', 'CITS'),
(7, 'Learning Management Systems (LMS)', 'Managing and supporting the university’s LMS platform, where course materials, assignments, and grades are shared, and online learning resources are available.', 3, '2023-11-20 02:02:46', 'CITS'),
(9, 'Technical Support', 'Offering technical assistance and troubleshooting for hardware, software, and network issues faced by students and staff.', 3, '2023-11-20 02:02:57', 'CITS'),
(10, 'Computer Labs', 'Maintaining and managing computer labs equipped with necessary software for various disciplines and courses.', 3, '2023-11-20 02:03:21', 'CITS'),
(11, 'Cybersecurity', 'Implementing security measures to protect sensitive data, systems, and user information from cyber threats and breaches.', 3, '2023-11-20 02:04:13', 'CITS'),
(12, 'Wireless Access', 'Providing secure and reliable wireless access points across campus to enable students and staff to connect their devices to the network.', 3, '2023-11-20 02:03:59', 'CITS'),
(13, 'Software Licensing', 'Managing licenses for software applications used by the university community, ensuring compliance and availability.', 3, '2023-11-20 02:03:33', 'CITS'),
(14, 'Data Storage and Backup', 'Offering data storage solutions and backup services toensure data integrity and availability.', 3, '2023-11-20 02:02:36', 'CITS'),
(15, 'Furniture', 'Furniture maintenance work!', 8, '2023-11-20 02:01:00', 'Civil Works'),
(16, 'Interior', 'Interior-based services', 8, '2023-11-21 03:25:25', 'Civil Works'),
(17, 'Signage', 'Signage installations and servicing', 8, '2023-11-21 03:26:29', 'Civil Works'),
(18, 'Hardware', 'Hardware related services', 8, '2023-11-21 03:26:56', 'Civil Works'),
(19, 'Power Supply and Distribution', 'Power supply & distribution-related services and maintenance', 8, '2023-11-21 03:31:08', 'Electrical Works'),
(20, 'Generator support', 'Generator support', 8, '2023-11-21 03:28:34', 'Electrical Works'),
(21, 'Event Management Support', 'Event Management Support', 8, '2023-11-21 03:29:00', 'Electrical Works'),
(22, 'Fire Detection and Alarm System', 'Fire detection & alarm System', 8, '2023-11-21 03:31:28', 'Electrical Works'),
(23, 'Power Socket', 'Power socket support services', 8, '2023-11-21 03:33:55', 'Electrical Works'),
(24, 'Exhaust Fan', 'Exhaust fan servicing or installation services', 8, '2023-11-21 03:34:40', 'Electrical Works'),
(25, 'Photocopier Service', 'Photocopier Service', 8, '2023-11-21 03:35:44', 'Electrical Works'),
(26, 'Internal Electrification', 'Internal Electrification', 8, '2023-11-21 03:36:02', 'Electrical Works'),
(27, 'Split AC', 'Split AC', 8, '2023-11-21 03:36:44', 'Mechanical Works'),
(28, 'VRF AC', 'VRF AC', 8, '2023-11-21 03:37:05', 'Mechanical Works'),
(29, 'Central AC', 'Central AC', 8, '2023-11-21 03:37:23', 'Mechanical Works'),
(30, 'Fire Hydrant', 'Fire Hydrant', 8, '2023-11-21 03:37:40', 'Mechanical Works'),
(31, 'Lift', 'Lift servicing and maintenance', 8, '2023-11-21 03:38:08', 'Mechanical Works'),
(32, 'New AC Installation', 'New AC installation support', 8, '2023-11-21 03:38:42', 'Mechanical Works'),
(33, 'Infrastructure Development', 'Infrastructure development related services', 8, '2023-11-21 03:39:19', 'Infrastructure Development'),
(34, 'Others', 'Others', 8, '2023-11-21 03:39:35', 'Others'),
(35, 'Legal Issue ', 'Legal Issue ', 7, '2023-11-21 04:15:08', 'Legal Issue '),
(36, 'Issue New IP Phone Number', 'Issue New IP Phone Number', 8, '2023-11-21 08:47:05', 'Others'),
(37, 'Name change of IP Phone holder', 'Name change of IP Phone holder', 8, '2023-11-21 08:48:42', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('Admin','Resolver','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `dept_id` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
(2, 'User', '1234567890', 'user@demo.com', NULL, 'User', NULL, '$2y$10$tg7vvxjaQSWwXr6OE4ESa.fKfFrzF/8o8rkXSE2dBxqQs0EScGc4K', 'profileDefault.png', NULL, '2020-04-28 06:11:22', NULL),
(3, 'Caretaker', '4294967295', 'caretaker@demo.com', NULL, 'Resolver', NULL, '$2y$10$FN8Rm9IBiL69.qApSKXKqOHAhN1VVGn5li/s6EOcrbQgnNC3kyIyS', 'profileDefault.png', NULL, '2020-04-28 06:40:01', NULL),
(4, 'Noor-E-Sadman', '01717916061', 'arnoyk123@gmail.com', NULL, 'User', NULL, '$2y$10$MnT6i16iVMNiBQeMFaeA1eJevZyk7gvX3X52BA1c51/zi9vrIz7be', 'arnoy.jpg', NULL, '2023-09-09 22:10:13', '2023-11-09 22:55:48'),
(5, 'Mahady Hasan', '1717916061', 'mahady@iub.edu.bd', NULL, 'Resolver', 'CSE', '$2y$10$a5CpTfFiPFAuprVVCQT4VeJdRdHTkfGlM9SUQpRsWQ8r7V8hVLGvO', 'mahady.jpeg', NULL, '2023-09-09 22:22:06', '2023-09-09 23:40:38'),
(7, 'CITS Admin', '1717916061', 'cits@iub.edu.bd', NULL, 'Resolver', 'CITS', '$2y$10$nfFBE6ThiS.K4okrpANi5eP14SL4nwDl0MYOw9LPHo7mO0lalZ9m6', 'profileDefault.png', NULL, '2023-09-10 01:08:09', NULL),
(8, 'Purchase Admin', '1717916062', 'purchase@iub.edu.bd', NULL, 'Resolver', 'P&P', '$2y$10$CIU2WIKtKe9SywuOLIDIPuncAtd5BXyzYNQkQynn4zEEvlBivYP7O', 'profileDefault.png', NULL, '2023-09-21 02:52:35', NULL),
(10, 'Facilities Admin', '1717916061', 'facilities@iub.edu.bd', NULL, 'Resolver', 'FAC', '$2y$10$FPobv1yzqteRcP16aigSGOXMcwEeWfaa5K1Rg.70X6/b./.OhIqYW', 'profileDefault.png', NULL, '2023-11-21 04:21:12', NULL),
(11, 'Mostofa', '1716364439', 'mostofa@iub.edu.bd', NULL, 'Resolver', 'O&M', '$2y$10$sqdeJAnA/2D6x76xOJWcbujaE35Y33HNmVkkgN8hy2TiOdiAFEoO6', 'profileDefault.png', NULL, '2023-11-21 08:28:36', NULL),
(12, 'Md. Ashraful Alam', '1816054764', 'ashraf@iub.edu.bd', NULL, 'Resolver', 'O&M', '$2y$10$nMiVJz7GjvMtMxoOSnRNWeJaK2yF2R5vNga.1bum0fBmbZy4gjdrC', 'profileDefault.png', NULL, '2023-11-21 08:35:49', NULL),
(13, 'Muhammad Zahedur Rahman', '1630408384', 'zahedur@iub.edu.bd', NULL, 'Resolver', 'O&M', '$2y$10$kas3MhFEjH7ng7pmO7gV2ei9Nwz/iSXTKXwU7lic2/pLONczWYH5W', 'profileDefault.png', NULL, '2023-11-21 08:57:21', NULL),
(14, 'ASM Shah Alam', '1913464710', 's.alam@iub.edu.bd', NULL, 'Resolver', 'O&M', '$2y$10$sEAsHYhheYdV1b7eXBB3kOgExgb18FAmoX26RaKMTc6/442l92K7a', 'profileDefault.png', NULL, '2023-11-21 09:15:03', NULL),
(15, 'Md Abdul Jabber', '1670179240', 'jabber@iub.edu.bd', NULL, 'Resolver', 'O&M', '$2y$10$5Yfy/RgsKgtVTlEKdLW5eug.FuWJNLgBEFxLgasQ7avaDkDGUhwey', 'profileDefault.png', NULL, '2023-11-21 09:17:19', NULL);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Commentuid` (`user_id`);

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
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `fkey_announcements_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Commentuid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
