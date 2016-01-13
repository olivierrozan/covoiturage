-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Janvier 2016 à 01:58
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id` int(10) NOT NULL,
  `idUser` int(10) DEFAULT NULL,
  `jour` varchar(8) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heure` varchar(5) DEFAULT NULL,
  `adresseDepart` varchar(255) DEFAULT NULL,
  `codePostalDepart` varchar(5) DEFAULT NULL,
  `villeDepart` varchar(255) DEFAULT NULL,
  `adresseArrivee` varchar(255) DEFAULT NULL,
  `codePostalArrivee` varchar(5) DEFAULT NULL,
  `villeArrivee` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `offre`
--

INSERT INTO `offre` (`id`, `idUser`, `jour`, `date`, `heure`, `adresseDepart`, `codePostalDepart`, `villeDepart`, `adresseArrivee`, `codePostalArrivee`, `villeArrivee`) VALUES
(1, 5, 'mardi', NULL, '15h', 'Rue Léon Gambetta', '59000', 'Lille', 'Rue Noire', '44000', 'Nantes'),
(2, 5, '', '2014-12-15', '16h', 'Rue de Saint- Genès', '33000', 'Bordeaux', 'Rue Voltaire', '62100', 'Calais'),
(3, 5, 'mercredi', NULL, '16h', 'Rue Pernelle', '75004', 'Paris', 'Rue des Pyramides', '59000', 'Lille'),
(4, 5, 'lundi', NULL, '8h30', 'Rue d''Anvers', '59000', 'Lille', 'Rue Pizay', '69001', 'Lyon'),
(5, 1, '', '2015-02-28', '17h30', 'Rue du loup', '33000', 'Bordeaux', 'Rue Marcelin Berthelot', '59240', 'Dunkerque'),
(6, 3, '', '2015-12-30', '15h', 'Rue d''Alger', '75001', 'Paris', 'Rue Barrau', '33800', 'Bordeaux'),
(7, 2, 'mercredi', NULL, '5h30', 'Rue Nationale', '59000', 'Lille', 'Rue aux Ours', '57000', 'Metz'),
(16, 2, NULL, '2015-12-31', '9h59', 'Rue Delezenne', '59160', 'Lille', 'Rue Renière', '33000', 'Bordeaux');

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `id` int(10) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `codePostal` varchar(5) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `valider` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `passager`
--

INSERT INTO `passager` (`id`, `nom`, `prenom`, `adresse`, `codePostal`, `ville`, `email`, `tel`, `valider`) VALUES
(1, 'nom1', 'prenom1', 'Rue Ratisbonne', '59800', 'Lille', 'a@a.fr', '06.66.66.66.66', 0),
(2, 'nopm2', 'prenom2', 'Rue de Flandre', '59000', 'Lille', 'b@b.fr', '06.77.77.77.77', 0),
(3, 'nom3', 'prenom3', 'Rue de la Pierre Levée', '86000', 'Poitiers\r\n', 'c@c.fr', '06.88.88.88.88', 0),
(4, 'nom4', 'prenom4', 'rue Georges Courteline', '37000', 'Tours\r\n', 'd@d.fr', '06.99.99.99.99', 0),
(5, 'nom5', 'prenom5', 'Rue Emile Zola', '37000', 'Tours\r\n', 'e@e.fr', '06.01.02.03.04', 0),
(6, 'nom6', 'prenom6', 'Rue de Sébastopol', '37000', 'Tours\r\n', 'f@f.fr', '06.11.02.33.04', 0),
(7, 'nom7', 'prenom7', 'Rue du Général Chanzy', '37000', 'Tours\r\n', 'g@g.fr', '06.11.02.33.04', 0),
(8, 'nom8', 'prenom8', 'Rue Walvein', '37000', 'Tours\r\n', 'h@h.fr', '06.11.02.33.04', 0),
(9, 'nom9', 'prenom9', 'Rue Colbert', '59000', 'Lille', 'i@i.fr', '06.11.02.33.04', 0),
(10, 'nom10', 'prenom10', 'Rue Solférino', '59000', 'Lille', 'j@j.fr', '06.11.02.33.04', 0),
(11, 'nom11', 'prenom11', 'Rue de Lens', '59000', 'Lille', 'k@k.fr', '06.11.02.33.04', 0),
(12, 'nom12', 'prenom12', 'Rue Jules Guesde', '59160', 'Lille', 'l@l.fr', '06.11.02.33.04', 0),
(13, 'nom13', 'prenom13', 'Rue Saint-Bernard', '59000', 'Lille', 'm@m.fr', '06.11.02.33.04', 0),
(14, 'nom14', 'prenom14', 'Rue de la Plaine', '59000', 'Lille', 'n@n.fr', '06.11.02.33.04', 0);

-- --------------------------------------------------------

--
-- Structure de la table `passagersparoffre`
--

