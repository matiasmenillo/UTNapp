USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetJobPositionById;

DELIMITER //

CREATE PROCEDURE GetJobPositionById
(
	IN IdJobPositionDBParam INT
)
BEGIN
	SELECT * FROM JobPosition WHERE IdJobPositionDB = IdJobPositionDBParam;
END //

DELIMITER ;