-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 23 nov. 2024 à 15:04
-- Version du serveur : 11.5.2-MariaDB-ubu2404
-- Version de PHP : 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `game_horizon`
--

-- --------------------------------------------------------

--
-- Structure de la table `adapter`
--

CREATE TABLE `adapter` (
  `id_jeu` int(11) NOT NULL,
  `id_controlleurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `adapter`
--

INSERT INTO `adapter` (`id_jeu`, `id_controlleurs`) VALUES
(32, 1),
(34, 2),
(34, 3);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `login` varchar(50) NOT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`login`, `password`) VALUES
('admin', '*3A06800F08E81E5076F75BE591641EBA964F34C3');

-- --------------------------------------------------------

--
-- Structure de la table `bannis`
--

CREATE TABLE `bannis` (
  `id_bannis` int(11) NOT NULL,
  `date_debutBan` datetime DEFAULT NULL,
  `date_finBan` datetime DEFAULT NULL,
  `ban_perma` tinyint(1) DEFAULT NULL,
  `raison_ban` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `libelle_categorie` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `libelle_categorie`) VALUES
(1, 'MMO'),
(2, 'RTS'),
(3, 'Combat'),
(4, 'Simulation'),
(5, 'MMORPG'),
(6, 'MOBA'),
(7, 'Battle Royale'),
(8, 'Action'),
(9, 'Aventure'),
(10, 'Réflexion'),
(11, 'Survival Horror'),
(12, 'Rogue Like'),
(13, 'Party Games'),
(14, 'RPG'),
(15, 'Open World');

-- --------------------------------------------------------

--
-- Structure de la table `categoriser_type`
--

CREATE TABLE `categoriser_type` (
  `id_jeu` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `categoriser_type`
--

INSERT INTO `categoriser_type` (`id_jeu`, `id_type`) VALUES
(17, 1),
(21, 1),
(27, 1),
(31, 1),
(19, 2),
(29, 2),
(21, 3),
(31, 3),
(19, 4),
(29, 4);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_transaction` int(11) NOT NULL,
  `date_heure_transaction` datetime DEFAULT current_timestamp(),
  `total_transaction` decimal(10,2) NOT NULL,
  `etat_transaction` varchar(50) DEFAULT NULL,
  `id_editeur` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `moyen_paiement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_transaction`, `date_heure_transaction`, `total_transaction`, `etat_transaction`, `id_editeur`, `id_utilisateur`, `moyen_paiement`) VALUES
(1, '2024-01-15 14:30:00', 89.98, 'Terminée', 1, 1, ''),
(2, '2024-01-20 16:45:00', 69.99, 'Terminée', 4, 2, ''),
(3, '2024-02-01 10:15:00', 49.99, 'Terminée', 8, 3, ''),
(4, '2024-02-05 20:30:00', 39.99, 'Terminée', 12, 1, ''),
(5, '2024-02-10 11:20:00', 79.74, 'Terminée', 1, 4, ''),
(6, '2024-02-15 15:00:00', 29.99, 'Terminée', 13, 2, ''),
(7, '2024-02-20 09:45:00', 39.99, 'Terminée', 16, 3, ''),
(8, '2024-03-01 13:25:00', 24.74, 'Terminée', 14, 4, ''),
(9, '2024-11-21 13:37:58', 59.99, 'Terminée', 1, 1, ''),
(10, '2024-11-21 13:37:58', 39.99, 'Terminée', 1, 2, ''),
(11, '2024-11-21 13:37:58', 29.99, 'Terminée', 2, 3, ''),
(12, '2024-11-16 13:37:58', 69.99, 'Terminée', 3, 4, ''),
(13, '2024-11-11 13:37:58', 49.99, 'Terminée', 4, 5, ''),
(14, '2024-11-06 13:37:58', 59.99, 'Terminée', 1, 1, ''),
(15, '2024-11-01 13:37:58', 39.99, 'Terminée', 1, 2, ''),
(16, '2024-10-21 13:37:58', 29.99, 'Terminée', 2, 3, ''),
(17, '2024-10-12 13:37:58', 69.99, 'Terminée', 3, 4, ''),
(18, '2024-10-07 13:37:58', 49.99, 'Terminée', 4, 5, ''),
(19, '2024-11-22 23:50:16', 35.00, NULL, NULL, 11, 'Cb'),
(20, '2024-11-22 23:51:25', 35.00, NULL, NULL, 11, 'Cb'),
(21, '2024-11-22 23:51:58', 35.00, NULL, NULL, 11, 'Cb'),
(22, '2024-11-22 23:52:42', 69.99, NULL, NULL, 11, 'Cb'),
(23, '2024-11-23 00:06:44', 29.99, NULL, NULL, 11, 'Cb'),
(24, '2024-11-23 00:14:11', 9.99, NULL, NULL, 11, 'Cb'),
(25, '2024-11-23 01:33:40', 29.99, 'Terminée', NULL, 11, 'Cb'),
(26, '2024-11-23 15:00:01', 49.99, 'Terminée', NULL, 11, 'Cb');

-- --------------------------------------------------------

--
-- Structure de la table `concerner_editeur`
--

CREATE TABLE `concerner_editeur` (
  `id_editeur` int(11) NOT NULL,
  `id_bannis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `concerner_user`
--

CREATE TABLE `concerner_user` (
  `id_utilisateur` int(11) NOT NULL,
  `id_bannis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `id_jeu` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `prix` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`id_jeu`, `id_transaction`, `prix`) VALUES
(1, 1, 59.99),
(1, 5, 59.99),
(2, 3, 49.99),
(2, 26, 49.99),
(3, 22, 69.99),
(4, 4, 39.99),
(5, 2, 69.99),
(5, 20, 35.00),
(5, 21, 35.00),
(6, 6, 29.99),
(6, 25, 29.99),
(7, 1, 29.99),
(7, 23, 29.99),
(8, 5, 9.75),
(8, 8, 9.99),
(8, 24, 9.99),
(10, 7, 39.99),
(11, 8, 14.75),
(14, 1, 29.99),
(14, 9, 29.99),
(14, 12, 29.99);

-- --------------------------------------------------------

--
-- Structure de la table `contenir_dlc`
--

