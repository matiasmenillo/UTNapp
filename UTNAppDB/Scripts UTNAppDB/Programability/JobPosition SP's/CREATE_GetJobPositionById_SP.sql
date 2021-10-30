USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetJobPositionById;

DELIMITER //

CREATE PROCEDURE GetJobPositionById
(
	IN IdJobPositionParam INT
)
BEGIN
	SELECT * FROM JobPosition WHERE IdJobPosition = IdJobPositionParam;
END //

DELIMITER ;