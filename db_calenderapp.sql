-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 09, 2022 at 01:27 PM
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
-- Database: `db_calenderapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_events`
--

CREATE TABLE `tbl_leave_events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `leave_type` int(4) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Pending,1=>Approved,2=>cancelled',
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_leave_events`
--

INSERT INTO `tbl_leave_events` (`id`, `user_id`, `event_title`, `start_date`, `end_date`, `leave_type`, `description`, `status`, `created_on`, `updated_on`) VALUES
(1, 2, 'test', '2022-09-02 06:30:00', '2022-09-03 06:30:00', 1, 'it is for tesigng', 0, '2022-09-07 10:34:44', '2022-09-07 10:34:44'),
(2, 2, 'test1', '2022-09-02 06:30:00', '2022-09-03 06:30:00', 1, 'it is for tesign', 0, '2022-09-07 10:39:23', '2022-09-07 10:39:23'),
(3, 2, 'test1', '2022-09-02 06:30:00', '2022-09-03 06:30:00', 3, 'test', 1, '2022-09-07 10:41:04', '2022-09-08 07:43:12'),
(4, 2, 'test11', '2022-09-05 06:30:00', '2022-09-06 06:30:00', 4, 'it is for testing', 0, '2022-09-07 10:42:18', '2022-09-07 10:42:18'),
(5, 2, 'test12', '2022-09-02 06:30:00', '2022-09-03 06:30:00', 2, 'testing data', 1, '2022-09-07 10:43:52', '2022-09-08 07:35:53'),
(6, 3, 'Metting Setup', '2022-09-15 06:30:00', '2022-09-16 06:30:00', 1, 'it is for tesing', 0, '2022-09-08 11:24:29', '2022-09-08 11:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restricted_dates`
--

CREATE TABLE `tbl_restricted_dates` (
  `id` int(11) NOT NULL,
  `restricted_dated` text NOT NULL,
  `year` year(4) NOT NULL,
  `status` int(4) NOT NULL DEFAULT 1,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_restricted_dates`
--

INSERT INTO `tbl_restricted_dates` (`id`, `restricted_dated`, `year`, `status`, `created_on`, `updated_on`) VALUES
(1, '[\"2022-09-05\",\"2022-09-06\",\"2022-09-12\",\"2022-09-14\",\"2022-09-19\",\"2022-09-21\",\"2022-09-23\",\"2022-09-26\",\"2022-09-29\"]', 2022, 1, '2022-09-09 11:02:38', '2022-09-09 11:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(4) NOT NULL DEFAULT 1 COMMENT '1=>Active,0=>Inactive	',
  `role` int(4) NOT NULL DEFAULT 2 COMMENT '1=>Admin,2=>Staff',
  `assigned_color` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `role`, `assigned_color`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$BcP5VKshRE9OOQxlOVtYAuRy7nDtny1piM1hcDq31DBBmF7YRhgqu', NULL, 1, 1, NULL, '2022-09-06 18:27:56', '2022-09-06 18:27:56'),
(2, 'dev singh', 'dev@yopmail.com', NULL, '$2y$10$s1B0j0RtbnhiOaGwxSAkF.t8FGwplBmu2LzrItE6AX0qKQ3HNxTKy', NULL, 1, 2, '#6D1F36', '2022-09-06 23:00:28', '2022-09-08 05:39:17'),
(3, 'Rajbir', 'rajbir@yopmail.com', NULL, '$2y$10$cwj0dI1NSZu6q7tOcF36De8uAyB15/juwa17LhXfs5P8MMSu19ZiO', NULL, 1, 2, '#5F9E5F', '2022-09-08 05:49:03', '2022-09-08 05:49:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_leave_events`
--
ALTER TABLE `tbl_leave_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_restricted_dates`
--
ALTER TABLE `tbl_restricted_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_leave_events`
--
ALTER TABLE `tbl_leave_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_restricted_dates`
--
ALTER TABLE `tbl_restricted_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
