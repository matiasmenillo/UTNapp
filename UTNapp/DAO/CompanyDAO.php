<?php
    namespace DAO;

    use DAO\ICompanyDAO as ICompanyDAO;
    use Models\Company as Company;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CompanyDAO implements ICompanyDAO{

        private $connection;
        private $tableName = "Company";

        public function Add(Company $company){

            try
            {
                $query = "CALL InsertCompany(:Status, :Sector, :Name, :Description, :Cuit, :CompanyLink, :AboutUs);";
                
                $parameters["Status"] = $company->getStatus();
                $parameters["Sector"] = $company->getSector();
                $parameters["Name"] = $company->getName();
                $parameters["Description"] = $company->getDescription();
                $parameters["Cuit"] = $company->getCuit();
                $parameters["CompanyLink"] = $company->getCompanyLink();
                $parameters["AboutUs"] = $company->getAboutUs();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                return "YA EXISTE UNA EMPRESA CON LOS DATOS INGRESADOS EN EL SISTEMA";
            }
        }

        public function GetAll(){

            try
            {
                $companyList = array();

                $query = "CALL GetAllCompanys();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setId($row["IdCompany"]);
                    $company->setStatus($row["Status"]);
                    $company->setSector($row["Sector"]);
                    $company->setName($row["Name"]);
                    $company->setDescription($row["Description"]);
                    $company->setCuit($row["Cuit"]);
                    $company->setCompanyLink($row["CompanyLink"]);
                    $company->setAboutUs($row["AboutUs"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($companyId){

            try
            {
                $query = "CALL GetCompanyById(:IdCompany);";

                $parameters["IdCompany"] = intval($companyId);

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $row = array_pop($resultSet);

                $company = new Company();
                $company->setId($row["IdCompany"]);
                $company->setStatus($row["Status"]);
                $company->setSector($row["Sector"]);
                $company->setName($row["Name"]);
                $company->setDescription($row["Description"]);
                $company->setCuit($row["Cuit"]);
                $company->setCompanyLink($row["CompanyLink"]);
                $company->setAboutUs($row["AboutUs"]);

                return $company;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Update(Company $company){

            try
            {
                $query = "CALL UpdateCompany(:IdCompanyParam, :Status, :Sector, :Name, :Description, :Cuit, :CompanyLink, :AboutUs);";

                $parameters["IdCompanyParam"] = intval($company->getId());
                $parameters["Status"] = intval($company->getStatus());
                $parameters["Sector"] = $company->getSector();
                $parameters["Name"] = $company->getName();
                $parameters["Description"] = $company->getDescription();
                $parameters["Cuit"] = intval($company->getCuit());
                $parameters["CompanyLink"] = $company->getCompanyLink();
                $parameters["AboutUs"] = $company->getAboutUs();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove(Company $company)
        {
            try
            {
                $query = "CALL DeleteCompany(:IdCompany);";

                $parameters["IdCompany"] = $company->GetId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                return "No se pueden borrar empresas con job offers relacionadas";
            }
        }

        public function getCompanyByName($companyName)
        {
            try
            {
                $companyList = array();

                $query = "CALL GetCompanyByName(:Name);";

                $parameters["Name"] = $companyName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $company = new Company();
                    $company->setId($row["IdCompany"]);
                    $company->setStatus($row["Status"]);
                    $company->setSector($row["Sector"]);
                    $company->setName($row["Name"]);
                    $company->setDescription($row["Description"]);
                    $company->setCuit($row["Cuit"]);
                    $company->setCompanyLink($row["CompanyLink"]);
                    $company->setAboutUs($row["AboutUs"]);

                    array_push($companyList, $company);
                }

                return $companyList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }


?>