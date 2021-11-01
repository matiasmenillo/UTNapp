<?php
    namespace DAO;

    use Models\Postulation as Postulation;
    interface IPostulationDAO{

        function Add(Postulation $Postulation);
        function GetAll();
        function GetByStudent($IdStudent);
        function GetByJobOffer($IdJobOffer);
        function Remove(Postulation $Postulation);
    }

?>