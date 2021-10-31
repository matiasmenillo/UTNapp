<?php
    namespace DAO;

    use Models\Student as Student;
    use DAO\IStudentDAO as IStudentDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class StudentDAO implements IStudentDAO{

        private $connection;
        private $tableName = "Student";

        public function getStudentsFromAPI()
        {
            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, URLAPI);
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, HTTPHEADER);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); // Hace que la solicitud/conexión sea insegura.

            $response = curl_exec($url);
            $toJson = json_decode($response);

            if ($toJson != NULL)
            {
                foreach($toJson as $eachStudent)
                {
                    $newStudent = new Student;

                    $newStudent->setStudentId($eachStudent->studentId);
                    $newStudent->setCareerId($eachStudent->careerId);
                    $newStudent->setFirstName($eachStudent->firstName);
                    $newStudent->setLastName($eachStudent->lastName);
                    $newStudent->setDni($eachStudent->dni);
                    $newStudent->setFileNumber($eachStudent->fileNumber);
                    $newStudent->setGender($eachStudent->gender);
                    $newStudent->setBirthDate($eachStudent->birthDate);
                    $newStudent->setEmail($eachStudent->email);
                    $newStudent->setPhoneNumber($eachStudent->phoneNumber);
                    $newStudent->setActive($eachStudent->active);
                    $newStudent->setAdmin(false);
                    $newStudent->setPassword(1234); // Como la API NO LO TRAE PONGO 1234 DE DAFAULT.

                    if ($this->GetById($newStudent->getStudentId()) == NULL) // SI NO LO TENGO EN LA BASE, LO AGREGO.
                    {
                        $this->Add($newStudent);
                    }
                }
            }

            curl_close($url);   
        }

        private function Add(Student $student){

            try
            {
                $query = "CALL InsertStudent(:IdStudent, :FirstName, :LastName, :Email, :Password, :Dni, :Admin, :IdCareer, :FileNumber, :Gender, :BirthDate, :PhoneNumber, :Active);";
                
                $parameters["IdStudent"] = $student->getStudentId();
                $parameters["FirstName"] = $student->getFirstName();
                $parameters["LastName"] = $student->getLastName();
                $parameters["Email"] = $student->getEmail();
                $parameters["Password"] = $student->getPassword();
                $parameters["Dni"] = $student->getDni();
                $parameters["Admin"] = $student->getAdmin();
                $parameters["IdCareer"] = $student->getCareerId();
                $parameters["FileNumber"] = $student->getFileNumber();
                $parameters["Gender"] = $student->getGender();
                $parameters["BirthDate"] = $student->getBirthDate();
                $parameters["PhoneNumber"] = $student->getPhoneNumber();
                $parameters["Active"] = $student->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }


        public function GetAll(){

            try
            {
                $studentList = array();

                $query = "CALL GetAllStudents();";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row)
                {                
                    $student = new Student();
                    $student->setStudentId($row["IdStudent"]);
                    $student->setFirstName($row["FirstName"]);
                    $student->setLastName($row["LastName"]);
                    $student->setEmail($row["Email"]);
                    $student->setPassword($row["Password"]);
                    $student->setDni($row["Dni"]);
                    $student->setAdmin($row["Admin"]);
                    $student->setCareerId($row["IdCareer"]);
                    $student->setFileNumber($row["FileNumber"]);
                    $student->setGender($row["Gender"]);
                    $student->setBirthDate($row["BirthDate"]);
                    $student->setPhoneNumber($row["PhoneNumber"]);
                    $student->setActive($row["Active"]);

                    array_push($studentList, $student);
                }

                return $studentList;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetById($studentId){

            try
            {
                $student= new Student;

                $query = "CALL GetStudentById(". $studentId .");";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                             
                $student = new Student();
                $student->setStudentId($resultSet["IdStudent"]);
                $student->setFirstName($resultSet["FirstName"]);
                $student->setLastName($resultSet["LastName"]);
                $student->setEmail($resultSet["Email"]);
                $student->setPassword($resultSet["Password"]);
                $student->setDni($resultSet["Dni"]);
                $student->setAdmin($resultSet["Admin"]);
                $student->setCareerId($resultSet["IdCareer"]);
                $student->setFileNumber($resultSet["FileNumber"]);
                $student->setGender($resultSet["Gender"]);
                $student->setBirthDate($resultSet["BirthDate"]);
                $student->setPhoneNumber($resultSet["PhoneNumber"]);
                $student->setActive($resultSet["Active"]);

                return $student;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Update(Student $student){

            try
            {
                $query = "CALL UpdateStudent(:IdStudent, :FirstName, :LastName, :Email, :Password, :Dni, :Admin, :IdCareer, :FileNumber, :Gender, :BirthDate, :PhoneNumber, :Active);";
                
                $parameters["IdStudent"] = $student->getStudentId();
                $parameters["FirstName"] = $student->getFirstName();
                $parameters["LastName"] = $student->getLastName();
                $parameters["Email"] = $student->getEmail();
                $parameters["Password"] = $student->getPassword();
                $parameters["Dni"] = $student->getDni();
                $parameters["Admin"] = $student->getAdmin();
                $parameters["IdCareer"] = $student->getCareerId();
                $parameters["FileNumber"] = $student->getFileNumber();
                $parameters["Gender"] = $student->getGender();
                $parameters["BirthDate"] = $student->getBirthDate();
                $parameters["PhoneNumber"] = $student->getPhoneNumber();
                $parameters["Active"] = $student->getActive();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Delete($studentId){

            try
            {
                $query = "CALL DeleteStudent(:IdStudent);";

                $parameters["IdStudent"] = $studentId;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }

?>