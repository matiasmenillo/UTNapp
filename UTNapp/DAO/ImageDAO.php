<?php
    namespace DAO;

    use DAO\IImageDAO as IImageDAO;
    use DAO\QueryType as QueryType;
    use DAO\StudentDAO as StudentDAO;
    use Models\Image as Image;

    class ImageDao implements \DAO\IImageDao
    {
        private $connection;
        private $tableName = "Images";

        public function Add(Image $image)
        {
            try
            {
                $query = "CALL Images_add(:name, :idStudent);";
                
                $parameters["name"] = $image->getName();
                $parameters["idStudent"] = $image->getStudent()->getStudentId();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try
            {
                $imageList = array();

                $query = "SELECT imageId, name, idStudent FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $image = new Image();
                    $StudentDAO = new StudentDAO;
                    $image->setStudent($StudentDAO->GetById($row["idStudent"]));
                    $image->setImageId($row["imageId"]);
                    $image->setName($row["name"]);

                    array_push($imageList, $image);
                }

                return $imageList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        function GetByIdStudent($idStudent)
        {
            try
            {
                $image = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE idStudent = :idStudent";

                $parameters["idStudent"] = $idStudent;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);   
                
                foreach ($resultSet as $row)
                {                
                    $image = new Image();
                    $StudentDAO = new StudentDAO;
                    $image->setStudent($StudentDAO->GetById($row["idStudent"]));
                    $image->setImageId($row["imageId"]);
                    $image->setName($row["name"]);
                }

                return $image;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        function GetByIdImage($idImage)
        {
            try
            {
                $image = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE imageId = :imageId";

                $parameters["imageId"] = $idImage;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);  
                
                foreach ($resultSet as $row)
                {                
                    $image = new Image();
                    $StudentDAO = new StudentDAO;
                    $image->setStudent($StudentDAO->GetById($row["idStudent"]));
                    $image->setImageId($row["imageId"]);
                    $image->setName($row["name"]);
                }

                return $image;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>