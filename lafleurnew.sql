-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 05 Avril 2013 à 15:20
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lafleurnew`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `a_id` int(5) NOT NULL,
  `a_login` char(20) NOT NULL,
  `a_mdp` char(20) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`a_id`, `a_login`, `a_mdp`) VALUES
(1, 'admin', 'root');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `cat_code` char(3) NOT NULL,
  `cat_libelle` char(30) NOT NULL,
  PRIMARY KEY (`cat_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`cat_code`, `cat_libelle`) VALUES
('bul', 'Bulbes'),
('mas', 'Plantes à massif'),
('ros', 'Rosiers');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `clt_id` int(5) NOT NULL,
  `clt_login` char(10) NOT NULL,
  `clt_mdp` char(10) NOT NULL,
  `clt_nom` char(10) NOT NULL,
  `clt_adresse` char(20) NOT NULL,
  `clt_cpostal` int(5) NOT NULL,
  `clt_tel` int(10) NOT NULL,
  `clt_email` char(20) NOT NULL,
  PRIMARY KEY (`clt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`clt_id`, `clt_login`, `clt_mdp`, `clt_nom`, `clt_adresse`, `clt_cpostal`, `clt_tel`, `clt_email`) VALUES
(1, 'Test', 'test', 'Test', '2 rue du test', 75000, 0, 'test@test.fr'),
(2, 'maxi', 'maxi', 'maxi', 'maxi', 75000, 0, 'wxcvb@live.fr');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `c_id` int(5) NOT NULL,
  `c_date` date NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`c_id`, `c_date`) VALUES
(1, '2013-04-04'),
(2, '2013-04-04');

-- --------------------------------------------------------

--
-- Structure de la table `contenucommande`
--

CREATE TABLE IF NOT EXISTS `contenucommande` (
  `cc_id` int(5) NOT NULL,
  `cc_cltId` int(5) NOT NULL,
  `cc_produit` char(5) NOT NULL,
  `cc_quantite` int(5) NOT NULL,
  PRIMARY KEY (`cc_id`,`cc_cltId`,`cc_produit`),
  KEY `idClient` (`cc_cltId`),
  KEY `produit` (`cc_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenucommande`
--

INSERT INTO `contenucommande` (`cc_id`, `cc_cltId`, `cc_produit`, `cc_quantite`) VALUES
(1, 1, 'b01', 1),
(2, 2, 'm01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `pdt_ref` char(5) NOT NULL,
  `pdt_designation` char(50) NOT NULL,
  `pdt_prix` int(10) NOT NULL,
  `pdt_image` char(50) NOT NULL,
  `pdt_categorie` char(3) NOT NULL,
  `pdt_qtedispo` int(5) NOT NULL,
  PRIMARY KEY (`pdt_ref`),
  KEY `pdt_categorie` (`pdt_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`pdt_ref`, `pdt_designation`, `pdt_prix`, `pdt_image`, `pdt_categorie`, `pdt_qtedispo`) VALUES
('b01', '3 bulbes de bégonias', 5, 'images/bulbes_begonia.jpg', 'bul', 10),
('b02', '10 bulbes de dahlias', 12, 'images/bulbes_dahlia.jpg', 'bul', 12),
('b03', '50 glaïeuls', 9, 'images/bulbes_glaieul.jpg', 'bul', 20),
('m01', 'Lot de 3 marguerites', 5, 'images/massif_marguerite.jpg', 'mas', 5),
('m02', 'Pour un bouquet de 6 pensées', 6, 'images/massif_pensee.jpg', 'mas', 16),
('m03', 'Mélange varié de 10 plantes à massif', 15, 'images/massif_melange.jpg', 'mas', 4),
('r01', '1 pied spécial grandes fleurs', 20, 'images/rosiers_gdefleur.jpg', 'ros', 30),
('r02', 'Une variété sélectionnée pour son parfum', 9, 'images/rosiers_parfum.jpg', 'ros', 27),
('r03', 'Rosier arbuste', 8, 'images/rosiers_arbuste.jpg', 'ros', 21);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contenucommande`
--
ALTER TABLE `contenucommande`
  ADD CONSTRAINT `contenucommande_ibfk_1` FOREIGN KEY (`cc_cltId`) REFERENCES `clients` (`clt_id`),
  ADD CONSTRAINT `contenucommande_ibfk_2` FOREIGN KEY (`cc_id`) REFERENCES `commande` (`c_id`),
  ADD CONSTRAINT `contenucommande_ibfk_3` FOREIGN KEY (`cc_produit`) REFERENCES `produits` (`pdt_ref`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`pdt_categorie`) REFERENCES `categorie` (`cat_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
