USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertCareer;

DELIMITER //

CREATE PROCEDURE InsertCareer 
(
	IN IdCareer int, 
	IN Description varchar(200), 
	IN Active bit(1)

)
BEGIN
	INSERT INTO Career VALUES
    (
		IdCareer,
        Description,
        Active
    );
END //

DELIMITER ;