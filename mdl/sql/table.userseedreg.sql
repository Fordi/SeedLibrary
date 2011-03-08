-- TODO: User access levels should probably be a little more verbose than a simple admin flag.  Think on this.
CREATE TABLE IF NOT EXISTS `userseedreg` (
  `DateReg` date NOT NULL,
  `NameFirst` varchar(40) NOT NULL,
  `NameLast` varchar(40) NOT NULL,
  `OrgName` varchar(40) DEFAULT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(30) NOT NULL,
  `PhoneNum` varchar(15) DEFAULT NULL,
  `Email` varchar(35) NOT NULL,
  `ContactYN` varchar(4) NOT NULL,
  `SeedExpLvl` varchar(15) NOT NULL,
  `GardenExpLvl` varchar(15) NOT NULL,
  `Volunteer` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Email`),
  KEY `DateReg` (`DateReg`),
  KEY `DateReg_2` (`DateReg`)
) CHARSET=utf8;
