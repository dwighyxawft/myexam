-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2023 at 01:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_mobile` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_address` varchar(255) NOT NULL,
  `admin_gender` text NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_mobile`, `admin_image`, `admin_address`, `admin_gender`, `admin_password`, `admin_created_at`) VALUES
(1, 'Seyi Ajiola', 'seyiajiola234@gmail.com', '08072623191', 'b460389419b34610ae78b3466eacfc03.jpg', '28, Alapo Street, Ijebu Ode, Ogun State, Nigeria', 'Female', '$2y$10$MkWcXMpVDAwDbJKMx1TJ4O/VM6DFQj0qo2L7uOCPNdapmgpB/nXqK', '2022-04-01'),
(2, 'Timilehin Amu', 'amuoladipupo@gmail.com', '08181107488', 'male.jpg', '28, Alapo Street, Ijebu Ode, Ogun State, Nigeria', 'Female', '$2y$10$Gk15vc2GKS5tpkDam3XdSey/lO9GjD8jhP/9iXZByhr1KNFUabLPy', '2022-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `exam_table`
--

CREATE TABLE `exam_table` (
  `exam_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `exam_title` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `exam_time` time NOT NULL,
  `exam_duration` int(25) NOT NULL,
  `total_questions` int(10) NOT NULL,
  `marks_per_right_answer` text NOT NULL,
  `exam_status` text NOT NULL,
  `exam_created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_table`
--

