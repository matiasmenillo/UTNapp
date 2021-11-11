<?php
    namespace DAO;

    use DAO\IImageDAO as IImageDAO;
    use DAO\QueryType as QueryType;
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
                $parameters["idStudent"] = $image->getIdStudent();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function RemoveImage(Image $image)
        {
            try
            {
                $query = "CALL DeleteImage(:imageId);";

                $parameters["imageId"] = $image->getImageId();
                var_dump($parameters);
                $this->connection = Connection::GetInstance();
               
                $this->connection->ExecuteNonQuery($query, $parameters);
                var_dump($parameters);
            }
            catch(Exception $ex)
            {
                return "NO SE PUDO BORRAR EL CV";
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
                    $image->setImageId($row["imageId"]);
                    $image->setIdStudent($row["idStudent"]);
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
                    $image->setImageId($row["imageId"]);
                    $image->setName($row["name"]);
                    $image->setIdStudent($row["idStudent"]);
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
                
                var_dump($resultSet);
                
                foreach ($resultSet as $row)
                {                
                    $image = new Image();
                    $image->setImageId($row["imageId"]);
                    $image->setName($row["name"]);
                    $image->setIdStudent($row["idStudent"]);
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