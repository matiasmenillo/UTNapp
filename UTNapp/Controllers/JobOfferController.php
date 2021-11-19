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
            $this->MailController = new MailController;

         }

         public function ShowJobOfferListView(){
            $PostulationController = new PostulationController;
            $PostulationController->ShowPostulateView();
        }

        public function ShowPDFView($jobOfferId)
        {
            $jobOffer = $this->JobOfferDAO->GetById($jobOfferId);
            $postulationList = $this->PostulationDAO->GetByJobOffer($jobOfferId);

            require_once(VIEWS_PATH . "pdfView.php");
        }

        public function ShowAddView(){

            $careerList = $this->CareerDAO->GetAll();
            $companyList = $this->CompanyDAO->GetAll();
            $jobPositions = $this->JobPositionDAO->GetAll();
            $jobPositionList = array();

            foreach($jobPositions as $jobPosition)
            {
                foreach($careerList as $career)
                {
                    if ($jobPosition->getCareer()->getCareerId() == $career->getCareerId())
                    {
                        $jobPosition->setCareer($career);
                        array_push($jobPositionList, $jobPosition);
                    }
                }
            }


            require_once(VIEWS_PATH . "addJobOffer.php");
        }

        public function ShowModifView($jobOfferId,  $jobPositionId, $companyId)
        {
            $ModifJobOffer = new JobOffer();
            $ModifJobOffer->setjobOfferId($jobOfferId);
            $ModifJobOffer->setCompany($this->CompanyDAO->GetById($companyId));

            $companyList = $this->CompanyDAO->GetAll();
            $careerList = $this->CareerDAO->GetAll();
            $jobPositions = $this->JobPositionDAO->GetAll();
            $jobPositionList = array();

            foreach($jobPositions as $jobPosition)
            {
                foreach($careerList as $career)
                {
                    if ($jobPosition->getCareer()->getCareerId() == $career->getCareerId())
                    {
                        $jobPosition->setCareer($career);
                        array_push($jobPositionList, $jobPosition);
                    }
                }

                if($jobPosition->getJobPositionId() == $jobPositionId)
                {
                    $ModifJobOffer->setJobPosition($jobPosition);
                }
            }

            require_once(VIEWS_PATH . "modifyJobOffer.php");
        }

        public function ShowPostulatedStudents($JobOfferId, $CompanyId, $JobPositionId)
        {
            $JobOffer = new JobOffer();
            $JobOffer->setjobOfferId($JobOfferId);
            $JobOffer->setCompany($this->CompanyDAO->GetById($CompanyId));

            $carrerList = $this->CareerDAO->GetAll();

            $postulationList = $this->PostulationDAO->GetByJobOffer($JobOffer->getjobOfferId());

            foreach($this->JobPositionDAO->GetAll() as $JobPosition)
            {
                if ($JobPosition->getJobPositionId() == $JobPositionId)
                {
                    foreach($carrerList as $career)
                    {
                        if ($career->getCareerId() == $JobPosition->getCareer()->getCareerId())
                        {
                            $JobPosition->setCareer($career);
                            $JobOffer->setJobPosition($JobPosition);
                        }
                    }
                }
            }

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
                            foreach($carrerList as $career)
                            {
                                if ($career->getCareerId() == $student->getCareer()->getCareerId())
                                {
                                    $student->setCareer($career);
                                    array_push($studentList, $student);
                                }
                            }
                        }
                    }
                }
            }

            require_once(VIEWS_PATH . "postulatedStudentsJobOfferList.php");
        }

        public function Add($jobPositionId, $companyId){

            $newJobOffer = new JobOffer;
         
            $newJobOffer->setCompany($this->CompanyDAO->GetById($companyId));

            foreach($this->JobPositionDAO->GetAll() as $JobPosition)
            {
                if ($JobPosition->getJobPositionId() == $jobPositionId)
                {
                    $newJobOffer->setJobPosition($JobPosition);
                }
            }
        
            $error = $this->JobOfferDAO->Add($newJobOffer);

            if ($error != null)
            {   
                echo "<script>alert('". $error ."')</script>";
            }

            $this->ShowJobOfferListView();
        }

        public function Modify($jobPositionId, $companyId, $jobOfferId){

            $ModifJobOffer = new JobOffer();
            $ModifJobOffer->setjobOfferId($jobOfferId);
            $ModifJobOffer->setCompany($this->CompanyDAO->GetById($companyId));

            foreach($this->JobPositionDAO->GetAll() as $JobPosition)
            {
                if ($JobPosition->getJobPositionId() == $jobPositionId)
                {
                    $ModifJobOffer->setJobPosition($JobPosition);
                }
            }

            $error = $this->JobOfferDAO->Update($ModifJobOffer);

            if ($error != null)
            {   
                echo "<script>alert('". $error ."')</script>";
            }

            $this->ShowJobOfferListView();
            
        }

        public function Remove($jobOfferId)
        {
            $ModifJobOffer = $this->JobOfferDAO->GetById($jobOfferId);
            $result = $this->JobOfferDAO->Remove($ModifJobOffer);

            if ($result != null)
            {
                echo "<script>alert('". $result ."')</script>";
            }
            else
            {
                $MailController = new MailController;
                $MailController->SendEndMail($ModifJobOffer);
            }

            $this->ShowJobOfferListView();
        }

         public function GetAll()
         {
            $JobOfferDAO = new JobOfferDAO;
            $JobPositionDAO = new JobPositionDAO;

            $careerList = $this->CareerDAO->GetAll();
            $jobPositions = $this->JobPositionDAO->GetAll();
            $JobPositionsList = array();

            foreach($jobPositions as $jobPosition)
            {
                foreach($careerList as $career)
                {
                    if ($jobPosition->getCareer()->getCareerId() == $career->getCareerId())
                    {
                        $jobPosition->setCareer($career);
                        array_push($JobPositionsList, $jobPosition);
                    }
                }
            }
            $JobOffersList = array();

            foreach($JobOfferDAO->GetAll() as $JobOffer)
            {
                foreach($JobPositionsList as $JobPosition)
                {
                    if ($JobPosition->GetJobPositionId() == $JobOffer->GetJobPosition()->GetJobPositionId())
                    {
                        array_push($JobOffersList, $JobOffer);
                    }
                }
            }

            return $JobOffersList;
         }

         public function FilterJobOffersByCareer($CareerId)
         {
            $JobOfferDAO = new JobOfferDAO;
            $JobPositionDAO = new JobPositionDAO;

            $careerList = $this->CareerDAO->GetAll();
            $jobPositions = $this->JobPositionDAO->GetAll();
            $JobPositionsList = array();

            foreach($jobPositions as $jobPosition)
            {
                foreach($careerList as $career)
                {
                    if ($jobPosition->getCareer()->getCareerId() == $career->getCareerId())
                    {
                        $jobPosition->setCareer($career);
                        array_push($JobPositionsList, $jobPosition);
                    }
                }
            }
            $JobOffersList = array();

            foreach($JobOfferDAO->GetAll() as $JobOffer)
            {
                foreach($JobPositionsList as $JobPosition)
                {
                    if ($JobPosition->GetJobPositionId() == $JobOffer->GetJobPosition()->GetJobPositionId())
                    {
                        $JobOffer->setJobPosition($JobPosition);
                        array_push($JobOffersList, $JobOffer);
                    }
                }
            }

            foreach ($JobOffersList as $JobOffer => $val)
            {
                foreach($JobPositionsList as $eachJobPosition)
                {
                    if ($eachJobPosition->getJobPositionId() == $val->getJobPosition()->getJobPositionId())
                    {
                        $JobPosition = $eachJobPosition;
                    }
                }

                if ($JobPosition->getCareer()->getCareerId() != intval($CareerId))
                {
                    unset($JobOffersList[$JobOffer]);
                }
            }

            if (count($JobOffersList) > 0)
            {
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
            $JobPositionDAO = new JobPositionDAO;

            $careerList = $this->CareerDAO->GetAll();
            $jobPositions = $this->JobPositionDAO->GetAll();
            $JobPositionsList = array();

            foreach($jobPositions as $jobPosition)
            {
                foreach($careerList as $career)
                {
                    if ($jobPosition->getCareer()->getCareerId() == $career->getCareerId())
                    {
                        $jobPosition->setCareer($career);
                        array_push($JobPositionsList, $jobPosition);
                    }
                }
            }
            $JobOffersList = array();

            foreach($JobOfferDAO->GetAll() as $JobOffer)
            {
                foreach($JobPositionsList as $JobPosition)
                {
                    if ($JobPosition->GetJobPositionId() == $JobOffer->GetJobPosition()->GetJobPositionId())
                    {
                        $JobOffer->setJobPosition($JobPosition);
                        array_push($JobOffersList, $JobOffer);
                    }
                }
            }

            foreach ($JobOffersList as $JobOffer => $val)
            {
                if ($val->getJobPosition()->getJobPositionId() != intval($jobPositionId))
                {
                    unset($JobOffersList[$JobOffer]);
                }
            }

            if (count($JobOffersList) > 0)
            {
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