<?php
    namespace Models;

    class Postulation
    {
        private $studentId;
        private $jobOfferId;
        private $postulationDate;

        public function getStudentId()
        {
            return $this->studentId;
        }

        public function setStudentId($studentId)
        {
            $this->studentId = $studentId;
        }

        public function getJobOfferId()
        {
            return $this->jobOfferId;
        }

        public function setJobOfferId($jobOfferId)
        {
            $this->jobOfferId = $jobOfferId;
        }

        public function getPostulationDate()
        {
            return $this->postulationDate;
        }

        public function setPostulationDate($postulationDate)
        {
            $this->postulationDate = $postulationDate;
        }

    }
?>  