-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mar. 15 avr. 2025 à 17:53
-- Version du serveur : 11.5.2-MariaDB
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sportify`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `max_participant` int(11) NOT NULL,
  `temps` int(11) NOT NULL,
  `id_coach` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_coach` (`id_coach`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `nom`, `max_participant`, `temps`, `id_coach`) VALUES
(6, 'Yoga', 5, 60, 0),
(7, 'Pilates', 3, 60, 0),
(8, 'Renforcement musculaire', 5, 45, 0),
(9, 'Cycling', 3, 45, 0),
(10, 'Fitness', 5, 45, 0);

-- --------------------------------------------------------

--
-- Structure de la table `coachs`
--

DROP TABLE IF EXISTS `coachs`;
CREATE TABLE IF NOT EXISTS `coachs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `coachs`
--

INSERT INTO `coachs` (`id`, `nom`, `prenom`, `numero`) VALUES
(1, 'Legrand', 'Michelle', '0123456789'),
(2, 'May', 'Marion', '0234567891'),
(3, 'Lemont', 'Camille', '0345678912'),
(4, 'Taylor', 'Amy', '0456789123'),
(5, 'Jones', 'Laura', '0567891234'),
(6, 'Marins', 'Laura', '0678912345');

-- --------------------------------------------------------

--
-- Structure de la table `difficultés`
--

DROP TABLE IF EXISTS `difficultés`;
CREATE TABLE IF NOT EXISTS `difficultés` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `difficultés`
--

INSERT INTO `difficultés` (`id`, `nom`) VALUES
(1, 'debutant'),
(2, 'intermediaire'),
(3, 'avancé'),
(4, 'tous niveaux');

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

DROP TABLE IF EXISTS `profils`;
CREATE TABLE IF NOT EXISTS `profils` (
  `pdp` mediumblob DEFAULT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `code_postal` int(5) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `complement_adresse` varchar(30) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id_difficulté` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_activité` int(11) NOT NULL,
  `id_coach` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_session`),
  KEY `id_activité` (`id_activité`),
  KEY `id_coach` (`id_coach`),
  KEY `id_difficulté` (`id_difficulté`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Structure de la table `session_profils`
--

DROP TABLE IF EXISTS `session_profils`;
CREATE TABLE IF NOT EXISTS `session_profils` (
  `mail` varchar(50) NOT NULL,
  `id_session` int(11) NOT NULL,
  PRIMARY KEY (`mail`,`id_session`),
  KEY `id_session` (`id_session`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `activites_ibfk_1` FOREIGN KEY (`id_coach`) REFERENCES `coachs` (`id`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`id_activité`) REFERENCES `activites` (`id`),
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`id_coach`) REFERENCES `coachs` (`id`),
  ADD CONSTRAINT `session_ibfk_3` FOREIGN KEY (`id_difficulté`) REFERENCES `difficultés` (`id`);

--
-- Contraintes pour la table `session_profils`
--
ALTER TABLE `session_profils`
  ADD CONSTRAINT `session_profils_ibfk_1` FOREIGN KEY (`id_session`) REFERENCES `session` (`id_session`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session_profils_ibfk_2` FOREIGN KEY (`mail`) REFERENCES `profils` (`mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
