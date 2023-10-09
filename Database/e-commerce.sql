-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 07:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `ad_id` int(11) NOT NULL,
  `ad_email` varchar(55) NOT NULL,
  `ad_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`ad_id`, `ad_email`, `ad_password`) VALUES
(1, 'arif@gmail.com', 'what'),
(3, 'ar@gmail.com', 'ar');

-- --------------------------------------------------------

--
-- Table structure for table `e_contacts`
--

CREATE TABLE `e_contacts` (
  `sno` int(11) NOT NULL,
  `c_name` varchar(55) NOT NULL,
  `c_email` varchar(55) NOT NULL,
  `c_phone` varchar(15) NOT NULL,
  `c_message` text NOT NULL,
  `c_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `e_order`
--

CREATE TABLE `e_order` (
  `o_id` int(11) NOT NULL,
  `o_user_email` varchar(55) NOT NULL,
  `o_place` varchar(55) NOT NULL,
  `o_pincode` int(11) NOT NULL,
  `o_proper_address` varchar(255) NOT NULL,
  `o_longitude` varchar(20) NOT NULL,
  `o_latitude` varchar(20) NOT NULL,
  `o_payment_type` varchar(55) NOT NULL,
  `o_payment_status` varchar(55) NOT NULL,
  `o_order_status` varchar(55) NOT NULL,
  `o_total_price` float NOT NULL,
  `o_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `e_order`
--

INSERT INTO `e_order` (`o_id`, `o_user_email`, `o_place`, `o_pincode`, `o_proper_address`, `o_longitude`, `o_latitude`, `o_payment_type`, `o_payment_status`, `o_order_status`, `o_total_price`, `o_date`) VALUES
(1, 'arifpir@gmail.com', 'handwara', 193221, 'proper handwara chowk', '34,59383', '24,38304', 'cod', 'pending', 'cancelled', 3036, '2023-07-03 23:59:36'),
(2, 'arifpir@gmail.com', 'wadipora', 193221, '3', 'ddg', 'hg', 'cod', 'pending', 'processing', 15, '2023-07-04 00:53:39'),
(3, 'arifpir@gmail.com', 'handwara', 34, 'e', 'dsd', 'gfr', 'payNow', 'pending', 'pending', 599, '2023-07-11 19:04:03'),
(4, 'arifpir@gmail.com', 'handwara', 34, 'e', 'dsd', 'gfr', 'payNow', 'pending', 'pending', 599, '2023-07-11 19:04:28'),
(5, 'arifpir@gmail.com', 'handwara', 34, 'e', 'dsd', 'gfr', 'payNow', 'pending', 'pending', 599, '2023-07-11 19:04:40'),
(6, 'arifpir@gmail.com', 'handwara', 34, 'e', 'dsd', 'gfr', 'cod', 'success', 'pending', 599, '2023-07-11 19:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `e_order_detail`
--

CREATE TABLE `e_order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(55) NOT NULL,
  `product_id` int(55) NOT NULL,
  `price` int(55) NOT NULL,
  `quantity` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `e_order_detail`
--

INSERT INTO `e_order_detail` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 7, 334, 9),
(2, 1, 8, 3, 1),
(3, 1, 10, 3, 9),
(4, 2, 8, 3, 5),
(5, 3, 11, 599, 1),
(6, 4, 11, 599, 1),
(7, 5, 11, 599, 1),
(8, 6, 11, 599, 1);

-- --------------------------------------------------------

--
-- Table structure for table `e_product`
--

CREATE TABLE `e_product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pr_name` varchar(55) NOT NULL,
  `pr_price` int(30) NOT NULL,
  `pr_qty` int(55) NOT NULL,
  `pr_short_desc` text NOT NULL,
  `pr_description` text NOT NULL,
  `pr_fimage` varchar(60) NOT NULL,
  `pr_simage` varchar(60) NOT NULL,
  `pr_timage` varchar(60) NOT NULL,
  `pr_fourthImage` varchar(60) NOT NULL,
  `pr_fifthImage` varchar(60) NOT NULL,
  `pr_meta_desc` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `e_product`
