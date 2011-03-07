-- TODO: naming conventions for tables are inconsistent
--	Apply standard: underscored, table name is singular form of what row represents
-- e.g., : seedcatalog -> seed; userseedreg-> user
CREATE TABLE IF NOT EXISTS `volunteer_user_map` (
  `email` varchar(50) NOT NULL,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`email`,`Type`)
) CHARSET=utf8;