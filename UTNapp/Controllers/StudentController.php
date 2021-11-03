<?php
     namespace Controllers;

     use Models\Student as Student;
     use DAO\StudentDAO as StudentDAO;
 
     class StudentController{
 
         private $StudentDAO;
 
         public function __construct(){
 
             $this->StudentDAO = new StudentDAO;
         }

         public function Add($user_firstName, $user_lastName , $user_email, $user_dni, $user_Gender, $user_BirthDate,$user_PhoneNumber, $user_FileNumber, $user_CareerId,$user_rol, $user_Active, $user_password){
           
            $newStudent = new Student;
            $newStudent->setStudentId(intval($this->StudentDAO->GetMaxId())+1);
            $newStudent->setFirstName($user_firstName);
            $newStudent->setLastName($user_lastName);
            $newStudent->setEmail($user_email);
            $newStudent->setDni($user_dni);
            $newStudent->setGender($user_Gender);
            $newStudent->setBirthDate($user_BirthDate);
            $newStudent->setPhoneNumber($user_PhoneNumber);
            $newStudent->setFileNumber($user_FileNumber);
            $newStudent->setCareerId($user_CareerId);
            $newStudent->setAdmin(intval($user_rol));
            $newStudent->setActive(intval($user_Active));
            $newStudent->setPassword($user_password);
        
            $error = $this->StudentDAO->Add($newStudent);

            if (isset($error))
            {
                echo $error;
                unset($error);
                $this->ShowAddStudentView();
            }
            else
            {
                $this->ShowStudentListView();
            } 
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

        public function ShowAddStudentView()
        {
            $careerController = new CareerController;
            $careerList = $careerController->GetAll();
            require_once(VIEWS_PATH . "addStudent.php"); 
        }
     }


?>