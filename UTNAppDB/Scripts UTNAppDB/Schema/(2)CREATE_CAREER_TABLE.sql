USE UTNAppDB;

/*DROP TABLE IF EXISTS Career;*/

CREATE TABLE Career
(
IdCareer INT Unique NOT NULL,
Description VARCHAR(200) NOT NULL,
Active BIT NOT NULL,

Primary Key (IdCareer)
)