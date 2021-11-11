USE UTNAppDB;

/*DROP TABLE IF EXISTS Images;*/


CREATE TABLE Images
(
	imageId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idStudent int,
    name VARCHAR(100) NOT NULL
)Engine=InnoDB;

DROP PROCEDURE IF EXISTS Images_add;

DELIMITER $$

CREATE PROCEDURE Images_add(IN Name VARCHAR(100), IN idStudent int)
BEGIN
    INSERT INTO images
    	(name, idStudent)
	VALUES
		(name, idStudent);

END$$

DROP PROCEDURE IF EXISTS DeleteImage;

DELIMITER //

CREATE PROCEDURE DeleteImage
(
	IN imageIdDBParam INT 
)
BEGIN
	DELETE FROM Images WHERE imageId = imageIdDBParam;
END //

