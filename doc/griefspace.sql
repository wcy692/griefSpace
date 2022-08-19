-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 12:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `griefspace`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation`
--

CREATE TABLE `activation` (
  `userdata_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `expiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activation`
--

INSERT INTO `activation` (`userdata_id`, `token`, `expiry`) VALUES
(35, '$2y$10$enf3AJwG6aCRqjFO01oZqe6o6IdWtA7rgg3LfPci8obMZ0ZQqIGJe', 1659008268),
(36, '$2y$10$jtsg2q2OOHoq2XPlyZZRJuWl05lhTskfg8ztQl0.IHU3CLDWs/JfW', 1660690288);

-- --------------------------------------------------------

--
-- Table structure for table `emotion`
--

CREATE TABLE `emotion` (
  `id` int(11) NOT NULL,
  `context` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emotion`
--

INSERT INTO `emotion` (`id`, `context`) VALUES
(1, 'terrible'),
(2, 'bad'),
(3, 'neutral'),
(4, 'good'),
(5, 'amazed');

-- --------------------------------------------------------

--
-- Table structure for table `forgetpwd`
--

CREATE TABLE `forgetpwd` (
  `userdata_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `expiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `journal_basic`
--

CREATE TABLE `journal_basic` (
  `identifier` int(11) NOT NULL,
  `userdata_id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `emotion_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `ans` text NOT NULL,
  `createTime` int(11) NOT NULL,
  `updateTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_basic`
--

INSERT INTO `journal_basic` (`identifier`, `userdata_id`, `journal_id`, `title`, `emotion_id`, `question_id`, `ans`, `createTime`, `updateTime`) VALUES
(119, 33, 4, 'create test', 5, 4, 'Love', 1658983991, 1659809553),
(120, 33, 4, 'create test', 5, 6, 'trtrtrtrt', 1658983991, 1659809553),
(121, 33, 4, 'create test', 5, 1, 'create test', 1658983991, 1659809553),
(122, 33, 4, 'create test', 5, 1, 'It\'s getting hard to get rid of you', 1658983991, 1659809553),
(123, 33, 6, '2022-07-21', 4, 1, 'It\'s bad', 1659367461, 1659809588),
(124, 33, 5, '2022-07-21', 1, 4, 'Love', 1659626597, 1659809597),
(125, 33, 5, '2022-07-21', 1, 6, 'trtrtrtrt', 1659626597, 1659809597),
(126, 33, 5, '2022-07-21', 1, 1, 'asdasdds', 1659626597, 1659809597),
(168, 33, 7, 'testarr', 1, 10, 'You\'re beautiful. I miss you so much :(', 1659718524, 1660532326),
(169, 33, 7, 'testarr', 1, 3, 'new ans', 1659718524, 1660532326),
(170, 33, 7, 'testarr', 1, 1, 'I\'ve started feeling depressed right now. What should I do', 1659718524, 1660532326),
(171, 33, 7, 'testarr', 1, 1, 'asd', 1659718524, 1660532326),
(172, 33, 7, 'testarr', 1, 1, 'asdadasd', 1659718524, 1660532326),
(173, 33, 7, 'testarr', 1, 6, 'treasure', 1659718524, 1660532326),
(176, 33, 8, 'titleasd', 1, 1, 'test  module', 1660542988, 1660546967),
(177, 33, 8, 'titleasd', 1, 5, 'you always helped me out.', 1660542988, 1660546967),
(178, 33, 8, 'titleasd', 1, 4, 'you are beautiful', 1660542988, 1660546967),
(186, 33, 9, 'title', 1, 1, 'test setting ver3', 1660645415, 1660646269),
(187, 33, 10, 'title', 3, 1, 'adasdadsad', 1660708889, 1660708889);

-- --------------------------------------------------------

--
-- Table structure for table `journal_question`
--

CREATE TABLE `journal_question` (
  `id` int(11) NOT NULL,
  `context` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `journal_question`
--

INSERT INTO `journal_question` (`id`, `context`) VALUES
(1, 'what’s in your mind today?'),
(2, 'what I wanna tell you today...'),
(3, 'your greatest gift was...'),
(4, 'the memory which is the most fond treasure...'),
(5, 'the memory which still struggles me the most...'),
(6, 'the pride I wanna talk about...'),
(7, 'the guilt I wanna talk about...'),
(8, 'something I wanna ask about...'),
(9, 'if you would say something to me now, it would be...'),
(10, 'the one thing that I will still remember...');

-- --------------------------------------------------------

--
-- Table structure for table `otp_email`
--

CREATE TABLE `otp_email` (
  `id` int(11) NOT NULL,
  `userdata_id` int(11) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `uid` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `pwd` text NOT NULL,
  `noti_id` int(11) NOT NULL,
  `isActivate` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `uid`, `email`, `pwd`, `noti_id`, `isActivate`) VALUES
(33, 'luz256', 'jamesphpcoding@gmail.com', '$2y$10$kfX8Img99ubQF0Bcb6pYte0dewAMlwIDRIZKZbuV1jhdUHnZ.sNQ2', 0, 1),
(35, 'james256', 't.t.4r3al@gmail.com', '$2y$10$/wH9yEyg69BMz8O9lbJFquoSfLHLDjOeJTVm0Gs/ViiZjfaJqr9eK', 0, 0),
(36, 'loren256', 'james@gmail.com', '$2y$10$a2zkbTPLkRBvRN4ZryN1vOTizIADgiTr/YUvo06IYidxTKqd6De5S', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `userdata_id` int(11) NOT NULL,
  `journal_created` tinyint(1) NOT NULL DEFAULT 0,
  `journal_updated` tinyint(1) NOT NULL DEFAULT 0,
  `login_alert` tinyint(1) NOT NULL DEFAULT 0,
  `one_time_pwd` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`id`, `userdata_id`, `journal_created`, `journal_updated`, `login_alert`, `one_time_pwd`) VALUES
(1, 33, 1, 1, 1, 1),
(2, 35, 0, 0, 0, 0),
(3, 36, 0, 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation`
--
ALTER TABLE `activation`
  ADD PRIMARY KEY (`userdata_id`);

--
-- Indexes for table `emotion`
--
ALTER TABLE `emotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgetpwd`
--
ALTER TABLE `forgetpwd`
  ADD PRIMARY KEY (`userdata_id`);

--
-- Indexes for table `journal_basic`
--
ALTER TABLE `journal_basic`
  ADD PRIMARY KEY (`identifier`);

--
-- Indexes for table `journal_question`
--
ALTER TABLE `journal_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_email`
--
ALTER TABLE `otp_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userdata_id` (`userdata_id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userdata_id` (`userdata_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emotion`
--
ALTER TABLE `emotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `journal_basic`
--
ALTER TABLE `journal_basic`
  MODIFY `identifier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `journal_question`
--
ALTER TABLE `journal_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `otp_email`
--
ALTER TABLE `otp_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation`
--
ALTER TABLE `activation`
  ADD CONSTRAINT `activation_ibfk_1` FOREIGN KEY (`userdata_id`) REFERENCES `userdata` (`id`);

--
-- Constraints for table `forgetpwd`
--
ALTER TABLE `forgetpwd`
  ADD CONSTRAINT `forgetpwd_ibfk_1` FOREIGN KEY (`userdata_id`) REFERENCES `userdata` (`id`);

--
-- Constraints for table `otp_email`
--
ALTER TABLE `otp_email`
  ADD CONSTRAINT `otp_email_ibfk_1` FOREIGN KEY (`userdata_id`) REFERENCES `userdata` (`id`);

--
-- Constraints for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`userdata_id`) REFERENCES `userdata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
