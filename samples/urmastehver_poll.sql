-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Loomise aeg: Dets 21, 2021 kell 12:29 PL
-- Serveri versioon: 5.7.36-0ubuntu0.18.04.1
-- PHP versioon: 7.3.15-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `urmastehver_poll`
--
CREATE DATABASE IF NOT EXISTS `urmastehver_poll` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_estonian_ci;
USE `urmastehver_poll`;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `answers`
--

CREATE TABLE `answers` (
  `id_a` int(11) UNSIGNED NOT NULL,
  `id_q` int(11) UNSIGNED NOT NULL,
  `answer` int(2) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(20) COLLATE utf8mb4_estonian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `answers`
--

INSERT INTO `answers` (`id_a`, `id_q`, `answer`, `date`, `IP`) VALUES
(1, 416, 1, '2021-12-11 11:58:14', '81.90.124.51'),
(2, 415, 1, '2021-12-11 11:58:35', '81.90.124.51'),
(3, 431, 1, '2021-12-11 12:01:20', '81.90.124.51'),
(4, 425, 2, '2021-12-11 12:14:39', '81.90.124.51'),
(5, 425, 1, '2021-12-11 14:23:22', '81.90.124.56'),
(8, 428, 1, '2021-12-12 08:55:28', '87.119.186.117'),
(9, 428, 2, '2021-12-12 08:55:34', '87.119.186.117'),
(10, 428, 3, '2021-12-12 08:55:51', '87.119.186.117'),
(11, 428, 3, '2021-12-12 08:55:56', '87.119.186.117'),
(12, 425, 2, '2021-12-12 08:56:56', '87.119.186.117'),
(13, 425, 1, '2021-12-12 08:57:01', '87.119.186.117'),
(14, 425, 1, '2021-12-13 09:00:34', '81.90.124.6'),
(15, 425, 1, '2021-12-13 09:13:38', '81.90.124.6'),
(16, 425, 1, '2021-12-13 09:14:08', '81.90.124.6'),
(17, 425, 1, '2021-12-13 09:15:33', '81.90.124.6'),
(18, 428, 2, '2021-12-13 09:16:05', '81.90.124.6'),
(19, 428, 1, '2021-12-13 09:18:08', '81.90.124.6'),
(20, 428, 1, '2021-12-13 09:18:52', '81.90.124.6'),
(21, 428, 2, '2021-12-13 09:23:09', '81.90.124.6'),
(22, 433, 1, '2021-12-13 15:08:34', '87.119.186.121'),
(23, 433, 2, '2021-12-13 15:08:40', '87.119.186.121'),
(24, 433, 1, '2021-12-13 15:08:44', '87.119.186.121'),
(25, 434, 3, '2021-12-13 17:11:09', '87.119.186.121'),
(26, 428, 3, '2021-12-13 17:17:48', '87.119.186.121'),
(28, 434, 3, '2021-12-14 00:37:57', '195.250.179.71'),
(29, 434, 1, '2021-12-14 00:38:11', '195.250.179.71'),
(30, 434, 2, '2021-12-14 00:38:44', '195.250.179.71'),
(31, 434, 3, '2021-12-14 00:47:52', '195.250.179.71'),
(32, 434, 2, '2021-12-14 00:48:29', '195.250.179.71'),
(33, 434, 3, '2021-12-14 14:05:50', '195.250.179.71'),
(34, 434, 3, '2021-12-14 14:05:53', '195.250.179.71'),
(35, 434, 2, '2021-12-14 14:06:41', '195.250.179.71'),
(36, 434, 1, '2021-12-14 14:06:54', '195.250.179.71'),
(37, 434, 2, '2021-12-14 14:06:57', '195.250.179.71'),
(38, 434, 3, '2021-12-14 14:06:59', '195.250.179.71'),
(39, 434, 1, '2021-12-14 14:07:18', '195.250.179.71'),
(40, 434, 2, '2021-12-14 14:07:22', '195.250.179.71'),
(41, 434, 3, '2021-12-14 14:07:25', '195.250.179.71'),
(42, 434, 1, '2021-12-14 14:07:38', '195.250.179.71'),
(43, 434, 2, '2021-12-14 14:07:49', '195.250.179.71'),
(45, 435, 1, '2021-12-14 14:23:07', '195.250.179.71'),
(50, 431, 3, '2021-12-14 17:25:08', '87.119.186.107'),
(51, 431, 1, '2021-12-14 17:29:32', '87.119.186.107'),
(52, 431, 2, '2021-12-14 17:30:34', '87.119.186.107'),
(53, 431, 2, '2021-12-14 17:30:45', '87.119.186.107'),
(54, 433, 2, '2021-12-14 17:31:06', '87.119.186.107'),
(57, 433, 2, '2021-12-14 17:34:37', '84.50.130.208'),
(58, 415, 1, '2021-12-14 19:06:00', '81.90.124.13'),
(59, 434, 3, '2021-12-15 09:53:19', '84.50.130.208'),
(60, 435, 2, '2021-12-15 09:55:33', '84.50.130.208'),
(61, 435, 2, '2021-12-15 10:04:24', '84.50.130.208'),
(62, 435, 1, '2021-12-15 10:04:40', '84.50.130.208'),
(63, 433, 1, '2021-12-16 15:59:35', '87.119.186.92'),
(64, 433, 1, '2021-12-16 16:03:57', '87.119.186.92'),
(65, 433, 2, '2021-12-16 16:07:57', '87.119.186.92'),
(66, 429, 2, '2021-12-16 16:10:17', '87.119.186.92'),
(67, 429, 1, '2021-12-16 16:10:23', '87.119.186.92'),
(68, 435, 1, '2021-12-16 16:26:50', '87.119.186.92'),
(69, 435, 1, '2021-12-16 16:30:27', '87.119.186.92'),
(70, 435, 2, '2021-12-16 16:31:05', '87.119.186.92'),
(71, 435, 1, '2021-12-16 16:36:59', '87.119.186.92'),
(72, 435, 1, '2021-12-16 16:37:36', '87.119.186.92'),
(73, 425, 2, '2021-12-16 16:41:22', '87.119.186.92'),
(74, 425, 1, '2021-12-16 17:20:00', '87.119.186.92'),
(75, 425, 2, '2021-12-16 17:20:13', '87.119.186.92'),
(76, 425, 1, '2021-12-16 17:20:33', '87.119.186.92'),
(77, 425, 2, '2021-12-16 17:22:39', '87.119.186.92'),
(78, 433, 1, '2021-12-18 10:34:58', '84.50.130.208'),
(79, 432, 2, '2021-12-18 10:41:04', '84.50.130.208'),
(80, 432, 2, '2021-12-19 09:54:45', '84.50.130.208'),
(81, 432, 1, '2021-12-19 09:54:53', '84.50.130.208'),
(82, 432, 3, '2021-12-19 09:55:25', '84.50.130.208'),
(83, 432, 2, '2021-12-19 09:55:30', '84.50.130.208'),
(84, 432, 3, '2021-12-19 09:55:59', '84.50.130.208');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `questions`
--

CREATE TABLE `questions` (
  `id_q` int(11) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_estonian_ci NOT NULL,
  `answer_1` varchar(100) COLLATE utf8mb4_estonian_ci NOT NULL,
  `answer_2` varchar(100) COLLATE utf8mb4_estonian_ci NOT NULL,
  `answer_3` varchar(100) COLLATE utf8mb4_estonian_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `questions`
--

INSERT INTO `questions` (`id_q`, `question`, `answer_1`, `answer_2`, `answer_3`, `created`, `status`) VALUES
(415, 'Mis sa homme süüa tahad?', 'burgerit', 'suppi', '', '2021-12-03 15:26:40', 0),
(416, 'Mis sa õhtul teed?', 'Vaatan telekat', 'Loen', 'Lähen peole', '2021-12-06 12:07:47', 0),
(425, 'Mis teed?', 'Midagi', 'Vahin ekraani', '', '2021-12-06 13:28:12', 0),
(428, 'Kas täna tuleb külm öö?', 'jah', 'ei', 'võib-olla', '2021-12-06 19:55:52', 0),
(429, 'Kas tahvliga ka töötab?', 'Jah', 'Ei', '', '2021-12-06 20:06:40', 0),
(431, 'Mis päev homme on?', 'pühapäev', 'reede', 'kolmapäev', '2021-12-11 10:00:11', 0),
(432, 'Kas sul on hea tuju?', 'jah', 'ei', 'mis see sinu asi on', '2021-12-11 10:06:40', 1),
(433, 'Kust tuleb tolm?', 'kosmosest', 'ei tea', '', '2021-12-13 08:31:47', 0),
(434, 'Mis kell on?', 'Casio', 'Rolex', 'Muu', '2021-12-13 13:25:42', 0),
(435, 'Kas on vaadatud?', 'Jah', 'Ei', '', '2021-12-13 22:42:50', 0);

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id_a`),
  ADD KEY `id_question` (`id_q`);

--
-- Indeksid tabelile `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_q`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `answers`
--
ALTER TABLE `answers`
  MODIFY `id_a` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT tabelile `questions`
--
ALTER TABLE `questions`
  MODIFY `id_q` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- Tõmmistatud tabelite piirangud
--

--
-- Piirangud tabelile `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`id_q`) REFERENCES `questions` (`id_q`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
