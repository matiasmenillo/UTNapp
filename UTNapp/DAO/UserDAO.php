<?php
    namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO{

        private $connection;
        private $tableName = "User";

        public function Add(User $user)
        {
            if ($this->checkApi($user))
            {
                try
                {
                    $query = "CALL InsertUser(:FirstName, :LastName, :Email, :Password, :Admin);";
                    
                    $parameters["FirstName"] = $user->getFirstName();
                    $parameters["LastName"] = $user->getLastName();
                    $parameters["Email"] = $user->getEmail();
                    $parameters["Password"] = $user->getPassword();
                    $parameters["Admin"] = $user->getAdmin();

                    $this->connection = Connection::GetInstance();
                    
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    
                }
                catch(Exception $ex)
                {
                    return "Ya existe un usuario con los datos ingresados en el sistema";
                }
            }
            else
            {
                return "Datos incorrectos";
            }
        }

        private function checkApi(User $user)
        {
                        //CURL
                        $url = curl_init();
                        //Sets URL
                        curl_setopt($url, CURLOPT_URL, URL_API_STUDENT);
                        //Sets Header key
                        curl_setopt($url, CURLOPT_HTTPHEADER, HTTPHEADER);
                        curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); // Hace que la solicitud/conexión sea insegura.
            
                        $response = curl_exec($url);
                        $toJson = json_decode($response);
            
                        if ($toJson != null)
                        {
                            foreach($toJson as $eachStudent)
                            {
                                if (intval($eachStudent->active) == 1)
                                {
                                    if ($user->getEmail() == $eachStudent->email && $user->getFirstName() == $eachStudent->firstName && $user->getLastName() == $eachStudent->lastName)
                                    {
                                        return true;
                                    }
                                }
                            }
                        }

                        return false;
        }

        public function GetAll(){

            try
            {
                $userList = array();

                $query = "CALL GetAllUsers();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $user = new User;
                    $user->setFirstName($row["FirstName"]);
                    $user->setLastName($row["LastName"]);
                    $user->setEmail($row["Email"]);
                    $user->setPassword($row["Password"]);
                    $user->setAdmin($row["Admin"]);
                   
                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByEmail($userEmail){

            try
            {
              
                $query = "CALL GetUserByEmail(:email)";

                $parameters["email"] = $userEmail;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $row = array_pop($resultSet);

                $user = new User;
                $user->setFirstName($row["FirstName"]);
                $user->setLastName($row["LastName"]);
                $user->setEmail($row["Email"]);
                $user->setPassword($row["Password"]);
                $user->setAdmin($row["Admin"]);
                
                return $user;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

    }


?>