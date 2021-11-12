<?php
    namespace Models;

    class Image
    {
        private $imageId;
        private $student;
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

        public function getStudent()
        {
                return $this->student;
        }

        public function setStudent(Student $Student)
        {
                $this->student = $Student;
        }
    }
?>