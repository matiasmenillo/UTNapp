<?php
    namespace DAO;

    use Models\Student as Student;

    interface IStudentDAO
    {
        function GetAll();
        function getStudentsFromAPI();
        function GetById($studentId);
        function Update(Student $student);
        function Add(Student $student);
        function Delete($studentId);
        function GetMaxId();
    }
?>