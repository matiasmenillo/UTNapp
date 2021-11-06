<?php
     namespace Controllers;

     use Models\Postulation as Postulation;
     use DAO\PostulationDAO as PostulationDAO;
     use DAO\JobOfferDAO as JobOfferDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\CompanyDAO as CompanyDAO;
     use DAO\JobPositionDAO as JobPositionDAO;
 
     class PostulationController{
 
         private $PostulationDAO;
 
         public function __construct(){
 
             $this->PostulationDAO = new PostulationDAO;
         }

         public function ShowPostulateView()
         {
             $JobOfferDAO = new JobOfferDAO;
             $CareerDAO = new CareerDAO;
             $JobPositionDAO = new JobPositionDAO;
             $CompanyDAO = new CompanyDAO;

             $JobOffersList = $JobOfferDAO->GetAll();
             $CareersList = $CareerDAO->GetALL();
             $JobPositionsList = $JobPositionDAO->GetAll();
             $CompanyList = $CompanyDAO->GetAll();
 
             require_once(VIEWS_PATH . "postulateView.php");
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

        public function Add($studentId,  $JobOfferId, $postulationDate)
        {
            $PostulationDAO = new PostulationDAO;

            $result = $PostulationDAO->GetByStudent(intval($studentId));

            if ($result == null)
            {
                $newPostulation = new Postulation;
            
                $newPostulation->setStudentId($studentId);
                $newPostulation->setJobOfferId($JobOfferId);
                $newPostulation->setPostulationDate($postulationDate);
            
                $this->PostulationDAO->Add($newPostulation);

                echo "Postulado correctamente!";
                $this->ShowPostulateView();
            }
            else
            {
                echo "Usted ya esta postulado en una Oferta Laboral";
                $this->ShowPostulateView();
            }
            
            
        }

        public function Remove($StudentId)
        {
            $RemovePostulation = new Postulation();
            $RemovePostulation->setStudentId($StudentId);
            $this->PostulationDAO->Remove($RemovePostulation);

            $this->ShowPostulateView();
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