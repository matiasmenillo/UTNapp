<?php
    namespace DAO;

    use DAO\IJobOfferDAO as IJobOfferDAO;
    use Models\JobOffer as JobOffer;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class JobOfferDAO implements IJobOfferDAO{

        private $connection;
        private $tableName = "JobOffer";

        public function Add(JobOffer $JobOffer){

            try
            {
                $query = "CALL InsertJobOffer(:IdJobPosition, :IdCompany);";
                
                $parameters["IdJobPosition"] = $JobOffer->getJobPositionId();
                $parameters["IdCompany"] = $JobOffer->getCompanyId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                return "YA EXISTE UNA JOB OFFER CON LOS DATOS INGRESADOS";
            }
        }

        public function GetAll(){

            try
            {
                $JobOfferList = array();

                $query = "CALL GetAllJobOffers();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {   
                    $JobOffer = new JobOffer();
                    $JobOffer->setJobOfferId($row["IdJobOffer"]);
                    $JobOffer->setJobPositionId($row["IdJobPosition"]);
                    $JobOffer->setCompanyId($row["IdCompany"]);

                    array_push($JobOfferList, $JobOffer);
                }

                return $JobOfferList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($JobOfferId){

            try
            {
                $JobOffer= new JobOffer;

                $query = "CALL GetJobOfferById(:IdJobOffer);";

                $parameters["IdJobOffer"] = $JobOfferId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                foreach ($resultSet as $row)
                {                
                    $JobOffer = new JobOffer();
                    $JobOffer->setJobOfferId($row["idJobOffer"]);
                    $JobOffer->setJobPositionId($row["jobPositionId"]);
                    $JobOffer->setCompanyId($row["companyId"]);

                    return $JobOffer;
                }

                return null;             
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove(JobOffer $JobOffer)
        {
            try
            {
                $query = "CALL DeleteJobOffer(:IdJobOffer);";

                $parameters["IdJobOffer"] = $JobOffer->getJobOfferId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Update(JobOffer $JobOffer){

            try
            {
                $query = "CALL UpdateJobOffer(:IdJobOffer, :IdJobPosition, :IdCompany);";
                
                $parameters["IdJobOffer"] = $JobOffer->getJobOfferId();
                $parameters["IdJobPosition"] = $JobOffer->getJobPositionId();
                $parameters["IdCompany"] = $JobOffer->getCompanyId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>