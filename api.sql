-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 26, 2016 at 07:57 PM
-- Server version: 5.7.10-log
-- PHP Version: 5.6.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `isDeleted`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'Web Developer', 0, 2, '2016-05-27 00:00:47', '2016-05-27 00:00:50'),
(2, 'Hukum TIK', 0, 4, '2016-05-27 00:01:06', '2016-05-27 00:01:10'),
(3, 'Web Developer', 0, 2, '2016-05-27 00:02:00', '2016-05-27 00:02:03'),
(4, 'Keamanan Jaringan', 0, 2, '2016-05-26 18:53:15', '2016-05-26 18:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `email`, `isDeleted`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Bissmilah', 'danaekairwanda', 0, 2, 2, '2016-05-26 17:54:22', '2016-05-26 17:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `privileges` enum('public','private') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `like` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_05_23_074638_create_jokes_table', 1),
('2016_05_25_080133_create_posts_table', 2),
('2016_05_25_163717_create_posts_table', 3),
('2016_05_25_164207_create_posts_table', 4),
('2016_05_25_165501_create_posts_table', 5),
('2016_05_25_170148_create_posts_table', 6),
('2016_05_25_174232_create_likes_table', 7),
('2016_05_25_175218_create_comments_table', 8),
('2016_05_25_175501_create_tags_table', 9),
('2016_05_25_175636_create_categories_table', 10),
('2016_05_25_175812_create_tags_table', 11),
('2016_05_25_175849_create_comments_table', 11),
('2016_05_25_180154_create_categories_table', 12),
('2016_05_25_180256_create_userFollows_table', 12),
('2016_05_25_182201_create_postArticle_table', 12),
('2016_05_25_182756_create_groups_table', 13),
('2016_05_26_140701_create_tags_table', 14),
('2016_05_26_142536_create_userFollows_table', 15),
('2016_05_26_144949_create_groups_table', 16),
('2016_05_26_145251_create_likes_table', 17),
('2016_05_26_145918_create_userFollows_table', 18),
('2016_05_26_150238_create_groups_table', 19),
('2016_05_26_150415_create_comments_table', 20),
('2016_05_26_150952_create_tags_table', 20),
('2016_05_26_151058_create_categories_table', 20),
('2016_05_26_174221_create_comments_table', 21),
('2016_05_26_180520_create_tags_table', 22),
('2016_05_26_181031_create_categories_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `image`, `isDeleted`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Bissmillah', 'halo lukman', 'hey', 1, 1, '2016-05-25 10:03:50', '2016-05-25 10:03:50'),
(4, 'Dna', 'hei API', 'coba', 1, 1, '2016-05-25 10:09:38', '2016-05-25 10:09:38'),
(5, 'dnaaaa', 'berhasil guys', 'oey', 0, 2, '2016-05-25 10:25:59', '2016-05-25 10:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `isDeleted`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', 0, 2, '2016-05-26 23:58:56', '2016-05-26 23:58:59'),
(2, 'AngularJS', 0, 4, '2016-05-26 23:59:14', '2016-05-26 23:59:18'),
(3, 'PHP artisan', 0, 2, '2016-05-26 23:59:38', '2016-05-26 18:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `userfollows`
--

CREATE TABLE IF NOT EXISTS `userfollows` (
  `id` int(10) unsigned NOT NULL,
  `friend_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `follow` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'heaven88', 'lockman.virginia@gmail.com', '$2y$10$SdxnSerAg2DkNfBHIgpwse.1iXscfDHgjMQnHgMOi/JE/KHlxzIJm', NULL, '2016-05-23 01:45:22', '2016-05-23 01:45:22'),
(2, 'gconn', 'briana.legros@sipes.org', '$2y$10$n6Rfu8gIBUxR09ff0VmesOatoc42Epp6K1hW421EV63qsSIsS19tC', NULL, '2016-05-23 01:45:23', '2016-05-23 01:45:23'),
(3, 'xharvey', 'verdie.bogisich@hotmail.com', '$2y$10$eSxdgBp5jjkeuZKO675Pq.J1R7Ya16z.na1yihBd2B/jw/SoTxYLi', NULL, '2016-05-23 01:45:23', '2016-05-23 01:45:23'),
(4, 'cassidy.kuvalis', 'konopelski.gilbert@yahoo.com', '$2y$10$lrPAWjQ.DMxV9/E8RQQFw.g2Pot79Zvd3kL/I4cj6hJjk1qTymjyC', NULL, '2016-05-23 01:45:23', '2016-05-23 01:45:23'),
(5, 'adele.ebert', 'julius71@bergnaum.com', '$2y$10$iHqFW/v.sl1DHXuHVwK/lu61h8c.W.I04JxTFtbH50jPRz.NygfK.', NULL, '2016-05-23 01:45:24', '2016-05-23 01:45:24'),
(6, 'claudine.wolff', 'lukas60@hotmail.com', '$2y$10$bGxBdO8Nqt6W0Z00qaB4xuvKL4lowSbVKienXZord3B5PZwz6tXSO', NULL, '2016-05-25 01:36:23', '2016-05-25 01:36:23'),
(7, 'ekunde', 'johan.ankunding@hotmail.com', '$2y$10$SWLXSIu612xuNYc7TRwukOjE9EJ5siOCHhZkICCt4pe3PzkPG2Gzq', NULL, '2016-05-25 01:36:23', '2016-05-25 01:36:23'),
(8, 'sophie63', 'fturcotte@hotmail.com', '$2y$10$Kx5AxymMZLR65Fnj8TAK5uLekvGPFlZy6ot4BOiguShmc8xzfModO', NULL, '2016-05-25 01:36:23', '2016-05-25 01:36:23'),
(9, 'tmoen', 'major.yost@moen.com', '$2y$10$BtiNOJURlTbClY/jJKjPk.0.PbKrpgFJSa93FNZD9QOT1CKs3Bytu', NULL, '2016-05-25 01:36:24', '2016-05-25 01:36:24'),
(10, 'dhowe', 'shields.cleve@mante.com', '$2y$10$5Nn3JsRJwLX2EYkxFJOIluWHB7NSMadbbtwi1GQ62WwA1t6Gvorz.', NULL, '2016-05-25 01:36:24', '2016-05-25 01:36:24'),
(11, 'lina.waelchi', 'jrodriguez@gmail.com', '$2y$10$YZFXVupaIsK35NhIExZjqeRK.BqT3GOiiFl6ycAYNirQcYrgaQ68K', NULL, '2016-05-25 01:37:50', '2016-05-25 01:37:50'),
(12, 'kenna57', 'cummerata.rory@yahoo.com', '$2y$10$ZKwej68dkP6w85ItWPwG9OAmr4vjqKHiKe2V0GZsGqgeJChDPHoei', NULL, '2016-05-25 01:37:51', '2016-05-25 01:37:51'),
(13, 'kuhlman.roel', 'ubogan@berge.biz', '$2y$10$mQpK0piI04A0PB0NEwFeY..ZwG0X5rdYwCsH8FqWKlH5zdzTOZipG', NULL, '2016-05-25 01:37:51', '2016-05-25 01:37:51'),
(14, 'chickle', 'ferne.kiehn@schmeler.net', '$2y$10$Ab1kDI/49dIc2n9CtbLMLuUD8rh7sjmZCTPw9oKPOtf93uvvNTgrK', NULL, '2016-05-25 01:37:51', '2016-05-25 01:37:51'),
(15, 'nikolaus.larissa', 'wehner.diamond@hotmail.com', '$2y$10$mdm5S7k2YBGy.rCREWDntuRp4TR/pBrTy1/aCJz/pJZtNXTLl1xDi', NULL, '2016-05-25 01:37:51', '2016-05-25 01:37:51'),
(16, 'eugenia97', 'brannon.hilpert@harris.com', '$2y$10$9gtfOTTM78CI1FwT5s/Krey6IPx5jOM97GeN4DWC97ePx9E.Fbti6', NULL, '2016-05-25 01:40:36', '2016-05-25 01:40:36'),
(17, 'drau', 'euna.rath@raynor.com', '$2y$10$8tIOZCPhJ5IgcWKqjRo84evQNLBW/d3hHGFzy/qEkJhYVU4RlxrOy', NULL, '2016-05-25 01:40:37', '2016-05-25 01:40:37'),
(18, 'marie71', 'parker.josefa@hotmail.com', '$2y$10$2wjWv0zqQtFyhy.djwdoz.6.nCWJE2Pcx6XQMHDYWXICKsAnP6LJG', NULL, '2016-05-25 01:40:37', '2016-05-25 01:40:37'),
(19, 'danyka.oconner', 'yasmine62@balistreri.com', '$2y$10$ZLJKrNyR6ZE2C5N.r/v7ieqJWDEhfGuUyyPMlbOTpew2x/CYLbr92', NULL, '2016-05-25 01:40:37', '2016-05-25 01:40:37'),
(20, 'gullrich', 'marquise37@reinger.com', '$2y$10$78mSJFId/Nv5bjDyZNsFiu7odt9eTxA7xYauvLLNImSGpvY7/z2qa', NULL, '2016-05-25 01:40:37', '2016-05-25 01:40:37'),
(21, 'alvena.renner', 'elvera44@hotmail.com', '$2y$10$QrxOOuEGElpW5w4DvpMkNuKeANsRjtWA7XfD/2ufcrIYNqMt87VAe', NULL, '2016-05-25 01:43:05', '2016-05-25 01:43:05'),
(22, 'pvandervort', 'forest.emmerich@runolfsson.com', '$2y$10$qkaYBroi.1gLXidx36WIfeutx1Di7XRz/VVmT6u7CC34EFUMoiekW', NULL, '2016-05-25 01:43:06', '2016-05-25 01:43:06'),
(23, 'cheyenne.greenholt', 'agreenholt@cartwright.net', '$2y$10$cTZ/tGyf7p2p68X5d4HbmOVAENoXYRoR6W/JiSoJrimLgVjYWGrd6', NULL, '2016-05-25 01:43:06', '2016-05-25 01:43:06'),
(24, 'xkessler', 'dameon60@sawayn.com', '$2y$10$gVu2YnLL.fxMUH9WoaM7ou.l0ACNK1zfLXCgF1kbIjb8D62FC4CPi', NULL, '2016-05-25 01:43:06', '2016-05-25 01:43:06'),
(25, 'mcdermott.rae', 'igulgowski@yahoo.com', '$2y$10$RmPHSuExRLrwEs6rXn8KW.b1ZES0cej/8TYg5G1Kr.6vaLNLc/Hfe', NULL, '2016-05-25 01:43:06', '2016-05-25 01:43:06'),
(26, 'koss.roxane', 'mya55@keebler.com', '$2y$10$TxLAwIdl6h5vbherx5V8F.1vSQpXrNb8KkN1vIVUTshaNHYLHUyzq', NULL, '2016-05-25 01:44:03', '2016-05-25 01:44:03'),
(27, 'dane93', 'crist.fermin@yahoo.com', '$2y$10$0jBkAt4mNIIivpnk7oIeku7r3d/HEPqHDyjoW8Vu403nAHYmbwLkO', NULL, '2016-05-25 01:44:03', '2016-05-25 01:44:03'),
(28, 'imelda.medhurst', 'hzieme@gmail.com', '$2y$10$OfEz1V9pgSRu9VSke2sUZ.fbLKjA9F.m7GOCUYUDyshiq0N4/WInm', NULL, '2016-05-25 01:44:03', '2016-05-25 01:44:03'),
(29, 'dickinson.alverta', 'tvon@hotmail.com', '$2y$10$0lYUS5.JhqQa4I4YkrqojOeepLaFxl6tixp9zz98FuVF3lGocDzIO', NULL, '2016-05-25 01:44:03', '2016-05-25 01:44:03'),
(30, 'simonis.noemi', 'brown.beaulah@yahoo.com', '$2y$10$2QE5Dw0HY3B163auyQzVa.x3B63sgwH23U879jnhEYB/gYvc4MCkq', NULL, '2016-05-25 01:44:03', '2016-05-25 01:44:03'),
(31, 'pheathcote', 'lind.adan@wunsch.net', '$2y$10$jYe20qOhL/JJx61eEFa1i.QfRYPL/2kS0IMHvsNG5aZmItnN.wko6', NULL, '2016-05-25 01:46:34', '2016-05-25 01:46:34'),
(32, 'mhauck', 'camryn79@yahoo.com', '$2y$10$volABpOqncF1MVR3ShqqMeZKeyvG6qJh2ijHeAav6mhq51bNvBLsu', NULL, '2016-05-25 01:46:34', '2016-05-25 01:46:34'),
(33, 'metz.emily', 'hdouglas@runolfsdottir.net', '$2y$10$JvP1Ocp2aRt1mj8T5hoBzO0BUi4cXD.Qm0oo21Qs.gfSnKgd5/4Pq', NULL, '2016-05-25 01:46:34', '2016-05-25 01:46:34'),
(34, 'earnestine56', 'gkris@yahoo.com', '$2y$10$09PEMtGaR9IsRjn.0Ag0reudQBmP8bvHGy2EDN0tRfR5xqhnNIjzK', NULL, '2016-05-25 01:46:34', '2016-05-25 01:46:34'),
(35, 'kylee.gislason', 'mante.loraine@yahoo.com', '$2y$10$1q0ydp2OH90rAYabMDmm1OJ6pjS77w1Bl/xr3J4P0XHXIyOM.Haa2', NULL, '2016-05-25 01:46:35', '2016-05-25 01:46:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_post_id_foreign` (`post_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groups_user_id_foreign` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_post_id_foreign` (`post_id`);

--
-- Indexes for table `userfollows`
--
ALTER TABLE `userfollows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userfollows_friend_id_foreign` (`friend_id`),
  ADD KEY `userfollows_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userfollows`
--
ALTER TABLE `userfollows`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `userfollows`
--
ALTER TABLE `userfollows`
  ADD CONSTRAINT `userfollows_friend_id_foreign` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userfollows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
