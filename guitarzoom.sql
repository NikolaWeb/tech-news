-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 12:24 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guitarzoom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id_admin` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id_admin`, `name`, `url`, `slug`) VALUES
(1, 'Slider', 'slider.php', 'slider'),
(2, 'Products', 'products.php', 'products'),
(3, 'Poll', 'poll.php', 'poll'),
(4, 'Menu', 'menu.php', 'menu');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `name`, `slug`, `url`, `keywords`, `description`) VALUES
(1, 'Home', 'home', 'home.php', 'Play guitar, Steve Stine, passion, practice', 'Steve Stine is known as the world\'s most sought-after guitar instructor.'),
(2, 'About', 'about', 'about.php', 'acoustic guitar, electric guitar, Steve Stine, Dan Denley', 'Our courses make it easy to play guitar in any style and rapidly boost your skills, step by step with guidance and accountability.'),
(3, 'Shop', 'shop', 'shop.php', 'Best sellers, Rock, Blues, Soloing, Beginner, Acoustic', 'Whether you want to improve your soloing, play blues like a pro, master chords and rhythm, or learn guitar from the ground up, these courses are a great place to start.'),
(4, 'Contact', 'contact', 'contact.php', 'Customer Support, Customer Success, message us', 'Leave a message and get an answer quickly from our Customer Success team.'),
(5, 'Cart', 'cart', 'cart.php', 'shop, buy, add to cart, sale', 'Get our courses for incredibly affordable prices.');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `id_poll` int(10) NOT NULL,
  `poll_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `result` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id_poll`, `poll_text`, `result`) VALUES
