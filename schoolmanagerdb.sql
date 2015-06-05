-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2015 at 06:23 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schoolmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`eventID` int(10) NOT NULL,
  `eventTitle` varchar(100) NOT NULL,
  `eventDate` date NOT NULL,
  `eventLoc` varchar(100) NOT NULL,
  `eventDesc` varchar(200) NOT NULL,
  `eventInivitees` varchar(200) NOT NULL DEFAULT 'None',
  `eventUrgency` int(1) NOT NULL DEFAULT '0',
  `occurSeq` int(1) NOT NULL DEFAULT '0',
  `occurNum` int(10) NOT NULL DEFAULT '1',
  `occurPeriod` int(1) NOT NULL DEFAULT '0',
  `occurWdy` int(1) NOT NULL DEFAULT '1',
  `eventActive` int(1) NOT NULL DEFAULT '1',
  `eventOwner` int(10) NOT NULL,
  `eventOwnerName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventTitle`, `eventDate`, `eventLoc`, `eventDesc`, `eventInivitees`, `eventUrgency`, `occurSeq`, `occurNum`, `occurPeriod`, `occurWdy`, `eventActive`, `eventOwner`, `eventOwnerName`) VALUES
(7, 'Staff Meeting', '2015-04-29', 'Staff Room', '', 'betty15,jamse14,', 2, 0, 1, 0, 1, 1, 17, 'James Mulandi');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE IF NOT EXISTS `extras` (
`extraID` int(10) NOT NULL,
  `info` varchar(50) NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`extraID`, `info`, `flag`) VALUES
(2, 'offline', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`mnID` int(100) NOT NULL,
  `selfID` varchar(50) NOT NULL,
  `selfTitle` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT 'default',
  `userlevel` varchar(200) NOT NULL DEFAULT '0',
  `todate` varchar(200) NOT NULL DEFAULT '0=0000-00-00',
  `reoccur` varchar(300) NOT NULL DEFAULT '0=0-0',
  `exception` varchar(300) NOT NULL DEFAULT '0=fld',
  `link_img` varchar(50) NOT NULL DEFAULT 'app.png',
  `admin` int(1) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`mnID`, `selfID`, `selfTitle`, `url`, `userlevel`, `todate`, `reoccur`, `exception`, `link_img`, `admin`, `public`) VALUES
