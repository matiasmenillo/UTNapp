DROP DATABASE UTNAppDB;
SET SQL_SAFE_UPDATES = 0;

-- DAR DE ALTA DB --

-- (1) SCHEMA --

CREATE DATABASE UTNAppDB;

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '1234'; 

USE UTNAppDB;

/*DROP TABLE IF EXISTS Career;*/

CREATE TABLE Career
(
IdCareer INT Unique NOT NULL,
IdCareerDB INT Unique auto_increment NOT NULL,
Description VARCHAR(200) NOT NULL,
Active INT NOT NULL,

Primary Key (IdCareer, IdCareerDB)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS Images;*/

CREATE TABLE Images
(
	imageId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idStudent int,
    name VARCHAR(100) NOT NULL
)Engine=InnoDB;

USE UTNAppDB;

/*DROP TABLE IF EXISTS Student;*/

CREATE TABLE Student
(
IdStudent INT Unique NOT NULL,
IdStudentDB INT Unique auto_increment NOT NULL,
FirstName VARCHAR(200) NOT NULL,
LastName VARCHAR(200) NOT NULL,
Email VARCHAR(200) NOT NULL,
Password VARCHAR(200) NOT NULL,
Dni varchar(200) NOT NULL,
Admin INT NOT NULL,
IdCareer INT NOT NULL,
FileNumber VARCHAR(200) NULL,
Gender varchar(200) NULL,
BirthDate DATE NOT NULL,
PhoneNumber varchar(200) NULL,
Active INT NOT NULL,

Primary Key (IdStudent, Email, Dni, IdStudentDB),
CONSTRAINT fk_Career_Student FOREIGN KEY (IdCareer) REFERENCES Career(IdCareer)
);

USE UTNAppDB;

CREATE TABLE Company
(
IdCompany INT Unique auto_increment NOT NULL,
Name VARCHAR(200) NOT NULL,
AboutUs VARCHAR(200) NULL,
Status BIT NOT NULL,
CompanyLink VARCHAR(200) NULL,
Cuit BIGINT NOT NULL,
Description VARCHAR(200) NULL,
Sector VARCHAR(200) NULL,

Primary Key (Name, Cuit)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS JobPosition;*/

CREATE TABLE JobPosition
(
IdJobPosition INT Unique NOT NULL,
IdJobPositionDB INT Unique auto_increment NOT NULL,
IdCareer INT NOT NULL,
Description VARCHAR(200) NOT NULL,

Primary Key (IdJobPosition, IdJobPositionDB),
CONSTRAINT fk_Career_JobPosition FOREIGN KEY (IdCareer)
REFERENCES Career(IdCareer)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS JobOffer;*/

CREATE TABLE JobOffer
(
IdJobOffer INT Unique auto_increment NOT NULL,
IdJobPosition INT NOT NULL,
IdCompany INT NOT NULL,

Primary Key (IdJobOffer),

CONSTRAINT fk_JobPosition_JobOffer FOREIGN KEY (IdJobPosition)
REFERENCES JobPosition(IdJobPosition),

CONSTRAINT fk_Company_JobOffer FOREIGN KEY (IdCompany)
REFERENCES Company(IdCompany)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS Postulation;*/

CREATE TABLE Postulation
(
IdStudent INT NOT NULL,
IdJobOffer INT NOT NULL,
PostulationDate DATE,

CONSTRAINT fk_Student_Postulation FOREIGN KEY (IdStudent)
REFERENCES Student(IdStudent),

CONSTRAINT fk_JobOffer_Postulation FOREIGN KEY (IdJobOffer)
REFERENCES JobOffer(IdJobOffer)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS H_Postulation;*/

CREATE TABLE H_Postulation
(
IdHPostulation INT Unique auto_increment NOT NULL,
IdStudent INT NOT NULL,
IdJobOffer INT NOT NULL,
PostulationDate DATE,

Primary Key (IdHPostulation)
);

USE UTNAppDB;

/*DROP TRIGGER IF EXISTS PostulationTrigger_Insert_H_Postulation;*/

delimiter //

create trigger PostulationTrigger_Insert_H_Postulation after insert on Postulation
   FOR EACH ROW
		BEGIN
			INSERT INTO H_Postulation(IdStudent , IdJobOffer, PostulationDate) values (new.IdStudent, new.IdJobOffer, new.PostulationDate);
		END
   //
   
-- (2) PROGRAMABILIY --

USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteCareer;

DELIMITER //

CREATE PROCEDURE DeleteCareer
(
	IN IdCareerDBParam INT 
)
BEGIN
	DELETE FROM Career WHERE IdCareerDB = IdCareerParamDB;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllCareers;

DELIMITER //

CREATE PROCEDURE GetAllCareers()
BEGIN
	SELECT * FROM Career;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetCareerById;

DELIMITER //

CREATE PROCEDURE GetCareerById
(
	IN IdCareerDBParam INT
)
BEGIN
	SELECT * FROM Career WHERE IdCareerDB = IdCareerDBParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertCareer;

DELIMITER //

CREATE PROCEDURE InsertCareer 
(
	IN IdCareer int, 
	IN Description varchar(200), 
	IN Active int

)
BEGIN
	INSERT INTO Career
    (
		IdCareer,
        Description,
        Active
    )
    VALUES
    (
		IdCareer,
        Description,
        Active
    );
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateCareer;

DELIMITER //

CREATE PROCEDURE UpdateCareer
(
	IN IdCareerDBParam int, 
	IN Description varchar(200), 
	IN Active int
)
BEGIN
	UPDATE Career 
	SET
        Description = Description,
        Active = Active
	WHERE IdCareer = IdCareerDBParam;
END //

DELIMITER ;

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

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllActiveCompanys;

DELIMITER //

CREATE PROCEDURE GetAllActiveCompanys()
BEGIN
	SELECT * FROM Company WHERE Status = 1;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllCompanys;

DELIMITER //

CREATE PROCEDURE GetAllCompanys()
BEGIN
	SELECT * FROM Company;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetCompanyById;

DELIMITER //

CREATE PROCEDURE GetCompanyById
(
	IN IdCompanyParam INT
)
BEGIN
	SELECT * FROM Company WHERE IdCompany = IdCompanyParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  CompanyHasJobOffer;

DELIMITER //

CREATE PROCEDURE CompanyHasJobOffer
(
	IN IdCompanyParam INT
)
BEGIN
	IF EXISTS (SELECT 1 FROM JobOffer WHERE IdCompany = IdCompanyParam) THEN
		BEGIN
			SELECT 1;
		END;
		ELSE
		BEGIN 
			SELECT 0;
		END;
	END IF;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetCompanyByName;

DELIMITER //

CREATE PROCEDURE GetCompanyByName
(
	IN CompanyNameParam VARCHAR(200)
)
BEGIN
	SELECT * FROM Company WHERE Name LIKE CONCAT('%', CompanyNameParam, '%');
END //

DELIMITER ;

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

USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateCompany;

DELIMITER //

CREATE PROCEDURE UpdateCompany
(
	IN IdCompanyParam INT,
	IN Status INT, 
	IN Sector varchar(200), 
	IN Name varchar(200),  
	IN Description varchar(200), 
	IN Cuit bigint, 
	IN CompanyLink varchar(200), 
	IN AboutUs varchar(200)  

)
BEGIN
	UPDATE Company 
	SET
		Status = Status,
        Sector = Sector,
        Name = Name,
        Description = Description,
        Cuit = Cuit,
        CompanyLink = CompanyLink,
        AboutUs = AboutUs
	WHERE IdCompany = IdCompanyParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllHistoricPostulations;

DELIMITER //

CREATE PROCEDURE GetAllHistoricPostulations()
BEGIN
	SELECT * FROM H_Postulation;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetAllHistoricPostulationsByStudent;

DELIMITER //

CREATE PROCEDURE GetAllHistoricPostulationsByStudent
(
	IN IdStudentParam INT
)
BEGIN
	SELECT * FROM H_Postulation WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteJobOffer;

DELIMITER //

CREATE PROCEDURE DeleteJobOffer
(
	IN IdJobOfferParam INT 
)
BEGIN
	DELETE FROM JobOffer WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllJobOffers;

DELIMITER //

CREATE PROCEDURE GetAllJobOffers()
BEGIN
	SELECT * FROM JobOffer;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetJobOfferById;

DELIMITER //

CREATE PROCEDURE GetJobOfferById
(
	IN IdJobOfferParam INT
)
BEGIN
	SELECT * FROM JobOffer WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  JobOfferHasPostulations;

DELIMITER //

CREATE PROCEDURE JobOfferHasPostulations
(
	IN IdJobOfferParam INT
)
BEGIN
	IF EXISTS (SELECT 1 FROM postulation WHERE IdJobOffer = IdJobOfferParam) THEN
		BEGIN
			SELECT 1;
		END;
		ELSE
		BEGIN 
			SELECT 0;
		END;
	END IF;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertJobOffer;

DELIMITER //

CREATE PROCEDURE InsertJobOffer 
(
		IN IdJobPosition int, 
		IN IdCompany int
)
BEGIN
	INSERT INTO JobOffer (IdJobPosition, IdCompany) VALUES
    (
		IdJobPosition,
        IdCompany
    );
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateJobOffer;

DELIMITER //

CREATE PROCEDURE UpdateJobOffer
(
	IN IdJobOfferParam int, 
	IN IdJobPosition int, 
	IN IdCompany int
)
BEGIN
	UPDATE JobOffer 
	SET
        IdJobPosition = IdJobPosition,
        IdCompany = IdCompany
	WHERE IdJobOffer = IdJobOfferParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteJobPosition;

DELIMITER //

CREATE PROCEDURE DeleteJobPosition
(
	IN IdJobPositionDBParam INT 
)
BEGIN
	DELETE FROM JobPosition WHERE IdJobPositionDB = IdJobPositionDBParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllJobPositions;

DELIMITER //

CREATE PROCEDURE GetAllJobPositions()
BEGIN
	SELECT * FROM jobposition;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetJobPositionById;

DELIMITER //

CREATE PROCEDURE GetJobPositionById
(
	IN IdJobPositionDBParam INT
)
BEGIN
	SELECT * FROM JobPosition WHERE IdJobPositionDB = IdJobPositionDBParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertJobPosition;

DELIMITER //

CREATE PROCEDURE InsertJobPosition 
(
	IN IdJobPosition int,		
	IN IdCareer	int,		
	IN Description varchar(200)			
)
BEGIN
	INSERT INTO JobPosition 
    (
		IdJobPosition,		
		IdCareer,	
        Description	
    )
    VALUES
    (
		IdJobPosition,		
		IdCareer,	
        Description	
    );
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateJobPosition;

DELIMITER //

CREATE PROCEDURE UpdateJobPosition
(
	IN IdJobPositionDBParam int,		
	IN IdCompany int,		
	IN Description varchar(200)
)
BEGIN
	UPDATE JobPosition 
	SET
		IdCompany = IdCompany,
        Description = Description
	WHERE IdJobPositionDB = IdJobPositionParamDB;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeletePostulation;

DELIMITER //

CREATE PROCEDURE DeletePostulation
(
	IN IdStudentParam INT 
)
BEGIN
	DELETE FROM Postulation WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllPostulations;

DELIMITER //

CREATE PROCEDURE GetAllPostulations()
BEGIN
	SELECT * FROM Postulation;
END //

DELIMITER ;

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

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetPostulationByStudent;

DELIMITER //

CREATE PROCEDURE GetPostulationByStudent
(
	IN IdStudentParam INT
)
BEGIN
	SELECT * FROM Postulation WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertPostulation;

DELIMITER //

CREATE PROCEDURE InsertPostulation 
(
	IN IdStudent int, 
	IN IdJobOffer int, 
	IN PostulationDate date

)
BEGIN
	INSERT INTO Postulation VALUES
    (
		IdStudent,
        IdJobOffer,
        PostulationDate
    );
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdatePostulation;

DELIMITER //

CREATE PROCEDURE UpdatePostulation
(
	IN IdStudent int, 
	IN IdJobOffer int, 
	IN PostulationDate date
)
BEGIN
	UPDATE Postulation 
	SET
        IdJobOffer = IdJobOffer,
        PostulationDate = PostulationDate
	WHERE IdStudent = IdStudent;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteStudent;

DELIMITER //

CREATE PROCEDURE DeleteStudent
(
	IN IdStudentParamDB INT

)
BEGIN
	DELETE FROM Student WHERE IdStudentDB = IdStudentDBParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllActiveStudents;

DELIMITER //

CREATE PROCEDURE GetAllActiveStudents()
BEGIN
	SELECT * FROM Student WHERE Active = 1;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllStudents;

DELIMITER //

CREATE PROCEDURE GetAllStudents()
BEGIN
	SELECT * FROM Student;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetStudentById;

DELIMITER //

CREATE PROCEDURE GetStudentById
(
	IN IdStudentDBParam INT
)
BEGIN
	SELECT * FROM Student WHERE IdStudentDB = IdStudentDBParam;
END //

DELIMITER ;

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
	INSERT INTO Student 
    (
		IdStudent,
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
    )
    VALUES
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

USE UTNAppDB;

DROP PROCEDURE IF EXISTS UpdateStudent;

DELIMITER //

CREATE PROCEDURE UpdateStudent
(
	IN IdStudentDBParam INT,
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
	WHERE IdStudentDB = IdStudentDBParam;
END //

DROP PROCEDURE IF EXISTS Images_add;

DELIMITER $$

CREATE PROCEDURE Images_add(IN Name VARCHAR(100), IN idStudent int)
BEGIN
    INSERT INTO images
    	(name, idStudent)
	VALUES
		(name, idStudent);
END$$

DROP PROCEDURE IF EXISTS DeleteImage;

DELIMITER //

CREATE PROCEDURE DeleteImage
(
	IN imageIdDBParam INT 
)
BEGIN
	DELETE FROM Images WHERE imageId = imageIdDBParam;
END //