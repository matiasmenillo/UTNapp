DROP DATABASE UTNAppDB;
SET SQL_SAFE_UPDATES = 0;

-- DAR DE ALTA DB --

-- (1) SCHEMA --

CREATE DATABASE UTNAppDB;

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '1234'; 

USE UTNAppDB;

/*DROP TABLE IF EXISTS Images;*/

CREATE TABLE Images
(
	imageId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idStudent int,
    name VARCHAR(100) NOT NULL
)Engine=InnoDB;

USE UTNAppDB;

/*DROP TABLE IF EXISTS UserRol;*/

CREATE TABLE UserRol
(
IdUserRol INT unique NOT NULL,
Name VARCHAR(200) NOT NULL,

Primary Key (IdUserRol)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS Users;*/

CREATE TABLE Users
(
IdUser INT unique auto_increment NOT NULL,
FirstName VARCHAR(200) NOT NULL,
LastName VARCHAR(200) NOT NULL,
Email VARCHAR(200) unique NOT NULL,
Password VARCHAR(200) NOT NULL,
Rol INT NOT NULL,

Primary Key (IdUser, Email),
CONSTRAINT FK_Rol FOREIGN KEY (Rol) REFERENCES UserRol(IdUserRol)
);

USE UTNAppDB;

CREATE TABLE Company
(
IdCompany INT Unique auto_increment NOT NULL,
Name VARCHAR(200) Unique NOT NULL,
AboutUs VARCHAR(200) NULL,
Status BIT NOT NULL,
CompanyLink VARCHAR(200) NULL,
Cuit BIGINT UNIQUE NOT NULL,
Description VARCHAR(200) NULL,
Sector VARCHAR(200) NULL,

Primary Key (Name)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS JobOffer;*/

CREATE TABLE JobOffer
(
IdJobOffer INT Unique auto_increment NOT NULL,
IdJobPosition INT NOT NULL,
IdCompany INT NOT NULL,

Primary Key (IdJobOffer),

FOREIGN KEY (IdCompany)
REFERENCES Company(IdCompany)
)ENGINE=INNODB;

USE UTNAppDB;

/*DROP TABLE IF EXISTS Postulation;*/

CREATE TABLE Postulation
(
IdStudent INT unique NOT NULL,
IdJobOffer INT NOT NULL,
PostulationDate DATE,

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

/*DROP TABLE IF EXISTS H_JobOffer;*/

CREATE TABLE H_JobOffer
(
IdHJobOffer INT Unique auto_increment NOT NULL,
IdJobOffer INT NOT NULL,
IdJobPosition INT NOT NULL,
IdCompany INT NOT NULL,

Primary Key (IdHJobOffer)
);

USE UTNAppDB;

/*DROP TABLE IF EXISTS Mail;*/

CREATE TABLE Mail
(
IdMail INT Unique auto_increment NOT NULL,
Email VARCHAR(200) NOT NULL,
IdCompany INT NOT NULL,
Header VARCHAR(200) NOT NULL,
Message VARCHAR(1000) NOT NULL,
SentDate DATETIME NOT NULL,

Primary Key (IdMail),

CONSTRAINT fk_User_Mail FOREIGN KEY (Email)
REFERENCES Users(Email),

CONSTRAINT fk_Comapany_Mail FOREIGN KEY (IdCompany)
REFERENCES company(IdCompany)
);

USE UTNAppDB;

/*DROP TRIGGER IF EXISTS PostulationTrigger_Insert_H_Postulation;*/

delimiter //

create trigger PostulationTrigger_Insert_H_Postulation after insert on Postulation
   FOR EACH ROW
		BEGIN
			INSERT INTO H_Postulation(IdStudent , IdJobOffer, PostulationDate) values (new.IdStudent, new.IdJobOffer, new.PostulationDate);
		END//

USE UTNAppDB;

/*DROP TRIGGER IF EXISTS PostulationTrigger_Insert_H_JobOffer;*/

delimiter //

create trigger PostulationTrigger_Insert_H_JobOffer after insert on JobOffer
   FOR EACH ROW
		BEGIN
			INSERT INTO H_JobOffer(IdJobOffer, IdJobPosition, IdCompany) values (new.IdJobOffer, new.IdJobPosition, new.IdCompany);
		END
   //
   
-- (2) PROGRAMABILIY --

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

DROP PROCEDURE IF EXISTS  GetAllHistoricPostulationsByJobOffer;

DELIMITER //

CREATE PROCEDURE GetAllHistoricPostulationsByJobOffer
(
	IN IdJobOfferParam INT
)
BEGIN
	SELECT * FROM H_Postulation WHERE IdJobOffer = IdJobOfferParam;
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

DROP PROCEDURE IF EXISTS GetAllHistoricJobOffers;

DELIMITER //

CREATE PROCEDURE GetAllHistoricJobOffers()
BEGIN
	SELECT * FROM H_JobOffer;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetAllHistoricJobOffersById;

DELIMITER //

CREATE PROCEDURE GetAllHistoricJobOffersById
(
	IN IdJobOfferParam INT
)
BEGIN
	SELECT * FROM H_JobOffer WHERE IdJobOffer = IdJobOfferParam;
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
	DELETE FROM Postulation WHERE IdJobOffer = IdJobOfferParam;
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

DROP PROCEDURE IF EXISTS  JobOfferExists;

DELIMITER //

CREATE PROCEDURE JobOfferExists
(
	IN IdJobPositionParam INT,
    IN IdCompanyParam INT
)
BEGIN
	IF EXISTS (SELECT 1 FROM JobOffer WHERE IdJobPosition = IdJobPositionParam AND IdCompany = IdCompanyParam) THEN
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

USE UTNAppDB;

DROP PROCEDURE IF EXISTS Images_add;

DELIMITER $$

CREATE PROCEDURE Images_add(IN Name VARCHAR(100), IN idStudent int)
BEGIN
    INSERT INTO images
    	(name, idStudent)
	VALUES
		(name, idStudent);
END$$

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllUsers;

DELIMITER //

CREATE PROCEDURE GetAllUsers()
BEGIN
	SELECT * FROM Users;
END //

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetUserById;

DELIMITER //

CREATE PROCEDURE GetUserById
(
	IN IdUserDBParam INT
)
BEGIN
	SELECT * FROM Users WHERE IdUser = IdUserDBParam;
END //

USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetUserByEmail;

DELIMITER //

CREATE PROCEDURE GetUserByEmail
(
	IN EmailParam VARCHAR(200)
)
BEGIN
	SELECT * FROM Users WHERE Email = EmailParam;
END //

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

USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertMail;

DELIMITER //

CREATE PROCEDURE InsertMail 
(
	IN Email VARCHAR(200),
    IN IdCompany INT,
	IN Header VARCHAR(200), 
	IN Message VARCHAR(1000)

)
BEGIN
	INSERT INTO Mail VALUES
    (
		Email,
        IdCompany,
        Header,
        Message,
        current_timestamp()
    );
END //

USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteMail;

DELIMITER //

CREATE PROCEDURE DeleteMail
(
	IN IdMailParam INT 
)
BEGIN
	DELETE FROM Mail WHERE IdMail = IdMailParam;
END //

DELIMITER ;

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllMailByEMail;

DELIMITER //

CREATE PROCEDURE GetAllMailByEMail
(
	IN EMailParam VARCHAR(200) 
)
BEGIN
	SELECT * FROM Mail WHERE Email = EMailParam order by sentDate desc;
END //

USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetMailById;

DELIMITER //

CREATE PROCEDURE GetMailById
(
	IN IdMailParam INT 
)
BEGIN
	SELECT * FROM Mail WHERE IdMail = IdMailParam order by sentDate desc;
END //

DELIMITER ;