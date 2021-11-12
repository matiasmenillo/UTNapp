<?php
     namespace Controllers;

     use Models\User as User;
     use DAO\StudentDAO as StudentDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\UserDAO as UserDAO;
 
     class UserController{
 
         private $StudentDAO;
         private $CareerDAO;
         private $UserDAO;
 
         public function __construct(){
 
             $this->StudentDAO = new StudentDAO;
             $this->CareerDAO = new CareerDAO;
             $this->UserDAO = new UserDAO;
         }

         public function Add($user_FirstName, $user_LastName, $user_email, $user_password){
           
            $newUser = new User;
            $newUser->setFirstName($user_FirstName);
            $newUser->setLastName($user_LastName);
            $newUser->setEmail($user_email);
            $newUser->setPassword($user_password);
            $newUser->setAdmin(0);
        
            $error = $this->UserDAO->Add($newUser);

            if (isset($error))
            {
                echo "<script>alert('". $error ."')</script>";
                unset($error);
                $this->AddUserView();
            }
            else
            {
                echo "<script>alert('Registrado correctamente!')</script>";
                $this->LoginView();
            } 
        }
         public function GetAll(){
 
             return $this->UserDAO->GetAll();
         }

         public function GetByEmail($email)
         {
             return $this->UserDAO->GetByEmail($email);
         }

         public function AddUserView(){

            require_once(VIEWS_PATH . "userRegister.php"); 
         }

         private function LoginView()
         {
            require_once(VIEWS_PATH . "index.php"); 
         }
     }
?>