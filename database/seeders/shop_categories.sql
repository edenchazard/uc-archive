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

-- Dumping data for table uc_archive.shop_categories: ~0 rows (approximately)
INSERT IGNORE INTO `shop_categories` (`id`, `title`, `slug`, `description`) VALUES
	(1, 'Items', 'items', 'So you\'d like to transmute something? Sure! What would you like?'),
	(2, 'Rare Components', 'rare-components', 'So you\'d like to transmute something? Sure! What would you like?'),
	(3, 'Materials', 'materials', NULL),
	(4, 'Potions', 'potions', NULL),
	(5, 'Eggs', 'eggs', NULL),
	(6, 'Dendros', 'dendros', NULL),
	(7, 'Elementals', 'elementals', 'These rare eggs seem to harness the power of the elements, and I\'d only wish to give these to the most experienced of caretakers.'),
	(8, 'Elements', 'elements', NULL),
	(9, 'Shop', 'shop', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
