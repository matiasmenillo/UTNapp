<?php
    namespace Models;

    class Student
    {
        private $studentId;
        private $career;
        private $fileNumber;
        private $gender;
        private $birthDate;
        private $phoneNumber;
        private $active;
        private $firstName;
        private $lastName;
        private $email;
        private $dni;

        public function setStudentId($id)
        {
            $this->studentId = $id;
        }

        public function getStudentId()
        {
            return $this->studentId;
        }

        public function setCareer(Career $career)
        {
            $this->career = $career;
        }

        public function getCareer()
        {
            return $this->career;
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

        public function getFirstName()
        {
                return $this->firstName;
        }

        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;
        }

        public function getLastName()
        {
                return $this->lastName;
        }

        public function setLastName($lastName)
        {
                $this->lastName = $lastName;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;
        }

        public function getDni()
        {
                return $this->dni;
        }

        public function setDni($dni)
        {
                $this->dni = $dni;
        }
    }
?>