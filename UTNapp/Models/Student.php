<?php
    namespace Models;

    class Student extends User
    {
        private $studentId;
        private $careerId;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $phoneNumber;
        private $active;

        public function setStudentId($id)
        {
            $this->studentId = $id;
        }

        public function getStudentId()
        {
            return $this->studentId;
        }

        public function setCareerId($careerId)
        {
            $this->careerId = $careerId;
        }

        public function getCareerId()
        {
            return $this->careerId;
        }

        public function setFileNumber($fileNumber)
        {
            $this->fileNumber = $fileNumber;
        }

        public function getFileNumber()
        {
            return $this->fileNumber;
        }

        public function setGender($gender)
        {
            $this->gender = $gender;
        }

        public function getGender()
        {
            return $this->gender;
        }

        public function setBirthDate($birthdate)
        {
            $this->birthDate = $birthdate;
        }

        public function getBirthDate()
        {
            return $this->birthDate;
        }

        public function setPhoneNumber($phoneNumber)
        {
            $this->phoneNumber = $phoneNumber;
        }

        public function getPhoneNumber()
        {
            return $this->phoneNumber;
        }

        public function setActive($active)
        {
            $this->active = $active;
        }

        public function getActive()
        {
            return $this->active;
        }
    }
?>