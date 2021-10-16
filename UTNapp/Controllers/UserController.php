<?php
    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;

    class UserController{

        private $userList = array();
        private $UserDAO;

        public function __construct(){

            $this->UserDAO = new UserDAO;
        }

        
        public function Add($user_firstName, $user_lastName, $user_email, $user_dni, $user_rol, $user_password){

            $user = new User;

            $user->setFirstName($user_firstName);
            $user->setLastName($user_lastName);
            $user->setDni($user_dni);
            $user->setEmail($user_email);
            $user->setPassword($user_password);
            $user->setRol($user_rol);
            
            $this->UserDAO->Add($user);
            $this->ShowAddView();
        }

        public function ShowAddView(){

            require_once(VIEWS_PATH . "addUser.php");
        }


        public function GetAll(){

            return $this->UserDAO->GetAll();
        }
    }

?>