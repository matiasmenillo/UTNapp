USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetPostulationByJobOffer;

DELIMITER //

CREATE PROCEDURE GetPostulationByJobOffer
(
	IN IdJobOfferParam INT
)
BEGIN
	SELECT * FROM Postulation WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;