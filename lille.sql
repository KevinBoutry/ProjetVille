-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 27 fév. 2023 à 16:41
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lille`
--

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `idLieu` int(11) NOT NULL,
  `nomLieu` varchar(255) NOT NULL,
  `lat` varchar(25) NOT NULL,
  `lon` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`idLieu`, `nomLieu`, `lat`, `lon`, `image`, `adresse`) VALUES
(1, 'Mairie', '50.63093', '3.0709', '1675952987-63e5035b023e04.20538368-mairie.jpg', 'Mairie de Lille'),
(2, 'beauxarts', '50.63079', '3.06211', '1675954352-63e508b0b3cf16.60390315-beauxarts.jpg', 'Place de la République'),
(3, 'citadelle', '50.6409', '3.0446', '1675954452-63e509141bfd94.09603968-citadelle.jpg', 'Avenue du 43e régiment d\'infanterie'),
(5, 'Opéra de Lille', '50.63745', '3.06511', '1676389184-63ebab40883bc2.30897920-opera.jpg', 'Place du Théâtre'),
(6, 'Musée Charles de Gaulle', '50.64600', '3.05868', '1676905666-63f38cc27e0c89.92574111-degaulle.jpg', '9 rue Princesse');

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

CREATE TABLE `quizz` (
  `idQuestion` int(11) NOT NULL,
  `question` text NOT NULL,
  `choix1` text NOT NULL,
  `choix2` text NOT NULL,
  `choix3` text DEFAULT NULL,
  `choix4` text DEFAULT NULL,
  `reponse` text NOT NULL,
  `idLieu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `quizz`
--

INSERT INTO `quizz` (`idQuestion`, `question`, `choix1`, `choix2`, `choix3`, `choix4`, `reponse`, `idLieu`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s ?', 'réponse 1', 'réponse 2', 'réponse 3', 'réponse 4', '2', 5),
(2, 'Ici doit se trouver une question ?', 'la réponse 1', 'la réponse 2 (bonne réponse)', 'la réponse 3', 'la réponse 4', '2', 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `IdUser` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `etapeQuizz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`IdUser`, `email`, `password`, `etapeQuizz`) VALUES
(1, 'kevin@machin.com', '$2y$10$.GBkI5Qu87ERZ3B13opDkuuekhtKWxUpjV0dYUqvxwonqT4.QgzVe', NULL),
(2, 'bidule@truc.fr', '$2y$10$XJnh2as/ZHs.jCu//FUCje7VQmX23sE0cQMCij4yOzcM3IkU.k9Ly', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`idLieu`);

--
-- Index pour la table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`idQuestion`),
  ADD KEY `idLieu` (`idLieu`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `idLieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `quizz`
--
ALTER TABLE `quizz`
  ADD CONSTRAINT `quizz_ibfk_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
