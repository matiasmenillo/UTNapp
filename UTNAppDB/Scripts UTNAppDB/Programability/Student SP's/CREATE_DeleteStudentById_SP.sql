USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteStudentById;

DELIMITER //

CREATE PROCEDURE DeleteStudentById
(
	IN IdStudentParam INT
)
BEGIN
	DELETE FROM Student WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;