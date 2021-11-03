<?php
    namespace DAO;

    use Models\Company as Company;

    interface ICompanyDAO{

        function Add(Company $company);
        function Remove(Company $company);
        function getCompanyByName($companyName);
        function Update(Company $company);
        function GetAll();
    }

?>