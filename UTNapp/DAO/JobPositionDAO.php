<?php
    namespace DAO;

    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\JobPosition as JobPosition;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class JobPositionDAO implements IJobPositionDAO{

        private $connection;
        private $tableName = "JobPosition";

        public function getJobPositionsFromAPI()
        {
            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, URL_API_JOBPOSITION);
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, HTTPHEADER);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); // Hace que la solicitud/conexión sea insegura.

            $response = curl_exec($url);
            $toJson = json_decode($response);

            if ($toJson != null)
            {
                foreach($toJson as $eachJobPosition)
                {
                    $newJobPosition = new JobPosition;

                    $newJobPosition->setJobPositionId($eachJobPosition->jobPositionId);
                    $newJobPosition->setCareerId($eachJobPosition->careerId);
                    $newJobPosition->setDescription($eachJobPosition->description);

                    $result = $this->GetById($newJobPosition->getJobPositionId());

                    if ($result == null) // SI NO LO TENGO EN LA BASE, LO AGREGO.
                    {
                        $this->Add($newJobPosition);
                    }
                }
                
            }

            curl_close($url);   
        }

        public function Add(JobPosition $JobPosition){

            try
            {
                $query = "CALL InsertJobPosition(:IdJobPosition, :IdCareer, :Description);";
                
                $parameters["IdJobPosition"] = $JobPosition->getJobPositionId();
                $parameters["IdCareer"] = $JobPosition->getCareerId();
                $parameters["Description"] = $JobPosition->getDescription();

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
                $JobPositionList = array();

                $query = "CALL GetAllJobPositions();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $JobPosition = new JobPosition();
                    $JobPosition->setJobPositionId($row["idjobposition"]);
                    $JobPosition->setDescription($row["description"]);
                    $JobPosition->setCareerId($row["careerId"]);

                    array_push($JobPositionList, $JobPosition);
                }

                return $JobPositionList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($JobPositionId){

            try
            {
                $JobPosition= new JobPosition;

                $query = "CALL GetJobPositionById(:IdJobPosition);";

                $parameters["IdJobPosition"] = $JobPositionId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                foreach ($resultSet as $row)
                {                
                    $JobPosition = new JobPosition();
                    $JobPosition->setJobPositionId($row["idjobposition"]);
                    $JobPosition->setDescription($row["description"]);
                    $JobPosition->setCareerId($row["careerId"]);

                    return $JobPosition;
                }

                return null;             
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove(JobPosition $JobPosition)
        {
            try
            {
                $query = "CALL DeleteJobPosition(:IdJobPosition);";

                $parameters["IdJobPosition"] = $JobPosition->getJobPositionId();

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