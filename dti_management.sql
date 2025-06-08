-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 11:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dti_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `dti_categories`
--

CREATE TABLE `dti_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_column` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dti_categories`
--

INSERT INTO `dti_categories` (`id`, `name`, `description`, `parent_id`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'Chính quyền số', 'Chính quyền số là việc triển khai các chuyển đổi số tại các cấp chính quyền địa phương (cấp tỉnh, quận, huyện, xã,..). Toàn bộ các hoạt động của chính quyền được triển khai và vận hành trên nền tảng hệ thống công nghệ thông tin.', NULL, 1, '2025-06-07 03:03:21', '2025-06-07 08:51:12'),
(3, 'Nhận thức số', 'Chỉ số Nhận thức số ....', NULL, 2, '2025-06-07 08:49:25', '2025-06-07 08:51:12'),
(5, 'test', 'sdg hs df', NULL, 0, '2025-06-07 09:00:30', '2025-06-07 09:00:30'),
(6, 'tssdgdg', 'fhgf', 5, 0, '2025-06-07 09:00:48', '2025-06-07 09:00:48'),
(7, 'Cấp 2', 'sgd dsgsd', 6, 0, '2025-06-07 09:13:02', '2025-06-07 09:13:02'),
(8, 'Danh mục gốc X', NULL, NULL, 0, '2025-06-07 09:17:24', '2025-06-07 09:17:24'),
(9, 'Tab sẽ đóng', NULL, 7, 0, '2025-06-07 09:19:04', '2025-06-07 09:19:04'),
(10, 'gdgds h', NULL, NULL, 0, '2025-06-07 09:21:40', '2025-06-07 09:21:40'),
(11, 'y575765', NULL, 9, 0, '2025-06-07 09:28:01', '2025-06-07 09:28:01'),
(12, 'ytrutrur', NULL, NULL, 0, '2025-06-07 09:28:43', '2025-06-07 09:28:43'),
(13, 'hgfjgfjfg', NULL, NULL, 0, '2025-06-07 09:28:56', '2025-06-07 09:28:56'),
(14, '12', NULL, NULL, 0, '2025-06-07 09:29:20', '2025-06-07 09:29:20'),
(15, '134', NULL, NULL, 0, '2025-06-07 09:32:04', '2025-06-07 09:32:04'),
(16, 'gdfhfd', NULL, NULL, 3, '2025-06-07 09:36:21', '2025-06-07 09:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `dti_data_entries`
--

CREATE TABLE `dti_data_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dti_indicator_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `entry_date` date NOT NULL,
  `entry_period` varchar(255) DEFAULT NULL,
  `numeric_value` decimal(12,4) DEFAULT NULL,
  `boolean_value` tinyint(1) DEFAULT NULL,
  `text_value` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dti_indicators`
--

CREATE TABLE `dti_indicators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `dti_category_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('numeric','percentage','boolean','text','decimal') NOT NULL,
  `max_value` decimal(8,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_06_145543_create_dti_categories_table', 1),
(6, '2025_06_06_145606_create_dti_indicators_table', 1),
(7, '2025_06_06_145623_create_dti_data_entries_table', 1),
(8, '2025_06_07_080114_create_permission_tables', 1),
(9, '2025_06_07_102349_add_order_to_dti_categories_table', 2),
(10, '2025_06_07_155534_add_parent_id_to_dti_categories_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49'),
(2, 'manage roles', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49'),
(3, 'configure indicators', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49'),
(4, 'enter dti data', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49'),
(5, 'view dti reports', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49'),
(2, 'manager', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49'),
(3, 'data entry clerk', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49'),
(4, 'viewer', 'web', '2025-06-07 02:21:49', '2025-06-07 02:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(5, 4);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$10$0qRzUmqhq3abZyNGC4F9uOCJx3sIrSE5bJV/D94n.0jCN5CtbsNdG', NULL, '2025-06-07 02:21:50', '2025-06-07 02:21:50'),
(2, 'Manager User', 'manager@example.com', NULL, '$2y$10$oQ59KsrZG0pnLNn2ZIBEr.uUaLdIrDL7BFvdvPWCXizlljnmm/XVe', NULL, '2025-06-07 02:21:50', '2025-06-07 02:21:50'),
(3, 'Data Entry User', 'dataentry@example.com', NULL, '$2y$10$PJgGs.gyyCw2kJtR2.z/ZOQByDIKzFtA6cKa/d9/gJbyhSzq6qXNS', NULL, '2025-06-07 02:21:50', '2025-06-07 02:21:50'),
(4, 'Viewer User', 'viewer@example.com', NULL, '$2y$10$FnDC.oz7pJhRGqJCtD2yLuEa/DProwuFDX9kn0KeSZx9Pw99wIG8O', NULL, '2025-06-07 02:21:50', '2025-06-07 02:21:50'),
(5, 'thangtv', 'thangtv@gmail.com', NULL, '$2y$10$ZHx8/SlaCEqcfAHTJ1dW1O6bHH86FOXxNweeFpYCLIlNjOEfAgATu', NULL, '2025-06-07 04:46:43', '2025-06-07 04:46:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dti_categories`
--
ALTER TABLE `dti_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dti_categories_name_unique` (`name`),
  ADD KEY `dti_categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `dti_data_entries`
--
ALTER TABLE `dti_data_entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dti_data_entries_dti_indicator_id_entry_date_user_id_unique` (`dti_indicator_id`,`entry_date`,`user_id`),
  ADD KEY `dti_data_entries_user_id_foreign` (`user_id`);

--
-- Indexes for table `dti_indicators`
--
ALTER TABLE `dti_indicators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dti_indicators_name_dti_category_id_unique` (`name`,`dti_category_id`),
  ADD UNIQUE KEY `dti_indicators_code_unique` (`code`),
  ADD KEY `dti_indicators_dti_category_id_foreign` (`dti_category_id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `dti_categories`
--
ALTER TABLE `dti_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `dti_data_entries`
--
ALTER TABLE `dti_data_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dti_indicators`
--
ALTER TABLE `dti_indicators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dti_categories`
--
ALTER TABLE `dti_categories`
  ADD CONSTRAINT `dti_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `dti_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dti_data_entries`
--
ALTER TABLE `dti_data_entries`
  ADD CONSTRAINT `dti_data_entries_dti_indicator_id_foreign` FOREIGN KEY (`dti_indicator_id`) REFERENCES `dti_indicators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dti_data_entries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dti_indicators`
--
ALTER TABLE `dti_indicators`
  ADD CONSTRAINT `dti_indicators_dti_category_id_foreign` FOREIGN KEY (`dti_category_id`) REFERENCES `dti_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
