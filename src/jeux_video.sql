-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 04 Août 2017 à 08:26
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `formation_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `jeux_video`
--

CREATE TABLE `jeux_video` (
  `ID` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `possesseur` varchar(255) NOT NULL,
  `console` varchar(255) NOT NULL,
  `prix` double NOT NULL DEFAULT '0',
  `nbre_joueurs_max` int(11) NOT NULL DEFAULT '0',
  `commentaires` text NOT NULL,
  `date_ajout` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `jeux_video`
--

INSERT INTO `jeux_video` (`ID`, `nom`, `possesseur`, `console`, `prix`, `nbre_joueurs_max`, `commentaires`, `date_ajout`) VALUES
(1, 'Super Mario Bros', 'Florent', 'NES', 4, 1, 'Un jeu d\'anthologie !', NULL),
(2, 'Sonic', 'Patrick', 'Megadrive', 2, 1, 'Pour moi, le meilleur jeu du monde !', NULL),
(3, 'Zelda : ocarina of time', 'Florent', 'Nintendo 64', 15, 1, 'Un jeu grand, beau et complet comme on en voit rarement de nos jours', NULL),
(4, 'Mario Kart 64', 'Florent', 'Nintendo 64', 25, 4, 'Un excellent jeu de kart !', NULL),
(5, 'Super Smash Bros Melee', 'Michel', 'GameCube', 55, 4, 'Un jeu de baston délirant !', NULL),
(6, 'Dead or Alive', 'Patrick', 'Xbox', 60, 4, 'Le plus beau jeu de baston jamais créé', NULL),
(7, 'Dead or Alive Xtreme Beach Volley Ball', 'Patrick', 'Xbox', 60, 4, 'Un jeu de beach volley de toute beauté o_O', NULL),
(8, 'Enter the Matrix', 'Michel', 'PC', 45, 1, 'Plutôt bof comme jeu, mais ça complète bien le film', NULL),
(9, 'Max Payne 2', 'Michel', 'PC', 50, 1, 'Très réaliste, une sorte de film noir sur fond d\'histoire d\'amour. A essayer !', NULL),
(10, 'Yoshi\'s Island', 'Florent', 'SuperNES', 6, 1, 'Le paradis des Yoshis :o)', NULL),
(11, 'Commandos 3', 'Florent', 'PC', 44, 12, 'Un bon jeu d\'action où on dirige un commando pendant la 2ème guerre mondiale !', NULL),
(12, 'Final Fantasy X', 'Patrick', 'PS2', 40, 1, 'Encore un Final Fantasy mais celui la est encore plus beau !', NULL),
(13, 'Pokemon Rubis', 'Florent', 'GBA', 44, 4, 'Pika-Pika-chu !!!', NULL),
(14, 'Starcraft', 'Michel', 'PC', 19, 8, 'Le meilleur jeux pc de tout les temps !', NULL),
(15, 'Grand Theft Auto 3', 'Michel', 'PS2', 30, 1, 'Comme dans les autres Gta on ecrase tout le monde :) .', NULL),
(16, 'Homeworld 2', 'Michel', 'PC', 45, 6, 'Superbe ! o_O', NULL),
(17, 'Aladin', 'Patrick', 'SuperNES', 10, 1, 'Comme le dessin Animé !', NULL),
(18, 'Super Mario Bros 3', 'Michel', 'SuperNES', 10, 2, 'Le meilleur Mario selon moi.', NULL),
(19, 'SSX 3', 'Florent', 'Xbox', 56, 2, 'Un très bon jeu de snow !', NULL),
(20, 'Star Wars : Jedi outcast', 'Patrick', 'Xbox', 33, 1, 'Encore un jeu sur star-wars où on se prend pour Luke Skywalker !', NULL),
(21, 'Actua Soccer 3', 'Patrick', 'PS', 30, 2, 'Un jeu de foot assez bof ...', NULL),
(22, 'Time Crisis 3', 'Florent', 'PS2', 40, 1, 'Un troisième volet efficace mais pas vraiment surprenant', NULL),
(23, 'X-FILES', 'Patrick', 'PS', 25, 1, 'Un jeu censé ressembler a la série mais assez raté ...', NULL),
(24, 'Soul Calibur 2', 'Patrick', 'Xbox', 54, 1, 'Un jeu bien axé sur le combat', NULL),
(25, 'Diablo', 'Florent', 'PS', 20, 1, 'Comme sur PC mais la c\'est sur un ecran de télé :) !', NULL),
(26, 'Street Fighter 2', 'Patrick', 'Megadrive', 10, 2, 'Le célèbre jeu de combat !', NULL),
(27, 'Gundam Battle Assault 2', 'Florent', 'PS', 29, 1, 'Jeu japonais dont le gameplay est un peu limité. Peu de robots malheureusement', NULL),
(28, 'Spider-Man', 'Florent', 'Megadrive', 15, 1, 'Vivez l\'aventure de l\'homme araignée', NULL),
(29, 'Midtown Madness 3', 'Michel', 'Xbox', 59, 6, 'Dans la suite des autres versions de Midtown Madness', NULL),
(30, 'Tetris', 'Florent', 'Gameboy', 5, 1, 'Qui ne connait pas ? ', NULL),
(31, 'The Rocketeer', 'Michel', 'NES', 2, 1, 'Un super un film et un jeu de m*rde ...', NULL),
(32, 'Pro Evolution Soccer 3', 'Patrick', 'PS2', 59, 2, 'Un petit jeu de foot sur PS2', NULL),
(33, 'Ice Hockey', 'Michel', 'NES', 7, 2, 'Jamais joué mais a mon avis ca parle de hockey sur glace ... =)', NULL),
(34, 'Sydney 2000', 'Florent', 'Dreamcast', 15, 2, 'Les JO de Sydney dans votre salon !', NULL),
(35, 'NBA 2k', 'Patrick', 'Dreamcast', 12, 2, 'A votre avis :p ?', NULL),
(36, 'Aliens Versus Predator : Extinction', 'Michel', 'PS2', 20, 2, 'Un shoot\'em up pour pc', NULL),
(37, 'Crazy Taxi', 'Florent', 'Dreamcast', 11, 1, 'Conduite de taxi en folie !', NULL),
(38, 'Le Maillon Faible', 'Mathieu', 'PS2', 10, 1, 'Le jeu de l\'émission', NULL),
(39, 'FIFA 64', 'Michel', 'Nintendo 64', 25, 2, 'Le premier jeu de foot sur la N64 =) !', NULL),
(40, 'Qui Veut Gagner Des Millions', 'Florent', 'PS2', 10, 1, 'Le jeu de l\'émission', NULL),
(41, 'Monopoly', 'Sebastien', 'Nintendo 64', 21, 4, 'Bheuuu le monopoly sur N64 !', NULL),
(42, 'Taxi 3', 'Corentin', 'PS2', 19, 4, 'Un jeu de voiture sur le film', NULL),
(43, 'Indiana Jones Et Le Tombeau De L\'Empereur', 'Florent', 'PS2', 25, 1, 'Notre aventurier préféré est de retour !!!', NULL),
(44, 'F-ZERO', 'Mathieu', 'GBA', 25, 4, 'Un super jeu de course futuriste !', NULL),
(45, 'Harry Potter Et La Chambre Des Secrets', 'Mathieu', 'Xbox', 30, 1, 'Abracadabra !! Le célebre magicien est de retour !', NULL),
(46, 'Half-Life', 'Corentin', 'PC', 15, 32, 'L\'autre meilleur jeu de tout les temps (surtout ses mods).', NULL),
(47, 'Myst III Exile', 'Sébastien', 'Xbox', 49, 1, 'Un jeu de réflexion', NULL),
(48, 'Wario World', 'Sebastien', 'Gamecube', 40, 4, 'Wario vs Mario ! Qui gagnera ! ?', NULL),
(49, 'Rollercoaster Tycoon', 'Florent', 'Xbox', 29, 1, 'Jeu de gestion d\'un parc d\'attraction', NULL),
(50, 'Splinter Cell', 'Patrick', 'Xbox', 53, 1, 'Jeu magnifique !', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `jeux_video`
--
ALTER TABLE `jeux_video`
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `jeux_video`
--
ALTER TABLE `jeux_video`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
