--
-- Table structure for table `events_log`
--

CREATE TABLE IF NOT EXISTS `events_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceId` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(16) NOT NULL,
  `deviceTime` varchar(10) NOT NULL,
  `data` text NOT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;




--
-- Table structure for table `ice_cream`
--

CREATE TABLE IF NOT EXISTS `ice_cream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `deviceId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(10) NOT NULL,
  `firstName` varchar(20) NOT NULL DEFAULT '',
  `lastName` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (-1,'Svečias', '');
INSERT INTO `user` VALUES (0,'Neatpažintas', '');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_card`
--

CREATE TABLE IF NOT EXISTS `user_card` (
  `cardId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `cardNumber` int(10) unsigned NOT NULL DEFAULT '0',
  `cardValue` varchar(21) NOT NULL DEFAULT '',
  PRIMARY KEY (`cardId`),
  KEY `CardNumber` (`cardNumber`),
  KEY `UserId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


LOCK TABLES `user_card` WRITE;
/*!40000 ALTER TABLE `user_card` DISABLE KEYS */;
INSERT INTO `user_card` VALUES (1,-1,0,'');
INSERT INTO `user_card` VALUES (2,0,1,'');
/*!40000 ALTER TABLE `user_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soccer_match`
--

CREATE TABLE IF NOT EXISTS `soccer_match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamId1` int(11) NOT NULL,
  `teamId2` int(11) NOT NULL,
  `teamResult1` int(11) NOT NULL,
  `teamResult2` int(11) NOT NULL,
  `startTime` int(11) NOT NULL,
  `lastShake` int(11) NOT NULL,
  `deviceId` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Create View for group event log data
--
CREATE VIEW `ice_counts`
AS SELECT
   sum(substr(`ev`.`data`,11,1)) AS `count`,substring_index(substring_index(`ev`.`data`,'"',-(2)),'"',1) AS `user`
FROM `events_log` AS `ev` group by substring_index(substring_index(`ev`.`data`,'"',-(2)),'"',1);
