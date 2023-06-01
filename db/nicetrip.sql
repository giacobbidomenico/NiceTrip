-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 01, 2023 alle 12:50
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
(1, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(2, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(3, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(4, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(5, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(6, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(7, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(8, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(9, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(10, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(11, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(12, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(13, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(14, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(15, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(16, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(17, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(18, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(19, 'Terzo comments second\'s post', '2023-05-10', '16:55:08', 6, 6),
(20, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(21, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(22, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(23, 'Seven comment\'s sixth post, second\'s post', '2023-05-11', '12:02:10', 6, 7),
(24, 'SES', '2020-12-05', '12:14:22', 6, 3),
(25, 'SES', '2020-12-05', '12:14:22', 6, 3),
(26, 'SES', '2020-12-05', '12:14:22', 6, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `destinations`
--

INSERT INTO `destinations` (`id`, `description`, `post_id`) VALUES
(13, 'Ancona, Italia', 67),
(14, 'Cesenatico Palazzo Turism, Viale Roma 112, 47042 Cesenatico, FC, Italia', 67);

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
(15, 3, 5),
(6, 6, 5),
(7, 7, 5);

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
(28, 67, '314ac198e0bb5d94bc711904c6b554.jpg');

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
(3, 6),
(5, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 'primo', 'primo', 3, '16:11:59', '2023-05-10'),
(6, 'secondo', 'secondo', 5, '16:12:21', '2023-05-10'),
(7, 'secondo.primo', 'secondo.primo', 5, '16:14:52', '2023-05-09'),
(8, 'secondo.secondo', 'secondo.secondo', 5, '16:12:21', '2023-05-16'),
(9, 'secondo.terzo', 'secondo.terzo', 5, '16:14:52', '2023-05-16'),
(10, 'terzo', 'terzo', 5, '16:12:21', '2023-05-17'),
(11, 'quarto', 'quarto', 5, '16:14:52', '2023-05-17'),
(12, 'quinto', 'quinto', 5, '16:12:21', '2023-05-17'),
(13, 'sesto', 'sesto', 5, '16:14:52', '2023-05-16'),
(14, 'settimo', 'settimo', 5, '16:14:52', '2023-05-16'),
(15, 'ottavo', 'ottavo', 5, '16:12:21', '2023-05-17'),
(16, 'nono', 'nono', 5, '16:14:52', '2023-05-17'),
(17, 'decimo', 'decimo', 5, '16:12:21', '2023-05-17'),
(18, 'undicesiomo', 'undicesiomo', 5, '16:14:52', '2023-05-16'),
(46, 'ferkgvpo', 'mvlemrgvermgv', 3, '24:05:22', '2023-05-16'),
(66, 'gropkgoprekogpkoprk', 'kfeokowpkgorkopkgoprwk', 3, '12:27:57', '2023-06-01'),
(67, 'jiojirjigjreoigjiojgiojre', 'jiweojfiowjeiojifojweojfi', 3, '12:33:45', '2023-06-01');

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
(3, 'primo', 'primo', 'primo', 'primo@primo.primo', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', 'genericProfilePhoto.jpg'),
(5, 'secondo', 'secondo', 'secondo', 'secondo@secondo.secondo', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', 'genericProfilePhoto.jpg'),
(6, 'terzo', 'terzo', 'terzo', 'terzo@terzo.terzo', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', 'genericProfilePhoto.jpg'),
(7, 'quarto', 'quarto', 'quarto', 'quarto@quarto.quarto', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', 'genericProfilePhoto.jpg'),
(11, 'cruciani', 'roberto', 'cruciani', 'nicetrip.socialplatform@gmail.com', '$2y$10$3wK7rbaNToUFSQxDnLxvz.TzOb.eru.XtYTXPkHct0OlT0ZgqkOAm', NULL, '', '');

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
  ADD KEY `senderId` (`senderId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT per la tabella `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT per la tabella `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `visualizations`
--
ALTER TABLE `visualizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

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
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`);

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
