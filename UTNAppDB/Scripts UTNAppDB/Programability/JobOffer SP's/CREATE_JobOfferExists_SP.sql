USE UTNAppDB;

DROP PROCEDURE IF EXISTS  JobOfferExists;

DELIMITER //

CREATE PROCEDURE JobOfferExists
(
	IN IdJobPositionParam INT,
    IN IdCompanyParam INT
)
BEGIN
	IF EXISTS (SELECT 1 FROM JobOffer WHERE IdJobPosition = IdJobPositionParam AND IdCompany = IdCompanyParam) THEN
		BEGIN
			SELECT 1;
		END;
		ELSE
		BEGIN 
			SELECT 0;
		END;
	END IF;
END //

DELIMITER ;