-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.32 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for arduino_db
CREATE DATABASE IF NOT EXISTS `arduino_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `arduino_db`;

-- Dumping structure for table arduino_db.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `banner_id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.banners: ~3 rows (approximately)
INSERT INTO `banners` (`banner_id`, `path`, `type`) VALUES
	(2, 'resources/banners/66a877e903798_33a02338-9d02-44a4-9e82-1b7a00301950.webp', 'banner'),
	(3, 'resources/banners/66a877f3dc10c_cdd56f18-8841-4a24-907d-b080e8d274bf.webp', 'banner'),
	(6, 'resources/banners/66a8824dcf3f5_57039006-e6da-41b9-8b9c-5f59ec590cd5.webp', 'banner');

-- Dumping structure for table arduino_db.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) NOT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.brand: ~6 rows (approximately)
INSERT INTO `brand` (`brand_id`, `brand_name`, `status`) VALUES
	(1, 'Arduino', 1),
	(2, 'MicroBit', 1),
	(3, 'Orange Pi', 1),
	(4, 'Raspbery Pi', 1),
	(5, 'Magic Bit', 1),
	(6, '-', 1);

-- Dumping structure for table arduino_db.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stock_id` int NOT NULL,
  `user_id` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_stock1_idx` (`stock_id`),
  KEY `fk_cart_user1_idx` (`user_id`),
  CONSTRAINT `fk_cart_stock1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.cart: ~0 rows (approximately)
INSERT INTO `cart` (`id`, `stock_id`, `user_id`, `qty`) VALUES
	(12, 15, 5, 1),
	(20, 14, 3, 1);

-- Dumping structure for table arduino_db.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) NOT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.category: ~10 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`, `status`) VALUES
	(1, 'Sensors', 1),
	(2, 'Development Boards', 1),
	(3, 'Robotics', 1),
	(4, 'Battery & Accessories', 1),
	(5, 'Cables & Accessories', 1),
	(6, 'Motors and Gears', 1),
	(7, 'Shields & Modules', 1),
	(8, 'Rc Hobbies', 1),
	(9, 'Arduino Compatible', 1),
	(10, 'Special Items', 1);

-- Dumping structure for table arduino_db.customer_questions
CREATE TABLE IF NOT EXISTS `customer_questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.customer_questions: ~2 rows (approximately)
INSERT INTO `customer_questions` (`id`, `f_name`, `l_name`, `email`, `message`, `datetime`) VALUES
	(3, 'sdfsdfsd', 'fsdfsdfds', 'Sashikaw08@gmail.com', 'sdfsdfsdfsdfsdfdf', '2024-07-27 14:46:26'),
	(4, 'hjggfffg', 'sdfsefefe', 'bhagya@gmail.com', 'sfdsfsdfsdfdfdf', '2024-07-27 14:46:43');

-- Dumping structure for table arduino_db.destrict
CREATE TABLE IF NOT EXISTS `destrict` (
  `destrict_id` int NOT NULL AUTO_INCREMENT,
  `destict_name` varchar(45) NOT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`destrict_id`),
  KEY `fk_destrict_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_destrict_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.destrict: ~2 rows (approximately)
INSERT INTO `destrict` (`destrict_id`, `destict_name`, `province_province_id`) VALUES
	(1, 'Kandy', 1),
	(2, 'Anuradhapura', 2);

-- Dumping structure for table arduino_db.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feed_id` int NOT NULL AUTO_INCREMENT,
  `rating` int NOT NULL,
  `date` datetime DEFAULT NULL,
  `feedback` varchar(250) DEFAULT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`feed_id`),
  KEY `fk_feedback_user1_idx` (`user_id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.feedback: ~3 rows (approximately)
