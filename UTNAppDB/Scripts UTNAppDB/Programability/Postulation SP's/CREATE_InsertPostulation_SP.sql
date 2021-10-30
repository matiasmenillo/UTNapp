USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertPostulation;

DELIMITER //

CREATE PROCEDURE InsertPostulation 
(
	IN IdStudent int, 
	IN IdJobOffer int, 
	IN PostulationDate date

)
BEGIN
	INSERT INTO Postulation VALUES
    (
		IdStudent,
        IdJobOffer,
        PostulationDate
    );
END //

DELIMITER ;