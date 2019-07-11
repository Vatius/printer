-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.41 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных printer
CREATE DATABASE IF NOT EXISTS `printer` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `printer`;

-- Дамп структуры для таблица printer.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `parts` text,
  PRIMARY KEY (`id`),
  KEY `idx-cart-order` (`order`),
  CONSTRAINT `fk-cart-order` FOREIGN KEY (`order`) REFERENCES `order` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы printer.cart: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`id`, `order`, `parts`) VALUES
	(5, 46, '["hp"]'),
	(6, 47, '["canon"]');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Дамп структуры для таблица printer.cartridge
CREATE TABLE IF NOT EXISTS `cartridge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text,
  `price` int(11) DEFAULT NULL,
  `printer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-cartridge-printer` (`printer`),
  CONSTRAINT `fk-cartridge-printer` FOREIGN KEY (`printer`) REFERENCES `printer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы printer.cartridge: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `cartridge` DISABLE KEYS */;
INSERT INTO `cartridge` (`id`, `article`, `price`, `printer`) VALUES
	(1, 'cnb', 390, 1),
	(2, 'cnbxl', 490, 1),
	(3, 'hpr', 390, 2),
	(4, 'hpb', 391, 2),
	(5, 'hpg', 392, 2),
	(6, 'phx', 393, 2);
/*!40000 ALTER TABLE `cartridge` ENABLE KEYS */;

-- Дамп структуры для таблица printer.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы printer.migration: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1562853450),
	('m190711_135804_create_order_table', 1562853941),
	('m190711_140732_create_printer_table', 1562854401),
	('m190711_140815_create_cartridge_table', 1562854401),
	('m190711_154126_create_cart_table', 1562859862);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица printer.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fio` text NOT NULL,
  `tel` text NOT NULL,
  `article` text NOT NULL,
  `sum` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы printer.order: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`id`, `fio`, `tel`, `article`, `sum`, `status`, `created_at`) VALUES
	(46, 'tester', '79121233223', 'hp', 2000, 1, '2019-07-11 20:35:07'),
	(47, 'Василий', '79121333223', 'canon', 1000, 2, '2019-07-11 20:35:47');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

-- Дамп структуры для таблица printer.printer
CREATE TABLE IF NOT EXISTS `printer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы printer.printer: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `printer` DISABLE KEYS */;
INSERT INTO `printer` (`id`, `article`, `price`) VALUES
	(1, 'canon', 1000),
	(2, 'hp', 2000),
	(3, 'xerox', 3000);
/*!40000 ALTER TABLE `printer` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
