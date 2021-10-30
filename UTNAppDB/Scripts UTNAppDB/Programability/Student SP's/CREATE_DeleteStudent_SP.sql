USE UTNAppDB;

DROP PROCEDURE IF EXISTS DeleteStudent;

DELIMITER //

CREATE PROCEDURE DeleteStudent
(
	IN IdStudentParam INT

)
BEGIN
	DELETE FROM Student WHERE IdStudent = IdStudentParam;
END //

DELIMITER ;