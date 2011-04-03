CREATE TABLE IF NOT EXISTS `outstanding` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`user_id` INT NOT NULL,
	`seed_id` INT NOT NULL,
	`quantity` INT NOT NULL,
	`borrowed` DATE,
	`due` DATE
) CHARSET=utf8;