--

INSERT INTO `e_product` (`id`, `category_id`, `pr_name`, `pr_price`, `pr_qty`, `pr_short_desc`, `pr_description`, `pr_fimage`, `pr_simage`, `pr_timage`, `pr_fourthImage`, `pr_fifthImage`, `pr_meta_desc`) VALUES
(40, 34, 'Ivory Cloud Classic', 599, 100, 'Introducing the Ivory Cloud Classic - Where Simplicity Meets Sophistication!\r\n\r\nElevate your wardrobe with our timeless and versatile white t-shirt. Crafted with meticulous attention to detail, the Pure Elegance Tee redefines the classic white top, offering a blend of comfort, style, and understated luxury.\r\n\r\nMade from the finest, high-quality cotton, this tee feels like a gentle embrace against your skin, providing day-long comfort no matter where life takes you. Its soft, breathable fabric ensures you stay cool and comfortable during the warmest summer days, while also providing a cozy layer when temperatures drop', 'The \"Pure Elegance Tee\" embodies minimalist sophistication, featuring a clean, sleek design that effortlessly complements any outfit. Whether you\'re pairing it with jeans for a casual day out, dressing it up with a blazer for a chic evening look, or layering it under your favorite sweater, this shirt effortlessly adapts to your unique style.\r\n\r\nThe crisp, radiant white color of this shirt serves as a blank canvas for your self-expression. Let your creativity shine by accessorizing or customizing it to suit your mood and personality. Whether you\'re into bold graphics, statement jewelry, or simply letting the shirt\'s pristine simplicity speak for itself, the Pure Elegance Tee is the perfect foundation for your fashion endeavors.\r\n\r\nExperience the timelessness of a classic white tee with the added touch of elegance. Elevate your everyday style and embrace the versatility of the \"Pure Elegance Tee\" – because sometimes, less truly is more. Embrace simplicity, embrace sophistication, and embrace comfort with every wear. Upgrade your wardrobe today with this essential piece that effortlessly complements your individuality.', '65243505bc7160.42852756.jpg', '65243505bc8683.37789545.jpg', '65243505bc8f91.37002934.jpg', '65243505bc96c5.52378783.jpg', '65243505bca2f7.05285927.jpg', 't-shirt'),
(41, 34, 'Ebony Elegance', 899, 100, 'Wrap yourself in the exquisite allure of our \"Midnight Cozy\" black sweater, a versatile and timeless addition to your wardrobe. Crafted with meticulous attention to detail, this sweater offers not just warmth, but an embodiment of elegance and comfort.\r\n\r\nThe rich, deep black hue of the sweater, reminiscent of a moonless night, makes it an effortlessly chic choice for any occasion. Whether you\'re heading to a casual dinner with friends, a day at the office, or a cozy night by the fireplace, the \"Midnight Cozy\" sweater effortlessly elevates your style.', 'Our sweater is made from high-quality, soft knit fabric that feels gentle against your skin. The relaxed fit drapes gracefully, providing a flattering silhouette for various body types. The ribbed cuffs and hem add a touch of texture while keeping you snug and warm. The classic crew neck design and long sleeves make it perfect for layering during the colder months or wearing on its own in milder weather.\r\n\r\nEmbrace the versatility of the \"Midnight Cozy\" black sweater and pair it with your favorite jeans for a casual look, dress it up with a statement necklace and slacks for a professional ensemble, or throw it over a dress for a stylish contrast. It\'s a wardrobe essential that effortlessly transitions from day to night, season to season.', '652436f4c1ac91.85934762.jpg', '652436f4c1bec5.87203093.jpg', '652436f4c1c9a3.23271347.jpg', '652436f4c1d210.72298056.jpg', '652436f4c1d9d4.02280210.jpg', 'sweater');

