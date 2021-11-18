<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IMailDAO as IMailDAO;
    use DAO\Connection as Connection;
    use Models\Mail as Mail;
    use Models\User as User;
    use PHPMailer\PHPMailer\PHPMailer;

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

                $this->SendEmail($mail);
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        private function SendEmail(Mail $oMail)
        {
            $mail = new PHPMailer;

            $fname = $oMail->getUser()->getFirstName() . " " . $oMail->getUser()->getLastName();		
            $toemail = ReceiverAdress; // --> Config.php setea esta variable, en un caso real, deberia ser el mail que llega en $oMail->getUser()->getEmail().
            $subject = $oMail->getHeader();	
            $message = $oMail->getMessage();
            $mail->isSMTP();                           
            $mail->Host = 'smtp.gmail.com';            
            $mail->SMTPAuth = true;                    
            $mail->Username = SenderAdress; // --> Config.php setea esta variable
            $mail->Password = SenderPassword; // --> Config.php setea esta variable
            $mail->SMTPSecure = 'tls';          
            $mail->Port = 587;                  
            $mail->setFrom(SenderAdress, SenderName); // --> Config.php setea estas variables
            $mail->addReplyTo(SenderAdress, SenderName); // --> Config.php setea estas variables
            $mail->addAddress($toemail);   

            $mail->isHTML(true); 

            $bodyContent = $message;

            $mail->Subject = $subject;
            $bodyContent = 'Querido/a '.$fname.':';
            $bodyContent .='<p>'.$message.'</p>';
            $mail->Body = $bodyContent;

            $mail->send();
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