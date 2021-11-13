<?php
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CareerDAO implements ICareerDAO
    {
        public function GetAll()
        {
            //CURL
            $url = curl_init();
            //Sets URL
            curl_setopt($url, CURLOPT_URL, URL_API_CAREER);
            //Sets Header key
            curl_setopt($url, CURLOPT_HTTPHEADER, HTTPHEADER);
            curl_setopt($url, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false); // Hace que la solicitud/conexión sea insegura.

            $response = curl_exec($url);
            $toJson = json_decode($response);

            if ($toJson != null)
            {
                $arrayCareers = array();

                foreach($toJson as $eachCareer)
                {
                    $newCareer = new Career;

                    $newCareer->setCareerId($eachCareer->careerId);
                    $newCareer->setDescription($eachCareer->description);
                    $newCareer->setActive(intval($eachCareer->active));

                    array_push($arrayCareers, $newCareer);
                }

                curl_close($url); 
                return $arrayCareers;
                
            }
            else
            {
                curl_close($url); 
                return null;
            }  
        }

        public function GetById($careerId){

            $arrayCareers = $this->GetAll();

            foreach($arrayCareers as $career)
            {
                if ($career->GetCareerId() == $careerId)
                {
                    return $career;
                }
            }

            return null;
        }   
    }
?>