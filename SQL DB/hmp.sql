-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 27, 2019 at 04:00 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collaborator`
--

DROP TABLE IF EXISTS `collaborator`;
CREATE TABLE IF NOT EXISTS `collaborator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `github_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_accepted` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_606D487CA76ED395` (`user_id`),
  KEY `IDX_606D487C166D1F9C` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collaborator`
--

INSERT INTO `collaborator` (`id`, `user_id`, `github_url`, `reason`, `is_accepted`, `project_id`) VALUES
(1, 5, 'https://github.com/mandiallabenj', 'I would like collaborate with you regarding your application. I have some api that is similar. Reply asap.', 'NO', 2),
(2, 5, 'https://github.com/mandiallabenj', 'i have RESTFUL api (s) thats suite your application', 'NO', 2),
(3, 2, 'https://github.com/mandiallabenj', 'Thanks for this App, lets work together', 'NO', 9),
(4, 6, 'https://github.com/mandiallabenj', 'i have an Api to fix multi languages', 'NO', 2);

-- --------------------------------------------------------

--
-- Table structure for table `collaborator_projects`
--

DROP TABLE IF EXISTS `collaborator_projects`;
CREATE TABLE IF NOT EXISTS `collaborator_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collaborator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7C293D2230098C8C` (`collaborator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CDE98962A76ED395` (`user_id`),
  KEY `IDX_CDE98962166D1F9C` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `issue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DA7D7F83A76ED395` (`user_id`),
  KEY `IDX_DA7D7F83166D1F9C` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `user_id`, `project_id`, `issue`, `created_at`) VALUES
