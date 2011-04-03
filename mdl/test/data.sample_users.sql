INSERT INTO `users` (
	`id`,
	`name`, 
	`pass`,
	`rights`
) VALUES (
	"42",
	"fordi", 
	sha1("12345"),
	"user"
);
INSERT INTO `user_attributes` (`user_id`,`name`,`json_value`) VALUES
(42, 'address1', '"218 Township Line Rd."'),
(42, 'address2', '"Apt 1"'),
(42, 'city', '"Jenkintown"'),
(42, 'state', '"PA"'),
(42, 'country', '"USA"'),
(42, 'zip', '"19046"'),
(42, 'email', '"fordiman@gmail.com"'),
(42, 'phone', '"267-475-7721"');

INSERT INTO `users` (
	`id`,
	`name`, 
	`pass`,
	`rights`
) VALUES (
	"43",
	"amyljac", 
	sha1("12345"),
	"user"
);
INSERT INTO `user_attributes` (`user_id`,`name`,`json_value`) VALUES
(43, 'address1', '"218 Township Line Rd."'),
(43, 'address2', '"Apt 1"'),
(43, 'city', '"Jenkintown"'),
(43, 'state', '"PA"'),
(43, 'country', '"USA"'),
(43, 'zip', '"19046"'),
(43, 'email', '"amyljac@gmail.com"'),
(43, 'phone', '"484-686-7721"');
