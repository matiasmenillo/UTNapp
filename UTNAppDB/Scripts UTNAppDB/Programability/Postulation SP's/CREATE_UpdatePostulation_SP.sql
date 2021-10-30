USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdatePostulation;

DELIMITER //

CREATE PROCEDURE UpdatePostulation
(
	IN IdStudent int, 
	IN IdJobOffer int, 
	IN PostulationDate date
)
BEGIN
	UPDATE Postulation 
	SET
        IdStudent = IdStudent,
        IdJobOffer = IdJobOffer,
        PostulationDate = PostulationDate
	WHERE IdStudent = IdStudent AND IdJobOffer = IdJobOffer;
END //

DELIMITER ;