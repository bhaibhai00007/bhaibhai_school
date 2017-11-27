ALTER TABLE `sc_enroll` CHANGE `roll` `roll` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
----------------------------------------------------------------------------------------------------------------------------
--
-- Table structure for table `sc_settings`
--

CREATE TABLE `sc_settings` (
  `settingsId` int(11) NOT NULL,
  `contstantName` varchar(450) NOT NULL,
  `constantValue` varchar(450) NOT NULL,
  `schoolId` int(11) DEFAULT '1',
  `constantDescription` varchar(750) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_settings`
--

INSERT INTO `sc_settings` (`settingsId`, `contstantName`, `constantValue`, `schoolId`, `constantDescription`) VALUES
(1, 'SYSTEM_NAME', 'Temp School', 1, ''),
(2, 'SYSTEM_TITLE', 'Temp School', 1, NULL),
(3, 'SCHOOL_ADDRESS', 'Temp Address', 1, NULL),
(4, 'SCHOOL_PHONE', '11111111', 1, NULL),
(5, 'SCHOOL_EMAIL', 'info@school.com', 1, NULL),
(6, 'IS_ALLOW_SMS', '1', 1, '1 is allow and 0 is not allow'),
(7, 'RUNNING_SESSION', '2016-2017', 1, NULL),
(8, 'STUDENT_ENTER_START_TIME', '07:00', 1, NULL),
(9, 'STUDENT_ENTER_END_TIME', '07:40', 1, NULL),
(10, 'STUDENT_EXIT_START_TIME', '14:30', 1, NULL),
(11, 'STUDENT_EXIT_END_TIME', '15:00', 1, NULL),
(12, 'APP_PACKAGE_NAME', 'com.test.app', 1, NULL),
(13, 'FCM_SERVER_KEY', 'cdacacascdacdacacacdcadascacdacdacacac', 1, NULL),
(14, 'LOGO', '', 1, NULL),
(15, 'SCHOOL_ENROLL_PREFIX', 'MAD-2017', 1, NULL),
(16, 'SCHOOL_ENROLL_SUFFIX', '000036', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sc_settings`
--
ALTER TABLE `sc_settings`
  ADD PRIMARY KEY (`settingsId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sc_settings`
--
ALTER TABLE `sc_settings`
  MODIFY `settingsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
  
-------------------------------------------------------------------------------------------------------------------
  
ALTER TABLE `sc_user` CHANGE `sessionID` `sessionId` INT(11) NOT NULL DEFAULT '2';