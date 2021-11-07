USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertCompany;

DELIMITER //

CREATE PROCEDURE InsertCompany
(
	IN Status INT, 
	IN Sector varchar(200), 
	IN Name varchar(200), 
	IN Description varchar(200), 
	IN Cuit bigint, 
	IN CompanyLink varchar(200), 
	IN AboutUs varchar(200)  

)
BEGIN
	INSERT INTO Company (Status, Sector, Name, Description, Cuit, CompanyLink, AboutUs) VALUES
    (
		Status,
        Sector,
        Name,
        Description,
        Cuit,
        CompanyLink,
        AboutUs
    );
END //

DELIMITER ;