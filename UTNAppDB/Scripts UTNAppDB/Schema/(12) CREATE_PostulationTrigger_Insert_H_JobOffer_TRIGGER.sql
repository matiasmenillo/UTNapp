USE UTNAppDB;

/*DROP TRIGGER IF EXISTS PostulationTrigger_Insert_H_JobOffer;*/

delimiter //

create trigger PostulationTrigger_Insert_H_JobOffer after insert on JobOffer
   FOR EACH ROW
		BEGIN
			INSERT INTO H_JobOffer(IdJobOffer, IdJobPosition, IdCompany) values (new.IdJobOffer, new.IdJobPosition, new.IdCompany);
		END
   //