-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : ven. 19 mai 2023 à 16:28
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `lname`, `fname`, `password`, `email`) VALUES
(1, 'otmani', 'abderrahim', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `domain`, `category`) VALUES
(1, 'fitness', 'fitness'),
(2, 'beaute', 'beaute'),
(3, 'commerce', 'commerce'),
(4, 'industrie', 'indusrie'),
(5, 'autre', 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `influencer_id` int DEFAULT NULL,
  `marque_id` int DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `duration` int DEFAULT NULL,
  `content` text,
  `price` float DEFAULT NULL,
  `status` enum('negotiation','active','canceled','finished') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `influencer_id` (`influencer_id`),
  KEY `marque_id` (`marque_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`id`, `influencer_id`, `marque_id`, `date_added`, `duration`, `content`, `price`, `status`) VALUES
(7, 50, 150, '2023-05-16 19:41:09', 31, 'about sharing videos on youtube and sponsoring twitter', 5500, 'active'),
(6, 32, 131, '2023-05-14 02:11:01', 4, 'Lorem Ipsum 3', 406, 'active'),
(11, 55, 141, '2023-05-18 13:16:30', 62, 'instagram', 62, 'active'),
(10, 55, 152, '2023-05-18 12:41:41', 95, 'instagram collaboration', 500000, 'active');

-- --------------------------------------------------------

--
-- Structure de la table `demsup`
--

DROP TABLE IF EXISTS `demsup`;
CREATE TABLE IF NOT EXISTS `demsup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `sender_type` enum('marque','influenceur') NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demsup`
--

INSERT INTO `demsup` (`id`, `sender_id`, `sender_type`, `date`) VALUES
(1, 1, 'marque', '2023-05-13 18:08:44'),
(5, 5, 'marque', '2023-05-13 18:08:57'),
(6, 35, 'influenceur', '2023-05-16 06:25:26'),
(7, 55, 'influenceur', '2023-05-18 11:34:39'),
(8, 152, 'marque', '2023-05-18 11:37:48');

-- --------------------------------------------------------

--
-- Structure de la table `influenceur`
--

DROP TABLE IF EXISTS `influenceur`;
CREATE TABLE IF NOT EXISTS `influenceur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'http://localhost/project/signup_influenceur/pdp/default.png',
  `youtube` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `influenceur`
--

INSERT INTO `influenceur` (`id`, `lname`, `fname`, `password`, `email`, `birth_date`, `category_id`, `photo`, `youtube`, `facebook`, `instagram`) VALUES
(55, 'billy', 'gates', 'test', 'bill@gates.com', '1965-01-01', 4, '../signup_influenceur/pdp/bill.jpeg', 'bill yt', 'bill fb', 'bill tv'),
(41, 'Brown', 'Sarah', 'test', 'sarah.brown@example.com', '1993-07-03', 1, 'http://localhost/project/signup_influenceur/pdp/default.png', 'sarah_brown_youtube', 'sarah_brown_facebook', 'sarah_brown_instagram'),
(43, 'Anderson', 'Jessica', 'test', 'jessica.anderson@example.com', '1991-05-25', 2, 'http://localhost/project/signup_influenceur/pdp/default.png', 'jessica_anderson_youtube', 'jessica_anderson_facebook', 'jessica_anderson_instagram'),
(44, 'Lee', 'Andrew', 'test', 'andrew.lee@example.com', '1994-09-07', 1, 'http://localhost/project/signup_influenceur/pdp/default.png', 'andrew_lee_youtube', 'andrew_lee_facebook', 'andrew_lee_instagram'),
(45, 'Harris', 'Olivia', 'test', 'olivia.harris@example.com', '1987-03-12', 2, 'http://localhost/project/signup_influenceur/pdp/default.png', 'olivia_harris_youtube', 'olivia_harris_facebook', 'olivia_harris_instagram'),
(46, 'Clark', 'Daniel', 'test', 'daniel.clark@example.com', '1990-08-29', 3, 'http://localhost/project/signup_influenceur/pdp/default.png', 'daniel_clark_youtube', 'daniel_clark_facebook', 'daniel_clark_instagram'),
(47, 'Lewis', 'Sophia', 'test', 'sophia.lewis@example.com', '1992-01-02', 1, 'http://localhost/project/signup_influenceur/pdp/default.png', 'sophia_lewis_youtube', 'sophia_lewis_facebook', 'sophia_lewis_instagram'),
(48, 'Young', 'Benjamin', 'test', 'benjamin.young@example.com', '1989-06-17', 2, 'http://localhost/project/signup_influenceur/pdp/default.png', 'benjamin_young_youtube', 'benjamin_young_facebook', 'benjamin_young_instagram'),
(49, 'Walker', 'Ava', 'test', 'ava.walker@example.com', '1993-11-30', 3, 'http://localhost/project/signup_influenceur/pdp/default.png', 'ava_walker_youtube', 'ava_walker_facebook', 'ava_walker_instagram'),
(56, 'test', 'infl', 'test', 'test@inf.com', '2000-01-01', 5, '../signup_influenceur/pdp/test.png', 'testyt', 'testfb', 'testig');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'http://localhost/project/signup_marque/pdp/default.png',
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `ca` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `name`, `logo`, `password`, `email`, `address`, `category_id`, `ca`) VALUES
(153, 'test', '../signup_marque/pdp/test.png', 'test', 'test@marque.com', 'Arbaoua', 5, 46000),
(137, 'Apple', 'http://localhost/project/signup_marque/pdp/default.png', 'apple123', 'contact@apple.com', '789 Apple Street, City', 2, 10000000),
(138, 'Samsung', 'http://localhost/project/signup_marque/pdp/default.png', 'samsung123', 'contact@samsung.com', '321 Samsung Street, City', 2, 8000000),
(141, 'Microsoft', 'http://localhost/project/signup_marque/pdp/default.png', 'microsoft123', 'contact@microsoft.com', '159 Microsoft Street, City', 2, 9000000),
(140, 'Toyota', 'http://localhost/project/signup_marque/pdp/default.png', 'toyota123', 'contact@toyota.com', '987 Toyota Street, City', 4, 7000000),
(144, 'Mercedes-Benz', 'http://localhost/project/signup_marque/pdp/default.png', 'mercedes123', 'contact@mercedes.com', '369 Mercedes Street, City', 4, 6000000),
(143, 'Amazon', 'http://localhost/project/signup_marque/pdp/default.png', 'amazon123', 'contact@amazon.com', '258 Amazon Street, City', 2, 12000000),
(142, 'Louis Vuitton', 'http://localhost/project/signup_marque/pdp/default.png', 'louisvuitton123', 'contact@louisvuitton.com', '753 LV Street, City', 5, 3000000),
(145, 'H&M', 'http://localhost/project/signup_marque/pdp/default.png', 'hm123', 'contact@hm.com', '852 H&M Street, City', 5, 2000000),
(146, 'Sony', 'http://localhost/project/signup_marque/pdp/default.png', 'sony123', 'contact@sony.com', '741 Sony Street, City', 2, 5000000),
(147, 'Pepsi', 'http://localhost/project/signup_marque/pdp/default.png', 'pepsi123', 'contact@pepsi.com', '963 Pepsi Street, City', 3, 4000000),
(148, 'BMW', 'http://localhost/project/signup_marque/pdp/default.png', 'bmw123', 'contact@bmw.com', '123 BMW Street, City', 4, 7000000),
(149, 'Google', 'http://localhost/project/signup_marque/pdp/default.png', 'google123', 'contact@google.com', '456 Google Street, City', 2, 15000000);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `content` text,
  `attachment` varchar(255) DEFAULT NULL,
  `sender_type` varchar(20) NOT NULL,
  `receiver_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=353 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `date`, `content`, `attachment`, `sender_type`, `receiver_type`) VALUES
(348, 55, 141, '2023-05-18 13:15:13', 'we should talk', NULL, 'influenceur', 'marque'),
(347, 141, 55, '2023-05-18 13:15:06', 'hello', NULL, 'marque', 'influenceur'),
(346, 55, 141, '2023-05-18 13:15:01', 'hello', NULL, 'influenceur', 'marque'),
(345, 1, 338, '2023-05-18 12:49:11', 'hi', NULL, 'admin', 'influenceur'),
(344, 1, 136, '2023-05-18 12:48:32', 'hello', NULL, 'admin', 'marque'),
(343, 1, 42, '2023-05-18 12:48:21', 'hello how can i help you', NULL, 'admin', 'influenceur'),
(342, 1, 55, '2023-05-18 12:44:12', 'how can i help you', NULL, 'admin', 'influenceur'),
(341, 152, 55, '2023-05-18 12:42:21', 'hello', NULL, 'marque', 'influenceur'),
(340, 55, 152, '2023-05-18 12:42:16', 'hi', NULL, 'influenceur', 'marque'),
(339, 152, 55, '2023-05-18 12:38:30', 'hello', NULL, 'marque', 'influenceur'),
(338, 55, 1, '2023-05-18 12:36:33', 'hello, i have a problem', NULL, 'influenceur', 'admin'),
(337, 55, 137, '2023-05-18 12:36:21', 'hello', NULL, 'influenceur', 'marque'),
(336, 55, 136, '2023-05-18 12:36:04', 'we need to talk about our collaboration', NULL, 'influenceur', 'marque'),
(335, 55, 136, '2023-05-18 12:35:54', 'hello', NULL, 'influenceur', 'marque'),
(334, 54, 1, '2023-05-18 12:14:14', 'hi', NULL, 'influenceur', 'admin'),
(333, 54, 134, '2023-05-18 12:14:06', 'hello', NULL, 'influenceur', 'marque'),
(332, 53, 149, '2023-05-16 20:06:39', 'lets talk about our future business', NULL, 'influenceur', 'marque'),
(331, 150, 50, '2023-05-16 19:40:35', 'can we talk about a new contract', NULL, 'marque', 'influenceur'),
(330, 50, 150, '2023-05-16 19:40:27', 'hello', NULL, 'influenceur', 'marque'),
(329, 150, 50, '2023-05-16 19:40:15', 'hii', NULL, 'marque', 'influenceur'),
(328, 150, 50, '2023-05-16 19:39:48', 'hello bill', NULL, 'marque', 'influenceur'),
(327, 50, 141, '2023-05-16 19:36:48', 'i want to talk with you about our negotiations', NULL, 'influenceur', 'marque'),
(325, 134, 37, '2023-05-16 19:16:57', 'hello', NULL, 'marque', 'influenceur'),
(326, 50, 141, '2023-05-16 19:36:36', 'hello', NULL, 'influenceur', 'marque'),
(319, 37, 114, '2023-05-16 19:02:28', 'hio', NULL, 'influenceur', 'marque'),
(318, 37, 114, '2023-05-16 19:01:53', 'hello', NULL, 'influenceur', 'marque'),
(317, 35, 1, '2023-05-16 18:48:27', 'hello', NULL, 'influenceur', 'admin'),
(316, 114, 1, '2023-05-16 18:43:54', 'admin', NULL, 'marque', 'admin'),
(315, 114, 1, '2023-05-16 18:42:02', 'fgf', NULL, 'marque', 'admin'),
(314, 114, 1, '2023-05-16 18:40:30', 'test', NULL, 'marque', 'admin'),
(313, 114, 36, '2023-05-16 18:32:12', 'khjhb', NULL, 'marque', 'influenceur'),
(312, 114, 35, '2023-05-16 18:32:05', 'hiii', NULL, 'marque', 'influenceur'),
(311, 114, 35, '2023-05-16 18:22:09', 'otm', NULL, 'marque', 'influenceur'),
(310, 114, 35, '2023-05-16 18:17:57', 'jhgjhg', NULL, 'marque', 'influenceur'),
(309, 35, 114, '2023-05-16 07:24:45', 'regrge', NULL, 'influenceur', 'marque'),
(308, 35, 114, '2023-05-16 07:24:44', 'rgerg', NULL, 'influenceur', 'marque'),
(307, 35, 114, '2023-05-16 07:24:43', 'erveg', NULL, 'influenceur', 'marque'),
(306, 35, 114, '2023-05-16 07:24:42', 'jhfdverd', NULL, 'influenceur', 'marque'),
(305, 35, 114, '2023-05-16 07:24:06', 'hrllo', NULL, 'influenceur', 'marque'),
(304, 114, 35, '2023-05-16 07:23:22', 'hello', NULL, 'marque', 'influenceur'),
(303, 114, 35, '2023-05-16 07:23:18', 'hi', NULL, 'marque', 'influenceur'),
(302, 114, 0, '2023-05-16 07:19:23', 'fvvrv', NULL, 'marque', 'influenceur'),
(301, 114, 35, '2023-05-16 07:14:02', 'lkkl', NULL, 'marque', 'influenceur'),
(300, 1, 35, '2023-05-16 06:58:41', 'hi', NULL, 'admin', 'influenceur'),
(299, 114, 35, '2023-05-16 06:54:33', 'lkkj', NULL, 'marque', 'influenceur'),
(298, 114, 114, '2023-05-16 06:53:35', ';mo', NULL, 'marque', 'marque'),
(297, 114, 35, '2023-05-16 06:53:10', 'klkjk', NULL, 'marque', 'influenceur'),
(296, 114, 114, '2023-05-16 06:46:10', 'hi', NULL, 'marque', 'marque'),
(295, 114, 114, '2023-05-16 06:44:15', 'heloo\r\n', NULL, 'marque', 'influenceur'),
(294, 114, 114, '2023-05-16 06:43:24', 'hi\r\n', NULL, 'marque', 'influenceur'),
(293, 35, 114, '2023-05-16 06:42:49', 'hi\r\n', NULL, 'influenceur', 'marque'),
(292, 1, 33, '2023-05-15 17:36:58', 'hey', NULL, 'admin', 'influenceur'),
(291, 1, 33, '2023-05-15 17:36:55', 'hello', NULL, 'admin', 'influenceur'),
(290, 1, 33, '2023-05-15 17:36:52', 'sdfvf', NULL, 'admin', 'influenceur'),
(289, 1, 33, '2023-05-15 17:36:49', 'frgvre', NULL, 'admin', 'influenceur'),
(288, 114, 32, '2023-05-15 17:33:38', 'kjgjhgjhghj', NULL, 'marque', 'influenceur'),
(287, 114, 32, '2023-05-15 17:33:20', 'hello', NULL, 'marque', 'influenceur');

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `influencer_id` int DEFAULT NULL,
  `marque_id` int DEFAULT NULL,
  `date_added` datetime DEFAULT CURRENT_TIMESTAMP,
  `duration` int DEFAULT NULL,
  `content` text,
  `price` float DEFAULT NULL,
  `sender` text,
  PRIMARY KEY (`id`),
  KEY `influencer_id` (`influencer_id`),
  KEY `marque_id` (`marque_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id`, `influencer_id`, `marque_id`, `date_added`, `duration`, `content`, `price`, `sender`) VALUES
(19, 54, 134, '2023-05-18 12:13:48', 20, 'hi', 20, 'influenceur'),
(16, 50, 142, '2023-05-16 19:36:18', 31, 'for sharing stories using instagram', 31, 'influenceur'),
(13, 35, 114, '2023-05-16 16:07:17', 255, 'test', 54, 'marque'),
(20, 54, 151, '2023-05-18 12:16:34', 458, 'hello', 458, 'marque');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
