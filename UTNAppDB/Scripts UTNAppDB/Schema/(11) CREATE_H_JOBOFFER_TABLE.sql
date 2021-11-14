USE UTNAppDB;

/*DROP TABLE IF EXISTS H_JobOffer;*/

CREATE TABLE H_JobOffer
(
IdHJobOffer INT Unique auto_increment NOT NULL,
IdJobOffer INT NOT NULL,
IdJobPosition INT NOT NULL,
IdCompany INT NOT NULL,

Primary Key (IdHJobOffer)
)