<?php
     namespace Controllers;

     use Models\Postulation as Postulation;
     use DAO\PostulationDAO as PostulationDAO;
     use DAO\JobOfferDAO as JobOfferDAO;
     use DAO\CareerDAO as CareerDAO;
     use DAO\CompanyDAO as CompanyDAO;
     use DAO\JobPositionDAO as JobPositionDAO;
     use DAO\StudentDAO as StudentDAO;
     use DAO\ImageDAO as ImageDAO;

class PostulationController{
 
         private $PostulationDAO;
         private $JobOfferDAO;
         private $CareerDAO;
         private $JobPositionDAO;
         private $CompanyDAO;
         private $StudentDAO;
 
         public function __construct(){
 
             $this->PostulationDAO = new PostulationDAO;
             $this->JobOfferDAO = new JobOfferDAO;
             $this->CareerDAO = new CareerDAO;
             $this->JobPositionDAO = new JobPositionDAO;
             $this->CompanyDAO = new CompanyDAO;
             $this->StudentDAO = new StudentDAO;
             $this->ImageDAO = new ImageDAO;
             $this->MailController = new MailController;
         }

         public function ShowPostulateView()
         {
            $JobOfferDAO = new JobOfferDAO;
            $JobPositionDAO = new JobPositionDAO;

            $CareersList = $this->CareerDAO->GetAll();

            $JobPositionsList = $JobPositionDAO->GetAll();
            $JobOffersList = array();

            foreach($JobOfferDAO->GetAll() as $JobOffer)
            {
                foreach($JobPositionsList as $JobPosition)
                {
                    if ($JobPosition->GetJobPositionId() == $JobOffer->GetJobPosition()->GetJobPositionId())
                    {
                        foreach($CareersList as $career)
                        {
                            if ($career->getCareerId() == $JobPosition->getCareer()->getCareerId())
                            {
                                $JobPosition->setCareer($career);
                                $JobOffer->setJobPosition($JobPosition);

                                if ($_SESSION["loggedUser"]->GetRol() == 2)
                                {
                                    if ($_SESSION["loggedCompany"]->getId() == $JobOffer->getCompany()->getId())
                                    {
                                        array_push($JobOffersList, $JobOffer);
                                    }
                                }
                                else
                                {
                                    array_push($JobOffersList, $JobOffer);
                                }
                            }
                        }
                    }
                }
            }
             $CareersList =  $this->CareerDAO->GetALL();
             $CompanyList =  $this->CompanyDAO->GetAll();
 
             require_once(VIEWS_PATH . "postulateView.php");
         }

        public function Add($studentId,  $JobOfferId, $postulationDate)
        {
            $result =  $this->PostulationDAO->GetByStudent(intval($studentId));
            $student = $this->StudentDAO->GetById($studentId);
            $JobOffer = $this->JobOfferDAO->GetById($JobOfferId);

            foreach($this->JobPositionDAO->GetAll() as $JobPosition)
            {
                if ($JobPosition->getJobPositionId() == $JobOffer->getJobPosition()->getJobPositionId())
                {
                    $careerId = $JobPosition->getCareer()->getCareerId();
                }
            }

            if ($result == null)
            {
                if ($careerId == $student->GetCareer()->getCareerId())
                {
                    $newPostulation = new Postulation;
            
                    $newPostulation->setStudent($this->StudentDAO->GetById($studentId));
                    $newPostulation->setJobOffer($this->JobOfferDAO->GetById($JobOfferId));
                    $newPostulation->setPostulationDate($postulationDate);
                
                    $this->PostulationDAO->Add($newPostulation);

                    $this->MailController->SendWelcomeMail($newPostulation->getJobOffer());

                    echo "<script>alert('¡Postulado correctamente!')</script>";
                    $this->ShowPostulateView();
                }
                else
                {
                    echo "<script>alert('Usted no pertenece a la carrera requerida para postularse en la Oferta Laboral.')</script>";
                    $this->ShowPostulateView();
                }
            }
            else
            {
                echo "<script>alert('Usted ya esta postulado en una Oferta Laboral')</script>";
                $this->ShowPostulateView();
            }
            
            
        }

