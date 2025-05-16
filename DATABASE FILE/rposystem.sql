-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 10:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rposystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `cash_received` decimal(10,2) NOT NULL,
  `change_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `barcode` varchar(255) NOT NULL,
  `staff_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `total_price`, `cash_received`, `change_amount`, `created_at`, `barcode`, `staff_id`) VALUES
('ORD_67eda1b45313b', 189.00, 200.00, 11.00, '2025-04-02 20:44:36', '', NULL),
('ORD_67eda1ce24484', 27.00, 50.00, 23.00, '2025-04-02 20:45:02', '', NULL),
('ORD_67eda220d88c9', 70.00, 80.00, 10.00, '2025-04-02 20:46:24', '', NULL),
('ORD_67eda2b145979', 12.00, 20.00, 8.00, '2025-04-02 20:48:49', '', NULL),
('ORD_67eda2daa6a38', 12.00, 80.00, 68.00, '2025-04-02 20:49:30', '', NULL),
('ORD_67eda4bfe819f', 30.00, 50.00, 20.00, '2025-04-02 20:57:35', '', NULL),
('ORD_67edd8c71a185', 54.00, 100.00, 46.00, '2025-04-03 00:39:35', '', NULL),
('ORD_67ede32d8bce4', 54.00, 100.00, 46.00, '2025-04-03 01:23:57', '', NULL),
('ORD_67f3e7afdd742', 27.00, 100.00, 73.00, '2025-04-07 14:56:47', '', NULL),
('ORD_67f4a8aa24e24', 12.00, 20.00, 8.00, '2025-04-08 04:40:10', '', NULL),
('ORD_67f4aac536ac9', 20.00, 20.00, 0.00, '2025-04-08 04:49:09', '', NULL),
('ORD_67f4ad03c8f45', 40.00, 99.99, 59.99, '2025-04-08 04:58:43', '', NULL),
('ORD_67f4aeb0c3a79', 26.00, 30.00, 4.00, '2025-04-08 05:05:52', '', NULL),
('ORD_67f4b0bc5bd8f', 27.00, 50.00, 23.00, '2025-04-08 05:14:36', '', NULL),
('ORD_67f4b21256be6', 12.00, 13.00, 1.00, '2025-04-08 05:20:18', '', NULL),
('ORD_67f4b3187f6bc', 20.00, 20.00, 0.00, '2025-04-08 05:24:40', '', NULL),
('ORD_67f4b484b6061', 50.00, 50.00, 0.00, '2025-04-08 05:30:44', '', NULL),
('ORD_67f4b6d82ae0c', 35.00, 50.00, 15.00, '2025-04-08 05:40:40', '', NULL),
('ORD_67f4be522fb31', 27.00, 50.00, 23.00, '2025-04-08 06:12:34', '', NULL),
('ORD_67f4c41553013', 27.00, 50.00, 23.00, '2025-04-08 06:37:09', '', NULL),
('ORD_67f4d29e87cc3', 45.00, 50.00, 5.00, '2025-04-08 07:39:10', '', NULL),
('ORD_67f4dad849709', 60.00, 60.00, 0.00, '2025-04-08 08:14:16', '', NULL),
('ORD_67f4dadab5b2a', 0.00, 60.00, 60.00, '2025-04-08 08:14:18', '', NULL),
('ORD_67f4dd02921d5', 27.00, 100.00, 73.00, '2025-04-08 08:23:30', '', 'QEUY-9042'),
('ORD_67f4de1ae19f0', 90.00, 100.00, 10.00, '2025-04-08 08:28:10', '', 'PAM-2158'),
('ORD_67f4e62d2d6d1', 12.00, 30.00, 18.00, '2025-04-08 09:02:37', '', 'PAM-2158'),
('ORD_67f4f5e62049e', 50.00, 100.00, 50.00, '2025-04-08 10:09:42', '', 'KIV-1212'),
('ORD_67f4f61c1c0e2', 27.00, 30.00, 3.00, '2025-04-08 10:10:36', '', 'DEN-1779'),
('ORD_67f66735251b5', 27.00, 100.00, 73.00, '2025-04-09 12:25:25', '', 'QEUY-9042'),
('ORD_67f6a45232b40', 28.00, 100.00, 72.00, '2025-04-09 16:46:10', '', 'PAM-2158'),
('ORD_67f6a554916c5', 27.00, 100.00, 73.00, '2025-04-09 16:50:28', '', 'PAM-2158'),
('ORD_67f6a57e863bd', 27.00, 200.00, 173.00, '2025-04-09 16:51:10', '', 'PAM-2158'),
('ORD_67f6be5eab2b7', 27.00, 100.00, 73.00, '2025-04-09 18:37:18', '', NULL),
('ORD_67f6becc938f1', 27.00, 100.00, 73.00, '2025-04-09 18:39:08', '', NULL),
('ORD_67f6bf3a931d0', 27.00, 100.00, 73.00, '2025-04-09 18:40:58', '', NULL),
('ORD_67f71db69c91d', 27.00, 30.00, 3.00, '2025-04-10 01:24:06', '', 'PAM-2158'),
('ORD_67f720f3c182a', 75.00, 200.00, 125.00, '2025-04-10 01:37:55', '', 'PAM-2158'),
('ORD_67f7219d34dc6', 0.00, 20.00, 20.00, '2025-04-10 01:40:45', '', 'PAM-2158'),
('ORD_67f72270cbdd5', 39.00, 40.00, 1.00, '2025-04-10 01:44:16', '', 'PAM-2158'),
('ORD_67f723d781893', 12.00, 20.00, 8.00, '2025-04-10 01:50:15', '', 'PAM-2158'),
('ORD_67f77f90a4b68', 57.00, 100.00, 43.00, '2025-04-10 08:21:36', '', 'PAM-2158'),
('ORD_67f77fbe87b44', 0.00, 10.00, 10.00, '2025-04-10 08:22:22', '', 'PAM-2158'),
('ORD_67f8cd5e0199b', 46.00, 100.00, 54.00, '2025-04-11 08:05:50', '', 'DEN-1779'),
('ORD_67f8ce2a9663b', 131.00, 200.00, 69.00, '2025-04-11 08:09:14', '', 'DEN-1779'),
('ORD_67f8cefa9dc82', 90.00, 100.00, 10.00, '2025-04-11 08:12:42', '', 'DEN-1779'),
('ORD_67f8d05de6714', 55.00, 100.00, 45.00, '2025-04-11 08:18:37', '', 'DEN-1779');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(19, 'ORD_67eda1b45313b', '67ed998dab100', 1, 15.00),
(20, 'ORD_67eda1b45313b', '67ed9a7a93ba7', 1, 14.00),
(21, 'ORD_67eda1b45313b', '67ed9af76dd3d', 1, 15.00),
(22, 'ORD_67eda1b45313b', '67ed9aba4d359', 1, 11.00),
(23, 'ORD_67eda1b45313b', '67ed9b8b7761c', 1, 15.00),
(24, 'ORD_67eda1b45313b', '67ed9b54a8a61', 1, 24.00),
(25, 'ORD_67eda1b45313b', '67ed9c349b89f', 1, 10.00),
(26, 'ORD_67eda1b45313b', '67ed9bfc7adc7', 1, 20.00),
(27, 'ORD_67eda1b45313b', '67ed9a367c823', 1, 13.00),
(28, 'ORD_67eda1b45313b', '67ed994376e7c', 1, 12.00),
(29, 'ORD_67eda1b45313b', '67ed9bc09106f', 1, 20.00),
(30, 'ORD_67eda1b45313b', '67ed9c7cb080f', 1, 20.00),
(31, 'ORD_67eda1ce24484', '67ed9a367c823', 1, 13.00),
(32, 'ORD_67eda1ce24484', '67ed9a7a93ba7', 1, 14.00),
(33, 'ORD_67eda220d88c9', '67ed9c349b89f', 1, 10.00),
(34, 'ORD_67eda220d88c9', '67ed9c7cb080f', 3, 20.00),
(35, 'ORD_67eda2b145979', '67ed994376e7c', 1, 12.00),
(36, 'ORD_67eda2daa6a38', '67ed994376e7c', 1, 12.00),
(37, 'ORD_67eda4bfe819f', '67ed9c7cb080f', 1, 20.00),
(38, 'ORD_67eda4bfe819f', '67ed9c349b89f', 1, 10.00),
(39, 'ORD_67edd8c71a185', '67ed9c7cb080f', 2, 20.00),
(40, 'ORD_67edd8c71a185', '67ed9a7a93ba7', 1, 14.00),
(41, 'ORD_67ede32d8bce4', '67ed9c7cb080f', 2, 20.00),
(42, 'ORD_67ede32d8bce4', '67ed9a7a93ba7', 1, 14.00),
(43, 'ORD_67f3e7afdd742', '67ed998dab100', 1, 15.00),
(44, 'ORD_67f3e7afdd742', '67ed994376e7c', 1, 12.00),
(45, 'ORD_67f4a8aa24e24', '67ed994376e7c', 1, 12.00),
(46, 'ORD_67f4aac536ac9', '67ed9c7cb080f', 1, 20.00),
(47, 'ORD_67f4ad03c8f45', '67ed994376e7c', 1, 12.00),
(48, 'ORD_67f4ad03c8f45', '67ed998dab100', 1, 15.00),
(49, 'ORD_67f4ad03c8f45', '67ed9a367c823', 1, 13.00),
(50, 'ORD_67f4aeb0c3a79', '67ed9aba4d359', 1, 11.00),
(51, 'ORD_67f4aeb0c3a79', '67ed9af76dd3d', 1, 15.00),
(52, 'ORD_67f4b0bc5bd8f', '67ed994376e7c', 1, 12.00),
(53, 'ORD_67f4b0bc5bd8f', '67ed998dab100', 1, 15.00),
(54, 'ORD_67f4b21256be6', '67ed994376e7c', 1, 12.00),
(55, 'ORD_67f4b3187f6bc', '67ed9c7cb080f', 1, 20.00),
(56, 'ORD_67f4b484b6061', '67ed9c7cb080f', 1, 20.00),
(57, 'ORD_67f4b484b6061', '67ed9c349b89f', 1, 10.00),
(58, 'ORD_67f4b484b6061', '67ed9bfc7adc7', 1, 20.00),
(59, 'ORD_67f4b6d82ae0c', '67ed9bfc7adc7', 1, 20.00),
(60, 'ORD_67f4b6d82ae0c', '67ed9b8b7761c', 1, 15.00),
(61, 'ORD_67f4be522fb31', '67ed994376e7c', 1, 12.00),
(62, 'ORD_67f4be522fb31', '67ed998dab100', 1, 15.00),
(63, 'ORD_67f4c41553013', '67ed994376e7c', 1, 12.00),
(64, 'ORD_67f4c41553013', '67ed998dab100', 1, 15.00),
(65, 'ORD_67f4d29e87cc3', '67ed9c349b89f', 1, 10.00),
(66, 'ORD_67f4d29e87cc3', '67ed9b8b7761c', 1, 15.00),
(67, 'ORD_67f4d29e87cc3', '67ed9bc09106f', 1, 20.00),
(68, 'ORD_67f4dad849709', '67ed9bc09106f', 2, 20.00),
(69, 'ORD_67f4dad849709', '67ed9bfc7adc7', 1, 20.00),
(70, 'ORD_67f4dd02921d5', '67ed994376e7c', 1, 12.00),
(71, 'ORD_67f4dd02921d5', '67ed998dab100', 1, 15.00),
(72, 'ORD_67f4de1ae19f0', '67ed9c349b89f', 1, 10.00),
(73, 'ORD_67f4de1ae19f0', '67ed9bfc7adc7', 1, 20.00),
(74, 'ORD_67f4de1ae19f0', '67ed9c7cb080f', 3, 20.00),
(75, 'ORD_67f4e62d2d6d1', '67ed994376e7c', 1, 12.00),
(76, 'ORD_67f4f5e62049e', '67ed9c7cb080f', 2, 20.00),
(77, 'ORD_67f4f5e62049e', '67ed9c349b89f', 1, 10.00),
(78, 'ORD_67f4f61c1c0e2', '67ed9a367c823', 1, 13.00),
(79, 'ORD_67f4f61c1c0e2', '67ed9a7a93ba7', 1, 14.00),
(80, 'ORD_67f66735251b5', '67ed994376e7c', 1, 12.00),
(81, 'ORD_67f66735251b5', '67ed998dab100', 1, 15.00),
(82, 'ORD_67f6a45232b40', '67ed998dab100', 1, 15.00),
(83, 'ORD_67f6a45232b40', '67ed9a367c823', 1, 13.00),
(84, 'ORD_67f6a554916c5', '67ed994376e7c', 1, 12.00),
(85, 'ORD_67f6a554916c5', '67ed998dab100', 1, 15.00),
(86, 'ORD_67f6a57e863bd', '67ed994376e7c', 1, 12.00),
(87, 'ORD_67f6a57e863bd', '67ed998dab100', 1, 15.00),
(88, 'ORD_67f6be5eab2b7', '67ed994376e7c', 1, 12.00),
(89, 'ORD_67f6be5eab2b7', '67ed998dab100', 1, 15.00),
(90, 'ORD_67f6becc938f1', '67ed994376e7c', 1, 12.00),
(91, 'ORD_67f6becc938f1', '67ed998dab100', 1, 15.00),
(92, 'ORD_67f6bf3a931d0', '67ed994376e7c', 1, 12.00),
(93, 'ORD_67f6bf3a931d0', '67ed998dab100', 1, 15.00),
(94, 'ORD_67f71db69c91d', '67ed998dab100', 1, 15.00),
(95, 'ORD_67f71db69c91d', '67ed994376e7c', 1, 12.00),
(96, 'ORD_67f720f3c182a', '67ed994376e7c', 5, 12.00),
(97, 'ORD_67f720f3c182a', '67ed998dab100', 1, 15.00),
(98, 'ORD_67f72270cbdd5', '67ed994376e7c', 2, 12.00),
(99, 'ORD_67f72270cbdd5', '67ed998dab100', 1, 15.00),
(100, 'ORD_67f723d781893', '67ed994376e7c', 1, 12.00),
(101, 'ORD_67f77f90a4b68', '67ed998dab100', 3, 15.00),
(102, 'ORD_67f77f90a4b68', '67ed994376e7c', 1, 12.00),
(103, 'ORD_67f8cd5e0199b', '67f8abefcd7a5', 2, 23.00),
(104, 'ORD_67f8ce2a9663b', '67f8af36d0b5e', 1, 22.00),
(105, 'ORD_67f8ce2a9663b', '67f8aef64f28e', 1, 26.00),
(106, 'ORD_67f8ce2a9663b', '67f8b201b49a6', 1, 30.00),
(107, 'ORD_67f8ce2a9663b', '67ed9aba4d359', 1, 11.00),
(108, 'ORD_67f8ce2a9663b', '67ed9af76dd3d', 1, 15.00),
(109, 'ORD_67f8ce2a9663b', '67f8b1b163d43', 1, 27.00),
(110, 'ORD_67f8cefa9dc82', '67f8b072da259', 1, 30.00),
(111, 'ORD_67f8cefa9dc82', '67ed994376e7c', 1, 12.00),
(112, 'ORD_67f8cefa9dc82', '67f7f2af9f8cf', 1, 8.00),
(113, 'ORD_67f8cefa9dc82', '67f7f36b44484', 1, 13.00),
(114, 'ORD_67f8cefa9dc82', '67f8af8f82dd2', 1, 27.00),
(115, 'ORD_67f8d05de6714', '67f8cbf22b360', 1, 25.00),
(116, 'ORD_67f8d05de6714', '67f8b3aaccfb5', 1, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `rpos_admin`
--

CREATE TABLE `rpos_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_number` varchar(20) DEFAULT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  `admin_profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rpos_admin`
--

INSERT INTO `rpos_admin` (`admin_id`, `admin_number`, `admin_name`, `admin_email`, `admin_password`, `admin_profile_pic`) VALUES
(1, 'HAO-837', 'Admin', 'admin@mail.com', '$2y$10$eRvwhExbm5Zf9LsH/1lD7eFDG1f2l5KEGfS8X4fjBx28i1PbcYKL2', 'uploads/photo_2025-04-08_18-02-56.jpg'),
(2, 'NOK-320', 'Admin', 'admin@mail.com', '531c154c293dfa54ca8eb77046c68c1aad5eb1f8', 'uploads/photo_2025-04-08_18-02-56.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_products`
--

CREATE TABLE `rpos_products` (
  `prod_id` varchar(200) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_img` varchar(200) NOT NULL,
  `prod_desc` longtext NOT NULL,
  `prod_price` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `barcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rpos_products`
--

INSERT INTO `rpos_products` (`prod_id`, `prod_name`, `prod_img`, `prod_desc`, `prod_price`, `created_at`, `barcode`) VALUES
('67ed994376e7c', 'Chocolate Sliced Cake', 'a1.jpg', 'a rich and velvety chocolate cake slice, topped with delicate swirls of whipped cream and a dusting of cocoa, served elegantly on a pristine white plate.', '12', '2025-04-02 20:29:50.281788', '1541766079330'),
('67ed998dab100', 'Lotus Ala Creme', 'a2.jpg', 'a decadent chocolate brownie topped with a crisp Lotus biscuit, paired with velvety whipped cream drizzled in caramel and adorned with biscuit crumbles—an exquisite fusion of crunch and creaminess.', '15', '2025-04-02 20:32:15.873716', '9976870597791'),
('67ed9a367c823', 'Rocky Road Overload', 'a3.jpg', 'a luscious chocolate cake draped in silky cream, adorned with dark and white chocolate shavings, and crowned with a vibrant cherry—an indulgent harmony of rich textures and flavors.', '13', '2025-04-02 20:32:55.251732', '1980726410842'),
('67ed9a7a93ba7', 'Teiny Crun', 'a4.jpg', 'a delicate chocolate dessert sits elegantly on a fluted, gold-rimmed plate, exuding sophistication. The rich, velvety chocolate dome is nestled within a crisp, textured crust, creating a harmonious balance of textures.', '14', '2025-04-02 20:33:23.491649', '9531434716164'),
('67ed9aba4d359', 'Oreo Sliced Cake', 'a5.jpg', 'a luscious slice of Oreo cheesecake rests gracefully on a fluted, cream-toned plate, exuding indulgence. The velvety white filling sits atop a rich, dark cookie crust, offering a perfect balance of texture and flavor.', '11', '2025-04-02 20:34:04.906454', '8254236316240'),
('67ed9af76dd3d', 'MuffCream', 'a6.jpg', 'a decadent chocolate brownie, rich and fudgy, sits elegantly on a pristine white plate, crowned with a perfectly round scoop of vanilla ice cream. A light dusting of cocoa powder adds a refined touch, between the warm, dense brownie and the cool, creamy ice cream.', '15', '2025-04-02 20:34:25.607949', '8430395921192'),
('67f7f1dcd9f6d', 'Choco Donut', '488850373_9541537959255705_8456886246150593934_n.jpg', 'Classic chocolate-glazed donut topped with rich cocoa drizzle and chocolate bits.', '5', '2025-04-10 16:29:16.905823', '3206424404685'),
('67f7f22adbc04', 'Caramel Cream Donut', '488216439_691189646585858_8421141630714838163_n.jpg', 'Filled with smooth caramel cream and finished with a golden caramel glaze.', '6', '2025-04-10 16:30:34.901611', '1591842361422'),
('67f7f26d8ac27', 'Overload Donut', '488229131_1947927939309912_1140293732050680399_n.jpg', 'Fully loaded with chocolate chips, caramel chunks, and crushed cookies for maximum flavor.', '10', '2025-04-10 16:31:41.569899', '3622482925809'),
('67f7f2af9f8cf', 'Cookies and Cream Donut', '487566472_2384827061893305_4790642078583606911_n.jpg', 'Topped with crushed cookies and filled with sweet cream for a cookies-and-cream twist.', '8', '2025-04-10 16:32:47.656361', '4363612785748'),
('67f7f30bad96d', 'Puffy Carapea Donut', '462537084_468294408879033_6468609028808671357_n.jpg', 'Light and airy donut glazed with buttery caramel and a hint of peanut crunch.', '12', '2025-04-10 16:35:00.706186', '5330749234356'),
('67f7f36b44484', 'Peanut Creme Donut', '486060238_667416742441299_4149415021418620414_n.jpg', 'Filled with creamy peanut butter and topped with crushed peanuts and a light sugar glaze.', '13', '2025-04-10 16:35:55.281466', '4599678534956'),
('67f8aadccf142', 'Choco Cherry Ice Cream', '489364700_573326245135581_4216551039213881937_n.jpg', 'A luscious blend of chocolate ice cream swirled with cherry syrup and bits of real cherries.', '20', '2025-04-11 05:46:36.962376', '4203881406886'),
('67f8ab3a86502', 'Peacreme Ice Cream', '488900098_1174624637446933_5638387877384752116_n.jpg', 'Creamy peanut and caramel-flavored ice cream with a smooth, nutty finish.', '25', '2025-04-11 05:46:05.352065', '9552559705970'),
('67f8abb123ea5', 'Strawberry Syrup Ice Cream', '487287497_1190601892605528_1202403885984741471_n.jpg', 'Velvety strawberry ice cream drizzled with rich strawberry syrup for extra sweetness.', '24', '2025-04-11 05:42:09.149683', '3928087763830'),
('67f8abefcd7a5', 'Chocolate Syrup Ice Cream', '488390502_1392323052202781_2087115825040501144_n.jpg', 'Classic chocolate ice cream layered with decadent chocolate syrup for double the cocoa love.', '23', '2025-04-11 05:43:11.843111', '5012550419527'),
('67f8ac34af753', 'Choco Coated Creme Ice Cream', '488920216_660866250214361_2177938219457860434_n.jpg', 'Creamy vanilla-based ice cream wrapped in a crunchy chocolate shell—smooth inside, crisp outside.', '21', '2025-04-11 05:44:20.734776', '8423041713029'),
('67f8ac6a96d65', 'Mocha Peanut Ice Cream', '487297261_3643841845910826_5911464815070360056_n.jpg', ' A bold fusion of mocha and peanut flavors, offering a rich and nutty coffee-infused scoop.', '23', '2025-04-11 05:45:39.986540', '9296438515471'),
('67f8ad9b9a9ec', 'Caramel Cookie Cupcake', '489366390_576887628065715_5030010938183827188_n.jpg', 'A soft vanilla cupcake topped with creamy caramel frosting and a crunchy cookie crumble.', '15', '2025-04-11 05:52:46.074558', '8335472000817'),
('67f8ae8e0f5fe', 'Cherry on Top Cupcake', '488177693_517356964567290_2654076725360481368_n.jpg', 'Fluffy cake with cherry-infused frosting, finished with a juicy cherry on top.', '19', '2025-04-11 05:54:22.063767', '4986359792352'),
('67f8aef64f28e', 'Strawberry Yogurt Cupcake', '485829616_460591683742360_8503415031587448514_n.jpg', 'A refreshing blend of strawberry and yogurt in a soft cupcake, topped with a tangy frosting.', '26', '2025-04-11 06:00:04.766499', '5588208028217'),
('67f8af36d0b5e', 'Cherry Velvet Cupcake', '486864881_24355775084022541_1700389157287586632_n.jpg', ' A twist on red velvet with hints of cherry and a smooth cream cheese frosting.\r\n', '22', '2025-04-11 05:57:10.856656', '9064532850305'),
('67f8af8f82dd2', 'Matcha Strawberry Cupcake ', '487225240_9760273617421184_7977331674206233994_n.jpg', 'Earthy matcha cake paired with strawberry frosting for a perfect balance of bold and sweet.', '27', '2025-04-11 05:58:39.537022', '4766266154388'),
('67f8afd06bb75', 'Strawberry Cupcake ', '487241209_4347485918853156_5170281151392843599_n.jpg', 'Light and moist strawberry-flavored cake topped with sweet strawberry buttercream.', '24', '2025-04-11 05:59:44.442324', '3453491871890'),
('67f8b0337de33', 'Avocado Smoothie', 'f81682ee5177f4782de3bfc506ab4f03.jpg', 'Creamy and rich, made with fresh avocado for a smooth, satisfying blend.', '20', '2025-04-11 06:01:23.518761', '3076280077459'),
('67f8b072da259', 'Strawberry Banana Smoothie', '822e94f127074d2f43101dc4e9be71a1.jpg', 'A classic duo of sweet strawberries and ripe bananas blended to perfection.', '30', '2025-04-11 06:02:26.894895', '1529048292288'),
('67f8b0d9930ab', 'Four Season Smoothie', 'b50abdc25831da5dbae9d1b388c6c9d9.jpg', 'A tropical mix of mango, pineapple, orange, and banana for a refreshing burst of flavor.', '35', '2025-04-11 06:04:09.603150', '3978690215035'),
('67f8b139d39d3', 'Berry Mixed Smoothie ', 'bd820f02b154f043db38b614988dd6c1.jpg', 'A vibrant blend of blueberries, strawberries, raspberries, and blackberries—berrylicious and refreshing.\r\n', '23', '2025-04-11 06:05:45.867786', '3080629414584'),
('67f8b1b163d43', 'Mango Smoothie', '7bb33f4149df29b815250928ccd6b549.jpg', 'Sweet, tropical mango blended into a smooth, icy treat bursting with sunshine flavor.', '27', '2025-04-11 06:07:45.410624', '8195539182098'),
('67f8b201b49a6', 'Kiwi Avocado ', '9a75113dc08267b57a5d79cec7b039ad.jpg', ' A unique combo of tangy kiwi and creamy avocado for a refreshing yet rich smoothie experience.', '30', '2025-04-11 06:09:05.741723', '5404110898208'),
('67f8b32d7cdd8', 'Latte', '488534808_2536526720016563_5853654681662568213_n (1).jpg', 'TBA', '20', '2025-04-11 06:14:05.512365', '6339507360633'),
('67f8b35fdbce8', 'Iced Americano', '487296196_1340268330584664_8178677798480785696_n (1).jpg', 'TBA', '20', '2025-04-11 06:14:55.901520', '5927750708169'),
('67f8b38bd9d36', 'Matcha', '488174299_1182507476747389_4926142331614694864_n (1).jpg', 'TBA', '23', '2025-04-11 06:15:39.892930', '9103645599838'),
('67f8b3aaccfb5', 'Toblerone', '489428829_1735930330327747_7534730089067927129_n (1).jpg', 'TBA', '30', '2025-04-11 06:16:10.841606', '7702284937609'),
('67f8b3d743e75', 'Peanuts', '486061553_1395354614825200_4155531274373402885_n (1).jpg', 'TBA', '26', '2025-04-11 06:16:55.278850', '5525185931567'),
('67f8cbf22b360', 'Strawberry latte', '485808713_1385720382612123_8799238730387260949_n (1).jpg', 'TBA', '25', '2025-04-11 07:59:46.179186', '7439496942489');

-- --------------------------------------------------------

--
-- Table structure for table `rpos_staff`
--

CREATE TABLE `rpos_staff` (
  `staff_id` int(20) NOT NULL,
  `staff_name` varchar(200) NOT NULL,
  `staff_number` varchar(200) NOT NULL,
  `staff_email` varchar(200) NOT NULL,
  `staff_password` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `staff_profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rpos_staff`
--

INSERT INTO `rpos_staff` (`staff_id`, `staff_name`, `staff_number`, `staff_email`, `staff_password`, `created_at`, `staff_profile_pic`) VALUES
(3, 'Kieven', 'PAM-2158', 'kiebs@mail.com', '531c154c293dfa54ca8eb77046c68c1aad5eb1f8', '2025-04-09 17:59:45.671518', 'uploads/1744221585_488244545_574418341657668_6448408771905102441_n.jpg'),
(4, 'Zeik', 'DEN-1779', 'zeik@mail.com', '2abd9867cad9eeee50033bf1d4310baa0c3c2aed', '2025-04-08 09:51:10.639353', NULL),
(5, 'Yukirin', 'KIV-1212', 'yukichirin@mail.com', 'c02a6ec5dfd73cfc10ca7de517ef168a97d0aa71', '2025-04-08 10:06:52.013273', NULL),
(6, 'Liza', 'RTB-2240', 'lizawang@mail.com', '3d46fa50ee2e6568e758edd5a132f14ce6bde0b1', '2025-04-08 10:23:04.415436', NULL),
(7, 'Kathlyn', 'PVA-1085', 'kathlyn@mail.com', 'e98c6f4782613af753fae0fcc5d8e8876cd73663', '2025-04-08 10:26:11.436257', NULL),
(8, 'Rosemarie', 'STJ-1643', 'rosemarie@mail.com', '26167afa20739a59f7b63b94859093b55c6f2faa', '2025-04-08 10:27:47.540940', NULL),
(9, 'Cj', 'TYG-7467', 'cjnoval@mail.com', 'dhen', '2025-04-10 01:32:56.070273', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `rpos_admin`
--
ALTER TABLE `rpos_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `rpos_products`
--
ALTER TABLE `rpos_products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `rpos_staff`
--
ALTER TABLE `rpos_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `rpos_admin`
--
ALTER TABLE `rpos_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rpos_staff`
--
ALTER TABLE `rpos_staff`
  MODIFY `staff_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
