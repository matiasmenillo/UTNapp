USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateJobPosition;

DELIMITER //

CREATE PROCEDURE UpdateJobPosition
(
	IN IdJobPositionParam int,		
	IN IdCompany int,		
	IN Description varchar(200)
)
BEGIN
	UPDATE JobPosition 
	SET
		IdCompany = IdCompany,
        Description = Description
	WHERE IdJobPosition = IdJobPositionParam;
END //

DELIMITER ;