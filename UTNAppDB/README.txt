==========================================================================================================================================
							!!!! ACLARACIONES !!!!
==========================================================================================================================================
EN LA RUTA: \UTNapp\UTNAppDB\Scripts UTNAppDB\GetDBReady
1-) EJECUTAR "(1) EXECUTE_SCHEMA_AND_SPs_DB".
2-) LEVANTAR WEB Y INTENTAR LOGIN CON CUALQUIER COSA PARA QUE LEVANTE DATOS DE API.
3-) EJECUTAR "(2) ADD_ADMINS".
4-) EJECUTAR "(3) ADD_TEST_DATA".
==========================================================================================================================================
							   <-- GUIA SPs -->
==========================================================================================================================================
Student (PK -> IdStudent, Email, Dni) ====================================================================================================

GetAllStudents()
GetAllActiveStudents()
GetStudentById(IdStudent)
InsertStudent(IdStudent, FirstName, LastName, Email, Password, Dni, Admin, IdCareer, FileNumber, Gender, BirthDate, PhoneNumber, Active)
UpdateStudent(IdStudent, FirstName, LastName, Email, Password, Dni, Admin, IdCareer, FileNumber, Gender, BirthDate, PhoneNumber, Active)
DeleteStudent(IdStudent)

==========================================================================================================================================
Company (PK -> IdCompany, Name, Cuit) ====================================================================================================

GetAllCompanys()
GetAllActiveCompanys()
GetCompanyById(IdCompany)
GetCompanyByName(Name)
InsertCompany(Status, Sector, Name, Description, Cuit, CompanyLink, AboutUs) --> NO SE EL PASA EL IdCompany porque lo genera la base.
UpdateCompany(IdComapny, Status, Sector, Name, Description, Cuit, CompanyLink, AboutUs)
DeleteCompany(IdCompany)

==========================================================================================================================================
Career (PK -> IdCareer) =================================================================================================================

GetAllCareers()
GetCareerById(IdCareer)
InsertCareer(IdCareer, Description, Active)
UpdateCareer(IdCareer, Description, Active)
DeleteCareer(IdCareer)

==========================================================================================================================================
JobPosition (PK -> IdJobPosition) ===========================================================================================================

GetAllJobPosition()
GetJobPositionById(IdJobPosition)
InsertJobPosition(IdJobPosition, IdCareer, Description)
UpdateJobPosition(IdJobPosition, IdCareer, Description)
DeleteJobPosition(IdJobPosition)

==========================================================================================================================================
JobOffer (PK -> IdJobOffer) ==============================================================================================================

GetAllJobOffers()
GetJobOfferById(IdJobOffer)
InsertJobOffer(IdJobPosition, IdCompany) --> NO SE EL PASA EL IdJobOffer porque lo genera la base.
UpdateJobOffer(IdJobOffer,IdJobPosition, IdCompany)
DeleteJobOffer(IdJobOffer)

==========================================================================================================================================
Postulation (PK -> IdStudent, IdJobOffer) ================================================================================================

GetAllPostulations()
GetPostulationByStudent(IdStudent)
GetPostulationByJobOffer(IdJobOffer)
InsertPostulation(IdStudent, IdJobOffer, PostulationDate)
UpdatePostulation(IdStudent, IdJobOffer, PostulationDate)
DeletePostulation(IdStudent)

==========================================================================================================================================