INSERT INTO `feedback` (`feed_id`, `rating`, `date`, `feedback`, `user_id`, `product_id`, `status`) VALUES
	(3, 5, '2024-07-25 13:16:20', 'aaaaaaaaaaaaa', 3, 12, 1),
	(4, 5, '2024-07-25 13:25:49', 'Great Product. Working Perfectly. #WIN', 3, 13, 1),
	(5, 5, '2024-07-29 19:35:21', 'Great Product. Customer Service is excellent. Product is working perfect too. #WIN', 5, 13, 1);

-- Dumping structure for table arduino_db.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  `date_time` datetime NOT NULL,
  `total` double NOT NULL,
  `order_status` int NOT NULL,
  `delivery_fee` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_user1_idx` (`user_id`),
  KEY `fk_invoice_order_status1_idx` (`order_status`),
  CONSTRAINT `fk_invoice_order_status1` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`status_id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.invoice: ~14 rows (approximately)
INSERT INTO `invoice` (`id`, `invoice_id`, `user_id`, `date_time`, `total`, `order_status`, `delivery_fee`) VALUES
	(5, '66a0c36a160a6', 3, '2024-07-24 14:33:59', 20400, 4, 300),
	(9, '66a0ebb72435f', 3, '2024-07-24 17:25:57', 6800, 2, 300),
	(11, '66a799cae4617', 3, '2024-07-29 19:02:15', 10200, 1, 300),
	(12, '66a79f414d411', 5, '2024-07-29 19:25:33', 1800, 1, 300),
	(13, '66a7b5969ca6a', 5, '2024-07-29 21:00:50', 10800, 3, 300),
	(14, '66a85d8692de8', 3, '2024-07-30 08:57:21', 7100, 1, 300),
	(15, '66a9dc0e0c9ed', 3, '2024-07-31 12:09:32', 7100, 1, 300),
	(21, '66a9e3092a058', 3, '2024-07-31 12:39:21', 1800, 4, 300),
	(22, '66a9e3cd8964f', 3, '2024-07-31 12:42:30', 7100, 3, 300),
	(23, '66aa2f4a09ffe', 3, '2024-07-31 18:04:39', 3700, 3, 300),
	(24, '66aa3084f196b', 5, '2024-07-31 18:09:57', 3700, 2, 300),
	(28, '66ab162667683', 3, '2024-08-01 10:31:13', 2000, 1, 300),
	(29, '66b867d16a845', 3, '2024-08-11 12:57:45', 4200, 1, 400),
	(30, '66b8684c37465', 3, '2024-08-11 12:59:39', 26050, 1, 400);

