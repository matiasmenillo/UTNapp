USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateUser;

DELIMITER //

CREATE PROCEDURE UpdateUser
(
	IN IdUser INT,
	IN FirstName varchar(200), 
	IN LastName varchar(200), 
	IN Email varchar(200), 
	IN Password varchar(200), 
	IN Admin INT

)
BEGIN
	UPDATE User
    SET
		FirstName = FirstName, 
		LastName = LastName, 
		Email = Email, 
		Password = Password, 
		Admin = Admin
	WHERE IdUser = IdUser;
END //

DELIMITER ;