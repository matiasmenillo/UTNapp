<?php
    namespace Models;

    class Mail
    {
        private $MailId;
        private $company;
        private $user;
        private $header;
        private $message;
        private $SentDate;

        public function getMailId()
        {
            return $this->MailId;
        }

        public function setMailId($MailId)
        {
            $this->MailId = $MailId;
        }

        public function getCompany()
        {
            return $this->company;
        }

        public function setCompany(Company $company)
        {
            $this->company = $company;
        }

        public function getUser()
        {
            return $this->user;
        }

        public function setUser(User $user)
        {
            $this->user = $user;
        }

        public function getHeader()
        {
            return $this->header;
        }

        public function setHeader($header)
        {
            $this->header = $header;
        }

        public function getMessage()
        {
            return $this->message;
        }

        public function setMessage($message)
        {
            $this->message = $message;
        }

        public function getSentDate()
        {
            return $this->SentDate;
        }

        public function setSentDate($SentDate)
        {
            $this->SentDate = $SentDate;
        }

    }
?>  