USE UTNAppDB;

DROP PROCEDURE IF EXISTS  JobOfferHasPostulations;

DELIMITER //

CREATE PROCEDURE JobOfferHasPostulations
(
	IN IdJobOfferParam INT
)
BEGIN
	IF EXISTS (SELECT 1 FROM postulation WHERE IdJobOffer = IdJobOfferParam) THEN
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