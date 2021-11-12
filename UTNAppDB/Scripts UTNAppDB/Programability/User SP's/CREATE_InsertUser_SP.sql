USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertUser;

DELIMITER //

CREATE PROCEDURE InsertUser
(
	IN FirstName varchar(200), 
	IN LastName varchar(200), 
	IN Email varchar(200), 
	IN Password varchar(200), 
	IN Dni VARCHAR(200), 
	IN Admin INT
)
BEGIN
	INSERT INTO User 
    (
		FirstName, 
		LastName, 
		Email, 
		Password, 
		Dni, 
		Admin
    )
    VALUES
    (
		FirstName, 
		LastName, 
		Email, 
		Password, 
		Dni, 
		Admin
    );
END //

DELIMITER ;