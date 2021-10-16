<?php
    namespace DAO;

    use Models\Company as Company;

    interface ICompanyDAO{

        function Add(Company $company);
        function Remove(Company $company);
        //function GetById($id);

    }

?>