<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;

    class LoginController{

        public function Login($user_email, $user_password){

           $StudentController = new StudentController;

           
        
           $studentList = $StudentController->GetAll();
           
           foreach($studentList as $student){

                if(($user_email == $student->getEmail()) && ($user_password == $student->getPassword())){

                $_SESSION["loggedUser"] = $student;

                ///Por ahora te manda a home.php. Deberia agregar en esta pagina todas las funciones de navAdmin
                require_once(VIEWS_PATH."validate-session.php");
                require(VIEWS_PATH . "home.php");


              }
        }
    }

    }
    
    

?>