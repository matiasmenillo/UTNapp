<?php
    namespace DAO;

    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\JobPosition as JobPosition;
    use DAO\CareerDAO as CareerDAO;

    class JobPositionDAO implements IJobPositionDAO
    {
        public function GetAll()
        {
            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, URL_API_JOBPOSITION);
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, HTTPHEADER);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); // Hace que la solicitud/conexión sea insegura.

            $response = curl_exec($url);
            $toJson = json_decode($response);

            if ($toJson != null)
            {
                $arrayJobPositions = array();

                foreach($toJson as $eachJobPosition)
                {
                    $newJobPosition = new JobPosition;
                    $careerDAO = new CareerDAO;

                    $newJobPosition->setJobPositionId($eachJobPosition->jobPositionId);
                    $newJobPosition->setCareer($careerDAO->GetById($eachJobPosition->careerId));
                    $newJobPosition->setDescription($eachJobPosition->description);

                    array_push($arrayJobPositions, $newJobPosition);
                    
                }

                curl_close($url);
                return $arrayJobPositions;
            }
            else
            {
                curl_close($url);
                return null;
            }   
        }

        public function GetById($JobPositionId)
        {
            $arrayJobPositions = $this->GetAll();

            foreach($arrayJobPositions as $jobPosition)
            {
                if ($jobPosition->getJobPositionId() == $JobPositionId)
                {
                    return $jobPosition;
                }
            }

            return null;
        }
    }
?>