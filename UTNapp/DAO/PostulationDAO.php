<?php
    namespace DAO;

    use DAO\IPostulationDAO as IPostulationDAO;
    use Models\Postulation as Postulation;
    use Models\Student as Student;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class PostulationDAO implements IPostulationDAO{

        private $connection;
        private $tableName = "Postulation";

        public function Add(Postulation $Postulation){

            try
            {
                $query = "CALL InsertPostulation(:IdStudent, :IdJobOffer, :PostulationDate);";
                
                $parameters["IdStudent"] = $Postulation->getStudentId();
                $parameters["IdJobOffer"] = $Postulation->getJobOfferId();
                $parameters["PostulationDate"] = $Postulation->getPostulationDate();

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
                $PostulationList = array();

                $query = "CALL GetAllPostulations();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Postulation = new Postulation();
                    $Postulation->setStudentId($row["IdStudent"]);
                    $Postulation->setJobOfferId($row["IdJobOffer"]);
                    $Postulation->setPostulationDate($row["PostulationDate"]);

                    array_push($PostulationList, $Postulation);
                }

                return $PostulationList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByStudent($StudentId){

            try
            {
                $Postulation= new Postulation;

                $query = "CALL GetPostulationByStudent(:IdStudent);";

                $parameters["IdStudent"] = $StudentId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                $row = array_pop($resultSet);

                if($row != null)
                {                        
                    $Postulation = new Postulation();
                    $Postulation->setStudentId($row["IdStudent"]);
                    $Postulation->setJobOfferId($row["IdJobOffer"]);
                    $Postulation->setPostulationDate($row["PostulationDate"]);

                    return $Postulation;
                }

                return null;             
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByJobOffer($JobOfferId){

            try
            {
                $Postulation= new Postulation;

                $query = "CALL GetPostulationByJobOffer(:IdJobOffer);";

                $parameters["IdJobOffer"] = $JobOfferId;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                $returnArray = array();

                foreach ($resultSet as $row)
                {                    
                    $Postulation = new Postulation();
                    $Postulation->setStudentId($row["IdStudent"]);
                    $Postulation->setJobOfferId($row["IdJobOffer"]);
                    $Postulation->setPostulationDate($row["PostulationDate"]);

                   array_push($returnArray, $Postulation);
                }

                return $returnArray;             
               
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Remove(Postulation $Postulation)
        {
            try
            {
                $query = "CALL DeletePostulation(:IdStudent);";

                $parameters["IdStudent"] = $Postulation->getStudentId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAllHistory(){

            try
            {
                $PostulationList = array();

                $query = "CALL GetAllHistoricPostulations();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $Postulation = new Postulation();
                    $Postulation->setStudentId($row["IdStudent"]);
                    $Postulation->setJobOfferId($row["IdJobOffer"]);
                    $Postulation->setPostulationDate($row["PostulationDate"]);

                    array_push($PostulationList, $Postulation);
                }

                return $PostulationList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAllHistoryByStudent(Student $student){

            try
            {
                $PostulationList = array();

                $query = "CALL GetAllHistoricPostulationsByStudent(:IdStudent);";

                $parameters["IdStudent"] = $student->getStudentId();

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
                {                
                    $Postulation = new Postulation();
                    $Postulation->setStudentId($row["IdStudent"]);
                    $Postulation->setJobOfferId($row["IdJobOffer"]);
                    $Postulation->setPostulationDate($row["PostulationDate"]);

                    array_push($PostulationList, $Postulation);
                }

                return $PostulationList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>