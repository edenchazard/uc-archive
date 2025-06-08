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

-- Dumping data for table uc_archive.items: ~16 rows (approximately)
INSERT IGNORE INTO `items` (`id`, `slug`, `name`, `description`) VALUES
	(1, 'male-gen-x', 'Male Gen-X', NULL),
	(2, 'female-gen-x', 'Female Gen-X', NULL),
	(12, 'cryogenic-freeze-spray', 'Cryogenic Freeze Spray', 'This cyrogenic freeze spray will freeze a creature or egg in its current form. It cannot evolve, be trained, use the Arena, be used in accomplishments, or count toward your egg limit.'),
	(23, 'mystery-box', 'Mystery Box', NULL),
	(25, 'time-warp-watch', 'Time Warp Watch', NULL),
	(26, 'story-parchment', 'Story Parchment', NULL),
	(29, 'component-bag', 'Component Bag', NULL),
	(33, 'elixir-of-nobility', 'Elixir of Nobility', 'The Elixir of Nobility will rebirth a creature with 500 or more care points as a noble!'),
	(34, 'elixir-of-exaltation', 'Elixir of Exaltation', 'The Elixir of Exalted will rebirth a noble creature with 1,000 or more care points as an exalted!'),
	(35, 'normalize-potion', 'Normalize Potion', NULL),
	(36, 'defrosting-torch', 'Defrosting Torch', NULL),
	(37, 'refresh-potion', 'Refresh Potion', NULL),
	(38, 'vigor-potion', 'Vigor Potion', NULL),
	(39, 'moxie-potion', 'Moxie Potion', NULL),
	(40, 'vitality-potion', 'Vitality Potion', NULL),
	(41, 'profession-scroll', 'Profession Scroll', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
