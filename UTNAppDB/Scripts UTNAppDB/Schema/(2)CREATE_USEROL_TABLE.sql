USE UTNAppDB;

/*DROP TABLE IF EXISTS UserRol;*/

CREATE TABLE UserRol
(
IdUserRol INT unique NOT NULL,
Name VARCHAR(200) NOT NULL,

Primary Key (IdUserRol)
)