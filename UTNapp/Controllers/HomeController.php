<?php
    namespace Controllers;

    use Controllers\CareerController as CareerController;

    class HomeController
    {
        public function Home()
        {
            require_once(VIEWS_PATH."home.php");

        }      
        
        public function Index()
        {
            require_once(VIEWS_PATH."index.php");
        }   
    }
?>