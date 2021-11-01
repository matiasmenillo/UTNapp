USE UTNAppDB;

/*DROP TABLE IF EXISTS Career;*/

CREATE TABLE Career
(
IdCareer INT Unique NOT NULL,
Description VARCHAR(200) NOT NULL,
Active INT NOT NULL,

Primary Key (IdCareer)
)