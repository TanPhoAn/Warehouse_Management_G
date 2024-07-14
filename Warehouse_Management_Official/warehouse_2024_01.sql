-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 14, 2024 lúc 07:18 AM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `warehouse_2024_01`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(40) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(10) NOT NULL,
  `fname` varchar(255) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`id`, `username`, `password`, `role`, `fname`, `lname`, `contact`, `email`, `avatar`) VALUES
(1, 'tanphan', 'ppp123', 0, 'Phan', 'Phước Tân', '0999999999', 'tan@gmail.com', ''),
(2, 'lapkien', 'lapkien123!', 1, 'Lin', 'Lập Kiến', '0888888888', 'kien@gmail.com', ''),
(3, 'haoquach', '12345', 1, 'Quách', 'Phú Hào', '0777777777', 'hao@gmail.com', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(10) NOT NULL,
  `packageID` bigint(10) NOT NULL,
  `employeeID` bigint(10) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pickDate` datetime DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_employee` (`employeeID`),
  KEY `FK_order_package` (`packageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `packageID`, `employeeID`, `description`, `pickDate`, `status`) VALUES
(1, 2, 1, 'Order 1 ', '2024-06-18 00:00:00', 'picking'),
(2, 1, 3, 'Order 2', '2024-07-02 00:00:00', 'picking');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `shipmentID` bigint(10) DEFAULT NULL,
  `bar_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_quantity` bigint(20) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `package_description` text COLLATE utf8_unicode_ci,
  `exp_date` date DEFAULT NULL,
  `mfg_date` date DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `bin_location` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment` (`shipmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `packages`
--

INSERT INTO `packages` (`id`, `shipmentID`, `bar_code`, `package_name`, `package_quantity`, `category`, `package_description`, `exp_date`, `mfg_date`, `width`, `length`, `weight`, `bin_location`, `status`) VALUES
(1, 1, '123456', 'adult toy', 200, 'toy', 'toys for people who need to release stress and lift the mood up ', '2024-03-30', '2030-05-30', '160.00', '150.00', '20000.00', '1', 'available'),
(2, 1, '1234557', 'cartoon book', 100, 'book', 'cartoon book manufactured by Kim Dong Publisher', '2024-05-30', '2040-05-30', '120.00', '120.00', '15000.00', '2', 'available'),
(3, 2, '123458', 'Yugioh Cards', 10000, 'toy', 'Yugioh cards game which use friendship power to against enemies', '2000-01-30', NULL, '60.00', '60.00', '1000.00', '3', 'preparing'),
(4, 4, '6969', 'mì ý', 700, 'thực phẩm lạnh', 'mì ý sốt bò bằm', '2024-05-30', '2026-05-30', '200.00', '150.00', '10000.00', '1', 'available'),
(5, 5, '3242', 'nước suối', 100, 'thực phẩm', 'nước suối Aquafina', '2024-01-22', '2028-04-22', '800.00', '80.00', '5000.00', '2', 'available');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `picks`
--

DROP TABLE IF EXISTS `picks`;
CREATE TABLE IF NOT EXISTS `picks` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `orderID` bigint(10) NOT NULL,
  `pickTime` timestamp NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pick_orders` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `picks`
--

INSERT INTO `picks` (`id`, `orderID`, `pickTime`, `status`) VALUES
(1, 1, '2024-07-12 05:47:38', 'picking'),
(2, 2, '2024-07-12 05:47:45', 'picking');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `returns`
--

DROP TABLE IF EXISTS `returns`;
CREATE TABLE IF NOT EXISTS `returns` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `orderID` bigint(10) NOT NULL,
  `problemDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `returnTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_returns_orders` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `returns`
--

INSERT INTO `returns` (`id`, `orderID`, `problemDescription`, `status`, `returnTime`) VALUES
(1, 2, 'xấu vãi ', 'returning', NULL),
(2, 1, 'không thích nữa', 'returning', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipments`
--

DROP TABLE IF EXISTS `shipments`;
CREATE TABLE IF NOT EXISTS `shipments` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `value` decimal(10,2) NOT NULL,
  `carModel` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driveName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receiveDate` timestamp NULL DEFAULT NULL,
  `employeeID` bigint(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employee` (`employeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shipments`
--

INSERT INTO `shipments` (`id`, `value`, `carModel`, `driveName`, `receiveDate`, `employeeID`) VALUES
(1, '1500.00', 'Ford Transit 2022', 'Nick ', '2024-06-05 07:00:00', 1),
(2, '1000.00', 'V Vans', 'Cardi B', '2024-06-30 06:00:00', 2),
(3, '2000.00', 'none', 'Jennie', NULL, 1),
(4, '2000.00', 'Tesla Model Y', 'John Wick', NULL, 1),
(5, '800.00', 'Tesla Model Y', 'Bella Poarch', NULL, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transfers`
--

DROP TABLE IF EXISTS `transfers`;
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currentLocation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newLocation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transDate` datetime NOT NULL,
  `packageID` bigint(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transfer_package` (`packageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_order_employee` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `FK_order_package` FOREIGN KEY (`packageID`) REFERENCES `packages` (`id`);

--
-- Các ràng buộc cho bảng `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `shipment` FOREIGN KEY (`shipmentID`) REFERENCES `shipments` (`id`);

--
-- Các ràng buộc cho bảng `picks`
--
ALTER TABLE `picks`
  ADD CONSTRAINT `FK_pick_orders` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `FK_returns_orders` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `FK_employee` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`id`);

--
-- Các ràng buộc cho bảng `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `FK_transfer_package` FOREIGN KEY (`packageID`) REFERENCES `packages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