-- --------------------------------------------------------

--
-- Table structure for table `e_users`
--

CREATE TABLE `e_users` (
  `id` int(11) NOT NULL,
  `u_name` varchar(55) NOT NULL,
  `u_email` varchar(55) NOT NULL,
  `u_password` varchar(55) NOT NULL,
  `u_phone` varchar(15) NOT NULL,
  `u_dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `e_users`
--

INSERT INTO `e_users` (`id`, `u_name`, `u_email`, `u_password`, `u_phone`, `u_dt`) VALUES
(3, 'arifpir', 'arifpir@gmail.com', 'arifpir', '8393749479', '2023-06-30 18:06:30'),
(5, 'arif', 'arif@gmail.com', 'what', '8479487493', '2023-07-01 19:28:33'),
(6, 'sahil', 'sahil@gmail.com', 'this', '393', '2023-07-11 00:12:41'),
(7, 'this', 'what@gmail.com', 'not', '3434', '2023-07-11 00:13:31'),
(8, 'what', 'what@mygmail.com', '243', '234', '2023-07-11 00:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `m_start_price` varchar(55) NOT NULL,
  `m_img` varchar(30) NOT NULL,
  `m_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`m_id`, `m_name`, `m_start_price`, `m_img`, `m_status`) VALUES
(34, 'Fashion', '449', 'Fashion.jpg', 1),
(35, 'Electronics', '6999', 'Electronics.jpg', 1),
(36, 'Home and Furniture', '1799', 'Home and Furniture.jpg', 1),
(38, 'Beauty and Personal Care', '49', 'Beauty and Personal Care.jpg', 1),
(40, 'Books, Movies, and Music', '199', 'Books, Movies, and Music.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(55) NOT NULL,
  `s_start_price` varchar(55) NOT NULL,
  `s_img` varchar(30) NOT NULL,
  `s_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`s_id`, `s_name`, `s_start_price`, `s_img`, `s_status`) VALUES
(10, 'Smartphones', '699', 'Smartphones.jpg', 1),
(11, 'Audio and Headphones', '499', 'Audio and Headphones.jpg', 1),
(14, 'Cameras and Photography', '12999', 'Cameras and Photography.jpg', 1),
(22, 'Men', '399', 'Men.jpg', 1),
(24, 'Women', '449', 'Women.jpg', 1),
(25, 'Footwear', '699', 'Footwear.jpg', 1),
(26, 'Accessories', '129', 'Accessories.jpg', 1),
(27, 'Home Decoration', '319', 'Home Decoration.jpg', 1),
(28, 'Lights', '599', 'Lights.jpg', 1),
(29, 'Skincare', '79', 'Skincare.jpg', 1),
(30, 'Toys and Games', '199', 'Toys and Games.jpg', 1),
(31, 'Health and Wellness', '239', 'Health and Wellness.jpg', 1),
(32, 'Watches', '99', 'Watches.jpg', 1),
(33, 'Books', '179', 'Books.jpg', 1),
(34, 'Fragrances', '99', 'Fragrances.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `e_contacts`
--
ALTER TABLE `e_contacts`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `e_order`
--
ALTER TABLE `e_order`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `e_order_detail`
--
ALTER TABLE `e_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_product`
--
ALTER TABLE `e_product`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `e_product` ADD FULLTEXT KEY `pr_name` (`pr_name`,`pr_short_desc`,`pr_description`,`pr_meta_desc`);

--
-- Indexes for table `e_users`
--
ALTER TABLE `e_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `e_contacts`
--
ALTER TABLE `e_contacts`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `e_order`
--
ALTER TABLE `e_order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `e_order_detail`
--
ALTER TABLE `e_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `e_product`
--
ALTER TABLE `e_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `e_users`
--
ALTER TABLE `e_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
