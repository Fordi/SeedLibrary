CREATE VIEW `inventory` AS
SELECT 
	`seeds`.*, 
	(`seeds`.`quantity` - sum(`outstanding`.`quantity`)) as "inventory"
FROM `seeds`, `outstanding`
WHERE `outstanding`.seed_id = `seeds`.id;