-- Dumping structure for table arduino_db.invoice_items
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `stock_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  `invoice_id` int NOT NULL,
  KEY `fk_invoice_items_stock1_idx` (`stock_id`),
  KEY `fk_invoice_items_invoice1_idx` (`invoice_id`),
  CONSTRAINT `fk_invoice_items_invoice1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  CONSTRAINT `fk_invoice_items_stock1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.invoice_items: ~17 rows (approximately)
INSERT INTO `invoice_items` (`stock_id`, `qty`, `price`, `invoice_id`) VALUES
	(10, 4, 3400, 5),
	(14, 1, 6500, 5),
	(15, 1, 1500, 9),
	(14, 1, 6500, 11),
	(12, 1, 3400, 11),
	(15, 1, 1500, 12),
	(17, 5, 2100, 13),
	(12, 2, 3400, 14),
	(6, 2, 3400, 15),
	(15, 1, 1500, 21),
	(6, 2, 3400, 22),
	(12, 1, 3400, 23),
	(6, 1, 3400, 24),
	(21, 1, 2000, 28),
	(17, 1, 2100, 29),
	(21, 1, 2000, 29),
	(19, 1, 27000, 30);

-- Dumping structure for table arduino_db.message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `sender` int NOT NULL,
  `receiver` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_message_user1_idx` (`sender`),
  KEY `fk_message_user2_idx` (`receiver`),
  CONSTRAINT `fk_message_user1` FOREIGN KEY (`sender`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_message_user2` FOREIGN KEY (`receiver`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.message: ~12 rows (approximately)
INSERT INTO `message` (`id`, `message`, `timestamp`, `sender`, `receiver`, `status`) VALUES
	(84, 'Hi', '2024-08-01 11:57:54', 3, 1, 1),
	(85, 'Can I Know details about a product?', '2024-08-01 11:58:26', 3, 1, 1),
	(86, 'Hi, NIce to meet you', '2024-08-01 11:59:13', 1, 3, 1),
	(87, 'Can i know the name of the product you are looking for', '2024-08-01 12:00:00', 1, 3, 1),
	(88, 'yes i need to know about the : Arduino Student Kit', '2024-08-01 12:00:47', 3, 1, 1),
	(89, 'sdfdsfdf', '2024-08-01 12:03:41', 8, 1, 1),
	(90, 'dsfsdfsdf', '2024-08-01 12:04:00', 5, 1, 1),
	(91, 'dfsdfsdfgeg', '2024-08-01 12:04:11', 4, 1, 1),
	(92, 'sdfsdfsdfd', '2024-08-01 12:04:30', 6, 1, 1),
	(93, 'Yes We have that product in stock', '2024-08-01 12:05:20', 1, 3, 1),
	(95, 'Hello', '2024-08-11 08:04:42', 3, 1, 1),
	(96, 'Hi', '2024-08-11 08:04:58', 1, 3, 1);

-- Dumping structure for table arduino_db.order_address
CREATE TABLE IF NOT EXISTS `order_address` (
  `order_address_id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int NOT NULL,
  `no` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `postal_code` int NOT NULL,
  `city` varchar(45) NOT NULL,
  `destrict_destrict_id` int NOT NULL,
  PRIMARY KEY (`order_address_id`),
  KEY `fk_order_address_invoice1_idx` (`invoice_id`),
  KEY `fk_order_address_destrict1_idx` (`destrict_destrict_id`),
  CONSTRAINT `fk_order_address_destrict1` FOREIGN KEY (`destrict_destrict_id`) REFERENCES `destrict` (`destrict_id`),
  CONSTRAINT `fk_order_address_invoice1` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.order_address: ~8 rows (approximately)
INSERT INTO `order_address` (`order_address_id`, `invoice_id`, `no`, `address`, `postal_code`, `city`, `destrict_destrict_id`) VALUES
	(1, 14, '12', 'asffsfd', 123456, 'xvcxvxcvc', 1),
	(3, 21, '1/3', 'Maberiya Junction, Digana,Rajawella.', 123555, 'Anuradhapura', 1),
	(4, 22, '1/3', 'Maberiya Junction, Digana,Rajawella.', 123555, 'Anuradhapura', 1),
	(5, 23, '1/3', 'Maberiya Junction, Digana,Rajawella.', 123555, 'Anuradhapura', 1),
	(6, 24, '12/5', 'Digana Village Kengalla', 20180, 'Kandy', 1),
	(10, 28, '1/3', 'Maberiya Junction, Digana,Rajawella.', 123555, 'Anuradhapura', 1),
	(11, 29, '2556/B', 'Group B ', 123555, 'Anuradhapura', 2),
	(12, 30, '2556/B', 'Group B ', 123555, 'Anuradhapura', 2);

-- Dumping structure for table arduino_db.order_status
CREATE TABLE IF NOT EXISTS `order_status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(45) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.order_status: ~4 rows (approximately)
INSERT INTO `order_status` (`status_id`, `status_name`) VALUES
	(1, 'Order Confirmed'),
	(2, 'Preparing Order'),
	(3, 'Shipped'),
	(4, 'Received To Customer');

-- Dumping structure for table arduino_db.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `datetime_added` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `cat_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`cat_id`),
  KEY `fk_product_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_product_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.product: ~12 rows (approximately)
INSERT INTO `product` (`id`, `name`, `datetime_added`, `status`, `cat_id`, `brand_id`, `description`) VALUES
	(6, 'Arduino® UNO R4 Minima', '2024-07-15 09:13:02', 1, 2, 1, 'Introducing the Arduino UNO R4 Minima! This board boasts the RA4M1 microprocessor from Renesas, delivering increased processing power, expanded memory, and additional peripherals. And the best part? It stays true to the reliable UNO form factor and operates at a practical 5 V voltage. Brace yourself for an upgrade like no other with the Arduino UNO R4 Minima!'),
	(8, 'Arduino Nano Matter', '2024-07-15 18:30:11', 1, 2, 1, 'The Arduino Nano Matter stems from a partnership between Arduino and Silicon Labs® to make Matter®, one of the most popular IoT connectivity standards for smart home devices, accessible to all.'),
	(11, 'Gravity WiFi IoT Module', '2024-07-15 19:09:18', 1, 2, 1, 'This WiFi IoT module supports multiple programming platforms, such as MakeCode, Mind+, and Arduino IDE, and can also be used on various popular IoT platforms like Easy IoT, IFFTTT, ThingSpeak, SIoT.'),
	(12, 'Cicerone board', '2024-07-18 10:20:18', 1, 2, 1, 'Move-X Cicerone board is a high-performance, low-power, Arduino MKR compatible DVK board based on Move-X MAMWLE LoRa module and u-blox MAX-M10S GNSS module. This combination allows best-in-class GNSS, long-range wireless connections and high-performance MCU processing in a low-power solution for extreme battery life.'),
	(13, 'Grove - Alcohol Sensor', '2024-07-18 10:24:42', 1, 1, 1, 'A complete alcohol sensor module for Arduino.'),
	(15, 'Grove - Water Sensor', '2024-07-18 10:29:06', 1, 1, 1, 'The Water Sensor module indicates whether the sensor is dry, damp or completely immersed in water by measuring conductivity'),
	(16, 'Arduino Plug and Make Kit', '2024-08-01 09:34:46', 1, 10, 1, 'Go from zero to tech hero! The Plug and Make Kit is Arduino’s new “starter kit” experience: the perfect beginner-friendly way to spark a new passion for DIY electronics and get your first taste of technology. Designed to offer you cutting-edge hardware, intuitive software and powerful Cloud technology, this kit makes it incredibly easy to get started. Whether you’re a beginner or a seasoned maker, join us and let’s create something amazing together!'),
	(17, 'Arduino Science Kit R3', '2024-08-01 09:41:02', 1, 10, 1, 'The Arduino Science Kit R3 and Arduino Science Journal app introduce a completely new and engaging way to bring physics theories to life in your classroom. The all-in-one design offers multiple sensors and components. The kit helps transform abstract concepts into real-world applications. Students gain a deeper understanding of physics principles while having fun. Physics principles leap off the page into action through this innovative kit.'),
	(18, 'Arduino IoT Bundle', '2024-08-01 09:46:58', 1, 10, 1, 'The Arduino IoT Bundle is the best way to start exploring the world of connected devices using the Arduino Nano RP2040 Connect. Follow the 5 step by step tutorials to quickly learn how to build IoT devices.'),
	(19, 'Arduino Student Kit', '2024-08-01 09:49:19', 1, 10, 1, 'The Arduino Student Kit is a hands-on, step-by-step remote learning tool for ages 11+: get started with the basics of electronics, programming, and coding at home. No prior knowledge or experience is necessary as the kit guides you through step by step. Educators can teach their class remotely using the kits, and parents can use the kit as a homeschool tool for their child to learn at their own pace. Everyone will gain confidence in programming and electronics with guided lessons and open experimentation.'),
	(20, 'TS400 Large Metal 4WD Robot Tank Chassis Kit', '2024-08-01 10:02:49', 1, 3, 6, 'The TS400 tank chassis is made of all metal and is very strong and beautiful.\r\nThe independent shock-absorbing system makes the chassis run smoothly even on uneven road surfaces;\r\nEquipped with 4 high-torque motors, the chassis can move forward and backwards, turn left and turn right, and turn around;\r\nThe chassis panel provides ample space for mounting robots and control kits and has a large development space.'),
	(21, 'Obstacle Avoidance Smart Robot', '2024-08-01 10:05:14', 1, 3, 6, 'Obstacle Avoidance Smart Robot');

-- Dumping structure for view arduino_db.product_details
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `product_details` (
	`id` INT(10) NOT NULL,
	`name` VARCHAR(100) NOT NULL COLLATE 'utf8mb3_general_ci',
	`description` TEXT NOT NULL COLLATE 'utf8mb3_general_ci',
	`cat_id` INT(10) NOT NULL,
	`cat_name` VARCHAR(45) NOT NULL COLLATE 'utf8mb3_general_ci',
	`brand_id` INT(10) NOT NULL,
	`brand_name` VARCHAR(45) NOT NULL COLLATE 'utf8mb3_general_ci',
	`status` INT(10) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for table arduino_db.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `product_id` int NOT NULL,
  `img_path` varchar(100) NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.product_img: ~33 rows (approximately)
INSERT INTO `product_img` (`product_id`, `img_path`) VALUES
	(6, 'resources//product_images//Arduino® UNO R4 Minima_0_669527e8846e5.png'),
	(6, 'resources//product_images//Arduino® UNO R4 Minima_1_669527e885c93.png'),
	(6, 'resources//product_images//Arduino® UNO R4 Minima_2_669527e88764b.png'),
	(8, 'resources//product_images//Arduino Nano Matter_0_6695281281ebd.png'),
	(8, 'resources//product_images//Arduino Nano Matter_1_6695281282f55.png'),
	(8, 'resources//product_images//Arduino Nano Matter_2_6695281283e47.png'),
	(11, 'resources//product_images//Gravity WiFi IoT Module_0_66952bd134c1c.png'),
	(11, 'resources//product_images//Gravity WiFi IoT Module_1_66952bd1364b8.png'),
	(11, 'resources//product_images//Gravity WiFi IoT Module_2_66952bd137b0a.png'),
	(12, 'resources//product_images//Cicerone board_0_66989f0ab70a2.png'),
	(12, 'resources//product_images//Cicerone board_1_66989f0ab840c.png'),
	(12, 'resources//product_images//Cicerone board_2_66989f0ab9623.png'),
	(13, 'resources//product_images//Grove - Alcohol Sensor_0_6698a0121ba2e.png'),
	(13, 'resources//product_images//Grove - Alcohol Sensor_1_6698a0121d570.png'),
	(15, 'resources//product_images//Grove - Water Sensor_0_6698a11aad23b.png'),
	(15, 'resources//product_images//Grove - Water Sensor_1_6698a11aaedcb.png'),
	(16, 'resources//product_images//Arduino Plug and Make Kit_0_66ab095ec4a11.webp'),
	(16, 'resources//product_images//Arduino Plug and Make Kit_1_66ab095ec640a.webp'),
	(16, 'resources//product_images//Arduino Plug and Make Kit_2_66ab095ec7a68.webp'),
	(17, 'resources//product_images//Arduino Science Kit R3_0_66ab0ad62f544.webp'),
	(17, 'resources//product_images//Arduino Science Kit R3_1_66ab0ad6303e4.webp'),
	(17, 'resources//product_images//Arduino Science Kit R3_2_66ab0ad63138c.webp'),
	(18, 'resources//product_images//Arduino IoT Bundle_0_66ab0c3ad8993.webp'),
	(18, 'resources//product_images//Arduino IoT Bundle_1_66ab0c3ad9897.webp'),
	(18, 'resources//product_images//Arduino IoT Bundle_2_66ab0c3ada93b.webp'),
	(19, 'resources//product_images//Arduino Student Kit_0_66ab0cc78e4e3.webp'),
	(19, 'resources//product_images//Arduino Student Kit_1_66ab0cc78f76f.webp'),
	(19, 'resources//product_images//Arduino Student Kit_2_66ab0cc790a33.webp'),
	(20, 'resources//product_images//TS400 Large Metal 4WD Robot Tank Chassis Kit_0_66ab0ff1a6f6f.jpeg'),
	(20, 'resources//product_images//TS400 Large Metal 4WD Robot Tank Chassis Kit_1_66ab0ff1a7ec8.jpeg'),
	(20, 'resources//product_images//TS400 Large Metal 4WD Robot Tank Chassis Kit_2_66ab0ff1a8e08.jpeg'),
	(21, 'resources//product_images//Obstacle Avoidance Smart Robot_0_66ab10821b954.jpeg'),
	(21, 'resources//product_images//Obstacle Avoidance Smart Robot_1_66ab10821d013.jpeg');

-- Dumping structure for table arduino_db.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) NOT NULL,
  `delivery_fee` double NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.province: ~2 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`, `delivery_fee`) VALUES
	(1, 'Central Province', 300),
	(2, 'North Central Province', 400);

