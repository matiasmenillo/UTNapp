<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/"); 
//Path to your project's root folder
define("FRONT_ROOT", "/UTNapp/UTNApp/"); // -> Ingresar ruta correspondiente a la ubicacion de la solucion
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", VIEWS_PATH . "img/");
define("UPLOADS_PATH", "Uploads/");

//Path to API
define("URL_API_STUDENT", "https://utn-students-api.herokuapp.com/api/Student");
define("URL_API_CAREER", "https://utn-students-api.herokuapp.com/api/Career");
define("URL_API_JOBPOSITION", "https://utn-students-api.herokuapp.com/api/JobPosition");
define("HTTPHEADER", ['x-api-key:4f3bceed-50ba-4461-a910-518598664c08']);

//Path to DB (Checkear estos datos en relacion a los de localhost)
define("DB_HOST", "localhost");
define("DB_NAME", "UTNAppDB");
define("DB_USER", "root");
define("DB_PASS", "1234");

//Mailer Basic Config (Checkear SPAM, los mails suelen llegar ahi)
define("SenderAdress", "UTNApp2021@gmail.com");
define("SenderPassword", "UTNAppPuerto");
define("SenderName", "UTNApp");
define("ReceiverAdress", "mauroporzio02@gmail.com"); //"-> Remplazar con la direccion que desea utilizar para recibir los mails a modo de test, entre las "".
?>

