/* RUN TO ADD ADMINS */

INSERT INTO UserRol(IdUserRol, Name) SELECT 0, 'Student';
INSERT INTO UserRol(IdUserRol, Name) SELECT 1, 'Admin';
INSERT INTO UserRol(IdUserRol, Name) SELECT 2, 'Company';

CALL InsertUser('Admin', 'Admin', 'admin@admin.com', 1234, 1);