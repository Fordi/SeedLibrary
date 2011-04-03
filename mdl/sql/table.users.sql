CREATE TABLE IF NOT EXISTS `users` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`name` TINYTEXT NOT NULL,
	`pass` varchar(40) NOT NULL,
	`rights` ENUM('user','admin')
) CHARSET=utf8;
