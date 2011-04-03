INSERT INTO `users` (
	`name`, 
	`pass`,
	`rights`
) VALUES (
	"admin", 
	sha1("12345"),
	"admin"
);