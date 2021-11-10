USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetAllHistoricPostulationsByStudent;

DELIMITER //

CREATE PROCEDURE GetAllHistoricPostulationsByStudent
(
	IN IdStudentParam INT
)
BEGIN
	SELECT * FROM H_Postulation WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;