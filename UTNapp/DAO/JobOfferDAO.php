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
                
                $parameters["IdJobPosition"] = $JobOffer->getJobPosition()->getJobPositionId();
                $parameters["IdCompany"] = $JobOffer->getCompany()->getId();

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
                    $CompanyDAO = new CompanyDAO;
                    $JobPositionDAO = new JobPositionDAO;

                    $JobOffer->setJobOfferId($row["IdJobOffer"]);
                    $JobOffer->setJobPosition($JobPositionDAO->GetById($row["IdJobPosition"]));
                    $JobOffer->setCompany($CompanyDAO->GetById($row["IdCompany"]));

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

                $row = array_pop($resultSet);

                if($row != null)
                {     
                    $JobOffer = new JobOffer();
                    $CompanyDAO = new CompanyDAO;
                    $JobPositionDAO = new JobPositionDAO;

                    $JobOffer->setJobOfferId($row["IdJobOffer"]);
                    $JobOffer->setJobPosition($JobPositionDAO->GetById($row["IdJobPosition"]));
                    $JobOffer->setCompany($CompanyDAO->GetById($row["IdCompany"]));

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
                    return "No puede borrar una Oferta Laboral si tiene estudiantes postulados";
                }
        }

        private function JobOfferHasPostulations(JobOffer $jobOffer){

            try
            {
                $query = "CALL JobOfferHasPostulations(:IdJobOffer);";
                
                $parameters["IdJobOffer"] = $jobOffer->getJobOfferId();

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                if (intval($resultSet[0][1]) == 1)
                {
                    return  true;
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function Update(JobOffer $JobOffer)
        {
            if (!$this->JobOfferHasPostulations($JobOffer))
            {
                try
                {
                    $query = "CALL UpdateJobOffer(:IdJobOffer, :IdJobPosition, :IdCompany);";
                    
                    $parameters["IdJobOffer"] = $JobOffer->getJobOfferId();
                    $parameters["IdJobPosition"] = $JobOffer->getJobPosition()->getJobPositionId();
                    $parameters["IdCompany"] = $JobOffer->getCompany()->getId();

                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }
            }
            else
            {
                return "No se puede modifcar una oferta laboral si tiene estudiantes postulados";
            }
        }
    }
?>