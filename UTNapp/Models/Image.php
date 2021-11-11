<?php
    namespace Models;

    class Image
    {
        private $imageId;
        private $idStudent;
        private $name;

        public function getImageId()
        {
            return $this->imageId;
        }

        public function setImageId($imageId)
        {
            $this->imageId = $imageId;
        }  
       
        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }        


        /**
         * Get the value of idStudent
         */ 
        public function getIdStudent()
        {
                return $this->idStudent;
        }

        /**
         * Set the value of idStudent
         *
         * @return  self
         */ 
        public function setIdStudent($idStudent)
        {
                $this->idStudent = $idStudent;

                return $this;
        }
    }
?>