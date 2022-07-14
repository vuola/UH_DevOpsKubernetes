CREATE TABLE IF NOT EXISTS `grocerytb` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `Item_name` varchar(30) NOT NULL,
  `Item_Quantity` int(100),
  `Item_status` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19;