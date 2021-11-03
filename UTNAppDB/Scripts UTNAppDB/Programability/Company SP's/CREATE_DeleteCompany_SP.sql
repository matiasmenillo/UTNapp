USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteCompany;

DELIMITER //

CREATE PROCEDURE DeleteCompany
(
	IN IdCompanyParam INT 
)
BEGIN
	DELETE FROM Company WHERE IdCompany = IdCompanyParam;
END //

DELIMITER ;