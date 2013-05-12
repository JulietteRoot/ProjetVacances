-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 12 Mai 2013 à 12:23
-- Version du serveur: 5.5.30
-- Version de PHP: 5.4.4-14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `vacances`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartement`
--

CREATE TABLE IF NOT EXISTS `appartement` (
  `id` int(10) unsigned NOT NULL,
  `etage` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `appartement`
--

INSERT INTO `appartement` (`id`, `etage`) VALUES
(1, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cadre`
--

CREATE TABLE IF NOT EXISTS `cadre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `cadre`
--

INSERT INTO `cadre` (`id`, `nom`) VALUES
(1, 'MER'),
(2, 'MONTAGNE'),
(3, 'CAMPAGNE');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `numero` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `numero`) VALUES
(1, 'Sparrow', 'Jack', 123),
(2, 'Snow', 'Jon', 456);

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
--

CREATE TABLE IF NOT EXISTS `hebergement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `capacite` tinyint(3) unsigned NOT NULL,
  `tarif_jour` float NOT NULL,
  `numero` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `descriptif` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `cadre` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero` (`numero`),
  KEY `cadre` (`cadre`,`type`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `hebergement`
--

INSERT INTO `hebergement` (`id`, `capacite`, `tarif_jour`, `numero`, `ville`, `descriptif`, `image`, `cadre`, `type`) VALUES
(1, 8, 500, 123, 'La Rochelle', 'A proximité des services (discothèque, bowling, station service), vue sur parking orienté plein Nord, loin des plages, pour un séjour inoubliable', '', 1, 1),
(2, 10, 1500, 789, 'Megève', 'Grande villa au charme typique, jacuzzi extérieur non chauffé, patinoire naturelle, cheminée factice, à 2000 mètres d''altitude en bout de chemin forestier non entretenu, avalanches fréquentes', '', 2, 2),
(3, 50, 600, 42, 'Marseille', 'Très bel appartement', '', 1, 1),
(4, 110, 1000, 1337, 'Chamonix', 'Très belle villa équipée d''une piscine chauffée', '', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `hebergement_services_inclus`
--

CREATE TABLE IF NOT EXISTS `hebergement_services_inclus` (
  `fk_hebergement` int(10) unsigned NOT NULL,
  `fk_service` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fk_hebergement`,`fk_service`),
  KEY `fk_service` (`fk_service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `hebergement_services_inclus`
--

INSERT INTO `hebergement_services_inclus` (`fk_hebergement`, `fk_service`) VALUES
(2, 1),
(3, 1),
(1, 2),
(4, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `hebergement_services_options`
--

CREATE TABLE IF NOT EXISTS `hebergement_services_options` (
  `fk_hebergement` int(10) unsigned NOT NULL,
  `fk_service` int(10) unsigned NOT NULL,
  PRIMARY KEY (`fk_hebergement`,`fk_service`),
  KEY `fk_service` (`fk_service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `hebergement_services_options`
--

INSERT INTO `hebergement_services_options` (`fk_hebergement`, `fk_service`) VALUES
(1, 1),
(4, 1),
(2, 2),
(3, 2),
(1, 3),
(3, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `reglement` tinyint(1) NOT NULL,
  `fk_client` int(10) unsigned NOT NULL,
  `fk_hebergement` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hebergement` (`fk_hebergement`),
  KEY `fk_client` (`fk_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `location`
--

INSERT INTO `location` (`id`, `numero`, `date_debut`, `date_fin`, `reglement`, `fk_client`, `fk_hebergement`) VALUES
(1, 123, '2013-05-04', '2013-05-11', 0, 1, 1),
(2, 456, '2013-07-06', '2013-07-30', 0, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `tarif` float(5,2) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `intitule`, `description`, `tarif`, `actif`) VALUES
(1, 'menage', 'Ménage complet de l''hébergement à la fin de chaque semaine', 40.00, 0),
(2, 'location linge de maison', 'Location de draps et serviettes propres', 15.00, 0),
(3, 'petit dejeuner', 'Un petit déjeuner est servi avant 10 heures ', 7.50, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_hebergement`
--

CREATE TABLE IF NOT EXISTS `type_hebergement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `intitule` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_hebergement`
--

INSERT INTO `type_hebergement` (`id`, `intitule`) VALUES
(1, 'appartement'),
(2, 'villa');

-- --------------------------------------------------------

--
-- Structure de la table `villa`
--

CREATE TABLE IF NOT EXISTS `villa` (
  `id` int(10) unsigned NOT NULL,
  `superficie_piscine` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `villa`
--

INSERT INTO `villa` (`id`, `superficie_piscine`) VALUES
(2, 150),
(4, 80);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartement`
--
ALTER TABLE `appartement`
  ADD CONSTRAINT `appartement_ibfk_1` FOREIGN KEY (`id`) REFERENCES `hebergement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hebergement`
--
ALTER TABLE `hebergement`
  ADD CONSTRAINT `hebergement_ibfk_1` FOREIGN KEY (`cadre`) REFERENCES `cadre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hebergement_ibfk_2` FOREIGN KEY (`type`) REFERENCES `type_hebergement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hebergement_services_inclus`
--
ALTER TABLE `hebergement_services_inclus`
  ADD CONSTRAINT `hebergement_services_inclus_ibfk_1` FOREIGN KEY (`fk_hebergement`) REFERENCES `hebergement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hebergement_services_inclus_ibfk_2` FOREIGN KEY (`fk_service`) REFERENCES `service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `hebergement_services_options`
--
ALTER TABLE `hebergement_services_options`
  ADD CONSTRAINT `hebergement_services_options_ibfk_1` FOREIGN KEY (`fk_hebergement`) REFERENCES `hebergement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hebergement_services_options_ibfk_2` FOREIGN KEY (`fk_service`) REFERENCES `service` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`fk_client`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`fk_hebergement`) REFERENCES `hebergement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `villa`
--
ALTER TABLE `villa`
  ADD CONSTRAINT `villa_ibfk_1` FOREIGN KEY (`id`) REFERENCES `hebergement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
