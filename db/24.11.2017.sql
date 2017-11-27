-- --------------------------------------------------------

--
-- Table structure for table `sc_notification_group`
--

DROP TABLE IF EXISTS `sc_notification_group`;
CREATE TABLE IF NOT EXISTS `sc_notification_group` (
  `notificationGroupId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  PRIMARY KEY (`notificationGroupId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_notification_group`
--

INSERT INTO `sc_notification_group` (`notificationGroupId`, `title`) VALUES
(1, 'School in attendance message'),
(2, 'School out attendance message'),
(3, 'School result publish message'),
(4, 'Up comming exam schedule message');

-- --------------------------------------------------------

--
-- Table structure for table `sc_notification_group_permission`
--

DROP TABLE IF EXISTS `sc_notification_group_permission`;
CREATE TABLE IF NOT EXISTS `sc_notification_group_permission` (
  `notificationGroupPermissionId` int(11) NOT NULL AUTO_INCREMENT,
  `notificationGroupId` int(11) NOT NULL,
  `notificationTypeId` int(11) NOT NULL,
  `allow` int(1) NOT NULL DEFAULT '0' COMMENT '1->allow,0=>not allow',
  PRIMARY KEY (`notificationGroupPermissionId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_notification_group_permission`
--

INSERT INTO `sc_notification_group_permission` (`notificationGroupPermissionId`, `notificationGroupId`, `notificationTypeId`, `allow`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 2, 1, 1),
(5, 2, 2, 1),
(6, 2, 3, 1),
(7, 3, 1, 1),
(8, 3, 2, 0),
(9, 3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sc_notification_queue`
--

DROP TABLE IF EXISTS `sc_notification_queue`;
CREATE TABLE IF NOT EXISTS `sc_notification_queue` (
  `notificatioQnueueId` int(11) NOT NULL AUTO_INCREMENT,
  `notificationGroupId` int(11) NOT NULL,
  `groupType` enum('common','specific','','') NOT NULL,
  `groupMemberType` enum('teacher','parent','student','') DEFAULT NULL,
  `classId` int(11) DEFAULT NULL,
  `sectionId` int(11) DEFAULT NULL,
  `msgBody` varchar(500) NOT NULL,
  `msgTitle` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`notificatioQnueueId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sc_notification_type`
--

DROP TABLE IF EXISTS `sc_notification_type`;
CREATE TABLE IF NOT EXISTS `sc_notification_type` (
  `notificationTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  PRIMARY KEY (`notificationTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_notification_type`
--

INSERT INTO `sc_notification_type` (`notificationTypeId`, `title`) VALUES
(1, 'email'),
(2, 'sms'),
(3, 'push');