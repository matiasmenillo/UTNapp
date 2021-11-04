<?php
     namespace Controllers;

     use Models\JobOffer as JobOffer;
     use DAO\JobOfferDAO as JobOfferDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\CompanyDAO as CompanyDAO;
     use DAO\JobPositionDAO as JobPositionDAO;
 
     class JobOfferController{
 
         private $JobOfferDAO;
 
         public function __construct(){
 
            $this->JobOfferDAO = new JobOfferDAO;
            $this->CareerDAO = new CareerDAO;
            $this->CompanyDAO = new CompanyDAO;
            $this->JobPositionDAO = new JobPositionDAO;
         }

         public function ShowJobOfferListView(){
            $PostulationController = new PostulationController;
            $PostulationController->ShowPostulateView();
        }

        public function ShowAddView(){

            $careerList = $this->CareerDAO->GetAll();
            $companyList = $this->CompanyDAO->GetAll();
            $jobPositionList = $this->JobPositionDAO->GetAll();

            require_once(VIEWS_PATH . "addJobOffer.php");
        }

        public function ShowModifView($jobOfferId,  $jobPositionId, $companyId){
            $ModifJobOffer = new JobOffer();
            $ModifJobOffer->setjobOfferId($jobOfferId);
            $ModifJobOffer->setJobPositionId($jobPositionId);
            $ModifJobOffer->setCompanyId($companyId);

            require_once(VIEWS_PATH . "");
        }

        public function Add($jobPositionId, $companyId){

            $newJobOffer = new JobOffer;
         
            $newJobOffer->setJobPositionId($jobPositionId);
            $newJobOffer->setCompanyId($companyId);
        
            $this->JobOfferDAO->Add($newJobOffer);
            $this->ShowJobOfferListView();
        }

        public function Modify($jobOfferId,  $jobPositionId, $companyId){

            $ModifJobOffer = new JobOffer();
            $ModifJobOffer->setjobOfferId($jobOfferId);
            $ModifJobOffer->setJobPositionId($jobPositionId);
            $ModifJobOffer->setCompanyId($companyId);

            $this->JobOfferDAO->Update($ModifJobOffer);

            $this->ShowJobOfferListView();
            
        }

        public function Remove($jobOfferId)
        {
            $ModifJobOffer = new JobOffer();
            $ModifJobOffer->setjobOfferId($jobOfferId);
            $this->JobOfferDAO->Remove($ModifJobOffer);

            $this->ShowJobOfferListView();
        }

         public function GetAll(){
 
             return $this->JobOfferDAO->GetAll();
         }
     }


?>