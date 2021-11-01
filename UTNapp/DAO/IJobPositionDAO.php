<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;
    interface IJobPositionDAO{

        function Add(JobPosition $JobPosition);
        function GetAll();
        function GetById($JobPositionId);
        function Remove(JobPosition $JobPosition);
    }

?>