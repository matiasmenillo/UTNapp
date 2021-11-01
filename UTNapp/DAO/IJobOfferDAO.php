<?php
    namespace DAO;

    use Models\JobOffer as JobOffer;
    interface IJobOfferDAO{

        function Add(JobOffer $JobOffer);
        function GetAll();
        function GetById($JobOfferId);
        function Remove(JobOffer $JobOffer);
        function Update(JobOffer $JobOffer);
    }

?>