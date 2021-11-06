<?php
     namespace Controllers;

     use Models\JobOffer as JobOffer;
     use DAO\JobOfferDAO as JobOfferDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\CompanyDAO as CompanyDAO;
     use DAO\JobPositionDAO as JobPositionDAO;
     use DAO\StudentDAO as StudentDAO;
     use DAO\PostulationDAO as PostulationDAO;
 
     class JobOfferController{
 
         private $JobOfferDAO;
         private $CareerDAO;
         private $CompanyDAO;
         private $JobPositionDAO;
         private $StudentDAO;
         private $PostulationDAO;
 
         public function __construct(){
 
            $this->JobOfferDAO = new JobOfferDAO;
            $this->CareerDAO = new CareerDAO;
            $this->CompanyDAO = new CompanyDAO;
            $this->JobPositionDAO = new JobPositionDAO;
            $this->StudentDAO = new StudentDAO;
            $this->PostulationDAO = new PostulationDAO;

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

            $careerList = $this->CareerDAO->GetAll();
            $companyList = $this->CompanyDAO->GetAll();
            $jobPositionList = $this->JobPositionDAO->GetAll();

            require_once(VIEWS_PATH . "modifyJobOffer.php");
        }

        public function ShowPostulatedStudents($JobOfferId, $CompanyId, $JobPositionId)
        {
            $JobOffer = new JobOffer();
            $JobOffer->setjobOfferId($JobOfferId);
            $JobOffer->setCompanyId($CompanyId);
            $JobOffer->setJobPositionId($JobPositionId);

            $jobPosition = $this->JobPositionDAO->GetById($JobOffer->getJobPositionId());
            $careerList = $this->CareerDAO->GetAll();
            $companyList = $this->CompanyDAO->GetAll();

            $postulationList = $this->PostulationDAO->GetByJobOffer($JobOffer->getjobOfferId());

            $allStudentsList = $this->StudentDAO->GetAll();
            $studentList = array();

            if ($postulationList != null)
            {
                foreach($postulationList as $postulation)
                {
                    foreach($allStudentsList as $student)
                    {
                        if ($student->getStudentId() == $postulation->getStudentId())
                        {
                            array_push($studentList, $student);
                        }
                    }
                }
            }

            require_once(VIEWS_PATH . "postulatedStudentsJobOfferList.php");
        }

        public function Add($jobPositionId, $companyId){

            $newJobOffer = new JobOffer;
         
            $newJobOffer->setJobPositionId($jobPositionId);
            $newJobOffer->setCompanyId($companyId);
        
            $this->JobOfferDAO->Add($newJobOffer);
            $this->ShowJobOfferListView();
        }

        public function Modify($jobPositionId, $companyId, $jobOfferId){

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

         public function FilterJobOffersByCareer($CareerId)
         {
            $JobOfferDAO = new JobOfferDAO;
            $JobPositionDAO = new JobPositionDAO;
            $JobOffersList = $JobOfferDAO->GetAll();

            foreach ($JobOffersList as $JobOffer => $val)
            {
                $JobPosition = $JobPositionDAO->GetById($val->getJobPositionId());

                if ($JobPosition->getCareerId() != intval($CareerId))
                {
                    unset($JobOffersList[$JobOffer]);
                }
            }

            if (count($JobOffersList) > 0)
            {
                $CompanyDAO = new CompanyDAO;
                $JobPositionDAO = new JobPositionDAO;
                $CareerDAO = new CareerDAO;

                $CareersList = $CareerDAO->GetALL();
                $JobPositionsList = $JobPositionDAO->GetAll();
                $CompanyList = $CompanyDAO->GetAll();

                require_once(VIEWS_PATH . "postulateView.php"); 
            }
            else
            {
              $errorMsg = "NO SE ENCONTRARON OFERTAS PARA EL FILTRO INGRESADO";
              echo $errorMsg;
              $this->ShowJobOfferListView();
            }
         }

         public function FilterJobOffersByJobPosition($jobPositionId)
         {
            $JobOfferDAO = new JobOfferDAO;
            $JobOffersList = $JobOfferDAO->GetAll();

            foreach ($JobOffersList as $JobOffer => $val)
            {
                if ($val->getJobPositionId() != intval($jobPositionId))
                {
                    unset($JobOffersList[$JobOffer]);
                }
            }

            if (count($JobOffersList) > 0)
            {
                $CareerDAO = new CareerDAO;
                $CompanyDAO = new CompanyDAO;
                $JobPositionDAO = new JobPositionDAO;

                $JobPositionsList = $JobPositionDAO->getAll();
                $CareersList = $CareerDAO->GetALL();
                $CompanyList = $CompanyDAO->GetAll();

                require_once(VIEWS_PATH . "postulateView.php"); 
            }
            else
            {
              $errorMsg = "NO SE ENCONTRARON OFERTAS PARA EL FILTRO INGRESADO";
              echo $errorMsg;
              $this->ShowJobOfferListView();
            }
         }
     }


?>