USE UTNAppDB;

/*DROP TABLE IF EXISTS Student;*/

CREATE TABLE Student
(
IdStudent INT Unique NOT NULL,
FirstName VARCHAR(200) NOT NULL,
LastName VARCHAR(200) NOT NULL,
Email VARCHAR(200) NOT NULL,
Password VARCHAR(200) NOT NULL,
Dni INT NOT NULL,
Admin BIT NOT NULL,
IdCareer INT NOT NULL,
FileNumber VARCHAR(200) NULL,
Gender CHAR NULL,
BirthDate DATE NOT NULL,
PhoneNumber INT NULL,
Active BIT NOT NULL,

Primary Key (IdStudent, Email, Dni),
CONSTRAINT fk_Career_Student FOREIGN KEY (IdCareer)
REFERENCES Career(IdCareer)
)