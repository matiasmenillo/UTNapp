<?php
    namespace DAO;
    use Models\User as User;
    use Models\Mail as Mail;

    interface IMailDAO{

        function Add(Mail $mail);
        function GetAllByUser(User $user);
        function Delete ($MailId);
    }

?>