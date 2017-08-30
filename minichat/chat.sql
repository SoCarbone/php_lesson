-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 17 Août 2017 à 12:44
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(255) COLLATE utf8_bin NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date_ajout` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`ID`, `pseudo`, `message`, `date_ajout`) VALUES
(100, 'Alexis', 'Oui je sais !', '2017-08-17 14:44:15'),
(99, 'Paulo', 'Tu dÃ©chires !', '2017-08-17 14:41:40'),
(94, 'Alexis', 'Bonjour Ã  tous !', '2017-08-17 14:22:05'),
(95, 'Justine', 'Salut Maxime ! Comment Ã§a va ?', '2017-08-17 14:22:24'),
(96, 'Paulo', 'Yop Maxime !', '2017-08-17 14:22:39'),
(97, 'Alexis', 'Et ben Ã§a peut aller ! Je me forme au langage PHP', '2017-08-17 14:24:36'),
(98, 'Justine', 'Waow! super !', '2017-08-17 14:24:53');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
