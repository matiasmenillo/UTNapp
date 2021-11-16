<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IMailDAO as IMailDAO;
    use DAO\Connection as Connection;
    use Models\Mail as Mail;
    use Models\User as User;

    class MailDAO implements IMailDAO{

        private $connection;
        private $tableName = "Mail";

        public function Add(Mail $mail)
        {
            try
            {
                $query = "CALL InsertMail(:Email, :IdCompany, :Header, :Message);";
                
                $parameters["Email"] = $mail->getUser()->getEmail();
                $parameters["Header"] = $mail->getHeader();
                $parameters["Message"] = $mail->getMessage();
                $parameters["IdCompany"] = intval($mail->getCompany()->getId());

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetAllByUser(User $user)
        {
            try
            {
                $mailArray = array();

                $UserDAO = new UserDAO;
                $CompanyDAO = new CompanyDAO;

                $query = "CALL GetAllMailByEmail(:Email);";

                $parameters["Email"] = $user->getEmail();

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query , $parameters);

                foreach($resultSet as $row)
                {  
                    $mail= new Mail;                    
                    $mail->setMailId($row["IdMail"]);
                    $mail->setUser($UserDAO->GetByEmail($row["Email"]));
                    $mail->setCompany($CompanyDAO->GetById($row["IdCompany"]));
                    $mail->setHeader($row["Header"]);
                    $mail->setMessage($row["Message"]);
                    $mail->setSentDate($row["SentDate"]);

                    array_push($mailArray, $mail);
                }
                return $mailArray;             
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function GetByid($mailId)
        {
            try
            {
                $mail= new Mail;

                $mailArray = array();

                $UserDAO = new UserDAO;
                $CompanyDAO = new CompanyDAO;

                $query = "CALL GetMailById(:IdMail);";

                $parameters["IdMail"] = $mailId;

                $this->connection = Connection::GetInstance();

                $row = $this->connection->Execute($query , $parameters)[0];   

                $mail->setMailId($row["IdMail"]);
                $mail->setUser($UserDAO->GetByEmail($row["Email"]));
                $mail->setCompany($CompanyDAO->GetById($row["IdCompany"]));
                $mail->setHeader($row["Header"]);
                $mail->setMessage($row["Message"]);
                $mail->setSentDate($row["SentDate"]);

                return $mail;             
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Delete($MailId)
        {
            try
            {
                $query = "CALL DeleteMail(:IdMail);";

                $parameters["IdMail"] = intval($MailId);

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }
    }
?>