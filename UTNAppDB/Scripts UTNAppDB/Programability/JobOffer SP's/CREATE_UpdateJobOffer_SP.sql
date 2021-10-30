USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateJobOffer;

DELIMITER //

CREATE PROCEDURE UpdateJobOffer
(
	IN IdJobOfferParam int, 
	IN IdJobPosition int, 
	IN IdCompany int
)
BEGIN
	UPDATE JobOffer 
	SET
        IdJobPosition = IdJobPosition,
        IdCompany = IdCompany
	WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;