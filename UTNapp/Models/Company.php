<?php
    namespace Models;


    class Company{

        private $name;
        private $aboutUs;
        private $status;
        private $companyLink;
        private $cuit;
        private $description;
        private $id;
        private $sector;

        

        /**
         * Get the value of aboutUs
         */ 
        public function getAboutUs()
        {
                return $this->aboutUs;
        }

        /**
         * Set the value of aboutUs
         *
         * @return  self
         */ 
        public function setAboutUs($aboutUs)
        {
                $this->aboutUs = $aboutUs;

                return $this;
        }


        /**
         * Get the value of companyLink
         */ 
        public function getCompanyLink()
        {
                return $this->companyLink;
        }

        /**
         * Set the value of companyLink
         *
         * @return  self
         */ 
        public function setCompanyLink($companyLink)
        {
                $this->companyLink = $companyLink;

                return $this;
        }

        /**
         * Get the value of cuit
         */ 
        public function getCuit()
        {
                return $this->cuit;
        }

        /**
         * Set the value of cuit
         *
         * @return  self
         */ 
        public function setCuit($cuit)
        {
                $this->cuit = $cuit;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of sector
         */ 
        public function getSector()
        {
                return $this->sector;
        }

        /**
         * Set the value of sector
         *
         * @return  self
         */ 
        public function setSector($sector)
        {
                $this->sector = $sector;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }
    }

?>