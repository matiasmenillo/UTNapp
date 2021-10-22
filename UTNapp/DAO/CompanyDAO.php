<?php
    namespace DAO;

    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO{

        private $companyList = array();
        private $fileName;


        public function __construct(){

            $this->fileName = dirname(__DIR__) . "/Data/company.json";
        }

        public function Add(Company $company){

            $this->RetrieveData();
            
            array_push($this->companyList, $company);

            $this->SaveData();
        }

        public function getCompanyByName($companyName)
        {
            $companys = $this->getAll();

            foreach($companys as $company)
            {
                if ($company->getName() == $companyName)
                {
                    return $company;
                }
            }
            
            return false;
        }

        public function Remove(Company $company)
        {
            $this->RetrieveData();
            foreach ($this->companyList as $key => $value) 
            {
                if ($value->getCuit() == $company->getCuit()) 
                {
                    unset($this->companyList[$key]);      
                }
            }
            $this->saveData();
        }


        public function GetAll(){

            $this->RetrieveData();

            return $this->companyList;
        }


        private function SaveData(){

            $arrayToEncode = array();

            foreach($this->companyList as $company){

                $valuesArray["company_name"] = $company->getName();
                $valuesArray["company_cuit"] = $company->getCuit();
                $valuesArray["company_status"] = $company->getStatus();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }
    


        private function RetrieveData(){

            $arrayToDecode = array();
            $this->companyList = array();

            if(file_exists($this->fileName)){

                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){

                    $company = new Company;

                    $company->setName($valuesArray["company_name"]);
                    $company->setCuit($valuesArray["company_cuit"]);
                    $company->setStatus($valuesArray["company_status"]);

                    array_push($this->companyList, $company);
                }
            }

        }

    }


?>