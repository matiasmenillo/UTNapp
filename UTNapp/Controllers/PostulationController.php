<?php
     namespace Controllers;

     use Models\Postulation as Postulation;
     use DAO\PostulationDAO as PostulationDAO;
 
     class PostulationController{
 
         private $PostulationDAO;
 
         public function __construct(){
 
             $this->PostulationDAO = new PostulationDAO;
         }

         public function ShowPostulationListView(){
            $result = $this->Postulation->GetAll();

            require_once(VIEWS_PATH . ""); 
         }

         public function ShowAddView(){

            require_once(VIEWS_PATH . "");
         }

         public function ShowModifView($studentId,  $JobOfferId, $postulationDate){
            $ModifPostulation = new Postulation();
            $ModifPostulation->setStudentId($studentId);
            $ModifPostulation->setJobOfferId($JobOfferId);
            $ModifPostulation->setPostulationDate($postulationDate);

            require_once(VIEWS_PATH . "");
        }

        public function Add($studentId,  $JobOfferId, $postulationDate){

            $newPostulation = new Postulation;
            
            $newPostulation->setStudentId($studentId);
            $newPostulation->setJobOfferId($JobOfferId);
            $newPostulation->setPostulationDate($postulationDate);
        
            $this->PostulationDAO->Add($newPostulation);

            $this->ShowPostulationListView();
            
        }

        public function Remove($StudentId)
        {
            $ModifPostulation = new Postulation();
            $ModifPostulation->setStudentId($StudentId);
            $this->PostulationDAO->Remove($ModifPostulation);

            $this->ShowPostulationListView();
        }

         public function GetAll(){
 
             return $this->PostulationDAO->GetAll();
         }

         public function GetByStudent($StudentId){
 
            return $this->PostulationDAO->GetByStudent($StudentId);
        }

        public function GetByJobOffer($JobOfferId){
 
            return $this->PostulationDAO->GetByJobOffer($JobOfferId);
        }
     }


?>