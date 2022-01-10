-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 10 jan. 2022 à 14:51
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `j3m`
--

-- --------------------------------------------------------

--
-- Structure de la table `jsondata`
--

CREATE TABLE `jsondata` (
  `date` varchar(8) DEFAULT NULL,
  `version` varchar(1) DEFAULT NULL,
  `headerLength` varchar(10) DEFAULT NULL,
  `service` varchar(10) DEFAULT NULL,
  `identification` varchar(10) DEFAULT NULL,
  `flags_code` varchar(10) DEFAULT NULL,
  `ttl` varchar(3) DEFAULT NULL,
  `protocol_name` varchar(10) DEFAULT NULL,
  `protocol_checksum__status` varchar(30) DEFAULT NULL,
  `protocol_ports__from` varchar(10) DEFAULT NULL,
  `protocol_ports__dest` varchar(10) DEFAULT NULL,
  `headerChecksum` varchar(30) DEFAULT NULL,
  `ip_from` varchar(8) DEFAULT NULL,
  `ip_dest` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `speudo` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
