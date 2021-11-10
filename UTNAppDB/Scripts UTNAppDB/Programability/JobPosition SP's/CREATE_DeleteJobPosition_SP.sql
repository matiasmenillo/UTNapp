USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteJobPosition;

DELIMITER //

CREATE PROCEDURE DeleteJobPosition
(
	IN IdJobPositionDBParam INT 
)
BEGIN
	DELETE FROM JobPosition WHERE IdJobPositionDB = IdJobPositionDBParam;
END //

DELIMITER ;