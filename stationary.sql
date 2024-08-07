-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 04:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stationary`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `content1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `content2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`, `image1`, `content1`, `image2`, `content2`) VALUES
(1, 'Welcome', 'Welcome to Zaw! Your Premier Destination for Quality Stationery and Copy Services.', 'img/pexels-alina-matveycheva-19089106.jpg', 'At Zaw, we&#039;re passionate about providing top-notch stationery and cutting-edge copier solutions. From high-quality pens to advanced copier machines, we have everything you need for a productive and creative experience. Our commitment to quality, conv', 'img/pexels-alina-matveycheva-19089106.jpg', 'At Zaw, we&#039;re passionate about providing top-quality stationery and copy solutions. From pens to copiers, we&#039;ve got you covered with products that enhance creativity and efficiency. Visit us today for convenience, affordability, and exceptional ');

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_name`, `password`, `image`) VALUES
('zaw', 'Zaw123', 'photo/avatar5.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `category_des` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `change_price`
--

CREATE TABLE `change_price` (
  `price_id` int(11) NOT NULL,
  `sale_price` int(10) NOT NULL,
  `sale_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `code` varchar(255) NOT NULL,
  `limit_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `copier`
--

CREATE TABLE `copier` (
  `copier_id` int(11) NOT NULL,
  `copier_type` varchar(20) NOT NULL,
  `copier_photo` varchar(50) DEFAULT NULL,
  `copier_des` varchar(250) DEFAULT NULL,
  `copier_price` int(10) NOT NULL,
  `copier_size` varchar(20) NOT NULL,
  `copier_date` date NOT NULL,
  `emp_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `copier`
--

INSERT INTO `copier` (`copier_id`, `copier_type`, `copier_photo`, `copier_des`, `copier_price`, `copier_size`, `copier_date`, `emp_name`) VALUES
(8, 'Type', 'photo/photo_2023-07-20_13-58-22.jpg', 'One Piece', 1000, '3', '2024-03-12', 'Kyaw Kyaw');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `nrc` varchar(20) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_name`, `password`, `phone`, `nrc`, `photo`, `address`) VALUES
('Kyaw Kyaw', '123', '09284561622', '12/SaKaKha(N)046659', 'photo/photo_2023-07-20_13-58-22.jpg', 'No.702, Aung Mingalar Street, Myawaddy Township, Kayin State');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `title`, `description`, `image`) VALUES
(1, 'Welcome to Zaw', 'hello Zaw', 'img/home.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `in_stock`
--

CREATE TABLE `in_stock` (
  `stock_id` int(11) NOT NULL,
  `item_quantity` int(100) NOT NULL,
  `stock_item_price` int(10) NOT NULL,
  `in_stock_date` date NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_des` varchar(250) NOT NULL,
  `item_photo` varchar(200) NOT NULL,
  `item_size` varchar(20) DEFAULT NULL,
  `item_type` varchar(20) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `limit_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_noti`
--

