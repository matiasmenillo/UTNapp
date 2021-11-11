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
            $ModifJobOffer->setJobPosition($this->JobPositionDAO->GetById($jobPositionId));
            $ModifJobOffer->setCompany($this->CompanyDAO->GetById($companyId));

            $companyList = $this->CompanyDAO->GetAll();
            $jobPositionList = $this->JobPositionDAO->GetAll();

            require_once(VIEWS_PATH . "modifyJobOffer.php");
        }

        public function ShowPostulatedStudents($JobOfferId, $CompanyId, $JobPositionId)
        {
            $JobOffer = new JobOffer();
            $JobOffer->setjobOfferId($JobOfferId);
            $JobOffer->setJobPosition($this->JobPositionDAO->GetById($JobPositionId));
            $JobOffer->setCompany($this->CompanyDAO->GetById($CompanyId));

            $postulationList = $this->PostulationDAO->GetByJobOffer($JobOffer->getjobOfferId());

            $allStudentsList = $this->StudentDAO->GetAll();
            $studentList = array();

            if ($postulationList != null)
            {
                foreach($postulationList as $postulation)
                {
                    foreach($allStudentsList as $student)
                    {
                        if ($student->getStudentId() == $postulation->getStudent()->getStudentId())
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
         
            $newJobOffer->setJobPosition($this->JobPositionDAO->GetById($jobPositionId));
            $newJobOffer->setCompany($this->CompanyDAO->GetById($companyId));
        
            $this->JobOfferDAO->Add($newJobOffer);
            $this->ShowJobOfferListView();
        }

        public function Modify($jobPositionId, $companyId, $jobOfferId){

            $ModifJobOffer = new JobOffer();
            $ModifJobOffer->setjobOfferId($jobOfferId);
            $ModifJobOffer->setJobPosition($this->JobPositionDAO->GetById($jobPositionId));
            $ModifJobOffer->setCompany($this->CompanyDAO->GetById($companyId));

            $error = $this->JobOfferDAO->Update($ModifJobOffer);

            if ($error != null)
            {   
                echo "<script>alert('". $error ."')</script>";
            }

            $this->ShowJobOfferListView();
            
        }

        public function Remove($jobOfferId)
        {
            $ModifJobOffer = new JobOffer();
            $ModifJobOffer->setjobOfferId($jobOfferId);
            $result = $this->JobOfferDAO->Remove($ModifJobOffer);

            if ($result != null)
            {
                echo "<script>alert('". $result ."')</script>";
            }

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
                $JobPosition = $JobPositionDAO->GetById($val->getJobPosition()->getJobPositionId());

                if ($JobPosition->getCareer()->getCareerId() != intval($CareerId))
                {
                    unset($JobOffersList[$JobOffer]);
                }
            }

            if (count($JobOffersList) > 0)
            {
                $JobPositionsList = $this->JobPositionDAO->getAll();
                $CareersList = $this->CareerDAO->GetALL();
                $CompanyList = $this->CompanyDAO->GetAll();

                require_once(VIEWS_PATH . "postulateView.php"); 
            }
            else
            {
              echo "<script>alert('No se encontraron ofertas para el filtro ingresado.')</script>";
              $this->ShowJobOfferListView();
            }
         }

         public function FilterJobOffersByJobPosition($jobPositionId)
         {
            $JobOfferDAO = new JobOfferDAO;
            $JobOffersList = $JobOfferDAO->GetAll();

            foreach ($JobOffersList as $JobOffer => $val)
            {
                if ($val->getJobPosition()->getJobPositionId() != intval($jobPositionId))
                {
                    unset($JobOffersList[$JobOffer]);
                }
            }

            if (count($JobOffersList) > 0)
            {
                $JobPositionsList = $this->JobPositionDAO->getAll();
                $CareersList = $this->CareerDAO->GetALL();
                $CompanyList = $this->CompanyDAO->GetAll();

                require_once(VIEWS_PATH . "postulateView.php"); 
            }
            else
            {
            echo "<script>alert('No se encontraron ofertas para el filtro ingresado.')</script>";
              $this->ShowJobOfferListView();
            }
         }
     }


?>