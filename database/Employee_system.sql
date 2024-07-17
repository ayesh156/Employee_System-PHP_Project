-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.29 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for employee_system
CREATE DATABASE IF NOT EXISTS `employee_system` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `employee_system`;

-- Dumping structure for table employee_system.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `varification_code` varchar(20) DEFAULT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_admin_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_admin_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.admin: ~1 rows (approximately)
INSERT INTO `admin` (`email`, `password`, `varification_code`, `gender_id`) VALUES
	('sdachathuranga@gmail.com', 'ayesh531', '6424298a98623', 1);

-- Dumping structure for table employee_system.admin_details
CREATE TABLE IF NOT EXISTS `admin_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `admin_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_admin_details_admin_idx` (`admin_email`),
  CONSTRAINT `fk_admin_details_admin` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.admin_details: ~1 rows (approximately)
INSERT INTO `admin_details` (`id`, `first_name`, `last_name`, `birthday`, `mobile`, `admin_email`) VALUES
	(1, 'Ayesh', 'Chathuranga', '2001-02-28', '0768484001', 'sdachathuranga@gmail.com');

-- Dumping structure for table employee_system.admin_image
CREATE TABLE IF NOT EXISTS `admin_image` (
  `path` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_admin_image_admin1_idx` (`admin_email`),
  CONSTRAINT `fk_admin_image_admin1` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.admin_image: ~1 rows (approximately)
INSERT INTO `admin_image` (`path`, `admin_email`) VALUES
	('../assets/images/admin_img/Ayesh_6425200680792.png', 'sdachathuranga@gmail.com');

-- Dumping structure for table employee_system.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.district: ~6 rows (approximately)
INSERT INTO `district` (`id`, `district`) VALUES
	(1, 'Colombo'),
	(2, 'Matara'),
	(3, 'Gampaha'),
	(4, 'Kaluthara'),
	(5, 'Kurunegala'),
	(6, 'Galle'),
	(7, 'Kandy');

