<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;
    use Controllers\UserController as UserController;
    use DAO\CareerDAO as CareerDAO;
    use DAO\CompanyDAO AS CompanyDAO;

    class LoginController
    {

        public function Login($user_email, $user_password)
        {
           $StudentController = new StudentController;
           $UserController = new UserController;
        
           $LoggedUser = $UserController->GetByEmail($user_email);

           if ($LoggedUser != null)
           {
                if ($LoggedUser->getPassword() == $user_password)
                {
                    if ($LoggedUser->getRol() == 0)
                    {
                            $student = $StudentController->GetByEmail($LoggedUser->getEmail());
                            if($student != null)
                            {
                                $CareerDAO = new CareerDAO;

                                $student->setCareer($CareerDAO->GetById($student->getCareer()->getCareerId()));
                                $_SESSION["loggedUser"] = $LoggedUser;
                                $_SESSION["loggedStudent"] = $student;
                                require(VIEWS_PATH . "home.php");
                            }
                    }
                    else
                    {
                        $_SESSION["loggedUser"] = $LoggedUser;

                        if ($LoggedUser->getRol() == 2)
                        {
                            $CompanyDAO = new CompanyDAO;
                            $company = $CompanyDAO->getCompanyByName($LoggedUser->GetFirstName())[0];
                            $_SESSION["loggedCompany"] = $company;
                        }

                        require(VIEWS_PATH . "home.php");
                    }
                }
                else
                {
                    echo "<script>alert('Contraseña o E-Mail invalido/a.')</script>"; // Se muestra un solo mensaje de error, para no especificarle al usuario cual es el dato errone, de esta manera protegemos su informacion.
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
