USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertStudent;

DELIMITER //

CREATE PROCEDURE InsertStudent
(
	IN IdStudentParam INT,
	IN FirstName varchar(200), 
	IN LastName varchar(200), 
	IN Email varchar(200), 
	IN Password varchar(200), 
	IN Dni VARCHAR(200), 
	IN Admin INT,
	IN IdCareer int, 
	IN FileNumber varchar(200), 
	IN Gender VARCHAR(200), 
	IN BirthDate date, 
	IN PhoneNumber VARCHAR(200), 
	IN Active INT

)
BEGIN
	INSERT INTO Student VALUES
    (
		IdStudentParam,
		FirstName, 
		LastName, 
		Email, 
		Password, 
		Dni, 
		Admin, 
		IdCareer, 
		FileNumber, 
		Gender, 
		BirthDate, 
		PhoneNumber, 
		Active
    );
END //

DELIMITER ;