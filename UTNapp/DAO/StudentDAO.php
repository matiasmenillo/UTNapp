<?php
    namespace DAO;

    use Models\Student as Student;
    use Models\Career as Career;
    use DAO\CareerDAO as CareerDAO;
    use DAO\IStudentDAO as IStudentDAO;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class StudentDAO implements IStudentDAO
    {
        public function GetAll()
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
                $arrayStudents = array();

                foreach($toJson as $eachStudent)
                {
                    $newStudent = new Student;
                    $career = new Career;
                    $career->setCareerId($eachStudent->careerId);

                    $newStudent->setStudentId($eachStudent->studentId);
                    $newStudent->setCareer($career);
                    $newStudent->setFirstName($eachStudent->firstName);
                    $newStudent->setLastName($eachStudent->lastName);
                    $newStudent->setDni($eachStudent->dni);
                    $newStudent->setFileNumber($eachStudent->fileNumber);
                    $newStudent->setGender($eachStudent->gender);
                    $newStudent->setBirthDate($eachStudent->birthDate);
                    $newStudent->setEmail($eachStudent->email);
                    $newStudent->setPhoneNumber($eachStudent->phoneNumber);
                    $newStudent->setActive(intval($eachStudent->active));

                    array_push($arrayStudents, $newStudent);
                }

                curl_close($url); 
                return $arrayStudents;
            }
            else
            {
                curl_close($url); 
                return null;
            }   
        }

        
        public function GetById($studentId)
        {
            $arrayStudents = $this->GetAll();

            foreach($arrayStudents as $student)
            {
                if ($student->GetStudentId() == $studentId)
                {
                    return $student;
                }
            }

            return null;
        }

        public function GetByEmail($email)
        {
            $arrayStudents = $this->GetAll();

            foreach($arrayStudents as $student)
            {
                if ($student->GetEmail() == $email)
                {
                    return $student;
                }
            }

            return null;
        }
    }

?>