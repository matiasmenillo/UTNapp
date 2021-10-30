USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertJobOffer;

DELIMITER //

CREATE PROCEDURE InsertJobOffer 
(
		IN IdJobPosition int, 
		IN IdCompany int
)
BEGIN
	INSERT INTO JobOffer VALUES
    (
		IdJobPosition,
        IdCompany
    );
END //

DELIMITER ;