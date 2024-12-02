-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 02 déc. 2024 à 10:54
-- Version du serveur : 8.0.37-0ubuntu0.23.10.2
-- Version de PHP : 8.2.10-2ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionbeblio`
--

-- --------------------------------------------------------

--
-- Structure de la table `Auteur`
--

CREATE TABLE `Auteur` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `biographie` text,
  `date_de_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Auteur`
--

INSERT INTO `Auteur` (`id`, `nom`, `biographie`, `date_de_naissance`) VALUES
(1, 'auteur1', 'blablabla', '1996-11-12'),
(2, 'auteur2', 'blebleble', '2000-11-14'),
(9, 'yassssin', 'testtesttestinnnn', '2005-01-12'),
(10, 'immen', 'imimimimmmmemnnnnnnnnnnnn', '1999-03-12'),
(13, 'testt', 'testtestetstttt', '2024-11-14');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `livre_id` int NOT NULL,
  `commentaire` text NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `livre_id`, `commentaire`, `date_creation`) VALUES
(1, 20, 'testetesttest', '2024-12-02 10:26:22'),
(2, 20, 'test', '2024-12-02 10:26:47'),
(3, 14, 'blabla', '2024-12-02 10:27:27'),
(4, 16, 'testtesttest', '2024-12-02 10:31:39'),
(5, 14, 'blellllllllll', '2024-12-02 10:35:04'),
(6, 17, 'c est un tres bon livre', '2024-12-02 10:42:23'),
(7, 18, 'non ce ne pas bon', '2024-12-02 10:43:29'),
(8, 20, 'xyzxyz', '2024-12-02 10:45:06');

-- --------------------------------------------------------

--
-- Structure de la table `Emprunt`
--

CREATE TABLE `Emprunt` (
  `id` int NOT NULL,
  `livre_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `date_emprunt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Emprunt`
--

INSERT INTO `Emprunt` (`id`, `livre_id`, `utilisateur_id`, `date_emprunt`) VALUES
(16, 16, 3, '2024-12-01'),
(17, 19, 3, '2024-12-02');

-- --------------------------------------------------------

--
-- Structure de la table `Genre`
--

CREATE TABLE `Genre` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Genre`
--

INSERT INTO `Genre` (`id`, `nom`, `description`) VALUES
(1, 'genre1', 'testtestetstetstest'),
(8, 'tell', 'telllllllllllllllllllllll'),
(11, 'test', 'testtesttesttest'),
(12, 'ggg22', 'ggggggggggggggg22222222');

-- --------------------------------------------------------

--
-- Structure de la table `historique_emprunts`
--

CREATE TABLE `historique_emprunts` (
  `id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `livre_id` int NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `historique_emprunts`
--

INSERT INTO `historique_emprunts` (`id`, `utilisateur_id`, `livre_id`, `date_emprunt`, `date_retour`) VALUES
(1, 3, 16, '2024-12-01', '2024-12-01'),
(2, 3, 17, '2024-12-01', '2024-12-01'),
(3, 3, 16, '2024-12-01', NULL),
(4, 3, 19, '2024-12-02', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Livre`
--

CREATE TABLE `Livre` (
  `id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur_id` int NOT NULL,
  `genre_id` int NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Livre`
--

INSERT INTO `Livre` (`id`, `titre`, `auteur_id`, `genre_id`, `ISBN`, `disponible`, `image`) VALUES
(14, 'blaaaaaa', 1, 1, '1121', 1, 'uploads/emblem-best-quality-number-1-png_62239.jpg'),
(16, 'liv111', 1, 11, '1211', 0, 'uploads/img1.jpeg'),
(17, 'liv2', 2, 8, '233', 1, 'uploads/img2.jpeg'),
(18, 'test2', 2, 12, '121', 1, 'uploads/img3.jpeg'),
(19, 'livX', 2, 11, '1122', 0, 'uploads/img1.jpeg'),
(20, 'livY', 10, 12, '10100', 1, 'uploads/img3.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id`, `nom`, `email`, `phone`, `password`, `role`) VALUES
(1, 'yass', 'yassin@gmail.com', '55444333', '$2y$10$J.UP5lJ3tLX8Wp4j5z6Fa.TlK3lUdyIlzh3WLiUpmH2ZArt80D9zm', 'user'),
(2, 'imen', 'imen@gmail.com', '44333222', '$2y$10$PbXQuzHq8Ty3ZkKAKeQWJ.aUyKttlQULg/PG0ItpD4iaY4Wf1g75u', 'user'),
(3, 'mhamed', 'mhamed@gmail.com', '66555444', 'mh123', 'user'),
(4, 'arafet', 'arafet@gmail.com', '99333222', 'arafet123', 'admin'),
(5, 'yassine', 'yassblk@gmail.com', '55434343', 'yassblk05', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Auteur`
--
ALTER TABLE `Auteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livre_id` (`livre_id`);

--
-- Index pour la table `Emprunt`
--
ALTER TABLE `Emprunt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_livre` (`livre_id`),
  ADD KEY `fk_utilisateur` (`utilisateur_id`);

--
-- Index pour la table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique_emprunts`
--
ALTER TABLE `historique_emprunts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utilisateurr` (`utilisateur_id`),
  ADD KEY `fk_livree` (`livre_id`);

--
-- Index pour la table `Livre`
--
ALTER TABLE `Livre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `fk_auteur` (`auteur_id`),
  ADD KEY `fk_genre` (`genre_id`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Auteur`
--
ALTER TABLE `Auteur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Emprunt`
--
ALTER TABLE `Emprunt`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `Genre`
--
ALTER TABLE `Genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `historique_emprunts`
--
ALTER TABLE `historique_emprunts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Livre`
--
ALTER TABLE `Livre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`livre_id`) REFERENCES `Livre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Emprunt`
--
ALTER TABLE `Emprunt`
  ADD CONSTRAINT `fk_livre` FOREIGN KEY (`livre_id`) REFERENCES `Livre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `Utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historique_emprunts`
--
ALTER TABLE `historique_emprunts`
  ADD CONSTRAINT `fk_livree` FOREIGN KEY (`livre_id`) REFERENCES `Livre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utilisateurr` FOREIGN KEY (`utilisateur_id`) REFERENCES `Utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Livre`
--
ALTER TABLE `Livre`
  ADD CONSTRAINT `fk_auteur` FOREIGN KEY (`auteur_id`) REFERENCES `Auteur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_genre` FOREIGN KEY (`genre_id`) REFERENCES `Genre` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
