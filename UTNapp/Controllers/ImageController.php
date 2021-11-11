<?php
    namespace Controllers;

    use DAO\ImageDAO as ImageDAO;
    use Models\Image as Image;

    class ImageController
    {
        private $imageDAO;

        public function __construct()
        {
            $this->imageDAO = new ImageDAO();
        }

        public function ShowUploadView()
        {
            require_once(VIEWS_PATH."addImage.php");
        }

        public function ShowListView()
        {
            $imageList = $this->imageDAO->GetAll();

            require_once(VIEWS_PATH."imageList.php");
        }

        public function ShowImage($idImage)
        {

            $image = $this->imageDAO->GetByIdImage(intval($idImage));

            require_once(VIEWS_PATH."imageShow.php");
        }

        public function Upload($idStudent, $file)
        {
            try
            {
                
                $fileName = $file["name"];
                $tempFileName = $file["tmp_name"];
                $type = $file["type"];
            
                $filePath = UPLOADS_PATH.basename($fileName);            

                $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                $imageSize = getimagesize($tempFileName);

                if($imageSize !== false)
                {
                    if (move_uploaded_file($tempFileName, $filePath))
                    {

                        $image = new Image();
                        $image->setName($fileName);
                        $image->setIdStudent($idStudent);
                        
                        $this->imageDAO->Add($image);

                        $message = "Imagen subida correctamente";
                    }
                    else
                        $message = "Ocurrió un error al intentar subir la imagen";
                }
                else   
                    $message = "El archivo no corresponde a una imágen";
            }
            catch(Exception $ex)
            {
                $message = $ex->getMessage();
            }

            $this->ShowListView();
        }    
    }
?>