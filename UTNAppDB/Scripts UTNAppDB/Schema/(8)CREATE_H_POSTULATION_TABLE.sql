USE UTNAppDB;

/*DROP TABLE IF EXISTS H_Postulation;*/

CREATE TABLE H_Postulation
(
IdHPostulation INT Unique auto_increment NOT NULL,
IdStudent INT NOT NULL,
IdJobOffer INT NOT NULL,
PostulationDate DATE,

Primary Key (IdHPostulation),

CONSTRAINT fk_Student_H_Postulation FOREIGN KEY (IdStudent)
REFERENCES Student(IdStudent),

CONSTRAINT fk_JobOffer_H_Postulation FOREIGN KEY (IdJobOffer)
REFERENCES JobOffer(IdJobOffer)
)