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

        public function ShowModifView($company_cuit,  $id, $company_name, $company_status , $aboutUs, $companyLink, $description, $sector){
            $ModifCompany = new Company();
            $ModifCompany->setName($company_name);
            $ModifCompany->setCuit($company_cuit);
            $ModifCompany->setStatus($company_status);
            $ModifCompany->setAboutUs($aboutUs);
            $ModifCompany->setCompanyLink($companyLink);
            $ModifCompany->setDescription($description);
            $ModifCompany->setId($id);
            $ModifCompany->setSector($sector);

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

        public function Modify($id, $company_name, $company_cuit , $aboutUs, $companyLink, $description, $sector,$company_status){

            $newCompany = new Company;
         
            $newCompany->setName($company_name);
            $newCompany->setCuit($company_cuit);
            $newCompany->setStatus($company_status);
            $newCompany->setAboutUs($aboutUs);
            $newCompany->setCompanyLink($companyLink);
            $newCompany->setDescription($description);
            $newCompany->setId($id);
            $newCompany->setSector($sector);

            $this->CompanyDAO->Update($newCompany);

            $this->ShowCompanyListView();
            
        }

        public function Remove($CompanyId)
        {
            $Company = new Company();
            $Company->setId(intval($CompanyId));
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