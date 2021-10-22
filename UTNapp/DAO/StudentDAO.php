<?php
    namespace DAO;

    use Models\Student as Student;
    use DAO\IStudentDAO as IStudentDAO;

    class StudentDAO implements IStudentDAO{

        private $studentList = array();
        private $fileName;

        function __construct(){

            $this->fileName = dirname(__DIR__) . "/Data/students.json";
        }

        private function getStudentsFromAPI()
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
                $newStudent->setRol("student");
                $newStudent->setPassword(1234); // Como la API NO LO TRAE PONGO 1234 DE DAFAULT.

                $this->Add($newStudent);
            }
            curl_close($url);   
        }

        private function Add($student){

            $this->RetrieveData();

            array_push($this->studentList, $student);

            $this->SaveData();
        }


        public function GetAll(){

            $this->RetrieveData();

            if(!file_exists($this->fileName)) // Solo consulto la API si tengo que cargar el JSON por primera ves.
            {
                $this->getStudentsFromAPI();
            }

            return $this->studentList;
        }

       
        private function SaveData()
        {
            $arrayToEncode = array();
    
            foreach($this->studentList as $student)
            {            
                $valuesArray["studentId"] = $student->getStudentId();
                $valuesArray["careerId"] = $student->getCareerId();
                $valuesArray["firstName"] = $student->getFirstName();
                $valuesArray["lastName"] = $student->getLastName();
                $valuesArray["dni"] = $student->getDni();
                $valuesArray["fileNumber"] = $student->getFileNumber();
                $valuesArray["gender"] = $student->getGender();
                $valuesArray["birthDate"] = $student->getBirthDate();
                $valuesArray["email"] = $student->getEmail();
                $valuesArray["phoneNumber"] = $student->getPhoneNumber();
                $valuesArray["active"] = $student->getActive();
                $valuesArray["rol"] = $student->getRol();
                $valuesArray["password"] = $student->getPassword();
    
                array_push($arrayToEncode, $valuesArray);
            }
    
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            
            file_put_contents($this->fileName, $jsonContent);
        }


        private function RetrieveData(){

            $this->studentList = array();

            if(file_exists($this->fileName)){

                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){

                    $student = new Student;

                    $student->setStudentId($valuesArray["studentId"]);
                    $student->setCareerId($valuesArray["careerId"]);
                    $student->setFirstName($valuesArray["firstName"]);
                    $student->setLastName($valuesArray["lastName"]);
                    $student->setDni($valuesArray["dni"]);
                    $student->setFileNumber($valuesArray["fileNumber"]);
                    $student->setGender($valuesArray["gender"]);
                    $student->setBirthDate($valuesArray["birthDate"]);
                    $student->setEmail($valuesArray["email"]);
                    $student->setPhoneNumber($valuesArray["phoneNumber"]);
                    $student->setActive($valuesArray["active"]);
                    $student->setRol($valuesArray["rol"]);
                    $student->setPassword($valuesArray["password"]);

                    array_push($this->studentList, $student);
                }                
            }
        }
    }

?>