-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 28 Août 2017 à 08:09
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `battle_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `game_character`
--

CREATE TABLE `game_character` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `life` int(11) NOT NULL,
  `strength` int(11) NOT NULL,
  `damage` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `xp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `game_character`
--

INSERT INTO `game_character` (`id`, `name`, `life`, `strength`, `damage`, `level`, `xp`) VALUES
(1, 'Barbak', 90, 47, 15, 1, 100),
(2, 'Batman', 80, 50, 25, 1, 0),
(3, 'Ploup', 80, 50, 25, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tp_character`
--

CREATE TABLE `tp_character` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `damage` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `tp_character`
--

INSERT INTO `tp_character` (`id`, `name`, `damage`) VALUES
(1, 'Barbak', 0),
(20, 'Plouc', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `game_character`
--
ALTER TABLE `game_character`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tp_character`
--
ALTER TABLE `tp_character`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `game_character`
--
ALTER TABLE `game_character`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tp_character`
--
ALTER TABLE `tp_character`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
