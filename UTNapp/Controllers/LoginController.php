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

                require_once(VIEWS_PATH . "indexAdmin.php");
              }

           }

           
           
 
            
        }
    }
    

?>