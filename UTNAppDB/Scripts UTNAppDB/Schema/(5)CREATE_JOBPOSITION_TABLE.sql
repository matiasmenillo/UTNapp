USE UTNAppDB;

/*DROP TABLE IF EXISTS JobPosition;*/

CREATE TABLE JobPosition
(
IdJobPosition INT Unique NOT NULL,
IdJobPositionDB INT Unique auto_increment NOT NULL,
IdCareer INT NOT NULL,
Description VARCHAR(200) NOT NULL,

Primary Key (IdJobPosition, IdJobPositionDB),
CONSTRAINT fk_Career_JobPosition FOREIGN KEY (IdCareer)
REFERENCES Career(IdCareer)
)