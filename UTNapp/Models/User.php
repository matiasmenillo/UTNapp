<?php
    namespace Models;

  class User
  {
        private $userId;
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        private $Rol;

        /**
         * Get the value of firstName
         */ 
        public function getUserId()
        {
                return $this->userId;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */ 
        public function setUserId($userId)
        {
                $this->userId = $userId;

                return $this;
        }

        /**
         * Get the value of firstName
         */ 
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */ 
        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

        /**
         * Get the value of lastName
         */ 
        public function getLastName()
        {
                return $this->lastName;
        }

        /**
         * Set the value of lastName
         *
         * @return  self
         */ 
        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of Rol
         */ 
        public function getRol()
        {
                return $this->Rol;
        }

        /**
         * Set the value of Rol
         *
         * @return  self
         */ 
        public function setRol($Rol)
        {
                $this->Rol = $Rol;

                return $this;
        }
    }


    


?>