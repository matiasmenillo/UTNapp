USE UTNAppDB;

/*DROP TABLE IF EXISTS User;*/

CREATE TABLE User
(
IdUser INT unique auto_increment NOT NULL,
FirstName VARCHAR(200) NOT NULL,
LastName VARCHAR(200) NOT NULL,
Email VARCHAR(200) unique NOT NULL,
Password VARCHAR(200) NOT NULL,
Admin INT NOT NULL,

Primary Key (IdUser, Email)
)


