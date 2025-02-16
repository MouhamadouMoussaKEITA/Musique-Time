-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 25 oct. 2024 à 12:39
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `musique_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `musiques`
--

DROP TABLE IF EXISTS `musiques`;
CREATE TABLE IF NOT EXISTS `musiques` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `musiques`
--

INSERT INTO `musiques` (`id`, `titre`, `genre`, `auteur`, `prix`, `image`) VALUES
(2, 'Perfect', 'Melo', 'Ed sheeran', 12.00, 'image2.jpg'),
(4, 'Euphon', 'Rap', 'gazo', 11.00, 'image4.jpeg'),
(5, 'Khalé', 'Mbalax', 'Youssou Ndour', 1000.00, 'image3.jpg'),
(6, 'ADC', 'Rap', 'Freeze Corleon', 155.00, 'image3.jpeg'),
(7, 'Jefe', 'Rap', 'Ninho', 144.00, 'image5.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `musique_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `auteur` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `musique_id` (`musique_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `musique_id`, `utilisateur_id`, `titre`, `genre`, `auteur`, `prix`, `image`) VALUES
(10, 2, 1, 'Perfect', 'Melo', 'Ed sheeran', 15.00, 'image2.jpg'),
(9, 1, 1, '100k', 'rap', 'gazo', 10.00, 'image1.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `mot_de_passe`, `pseudo`) VALUES
(6, 'mk', '$2y$10$zH58ME1tCRU.f0MnbK5RxeEpuwsvIUUuvsBrHlmvA16a5/6OPpfpO', 'mk'),
(7, 'root', '$2y$10$z80cyWbwNep4x.tRF.zlseJ9u7uXASXlz4TwctMvzbyqUqIqEK0.K', 'root');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
