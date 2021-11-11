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
)


