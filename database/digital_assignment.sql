-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 03:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `addsubject`
--

CREATE TABLE `addsubject` (
  `sub_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subjectname` varchar(255) DEFAULT NULL,
  `tid` int(11) NOT NULL,
  `subjectcode` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addsubject`
--

INSERT INTO `addsubject` (`sub_id`, `semester`, `subjectname`, `tid`, `subjectcode`, `status`) VALUES
(49, 1, 'sub2', 0, '2', 0),
(52, 8, 'sub9', 0, '5', 0),
(53, 1, 'sub10', 0, '6', 0),
(54, 1, 'sub8', 0, '8', 0),
(55, 3, 'sub3', 0, '333', 0),
(56, 8, 'subject 88', 0, '666', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assignedsubject`
--

CREATE TABLE `assignedsubject` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `sub` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignedsubject`
--

INSERT INTO `assignedsubject` (`id`, `tid`, `sub`, `sem`, `status`) VALUES
(56, 68, 49, 1, 0),
(58, 75, 53, 1, 0),
(59, 75, 55, 3, 0),
(60, 75, 52, 8, 0),
(61, 75, 56, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th'),
(7, '7th'),
(8, '8th');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `aid` int(11) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `email` varchar(233) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`aid`, `username`, `email`, `password`) VALUES
(50, 'Admin', 'admin@gmail.com', '1234');

-- --------------------------------------------------------

CREATE TABLE `tbl_create_assignment` (
  `id` int(11) NOT NULL,
  `title` varchar(233) DEFAULT NULL,
  `description` varchar(999) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `file` varchar(233) DEFAULT NULL,
  `posted_by` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_create_assignment`
--

INSERT INTO `tbl_create_assignment` (`id`, `title`, `description`, `semester`, `subject`, `created_date`, `deadline`, `file`, `posted_by`) VALUES
(43, 'what ?', '<p>what is what?</p>\r\n', 1, 49, '2022-11-06', '2022-11-10', 'IMG_0123.JPG', 'Brett Mccoy'),
(44, 'hello', '<p>what is hello?</p>\r\n', 1, 49, '2022-11-12', '2022-11-24', 'IMG_0147.JPG', 'Brett Mccoy'),
(45, 'Finding root', '<p>By biesction Method</p>\r\n', 1, 49, '2022-11-12', '2022-11-25', 'IMG_0238.JPG', 'Brett Mccoy'),
(46, 'Bisection methd', '<p>Finding root</p>\r\n', 8, 52, '2022-11-12', '2022-11-24', 'IMG_0134.JPG', 'Roshan Keith');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `sid` int(11) NOT NULL,
  `sname` varchar(233) DEFAULT NULL,
  `email` varchar(233) DEFAULT NULL,
  `semester` int(11) NOT NULL,
  `roll_no` int(11) DEFAULT NULL,
  `saddress` varchar(233) DEFAULT NULL,
  `sphone` varchar(233) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`sid`, `sname`, `email`, `semester`, `roll_no`, `saddress`, `sphone`, `status`) VALUES