(1, 3, 2, 'App built for the English language, how about Spanish, French and German? I recommend the symfony 4.3 Translator component.', '2019-04-23 11:04:13'),
(2, 3, 3, 'Can\'t work with safari browser? Solve this', '2019-04-23 11:07:22'),
(3, 2, 5, 'Music takes long to sync!! in the ipad 3rd Model?', '2019-04-23 11:38:49'),
(4, 2, 5, 'Can\'t work with safari browser? Solve this', '2019-05-01 10:10:31'),
(5, 2, 5, 'Can\'t work with safari browser? Solve this', '2019-05-01 10:10:38'),
(6, 6, 2, 'fix settings option for Opera mini browser', '2019-06-06 11:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190422164642', '2019-04-22 16:46:56'),
('20190422182241', '2019-04-22 20:45:55'),
('20190422203436', '2019-04-22 20:35:30'),
('20190422204414', '2019-04-22 20:49:12'),
('20190422205705', '2019-04-22 20:57:23'),
('20190424183645', '2019-04-24 18:37:03'),
('20190424211938', '2019-04-28 11:08:47'),
('20190428111959', '2019-04-28 11:20:12'),
('20190502100843', '2019-05-02 10:09:11'),
('20190502101538', '2019-05-02 10:15:47'),
('20190502101641', '2019-05-02 10:16:52'),
('20190502134520', '2019-05-02 13:46:00'),
('20190502182248', '2019-05-02 18:23:47'),
('20190502200352', '2019-05-05 19:37:32'),
('20190505192145', '2019-05-05 19:22:19'),
('20190506051246', '2019-05-06 05:13:11'),
('20190507171826', '2019-05-07 17:19:27'),
('20190508032805', '2019-05-08 03:28:51'),
('20190508033730', '2019-05-08 03:38:21'),
('20190508202448', '2019-05-08 20:25:16'),
('20190529043149', '2019-05-29 04:32:16'),
('20190529045049', '2019-05-29 04:51:01'),
('20190602170005', '2019-06-02 17:00:32'),
('20190606123948', '2019-06-06 12:41:13'),
('20190606200409', '2019-06-06 20:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enterprise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isblocked` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2FB3D0EEA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `user_id`, `title`, `icon`, `description`, `published_at`, `category`, `is_enterprise`, `isblocked`, `is_approved`) VALUES
(2, 2, 'Voice Recognition App', '5ed8478bdf07410e1285baa2aaf4672f.png', 'The app is powered by Google voice recognition tech. When you\'re recording a note, you can easily dictate punctuation marks through voice commands, or by using the built-in punctuation keyboard.', '2019-04-28 11:21:16', 'Web', 'YES', 'NO', 'YES'),
(3, 2, 'w3 schools Api', '6366c5d7be93bb8cef6cdf25e67f480e.jpeg', 'W3Schools API is optimized for learning, testing, and training.', '2019-04-28 11:23:58', 'Web', NULL, 'YES', 'YES'),
(4, 3, 'MakEssense Work Blog', '50aa2f8ca0e75d316428d280418f99d8.png', 'Start a course work forum, anywhere at anytime. Compatible with chrome and firefox Add Ons extensions', '2019-04-23 11:06:16', NULL, NULL, 'NO', 'NO'),
(5, 3, 'Itunes Music Skin', 'f403eb9bff23a565d0b4f5c4a756ac84.png', 'iTunes Music Skin is a media player skin that provides media library, and Internet radio broadcaster web service.', '2019-04-23 11:25:43', NULL, 'YES', 'NO', 'NO'),
(6, 3, 'AppStore API', 'df56e078cb4e0d510dd92af53a3dba7e.png', 'The AppStore API allows users to browse and download apps developed with Apple\'s iOS software development kit.', '2019-04-23 11:30:58', NULL, NULL, 'YES', NULL),
(7, 2, 'Love Match', '5d58047db6e7afe8d935090a9cc6d9c2.png', 'Love match is a couples APP and provides better communication experience & better way to stay in touch with your favorite person. Sending messages, voice messages, pictures e.t.c', '2019-04-23 11:36:08', NULL, 'YES', 'NO', 'YES'),
(8, 2, 'Delicious Code API', 'e74af0627572b9295125172539ae73d6.png', 'Instead of handling file uploading yourself, you may consider using the Delicious Code API. This API provides all the common operations (such as file renaming, saving and deleting) and it\'s tightly integrated with Doctrine ORM.', '2019-04-23 14:04:21', NULL, NULL, 'NO', 'YES'),
(9, 5, 'Symfony 4 CMS', 'e42375d7ae85f2a028a355e15371a580.png', 'Symfony 4 CMS project represents a rethinking of its ideas and features from the ground up to match the industry practices withapplication bundles,config parameters are now environment variables, the application directory structure is easier to navigate and hundreds of other small improvements that will make you love Symfony.', '2019-06-05 16:11:55', 'Web', NULL, 'NO', NULL),
(10, 5, 'Blackfire io', '3358fda4f0fd38becba1140fe8eae914.jpeg', 'Blackfire empowers all developers and IT/Ops to continuously verify and improve their app’s\r\nperformance, throughout its lifecycle, by getting the right information at the right moment.', '2019-06-05 16:15:27', 'Web', NULL, 'NO', NULL),
(11, 6, 'Cartoon Api', 'd9e6b84602137f0519f53517f4eb1026.jpeg', 'Use this api to build all human model animations', '2019-06-06 11:29:43', 'Web', 'YES', 'YES', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `projectfiles`
--

DROP TABLE IF EXISTS `projectfiles`;
CREATE TABLE IF NOT EXISTS `projectfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `projectfile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `version_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_6281F85AA76ED395` (`user_id`),
  KEY `IDX_6281F85A166D1F9C` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projectfiles`
--

INSERT INTO `projectfiles` (`id`, `project_id`, `user_id`, `projectfile`, `created_at`, `version_name`, `features`) VALUES
(1, 2, 2, 'c663935204c4e7ebbcf093c794b32772.zip', '2019-04-24 18:37:53', NULL, NULL),
(2, 2, 2, '6d2e0f25a52f3858ece44236b14d1379.zip', '2019-04-24 20:27:51', NULL, NULL),
(3, 2, 2, 'a7a24f3e1ffbf1ce5cf490ecade47632.zip', '2019-04-24 20:28:29', NULL, NULL),
(4, 2, 2, 'c4259213f15e36170cbda7ac4d122c5f.zip', '2019-04-24 22:33:01', NULL, NULL),
(5, 7, 2, 'a8697edcfa5f4c28256885278d1ee77d.zip', '2019-04-24 22:39:33', NULL, NULL),
(6, 2, 2, '000e6202e5f30a91573df5713b22952e.zip', '2019-05-01 10:04:57', NULL, NULL),
(7, 2, 2, '0edbe37436e06ca235ff6ff932051173.zip', '2019-05-02 12:54:56', '1.1 Beta', NULL),
(8, 2, 2, 'b52b5e2e0f349266c05df491602b96f1.zip', '2019-05-02 19:23:09', '1.3.1 Beta plus', 'Bug fixes, Support for Languages: spanish and german.'),
(9, 2, 2, 'c631b0aa5d2a5ff1d98df6fb0933f51c.zip', '2019-05-02 19:23:27', '1.3.1 Beta plus', 'Bug fixes, Support for Languages: spanish and german.'),
(10, 3, 2, '2dcb4021931730710dce34b7d2b8fab8.zip', '2019-05-02 19:29:54', '1.1 nero -V', 'Bug Fixes, Python Support'),
(11, 3, 2, '23d7db319ececa711dc5c2b614647788.zip', '2019-05-02 19:32:59', '1.1 nero -V', 'Bug Fixes, Python Support'),
(12, 3, 2, '80e747b49f352cd8402114faa2fd03c2.zip', '2019-05-02 19:51:46', '1.1.2 nero -V', 'Bug fixes, Python Support, C++ and C# Support,'),
(13, 2, 2, '996d884648350b9a7e6df0bd3aafe56d.zip', '2019-05-02 19:53:14', '1.4.1 Beta plus', 'Bug fixes, Support for Languages: Spanish, Latin , Kiswahili and German.'),
(14, 11, 6, '845395291f7e97a59dea0de38519f6a4.zip', '2019-06-06 11:48:24', 'Cartoon Froyo 6.6', 'Blender, 3d max support, spanish language');

-- --------------------------------------------------------

--
-- Table structure for table `screenshot`
--

DROP TABLE IF EXISTS `screenshot`;
CREATE TABLE IF NOT EXISTS `screenshot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `screenshot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_58991E41166D1F9C` (`project_id`),
  KEY `IDX_58991E41A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screenshot`
--

INSERT INTO `screenshot` (`id`, `project_id`, `user_id`, `screenshot`) VALUES
(6, 2, 2, 'b6eb3790e02e6164261f0f3a4176ac3f.png'),
(7, 2, 2, '737554f6f266f2b710b99379be4e7b88.png'),
(8, 8, 2, 'c1b229a9f1c6431caf3633e626028c00.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `email`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=1024,t=2,p=2$MmtsejZKZ0s0L2Y0bk0yNA$KgEoyagLBAoGBzA6RQ1OEhoYupcpQcFnIQC2F64RfO8', 'mandeallanbenjamin@gmail.com'),
(2, 'mandiallabenj', '[]', '$argon2i$v=19$m=1024,t=2,p=2$Zk50R3c5R0RtdlVhVFBkWQ$FS2f6WFMJh9l1NSTGkWbTOtbB2WHBWGOCV24XGiCAfs', 'allan.m.b@aol.com'),
(3, 'elos', '[]', '$argon2i$v=19$m=1024,t=2,p=2$MDFyUDM4bVBIUVk5VHVpbQ$/ppswZEGmkxcd9XmF9G79iLlDE0pJWZ4+3MF2cgBc2U', 'allan.m.b@aol.com'),
(4, 'emma', '[]', '$argon2i$v=19$m=1024,t=2,p=2$aVFuNEJtM05QTUVraVBicw$nkwrvvZUZsckpVLPBA42TATpyrBa1DDoXFHGw9y6jn4', 'memashia@gmail.com'),
(5, 'deliciouscodelabs', '[]', '$argon2i$v=19$m=1024,t=2,p=2$V0p0MG83TGkzSEZGbVA4WQ$dsUYqvzau22rQTKQqS/3ah1dR3s/xzlHZB2VsRdYSmg', 'deliciouscode17@gmail.com'),
(6, 'Jessy', '[]', '$argon2i$v=19$m=1024,t=2,p=2$VVhzdUwzWE1rcG9PdjJiWQ$8hPWAy7hR1HjuX8BRRfzloq/px0azqKNwGPdJyfgzJE', 'jessy@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collaborator`
--
ALTER TABLE `collaborator`
  ADD CONSTRAINT `FK_606D487C166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_606D487CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `collaborator_projects`
--
ALTER TABLE `collaborator_projects`
  ADD CONSTRAINT `FK_7C293D2230098C8C` FOREIGN KEY (`collaborator_id`) REFERENCES `collaborator` (`id`);

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `FK_CDE98962166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_CDE98962A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `FK_DA7D7F83166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_DA7D7F83A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `FK_2FB3D0EEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `projectfiles`
--
ALTER TABLE `projectfiles`
  ADD CONSTRAINT `FK_6281F85A166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_6281F85AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `screenshot`
--
ALTER TABLE `screenshot`
  ADD CONSTRAINT `FK_58991E41166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `FK_58991E41A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
