USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertUser;

DELIMITER //

CREATE PROCEDURE InsertUser
(
	IN FirstName varchar(200), 
	IN LastName varchar(200), 
	IN Email varchar(200), 
	IN Password varchar(200), 
	IN Rol INT
)
BEGIN
	INSERT INTO Users
    (
		FirstName, 
		LastName, 
		Email, 
		Password,  
		Rol
    )
    VALUES
    (
		FirstName, 
		LastName, 
		Email, 
		Password, 
		Rol
    );
END //

DELIMITER ;