(1, 'login', 'Home', 'Login/login', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'home.png', 0, 1),
(101, 'aboutus_login', 'About Us', 'login/aboutus', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'information.png', 0, 1),
(102, 'contactus_login', 'Contacts', 'login/contacts', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'mail.png', 0, 1),
(103, 'resource_login', 'Resource', 'login/resource', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'resource.png', 0, 1),
(104, 'events', 'Events', 'events/calendar', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'events.png', 0, 1),
(105, 'userprofile_login', 'User Profile', 'Login/userProfile', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'userprofile.png', 0, 0),
(107, 'notice_login', 'Notices', 'login/notices', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'pin.png', 0, 1),
(108, 'newevent_events', 'Add Event', 'Events/newEvent', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'plus.png', 0, 0),
(109, 'delevent_events', 'Delete Event', 'Events/delEvent', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'uncheck3.png', 0, 0),
(110, 'viewevents_events', 'View Events', 'Events/calendar', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'events.png', 0, 1),
(111, 'academic', 'Academic', 'Academic/showAll', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'academic.png', 0, 0),
(112, 'finance', 'Finance', 'Finance/showAll', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'finance.png', 0, 0),
(113, 'students', 'Student Life', 'Students/searchStudent', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'student.png', 0, 0),
(114, 'staffLife', 'Staff Life', 'Staff/showAll', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'staff.png', 0, 0),
(115, 'administration', 'Settings', 'administration/showAll', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'manage2.png', 1, 0),
(116, 'help', 'Help', 'login/help', '0,1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'help.png', 0, 1),
(118, 'newStudent_students', 'New Student', 'Students/newStudent', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'plus.png', 0, 0),
(119, 'draftStudentRecords_Students', 'Draft Records', 'Students/draftStudentRecords', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'diskedit.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
`posID` int(10) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`posID`, `title`) VALUES
(1, 'Manager'),
(2, 'Head Teacher'),
(3, 'Senior Teacher'),
(4, 'Teacher'),
(5, 'Accountant'),
(6, 'Secretary');

-- --------------------------------------------------------

--
-- Table structure for table `pwdbackup`
--

CREATE TABLE IF NOT EXISTS `pwdbackup` (
`bkID` int(100) NOT NULL,
  `userID` int(10) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `lastDate` date NOT NULL,
  `changedBy` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recent`
--

CREATE TABLE IF NOT EXISTS `recent` (
`recID` int(100) NOT NULL,
  `itemTitle` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `userid` int(10) NOT NULL,
  `link_img` varchar(50) NOT NULL DEFAULT 'app.png'
) ENGINE=InnoDB AUTO_INCREMENT=845 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recent`
--

INSERT INTO `recent` (`recID`, `itemTitle`, `url`, `userid`, `link_img`) VALUES
(266, 'Add Event', 'Events/newEvent', 19, 'plus.png'),
(295, 'View Events', 'Events/calendar', 0, 'events.png'),
(476, 'StudentsForm1', 'Students/studentsForm1', 19, 'app.png'),
(767, 'Manage', 'Students/manageStudents', 19, 'manage2.png'),
(775, 'Resource', 'Login/resource', 19, 'resource.png'),
(814, 'New Student', 'Students/newStudent', 19, 'plus.png'),
(815, 'Draft Records', 'Students/draftStudentRecords', 19, 'diskedit.png'),
(819, 'User Profile', 'Login/userProfile', 19, 'userprofile.png'),
(824, 'About Us', 'Login/aboutus', 19, 'information.png'),
(827, 'Contacts', 'Login/contacts', 19, 'mail.png'),
(830, 'Notices', 'Login/notices', 19, 'pin.png'),
(831, 'Events', 'Events/calendar', 19, 'events.png'),
(832, 'Academic', 'Academic/showAll', 19, 'academic.png'),
(833, 'Finance', 'Finance/showAll', 19, 'finance.png'),
(835, 'Staff Life', 'Staff/showAll', 19, 'staff.png'),
(840, 'Help', 'Login/help', 19, 'help.png'),
(842, 'Student Life', 'Students/searchStudent', 19, 'student.png'),
(844, 'Home', 'Login/login', 19, 'home.png');

-- --------------------------------------------------------

--
-- Table structure for table `securityqueries`
--

CREATE TABLE IF NOT EXISTS `securityqueries` (
`qID` int(10) NOT NULL,
  `qstn` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `securityqueries`
--

INSERT INTO `securityqueries` (`qID`, `qstn`) VALUES
(1, 'What is your childhood name?'),
(2, 'What is your mother''s maiden name?'),
(3, 'Where did you first met your spouse?'),
(4, 'What is the name of your first school?'),
(5, 'What is the name of your favourite pet?'),
(6, 'What is your favourite food?');

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE IF NOT EXISTS `setup` (
`setupKey` int(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `public` int(1) NOT NULL,
  `admin` int(1) NOT NULL,
  `userlvl` varchar(100) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`setupKey`, `url`, `public`, `admin`, `userlvl`, `content`) VALUES
(1, 'Login/login', 1, 0, '0,1,2,3,4,5,6,7', '<h3 style="margin-left:280px;">School Management System</h3><p>Welcome to the Vine Gardens School&reg; management system. <br>This is an integrated system built to offer you the following application:</p>\r\n<ul>\r\n<li>Student Life - All about students</li>\r\n<li>Staff Life - All about staffs</li>\r\n<li>Academic - For class assignments and examination management</li>\r\n<li>Finance - All about finance</li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`studentKey` int(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `sex` int(1) DEFAULT '0',
  `dob` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `studentImage` varchar(50) DEFAULT 'None',
  `admNo` varchar(10) DEFAULT '0',
  `county` varchar(50) DEFAULT 'None',
  `ward` varchar(50) DEFAULT 'None',
  `area` varchar(50) DEFAULT 'None',
  `street` varchar(50) DEFAULT 'None',
  `parentOneFullname` varchar(50) DEFAULT 'None',
  `parentOneRel` int(1) DEFAULT '0',
  `parentOneRelOther` varchar(20) DEFAULT 'None',
  `parentOnePhone` varchar(15) DEFAULT '0',
  `parentOneEmail` varchar(50) DEFAULT NULL,
  `parentOneJob` varchar(50) DEFAULT NULL,
  `parentOneHome` varchar(50) DEFAULT NULL,
  `parentTwoFullname` varchar(50) DEFAULT 'None',
  `parentTwoRel` int(1) DEFAULT '0',
  `parentTwoRelOther` varchar(20) DEFAULT 'None',
  `parentTwoPhone` varchar(15) DEFAULT 'None',
  `parentTwoEmail` varchar(50) DEFAULT 'None',
  `parentTwoJob` varchar(50) DEFAULT 'None',
  `parentTwoHome` varchar(50) DEFAULT 'None',
  `entryClass` int(2) DEFAULT '0',
  `firstSchool` varchar(50) DEFAULT 'None',
  `formerSchool` varchar(30) DEFAULT 'None',
  `lastScore` int(5) DEFAULT '0',
  `interviewed` int(1) DEFAULT '0',
  `interviewScore` int(5) DEFAULT '0',
  `talents` varchar(200) DEFAULT NULL,
  `talentsOther` varchar(200) DEFAULT 'None',
  `medical` varchar(200) DEFAULT NULL,
  `medicalOther` varchar(200) DEFAULT 'None',
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `regBy` varchar(50) DEFAULT NULL,
  `draft` int(1) DEFAULT '1',
  `active` enum('Yes','No') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentKey`, `fname`, `lname`, `sex`, `dob`, `nationality`, `studentImage`, `admNo`, `county`, `ward`, `area`, `street`, `parentOneFullname`, `parentOneRel`, `parentOneRelOther`, `parentOnePhone`, `parentOneEmail`, `parentOneJob`, `parentOneHome`, `parentTwoFullname`, `parentTwoRel`, `parentTwoRelOther`, `parentTwoPhone`, `parentTwoEmail`, `parentTwoJob`, `parentTwoHome`, `entryClass`, `firstSchool`, `formerSchool`, `lastScore`, `interviewed`, `interviewScore`, `talents`, `talentsOther`, `medical`, `medicalOther`, `regDate`, `regBy`, `draft`, `active`) VALUES
(18, 'Emily', 'Kitsao', 1, '2008-04-29', 'Kenya', 'None', '431', 'Nairobi', 'Nairobi', 'Buruburu', '', 'Nicodemus Karisa', 6, '', '0711937485', 'nkmwambs@gmail.com', 'Lecturer', 'Kileleshwa', '', 0, '', '', '', '', '', 6, '1', '', 0, 0, 375, 'Singing', '', '', '', '2015-05-04 20:41:22', 'Nicodemus Karisa', 0, 'Yes'),
(22, 'Bella', 'Kai', 1, '2011-03-01', 'Kenya', 'None', '546', 'Nairobi', 'Kabete', 'Lower Kabete', 'Iria Road', 'Pst David Gitau', 1, '', '0724756384', 'dgitash@yahoo.com', 'Pastor', 'Kabete', 'Hellen Komora', 2, '', '0722837465', '', 'Hotelier', 'Lower Kabete', 7, '0', 'Bishop Gory Primary', 288, 1, 301, 'Singing', '', 'Other', '', '2015-05-04 20:18:57', 'Nicodemus Karisa', 0, 'Yes'),
(28, 'John', 'Mungai', 2, '2015-04-14', 'Kenya', 'None', '423', 'Nairobi', 'Kilimani', 'Kilimani', '', 'Stephen Njoroge', 1, '', '0722758493', '', '', '', '', 0, '', '', '', '', '', 6, '1', '', 0, 0, 384, 'Ball Games', '', 'Other', '', '2015-05-04 20:02:29', 'Nicodemus Karisa', 1, 'Yes'),
(31, 'Joyce', 'Cherono', 1, '2006-07-07', 'Kenya', 'None', '444', 'Bomet', 'Bomet', 'Bomet Center', '', 'Arnold Ken', 1, '', '0710645364', '', '', '', '', 0, '', '', '', '', '', 7, '0', 'ABC Junior School', 422, 1, 396, 'Ball Games,Swimming,Singing', '', 'Asthma', '', '2015-04-30 21:14:21', 'Nicodemus Karisa', 0, 'Yes'),
(32, 'Peter', 'Ndungu', 2, '2006-05-14', 'Kenya', 'None', '452', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '', 0, 0, 0, NULL, '', NULL, '', '2015-05-04 20:02:53', 'Nicodemus Karisa', 1, 'Yes'),
(33, 'Lilian', 'Rodgers', 1, '2008-02-20', 'Kenya', 'None', '564', 'Momabasa', 'Mlaleo', 'Mlaleo', 'Moi Avenus', 'Abdalla Sheria', 6, '', '0732847596', '', '', '', '', 0, '', '', '', '', '', 4, '1', '', 0, 1, 333, 'Ball Games,Singing', '', 'Other', '', '2015-05-04 20:35:10', 'Nicodemus Karisa', 0, 'Yes'),
(34, 'Susan', 'Keino', 1, '2011-05-10', 'Kenya', 'None', '565', '', '', '', '', '', 0, '', '', '', '', '', '', 0, '', '', '', '', '', 0, '', '', 0, 0, 0, NULL, '', NULL, '', '2015-05-04 19:03:23', 'Nicodemus Karisa', 1, 'Yes'),
(35, 'Jonathan', 'Kamau', 2, '2009-02-03', 'Kenya', 'None', '234', 'Kiambu', 'Ndeiya', 'Ndeiya', 'Wanyee Road', 'Kamau Njuguna', 1, '', '0734645273', '', 'Driver', 'Ndeiya', 'Martha Njenga', 2, '', '0722637463', '', 'Business Woman', 'Ndeiya', 6, '0', 'Lwera Primary', 389, 1, 352, 'Ball Games,Singing,Swimming', '', 'Other', '', '2015-05-04 19:06:56', 'Nicodemus Karisa', 0, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`ID` int(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userlevel` int(5) NOT NULL,
  `delegated_role` int(10) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL,
  `auth` int(5) NOT NULL DEFAULT '0',
  `logs_after_register` int(10) NOT NULL DEFAULT '0',
  `securityQstnID` int(10) NOT NULL DEFAULT '0',
  `qAns` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `fname`, `lname`, `email`, `userlevel`, `delegated_role`, `admin`, `password`, `auth`, `logs_after_register`, `securityQstnID`, `qAns`) VALUES
(16, 'betty15', 'Beatrice', 'Ruiru', 'BRuiru@vine.com', 1, 0, 0, 'e7d109998cac2c74988c6f632991afed', 0, 1, 1, 'Betty'),
(17, 'jamse14', 'James', 'Mulandi', 'JMulandi1@gmail.com', 5, 0, 0, 'e7d109998cac2c74988c6f632991afed', 0, 1, 1, 'Jamo'),
(18, 'sallyby', 'Sally', 'Ben', 'ssbenny@yahoo.com', 4, 0, 0, 'f5b59898cc6d8e4fbef93b1d6b3e6ce0', 0, 0, 1, 'Sally'),
(19, 'nico2015', 'Nicodemus', 'Karisa', 'NKarisa@ke.ci.org', 2, 0, 1, 'fbdf9989ea636d6b339fd6b85f63e06e', 0, 1, 0, ''),
(22, 'livingO', 'Livingstone', 'Onduso', 'eonduso@gmail.com', 1, 0, 0, 'fbdf9989ea636d6b339fd6b85f63e06e', 0, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
 ADD PRIMARY KEY (`extraID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`mnID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
 ADD PRIMARY KEY (`posID`);

--
-- Indexes for table `pwdbackup`
--
ALTER TABLE `pwdbackup`
 ADD PRIMARY KEY (`bkID`);

--
-- Indexes for table `recent`
--
ALTER TABLE `recent`
 ADD PRIMARY KEY (`recID`);

--
-- Indexes for table `securityqueries`
--
ALTER TABLE `securityqueries`
 ADD PRIMARY KEY (`qID`);

--
-- Indexes for table `setup`
--
ALTER TABLE `setup`
 ADD PRIMARY KEY (`setupKey`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`studentKey`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `eventID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
MODIFY `extraID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `mnID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
MODIFY `posID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pwdbackup`
--
ALTER TABLE `pwdbackup`
MODIFY `bkID` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recent`
--
ALTER TABLE `recent`
MODIFY `recID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=845;
--
-- AUTO_INCREMENT for table `securityqueries`
--
ALTER TABLE `securityqueries`
MODIFY `qID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `setup`
--
ALTER TABLE `setup`
MODIFY `setupKey` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `studentKey` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
