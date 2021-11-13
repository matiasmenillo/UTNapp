<?php
     namespace Controllers;

     use Models\JobPosition as JobPosition;
     use DAO\JobPositionDAO as JobPositionDAO;
 
     class JobPositionController{
 
         private $JobPositionDAO;
 
         public function __construct(){
 
             $this->JobPositionDAO = new JobPositionDAO;
         }

         public function GetAll(){
 
             return $this->JobPositionDAO->GetAll();
         }
     }


?>