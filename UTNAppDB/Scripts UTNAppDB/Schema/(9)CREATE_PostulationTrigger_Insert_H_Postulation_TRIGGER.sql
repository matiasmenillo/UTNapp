USE UTNAppDB;

/*DROP TRIGGER IF EXISTS PostulationTrigger_Insert_H_Postulation;*/

delimiter //

create trigger PostulationTrigger_Insert_H_Postulation after insert on Postulation
   FOR EACH ROW
		BEGIN
			INSERT INTO H_Postulation(IdStudent , IdJobOffer, PostulationDate) values (new.IdStudent, new.IdJobOffer, new.PostulationDate);
		END
   //