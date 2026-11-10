-- Adminer 6.1.2 MariaDB 13.0.2-MariaDB-ubu2604 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `builds`;
CREATE TABLE `builds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(20) NOT NULL,
  `platform` varchar(20) NOT NULL,
  `changelog` text NOT NULL,
  `downloadUrl` varchar(255) NOT NULL,
  `releasedAt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `builds` (`id`, `version`, `platform`, `changelog`, `downloadUrl`, `releasedAt`) VALUES
(1,	'0.3.1',	'macos',	'Nic moc',	'',	'2026-12-10');

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `severity` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `buildId` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `buildId` (`buildId`),
  CONSTRAINT `1` FOREIGN KEY (`buildId`) REFERENCES `builds` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `reports` (`id`, `title`, `type`, `severity`, `status`, `description`, `buildId`, `createdAt`) VALUES
(5,	'iiii',	'bug',	'critical',	'fixed',	'kkklkllkkl',	1,	'2026-11-10 19:40:14');

-- 2026-11-10 19:49:25 UTC