-- Dumping structure for table arduino_db.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `qty` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `product_id` int NOT NULL,
  `warenty` varchar(45) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock_product1_idx` (`product_id`),
  CONSTRAINT `fk_stock_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.stock: ~12 rows (approximately)
INSERT INTO `stock` (`id`, `price`, `qty`, `status`, `product_id`, `warenty`, `discount`) VALUES
	(6, 3400, 25, 1, 6, '1 month', '4'),
	(10, 3400, 25, 1, 8, '1 month', 'none'),
	(12, 3400, 18, 1, 11, 'none', '3'),
	(14, 6500, 26, 1, 12, 'none', 'none'),
	(15, 1500, 18, 1, 13, 'none', '10'),
	(17, 2100, 3, 1, 15, 'none', 'none'),
	(18, 25000, 15, 1, 16, '3', 'none'),
	(19, 27000, 29, 1, 17, '1 month', '5'),
	(20, 22000, 20, 1, 18, '1 month', 'none'),
	(21, 2000, 28, 1, 19, '1 month', '15'),
	(22, 5000, 30, 1, 20, 'none', 'none'),
	(23, 3400, 30, 1, 21, 'none', 'none');

-- Dumping structure for view arduino_db.stock_view
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `stock_view` (
	`stock_id` INT(10) NOT NULL,
	`product_id` INT(10) NOT NULL,
	`name` VARCHAR(100) NOT NULL COLLATE 'utf8mb3_general_ci',
	`description` TEXT NOT NULL COLLATE 'utf8mb3_general_ci',
	`cat_id` INT(10) NOT NULL,
	`cat_name` VARCHAR(45) NOT NULL COLLATE 'utf8mb3_general_ci',
	`brand_id` INT(10) NOT NULL,
	`brand_name` VARCHAR(45) NOT NULL COLLATE 'utf8mb3_general_ci',
	`status` INT(10) NOT NULL,
	`price` DOUBLE NOT NULL,
	`qty` INT(10) NOT NULL,
	`warenty` VARCHAR(45) NULL COLLATE 'utf8mb3_general_ci',
	`discount` VARCHAR(45) NULL COLLATE 'utf8mb3_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table arduino_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `vcode` varchar(100) DEFAULT NULL,
  `user_type_id` int NOT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_user_type_idx` (`user_type_id`),
  CONSTRAINT `fk_user_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.user: ~8 rows (approximately)
INSERT INTO `user` (`id`, `fname`, `lname`, `mobile`, `email`, `password`, `status`, `vcode`, `user_type_id`, `profile_pic`) VALUES
	(1, 'Thimira', 'Wassana', '0772259101', 'thimiraw3@gmail.com', '123', 1, '66b8b69d1ac81', 1, NULL),
	(3, 'Thimira', 'Wassana', '0777878649', 'bhagya@gmail.com', '12345', 1, NULL, 2, 'resources/profile_image/66b8687408d67_photo_2023-02-11_01-22-30.jpg'),
	(4, 'Sahan', 'Perera', '0777389764', 'sahan@gmail.com', '12345', 1, NULL, 2, NULL),
	(5, 'Osanda', 'Kalhara', '0777467986', 'osanda@gmail.com', '12345', 1, NULL, 2, 'resources/profile_image/66ab245c08d41_photo_2023-02-11_01-22-32.jpg'),
	(6, 'Thilina', 'Bandara', '0777467986', 'thilina@gmail.com', '12345', 1, NULL, 2, NULL),
	(7, 'Dileepa ', 'Ranaweera', '0772258756', 'dileepa@gmail.com', '12345', 1, NULL, 2, NULL),
	(8, 'Deneth', 'Senevirathne', '0777878956', 'deneth@gmail.com', '12345', 1, NULL, 2, NULL),
	(9, 'Kasun', 'Perera', '0777467945', 'kasunper@gmail.com', 'Kasun123', 1, NULL, 2, NULL);

-- Dumping structure for table arduino_db.user_address
CREATE TABLE IF NOT EXISTS `user_address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `no` varchar(45) DEFAULT NULL,
  `line1` text NOT NULL,
  `line2` text NOT NULL,
  `postal_code` int NOT NULL,
  `city` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  `destrict_destrict_id` int NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_address_user1_idx` (`user_id`),
  KEY `fk_user_address_destrict1_idx` (`destrict_destrict_id`),
  CONSTRAINT `fk_user_address_destrict1` FOREIGN KEY (`destrict_destrict_id`) REFERENCES `destrict` (`destrict_id`),
  CONSTRAINT `fk_user_address_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.user_address: ~2 rows (approximately)
INSERT INTO `user_address` (`address_id`, `no`, `line1`, `line2`, `postal_code`, `city`, `user_id`, `destrict_destrict_id`) VALUES
	(1, '2556/B', 'Group B', '', 123555, 'Anuradhapura', 3, 2),
	(2, '12/5', 'Digana Village', 'Kengalla', 20180, 'Kandy', 5, 1);

-- Dumping structure for table arduino_db.user_type
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.user_type: ~2 rows (approximately)
INSERT INTO `user_type` (`id`, `name`) VALUES
	(1, 'Admin'),
	(2, 'User');

-- Dumping structure for table arduino_db.wishlist
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stock_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wishlist_stock1_idx` (`stock_id`),
  KEY `fk_wishlist_user1_idx` (`user_id`),
  CONSTRAINT `fk_wishlist_stock1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`),
  CONSTRAINT `fk_wishlist_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table arduino_db.wishlist: ~2 rows (approximately)
INSERT INTO `wishlist` (`id`, `stock_id`, `user_id`) VALUES
	(7, 10, 3),
	(9, 21, 3);

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `product_details`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `product_details` AS select `product`.`id` AS `id`,`product`.`name` AS `name`,`product`.`description` AS `description`,`category`.`cat_id` AS `cat_id`,`category`.`cat_name` AS `cat_name`,`brand`.`brand_id` AS `brand_id`,`brand`.`brand_name` AS `brand_name`,`product`.`status` AS `status` from ((`product` join `category` on((`product`.`cat_id` = `category`.`cat_id`))) join `brand` on((`product`.`brand_id` = `brand`.`brand_id`)));

-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `stock_view`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `stock_view` AS select `stock`.`id` AS `stock_id`,`product_details`.`id` AS `product_id`,`product_details`.`name` AS `name`,`product_details`.`description` AS `description`,`product_details`.`cat_id` AS `cat_id`,`product_details`.`cat_name` AS `cat_name`,`product_details`.`brand_id` AS `brand_id`,`product_details`.`brand_name` AS `brand_name`,`stock`.`status` AS `status`,`stock`.`price` AS `price`,`stock`.`qty` AS `qty`,`stock`.`warenty` AS `warenty`,`stock`.`discount` AS `discount` from (`stock` join `product_details` on((`stock`.`product_id` = `product_details`.`id`)));

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
