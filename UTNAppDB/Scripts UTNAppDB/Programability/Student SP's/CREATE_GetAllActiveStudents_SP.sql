USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetAllActiveStudents;

DELIMITER //

CREATE PROCEDURE GetAllActiveStudents()
BEGIN
	SELECT * FROM Student WHERE Active = 1;
END //

DELIMITER ;