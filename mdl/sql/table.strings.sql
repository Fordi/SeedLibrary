CREATE TABLE IF NOT EXISTS `string` (
	`locale` varchar(5) NOT NULL,
	`name` varchar(64) NOT NULL,
	`string` MEDIUMTEXT NOT NULL,
	PRIMARY KEY (`locale`, `name`)
) CHARSET=utf8;