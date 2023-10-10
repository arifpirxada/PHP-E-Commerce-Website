-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 11:42 AM
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
(41, 34, 'Ebony Elegance', 899, 100, 'Wrap yourself in the exquisite allure of our \"Midnight Cozy\" black sweater, a versatile and timeless addition to your wardrobe. Crafted with meticulous attention to detail, this sweater offers not just warmth, but an embodiment of elegance and comfort.\r\n\r\nThe rich, deep black hue of the sweater, reminiscent of a moonless night, makes it an effortlessly chic choice for any occasion. Whether you\'re heading to a casual dinner with friends, a day at the office, or a cozy night by the fireplace, the \"Midnight Cozy\" sweater effortlessly elevates your style.', 'Our sweater is made from high-quality, soft knit fabric that feels gentle against your skin. The relaxed fit drapes gracefully, providing a flattering silhouette for various body types. The ribbed cuffs and hem add a touch of texture while keeping you snug and warm. The classic crew neck design and long sleeves make it perfect for layering during the colder months or wearing on its own in milder weather.\r\n\r\nEmbrace the versatility of the \"Midnight Cozy\" black sweater and pair it with your favorite jeans for a casual look, dress it up with a statement necklace and slacks for a professional ensemble, or throw it over a dress for a stylish contrast. It\'s a wardrobe essential that effortlessly transitions from day to night, season to season.', '652436f4c1ac91.85934762.jpg', '652436f4c1bec5.87203093.jpg', '652436f4c1c9a3.23271347.jpg', '652436f4c1d210.72298056.jpg', '652436f4c1d9d4.02280210.jpg', 'sweater'),
(42, 34, 'Ebony Essential Shirt', 399, 100, 'the epitome of timeless simplicity and sophistication. Crafted with meticulous attention to detail, this white t-shirt transcends the ordinary and elevates your wardrobe to new heights.\r\n\r\nUnparalleled Comfort: Our \"Pure Elegance Tee\" is made from premium, ultra-soft cotton fabric, ensuring unmatched comfort all day long. Whether you\'re lounging at home, running errands, or dressing it up for a night out, you\'ll feel at ease and stylish.\r\n\r\nEndless Versatility: This classic white wonder is a versatile staple that effortlessly complements any outfit. Pair it with jeans for a casual look, layer it under a blazer for a smart-casual ensemble, or wear it solo with a statement accessory for a touch of minimalistic elegance.', 'Timeless Appeal: The \"Pure Elegance Tee\" embodies the concept of less is more. Its clean lines, tailored fit, and pristine white color make it a wardrobe essential that stands the test of time, transcending trends and seasons.\r\n\r\nQuality Craftsmanship: We take pride in the quality of our products. Every \"Pure Elegance Tee\" is crafted with precision, featuring reinforced stitching and a durable fabric that maintains its shape and color, wash after wash.\r\n\r\nExpress Your Style: With a blank slate like the \"Pure Elegance Tee,\" you have the freedom to express your unique style. Add your own personal flair through accessorizing or simply let the shirt\'s elegance speak for itself.\r\n\r\nA Wardrobe Must-Have: No matter your age, gender, or personal style, the \"Pure Elegance Tee\" is a wardrobe must-have that suits every occasion and complements your individuality.\r\n\r\nChoose the \"Pure Elegance Tee\" for a white t-shirt that goes beyond fashion, offering you an enduring sense of style and comfort. Elevate your look today with this classic piece of apparel.', '6525080bc00f37.26313643.jpg', '6525080bc021f1.19240403.jpg', '6525080bc02a13.60252436.jpg', '6525080bc03120.55262876.jpg', '6525080bc037d9.87089945.jpg', 'black t-shirt'),
(43, 34, 'Pure Bliss Hoodie', 649, 100, 'Introducing our Pure Bliss Hoodie, a wardrobe essential that embodies comfort, style, and versatility in one elegant package. Crafted from premium, ultra-soft cotton fabric, this white hoodie offers the ultimate coziness, making it your go-to choice for chilly days or relaxed evenings. Its minimalist design and neutral hue make it a versatile addition to any outfit, allowing you to effortlessly elevate your casual or athleisure look.', 'The Pure Bliss Hoodie isn\'t just a piece of clothing; it\'s a statement of refined simplicity. Its carefully tailored fit and durable construction ensure that you\'ll enjoy both comfort and longevity. Whether you pair it with jeans for a laid-back day out or layer it under a jacket for added warmth, this hoodie will become your trusted companion, providing an unmatched blend of comfort and style for every occasion. Embrace the timeless charm of this white hoodie and experience pure bliss in fashion.', '6525098057cfb6.65349479.jpg', '6525098057ed99.15578375.jpg', '6525098057f914.35746461.jpg', '652509805806c5.46740435.jpg', '65250980581086.03661527.jpg', 'hoodie'),
(44, 34, 'Midnight Essential Hoodie', 549, 100, 'Introducing our sleek and stylish black hoodie, a versatile addition to your wardrobe that effortlessly combines comfort with urban flair. Crafted from high-quality, soft cotton blend fabric, this hoodie wraps you in warmth and coziness. The deep black color exudes a sense of understated sophistication, making it a timeless staple for any season. Whether you\'re dressing it up or down, the black hoodie is the epitome of versatility.', 'With its minimalist design, this hoodie features a kangaroo pocket in the front and an adjustable drawstring hood, adding both functionality and fashion-forward elements to your outfit. Pair it with jeans for a casual and edgy look, or layer it under a leather jacket for an extra dose of coolness during chilly evenings. The black hoodie is not just an article of clothing; it\'s a statement piece that effortlessly complements your individual style, allowing you to express yourself with confidence and comfort wherever you go.', '65250a716838f5.10468548.jpg', '65250a71684843.67491289.jpg', '65250a71685053.15453561.jpg', '65250a71685a81.29035757.jpg', '65250a716867d4.90252605.jpg', 'black hoodie'),
(45, 34, 'SunStrike Shades', 239, 200, 'SunStrike Shades are the epitome of style and sun protection combined. Crafted with precision and designed to exude elegance, these sunglasses are the perfect accessory for those who appreciate both fashion and functionality. The sleek, modern frame is made from lightweight, durable materials that ensure comfort during extended wear, making them ideal for any outdoor activity. Whether you\'re lounging on the beach, exploring a bustling city, or hitting the hiking trails, SunStrike Shades will not only shield your eyes from the sun\'s harmful rays but also elevate your overall look.', 'The lenses of SunStrike Shades are polarized to reduce glare, providing enhanced visual clarity and reducing eye strain in bright conditions. They offer 100% UV protection, safeguarding your eyes from the sun\'s damaging radiation. The attention to detail in their design, from the stylish temple accents to the subtle logo etching, showcases a commitment to quality and sophistication. With SunStrike Shades, you\'re not just wearing sunglasses; you\'re making a fashion statement while prioritizing your eye health. Elevate your style and protect your eyes with SunStrike Shades, the ultimate blend of fashion and function.', '65250c2d63c2e4.62378951.jpg', '65250c2d63d5e0.14211150.jpg', '65250c2d63ddb4.23200400.jpg', '65250c2d63e5f7.06252406.jpg', '65250c2d63ed47.26232377.jpg', 'sunglasses'),
(46, 34, 'Velocity Boost', 639, 200, 'Introducing the Velocity Boost sneaker, a dynamic fusion of style and performance. These sneakers are meticulously designed to cater to the modern urban explorer and fitness enthusiast alike. With their sleek, aerodynamic silhouette, these kicks exude a sense of effortless cool that effortlessly complements any outfit, whether you\'re hitting the gym, strolling through the city streets, or simply hanging out with friends.', 'Crafted from high-quality, breathable materials, the \"Velocity Boost\" sneakers ensure comfort and durability. The innovative cushioning technology in the sole provides superior shock absorption and responsiveness, making them ideal for running, training, or any high-impact activity. With a range of vibrant color options and a distinctive logo, these sneakers are not just a footwear choice but a fashion statement. Step into the future of footwear with the \"Velocity Boost\" and experience a harmonious blend of fashion-forward design and athletic functionality.', '65250dd6cc7047.76658549.jpg', '65250dd6cc8333.90618135.jpg', '65250dd6cc8c15.57636646.jpg', '65250dd6cc9325.70556785.jpg', '65250dd6cc9a14.73477423.jpg', 'sneaker'),
(47, 34, 'Black Women Jacket', 1149, 400, 'Introducing the epitome of timeless elegance and contemporary style - the Women\'s Black Jacket. This versatile piece is a must-have in every fashion-conscious woman\'s wardrobe. Crafted from high-quality, supple black leather, it exudes an air of sophistication and edginess that effortlessly elevates any outfit. Its tailored silhouette accentuates your curves, offering a flattering and comfortable fit that transitions seamlessly from day to night. The minimalist design features a sleek, asymmetrical zip closure and discreet pockets, providing both functionality and a clean, sleek aesthetic. Whether you\'re heading to a business meeting or a night out on the town, this black jacket is your go-to choice for a polished and fashionable look that exudes confidence.', 'Not only does this black jacket offer impeccable style, but it also provides warmth and protection against the elements. The premium leather construction is not only fashionable but also durable, making it a reliable companion for the seasons to come. Its versatile design complements a wide range of outfits, from pairing it with jeans for a casual yet chic ensemble to draping it over a little black dress for a dose of urban glamour. This Women\'s Black Jacket is the embodiment of sophistication, offering a timeless appeal that ensures you\'ll look effortlessly chic for any occasion, year after year. It\'s a statement piece that speaks volumes about your taste and fashion sensibility, making it an essential addition to your wardrobe for the modern woman on the go.', '65251026980a42.40850951.jpg', '65251026982779.50846831.jpg', '652510269842f0.03358017.jpg', '65251026985416.64675824.jpg', '65251026986416.26179478.jpg', 'women jacket');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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
