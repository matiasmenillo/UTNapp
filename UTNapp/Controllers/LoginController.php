<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;
    use Controllers\UserController as UserController;

    class LoginController
    {

        public function Login($user_email, $user_password)
        {
           $CareerController = new CareerController;
           $JobPositionController = new JobPositionController;
           $StudentController = new StudentController;
           $UserController = new UserController;

           $CareerController->CheckApi();
           $JobPositionController->CheckApi();
        
           $LoggedUser = $UserController->GetByEmail($user_email);

           if ($LoggedUser != null)
           {
                if ($LoggedUser->getPassword() == $user_password)
                {
                    if ($LoggedUser->getAdmin() == 0)
                    {
                            $student = $StudentController->GetByEmail($LoggedUser->getEmail());
                            if($student != null)
                            {
                                $_SESSION["loggedUser"] = $LoggedUser;
                                $_SESSION["loggedStudent"] = $student;
                                require(VIEWS_PATH . "home.php");
                            }
                    }
                    else
                    {
                        $_SESSION["loggedUser"] = $LoggedUser;
                        require(VIEWS_PATH . "home.php");
                    }
                }
                else
                {
                    echo "<script>alert('Contraseña o E-Mail invalido/a.')</script>";
                    require_once(VIEWS_PATH . "index.php");
                }
           }
        }

      public function Logout()
      {
          session_destroy();
          echo "<script>alert('LogOut Exitoso, vuelva pronto')</script>";
          header("location: ".FRONT_ROOT."Home/index");
      }
    }
?>
