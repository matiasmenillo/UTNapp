USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateJobPosition;

DELIMITER //

CREATE PROCEDURE UpdateJobPosition
(
	IN IdJobPositionParam int,		
	IN IdCareer	int,		
	IN Description varchar(200)
)
BEGIN
	UPDATE Career 
	SET
		IdCareer = IdCareer,	
        Description = Description
	WHERE IdJobPosition = IdJobPositionParam;
END //

DELIMITER ;