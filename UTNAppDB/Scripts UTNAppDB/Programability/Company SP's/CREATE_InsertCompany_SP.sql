USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertCompany;

DELIMITER //

CREATE PROCEDURE InsertCompany
(
	IN Status bit(1), 
	IN Sector varchar(200), 
	IN Name varchar(200), 
	IN Description varchar(200), 
	IN Cuit int, 
	IN CompanyLink varchar(200), 
	IN AboutUs varchar(200)  

)
BEGIN
	INSERT INTO Student VALUES
    (
		Status,
        Sector,
        Name,
        IdCompany,
        Description,
        Cuit,
        CompanyLink,
        AboutUs
    );
END //

DELIMITER ;