-- Dumping structure for table employee_system.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table employee_system.option
CREATE TABLE IF NOT EXISTS `option` (
  `id` int NOT NULL AUTO_INCREMENT,
  `option` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.option: ~2 rows (approximately)
INSERT INTO `option` (`id`, `option`) VALUES
	(1, 'block'),
	(2, 'unblock');

-- Dumping structure for table employee_system.position
CREATE TABLE IF NOT EXISTS `position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.position: ~2 rows (approximately)
INSERT INTO `position` (`id`, `position`) VALUES
	(1, 'Head'),
	(2, 'Employee');

-- Dumping structure for table employee_system.project
CREATE TABLE IF NOT EXISTS `project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text,
  `res_path` varchar(100) DEFAULT NULL,
  `project_type_id` int NOT NULL,
  `status_id` int NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_project_type1_idx` (`project_type_id`),
  KEY `fk_project_status1_idx` (`status_id`),
  KEY `fk_project_staff1_idx` (`staff_email`),
  CONSTRAINT `fk_project_project_type1` FOREIGN KEY (`project_type_id`) REFERENCES `project_type` (`id`),
  CONSTRAINT `fk_project_staff1` FOREIGN KEY (`staff_email`) REFERENCES `staff` (`email`),
  CONSTRAINT `fk_project_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.project: ~2 rows (approximately)
INSERT INTO `project` (`id`, `name`, `start_date`, `end_date`, `description`, `res_path`, `project_type_id`, `status_id`, `staff_email`) VALUES
	(1, 'Library', '2023-01-27', '2023-03-30', 'Create Book Web Site', '../assets/src/Project_resources/Library_6422f70f6189f.zip', 2, 3, 'sdachathuranga@gmail.com'),
	(2, 'Ecommerce', '2023-02-28', '2023-03-27', 'Create Ecommerce Web site', '../assets/src/Project_resources/wp_project3.zip', 2, 2, 'sdachathuranga@gmail.com'),
	(10, 'School Library', '2023-03-30', '2023-04-15', 'Create School Library App', '../assets/src/Project_resources/School Library_642524a7cebb6.zip', 3, 2, 'thisara@gmail.com'),
	(11, 'Tea Shop', '2023-03-01', '2023-03-24', 'Create Web site for tea shop', '../assets/src/Project_resources/Tea Shop_642526c0d3359.zip', 1, 3, 'thisara@gmail.com'),
	(12, 'Car Race', '2023-03-01', '2023-04-28', 'Create Car game', '../assets/src/Project_resources/Car Race_642528688cad0.zip', 6, 2, 'sachindu@gmail.com'),
	(13, 'Student system', '2023-03-28', '2023-04-29', 'Create Student management system', '../assets/src/Project_resources/Student system_6425854ec3de9.zip', 1, 2, 'eshara@gmail.com'),
	(14, 'Travel Agents', '2023-03-30', '2023-04-11', 'Create website for Travel agency', '../assets/src/Project_resources/Travel Agents_6425dc3503159.zip', 2, 1, 'thisara@gmail.com');

-- Dumping structure for table employee_system.project_type
CREATE TABLE IF NOT EXISTS `project_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.project_type: ~3 rows (approximately)
INSERT INTO `project_type` (`id`, `name`, `description`) VALUES
	(1, 'Software', 'Software Projects'),
	(2, 'Website', 'Website Project'),
	(3, 'App', 'Mobile Application'),
	(6, 'Game', 'PC Games');

-- Dumping structure for table employee_system.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rate` int DEFAULT NULL,
  `comment` text,
  `date` date DEFAULT NULL,
  `uploaded_project_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_review_uploaded_project1_idx` (`uploaded_project_id`),
  CONSTRAINT `fk_review_uploaded_project1` FOREIGN KEY (`uploaded_project_id`) REFERENCES `uploaded_project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.review: ~4 rows (approximately)
INSERT INTO `review` (`id`, `rate`, `comment`, `date`, `uploaded_project_id`) VALUES
	(1, 5, 'Good', '2023-03-27', 1),
	(2, 4, 'Nice', '2023-03-28', 2),
	(3, 4, 'Good', '2023-03-29', 1),
	(4, 4, 'Super', '2023-03-29', 2),
	(5, 4, 'Well done.', '2023-03-29', 5),
	(6, 5, 'Good Project', '2023-03-30', 5),
	(7, 5, 'Great Job', '2023-03-30', 7),
	(8, 4, 'Well done. This is greate.', '2023-03-30', 8);

-- Dumping structure for table employee_system.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `email` varchar(100) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `varification_code` varchar(20) DEFAULT NULL,
  `gender_id` int NOT NULL,
  `position_id` int NOT NULL,
  `option_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_staff_gender1_idx` (`gender_id`),
  KEY `fk_staff_position1_idx` (`position_id`),
  KEY `fk_staff_option1_idx` (`option_id`),
  CONSTRAINT `fk_staff_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_staff_option1` FOREIGN KEY (`option_id`) REFERENCES `option` (`id`),
  CONSTRAINT `fk_staff_position1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.staff: ~2 rows (approximately)
INSERT INTO `staff` (`email`, `password`, `varification_code`, `gender_id`, `position_id`, `option_id`) VALUES
	('eshara@gmail.com', 'eshara157', NULL, 1, 2, 2),
	('sachindu@gmail.com', 'sachindu123', NULL, 1, 2, 2),
	('sdachathuranga@gmail.com', 'ayesh531', '64253eb8ec176', 1, 1, 2),
	('thisara@gmail.com', 'thisara123', NULL, 1, 2, 2);

-- Dumping structure for table employee_system.staff_details
CREATE TABLE IF NOT EXISTS `staff_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `address_line1` text,
  `address_line2` text,
  `district_id` int NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_details_district1_idx` (`district_id`),
  KEY `fk_staff_details_staff1_idx` (`staff_email`),
  CONSTRAINT `fk_staff_details_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`),
  CONSTRAINT `fk_staff_details_staff1` FOREIGN KEY (`staff_email`) REFERENCES `staff` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.staff_details: ~2 rows (approximately)
