-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 27 mars 2020 à 17:09
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `master_eil`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `Id` int(50) NOT NULL,
  `Filename` longtext NOT NULL,
  `Commentaire` varchar(50) NOT NULL,
  `Titre` varchar(37) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id`, `Filename`, `Commentaire`, `Titre`, `id_user`) VALUES
(2, './photos/tmXDd_19qt3m.jpg', 'Test d\'un commentaire', 'Ceci est un titre de test', 2),
(3, './photos/pK3NM_moyenage.jpg', 'Le commentaire de l&#039;article du Moyen-Age', 'Article sur le moyen age', 3),
(4, './photos/upkER_logo museum.png', 'Je sers toujours de test à la suppression ...', 'Je sais que je vais être supprimé', 3),
(5, './photos/ClFAy_secww.jpg', 'zzzzz', 'zzzz', 3),
(6, './photos/D8Hbq_logo museum.png', 'ssssss', 'ssss', 1),
(7, './photos/lT7zF_icone-musee.png', 'aaaaa', 'aaaaaa', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `Id` int(37) NOT NULL,
  `Nom` varchar(37) NOT NULL,
  `Prenom` varchar(37) NOT NULL,
  `Email` varchar(37) NOT NULL,
  `MotDePasse` varchar(37) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`Id`, `Nom`, `Prenom`, `Email`, `MotDePasse`) VALUES
(1, 'Pjde', 'Val', 'valentinpoujade@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'ubiergo', 'antoine', 'aa@aa.fr', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'ROLLET', 'Mr', 'admin@admin.fr', '21232f297a57a5a743894a0e4a801fc3');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `Id` int(37) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
