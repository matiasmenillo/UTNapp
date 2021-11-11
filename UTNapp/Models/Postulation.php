<?php
    namespace Models;

    class Postulation
    {
        private $student;
        private $jobOffer;
        private $postulationDate;

        public function getStudent()
        {
            return $this->student;
        }

        public function setStudent(Student $student)
        {
            $this->student = $student;
        }

        public function getJobOffer()
        {
            return $this->jobOffer;
        }

        public function setJobOffer(JobOffer $jobOffer)
        {
            $this->jobOffer = $jobOffer;
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