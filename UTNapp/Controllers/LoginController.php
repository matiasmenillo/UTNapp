<?php
    namespace Controllers;

    use Controllers\UserController as UserController;

    class LoginController{

        public function Login($user_email, $user_password){

           $userController = new UserController;
        
           $userList = $userController->GetAll();
           
           foreach($userList as $user){

                if(($user_email == $user->getEmail()) && ($user_password == $user->getPassword())){

                $_SESSION["loggedUser"] = $user;

                ///Por ahora te manda a home.php. Deberia agregar en esta pagina todas las funciones de navAdmin
                require_once(VIEWS_PATH."validate-session.php");
                require(VIEWS_PATH . "home.php");


              }
        }
    }

    }
    
    

?>