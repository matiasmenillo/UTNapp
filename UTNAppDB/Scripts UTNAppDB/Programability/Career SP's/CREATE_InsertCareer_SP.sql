USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertCareer;

DELIMITER //

CREATE PROCEDURE InsertCareer 
(
	IN IdCareer int, 
	IN Description varchar(200), 
	IN Active int

)
BEGIN
	INSERT INTO Career
    (
		IdCareer,
        Description,
        Active
    )
    VALUES
    (
		IdCareer,
        Description,
        Active
    );
END //

DELIMITER ;