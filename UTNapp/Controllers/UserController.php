<?php
     namespace Controllers;

     use Models\User as User;
     use DAO\StudentDAO as StudentDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\UserDAO as UserDAO;
     use Controllers\HomeController as HomeController;
 
     class UserController{
 
         private $StudentDAO;
         private $CareerDAO;
         private $UserDAO;
 
         public function __construct(){
 
             $this->StudentDAO = new StudentDAO;
             $this->CareerDAO = new CareerDAO;
             $this->UserDAO = new UserDAO;
         }

         public function Add($user_FirstName, $user_LastName, $user_email, $user_password, $user_rol){

            $newUser = new User;
            $newUser->setFirstName($user_FirstName);
            $newUser->setLastName($user_LastName);
            $newUser->setEmail($user_email);
            $newUser->setPassword($user_password);
            $newUser->setAdmin(intval($user_rol));
        
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

                if ($newUser->getAdmin() == 0)
                {
                    $this->LoginView();
                }
                else
                {
                    $this->HomeView();
                }
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

         public function ShowAddAdminView()
         {
            require_once(VIEWS_PATH . "addAdmin.php"); 
         }

         private function LoginView()
         {
            require_once(VIEWS_PATH . "index.php"); 
         }

         private function HomeView()
         {
             $homeController = new HomeController;
             $homeController->Home();
         }
     }
?>