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
)


