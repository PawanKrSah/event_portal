-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 08:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('adbu-student-event-cache-pawan@mail.com|127.0.0.1', 'i:1;', 1774684080),
('adbu-student-event-cache-pawan@mail.com|127.0.0.1:timer', 'i:1774684080;', 1774684080),
('campus-event-portal-cache-admin@gmail.com|127.0.0.1', 'i:1;', 1772254016),
('campus-event-portal-cache-admin@gmail.com|127.0.0.1:timer', 'i:1772254016;', 1772254016),
('campus-event-portal-cache-sid@mail.com|127.0.0.1', 'i:1;', 1772257920),
('campus-event-portal-cache-sid@mail.com|127.0.0.1:timer', 'i:1772257920;', 1772257920),
('laravel-cache-admin@gmail.com|127.0.0.1', 'i:1;', 1772030164),
('laravel-cache-admin@gmail.com|127.0.0.1:timer', 'i:1772030164;', 1772030164),
('student-events-cache-ari@gmail.com|127.0.0.1', 'i:2;', 1772610446),
('student-events-cache-ari@gmail.com|127.0.0.1:timer', 'i:1772610446;', 1772610446);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `venue` varchar(255) NOT NULL,
  `event_date` datetime NOT NULL,
  `max_capacity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `venue`, `event_date`, `max_capacity`, `created_at`, `updated_at`) VALUES
(1, 'IoT Workshop 2026', 'Hands-on session for MCA students.', 'MCA Lab 2nd Floor', '2026-03-15 10:00:00', 60, '2026-02-24 09:23:31', '2026-02-25 09:39:58'),
(3, 'Guest Lecture on Sustainable Development', 'Dr Prasank Sarma from IIT Delhi will be giving insightful lecture on sustainable development.', 'Conference Room 4th floor', '2026-03-09 11:00:00', 30, '2026-02-25 09:36:30', '2026-03-04 13:05:18'),
(5, 'ITA Presentation', 'All students of MCA 2nd semester are asked to prepare for presentation and Last date of submission in google classroom is on 4th march.', 'Room no. 223', '2026-03-06 08:30:00', 60, '2026-03-01 07:16:38', '2026-03-04 13:04:39'),
(6, 'Inter Department Chess Compition', 'Students are requested to participate in the event and showcase their skills and to represent their department. Do register early the seats are limited. \r\nAttendance and e-certificate will be given to all the participants.', 'Boys common room Ground Floor', '2026-03-18 10:30:00', 60, '2026-03-01 07:30:27', '2026-03-01 07:30:27'),
(7, 'Creating an event for 1 attendee', 'Only one student can register', 'Conference Room 4th floor', '2026-03-28 18:34:00', 1, '2026-03-01 07:34:22', '2026-03-05 08:33:14'),
(8, 'event 1', 'daas', 'MCA LAB', '2026-03-17 09:35:00', 30, '2026-03-05 22:35:20', '2026-03-05 22:35:20'),
(9, 'Inter Department Quiz Competition', 'Students are asked to participate in this event to demonstrate there knowledge and represent there Departments', 'Language lab Ground floor', '2026-04-02 20:36:00', 50, '2026-03-28 09:36:55', '2026-03-28 09:36:55'),
(10, 'Guest lecture on AI for Daily life', 'An alumni of our institute has taken the initiative to give us a lecture on how we can use AI in our daily lives, all students are requested to join this lecture as this lecture will be conducted through online mode.', 'Online mode', '2026-04-06 09:00:00', 500, '2026-03-28 22:05:38', '2026-03-28 22:05:38'),
(11, 'Bohag Bihu Celebration', 'Student are asked to attend this event to experience and to learn about the rich Assamese culture and tradition', 'Atrium', '2026-04-13 10:00:00', 500, '2026-03-28 22:13:18', '2026-03-28 22:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `event_notifications`
--

CREATE TABLE `event_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_notifications`
--

INSERT INTO `event_notifications` (`id`, `event_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 3, 'the event has been postponed to 05 March', '2026-02-25 12:48:16', '2026-02-25 12:48:16'),
(2, 1, 'the event venue has been changed to Lab 2', '2026-02-25 13:03:51', '2026-02-25 13:03:51'),
(3, 1, 'hi', '2026-03-01 21:58:53', '2026-03-01 21:58:53'),
(4, 1, 'Student are asked to bring there laptops.', '2026-03-02 23:39:44', '2026-03-02 23:39:44'),
(5, 7, 'hello', '2026-03-04 23:47:35', '2026-03-04 23:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `event_user`
--

CREATE TABLE `event_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_user`
--

INSERT INTO `event_user` (`id`, `event_id`, `user_id`, `created_at`, `updated_at`) VALUES
(17, 3, 7, NULL, NULL),
(18, 5, 3, NULL, NULL),
(20, 1, 3, NULL, NULL),
(21, 7, 3, NULL, NULL),
(22, 6, 3, NULL, NULL),
(36, 5, 8, NULL, NULL),
(37, 1, 8, NULL, NULL),
(38, 3, 8, NULL, NULL),
(39, 6, 8, NULL, NULL),
(40, 1, 9, NULL, NULL),
(41, 3, 9, NULL, NULL),
(42, 1, 10, NULL, NULL),
(43, 10, 10, NULL, NULL),
(44, 11, 10, NULL, NULL),
(45, 9, 11, NULL, NULL),
(46, 10, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_14_170933_add_two_factor_columns_to_users_table', 1),
(5, '2026_02_24_143224_add_role_to_users_table', 2),
(6, '2026_02_24_144632_create_events_table', 3),
(7, '2026_02_24_182912_add_student_id_to_users_table', 4),
(8, '2026_02_24_192508_create_event_user_table', 5),
(9, '2026_02_25_172727_create_event_notifications_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('fardin@gmail.com', '$2y$12$B3Pwa2ynFv5PDXeo8Az0jucbhU2CTzKdub5y3RfiN1IxkgUaGZ9Jy', '2026-03-28 23:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Am4SKoXF4O8AEU830gXP8S1pYoH2SzcZo0OIIItE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFlKWjg2ZU9Mbk52ZmVFSjd4NHFCcFpOSURQMTdRVkJGdmxvRUJjTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774766990),
('oQrNJ6Gd2CQVroYDR8zTvKllz7xkU29Hjn25iH0b', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1M4TFFWVkFMcWVkNVQ4akZVYjRzcVZ3N0duZXJBdFpmSXNyMVNmUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1774763904),
('WBQ2Q4niDOokbPIGGBEzOiKTjjC3J2Lxb8Kgutos', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHZIQ1dOM2Ntd1ZmTnJ1NnJGVEFwZGo3SUp6cDdqcDBlblVubWx1ciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1774710415);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'student',
  `student_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `role`, `student_id`) VALUES
(1, 'University Admin', 'admin@event.com', NULL, '$2y$12$lDxCg8Jcw5CExauNMgw5p.TzrJDqZ..YfpwAukgI5E3xcARB.z64i', NULL, NULL, NULL, NULL, '2026-02-24 09:05:11', '2026-02-24 09:05:11', 'admin', NULL),
(3, 'PAWAN KUMAR SAH', 'pawan@gmail.com', NULL, '$2y$12$64aDzW46tnn8.Nr.hvub5OAv.Y2cH9cYFrLDHQ4O2fV85rRY8XmkS', NULL, NULL, NULL, 'nAX9iFZrhfcHdOKzycOajqunBYyWWFkYo6yZOw3GBusSFCdl0suDS8LwlZ9D', '2026-02-24 15:03:12', '2026-03-02 23:37:09', 'admin', 'DC2025MCA0053'),
(7, 'Ariesha R Marak', 'ari@gmail.com', NULL, '$2y$12$KtMClxVnLeYOv2O71Ul3be3Q48zfwm0f4O3eD.qTDm/Qqc9WgGuly', NULL, NULL, NULL, '4EQFdKKpZ2HJdhuVhtylnICCkj0Jyh9SOCiUVGy6PeFJHPAdSJPjRv5XJkQG', '2026-03-01 22:07:23', '2026-03-03 00:02:29', 'student', 'DC2025MCA0005'),
(8, 'Julius', 'julius@gmail.com', NULL, '$2y$12$iYvZ5AcmL2vioTnpq0QsP.JCW.JWLivlDe3yobqTy/BEln84OPDla', NULL, NULL, NULL, NULL, '2026-03-05 01:22:14', '2026-03-05 01:22:14', 'student', 'DC2025MCA0045'),
(9, 'Abhishake Horo', 'abhishake@gmail.com', NULL, '$2y$12$QaYeyzPjIXE15zMDSSGfFOGDfjetxehzdr.DtpIZ4Sxwn85oU0hcG', NULL, NULL, NULL, NULL, '2026-03-05 22:14:32', '2026-03-05 22:14:32', 'student', 'DC2025MCA0009'),
(10, 'Parthiv Gogoi', 'gogoiparthiv@gmail.com', NULL, '$2y$12$dqgKa9D/M3VbBK5ClIkqiev0TLsJyrUqNg6Pv.3fRYNJ1J7FGCBZ6', NULL, NULL, NULL, '5rTkFNkkxzqzoHvPNxpfuMQzVWIGL1a8wLkCriYuusmdQHuettSFOWDIdxLk', '2026-03-05 22:33:01', '2026-03-05 22:33:01', 'student', 'DC2025MCA0056'),
(11, 'Fardin Ahmed', 'fardin@gmail.com', NULL, '$2y$12$WgsbxiJzA7yYsVLx3FYNA.kmydDEWjTmGdsacLxoUHxY41liDJxgm', NULL, NULL, NULL, NULL, '2026-03-28 23:56:10', '2026-03-28 23:56:10', 'student', 'DC2025MCA0008');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_notifications`
--
ALTER TABLE `event_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_notifications_event_id_foreign` (`event_id`);

--
-- Indexes for table `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_user_event_id_foreign` (`event_id`),
  ADD KEY `event_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_id_unique` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `event_notifications`
--
ALTER TABLE `event_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_user`
--
ALTER TABLE `event_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_notifications`
--
ALTER TABLE `event_notifications`
  ADD CONSTRAINT `event_notifications_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
