USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllJobPositions;

DELIMITER //

CREATE PROCEDURE GetAllJobPositions()
BEGIN
	SELECT * FROM jobposition;
END //

DELIMITER ;