(1, 'Rock', 11),
(2, 'Blues', 5),
(3, 'Metal', 15),
(5, 'Country', 10);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `excerpt` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name`, `image_url`, `alt`, `price`, `description`, `excerpt`) VALUES
(1, 'Soloing By Instinct', 'images/products/soloing-by-instinct.jpg', 'Soloing By Instinct', '97', '<p>Take Command Of Any Playing Situation With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - You\'ll \"see\" techniques pro guitarists use in their songs and solos</li>\r\n \r\n<li>Connect - You\'ll combine these techniques so you can create your own personal style</li>\r\n \r\n<li>Play - You\'ll play cover songs and solos with confidence, and you\'ll sound amazing when you play guitar for family and friends.</li>\r\n</ol>\r\n<p>Includes: 1.5 hours of HD videos, PDF tab book and access to our private Facebook group</p>', 'Discover 4 levels of playing a solo, from \"note-for-note\" to complete improvisation'),
(2, 'All About Blues Licks', 'images/products/all-about-blues-licks.jpg', 'All About Blues Licks', '67', '<p>Master Essential Blues Licks And Create Authentic Blues Solos With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - You\'ll \"see\" how to play 46 killer blues licks, and find out how to change them up to match your playing style.</li>\r\n\r\n<li>Connect - You\'ll connect these licks into awesome blues solos that sound original and authentic.</li>\r\n\r\n<li>Play - You\'ll play awesome blues solos with confidence... and you\'ll sound amazing.</li>\r\n</ol>\r\n<p>Includes: 2.5 hours of HD videos, PDF tab book and access to our private Facebook group</p>', 'A smokin\' hot blues lick in the style of Stevie Ray Vaughan'),
(3, 'Music Theory Made Easy', 'images/products/music-theory-made-easy.jpg', 'Music Theory Made Easy', '37', '<p>Skyrocket Your Rhythm And Lead Guitar Playing With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - You\'ll see notes, scales and chords clearly on the fretboard</li>\r\n\r\n<li>Connect - Discover how to connect chords and scales to master any style of music</li>\r\n\r\n<li>Play -  You\'ll play rhythm and lead guitar like a pro and enjoy a life-long passion</li>\r\n</ol>\r\n<p>Includes: 6 hours of videos, PDF tab book and access to our private Facebook group</p>', 'How to play the same note on multiple strings'),
(4, 'Play Acoustic Now', 'images/products/play-acoustic-now.jpg', 'Play Acoustic Now', '67', '<p>Master The Fretboard And Solo Like A Pro With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - You\'ll see how to tune your acoustic guitar, and how to hold it the right way to play music</li>\r\n\r\n<li>Connect - Discover how to thread chords and scales together, so you can learn your favorite songs in minutes</li>\r\n\r\n<li>Play - You\'ll play acoustic guitar with style and confidence, and even start writing your own songs</li>\r\n</ol>\r\n<p>Includes: 7 hours of HD videos, PDF tab book and access to our private Facebook group</p>', 'How to play 10 essential chords for acoustic guitar, so you can quickly master your favorite songs'),
(5, 'Master Blues Basics in 30 Days', 'images/products/master-blues-basics-in-30-days.jpg', 'Master Blues Basics in 30 Days', '49', '<p>Play Authentic Blues Guitar In Just 30-Days With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - Discover how blues scales fit into the 12-bar blues progression</li>\r\n\r\n<li>Connect - Connect what you learn with music you like, and play like your favorite guitarists.</li>\r\n\r\n<li>Play - You\'ll play authentic blues guitar with confidence... and you\'ll create your own blues solos from scratch.</li>\r\n</ol>\r\n<p>Includes: 1.5 hours of online videos, PDF tab book and access to our private Facebook group</p>', 'Explore the 12-bar blues progression and start playing authentic blues rhythms right away'),
(6, 'Ear Training Made Easy', 'images/products/ear-training-made-easy.jpg', 'Ear Training Made Easy', '37', '<p>Play Your Favorite Songs And Solos By Ear  With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - Find out how to visualize songs and solos using your ears as your guide</li> \r\n\r\n<li>Connect - Connect what you hear instantly to chords, scales and licks on the fretboard without any tabs or sheet music</li> \r\n\r\n<li>Play - You\'ll play songs and solos faster and never waste time playing your guitar again</li> \r\n</ol>\r\n<p>Includes: 2 hours of videos, PDF tab book and access to our private Facebook group</p>', 'Essential music vocabulary, so you\'ll know what you\'re talking about when playing with your friends and teachers'),
(7, '96 Rock Licks', 'images/products/96-rock-licks.jpg', '96 Rock Licks', '49', '<p>Create Your Own Killer Rock Solos From Scratch With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - You\'ll \"see\" how to play 96 awesome rock licks, and you\'ll add new licks to your arsenal every day</li>\r\n\r\n<li>Connect - You\'ll connect licks across the fretboard and master every playing position</li>\r\n\r\n<li>Play - You\'ll play musical rock guitar solos with complete confidence, and impress your family and friends</li>\r\n</ol>\r\n<p>Includes: 4 hours of HD videos, PDF tab book and access to our private Facebook group</p>', 'Discover the pentatonic minor, blues, and hybrid scales, so you\'ll get a feel for how rock licks should sound'),
(8, 'Solofire', 'images/products/solofire.jpg', 'Solofire', '37', '<p>Skyrocket Your Lead Guitar Playing And Solo With Confidence With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize -  See scales clearly with easy-to-learn shortcuts that will transform your guitar playing.</li>\r\n\r\n<li>Connect - Connect scales across the fretboard using simple patterns</li>\r\n\r\n<li>Play -  Perform killer guitar solos over any song or chord progression with complete confidence</li>\r\n</ol>\r\n<p>Includes: Over 4 hours of videos, PDF tab book and access to our private Facebook group</p>', 'How to use your volume and tone controls. So you can get the perfect sound for your solos.'),
(9, 'Goodbye Boring Solos', 'images/products/Goodbye-Boring-Solos.jpg', 'Goodbye Boring Solos', '57', '<p>Never Play A Boring Solo Again With Steve Stine\'s Easy 3-Step Plan:</p>\r\n<ol>\r\n<li>Visualize - See how to perform pro soloing techniques and add them to your solos</li>\r\n\r\n<li>Connect - Learn to combine techniques and patterns across the fretboard so you\'re never stuck again</li>\r\n\r\n<li>Play - Create exciting solos from scratch for any style of music</li>\r\n</ol>\r\n<p>Includes: 5 hours of videos, PDF tab book and access to our private Facebook group</p>', 'Expert tips on guitar picks, from which ones to use to the right way to use them.');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `role_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `top_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bottom_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `url`, `alt`, `top_text`, `bottom_text`) VALUES
(1, 'images/uploads/1518908170_slider-steve.jpg', 'Soloing By Instincts', 'Ignite Your Passion', 'Develop a lifelong passion for guitar and the confidence to express your creativity'),
(2, 'images/slider-guitar.jpg', 'Guitar Strings', 'Inspire Your Practice', 'You can forget about spending hours learning boring drills because our instructors make each lesson fun and exciting');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_role` int(10) NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_role`, `full_name`, `email`) VALUES
(1, 'admin', 'd6e631248c899248f50290423fa1e697', 1, '', ''),
(2, 'username', 'a2cc65ac1f8ba2f1f8b194c79a9d675f', 2, '', ''),
(4, 'Dzoni Kejdz', '1dadf5b994f75d7f56173e417955b33f', 2, 'dzoni', 'dzoni@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id_poll`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `id_poll` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
