<?php
    namespace DAO;

    use Models\User as User;
    use DAO\IUserDAO as IUserDAO;

    class UserDAO implements IUserDAO{

        private $userList = array();
        private $fileName;

        function __construct(){

            $this->fileName = dirname(__DIR__) . "/Data/users.json";
        }


        public function Add($user){

            $this->RetrieveData();

            array_push($this->userList, $user);

            $this->SaveData();
        }


        public function GetAll(){

            $this->RetrieveData();

            return $this->userList;
        }

       
        private function SaveData()
        {
            $arrayToEncode = array();
    
            foreach($this->userList as $user)
            {            
               
                $valuesArray["firstName"] = $user->getFirstName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["dni"] = $user->getDni();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();
                $valuesArray["rol"] = $user->getRol();
    
                array_push($arrayToEncode, $valuesArray);
            }
    
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            
            file_put_contents($this->fileName, $jsonContent);
        }


        private function RetrieveData(){

            $this->userList = array();

            if(file_exists($this->fileName)){

                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){

                    $user = new User;
                    $user->setFirstName($valuesArray["firstName"]);
                    $user->setLastName($valuesArray["lastName"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);
                    $user->setDni($valuesArray["dni"]);
                    $user->setRol($valuesArray["rol"]);

                    
                    array_push($this->userList, $user);
                }                
            }
        }
    }

?>