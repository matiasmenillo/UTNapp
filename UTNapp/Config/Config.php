<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/UTNapp/UTNapp/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", VIEWS_PATH . "img/");

//Path to API
define("URLAPI", "https://utn-students-api.herokuapp.com/api/Student");
define("HTTPHEADER", ['x-api-key:4f3bceed-50ba-4461-a910-518598664c08']);
?>

