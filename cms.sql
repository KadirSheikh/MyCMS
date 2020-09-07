-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2020 at 09:36 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `catogery`
--

CREATE TABLE `catogery` (
  `cat_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `cat_title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catogery`
--

INSERT INTO `catogery` (`cat_id`, `user_id`, `cat_title`) VALUES
(7, 15, 'css'),
(8, 15, 'js'),
(12, 0, 'java2'),
(14, 0, 'Testing'),
(15, 0, 'Angular'),
(16, 0, 'sfsdf'),
(17, 0, 'fsdfsd'),
(18, 15, 'Angular');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `comment_post_id` int(10) NOT NULL,
  `comment_auther` varchar(200) NOT NULL,
  `comment_email` varchar(200) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(200) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_auther`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(14, 40, 'ks', 'rs7246510@gmail.com', 'wow', 'unapproved', '2020-02-16'),
(15, 40, 'Kadir Sheikh ', 'rs7246510@gmail.com', 'yo', 'unapproved', '2020-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_cat_id` int(10) NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_auther` varchar(200) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tag` varchar(200) NOT NULL,
  `post_comment_count` int(10) NOT NULL,
  `post_status` varchar(200) NOT NULL DEFAULT 'draft',
  `post_view_count` int(20) NOT NULL,
  `likes` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_cat_id`, `post_title`, `post_auther`, `post_date`, `post_image`, `post_content`, `post_tag`, `post_comment_count`, `post_status`, `post_view_count`, `likes`) VALUES
(40, 15, 8, 'Testing', 'kamil sheikh', '2020-02-16', '166701.jpg', 'sudhfskjf', 'js,php,java', 0, 'Publish', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_firstname` varchar(200) NOT NULL,
  `user_lastname` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(200) NOT NULL,
  `randSalt` varchar(200) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(6, 'demo', '', '', 'demo@gmail.com', '$2y$12$xXgZ8Ui/kKZ8EMVFWMoUY.TMxKu7A/4mQY2JrjvNvRQO9AUySLAsy', '', 'admin', '$2y$10$iusesomecrazystring22', 'e4965e43d02782743d6dd70a6d0dfe3a75ccf229b6774d8d679f2beef6b96c08a1c3d73d79a4fc8551a9e350e3ce14455902'),
(15, 'kamil123', 'kamil', 'sheikh', 'ks7246510@gmail.com', '$2y$12$WYOgxes551i.mRnTjB1NyOcoiHhvwHIUH.X6Qv2oCVW9W/Xhd2rr2', '', 'admin', '$2y$10$iusesomecrazystrings22', ''),
(16, 'yoyo', 'kadirjsfjhsdkj', 'sheikhjdkfhskjf', 'rs724651000000@gmail.com', '$2y$12$zsaEE481KKXSW6x8ddLCN.OrIFgX0fCPtEQjpvEc66RNU6drEmrMW', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(17, 'swirlly', 'kamil', 'sheikh', 'rs72sfdf46510@gmail.com', '$2y$12$58yP2M2uXjbzgu9mWRWp4.KeHvsP8HZlhRXjGstIb2vDVdHjd5aay', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(18, 'swirllysfsdf', 'kamil', 'sheikh', 'rs7246510@gmail.com', '$2y$12$1eJhvvyl0nHdsyGHIaetx.KxfjKQOvT0AGfXXjsgM6LfLHFHv8ljK', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(19, 'ritwik', 'rizwan', 'sheikhjhfkjsdf', 'sfsdfjh@gmail.com', '$2y$12$cGUgBeT07bYUKqFvUT69zef1VS5TFmtg5sS/Vxl/fXhS/QbrFAus.', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(20, 'hohooh', 'hohoho', 'hohooho', 'hohoho7246510@gmail.com', '$2y$12$pDnUQ4/L4ZJMqgHq8JeaPOD3l6w6EcSSnS1Lanl/1HdsVeTXgR6Xy', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(21, 'kadir786', 'rizwan', 'sheikhjdkfhskjf', 'hsfskjdfh@gmail.com', '$2y$12$roBijax0io89kmSQN89RYeOxZscaRRVMVqRbxkLHpY9iLEJVzswqu', '', 'subscriber', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_online`
--

CREATE TABLE `user_online` (
  `id` int(11) NOT NULL,
  `session` varchar(300) NOT NULL,
  `time` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_online`
--

INSERT INTO `user_online` (`id`, `session`, `time`) VALUES
(2, '87p6gijfp5lggqsi3nv03bfscj', 1580317057);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catogery`
--
ALTER TABLE `catogery`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_online`
--
ALTER TABLE `user_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catogery`
--
ALTER TABLE `catogery`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_online`
--
ALTER TABLE `user_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
