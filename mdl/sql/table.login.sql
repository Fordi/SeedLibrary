CREATE TABLE IF NOT EXISTS `login` (
  `Email` varchar(35) NOT NULL,
  `loginTime` datetime NOT NULL,
  PRIMARY KEY (`Email`,`loginTime`),
  UNIQUE KEY `loginTime` (`loginTime`)
) CHARSET=utf8;
