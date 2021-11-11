<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;

    class LoginController{

        public function Login($user_email, $user_password){

           $CareerController = new CareerController;
           $JobPositionController = new JobPositionController;
           $StudentController = new StudentController;
           
           $CareerController->CheckApi();
           $JobPositionController->CheckApi();
           $StudentController->CheckApi();
        
           $studentList = $StudentController->GetAll();

           $found = false;

           foreach($studentList as $student){

                if($user_email == $student->getEmail()){

                    $found = true;
                        
                    if($user_password == $student->getPassword()){
                        
                        $careerController = new CareerController;
                        $_SESSION["loggedUser"] = $student;
                        $_SESSION["loggedUserCareer"] = $careerController->GetById($_SESSION["loggedUser"]->getCareerId());
                        require(VIEWS_PATH . "home.php");

                    }else{
                        echo "<script>alert('Contraseña invalida.')</script>";
                        require_once(VIEWS_PATH . "index.php");
                    }
                
              }
            }
            if($found == false){
                echo "<script>alert('E-Mail invalido')</script>";
                require_once(VIEWS_PATH . "index.php");
        }
      }

      public function Logout()
      {
          session_destroy();
          session_start();
          $_SESSION['successMessage']="LogOut Exitoso, vuelva pronto";
          header("location: ".FRONT_ROOT."Home/index");
      }
    }
?>