CREATE TABLE `passagersparoffre` (
  `idOffre` int(10) NOT NULL,
  `idPassager` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `passagersparoffre`
--

INSERT INTO `passagersparoffre` (`idOffre`, `idPassager`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `passagersparramassage`
--

CREATE TABLE `passagersparramassage` (
  `idRamassage` int(10) NOT NULL,
  `idPassager` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `passagersparramassage`
--

INSERT INTO `passagersparramassage` (`idRamassage`, `idPassager`) VALUES
(1, 13),
(1, 14),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 1),
(4, 2),
(5, 2),
(5, 3),
(6, 4),
(6, 7),
(7, 4),
(7, 7),
(13, 1),
(13, 2),
(14, 2),
(14, 3),
(21, 5),
(21, 6),
(22, 9),
(22, 10);

-- --------------------------------------------------------

--
-- Structure de la table `ramassage`
--

CREATE TABLE `ramassage` (
  `id` int(10) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `codePostal` varchar(5) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ramassage`
--

INSERT INTO `ramassage` (`id`, `adresse`, `codePostal`, `ville`) VALUES
(1, 'Rue Jean Catelas', '80000', 'Amiens'),
(2, 'Rue de la Wattelette', '62000', 'Arras'),
(3, 'Rue jean Jaurès', '86000', 'Poitiers'),
(4, 'Rue Emile Zola', '37000', 'Tours'),
(5, 'Rue Desgroux', '60000', 'Beauvais'),
(6, 'Rue Debray', '80000', 'Amiens'),
(7, 'Rue Amyot', '75005', 'Paris'),
(8, 'Rue Michelet', '89000', 'Auxerre'),
(9, 'Rue de la Préfecture', '37000', 'Tours'),
(10, 'Rue des Bouchers', '28000', 'Chartres'),
(21, 'Rue Pont Mortain', '14100', 'Lisieux'),
(22, 'Boulevard Voltaire', '35000', 'Rennes');

-- --------------------------------------------------------

--
-- Structure de la table `ramassagesparoffre`
--

CREATE TABLE `ramassagesparoffre` (
  `idOffre` int(10) NOT NULL,
  `idRamassage` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ramassagesparoffre`
--

INSERT INTO `ramassagesparoffre` (`idOffre`, `idRamassage`) VALUES
(1, 1),
(1, 2),
(1, 21),
(1, 22),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` char(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `codePostal` varchar(5) DEFAULT NULL,
  `ville` varchar(30) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `voiture` varchar(50) DEFAULT NULL,
  `places` smallint(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `login`, `password`, `nom`, `prenom`, `adresse`, `codePostal`, `ville`, `tel`, `voiture`, `places`) VALUES
(1, 'jdurand@gmail.com', 'jdurand', '$2y$10$JPyuPIhfRhpdo1uyFOqSwuYMq2XZNUd.DIOeO0SDArxx/ccnJwf/.\n', 'Durand', 'Jean', 'Chemin de l''Apothicaire', '59560', 'Comines', '06.11.11.11.11', 'Peugeot 807', 4),
(2, 'jduval@gmail.com', 'jduval', '$2y$10$nMwZ2MxUh4q4TbHhx7N89euNKw0JbxPPIX1u.mVruMFNZgCj0GFrS\n', 'Duval', 'Anne', 'Rue Lagrange', '62300', 'Lens', '06.22.22.22.22', 'Peugeot 206', 2),
(3, 'lahmad@gmail.com', 'lahmad', '$2y$10$r5InmSEnt/MG2hI3wh0cGeUWWe10i0CbAkGC90Yd5EqsA00AM3QLu\n', 'Ahmad', 'Louise', 'Rue de Paris', '60200', 'Compiègne', '06.33.33.33.33', 'Renault Laguna', 3),
(4, 'kanran59@aol.com', 'jbieber', '$2y$10$eKu2ciNbSbN.M5NHb5ALNuESj2L5JB.j98PAC2va93TG94Ewd2qNO', 'bieber', 'justin', 'Rue Youri Gagarine', '52000', 'Chaumont', '07.07.07.07.08', 'Citroen Saxo', 2),
(5, 'rozan.olivier@gmail.com', 'orozan', '$2y$10$IRb/b3ewOaAmJ/u3fxZ19.vkS3tN94nfeHcTgpBMLZO1Tr6zsBC/W', 'rozan', 'olivier', '16 Rue des Aubépines', '59121', 'Haulchin', '07.77.22.21.05', 'Ford Mondeo', 4);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `passagersparoffre`
--
ALTER TABLE `passagersparoffre`
  ADD PRIMARY KEY (`idOffre`,`idPassager`);

--
-- Index pour la table `passagersparramassage`
--
ALTER TABLE `passagersparramassage`
  ADD PRIMARY KEY (`idRamassage`,`idPassager`);

--
-- Index pour la table `ramassage`
--
ALTER TABLE `ramassage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ramassagesparoffre`
--
ALTER TABLE `ramassagesparoffre`
  ADD PRIMARY KEY (`idOffre`,`idRamassage`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `passager`
--
ALTER TABLE `passager`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `ramassage`
--
ALTER TABLE `ramassage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
