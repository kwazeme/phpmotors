-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jul 14, 2022 at 09:14 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--
CREATE DATABASE IF NOT EXISTS `phpmotors` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `phpmotors`;

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

DROP TABLE IF EXISTS `carclassification`;
CREATE TABLE `carclassification` (
  `classificationId` int NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(14, 'Kingston'),
(47, 'off-road'),
(48, 'Antique');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `clientId` int UNSIGNED NOT NULL,
  `clientFirstname` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(17, 'Kwazeme', 'Ogubie', 'cooke@stove.com', '$2y$10$SH7CkH6s1/rhVB7qSLRp4.K.heKDuH7MXkCjF5RzL1YHPPoXDQ166', '1', NULL),
(22, 'Admin', 'UserNew', 'adminNew@cse340.net', '$2y$10$3QQaILPbieDuhBdYpLA6bOcUk/l.RFKaMSZ34pZoCu/GugQWFARC6', '3', NULL),
(23, 'Kwaze', 'User', 'me@gmail.com', '$2y$10$mhQePFqIBs9.wYHGxTPeyOx4Yz.YrHl6VOyRq0XTlYV/P2zNFwgBG', '1', NULL),
(24, 'Augustine', 'Ogubie', 'augustine@knisp.co.za', '$2y$10$iEYBqYnX5M5jAIqKWWI57.GZ0HL0cg1NdqD/9gE9Jz7aFfasRIwcW', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `ImgId` int NOT NULL,
  `invId` int NOT NULL,
  `imgName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgPath` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imgPrimary` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ImgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(15, 3, 'adventador.jpg', '/phpmotors/uploads/images/vehicles/adventador.jpg', '2022-06-30 13:35:27', 1),
(16, 3, 'adventador-tn.jpg', '/phpmotors/uploads/images/vehicles/adventador-tn.jpg', '2022-06-30 13:35:27', 1),
(17, 4, 'monster-truck.jpg', '/phpmotors/uploads/images/vehicles/monster-truck.jpg', '2022-06-30 13:36:21', 1),
(18, 4, 'monster-truck-tn.jpg', '/phpmotors/uploads/images/vehicles/monster-truck-tn.jpg', '2022-06-30 13:36:21', 1),
(21, 5, 'mechanic.jpg', '/phpmotors/uploads/images/vehicles/mechanic.jpg', '2022-06-30 13:37:37', 1),
(22, 5, 'mechanic-tn.jpg', '/phpmotors/uploads/images/vehicles/mechanic-tn.jpg', '2022-06-30 13:37:37', 1),
(23, 6, 'batmobile.jpg', '/phpmotors/uploads/images/vehicles/batmobile.jpg', '2022-06-30 13:37:59', 1),
(24, 6, 'batmobile-tn.jpg', '/phpmotors/uploads/images/vehicles/batmobile-tn.jpg', '2022-06-30 13:37:59', 1),
(25, 7, 'mystery-van.jpg', '/phpmotors/uploads/images/vehicles/mystery-van.jpg', '2022-06-30 13:39:06', 1),
(26, 7, 'mystery-van-tn.jpg', '/phpmotors/uploads/images/vehicles/mystery-van-tn.jpg', '2022-06-30 13:39:06', 1),
(27, 8, 'fire-truck.jpg', '/phpmotors/uploads/images/vehicles/fire-truck.jpg', '2022-06-30 13:39:32', 1),
(28, 8, 'fire-truck-tn.jpg', '/phpmotors/uploads/images/vehicles/fire-truck-tn.jpg', '2022-06-30 13:39:32', 1),
(29, 9, 'crwn-vic.jpg', '/phpmotors/uploads/images/vehicles/crwn-vic.jpg', '2022-06-30 13:40:14', 1),
(30, 9, 'crwn-vic-tn.jpg', '/phpmotors/uploads/images/vehicles/crwn-vic-tn.jpg', '2022-06-30 13:40:16', 1),
(31, 10, 'camaro.jpg', '/phpmotors/uploads/images/vehicles/camaro.jpg', '2022-06-30 13:40:36', 1),
(32, 10, 'camaro-tn.jpg', '/phpmotors/uploads/images/vehicles/camaro-tn.jpg', '2022-06-30 13:40:37', 1),
(33, 11, 'escalade.jpg', '/phpmotors/uploads/images/vehicles/escalade.jpg', '2022-06-30 13:40:59', 1),
(34, 11, 'escalade-tn.jpg', '/phpmotors/uploads/images/vehicles/escalade-tn.jpg', '2022-06-30 13:41:01', 1),
(35, 12, 'hummer.jpg', '/phpmotors/uploads/images/vehicles/hummer.jpg', '2022-06-30 13:41:46', 1),
(36, 12, 'hummer-tn.jpg', '/phpmotors/uploads/images/vehicles/hummer-tn.jpg', '2022-06-30 13:41:46', 1),
(37, 13, 'aerocar.jpg', '/phpmotors/uploads/images/vehicles/aerocar.jpg', '2022-06-30 13:42:16', 1),
(38, 13, 'aerocar-tn.jpg', '/phpmotors/uploads/images/vehicles/aerocar-tn.jpg', '2022-06-30 13:42:16', 1),
(39, 14, 'van.jpg', '/phpmotors/uploads/images/vehicles/van.jpg', '2022-06-30 13:42:57', 1),
(40, 14, 'van-tn.jpg', '/phpmotors/uploads/images/vehicles/van-tn.jpg', '2022-06-30 13:42:57', 1),
(41, 15, 'dogcar.jpg', '/phpmotors/uploads/images/vehicles/dogcar.jpg', '2022-06-30 13:53:40', 1),
(42, 15, 'dogcar-tn.jpg', '/phpmotors/uploads/images/vehicles/dogcar-tn.jpg', '2022-06-30 13:53:41', 1),
(43, 20, 'wrangler.jpg', '/phpmotors/uploads/images/vehicles/wrangler.jpg', '2022-06-30 13:54:02', 1),
(44, 20, 'wrangler-tn.jpg', '/phpmotors/uploads/images/vehicles/wrangler-tn.jpg', '2022-06-30 13:54:02', 1),
(45, 21, 'delorean.jpg', '/phpmotors/uploads/images/vehicles/delorean.jpg', '2022-06-30 14:02:27', 1),
(46, 21, 'delorean-tn.jpg', '/phpmotors/uploads/images/vehicles/delorean-tn.jpg', '2022-06-30 14:02:28', 1),
(47, 10, 'camaro-ss.jpg', '/phpmotors/uploads/images/vehicles/camaro-ss.jpg', '2022-06-30 14:05:44', 0),
(48, 10, 'camaro-ss-tn.jpg', '/phpmotors/uploads/images/vehicles/camaro-ss-tn.jpg', '2022-06-30 14:05:44', 0),
(49, 20, 'rubicon.jpg', '/phpmotors/uploads/images/vehicles/rubicon.jpg', '2022-06-30 14:09:12', 0),
(50, 20, 'rubicon-tn.jpg', '/phpmotors/uploads/images/vehicles/rubicon-tn.jpg', '2022-06-30 14:09:12', 0),
(51, 11, 'cadillac-escalade.jpg', '/phpmotors/uploads/images/vehicles/cadillac-escalade.jpg', '2022-06-30 14:09:47', 0),
(52, 11, 'cadillac-escalade-tn.jpg', '/phpmotors/uploads/images/vehicles/cadillac-escalade-tn.jpg', '2022-06-30 14:09:47', 0),
(53, 2, 'model-t.jpg', '/phpmotors/uploads/images/vehicles/model-t.jpg', '2022-07-02 18:50:40', 1),
(54, 2, 'model-t-tn.jpg', '/phpmotors/uploads/images/vehicles/model-t-tn.jpg', '2022-07-02 18:50:40', 1),
(55, 10, 'Camaro_ZL1.jpg', '/phpmotors/uploads/images/vehicles/Camaro_ZL1.jpg', '2022-07-02 23:33:10', 0),
(56, 10, 'Camaro_ZL1-tn.jpg', '/phpmotors/uploads/images/vehicles/Camaro_ZL1-tn.jpg', '2022-07-02 23:33:10', 0),
(57, 10, 'camaroblue.jpg', '/phpmotors/uploads/images/vehicles/camaroblue.jpg', '2022-07-02 23:33:42', 0),
(58, 10, 'camaroblue-tn.jpg', '/phpmotors/uploads/images/vehicles/camaroblue-tn.jpg', '2022-07-02 23:33:42', 0),
(59, 10, 'chevy-camaro-zl1-nascar.jpg', '/phpmotors/uploads/images/vehicles/chevy-camaro-zl1-nascar.jpg', '2022-07-02 23:34:17', 0),
(60, 10, 'chevy-camaro-zl1-nascar-tn.jpg', '/phpmotors/uploads/images/vehicles/chevy-camaro-zl1-nascar-tn.jpg', '2022-07-02 23:34:17', 0),
(61, 11, '2023-Cadillac-Escalade-V.jpg', '/phpmotors/uploads/images/vehicles/2023-Cadillac-Escalade-V.jpg', '2022-07-02 23:35:34', 0),
(62, 11, '2023-Cadillac-Escalade-V-tn.jpg', '/phpmotors/uploads/images/vehicles/2023-Cadillac-Escalade-V-tn.jpg', '2022-07-02 23:35:34', 0),
(63, 11, 'Cadillac-Escalade-1200.png', '/phpmotors/uploads/images/vehicles/Cadillac-Escalade-1200.png', '2022-07-02 23:35:54', 0),
(64, 11, 'Cadillac-Escalade-1200-tn.png', '/phpmotors/uploads/images/vehicles/Cadillac-Escalade-1200-tn.png', '2022-07-02 23:35:54', 0),
(65, 11, 'maxres.jpg', '/phpmotors/uploads/images/vehicles/maxres.jpg', '2022-07-02 23:36:22', 0),
(66, 11, 'maxres-tn.jpg', '/phpmotors/uploads/images/vehicles/maxres-tn.jpg', '2022-07-02 23:36:23', 0),
(67, 3, 'lambo.jpg', '/phpmotors/uploads/images/vehicles/lambo.jpg', '2022-07-03 19:12:36', 0),
(68, 3, 'lambo-tn.jpg', '/phpmotors/uploads/images/vehicles/lambo-tn.jpg', '2022-07-03 19:12:36', 0),
(69, 21, 'delorian.jpg', '/phpmotors/uploads/images/vehicles/delorian.jpg', '2022-07-03 19:19:47', 0),
(70, 21, 'delorian-tn.jpg', '/phpmotors/uploads/images/vehicles/delorian-tn.jpg', '2022-07-03 19:19:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `invId` int NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 1, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 400, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month. ', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '35000', 1, 'Brown', 2),
(20, 'Wrangler', 'Gt300', 'light weight great car for racing.', 'http://phpmotors/images/no-image.png', 'http://phpmotors/images/no-image.png', '2424242', 34, 'Yellow', 4),
(21, 'DMC', 'DeLorean', '3 Cup holders Superman doors Fuzzy dice!', 'http://phpmotors/images/no-image.png', 'http://phpmotors/images/no-image.png', '23425', 345, 'antique', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `reviewId` int UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `invId` int NOT NULL,
  `clientId` int UNSIGNED NOT NULL,
  `clientScreenName` varchar(40) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`, `clientScreenName`) VALUES
(7, 'First review test for the Cadillac&#039;s Escalade. testing', '2022-07-08 18:04:17', 11, 17, 'KOgubie'),
(8, 'Nice and facncy dog shaped car. Good one.', '2022-07-08 20:07:49', 15, 17, 'KOgubie'),
(10, 'Sample review for the monster truck \r\n review by an user.\r\nModified 21:24 testing', '2022-07-11 19:24:48', 4, 22, 'AUserNew'),
(11, 'ANother review for the Chevy&#039;s camoro for testing purposes. Modified camaro reviews.', '2022-07-11 18:10:58', 10, 22, 'AUserNew');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ImgId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
