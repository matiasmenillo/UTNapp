DROP PROCEDURE IF EXISTS DeleteImage;

DELIMITER //

CREATE PROCEDURE DeleteImage
(
	IN imageIdDBParam INT 
)
BEGIN
	DELETE FROM Images WHERE imageId = imageIdDBParam;
END //