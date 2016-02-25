-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2016 at 03:52 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schoolmanager`
--
CREATE DATABASE IF NOT EXISTS `schoolmanager` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `schoolmanager`;

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `aclID` int(100) NOT NULL AUTO_INCREMENT,
  `aclTitle` varchar(100) NOT NULL,
  PRIMARY KEY (`aclID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`aclID`, `aclTitle`) VALUES
(1, 'Manager'),
(2, 'Head-Teacher'),
(3, 'Senior Teacher'),
(4, 'Teacher'),
(5, 'Accountant'),
(6, 'Secretary');

-- --------------------------------------------------------

--
-- Table structure for table `classenroll`
--

CREATE TABLE IF NOT EXISTS `classenroll` (
  `enrollID` int(100) NOT NULL AUTO_INCREMENT,
  `studentkey` int(10) NOT NULL,
  `classid` int(10) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`enrollID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `classenroll`
--

INSERT INTO `classenroll` (`enrollID`, `studentkey`, `classid`, `stmp`) VALUES
(10, 51, 9, '2016-02-17 14:25:51'),
(11, 52, 8, '2016-02-17 14:11:09'),
(12, 53, 9, '2016-02-17 14:25:51'),
(15, 50, 6, '2016-02-16 20:49:09'),
(17, 54, 9, '2016-02-17 14:25:51'),
(18, 55, 8, '2016-02-17 14:09:10'),
(19, 56, 9, '2016-02-17 14:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `classID` int(100) NOT NULL AUTO_INCREMENT,
  `classname` varchar(100) NOT NULL,
  `gradelevelid` int(5) NOT NULL,
  `tutorid` int(5) NOT NULL,
  `academicyear` int(5) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`classID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `classname`, `gradelevelid`, `tutorid`, `academicyear`, `stmp`) VALUES
(1, 'STD ONE East', 4, 18, 2015, '2016-02-16 19:58:22'),
(4, 'STD Four West', 7, 24, 2016, '2016-02-14 19:37:56'),
(5, 'Baby Class', 1, 25, 2016, '2016-02-15 08:18:12'),
(6, 'STD TWO South', 5, 24, 2016, '2016-02-16 19:58:52'),
(7, 'Class ONE Blessed', 4, 25, 2016, '2016-02-16 20:38:02'),
(8, 'STD Three Red', 6, 18, 2016, '2016-02-17 14:04:44'),
(9, 'class 8 e', 11, 25, 2016, '2016-02-17 14:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventID` int(10) NOT NULL AUTO_INCREMENT,
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
  `eventOwnerName` varchar(50) NOT NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventID`, `eventTitle`, `eventDate`, `eventLoc`, `eventDesc`, `eventInivitees`, `eventUrgency`, `occurSeq`, `occurNum`, `occurPeriod`, `occurWdy`, `eventActive`, `eventOwner`, `eventOwnerName`) VALUES
(7, 'Staff Meeting', '2015-04-29', 'Staff Room', '', 'betty15,jamse14,', 2, 0, 1, 0, 1, 1, 17, 'James Mulandi'),
(8, 'Staff Open Day', '2015-09-08', 'School Field', 'A day to celebrate our children talents', '', 1, 0, 0, 0, 1, 1, 23, 'Nicodemus Karisa');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE IF NOT EXISTS `extras` (
  `extraID` int(10) NOT NULL AUTO_INCREMENT,
  `info` varchar(50) NOT NULL,
  `flag` int(1) NOT NULL,
  PRIMARY KEY (`extraID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`extraID`, `info`, `flag`) VALUES
