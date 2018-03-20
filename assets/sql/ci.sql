-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2018 at 10:16 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_client_assignment`
--

CREATE TABLE `dashboard_client_assignment` (
  `assignment_id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_till` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(220) NOT NULL,
  `test_json` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_name`, `test_json`) VALUES
(1, 'HTML 5 Apti-Test', '[{"header": {"createdBy": "User1", "test_name": "HTML 5 Test"}, "question_set": [{"options": [{"optionId": 1, "optionText": "Sample 1 Option Text"}, {"optionId": 2, "optionText": "Sample 2 Option Text"}, {"optionId": 3, "optionText": "Sample 3 Option Text"}, {"optionId": 4, "optionText": "Sample 4 Option Text"}], "questionText": "Sample Question 1 Text", "correctOptionId": [1, 3]}, {"options": [{"optionId": 1, "optionText": "Sample 1 Option Text"}, {"optionId": 2, "optionText": "Sample 2 Option Text"}, {"optionId": 3, "optionText": "Sample 3 Option Text"}, {"optionId": 4, "optionText": "Sample 4 Option Text"}], "questionText": "Sample Question 2 Text", "correctOptionId": [2, 4]}]}]'),
(2, 'PHP 7 Apti Test', '[{"header": {"createdBy": "User1", "test_name": "HTML 5 Test"}, "question_set": [{"options": [{"optionId": 1, "optionText": "Sample 1 Option Text"}, {"optionId": 2, "optionText": "Sample 2 Option Text"}, {"optionId": 3, "optionText": "Sample 3 Option Text"}, {"optionId": 4, "optionText": "Sample 4 Option Text"}], "questionText": "Sample Question 1 Text", "correctOptionId": [1, 3]}, {"options": [{"optionId": 1, "optionText": "Sample 1 Option Text"}, {"optionId": 2, "optionText": "Sample 2 Option Text"}, {"optionId": 3, "optionText": "Sample 3 Option Text"}, {"optionId": 4, "optionText": "Sample 4 Option Text"}], "questionText": "Sample Question 2 Text", "correctOptionId": [2, 4]}]}]');

-- --------------------------------------------------------

--
-- Table structure for table `test_assignment`
--

CREATE TABLE `test_assignment` (
  `assignment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_assignment`
--

INSERT INTO `test_assignment` (`assignment_id`, `user_id`, `test_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `training_id` int(11) NOT NULL,
  `training_topic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`training_id`, `training_topic`) VALUES
(1, 'HTML 5'),
(2, 'PHP 7'),
(3, 'JavaScript ECMA 6');

-- --------------------------------------------------------

--
-- Table structure for table `training_assigment`
--

CREATE TABLE `training_assigment` (
  `assignment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_assigment`
--

INSERT INTO `training_assigment` (`assignment_id`, `user_id`, `training_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(200) DEFAULT NULL COMMENT 'This is a unique column',
  `password` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT 'Actual name of the user',
  `type` varchar(1) NOT NULL DEFAULT '2' COMMENT '1: admin user; 2:normal user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `type`) VALUES
(1, 'user1@ci.com', 'user1', 'User1', '1'),
(2, 'user2@ci.com', 'user2', 'User2', '1'),
(3, 'user3@ci.com', 'user3', 'User3', '2'),
(4, 'user4@ci.com', 'user4', 'User4', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashboard_client_assignment`
--
ALTER TABLE `dashboard_client_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `version_id` (`version_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `test_assignment`
--
ALTER TABLE `test_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `fk_test_user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`training_id`);

--
-- Indexes for table `training_assigment`
--
ALTER TABLE `training_assigment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `fk_training_user_id` (`user_id`),
  ADD KEY `training_id` (`training_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `index_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dashboard_client_assignment`
--
ALTER TABLE `dashboard_client_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test_assignment`
--
ALTER TABLE `test_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `training_assigment`
--
ALTER TABLE `training_assigment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `test_assignment`
--
ALTER TABLE `test_assignment`
  ADD CONSTRAINT `fk_test_test_id` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`),
  ADD CONSTRAINT `fk_test_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `training_assigment`
--
ALTER TABLE `training_assigment`
  ADD CONSTRAINT `fk_training_training_id` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`training_id`),
  ADD CONSTRAINT `fk_training_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
