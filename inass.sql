-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 04:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inass`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `sizes` varchar(20) NOT NULL,
  `sugar` varchar(20) NOT NULL,
  `ice` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `uname`, `ProductID`, `sizes`, `sugar`, `ice`, `quantity`) VALUES
(16, 'alamak', 'p003', 'Medium', 'Normal', 'Normal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(30) NOT NULL,
  `image` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `price` double NOT NULL,
  `CategoryID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `image`, `name`, `price`, `CategoryID`) VALUES
('p001', 'img/pearlmilktea.jpg', 'Milk Tea with Black Pearls', 8, 'c1'),
('p002', 'img/grassjelly.jpg', 'Grass Jelly Milk Tea', 7.5, 'c1'),
('p003', 'img/orangejuice.jpg', 'Orange Juice', 6, 'c2'),
('p004', 'img/sparklinglemonade.jpg', 'Sparkling Lemonade', 11, 'c3'),
('p005', 'img/latte.jpg', 'Latte', 7, 'c4'),
('p006', 'img/icelemontea.jpg', 'Ice Lemon Tea', 7.5, 'c5'),
('p007', 'img/thaigreen.jpg', 'Thai Green Milk Tea', 9.5, 'c1'),
('p008', 'img/br.jpg', 'Beetroot', 6, 'c2'),
('p009', 'img/ap.jpg', 'Apple Juice', 6, 'c2'),
('p010', 'img/Screenshot 2022-09-13 111959.png', 'Hello World', 11, 'c2'),
('p011', 'img/sw.jpg', 'Sparkling Watermelon', 11, 'c3'),
('p012', 'img/m.jpg', 'Mocha', 7.5, 'c4'),
('p013', 'img/at.jpg', 'Apple Tea', 8, 'c5');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `RecordID` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `sugar` varchar(20) NOT NULL,
  `ice` varchar(20) NOT NULL,
  `sizes` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`RecordID`, `uname`, `ProductID`, `sugar`, `ice`, `sizes`, `quantity`) VALUES
(2, 'alamak', 'p001', 'Normal', 'Normal', 'Medium', 1),
(2, 'alamak', 'p004', 'Normal', 'Normal', 'Medium', 1),
(3, 'Chiayin', 'p002', 'Extra', 'Less', 'Large(+RM1)', 3),
(3, 'Chiayin', 'p004', 'Less', 'None', 'Large(+RM1)', 1),
(4, 'Chiayin', 'p001', 'Normal', 'Normal', 'Medium', 1),
(4, 'Chiayin', 'p006', 'Normal', 'Normal', 'Medium', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uname` varchar(20) NOT NULL,
  `pword` varchar(20) NOT NULL,
  `pnum` varchar(20) DEFAULT NULL,
  `adress` varchar(20) DEFAULT NULL,
  `isadmin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uname`, `pword`, `pnum`, `adress`, `isadmin`) VALUES
('admin', 'admin', '', '', '1'),
('alamak', 'ah', '0169696969', 'iloveu', '0'),
('Chiayin', 'cy0416', '0177136533', 'gemas', '0'),
('Owen', 'Owen0223', '0172340223', '111,Jalan Indah 1/24', '0'),
('qwqw', 'qwww', '011233132131', 'weqdwdqw12213', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`uname`) REFERENCES `user` (`uname`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`uname`) REFERENCES `user` (`uname`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
