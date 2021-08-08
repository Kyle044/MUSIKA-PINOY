-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2021 at 03:51 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmusicdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aposttbl`
--

CREATE TABLE `aposttbl` (
  `apost_id` int(11) NOT NULL,
  `postName` varchar(255) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `date_up` varchar(255) NOT NULL,
  `last_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aposttbl`
--

INSERT INTO `aposttbl` (`apost_id`, `postName`, `fileName`, `category`, `description`, `thumbnail`, `name`, `uid`, `likes`, `views`, `date_up`, `last_id`) VALUES
(81, 'Guitar Tutorial by CJ', '6031ff609a9f81.43724784.mp4', 'Guitar', 'Follow Me in Facebook CJ Delgado!', '6031ff609ab271.24269865.png', 'John Kyle Razon', '3', 0, 1, '2021-02-21 14:36:16', 140),
(83, 'Piano Lesson', '6030e3b12b5b82.06868457.mp4', 'Category', 'My piano lesson tutorial', '6030e3b12b6c98.67614262.jpg', 'jhester', '8', 1, 4, '2021-02-20 18:25:53', 135),
(86, 'Drums Tutorial Basics', '6031f9ab65e079.84465350.mp4', 'Drums', 'The Basics of the Drums By Toto', '6031f9ab65f678.28215422.png', 'IdolRoffy', '7', 1, 1, '2021-02-21 14:11:55', 138),
(89, 'Bass Tutorial Overview', '6031f962aae220.46583501.mp4', 'Bass', 'Its a Bass Tutorial Overview By Our One And Only Bill Gates!', '6031f962aaf426.05610772.jpg', 'IdolRoffy', '7', 1, 4, '2021-02-21 14:10:42', 137),
(106, 'Ill Never Go Cover By Cheeze Wiz Band', '602e334d769ec9.98727100.mp4', 'performance', 'Support our Band!', '602e334d76ac73.02521071.jpg', 'IdolRoffy', '7', 2, 3, '2021-02-18 17:28:45', 132),
(108, 'Guitar lesson  family chords tutorial', '6030dfcb5d9862.82466723.mp4', 'Guitar', 'Basic guitar chords for beginners \r\n', '6030dfcb5da9c3.14400315.jpg', 'jhester', '8', 1, 1, '2021-02-20 18:09:15', 134),
(113, 'Nerveless Acoustic Jam!', '6031fa72782870.81225764.mp4', 'performance', 'Follow Us Cheeze Which Band!', '6031fa72783a12.08621327.jpg', 'IdolRoffy', '7', 1, 2, '2021-02-21 14:15:14', 139),
(115, 'Music Theory About Guitar', '60320a00923ff8.20618189.mp4', 'theory', 'Minor And Major!', '60320a00925407.46597506.jpg', 'John Kyle Razon', '3', 0, 1, '2021-02-21 15:21:36', 141),
(116, 'Music Theory Part 2 Guitar', '60320a3da1cbc3.28812128.mp4', 'theory', 'Techniques!', '60320a3da5afa7.14589832.jpg', 'John Kyle Razon', '3', 0, 1, '2021-02-21 15:22:37', 142),
(117, 'JAJA THE DANCER', '603852aab4e0c7.09849093.mp4', 'performance', 'HEHEHE', '603852aab4f796.73245814.jpg', 'daniel', '9', 1, 2, '2021-02-26 09:45:14', 143);

-- --------------------------------------------------------

--
-- Table structure for table `comtbl`
--

CREATE TABLE `comtbl` (
  `CID` int(11) NOT NULL,
  `CommentType` varchar(255) NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comtbl`
--

