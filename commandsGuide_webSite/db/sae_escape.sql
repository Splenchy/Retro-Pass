-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+deb13u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 09 fév. 2026 à 22:35
-- Version du serveur : 11.8.3-MariaDB-0+deb13u1 from Debian
-- Version de PHP : 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae_escape`
--
CREATE DATABASE IF NOT EXISTS `sae_escape` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sae_escape`;

-- --------------------------------------------------------

--
-- Structure de la table `tblGroups`
--

DROP TABLE IF EXISTS `tblGroups`;
CREATE TABLE `tblGroups` (
  `id` int(11) NOT NULL,
  `groupName` varchar(50) NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp(),
  `end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tblGroups`
--

INSERT INTO `tblGroups` (`id`, `groupName`, `start`, `end`) VALUES
(15, 'blackblack', '2025-12-04 17:13:40', '2025-12-04 17:57:00'),
(17, 'faaaaah', '2025-12-04 18:06:45', '2025-12-04 18:34:28'),
(18, 'GEII 1', '2025-12-04 18:37:45', '2025-12-04 19:03:32'),
(20, 'maddogz', '2025-12-04 19:10:08', '2025-12-04 19:33:06'),
(22, 'madame', '2025-12-04 20:02:22', '2025-12-04 20:30:00'),
(23, '2casos', '2025-12-04 20:41:47', '2025-12-04 21:19:50'),
(24, 'jojo', '2025-12-05 00:42:56', '2025-12-05 02:24:23'),
(39, 'brillith', '2026-01-29 11:27:27', NULL),
(40, '1g4', '2026-01-29 11:41:58', NULL),
(41, 'rly', '2026-01-29 12:46:41', NULL),
(42, 'PythonGroup', '2026-01-29 13:08:55', '2026-01-29 13:23:30'),
(43, 'GLAL', '2026-01-29 13:29:24', '2026-01-29 13:48:04'),
(45, 'bad', '2026-01-29 13:51:42', NULL),
(46, 'equipe de rayan', '2026-01-29 14:00:36', '2026-01-29 14:17:22'),
(48, 'ratpi', '2026-01-29 14:20:34', '2026-01-29 14:36:59'),
(51, 'Lumina', '2026-01-29 14:50:31', NULL),
(52, 'nk', '2026-01-29 15:14:05', NULL),
(53, 'girl power', '2026-01-29 16:00:55', '2026-01-29 16:23:34'),
(54, 'bruno', '2026-01-29 17:42:31', NULL),
(55, 'lucas', '2026-01-29 17:46:35', '2026-01-29 18:06:27'),
(56, 'daron', '2026-01-29 18:19:05', '2026-01-29 18:37:16'),
(57, 'nolan', '2026-01-29 19:13:07', '2026-01-29 19:31:46');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tblGroups`
--
ALTER TABLE `tblGroups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNQ_groupName` (`groupName`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tblGroups`
--
ALTER TABLE `tblGroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
