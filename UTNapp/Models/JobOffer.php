<?php
    namespace Models;

    class JobOffer
    {
        private $jobOfferId;
        private $jobPositionId;
        private $companyId;

        public function getjobOfferId()
        {
            return $this->jobOfferId;
        }

        public function setjobOfferId($jobOfferId)
        {
            $this->jobOfferId = $jobOfferId;
        }

        public function getJobPositionId()
        {
            return $this->jobPositionId;
        }

        public function setJobPositionId($jobPositionId)
        {
            $this->jobPositionId = $jobPositionId;
        }

        public function getCompanyId()
        {
            return $this->companyId;
        }

        public function setCompanyId($companyId)
        {
            $this->companyId = $companyId;
        }

    }
?>  