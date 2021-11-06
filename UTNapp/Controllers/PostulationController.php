<?php
     namespace Controllers;

     use Models\Postulation as Postulation;
     use DAO\PostulationDAO as PostulationDAO;
     use DAO\JobOfferDAO as JobOfferDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\CompanyDAO as CompanyDAO;
     use DAO\JobPositionDAO as JobPositionDAO;
     use DAO\StudentDAO;

class PostulationController{
 
         private $PostulationDAO;
         private $JobOfferDAO;
         private $CareerDAO;
         private $JobPositionDAO;
         private $CompanyDAO;
 
         public function __construct(){
 
             $this->PostulationDAO = new PostulationDAO;
             $this-> JobOfferDAO = new JobOfferDAO;
             $this->CareerDAO = new CareerDAO;
             $this->JobPositionDAO = new JobPositionDAO;
             $this->CompanyDAO = new CompanyDAO;
             $this->StudentDAO = new StudentDAO;
         }

         public function ShowPostulateView()
         {
             $JobOffersList =  $this->JobOfferDAO->GetAll();
             $CareersList =  $this->CareerDAO->GetALL();
             $JobPositionsList =  $this->JobPositionDAO->GetAll();
             $CompanyList =  $this->CompanyDAO->GetAll();
 
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
            $result =  $this->PostulationDAO->GetByStudent(intval($studentId));
            $student = $this->StudentDAO->GetById($studentId);
            $JobOffer = $this->JobOfferDAO->GetById($JobOfferId);

            foreach($this->JobPositionDAO->GetAll() as $JobPosition)
            {
                if ($JobPosition->getJobPositionId() == $JobOffer->getJobPositionId())
                {
                    $careerId = $JobPosition->getCareerId();
                }
            }

            if ($result == null)
            {
                if ($careerId == $student->GetCareerID())
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
                    echo "Usted no pertenece a la carrera requerida para postularse en la Oferta Laboral";
                    $this->ShowPostulateView();
                }
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