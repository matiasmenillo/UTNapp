<?php
    namespace Models;

    class JobOffer
    {
        private $jobOfferId;
        private $jobPosition;
        private $company;

        public function getjobOfferId()
        {
            return $this->jobOfferId;
        }

        public function setjobOfferId($jobOfferId)
        {
            $this->jobOfferId = $jobOfferId;
        }

        public function getJobPosition()
        {
            return $this->jobPosition;
        }

        public function setJobPosition(JobPosition $jobPosition)
        {
            $this->jobPosition = $jobPosition;
        }

        public function getCompany()
        {
            return $this->company;
        }

        public function setCompany(Company $company)
        {
            $this->company = $company;
        }

    }
?>  