USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateStudent;

DELIMITER //

CREATE PROCEDURE UpdateStudent
(
	IN IdStudentParam INT,
	IN FirstName varchar(200), 
	IN LastName varchar(200), 
	IN Email varchar(200), 
	IN Password varchar(200), 
	IN Dni varchar(200), 
	IN Admin INT, 
	IN IdCareer int, 
	IN FileNumber varchar(200), 
	IN Gender varchar(200), 
	IN BirthDate date, 
	IN PhoneNumber varchar(200), 
	IN Active INT 

)
BEGIN
	UPDATE Student
    SET
		FirstName = FirstName, 
		LastName = LastName, 
		Email = Email, 
		Password = Password, 
		Dni = Dni, 
		Admin = Admin, 
		IdCareer = IdCareer, 
		FileNumber = FileNumber, 
		Gender = Gender, 
		BirthDate = BirthDate, 
		PhoneNumber = PhoneNumber, 
		Active = Active
	WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;