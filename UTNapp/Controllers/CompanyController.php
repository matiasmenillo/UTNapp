<?php
    namespace Controllers;

    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;

    class CompanyController{ 

        private $CompanyDAO;
        private $companyList = array();

        public function __construct(){

            $this->CompanyDAO = new CompanyDAO;
        }

        public function ShowCompanyListView(){

            
            require_once(VIEWS_PATH . "companyListAdmin.php");
        }

        public function ShowAddView(){

            require_once(VIEWS_PATH . "addCompany.php");
        }

        public function Add($company_name, $company_cuit /*, $aboutUs, $active, $companyLink, $description, $id, $sector*/){

            $newCompany = new Company;
         
            $newCompany->setName($company_name);
            $newCompany->setCuit($company_cuit);
            //$newCompany->setAboutUs($aboutUs);
            //$newCompany->setActive($active);
            //$newCompany->setCompanyLink($companyLink);
            //$newCompany->setDescription($description);
            //$newCompany->setId($id);
            //$newCompany->setSector($sector);
        
            $this->CompanyDAO->Add($newCompany);

            $this->ShowAddView();
        }



    }

?>