        public function showPostulationHistoryView()
        {
            $JobOfferDAO = new JobOfferDAO;
            $JobPositionDAO = new JobPositionDAO;

            $CareersList =  $this->CareerDAO->GetALL();

            $JobPositionsList = $JobPositionDAO->GetAll();
            $JobOffersList = array();

            foreach($JobOfferDAO->GetAllHistoric() as $JobOffer)
            {
                foreach($JobPositionsList as $JobPosition)
                {
                    if ($JobPosition->GetJobPositionId() == $JobOffer->GetJobPosition()->GetJobPositionId())
                    {
                        foreach($CareersList as $career)
                        {
                            if ($career->getCareerId() == $JobPosition->getCareer()->getCareerId())
                            {
                                $JobPosition->setCareer($career);
                                $JobOffer->setJobPosition($JobPosition);
                                array_push($JobOffersList, $JobOffer);
                            }
                        }
                    }
                }
            }

             $CompanyList =  $this->CompanyDAO->GetAll();

             if ($_SESSION["loggedUser"]->getRol() == 0)
             {
                $Postulations = $this->PostulationDAO->GetAllHistoryByStudent($_SESSION["loggedStudent"]);
                $PostulationHistory = array();

                foreach($Postulations as $Postulation)
                {
                    foreach($JobOffersList as $JobOffer)
                    {
                        if ($Postulation->getJobOffer()->getJobOfferId() == $JobOffer->getJobOfferId())
                        {
                            $Postulation->setJobOffer($JobOffer);
                            array_push($PostulationHistory, $Postulation);
                        }
                    }   
                }

                $PostulacionVigente = $this->PostulationDAO->GetByStudent($_SESSION["loggedStudent"]->getStudentId());

                if ($PostulacionVigente != null)
                {
                    foreach($this->JobOfferDAO->GetAll() as $jobOffer)
                    {
                        if ($PostulacionVigente->getJobOffer()->getjobOfferId() == $jobOffer->getjobOfferId())
                        {
                            foreach($JobPositionsList as $jobposition)
                            {
                                if ($jobposition->getJobPositionId() == $jobOffer->getJobPosition()->getJobPositionId())
                                {
                                    foreach($CareersList as $career)
                                    {
                                        if ($career->getCareerId() == $jobposition->getCareer()->getCareerId())
                                        {
                                            $jobposition->setCareer($career);
                                            $jobOffer->setJobPosition($jobposition);
                                            $PostulacionVigente->setJobOffer($jobOffer);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                require_once(VIEWS_PATH . "postulationHistoryList.php");
             }
             else if ($_SESSION["loggedUser"]->getRol() == 1)
             {

                $PostulationHistory = array();
                $Postulations = $this->PostulationDAO->GetAllHistory();

                foreach($Postulations as $Postulation)
                {
                    foreach($JobOffersList as $JobOffer)
                    {
                        if ($Postulation->getJobOffer()->getJobOfferId() == $JobOffer->getJobOfferId())
                        {
                            $Postulation->setJobOffer($JobOffer);
                            array_push($PostulationHistory, $Postulation);
                        }
                    }
                }

                require_once(VIEWS_PATH . "postulationHistoryListAdmin.php");
             }
             else
             {
                $PostulationHistory = array();
                $Postulations = $this->PostulationDAO->GetAllHistory();

                foreach($Postulations as $Postulation)
                {
                    foreach($JobOffersList as $JobOffer)
                    {
                        if ($Postulation->getJobOffer()->getJobOfferId() == $JobOffer->getJobOfferId() && $JobOffer->getCompany()->getId() == $_SESSION["loggedCompany"]->getId())
                        {
                            $Postulation->setJobOffer($JobOffer);
                            array_push($PostulationHistory, $Postulation);
                        }
                    }
                }

                require_once(VIEWS_PATH . "postulationHistoryListCompany.php");
             }

        }

        public function Remove($StudentId)
        {
            $RemovePostulation = new Postulation();
            $RemovePostulation->setStudent($this->StudentDAO->GetById($StudentId));
            $this->PostulationDAO->Remove($RemovePostulation);

            $this->showPostulationHistoryView();
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