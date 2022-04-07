-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 03 Avril 2022 à 19:49
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `escalade`
--

-- --------------------------------------------------------

--
-- Structure de la table `bloc`
--

CREATE TABLE `bloc` (
  `id` int(11) NOT NULL,
  `grimpeur` varchar(30) NOT NULL,
  `idGrimpeur` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `cotation` varchar(5) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bloc`
--

INSERT INTO `bloc` (`id`, `grimpeur`, `idGrimpeur`, `nom`, `cotation`, `description`, `date`) VALUES
(37, 'Camille', 38, 'Burden of Dreams', '9a', 'Vraiment pas dur', '2022-04-03'),
(38, 'Camille', 38, 'Return of the sleepwalker', '8c+', 'Fait en no-foot', '2022-04-03'),
(48, 'Guillaume', 35, 'ArÃªte des fourmis', '5b', 'Un rÃ©ta pas si simple', '2022-04-03');

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE `classement` (
  `id` int(11) NOT NULL,
  `grimpeur` varchar(50) NOT NULL,
  `niveauVoie` varchar(3) NOT NULL,
  `niveauBloc` varchar(3) NOT NULL,
  `niveauVSup` varchar(50) NOT NULL,
  `nbVoies` int(5) NOT NULL,
  `nbBlocs` int(5) NOT NULL,
  `nbVSup` int(5) NOT NULL,
  `points` int(10) NOT NULL,
  `pointsVoie` int(10) NOT NULL,
  `pointsBloc` int(10) NOT NULL,
  `pointsVSup` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `classement`
--

INSERT INTO `classement` (`id`, `grimpeur`, `niveauVoie`, `niveauBloc`, `niveauVSup`, `nbVoies`, `nbBlocs`, `nbVSup`, `points`, `pointsVoie`, `pointsBloc`, `pointsVSup`) VALUES
(35, 'Guillaume', '6c+', '5b', 'Rouge/Orange', 1, 1, 1, 14094, 10000, 24, 4096),
(36, 'Louis', '6c', '0', 'Rouge', 2, 0, 1, 9082, 6681, 0, 2401),
(38, 'Camille', '9c', '9a', 'Arc-en-ciel', 1, 2, 1, 2622448, 1434890, 1158997, 28561);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `logname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`id`, `logname`, `password`) VALUES
(35, 'Guillaume', '0cc175b9c0f1b6a831c399e269772661'),
(36, 'Louis', '0cc175b9c0f1b6a831c399e269772661'),
(38, 'Camille', '0cc175b9c0f1b6a831c399e269772661');

-- --------------------------------------------------------

--
-- Structure de la table `voie`
--

CREATE TABLE `voie` (
  `id` int(11) NOT NULL,
  `grimpeur` varchar(30) NOT NULL,
  `idGrimpeur` int(10) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `cotation` varchar(5) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voie`
--

INSERT INTO `voie` (`id`, `grimpeur`, `idGrimpeur`, `nom`, `cotation`, `description`, `date`) VALUES
(45364, 'Camille', 38, 'Silence', '9c', 'Flash', '2022-04-03'),
(45365, 'Guillaume', 35, 'Bigdil', '6c+', 'Faite Ã  la deuxiÃ¨me session, au premier vrai essai !', '2022-04-03'),
(45368, 'Louis', 36, 'Pilier des pirates', '6a+', 'Que des bacs', '2022-04-03'),
(45370, 'Louis', 36, 'Bertille Blues', '6c', 'Flash', '2022-04-03');

-- --------------------------------------------------------

--
-- Structure de la table `vsup`
--

CREATE TABLE `vsup` (
  `id` int(11) NOT NULL,
  `grimpeur` varchar(30) NOT NULL,
  `idGrimpeur` int(10) NOT NULL,
  `cotation` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vsup`
--

INSERT INTO `vsup` (`id`, `grimpeur`, `idGrimpeur`, `cotation`, `description`, `date`) VALUES
(11, 'Camille', 38, 'Arc-en-ciel', 'Fait Ã  une seule main', '2022-04-03'),
(15, 'Guillaume', 35, 'Rouge/Orange', 'Je la fais avant que Louis la dÃ©truise avec un burin', '2022-04-03'),
(17, 'Louis', 36, 'Rouge', 'La traversÃ©e orange marbrÃ©e', '2022-04-03');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `bloc`
--
ALTER TABLE `bloc`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classement`
--
ALTER TABLE `classement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voie`
--
ALTER TABLE `voie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vsup`
--
ALTER TABLE `vsup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `bloc`
--
ALTER TABLE `bloc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `classement`
--
ALTER TABLE `classement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `voie`
--
ALTER TABLE `voie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45371;
--
-- AUTO_INCREMENT pour la table `vsup`
--
ALTER TABLE `vsup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
