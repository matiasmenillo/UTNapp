USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateCareer;

DELIMITER //

CREATE PROCEDURE UpdateCareer
(
	IN IdCareerParam int, 
	IN Description varchar(200), 
	IN Active int
)
BEGIN
	UPDATE Career 
	SET
        Description = Description,
        Active = Active
	WHERE IdCareer = IdCareerParam;
END //

DELIMITER ;