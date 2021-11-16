USE UTNAppDB;

/*DROP TABLE IF EXISTS Mail;*/

CREATE TABLE Mail
(
IdMail INT Unique auto_increment NOT NULL,
Email VARCHAR(200) NOT NULL,
IdCompany INT NOT NULL,
Header VARCHAR(200) NOT NULL,
Message VARCHAR(1000) NOT NULL,
SentDate DATETIME NOT NULL,

Primary Key (IdMail),

CONSTRAINT fk_User_Mail FOREIGN KEY (Email)
REFERENCES Users(Email),

CONSTRAINT fk_Comapany_Mail FOREIGN KEY (IdCompany)
REFERENCES company(IdCompany)
)