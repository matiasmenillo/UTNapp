<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;

    class LoginController{

        public function Login($user_email, $user_password){

           $StudentController = new StudentController;
           
           $StudentController->CheckApi();
        
           $studentList = $StudentController->GetAll();

           $found = false;

           foreach($studentList as $student){

                if($user_email == $student->getEmail()){

                    $found = true;
                        
                    if($user_password == $student->getPassword()){

                        $_SESSION["loggedUser"] = $student;
                        ///Por ahora te manda a home.php. Deberia agregar en esta pagina todas las funciones de navAdmin
                        require_once(VIEWS_PATH."validate-session.php");
                        require(VIEWS_PATH . "home.php");

                    }else{
                        $errorMsg = "CONTRASEÑA INVALIDA";
                        echo $errorMsg;
                        require_once(VIEWS_PATH . "index.php");
                    }
                
              }
            }
            if($found == false){
                $errorMsg = "EMAIL IVALIDO";
                echo $errorMsg;
                require_once(VIEWS_PATH . "index.php");
        }
      }
    }
?>
