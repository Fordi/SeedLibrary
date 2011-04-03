INSERT INTO `seeds` (
	`id`,
	`name`,
	`quantity`,
	`donated`,
	`description`
) VALUES
(
	128,
	'Empress of India Nasturtium',
	1,
	NOW(),
	'A classic Victorian heirloom with dark blue-green foliage.  Brilliant scrimson-scarlet flowers on plants seldom more than 12-14" tall.  Suitable for containers.  The flowers and leaves are a peppery addition to salads, pastas, or used as a garnish.  Hardy annual.'
);
CREATE TABLE IF NOT EXISTS `seed_attributes` (
	`id` INT AUTO_INCREMENT PRIMARY KEY,
	`seed_id` INT NOT NULL,
	`name` TINYTEXT NOT NULL,
	`json_value` TEXT NOT NULL
) CHARSET=utf8;
INSERT INTO `seed_attributes` (`seed_id`, `name`, `json_value`) VALUES
(128, 'image', '"/seed-images/175a014724d9a6a6001c35077f55d9cf.jpg"'),
(128, 'latin', '"Tropaeolum minus"'),
(128, 'directSeed', '1/4" Deep'),
(128, 'germination', '7-12 Days'),
(128, 'thin', '8-12" Apart'),
(128, 'light', 'Full Sun');