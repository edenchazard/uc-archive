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

-- Dumping data for table uc_archive.consumables: ~36 rows (approximately)
INSERT IGNORE INTO `consumables` (`id`, `slug`, `name`, `type`) VALUES
	(1, 'ancientberry', 'Ancientberry', 'Rare Component'),
	(2, 'astralune', 'Astralune', 'Rare Component'),
	(3, 'auraglass', 'Auraglass', 'Standard'),
	(4, 'bluemaple', 'Bluemaple', 'Standard'),
	(5, 'echoberry', 'Echoberry', 'Standard'),
	(6, 'essentia', 'Essentia', 'Rare Component'),
	(7, 'heartwater', 'Heartwater', 'Standard'),
	(8, 'lifepowder', 'Lifepowder', 'Standard'),
	(9, 'meadowgem', 'Meadowgem', 'Standard'),
	(10, 'moonruby', 'Moonruby', 'Standard'),
	(11, 'riverstone', 'Riverstone', 'Standard'),
	(12, 'seamelon', 'Seamelon', 'Standard'),
	(13, 'skypollen', 'Skypollen', 'Standard'),
	(14, 'starweave', 'Starweave', 'Rare Component'),
	(15, 'sunnyseed', 'Sunnyseed', 'Standard'),
	(16, 'timeshard', 'Timeshard', 'Standard'),
	(17, 'treescent', 'Treescent', 'Standard'),
	(18, 'watervine', 'Watervine', 'Standard'),
	(19, 'whiteroot', 'Whiteroot', 'Standard'),
	(20, 'wood', 'Wood', 'Building Material'),
	(21, 'stone', 'Stone', 'Building Material'),
	(22, 'metal', 'Metal', 'Building Material'),
	(23, 'supplies', 'Supplies', 'Building Material'),
	(25, 'mystic-dew', 'Mystic Dew', 'Tree'),
	(26, 'gemstone', 'Gemstone', 'Tree'),
	(27, 'tree-seeds', 'Tree Seeds', 'Tree'),
	(28, 'spirit-stones', 'Spirit Stones', 'Tree'),
	(29, 'earth-orb', 'Earth Orb', 'Orb'),
	(30, 'fire-orb', 'Fire Orb', 'Orb'),
	(31, 'water-orb', 'Water Orb', 'Orb'),
	(32, 'wind-orb', 'Wind Orb', 'Orb'),
	(33, 'earth-shard', 'Earth Shard', 'Shard'),
	(34, 'fire-shard', 'Fire Shard', 'Shard'),
	(35, 'water-shard', 'Water Shard', 'Shard'),
	(36, 'wind-shard', 'Wind Shard', 'Shard'),
	(37, 'coins', 'Coins', 'Other');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
