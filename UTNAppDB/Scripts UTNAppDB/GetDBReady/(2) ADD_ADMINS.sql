/* RUN TO ADD ADMINS (CORRER LUEGO DE LEVANTAR LA API DESDE LOGIN EN APP) */

CALL InsertStudent((SELECT MAX(IdStudent) FROM Student) + 1, 'Mauro', 'Porzio', 'mauro@gmail.com', 1234, 1231231, 1, 1, null, 'M', '2021-12-02', 22323454, 1);
CALL InsertStudent((SELECT MAX(IdStudent) FROM Student) + 1, 'Matias', 'Menillo', 'matias@gmail.com', 1234, 1112231, 1, 2, null, 'M', '2000-01-01', 22354363, 1);
CALL InsertStudent((SELECT MAX(IdStudent) FROM Student) + 1, 'Rodrigo', 'Moreno', 'rodrigo@gmail.com', 1234, 1234123, 1, 2, null, 'M', '2000-01-01', 22354662, 1);