(56, 'Troy Key', 'wilakimy@gmail.com', 5, 71, 'Laboriosam in culpa', '9852706073', 1),
(57, 'Pearl Powell', 'qapunozi@gmail.com', 5, 37, 'Distinctio Labore d', '9849037614', 0),
(58, 'Driscoll Woodard', 'vofyxecaf@gmail.com', 6, 55, 'Molestiae quidem con', '9883799937', 0),
(59, 'Louis Hess', 'xinuwa@gmail.com', 7, 22, 'Consequat Distincti', '9865039046', 1),
(60, 'Scott Sawyer', 'gujo@gmail.com', 2, 45, 'Est ipsum nesciunt', '9863298915', 1),
(61, 'Noelle Faulkner', 'jiwapox@gmail.com', 7, 43, 'Sunt sunt laborum S', '9896260405', 1),
(62, 'Emmanuel Harrison', 'rotusy@gmail.com', 5, 85, 'Sed quia fuga Lorem', '9853299441', 0),
(63, 'Belle Gilmore', 'wylajo@gmail.com', 1, 52, 'Labore facere maxime', '9893909980', 1),
(64, 'Reed Hurley', 'qiviky@gmail.com', 1, 14, 'Aut est ut ea eligen', '9882405819', 1),
(65, 'Leigh Reid', 'vijycora@gmail.com', 1, 41, 'Dolor nihil qui ex p', '9866298671', 1),
(66, 'Liberty Gallegos', 'hapesefi@gmail.com', 1, 4, 'Sit sit accusantium ', '9894983628', 1),
(67, 'Gil Curtis', 'sachin@gmail.com', 7, 57, 'Consequatur volupta', '9899224458', 0),
(68, 'Yael Gomez', 'rajesh@gmail.com', 8, 55, 'Consectetur inventor', '9838412447', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_login`
--

CREATE TABLE `tbl_student_login` (
  `sid` int(11) NOT NULL,
  `username` varchar(233) DEFAULT NULL,
  `email` varchar(233) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `student` int(11) DEFAULT NULL,
  `password` varchar(233) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student_login`
--

INSERT INTO `tbl_student_login` (`sid`, `username`, `email`, `avatar`, `student`, `password`) VALUES
(24, 'Santosh', 'hapesefi@gmail.com', 'IMG_0130.JPG', 66, 'bsccsit7'),
(25, 'Louis Hess', 'xinuwa@gmail.com', 'IMG_0137.JPG', 59, '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'Yael Gomez', 'rajesh@gmail.com', 'IMG_0131.JPG', 68, '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submit_assignment`
--

CREATE TABLE `tbl_submit_assignment` (
  `id` int(11) NOT NULL,
  `assignment` int(11) DEFAULT NULL,
  `sub` varchar(255) NOT NULL,
  `submitted_date` date DEFAULT NULL,
  `file` varchar(233) DEFAULT NULL,
  `description` text NOT NULL,
  `submitted_by` varchar(233) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `grade` text NOT NULL,
  `suggestion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_submit_assignment`
--

INSERT INTO `tbl_submit_assignment` (`id`, `assignment`, `sub`, `submitted_date`, `file`, `description`, `submitted_by`, `status`, `grade`, `suggestion`) VALUES
(67, 44, '', '2022-11-12', 'IMG_0134.JPG', 'hey', 'Liberty Gallegos', 0, '', ''),
(68, 45, '', '2022-11-12', 'IMG_0143.JPG', 'average', 'Liberty Gallegos', 1, '3', 'Average'),
(69, 46, '', '2022-11-12', 'IMG_0133.JPG', 'akshd ajsf', 'Yael Gomez', 1, '3', 'very good,');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tname` varchar(233) DEFAULT NULL,
  `temail` varchar(222) DEFAULT NULL,
  `taddress` varchar(233) DEFAULT NULL,
  `tphone` varchar(233) DEFAULT NULL,
  `tsemester` int(11) DEFAULT NULL,
  `tsubject` int(11) DEFAULT 0,
  `teacher_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `isAssigned` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`tid`, `sid`, `tname`, `temail`, `taddress`, `tphone`, `tsemester`, `tsubject`, `teacher_id`, `status`, `isAssigned`) VALUES
(65, 0, 'Kaitlin Rasmussen', 'wiwon@gmail.com', 'Harum commodi sit s', '9875512814', NULL, 0, 0, 0, 1),
(68, 0, 'Brett Mccoy', 'brett@gmail.com', 'Ut doloribus veniam', '9801387123', NULL, 0, 0, 1, 1),
(70, 0, 'Nigel Bond', 'hozile@gmail.com', 'Rem laboriosam recu', '9844723067', NULL, 0, 0, 1, 0),
(71, 0, 'Dexter Wiggins', 'sasuvywaf@gmail.com', 'Impedit praesentium', '9822690981', NULL, 0, 0, 1, 1),
(72, 0, 'Pamela Savage', 'bonywuve@gmail.com', 'Inventore soluta iur', '9890092249', NULL, 0, 0, 0, 0),
(73, 0, 'Maggy Rivers', 'kuqacysi@gmail.com', 'Libero minima optio', '9876366359', NULL, 0, 0, 1, 0),
(74, 0, 'Norman Kim', 'wikumofuz@gmail.com', 'Repudiandae ea aut i', '9885704634', NULL, 0, 0, 0, 0),
(75, 0, 'Roshan Keith', 'roshan@gmail.com', 'Jhapa', '9803281015', NULL, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_login`
--

CREATE TABLE `tbl_teacher_login` (
  `tid` int(11) NOT NULL,
  `username` varchar(233) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(233) DEFAULT NULL,
  `teacher` int(11) DEFAULT NULL,
  `password` varchar(233) DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher_login`
--

INSERT INTO `tbl_teacher_login` (`tid`, `username`, `avatar`, `email`, `teacher`, `password`, `status`) VALUES
(9, 'Brett Mccoy', 'a.jpg', 'brett@gmail.com', 68, '81dc9bdb52d04dc20036dbd8313ed055', 0),
(10, 'Roshan Keith', 'IMG_0129.JPG', 'roshan@gmail.com', 75, '81dc9bdb52d04dc20036dbd8313ed055', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addsubject`
--
ALTER TABLE `addsubject`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `assignedsubject`
--
ALTER TABLE `assignedsubject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignedsubject_ibfk_1` (`sem`),
  ADD KEY `sub` (`sub`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tbl_create_assignment`
--
ALTER TABLE `tbl_create_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester` (`semester`),
  ADD KEY `tbl_create_assignment_ibfk_1` (`subject`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tbl_student_login`
--
ALTER TABLE `tbl_student_login`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `tbl_submit_assignment`
--
ALTER TABLE `tbl_submit_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment` (`assignment`),
  ADD KEY `assignment_3` (`assignment`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `tsemester` (`tsemester`),
  ADD KEY `tsubject` (`tsubject`);

--
-- Indexes for table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `teacher` (`teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addsubject`
--
ALTER TABLE `addsubject`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `assignedsubject`
--
ALTER TABLE `assignedsubject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_create_assignment`
--
ALTER TABLE `tbl_create_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_student_login`
--
ALTER TABLE `tbl_student_login`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_submit_assignment`
--
ALTER TABLE `tbl_submit_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignedsubject`
--
ALTER TABLE `assignedsubject`
  ADD CONSTRAINT `assignedsubject_ibfk_1` FOREIGN KEY (`sem`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `assignedsubject_ibfk_2` FOREIGN KEY (`sub`) REFERENCES `addsubject` (`sub_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `assignedsubject_ibfk_3` FOREIGN KEY (`tid`) REFERENCES `tbl_teacher` (`tid`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_create_assignment`
--
ALTER TABLE `tbl_create_assignment`
  ADD CONSTRAINT `tbl_create_assignment_ibfk_2` FOREIGN KEY (`semester`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_create_assignment_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `addsubject` (`sub_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_student_login`
--
ALTER TABLE `tbl_student_login`
  ADD CONSTRAINT `tbl_student_login_ibfk_1` FOREIGN KEY (`student`) REFERENCES `tbl_student` (`sid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_login_ibfk_2` FOREIGN KEY (`student`) REFERENCES `tbl_student` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_submit_assignment`
--
ALTER TABLE `tbl_submit_assignment`
  ADD CONSTRAINT `tbl_submit_assignment_ibfk_1` FOREIGN KEY (`assignment`) REFERENCES `tbl_create_assignment` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD CONSTRAINT `tbl_teacher_ibfk_1` FOREIGN KEY (`tsemester`) REFERENCES `semesters` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_teacher_login`
--
ALTER TABLE `tbl_teacher_login`
  ADD CONSTRAINT `tbl_teacher_login_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `tbl_teacher` (`tid`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
