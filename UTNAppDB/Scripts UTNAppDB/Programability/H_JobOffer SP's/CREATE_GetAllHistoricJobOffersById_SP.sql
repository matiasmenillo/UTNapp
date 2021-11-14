USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetAllHistoricJobOffersById;

DELIMITER //

CREATE PROCEDURE GetAllHistoricJobOffersById
(
	IN IdJobOfferParam INT
)
BEGIN
	SELECT * FROM H_JobOffer WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;