-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 08:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `date`) VALUES
(1, 'ELECTROMECHANICAL EQUIPMENT', '2022-05-11 06:08:30'),
(2, 'DRILLS', '2022-05-11 06:10:07'),
(3, 'SCAFFOLDING', '2022-05-11 06:10:16'),
(4, 'POWER GENERATORS', '2022-05-11 06:10:23'),
(5, 'CONSTRUCTION EQUIPMENT', '2022-05-11 06:10:33'),
(6, 'tractor', '2022-05-13 04:07:56'),
(8, 'Clothes', '2022-12-11 19:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_document` int(11) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `birthday` date NOT NULL,
  `total_purchases` int(11) NOT NULL,
  `last_purchases` datetime NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `id_document`, `email`, `phone`, `address`, `birthday`, `total_purchases`, `last_purchases`, `last_login`) VALUES
(4, 'Daw Aye Nu', 6755959, 'ayenu@gmail.com', '0998932323', 'Sagaing', '1992-02-02', 21, '2022-07-22 09:30:50', '2022-07-22 07:30:50'),
(5, 'Min Min', 98777663, 'minmin@gmail.com', '0993929993', 'Sagaing', '1992-02-09', 5, '0000-00-00 00:00:00', '2022-07-17 04:20:45'),
(9, 'Mi Lay', 343434434, 'milay@gmial.com', '95099392999', 'natchaung road', '1992-02-02', 11, '2022-07-17 06:25:29', '2022-07-17 04:25:29'),
(11, 'Kyaw Lay', 23233232, 'kyawlay123@gmail.com', '95099392999', 'yangon', '1986-01-05', 1, '0000-00-00 00:00:00', '2022-12-11 18:39:05'),
(13, 'kaunglay', 3232, 'kaunglay@gmail.com', '0932323232', 'yangon', '1986-01-05', 140, '2022-12-11 20:10:15', '2022-12-11 19:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) NOT NULL,
  `buying_price` float NOT NULL,
  `selling_price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `code`, `description`, `image`, `stock`, `buying_price`, `selling_price`, `quantity`, `date`) VALUES
(2, 1, '102', 'Float Plate for Palletizer', 'views/img/products/102/915.jpg', 10, 4500, 6300, -10, '2022-07-17 04:28:11'),
(3, 1, '103', 'Air Compressor for painting', 'views/img/products/103/145.jpg', 10, 3000, 4200, 20, '2022-07-17 04:27:58'),
(4, 1, '104', 'Adobe Cutter without Disk', 'views/img/products/104/471.jpg', 5, 4000, 5600, -5, '2022-07-17 04:28:11'),
(5, 1, '105', 'Floor Cutter without Disk', 'views/img/products/105/599.jpg', 18, 1540, 2156, 2, '2022-12-11 18:38:51'),
(6, 1, '106', 'Diamond Tip Disk', 'views/img/products/106/426.jpg', 1, 1100, 1540, -1, '2022-12-11 18:39:05'),
(7, 1, '107', 'Air extractor', 'views/img/products/107/408.jpg', 5, 1540, 2156, -5, '2022-12-11 18:36:39'),
(8, 1, '108', 'Mower', 'views/img/products/108/207.jpg', 1, 1540, 2156, -1, '2022-07-17 04:28:20'),
(9, 1, '109', 'Electric Water Washer', 'views/img/products/109/869.jpg', 1, 2600, 3640, -1, '2022-07-17 04:28:20'),
(10, 1, '110', 'Petrol pressure washer', 'views/img/products/110/678.jpg', 19, 2210, 3094, 1, '2022-12-11 18:38:51'),
(11, 1, '111', 'Gasoline motor pump', 'views/img/products/111/627.jpg', 10, 2860, 4004, 10, '2022-07-17 04:25:28'),
(12, 1, '112', 'Electric motor pump', 'views/img/products/112/286.jpg', 20, 2400, 3360, 0, '2022-07-11 02:59:44'),
(13, 1, '113', 'Circular saw', '', 20, 1100, 1540, 0, '2022-07-11 03:00:30'),
(14, 1, '114', 'Tungsten disc for circular saw', '', 20, 4500, 6300, 0, '2022-07-11 03:00:30'),
(15, 1, '115', 'Electric welder', '', 20, 1980, 2772, 0, '2022-07-11 02:58:19'),
(16, 1, '116', 'Welders face', '', 20, 4200, 5880, 0, '2022-07-11 02:58:16'),
(17, 1, '117', 'Illumination tower', '', 20, 1800, 2520, 0, '2022-07-11 02:58:12'),
(18, 2, '201', 'Floor Demolishing Hammer 110V', '', 20, 5600, 7840, 0, '2022-07-11 02:58:04'),
(19, 2, '202', 'Muela or chisel hammer demolishing floor', '', 20, 9600, 13440, 0, '2022-07-11 02:58:00'),
(20, 2, '203', 'Wall Wrecking Drill 110V', '', 20, 3850, 5390, 0, '2022-07-11 02:59:44'),
(21, 2, '204', 'Muela or chisel hammer demolition wall', '', 20, 9600, 13440, 0, '2022-07-11 02:58:28'),
(22, 2, '205', '1/2 Hammer Drill Wood and Metal', '', 20, 8000, 11200, 0, '2022-07-11 03:00:30'),
(23, 2, '206', 'Drill Percussion SDS Plus 110V', '', 20, 3900, 5460, 0, '2022-07-11 02:58:22'),
(24, 2, '207', 'Drill Percussion SDS Max 110V (Mining)', '', 20, 4600, 6440, 0, '2022-07-11 02:59:44'),
(25, 3, '301', 'Hanging scaffolding', '', 20, 1440, 2016, 0, '2022-07-11 02:59:44'),
(26, 3, '302', 'Scaffolding hanging spacer', '', 20, 1600, 2240, 0, '2022-07-11 02:59:44'),
(27, 3, '303', 'Modular scaffolding frame', '', 20, 900, 1260, 0, '2022-07-11 02:59:44'),
(28, 3, '304', 'Frame scaffolding scissors', '', 20, 100, 140, 0, '2022-07-11 02:59:44'),
(29, 3, '305', 'Scaffolding scissors', '', 20, 162, 226.8, 0, '0000-00-00 00:00:00'),
(30, 3, '306', 'Internal ladder for scaffolding', '', 20, 270, 378, 0, '0000-00-00 00:00:00'),
(31, 3, '307', 'Security handrails', '', 20, 75, 105, 0, '0000-00-00 00:00:00'),
(32, 3, '308', 'Rotating wheel for scaffolding', '', 20, 168, 235.2, 0, '0000-00-00 00:00:00'),
(33, 3, '309', 'safety harness', '', 20, 1750, 2450, 0, '0000-00-00 00:00:00'),
(34, 3, '310', 'Sling for harness', '', 20, 175, 245, 0, '0000-00-00 00:00:00'),
(35, 3, '311', 'Metallic Platform', '', 20, 420, 588, 0, '0000-00-00 00:00:00'),
(36, 4, '401', '6 Kva Diesel Power Plant', '', 20, 3500, 4900, 0, '0000-00-00 00:00:00'),
(37, 4, '402', '10 Kva Diesel Power Plant', '', 20, 3550, 4970, 0, '2022-07-11 03:00:30'),
(38, 4, '403', '20 Kva Diesel Power Plant', '', 20, 3600, 5040, 0, '0000-00-00 00:00:00'),
(39, 4, '404', '30 Kva Diesel Power Plant', '', 20, 3650, 5110, 0, '0000-00-00 00:00:00'),
(40, 4, '405', '60 Kva Diesel Power Plant', '', 20, 3700, 5180, 0, '0000-00-00 00:00:00'),
(41, 4, '406', '75 Kva Diesel Power Plant', '', 20, 3750, 5250, 0, '0000-00-00 00:00:00'),
(42, 4, '407', '100 Kva Diesel Power Plant', '', 20, 3800, 5320, 0, '2022-07-11 03:00:30'),
(43, 4, '408', '120 Kva Diesel Power Plant', '', 20, 3850, 5390, 0, '0000-00-00 00:00:00'),
(44, 5, '501', 'Aluminum Scissor Ladder', '', 20, 350, 490, 0, '0000-00-00 00:00:00'),
(45, 5, '502', 'Electric extension', '', 20, 370, 518, 0, '0000-00-00 00:00:00'),
(46, 5, '503', 'Tensioner cat', '', 20, 380, 532, 0, '0000-00-00 00:00:00'),
(47, 5, '504', 'Lamina Covers Gap', '', 20, 380, 532, 0, '0000-00-00 00:00:00'),
(48, 5, '505', 'Pipe wrench', '', 20, 480, 672, 0, '0000-00-00 00:00:00'),
(49, 5, '506', 'Manila by Metro', '', 20, 600, 840, 0, '0000-00-00 00:00:00'),
(50, 5, '507', '2-channel pulley', '', 20, 900, 1260, 0, '0000-00-00 00:00:00'),
(51, 5, '508', 'Tensor', '', 20, 100, 140, 0, '0000-00-00 00:00:00'),
(52, 5, '509', 'Weighing machine', '', 20, 130, 182, 0, '0000-00-00 00:00:00'),
(53, 5, '510', 'Hydrostatic pump', '', 20, 770, 1078, 0, '0000-00-00 00:00:00'),
(54, 5, '511', 'Chapeta', '', 20, 660, 924, 0, '0000-00-00 00:00:00'),
(55, 5, '512', 'Concrete sample cylinder', '', 20, 400, 560, 0, '0000-00-00 00:00:00'),
(56, 5, '513', 'Lever Shear', '', 20, 450, 630, 0, '0000-00-00 00:00:00'),
(57, 5, '514', 'Scissor Shear', '', 20, 580, 812, 0, '0000-00-00 00:00:00'),
(58, 5, '515', 'Pneumatic tire car', '', 20, 420, 588, 0, '0000-00-00 00:00:00'),
(59, 5, '516', 'Cone slump', '', 20, 140, 196, 0, '0000-00-00 00:00:00'),
(60, 5, '517', 'Baldosin cutter', '', 20, 930, 1302, 0, '0000-00-00 00:00:00'),
(158, 3, '312', 'Mini Tractor', 'views/img/products/312/429.jpg', 20, 280000, 392000, 0, '2022-07-11 02:59:44'),
(161, 3, '313', 'banana', 'views/img/products/313/331.jpg', 20, 5, 6.45, 0, '2022-07-11 02:59:44'),
(164, 1, '118', 'camera', 'views/img/products/118/396.jpg', 20, 8000, 11200, 0, '2022-07-13 05:05:52'),
(166, 8, '801', 'girl Shirt', 'views/img/products/801/698.jpg', 1900, 7000, 9100, 100, '2022-12-11 19:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `taxes` float NOT NULL,
  `net_price` float NOT NULL,
  `total` float NOT NULL,
  `payment_method` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `code`, `client_id`, `seller_id`, `products`, `taxes`, `net_price`, `total`, `payment_method`, `date`) VALUES
(81, 1004, 9, 11, '[{\"id\":\"11\",\"description\":\"Gasoline motor pump\",\"quantity\":\"10\",\"stock\":\"10\",\"price\":\"4004\",\"totalPrice\":\"40040\"},{\"id\":\"8\",\"description\":\"Mower\",\"quantity\":\"1\",\"stock\":\"17\",\"price\":\"2156\",\"totalPrice\":\"2156\"}]', 8439.2, 42196, 50635.2, 'CC-232567323434', '2022-07-17 04:25:29'),
(82, 1005, 4, 11, '[{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"quantity\":\"10\",\"stock\":\"10\",\"price\":\"4200\",\"totalPrice\":\"42000\"}]', 8400, 42000, 50400, 'CC-8892567323434', '2022-07-17 04:27:58'),
(83, 1005, 4, 11, '[{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"quantity\":\"10\",\"stock\":\"10\",\"price\":\"4200\",\"totalPrice\":\"42000\"}]', 8400, 42000, 50400, 'CC-8892567323434', '2022-07-17 04:27:58'),
(84, 1006, 4, 11, '[{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"2156\",\"totalPrice\":\"2156\"}]', 409.64, 2156, 2565.64, 'DC-1233445645454', '2022-07-22 07:30:50'),
(85, 1007, 12, 11, '[{\"id\":\"10\",\"description\":\"Petrol pressure washer\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"3094\",\"totalPrice\":\"3094\"},{\"id\":\"5\",\"description\":\"Floor Cutter without Disk\",\"quantity\":\"1\",\"stock\":\"18\",\"price\":\"2156\",\"totalPrice\":\"2156\"}]', 1050, 5250, 6300, 'CC-3443344333456', '2022-12-11 18:38:51'),
(86, 1008, 13, 22, '[{\"id\":\"166\",\"description\":\"girl Shirt\",\"quantity\":\"40\",\"stock\":\"1960\",\"price\":\"9100\",\"totalPrice\":\"364000\"}]', 72800, 364000, 436800, 'CC-332241425453', '2022-12-11 19:08:07'),
(87, 1009, 13, 22, '[{\"id\":\"166\",\"description\":\"girl Shirt\",\"quantity\":\"60\",\"stock\":\"1900\",\"price\":\"9100\",\"totalPrice\":\"546000\"}]', 109200, 546000, 655200, 'cash', '2022-12-11 19:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `status` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `password`, `profile`, `photo`, `status`, `last_login`, `date`) VALUES
(11, 'Admin', 'admin', '$2a$07$usesomesillystringforeaukJGqKyjM.17r0oegwMm5vRFfPVfju', 'Administrator', 'views/img/users/admin/682.jpg', 1, '2022-12-11 13:59:35', '2022-12-11 18:59:35'),
(16, 'Soe Win', 'soewin', '$2a$07$usesomesillystringforeaukJGqKyjM.17r0oegwMm5vRFfPVfju', 'Staff', 'views/img/users/soewin/224.jpg', 1, '2022-07-13 00:04:45', '2022-07-13 05:04:45'),
(17, 'Aung Min Thant', 'aungMin', '$2a$07$usesomesillystringforeaukJGqKyjM.17r0oegwMm5vRFfPVfju', 'Staff', 'views/img/users/aungMin/425.jpg', 1, '0000-00-00 00:00:00', '2022-07-15 02:46:34'),
(19, 'Kyaw Myo Thant', 'KyawLay', '$2a$07$usesomesillystringforeaukJGqKyjM.17r0oegwMm5vRFfPVfju', 'Administrator', 'views/img/users/KyawLay/590.jpg', 1, '2022-05-18 23:47:09', '2022-12-11 19:10:56'),
(22, 'kaung kaung', 'kaungkaung', '$2a$07$usesomesillystringforept8AZ4o8WzXLD0p9qj6ZyZ6jAhynIUu', 'Staff', 'views/img/users/kaungkaung/680.jpg', 1, '2022-12-11 14:00:03', '2022-12-11 19:00:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
