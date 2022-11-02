-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 08 juil. 2022 à 14:23
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `miaror`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `imageExt` enum('jpg','png','gif','svg','tiff') NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `tag`, `title`, `imageExt`, `content`) VALUES
(1, 'programmation', 'HTML, JavaScript et Python sont les langages favoris des développeurs.', 'jpg', 'empty'),
(2, 'cybersecurite', 'Google chrome reçoit une mise à jour de sécurité d\'urgence sur Windows et Android.', 'jpg', 'empty'),
(3, 'sante', 'Les AirPods Pro 2 d’Apple seraient dépourvus des fonctions de santé.', 'jpg', '<p>Selon la rumeur, les écouteurs sans fil <a href=\"https://www.blog-nouvelles-technologies.fr/tag/airpods-pro-2/\">AirPods Pro 2</a> d’Apple devraient recevoir un capteur de surveillance de la fréquence cardiaque cette année, mais les choses ne semblent pas si brillantes pour les nouveaux écouteurs. Selon une nouvelle information, \n                le nouveau capteur pourrait ne pas être prêt pour le prime time, et Apple l’aurait mis à l’écart, car il n’était pas prêt.</p>'),
(7, 'sante', 'L\'importance du travail de groupe', 'png', '<p>Le travail de groupe permet de ne pas se sentir seul, et ouais</p>');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `message`, `name`, `note`) VALUES
(1, 'excellent concept  !', 'Lucas', 10),
(9, 'c\'est génial comme concept je valide très fort !', 'Galitan', 10);

-- --------------------------------------------------------

--
-- Structure de la table `betaTesters`
--

CREATE TABLE `betaTesters` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `forname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `betaTesters`
--

INSERT INTO `betaTesters` (`id`, `email`, `name`, `forname`) VALUES
(3, 'yanis@hotmail.fr', 'Yanis', 'Bk'),
(6, 'azea', 'zaeaze', 'azeaez'),
(8, 'imgood@mail.com', 'keep', 'me'),
(9, '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `boosts`
--

CREATE TABLE `boosts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boosts`
--

INSERT INTO `boosts` (`id`, `name`, `cost`) VALUES
(1, 'Programmes Personnalisés', 10),
(2, 'Assistant Vocal', 15),
(3, 'Suivi de Consommation', 5),
(4, 'Support 24/7', 2),
(5, 'Chauffage anti-buée', 8),
(6, 'Détecteur de présence', 2);

-- --------------------------------------------------------

--
-- Structure de la table `partnerCodes`
--

CREATE TABLE `partnerCodes` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `partnerCodes`
--

INSERT INTO `partnerCodes` (`id`, `email`, `code`) VALUES
(1, 'imwrong@mail.com', 'IsuI3tV2'),
(2, 'imgood@mail.com', 'AFGN9wFM'),
(3, '', 'ZZltXxtd');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(5, 'my@mail.com', 'mypass'),
(6, 'test@hotmail.fr', 'jojo92'),
(12, 'ahah@hotmail.fr', '$2y$10$oqmKuYC9wUMyukxrH134SOkfapi8aSsueDZ1dairyhBthOO6p6gPq');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `betaTesters`
--
ALTER TABLE `betaTesters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `boosts`
--
ALTER TABLE `boosts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partnerCodes`
--
ALTER TABLE `partnerCodes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `betaTesters`
--
ALTER TABLE `betaTesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `boosts`
--
ALTER TABLE `boosts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `partnerCodes`
--
ALTER TABLE `partnerCodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
