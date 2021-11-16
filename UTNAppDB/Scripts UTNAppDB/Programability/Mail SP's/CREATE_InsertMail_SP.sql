USE UTNAppDB;

DROP PROCEDURE IF EXISTS InsertMail;

DELIMITER //

CREATE PROCEDURE InsertMail 
(
	IN Email VARCHAR(200),
    IN IdCompany INT,
	IN Header VARCHAR(200), 
	IN Message VARCHAR(1000)

)
BEGIN
	INSERT INTO Mail 
    (
		IdMail,
		Email,
        IdCompany,
        Header,
        Message,
        SentDate
    )
    VALUES
    (
		NULL,
		Email,
        IdCompany,
        Header,
        Message,
        current_timestamp()
    );
END //

DELIMITER ;

CALL InsertMail('test@mail.com', 1, 'test', 'test-message');