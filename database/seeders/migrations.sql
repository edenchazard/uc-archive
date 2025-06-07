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

-- Dumping data for table uc_archive.migrations: ~2 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_05_06_0_create_consumables_table', 1),
	(6, '2023_05_06_1_create_families_table', 1),
	(7, '2023_05_06_2_create_alts_table', 1),
	(8, '2023_05_06_3_create_creatures_table', 1),
	(9, '2023_05_08_211434_create_training_options_table', 1),
	(10, '2023_05_12_171102_create_user_pets_table', 1),
	(11, '2025_05_25_132153_stringify_elements', 1),
	(12, '2025_05_25_135829_stringify_unique_rating', 1),
	(13, '2025_05_25_232332_add_slugs', 1),
	(14, '2025_05_26_104810_json_max_stats', 1),
	(15, '2025_05_26_110406_json_base_stats', 1),
	(16, '2025_05_26_164556_add_exploration_areas', 1),
	(17, '2025_05_26_185821_add_exploration_stories', 1),
	(18, '2025_05_31_161543_migrate_to_exploration_stories_creatures', 1),
	(19, '2025_06_06_214746_create_shop_transactions', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
