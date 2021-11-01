<?php
     namespace Controllers;

     use Models\Career as Career;
     use DAO\CareerDAO as CareerDAO;
 
     class CareerController{
 
         private $CareerDAO;
 
         public function __construct(){
 
             $this->CareerDAO = new CareerDAO;
         }

         public function GetAll(){
 
             return $this->CareerDAO->GetAll();
         }

         public function CheckApi()
         {
            $this->CareerDAO->getCareersFromAPI();
         }
     }


?>