INSERT INTO `comtbl` (`CID`, `CommentType`, `Comment`, `uid`, `date`) VALUES
(1, '74', 'waewewe', '3', '2021-02-12 23:36:36'),
(2, '74', 'shyehehehe', '3', '2021-02-12 23:36:44'),
(3, '74', 'shettt', 'John Kyle Razon', '2021-02-12 23:37:11'),
(4, '74', 'asdasdasdas', 'John Kyle Razon', '2021-02-13 13:06:07'),
(5, '74', 'shet', 'John Kyle Razon', '2021-02-13 13:11:02'),
(6, '74', 'wat', 'John Kyle Razon', '2021-02-13 13:11:04'),
(7, '81', '', 'shet', '2021-02-15 10:53:15'),
(8, '', 'asdsad', '', '2021-02-15 11:02:46'),
(9, '', 'asdsadsadsa', '', '2021-02-15 11:02:48'),
(10, '81', 'wat', 'John Kyle Razon', '2021-02-15 12:28:23'),
(11, '81', 'ye\n', 'John Kyle Razon', '2021-02-15 12:28:29'),
(12, '84', 'whattt', 'John Kyle Razon', '2021-02-15 14:47:48'),
(13, '81', 'ye\n', 'John Kyle Razon', '2021-02-16 16:29:23'),
(14, '81', 'ye\nshet', 'John Kyle Razon', '2021-02-16 16:29:28'),
(15, '88', 'shet', 'IdolRoffy', '2021-02-17 15:17:33'),
(16, '82', 'weat', 'IdolRoffy', '2021-02-17 15:37:09'),
(17, '91', 'ROCK\n', 'IdolRoffy', '2021-02-17 17:47:24'),
(18, '105', 'jaja galing dumamoves\n', 'IdolRoffy', '2021-02-18 17:33:42'),
(19, '105', 'ow shet', 'IdolRoffy', '2021-02-18 17:40:02'),
(20, '105', 'jaja', 'IdolRoffy', '2021-02-18 17:40:31'),
(21, '105', 'wow sabaw', 'IdolRoffy', '2021-02-18 17:41:30'),
(22, '105', 'ITS A YES FOR ME', 'IdolRoffy', '2021-02-19 13:35:47'),
(23, '105', 'MY GODDDD', 'IdolRoffy', '2021-02-19 13:39:57'),
(24, '89', 'asdasd', 'John Kyle Razon', '2021-02-21 12:50:15'),
(25, '81', 'Idol!\n', 'John Kyle Razon', '2021-02-21 17:40:05'),
(26, '81', 'Idol!\nLodi!\n', 'John Kyle Razon', '2021-02-21 17:40:09'),
(27, '81', 'MORE POWER\n', 'John Kyle Razon', '2021-02-21 17:40:18'),
(28, '117', 'GALING SUMAYAW NI JAJA', 'daniel', '2021-02-26 09:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `liketbl`
--

CREATE TABLE `liketbl` (
  `id_like` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liketbl`
--

INSERT INTO `liketbl` (`id_like`, `uid`, `vid`) VALUES
(101, 7, '82'),
(102, 7, '88'),
(115, 7, '91'),
(116, 7, '106'),
(122, 3, '89'),
(127, 8, '109'),
(129, 7, '105'),
(149, 3, '86'),
(279, 9, '106'),
(282, 7, '117');

-- --------------------------------------------------------

--
-- Table structure for table `messtbl`
--

CREATE TABLE `messtbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messtbl`
--

INSERT INTO `messtbl` (`id`, `name`, `message`, `date`) VALUES
(9, 'kylegwapo04@gmail.com', 'Galing!', '2021-02-25 19:27:12'),
(24, 'niamhcyruss@gmail.com', 'sdadasd', '2021-02-26 11:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `notiftbl`
--

CREATE TABLE `notiftbl` (
  `id_notif` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notiftbl`
--

INSERT INTO `notiftbl` (`id_notif`, `user_id`, `message`, `date`, `post_id`) VALUES
(16, 8, 'Your Post Music Theory memorizing note in the fret board  is Approved by the Admin!', '2021-02-20 18:26:25', 133),
(17, 8, 'Your Post Guitar lesson  family chords tutorial is Approved by the Admin!', '2021-02-20 18:26:30', 134),
(18, 8, 'Your Post Piano Lesson is Approved by the Admin!', '2021-02-20 18:26:35', 135),
(19, 8, 'Your Post Piano Lesson is liked by jhester', '2021-02-20 18:27:22', 135),
(20, 8, 'Your Post Piano Lesson is liked by jhester', '2021-02-20 18:27:24', 135),
(32, 8, 'You are supported By IdolRoffy', '2021-02-21 13:56:43', 135),
(33, 8, 'You\'re Unsupported By IdolRoffy', '2021-02-21 13:58:39', 135),
(34, 8, 'You are supported By IdolRoffy', '2021-02-21 14:01:37', 135),
(49, 8, 'You are supported By John Kyle Razon', '2021-02-21 14:51:23', 134),
(56, 8, 'Your Post Guitar lesson  family chords tutorial is liked by John Kyle Razon', '2021-02-21 14:57:07', 134),
(57, 8, 'Your Post Guitar lesson  family chords tutorial is liked by John Kyle Razon', '2021-02-21 14:57:08', 134),
(204, 9, 'Your Post JAJA THE DANCER is Approved by the Admin!', '2021-02-26 09:45:49', 143),
(205, 9, 'Your Post JAJA THE DANCER is Commented by daniel', '2021-02-26 09:46:36', 143),
(207, 9, 'Your Post JAJA THE DANCER is liked by IdolRoffy', '2021-02-26 09:55:48', 143),
(208, 9, 'Your Post JAJA THE DANCER is liked by IdolRoffy', '2021-02-26 09:55:49', 143),
(209, 9, 'Your Post JAJA THE DANCER is liked by IdolRoffy', '2021-02-26 09:55:50', 143),
(210, 9, 'You are supported By IdolRoffy', '2021-02-26 09:55:51', 143);

-- --------------------------------------------------------

--
-- Table structure for table `posttbl`
--

CREATE TABLE `posttbl` (
  `post_id` int(11) NOT NULL,
  `postName` varchar(255) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `date_up` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subtbl`
--

CREATE TABLE `subtbl` (
  `id_sub` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `poster_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subtbl`
--

INSERT INTO `subtbl` (`id_sub`, `uid`, `poster_id`) VALUES
(14, 7, '8'),
(18, 3, '8'),
(19, 7, '3'),
(21, 3, '7'),
(22, 7, '9');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `access` varchar(255) NOT NULL,
  `supporter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `date`, `access`, `supporter`) VALUES
(3, 'kylegwapo04@gmail.com', 'John Kyle Razon', '202cb962ac59075b964b07152d234b70', '2021-02-10 22:25:18', '', 1),
(5, 'admin@gmail.com', 'Admin Kayl', '0192023a7bbd73250516f069df18b500', '2021-02-10 23:20:26', 'admin', 0),
(7, 'user@gmail.com', 'IdolRoffy', '202cb962ac59075b964b07152d234b70', '2021-02-17 15:16:54', 'user', 1),
(8, 'jhesterrelox01@gmail.com', 'jhester', '202cb962ac59075b964b07152d234b70', '2021-02-20 17:48:21', 'user', 2),
(9, 'daniel@gmail.com', 'daniel', '202cb962ac59075b964b07152d234b70', '2021-02-26 09:42:00', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `viewtbl`
--

CREATE TABLE `viewtbl` (
  `id_view` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vid` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `viewtbl`
--

INSERT INTO `viewtbl` (`id_view`, `uid`, `vid`, `date`) VALUES
(2, 3, '74', '2021-02-21 15:16:42'),
(5, 3, '654435435345', '2021-02-21 15:16:42'),
(29, 3, '84', '2021-02-21 15:16:42'),
(30, 5, '81', '2021-02-21 15:16:42'),
(31, 3, '86', '2021-02-21 15:16:42'),
(32, 7, '82', '2021-02-21 15:16:42'),
(33, 7, '85', '2021-02-21 15:16:42'),
(34, 7, '88', '2021-02-21 15:16:42'),
(35, 0, '90', '2021-02-21 15:16:42'),
(36, 7, '91', '2021-02-21 15:16:42'),
(37, 7, '913', '2021-02-21 15:16:42'),
(38, 7, '81', '2021-02-21 15:16:42'),
(39, 7, '86', '2021-02-21 15:16:42'),
(40, 3, '89', '2021-02-21 15:16:42'),
(41, 7, '103', '2021-02-21 15:16:42'),
(42, 3, '130', '2021-02-21 15:16:42'),
(43, 7, '', '2021-02-21 15:16:42'),
(44, 7, '105', '2021-02-21 15:16:42'),
(45, 7, '106', '2021-02-21 15:16:42'),
(46, 3, '105', '2021-02-21 15:16:42'),
(47, 8, '109', '2021-02-21 15:16:42'),
(48, 3, '106', '2021-02-21 15:16:42'),
(49, 7, '109', '2021-02-21 15:16:42'),
(50, 7, '113', '2021-02-21 15:16:42'),
(51, 3, '113', '2021-02-21 15:16:42'),
(52, 3, '108', '2021-02-21 15:16:42'),
(53, 3, '81', '2021-02-21 15:16:42'),
(54, 7, '89', '2021-02-21 15:16:42'),
(55, 3, '116', '2021-02-21 16:24:31'),
(56, 3, '115', '2021-02-21 16:24:36'),
(57, 9, '89', '2021-02-26 09:42:26'),
(58, 9, '117', '2021-02-26 09:46:16'),
(59, 9, '106', '2021-02-26 09:49:24'),
(60, 9, '83', '2021-02-26 09:50:00'),
(61, 7, '117', '2021-02-26 09:55:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aposttbl`
--
ALTER TABLE `aposttbl`
  ADD PRIMARY KEY (`apost_id`);

--
-- Indexes for table `comtbl`
--
ALTER TABLE `comtbl`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `liketbl`
--
ALTER TABLE `liketbl`
  ADD PRIMARY KEY (`id_like`);

--
-- Indexes for table `messtbl`
--
ALTER TABLE `messtbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notiftbl`
--
ALTER TABLE `notiftbl`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indexes for table `posttbl`
--
ALTER TABLE `posttbl`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `subtbl`
--
ALTER TABLE `subtbl`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viewtbl`
--
ALTER TABLE `viewtbl`
  ADD PRIMARY KEY (`id_view`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aposttbl`
--
ALTER TABLE `aposttbl`
  MODIFY `apost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `comtbl`
--
ALTER TABLE `comtbl`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `liketbl`
--
ALTER TABLE `liketbl`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `messtbl`
--
ALTER TABLE `messtbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `notiftbl`
--
ALTER TABLE `notiftbl`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `posttbl`
--
ALTER TABLE `posttbl`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `subtbl`
--
ALTER TABLE `subtbl`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `viewtbl`
--
ALTER TABLE `viewtbl`
  MODIFY `id_view` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
