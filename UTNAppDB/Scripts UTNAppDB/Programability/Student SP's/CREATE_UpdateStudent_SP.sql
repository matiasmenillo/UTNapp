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
	IN Dni int, 
	IN Admin bit(1), 
	IN IdCareer int, 
	IN FileNumber varchar(200), 
	IN Gender char(1), 
	IN BirthDate date, 
	IN PhoneNumber int, 
	IN Active bit(1) 

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
		PhoneNumber = PhoneNumbe, 
		Active = Active
	WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;