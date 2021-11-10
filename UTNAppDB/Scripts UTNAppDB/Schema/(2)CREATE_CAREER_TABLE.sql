USE UTNAppDB;

/*DROP TABLE IF EXISTS Career;*/

CREATE TABLE Career
(
IdCareer INT Unique NOT NULL,
IdCareerDB INT Unique auto_increment NOT NULL,
Description VARCHAR(200) NOT NULL,
Active INT NOT NULL,

Primary Key (IdCareer, IdCareerDB)
)