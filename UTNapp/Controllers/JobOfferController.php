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
         }

         public function ShowJobOfferListView(){
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