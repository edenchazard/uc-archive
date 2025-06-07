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

-- Dumping data for table uc_archive.alts: ~0 rows (approximately)
INSERT IGNORE INTO `alts` (`id`, `family_id`, `name`, `enabled`) VALUES
	(1, 2, 'candycane', 0),
	(2, 7, 'iceprince', 0),
	(3, 7, 'black', 0),
	(4, 27, 'holly', 0),
	(5, 28, 'green', 0),
	(6, 31, 'rose', 0),
	(7, 31, 'kiwi', 0),
	(8, 31, 'trick', 0),
	(9, 31, 'treat', 0),
	(10, 31, 'snow', 0),
	(11, 31, 'light', 0),
	(12, 31, 'gift', 0),
	(13, 31, 'cuddles', 1),
	(14, 31, 'wine', 1),
	(15, 31, 'heart', 0),
	(16, 31, 'mango', 1),
	(17, 31, 'coffee', 1),
	(18, 31, 'mint', 0),
	(19, 34, 'black', 0),
	(20, 37, 'snowbank', 0),
	(21, 54, 'light', 0),
	(22, 59, 'lovestruck', 0),
	(23, 82, 'camo', 1),
	(24, 82, 'red', 1),
	(25, 82, 'coral', 1),
	(26, 82, 'albino', 1),
	(27, 82, 'blue', 1),
	(28, 82, 'black', 1),
	(29, 96, 'black', 0),
	(30, 101, 'purple', 1),
	(31, 101, 'red', 1),
	(32, 101, 'green', 1),
	(33, 101, 'blue', 1),
	(34, 106, 'treat', 0),
	(35, 109, 'darkblue', 1),
	(36, 109, 'green', 1),
	(37, 109, 'lime', 1),
	(38, 109, 'aqua', 1),
	(39, 109, 'blue', 1),
	(40, 109, 'liquid', 1),
	(41, 122, 'orange', 0),
	(42, 133, 'fireworks', 0),
	(43, 133, 'green', 1),
	(44, 133, 'orange', 1),
	(45, 133, 'purple', 1),
	(46, 133, 'teal', 1),
	(47, 133, 'pink', 1),
	(48, 133, 'red', 1),
	(49, 135, 'green', 1),
	(50, 149, 'reindeer', 0),
	(51, 155, 'butterfly', 1),
	(52, 155, 'goldfish', 1),
	(53, 156, 'frostmage', 0),
	(54, 156, 'brokenhear', 0),
	(55, 156, 'snowman', 0),
	(56, 156, 'gobble', 0),
	(57, 156, 'nightbefor', 0),
	(58, 156, 'threecorne', 0),
	(59, 156, 'medal', 0),
	(60, 156, 'backtoscho', 0),
	(61, 156, 'groom', 0),
	(62, 156, 'bride', 0),
	(63, 156, 'jackolante', 0),
	(64, 156, 'graduation', 0),
	(65, 156, 'fairfun', 0),
	(66, 156, 'superflora', 0),
	(67, 156, 'blue', 0),
	(68, 156, 'pink', 0),
	(69, 156, 'yarrr', 0),
	(70, 156, 'nyao', 0),
	(71, 162, 'hanukkah', 0),
	(72, 170, 'aqua', 1),
	(73, 170, 'cream', 1),
	(74, 170, 'gold', 1),
	(75, 170, 'silver', 1),
	(76, 170, 'purple', 1),
	(77, 170, 'zebra', 1),
	(78, 170, 'tiger', 1),
	(79, 170, 'cheetah', 1),
	(80, 170, 'curacao', 1),
	(81, 170, 'orchid', 1),
	(82, 170, 'yellow', 1),
	(83, 170, 'tan', 1),
	(84, 170, 'green', 1),
	(85, 170, 'orange', 1),
	(86, 170, 'pink', 1),
	(87, 170, 'dawn', 1),
	(88, 170, 'seafoam', 1),
	(89, 170, 'peep', 1),
	(90, 170, 'cocoa', 1),
	(91, 170, 'friends', 1),
	(92, 170, 'blue', 1),
	(93, 176, 'blue', 1),
	(94, 176, 'yellow', 1),
	(95, 176, 'purple', 1),
	(96, 176, 'red', 1),
	(97, 191, 'yellow', 1),
	(98, 191, 'green', 1),
	(99, 191, 'cocoa', 1),
	(100, 191, 'cream', 1),
	(101, 191, 'treat', 1),
	(102, 45, 'rotate', 0),
	(103, 34, 'dragonbot', 0),
	(104, 38, 'partay', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
