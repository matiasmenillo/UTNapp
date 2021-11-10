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
