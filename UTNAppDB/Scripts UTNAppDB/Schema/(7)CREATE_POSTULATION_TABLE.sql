USE UTNAppDB;

/*DROP TABLE IF EXISTS Postulation;*/

CREATE TABLE Postulation
(
IdStudent INT unique NOT NULL,
IdJobOffer INT NOT NULL,
PostulationDate DATE,

CONSTRAINT fk_JobOffer_Postulation FOREIGN KEY (IdJobOffer)
REFERENCES JobOffer(IdJobOffer)
)