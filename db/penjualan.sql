-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 12:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`) VALUES
('user1', '$2y$10$QSzSpjNGaFJKHUukquwvNuzsusRaIf79X.P0VINvN8Teu53cZRECO');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_code` varchar(18) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `price` int(6) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `discount` int(6) NOT NULL,
  `dimension` varchar(50) NOT NULL,
  `unit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_code`, `product_name`, `price`, `currency`, `discount`, `dimension`, `unit`) VALUES
('GVBR', 'Giv Biru', 11000, 'IDR', 0, '2 cm x 3 cm', 'PCS'),
('SKUSKILNL', 'SO klin Liquid', 18000, 'IDR', 0, '13 cm x 10 cm', 'PCS'),
('SKUSKILNP', 'SO klin Pewangi', 13500, 'IDR', 10, '13 cm x 10 cm', 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `document_number` int(10) NOT NULL,
  `document_code` varchar(12) NOT NULL,
  `product_code` varchar(18) NOT NULL,
  `price` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `unit` varchar(5) NOT NULL,
  `sub_total` int(10) NOT NULL,
  `currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`document_number`, `document_code`, `product_code`, `price`, `quantity`, `unit`, `sub_total`, `currency`) VALUES
(87, '671135927413', 'GVBR', 11000, 2, 'PCS', 11000, 'IDR'),
(88, '671135927413', 'SKUSKILNL', 18000, 1, 'PCS', 18000, 'IDR'),
(89, '671136002599', 'SKUSKILNL', 18000, 4, 'PCS', 72000, 'IDR'),
(90, '671136002599', 'SKUSKILNP', 12150, 2, 'PCS', 24300, 'IDR'),
(91, '671136116840', 'SKUSKILNL', 18000, 3, 'PCS', 54000, 'IDR'),
(92, '671136116840', 'GVBR', 11000, 1, 'PCS', 11000, 'IDR'),
(93, '671136794782', 'SKUSKILNL', 18000, 4, 'PCS', 72000, 'IDR'),
(94, '671136794782', 'SKUSKILNP', 12150, 2, 'PCS', 24300, 'IDR'),
(95, '671136794782', 'GVBR', 11000, 7, 'PCS', 77000, 'IDR'),
(96, '671147380125', 'SKUSKILNP', 12150, 2, 'PCS', 24300, 'IDR'),
(97, '671147380125', 'SKUSKILNL', 18000, 3, 'PCS', 54000, 'IDR');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_header`
--

CREATE TABLE `transaction_header` (
  `document_code` varchar(12) NOT NULL,
  `user` varchar(50) NOT NULL,
  `total` int(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_header`
--

INSERT INTO `transaction_header` (`document_code`, `user`, `total`, `date`) VALUES
('671135927413', 'user1', 40000, '2022-12-15'),
('671136002599', 'user1', 96300, '2022-12-15'),
('671136116840', 'user1', 65000, '2022-12-15'),
('671136794782', 'user1', 173300, '2022-12-15'),
('671147380125', 'user1', 78300, '2022-12-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`document_number`),
  ADD KEY `product_code` (`product_code`),
  ADD KEY `document_code` (`document_code`);

--
-- Indexes for table `transaction_header`
--
ALTER TABLE `transaction_header`
  ADD PRIMARY KEY (`document_code`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `document_number` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD CONSTRAINT `transaction_detail_ibfk_1` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`),
  ADD CONSTRAINT `transaction_detail_ibfk_2` FOREIGN KEY (`document_code`) REFERENCES `transaction_header` (`document_code`);

--
-- Constraints for table `transaction_header`
--
ALTER TABLE `transaction_header`
  ADD CONSTRAINT `transaction_header_ibfk_1` FOREIGN KEY (`user`) REFERENCES `login` (`user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