CREATE TABLE `item_noti` (
  `noti_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `total_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nrc`
--

CREATE TABLE `nrc` (
  `nrc_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `township` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nrc`
--

INSERT INTO `nrc` (`nrc_id`, `state`, `township`) VALUES
(3, 1, 'BhaMaNa'),
(4, 1, 'PaMaNa'),
(5, 1, 'AhTaNa'),
(6, 1, 'MaTaNa'),
(7, 1, 'KhaPhaNa'),
(8, 1, 'TaNaNa'),
(9, 1, 'PhaKaNa'),
(10, 1, 'KaMaNa'),
(11, 1, 'KhaLaPha'),
(12, 1, 'MaKhaBa'),
(13, 1, 'MaSaNa'),
(14, 1, 'MaKaTa'),
(15, 1, 'MaNyaNa'),
(16, 1, 'HaPaNa'),
(17, 1, 'MaKaTha'),
(18, 1, 'MaMaNa'),
(23, 1, 'MaKaNa'),
(24, 1, 'SaKaNa'),
(25, 1, 'KaMaTa'),
(26, 1, 'SaBaTa'),
(27, 1, 'MaGaDa'),
(28, 1, 'AhGaYa'),
(29, 1, 'NaMaNa'),
(30, 1, 'PaTaAh'),
(31, 1, 'YaKaNa'),
(32, 1, 'SaBaNa'),
(33, 1, 'SaLaNa'),
(34, 1, 'WaMaNa'),
(35, 1, 'SahDaNa'),
(36, 1, 'RaBhaYa'),
(37, 1, 'KaPaTa'),
(38, 1, 'PaWaNa'),
(39, 1, 'MaLaNa'),
(40, 1, 'LaGaNa'),
(41, 1, 'DaPhaYa'),
(42, 1, 'PaNaDa'),
(43, 1, 'KhaBaDa'),
(44, 1, 'SahPaBa'),
(45, 1, 'HpaKaNa'),
(46, 1, 'KhaLaHpa'),
(47, 2, 'DaMaSa'),
(48, 2, 'SaSaNa'),
(49, 2, 'PhaSaNa'),
(50, 2, 'HtaTaPa'),
(51, 2, 'KhaSaNa'),
(52, 2, 'PhaLaSa'),
(53, 2, 'LaKaNa'),
(54, 2, 'MaYaMa'),
(55, 2, 'MaSaNa'),
(56, 2, 'YaTaNa'),
(57, 2, 'PhaYaSa'),
(58, 2, 'BaLaKha'),
(59, 2, 'RaThaNa'),
(60, 2, 'HpaRaHsa'),
(61, 2, 'HpaHsaNa'),
(62, 2, 'LaKaNa'),
(63, 2, 'DaMaHsa'),
(64, 2, 'RaTaNa'),
(65, 2, 'BaLaKha'),
(66, 3, 'KaDaNa'),
(67, 3, 'KaSaKa'),
(68, 3, 'MaWaTa'),
(69, 3, 'SaKaLa'),
(70, 3, 'BaGaLa'),
(71, 3, 'PaKaNa'),
(72, 3, 'YaYaTha'),
(73, 3, 'KaKaYa'),
(74, 3, 'ThaTaKa'),
(75, 3, 'KaTaKha'),
(76, 3, 'LaBaNa'),
(77, 3, 'MaSaLa'),
(78, 3, 'BaAhNa'),
(79, 3, 'LaThaNa'),
(80, 3, 'PhaAhNa'),
(81, 3, 'ThaTaNa'),
(82, 3, 'WaLaMa'),
(83, 3, 'PhaPaNa'),
(84, 3, 'KaMaMa'),
(85, 3, 'BaThaSah'),
(86, 4, 'HtaTaLa'),
(87, 4, 'KaPaLa'),
(88, 4, 'MaTaNa'),
(89, 4, 'PaLaWa'),
(90, 4, 'TaTaNa'),
(91, 4, 'MaTaPa'),
(92, 4, 'PhaLaNa'),
(93, 4, 'HaKhaNa'),
(94, 4, 'SahMaNa'),
(95, 4, 'TaZaNa'),
(96, 4, 'KaKhaNa'),
(97, 4, 'RaZaNa'),
(98, 4, 'RaKhaDa'),
(99, 5, 'AhYaTa'),
(100, 5, 'BhaMaNa'),
(101, 5, 'BaTaLa'),
(102, 5, 'KhaAuNa'),
(103, 5, 'KhaTaNa'),
(104, 5, 'HaMaLa'),
(105, 5, 'AhTaNa'),
(106, 5, 'KaLaNa'),
(107, 5, 'KaLaHta'),
(108, 5, 'KaLaWa'),
(109, 5, 'KaBaLa'),
(110, 5, 'AhHtaNa'),
(111, 5, 'KaNaNa'),
(112, 5, 'KaThaNa'),
(113, 5, 'KaLaTa'),
(114, 5, 'KaSaLa'),
(115, 5, 'HtaPaKha'),
(116, 5, 'LaHaNa'),
(117, 5, 'LaYaNa'),
(118, 5, 'MaPaLa'),
(119, 5, 'SaMaYa'),
(120, 5, 'MaLaNa'),
(121, 5, 'MaKaNa'),
(122, 5, 'MaYaNa'),
(123, 5, 'MaMaNa'),
(124, 5, 'DaHaNa'),
(125, 5, 'NaYaNa'),
(126, 5, 'PaSaNa'),
(127, 5, 'PaLaNa'),
(128, 5, 'PhaPaNa'),
(129, 5, 'PaLaBa'),
(130, 5, 'SaKaNa'),
(131, 5, 'SaLaKa'),
(132, 5, 'KaMaNa'),
(133, 5, 'YaBaNa'),
(134, 5, 'DaPaYa'),
(135, 5, 'TaMaNa'),
(136, 5, 'MaThaNa'),
(137, 5, 'TaSaNa'),
(138, 5, 'HtaKhaNa'),
(139, 5, 'KaLaTha'),
(140, 5, 'NagSaNa'),
(141, 5, 'TaAuNa'),
(142, 5, 'DaKaNa'),
(143, 5, 'AhMaZa'),
(144, 5, 'WaLaNa'),
(145, 5, 'WaThaNa'),
(146, 5, 'YaAuNa'),
(147, 5, 'YaMaPa'),
(148, 5, 'MaMaTa'),
(149, 5, 'KhaAuTa'),
(150, 5, 'KhaPaNa'),
(151, 5, 'HpaPaNa'),
(152, 5, 'LaHaNa'),
(153, 5, 'NagZaNa'),
(154, 6, 'BaPaNa'),
(155, 6, 'HtaWaNa'),
(156, 6, 'AhMaYa'),
(157, 6, 'KaYaYa'),
(158, 6, 'KaPaNa'),
(159, 6, 'KaThaMa'),
(160, 6, 'HaThaTa'),
(161, 6, 'KhaMaKa'),
(162, 6, 'MaMaLa'),
(163, 6, 'KaThaNa'),
(164, 6, 'KaSaNa'),
(165, 6, 'MaAaNa'),
(166, 6, 'LaLaNa'),
(167, 6, 'MaMaNa'),
(168, 6, 'MaAhYa'),
(169, 6, 'PaLaNa'),
(170, 6, 'TaThaya'),
(171, 6, 'ThaYaKha'),
(172, 6, 'YaPhaNa'),
(173, 6, 'MaTaNa'),
(174, 6, 'KaLaAh'),
(175, 6, 'PaLaTa'),
(176, 6, 'HtaWaNa'),
(177, 6, 'LaLaNa'),
(178, 6, 'MaTaNa'),
(179, 6, 'KaSaNa'),
(180, 6, 'PaLaNa'),
(181, 6, 'PaLaTa'),
(182, 6, 'KaThaNa'),
(183, 6, 'BaPaNa'),
(184, 6, 'KhaMaKa'),
(185, 6, 'MaMaNa'),
(186, 7, 'PaKhaNa'),
(187, 7, 'MaWaTa'),
(188, 7, 'DaAuNa'),
(189, 7, 'KaPaKa'),
(190, 7, 'HtaTaPa'),
(191, 7, 'KaWaNa'),
(192, 7, 'KaKaNa'),
(193, 7, 'KaTaKha'),
(194, 7, 'KaTaNa'),
(195, 7, 'LaPaTa'),
(196, 7, 'MaLaNa'),
(197, 7, 'MaNyaNa'),
(198, 7, 'NaTaTa'),
(199, 7, 'NyaLaPa'),
(200, 7, 'AhPhaNa'),
(201, 7, 'AuTaNa'),
(202, 7, 'PaTaNa'),
(203, 7, 'PaKhaTa'),
(204, 7, 'PaTaTa'),
(205, 7, 'PhaMaNa'),
(206, 7, 'PaSaTa'),
(207, 7, 'PaMaNa'),
(208, 7, 'YaTaNa'),
(209, 7, 'YaKaNa'),
(210, 7, 'TaNgaNa'),
(211, 7, 'ThaNaPa'),
(212, 7, 'ThaWaTa'),
(213, 7, 'ThaKaNa'),
(214, 7, 'WaMaNa'),
(215, 7, 'YaTaYa'),
(216, 7, 'ZaKaNa'),
(217, 7, 'NaTaLa'),
(218, 7, 'TaNgaNa'),
(219, 7, 'HtaTaPa'),
(220, 7, 'KaKaNa'),
(221, 7, 'PaKhaNa'),
(222, 7, 'KaTaKha'),
(223, 7, 'WaMaNa'),
(224, 7, 'ThaNaPa'),
(225, 7, 'KaWaNa'),
(226, 7, 'ThaWaTa'),
(227, 7, 'LaPaTa'),
(228, 7, 'MaLaNa'),
(229, 7, 'KaPaKa'),
(230, 7, 'ZaKaNa'),
(231, 7, 'PaMaNa'),
(232, 7, 'NaTaLa'),
(233, 7, 'ThaKaNa'),
(234, 7, 'PaTaTa'),
(235, 7, 'paKhaTa'),
(236, 8, 'AhLaNa'),
(237, 8, 'MaHtaNa'),
(238, 8, 'KhaMaNa'),
(239, 8, 'BaKaLa'),
(240, 8, 'GaGaNa'),
(241, 8, 'KaMaNa'),
(242, 8, 'MaKaNa'),
(243, 8, 'MaBaNa'),
(244, 8, 'MaTaNa'),
(245, 8, 'MaLaNa'),
(246, 8, 'MaMaNa'),
(247, 8, 'MaThana'),
(248, 8, 'NaMaNa'),
(249, 8, 'NgaPhaNa'),
(250, 8, 'PaKhaKa'),
(251, 8, 'PaMaNa'),
(252, 8, 'PaPhaNa'),
(253, 8, 'SaLaNa'),
(254, 8, 'KaHtaNa'),
(255, 8, 'SaMaNa'),
(256, 8, 'SaPhaNa'),
(257, 8, 'MaYaSa'),
(258, 8, 'MaGaDa'),
(259, 8, 'MaHtaLa'),
(260, 8, 'TaTaKa'),
(261, 8, 'ThaYaNa'),
(262, 8, 'HtaLaNa'),
(263, 8, 'YaNaKha'),
(264, 8, 'YaSaKa'),
(265, 8, 'MaKaNa'),
(266, 8, 'KhaMaNa'),
(267, 8, 'NaMaNa'),
(268, 8, 'MaThaNa'),
(269, 8, 'TaTaKa'),
(270, 8, 'MaBaNa'),
(271, 8, 'SaLaNa'),
(272, 8, 'MaHtaNa'),
(273, 8, 'KaMaNa'),
(274, 8, 'MaTaNa'),
(275, 8, 'MaLaNa'),
(276, 8, 'PaKhaKa'),
(277, 8, 'MaMaNa'),
(278, 8, 'PaMaNa'),
(279, 8, 'GaGaNa'),
(280, 8, 'HtaLaNa'),
(281, 8, 'KaHtaNa'),
(282, 9, 'AhMaYa'),
(283, 9, 'KhaMaSa'),
(284, 9, 'KhaMaKha'),
(285, 9, 'AhYaTa'),
(286, 9, 'ThaTaYa'),
(287, 9, 'KhaMaZa'),
(288, 9, 'NaNaMa'),
(289, 9, 'PaKhaMa'),
(290, 9, 'KaMaNa'),
(291, 9, 'AhMaZa'),
(292, 9, 'AhSaNa'),
(293, 9, 'KhaMaMa'),
(294, 9, 'MaKaKha'),
(295, 9, 'MaNaTa'),
(296, 9, 'MaYaMa'),
(297, 9, 'PaKhaKa'),
(298, 9, 'ThaWaNa'),
(299, 9, 'PaAuLa'),
(300, 9, 'MaMaNa'),
(301, 9, 'SaKaNa'),
(302, 9, 'TaTaAu'),
(303, 9, 'TaThaNa'),
(304, 9, 'ThaPaKa'),
(305, 9, 'ThaSaNa'),
(306, 9, 'WaTaNa'),
(307, 9, 'YaMaTha'),
(308, 9, 'DaKhaTha'),
(309, 9, 'LaWaNa'),
(310, 9, 'AuTaTha'),
(311, 9, 'PaBaTha'),
(312, 9, 'PaMaNa'),
(313, 9, 'TaKaNa'),
(314, 9, 'ZaBaTha'),
(315, 9, 'ZaYaTha'),
(316, 9, 'TaKaTa'),
(317, 9, 'NgaThaRa'),
(318, 9, 'MaNaTa'),
(319, 9, 'KhaMaSa'),
(320, 9, 'MaHaMa'),
(321, 9, 'PaKaKha'),
(322, 9, 'PaThaKa'),
(323, 9, 'MaMaNa'),
(324, 9, 'SaKaNa'),
(325, 9, 'TaKaTa'),
(326, 9, 'SaKaTa'),
(327, 9, 'MaThaNa'),
(328, 9, 'MaKhaNa'),
(329, 9, 'TaThaNa'),
(330, 9, 'KaPaTa'),
(331, 9, 'NaHtaKa'),
(332, 9, 'NgaZaNa'),
(333, 9, 'NgaThaRa'),
(334, 9, 'MaHtaLa'),
(335, 9, 'MaLaNa'),
(336, 9, 'ThaSaNa'),
(337, 9, 'WaTaNa'),
(338, 9, 'UTaTha'),
(339, 10, 'BaLaNa'),
(340, 10, 'KhaSaNa'),
(341, 10, 'KaMaYa'),
(342, 10, 'BaAhNa'),
(343, 10, 'KaHtaNa'),
(344, 10, 'HtarHtaNa'),
(345, 10, 'KaMaLa'),
(346, 10, 'PhaPaNa'),
(347, 10, 'MaSaNa'),
(348, 10, 'MaLaMa'),
(349, 10, 'MaDaNa'),
(350, 10, 'PaMaNa'),
(351, 10, 'ThaPhaYa'),
(352, 10, 'ThaHtaNa'),
(353, 10, 'KhaZaNa'),
(354, 10, 'LaMaNa'),
(355, 10, 'YaMaNa'),
(356, 10, 'MaDana'),
(357, 10, 'LaMaNa'),
(358, 10, 'KhaZaNa'),
(359, 10, 'ThaHtaNa'),
(360, 10, 'PaMaNa'),
(361, 10, 'KaHtaNa'),
(362, 10, 'PaMaNa'),
(363, 10, 'KaHtaNa'),
(364, 10, 'BaLaNa'),
(365, 11, 'AhMaNa'),
(366, 11, 'BaThaTa'),
(367, 11, 'GaMaNa'),
(368, 11, 'KaTaLa'),
(369, 11, 'KaPhaNa'),
(370, 11, 'KaTaNa'),
(371, 11, 'MaMaNa'),
(372, 11, 'MaTaNa'),
(373, 11, 'TaPaWa'),
(374, 11, 'MaAuNu'),
(375, 11, 'MaPaNa'),
(376, 11, 'PaTaNa'),
(377, 11, 'PaNaTa'),
(378, 11, 'PaNaKa'),
(379, 11, 'YaBhaNa'),
(380, 11, 'YaThaTa'),
(381, 11, 'YaTaNa'),
(382, 11, 'MaPaTa'),
(383, 11, 'YaTaTha'),
(384, 11, 'LaMaTa'),
(385, 11, 'SaTaNa'),
(386, 11, 'ThaTaNa'),
(387, 11, 'MaAhNa'),
(388, 11, 'TaKaNa'),
(389, 11, 'ThaGaKa'),
(390, 11, 'MaAhTa'),
(391, 11, 'RaThaTa'),
(392, 11, 'MaUNa'),
(393, 11, 'RaBaNa'),
(394, 12, 'AhLaNa'),
(395, 12, 'BhaHaNa'),
(396, 12, 'BhaTaHta'),
(397, 12, 'KaKaKa'),
(398, 12, 'DaGaNa'),
(399, 12, 'DaDaSa'),
(400, 12, 'DaLaNa'),
(401, 12, 'DaPaNa'),
(402, 12, 'DaGaYa'),
(403, 12, 'LaMaNa'),
(404, 12, 'LaThaya'),
(405, 12, 'LaKaNa'),
(406, 12, 'MaBaNa'),
(407, 12, 'HtaTaPa'),
(408, 12, 'AhSaNa'),
(409, 12, 'KaMaya'),
(410, 12, 'SaKaKha'),
(411, 12, 'KaMaNa'),
(412, 12, 'KhaYaNa'),
(413, 12, 'KaKhaKa'),
(414, 12, 'KaTaTa'),
(415, 12, 'KaTaNa'),
(416, 12, 'KaMaTa'),
(417, 12, 'LaMaTa'),
(418, 12, 'LaThaNa'),
(419, 12, 'MaYaKa'),
(420, 12, 'MaGaDa'),
(421, 12, 'MaGaTa'),
(422, 12, 'DaGaMa'),
(423, 12, 'MaAuKa'),
(424, 12, 'AuKaMa'),
(425, 12, 'PaBaTa'),
(426, 12, 'PaZaTa'),
(427, 12, 'SaKhaNa'),
(428, 12, 'SaKaNa'),
(429, 12, 'YaPaTha'),
(430, 12, 'DaGaTa'),
(431, 12, 'AuKaTa'),
(432, 12, 'TaAuKa'),
(433, 12, 'TaKaNa'),
(434, 12, 'TaMaNa'),
(435, 12, 'ThaKaTa'),
(436, 12, 'ThaLaNa'),
(437, 12, 'ThaGaKa'),
(438, 12, 'ThaKhaNa'),
(439, 12, 'TaTaNa'),
(440, 12, 'YaKaNa'),
(441, 12, 'TaTaTa'),
(442, 12, 'DaGaSa'),
(443, 12, 'RaKaNa'),
(444, 12, 'UKaTa'),
(445, 12, 'UKaMa'),
(446, 12, 'MaGaTa'),
(447, 12, 'DaGaMa'),
(448, 12, 'KaKaKa'),
(449, 12, 'RaPaTha'),
(450, 13, 'MaMaNa'),
(451, 13, 'MaPaNa'),
(452, 13, 'HaPaNa'),
(453, 13, 'ThaNaNa'),
(454, 13, 'SaSaNa'),
(455, 13, 'ThaPaNa'),
(456, 13, 'KaLaNa'),
(457, 13, 'KaTaNa'),
(458, 13, 'KaKaNa'),
(459, 13, 'MaHtaTa'),
(460, 13, 'KaHaNa'),
(461, 13, 'KaKhaNa'),
(462, 13, 'TaMaNya'),
(463, 13, 'KaMaNa'),
(464, 13, 'KaMaNa'),
(465, 13, 'MaNgaNa'),
(466, 13, 'KaThaNa'),
(467, 13, 'LaKhaNa'),
(468, 13, 'HaMaNa'),
(469, 13, 'LaYaNa'),
(470, 13, 'KhaYaHa'),
(471, 13, 'LaKaNa'),
(472, 13, 'YaSaNa'),
(473, 13, 'LaLaNa'),
(474, 13, 'MaBaNa'),
(475, 13, 'MaTaNa'),
(476, 13, 'MaKhaTa'),
(477, 13, 'MaSaNa'),
(478, 13, 'MaPhaTa'),
(479, 13, 'MaPhaNa'),
(480, 13, 'MaLaNa'),
(481, 13, 'MaNaNa'),
(482, 13, 'TaTaNa'),
(483, 13, 'PaPaKa'),
(484, 13, 'MaYaTa'),
(485, 13, 'MaYaNa'),
(486, 13, 'MaHaYa'),
(487, 13, 'MaKaNa'),
(488, 13, 'MaSaTa'),
(489, 13, 'WaKana'),
(490, 13, 'NaKhaNa'),
(491, 13, 'NaSana'),
(492, 13, 'NaPhana'),
(493, 13, 'KhaLaNa'),
(494, 13, 'NaTaNa'),
(495, 13, 'NaMaTa'),
(496, 13, 'NyaYaNa'),
(497, 13, 'MaKhaNa'),
(498, 13, 'PaSaNa'),
(499, 13, 'PaWaNa'),
(500, 13, 'PhaKhaNa'),
(501, 13, 'PaTaYa'),
(502, 13, 'PaLaNa'),
(503, 13, 'TaKhaLa'),
(504, 13, 'TaYaNa'),
(505, 13, 'TaKaNa'),
(506, 13, 'KaTaLa'),
(507, 13, 'YaNyaNa'),
(508, 13, 'YaNgaNa'),
(509, 13, 'MaMaTa'),
(510, 13, 'NaTaRa'),
(511, 13, 'AhTaNa'),
(512, 13, 'PaLaTa'),
(513, 13, 'MaNaTa'),
(514, 13, 'KaLaDa'),
(515, 13, 'LaKhaTa'),
(516, 13, 'KaTaTa'),
(517, 13, 'KaLaTa'),
(518, 13, 'PaYaNa'),
(519, 13, 'MaKaHta'),
(520, 13, 'NaKhaNa'),
(521, 13, 'MaKaTa'),
(522, 13, 'PaSahTa'),
(523, 13, 'NaKhaTa'),
(524, 13, 'MaTaTa'),
(525, 13, 'MaLaTa'),
(526, 13, 'HaPaTa'),
(527, 13, 'MaMaHta'),
(528, 13, 'PaLaHta'),
(529, 13, 'LaKaNa'),
(530, 13, 'MaPaHta'),
(531, 13, 'MaPaTa'),
(532, 13, 'MaHtaNa'),
(533, 13, 'MaYaHta'),
(534, 13, 'TaLaNa'),
(535, 13, 'KaLaHta'),
(536, 13, 'MaHpaTa'),
(537, 14, 'BaKaLa'),
(538, 14, 'DaNaPha'),
(539, 14, 'DaDaYa'),
(540, 14, 'KaMaNa'),
(541, 14, 'PaKaKha'),
(542, 14, 'HaThaTa'),
(543, 14, 'AhGaPa'),
(544, 14, 'TaMaNa'),
(545, 14, 'KaKaHta'),
(546, 14, 'KaLaNa'),
(547, 14, 'KaKhaNa'),
(548, 14, 'KaKaNa'),
(549, 14, 'KaPaNa'),
(550, 14, 'LaPaTa'),
(551, 14, 'PaSaLa'),
(552, 14, 'LaMaNa'),
(553, 14, 'MaAhBa'),
(554, 14, 'MaMaKa'),
(555, 14, 'MaAhNa'),
(556, 14, 'AhPaNa'),
(557, 14, 'MaMaNa'),
(558, 14, 'HaKaKa'),
(559, 14, 'NgaPaTa'),
(560, 14, 'NgaYaKa'),
(561, 14, 'NyaTaNa'),
(562, 14, 'PaTaNa'),
(563, 14, 'YaThaYa'),
(564, 14, 'MaYaKa'),
(565, 14, 'AhSaNa'),
(566, 14, 'PathaYa'),
(567, 14, 'PathaNa'),
(568, 14, 'NgaSaNa'),
(569, 14, 'AhMaNa'),
(570, 14, 'KaMaTha'),
(571, 14, 'PhaPaNa'),
(572, 14, 'ThaPaNa'),
(573, 14, 'WaKhaMa'),
(574, 14, 'YaKaNa'),
(575, 14, 'NgaThaKha'),
(576, 14, 'ZaLaNa'),
(577, 14, 'AhMaTa'),
(578, 14, 'RaThaYa'),
(579, 14, 'NgaHsaNa'),
(580, 14, 'MaAhPa');

-- --------------------------------------------------------

--
-- Table structure for table `remain_stock`
--

CREATE TABLE `remain_stock` (
  `remain_id` int(11) NOT NULL,
  `remain_quantity` int(11) NOT NULL,
  `remain_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) NOT NULL,
  `sale_quantity` int(100) NOT NULL,
  `sale_total_price` int(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `sale_price` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_info`
--

CREATE TABLE `shop_info` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `open_hour` varchar(255) NOT NULL,
  `fb_link` varchar(255) NOT NULL,
  `insta_link` varchar(255) NOT NULL,
  `twt_link` varchar(255) NOT NULL,
  `linkin_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Dumping data for table `shop_info`
--

INSERT INTO `shop_info` (`id`, `location`, `email`, `phone`, `open_hour`, `fb_link`, `insta_link`, `twt_link`, `linkin_link`) VALUES
(1, 'အမှတ် (၁၃) ၊ ညောင်တုန်းလမ်း ၊ စမ်းချောင်း', 'exampleZaw@gmail.com', '၀၉ ၂၅၄၀၇၃၈၉၆', '7 AM', 'https//facebook link', 'https//instagram link..', 'https//twt_link', '');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `sale_quantity` int(11) NOT NULL,
  `sale_total_price` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2 COLLATE=ucs2_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `change_price`
--
ALTER TABLE `change_price`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copier`
--
ALTER TABLE `copier`
  ADD PRIMARY KEY (`copier_id`),
  ADD KEY `emp_name` (`emp_name`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_name`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_stock`
--
ALTER TABLE `in_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `category_id_2` (`category_id`),
  ADD KEY `category_id_3` (`category_id`),
  ADD KEY `category_id_4` (`category_id`),
  ADD KEY `category_id_5` (`category_id`);

--
-- Indexes for table `item_noti`
--
ALTER TABLE `item_noti`
  ADD PRIMARY KEY (`noti_id`),
  ADD KEY `item_noti_ibfk_1` (`item_id`);

--
-- Indexes for table `nrc`
--
ALTER TABLE `nrc`
  ADD PRIMARY KEY (`nrc_id`);

--
-- Indexes for table `remain_stock`
--
ALTER TABLE `remain_stock`
  ADD PRIMARY KEY (`remain_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `price_id` (`price_id`);

--
-- Indexes for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`stock_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `change_price`
--
ALTER TABLE `change_price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `copier`
--
ALTER TABLE `copier`
  MODIFY `copier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `in_stock`
--
ALTER TABLE `in_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `item_noti`
--
ALTER TABLE `item_noti`
  MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nrc`
--
ALTER TABLE `nrc`
  MODIFY `nrc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=581;

--
-- AUTO_INCREMENT for table `remain_stock`
--
ALTER TABLE `remain_stock`
  MODIFY `remain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `change_price`
--
ALTER TABLE `change_price`
  ADD CONSTRAINT `change_price_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `change_price_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `in_stock` (`stock_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `copier`
--
ALTER TABLE `copier`
  ADD CONSTRAINT `copier_ibfk_1` FOREIGN KEY (`emp_name`) REFERENCES `employee` (`emp_name`) ON DELETE CASCADE;

--
-- Constraints for table `in_stock`
--
ALTER TABLE `in_stock`
  ADD CONSTRAINT `in_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_noti`
--
ALTER TABLE `item_noti`
  ADD CONSTRAINT `item_noti_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `remain_stock`
--
ALTER TABLE `remain_stock`
  ADD CONSTRAINT `remain_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `remain_stock_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `in_stock` (`stock_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_ibfk_3` FOREIGN KEY (`price_id`) REFERENCES `change_price` (`price_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
