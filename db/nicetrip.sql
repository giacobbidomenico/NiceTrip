-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 12, 2023 alle 22:12
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nicetrip`
--
CREATE DATABASE IF NOT EXISTS `nicetrip` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nicetrip`;

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `postsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `comments`
--

INSERT INTO `comments` (`id`, `description`, `date`, `time`, `postsId`, `userId`) VALUES
(33, 'copdvmpfdm', '2023-06-10', '11:01:07', 124, 3),
(35, 'bgrt brtnr', '2023-06-10', '16:24:09', 128, 5),
(44, 'voidfniobion', '2023-06-10', '22:35:44', 128, 3),
(47, 'bel post', '2023-06-11', '15:55:32', 127, 12),
(52, 'frwmpgvkne', '2023-06-12', '20:57:53', 127, 3),
(53, 'jvbpibjffr', '2023-06-12', '21:21:05', 127, 3),
(54, 'vjpirjvipoejbi', '2023-06-12', '22:01:02', 127, 3),
(55, 'vjpirjvipoejbi', '2023-06-12', '22:03:00', 127, 3),
(56, 'btepmhbem', '2023-06-12', '22:05:42', 127, 3),
(57, 'tbjie\'pboj', '2023-06-12', '22:05:54', 127, 3),
(58, 'colletta è bello', '2023-06-12', '22:06:22', 127, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `following` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `follows`
--

INSERT INTO `follows` (`id`, `follower`, `following`) VALUES
(16, 3, 5),
(48, 3, 12),
(44, 5, 12),
(17, 12, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `postsId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `images`
--

INSERT INTO `images` (`id`, `postsId`, `name`) VALUES
(110, 127, 'c2213cc523879e2ac6f2c63079c721.png'),
(111, 127, '1aee65e4d454a4414668e5e652819f.png'),
(112, 127, '0a67105e45bb60b0b2fc4b0145f41d.gif'),
(113, 127, '05d2969291fc75e7fe241ac7fbcf23.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `userId` int(11) NOT NULL,
  `postsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `likes`
--

INSERT INTO `likes` (`userId`, `postsId`) VALUES
(3, 124),
(3, 127),
(3, 128),
(5, 127),
(12, 124);

-- --------------------------------------------------------

--
-- Struttura della tabella `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `senderId`, `receiverId`, `postId`, `datetime`, `sent`) VALUES
(154, 3, 3, 12, NULL, '2023-06-12 21:38:27', 1),
(155, 3, 3, 12, NULL, '2023-06-12 21:39:17', 1),
(156, 3, 3, 12, NULL, '2023-06-12 22:00:01', 1),
(157, 1, 3, 12, 127, '2023-06-12 22:00:19', 1),
(158, 1, 3, 12, 127, '2023-06-12 22:00:42', 1),
(159, 2, 3, 12, 127, '2023-06-12 22:01:02', 1),
(160, 1, 3, 12, 127, '2023-06-12 22:02:57', 1),
(161, 2, 3, 12, 127, '2023-06-12 22:03:00', 1),
(162, 2, 3, 12, 127, '2023-06-12 22:05:42', 1),
(163, 2, 3, 12, 127, '2023-06-12 22:05:54', 1),
(164, 2, 3, 12, 127, '2023-06-12 22:06:22', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `userId` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `userId`, `time`, `date`) VALUES
(124, 'vnroingvo', 'nvrejngbogno', 5, '18:14:04', '2023-06-09'),
(127, 'ciao', 'ciao', 12, '15:02:04', '2023-06-10'),
(128, 'gegethrhe', 'gtntrnnntnrt', 5, '16:23:57', '2023-06-10');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation_code` varchar(30) DEFAULT NULL,
  `cookie` varchar(30) NOT NULL,
  `photoPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `userName`, `name`, `lastName`, `email`, `password`, `activation_code`, `cookie`, `photoPath`) VALUES
(3, 'primo', 'primo', 'primo', 'primo@primo.primo', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '3ffd95225a5e124286fac6e1bf2d2f', 'genericProfilePhoto.jpg'),
(5, 'secondo', 'secondo', 'secondo', 'secondo@secondo.secondo', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', 'genericProfilePhoto.jpg'),
(6, 'terzo', 'terzo', 'terzo', 'terzo@terzo.terzo', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', 'genericProfilePhoto.jpg'),
(7, 'quarto', 'quarto', 'quarto', 'quarto@quarto.quarto', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', 'genericProfilePhoto.jpg'),
(12, 'cruciani', 'roberto', 'cruciani', 'nicetrip.socialplatform@gmail.com', '$2y$10$WANP7LzfMGZ.kk02K3ALfOKsoUC9uIYTc55KqXfpNeig8j9d3dAiq', NULL, '', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `visualizations`
--

CREATE TABLE `visualizations` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `visualizations`
--

INSERT INTO `visualizations` (`id`, `userId`, `postId`) VALUES
(370, 3, 124),
(371, 3, 128),
(372, 12, 124),
(373, 12, 128),
(374, 3, 127),
(375, 5, 127);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postsId` (`postsId`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indici per le tabelle `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `follower_2` (`follower`,`following`),
  ADD KEY `follower` (`follower`),
  ADD KEY `following` (`following`);

--
-- Indici per le tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postsId` (`postsId`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`userId`,`postsId`),
  ADD KEY `postsId` (`postsId`);

--
-- Indici per le tabelle `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiverId` (`receiverId`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `postId` (`postId`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Indici per le tabelle `visualizations`
--
ALTER TABLE `visualizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT per la tabella `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT per la tabella `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT per la tabella `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `visualizations`
--
ALTER TABLE `visualizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `destinations_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Limiti per la tabella `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`);

--
-- Limiti per la tabella `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postsId`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`);

--
-- Limiti per la tabella `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Limiti per la tabella `visualizations`
--
ALTER TABLE `visualizations`
  ADD CONSTRAINT `visualizations_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `visualizations_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
