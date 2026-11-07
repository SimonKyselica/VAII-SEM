-- Adminer 6.1.2 MariaDB 13.0.2-MariaDB-ubu2604 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `severity` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `buildVersion` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `reports` (`id`, `title`, `type`, `severity`, `status`, `description`, `buildVersion`, `createdAt`) VALUES
(1,	'Bug in your game when standing',	'bug',	'critical',	'new',	'When I\'m standing I cannot move',	'0.10.2',	'2026-11-07 00:00:00'),
(3,	'Bug when im shoting',	'bug',	'medium',	'confirmed',	'When im shooting, I cannot move',	'6.7.9.',	'2026-11-07 16:35:37'),
(4,	'Crash when im jumping',	'crash',	'critical',	'in_progress',	'When im jumping, the game crashes :( pls fix',	'4.6.7.',	'2026-11-07 16:37:04');

-- 2026-11-07 16:38:00 UTC