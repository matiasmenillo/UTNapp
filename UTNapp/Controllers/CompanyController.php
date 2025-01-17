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

        public function Add($company_name, $company_cuit , $aboutUs, $companyLink, $description, $sector,$company_status){
        
            if (strlen((String)$company_cuit) == 10)
            {
                $newCompany = new Company;
            
                $newCompany->setName($company_name);
                $newCompany->setCuit($company_cuit);
                $newCompany->setStatus(intval($company_status));
                $newCompany->setAboutUs($aboutUs);
                $newCompany->setCompanyLink($companyLink);
                $newCompany->setDescription($description);
                $newCompany->setSector($sector);
            
                $error = $this->CompanyDAO->Add($newCompany);

                if (isset($error))
                {
                    echo "<script>alert('". $error ."')</script>";
                    unset($error);
                    $this->ShowAddView();
                }
                else
                {
                    $this->ShowCompanyListView();
                } 
            }
            else
            {
                echo "<script>alert('El Campo CUIT debe tener 10 Digitos Numericos')</script>";
                $this->ShowAddView();
            }
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

            $error = $this->CompanyDAO->Update($newCompany);

            if ($error != null)
            {   
                echo "<script>alert('". $error ."')</script>";
            }

            $this->ShowCompanyListView();
            
        }

        public function Remove($CompanyId)
        {
            $Company = new Company();
            $Company->setId(intval($CompanyId));
            $error = $this->CompanyDAO->Remove($Company);

            if ($error != null)
            {
                echo "<script>alert('". $error ."')</script>";
                unset($error);
            }  

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
                echo "<script>alert('Compañía no encontrada')</script>";
              $this->ShowCompanyListView();
            }
        }
        
    }

?>