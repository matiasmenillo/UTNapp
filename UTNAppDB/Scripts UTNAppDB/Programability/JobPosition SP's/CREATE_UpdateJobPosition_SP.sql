USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateJobPosition;

DELIMITER //

CREATE PROCEDURE UpdateJobPosition
(
	IN IdJobPositionDBParam int,		
	IN IdCompany int,		
	IN Description varchar(200)
)
BEGIN
	UPDATE JobPosition 
	SET
		IdCompany = IdCompany,
        Description = Description
	WHERE IdJobPositionDB = IdJobPositionParamDB;
END //

DELIMITER ;