CREATE TABLE `contenir_dlc` (
  `id_dlc` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `controlleur`
--

CREATE TABLE `controlleur` (
  `id_controlleurs` int(11) NOT NULL,
  `libelle_controlleur` varchar(90) DEFAULT NULL,
  `chemin_img_controlleur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `controlleur`
--

INSERT INTO `controlleur` (`id_controlleurs`, `libelle_controlleur`, `chemin_img_controlleur`) VALUES
(1, 'Manette Xbox', NULL),
(2, 'Clavier + souris', NULL),
(3, 'Manette PS4', NULL),
(4, 'Manette Ps5', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `dlc`
--

CREATE TABLE `dlc` (
  `id_dlc` int(11) NOT NULL,
  `nom_dlc` varchar(255) DEFAULT NULL,
  `prix_dlc` decimal(8,2) DEFAULT NULL,
  `resume_dlc` text DEFAULT NULL,
  `date_sortie_dlc` date DEFAULT NULL,
  `validation` tinyint(1) DEFAULT NULL,
  `mise_en_ligne` tinyint(1) DEFAULT NULL,
  `date_miseEnLigne` datetime DEFAULT NULL,
  `image_banniere_dlc` varchar(100) DEFAULT NULL,
  `image_card_dlc` varchar(100) DEFAULT NULL,
  `id_jeu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
  `id_editeur` int(11) NOT NULL,
  `nom_societe` varchar(180) DEFAULT NULL,
  `login_editeur` varchar(80) DEFAULT NULL,
  `password_editeur` varchar(255) DEFAULT NULL,
  `siret` varchar(50) DEFAULT NULL,
  `mail_editeur` varchar(180) DEFAULT NULL,
  `adresse_editeur` varchar(200) DEFAULT NULL,
  `chemin_img_editeur` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `editeur`
--

INSERT INTO `editeur` (`id_editeur`, `nom_societe`, `login_editeur`, `password_editeur`, `siret`, `mail_editeur`, `adresse_editeur`, `chemin_img_editeur`) VALUES
(1, 'CD Projekt RED ', 'cd_red', '$argon2id$v=19$m=16,t=2,p=1$YWdtbjlDbExzUUo4YjFjcA$PjojPgFqtqt+7wEq/P1awA', '892 159 328 00012', 'cd-red@business.com', '74 rue JAGIELLONSKA 03-301 VARSOVIE POLOGNE', '/img/editeurs/cdpro.png'),
(2, 'Electonic Arts (EA) ', '', '', '985 159 490 00012', 'electronic-arts@business.com', '71 LE CLOSET 50290 LONGUEVILLE NORMANDIE', '/img/editeurs/EA.png'),
(3, 'Ubisoft ', '', '', '335 186 094 00074', 'ubisoft@business.com', '2 RUE DU CHENE HELEUC 56910 CARENTOIR FRANCE', '/img/editeurs/ubisoft.png'),
(4, 'Activision Blizzard ', '', '', '400 299 566 00085', 'activision-blizzard@business.com', '20-22 20 RUE MARIUS AUFAN 92300 LEVALLOIS-PERRET', '/img/editeurs/Activision_Blizzard.png'),
(5, 'Sony Interactive Entertainment ', '', '', '399 930 593 00039', 'sony-interactive@business.com', '112 AVENUE DE WAGRAM 75017 PARIS', '/img/editeurs/sony.png'),
(6, 'Square Enix ', '', '', '334 213 113 00064', 'square-enix@business.com', '164 RUE VICTOR HUGO, 92300 LEVALLOIS-PERRET', '/img/editeurs/squareEnix.png'),
(7, 'Bandai Namco Entertainment ', '', '', '347 543 704 00089', 'bandai-namco@business.com', 'CS 90618 15 RUE FELIX MANGINI 69009 LYON', '/img/editeurs/bandai.png'),
(8, 'Bethesda Softworks ', '', '', '527 654 586 00025', 'bethesda-softworks@business.com', '1 RUE DU DEPART 75014 PARIS', '/img/editeurs/bethesda.png'),
(9, 'Capcom ', '', '', '508 508 660 00026', 'capcom@business.com', 'C/O SERV CONSEIL VESUBIEN-EUROPE B 29 RUE PASTORELLI 06000 NICE', '/img/editeurs/capcom.png'),
(10, 'SEGA ', '', '', '794 361 436 00015', 'sega@business.com', 'CENTRE COMMERCIAL LA PETITE ARCHE 31 AVENUE GUSTAVE EIFFEL 37100 TOURS', '/img/editeurs/sega.png'),
(11, 'Rockstar Games ', '', '', '353 523 780 00032', 'rockstar-games@business.com', '3 AV MIREILLE QRT BON SEC 13014 MARSEILLE', '/img/editeurs/rockstar.png'),
(12, 'Xbox Games Studios ', '', '', '327 733 184 00516', 'xbox-games@business.com', '37/45 37 QUAI DU PRESIDENT ROOSEVELT 92130 ISSY-LES-MOULINEAUX', '/img/editeurs/xbox.png'),
(13, 'Respawn Entertainment ', '', '', '808 391 452 00022 ', 'respawn-entertainment@business.com', '2 RUE DU LAMPADEN, 57800 COCHEREN', '/img/utilisateurs/user.png'),
(14, 'Toby Fox', '', '', '432 354 789 00043', 'toby-fox@business.com', '71 LE CLOSET 50290 LONGUEVILLE NORMANDIE', '/img/utilisateurs/user.png'),
(15, 'Nicalis, Inc.', '', '', '834 052 683 00064', 'nicalis-inc@business.com', '74 rue JAGIELLONSKA 03-301 VARSOVIE POLOGNE', '/img/utilisateurs/user.png'),
(16, 'Arrowhead Game Studios', '', '', '831 343 199 00020', 'arrowhead-g@business.com', '2 RUE DU CHENE HELEUC 56910 CARENTOIR FRANCE', '/img/utilisateurs/user.png'),
(17, 'Zeekerss', '', '', '332 343 117 00020', 'zeekers@business.com', '164 RUE VICTOR HUGO, 92300 LEVALLOIS-PERRET', '/img/utilisateurs/user.png'),
(18, 'test', 'test', '$argon2id$v=19$m=65536,t=4,p=1$LjdDV3dzNG5BbGcuS1pJRw$/C2CNKrYL8hg5Z/XkY3hw7Vl1xh3tqCUE52mGPldvwY', '662672', 'test@mail.fr', 'test', '/img/utilisateurs/user.png'),
(20, 'CD Projekt', 'cdpr', 'password123', '12345678901234', 'contact@cdpr.com', 'Pologne', NULL),
(21, 'Mojang', 'mojang', 'password123', '23456789012345', 'contact@mojang.com', 'Suède', NULL),
(22, 'EA Games', 'ea', 'password123', '34567890123456', 'contact@ea.com', 'USA', NULL),
(23, 'Rockstar', 'rockstar', 'password123', '45678901234567', 'contact@rockstar.com', 'USA', NULL),
(24, 'test', 'test', '$argon2id$v=19$m=65536,t=4,p=1$aS52RFhDa2JuTmFrc1pUcw$RAyDgQ9nywzoxwX0+nW/pc2DJ1K8F7/NlZK0kyWTzgw', '51554', 'test@mail.fr', 'dgfrg', '/img/utilisateurs/user.png'),
(25, 'societeteste', 'test2', '$argon2id$v=19$m=65536,t=4,p=1$dWtRSUx4Yi5PeGp3WWlVLg$tPxG7KZpdugn4/rp/fzwC/19W5Eldma0/mUVQdm2a1s', '154545', 'qfsdfesd@fdfze.fr', 'fjenf', '/img/utilisateurs/user.png');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `libelle_genre` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `libelle_genre`) VALUES
(1, 'Science-fiction'),
(2, 'Post-apocalyptique'),
(3, 'Cyberpunk'),
(4, 'Steampunk'),
(5, 'Héroique Fantaisie'),
(6, 'Western'),
(7, 'Horreur'),
(8, 'Mythologie'),
(9, 'Piraterie'),
(10, 'Médiéval'),
(11, 'Anime');

-- --------------------------------------------------------

--
-- Structure de la table `jeu`
--

CREATE TABLE `jeu` (
  `id_jeu` int(11) NOT NULL,
  `nom_jeu` varchar(255) DEFAULT NULL,
  `prix` decimal(8,2) DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `type_jeu` text DEFAULT NULL,
  `id_jeu_parent` int(11) DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `validation` tinyint(1) DEFAULT NULL,
  `gif` varchar(100) DEFAULT NULL,
  `image_card` varchar(100) DEFAULT NULL,
  `image_banniere` varchar(100) DEFAULT NULL,
  `mise_en_ligne` tinyint(1) DEFAULT NULL,
  `date_miseEnLigne` datetime DEFAULT NULL,
  `id_editeur` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `jeu`
--

INSERT INTO `jeu` (`id_jeu`, `nom_jeu`, `prix`, `resume`, `type_jeu`, `id_jeu_parent`, `date_sortie`, `validation`, `gif`, `image_card`, `image_banniere`, `mise_en_ligne`, `date_miseEnLigne`, `id_editeur`, `id_genre`, `id_categorie`) VALUES
(1, 'Cyberpunk 2077', 59.99, 'Cyberpunk 2077 est un RPG d\\\'action-aventure en monde ouvert qui se déroule dans la mégalopole de Night City, où vous incarnez un cyber-mercenaire qui livre un combat sans merci pour sa survie. Avec des améliorations et du contenu additionnel gratuit, personnalisez entièrement votre personnage et votre style de jeu en accomplissant des boulots, améliorez votre réputation et déverrouillez des améliorations. Les relations que vous nouerez et les choix que vous ferez auront un impact sur l\\\'histoire et le monde qui vous entoure. C\\\'est ici que se forgent les légendes. Quelle sera la vôtre ?<br>\\r\\n<br>\\r\\nCRÉEZ VOTRE PROPRE CYBERPUNK\\r\\nDevenez un hors-la-loi urbain équipé d\\\'améliorations cybernétiques et forgez votre légende dans les rues de Night City. <br>\\r\\n<br>\\r\\nEXPLOREZ LA VILLE DU FUTUR\\r\\nNight City regorge de choses à faire, d\\\'endroits à voir et de gens à rencontrer. Et vous êtes libre d\\\'aller où vous voulez, quand vous voulez, comme vous voulez.<br>\\r\\n<br>\\r\\nFORGEZ VOTRE LÉGENDE\\r\\nLancez-vous dans des aventures risquées et nouez des relations avec des personnages inoubliables dont le sort dépendra de vos choix.<br>\\r\\n<br>\\r\\nPROFITEZ DES AMÉLIORATIONS\\r\\nRedécouvrez Cyberpunk 2077 avec de nombreux changements et améliorations apportés au gameplay, à l\\\'économie, à l\\\'ergonomie de la carte et bien plus.<br>\\r\\n<br>\\r\\nOBTENEZ DES OBJETS EXCLUSIFS\\r\\nObtenez des cadeaux en jeu et des goodies numériques inspirés des jeux CD PROJEKT RED dans le cadre du programme Mes Récompenses.\\r\\n', NULL, NULL, '2025-12-11', 1, 'cyberpunk_gif.gif', 'cyberpunk-img.jpg', 'cyberpunk-dark2.jpg', 1, '2019-12-10 00:00:00', 1, 3, 7),
(2, 'The Elder Scrolls V: Skyrim', 49.99, 'Lauréat de plus de 200 récompenses du Jeu de l\\\'année, The Elder Scrolls V: Skyrim Special Edition donne vie jusque dans ses moindres  détails à un univers de fantasy épique. La Special Edition contient le jeu et ses extensions acclamés par la critique ainsi que de nouvelles fonctionnalités : textures et effets remasterisés, rayons lumineux volumétriques, profondeur de champ dynamique, reflets et bien plus.<br>\\n<br>\\nSkyrim Special Edition apporte également la puissance des créations de Bethesda Game Studios sur PC et consoles. De nouveaux environnements, quêtes, personnages, dialogues, armures, armes et bien plus : avec les créations, votre expérience de jeu n\\\'a plus de limites.', NULL, NULL, '2011-11-11', 1, 'skygif.gif', 'skyrim-img.jpg', 'skyrim-dark.jpg', 1, '2010-11-11 00:00:00', 8, 10, 5),
(3, 'Dragon Ball: Sparking! Zero', 69.99, 'DRAGON BALL: Sparking! ZERO reprend le gameplay effréné de la série Budokai Tenkaichi et l\\\'emmène vers des sommets inégalés. Devenez un super guerrier et faites l\\\'expérience de la surpuissance brisant toutes les limites des combats Dragon Ball, capables de faire trembler la terre entière ! <br>\\r\\n<br>\\r\\nDéchaînez la puissance de plus de 180 guerriers venus de Dragon Ball Z, Dragon Ball Super, Dragon Ball GT et de certains films Dragon Ball, tous disponibles dans le jeu de base ! Chaque personnage vient avec ses propres capacités, transformations et techniques emblématiques. <br>\\r\\n<br>\\r\\nIncarnez la force de destruction des plus puissants guerriers jamais apparus dans l\\\'univers Dragon Ball ! <br>\\r\\n<br>\\r\\nLancez-vous dans de féroces batailles 3D au rythme effréné qui restent fidèles à l\\\'anime et à la série de jeux vidéo, avec des graphismes à couper le souffle et des techniques de combat authentiques telles que des chocs de rayons, enchaînements d\\\'attaques, des déplacements plus rapides que la lumière et même des attaques ultimes capables de raser des planètes entières.<br>\\r\\n<br>\\r\\nDéfiez d\\\'autres joueurs en ligne pour tester votre niveau, ou jouez sur le canapé hors ligne avec des amis pour affûter vos talents exclusivement dans la Salle de l\\\'esprit et du temps ! Combattez selon votre propre style pour devenir champion à travers divers modes tournoi et selon différentes conditions de victoire.', NULL, NULL, '2024-10-11', 1, 'DBSZ_gif.gif', 'DBSZ-img.jpg', 'DBSZ-dark.jpg', 1, '2024-11-23 00:00:00', 7, 1, 3),
(4, 'Halo: The Master Chief Collection', 39.99, 'La saga qui a révolutionné les jeux sur console débarque sur PC avec 6 titres incontournables réunis au sein d\\\'une expérience épique.<br>\\r\\n<br>\\r\\nParamètres/optimisations PC : Halo : La collection le Major est maintenant optimisé pour PC et affiche des graphismes somptueux jusqu\\\'en 4K UHD à au moins 60 images/seconde.* Profitez également des commandes personnalisables à la souris et au clavier, de l\\\'affichage ultra large, du champ de vision réglable et bien plus encore.<br>\\r\\n<br>\\r\\nCampagne : avec Halo: Reach, Halo: Combat Evolved Anniversary, Halo 2: Anniversary, Halo 3, la campagne Halo 3: ODST et Halo 4, La collection le Major vous invite à tracer votre propre voie à travers la saga Halo. Démarrant avec la bravoure exceptionnelle de Noble Six dans Halo: Reach et culminant avec l\\\'émergence d\\\'un nouvel ennemi dans Halo 4, la saga du Major totalise 67 missions de campagne réparties sur 6 titres salués par la critique.<br>\\r\\n<br>\\r\\nMultijoueur : chaque titre intégré à la collection comprend également des cartes, modes et types de parties qui lui sont propres. Avec plus de 120 cartes multijoueur, et le riche contenu Forge créé par la communauté permettant des parties sans cesse renouvelées, La collection le Major offre l\\\'expérience Halo la plus variée et la plus étendue jamais proposée.<br>\\r\\n<br>\\r\\nForge : le célèbre éditeur de cartes de Halo revient plus phénoménal que jamais. Créez de nouvelles cartes grâce à des fonctionnalités novatrices, un plus gros budget et des objets inédits, afin de proposer de nouvelles façons de jouer avec des modes de jeu personnalisés\\r\\n', NULL, NULL, '2019-12-03', 1, 'Halo-gif.gif', 'Halo_MCC-img.jpg', 'Halo_MCC-dark.jpg', 1, '2018-12-03 00:00:00', 12, 1, 8),
(5, 'Call Of Duty Black Ops 6', 69.99, 'Développé par Treyarch et Raven, Black Ops 6 est un jeu d\\\'action et d\\\'espionnage qui se déroule au début des années 90, une période de transition et de bouleversements sur la scène politique mondiale, caractérisée par la fin de la guerre froide et l\\\'émergence des États-Unis en tant que superpuissance. Avec son intrigue captivante et sa liberté d\\\'action, il s\\\'agit là d\\\'un Black Ops digne du nom.<br>\\n<br>\\nLa campagne de Black Ops 6 vous offre une expérience de jeu dynamique à chaque instant, avec des espaces de jeu variés, des décors spectaculaires et des scènes d\\\'action intenses, des casses aux enjeux considérables et des missions d\\\'espionnage.<br>\\n<br>\\nVivez une expérience Multijoueur exceptionnelle et testez vos compétences sur 16 nouvelles cartes disponibles dès le lancement du jeu, dont 12 cartes 6v6 et 4 cartes Strike jouables en 2v2 ou en 6v6.<br>\\n<br>\\nBlack Ops 6 marque également le retour épique du très populaire Zombies par manche, un mode dans lequel les joueurs affronteront des hordes de morts-vivants sur deux cartes inédites et ce, dès le lancement du jeu. Par la suite, des cartes encore plus spectaculaires et des expériences inédites seront proposées aux joueurs dans les modes Multijoueur et Zombies.', NULL, NULL, '2024-10-25', 1, 'BO6-gif.gif', 'BO6-img.jpg', 'BO6-dark.jpg', 1, '2024-11-23 00:00:00', 4, 1, 8),
(6, 'Titanfall 2', 29.99, 'Profitez de l\\\'édition Ultime de Titanfall™ 2 pour plonger au coeur de l\\\'un des FPS les plus novateurs de 2016 ! Retrouvez tout le contenu de l\\\'édition Deluxe Digitale et obtenez le Pack de démarrage, vous offrant un accès instantané à toutes les classes de Titans et de pilotes ainsi qu\\\'à des fonds, des jetons XP double et une peinture de guerre pour la carabine R-201 afin de combattre avec style à la Frontière. L\\\'édition Ultime comprend le jeu de base Titanfall™ 2, tout le contenu de l\\\'édition Deluxe (Titans Scorch Prime et Ion Prime, peinture de guerre édition Deluxe pour les 6 Titans, camouflage édition Deluxe pour tous les Titans, pilotes et armes, personnalisations de cockpit Deluxe pour les 6 Titans, emblème édition Deluxe) et le Pack de démarrage (accès instantané à tous les Titans et à toutes les capacités tactiques de pilote, 500 jetons pour débloquer des équipements, des optimisations cosmétiques et du matériel, 10 jetons XP double et la peinture de guerre Souterrain pour la carabine R-201).', NULL, NULL, '2016-10-28', 1, 'titan_2.gif', 'titan-img.jpg', 'titan-dark2.jpg', 1, '2015-10-28 00:00:00', 13, 1, 8),
(7, 'Grand Theft Auto 5', 29.99, 'Lorsqu\\\'un jeune arnaqueur, un braqueur de banque à la retraite et un terrifiant psychopathe se retrouvent piégés par de grands criminels, le gouvernement américain et l\\\'industrie du divertissement, ils décident de se lancer dans une série de braquages pour survivre dans une ville sans pitié, où ils ne peuvent se fier à personne, même entre eux. <br>\\r\\n<br>\\r\\nGrand Theft Auto V sur PC offre aux joueurs la possibilité d\\\'explorer le monde de Los Santos et Blaine County en haute résolution (jusqu\\\'à 4K) et à 60 images par seconde.<br>\\r\\n<br>\\r\\nLe jeu propose également tout un panel d\\\'options de personnalisation spécifiques au PC, incluant 25 paramètres distincts de qualité de texture, d\\\'ombres, de pavage, d\\\'anticrénelage et d\\\'autres, ainsi que la possibilité de personnaliser intégralement les commandes de la souris et du clavier. Les options permettent également de contrôler la densité du trafic, pour les piétons et les automobilistes, d\\\'utiliser jusqu\\\'à trois écrans, de jouer en 3D, et incluent un système plug-and-play pour vos manettes. <br>\\r\\n<br>\\r\\nGrand Theft Auto V sur PC contient également Grand Theft Auto Online, avec des parties pouvant accueillir jusqu\\\'à 30 joueurs et deux spectateurs. Toutes les améliorations existantes de gameplay et le contenu créé par Rockstar depuis le lancement de Grand Theft Auto Online seront également disponibles, y compris les Braquages et les modes Rivalité.<br>\\r\\n<br>\\r\\nLes versions PC de Grand Theft Auto V et Grand Theft Auto Online incluent le mode à la première personne, qui permet aux joueurs d\\\'explorer l\\\'extraordinaire monde de Los Santos d\\\'un tout nouveau point de vue.', NULL, NULL, '2013-09-17', 1, 'GTA5-gif.gif', 'GTA5-img.jpg', 'GTA5-dark2.jpg', 1, '2012-09-17 00:00:00', 11, 1, 8),
(8, 'Undertale', 9.99, 'UNDERTALE! The RPG game where you don\'t have to destroy anyone.<br><br> Welcome to UNDERTALE. In this RPG, you control a human who falls underground into the <br> world of monsters. Now you must find your way out... or stay trapped forever. <br><br> ((Healthy Dog\'s Warning: Game contains imagery that may be harmful to players with <br> photosensitive epilepsy or similar condition.)) <br><br>features: <br> <br> Killing is unnecessary: negotiate out of danger using the unique battle system.<br>Time your attacks for extra damage, then dodge enemy attacks in a style reminiscent of <br> top-down shooters. <br> Original art and soundtrack brimming with personality. <br> Soulful, character-rich story with an emphasis on humor. <br> Created mostly by one person. <br> Become friends with all of the bosses! <br> At least 5 dogs. <br> You can date a skeleton. <br> Hmmm... now there are 6 dogs...? <br> Maybe you won\'t want to date the skeleton. <br> I thought I found a 7th dog, but it was actually just the 3rd dog. <br> If you play this game, can you count the dogs for me...? I\'m not good at it. ', NULL, NULL, '2015-09-15', 1, 'undertale-gif.gif', 'undertale-img.jpg', 'undertale-bkg.webp', 1, '2014-09-15 00:00:00', 14, 5, 14),
(9, 'The Binding of Isaac: Rebirth', 14.99, 'When Isaac’s mother starts hearing the voice of God demanding a sacrifice be made to prove <br> her faith, Isaac escapes into the basement facing droves of deranged enemies, lost brothers <br> and sisters, his fears, and eventually his mother. <br><br> Gameplay <br>The Binding of Isaac is a randomly generated action RPG shooter with heavy Rogue-like <br> elements. Following Isaac on his journey players will find bizarre treasures that change Isaac’s <br> form giving him super human abilities and enabling him to fight off droves of mysterious <br> creatures, discover secrets and fight his way to safety. <br><br> About the Binding Of Isaac: Rebirth <br> The Binding of Isaac: Rebirth is the ultimate of remakes with an all-new highly efficient game <br> engine (expect 60fps on most PCs), all-new hand-drawn pixel style artwork, highly polished <br> visual effects, all-new soundtrack and audio by the the sexy Ridiculon duo Matthias Bossi + <br> Jon Evans. Oh yeah, and hundreds upon hundreds of designs, redesigns and re-tuned <br> enhancements by series creator, Edmund McMillen. Did we mention the poop?', NULL, NULL, '2014-11-04', 1, 'isaac-gif.gif', 'isaac-card.jpg', 'isaac-bkg.jpg', 1, '2013-11-04 00:00:00', 15, 1, 12),
(10, 'Helldivers 2', 39.99, 'The Galaxy’s Last Line of Offence.<br> Enlist in the Helldivers and join the fight for freedom across a hostile galaxy in a fast, frantic,<br>and ferocious third-person shooter.<br><br> URGENT BROADCAST – SUPER EARTH ARMED FORCES <br> Freedom. Peace. Democracy. <br> Your Super Earth-born rights. The key pillars of our civilization.<br> Of our very existence. <br> But the war rages on. And everything is once again under threat.<br> Join the greatest military force the galaxy has ever seen and make this a safe and free place <br> to live. <br><br> BECOME A LEGEND <br> You will be assembled into squads of up to four Helldivers and assigned strategic missions.<br> Watch each other’s back – friendly fire is an unfortunate certainty of war, but victory without <br> teamwork is impossible.', NULL, NULL, '2024-02-08', 0, 'hell-gif.gif', 'hell-card.jpg', 'hell-card-card.jpg', 1, '2024-11-23 00:00:00', 16, 1, 8),
(11, 'Lethal Company', 9.75, '> OBJECTIVES <br><br> You are a contracted worker for the Company. Your job is to collect scrap from abandoned, <br> industrialized moons to meet the Company\'s profit quota. You can use the cash you earn to <br> travel to new moons with higher risks and rewards--or you can buy fancy suits and <br> decorations for your ship. Experience nature, scanning any creature you find to add them to <br> your bestiary. Explore the wondrous outdoors and rummage through their derelict, steel and <br> concrete underbellies. Just never miss the quota. <br><br> > DON’T GO ALONE <br> These dangers prey upon the vulnerable and lonesome, and the protection of your crew may <br> be your only hope. You can guide your crewmates from your ship, using the radar to call out <br> traps and using the ship\'s terminal to access remotely locked doors--or you can all go in <br> together. The Company store has many useful tools for the job, including lights, shovels, <br> walkie talkies, stun grenades, or boomboxes. <br><br> > WORK FAST <br> Things get dangerous at night. Communicate with your crewmates to carry all valuables to <br> the ship before things get too dangerous, and try not to leave anyone behind.', NULL, NULL, '2024-10-23', 1, 'lethal-gif.gif', 'lethal-card.jpg', 'lethal-bkg.png', 1, '2023-10-23 00:00:00', 17, 7, 11),
(14, 'Minecraft', 29.99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-23 15:50:09', 2, 2, 15),
(16, 'GTA V', 49.99, 'ghjt', NULL, NULL, '2024-11-21', NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, 15),
(17, 'Stellar Odyssey', 49.99, 'Explorez une galaxie mystérieuse dans ce RPG spatial épique. Découvrez des civilisations perdues et forgez votre destin parmi les étoiles.', NULL, NULL, '2024-12-15', 0, NULL, NULL, NULL, 1, NULL, 3, 1, 9),
(18, 'Chronosphere', 39.99, 'Un jeu de plateforme innovant où vous manipulez le temps pour résoudre des énigmes complexes dans un monde steampunk.', NULL, NULL, '2024-11-30', 0, NULL, NULL, NULL, 1, NULL, 2, 3, 10),
(19, 'Mythic Legends', 59.99, 'Un MMORPG fantastique où les joueurs incarnent des héros légendaires dans leur quête pour sauver le royaume des forces obscures.', NULL, NULL, '2024-12-20', 0, NULL, NULL, NULL, 1, NULL, 4, 2, 5),
(20, 'Cyber Revolution', 54.99, 'Plongez dans un monde cyberpunk où les choix que vous faites influencent directement l avenir de la mégalopole Neo-Tokyo.', NULL, NULL, '2024-12-01', 0, NULL, NULL, NULL, 1, NULL, 5, 1, 15),
(21, 'Forest Keeper', 29.99, 'Un jeu de survie écologique où vous devez protéger une forêt mystique des dangers modernes tout en découvrant ses secrets ancestraux.', NULL, NULL, '2024-11-25', 0, NULL, NULL, NULL, 1, NULL, 1, 4, 4),
(22, 'Quantum Warriors', 44.99, 'Un jeu de combat futuriste où les combattants utilisent la technologie quantique pour créer des combos spectaculaires.', NULL, NULL, '2024-12-10', 0, NULL, NULL, NULL, 1, NULL, 6, 5, 3),
(23, 'Medieval Dynasty', 49.99, 'Gérez votre propre royaume médiéval dans ce jeu de stratégie complexe mêlant politique, guerre et développement économique.', NULL, NULL, '2024-12-05', 0, NULL, NULL, NULL, 1, NULL, 7, 6, 2),
(24, 'Dungeon Masters', 34.99, 'Un roguelike captivant où chaque partie est unique grâce à la génération procédurale de donjons et un système de progression innovant.', NULL, NULL, '2024-11-28', 0, NULL, NULL, NULL, 1, NULL, 8, 7, 12),
(25, 'Space Pirates', 39.99, 'Un jeu d action spatial où vous dirigez un équipage de pirates dans leur quête de trésors à travers la galaxie.', NULL, NULL, '2024-12-08', 0, NULL, NULL, NULL, 1, NULL, 9, 8, 8),
(26, 'Mystic Garden', 24.99, 'Un jeu de simulation relaxant où vous cultivez des plantes magiques et interagissez avec des créatures fantastiques.', NULL, NULL, '2024-11-22', 0, NULL, NULL, NULL, 1, NULL, 10, 9, 4),
(27, 'Stellar Odyssey', 49.99, 'Explorez une galaxie mystérieuse dans ce RPG spatial épique. Découvrez des civilisations perdues et forgez votre destin parmi les étoiles.', NULL, NULL, '2024-12-15', 0, NULL, NULL, NULL, 1, NULL, 3, 1, 9),
(28, 'Chronosphere', 39.99, 'Un jeu de plateforme innovant où vous manipulez le temps pour résoudre des énigmes complexes dans un monde steampunk.', NULL, NULL, '2024-11-30', 0, NULL, NULL, NULL, 1, NULL, 2, 3, 10),
(29, 'Mythic Legends', 59.99, 'Un MMORPG fantastique où les joueurs incarnent des héros légendaires dans leur quête pour sauver le royaume des forces obscures.', NULL, NULL, '2024-12-20', 0, NULL, NULL, NULL, 1, NULL, 4, 2, 5),
(30, 'Cyber Revolution', 54.99, 'Plongez dans un monde cyberpunk où les choix que vous faites influencent directement l avenir de la mégalopole Neo-Tokyo.', NULL, NULL, '2024-12-01', 0, NULL, NULL, NULL, 1, NULL, 5, 1, 15),
(31, 'Forest Keeper', 29.99, 'Un jeu de survie écologique où vous devez protéger une forêt mystique des dangers modernes tout en découvrant ses secrets ancestraux.', NULL, NULL, '2024-11-25', 0, NULL, NULL, NULL, 1, NULL, 1, 4, 4),
(32, 'rerer', 10.00, 'ererzr', 'principal', NULL, '2024-11-23', 1, 'fc7caf7f-4be0-4dda-ae01-56c6e81ce0f0.gif', '459034126_8363429420413755_7139187233140154344_n.jpg', 'Monstres-et-Cie-la-suite-que-vous-ne-verrez-jamais.jpg', 1, '2024-11-23 00:00:00', 25, 3, 4),
(33, 'Holy sport', 10.00, 'efzefze er er', 'erer', NULL, '2024-11-23', 1, NULL, NULL, NULL, 1, '2024-11-23 15:51:14', 20, 4, 1),
(34, 'test3', 10.99, 'zerfze&#039;rfz', 'principal', NULL, '2024-11-23', 1, 'HZD_periodic_1.gif', '459034126_8363429420413755_7139187233140154344_n.jpg', 'Monstres-et-Cie-la-suite-que-vous-ne-verrez-jamais.jpg', 1, '2024-11-23 15:02:18', 25, 3, 14);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` int(11) NOT NULL,
  `chemin_media` text DEFAULT NULL,
  `id_dlc` int(11) DEFAULT NULL,
  `id_jeu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notif`
--

CREATE TABLE `notif` (
  `id_notif` int(11) NOT NULL,
  `date_heure_notif` datetime DEFAULT NULL,
  `objet` varchar(120) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `etat` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `notif`
--

INSERT INTO `notif` (`id_notif`, `date_heure_notif`, `objet`, `contenu`, `etat`) VALUES
(1, '2024-11-23 14:33:01', 'Nouveau jeu soumis', 'Un nouveau jeu nommé \'rerer\' a été soumis.', 0),
(2, '2024-11-23 15:01:48', 'Nouveau jeu soumis', 'Un nouveau jeu nommé \'test3\' a été soumis.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `posseder`
--

CREATE TABLE `posseder` (
  `id_utilisateur` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `favoris` tinyint(1) DEFAULT NULL,
  `date_acquisition` date DEFAULT NULL,
  `date_achat` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `posseder`
--

INSERT INTO `posseder` (`id_utilisateur`, `id_jeu`, `statut`, `favoris`, `date_acquisition`, `date_achat`) VALUES
(11, 2, NULL, NULL, NULL, '2024-11-23 15:00:01'),
(11, 3, NULL, NULL, NULL, '2024-11-22 23:52:42');

-- --------------------------------------------------------

--
-- Structure de la table `preferer_cate`
--

CREATE TABLE `preferer_cate` (
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `preferer_genre`
--

CREATE TABLE `preferer_genre` (
  `id_utilisateur` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `preferer_type`
--

CREATE TABLE `preferer_type` (
  `id_utilisateur` int(11) NOT NULL,
  `id_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promotion` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `reduction` decimal(5,2) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `id_jeu`, `reduction`, `date_debut`, `date_fin`) VALUES
(1, 5, 50.00, '2024-11-19', '2024-12-13'),
(2, 10, 20.00, '2024-11-19', '2024-11-30');

-- --------------------------------------------------------

--
-- Structure de la table `recevoir_admin`
--

CREATE TABLE `recevoir_admin` (
  `login` varchar(50) NOT NULL,
  `id_notif` int(11) NOT NULL,
  `date_heure_lecture_` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `recevoir_admin`
--

INSERT INTO `recevoir_admin` (`login`, `id_notif`, `date_heure_lecture_`) VALUES
('admin', 1, NULL),
('admin', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recevoir_editeur`
--

CREATE TABLE `recevoir_editeur` (
  `id_editeur` int(11) NOT NULL,
  `id_notif` int(11) NOT NULL,
  `date_heure_lecture_` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recevoir_user`
--

CREATE TABLE `recevoir_user` (
  `id_utilisateur` int(11) NOT NULL,
  `id_notif` int(11) NOT NULL,
  `date_heure_lecture_` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `remboursement`
--

CREATE TABLE `remboursement` (
  `id_remboursement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `date_demande` datetime NOT NULL DEFAULT current_timestamp(),
  `statut` enum('en_attente','accepte','refuse') NOT NULL DEFAULT 'en_attente',
  `raison` text DEFAULT NULL,
  `date_traitement` datetime DEFAULT NULL,
  `id_transaction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `remboursement`
--

INSERT INTO `remboursement` (`id_remboursement`, `id_utilisateur`, `id_jeu`, `date_demande`, `statut`, `raison`, `date_traitement`, `id_transaction`) VALUES
(1, 11, 5, '2024-11-23 01:11:21', 'accepte', 'nul', '2024-11-23 01:15:26', 21),
(2, 11, 7, '2024-11-23 01:23:49', 'accepte', 'fdfged', '2024-11-23 01:23:56', 23),
(3, 11, 8, '2024-11-23 01:25:26', 'accepte', 'efezr', '2024-11-23 01:25:39', 24),
(4, 11, 3, '2024-11-23 01:25:54', 'refuse', 'zdzde', '2024-11-23 01:26:03', 22),
(5, 11, 6, '2024-11-23 14:59:08', 'accepte', 'le jeu pue', '2024-11-23 14:59:29', 25);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `libelle_type` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `libelle_type`) VALUES
(1, 'Solo'),
(2, 'Multijoueur'),
(3, 'Coopératif'),
(4, 'En ligne'),
(5, 'Compétitif');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `pseudo_utilisateur` varchar(150) DEFAULT NULL,
  `mail` varchar(180) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `chemin_img_user` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo_utilisateur`, `mail`, `password`, `chemin_img_user`) VALUES
(1, 'jean2', 'mail@contact.fr', 'refgrg', '/img/utilisateurs/user.png'),
(2, 'JohnDoe', 'john.doe@email.com', '$argon2id$v=19$m=16,t=2,p=1$c0c5U1pJQjd6ZXlGWHVFNg$QUBZRZc0d6H6BJT/DZfj+w', NULL),
(3, 'AliceGamer', 'alice.gamer@email.com', '$argon2id$v=19$m=16,t=2,p=1$c0c5U1pJQjd6ZXlGWHVFNg$QUBZRZc0d6H6BJT/DZfj+w', NULL),
(4, 'BobPlayer', 'bob.player@email.com', '$argon2id$v=19$m=16,t=2,p=1$c0c5U1pJQjd6ZXlGWHVFNg$QUBZRZc0d6H6BJT/DZfj+w', NULL),
(5, 'EmmaGaming', 'emma.gaming@email.com', '$argon2id$v=19$m=16,t=2,p=1$c0c5U1pJQjd6ZXlGWHVFNg$QUBZRZc0d6H6BJT/DZfj+w', NULL),
(6, 'JohnDoe', 'johndoe@mail.fr', NULL, '/img/utilisateurs/user.png'),
(7, 'AliceGamer', NULL, NULL, NULL),
(8, 'BobPlayer', NULL, NULL, NULL),
(9, 'EmmaGames', NULL, NULL, NULL),
(10, 'MaxGaming', NULL, NULL, NULL),
(11, 'sully', 'sully@mail.fr', '$argon2id$v=19$m=65536,t=4,p=1$emY4S3Jpd2JwckxsYWFDMg$Oo3XSYtrRQbxPNWKu3/EG9i5+GMmACPO5gCcKazrVLc', '/img/utilisateurs/user.png'),
(12, 'sully2', 'sully2@mail.fr', '$argon2id$v=19$m=65536,t=4,p=1$ZFE1cG5QQ3YyVXpyTUt1WA$jYifyzC2nZM8HQ9n6vFigeKUiJjK4pWuyHSDBgPYZrU', '/img/utilisateurs/user.png');

-- --------------------------------------------------------

--
-- Structure de la table `utiliser`
--

CREATE TABLE `utiliser` (
  `id_utilisateur` int(11) NOT NULL,
  `id_controlleurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adapter`
--
ALTER TABLE `adapter`
  ADD PRIMARY KEY (`id_jeu`,`id_controlleurs`),
  ADD KEY `id_controlleurs` (`id_controlleurs`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `bannis`
--
ALTER TABLE `bannis`
  ADD PRIMARY KEY (`id_bannis`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `categoriser_type`
--
ALTER TABLE `categoriser_type`
  ADD PRIMARY KEY (`id_jeu`,`id_type`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_editeur` (`id_editeur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `concerner_editeur`
--
ALTER TABLE `concerner_editeur`
  ADD PRIMARY KEY (`id_editeur`,`id_bannis`),
  ADD KEY `id_bannis` (`id_bannis`);

--
-- Index pour la table `concerner_user`
--
ALTER TABLE `concerner_user`
  ADD PRIMARY KEY (`id_utilisateur`,`id_bannis`),
  ADD KEY `id_bannis` (`id_bannis`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`id_jeu`,`id_transaction`),
  ADD KEY `id_transaction` (`id_transaction`);

--
-- Index pour la table `contenir_dlc`
--
ALTER TABLE `contenir_dlc`
  ADD PRIMARY KEY (`id_dlc`,`id_transaction`),
  ADD KEY `id_transaction` (`id_transaction`);

--
-- Index pour la table `controlleur`
--
ALTER TABLE `controlleur`
  ADD PRIMARY KEY (`id_controlleurs`);

--
-- Index pour la table `dlc`
--
ALTER TABLE `dlc`
  ADD PRIMARY KEY (`id_dlc`),
  ADD KEY `id_jeu` (`id_jeu`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
  ADD PRIMARY KEY (`id_editeur`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Index pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD PRIMARY KEY (`id_jeu`),
  ADD KEY `id_editeur` (`id_editeur`),
  ADD KEY `id_genre` (`id_genre`),
  ADD KEY `id_categorie` (`id_categorie`),
  ADD KEY `fk_id_jeu_parent` (`id_jeu_parent`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `id_dlc` (`id_dlc`),
  ADD KEY `id_jeu` (`id_jeu`);

--
-- Index pour la table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Index pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD PRIMARY KEY (`id_utilisateur`,`id_jeu`),
  ADD KEY `id_jeu` (`id_jeu`);

--
-- Index pour la table `preferer_cate`
--
ALTER TABLE `preferer_cate`
  ADD PRIMARY KEY (`id_utilisateur`,`id_categorie`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `preferer_genre`
--
ALTER TABLE `preferer_genre`
  ADD PRIMARY KEY (`id_utilisateur`,`id_genre`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Index pour la table `preferer_type`
--
ALTER TABLE `preferer_type`
  ADD PRIMARY KEY (`id_utilisateur`,`id_type`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promotion`),
  ADD KEY `id_jeu` (`id_jeu`);

--
-- Index pour la table `recevoir_admin`
--
ALTER TABLE `recevoir_admin`
  ADD PRIMARY KEY (`login`,`id_notif`),
  ADD KEY `id_notif` (`id_notif`);

--
-- Index pour la table `recevoir_editeur`
--
ALTER TABLE `recevoir_editeur`
  ADD PRIMARY KEY (`id_editeur`,`id_notif`),
  ADD KEY `id_notif` (`id_notif`);

--
-- Index pour la table `recevoir_user`
--
ALTER TABLE `recevoir_user`
  ADD PRIMARY KEY (`id_utilisateur`,`id_notif`),
  ADD KEY `id_notif` (`id_notif`);

--
-- Index pour la table `remboursement`
--
ALTER TABLE `remboursement`
  ADD PRIMARY KEY (`id_remboursement`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_jeu` (`id_jeu`),
  ADD KEY `id_transaction` (`id_transaction`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD PRIMARY KEY (`id_utilisateur`,`id_controlleurs`),
  ADD KEY `id_controlleurs` (`id_controlleurs`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bannis`
--
ALTER TABLE `bannis`
  MODIFY `id_bannis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `controlleur`
--
ALTER TABLE `controlleur`
  MODIFY `id_controlleurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `dlc`
--
ALTER TABLE `dlc`
  MODIFY `id_dlc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
  MODIFY `id_editeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `jeu`
--
ALTER TABLE `jeu`
  MODIFY `id_jeu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notif`
--
ALTER TABLE `notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id_promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `remboursement`
--
ALTER TABLE `remboursement`
  MODIFY `id_remboursement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adapter`
--
ALTER TABLE `adapter`
  ADD CONSTRAINT `adapter_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`),
  ADD CONSTRAINT `adapter_ibfk_2` FOREIGN KEY (`id_controlleurs`) REFERENCES `controlleur` (`id_controlleurs`);

--
-- Contraintes pour la table `categoriser_type`
--
ALTER TABLE `categoriser_type`
  ADD CONSTRAINT `categoriser_type_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`),
  ADD CONSTRAINT `categoriser_type_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_editeur`) REFERENCES `editeur` (`id_editeur`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Contraintes pour la table `concerner_editeur`
--
ALTER TABLE `concerner_editeur`
  ADD CONSTRAINT `concerner_editeur_ibfk_1` FOREIGN KEY (`id_editeur`) REFERENCES `editeur` (`id_editeur`),
  ADD CONSTRAINT `concerner_editeur_ibfk_2` FOREIGN KEY (`id_bannis`) REFERENCES `bannis` (`id_bannis`);

--
-- Contraintes pour la table `concerner_user`
--
ALTER TABLE `concerner_user`
  ADD CONSTRAINT `concerner_user_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `concerner_user_ibfk_2` FOREIGN KEY (`id_bannis`) REFERENCES `bannis` (`id_bannis`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`),
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`id_transaction`) REFERENCES `commande` (`id_transaction`);

--
-- Contraintes pour la table `contenir_dlc`
--
ALTER TABLE `contenir_dlc`
  ADD CONSTRAINT `contenir_dlc_ibfk_1` FOREIGN KEY (`id_dlc`) REFERENCES `dlc` (`id_dlc`),
  ADD CONSTRAINT `contenir_dlc_ibfk_2` FOREIGN KEY (`id_transaction`) REFERENCES `commande` (`id_transaction`);

--
-- Contraintes pour la table `dlc`
--
ALTER TABLE `dlc`
  ADD CONSTRAINT `dlc_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`);

--
-- Contraintes pour la table `jeu`
--
ALTER TABLE `jeu`
  ADD CONSTRAINT `fk_id_jeu_parent` FOREIGN KEY (`id_jeu_parent`) REFERENCES `jeu` (`id_jeu`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `jeu_ibfk_1` FOREIGN KEY (`id_editeur`) REFERENCES `editeur` (`id_editeur`),
  ADD CONSTRAINT `jeu_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`),
  ADD CONSTRAINT `jeu_ibfk_3` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`id_dlc`) REFERENCES `dlc` (`id_dlc`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`);

--
-- Contraintes pour la table `posseder`
--
ALTER TABLE `posseder`
  ADD CONSTRAINT `posseder_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `posseder_ibfk_2` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`);

--
-- Contraintes pour la table `preferer_cate`
--
ALTER TABLE `preferer_cate`
  ADD CONSTRAINT `preferer_cate_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `preferer_cate_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);

--
-- Contraintes pour la table `preferer_genre`
--
ALTER TABLE `preferer_genre`
  ADD CONSTRAINT `preferer_genre_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `preferer_genre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`);

--
-- Contraintes pour la table `preferer_type`
--
ALTER TABLE `preferer_type`
  ADD CONSTRAINT `preferer_type_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `preferer_type_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);

--
-- Contraintes pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `promotion_ibfk_1` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`);

--
-- Contraintes pour la table `recevoir_admin`
--
ALTER TABLE `recevoir_admin`
  ADD CONSTRAINT `recevoir_admin_ibfk_1` FOREIGN KEY (`login`) REFERENCES `admin` (`login`),
  ADD CONSTRAINT `recevoir_admin_ibfk_2` FOREIGN KEY (`id_notif`) REFERENCES `notif` (`id_notif`);

--
-- Contraintes pour la table `recevoir_editeur`
--
ALTER TABLE `recevoir_editeur`
  ADD CONSTRAINT `recevoir_editeur_ibfk_1` FOREIGN KEY (`id_editeur`) REFERENCES `editeur` (`id_editeur`),
  ADD CONSTRAINT `recevoir_editeur_ibfk_2` FOREIGN KEY (`id_notif`) REFERENCES `notif` (`id_notif`);

--
-- Contraintes pour la table `recevoir_user`
--
ALTER TABLE `recevoir_user`
  ADD CONSTRAINT `recevoir_user_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `recevoir_user_ibfk_2` FOREIGN KEY (`id_notif`) REFERENCES `notif` (`id_notif`);

--
-- Contraintes pour la table `remboursement`
--
ALTER TABLE `remboursement`
  ADD CONSTRAINT `remboursement_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `remboursement_ibfk_2` FOREIGN KEY (`id_jeu`) REFERENCES `jeu` (`id_jeu`),
  ADD CONSTRAINT `remboursement_ibfk_3` FOREIGN KEY (`id_transaction`) REFERENCES `commande` (`id_transaction`);

--
-- Contraintes pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD CONSTRAINT `utiliser_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `utiliser_ibfk_2` FOREIGN KEY (`id_controlleurs`) REFERENCES `controlleur` (`id_controlleurs`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
