-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 jan. 2025 à 11:46
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tom_troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `disponibilite` tinyint(1) NOT NULL DEFAULT '1',
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `books_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `user_id`, `titre`, `auteur`, `description`, `image_url`, `disponibilite`, `date_ajout`) VALUES
(1, 12, 'The Kinkfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table.                                                 ', 'the-kinkfolk-table.png', 1, '2024-09-27 14:56:50'),
(2, 12, 'The Kinkfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. ', 'the-kinkfolk-table.png', 0, '2024-09-27 14:56:50'),
(3, 12, 'The Kinkfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. ', 'the-kinkfolk-table.png', 1, '2024-09-27 14:56:50'),
(4, 12, 'The Kinkfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. ', 'the-kinkfolk-table.png', 0, '2024-09-27 14:56:50'),
(16, 12, 'Narnia', 'C.S Lewis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'narnia.png', 1, '2024-11-22 12:26:31'),
(17, 19, 'The Two Towers', 'J.R.R Tolkien', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'the-two-towers.png', 1, '2024-11-22 12:28:17'),
(18, 20, 'Company Of One', 'Paul Jarvis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'company-of-one.png', 1, '2024-11-22 12:29:22'),
(19, 21, 'Narnia', 'C.S Lewis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'narnia.png', 1, '2024-11-22 12:30:15'),
(20, 22, 'The Subtle Art Of Not Giving A Fuck', 'Mark Manson', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.\r\n\r\n', 'the-subtle-art-of-not-having-a-fuck.png', 1, '2024-11-22 12:31:14'),
(21, 23, 'A Book Full Of Hope', 'Ruki Kaur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'a-book-full-of-hope.png', 1, '2024-11-22 12:32:17'),
(22, 24, 'Thinking, Fast & Slow', 'Daniel Kahneman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'thinking-fast-and-slow.png', 1, '2024-11-22 12:33:35'),
(23, 25, 'Psalms', 'Alabaster', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'psalms.png', 1, '2024-11-22 12:34:22'),
(24, 26, 'Innovation', 'Matt Ridley', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'innovation.png', 1, '2024-11-22 12:35:17'),
(25, 27, 'Hygge', 'Meik Wiking', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'hygge.png', 1, '2024-11-22 12:42:15'),
(26, 28, 'Minimalist Graphics', 'Julia Schlonlau', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'minimalist-graphics.png', 1, '2024-11-22 12:43:21'),
(27, 29, 'Milwaukee Mission', 'Elder Cooper Low', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'milwaukee-mission.png', 1, '2024-11-22 12:44:22'),
(28, 30, 'Delight!', 'Justin Rossow', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'delight!.png', 1, '2024-11-22 12:45:13'),
(29, 27, 'Milk & honey', 'Rupi Kaur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'milk-and-honey.png', 1, '2024-11-22 12:46:48'),
(30, 11, 'Wabi Sabi', 'Beth Kempton', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'wabi-sabi.png', 1, '2024-11-22 12:47:45'),
(31, 11, 'The Kinfolk Table', 'Nathan Williams', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.', 'the-kinkfolk-table.png', 1, '2024-11-22 12:48:46'),
(32, 31, 'Esther', 'Alabaster', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In bibendum mauris ex, ut commodo ante varius eget. Nulla porttitor sollicitudin dolor, sit amet suscipit est fermentum vulputate. Mauris nisl diam, cursus sed sodales eget, posuere id quam. Aliquam vel consectetur eros. Vivamus sed mi nec risus placerat tempor eget a leo. Donec scelerisque, nisi ut imperdiet vulputate, diam tellus pretium tellus, ac tempor erat massa vel lorem. Morbi blandit velit rutrum, ultrices mauris nec, convallis lorem. Aenean ac massa sit amet lacus posuere posuere. Aliquam ornare tempus elementum. Nunc consectetur elit vel aliquet egestas. Vivamus eu nulla nulla. Sed tortor lorem, vulputate eu mauris ac, imperdiet volutpat arcu. In semper magna eu ultrices efficitur. In accumsan massa nisi, nec tempor leo luctus non. Suspendisse tincidunt sapien auctor vestibulum malesuada.\r\n\r\n', 'esther.png', 1, '2024-11-22 12:49:26'),
(34, 12, 'The Kinkfolk Table', 'Nathan Williams', 'J\'ai récemment plongé dans les pages de \r\n\r\nThe Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; \r\n\r\nl célèbre l\'art de partager des moments authentiques autour de la table.                                                                                                                                                                                                                                                                                                                                                                                                                                              ', 'test.png', 1, '2024-11-27 14:56:50');

-- --------------------------------------------------------

--
-- Structure de la table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `owner_id` int NOT NULL,
  `participant_id` int NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `participant_non_lu` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  KEY `participant_id` (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `chats`
--

INSERT INTO `chats` (`id`, `owner_id`, `participant_id`, `date_creation`, `participant_non_lu`) VALUES
(38, 11, 12, '2025-01-17 14:29:01', 0),
(39, 12, 11, '2025-01-17 14:29:01', 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chat_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `chat_id`, `sender_id`, `message`, `date_envoi`) VALUES
(191, 38, 11, 'he', '2025-01-17 14:29:05'),
(192, 39, 12, 'he', '2025-01-17 14:29:05'),
(193, 39, 12, 'dbdbdf', '2025-01-17 14:29:26'),
(194, 38, 11, 'dbdbdf', '2025-01-17 14:29:26'),
(195, 38, 11, 'feaeaf', '2025-01-24 09:16:15'),
(196, 39, 12, 'feaeaf', '2025-01-24 09:16:15'),
(197, 39, 12, 'aefefefeaz', '2025-01-24 09:16:37'),
(198, 38, 11, 'aefefefeaz', '2025-01-24 09:16:37');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `miniature_profil_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pseudo`, `date_inscription`, `miniature_profil_url`) VALUES
(11, 'alexlecture@gmail.com', '$2y$10$7OnhBuDzBjRUfVV/cXuenOJGABkeWj2OlrMJF4irsVk2iHQcQ9vIy', 'Alexlecture', '2024-05-27 09:46:06', ''),
(12, 'nathalire@gmail.com', '$2y$10$diGzLCO4X0Kzjj119rC9LesMouGGAu3BQEfJTyAdA9ADeIMiDuUly', 'Nathalire', '2023-09-27 10:46:46', 'Gally\'ko Tattoo Logo.jpg'),
(19, 'Lotrfanclub67@gmail.com', '$2y$10$Lk2SbOk/GLGvZXShjzr6muGrVaVpkNigOCE6s67JtcIRkVZdr0X.m', 'Lotrfanclub67', '2024-11-22 12:17:37', ''),
(20, 'Victoirefabr912@gmail.com', '$2y$10$PztEnap3bPDh2bMpgD8AKesqPfykYI1HKPQQ4L5pl6/2mQu21xr/.', 'Victoirefabr912', '2024-11-22 12:18:18', ''),
(21, 'AnnikaBrahms@gmail.com', '$2y$10$fPXILu4Xr4CVxhq3v5oWeu8djxJvOF1Mgmod0P7efb/aaVSK63fmW', 'AnnikaBrahms', '2024-11-22 12:18:35', ''),
(22, 'Verogo33@gmail.com', '$2y$10$2dO3poyuHuwq7E52Rlcmc.NO3G7zp6FVr.N4Xale1N2FuIt1dmJ9C', 'Verogo33', '2024-11-22 12:18:56', ''),
(23, 'ML95@gmail.com', '$2y$10$nFVOubFB/6YRZgtqbZGd4.nKIl9psaSFPuRhn/mjrWXslTI8I4wHe', 'ML95', '2024-11-22 12:20:20', ''),
(24, 'Sas634@gmail.com', '$2y$10$iQiq8BtYedWosB9CmwXz5.IQAKkGVvjQtbxVLHvk99NAqsbJKyNiK', 'Sas634', '2024-11-22 12:20:47', ''),
(25, 'Lolobzh@gmail.com', '$2y$10$IIx.xmkDCbDM1HynGnz99.Mgd0B2.7l6ysPBBUINRkljhS/XCaGo6', 'Lolobzh', '2024-11-22 12:21:06', ''),
(26, 'Lou&Ben50@gmail.com', '$2y$10$.Miy.qlTLGh0ua2FsszMGeqid1tImjWwS.IhzgkHqIeJFZW8pF1Zq', 'Lou&Ben50', '2024-11-22 12:21:21', ''),
(27, 'Hugo1990_12@gmail.com', '$2y$10$FSZl5kVEzrEzMTq2cY8urOpW7HkOh7gIgYV5vdTOkjGk0Z.sXK4Wm', 'Hugo1990_12', '2024-11-22 12:21:39', ''),
(28, 'Hamzalecture@gmail.com', '$2y$10$tVrTr1Ems01lAooggZEQau8iChN5qmXXf75vSPUQ3d74VqEgKFoHa', 'Hamzalecture', '2024-11-22 12:21:56', ''),
(29, 'Christiane75014@gmail.com', '$2y$10$F9it9JIpLkI71RUZll4hn.0O7O2jJbvaVXRAZL/WVjogx0WIwLMAa', 'Christiane75014', '2024-11-22 12:22:12', ''),
(30, 'Juju1432@gmail.com', '$2y$10$iRBzkrho/aYQtHs7Da.xYu4rUFb1pikHc1spllWfbEiVGbyiDgoxG', 'Juju1432', '2024-11-22 12:22:27', ''),
(31, 'CamilleClubLit@gmail.com', '$2y$10$cqWO7hvfDHaEuavteInyAu7iyN/ny/GgCOauabL2.jQfZZ9mZhkiu', 'CamilleClubLit', '2024-11-22 12:22:55', 'test.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `fk_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participant_id` FOREIGN KEY (`participant_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_chat_id` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sender_id` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
