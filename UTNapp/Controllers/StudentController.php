<?php
     namespace Controllers;

     use Models\Student as Student;
     use DAO\StudentDAO as StudentDAO;
     use DAO\CareerDAO as CareerDAO;
 
     class StudentController{
 
         private $StudentDAO;
         private $CareerDAO;
 
         public function __construct(){
 
             $this->StudentDAO = new StudentDAO;
             $this->CareerDAO = new CareerDAO;
         }

         public function GetAll(){
 
             return $this->StudentDAO->GetAll();
         }

         public function GetById($studentId)
         {
            return $this->StudentDAO->GetById($studentId);
         }

         public function GetByEmail($email)
         {
            return $this->StudentDAO->GetByEmail($email);
         }

         public function ShowStudentListView(){
            $studentList = $this->StudentDAO->GetAll();
            $careerList = $this->CareerDAO->GetAll();

            require_once(VIEWS_PATH . "studentList.php"); 
        }
        
        public function ShowViewStudentDetails($studentId)
        {
            $carrerList = $this->CareerDAO->GetAll();
            $student = $this->StudentDAO->GetById($studentId);

            foreach($carrerList as $career)
            {
                if ($career->getCareerId() == $student->getCareer()->getCareerId())
                {
                    $student->setCareer($career);
                }
            }

            require_once(VIEWS_PATH . "studentDetails.php");
        }
     }


?>