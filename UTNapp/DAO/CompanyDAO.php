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
                throw $ex;
            }
        }

        public function GetAll(){

            try
            {
                $studentList = array();

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

                    array_push($studentList, $company);
                }

                return $studentList;
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

                var_dump($parameters);

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

                var_dump($company);

                $parameters["IdCompany"] = $company->GetId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function getCompanyByName($companyName)
        {
            try
            {
                $studentList = array();

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

                    array_push($studentList, $company);
                }

                return $studentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }


?>