<?php
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CareerDAO implements ICareerDAO{

        private $connection;
        private $tableName = "Career";

        public function getCareersFromAPI()
        {
            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, URL_API_CAREER);
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, HTTPHEADER);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); // Hace que la solicitud/conexión sea insegura.

            $response = curl_exec($url);
            $toJson = json_decode($response);

            if ($toJson != null)
            {
                foreach($toJson as $eachCareer)
                {
                    $newCareer = new Career;

                    $newCareer->setCareerId($eachCareer->careerId);
                    $newCareer->setDescription($eachCareer->description);
                    $newCareer->setActive(intval($eachCareer->active));

                    $result = $this->GetById($newCareer->getCareerId());

                    if ($result == null) // SI NO LO TENGO EN LA BASE, LO AGREGO.
                    {
                        $this->Add($newCareer);
                    }
                }
                
            }

            curl_close($url);   
        }

        public function Add(Career $career){

            try
            {
                $query = "CALL InsertCareer(:IdCareer, :Description, :Active);";
                
                $parameters["IdCareer"] = $career->getCareerId();
                $parameters["Description"] = $career->getDescription();
                $parameters["Active"] = $career->getActive();

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
                $careerList = array();

                $query = "CALL GetAllCareers();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $career = new Career();
                    $career->setCareerId($row["IdCareer"]);
                    $career->setDescription($row["Description"]);
                    $career->setActive($row["Active"]);

                    array_push($careerList, $career);
                }

                return $careerList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($careerId){

            try
            {
                $career= new Career;

                $query = "CALL GetCareerById(:Idcareer);";

                $parameters["Idcareer"] = $careerId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                foreach ($resultSet as $row)
                {                
                    $career = new Career();
                    $career->setCareerId($row["IdCareer"]);
                    $career->setDescription($row["Description"]);
                    $career->setActive($row["Active"]);

                    return $career;
                }

                return null;             
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove(career $career)
        {
            try
            {
                $query = "CALL Deletecareer(:Idcareer);";

                $parameters["Idcareer"] = $career->getCareerId();

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