INSERT INTO `staff_details` (`id`, `first_name`, `last_name`, `birthday`, `mobile`, `address_line1`, `address_line2`, `district_id`, `staff_email`) VALUES
	(1, 'Ayesh', 'Chathuranga', '2001-02-28', '0712345678', 'Rukmalgahahena', 'Diddenipotha', 2, 'sdachathuranga@gmail.com'),
	(4, 'Thisara', 'Lakshan', '2023-03-11', '0712345689', 'Hikkotawaththa', 'Makandura', 6, 'thisara@gmail.com'),
	(5, 'Eshara', 'Ranaveera', '2001-03-08', '0761234587', 'Ellawela', 'Horapawita', 2, 'eshara@gmail.com'),
	(6, 'Chamika', 'Sachindu', '2001-02-08', '0779874163', 'Uthuruhandiya', 'Makandura', 1, 'sachindu@gmail.com');

-- Dumping structure for table employee_system.staff_image
CREATE TABLE IF NOT EXISTS `staff_image` (
  `path` varchar(100) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_staff_image_staff1_idx` (`staff_email`),
  CONSTRAINT `fk_staff_image_staff1` FOREIGN KEY (`staff_email`) REFERENCES `staff` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.staff_image: ~2 rows (approximately)
INSERT INTO `staff_image` (`path`, `staff_email`) VALUES
	('../assets/images/staff_img/Eshara_64252278e56e7.png', 'eshara@gmail.com'),
	('../assets/images/staff_img/Chamika_6425280b59a9a.png', 'sachindu@gmail.com'),
	('../assets/images/staff_img/Ayesh_64256718175f8.jpeg', 'sdachathuranga@gmail.com'),
	('../assets/images/staff_img/Thisara_6425267aab127.png', 'thisara@gmail.com');

-- Dumping structure for table employee_system.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.status: ~2 rows (approximately)
INSERT INTO `status` (`id`, `status`) VALUES
	(1, 'Pending'),
	(2, 'Done'),
	(3, 'Reject');

-- Dumping structure for table employee_system.uploaded_project
CREATE TABLE IF NOT EXISTS `uploaded_project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(100) DEFAULT NULL,
  `date_uploaded` date DEFAULT NULL,
  `description` text,
  `project_id` int NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_uploaded_project_project1_idx` (`project_id`),
  KEY `fk_uploaded_project_staff1_idx` (`staff_email`),
  CONSTRAINT `fk_uploaded_project_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  CONSTRAINT `fk_uploaded_project_staff1` FOREIGN KEY (`staff_email`) REFERENCES `staff` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table employee_system.uploaded_project: ~2 rows (approximately)
INSERT INTO `uploaded_project` (`id`, `path`, `date_uploaded`, `description`, `project_id`, `staff_email`) VALUES
	(1, '../assets/src/Upload_projects/wp-clone-main.zip', '2023-03-29', 'This is my Project', 1, 'sdachathuranga@gmail.com'),
	(2, '../assets/src/Project_resources/Ecommerce_64257f2eb0246.zip', '2023-03-30', 'Updated', 2, 'sdachathuranga@gmail.com'),
	(5, '../assets/src/Upload_projects/School Library_642rewcebb6.zip', '2023-03-30', 'This is completed Project', 10, 'thisara@gmail.com'),
	(7, '../assets/src/Upload_projects/Car Race_64258313548ec.zip', '2023-03-30', 'This is completed car project.', 12, 'sachindu@gmail.com'),
	(8, '../assets/src/Upload_projects/Student system_64258649990c9.zip', '2023-03-30', 'This is student system', 13, 'eshara@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
