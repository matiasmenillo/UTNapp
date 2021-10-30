USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeletePostulation;

DELIMITER //

CREATE PROCEDURE DeletePostulation
(
	IN IdPostulationParam INT 
)
BEGIN
	DELETE FROM Postulation WHERE IdPostulation = IdPostulationParam;
END //

DELIMITER ;