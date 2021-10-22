<?php
    namespace Controllers;

    use Models\Company as Company;
    use DAO\CompanyDAO as CompanyDAO;

    class CompanyController{ 

        private $CompanyDAO;
        private $companyList;

        public function __construct(){

            $this->CompanyDAO = new CompanyDAO;
        }

        public function ShowCompanyListView(){
            $result = $this->CompanyDAO->GetAll();

            require_once(VIEWS_PATH . "companyList.php"); 
        }

        public function ShowAddView(){

            require_once(VIEWS_PATH . "addCompany.php");
        }

        public function ShowModifView($Cuit, $Name, $Status){
            $ModifCompany = new Company();
            $ModifCompany->setCuit($Cuit);
            $ModifCompany->setName($Name);
            $ModifCompany->setStatus($Status);

            require_once(VIEWS_PATH . "modifyCompany.php");
        }

        public function Add($company_name, $company_cuit, $company_status /*, $aboutUs, $companyLink, $description, $id, $sector*/){

            $newCompany = new Company;
         
            $newCompany->setName($company_name);
            $newCompany->setCuit($company_cuit);
            $newCompany->setStatus($company_status);
            //$newCompany->setAboutUs($aboutUs);
            //$newCompany->setCompanyLink($companyLink);
            //$newCompany->setDescription($description);
            //$newCompany->setId($id);
            //$newCompany->setSector($sector);
        
            $this->CompanyDAO->Add($newCompany);

            
            $this->ShowCompanyListView();
            
        }

        public function Modify($company_name, $company_cuit, $company_status /*, $aboutUs, $companyLink, $description, $id, $sector*/){

            $newCompany = new Company;
         
            $newCompany->setName($company_name);
            $newCompany->setCuit($company_cuit);
            $newCompany->setStatus($company_status);
            //$newCompany->setAboutUs($aboutUs);
            //$newCompany->setCompanyLink($companyLink);
            //$newCompany->setDescription($description);
            //$newCompany->setId($id);
            //$newCompany->setSector($sector);

            $this->CompanyDAO->Remove($newCompany);
            $this->CompanyDAO->Add($newCompany);

            $this->ShowCompanyListView();
            
        }

        public function Remove($Cuit)
        {
            $Company = new Company();
            $Company->setCuit($Cuit);
            $this->CompanyDAO->Remove($Company);
            $this->ShowCompanyListView();
        }

        public function searchCompany($companyName)
        {
            $result = $this->CompanyDAO->getCompanyByName($companyName);

            if (count($result) > 0)
            {
                require_once(VIEWS_PATH . "companyList.php"); 
            }
            else
            {
              $errorMsg = "COMPANY NOT FOUND";
              echo $errorMsg;
              $this->ShowCompanyListView();
            }
        }
    }

?>