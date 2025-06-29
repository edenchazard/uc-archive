-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.9.8-MariaDB-1:10.9.8+maria~ubu2204 - mariadb.org binary distribution
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table uc_archive.shop_transaction_requirements: ~0 rows (approximately)
INSERT IGNORE INTO `shop_transaction_requirements` (`id`, `shop_transaction_id`, `requireable_type`, `requireable_id`, `amount`) VALUES
	(1, 1, 'App\\Models\\Consumable', 4, 75),
	(2, 1, 'App\\Models\\Consumable', 7, 75),
	(3, 2, 'App\\Models\\Consumable', 6, 2),
	(4, 2, 'App\\Models\\Consumable', 8, 35),
	(5, 3, 'App\\Models\\Consumable', 16, 25),
	(6, 3, 'App\\Models\\Consumable', 17, 25),
	(7, 3, 'App\\Models\\Consumable', 9, 25),
	(8, 3, 'App\\Models\\Consumable', 15, 25),
	(9, 4, 'App\\Models\\Consumable', 7, 25),
	(10, 4, 'App\\Models\\Consumable', 13, 25),
	(11, 4, 'App\\Models\\Consumable', 11, 25),
	(12, 4, 'App\\Models\\Consumable', 21, 5),
	(13, 5, 'App\\Models\\Consumable', 3, 25),
	(14, 5, 'App\\Models\\Consumable', 19, 25),
	(15, 5, 'App\\Models\\Consumable', 10, 25),
	(16, 5, 'App\\Models\\Consumable', 12, 25),
	(17, 6, 'App\\Models\\Consumable', 8, 25),
	(18, 6, 'App\\Models\\Consumable', 18, 25),
	(19, 6, 'App\\Models\\Consumable', 4, 25),
	(20, 6, 'App\\Models\\Consumable', 5, 25),
	(21, 7, 'App\\Models\\Consumable', 17, 10),
	(22, 7, 'App\\Models\\Consumable', 15, 10),
	(23, 8, 'App\\Models\\Consumable', 16, 8),
	(24, 8, 'App\\Models\\Consumable', 19, 7),
	(25, 9, 'App\\Models\\Consumable', 8, 8),
	(26, 9, 'App\\Models\\Consumable', 11, 7),
	(27, 10, 'App\\Models\\Consumable', 5, 30),
	(28, 10, 'App\\Models\\Consumable', 18, 15),
	(29, 10, 'App\\Models\\Consumable', 3, 15),
	(30, 10, 'App\\Models\\Consumable', 20, 5),
	(31, 11, 'App\\Models\\Consumable', 1, 10),
	(32, 11, 'App\\Models\\Consumable', 2, 8),
	(33, 11, 'App\\Models\\Consumable', 14, 8),
	(34, 11, 'App\\Models\\Consumable', 6, 4),
	(35, 12, 'App\\Models\\Consumable', 1, 20),
	(36, 12, 'App\\Models\\Consumable', 2, 15),
	(37, 12, 'App\\Models\\Consumable', 14, 15),
	(38, 12, 'App\\Models\\Consumable', 6, 12),
	(39, 12, 'App\\Models\\Consumable', 20, 25),
	(40, 13, 'App\\Models\\Consumable', 5, 20),
	(41, 13, 'App\\Models\\Consumable', 12, 20),
	(42, 13, 'App\\Models\\Consumable', 8, 20),
	(43, 13, 'App\\Models\\Consumable', 7, 20),
	(44, 14, 'App\\Models\\Consumable', 5, 20),
	(45, 14, 'App\\Models\\Consumable', 12, 20),
	(46, 14, 'App\\Models\\Consumable', 8, 20),
	(47, 14, 'App\\Models\\Consumable', 7, 20),
	(48, 15, 'App\\Models\\Consumable', 1, 1),
	(49, 15, 'App\\Models\\Consumable', 2, 1),
	(50, 15, 'App\\Models\\Consumable', 14, 1),
	(51, 15, 'App\\Models\\Consumable', 6, 1),
	(52, 15, 'App\\Models\\Consumable', 16, 5),
	(53, 16, 'App\\Models\\Consumable', 14, 1),
	(54, 16, 'App\\Models\\Consumable', 18, 10),
	(55, 17, 'App\\Models\\Consumable', 6, 2),
	(56, 17, 'App\\Models\\Consumable', 1, 1),
	(57, 17, 'App\\Models\\Consumable', 15, 35),
	(58, 18, 'App\\Models\\Consumable', 14, 2),
	(59, 18, 'App\\Models\\Consumable', 2, 1),
	(60, 18, 'App\\Models\\Consumable', 3, 30),
	(61, 19, 'App\\Models\\Consumable', 20, 10),
	(62, 19, 'App\\Models\\Consumable', 10, 20),
	(63, 19, 'App\\Models\\Consumable', 1, 10),
	(64, 19, 'App\\Models\\Consumable', 14, 10),
	(65, 19, 'App\\Models\\Consumable', 2, 10),
	(66, 20, 'App\\Models\\Consumable', 1, 10),
	(67, 20, 'App\\Models\\Consumable', 2, 10),
	(68, 20, 'App\\Models\\Consumable', 6, 14),
	(69, 20, 'App\\Models\\Consumable', 18, 15),
	(70, 20, 'App\\Models\\Consumable', 22, 5),
	(71, 21, 'App\\Models\\Consumable', 1, 7),
	(72, 21, 'App\\Models\\Consumable', 14, 25),
	(73, 21, 'App\\Models\\Consumable', 23, 15),
	(74, 21, 'App\\Models\\Consumable', 7, 8),
	(75, 22, 'App\\Models\\Consumable', 1, 1),
	(76, 22, 'App\\Models\\Consumable', 14, 14),
	(77, 22, 'App\\Models\\Consumable', 6, 20),
	(78, 22, 'App\\Models\\Consumable', 20, 30),
	(79, 23, 'App\\Models\\Consumable', 1, 18),
	(80, 23, 'App\\Models\\Consumable', 2, 17),
	(81, 23, 'App\\Models\\Consumable', 14, 15),
	(82, 23, 'App\\Models\\Consumable', 6, 16),
	(83, 23, 'App\\Models\\Consumable', 9, 66),
	(84, 24, 'App\\Models\\Consumable', 6, 18),
	(85, 24, 'App\\Models\\Consumable', 14, 4),
	(86, 24, 'App\\Models\\Consumable', 2, 12),
	(87, 24, 'App\\Models\\Consumable', 17, 50),
	(88, 25, 'App\\Models\\Consumable', 5, 10),
	(89, 25, 'App\\Models\\Consumable', 18, 10),
	(90, 26, 'App\\Models\\Consumable', 6, 8),
	(91, 26, 'App\\Models\\Consumable', 14, 18),
	(92, 26, 'App\\Models\\Consumable', 2, 5),
	(93, 26, 'App\\Models\\Consumable', 20, 30),
	(94, 26, 'App\\Models\\Consumable', 22, 10),
	(95, 27, 'App\\Models\\Consumable', 1, 10),
	(96, 27, 'App\\Models\\Consumable', 2, 11),
	(97, 27, 'App\\Models\\Consumable', 6, 12),
	(98, 27, 'App\\Models\\Consumable', 12, 50),
	(99, 28, 'App\\Models\\Consumable', 1, 14),
	(100, 28, 'App\\Models\\Consumable', 2, 10),
	(101, 28, 'App\\Models\\Consumable', 6, 8),
	(102, 28, 'App\\Models\\Consumable', 16, 50),
	(103, 29, 'App\\Models\\Consumable', 1, 10),
	(104, 29, 'App\\Models\\Consumable', 14, 8),
	(105, 29, 'App\\Models\\Consumable', 6, 12),
	(106, 29, 'App\\Models\\Consumable', 7, 30),
	(107, 29, 'App\\Models\\Consumable', 8, 20),
	(108, 29, 'App\\Models\\Consumable', 20, 20),
	(109, 29, 'App\\Models\\Consumable', 23, 10),
	(110, 30, 'App\\Models\\Consumable', 1, 12),
	(111, 30, 'App\\Models\\Consumable', 2, 3),
	(112, 30, 'App\\Models\\Consumable', 14, 3),
	(113, 30, 'App\\Models\\Consumable', 6, 12),
	(114, 30, 'App\\Models\\Consumable', 4, 50),
	(115, 30, 'App\\Models\\Consumable', 5, 50),
	(116, 30, 'App\\Models\\Consumable', 20, 25),
	(117, 31, 'App\\Models\\Consumable', 2, 15),
	(118, 31, 'App\\Models\\Consumable', 14, 15),
	(119, 31, 'App\\Models\\Consumable', 20, 50),
	(120, 31, 'App\\Models\\Consumable', 22, 5),
	(121, 31, 'App\\Models\\Consumable', 23, 10),
	(122, 31, 'App\\Models\\Consumable', 15, 75),
	(123, 31, 'App\\Models\\Consumable', 3, 60),
	(124, 32, 'App\\Models\\Consumable', 2, 10),
	(125, 32, 'App\\Models\\Consumable', 14, 10),
	(126, 32, 'App\\Models\\Consumable', 6, 10),
	(127, 32, 'App\\Models\\Consumable', 20, 100),
	(128, 32, 'App\\Models\\Consumable', 13, 100),
	(129, 33, 'App\\Models\\Consumable', 1, 4),
	(130, 33, 'App\\Models\\Consumable', 2, 20),
	(131, 33, 'App\\Models\\Consumable', 14, 20),
	(132, 33, 'App\\Models\\Consumable', 6, 20),
	(133, 34, 'App\\Models\\Consumable', 2, 12),
	(134, 34, 'App\\Models\\Consumable', 14, 12),
	(135, 34, 'App\\Models\\Consumable', 6, 8),
	(136, 35, 'App\\Models\\Consumable', 1, 20),
	(137, 35, 'App\\Models\\Consumable', 2, 15),
	(138, 35, 'App\\Models\\Consumable', 6, 20),
	(139, 35, 'App\\Models\\Consumable', 14, 15),
	(140, 35, 'App\\Models\\Consumable', 21, 75),
	(141, 36, 'App\\Models\\Consumable', 1, 12),
	(142, 36, 'App\\Models\\Consumable', 2, 15),
	(143, 36, 'App\\Models\\Consumable', 14, 3),
	(144, 37, 'App\\Models\\Consumable', 2, 7),
	(145, 37, 'App\\Models\\Consumable', 6, 23),
	(146, 37, 'App\\Models\\Consumable', 3, 165),
	(147, 38, 'App\\Models\\Consumable', 1, 8),
	(148, 38, 'App\\Models\\Consumable', 6, 21),
	(149, 38, 'App\\Models\\Consumable', 15, 77),
	(150, 38, 'App\\Models\\Consumable', 20, 10),
	(151, 43, 'App\\Models\\Consumable', 25, 100),
	(152, 43, 'App\\Models\\Consumable', 26, 100),
	(153, 43, 'App\\Models\\Consumable', 27, 100),
	(154, 43, 'App\\Models\\Consumable', 28, 100),
	(155, 44, 'App\\Models\\Consumable', 1, 15),
	(156, 44, 'App\\Models\\Consumable', 14, 12),
	(157, 44, 'App\\Models\\Consumable', 4, 175),
	(158, 44, 'App\\Models\\Consumable', 17, 175),
	(159, 45, 'App\\Models\\Consumable', 2, 18),
	(160, 45, 'App\\Models\\Consumable', 14, 10),
	(161, 45, 'App\\Models\\Consumable', 10, 10),
	(162, 45, 'App\\Models\\Consumable', 22, 10),
	(163, 46, 'App\\Models\\Consumable', 2, 10),
	(164, 46, 'App\\Models\\Consumable', 14, 8),
	(165, 46, 'App\\Models\\Consumable', 6, 9),
	(166, 46, 'App\\Models\\Consumable', 18, 75),
	(167, 46, 'App\\Models\\Consumable', 21, 25),
	(168, 47, 'App\\Models\\Consumable', 1, 14),
	(169, 47, 'App\\Models\\Consumable', 6, 13),
	(170, 47, 'App\\Models\\Consumable', 15, 90),
	(171, 47, 'App\\Models\\Consumable', 22, 15),
	(172, 48, 'App\\Models\\Consumable', 2, 15),
	(173, 48, 'App\\Models\\Consumable', 14, 14),
	(174, 48, 'App\\Models\\Consumable', 20, 20),
	(175, 48, 'App\\Models\\Consumable', 22, 15),
	(176, 49, 'App\\Models\\Consumable', 14, 8),
	(177, 49, 'App\\Models\\Consumable', 2, 6),
	(178, 49, 'App\\Models\\Consumable', 6, 15),
	(179, 49, 'App\\Models\\Consumable', 21, 5),
	(180, 49, 'App\\Models\\Consumable', 20, 11),
	(181, 49, 'App\\Models\\Consumable', 22, 5),
	(182, 50, 'App\\Models\\Consumable', 1, 6),
	(183, 50, 'App\\Models\\Consumable', 2, 6),
	(184, 50, 'App\\Models\\Consumable', 6, 18),
	(185, 51, 'App\\Models\\Consumable', 1, 10),
	(186, 51, 'App\\Models\\Consumable', 2, 5),
	(187, 51, 'App\\Models\\Consumable', 6, 10),
	(188, 51, 'App\\Models\\Consumable', 20, 10),
	(189, 51, 'App\\Models\\Consumable', 21, 100),
	(190, 52, 'App\\Models\\Consumable', 6, 25),
	(191, 52, 'App\\Models\\Consumable', 10, 200),
	(192, 52, 'App\\Models\\Consumable', 21, 15),
	(193, 53, 'App\\Models\\Consumable', 2, 28),
	(194, 53, 'App\\Models\\Consumable', 11, 75),
	(195, 53, 'App\\Models\\Consumable', 18, 75),
	(196, 54, 'App\\Models\\Consumable', 6, 18),
	(197, 54, 'App\\Models\\Consumable', 14, 10),
	(198, 54, 'App\\Models\\Consumable', 12, 75),
	(199, 54, 'App\\Models\\Consumable', 18, 75),
	(200, 55, 'App\\Models\\Consumable', 14, 25),
	(201, 55, 'App\\Models\\Consumable', 3, 150),
	(202, 55, 'App\\Models\\Consumable', 8, 150),
	(203, 56, 'App\\Models\\Consumable', 1, 10),
	(204, 56, 'App\\Models\\Consumable', 6, 15),
	(205, 56, 'App\\Models\\Consumable', 19, 150),
	(206, 56, 'App\\Models\\Consumable', 18, 150),
	(207, 56, 'App\\Models\\Consumable', 21, 10),
	(208, 59, 'App\\Models\\Consumable', 2, 20),
	(209, 59, 'App\\Models\\Consumable', 6, 5),
	(210, 59, 'App\\Models\\Consumable', 7, 200),
	(211, 59, 'App\\Models\\Consumable', 23, 15),
	(212, 60, 'App\\Models\\Consumable', 2, 25),
	(213, 60, 'App\\Models\\Consumable', 1, 25),
	(214, 60, 'App\\Models\\Consumable', 14, 25),
	(215, 60, 'App\\Models\\Consumable', 6, 23),
	(216, 60, 'App\\Models\\Consumable', 8, 300),
	(217, 60, 'App\\Models\\Consumable', 15, 1),
	(218, 60, 'App\\Models\\Consumable', 22, 10),
	(219, 61, 'App\\Models\\Consumable', 2, 10),
	(220, 61, 'App\\Models\\Consumable', 14, 10),
	(221, 61, 'App\\Models\\Consumable', 6, 5),
	(222, 61, 'App\\Models\\Consumable', 10, 300),
	(223, 61, 'App\\Models\\Consumable', 13, 300),
	(224, 62, 'App\\Models\\Consumable', 1, 8),
	(225, 62, 'App\\Models\\Consumable', 6, 7),
	(226, 62, 'App\\Models\\Consumable', 14, 8),
	(227, 62, 'App\\Models\\Consumable', 2, 7),
	(228, 62, 'App\\Models\\Consumable', 22, 5),
	(229, 62, 'App\\Models\\Consumable', 23, 5),
	(230, 63, 'App\\Models\\Consumable', 1, 5),
	(231, 63, 'App\\Models\\Consumable', 2, 5),
	(232, 63, 'App\\Models\\Consumable', 6, 15),
	(233, 63, 'App\\Models\\Consumable', 4, 300),
	(234, 63, 'App\\Models\\Consumable', 11, 200),
	(235, 63, 'App\\Models\\Consumable', 23, 10),
	(236, 64, 'App\\Models\\Consumable', 6, 25),
	(237, 64, 'App\\Models\\Consumable', 9, 200),
	(238, 64, 'App\\Models\\Consumable', 10, 200),
	(239, 64, 'App\\Models\\Consumable', 11, 200),
	(240, 64, 'App\\Models\\Consumable', 15, 200),
	(241, 39, 'App\\Models\\Item', 29, 1),
	(242, 39, 'App\\Models\\Item', 38, 2),
	(243, 39, 'App\\Models\\Item', 39, 2),
	(244, 39, 'App\\Models\\Item', 40, 2),
	(245, 40, 'App\\Models\\Item', 29, 1),
	(246, 40, 'App\\Models\\Item', 37, 2),
	(247, 40, 'App\\Models\\Item', 38, 2),
	(248, 40, 'App\\Models\\Item', 40, 2),
	(249, 41, 'App\\Models\\Item', 29, 1),
	(250, 41, 'App\\Models\\Item', 37, 2),
	(251, 41, 'App\\Models\\Item', 39, 2),
	(252, 41, 'App\\Models\\Item', 38, 2),
	(253, 42, 'App\\Models\\Item', 29, 1),
	(254, 42, 'App\\Models\\Item', 37, 2),
	(255, 42, 'App\\Models\\Item', 39, 2),
	(256, 42, 'App\\Models\\Item', 40, 2),
	(257, 43, 'App\\Models\\Item', 29, 50),
	(258, 45, 'App\\Models\\Item', 2, 2),
	(259, 51, 'App\\Models\\Item', 1, 1),
	(260, 51, 'App\\Models\\Item', 38, 2),
	(261, 51, 'App\\Models\\Item', 40, 2),
	(262, 52, 'App\\Models\\Item', 36, 1),
	(263, 53, 'App\\Models\\Item', 25, 1),
	(264, 54, 'App\\Models\\Item', 1, 50),
	(265, 55, 'App\\Models\\Item', 26, 1),
	(266, 59, 'App\\Models\\Item', 12, 1),
	(267, 60, 'App\\Models\\Item', 2, 1),
	(268, 62, 'App\\Models\\Item', 26, 10),
	(269, 62, 'App\\Models\\Item', 37, 2),
	(270, 63, 'App\\Models\\Item', 35, 2),
	(271, 63, 'App\\Models\\Item', 37, 3),
	(272, 65, 'App\\Models\\Item', 39, 15),
	(273, 65, 'App\\Models\\Item', 1, 10),
	(274, 65, 'App\\Models\\Item', 2, 10),
	(275, 65, 'App\\Models\\Item', 25, 10),
	(276, 65, 'App\\Models\\Consumable', 30, 3),
	(277, 65, 'App\\Models\\Consumable', 34, 3),
	(278, 65, 'App\\Models\\Consumable', 36, 2),
	(279, 66, 'App\\Models\\Consumable', 33, 4),
	(280, 67, 'App\\Models\\Consumable', 34, 4),
	(281, 68, 'App\\Models\\Consumable', 35, 4),
	(282, 69, 'App\\Models\\Consumable', 36, 4),
	(283, 70, 'App\\Models\\Consumable', 29, 1),
	(284, 71, 'App\\Models\\Consumable', 30, 1),
	(285, 72, 'App\\Models\\Consumable', 31, 1),
	(286, 73, 'App\\Models\\Consumable', 32, 1),
	(287, 74, 'App\\Models\\Consumable', 37, 5000),
	(288, 77, 'App\\Models\\Consumable', 32, 3),
	(289, 77, 'App\\Models\\Consumable', 36, 3),
	(290, 77, 'App\\Models\\Consumable', 35, 2),
	(291, 77, 'App\\Models\\Item', 40, 15),
	(292, 77, 'App\\Models\\Item', 1, 10),
	(293, 77, 'App\\Models\\Item', 2, 10),
	(294, 77, 'App\\Models\\Item', 25, 10);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
