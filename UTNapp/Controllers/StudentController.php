<?php
    namespace Controllers;


    class StudentController{

        public function GetStudentFromApi{

            $url = "https://utn-students-api.herokuapp.com/index.html/api/Student";
            $studentJson = file_get_contents($url);

        }
    }


?>