-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 24, 2021 at 04:14 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fidelite`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `commerce_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commerce`
--

CREATE TABLE `commerce` (
  `id` int(11) NOT NULL,
  `patron_id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commerce`
--

INSERT INTO `commerce` (`id`, `patron_id`, `nom`, `description`, `image`, `adress`, `cp`, `ville`, `tel`) VALUES
(1, 1, 'WebAntek', 'agence de communication webantek', 'https://picsum.photos/800', '20 rue de la rue', '39000', 'Lons le saunier', '0666712423');

-- --------------------------------------------------------

--
-- Table structure for table `commerce_user`
--

CREATE TABLE `commerce_user` (
  `commerce_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210518090738', '2021-06-23 13:19:59', 47),
('DoctrineMigrations\\Version20210518142340', '2021-06-23 13:19:59', 152);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abonnement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `abonnement`) VALUES
(1, 'loic@webantek.com', '[\"ROLE_ENTREPRISE\"]', '$2y$13$6BBGw7CP3DykEc4UILXrv.HxZtTMtMkholTR8x2t7R78KY/Wd447m', 'Dauchy', 'Loïc', 0),
(2, 'dauchyl39@gmail.com', '[\"ROLE_USER\"]', '$2y$13$TTNMGkrfr7bauRqwpGZjWOIvz66nVcm8NrUETOrcgdxDMQPlbdHA6', 'Dauchy', 'Loic', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_161498D3B09114B7` (`commerce_id`),
  ADD KEY `IDX_161498D3A76ED395` (`user_id`);

--
-- Indexes for table `commerce`
--
ALTER TABLE `commerce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BBF5FDF9DBD5322` (`patron_id`);

--
-- Indexes for table `commerce_user`
--
ALTER TABLE `commerce_user`
  ADD PRIMARY KEY (`commerce_id`,`user_id`),
  ADD KEY `IDX_55A09C4CB09114B7` (`commerce_id`),
  ADD KEY `IDX_55A09C4CA76ED395` (`user_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commerce`
--
ALTER TABLE `commerce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `FK_161498D3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_161498D3B09114B7` FOREIGN KEY (`commerce_id`) REFERENCES `commerce` (`id`);

--
-- Constraints for table `commerce`
--
ALTER TABLE `commerce`
  ADD CONSTRAINT `FK_BBF5FDF9DBD5322` FOREIGN KEY (`patron_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `commerce_user`
--
ALTER TABLE `commerce_user`
  ADD CONSTRAINT `FK_55A09C4CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_55A09C4CB09114B7` FOREIGN KEY (`commerce_id`) REFERENCES `commerce` (`id`) ON DELETE CASCADE;
