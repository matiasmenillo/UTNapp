USE UTNAppDB;

/*DROP TABLE IF EXISTS JobOffer;*/

CREATE TABLE JobOffer
(
IdJobOffer INT Unique auto_increment NOT NULL,
IdJobPosition INT NOT NULL,
IdCompany INT NOT NULL,

Primary Key (IdJobOffer),

CONSTRAINT fk_JobPosition_JobOffer FOREIGN KEY (IdJobPosition)
REFERENCES JobPosition(IdJobPosition),

CONSTRAINT fk_Company_JobOffer FOREIGN KEY (IdCompany)
REFERENCES Company(IdCompany)
)