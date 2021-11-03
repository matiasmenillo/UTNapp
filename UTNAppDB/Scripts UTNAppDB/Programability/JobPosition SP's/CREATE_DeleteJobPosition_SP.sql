USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteJobPosition;

DELIMITER //

CREATE PROCEDURE DeleteJobPosition
(
	IN IdJobPositionParam INT 
)
BEGIN
	DELETE FROM JobPosition WHERE IdJobPosition = IdJobPositionParam;
END //

DELIMITER ;