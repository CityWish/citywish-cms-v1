-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : ven. 02 oct. 2026 à 08:52
-- Version du serveur : 8.4.11
-- Version de PHP : 8.3.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `title` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `descp` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `author` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `corrector` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dates` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `dates_correction` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `dates_editing` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '',
  `category` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `valid` int NOT NULL DEFAULT '0',
  `deleted` int NOT NULL DEFAULT '0',
  `draft` int NOT NULL DEFAULT '0',
  `corrected` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles_correct`
--

CREATE TABLE `articles_correct` (
  `id` int NOT NULL,
  `title` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `descp` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `author` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dates` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `id_article` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `articles_edit`
--

CREATE TABLE `articles_edit` (
  `id` int NOT NULL,
  `title` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `descp` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `author` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dates` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `category` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_article` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `auth2factor`
--

CREATE TABLE `auth2factor` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `code` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `banip`
--

CREATE TABLE `banip` (
  `id` int NOT NULL,
  `pseudo` varchar(85) NOT NULL,
  `why` text NOT NULL,
  `ip` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `id_article` int NOT NULL,
  `commentaire` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `par` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dates` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `dedi`
--

CREATE TABLE `dedi` (
  `id` int NOT NULL,
  `msg` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `par` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `verif` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `flux`
--

CREATE TABLE `flux` (
  `id` int NOT NULL,
  `pseudo` varchar(85) NOT NULL,
  `uniqueId` varchar(80) NOT NULL,
  `cw_hc` varchar(2) NOT NULL,
  `poste` text NOT NULL,
  `newposte` text NOT NULL,
  `pole` int NOT NULL,
  `in_out` int NOT NULL,
  `month` int NOT NULL,
  `year` int NOT NULL,
  `webhook` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `flux_webhook`
--

CREATE TABLE `flux_webhook` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `link` varchar(135) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `avatar` varchar(135) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `onoff` int NOT NULL DEFAULT '0',
  `role` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `giveaways`
--

CREATE TABLE `giveaways` (
  `id` int NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `timestamp` varchar(100) DEFAULT NULL,
  `author` int DEFAULT NULL,
  `winner` varchar(50) DEFAULT NULL,
  `nb_winners` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `giveaways_participants`
--

CREATE TABLE `giveaways_participants` (
  `id` int NOT NULL,
  `id_user` int NOT NULL DEFAULT '0',
  `id_giveaway` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `logs` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `par` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dates` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE `maintenance` (
  `etat` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int NOT NULL,
  `id_discord` varchar(20) NOT NULL DEFAULT 'none',
  `discord_tokens` varchar(70) NOT NULL DEFAULT 'none',
  `name` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `uniqueId` int NOT NULL,
  `mail` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rang` int NOT NULL DEFAULT '1',
  `moto` varchar(105) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Pour changer votre description allez dans paramètres',
  `genre` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `certif` int NOT NULL DEFAULT '0',
  `hide` int NOT NULL DEFAULT '0',
  `point_staff` int NOT NULL DEFAULT '0',
  `stats_staff` int NOT NULL DEFAULT '0',
  `jetons` int NOT NULL DEFAULT '0',
  `points` int DEFAULT '0',
  `activ_p_s` int NOT NULL DEFAULT '0',
  `fonction` varchar(110) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Membre',
  `vote` int DEFAULT '0',
  `ip_adresse` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ban` int DEFAULT '0',
  `flux` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `members_figure`
--

CREATE TABLE `members_figure` (
  `id` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `figure` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `members_perms`
--

CREATE TABLE `members_perms` (
  `id` int NOT NULL,
  `id_member` int NOT NULL,
  `perms_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `titre` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descp` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `par` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dates` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `categorie` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `supprimer` int NOT NULL DEFAULT '0',
  `valid` int NOT NULL DEFAULT '0',
  `background` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `partners`
--

CREATE TABLE `partners` (
  `id` int NOT NULL,
  `name` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link` varchar(125) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `img` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `img_little` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `color` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `descp` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `valid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `name` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `descp` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ranking_discord`
--

CREATE TABLE `ranking_discord` (
  `id` int NOT NULL,
  `id_discord` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `points` int NOT NULL,
  `month` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `year` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ranking` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statutvote`
--

CREATE TABLE `statutvote` (
  `id` int NOT NULL,
  `staffs` int NOT NULL,
  `user` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `onoff` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `team_poles`
--

CREATE TABLE `team_poles` (
  `id` int NOT NULL,
  `name` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `recruitment_status` int NOT NULL DEFAULT '0',
  `color` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `default_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `team_staffs`
--

CREATE TABLE `team_staffs` (
  `id` int NOT NULL,
  `id_pole` int NOT NULL,
  `id_member` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `view_article`
--

CREATE TABLE `view_article` (
  `id` int NOT NULL,
  `id_article` int NOT NULL,
  `IP` varchar(85) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dates` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int NOT NULL,
  `id_users` int NOT NULL,
  `id_whovote` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles_correct`
--
ALTER TABLE `articles_correct`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `articles_edit`
--
ALTER TABLE `articles_edit`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `auth2factor`
--
ALTER TABLE `auth2factor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dedi`
--
ALTER TABLE `dedi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flux`
--
ALTER TABLE `flux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `flux_webhook`
--
ALTER TABLE `flux_webhook`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `giveaways`
--
ALTER TABLE `giveaways`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `giveaways_participants`
--
ALTER TABLE `giveaways_participants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`etat`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members_figure`
--
ALTER TABLE `members_figure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_figure_id_user_index` (`id_user`);

--
-- Index pour la table `members_perms`
--
ALTER TABLE `members_perms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_perms_members_id_fk` (`id_member`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ranking_discord`
--
ALTER TABLE `ranking_discord`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statutvote`
--
ALTER TABLE `statutvote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team_poles`
--
ALTER TABLE `team_poles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team_staffs`
--
ALTER TABLE `team_staffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_pole` (`id_pole`);

--
-- Index pour la table `view_article`
--
ALTER TABLE `view_article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles_correct`
--
ALTER TABLE `articles_correct`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles_edit`
--
ALTER TABLE `articles_edit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auth2factor`
--
ALTER TABLE `auth2factor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dedi`
--
ALTER TABLE `dedi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flux`
--
ALTER TABLE `flux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flux_webhook`
--
ALTER TABLE `flux_webhook`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `giveaways`
--
ALTER TABLE `giveaways`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `giveaways_participants`
--
ALTER TABLE `giveaways_participants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members_figure`
--
ALTER TABLE `members_figure`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `members_perms`
--
ALTER TABLE `members_perms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ranking_discord`
--
ALTER TABLE `ranking_discord`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statutvote`
--
ALTER TABLE `statutvote`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team_poles`
--
ALTER TABLE `team_poles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `team_staffs`
--
ALTER TABLE `team_staffs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `view_article`
--
ALTER TABLE `view_article`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `members_perms`
--
ALTER TABLE `members_perms`
  ADD CONSTRAINT `members_perms_members_id_fk` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`);

--
-- Contraintes pour la table `team_staffs`
--
ALTER TABLE `team_staffs`
  ADD CONSTRAINT `id_member` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `id_pole` FOREIGN KEY (`id_pole`) REFERENCES `team_poles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
