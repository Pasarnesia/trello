-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Des 2018 pada 08.27
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trello`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_cards`
--

CREATE TABLE `activity_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `order` int(11) NOT NULL,
  `list_card_id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `priority_id` bigint(20) DEFAULT NULL,
  `media_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_cards`
--

INSERT INTO `activity_cards` (`id`, `name`, `description`, `due_date`, `order`, `list_card_id`, `transaction_id`, `priority_id`, `media_id`, `created_at`, `updated_at`) VALUES
(1, 'Update Title i', 'Test Activity Cards', '2018-12-09', 1, 1, NULL, NULL, NULL, '2018-11-20 01:42:35', '2018-12-10 07:04:37'),
(2, 'dgfgfdgfdgdfgdf', 'Test saving Description', '2018-12-01', 2, 1, NULL, NULL, NULL, '2018-11-20 01:42:35', '2018-12-10 05:39:37'),
(3, 'asdasdasdasdasd', NULL, '2018-12-09', 1, 1, NULL, NULL, NULL, '2018-12-07 02:06:39', '2018-12-08 10:28:13'),
(6, 'dsad asdas asd', NULL, NULL, 1, 8, NULL, NULL, NULL, '2018-12-07 02:07:02', '2018-12-07 02:07:02'),
(7, 'asdsdasdasd', NULL, NULL, 1, 9, NULL, NULL, NULL, '2018-12-07 02:08:26', '2018-12-07 02:08:26'),
(8, 'gtgtgtgtgtgt', NULL, NULL, 1, 10, NULL, NULL, NULL, '2018-12-07 02:08:51', '2018-12-07 02:08:51'),
(9, 'gtgtgtgtg', NULL, NULL, 1, 10, NULL, NULL, NULL, '2018-12-07 02:08:54', '2018-12-07 02:08:54'),
(12, 'Card', NULL, NULL, 1, 11, NULL, NULL, NULL, '2018-12-07 04:22:49', '2018-12-07 04:22:49'),
(13, 'Handling Saved', NULL, NULL, 1, 1, NULL, NULL, NULL, '2018-12-10 03:21:34', '2018-12-10 03:21:34'),
(14, 'Test Title Bugs Save', 'Test descriptions', '2018-12-10', 1, 6, NULL, NULL, NULL, '2018-12-10 05:41:32', '2018-12-10 07:30:10'),
(15, 'Pembelanjaan Barang Belanjaan', 'Pembelanjaan Fase 2', '2019-01-16', 1, 12, NULL, NULL, NULL, '2018-12-10 05:47:50', '2018-12-10 07:29:51'),
(17, 'sdfsdfwer', NULL, NULL, 1, 6, NULL, NULL, NULL, '2018-12-10 06:47:13', '2018-12-10 06:47:13'),
(18, 'utjujuju', NULL, NULL, 1, 6, NULL, NULL, NULL, '2018-12-10 06:47:18', '2018-12-10 06:47:18'),
(19, '1', NULL, NULL, 1, 6, NULL, NULL, NULL, '2018-12-10 06:47:21', '2018-12-10 06:47:21'),
(20, '1', NULL, NULL, 1, 6, NULL, NULL, NULL, '2018-12-10 06:47:25', '2018-12-10 06:47:25'),
(21, '2', NULL, NULL, 1, 6, NULL, NULL, NULL, '2018-12-10 06:47:28', '2018-12-10 06:47:28'),
(22, 'wewewe', NULL, NULL, 1, 6, NULL, NULL, NULL, '2018-12-10 06:47:32', '2018-12-10 06:47:32'),
(31, 'Update Save', NULL, NULL, 1, 12, NULL, NULL, NULL, '2018-12-10 07:32:18', '2018-12-10 07:32:29'),
(32, 'fsssdfsdf', 'asdasdasdasdasd sad asdasd asda', NULL, 1, 13, NULL, NULL, NULL, '2018-12-13 00:18:46', '2018-12-13 00:18:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `checklists`
--

CREATE TABLE `checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `media_id` bigint(20) DEFAULT NULL,
  `activity_card_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `checklists`
--

INSERT INTO `checklists` (`id`, `content`, `status`, `media_id`, `activity_card_id`, `created_at`, `updated_at`) VALUES
(1, 'asdasdas', 1, NULL, 1, '2018-11-20 05:17:55', '2018-11-20 05:17:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_cards`
--

CREATE TABLE `list_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `list_cards`
--

INSERT INTO `list_cards` (`id`, `name`, `order`, `project_id`, `created_at`, `updated_at`) VALUES
(1, 'to do list', 0, 1, '2018-11-20 01:34:04', '2018-12-10 04:03:42'),
(2, 'Kinerjaku', 1, 1, '2018-12-07 01:34:47', '2018-12-10 05:37:16'),
(6, 'Fase Satu', 1, 2, '2018-12-07 01:42:00', '2018-12-10 05:46:24'),
(9, 'Test', 1, 8, '2018-12-07 02:08:22', '2018-12-07 02:08:22'),
(10, '9090909', 1, 8, '2018-12-07 02:08:44', '2018-12-07 02:08:44'),
(12, 'Fase Dua Belas', 1, 2, '2018-12-10 05:47:41', '2018-12-10 07:21:31'),
(13, 'asdasdasd', 1, 5, '2018-12-13 00:18:38', '2018-12-13 00:18:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2018_11_20_080313_create_projects_table', 3),
(5, '2018_11_20_083038_create_list_cards_table', 4),
(7, '2018_11_20_083506_create_activity_cards_table', 5),
(8, '2018_11_20_084430_create_priorities_table', 6),
(9, '2018_11_20_084826_create_colors_table', 6),
(10, '2018_11_20_085307_create_checklists_table', 7),
(11, '2018_11_20_090830_create_transactions_table', 8),
(12, '2018_11_20_090837_create_transaction_lists_table', 8),
(13, '2018_11_20_091947_create_user_levels_table', 9),
(14, '2018_11_20_092046_create_user_projects_table', 9),
(15, '2018_11_20_092712_create_media_table', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `priorities`
--

CREATE TABLE `priorities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_status` tinyint(4) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `name`, `cost`, `cost_status`, `address`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'tes', '120000', 1, 'surabaya', 1, '2018-11-20 01:11:43', '2018-11-20 01:11:43'),
(2, 'Project 2', '120000', 1, 'Jakarta', 1, '2018-11-20 01:11:43', '2018-11-20 01:11:43'),
(4, 'Test Project', '1200', 1, 'Surabaya', 1, '2018-11-27 07:59:20', '2018-11-27 07:59:20'),
(5, 'Laravel', '210000', 1, 'Jawa Timur', 1, '2018-11-27 08:00:21', '2018-11-27 08:00:21'),
(6, 'asddasdas', '34242423', 1, 'sadadasdasda', 1, '2018-11-27 08:13:19', '2018-11-27 08:13:19'),
(7, 'test', '1000', 1, 'Surabaya', 1, '2018-12-07 00:45:12', '2018-12-07 00:45:12'),
(8, 'asdasd', '23423', 1, 'asdasdsad', 1, '2018-12-07 00:50:45', '2018-12-07 00:50:45'),
(9, 'Test 2', '10000', 1, 'Nganjuk', 1, '2018-12-10 03:17:56', '2018-12-10 03:17:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_lists`
--

CREATE TABLE `transaction_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'zainul', 'admin@admin.com', '$2y$10$tEHrdGbdpzTJw4fqxTRuOO2bODGLoO.M.l9rMM.q2K1mfSlnCy83a', 'fYcd0MPg0Q0pPdyLBdnMouU0Wo6M1aU3uQ1s369TZ34hmBc0RxaBTmZNqMUa', '2018-11-19 19:01:59', '2018-11-19 19:01:59'),
(2, 'admin', 'admin@admin.co.id', '$2y$10$U6KVaissWVyHwO7l.bH.FeuKxy0ARO7G6gsQ4Umz3A2FE8Mj7qgyK', 'XgdoebryPXKABDcrrB06E5KQ1JnEilG77WPgbFKFmFYb0tgqt4nHatuDRCsy', '2018-11-20 05:12:47', '2018-11-20 05:12:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_levels`
--

CREATE TABLE `user_levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_projects`
--

CREATE TABLE `user_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_level_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_projects`
--

INSERT INTO `user_projects` (`id`, `project_id`, `user_id`, `user_level_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2018-11-19 17:00:00', '2018-11-19 17:00:00'),
(2, 1, 2, 1, '2018-11-19 17:00:00', '2018-11-19 17:00:00'),
(3, 2, 1, 1, '2018-11-19 17:00:00', '2018-11-19 17:00:00'),
(4, 4, 1, 1, '2018-11-27 07:59:20', '2018-11-27 07:59:20'),
(5, 5, 1, 1, '2018-11-27 08:00:21', '2018-11-27 08:00:21'),
(6, 6, 1, 1, '2018-11-27 08:13:19', '2018-11-27 08:13:19'),
(7, 7, 1, 1, '2018-12-07 00:45:12', '2018-12-07 00:45:12'),
(8, 8, 1, 1, '2018-12-07 00:50:45', '2018-12-07 00:50:45'),
(9, 9, 1, 1, '2018-12-10 03:17:56', '2018-12-10 03:17:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_cards`
--
ALTER TABLE `activity_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `list_cards`
--
ALTER TABLE `list_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_lists`
--
ALTER TABLE `transaction_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_projects`
--
ALTER TABLE `user_projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_cards`
--
ALTER TABLE `activity_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `list_cards`
--
ALTER TABLE `list_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaction_lists`
--
ALTER TABLE `transaction_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_projects`
--
ALTER TABLE `user_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
