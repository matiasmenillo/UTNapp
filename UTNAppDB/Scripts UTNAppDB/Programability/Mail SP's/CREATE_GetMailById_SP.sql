USE UTNAppDB;

DROP PROCEDURE IF EXISTS GetMailById;

DELIMITER //

CREATE PROCEDURE GetMailById
(
	IN IdMailParam INT 
)
BEGIN
	SELECT * FROM Mail WHERE IdMail = IdMailParam order by sentDate desc;
END //

DELIMITER ;