(2, 'offline', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feestructure`
--

CREATE TABLE IF NOT EXISTS `feestructure` (
  `sID` int(100) NOT NULL AUTO_INCREMENT,
  `fID` int(100) NOT NULL,
  `dsc` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `period` int(5) NOT NULL,
  `category` int(5) NOT NULL,
  PRIMARY KEY (`sID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `feestructure`
--

INSERT INTO `feestructure` (`sID`, `fID`, `dsc`, `amount`, `period`, `category`) VALUES
(1, 1, 'Lunch fees', 4500, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feestructuregrades`
--

CREATE TABLE IF NOT EXISTS `feestructuregrades` (
  `gID` int(100) NOT NULL AUTO_INCREMENT,
  `fID` int(10) NOT NULL,
  `gradelevelid` int(10) NOT NULL,
  PRIMARY KEY (`gID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `feestructuregrades`
--

INSERT INTO `feestructuregrades` (`gID`, `fID`, `gradelevelid`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 1, 6),
(4, 1, 7),
(5, 1, 8),
(6, 1, 9),
(7, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `feestructureheader`
--

CREATE TABLE IF NOT EXISTS `feestructureheader` (
  `fID` int(100) NOT NULL AUTO_INCREMENT,
  `academicyear` int(11) NOT NULL,
  `feestructurename` varchar(100) NOT NULL,
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `feestructureheader`
--

INSERT INTO `feestructureheader` (`fID`, `academicyear`, `feestructurename`, `stmp`) VALUES
(1, 2016, 'Meals', '2016-02-19 13:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `feestructureperiod`
--

CREATE TABLE IF NOT EXISTS `feestructureperiod` (
  `pID` int(10) NOT NULL AUTO_INCREMENT,
  `periodname` varchar(50) NOT NULL,
  PRIMARY KEY (`pID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feestructureperiod`
--

INSERT INTO `feestructureperiod` (`pID`, `periodname`) VALUES
(1, 'Termly'),
(2, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `gradelevels`
--

CREATE TABLE IF NOT EXISTS `gradelevels` (
  `lvlID` int(100) NOT NULL AUTO_INCREMENT,
  `levelName` varchar(100) NOT NULL,
  PRIMARY KEY (`lvlID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `gradelevels`
--

INSERT INTO `gradelevels` (`lvlID`, `levelName`) VALUES
(1, 'Play Group'),
(2, 'Nursey'),
(3, 'Pre-school'),
(4, 'STD One'),
(5, 'STD Two'),
(6, 'STD Three'),
(7, 'STD Four'),
(8, 'STD Five'),
(9, 'STD Six'),
(10, 'STD Seven'),
(11, 'STD Eight');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE IF NOT EXISTS `logos` (
  `logoID` int(10) NOT NULL AUTO_INCREMENT,
  `url` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `viewable` int(5) NOT NULL DEFAULT '0',
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`logoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`logoID`, `url`, `title`, `viewable`, `stmp`) VALUES
(1, 'logo.png', 'Vine Gardens School<br> P.O. BOX 3524, Ngong<br>email:info@vinegardensschool.com', 1, '2016-02-18 18:33:10'),
(2, 'staff.png', 'Staff Site', 0, '2016-02-17 14:28:25'),
(3, 'constructionspin.gif', 'The Construction Site', 0, '2016-02-18 18:33:10'),
(4, 'pp.jpg', 'Beauty Pageant Site', 0, '2016-02-17 00:26:06'),
(5, 'mantain.png', 'Test Site', 0, '2016-02-17 09:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `mnID` int(100) NOT NULL AUTO_INCREMENT,
  `selfID` varchar(50) NOT NULL,
  `selfTitle` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT 'default',
  `langid` varchar(100) NOT NULL,
  `userlevel` varchar(200) NOT NULL DEFAULT '0',
  `todate` varchar(200) NOT NULL DEFAULT '0=0000-00-00',
  `reoccur` varchar(300) NOT NULL DEFAULT '0=0-0',
  `exception` varchar(300) NOT NULL DEFAULT '0=fld',
  `link_img` varchar(50) NOT NULL DEFAULT 'app.png',
  `admin` int(1) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mnID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`mnID`, `selfID`, `selfTitle`, `url`, `langid`, `userlevel`, `todate`, `reoccur`, `exception`, `link_img`, `admin`, `public`) VALUES
(1, 'login', 'Home', 'Login/home', 'login', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'home.png', 0, 0),
(101, 'aboutus_login', 'About Us', 'login/aboutus', 'aboutus_login', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'information.png', 0, 1),
(102, 'contactus_login', 'Contacts', 'login/contacts', 'contactus_login', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'mail.png', 0, 1),
(103, 'resource_login', 'Resource', 'login/resource', 'resource_login', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'resource.png', 0, 1),
(104, 'events', 'Events', 'events/calendar', 'events', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'events.png', 0, 1),
(105, 'userprofile_login', 'User Profile', 'Login/userProfile', 'userprofile_login', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'userprofile.png', 0, 0),
(107, 'notice_login', 'Notices', 'login/notices', 'notice_login', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'pin.png', 0, 1),
(108, 'newevent_events', 'Add Event', 'Events/newEvent', 'newevent_events', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'plus.png', 0, 0),
(109, 'delevent_events', 'Delete Event', 'Events/delEvent', 'delevent_events', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'uncheck3.png', 0, 0),
(110, 'viewevents_events', 'View Events', 'Events/calendar', 'viewevents_events', '0,1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'events.png', 0, 1),
(111, 'searchStudent_Students', 'Search Student', 'Students/searchStudent', 'searchStudent_Students', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'search2.png', 0, 0),
(113, 'students', 'Student Life', 'Students/searchStudent', 'students', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'student.png', 0, 0),
(114, 'staffLife', 'Staff Life', 'Staff/showAll', 'staffLife', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'staff.png', 0, 0),
(115, 'administration', 'Settings', 'administration/showAll', 'administration', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'manage2.png', 1, 0),
(116, 'feeStructure_finance', 'Fee Structures', 'Finance/feeStructure', 'feeStructure_finance', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'app.png', 0, 0),
(118, 'newStudent_students', 'New Student', 'Students/newStudent', 'newStudent_students', '1,2,3,4,5,6', '0=0000-00-00', '0=0-0', '0=fld', 'plus.png', 0, 0),
(119, 'draftStudentRecords_Students', 'Draft Records', 'Students/draftStudentRecords', 'draftStudentRecords_Students', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'diskedit.png', 0, 0),
(120, 'myprofile_staff', 'My Profile', 'Staff/myprofile', 'myprofile_staff', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15', '0=0000-00-00', '0=0-0', '0=fld', 'app.png', 0, 0),
(121, 'academic_Students', 'Academic', 'Students/academic', 'academic', '1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'academic.png', 0, 0),
(122, 'finance_Students', 'Finance', 'Students/finance', 'finance', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'finance.png', 0, 0),
(123, 'classmanager_Students', 'Class Manager', 'Students/classmanager', 'classmanager_students', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'processed.png', 0, 0),
(124, 'messageboard_Administration', 'My Site', 'Administration/messageboard', 'messageboard_Students', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'pin.png', 0, 0),
(125, 'finance', 'Finance', 'Finance/showAll', 'finance_top_menu', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'finance.png', 0, 0),
(126, 'help', 'Help', 'login/help', 'help', '0,1,2,3,4,5,6,7', '0=0000-00-00', '0=0-0', '0=fld', 'help.png', 0, 1),
(127, 'accounts_finance', 'Accounts', 'Finance/accounts', 'accounts_finance', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'small_post.png', 0, 0),
(128, 'reports_finance', 'Finance Reports', 'Finance/reports', 'reports_finance', '1,2,5', '0=0000-00-00', '0=0-0', '0=fld', 'archive.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msgID` int(100) NOT NULL AUTO_INCREMENT,
  `boardname` varchar(100) NOT NULL,
  `pointer` varchar(100) NOT NULL,
  `msg` longtext NOT NULL,
  `msg_type` int(10) NOT NULL DEFAULT '1',
  `stmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`msgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msgID`, `boardname`, `pointer`, `msg`, `msg_type`, `stmp`) VALUES
(1, 'Class Manager', 'Students_classmanager', 'This module allows the users to add a new class, search for enrolled students and add students to class.', 2, '2016-02-14 22:37:30'),
(2, 'Introduction', 'Login_home', 'Hello', 1, '2016-02-17 05:03:25'),
(3, 'Create Class Module Description', 'Students_createclass', 'This module allows you to create a class and add or remove students from a class.', 2, '2016-02-14 22:37:56'),
(4, '', 'Students_viewclass', 'This module allows you manage a class by deleting, renaming or changing the tutor.', 2, '2016-02-14 20:39:33'),
(6, 'Logged User Welcome', 'Login_logged', '<h4>Dear User</h4>\nWelcome to the Vine Gardens School Management System.\n', 1, '2016-02-14 22:38:13'),
(7, 'Settings Page', 'Administration_showAll', '<h4>Settings Functions</h4>\r\n\r\nSettings comprises of a number of mainly administrative function to allow setting up of the application\r\n', 1, '2016-02-14 23:26:09'),
(8, 'Messageboard Module Description', 'Administration_messageboard', 'This module allows administrators to create new pages and module descriptions', 2, '2016-02-14 23:11:41'),
(9, 'Staff Module Description', 'Staff_showAll', 'This module allow users to manage staff performance and payroll', 2, '2016-02-14 23:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `msgtypes`
--

CREATE TABLE IF NOT EXISTS `msgtypes` (
  `typeID` int(100) NOT NULL AUTO_INCREMENT,
  `msgtype` varchar(100) NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `msgtypes`
--

INSERT INTO `msgtypes` (`typeID`, `msgtype`) VALUES
(1, 'Pages'),
(2, 'Description');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `posID` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`posID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  `bkID` int(100) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `lastDate` date NOT NULL,
  `changedBy` int(10) NOT NULL,
  PRIMARY KEY (`bkID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recent`
--

CREATE TABLE IF NOT EXISTS `recent` (
  `recID` int(100) NOT NULL AUTO_INCREMENT,
  `itemTitle` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `userid` int(10) NOT NULL,
  `link_img` varchar(50) NOT NULL DEFAULT 'app.png',
  PRIMARY KEY (`recID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1896 ;

--
-- Dumping data for table `recent`
--

INSERT INTO `recent` (`recID`, `itemTitle`, `url`, `userid`, `link_img`) VALUES
(1388, 'Add Event', 'Events/newEvent', 19, 'plus.png'),
(1390, 'Delete Event', 'Events/delEvent', 19, 'uncheck3.png'),
(1409, 'My Profile', 'Staff/myprofile', 19, 'app.png'),
(1565, 'Draft Records', 'Students/draftStudentRecords', 19, 'diskedit.png'),
(1684, 'Help', 'Login/help', 19, 'help.png'),
(1686, 'Academic', 'Students/academic', 19, 'academic.png'),
(1732, 'Search Student', 'Students/searchStudent', 19, 'search2.png'),
(1752, 'Message Board', 'Administration/messageboard', 19, 'pin.png'),
(1753, 'Site Look', 'Administration/messageboard', 19, 'pin.png'),
(1791, 'Staff Life', 'Staff/showAll', 19, 'staff.png'),
(1843, 'New Student', 'Students/newStudent', 19, 'plus.png'),
(1849, 'Notices', 'Login/notices', 19, 'pin.png'),
(1850, 'User Profile', 'Login/userProfile', 19, 'userprofile.png'),
(1851, 'Resource', 'Login/resource', 19, 'resource.png'),
(1853, 'Contacts', 'Login/contacts', 19, 'mail.png'),
(1854, 'About Us', 'Login/aboutus', 19, 'information.png'),
(1867, 'Accounts', 'Finance/accounts', 19, 'small_post.png'),
(1876, 'Class Manager', 'Students/classmanager', 19, 'processed.png'),
(1878, 'Settings', 'Administration/showAll', 19, 'manage2.png'),
(1880, 'My Site', 'Administration/messageboard', 19, 'pin.png'),
(1882, 'Events', 'Events/calendar', 19, 'events.png'),
(1883, 'View Events', 'Events/calendar', 19, 'events.png'),
(1885, 'Home', 'Login/home', 0, 'home.png'),
(1887, 'Finance Reports', 'Finance/reports', 19, 'archive.png'),
(1891, 'Student Life', 'Students/searchStudent', 19, 'student.png'),
(1894, 'Finance', 'Finance/showAll', 19, 'finance.png'),
(1895, 'Fee Structures', 'Finance/feeStructure', 19, 'app.png');

-- --------------------------------------------------------

--
-- Table structure for table `revenucategories`
--

CREATE TABLE IF NOT EXISTS `revenucategories` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `revenucategories`
--

INSERT INTO `revenucategories` (`catID`, `categoryname`, `active`) VALUES
(1, 'Meals', 1),
(2, 'Tuition Fees', 1),
(3, 'Examination', 1),
(4, 'Academic Trip', 1);

-- --------------------------------------------------------

--
-- Table structure for table `securityqueries`
--

CREATE TABLE IF NOT EXISTS `securityqueries` (
  `qID` int(10) NOT NULL AUTO_INCREMENT,
  `qstn` varchar(200) NOT NULL,
  PRIMARY KEY (`qID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  `setupKey` int(100) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `public` int(1) NOT NULL,
  `admin` int(1) NOT NULL,
  `userlvl` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`setupKey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`setupKey`, `url`, `public`, `admin`, `userlvl`, `content`) VALUES
(1, 'Login/login', 1, 0, '0,1,2,3,4,5,6,7', '<h3 style="margin-left:280px;">School Management System</h3><p>Welcome to the Vine Gardens School&reg; management system. <br>This is an integrated system built to offer you the following application:</p><ul><li>Student Life - All about students</li><li>Staff Life - All about staffs</li><li>Academic - For class assignments and examination management</li><li>Finance - All about finance</li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `studentKey` int(100) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `sex` varchar(10) DEFAULT 'None',
  `dob` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `studentImage` varchar(50) DEFAULT 'None',
  `admNo` varchar(10) DEFAULT '0',
  `county` varchar(50) DEFAULT 'None',
  `ward` varchar(50) DEFAULT 'None',
  `area` varchar(50) DEFAULT 'None',
  `street` varchar(50) DEFAULT 'None',
  `parentOneFullname` varchar(50) DEFAULT 'None',
  `parentOneRel` varchar(50) DEFAULT 'None',
  `parentOneRelOther` varchar(20) DEFAULT 'None',
  `parentOnePhone` varchar(15) DEFAULT '0',
  `parentOneEmail` varchar(50) DEFAULT NULL,
  `parentOneJob` varchar(50) DEFAULT NULL,
  `parentOneHome` varchar(50) DEFAULT NULL,
  `parentTwoFullname` varchar(50) DEFAULT 'None',
  `parentTwoRel` varchar(50) DEFAULT 'None',
  `parentTwoRelOther` varchar(20) DEFAULT 'None',
  `parentTwoPhone` varchar(15) DEFAULT 'None',
  `parentTwoEmail` varchar(50) DEFAULT 'None',
  `parentTwoJob` varchar(50) DEFAULT 'None',
  `parentTwoHome` varchar(50) DEFAULT 'None',
  `entryClass` int(2) DEFAULT '0',
  `firstSchool` varchar(50) DEFAULT 'None',
  `formerSchool` varchar(30) DEFAULT 'None',
  `lastScore` int(5) DEFAULT '0',
  `interviewed` varchar(5) DEFAULT 'No',
  `interviewScore` int(5) DEFAULT '0',
  `talents` varchar(200) DEFAULT NULL,
  `talentsOther` varchar(200) DEFAULT 'None',
  `medical` varchar(200) DEFAULT NULL,
  `medicalOther` varchar(200) DEFAULT 'None',
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `regBy` varchar(50) DEFAULT NULL,
  `draft` varchar(5) DEFAULT 'Yes',
  `active` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`studentKey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentKey`, `fname`, `lname`, `sex`, `dob`, `nationality`, `studentImage`, `admNo`, `county`, `ward`, `area`, `street`, `parentOneFullname`, `parentOneRel`, `parentOneRelOther`, `parentOnePhone`, `parentOneEmail`, `parentOneJob`, `parentOneHome`, `parentTwoFullname`, `parentTwoRel`, `parentTwoRelOther`, `parentTwoPhone`, `parentTwoEmail`, `parentTwoJob`, `parentTwoHome`, `entryClass`, `firstSchool`, `formerSchool`, `lastScore`, `interviewed`, `interviewScore`, `talents`, `talentsOther`, `medical`, `medicalOther`, `regDate`, `regBy`, `draft`, `active`) VALUES
(50, 'IVY', 'JUMBA', 'Female', '2011-02-09', 'Kenya', 'None', 'VGS0001', 'Nairobi', 'NA', 'Kephis', 'NA', 'The Father', 'Father', '', '0745321567', '', '', '', '', '', '', '', '', '', '', 6, '0', 'School 1', 311, 'No', 0, NULL, '', NULL, '', '2016-02-15 07:57:36', 'Nicodemus Karisa', '0', 'Yes'),
(51, 'Alvin', 'Kelly', 'Male', '2012-04-11', 'Kenya', 'None', 'VGS0002', 'Nairobi', 'Ngong', 'Phase A', 'Ngong Road', 'Peter Ndungu', 'Father', '', '0711808071', 'NA', 'Farmer', 'Ngong', '', '', '', '', '', '', '', 4, '0', 'Shangwe Mtaani Primary', 311, 'No', 0, NULL, 'Running', NULL, 'NA', '2016-02-15 07:57:40', 'Nicodemus Karisa', '0', 'Yes'),
(52, 'Melvin', 'Otieno', 'Female', '2011-10-03', 'Kenya', 'None', 'VGS0003', 'Kajiado', 'Ngong', 'Phase B', 'Ngong Road', 'Patmo Keino', 'Father', '', '0722908976', '', '', '', '', '', '', '', '', '', '', 7, '', 'Mtaa Primary', 0, 'Yes', 302, NULL, 'NA', NULL, 'NA', '2016-02-15 07:57:43', 'Nicodemus Karisa', '0', 'Yes'),
(53, 'Leah', 'Boinnet', 'Female', '2011-02-13', 'Kenya', 'None', 'VGS0004', 'Nairobi', 'Karen C', 'Karen C', 'Langata RD', 'Mary Ben', 'Mother', '', '0745432312', '', 'Business Woman', '', 'John Binnet', 'Father', '', '0765726372', '', 'Teacher', '', 1, '1', '', 0, 'No', 0, NULL, 'Ball Games', NULL, 'NA', '2016-02-15 08:14:48', 'Nicodemus Karisa', '0', 'Yes'),
(54, 'Caleb', 'Oduori', 'Male', '2012-02-14', 'Kenya', 'None', 'VGS0005', 'Nairobi', 'Karen', 'Karen C', 'Langata Road', 'Billow Kerrow', 'Father', '', '0206527390', '', 'MP', 'Muthaiga', '', '', '', '', '', '', '', 2, '1', '', 0, 'No', 0, NULL, 'NA', NULL, 'NA', '2016-02-16 19:19:35', 'Nicodemus Karisa', '0', 'Yes'),
(55, 'Allan', 'Ken', 'Male', '2010-03-12', 'Kenya', 'None', 'VGS0006', 'Kajiado', 'Ngong', 'Area A', 'Ngong Road', 'ABC', 'Father', '', '0744543276', '', 'Farmer', 'Ngong', '', '', '', '', '', '', '', 5, '0', 'Ngong Township', 290, 'Yes', 305, NULL, 'Singing', NULL, 'NA', '2016-02-17 14:07:11', 'Nicodemus Karisa', '0', 'Yes'),
(56, 'jordan', 'okwara', 'Male', '2002-11-20', 'Kenya', 'None', 'vgs0007', 'kajiado', 'ngong', '46', 'ngong', 'geffrey', 'Father', '', '0722876409', '', '', '', '', '', '', '', '', '', '', 11, '1', '', 0, 'No', 0, NULL, 'singing', NULL, 'n/a', '2016-02-17 14:18:59', 'Nicodemus Karisa', '0', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
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
  `qAns` varchar(200) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'eng',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `fname`, `lname`, `email`, `userlevel`, `delegated_role`, `admin`, `password`, `auth`, `logs_after_register`, `securityQstnID`, `qAns`, `lang`) VALUES
(0, 'Guest', 'Guest', 'Guest', '', 0, 0, 0, 'fbdf9989ea636d6b339fd6b85f63e06e', 1, 0, 0, '', 'eng'),
(16, 'betty15', 'Beatrice', 'Ruiru', 'BRuiru@vine.com', 1, 0, 0, 'e7d109998cac2c74988c6f632991afed', 0, 1, 1, 'Betty', 'eng'),
(17, 'jamse14', 'James', 'Mulandi', 'JMulandi1@gmail.com', 5, 0, 0, 'e7d109998cac2c74988c6f632991afed', 0, 1, 1, 'Jamo', 'eng'),
(18, 'sallyby', 'Sally', 'Ben', 'ssbenny@yahoo.com', 4, 0, 0, 'f5b59898cc6d8e4fbef93b1d6b3e6ce0', 0, 0, 1, 'Sally', 'eng'),
(19, 'nico2015', 'Nicodemus', 'Karisa', 'NKarisa@ke.ci.org', 2, 0, 1, 'fbdf9989ea636d6b339fd6b85f63e06e', 0, 1, 0, '', 'eng'),
(22, 'livingO', 'Livingstone', 'Onduso', 'eonduso@gmail.com', 1, 0, 0, 'fbdf9989ea636d6b339fd6b85f63e06e', 0, 0, 1, '', 'eng'),
(23, 'nickys', 'Nicodemus', 'Karisa', 'nkmwambs@gmail.com', 2, 0, 0, 'e7d109998cac2c74988c6f632991afed', 1, 1, 1, 'Karisa', 'eng'),
(24, 'hellen', 'Hellen', 'Akalapatan', 'hellenakala@gmail.com', 4, 0, 0, '359aa073de9e155aabf6a5f965bd3f56', 0, 0, 0, '', 'eng'),
(25, 'liz2016', 'Elizabeth', 'Karanja', 'ejax@gmail.com', 4, 0, 0, 'fbdf9989ea636d6b339fd6b85f63e06e', 0, 0, 0, '', 'eng');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
