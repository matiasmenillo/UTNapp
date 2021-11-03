USE UTNAppDB;

DROP PROCEDURE IF EXISTS  GetPostulationByStudent;

DELIMITER //

CREATE PROCEDURE GetPostulationByStudent
(
	IN IdStudentParam INT
)
BEGIN
	SELECT * FROM Postulation WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;