INSERT INTO `exam_table` (`exam_id`, `admin_id`, `exam_title`, `exam_date`, `exam_time`, `exam_duration`, `total_questions`, `marks_per_right_answer`, `exam_status`, `exam_created_on`) VALUES
(1, 2, 'Hypertext Preprocessor (PHP)', '2022-04-22', '14:30:00', 20, 20, '5', 'Completed', '2022-04-07 09:05:06'),
(6, 2, 'Javascript', '2022-05-01', '18:00:00', 2, 10, '10', 'Completed', '2022-04-30 14:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `option_table`
--

CREATE TABLE `option_table` (
  `option_id` int(11) NOT NULL,
  `question_id` int(10) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `option_title` varchar(255) NOT NULL,
  `option_number` int(10) NOT NULL,
  `option_created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `option_table`
--

INSERT INTO `option_table` (`option_id`, `question_id`, `exam_id`, `option_title`, `option_number`, `option_created_on`) VALUES
(1, 1, 1, '%variable_name', 1, '2022-04-10 17:17:35'),
(2, 1, 1, '#variable_name', 2, '2022-04-10 17:17:36'),
(3, 1, 1, '$variable_name', 3, '2022-04-10 17:17:36'),
(4, 1, 1, '@variable_name', 4, '2022-04-10 17:17:36'),
(9, 3, 1, 'Frontend ', 1, '2022-04-10 17:20:34'),
(10, 3, 1, 'Rightend', 2, '2022-04-10 17:20:34'),
(11, 3, 1, 'Leftend', 3, '2022-04-10 17:20:34'),
(12, 3, 1, 'Backend', 4, '2022-04-10 17:20:34'),
(21, 6, 1, 'jquery', 1, '2022-04-13 15:17:38'),
(22, 6, 1, 'laravel', 2, '2022-04-13 15:17:38'),
(23, 6, 1, 'bootstrap', 3, '2022-04-13 15:17:38'),
(24, 6, 1, 'nodejs', 4, '2022-04-13 15:17:38'),
(33, 9, 1, 'date.getDay();', 1, '2022-04-19 23:15:37'),
(34, 9, 1, 'date(\"Y-m-d\");', 2, '2022-04-19 23:15:37'),
(35, 9, 1, '$date(\"Y-m-d\");', 3, '2022-04-19 23:15:37'),
(36, 9, 1, 'new Date;', 4, '2022-04-19 23:15:37'),
(37, 10, 1, '</ />', 1, '2022-04-19 23:16:26'),
(38, 10, 1, '</php />', 2, '2022-04-19 23:16:26'),
(39, 10, 1, '<? ?>', 3, '2022-04-19 23:16:27'),
(40, 10, 1, '<?php ?>', 4, '2022-04-19 23:16:27'),
(41, 11, 1, 'mongodb', 1, '2022-04-19 23:20:04'),
(42, 11, 1, 'MySQL', 2, '2022-04-19 23:20:04'),
(43, 11, 1, 'HerSQL', 3, '2022-04-19 23:20:04'),
(44, 11, 1, 'firebase', 4, '2022-04-19 23:20:04'),
(45, 12, 1, 'echo', 1, '2022-04-22 18:43:04'),
(46, 12, 1, 'fopen', 2, '2022-04-22 18:43:04'),
(47, 12, 1, 'print_v', 3, '2022-04-22 18:43:05'),
(48, 12, 1, 'in_print', 4, '2022-04-22 18:43:05'),
(49, 13, 1, 'Hypertext Preprocessor', 1, '2022-04-22 18:44:17'),
(50, 13, 1, 'Personal Hybrid Pen', 2, '2022-04-22 18:44:18'),
(51, 13, 1, 'Personnel Hypertext Prorocol', 3, '2022-04-22 18:44:18'),
(52, 13, 1, 'Processing HyperText Protocol', 4, '2022-04-22 18:44:18'),
(53, 14, 1, 'Sql', 1, '2022-04-22 18:45:19'),
(54, 14, 1, 'Nosql', 2, '2022-04-22 18:45:19'),
(55, 14, 1, 'SomeSql', 3, '2022-04-22 18:45:19'),
(56, 14, 1, 'EverySql', 4, '2022-04-22 18:45:19'),
(57, 15, 1, 'True', 1, '2022-04-22 18:46:58'),
(58, 15, 1, 'False', 2, '2022-04-22 18:46:58'),
(59, 15, 1, 'sometimes true', 3, '2022-04-22 18:46:58'),
(60, 15, 1, 'sometimes false', 4, '2022-04-22 18:46:58'),
(61, 16, 1, 'else if(condition){statement}', 1, '2022-04-22 18:48:35'),
(62, 16, 1, 'elseif(condition){statement}', 2, '2022-04-22 18:48:35'),
(63, 16, 1, 'el if(condition){statement}', 3, '2022-04-22 18:48:36'),
(64, 16, 1, 'elif(condition){statement}', 4, '2022-04-22 18:48:36'),
(65, 17, 1, 'frontend, rightend', 1, '2022-04-22 18:50:47'),
(66, 17, 1, 'leftend, backend', 2, '2022-04-22 18:50:47'),
(67, 17, 1, 'backend, frontend', 3, '2022-04-22 18:50:47'),
(68, 17, 1, 'frontend, leftend', 4, '2022-04-22 18:50:47'),
(69, 18, 1, 'unity', 1, '2022-04-22 19:04:20'),
(70, 18, 1, 'c++', 2, '2022-04-22 19:04:20'),
(71, 18, 1, 'virtual studio', 3, '2022-04-22 19:04:20'),
(72, 18, 1, 'nodejs', 4, '2022-04-22 19:04:20'),
(73, 19, 1, 'Yes', 1, '2022-04-22 19:05:28'),
(74, 19, 1, 'No', 2, '2022-04-22 19:05:28'),
(75, 19, 1, 'Not Sure', 3, '2022-04-22 19:05:28'),
(76, 19, 1, 'I dont know', 4, '2022-04-22 19:05:28'),
(77, 20, 1, 'HTML, CSS, Javascript, C++', 1, '2022-04-22 19:07:20'),
(78, 20, 1, 'CSS, Python, Java, PHP', 2, '2022-04-22 19:07:20'),
(79, 20, 1, 'PHP, Jquery, Bootstrap, SQL', 3, '2022-04-22 19:07:20'),
(80, 20, 1, 'HTML, CSS, Javascript, PHP', 4, '2022-04-22 19:07:20'),
(81, 21, 1, 'Yes', 1, '2022-04-22 19:08:24'),
(82, 21, 1, 'No', 2, '2022-04-22 19:08:24'),
(83, 21, 1, 'Not sure', 3, '2022-04-22 19:08:24'),
(84, 21, 1, 'I dont know', 4, '2022-04-22 19:08:24'),
(85, 22, 1, 'Converting Javascript variables into PHP variables', 1, '2022-04-22 19:10:26'),
(86, 22, 1, 'Getting informnation from the client side to the server side', 2, '2022-04-22 19:10:26'),
(87, 22, 1, 'Loading the webpage for information', 3, '2022-04-22 19:10:26'),
(88, 22, 1, 'click buttons', 4, '2022-04-22 19:10:27'),
(89, 23, 1, 'submitting information', 1, '2022-04-22 19:49:51'),
(90, 23, 1, 'for user signup', 2, '2022-04-22 19:49:51'),
(91, 23, 1, 'user login', 3, '2022-04-22 19:49:51'),
(92, 23, 1, 'displaying information', 4, '2022-04-22 19:49:51'),
(93, 24, 1, 'CSS', 1, '2022-04-22 19:51:00'),
(94, 24, 1, 'Materialize', 2, '2022-04-22 19:51:00'),
(95, 24, 1, 'Bootsatrap', 3, '2022-04-22 19:51:00'),
(96, 24, 1, 'Tailwind', 4, '2022-04-22 19:51:01'),
(97, 25, 1, 'Java', 1, '2022-04-22 19:52:01'),
(98, 25, 1, 'laravel', 2, '2022-04-22 19:52:01'),
(99, 25, 1, 'Javascript', 3, '2022-04-22 19:52:02'),
(100, 25, 1, 'PHP', 4, '2022-04-22 19:52:02'),
(101, 26, 6, 'true', 1, '2022-04-30 14:28:38'),
(102, 26, 6, 'false', 2, '2022-04-30 14:28:38'),
(103, 26, 6, 'sometimes true', 3, '2022-04-30 14:28:38'),
(104, 26, 6, 'sometimes false', 4, '2022-04-30 14:28:38'),
(105, 27, 6, 'Frontend ', 1, '2022-04-30 14:29:25'),
(106, 27, 6, 'Leftend', 2, '2022-04-30 14:29:25'),
(107, 27, 6, 'Rightend', 3, '2022-04-30 14:29:25'),
(108, 27, 6, 'Backend', 4, '2022-04-30 14:29:25'),
(109, 28, 6, 'Enterprise', 1, '2022-04-30 14:31:10'),
(110, 28, 6, 'Django', 2, '2022-04-30 14:31:10'),
(111, 28, 6, 'React', 3, '2022-04-30 14:31:11'),
(112, 28, 6, 'Pixi', 4, '2022-04-30 14:31:11'),
(113, 29, 6, 'in_array()', 1, '2022-04-30 14:33:08'),
(114, 29, 6, 'foreach()', 2, '2022-04-30 14:33:08'),
(115, 29, 6, 'window.location.href', 3, '2022-04-30 14:33:08'),
(116, 29, 6, 'window.computer.close', 4, '2022-04-30 14:33:08'),
(117, 30, 6, 'Phaser', 1, '2022-04-30 14:34:14'),
(118, 30, 6, 'Pixi', 2, '2022-04-30 14:34:14'),
(119, 30, 6, 'Node', 3, '2022-04-30 14:34:15'),
(120, 30, 6, 'Jquery', 4, '2022-04-30 14:34:15'),
(121, 31, 6, 'date(\"Y-m-d\");', 1, '2022-04-30 14:35:37'),
(122, 31, 6, 'date.today();', 2, '2022-04-30 14:35:37'),
(123, 31, 6, 'Date.now();', 3, '2022-04-30 14:35:37'),
(124, 31, 6, 'Date();', 4, '2022-04-30 14:35:37'),
(125, 32, 6, 'Google V8', 1, '2022-04-30 14:37:39'),
(126, 32, 6, 'Safari V8', 2, '2022-04-30 14:37:39'),
(127, 32, 6, 'Chromium', 3, '2022-04-30 14:37:39'),
(128, 32, 6, 'Mozilla', 4, '2022-04-30 14:37:39'),
(129, 33, 6, 'element.inner()', 1, '2022-04-30 14:39:23'),
(130, 33, 6, 'element.html()', 2, '2022-04-30 14:39:23'),
(131, 33, 6, 'element.innerHTML();', 3, '2022-04-30 14:39:23'),
(132, 33, 6, 'element.htmlContent();', 4, '2022-04-30 14:39:23'),
(133, 34, 6, 'node', 1, '2022-04-30 14:40:33'),
(134, 34, 6, 'react', 2, '2022-04-30 14:40:33'),
(135, 34, 6, 'jquery', 3, '2022-04-30 14:40:33'),
(136, 34, 6, 'phaser', 4, '2022-04-30 14:40:33'),
(137, 35, 6, 'Low Level', 1, '2022-04-30 14:41:55'),
(138, 35, 6, 'High Level', 2, '2022-04-30 14:41:55'),
(139, 35, 6, 'Assembly ', 3, '2022-04-30 14:41:55'),
(140, 35, 6, 'Human', 4, '2022-04-30 14:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `question_table`
--

CREATE TABLE `question_table` (
  `question_id` int(11) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `question_title` varchar(255) NOT NULL,
  `correct_answer` int(25) NOT NULL,
  `question_number` int(10) NOT NULL,
  `question_created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_table`
--

INSERT INTO `question_table` (`question_id`, `exam_id`, `question_title`, `correct_answer`, `question_number`, `question_created_on`) VALUES
(1, 1, 'how is a php variable defined', 3, 1, '2022-04-10 17:17:35'),
(3, 1, 'PHP is under what part of web development', 4, 2, '2022-04-10 17:20:34'),
(6, 1, 'Which of the following is a php framework', 2, 3, '2022-04-13 15:17:38'),
(9, 1, 'Which of the following is used to get the date in php', 2, 4, '2022-04-19 23:15:37'),
(10, 1, 'How is a php code identified in a source code', 4, 5, '2022-04-19 23:16:26'),
(11, 1, 'Which of the following is a database in php', 2, 6, '2022-04-19 23:20:04'),
(12, 1, 'which of the following is used to display in php', 1, 7, '2022-04-22 18:43:04'),
(13, 1, 'what is php', 1, 8, '2022-04-22 18:44:17'),
(14, 1, 'What type of database is Mysql', 1, 9, '2022-04-22 18:45:19'),
(15, 1, 'PHP can be used with other javascript ', 1, 10, '2022-04-22 18:46:58'),
(16, 1, 'How is an elseif statement defined in php', 2, 11, '2022-04-22 18:48:35'),
(17, 1, 'PHP is _______ while Javascript is _________', 3, 12, '2022-04-22 18:50:47'),
(18, 1, 'Which of the following is another backend framework for web', 4, 13, '2022-04-22 19:04:20'),
(19, 1, 'Is PHP a programming language', 1, 14, '2022-04-22 19:05:28'),
(20, 1, 'For basic web developers, which of the following is good to learn', 4, 15, '2022-04-22 19:07:20'),
(21, 1, 'Can PHP be used for System Development', 1, 16, '2022-04-22 19:08:24'),
(22, 1, 'PHP ajax can be used for the following except ', 4, 17, '2022-04-22 19:10:26'),
(23, 1, 'Uses of forms in an html document includes the following except', 4, 18, '2022-04-22 19:49:51'),
(24, 1, 'Which of these is the styling language of the web', 1, 19, '2022-04-22 19:51:00'),
(25, 1, 'Which of these is the scripting language of the web', 3, 20, '2022-04-22 19:52:01'),
(26, 6, 'Javascript is the same thing as java', 2, 1, '2022-04-30 14:28:38'),
(27, 6, 'Javascript is in what part of web development', 1, 2, '2022-04-30 14:29:25'),
(28, 6, 'Which of the following is a framework in javascript', 3, 3, '2022-04-30 14:31:10'),
(29, 6, 'Which of the following is a syntax in javascript', 3, 4, '2022-04-30 14:33:08'),
(30, 6, 'Which of the following javascript frameworks runs on the server', 3, 5, '2022-04-30 14:34:14'),
(31, 6, 'Which of the following syntaxes is used to get today\'s date in javascript', 3, 6, '2022-04-30 14:35:37'),
(32, 6, 'Node runs on __________ engine', 1, 7, '2022-04-30 14:37:38'),
(33, 6, 'Which of the following is used to alter the inner html content of an element in html', 3, 8, '2022-04-30 14:39:22'),
(34, 6, 'Which of the following is a javascript framework for games', 4, 9, '2022-04-30 14:40:33'),
(35, 6, 'Javascript is a __________ Language', 2, 10, '2022-04-30 14:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_enroll_exam_table`
--

CREATE TABLE `user_enroll_exam_table` (
  `enroll_id` int(10) NOT NULL,
  `offerer_id` int(10) NOT NULL,
  `enroller_id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `acceptance_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_enroll_exam_table`
--

INSERT INTO `user_enroll_exam_table` (`enroll_id`, `offerer_id`, `enroller_id`, `exam_id`, `acceptance_status`) VALUES
(1, 2, 1, 1, 'accepted'),
(2, 2, 1, 6, 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_question_answers_table`
--

CREATE TABLE `user_exam_question_answers_table` (
  `answer_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `user_answer` int(10) NOT NULL,
  `correct_answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_exam_question_answers_table`
--

INSERT INTO `user_exam_question_answers_table` (`answer_id`, `user_id`, `admin_id`, `exam_id`, `question_id`, `user_answer`, `correct_answer`) VALUES
(1, 1, 2, 1, 25, 3, 3),
(2, 1, 2, 1, 24, 1, 1),
(3, 1, 2, 1, 23, 4, 4),
(4, 1, 2, 1, 22, 4, 4),
(5, 1, 2, 1, 21, 1, 1),
(6, 1, 2, 1, 20, 4, 4),
(7, 1, 2, 1, 19, 1, 1),
(8, 1, 2, 1, 18, 4, 4),
(9, 1, 2, 1, 17, 3, 3),
(10, 1, 2, 1, 16, 2, 2),
(11, 1, 2, 1, 15, 1, 1),
(12, 1, 2, 1, 14, 1, 1),
(13, 1, 2, 1, 13, 1, 1),
(14, 1, 2, 1, 12, 1, 1),
(15, 1, 2, 1, 11, 2, 2),
(16, 1, 2, 1, 10, 3, 4),
(17, 1, 2, 1, 9, 2, 2),
(18, 1, 2, 1, 6, 2, 2),
(19, 1, 2, 1, 3, 4, 4),
(20, 1, 2, 1, 1, 3, 3),
(33, 1, 2, 6, 35, 2, 2),
(34, 1, 2, 6, 34, 4, 4),
(35, 1, 2, 6, 33, 3, 3),
(36, 1, 2, 6, 32, 1, 1),
(37, 1, 2, 6, 31, 3, 3),
(38, 1, 2, 6, 30, 3, 3),
(39, 1, 2, 6, 29, 3, 3),
(40, 1, 2, 6, 28, 3, 3),
(41, 1, 2, 6, 27, 1, 1),
(42, 1, 2, 6, 26, 2, 2),
(43, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_takers_table`
--

CREATE TABLE `user_exam_takers_table` (
  `sit_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `commencement_time` time NOT NULL,
  `completion_time` time NOT NULL,
  `user_exam_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_exam_takers_table`
--

INSERT INTO `user_exam_takers_table` (`sit_id`, `user_id`, `exam_id`, `admin_id`, `commencement_time`, `completion_time`, `user_exam_status`) VALUES
(1, 1, 1, 2, '22:27:45', '22:38:34', 'Sitted'),
(3, 1, 6, 2, '17:00:58', '17:02:10', 'Sitted');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_mobile` varchar(100) NOT NULL,
  `user_gender` text NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `user_name`, `user_email`, `user_address`, `user_image`, `user_mobile`, `user_gender`, `user_password`, `user_created_at`) VALUES
(1, 'Amu Oladipupo', 'dwightxawft@gmail.com', '12, Adetunji Adebajo, Pineapple Estate, Lucky Fibres, Ikorodu, Lagos', 'IMG-20200622-WA0038.jpg', '07057249825', 'Male', '$2y$10$WWKt93Y2wOvCetENZSIkeenTupyxIODEMqnSwRmw2/ZXANV6foOP.', '2022-04-12'),
(2, 'Beng Adex', 'bengadex256@gmail.com', '247, Osota Bus Stop, Ewu-Elepe, Ikorodu, Lagos, Nigeria', 'male.jpg', '07015281103', 'Male', '$2y$10$kl.1fxDbI/.ubfN8KwX3ruDNLIhnr2MxleunVGitHZE3q0JRrxJvu', '2022-04-12'),
(3, 'Amu Oladipupo', 'amuoladipupo@gmail.com', '247, Osota Bus Stop, Ewu-Elepe, Ikorodu, Lagos, Nigeria', 'male.jpg', '07057249825', 'Male', '$2y$10$6mn78nUDA7eG/qrBsjVHpe6sj9eP92O2eXCWSZyoxgvqQhJHUNoZW', '2022-06-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `exam_table`
--
ALTER TABLE `exam_table`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `option_table`
--
ALTER TABLE `option_table`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `question_table`
--
ALTER TABLE `question_table`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `user_enroll_exam_table`
--
ALTER TABLE `user_enroll_exam_table`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `user_exam_question_answers_table`
--
ALTER TABLE `user_exam_question_answers_table`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `user_exam_takers_table`
--
ALTER TABLE `user_exam_takers_table`
  ADD PRIMARY KEY (`sit_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_table`
--
ALTER TABLE `exam_table`
  MODIFY `exam_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `option_table`
--
ALTER TABLE `option_table`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `question_table`
--
ALTER TABLE `question_table`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_enroll_exam_table`
--
ALTER TABLE `user_enroll_exam_table`
  MODIFY `enroll_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_exam_question_answers_table`
--
ALTER TABLE `user_exam_question_answers_table`
  MODIFY `answer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_exam_takers_table`
--
ALTER TABLE `user_exam_takers_table`
  MODIFY `sit_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
