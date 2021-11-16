USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetAllHistoricPostulationsByJobOffer;

DELIMITER //

CREATE PROCEDURE GetAllHistoricPostulationsByJobOffer
(
	IN IdJobOfferParam INT
)
BEGIN
	SELECT * FROM H_Postulation WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;