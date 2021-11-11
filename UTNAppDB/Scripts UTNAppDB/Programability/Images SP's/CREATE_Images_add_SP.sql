DROP PROCEDURE IF EXISTS Images_add;

DELIMITER $$

CREATE PROCEDURE Images_add(IN Name VARCHAR(100), IN idStudent int)
BEGIN
    INSERT INTO images
    	(name, idStudent)
	VALUES
		(name, idStudent);
END$$