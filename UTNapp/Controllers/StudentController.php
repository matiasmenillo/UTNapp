<?php
     namespace Controllers;

     use Models\Student as Student;
     use DAO\StudentDAO as StudentDAO;
 
     class StudentController{
 
         private $StudentDAO;
 
         public function __construct(){
 
             $this->StudentDAO = new StudentDAO;
         }


         public function GetAll(){
 
             return $this->StudentDAO->GetAll();
         }

         public function CheckApi()
         {
            $this->StudentDAO->getStudentsFromAPI();
         }

         public function ShowStudentListView(){
            $studentList = $this->StudentDAO->GetAll();

            require_once(VIEWS_PATH . "studentList.php"); 
        }
     }


?>