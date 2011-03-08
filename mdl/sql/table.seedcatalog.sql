CREATE TABLE IF NOT EXISTS `seedcatalog` (
  `Common_Name` varchar(40) NOT NULL,
  `Latin_Name` varchar(40) DEFAULT NULL,
  `Date` date NOT NULL,
  `Variety` varchar(30) NOT NULL,
  `MemberID` varchar(35) NOT NULL,
  `Year_Harvested` int(4) DEFAULT NULL,
  `Location` varchar(20) NOT NULL,
  `Experience` varchar(15) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `TransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `Last_Seed` varchar(4) NOT NULL,
  PRIMARY KEY (`TransactionID`),
  UNIQUE KEY `Common_Name` (`Common_Name`,`Date`,`Variety`,`MemberID`)
) CHARSET=utf8;
